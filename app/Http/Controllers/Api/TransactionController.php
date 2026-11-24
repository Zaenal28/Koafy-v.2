<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\DataTransaksiBarang;
use App\Models\DetailTransaksi;
use App\Models\PenyiapanPenyerahanBarang;
use App\Models\Transaksi;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Ambil daftar transaksi (untuk Admin & Customer) + Notifikasi Transaksi Baru
     */
    public function index(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);

        $query = Transaksi::with(['details', 'transaksiBarang', 'pengiriman', 'customer'])
            ->orderByDesc('id');

        if ($request->boolean('mine') && $user && $user->role === 'customer') {
            $query->where('id_customer', $user->id);
        } elseif ($request->filled('id_customer')) {
            $query->where('id_customer', $request->input('id_customer'));
        }

        $transactions = $query->get()->map(fn (Transaksi $t) => $this->formatTransaksi($t));

        $unreadNotifications = Transaksi::with(['details', 'pengiriman'])
            ->where('is_notif_read', false)
            ->orderByDesc('id')
            ->get()
            ->map(fn (Transaksi $t) => [
                'id' => $t->id,
                'kode_invoice' => $t->kode_invoice,
                'nama_customer' => $t->nama_customer,
                'total_pembayaran' => (int) $t->total_pembayaran,
                'metode_pembayaran' => $t->metode_pembayaran,
                'status_pembayaran' => $t->status_pembayaran,
                'tanggal' => $t->tanggal,
                'has_bukti' => !empty($t->bukti_transfer),
                'created_at' => $t->created_at ? $t->created_at->format('d M Y H:i') : $t->tanggal,
            ]);

        return response()->json([
            'success' => true,
            'transactions' => $transactions,
            'unread_count' => $unreadNotifications->count(),
            'notifications' => $unreadNotifications,
        ]);
    }

    /**
     * Simpan Transaksi Baru saat Customer melakukan Checkout
     * Menyimpan ke tabel:
     * - transaksi (Database transaksi & data transaksi)
     * - detail_transaksi (Detail transaksi)
     * - data_transaksi_barang (Data transaksi barang)
     * - penyiapan_penyerahan_barang (Penyiapan & Penyerahan Barang)
     */
    public function store(Request $request): JsonResponse
    {
        $user = JwtService::userFromRequest($request);

        return DB::transaction(function () use ($request, $user) {
            $customerId = $user?->id ?? $request->input('id_customer');
            if (!$customerId) {
                $firstCustomer = User::where('role', 'customer')->first();
                $customerId = $firstCustomer?->id;
            }

            $randomDigits = rand(1000, 9999);
            $kodeInvoice = $request->input('kode_invoice')
                ?? $request->input('id')
                ?? ('INV/' . date('Ymd') . '/KFY/' . $randomDigits);

            // Jika kode invoice sudah ada, tambahkan suffix unik
            if (Transaksi::where('kode_invoice', $kodeInvoice)->exists()) {
                $kodeInvoice .= '-' . rand(10, 99);
            }

            $namaCustomer = $request->input('nama_customer')
                ?? $request->input('recipientName')
                ?? $user?->name
                ?? 'Siti Rahma';

            $telpon = $request->input('telpon')
                ?? $request->input('phone')
                ?? $user?->no_telpon
                ?? '081234567890';

            $alamat = $request->input('alamat')
                ?? $request->input('fullAddress')
                ?? 'Jl. Senopati No. 45, RT 02 / RW 05, Kebayoran Baru, Jakarta Selatan';

            $kecamatan = $request->input('kecamatan') ?? $request->input('area', 'Kebayoran Baru');
            $kodePos = $request->input('kode_pos') ?? $request->input('postalCode', '12110');

            $items = $request->input('items', []);
            $subtotal = 0;
            foreach ($items as $item) {
                $price = (int) ($item['price'] ?? $item['harga'] ?? 156510);
                $qty = (int) ($item['qty'] ?? 1);
                $subtotal += ($price * $qty);
            }
            if ($subtotal === 0) {
                $subtotal = (int) ($request->input('subtotal_pembayaran') ?? $request->input('totalAmount', 156510));
            }

            $ongkir = (int) ($request->input('ongkir') ?? $request->input('shippingFee', 0));
            $diskonVoucer = (int) ($request->input('diskon_voucer') ?? $request->input('discountAmount', 0));
            $voucer = $request->input('voucer') ?? $request->input('voucherCode');
            $totalPembayaran = (int) ($request->input('total_pembayaran') ?? $request->input('totalAmount') ?? max(0, $subtotal + $ongkir - $diskonVoucer));

            $metodePembayaran = $request->input('metode_pembayaran') ?? $request->input('paymentMethod', 'Transfer Bank BCA (No. Rekening)');
            $tipePembayaran = $request->input('tipe_pembayaran') ?? $request->input('paymentType', 'manual_bca');
            $statusPembayaran = $request->input('status_pembayaran') ?? $request->input('statusLabel', 'Menunggu Pembayaran');

            $now = now();

            // 1. Insert ke tabel transaksi
            $transaksi = Transaksi::create([
                'kode_invoice' => $kodeInvoice,
                'tanggal' => $request->input('tanggal') ?? $request->input('date', date('d M Y')),
                'id_customer' => $customerId,
                'nama_customer' => $namaCustomer,
                'alamat' => $alamat,
                'kecamatan' => $kecamatan,
                'kode_pos' => $kodePos,
                'telpon' => $telpon,
                'voucer' => $voucer,
                'diskon_voucer' => $diskonVoucer,
                'ongkir' => $ongkir,
                'subtotal_pembayaran' => $subtotal,
                'total_pembayaran' => $totalPembayaran,
                'metode_pembayaran' => $metodePembayaran,
                'tipe_pembayaran' => $tipePembayaran,
                'status_pembayaran' => $statusPembayaran,
                'nama_rekening_pengirim' => $request->input('nama_rekening_pengirim'),
                'bank_pengirim' => $request->input('bank_pengirim'),
                'bukti_transfer' => $request->input('bukti_transfer'),
                'is_notif_read' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // 2. Insert ke tabel detail_transaksi & data_transaksi_barang
            foreach ($items as $item) {
                $namaProduk = $item['name'] ?? $item['nama_produk'] ?? $item['nama_barang'] ?? 'Koafy Beauty Product';
                $hargaSatuan = (int) ($item['price'] ?? $item['harga'] ?? 156510);
                $qtyItem = (int) ($item['qty'] ?? 1);
                $itemSubtotal = $hargaSatuan * $qtyItem;
                $idBarang = isset($item['id']) && is_numeric($item['id']) ? (int) $item['id'] : null;

                if (!$idBarang) {
                    $foundBarang = DataBarang::where('nama_barang', 'like', '%' . $namaProduk . '%')->first();
                    $idBarang = $foundBarang?->id;
                }

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_customer' => $customerId,
                    'id_barang' => $idBarang,
                    'nama_customer' => $namaCustomer,
                    'nama_produk' => $namaProduk,
                    'shade' => $item['shade'] ?? $item['meta'] ?? 'Standar',
                    'harga' => $hargaSatuan,
                    'qty' => $qtyItem,
                    'voucer' => $voucer,
                    'ongkir' => $ongkir,
                    'subtotal' => $itemSubtotal,
                    'subtotal_pembayaran' => $subtotal,
                    'total_pembayaran' => $totalPembayaran,
                    'metode_pembayaran' => $metodePembayaran,
                    'status_pembayaran' => $statusPembayaran,
                    'gambar_produk' => $item['image'] ?? '/images/product-butterbalm-duo.jpg',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                DataTransaksiBarang::create([
                    'id_transaksi' => $transaksi->id,
                    'id_barang' => $idBarang,
                    'nama_barang' => $namaProduk,
                    'harga' => $hargaSatuan,
                    'qty' => $qtyItem,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // 3. Insert ke tabel penyiapan_penyerahan_barang
            $jasaPengiriman = $request->input('jasa_pengiriman')
                ?? $request->input('courier')
                ?? 'J&T Express - Regular';

            $noResi = $request->input('no_resi')
                ?? $request->input('trackingNumber')
                ?? 'BELUM DIINPUT';

            $statusPengiriman = $request->input('status_pengiriman') ?? 'Menunggu Konfirmasi Pembayaran';

            PenyiapanPenyerahanBarang::create([
                'id_transaksi' => $transaksi->id,
                'jasa_pengiriman' => $jasaPengiriman,
                'no_resi' => $noResi,
                'status_pengiriman' => $statusPengiriman,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan ke database dan notifikasi dikirim ke Admin.',
                'transaction' => $this->formatTransaksi($transaksi->fresh(['details', 'transaksiBarang', 'pengiriman'])),
            ], 201);
        });
    }

    /**
     * Customer Upload Bukti Transfer BCA & Input Nama Pemilik Rekening Pengirim
     */
    public function uploadTransferProof(Request $request, string $idOrInvoice): JsonResponse
    {
        $transaksi = is_numeric($idOrInvoice)
            ? Transaksi::find($idOrInvoice)
            : Transaksi::where('kode_invoice', urldecode($idOrInvoice))->first();

        if (!$transaksi && $request->filled('kode_invoice')) {
            $transaksi = Transaksi::where('kode_invoice', $request->input('kode_invoice'))->first();
        }

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Data transaksi tidak ditemukan.',
            ], 404);
        }

        $transaksi->update([
            'nama_rekening_pengirim' => $request->input('nama_rekening_pengirim') ?? $request->input('senderName'),
            'bank_pengirim' => $request->input('bank_pengirim') ?? $request->input('senderBank', 'BCA'),
            'bukti_transfer' => $request->input('bukti_transfer') ?? $request->input('transferProofImage'),
            'status_pembayaran' => 'Menunggu Verifikasi Admin',
            'is_notif_read' => false, // Munculkan notifikasi baru untuk Admin
            'updated_at' => now(),
        ]);

        $transaksi->details()->update([
            'status_pembayaran' => 'Menunggu Verifikasi Admin',
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti transfer berhasil disimpan di database. Menunggu verifikasi Admin.',
            'transaction' => $this->formatTransaksi($transaksi->fresh(['details', 'transaksiBarang', 'pengiriman'])),
        ]);
    }

    /**
     * ADMIN: Mengecek Transaksi & Mengubah Status Pembayaran Berhasil
     */
    public function updatePaymentStatus(Request $request, int $id): JsonResponse
    {
        $transaksi = Transaksi::with(['details', 'pengiriman'])->findOrFail($id);

        $statusPembayaran = $request->input('status_pembayaran', 'Pembayaran Berhasil');

        $transaksi->update([
            'status_pembayaran' => $statusPembayaran,
            'is_notif_read' => true,
            'updated_at' => now(),
        ]);

        $transaksi->details()->update([
            'status_pembayaran' => $statusPembayaran,
            'updated_at' => now(),
        ]);

        if ($transaksi->pengiriman) {
            if (str_contains(strtolower($statusPembayaran), 'berhasil') || str_contains(strtolower($statusPembayaran), 'lunas')) {
                if (in_array($transaksi->pengiriman->status_pengiriman, ['Menunggu Konfirmasi Pembayaran', 'Menunggu Konfirmasi'])) {
                    $transaksi->pengiriman->update([
                        'status_pengiriman' => 'Sedang Dikemas / Siap Kirim',
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran transaksi ' . $transaksi->kode_invoice . ' berhasil diubah menjadi: ' . $statusPembayaran,
            'transaction' => $this->formatTransaksi($transaksi->fresh(['details', 'transaksiBarang', 'pengiriman'])),
        ]);
    }

    /**
     * ADMIN: Menginput Nomor Resi Secara Manual & Update Status Pengiriman (Penyiapan & Penyerahan Barang)
     */
    public function updateShipment(Request $request, int $id): JsonResponse
    {
        $transaksi = Transaksi::with(['details', 'pengiriman'])->findOrFail($id);

        $jasaPengiriman = $request->input('jasa_pengiriman', $transaksi->pengiriman?->jasa_pengiriman ?? 'J&T Express - Regular');
        $noResi = trim((string) $request->input('no_resi', ''));
        $statusPengiriman = $request->input('status_pengiriman', $noResi ? 'Dikirim' : 'Sedang Dikemas');

        PenyiapanPenyerahanBarang::updateOrCreate(
            ['id_transaksi' => $transaksi->id],
            [
                'jasa_pengiriman' => $jasaPengiriman,
                'no_resi' => $noResi ?: 'BELUM DIINPUT',
                'status_pengiriman' => $statusPengiriman,
                'updated_at' => now(),
            ]
        );

        $transaksi->update([
            'is_notif_read' => true,
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nomor resi (' . ($noResi ?: '-') . ') & status pengiriman berhasil disimpan.',
            'transaction' => $this->formatTransaksi($transaksi->fresh(['details', 'transaksiBarang', 'pengiriman'])),
        ]);
    }

    /**
     * ADMIN: Tandai Notifikasi Transaksi Sudah Dibaca
     */
    public function markNotificationRead(Request $request): JsonResponse
    {
        if ($request->filled('id_transaksi')) {
            Transaksi::where('id', $request->input('id_transaksi'))->update(['is_notif_read' => true]);
        } else {
            Transaksi::where('is_notif_read', false)->update(['is_notif_read' => true]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi transaksi ditandai sudah dilihat.',
            'unread_count' => Transaksi::where('is_notif_read', false)->count(),
        ]);
    }

    /**
     * ADMIN: Ambil daftar semua pelanggan terdaftar dari database
     */
    public function customers(): JsonResponse
    {
        $customers = User::with(['dataUser', 'alamatCustomers', 'transaksi'])
            ->where('role', 'customer')
            ->orderByDesc('id')
            ->get()
            ->map(function (User $u) {
                $totalSpent = $u->transaksi->sum('total_pembayaran');
                $orderCount = $u->transaksi->count();
                $phone = $u->dataUser?->no_telpon ?? $u->no_telpon ?? '081234567890';
                $cleanWa = '62' . ltrim(preg_replace('/[^0-9]/', '', $phone), '0');

                return [
                    'id' => 'KFY-M' . str_pad((string) $u->id, 3, '0', STR_PAD_LEFT),
                    'id_customer' => $u->id,
                    'name' => $u->dataUser?->nama_lengkap ?? $u->name,
                    'nama_customer' => $u->name,
                    'email' => $u->email,
                    'phone' => $phone,
                    'no_telpon' => $phone,
                    'waNumber' => $cleanWa,
                    'tanggal_lahir' => $u->dataUser?->tanggal_lahir ?? '1998-05-14',
                    'tier' => $u->dataUser?->tier ?? 'GOLD MEMBER',
                    'totalSpent' => (int) $totalSpent,
                    'orderCount' => $orderCount,
                    'joinDate' => $u->created_at ? $u->created_at->format('d M Y') : '24 Nov 2026',
                    'addresses' => $u->alamatCustomers,
                ];
            });

        return response()->json([
            'success' => true,
            'customers' => $customers,
        ]);
    }

    private function formatTransaksi(Transaksi $t): array
    {
        $pengiriman = $t->pengiriman;
        $details = $t->details;

        $totalQty = $details->sum('qty') ?: 1;
        $itemsSummary = $details->map(fn (DetailTransaksi $d) => $d->nama_produk . ' (' . $d->qty . 'x)')->implode(', ');
        $firstShade = $details->first()?->shade ?? 'Standar';

        $statusPembayaranLower = strtolower($t->status_pembayaran);
        $statusPengirimanLower = strtolower($pengiriman?->status_pengiriman ?? '');

        $statusClass = 'amber';
        $filterCategory = 'pending';
        if (str_contains($statusPengirimanLower, 'dikirim') || str_contains($statusPengirimanLower, 'selesai')) {
            $statusClass = 'blue';
            $filterCategory = 'shipping';
        } elseif (str_contains($statusPembayaranLower, 'berhasil') || str_contains($statusPembayaranLower, 'lunas')) {
            $statusClass = 'green';
            $filterCategory = 'paid';
        }

        $cleanPhone = ltrim(preg_replace('/[^0-9]/', '', $t->telpon), '0');
        if (str_starts_with($cleanPhone, '62')) {
            $waNumber = $cleanPhone;
            $shortPhone = substr($cleanPhone, 2);
        } else {
            $waNumber = '62' . $cleanPhone;
            $shortPhone = $cleanPhone;
        }

        return [
            'db_id' => $t->id,
            'id_transaksi' => $t->id,
            'id' => $t->kode_invoice,
            'kode_invoice' => $t->kode_invoice,
            'date' => $t->tanggal,
            'tanggal' => $t->tanggal,
            'id_customer' => $t->id_customer,
            'buyer' => $t->nama_customer,
            'nama_customer' => $t->nama_customer,
            'email' => $t->customer?->email ?? 'customer@koafy.com',
            'phone' => $shortPhone ?: $t->telpon,
            'telpon' => $t->telpon,
            'waNumber' => $waNumber,
            'alamat' => $t->alamat,
            'kecamatan' => $t->kecamatan ?? '',
            'kode_pos' => $t->kode_pos ?? '',
            'voucer' => $t->voucer,
            'diskon_voucer' => (int) $t->diskon_voucer,
            'ongkir' => (int) $t->ongkir,
            'subtotal_pembayaran' => (int) $t->subtotal_pembayaran,
            'total_pembayaran' => (int) $t->total_pembayaran,
            'total' => (int) $t->total_pembayaran,
            'totalAmount' => (int) $t->total_pembayaran,
            'total_qty' => (int) $totalQty,
            'metode_pembayaran' => $t->metode_pembayaran,
            'paymentMethod' => $t->metode_pembayaran,
            'tipe_pembayaran' => $t->tipe_pembayaran,
            'paymentType' => $t->tipe_pembayaran,
            'status_pembayaran' => $t->status_pembayaran,
            'status' => $t->status_pembayaran,
            'statusLabel' => $t->status_pembayaran,
            'statusClass' => $statusClass,
            'filterCategory' => $filterCategory,
            'nama_rekening_pengirim' => $t->nama_rekening_pengirim,
            'bank_pengirim' => $t->bank_pengirim,
            'bukti_transfer' => $t->bukti_transfer,
            'is_notif_read' => (bool) $t->is_notif_read,
            'courier' => $pengiriman?->jasa_pengiriman ?? 'J&T Express',
            'jasa_pengiriman' => $pengiriman?->jasa_pengiriman ?? 'J&T Express',
            'trackingNo' => $pengiriman?->no_resi ?? 'BELUM DIINPUT',
            'trackingNumber' => $pengiriman?->no_resi ?? 'BELUM DIINPUT',
            'no_resi' => $pengiriman?->no_resi ?? 'BELUM DIINPUT',
            'status_pengiriman' => $pengiriman?->status_pengiriman ?? 'Menunggu Konfirmasi',
            'items_summary' => $itemsSummary ?: 'Koafy Crystal Butterbalm Duo (1x)',
            'shade' => $firstShade,
            'items' => $details->map(fn (DetailTransaksi $d) => [
                'id' => $d->id,
                'id_barang' => $d->id_barang,
                'name' => $d->nama_produk,
                'nama_produk' => $d->nama_produk,
                'shade' => $d->shade ?? 'Standar',
                'price' => (int) $d->harga,
                'harga' => (int) $d->harga,
                'qty' => (int) $d->qty,
                'subtotal' => (int) $d->subtotal,
                'image' => $d->gambar_produk ?: '/images/product-butterbalm-duo.jpg',
            ])->values(),
            'created_at' => $t->created_at ? $t->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => $t->updated_at ? (string) $t->updated_at : null,
        ];
    }
}
