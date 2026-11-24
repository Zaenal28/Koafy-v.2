<?php

namespace Database\Seeders;

use App\Models\DataAlamatCustomer;
use App\Models\DataBarang;
use App\Models\DataTransaksiBarang;
use App\Models\DataUser;
use App\Models\DetailTransaksi;
use App\Models\PenyiapanPenyerahanBarang;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\VarianShadeBarang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================================
        // 1. SEED AKUN ADMIN (GMAIL & PASSWORD JWT)
        // =====================================================================
        User::updateOrCreate(
            ['email' => 'admin.koafy@gmail.com'],
            [
                'name' => 'Admin Koafy Official',
                'no_telpon' => '081809607187',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin Koafy',
                'no_telpon' => '081809607187',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // =====================================================================
        // 2. SEED AKUN CUSTOMER, DATA USER, & DATA ALAMAT CUSTOMER
        // =====================================================================
        $customersData = [
            [
                'name' => 'Siti Rahma',
                'email' => 'siti.rahma@example.com',
                'no_telpon' => '081234567890',
                'tanggal_lahir' => '1998-05-14',
                'tier' => 'GOLD MEMBER',
                'addresses' => [
                    [
                        'label_alamat' => 'Rumah Utama',
                        'no_telpon' => '081234567890',
                        'nama_penerima' => 'Siti Rahma',
                        'alamat_penerima' => 'Jl. Senopati No. 45, RT 02 / RW 05, Kelurahan Senayan',
                        'kecamatan' => 'Kebayoran Baru, Jakarta Selatan',
                        'kode_pos' => '12110',
                        'catatan' => 'Pagar warna putih, titip ke satpam jika rumah kosong',
                        'is_primary' => true,
                    ],
                    [
                        'label_alamat' => 'Office (Kantor)',
                        'no_telpon' => '081987654321',
                        'nama_penerima' => 'Siti Rahma',
                        'alamat_penerima' => 'Gedung SCBD Tower B Lt. 12, Jl. Jend. Sudirman Kav 52-53',
                        'kecamatan' => 'Kebayoran Baru, Jakarta Selatan',
                        'kode_pos' => '12190',
                        'catatan' => 'Kirim saat jam kerja 09.00 - 17.00 WIB',
                        'is_primary' => false,
                    ],
                ],
            ],
            [
                'name' => 'Kayla Anindita',
                'email' => 'kayla.anindita@gmail.com',
                'no_telpon' => '081294827100',
                'tanggal_lahir' => '1999-08-21',
                'tier' => 'VIP GLOW',
                'addresses' => [
                    [
                        'label_alamat' => 'Rumah Kemang',
                        'no_telpon' => '081294827100',
                        'nama_penerima' => 'Kayla Anindita',
                        'alamat_penerima' => 'Jl. Kemang Raya No. 18B, Bangka',
                        'kecamatan' => 'Mampang Prapatan, Jakarta Selatan',
                        'kode_pos' => '12730',
                        'catatan' => 'Rumah cat krem samping klinik gigi',
                        'is_primary' => true,
                    ],
                ],
            ],
            [
                'name' => 'Aurelia Putri',
                'email' => 'aurelia.p@gmail.com',
                'no_telpon' => '085719283746',
                'tanggal_lahir' => '2001-02-11',
                'tier' => 'GOLD MEMBER',
                'addresses' => [
                    [
                        'label_alamat' => 'Apartemen Dago',
                        'no_telpon' => '085719283746',
                        'nama_penerima' => 'Aurelia Putri',
                        'alamat_penerima' => 'Jl. Ir. H. Juanda No. 112, Lebakgede',
                        'kecamatan' => 'Coblong, Kota Bandung',
                        'kode_pos' => '40132',
                        'catatan' => 'Titip di resepsionis lobby utama',
                        'is_primary' => true,
                    ],
                ],
            ],
        ];

        $seededCustomers = [];
        foreach ($customersData as $cData) {
            $user = User::updateOrCreate(
                ['email' => $cData['email']],
                [
                    'name' => $cData['name'],
                    'no_telpon' => $cData['no_telpon'],
                    'role' => 'customer',
                    'password' => Hash::make('password123'),
                ]
            );

            DataUser::updateOrCreate(
                ['id_customer' => $user->id],
                [
                    'nama_lengkap' => $cData['name'],
                    'email_akun' => $cData['email'],
                    'no_telpon' => $cData['no_telpon'],
                    'tanggal_lahir' => $cData['tanggal_lahir'],
                    'gender' => 'Wanita',
                    'tier' => $cData['tier'],
                    'avatar' => '/images/siti-rahma-avatar.jpg',
                ]
            );

            if ($user->alamatCustomers()->count() === 0) {
                foreach ($cData['addresses'] as $addr) {
                    DataAlamatCustomer::create(array_merge($addr, ['id_customer' => $user->id]));
                }
            }

            $seededCustomers[] = $user;
        }

        // =====================================================================
        // 3. SEED DATABASE DATA BARANG & VARIAN SHADE (4 GAMBAR 800x800 1:1)
        // =====================================================================
        if (DataBarang::count() === 0) {
            $products = [
                [
                    'sku' => 'KFY-LIP-001',
                    'status' => 'active',
                    'nama_barang' => 'Koafy Crystal Butterbalm Tint Duo',
                    'kategori_produk' => 'Makeup',
                    'harga_normal' => 190000,
                    'harga_promo' => 156510,
                    'stok' => 48,
                    'tanggal_masuk' => '15-08-2026',
                    'tanggal_expired' => '15-08-2029',
                    'deskripsi_barang' => 'Lip butterbalm mewah dengan hasil akhir glossy sebening kristal yang melembapkan bibir kering seharian.',
                    'kandungan_ingredients' => 'Shea Butter, Jojoba Seed Oil, Squalane, Vitamin E, Hyaluronic Filling Spheres, Peptides.',
                    'manfaat_utama' => 'Melembapkan bibir 24 jam, menyamarkan garis bibir, memberikan warna natural berkilau tanpa rasa lengket.',
                    'cara_pakai' => 'Oleskan merata pada bibir bersih. Tambahkan layer kedua untuk efek plump glossy yang lebih intens.',
                    'rekomendasi_tipe_kulit' => 'Semua Jenis Kulit & Bibir Kering / Sensitif',
                    'gambar_produk_1' => '/images/product-butterbalm-duo.jpg',
                    'gambar_produk_2' => '/images/product-velvet-lip.jpg',
                    'gambar_produk_3' => '/images/product-multibalm-trio.jpg',
                    'gambar_produk_4' => '/images/product-pink-cream.jpg',
                    'shades' => [
                        ['nama_shade' => '01 Rosewood Dew', 'kode_warna' => '#C95B73', 'gambar_produk' => '/images/product-butterbalm-duo.jpg'],
                        ['nama_shade' => '02 Mauve Petal', 'kode_warna' => '#A64D69', 'gambar_produk' => '/images/product-velvet-lip.jpg'],
                        ['nama_shade' => '03 Peach Nectar', 'kode_warna' => '#E57C73', 'gambar_produk' => '/images/product-multibalm-trio.jpg'],
                    ],
                ],
                [
                    'sku' => 'KFY-SKN-002',
                    'status' => 'active',
                    'nama_barang' => 'HSK Secret Pink Radiance Barrier Cream 50ml',
                    'kategori_produk' => 'Skincare',
                    'harga_normal' => 235000,
                    'harga_promo' => 185000,
                    'stok' => 35,
                    'tanggal_masuk' => '01-09-2026',
                    'tanggal_expired' => '01-09-2029',
                    'deskripsi_barang' => 'Krim pelembap pencerah wajah dengan tekstur water-gel ringan yang memperkuat skin barrier di iklim tropis.',
                    'kandungan_ingredients' => '5X Ceramide, Niacinamide 5%, French Rose Water, Centella Asiatica, Panthenol.',
                    'manfaat_utama' => 'Mencerahkan kulit kusam, mengunci kelembapan hingga 72 jam, meredakan kemerahan dan iritasi ringan.',
                    'cara_pakai' => 'Ambil secukupnya dan ratakan ke seluruh wajah serta leher pada pagi dan malam hari setelah serum.',
                    'rekomendasi_tipe_kulit' => 'Kulit Normal, Kering, Kombinasi & Kusam',
                    'gambar_produk_1' => '/images/product-pink-cream.jpg',
                    'gambar_produk_2' => '/images/product-butterbalm-duo.jpg',
                    'gambar_produk_3' => '/images/product-velvet-lip.jpg',
                    'gambar_produk_4' => '/images/product-multibalm-trio.jpg',
                    'shades' => [],
                ],
                [
                    'sku' => 'KFY-MKP-003',
                    'status' => 'active',
                    'nama_barang' => 'Koafy Velvet Lip & Cheek Multi Balm Trio',
                    'kategori_produk' => 'Makeup',
                    'harga_normal' => 255000,
                    'harga_promo' => 210000,
                    'stok' => 28,
                    'tanggal_masuk' => '10-10-2026',
                    'tanggal_expired' => '10-10-2029',
                    'deskripsi_barang' => 'Multi-balm praktis 3-in-1 untuk kelopak mata, pipi, dan bibir dengan hasil soft-focus velvet matte.',
                    'kandungan_ingredients' => 'Camellia Japonica Oil, Rosehip Oil, Micro-Velvet Powder, Tocopherol (Vitamin E).',
                    'manfaat_utama' => 'Pigmentasi tinggi yang mudah di-blend dengan jari, tahan keringat seharian, tidak menyumbat pori.',
                    'cara_pakai' => 'Tap perlahan menggunakan ujung jari atau kuas pada pipi dan bibir, lalu baurkan hingga menyatu alami.',
                    'rekomendasi_tipe_kulit' => 'Semua Jenis Kulit (Termasuk Berminyak & Acne-Prone)',
                    'gambar_produk_1' => '/images/product-multibalm-trio.jpg',
                    'gambar_produk_2' => '/images/product-velvet-lip.jpg',
                    'gambar_produk_3' => '/images/product-butterbalm-duo.jpg',
                    'gambar_produk_4' => '/images/product-pink-cream.jpg',
                    'shades' => [
                        ['nama_shade' => '01 Berry Flush', 'kode_warna' => '#B83B5E', 'gambar_produk' => '/images/product-multibalm-trio.jpg'],
                        ['nama_shade' => '02 Coral Breeze', 'kode_warna' => '#EA7362', 'gambar_produk' => '/images/product-velvet-lip.jpg'],
                    ],
                ],
                [
                    'sku' => 'KFY-MKP-004',
                    'status' => 'active',
                    'nama_barang' => 'Koafy Velvet Lip & Precision Brush Set',
                    'kategori_produk' => 'Makeup',
                    'harga_normal' => 215000,
                    'harga_promo' => 175000,
                    'stok' => 42,
                    'tanggal_masuk' => '20-10-2026',
                    'tanggal_expired' => '20-10-2029',
                    'deskripsi_barang' => 'Paket lip cream velvet lembut dilengkapi lip brush presisi untuk gradasi ombre ala MUA profesional.',
                    'kandungan_ingredients' => 'Argan Oil, Macadamia Oil, Velvet Silicone Elastomer, Hyaluronic Acid.',
                    'manfaat_utama' => 'Transfer-proof, ringan seperti tidak memakai lipstik, menutup warna bibir gelap dalam 1x pulasan.',
                    'cara_pakai' => 'Aplikasikan di bagian tengah bibir lalu ratakan ke tepi menggunakan precision lip brush.',
                    'rekomendasi_tipe_kulit' => 'Semua Jenis Kulit',
                    'gambar_produk_1' => '/images/product-velvet-lip.jpg',
                    'gambar_produk_2' => '/images/product-butterbalm-duo.jpg',
                    'gambar_produk_3' => '/images/product-multibalm-trio.jpg',
                    'gambar_produk_4' => '/images/product-pink-cream.jpg',
                    'shades' => [
                        ['nama_shade' => '01 Rosewood Matte', 'kode_warna' => '#A8425B', 'gambar_produk' => '/images/product-velvet-lip.jpg'],
                        ['nama_shade' => '02 Terracotta Chic', 'kode_warna' => '#B85442', 'gambar_produk' => '/images/product-butterbalm-duo.jpg'],
                    ],
                ],
            ];

            foreach ($products as $pData) {
                $shades = $pData['shades'] ?? [];
                unset($pData['shades']);
                $barang = DataBarang::create($pData);

                foreach ($shades as $sh) {
                    VarianShadeBarang::create([
                        'id_barang' => $barang->id,
                        'nama_shade' => $sh['nama_shade'],
                        'kode_warna' => $sh['kode_warna'],
                        'gambar_produk' => $sh['gambar_produk'],
                    ]);
                }
            }
        }

        // =====================================================================
        // 4. SEED DATABASE TRANSAKSI, DETAIL TRANSAKSI, & PENGIRIMAN
        // =====================================================================
        if (Transaksi::count() === 0) {
            $siti = $seededCustomers[0];
            $kayla = $seededCustomers[1];
            $aurelia = $seededCustomers[2];
            $b1 = DataBarang::first();
            $b2 = DataBarang::skip(1)->first() ?? $b1;

            // Transaksi 1: Menunggu Verifikasi Admin (Notif Baru Belum Dibaca)
            $t1 = Transaksi::create([
                'kode_invoice' => 'INV/20261124/KFY/8492',
                'tanggal' => '24 Nov 2026',
                'id_customer' => $siti->id,
                'nama_customer' => 'Siti Rahma',
                'alamat' => 'Jl. Senopati No. 45, RT 02 / RW 05, Kelurahan Senayan',
                'kecamatan' => 'Kebayoran Baru, Jakarta Selatan',
                'kode_pos' => '12110',
                'telpon' => '081234567890',
                'voucer' => 'BEAUTY2027',
                'diskon_voucer' => 25000,
                'ongkir' => 15000,
                'subtotal_pembayaran' => 473600,
                'total_pembayaran' => 463600,
                'metode_pembayaran' => 'Transfer Bank BCA (No. Rekening)',
                'tipe_pembayaran' => 'manual_bca',
                'status_pembayaran' => 'Menunggu Verifikasi Admin',
                'nama_rekening_pengirim' => 'Siti Rahma',
                'bank_pengirim' => 'BCA',
                'bukti_transfer' => '/images/product-butterbalm-duo.jpg',
                'is_notif_read' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $t1->id,
                'id_customer' => $siti->id,
                'id_barang' => $b1?->id,
                'nama_customer' => 'Siti Rahma',
                'nama_produk' => 'Koafy Crystal Butterbalm Tint Duo',
                'shade' => '01 Rosewood Dew',
                'harga' => 288600,
                'qty' => 1,
                'voucer' => 'BEAUTY2027',
                'ongkir' => 15000,
                'subtotal' => 288600,
                'subtotal_pembayaran' => 473600,
                'total_pembayaran' => 463600,
                'metode_pembayaran' => 'Transfer Bank BCA (No. Rekening)',
                'status_pembayaran' => 'Menunggu Verifikasi Admin',
                'gambar_produk' => '/images/product-butterbalm-duo.jpg',
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $t1->id,
                'id_customer' => $siti->id,
                'id_barang' => $b2?->id,
                'nama_customer' => 'Siti Rahma',
                'nama_produk' => 'HSK Secret Pink Radiance Barrier Cream 50ml',
                'shade' => '50 ml • Brightening',
                'harga' => 185000,
                'qty' => 1,
                'voucer' => 'BEAUTY2027',
                'ongkir' => 15000,
                'subtotal' => 185000,
                'subtotal_pembayaran' => 473600,
                'total_pembayaran' => 463600,
                'metode_pembayaran' => 'Transfer Bank BCA (No. Rekening)',
                'status_pembayaran' => 'Menunggu Verifikasi Admin',
                'gambar_produk' => '/images/product-pink-cream.jpg',
            ]);

            DataTransaksiBarang::create([
                'id_transaksi' => $t1->id,
                'id_barang' => $b1?->id,
                'nama_barang' => 'Koafy Crystal Butterbalm Tint Duo',
                'harga' => 288600,
                'qty' => 1,
            ]);
            DataTransaksiBarang::create([
                'id_transaksi' => $t1->id,
                'id_barang' => $b2?->id,
                'nama_barang' => 'HSK Secret Pink Radiance Barrier Cream 50ml',
                'harga' => 185000,
                'qty' => 1,
            ]);

            PenyiapanPenyerahanBarang::create([
                'id_transaksi' => $t1->id,
                'jasa_pengiriman' => 'J&T Express - Regular',
                'no_resi' => 'BELUM DIINPUT',
                'status_pengiriman' => 'Menunggu Konfirmasi Pembayaran',
            ]);

            // Transaksi 2: Pembayaran Berhasil (Siap Cetak Slip & Input Resi)
            $t2 = Transaksi::create([
                'kode_invoice' => 'INV/20261124/KFY/8491',
                'tanggal' => '24 Nov 2026',
                'id_customer' => $kayla->id,
                'nama_customer' => 'Kayla Anindita',
                'alamat' => 'Jl. Kemang Raya No. 18B, Bangka',
                'kecamatan' => 'Mampang Prapatan, Jakarta Selatan',
                'kode_pos' => '12730',
                'telpon' => '081294827100',
                'voucer' => null,
                'diskon_voucer' => 0,
                'ongkir' => 25000,
                'subtotal_pembayaran' => 313020,
                'total_pembayaran' => 338020,
                'metode_pembayaran' => 'BCA Virtual Account',
                'tipe_pembayaran' => 'va',
                'status_pembayaran' => 'Pembayaran Berhasil',
                'is_notif_read' => false,
                'created_at' => now()->subMinutes(25),
                'updated_at' => now()->subMinutes(10),
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $t2->id,
                'id_customer' => $kayla->id,
                'id_barang' => $b1?->id,
                'nama_customer' => 'Kayla Anindita',
                'nama_produk' => 'Koafy Crystal Butterbalm Tint Duo',
                'shade' => '02 Mauve Petal',
                'harga' => 156510,
                'qty' => 2,
                'voucer' => null,
                'ongkir' => 25000,
                'subtotal' => 313020,
                'subtotal_pembayaran' => 313020,
                'total_pembayaran' => 338020,
                'metode_pembayaran' => 'BCA Virtual Account',
                'status_pembayaran' => 'Pembayaran Berhasil',
                'gambar_produk' => '/images/product-butterbalm-duo.jpg',
            ]);

            DataTransaksiBarang::create([
                'id_transaksi' => $t2->id,
                'id_barang' => $b1?->id,
                'nama_barang' => 'Koafy Crystal Butterbalm Tint Duo',
                'harga' => 156510,
                'qty' => 2,
            ]);

            PenyiapanPenyerahanBarang::create([
                'id_transaksi' => $t2->id,
                'jasa_pengiriman' => 'SiCepat BEST (Next Day)',
                'no_resi' => 'BELUM DIINPUT',
                'status_pengiriman' => 'Sedang Dikemas / Siap Kirim',
            ]);

            // Transaksi 3: Sudah Dikirim dengan Nomor Resi
            $t3 = Transaksi::create([
                'kode_invoice' => 'INV/20261123/KFY/8490',
                'tanggal' => '23 Nov 2026',
                'id_customer' => $aurelia->id,
                'nama_customer' => 'Aurelia Putri',
                'alamat' => 'Jl. Ir. H. Juanda No. 112, Lebakgede',
                'kecamatan' => 'Coblong, Kota Bandung',
                'kode_pos' => '40132',
                'telpon' => '085719283746',
                'voucer' => 'FREESHIP',
                'diskon_voucer' => 0,
                'ongkir' => 0,
                'subtotal_pembayaran' => 210000,
                'total_pembayaran' => 210000,
                'metode_pembayaran' => 'QRIS (Semua E-Wallet / Bank)',
                'tipe_pembayaran' => 'ewallet',
                'status_pembayaran' => 'Pembayaran Berhasil',
                'is_notif_read' => true,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subHours(12),
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $t3->id,
                'id_customer' => $aurelia->id,
                'id_barang' => $b1?->id,
                'nama_customer' => 'Aurelia Putri',
                'nama_produk' => 'Koafy Velvet Lip & Cheek Multi Balm Trio',
                'shade' => '01 Berry Flush',
                'harga' => 210000,
                'qty' => 1,
                'voucer' => 'FREESHIP',
                'ongkir' => 0,
                'subtotal' => 210000,
                'subtotal_pembayaran' => 210000,
                'total_pembayaran' => 210000,
                'metode_pembayaran' => 'QRIS (Semua E-Wallet / Bank)',
                'status_pembayaran' => 'Pembayaran Berhasil',
                'gambar_produk' => '/images/product-multibalm-trio.jpg',
            ]);

            DataTransaksiBarang::create([
                'id_transaksi' => $t3->id,
                'id_barang' => $b1?->id,
                'nama_barang' => 'Koafy Velvet Lip & Cheek Multi Balm Trio',
                'harga' => 210000,
                'qty' => 1,
            ]);

            PenyiapanPenyerahanBarang::create([
                'id_transaksi' => $t3->id,
                'jasa_pengiriman' => 'J&T Express - Regular',
                'no_resi' => 'JT8829104489',
                'status_pengiriman' => 'Dikirim',
            ]);
        }
    }
}
