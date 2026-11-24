<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Mencakup seluruh struktur tabel E-Commerce Koafy:
     * 1. Akun User/Customer (users dengan id_customer, nama_customer, email, no_telpon, password, role)
     * 2. Data User (data_users)
     * 3. Data Alamat User/Customer (data_alamat_customers)
     * 4. Database Data Barang (data_barang) & Varian Warna / Shade (varian_shade_barang)
     * 5. Database Transaksi & Data Transaksi (transaksi)
     * 6. Detail Transaksi (detail_transaksi)
     * 7. Data Transaksi Barang (data_transaksi_barang)
     * 8. Penyiapan & Penyerahan Barang (penyiapan_penyerahan_barang)
     */
    public function up(): void
    {
        // 1. Tambahkan kolom no_telpon & role pada tabel users (Akun User/Customer & Admin)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'no_telpon')) {
                $table->string('no_telpon', 30)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role', 20)->default('customer')->after('no_telpon'); // 'customer' | 'admin'
            }
        });

        // 2. Tabel Data User (Profil Lengkap Customer)
        Schema::create('data_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('users')->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('email_akun');
            $table->string('no_telpon', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('gender', 20)->nullable()->default('Wanita');
            $table->string('tier', 40)->default('GOLD MEMBER');
            $table->string('avatar')->nullable()->default('/images/siti-rahma-avatar.jpg');
            $table->timestamps();
        });

        // 3. Tabel Data Alamat User / Customer
        Schema::create('data_alamat_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->constrained('users')->cascadeOnDelete();
            $table->string('label_alamat'); // cth: Rumah Utama, Kantor
            $table->string('no_telpon', 30);
            $table->string('nama_penerima');
            $table->text('alamat_penerima'); // menggunakan text/note karena teksnya panjang
            $table->string('kecamatan');
            $table->string('kode_pos', 20);
            $table->text('catatan')->nullable(); // opsional
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        // 4. Tabel Database Data Barang
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id(); // id_barang
            $table->string('sku', 60)->nullable();
            $table->string('status', 20)->default('active'); // active / inactive
            $table->string('nama_barang');
            $table->string('kategori_produk', 100);
            $table->bigInteger('harga_normal')->default(0);
            $table->bigInteger('harga_promo')->nullable(); // Harga Promo / harga coret
            $table->integer('stok')->default(50);
            $table->string('tanggal_masuk', 30)->nullable();
            $table->string('tanggal_expired', 30)->nullable();
            $table->text('deskripsi_barang')->nullable();
            $table->text('kandungan_ingredients')->nullable();
            $table->text('manfaat_utama')->nullable();
            $table->text('cara_pakai')->nullable();
            $table->string('rekomendasi_tipe_kulit')->nullable();
            // 4 Gambar Produk (Rasio 1:1 Kotak ukuran ideal 800 x 800 px)
            $table->longText('gambar_produk_1')->nullable();
            $table->longText('gambar_produk_2')->nullable();
            $table->longText('gambar_produk_3')->nullable();
            $table->longText('gambar_produk_4')->nullable();
            $table->timestamps();
        });

        // 4B. Tabel Varian Warna / Shade Barang (Opsional)
        Schema::create('varian_shade_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('data_barang')->cascadeOnDelete();
            $table->string('nama_shade')->nullable();
            $table->string('kode_warna', 30); // hex kode warna, cth: #D45B7A
            $table->longText('gambar_produk')->nullable(); // gambar produk sesuai warna
            $table->timestamps();
        });

        // 5. Tabel Database Transaksi & Data Transaksi
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id(); // id_transaksi
            $table->string('kode_invoice', 80)->unique();
            $table->string('tanggal', 50);
            $table->foreignId('id_customer')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_customer');
            $table->text('alamat');
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos', 20)->nullable();
            $table->string('telpon', 30);
            $table->string('voucer', 60)->nullable();
            $table->bigInteger('diskon_voucer')->default(0);
            $table->bigInteger('ongkir')->default(0);
            $table->bigInteger('subtotal_pembayaran')->default(0);
            $table->bigInteger('total_pembayaran')->default(0);
            $table->string('metode_pembayaran', 100);
            $table->string('tipe_pembayaran', 50)->default('manual_bca');
            $table->string('status_pembayaran', 60)->default('Menunggu Pembayaran');
            $table->string('nama_rekening_pengirim')->nullable();
            $table->string('bank_pengirim', 60)->nullable();
            $table->longText('bukti_transfer')->nullable();
            $table->boolean('is_notif_read')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });

        // 6. Tabel Detail Transaksi
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transaksi')->cascadeOnDelete();
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->string('nama_customer');
            $table->string('nama_produk');
            $table->string('shade')->nullable();
            $table->bigInteger('harga')->default(0);
            $table->integer('qty')->default(1);
            $table->string('voucer', 60)->nullable();
            $table->bigInteger('ongkir')->default(0);
            $table->bigInteger('subtotal')->default(0);
            $table->bigInteger('subtotal_pembayaran')->default(0);
            $table->bigInteger('total_pembayaran')->default(0);
            $table->string('metode_pembayaran', 100)->nullable();
            $table->string('status_pembayaran', 60)->nullable();
            $table->longText('gambar_produk')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });

        // 7. Tabel Data Transaksi Barang
        Schema::create('data_transaksi_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transaksi')->cascadeOnDelete();
            $table->unsignedBigInteger('id_barang')->nullable();
            $table->string('nama_barang');
            $table->bigInteger('harga')->default(0);
            $table->integer('qty')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });

        // 8. Tabel Penyiapan & Penyerahan Barang
        Schema::create('penyiapan_penyerahan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->constrained('transaksi')->cascadeOnDelete();
            $table->string('jasa_pengiriman', 120);
            $table->string('no_resi', 100)->nullable();
            $table->string('status_pengiriman', 60)->default('Menunggu Konfirmasi');
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyiapan_penyerahan_barang');
        Schema::dropIfExists('data_transaksi_barang');
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('varian_shade_barang');
        Schema::dropIfExists('data_barang');
        Schema::dropIfExists('data_alamat_customers');
        Schema::dropIfExists('data_users');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_telpon', 'role']);
        });
    }
};
