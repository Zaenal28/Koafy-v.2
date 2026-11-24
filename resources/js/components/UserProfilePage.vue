<template>
  <!-- =====================================================================
       USER PROFILE & ACCOUNT DASHBOARD
       - Ref Gambar 1: Left Profile Card + Right Shipping Addresses
       - Ref Gambar 2: Full-Page Add/Edit Address Form (NO POPUP)
       - Tabs: Alamat, Barang Dibeli, Wishlist, Keranjang, Edit Profil, Kata Sandi
       ===================================================================== -->
  <section class="user-profile-page" aria-label="Halaman Akun Pengguna">
    <div class="user-profile-container">

      <!-- Breadcrumbs Navigation -->
      <nav class="profile-breadcrumb" aria-label="Breadcrumb">
        <a href="#home" class="breadcrumb-link" @click.prevent="$emit('back-to-home')">Beranda</a>
        <span class="breadcrumb-separator">/</span>
        <a href="#profile" class="breadcrumb-link" @click.prevent="switchTab('addresses')">Akun Saya</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ currentTabTitle }}</span>
      </nav>

      <!-- Main Layout Grid (Left Sidebar + Right Content) -->
      <div class="profile-layout-grid">

        <!-- ===============================================================
             LEFT COLUMN: Profile Card & Actions (PERSIS GAMBAR REFERENSI 1)
             =============================================================== -->
        <aside class="profile-sidebar-card">
          <!-- Avatar with Camera Overlay Button -->
          <div class="profile-avatar-wrapper">
            <div class="profile-avatar-circle">
              <img
                :src="user.avatar"
                :alt="user.name"
                class="profile-avatar-img"
              />
            </div>
            <button
              type="button"
              class="avatar-camera-btn"
              title="Ubah Foto Profil"
              aria-label="Ubah Foto Profil"
              @click="triggerAvatarUpload"
            >
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
              </svg>
            </button>
            <input
              ref="fileInputRef"
              type="file"
              accept="image/*"
              class="hidden-file-input"
              @change="onAvatarSelected"
            />
          </div>

          <!-- User Name & Email -->
          <h2 class="profile-user-name">{{ user.name }}</h2>
          <p class="profile-user-email">{{ user.email }}</p>

          <!-- Membership Badge -->
          <div class="profile-tier-badge">
            <span class="tier-star">★</span>
            <span>{{ user.tier }}</span>
          </div>

          <!-- Action Buttons (Persis Gambar 1) -->
          <div class="sidebar-action-buttons">
            <!-- 1. Ubah Foto Profil -->
            <button
              type="button"
              class="btn-sidebar-outline"
              @click="triggerAvatarUpload"
            >
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z" />
              </svg>
              <span>Ubah Foto Profil</span>
            </button>

            <!-- 2. Barang Dibeli -->
            <button
              type="button"
              class="btn-sidebar-outline"
              :class="{ active: activeTab === 'orders' }"
              @click="switchTab('orders')"
            >
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
              </svg>
              <span>Barang Dibeli</span>
            </button>

            <!-- 3. Ubah Kata Sandi Akun (Red / Rose Gradient Button) -->
            <button
              type="button"
              class="btn-sidebar-primary"
              :class="{ active: activeTab === 'password' }"
              @click="switchTab('password')"
            >
              <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
              </svg>
              <span>Ubah Kata Sandi Akun</span>
            </button>
          </div>

          <!-- Extended Navigation Tabs List -->
          <div class="sidebar-nav-menu">
            <button
              type="button"
              class="sidebar-nav-item"
              :class="{ active: activeTab === 'addresses' || activeTab === 'address-form' }"
              @click="switchTab('addresses')"
            >
              <span class="nav-icon">📍</span>
              <span class="nav-label">Daftar Alamat</span>
              <span class="nav-badge">{{ addresses.length }}</span>
            </button>

            <button
              type="button"
              class="sidebar-nav-item"
              :class="{ active: activeTab === 'profile-info' }"
              @click="switchTab('profile-info')"
            >
              <span class="nav-icon">👤</span>
              <span class="nav-label">Data Diri & Info</span>
            </button>

            <button
              type="button"
              class="sidebar-nav-item"
              :class="{ active: activeTab === 'wishlist' }"
              @click="switchTab('wishlist')"
            >
              <span class="nav-icon">❤️</span>
              <span class="nav-label">Wishlist</span>
              <span class="nav-badge">{{ wishlistItems.length }}</span>
            </button>

            <button
              type="button"
              class="sidebar-nav-item"
              :class="{ active: activeTab === 'cart' }"
              @click="switchTab('cart')"
            >
              <span class="nav-icon">🛒</span>
              <span class="nav-label">Keranjang Belanja</span>
              <span class="nav-badge">{{ cartTotalQty }}</span>
            </button>

            <button
              type="button"
              class="sidebar-nav-item logout-item"
              @click="handleLogout"
            >
              <span class="nav-icon">🚪</span>
              <span class="nav-label">Keluar dari Akun</span>
            </button>
          </div>
        </aside>

        <!-- ===============================================================
             RIGHT COLUMN: Main Content Area (Multi-View without Popups)
             =============================================================== -->
        <main class="profile-content-card">

          <!-- -------------------------------------------------------------
               VIEW 1: DAFTAR ALAMAT PENGIRIMAN (PERSIS GAMBAR REFERENSI 1)
               ------------------------------------------------------------- -->
          <div v-if="activeTab === 'addresses'" class="addresses-view">
            <!-- Header Bar -->
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">📍</span>
                <h1 class="content-title">Daftar Alamat Pengiriman</h1>
              </div>

              <!-- Button Tambah Alamat Baru: Pindah ke sub-page/form (NO POPUP!) -->
              <button
                type="button"
                class="btn-add-address"
                @click="openAddAddressPage"
              >
                + Tambah Alamat Baru
              </button>
            </div>

            <!-- Address Cards List -->
            <div class="address-cards-list">
              <div
                v-for="addr in addresses"
                :key="addr.id"
                class="address-card"
                :class="{ 'is-primary': addr.isPrimary }"
              >
                <div class="address-card-body">
                  <div class="address-card-header">
                    <div class="address-title-group">
                      <h3 class="address-label-title">
                        {{ addr.recipientName }} ({{ addr.label }})
                      </h3>
                      <span v-if="addr.isPrimary" class="primary-address-pill">Utama</span>
                    </div>

                    <!-- Action Icons: Edit (Pencil) & Delete (Trash) -->
                    <div class="address-card-actions">
                      <button
                        type="button"
                        class="action-icon-btn edit-btn"
                        title="Edit Alamat"
                        aria-label="Edit Alamat"
                        @click="openEditAddressPage(addr)"
                      >
                        <!-- Pencil Icon -->
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </button>

                      <button
                        type="button"
                        class="action-icon-btn delete-btn"
                        title="Hapus Alamat"
                        aria-label="Hapus Alamat"
                        @click="deleteAddress(addr.id)"
                      >
                        <!-- Trash Icon -->
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  <!-- Phone Number -->
                  <p class="address-phone">{{ addr.phone }}</p>

                  <!-- Full Street Address -->
                  <p class="address-full">
                    {{ addr.fullAddress }}, {{ addr.area }}, {{ addr.postalCode }}
                  </p>

                  <!-- Delivery Note (Italic) -->
                  <p v-if="addr.notes" class="address-notes">
                    Catatan: {{ addr.notes }}
                  </p>

                  <!-- Set as Primary Button (if not primary) -->
                  <div v-if="!addr.isPrimary" class="address-footer-actions">
                    <button
                      type="button"
                      class="btn-set-primary"
                      @click="setAsPrimaryAddress(addr.id)"
                    >
                      Jadikan Alamat Utama
                    </button>
                  </div>
                </div>
              </div>

              <!-- Empty State if no addresses -->
              <div v-if="addresses.length === 0" class="empty-address-box">
                <p>Belum ada alamat pengiriman tersimpan.</p>
                <button type="button" class="btn-add-address" @click="openAddAddressPage">
                  + Tambah Alamat Sekarang
                </button>
              </div>
            </div>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 2: FORM TAMBAH / EDIT ALAMAT PENGIRIMAN
               (PERSIS GAMBAR REFERENSI 2 - PINDAH HALAMAN / SUB-VIEW, BUKAN POPUP!)
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'address-form'" class="address-form-view">
            <!-- Form Header with Title and Close 'X' Button -->
            <div class="form-header-bar">
              <h2 class="form-main-title">
                {{ isEditingAddress ? 'Edit Alamat Pengiriman' : 'Tambah Alamat Pengiriman Baru' }}
              </h2>
              <button
                type="button"
                class="form-close-btn"
                aria-label="Kembali ke Daftar Alamat"
                @click="cancelAddressForm"
              >
                ✕
              </button>
            </div>

            <!-- Form Content Fields (Persis Gambar 2) -->
            <form class="address-fields-form" @submit.prevent="saveAddressForm">

              <!-- 1. Label Alamat -->
              <div class="form-field-group">
                <label for="addr-label" class="form-field-label">
                  Label Alamat (misal: Rumah / Kantor)
                </label>
                <input
                  id="addr-label"
                  v-model="addressFormData.label"
                  type="text"
                  required
                  placeholder="Rumah"
                  class="form-field-input"
                />
              </div>

              <!-- 2. No Telepon -->
              <div class="form-field-group">
                <label for="addr-phone" class="form-field-label">
                  No Telepon <span class="required-asterisk">*</span>
                </label>
                <input
                  id="addr-phone"
                  v-model="addressFormData.phone"
                  type="tel"
                  required
                  placeholder="+62 (8) 000-0000"
                  class="form-field-input"
                />
              </div>

              <!-- 3. Nama Penerima -->
              <div class="form-field-group">
                <label for="addr-recipient" class="form-field-label">
                  Nama Penerima <span class="required-asterisk">*</span>
                </label>
                <input
                  id="addr-recipient"
                  v-model="addressFormData.recipientName"
                  type="text"
                  required
                  placeholder="Masukkan Nama Penerima"
                  class="form-field-input"
                />
              </div>

              <!-- 4. Alamat Penerima (Textarea) -->
              <div class="form-field-group">
                <label for="addr-full" class="form-field-label">
                  Alamat Penerima <span class="required-asterisk">*</span>
                </label>
                <textarea
                  id="addr-full"
                  v-model="addressFormData.fullAddress"
                  rows="3"
                  required
                  placeholder="Contoh: Jalan Raya Bogor No.123 RT 01 RW 01"
                  class="form-field-textarea"
                ></textarea>
              </div>

              <!-- 5. Kecamatan/Kota/Provinsi with Search Icon -->
              <div class="form-field-group">
                <label for="addr-area" class="form-field-label">
                  Kecamatan/Kota/Provinsi <span class="required-asterisk">*</span>
                </label>
                <div class="input-with-icon-wrap">
                  <input
                    id="addr-area"
                    v-model="addressFormData.area"
                    type="text"
                    required
                    placeholder="Pilih Kecamatan/Kota/Provinsi"
                    class="form-field-input"
                    list="area-suggestions"
                  />
                  <span class="search-magnifier-icon" aria-hidden="true">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                  </span>
                  <datalist id="area-suggestions">
                    <option value="Kebayoran Baru, Jakarta Selatan, DKI Jakarta" />
                    <option value="Tanah Abang, Jakarta Pusat, DKI Jakarta" />
                    <option value="Setiabudi, Jakarta Selatan, DKI Jakarta" />
                    <option value="Kelapa Gading, Jakarta Utara, DKI Jakarta" />
                    <option value="Coblong, Kota Bandung, Jawa Barat" />
                    <option value="Tegalsari, Kota Surabaya, Jawa Timur" />
                    <option value="Banjarsari, Kota Surakarta, Jawa Tengah" />
                    <option value="Kuta, Badung, Bali" />
                  </datalist>
                </div>
              </div>

              <!-- 6. Kode Pos -->
              <div class="form-field-group">
                <label for="addr-postal" class="form-field-label">
                  Kode Pos
                </label>
                <input
                  id="addr-postal"
                  v-model="addressFormData.postalCode"
                  type="text"
                  placeholder="12110"
                  class="form-field-input"
                />
              </div>

              <!-- 7. Catatan untuk Kurir (Opsional) -->
              <div class="form-field-group">
                <label for="addr-notes" class="form-field-label">
                  Catatan untuk Kurir (Opsional)
                </label>
                <input
                  id="addr-notes"
                  v-model="addressFormData.notes"
                  type="text"
                  placeholder="Contoh: Pagar warna putih, titip ke satpam jika kosong"
                  class="form-field-input"
                />
              </div>

              <!-- 8. Checkbox: Jadikan Alamat Utama -->
              <label class="form-checkbox-control">
                <input
                  v-model="addressFormData.isPrimary"
                  type="checkbox"
                  class="custom-pink-checkbox"
                />
                <span class="checkbox-label-text">Jadikan Alamat Utama Pengiriman</span>
              </label>

              <!-- Form Action Buttons: Simpan & Batal -->
              <div class="form-buttons-row">
                <button type="submit" class="btn-submit-address">
                  {{ isEditingAddress ? 'Simpan Perubahan Alamat' : 'Simpan Alamat' }}
                </button>
                <button
                  type="button"
                  class="btn-cancel-address"
                  @click="cancelAddressForm"
                >
                  Batal
                </button>
              </div>

            </form>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 3: BARANG DIBELI / PESANAN SAYA
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'orders'" class="orders-view">
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">🛍️</span>
                <h1 class="content-title">Barang yang Dibeli (Pesanan Saya)</h1>
              </div>
            </div>

            <!-- Order Status Filter Pills -->
            <div class="order-status-tabs">
              <button
                v-for="status in orderStatuses"
                :key="status.id"
                type="button"
                class="status-pill-btn"
                :class="{ active: currentOrderStatus === status.id }"
                @click="currentOrderStatus = status.id"
              >
                {{ status.label }}
              </button>
            </div>

            <!-- Orders Cards List -->
            <div class="orders-list">
              <div
                v-for="order in filteredOrders"
                :key="order.id"
                class="order-card"
              >
                <div class="order-card-header">
                  <div class="order-meta-info">
                    <span class="order-date">{{ order.date }}</span>
                    <span class="order-code">{{ order.id }}</span>
                    <span class="courier-badge">{{ order.courier }}</span>
                  </div>
                  <span class="order-status-badge" :class="order.statusClass">
                    {{ order.statusLabel }}
                  </span>
                </div>

                <!-- Order Item Rows -->
                <div class="order-items-wrapper">
                  <div
                    v-for="item in order.items"
                    :key="item.name"
                    class="order-item-row"
                  >
                    <img :src="item.image" :alt="item.name" class="order-item-thumb" />
                    <div class="order-item-details">
                      <h4 class="order-item-name">{{ item.name }}</h4>
                      <p class="order-item-meta">{{ item.shade }} • {{ item.qty }} pcs</p>
                    </div>
                    <div class="order-item-price">
                      Rp {{ formatRupiah(item.price) }}
                    </div>
                  </div>
                </div>

                <!-- Order Footer Total & Actions -->
                <div class="order-card-footer">
                  <div class="order-total-amount">
                    <span>Total Pembayaran:</span>
                    <strong>Rp {{ formatRupiah(order.totalAmount) }}</strong>
                  </div>
                  <div class="order-action-buttons">
                    <button
                      type="button"
                      class="btn-order-outline"
                      @click="$emit('toast', `Melihat nomor resi pengiriman ${order.trackingNumber}`)"
                    >
                      Lacak Paket
                    </button>
                    <button
                      type="button"
                      class="btn-order-primary"
                      @click="buyOrderAgain(order)"
                    >
                      Beli Lagi
                    </button>
                  </div>
                </div>
              </div>

              <!-- Empty orders state -->
              <div v-if="filteredOrders.length === 0" class="empty-address-box">
                <p>Tidak ada pesanan dengan status ini.</p>
              </div>
            </div>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 4: HALAMAN WISHLIST SAYA
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'wishlist'" class="wishlist-view">
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">❤️</span>
                <h1 class="content-title">Wishlist / Produk Favorit</h1>
                <span class="count-pill-tag">{{ wishlistItems.length }} Produk</span>
              </div>
              <button
                v-if="wishlistItems.length > 0"
                type="button"
                class="btn-add-address"
                @click="$emit('move-all-to-cart')"
              >
                Pindahkan Semua ke Keranjang
              </button>
            </div>

            <div v-if="wishlistItems.length > 0" class="wishlist-grid">
              <div
                v-for="item in wishlistItems"
                :key="item.id"
                class="wishlist-card"
              >
                <div class="wishlist-thumb-placeholder">
                  <img
                    v-if="item.image"
                    :src="item.image"
                    :alt="item.name"
                    class="wishlist-product-img"
                  />
                  <span v-else class="initial-logo-k">K</span>
                </div>
                <div class="wishlist-card-content">
                  <h3 class="wishlist-item-title">{{ item.name }}</h3>
                  <p class="wishlist-item-meta">{{ item.meta }}</p>
                  <div class="wishlist-price-row">
                    <span class="wishlist-price">Rp {{ formatRupiah(item.price) }}</span>
                    <span class="stock-badge">Stok Tersedia</span>
                  </div>
                  <div class="wishlist-actions-row">
                    <button
                      type="button"
                      class="btn-move-cart"
                      @click="$emit('move-to-cart', item.id)"
                    >
                      + Keranjang
                    </button>
                    <button
                      type="button"
                      class="btn-delete-wishlist"
                      title="Hapus dari Wishlist"
                      @click="$emit('toggle-favorite', item)"
                    >
                      ✕
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div v-else class="empty-address-box">
              <p>Belum ada produk favorit di wishlist Anda.</p>
              <button type="button" class="btn-add-address" @click="$emit('back-to-home')">
                Jelajahi Koleksi Koafy
              </button>
            </div>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 5: HALAMAN KERANJANG BELANJA
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'cart'" class="cart-view">
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">🛒</span>
                <h1 class="content-title">Keranjang Belanja</h1>
                <span class="count-pill-tag">{{ cartTotalQty }} Item</span>
              </div>
            </div>

            <div v-if="cartItems.length > 0" class="cart-layout-split">
              <!-- Cart Items List -->
              <div class="cart-items-column">
                <div
                  v-for="item in cartItems"
                  :key="item.id"
                  class="cart-row-card"
                >
                  <div class="cart-item-thumb">
                    <img
                      v-if="item.image"
                      :src="item.image"
                      :alt="item.name"
                      class="cart-img"
                    />
                    <span v-else class="cart-fallback-k">K</span>
                  </div>

                  <div class="cart-item-info">
                    <h3 class="cart-product-title">{{ item.name }}</h3>
                    <p class="cart-product-meta">{{ item.meta }}</p>
                    <div class="cart-product-unit-price">Rp {{ formatRupiah(item.price) }}</div>
                  </div>

                  <!-- Quantity Stepper -->
                  <div class="cart-qty-stepper">
                    <button
                      type="button"
                      class="qty-btn"
                      aria-label="Kurangi"
                      @click="$emit('change-qty', { id: item.id, delta: -1 })"
                    >
                      -
                    </button>
                    <span class="qty-number">{{ item.qty }}</span>
                    <button
                      type="button"
                      class="qty-btn"
                      aria-label="Tambah"
                      @click="$emit('change-qty', { id: item.id, delta: 1 })"
                    >
                      +
                    </button>
                  </div>

                  <!-- Subtotal -->
                  <div class="cart-subtotal-price">
                    Rp {{ formatRupiah(item.price * item.qty) }}
                  </div>
                </div>
              </div>

              <!-- Cart Summary Card -->
              <aside class="cart-summary-card">
                <h3 class="summary-card-title">Ringkasan Belanja</h3>
                <div class="summary-row">
                  <span>Total Harga ({{ cartTotalQty }} barang)</span>
                  <span>Rp {{ formatRupiah(cartSubtotal) }}</span>
                </div>
                <div class="summary-row discount-row">
                  <span>Diskon Voucher Member</span>
                  <span>-Rp {{ formatRupiah(activeDiscountValue || 0) }}</span>
                </div>
                <div class="summary-row">
                  <span>Estimasi Ongkos Kirim</span>
                  <span class="free-ongkir">GRATIS</span>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-total-row">
                  <span>Total Belanja</span>
                  <strong class="total-amount">Rp {{ formatRupiah(Math.max(0, cartSubtotal - (activeDiscountValue || 0))) }}</strong>
                </div>

                <button
                  type="button"
                  class="btn-checkout-full"
                  @click="$emit('checkout')"
                >
                  Lanjut ke Checkout
                </button>
              </aside>
            </div>

            <div v-else class="empty-address-box">
              <p>Keranjang belanja Anda masih kosong.</p>
              <button type="button" class="btn-add-address" @click="$emit('back-to-home')">
                Belanja Sekarang
              </button>
            </div>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 6: UBAH DATA INFORMASI PROFIL AKUN
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'profile-info'" class="profile-info-view">
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">👤</span>
                <h1 class="content-title">Ubah Data Informasi Profil</h1>
              </div>
            </div>

            <form class="address-fields-form" @submit.prevent="saveProfileInfo">
              <div class="form-field-group">
                <label class="form-field-label">Nama Lengkap <span class="required-asterisk">*</span></label>
                <input
                  v-model="userFormData.name"
                  type="text"
                  required
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">Email Akun <span class="required-asterisk">*</span></label>
                <input
                  v-model="userFormData.email"
                  type="email"
                  required
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">No. Telepon / WhatsApp <span class="required-asterisk">*</span></label>
                <input
                  v-model="userFormData.phone"
                  type="tel"
                  required
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">Tanggal Lahir</label>
                <input
                  v-model="userFormData.birthDate"
                  type="date"
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">Jenis Kelamin</label>
                <div class="gender-radio-group">
                  <label class="radio-label">
                    <input v-model="userFormData.gender" type="radio" value="Wanita" />
                    <span>Wanita</span>
                  </label>
                  <label class="radio-label">
                    <input v-model="userFormData.gender" type="radio" value="Pria" />
                    <span>Pria</span>
                  </label>
                </div>
              </div>

              <div class="form-buttons-row">
                <button type="submit" class="btn-submit-address">
                  Simpan Perubahan Data
                </button>
              </div>
            </form>
          </div>

          <!-- -------------------------------------------------------------
               VIEW 7: UBAH KATA SANDI AKUN
               ------------------------------------------------------------- -->
          <div v-else-if="activeTab === 'password'" class="password-view">
            <div class="content-header-row">
              <div class="content-header-left">
                <span class="location-pin-icon">🔑</span>
                <h1 class="content-title">Ubah Kata Sandi Akun</h1>
              </div>
            </div>

            <form class="address-fields-form" @submit.prevent="saveNewPassword">
              <div class="form-field-group">
                <label class="form-field-label">Kata Sandi Saat Ini <span class="required-asterisk">*</span></label>
                <input
                  v-model="passwordForm.oldPassword"
                  type="password"
                  required
                  placeholder="Masukkan kata sandi lama"
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">Kata Sandi Baru <span class="required-asterisk">*</span></label>
                <input
                  v-model="passwordForm.newPassword"
                  type="password"
                  required
                  minlength="8"
                  placeholder="Minimal 8 karakter"
                  class="form-field-input"
                />
              </div>

              <div class="form-field-group">
                <label class="form-field-label">Konfirmasi Kata Sandi Baru <span class="required-asterisk">*</span></label>
                <input
                  v-model="passwordForm.confirmPassword"
                  type="password"
                  required
                  minlength="8"
                  placeholder="Ulangi kata sandi baru"
                  class="form-field-input"
                />
              </div>

              <div class="form-buttons-row">
                <button type="submit" class="btn-submit-address">
                  Perbarui Kata Sandi
                </button>
              </div>
            </form>
          </div>

        </main>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
  user: {
    type: Object,
    default: () => ({
      name: 'Siti Rahma',
      email: 'siti.rahma@example.com',
      phone: '081234567890',
      tier: 'GOLD MEMBER',
      avatar: '/images/siti-rahma-avatar.jpg',
      gender: 'Wanita',
      birthDate: '1998-05-14',
    }),
  },
  wishlistItems: {
    type: Array,
    default: () => [],
  },
  cartItems: {
    type: Array,
    default: () => [],
  },
  activeDiscountValue: {
    type: Number,
    default: 0,
  },
  initialTab: {
    type: String,
    default: 'addresses',
  },
});

const emit = defineEmits([
  'update:user',
  'back-to-home',
  'toast',
  'move-to-cart',
  'move-all-to-cart',
  'toggle-favorite',
  'change-qty',
  'checkout',
  'logout',
]);

const activeTab = ref(props.initialTab || 'addresses');
const fileInputRef = ref(null);

watch(() => props.initialTab, (newTab) => {
  if (newTab) activeTab.value = newTab;
});

const currentTabTitle = computed(() => {
  switch (activeTab.value) {
    case 'addresses': return 'Daftar Alamat Pengiriman';
    case 'address-form': return isEditingAddress.value ? 'Edit Alamat' : 'Tambah Alamat';
    case 'orders': return 'Barang yang Dibeli';
    case 'wishlist': return 'Wishlist';
    case 'cart': return 'Keranjang Belanja';
    case 'profile-info': return 'Informasi Profil';
    case 'password': return 'Ubah Kata Sandi';
    default: return 'Akun Saya';
  }
});

function switchTab(tab) {
  activeTab.value = tab;
  window.scrollTo({ top: 120, behavior: 'smooth' });
}

// ---------------------------------------------------------------------
// ADDRESSES STATE & METHODS (REF GAMBAR 1 & 2)
// ---------------------------------------------------------------------
const addresses = ref([
  {
    id: 'addr-1',
    label: 'Rumah Utama',
    recipientName: 'Siti Rahma',
    phone: '081234567890',
    fullAddress: 'Jl. Senopati No. 45, RT 02 / RW 05, Kebayoran Baru, Jakarta Selatan',
    area: 'DKI Jakarta',
    postalCode: '12110',
    notes: 'Pagar warna putih, titip ke satpam jika kosong',
    isPrimary: true,
  },
  {
    id: 'addr-2',
    label: 'Office (Kantor)',
    recipientName: 'Siti Rahma',
    phone: '081987654321',
    fullAddress: 'Gedung SCBD Tower B Lt. 12, Tanah Abang, Jakarta Pusat',
    area: 'DKI Jakarta',
    postalCode: '10220',
    notes: 'Kirim saat jam kerja 09.00 - 17.00 WIB',
    isPrimary: false,
  },
]);

const isEditingAddress = ref(false);
const editingAddressId = ref(null);

const addressFormData = ref({
  label: '',
  phone: '',
  recipientName: '',
  fullAddress: '',
  area: '',
  postalCode: '',
  notes: '',
  isPrimary: false,
});

function openAddAddressPage() {
  isEditingAddress.value = false;
  editingAddressId.value = null;
  addressFormData.value = {
    label: 'Rumah',
    phone: props.user.phone || '',
    recipientName: props.user.name || '',
    fullAddress: '',
    area: '',
    postalCode: '',
    notes: '',
    isPrimary: addresses.value.length === 0,
  };
  // Pindah halaman/sub-view (NO POPUP)
  activeTab.value = 'address-form';
  window.scrollTo({ top: 120, behavior: 'smooth' });
}

function openEditAddressPage(addr) {
  isEditingAddress.value = true;
  editingAddressId.value = addr.id;
  addressFormData.value = { ...addr };
  // Pindah halaman/sub-view (NO POPUP)
  activeTab.value = 'address-form';
  window.scrollTo({ top: 120, behavior: 'smooth' });
}

function cancelAddressForm() {
  activeTab.value = 'addresses';
  window.scrollTo({ top: 120, behavior: 'smooth' });
}

function saveAddressForm() {
  if (!addressFormData.value.recipientName || !addressFormData.value.phone || !addressFormData.value.fullAddress) {
    emit('toast', 'Mohon lengkapi data alamat yang berbintang merah');
    return;
  }

  if (addressFormData.value.isPrimary) {
    addresses.value.forEach((a) => {
      a.isPrimary = false;
    });
  }

  if (isEditingAddress.value && editingAddressId.value) {
    const idx = addresses.value.findIndex((a) => a.id === editingAddressId.value);
    if (idx > -1) {
      addresses.value[idx] = {
        ...addressFormData.value,
        id: editingAddressId.value,
      };
      emit('toast', 'Alamat pengiriman berhasil diperbarui!');
    }
  } else {
    const newId = 'addr-' + Date.now();
    addresses.value.push({
      ...addressFormData.value,
      id: newId,
    });
    emit('toast', 'Alamat pengiriman baru berhasil ditambahkan!');
  }

  // Kembali ke halaman daftar alamat (NO POPUP)
  activeTab.value = 'addresses';
  window.scrollTo({ top: 120, behavior: 'smooth' });
}

function deleteAddress(id) {
  if (confirm('Apakah Anda yakin ingin menghapus alamat pengiriman ini?')) {
    addresses.value = addresses.value.filter((a) => a.id !== id);
    emit('toast', 'Alamat pengiriman berhasil dihapus');
  }
}

function setAsPrimaryAddress(id) {
  addresses.value.forEach((a) => {
    a.isPrimary = a.id === id;
  });
  emit('toast', 'Alamat utama berhasil diperbarui!');
}

// ---------------------------------------------------------------------
// ORDERS (BARANG DIBELI) STATE & METHODS
// ---------------------------------------------------------------------
const currentOrderStatus = ref('all');

const orderStatuses = [
  { id: 'all', label: 'Semua Pesanan' },
  { id: 'pending', label: 'Menunggu Pembayaran' },
  { id: 'processing', label: 'Diproses' },
  { id: 'shipping', label: 'Dikirim' },
  { id: 'completed', label: 'Selesai' },
  { id: 'cancelled', label: 'Dibatalkan' },
];

function formatRupiah(val) {
  return Number(val || 0).toLocaleString('id-ID');
}

const defaultSampleOrders = [
  {
    id: 'INV/20261120/KFY/0892',
    date: '20 Nov 2026',
    status: 'completed',
    statusLabel: 'Selesai',
    statusClass: 'status-completed',
    courier: 'J&T Express - Regular',
    trackingNumber: 'JT9283746102',
    totalAmount: 385000,
    items: [
      {
        name: 'Koafy Soft-Square Multi Balm Trio',
        shade: 'Trio Set 01 (Soft Rose & Berry)',
        qty: 1,
        price: 210000,
        image: '/images/product-butterbalm-1.jpg',
      },
      {
        name: 'Koafy Velvet Lip & Brush Set',
        shade: 'Rosewood Matte',
        qty: 1,
        price: 175000,
        image: '/images/product-lip-velvet.jpg',
      },
    ],
  },
  {
    id: 'INV/20261122/KFY/0944',
    date: '22 Nov 2026',
    status: 'shipping',
    statusLabel: 'Sedang Dikirim',
    statusClass: 'status-shipping',
    courier: 'SiCepat BEST (1 Hari Sampai)',
    trackingNumber: 'SC8837192800',
    totalAmount: 288600,
    items: [
      {
        name: 'Koafy Crystal Butterbalm Duo',
        shade: 'Mauve Pink Duo Set',
        qty: 1,
        price: 288600,
        image: '/images/product-butterbalm-duo.jpg',
      },
    ],
  },
];

function loadSavedOrders() {
  try {
    const saved = localStorage.getItem('koafy_orders');
    if (saved) {
      const parsed = JSON.parse(saved);
      if (Array.isArray(parsed) && parsed.length > 0) {
        return [...parsed, ...defaultSampleOrders];
      }
    }
  } catch (e) {
    console.error('Error loading saved orders', e);
  }
  return defaultSampleOrders;
}

const sampleOrders = ref(loadSavedOrders());

const filteredOrders = computed(() => {
  if (currentOrderStatus.value === 'all') return sampleOrders.value;
  return sampleOrders.value.filter((o) => o.status === currentOrderStatus.value);
});

function buyOrderAgain(order) {
  order.items.forEach((item) => {
    emit('move-to-cart', {
      id: 're-' + Date.now() + Math.random(),
      name: item.name,
      meta: item.shade,
      price: item.price,
      qty: item.qty,
    });
  });
  emit('toast', 'Item pesanan berhasil ditambahkan ke keranjang belanja!');
  activeTab.value = 'cart';
}

// ---------------------------------------------------------------------
// CART CALCULATIONS
// ---------------------------------------------------------------------
const cartTotalQty = computed(() =>
  props.cartItems.reduce((sum, item) => sum + (item.qty || 1), 0)
);

const cartSubtotal = computed(() =>
  props.cartItems.reduce((sum, item) => sum + (item.price * (item.qty || 1)), 0)
);

// ---------------------------------------------------------------------
// PROFILE DATA & PASSWORD
// ---------------------------------------------------------------------
const userFormData = ref({
  name: props.user.name || 'Siti Rahma',
  email: props.user.email || 'siti.rahma@example.com',
  phone: props.user.phone || '081234567890',
  birthDate: props.user.birthDate || '1998-05-14',
  gender: props.user.gender || 'Wanita',
});

function saveProfileInfo() {
  emit('update:user', {
    ...props.user,
    ...userFormData.value,
  });
  emit('toast', 'Informasi data diri berhasil disimpan!');
}

const passwordForm = ref({
  oldPassword: '',
  newPassword: '',
  confirmPassword: '',
});

function saveNewPassword() {
  if (passwordForm.value.newPassword !== passwordForm.value.confirmPassword) {
    emit('toast', 'Konfirmasi kata sandi baru tidak cocok');
    return;
  }
  emit('toast', 'Kata sandi akun Anda berhasil diperbarui!');
  passwordForm.value = { oldPassword: '', newPassword: '', confirmPassword: '' };
  switchTab('addresses');
}

// ---------------------------------------------------------------------
// AVATAR UPLOAD
// ---------------------------------------------------------------------
function triggerAvatarUpload() {
  fileInputRef.value?.click();
}

function onAvatarSelected(e) {
  const file = e.target.files?.[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (uploadEvent) => {
      const newAvatarUrl = uploadEvent.target?.result;
      if (newAvatarUrl) {
        emit('update:user', {
          ...props.user,
          avatar: newAvatarUrl,
        });
        emit('toast', 'Foto profil berhasil diperbarui!');
      }
    };
    reader.readAsDataURL(file);
  }
}

function handleLogout() {
  if (confirm('Apakah Anda ingin keluar dari akun ini?')) {
    emit('logout');
  }
}
</script>
