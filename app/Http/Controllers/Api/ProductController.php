<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\VarianShadeBarang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Ambil semua Data Barang beserta Varian Warna / Shade
     */
    public function index(Request $request): JsonResponse
    {
        $query = DataBarang::with('shades')->orderByDesc('id');

        if ($request->filled('status')) {
            $query->where('status', strtolower($request->input('status')));
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_produk', $request->input('kategori'));
        }

        $items = $query->get()->map(fn (DataBarang $b) => $this->formatBarang($b));

        return response()->json([
            'success' => true,
            'products' => $items,
        ]);
    }

    /**
     * Detail 1 Data Barang
     */
    public function show(int $id): JsonResponse
    {
        $barang = DataBarang::with('shades')->findOrFail($id);

        return response()->json([
            'success' => true,
            'product' => $this->formatBarang($barang),
        ]);
    }

    /**
     * Tambah Data Barang baru + 4 Gambar (800x800 1:1) + Varian Warna / Shade (Opsional)
     */
    public function store(Request $request): JsonResponse
    {
        $hargaNormal = $this->parseNumericPrice($request->input('harga_normal') ?? $request->input('normalPrice') ?? $request->input('normalPriceFormatted', 185000));
        $hargaPromo = $this->parseNumericPrice($request->input('harga_promo') ?? $request->input('discountPrice') ?? $request->input('discountPriceFormatted', $hargaNormal));

        $statusRaw = strtolower($request->input('status', 'active'));
        $status = in_array($statusRaw, ['active', 'aktif']) ? 'active' : 'inactive';

        $images = $request->input('images', []);

        $barang = DataBarang::create([
            'sku' => $request->input('sku') ?: 'KFY-' . strtoupper(substr(md5(uniqid()), 0, 6)),
            'status' => $status,
            'nama_barang' => $request->input('nama_barang') ?? $request->input('name', 'Produk Koafy Baru'),
            'kategori_produk' => $request->input('kategori_produk') ?? $request->input('category', 'Makeup'),
            'harga_normal' => $hargaNormal,
            'harga_promo' => $hargaPromo ?: $hargaNormal,
            'stok' => (int) ($request->input('stok') ?? $request->input('stock', 50)),
            'tanggal_masuk' => $request->input('tanggal_masuk') ?? $request->input('tglMasuk', date('d-m-Y')),
            'tanggal_expired' => $request->input('tanggal_expired') ?? $request->input('tglExpired', date('d-m-Y', strtotime('+2 years'))),
            'deskripsi_barang' => $request->input('deskripsi_barang') ?? $request->input('description', ''),
            'kandungan_ingredients' => $request->input('kandungan_ingredients') ?? $request->input('ingredients', ''),
            'manfaat_utama' => $request->input('manfaat_utama') ?? $request->input('benefits', ''),
            'cara_pakai' => $request->input('cara_pakai') ?? $request->input('howToUse', ''),
            'rekomendasi_tipe_kulit' => $request->input('rekomendasi_tipe_kulit') ?? $request->input('skinType', 'Semua Jenis Kulit (All Skin Types)'),
            'gambar_produk_1' => $request->input('gambar_produk_1') ?? ($images[0] ?? $request->input('image', '/images/product-butterbalm-duo.jpg')),
            'gambar_produk_2' => $request->input('gambar_produk_2') ?? ($images[1] ?? null),
            'gambar_produk_3' => $request->input('gambar_produk_3') ?? ($images[2] ?? null),
            'gambar_produk_4' => $request->input('gambar_produk_4') ?? ($images[3] ?? null),
        ]);

        // Simpan Varian Warna / Shade jika ada
        $shades = $request->input('shades', []);
        if (is_array($shades)) {
            foreach ($shades as $shadeItem) {
                if (!empty($shadeItem['kode_warna']) || !empty($shadeItem['colorCode'])) {
                    VarianShadeBarang::create([
                        'id_barang' => $barang->id,
                        'nama_shade' => $shadeItem['nama_shade'] ?? $shadeItem['name'] ?? 'Shade Default',
                        'kode_warna' => $shadeItem['kode_warna'] ?? $shadeItem['colorCode'] ?? '#D45B7A',
                        'gambar_produk' => $shadeItem['gambar_produk'] ?? $shadeItem['image'] ?? $barang->gambar_produk_1,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil disimpan ke database.',
            'product' => $this->formatBarang($barang->fresh('shades')),
        ], 201);
    }

    /**
     * Update Data Barang & Varian Shade
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $barang = DataBarang::findOrFail($id);

        $hargaNormal = $request->hasAny(['harga_normal', 'normalPrice', 'normalPriceFormatted'])
            ? $this->parseNumericPrice($request->input('harga_normal') ?? $request->input('normalPrice') ?? $request->input('normalPriceFormatted'))
            : $barang->harga_normal;

        $hargaPromo = $request->hasAny(['harga_promo', 'discountPrice', 'discountPriceFormatted'])
            ? $this->parseNumericPrice($request->input('harga_promo') ?? $request->input('discountPrice') ?? $request->input('discountPriceFormatted'))
            : $barang->harga_promo;

        $statusRaw = strtolower($request->input('status', $barang->status));
        $status = in_array($statusRaw, ['active', 'aktif']) ? 'active' : 'inactive';

        $images = $request->input('images', []);

        $barang->update([
            'sku' => $request->input('sku', $barang->sku),
            'status' => $status,
            'nama_barang' => $request->input('nama_barang') ?? $request->input('name', $barang->nama_barang),
            'kategori_produk' => $request->input('kategori_produk') ?? $request->input('category', $barang->kategori_produk),
            'harga_normal' => $hargaNormal,
            'harga_promo' => $hargaPromo,
            'stok' => (int) ($request->input('stok') ?? $request->input('stock', $barang->stok)),
            'tanggal_masuk' => $request->input('tanggal_masuk') ?? $request->input('tglMasuk', $barang->tanggal_masuk),
            'tanggal_expired' => $request->input('tanggal_expired') ?? $request->input('tglExpired', $barang->tanggal_expired),
            'deskripsi_barang' => $request->input('deskripsi_barang') ?? $request->input('description', $barang->deskripsi_barang),
            'kandungan_ingredients' => $request->input('kandungan_ingredients') ?? $request->input('ingredients', $barang->kandungan_ingredients),
            'manfaat_utama' => $request->input('manfaat_utama') ?? $request->input('benefits', $barang->manfaat_utama),
            'cara_pakai' => $request->input('cara_pakai') ?? $request->input('howToUse', $barang->cara_pakai),
            'rekomendasi_tipe_kulit' => $request->input('rekomendasi_tipe_kulit') ?? $request->input('skinType', $barang->rekomendasi_tipe_kulit),
            'gambar_produk_1' => $request->input('gambar_produk_1') ?? ($images[0] ?? $request->input('image', $barang->gambar_produk_1)),
            'gambar_produk_2' => $request->has('gambar_produk_2') ? $request->input('gambar_produk_2') : ($images[1] ?? $barang->gambar_produk_2),
            'gambar_produk_3' => $request->has('gambar_produk_3') ? $request->input('gambar_produk_3') : ($images[2] ?? $barang->gambar_produk_3),
            'gambar_produk_4' => $request->has('gambar_produk_4') ? $request->input('gambar_produk_4') : ($images[3] ?? $barang->gambar_produk_4),
        ]);

        if ($request->has('shades') && is_array($request->input('shades'))) {
            $barang->shades()->delete();
            foreach ($request->input('shades') as $shadeItem) {
                if (!empty($shadeItem['kode_warna']) || !empty($shadeItem['colorCode'])) {
                    VarianShadeBarang::create([
                        'id_barang' => $barang->id,
                        'nama_shade' => $shadeItem['nama_shade'] ?? $shadeItem['name'] ?? 'Shade',
                        'kode_warna' => $shadeItem['kode_warna'] ?? $shadeItem['colorCode'] ?? '#D45B7A',
                        'gambar_produk' => $shadeItem['gambar_produk'] ?? $shadeItem['image'] ?? $barang->gambar_produk_1,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diperbarui.',
            'product' => $this->formatBarang($barang->fresh('shades')),
        ]);
    }

    /**
     * Toggle status barang (active / inactive)
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $barang = DataBarang::findOrFail($id);
        $barang->status = $barang->status === 'active' ? 'inactive' : 'active';
        $barang->save();

        return response()->json([
            'success' => true,
            'message' => 'Status barang diubah menjadi ' . strtoupper($barang->status),
            'product' => $this->formatBarang($barang->fresh('shades')),
        ]);
    }

    /**
     * Hapus Data Barang
     */
    public function destroy(int $id): JsonResponse
    {
        $barang = DataBarang::findOrFail($id);
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil dihapus dari database.',
        ]);
    }

    private function parseNumericPrice(mixed $val): int
    {
        if (is_numeric($val)) {
            return (int) $val;
        }
        $digits = preg_replace('/[^0-9]/', '', (string) $val);
        return $digits !== '' ? (int) $digits : 0;
    }

    private function formatBarang(DataBarang $b): array
    {
        $images = array_values(array_filter([
            $b->gambar_produk_1,
            $b->gambar_produk_2,
            $b->gambar_produk_3,
            $b->gambar_produk_4,
        ]));

        return [
            'id' => $b->id,
            'id_barang' => $b->id,
            'sku' => $b->sku ?: 'KFY-PRD-' . str_pad((string) $b->id, 3, '0', STR_PAD_LEFT),
            'status' => strtoupper($b->status) === 'ACTIVE' ? 'ACTIVE' : 'INACTIVE',
            'status_db' => $b->status,
            'name' => $b->nama_barang,
            'nama_barang' => $b->nama_barang,
            'category' => $b->kategori_produk,
            'kategori_produk' => $b->kategori_produk,
            'normalPrice' => (int) $b->harga_normal,
            'harga_normal' => (int) $b->harga_normal,
            'normalPriceFormatted' => 'Rp ' . number_format((int) $b->harga_normal, 0, ',', '.'),
            'discountPrice' => (int) ($b->harga_promo ?: $b->harga_normal),
            'harga_promo' => (int) ($b->harga_promo ?: $b->harga_normal),
            'discountPriceFormatted' => 'Rp ' . number_format((int) ($b->harga_promo ?: $b->harga_normal), 0, ',', '.'),
            'stock' => (int) $b->stok,
            'stok' => (int) $b->stok,
            'tglMasuk' => $b->tanggal_masuk ?: '15-08-2026',
            'tanggal_masuk' => $b->tanggal_masuk ?: '15-08-2026',
            'tglExpired' => $b->tanggal_expired ?: '15-08-2029',
            'tanggal_expired' => $b->tanggal_expired ?: '15-08-2029',
            'description' => $b->deskripsi_barang ?? '',
            'deskripsi_barang' => $b->deskripsi_barang ?? '',
            'ingredients' => $b->kandungan_ingredients ?? '',
            'kandungan_ingredients' => $b->kandungan_ingredients ?? '',
            'benefits' => $b->manfaat_utama ?? '',
            'manfaat_utama' => $b->manfaat_utama ?? '',
            'howToUse' => $b->cara_pakai ?? '',
            'cara_pakai' => $b->cara_pakai ?? '',
            'skinType' => $b->rekomendasi_tipe_kulit ?? 'Semua Jenis Kulit',
            'rekomendasi_tipe_kulit' => $b->rekomendasi_tipe_kulit ?? 'Semua Jenis Kulit',
            'image' => $b->gambar_produk_1 ?: '/images/product-butterbalm-duo.jpg',
            'gambar_produk_1' => $b->gambar_produk_1 ?: '/images/product-butterbalm-duo.jpg',
            'gambar_produk_2' => $b->gambar_produk_2 ?: '',
            'gambar_produk_3' => $b->gambar_produk_3 ?: '',
            'gambar_produk_4' => $b->gambar_produk_4 ?: '',
            'images' => count($images) > 0 ? $images : ['/images/product-butterbalm-duo.jpg'],
            'shades' => $b->shades->map(fn (VarianShadeBarang $s) => [
                'id' => $s->id,
                'id_barang' => $s->id_barang,
                'name' => $s->nama_shade,
                'nama_shade' => $s->nama_shade,
                'colorCode' => $s->kode_warna,
                'kode_warna' => $s->kode_warna,
                'image' => $s->gambar_produk ?: $b->gambar_produk_1,
                'gambar_produk' => $s->gambar_produk ?: $b->gambar_produk_1,
            ])->values(),
        ];
    }
}
