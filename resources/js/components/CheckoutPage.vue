<template>
  <!-- =====================================================================
       KOAFY CHECKOUT PAGE (HALAMAN CEKOUT BARANG)
       - Rincian Total Barang: Dari Cart (Keranjang) atau Direct Buy (Beli Langsung)
       - Pilihan Pengiriman: Kirim ke Alamat (Jasa Ekspedisi) ATAU Ambil di Klinik Koafy (Gratis / Rp 0)
       - Pilihan Metode Pembayaran: Virtual Account, QRIS/E-Wallet, Kartu Kredit, COD/Bayar di Klinik
       - Pengisian Voucher & Kupon Diskon Aktif
       - Ringkasan Tagihan & Transaksi Aman
       - Modal Konfirmasi Pesanan & Invoice Sukses
       - Tone Warna: Pink Mewah Khas E-Commerce Koafy
       ===================================================================== -->
  <section class="checkout-page-wrapper" aria-label="Halaman Checkout Koafy">
    <div class="checkout-container">

      <!-- Breadcrumbs Navigation -->
      <nav class="checkout-breadcrumb" aria-label="Breadcrumb">
        <a href="#home" class="breadcrumb-link" @click.prevent="$emit('back-to-home')">Beranda</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-link" @click.prevent="handleBackToCart">Keranjang</span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Checkout Pesanan</span>
      </nav>

      <!-- Page Header -->
      <header class="checkout-header">
        <div class="checkout-title-wrap">
          <span class="checkout-badge-pill">CHECKOUT PESANAN</span>
          <h1 class="checkout-main-title">Konfirmasi &amp; Pembayaran</h1>
          <p class="checkout-sub-title">
            Periksa kembali pesanan Anda, pilih metode pengiriman atau ambil di klinik, dan selesaikan pembayaran.
          </p>
        </div>

        <div class="checkout-security-badge">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
          </svg>
          <div>
            <strong>100% Aman &amp; Terenkripsi</strong>
            <small>Garansi Produk Resmi BPOM &amp; Halal</small>
          </div>
        </div>
      </header>

      <!-- Source Toggle Pill (Keranjang Belanja VS Beli Langsung) -->
      <div v-if="directBuyItem" class="checkout-source-switcher">
        <button
          type="button"
          class="source-tab-btn"
          :class="{ active: activeSource === 'cart' }"
          @click="activeSource = 'cart'"
        >
          <span>Keranjang Belanja ({{ cartItems.length }} Item)</span>
        </button>
        <button
          type="button"
          class="source-tab-btn"
          :class="{ active: activeSource === 'direct' }"
          @click="activeSource = 'direct'"
        >
          <span>Beli Langsung (1 Item)</span>
        </button>
      </div>

      <!-- Main Layout Grid: Left Content (65%) + Right Summary Sidebar (35%) -->
      <div class="checkout-layout-grid">

        <!-- ===============================================================
             LEFT COLUMN: Shipping, Items, and Payment Methods
             =============================================================== -->
        <div class="checkout-main-col">

          <!-- 1. METODE PENGIRIMAN: KIRIM KE ALAMAT ATAU AMBIL DI KLINIK -->
          <div class="checkout-card">
            <div class="checkout-card-header">
              <div class="card-header-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25H4.125C3.504 7.5 3 8.004 3 8.625v7.875" />
                </svg>
              </div>
              <div>
                <h2 class="card-header-title">1. Metode Penerimaan Barang</h2>
                <p class="card-header-desc">Pilih pengiriman ke rumah melalui ekspedisi atau ambil langsung di klinik kami.</p>
              </div>
            </div>

            <!-- Delivery Method Selector (2 Options) -->
            <div class="delivery-type-tabs" role="tablist">
              <button
                type="button"
                class="delivery-type-btn"
                :class="{ active: deliveryType === 'shipping' }"
                @click="deliveryType = 'shipping'"
              >
                <div class="delivery-btn-icon">📦</div>
                <div class="delivery-btn-info">
                  <strong>Kirim ke Alamat</strong>
                  <small>Ekspedisi J&amp;T, SiCepat, JNE, Instant</small>
                </div>
                <span class="delivery-check-circle" :class="{ checked: deliveryType === 'shipping' }"></span>
              </button>

              <button
                type="button"
                class="delivery-type-btn"
                :class="{ active: deliveryType === 'clinic_pickup' }"
                @click="deliveryType = 'clinic_pickup'"
              >
                <div class="delivery-btn-icon">🏥</div>
                <div class="delivery-btn-info">
                  <strong>Ambil di Klinik Koafy</strong>
                  <small class="highlight-free">GRATIS Ongkir • Siap Diambil</small>
                </div>
                <span class="delivery-check-circle" :class="{ checked: deliveryType === 'clinic_pickup' }"></span>
              </button>
            </div>

            <!-- OPTION A: SHIPPING TO HOME ADDRESS -->
            <div v-if="deliveryType === 'shipping'" class="shipping-section-wrap">

              <!-- Selected Address Display -->
              <div class="selected-address-box">
                <div class="selected-address-header">
                  <div class="address-title-group">
                    <span class="address-badge-type">{{ selectedAddress.label || 'Alamat Utama' }}</span>
                    <span v-if="selectedAddress.isPrimary" class="address-badge-primary">Utama</span>
                  </div>
                  <button type="button" class="btn-change-address" @click="showAddressModal = true">
                    Ganti Alamat
                  </button>
                </div>

                <div class="address-recipient-info">
                  <strong>{{ selectedAddress.recipientName || user.name || 'Siti Rahma' }}</strong>
                  <span class="address-phone-dot">•</span>
                  <span>{{ selectedAddress.phone || user.phone || '081234567890' }}</span>
                </div>

                <p class="address-full-text">
                  {{ selectedAddress.fullAddress || 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan' }}
                </p>

                <div class="address-area-meta">
                  <span>{{ selectedAddress.area || 'DKI Jakarta' }}</span>
                  <span v-if="selectedAddress.postalCode">Kode Pos: {{ selectedAddress.postalCode }}</span>
                  <span v-if="selectedAddress.notes" class="address-notes-pill">Catatan: {{ selectedAddress.notes }}</span>
                </div>
              </div>

              <!-- Courier / Shipping Service Options -->
              <div class="courier-selector-section">
                <label class="section-sub-label">Pilih Jasa Pengiriman &amp; Durasi:</label>
                <div class="couriers-grid">
                  <div
                    v-for="courier in courierOptions"
                    :key="courier.id"
                    class="courier-option-card"
                    :class="{ selected: selectedCourier.id === courier.id }"
                    @click="selectedCourier = courier"
                  >
                    <div class="courier-card-left">
                      <div class="courier-logo-badge">{{ courier.code }}</div>
                      <div class="courier-info">
                        <strong class="courier-name">{{ courier.name }}</strong>
                        <span class="courier-eta">{{ courier.eta }}</span>
                      </div>
                    </div>
                    <div class="courier-card-right">
                      <strong class="courier-price">Rp {{ formatRupiah(courier.price) }}</strong>
                      <span class="courier-radio" :class="{ active: selectedCourier.id === courier.id }"></span>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- OPTION B: SELF PICKUP AT KOAFY CLINIC -->
            <div v-else class="clinic-pickup-section-wrap">

              <!-- Clinic Promo Highlight Banner -->
              <div class="clinic-info-banner">
                <div class="clinic-banner-icon">
                  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                  </svg>
                </div>
                <div>
                  <strong>Ambil Langsung di Klinik Kecantikan Koafy (Bebas Biaya Pengiriman)</strong>
                  <p>
                    Pesanan Anda disiapkan secara steril oleh apoteker klinik bersama dokter ahli kami. Tunjukkan kode invoice ke resepsionis untuk serah terima langsung.
                  </p>
                </div>
              </div>

              <!-- Clinic Branch Selection -->
              <label class="section-sub-label">Pilih Lokasi Cabang Klinik Koafy:</label>
              <div class="clinics-grid">
                <div
                  v-for="clinic in clinicBranches"
                  :key="clinic.id"
                  class="clinic-card-option"
                  :class="{ selected: selectedClinic.id === clinic.id }"
                  @click="selectedClinic = clinic"
                >
                  <div class="clinic-card-head">
                    <span class="clinic-city-pill">{{ clinic.city }}</span>
                    <span class="clinic-hours-tag">⏰ {{ clinic.hours }}</span>
                  </div>
                  <h4 class="clinic-branch-name">{{ clinic.name }}</h4>
                  <p class="clinic-branch-addr">{{ clinic.address }}</p>
                  <div class="clinic-card-footer">
                    <span class="clinic-badge-free">GRATIS AMBIL DI KLINIK</span>
                    <span class="courier-radio" :class="{ active: selectedClinic.id === clinic.id }"></span>
                  </div>
                </div>
              </div>

              <!-- Pickup Schedule & Notes -->
              <div class="clinic-pickup-form-row">
                <div class="form-group-pickup">
                  <label class="form-label-pickup">Perkiraan Tanggal Pengambilan:</label>
                  <input
                    v-model="pickupDate"
                    type="date"
                    class="form-control-pickup"
                    :min="minPickupDate"
                  />
                </div>
                <div class="form-group-pickup">
                  <label class="form-label-pickup">Perkiraan Waktu / Jam:</label>
                  <select v-model="pickupTime" class="form-control-pickup">
                    <option value="Pagi (10:00 - 12:00 WIB)">Pagi (10:00 - 12:00 WIB)</option>
                    <option value="Siang (13:00 - 15:00 WIB)">Siang (13:00 - 15:00 WIB)</option>
                    <option value="Sore (16:00 - 18:00 WIB)">Sore (16:00 - 18:00 WIB)</option>
                    <option value="Malam (18:30 - 20:00 WIB)">Malam (18:30 - 20:00 WIB)</option>
                  </select>
                </div>
              </div>

              <div class="form-group-pickup full-width">
                <label class="form-label-pickup">Catatan untuk Staf Klinik (Opsional):</label>
                <input
                  v-model="pickupNotes"
                  type="text"
                  class="form-control-pickup"
                  placeholder="Contoh: Titip atas nama Ibu Siti Rahma, mohon siapkan di meja resepsionis"
                />
              </div>

            </div>

          </div>

          <!-- 2. DAFTAR BARANG YANG DICHECKOUT -->
          <div class="checkout-card">
            <div class="checkout-card-header">
              <div class="card-header-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>
              </div>
              <div>
                <h2 class="card-header-title">2. Rincian Barang Pesanan</h2>
                <p class="card-header-desc">
                  {{ activeCheckoutItems.length }} produk yang siap diproses untuk checkout.
                </p>
              </div>
            </div>

            <!-- Items List -->
            <div class="checkout-items-list">
              <div
                v-for="item in activeCheckoutItems"
                :key="item.id"
                class="checkout-item-row"
              >
                <!-- Thumbnail -->
                <div class="checkout-item-thumb">
                  <img
                    :src="item.image || '/images/product-butterbalm-duo.jpg'"
                    :alt="item.name"
                    class="thumb-img"
                    onerror="this.src='/images/product-butterbalm-1.jpg'"
                  />
                  <span class="thumb-qty-badge">{{ item.qty }}x</span>
                </div>

                <!-- Info -->
                <div class="checkout-item-details">
                  <h4 class="item-product-name">{{ item.name }}</h4>
                  <p class="item-product-meta">{{ item.meta || 'Standar Shade • Kemasan Segel BPOM' }}</p>
                  <div class="item-price-calculation">
                    <span class="item-unit-price">Rp {{ formatRupiah(item.price) }} / item</span>
                    <div class="item-qty-adjuster">
                      <button
                        type="button"
                        class="btn-qty-mini"
                        :disabled="item.qty <= 1"
                        @click="adjustItemQty(item, -1)"
                      >
                        −
                      </button>
                      <span class="qty-mini-value">{{ item.qty }}</span>
                      <button
                        type="button"
                        class="btn-qty-mini"
                        @click="adjustItemQty(item, 1)"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Subtotal Item -->
                <div class="checkout-item-subtotal">
                  <span class="subtotal-label">Subtotal</span>
                  <strong class="subtotal-amount">Rp {{ formatRupiah(item.price * item.qty) }}</strong>
                </div>
              </div>
            </div>

          </div>

          <!-- 3. METODE PEMBAYARAN -->
          <div class="checkout-card">
            <div class="checkout-card-header">
              <div class="card-header-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                </svg>
              </div>
              <div>
                <h2 class="card-header-title">3. Pilih Metode Pembayaran</h2>
                <p class="card-header-desc">Semua transaksi diverifikasi otomatis secara real-time tanpa biaya tambahan.</p>
              </div>
            </div>

            <!-- Payment Methods Accordion / List -->
            <div class="payment-methods-stack">

              <!-- Group 0: Transfer Bank BCA (No. Rekening Manual) -->
              <div class="payment-group-box">
                <span class="payment-group-title">TRANSFER KE NO. REKENING (TRANSFER MANUAL)</span>
                <div class="payment-options-grid">
                  <div
                    v-for="method in manualBankMethods"
                    :key="method.id"
                    class="payment-option-card bca-manual-card"
                    :class="{ selected: selectedPayment.id === method.id }"
                    @click="selectedPayment = method"
                  >
                    <div class="pay-logo-badge bca-manual-badge">{{ method.short }}</div>
                    <div class="pay-info">
                      <div class="pay-name-row">
                        <strong class="pay-name">{{ method.name }}</strong>
                        <span class="manual-tag-pill">Upload Bukti</span>
                      </div>
                      <small class="pay-hint">{{ method.hint }}</small>
                    </div>
                    <span class="courier-radio" :class="{ active: selectedPayment.id === method.id }"></span>
                  </div>
                </div>
              </div>

              <!-- Group 1: Virtual Account -->
              <div class="payment-group-box">
                <span class="payment-group-title">Virtual Account (Bank Transfer Otomatis)</span>
                <div class="payment-options-grid">
                  <div
                    v-for="method in vaMethods"
                    :key="method.id"
                    class="payment-option-card"
                    :class="{ selected: selectedPayment.id === method.id }"
                    @click="selectedPayment = method"
                  >
                    <div class="pay-logo-badge">{{ method.short }}</div>
                    <div class="pay-info">
                      <strong class="pay-name">{{ method.name }}</strong>
                      <small class="pay-hint">{{ method.hint }}</small>
                    </div>
                    <span class="courier-radio" :class="{ active: selectedPayment.id === method.id }"></span>
                  </div>
                </div>
              </div>

              <!-- Group 2: QRIS & E-Wallet -->
              <div class="payment-group-box">
                <span class="payment-group-title">E-Wallet &amp; QRIS (Scan Instan)</span>
                <div class="payment-options-grid">
                  <div
                    v-for="method in ewalletMethods"
                    :key="method.id"
                    class="payment-option-card"
                    :class="{ selected: selectedPayment.id === method.id }"
                    @click="selectedPayment = method"
                  >
                    <div class="pay-logo-badge ewallet-badge">{{ method.short }}</div>
                    <div class="pay-info">
                      <strong class="pay-name">{{ method.name }}</strong>
                      <small class="pay-hint">{{ method.hint }}</small>
                    </div>
                    <span class="courier-radio" :class="{ active: selectedPayment.id === method.id }"></span>
                  </div>
                </div>
              </div>

              <!-- Group 3: Kartu Kredit & Bayar di Tempat/Klinik -->
              <div class="payment-group-box">
                <span class="payment-group-title">Kartu &amp; Bayar Langsung</span>
                <div class="payment-options-grid">
                  <div
                    v-for="method in otherMethods"
                    :key="method.id"
                    class="payment-option-card"
                    :class="{ selected: selectedPayment.id === method.id }"
                    @click="selectedPayment = method"
                  >
                    <div class="pay-logo-badge other-badge">{{ method.short }}</div>
                    <div class="pay-info">
                      <strong class="pay-name">{{ method.name }}</strong>
                      <small class="pay-hint">{{ method.hint }}</small>
                    </div>
                    <span class="courier-radio" :class="{ active: selectedPayment.id === method.id }"></span>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>

        <!-- ===============================================================
             RIGHT COLUMN: Sticky Summary Sidebar & Voucher Application
             =============================================================== -->
        <aside class="checkout-sidebar-col">
          <div class="checkout-sticky-card">

            <h3 class="sidebar-title">Ringkasan Pembayaran</h3>

            <!-- VOUCHER PROMO SECTION -->
            <div class="voucher-box-container">
              <label class="voucher-label">
                <span>Voucher Diskon Koafy</span>
                <span class="voucher-badge-hot">HEMAT</span>
              </label>

              <!-- Voucher Input Form -->
              <div class="voucher-input-group">
                <input
                  v-model="voucherInput"
                  type="text"
                  class="voucher-input"
                  placeholder="Ketik kode kupon..."
                  @keyup.enter="handleApplyVoucherInput"
                />
                <button
                  type="button"
                  class="btn-apply-voucher"
                  @click="handleApplyVoucherInput"
                >
                  Terapkan
                </button>
              </div>

              <!-- Applied Voucher Card -->
              <div v-if="appliedVoucher" class="applied-voucher-card">
                <div class="applied-info">
                  <span class="applied-icon">🎟️</span>
                  <div>
                    <strong class="applied-code">{{ appliedVoucher.code }}</strong>
                    <small class="applied-desc">{{ appliedVoucher.desc }}</small>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn-remove-voucher"
                  title="Hapus Voucher"
                  @click="removeVoucher"
                >
                  ✕
                </button>
              </div>

              <!-- Available Quick Vouchers Pills -->
              <div class="available-vouchers-list">
                <span class="vouchers-hint">Kupon Tersedia:</span>
                <div class="vouchers-pills-row">
                  <button
                    v-for="v in availableVouchers"
                    :key="v.code"
                    type="button"
                    class="voucher-pill-btn"
                    :class="{ selected: appliedVoucher?.code === v.code }"
                    @click="applyVoucher(v)"
                  >
                    <span class="pill-code">{{ v.code }}</span>
                    <span class="pill-disc">{{ v.label }}</span>
                  </button>
                </div>
              </div>

            </div>

            <!-- Price Breakdown Calculation -->
            <div class="price-breakdown-table">
              <div class="breakdown-row">
                <span class="row-label">Total Harga ({{ totalItemQuantity }} Barang)</span>
                <span class="row-value">Rp {{ formatRupiah(subtotalAmount) }}</span>
              </div>

              <div class="breakdown-row">
                <span class="row-label">
                  Biaya Pengiriman
                  <small v-if="deliveryType === 'clinic_pickup'" class="pill-free-badge">Ambil di Klinik</small>
                </span>
                <span v-if="deliveryType === 'clinic_pickup'" class="row-value free-text">GRATIS</span>
                <span v-else class="row-value">Rp {{ formatRupiah(shippingFee) }}</span>
              </div>

              <div v-if="discountAmount > 0" class="breakdown-row discount-row">
                <span class="row-label">Diskon Kupon Promo</span>
                <span class="row-value discount-value">-Rp {{ formatRupiah(discountAmount) }}</span>
              </div>

              <div class="breakdown-row">
                <span class="row-label">Biaya Layanan &amp; Penanganan</span>
                <span class="row-value free-text">GRATIS</span>
              </div>

              <div class="breakdown-divider"></div>

              <div class="breakdown-row total-row">
                <div class="total-label-group">
                  <span class="total-main-label">Total Tagihan</span>
                  <small class="total-sub-label">Termasuk PPN &amp; Biaya Asuransi</small>
                </div>
                <strong class="total-main-amount">Rp {{ formatRupiah(grandTotal) }}</strong>
              </div>
            </div>

            <!-- Big Submit CTA Button -->
            <button
              type="button"
              class="btn-place-order"
              :disabled="isSubmitting || activeCheckoutItems.length === 0"
              @click="submitOrder"
            >
              <span v-if="isSubmitting" class="spinner-inline"></span>
              <span v-else>
                Bayar Sekarang • Rp {{ formatRupiah(grandTotal) }}
              </span>
            </button>

            <!-- Reassurance & Trust Badges -->
            <div class="checkout-trust-box">
              <div class="trust-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Produk Asli &amp; Teruji Dokter Klinik</span>
              </div>
              <div class="trust-item">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Garansi 100% Pengembalian Dana</span>
              </div>
            </div>

          </div>
        </aside>

      </div>

    </div>

    <!-- =====================================================================
         MODAL 1: GANTI ALAMAT PENGIRIMAN
         ===================================================================== -->
    <div
      v-if="showAddressModal"
      class="checkout-modal-backdrop"
      @click="showAddressModal = false"
    >
      <div class="checkout-modal-card" @click.stop>
        <div class="modal-header">
          <h3 class="modal-title">Pilih Alamat Pengiriman</h3>
          <button type="button" class="modal-close-btn" @click="showAddressModal = false">✕</button>
        </div>

        <div class="modal-body">
          <div class="address-selection-list">
            <div
              v-for="addr in savedAddresses"
              :key="addr.id"
              class="address-option-card"
              :class="{ selected: selectedAddress.id === addr.id }"
              @click="chooseAddress(addr)"
            >
              <div class="addr-opt-header">
                <div class="addr-badges">
                  <span class="address-badge-type">{{ addr.label }}</span>
                  <span v-if="addr.isPrimary" class="address-badge-primary">Utama</span>
                </div>
                <span class="courier-radio" :class="{ active: selectedAddress.id === addr.id }"></span>
              </div>

              <strong class="addr-opt-name">{{ addr.recipientName }} • {{ addr.phone }}</strong>
              <p class="addr-opt-full">{{ addr.fullAddress }}</p>
              <span class="addr-opt-area">{{ addr.area }} (Kode Pos: {{ addr.postalCode }})</span>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-cancel-modal" @click="showAddressModal = false">
            Tutup
          </button>
          <button type="button" class="btn-save-modal" @click="showAddressModal = false">
            Gunakan Alamat Ini
          </button>
        </div>
      </div>
    </div>

    <!-- =====================================================================
         MODAL 2: PESANAN BERHASIL DIBUAT (INVOICE & INSTRUKSI PEMBAYARAN)
         ===================================================================== -->
    <div
      v-if="showSuccessModal"
      class="checkout-modal-backdrop"
      @click="handleSuccessBackToStore"
    >
      <div class="checkout-modal-card success-modal-card" @click.stop>

        <div class="success-top-celebration">
          <div class="success-icon-badge">✓</div>
          <span class="success-label-tag">PESANAN BERHASIL DIBUAT</span>
          <h2 class="success-title">Terima Kasih Atas Pesanan Anda!</h2>
          <p class="success-desc">
            Pesanan Anda dengan nomor tagihan telah resmi terdaftar di sistem kecantikan Koafy.
          </p>
        </div>

        <div class="invoice-summary-box">
          <div class="invoice-row">
            <span class="inv-label">No. Invoice</span>
            <strong class="inv-value pink-code">{{ createdOrder.id }}</strong>
          </div>
          <div class="invoice-row">
            <span class="inv-label">Tanggal Transaksi</span>
            <span class="inv-value">{{ createdOrder.date }}</span>
          </div>
          <div class="invoice-row">
            <span class="inv-label">Metode Pengiriman</span>
            <span class="inv-value">
              {{ createdOrder.deliveryType === 'clinic_pickup' ? 'Ambil di ' + createdOrder.clinicBranch : createdOrder.courier }}
            </span>
          </div>
          <div class="invoice-row">
            <span class="inv-label">Metode Pembayaran</span>
            <strong class="inv-value">{{ createdOrder.paymentMethod }}</strong>
          </div>
          <div class="invoice-row total-inv-row">
            <span class="inv-label">Total Pembayaran</span>
            <strong class="inv-total-price">Rp {{ formatRupiah(createdOrder.totalAmount) }}</strong>
          </div>
        </div>

        <!-- Payment Instructions Card (VA / QRIS / Manual BCA / Clinic Pickup Instructions) -->
        <div class="payment-instruction-box">
          <div v-if="createdOrder.paymentType === 'va'" class="instruction-content">
            <span class="ins-title">Nomor Virtual Account {{ createdOrder.paymentMethod }}:</span>
            <div class="va-copy-row">
              <strong class="va-number-text">{{ createdOrder.vaNumber }}</strong>
              <button type="button" class="btn-copy-code" @click="copyCode(createdOrder.vaNumber, 'Nomor Virtual Account berhasil disalin!')">
                Salin No. VA
              </button>
            </div>
            <p class="ins-hint">
              Transfer nominal pas ke nomor VA di atas melalui ATM / M-Banking sebelum 24 jam.
            </p>
          </div>

          <!-- TRANSFER BANK BCA MANUAL: NO REKENING + FORM INPUT NAMA PENGIRIM + UPLOAD BUKTI -->
          <div v-else-if="createdOrder.paymentType === 'manual_bca'" class="instruction-content bca-manual-instruction">
            
            <!-- Box No Rekening Tujuan -->
            <div class="bca-dest-box">
              <div class="bca-header-line">
                <span class="bca-logo-pill">BCA</span>
                <div>
                  <h4 class="bca-title">Rekening Transfer Resmi Koafy</h4>
                  <small class="bca-sub">Silakan transfer nominal pas melalui BCA Mobile, ATM, atau KlikBCA</small>
                </div>
              </div>

              <div class="bca-account-card">
                <div class="bca-acc-row">
                  <span class="bca-row-label">Bank Penerima:</span>
                  <strong class="bca-row-val">Bank Central Asia (BCA)</strong>
                </div>

                <div class="bca-acc-row highlight-row">
                  <span class="bca-row-label">Nomor Rekening:</span>
                  <div class="copyable-val-wrap">
                    <strong class="bca-row-val bca-acc-number">828 0192 888</strong>
                    <button type="button" class="btn-copy-mini" @click="copyCode('8280192888', 'Nomor Rekening BCA 8280192888 berhasil disalin!')">
                      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
                      </svg>
                      Salin Rekening
                    </button>
                  </div>
                </div>

                <div class="bca-acc-row">
                  <span class="bca-row-label">Atas Nama Rekening:</span>
                  <strong class="bca-row-val">PT KOAFY BEAUTY INDONESIA</strong>
                </div>

                <div class="bca-acc-row highlight-amount-row">
                  <span class="bca-row-label">Jumlah Ditransfer:</span>
                  <div class="copyable-val-wrap">
                    <strong class="bca-row-val bca-amount-text">Rp {{ formatRupiah(createdOrder.totalAmount) }}</strong>
                    <button type="button" class="btn-copy-mini" @click="copyCode(createdOrder.totalAmount, 'Nominal tagihan berhasil disalin!')">
                      Salin Nominal
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Form Konfirmasi Transfer: Nama Pengirim + Upload Screenshot -->
            <div v-if="!transferProofSubmitted" class="bca-confirm-form-wrap">
              <div class="form-title-pill-wrap">
                <span class="step-num-pill">Konfirmasi</span>
                <h4 class="form-section-title">Data Rekening Pengirim &amp; Bukti Transfer</h4>
              </div>
              <p class="form-section-hint">
                Mohon masukkan nama pemilik rekening yang mentransfer dan unggah screenshot bukti transfer sukses agar pesanan Anda dapat segera kami verifikasi.
              </p>

              <!-- Input Nama Pemilik Rekening -->
              <div class="confirm-field-group">
                <label class="confirm-label">
                  Nama Pemilik Rekening Pengirim <span class="req-star">*</span>
                </label>
                <input
                  v-model="transferForm.senderName"
                  type="text"
                  placeholder="Contoh: Siti Rahma"
                  class="confirm-input"
                />
              </div>

              <!-- Input Bank Pengirim -->
              <div class="confirm-field-group">
                <label class="confirm-label">Bank Pengirim</label>
                <select v-model="transferForm.senderBank" class="confirm-select">
                  <option value="BCA">BCA (Bank Central Asia)</option>
                  <option value="Mandiri">Bank Mandiri</option>
                  <option value="BNI">Bank BNI</option>
                  <option value="BRI">Bank BRI</option>
                  <option value="CIMB Niaga">CIMB Niaga</option>
                  <option value="Bank Lain / E-Wallet">Bank Lain / E-Wallet (SeaBank, Jago, Dana, dll)</option>
                </select>
              </div>

              <!-- Upload Bukti Screenshot -->
              <div class="confirm-field-group">
                <label class="confirm-label">
                  Upload Bukti Screenshot Transfer <span class="req-star">*</span>
                </label>

                <!-- Dropzone File Picker -->
                <div
                  v-if="!transferProofPreview"
                  class="upload-dropzone"
                  @click="triggerFileInput"
                >
                  <input
                    ref="transferProofInputRef"
                    type="file"
                    accept="image/*"
                    class="hidden-file-input"
                    @change="handleTransferProofUpload"
                  />
                  <div class="dropzone-content">
                    <div class="dropzone-icon">
                      <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                      </svg>
                    </div>
                    <strong class="dropzone-text">Klik untuk Upload Screenshot Bukti Transfer</strong>
                    <small class="dropzone-hint">Format file: JPG, PNG, atau WEBP (Maksimal 5 MB)</small>
                  </div>
                </div>

                <!-- Preview Thumbnail Card if Uploaded -->
                <div v-else class="proof-preview-card">
                  <div class="preview-img-wrap">
                    <img :src="transferProofPreview" alt="Bukti Transfer" class="preview-img" />
                  </div>
                  <div class="preview-meta">
                    <span class="preview-success-tag">✓ Screenshot Bukti Terpilih</span>
                    <p class="preview-hint">Pastikan nama penerima &amp; nominal Rp {{ formatRupiah(createdOrder.totalAmount) }} terbaca jelas.</p>
                    <div class="preview-action-btns">
                      <button type="button" class="btn-change-photo" @click="triggerFileInput">
                        Ganti Foto
                      </button>
                      <button type="button" class="btn-remove-photo" @click="removeTransferProof">
                        Hapus
                      </button>
                    </div>
                    <input
                      ref="transferProofInputRef"
                      type="file"
                      accept="image/*"
                      class="hidden-file-input"
                      @change="handleTransferProofUpload"
                    />
                  </div>
                </div>
              </div>

              <!-- Tombol Kirim Bukti Pembayaran -->
              <button
                type="button"
                class="btn-submit-transfer-proof"
                :disabled="isUploadingProof"
                @click="submitTransferConfirmation"
              >
                <span v-if="isUploadingProof" class="spinner-inline"></span>
                <span v-else>
                  Kirim Bukti Pembayaran
                </span>
              </button>
            </div>

            <!-- Tampilan Berhasil Setelah Bukti Dikirim -->
            <div v-else class="transfer-submitted-success-box">
              <div class="proof-success-badge">✓</div>
              <h4 class="submitted-title">Bukti Transfer Berhasil Dikirim!</h4>
              <p class="submitted-desc">
                Terima kasih, <strong>{{ transferForm.senderName }}</strong>! Bukti pembayaran Anda telah diterima sistem. Tim admin/finance Koafy akan segera memverifikasi transaksi Anda.
              </p>
              <div class="submitted-details-pill">
                <span>Pengirim: <strong>{{ transferForm.senderName }} ({{ transferForm.senderBank }})</strong></span>
                <span>Status: <strong class="pink-status">Menunggu Verifikasi Admin</strong></span>
              </div>
            </div>

          </div>

          <div v-else-if="createdOrder.paymentType === 'ewallet'" class="instruction-content">
            <span class="ins-title">Instruksi Pembayaran QRIS / E-Wallet:</span>
            <div class="qris-box-mock">
              <span class="qris-brand">QRIS KOAFY PAY</span>
              <div class="qris-qr-code">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#2D101C" stroke-width="1.8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5A.75.75 0 014.5 3.75h4.5a.75.75 0 01.75.75v4.5a.75.75 0 01-.75.75h-4.5A.75.75 0 013.75 9V4.5zM3.75 14.25a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v4.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75v-4.5zM13.5 4.5a.75.75 0 01.75-.75h4.5a.75.75 0 01.75.75v4.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V4.5zM14.25 13.5h1.5v1.5h-1.5zM17.25 13.5h1.5v1.5h-1.5zM14.25 16.5h1.5v1.5h-1.5zM17.25 16.5h1.5v1.5h-1.5z" />
                </svg>
              </div>
              <small>Scan QRIS menggunakan GoPay, OVO, ShopeePay, Dana, atau BCA Mobile.</small>
            </div>
          </div>

          <div v-else class="instruction-content">
            <span class="ins-title">Pengambilan di Klinik Koafy:</span>
            <p class="ins-hint">
              Silakan datang ke <strong>{{ createdOrder.clinicBranch }}</strong> pada tanggal pengambilan yang dipilih. Tunjukkan kode invoice <strong>{{ createdOrder.id }}</strong> ke resepsionis klinik kami.
            </p>
          </div>
        </div>

        <div class="success-actions-row">
          <button
            type="button"
            class="btn-view-order-status"
            @click="handleViewMyOrders"
          >
            Lihat Pesanan Saya
          </button>
          <button
            type="button"
            class="btn-continue-shopping"
            @click="handleSuccessBackToStore"
          >
            Belanja Produk Lainnya
          </button>
        </div>

      </div>
    </div>

  </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  user: {
    type: Object,
    default: () => ({ name: 'Siti Rahma', phone: '081234567890' }),
  },
  cartItems: {
    type: Array,
    default: () => [],
  },
  directBuyItem: {
    type: Object,
    default: null,
  },
  initialSource: {
    type: String,
    default: 'cart', // 'cart' | 'direct'
  },
  initialDiscountValue: {
    type: Number,
    default: 0,
  },
});

const emit = defineEmits([
  'back-to-home',
  'back-to-cart',
  'order-created',
  'toast',
  'view-orders',
]);

function formatRupiah(val) {
  return Number(val || 0).toLocaleString('id-ID');
}

// Source toggle ('cart' or 'direct')
const activeSource = ref(props.initialSource === 'direct' && props.directBuyItem ? 'direct' : 'cart');

// Local reactive items copy for adjustment
const checkoutCartItems = ref(props.cartItems.map((item) => ({ ...item })));
const checkoutDirectItem = ref(
  props.directBuyItem
    ? { ...props.directBuyItem, qty: props.directBuyItem.qty || 1 }
    : null
);

// Active items based on source
const activeCheckoutItems = computed(() => {
  if (activeSource.value === 'direct' && checkoutDirectItem.value) {
    return [checkoutDirectItem.value];
  }
  return checkoutCartItems.value;
});

function adjustItemQty(item, delta) {
  item.qty += delta;
  if (item.qty < 1) item.qty = 1;
}

// -----------------------------------------------------------------------------
// DELIVERY TYPE: 'shipping' (Kirim ke Rumah) vs 'clinic_pickup' (Ambil di Klinik)
// -----------------------------------------------------------------------------
const deliveryType = ref('shipping');

// Saved Addresses (synced with user's addresses or defaults)
const savedAddresses = ref([
  {
    id: 'addr-1',
    label: 'Rumah Utama',
    recipientName: props.user?.name || 'Siti Rahma',
    phone: props.user?.phone || '081234567890',
    fullAddress: 'Jl. Senopati No. 45, RT 02 / RW 05, Kebayoran Baru, Jakarta Selatan',
    area: 'DKI Jakarta',
    postalCode: '12110',
    notes: 'Pagar warna putih, titip ke satpam jika kosong',
    isPrimary: true,
  },
  {
    id: 'addr-2',
    label: 'Office (Kantor)',
    recipientName: props.user?.name || 'Siti Rahma',
    phone: '081987654321',
    fullAddress: 'Gedung SCBD Tower B Lt. 12, Tanah Abang, Jakarta Pusat',
    area: 'DKI Jakarta',
    postalCode: '10220',
    notes: 'Kirim saat jam kerja 09.00 - 17.00 WIB',
    isPrimary: false,
  },
]);

const selectedAddress = ref(savedAddresses.value[0]);
const showAddressModal = ref(false);

function chooseAddress(addr) {
  selectedAddress.value = addr;
  showAddressModal.value = false;
  emit('toast', `Alamat pengiriman diubah ke: ${addr.label}`);
}

// Couriers Options
const courierOptions = [
  { id: 'courier-1', code: 'J&T', name: 'J&T Express - Regular', eta: '2 - 3 Hari Kerja', price: 15000 },
  { id: 'courier-2', code: 'SICEPAT', name: 'SiCepat BEST (Next Day)', eta: '1 Hari Sampai', price: 25000 },
  { id: 'courier-3', code: 'JNE', name: 'JNE YES Express', eta: '1 - 2 Hari Kerja', price: 20000 },
  { id: 'courier-4', code: 'INSTANT', name: 'Instant GoSend / Grab', eta: '2 - 4 Jam Tiba', price: 35000 },
  { id: 'courier-5', code: 'ANTERAJA', name: 'Anteraja Regular Eco', eta: '2 - 3 Hari Kerja', price: 12000 },
];
const selectedCourier = ref(courierOptions[0]);

// Clinic Branches for Self-Pickup
const clinicBranches = [
  {
    id: 'clinic-jkt',
    city: 'Jakarta Selatan',
    name: 'Klinik Koafy Senopati Aesthetic',
    address: 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan',
    hours: '09.00 - 20.00 WIB',
  },
  {
    id: 'clinic-bdg',
    city: 'Bandung',
    name: 'Klinik Koafy Riau Glow Boutique',
    address: 'Jl. L.L.R.E Martadinata (Riau) No. 78, Cihapit, Bandung',
    hours: '09.00 - 19.00 WIB',
  },
  {
    id: 'clinic-sby',
    city: 'Surabaya',
    name: 'Klinik Koafy Gubeng Derma Center',
    address: 'Jl. Raya Gubeng No. 32, Gubeng, Surabaya',
    hours: '09.00 - 20.00 WIB',
  },
];
const selectedClinic = ref(clinicBranches[0]);

// Min pickup date: Tomorrow
const tomorrowDate = new Date();
tomorrowDate.setDate(tomorrowDate.getDate() + 1);
const minPickupDate = tomorrowDate.toISOString().split('T')[0];
const pickupDate = ref(minPickupDate);
const pickupTime = ref('Pagi (10:00 - 12:00 WIB)');
const pickupNotes = ref('');

// -----------------------------------------------------------------------------
// PAYMENT METHODS
// -----------------------------------------------------------------------------
const manualBankMethods = [
  {
    id: 'bca_manual',
    short: 'BCA',
    name: 'Transfer Bank BCA (No. Rekening)',
    bankName: 'Bank Central Asia (BCA)',
    accountNumber: '828 0192 888',
    accountName: 'PT KOAFY BEAUTY INDONESIA',
    hint: 'Transfer manual ke rekening resmi & upload screenshot bukti transfer',
    type: 'manual_bca',
  },
];

const vaMethods = [
  { id: 'bca_va', short: 'BCA', name: 'BCA Virtual Account', hint: 'Otomatis terverifikasi 24 jam', type: 'va' },
  { id: 'mandiri_va', short: 'MANDIRI', name: 'Mandiri Virtual Account', hint: 'Livin by Mandiri & ATM', type: 'va' },
  { id: 'bni_va', short: 'BNI', name: 'BNI Virtual Account', hint: 'BNI Mobile Banking', type: 'va' },
  { id: 'bri_va', short: 'BRI', name: 'BRI Virtual Account (BRIVA)', hint: 'BRImo & ATM BRI', type: 'va' },
];

const ewalletMethods = [
  { id: 'qris', short: 'QRIS', name: 'QRIS (Semua E-Wallet / Bank)', hint: 'Scan langsung via kamera / m-banking', type: 'ewallet' },
  { id: 'gopay', short: 'GOPAY', name: 'GoPay / GoPay Later', hint: 'Terhubung ke aplikasi Gojek', type: 'ewallet' },
  { id: 'ovo', short: 'OVO', name: 'OVO Cash', hint: 'Konfirmasi instan via ponsel', type: 'ewallet' },
  { id: 'shopeepay', short: 'SPAY', name: 'ShopeePay & DANA', hint: 'Cashback koin & saldo instan', type: 'ewallet' },
];

const otherMethods = [
  { id: 'cc', short: 'CC', name: 'Kartu Kredit / Debit Online', hint: 'Visa, MasterCard, JCB 3D-Secure', type: 'cc' },
  { id: 'clinic_pay', short: 'KLINIK', name: 'Bayar Langsung di Klinik (COD)', hint: 'Tunai / Debit saat serah terima barang', type: 'cod' },
];

const selectedPayment = ref(manualBankMethods[0]);

// State for BCA Transfer Confirmation & Upload
const transferForm = ref({
  senderName: props.user?.name || 'Siti Rahma',
  senderBank: 'BCA',
  notes: '',
});
const transferProofPreview = ref('');
const isUploadingProof = ref(false);
const transferProofSubmitted = ref(false);
const transferProofInputRef = ref(null);

function triggerFileInput() {
  if (transferProofInputRef.value) {
    transferProofInputRef.value.click();
  }
}

function handleTransferProofUpload(event) {
  const file = event.target.files?.[0];
  if (!file) return;
  if (file.size > 5 * 1024 * 1024) {
    emit('toast', 'Ukuran foto maksimal 5MB');
    return;
  }
  const reader = new FileReader();
  reader.onload = (e) => {
    transferProofPreview.value = e.target.result;
    emit('toast', 'Foto screenshot bukti transfer berhasil dimuat');
  };
  reader.readAsDataURL(file);
}

function removeTransferProof() {
  transferProofPreview.value = '';
  if (transferProofInputRef.value) {
    transferProofInputRef.value.value = '';
  }
}

function submitTransferConfirmation() {
  if (!transferForm.value.senderName.trim()) {
    emit('toast', 'Silakan masukkan nama pemilik rekening pengirim');
    return;
  }
  if (!transferProofPreview.value) {
    emit('toast', 'Silakan lampirkan foto / screenshot bukti transfer Anda');
    return;
  }
  isUploadingProof.value = true;
  setTimeout(() => {
    isUploadingProof.value = false;
    transferProofSubmitted.value = true;
    createdOrder.value.status = 'processing';
    createdOrder.value.statusLabel = 'Menunggu Konfirmasi Admin';
    createdOrder.value.statusClass = 'status-processing';
    createdOrder.value.transferSenderName = transferForm.value.senderName;
    createdOrder.value.transferSenderBank = transferForm.value.senderBank;
    createdOrder.value.transferProofImage = transferProofPreview.value;
    createdOrder.value.transferSubmitted = true;
    try {
      const orders = JSON.parse(localStorage.getItem('koafy_orders') || '[]');
      const idx = orders.findIndex((o) => o.id === createdOrder.value.id);
      if (idx > -1) {
        orders[idx] = { ...orders[idx], ...createdOrder.value };
      } else {
        orders.unshift(createdOrder.value);
      }
      localStorage.setItem('koafy_orders', JSON.stringify(orders));
    } catch (e) {
      console.error('Error updating order transfer proof', e);
    }
    emit('toast', 'Bukti transfer berhasil dikirim! Menunggu konfirmasi admin.');
  }, 700);
}

// -----------------------------------------------------------------------------
// VOUCHERS & COUPONS
// -----------------------------------------------------------------------------
const availableVouchers = [
  { code: 'BEAUTY2027', label: 'Hemat Rp 25.000', amount: 25000, desc: 'Potongan spesial launching produk 2027' },
  { code: 'KOAFYFIRST', label: 'Diskon 15%', percent: 0.15, desc: 'Diskon 15% untuk pelanggan setia' },
  { code: 'FREESHIP', label: 'Bebas Ongkir', freeship: true, desc: 'Potongan ongkos kirim ke seluruh Indonesia' },
];

const voucherInput = ref('');
const appliedVoucher = ref(
  props.initialDiscountValue > 0
    ? { code: 'VOUCHERPROMO', label: `Diskon Rp ${formatRupiah(props.initialDiscountValue)}`, amount: props.initialDiscountValue, desc: 'Promo aktif keranjang' }
    : null
);

function applyVoucher(voucher) {
  appliedVoucher.value = voucher;
  emit('toast', `Kupon ${voucher.code} berhasil diterapkan!`);
}

function handleApplyVoucherInput() {
  const code = voucherInput.value.trim().toUpperCase();
  if (!code) return;
  const match = availableVouchers.find((v) => v.code === code);
  if (match) {
    appliedVoucher.value = match;
    voucherInput.value = '';
    emit('toast', `Kupon ${match.code} berhasil diterapkan!`);
  } else {
    // Custom valid voucher test
    appliedVoucher.value = {
      code,
      label: 'Hemat Rp 20.000',
      amount: 20000,
      desc: 'Kupon promo belanja Koafy',
    };
    voucherInput.value = '';
    emit('toast', `Kupon ${code} berhasil diaktifkan!`);
  }
}

function removeVoucher() {
  appliedVoucher.value = null;
  emit('toast', 'Voucher telah dilepas.');
}

// -----------------------------------------------------------------------------
// CALCULATIONS
// -----------------------------------------------------------------------------
const subtotalAmount = computed(() => {
  return activeCheckoutItems.value.reduce((acc, item) => acc + item.price * item.qty, 0);
});

const totalItemQuantity = computed(() => {
  return activeCheckoutItems.value.reduce((acc, item) => acc + item.qty, 0);
});

const shippingFee = computed(() => {
  if (deliveryType.value === 'clinic_pickup') {
    return 0; // Gratis ongkir jika ambil di klinik
  }
  if (appliedVoucher.value && appliedVoucher.value.freeship) {
    return 0;
  }
  return selectedCourier.value ? selectedCourier.value.price : 15000;
});

const discountAmount = computed(() => {
  if (!appliedVoucher.value) return 0;
  if (appliedVoucher.value.amount) {
    return Math.min(appliedVoucher.value.amount, subtotalAmount.value);
  }
  if (appliedVoucher.value.percent) {
    return Math.round(subtotalAmount.value * appliedVoucher.value.percent);
  }
  return 0;
});

const grandTotal = computed(() => {
  const tot = subtotalAmount.value + shippingFee.value - discountAmount.value;
  return Math.max(tot, 0);
});

// -----------------------------------------------------------------------------
// SUBMIT ORDER
// -----------------------------------------------------------------------------
const isSubmitting = ref(false);
const showSuccessModal = ref(false);
const createdOrder = ref({});

function submitOrder() {
  if (activeCheckoutItems.value.length === 0) {
    emit('toast', 'Tidak ada barang yang dipilih untuk checkout.');
    return;
  }

  isSubmitting.value = true;
  transferProofSubmitted.value = false;
  transferProofPreview.value = '';

  setTimeout(() => {
    isSubmitting.value = false;

    // Generate Invoice Number
    const randomDigits = Math.floor(1000 + Math.random() * 9000);
    const invoiceId = `INV/20261124/KFY/${randomDigits}`;
    const todayStr = '24 Nov 2026';

    // Virtual account generator mock
    const randomVA = '8029 ' + Math.floor(1000 + Math.random() * 9000) + ' ' + Math.floor(1000 + Math.random() * 9000) + ' ' + Math.floor(10 + Math.random() * 90);

    let status = 'shipping';
    let statusLabel = deliveryType.value === 'clinic_pickup' ? 'Siap Diambil di Klinik' : 'Menunggu Pembayaran';
    let statusClass = 'status-shipping';

    if (selectedPayment.value.type === 'manual_bca') {
      status = 'pending';
      statusLabel = 'Menunggu Bukti Transfer';
      statusClass = 'status-pending';
    }

    const orderData = {
      id: invoiceId,
      date: todayStr,
      status: status,
      statusLabel: statusLabel,
      statusClass: statusClass,
      deliveryType: deliveryType.value,
      courier: deliveryType.value === 'clinic_pickup' ? 'Ambil Sendiri di Klinik' : selectedCourier.value.name,
      clinicBranch: selectedClinic.value.name,
      trackingNumber: deliveryType.value === 'clinic_pickup' ? `KFY-PICKUP-${randomDigits}` : `JT${Math.floor(1000000000 + Math.random() * 9000000000)}`,
      totalAmount: grandTotal.value,
      paymentMethod: selectedPayment.value.name,
      paymentType: selectedPayment.value.type,
      vaNumber: randomVA,
      bankTarget: selectedPayment.value.type === 'manual_bca' ? {
        bank: 'Bank Central Asia (BCA)',
        accountNumber: '828 0192 888',
        accountName: 'PT KOAFY BEAUTY INDONESIA',
      } : null,
      items: activeCheckoutItems.value.map((item) => ({
        name: item.name,
        shade: item.meta || 'Standar',
        qty: item.qty,
        price: item.price,
        image: item.image || '/images/product-butterbalm-duo.jpg',
      })),
    };

    createdOrder.value = orderData;
    showSuccessModal.value = true;

    // Save to localStorage for orders list
    try {
      const orders = JSON.parse(localStorage.getItem('koafy_orders') || '[]');
      orders.unshift(orderData);
      localStorage.setItem('koafy_orders', JSON.stringify(orders));
    } catch (e) {
      console.error('Error saving order to localStorage', e);
    }

    // Notify parent about new order
    emit('order-created', {
      order: orderData,
      source: activeSource.value,
      clearedItemIds: activeSource.value === 'cart' ? checkoutCartItems.value.map((x) => x.id) : [],
    });

    emit('toast', `Pesanan ${invoiceId} berhasil dibuat!`);
  }, 900);
}

function copyCode(text, message = 'Berhasil disalin ke clipboard!') {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(String(text));
  }
  emit('toast', message);
}

function handleBackToCart() {
  emit('back-to-cart');
}

function handleViewMyOrders() {
  showSuccessModal.value = false;
  emit('view-orders');
}

function handleSuccessBackToStore() {
  showSuccessModal.value = false;
  emit('back-to-home');
}
</script>
