<template>
  <!-- =====================================================================
       ADMIN DASHBOARD - KOAFY BY HSK SECRET
       REFERENCE: IMAGE 2 SIDEBAR & CMS E-COMMERCE MANAGEMENT
       ROUTE: http://127.0.0.1:8000/admin
       ===================================================================== -->
  <div class="admin-layout-wrapper">
    <!-- Mobile Topbar with Hamburger Toggle -->
    <header class="admin-mobile-topbar">
      <button
        type="button"
        class="admin-hamburger-btn"
        aria-label="Toggle Sidebar Menu"
        @click="isMobileSidebarOpen = !isMobileSidebarOpen"
      >
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>

      <div class="admin-mobile-logo-group">
        <img src="/images/koafy-logo.png" alt="Koafy Logo" class="admin-logo-img" />
        <span class="admin-badge-pill">ADMIN</span>
      </div>

      <button
        type="button"
        class="admin-view-store-mobile"
        @click="$emit('go-to-store')"
      >
        🛒 Toko
      </button>
    </header>

    <!-- Sidebar Backdrop for Mobile -->
    <div
      v-if="isMobileSidebarOpen"
      class="admin-sidebar-backdrop"
      @click="isMobileSidebarOpen = false"
    ></div>

    <!-- SIDEBAR CONTAINER (EXACT MATCH REFERENCE IMAGE 2) -->
    <aside
      class="admin-sidebar"
      :class="{ 'mobile-open': isMobileSidebarOpen }"
    >
      <!-- Sidebar Brand Header -->
      <div class="admin-sidebar-header">
        <a href="#store" class="admin-brand-link" @click.prevent="$emit('go-to-store')">
          <img
            src="/images/koafy-logo.png"
            alt="Koafy by HSK Secret"
            class="admin-logo-img"
          />
        </a>
        <span class="admin-badge-pill">ADMIN</span>
      </div>

      <!-- Sidebar Navigation Menu Items -->
      <nav class="admin-sidebar-nav">
        <!-- 1. UTAMA -->
        <div class="sidebar-section-title">UTAMA</div>
        <ul class="sidebar-menu-list">
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'dashboard' }"
              @click="selectTab('dashboard')"
            >
              <!-- Dashboard Icon (4 rounded grid squares) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="2" />
                <rect x="14" y="3" width="7" height="7" rx="2" />
                <rect x="14" y="14" width="7" height="7" rx="2" />
                <rect x="3" y="14" width="7" height="7" rx="2" />
              </svg>
              <span>Dashboard</span>
            </button>
          </li>
        </ul>

        <!-- 2. CMS & E-COMMERCE -->
        <div class="sidebar-section-title">CMS &amp; E-COMMERCE</div>
        <ul class="sidebar-menu-list">
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'homepage-banner' }"
              @click="selectTab('homepage-banner')"
            >
              <!-- Homepage & Banner (Photo / Image Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="3" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <path d="M21 15l-5-5L5 21" />
              </svg>
              <span>Homepage &amp; Banner</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'faq' }"
              @click="selectTab('faq')"
            >
              <!-- Kelola FAQ (Question Circle Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9" />
                <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                <line x1="12" y1="17" x2="12.01" y2="17" />
              </svg>
              <span>Kelola FAQ</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'flash-sale' }"
              @click="selectTab('flash-sale')"
            >
              <!-- Kelola Flash Sale (Lightning Bolt Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
              </svg>
              <span>Kelola Flash Sale</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'rating' }"
              @click="selectTab('rating')"
            >
              <!-- Kelola Rating (Star Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
              </svg>
              <span>Kelola Rating</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'instagram' }"
              @click="selectTab('instagram')"
            >
              <!-- Kelola Instagram (Instagram Camera Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
              </svg>
              <span>Kelola Instagram</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'video' }"
              @click="selectTab('video')"
            >
              <!-- Kelola Video (Video Camera Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="23 7 16 12 23 17 23 7" />
                <rect x="1" y="5" width="15" height="14" rx="2" ry="2" />
              </svg>
              <span>Kelola Video</span>
            </button>
          </li>
        </ul>

        <!-- 3. KATALOG & STOK -->
        <div class="sidebar-section-title">KATALOG &amp; STOK</div>
        <ul class="sidebar-menu-list">
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'products' }"
              @click="selectTab('products')"
            >
              <!-- Produk & Katalog (Shopping Bag Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                <line x1="3" y1="6" x2="21" y2="6" />
                <path d="M16 10a4 4 0 01-8 0" />
              </svg>
              <span>Produk &amp; Katalog</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'categories' }"
              @click="selectTab('categories')"
            >
              <!-- Kelola Kategori (Layers Stack Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 2 7 12 12 22 7 12 2" />
                <polyline points="2 17 12 22 22 17" />
                <polyline points="2 12 12 17 22 12" />
              </svg>
              <span>Kelola Kategori</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'stock' }"
              @click="selectTab('stock')"
            >
              <!-- Stok & Inventori (Stacked Boxes Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="21 8 21 21 3 21 3 8" />
                <rect x="1" y="3" width="22" height="5" />
                <line x1="10" y1="12" x2="14" y2="12" />
              </svg>
              <span>Stok &amp; Inventori</span>
            </button>
          </li>
        </ul>

        <!-- 4. TRANSAKSI & KURIR -->
        <div class="sidebar-section-title">TRANSAKSI &amp; KURIR</div>
        <ul class="sidebar-menu-list">
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'orders' }"
              @click="selectTab('orders')"
            >
              <!-- Pesanan & Pembayaran (Credit Card Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2" />
                <line x1="1" y1="10" x2="23" y2="10" />
              </svg>
              <span>Pesanan &amp; Pembayar...</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'shipping' }"
              @click="selectTab('shipping')"
            >
              <!-- Pengiriman & Resi (Delivery Truck Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="1" y="3" width="15" height="13" />
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                <circle cx="5.5" cy="18.5" r="2.5" />
                <circle cx="18.5" cy="18.5" r="2.5" />
              </svg>
              <span>Pengiriman &amp; Resi</span>
            </button>
          </li>
        </ul>

        <!-- 5. PELANGGAN & MARKETING -->
        <div class="sidebar-section-title">PELANGGAN &amp; MARKETING</div>
        <ul class="sidebar-menu-list">
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'customers' }"
              @click="selectTab('customers')"
            >
              <!-- Data Pelanggan (Users Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87" />
                <path d="M16 3.13a4 4 0 010 7.75" />
              </svg>
              <span>Data Pelanggan</span>
            </button>
          </li>
          <li>
            <button
              type="button"
              class="sidebar-menu-item"
              :class="{ active: currentTab === 'vouchers' }"
              @click="selectTab('vouchers')"
            >
              <!-- Voucher & Promo (Ticket / Tag Outline) -->
              <svg class="sidebar-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                <line x1="7" y1="7" x2="7.01" y2="7" />
              </svg>
              <span>Voucher &amp; Promo</span>
            </button>
          </li>
        </ul>

        <!-- Bottom Quick Switch Back to Store -->
        <div class="sidebar-bottom-action">
          <button
            type="button"
            class="btn-exit-admin"
            @click="$emit('go-to-store')"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <span>Ke Toko E-Commerce</span>
          </button>
        </div>
      </nav>
    </aside>

    <!-- MAIN ADMIN CONTENT AREA -->
    <main class="admin-main-panel">
      <!-- Admin Top Navigation Bar -->
      <div class="admin-topbar">
        <div class="admin-topbar-left">
          <h1 class="admin-page-title">{{ tabTitle }}</h1>
          <p class="admin-page-subtitle">Kelola konten katalog, stok, dan penjualan toko Koafy by HSK Secret</p>
        </div>

        <div class="admin-topbar-right">
          <!-- Store Link Pill -->
          <button
            type="button"
            class="admin-top-btn store-btn"
            title="Buka Website E-Commerce"
            @click="$emit('go-to-store')"
          >
            <span>🛍️ Lihat Website Toko</span>
          </button>

          <!-- Search Bar -->
          <div class="admin-search-wrap">
            <svg width="16" height="16" fill="none" stroke="#9CA3AF" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input
              v-model="adminSearch"
              type="text"
              placeholder="Cari pesanan, produk, pelanggan..."
              class="admin-search-input"
            />
          </div>

          <!-- Notification Bell -->
          <button
            type="button"
            class="admin-top-icon-btn"
            title="3 Pesanan Baru Masuk"
            @click="$emit('toast', 'Ada 3 pesanan baru masuk menunggu konfirmasi')"
          >
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <span class="admin-notif-dot"></span>
          </button>

          <!-- Admin Avatar -->
          <div class="admin-user-pill">
            <div class="admin-user-avatar">AK</div>
            <div class="admin-user-info">
              <span class="admin-user-name">Admin Koafy</span>
              <span class="admin-user-role">Super Administrator</span>
            </div>
          </div>
        </div>
      </div>

      <!-- =================================================================
           TAB 1: DASHBOARD UTAMA
           ================================================================= -->
      <section v-if="currentTab === 'dashboard'" class="admin-tab-body">
        <!-- 4 Metric Cards -->
        <div class="admin-metrics-grid">
          <div class="metric-card">
            <div class="metric-card-header">
              <span class="metric-title">Total Penjualan Bulan Ini</span>
              <span class="metric-badge green">+18.4%</span>
            </div>
            <div class="metric-value">Rp 128.450.000</div>
            <div class="metric-footer">
              <span>Setara ~$8,420.00 USD</span>
              <span class="metric-subtext">Dari 142 transaksi lunas</span>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-card-header">
              <span class="metric-title">Pesanan &amp; Pengiriman</span>
              <span class="metric-badge pink">12 Perlu Kirim</span>
            </div>
            <div class="metric-value">142 Pesanan</div>
            <div class="metric-footer">
              <span>8 Menunggu Verifikasi</span>
              <span class="metric-subtext">122 Pesanan Selesai</span>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-card-header">
              <span class="metric-title">Pelanggan Terdaftar</span>
              <span class="metric-badge blue">+35 Member Baru</span>
            </div>
            <div class="metric-value">1,248 Member</div>
            <div class="metric-footer">
              <span>94% No WhatsApp Aktif</span>
              <span class="metric-subtext">82% Repeat Buyer</span>
            </div>
          </div>

          <div class="metric-card">
            <div class="metric-card-header">
              <span class="metric-title">Katalog &amp; Inventori</span>
              <span class="metric-badge orange">3 Butuh Restock</span>
            </div>
            <div class="metric-value">24 SKU Produk</div>
            <div class="metric-footer">
              <span>6 Kategori Aktif</span>
              <span class="metric-subtext">2 Banner Slider Aktif</span>
            </div>
          </div>
        </div>

        <!-- Quick Management Actions -->
        <div class="admin-quick-actions">
          <button type="button" class="quick-action-card" @click="selectTab('homepage-banner')">
            <span class="quick-action-icon">🖼️</span>
            <div class="quick-action-text">
              <strong>Homepage &amp; Banner</strong>
              <small>Kelola 2 slide banner hero, teks kampanye &amp; voucher</small>
            </div>
            <span class="quick-action-arrow">&rarr;</span>
          </button>

          <button type="button" class="quick-action-card" @click="selectTab('products')">
            <span class="quick-action-icon">💄</span>
            <div class="quick-action-text">
              <strong>Produk &amp; Katalog</strong>
              <small>Update harga, diskon harga coret, stok &amp; shade warna</small>
            </div>
            <span class="quick-action-arrow">&rarr;</span>
          </button>

          <button type="button" class="quick-action-card" @click="selectTab('vouchers')">
            <span class="quick-action-icon">🏷️</span>
            <div class="quick-action-text">
              <strong>Voucher &amp; Promo 50K</strong>
              <small>Kelola voucher potongan belanja &amp; flash sale</small>
            </div>
            <span class="quick-action-arrow">&rarr;</span>
          </button>
        </div>

        <!-- Recent Orders Table -->
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Pesanan &amp; Pembayaran Terbaru</h2>
              <p class="card-table-subtitle">Data transaksi masuk yang terhubung langsung dengan nomor WhatsApp pembeli</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="selectTab('orders')"
            >
              Lihat Semua Pesanan
            </button>
          </div>

          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>No. Pesanan</th>
                  <th>Pelanggan</th>
                  <th>No. WhatsApp</th>
                  <th>Produk Dipesan</th>
                  <th>Total Tagihan</th>
                  <th>Status Pesanan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in recentOrders" :key="order.id">
                  <td><strong class="order-id">{{ order.id }}</strong></td>
                  <td>
                    <div class="order-buyer">
                      <strong>{{ order.buyer }}</strong>
                      <small>{{ order.email }}</small>
                    </div>
                  </td>
                  <td>
                    <a
                      :href="`https://wa.me/${order.waNumber}?text=Halo%20${encodeURIComponent(order.buyer)},%20kami%20dari%20Koafy%20by%20HSK%20Secret%20mengenai%20pesanan%20${order.id}`"
                      target="_blank"
                      rel="noopener"
                      class="wa-link-badge"
                      title="Kirim pesan konfirmasi WhatsApp"
                    >
                      <span>💬 +62 {{ order.phone }}</span>
                    </a>
                  </td>
                  <td>
                    <div class="order-product-preview">
                      <span>{{ order.items }}</span>
                      <small v-if="order.shade" class="order-shade-pill">{{ order.shade }}</small>
                    </div>
                  </td>
                  <td>
                    <strong class="order-total">${{ order.total }}.00</strong>
                  </td>
                  <td>
                    <span :class="['status-pill', order.statusClass]">{{ order.status }}</span>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn-table-action"
                      @click="handleOrderAction(order)"
                    >
                      Kelola
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 2: HOMEPAGE & BANNER (CMS)
           ================================================================= -->
      <section v-else-if="currentTab === 'homepage-banner'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Kelola Banner Slider Beranda (Campaign)</h2>
              <p class="card-table-subtitle">Atur gambar banner, teks kampanye, voucher diskon, dan urutan slide</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', 'Fitur upload banner baru siap digunakan')"
            >
              + Tambah Slide Banner
            </button>
          </div>

          <div class="banner-cards-grid">
            <div v-for="(slide, idx) in heroSlides" :key="slide.id" class="banner-manage-card">
              <div class="banner-preview-img-wrap">
                <img :src="slide.image" :alt="slide.title" class="banner-preview-img" />
                <span class="banner-order-pill">Slide #{{ idx + 1 }}</span>
                <span v-if="slide.active" class="banner-status-pill active">Aktif Ditampilkan</span>
                <span v-else class="banner-status-pill">Nonaktif</span>
              </div>
              <div class="banner-card-info">
                <h3 class="banner-card-title">{{ slide.title }}</h3>
                <p class="banner-card-desc">{{ slide.subtitle }}</p>
                <div class="banner-meta-row">
                  <span class="meta-tag">Promo: {{ slide.badge }}</span>
                  <span class="meta-tag">Voucher: {{ slide.voucherValue }}</span>
                </div>
                <div class="banner-card-actions">
                  <button
                    type="button"
                    class="btn-outline-sm"
                    @click="toggleSlideStatus(slide)"
                  >
                    {{ slide.active ? 'Sembunyikan' : 'Aktifkan' }}
                  </button>
                  <button
                    type="button"
                    class="btn-admin-pink-sm"
                    @click="$emit('toast', `Menyimpan pengaturan Slide ${idx + 1}`)"
                  >
                    Edit Teks &amp; Gambar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 3: PRODUK & KATALOG
           ================================================================= -->
      <section v-else-if="currentTab === 'products'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Kelola Katalog Produk</h2>
              <p class="card-table-subtitle">Daftar produk, harga normal, harga coret diskon, stok dan shade</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', 'Form tambah produk baru dibuka')"
            >
              + Tambah Produk Baru
            </button>
          </div>

          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>Kategori</th>
                  <th>Harga Saat Ini</th>
                  <th>Harga Coret</th>
                  <th>Diskon</th>
                  <th>Pilihan Shade</th>
                  <th>Stok</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="prod in catalogProducts" :key="prod.id">
                  <td>
                    <div class="product-cell-info">
                      <div class="product-thumb-avatar">
                        <img :src="prod.image" :alt="prod.name" />
                      </div>
                      <div>
                        <strong>{{ prod.name }}</strong>
                        <small>{{ prod.brand }} &bull; {{ prod.volume }}</small>
                      </div>
                    </div>
                  </td>
                  <td><span class="cat-pill">{{ prod.category }}</span></td>
                  <td><strong style="color:#F51487;">${{ prod.price }}.00</strong></td>
                  <td><span class="price-strikethrough">${{ prod.originalPrice }}.00</span></td>
                  <td><span class="discount-badge-table">-{{ prod.discountPercent }}%</span></td>
                  <td>
                    <span v-if="prod.hasShades" class="badge-shades">✓ 3 Shade Warna</span>
                    <span v-else class="text-muted-sm">-</span>
                  </td>
                  <td>
                    <span :class="['stock-pill', prod.stock < 15 ? 'low' : 'ok']">
                      {{ prod.stock }} pcs
                    </span>
                  </td>
                  <td>
                    <button
                      type="button"
                      class="btn-table-action"
                      @click="$emit('toast', `Mengedit produk ${prod.name}`)"
                    >
                      Edit
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 4: KELOLA KATEGORI
           ================================================================= -->
      <section v-else-if="currentTab === 'categories'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Kelola 6 Kategori Produk</h2>
              <p class="card-table-subtitle">Kategori resmi dengan tone warna Cushion rose-pink Koafy</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', 'Tambah kategori baru')"
            >
              + Tambah Kategori
            </button>
          </div>

          <div class="admin-category-grid">
            <div v-for="cat in categoriesList" :key="cat.name" class="category-admin-card">
              <div class="cat-admin-img-wrap">
                <img :src="cat.image" :alt="cat.name" />
              </div>
              <div class="cat-admin-content">
                <h3>{{ cat.name }}</h3>
                <p>{{ cat.itemCount }} Produk Terdaftar</p>
                <button
                  type="button"
                  class="btn-outline-sm"
                  @click="$emit('toast', `Kategori ${cat.name} diperbarui`)"
                >
                  Kelola Kategori
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 5: KELOLA FLASH SALE (REF IMAGES 1 & 2)
           ================================================================= -->
      <section v-else-if="currentTab === 'flash-sale'" class="admin-tab-body">
        <!-- 1. MASTER TOGGLE SWITCH: AKTIF / NONAKTIFKAN DARI E-COMMERCE -->
        <div class="flash-sale-master-card" :class="{ inactive: !isFlashSaleActive }">
          <div class="master-card-info">
            <div class="master-card-icon-badge">
              <span>⚡</span>
            </div>
            <div>
              <div class="master-card-status-row">
                <h3 class="master-card-title">Tampilan Section Flash Sale di Website E-Commerce</h3>
                <span :class="['status-pill', isFlashSaleActive ? 'green' : 'orange']">
                  {{ isFlashSaleActive ? '🟢 SEDANG AKTIF (TAMPIL DI WEB)' : '⚪ NONAKTIF (DISEMBUNYIKAN)' }}
                </span>
              </div>
              <p class="master-card-desc">
                {{ isFlashSaleActive
                  ? 'Section Flash Sale beserta hitung mundur saat ini aktif dan dapat dilihat oleh pelanggan di halaman beranda toko.'
                  : 'Section Flash Sale saat ini dinonaktifkan dan disembunyikan sepenuhnya dari halaman beranda toko.' }}
              </p>
            </div>
          </div>

          <div class="master-card-action">
            <button
              type="button"
              :class="['btn-master-toggle', isFlashSaleActive ? 'btn-toggle-off' : 'btn-toggle-on']"
              @click="toggleFlashSaleMaster"
            >
              <span v-if="isFlashSaleActive">✕ Nonaktifkan dari Website</span>
              <span v-else>✓ Aktifkan di Website</span>
            </button>
          </div>
        </div>

        <!-- 2. TABLE DATA PRODUK FLASH SALE (EXACT MATCH REF IMAGE 2) -->
        <div class="admin-card-table-wrap">
          <div class="flash-table-top-bar">
            <!-- Search Input (Ref Image 2 Left) -->
            <div class="flash-search-input-wrap">
              <svg width="16" height="16" fill="none" stroke="#9CA3AF" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
              </svg>
              <input
                v-model="flashSaleSearch"
                type="text"
                placeholder="Cari produk flash sale..."
                class="flash-search-input"
              />
            </div>

            <!-- Button Tambah Produk Flash Sale (Ref Image 2 Right) -->
            <button
              type="button"
              class="btn-admin-pink"
              @click="openAddModal"
            >
              + Tambah Produk Flash Sale
            </button>
          </div>

          <!-- Table matching Image 2 -->
          <div class="table-responsive">
            <table class="admin-table flash-table">
              <thead>
                <tr>
                  <th>Produk &uarr;&darr;</th>
                  <th>Harga Asli</th>
                  <th>Harga Flash Sale &uarr;&darr;</th>
                  <th>Diskon %</th>
                  <th>Batas Stok FS &uarr;&darr;</th>
                  <th>Terjual &uarr;&darr;</th>
                  <th>Status &uarr;&darr;</th>
                  <th style="text-align: right;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in filteredFlashSaleItems" :key="item.id">
                  <!-- Produk -->
                  <td>
                    <div class="flash-prod-cell">
                      <div class="flash-prod-thumb">
                        <img :src="item.image" :alt="item.name" />
                      </div>
                      <span class="flash-prod-name">{{ item.name }}</span>
                    </div>
                  </td>

                  <!-- Harga Asli (strikethrough) -->
                  <td>
                    <span class="price-strikethrough-fs">{{ item.originalPriceFormatted }}</span>
                  </td>

                  <!-- Harga Flash Sale -->
                  <td>
                    <strong class="price-highlight-fs">{{ item.flashPriceFormatted }}</strong>
                  </td>

                  <!-- Diskon % -->
                  <td>
                    <span class="discount-pill-fs">-{{ item.discountPercent }}%</span>
                  </td>

                  <!-- Batas Stok FS -->
                  <td>
                    <span class="stock-text-fs">{{ item.quotaStock }} pcs</span>
                  </td>

                  <!-- Terjual (e.g. 8 dari 10 pcs + bar) -->
                  <td>
                    <div class="sold-cell-wrap">
                      <span class="sold-count-text">{{ item.soldCount }} dari {{ item.quotaStock }} pcs</span>
                      <div class="sold-progress-track">
                        <div
                          class="sold-progress-fill"
                          :style="{ width: `${Math.min(100, Math.round((item.soldCount / item.quotaStock) * 100))}%` }"
                        ></div>
                      </div>
                    </div>
                  </td>

                  <!-- Status -->
                  <td>
                    <button
                      type="button"
                      :class="['status-pill-btn', item.active ? 'active' : 'inactive']"
                      :title="item.active ? 'Klik untuk nonaktifkan produk ini' : 'Klik untuk aktifkan produk ini'"
                      @click="toggleItemStatus(item)"
                    >
                      {{ item.active ? 'AKTIF' : 'NONAKTIF' }}
                    </button>
                  </td>

                  <!-- Aksi: Edit & Delete (Ref Image 2) -->
                  <td style="text-align: right;">
                    <div class="actions-icon-group">
                      <!-- Edit Icon (Square with pencil) -->
                      <button
                        type="button"
                        class="btn-icon-action edit"
                        title="Edit Produk Flash Sale"
                        @click="openEditModal(item)"
                      >
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </button>

                      <!-- Delete Icon (Trash) -->
                      <button
                        type="button"
                        class="btn-icon-action delete"
                        title="Hapus dari Flash Sale"
                        @click="deleteItem(item)"
                      >
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 5B: KELOLA VOUCHER & PROMO
           ================================================================= -->
      <section v-else-if="currentTab === 'vouchers'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Kelola Voucher Diskon &amp; Promo Member</h2>
              <p class="card-table-subtitle">Atur kuota klaim voucher 50K dan program diskon spesial</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', 'Buat kode promo/voucher baru')"
            >
              + Buat Voucher Baru
            </button>
          </div>

          <div class="vouchers-admin-grid">
            <div v-for="vc in vouchersList" :key="vc.code" class="voucher-admin-card">
              <div class="voucher-badge-top">VOUCHER MEMBER</div>
              <div class="voucher-code-title">{{ vc.code }}</div>
              <div class="voucher-discount-val">Potongan {{ vc.amount }}</div>
              <div class="voucher-rules">Min. Belanja: {{ vc.minSpend }}</div>
              <div class="voucher-status-row">
                <span>Kuota: <strong>{{ vc.claimed }} / {{ vc.quota }} Klaim</strong></span>
                <span class="status-pill green">Aktif</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 6: PESANAN & TRANSAKSI
           ================================================================= -->
      <section v-else-if="currentTab === 'orders' || currentTab === 'shipping'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Daftar Semua Pesanan Masuk</h2>
              <p class="card-table-subtitle">Integrasi pembayaran, kurir pengiriman resi (J&amp;T, SiCepat), dan notifikasi WhatsApp</p>
            </div>
            <div class="table-filter-group">
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'all' }]"
                @click="orderFilter = 'all'"
              >
                Semua
              </button>
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'paid' }]"
                @click="orderFilter = 'paid'"
              >
                Lunas (Diproses)
              </button>
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'shipping' }]"
                @click="orderFilter = 'shipping'"
              >
                Dikirim
              </button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>No. Pesanan</th>
                  <th>Tanggal</th>
                  <th>Pelanggan</th>
                  <th>Nomor WhatsApp</th>
                  <th>Item Produk</th>
                  <th>Kurir &amp; Resi</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="ord in filteredOrders" :key="ord.id">
                  <td><strong>{{ ord.id }}</strong></td>
                  <td>{{ ord.date }}</td>
                  <td>
                    <strong>{{ ord.buyer }}</strong>
                  </td>
                  <td>
                    <a
                      :href="`https://wa.me/${ord.waNumber}`"
                      target="_blank"
                      rel="noopener"
                      class="wa-link-badge"
                    >
                      💬 +62 {{ ord.phone }}
                    </a>
                  </td>
                  <td>{{ ord.items }}</td>
                  <td>
                    <span class="resi-badge">{{ ord.courier }}: {{ ord.trackingNo }}</span>
                  </td>
                  <td><strong style="color:#F51487;">${{ ord.total }}.00</strong></td>
                  <td>
                    <span :class="['status-pill', ord.statusClass]">{{ ord.status }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 7: DATA PELANGGAN
           ================================================================= -->
      <section v-else-if="currentTab === 'customers'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">Data Pelanggan &amp; Member Terdaftar</h2>
              <p class="card-table-subtitle">Data member lengkap dengan nomor telepon / WhatsApp yang diinput saat pendaftaran</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', 'Export data pelanggan ke Excel/CSV')"
            >
              📥 Export Data
            </button>
          </div>

          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>ID Member</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>No. WhatsApp / Telepon</th>
                  <th>Tier Member</th>
                  <th>Total Belanja</th>
                  <th>Terdaftar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="cust in customersList" :key="cust.id">
                  <td><strong>#{{ cust.id }}</strong></td>
                  <td>
                    <div class="order-buyer">
                      <strong>{{ cust.name }}</strong>
                    </div>
                  </td>
                  <td>{{ cust.email }}</td>
                  <td>
                    <a
                      :href="`https://wa.me/${cust.waNumber}`"
                      target="_blank"
                      rel="noopener"
                      class="wa-link-badge"
                    >
                      💬 +62 {{ cust.phone }}
                    </a>
                  </td>
                  <td><span class="status-pill pink">{{ cust.tier }}</span></td>
                  <td><strong>${{ cust.totalSpent }}.00</strong> ({{ cust.orderCount }} pesanan)</td>
                  <td>{{ cust.joinDate }}</td>
                  <td>
                    <button
                      type="button"
                      class="btn-table-action"
                      @click="$emit('toast', `Detail pelanggan ${cust.name}`)"
                    >
                      Detail
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- =================================================================
           TAB 8: KELOLA FAQ, RATING, INSTAGRAM, VIDEO
           ================================================================= -->
      <section v-else class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">{{ tabTitle }}</h2>
              <p class="card-table-subtitle">Modul manajemen CMS e-commerce Koafy</p>
            </div>
            <button
              type="button"
              class="btn-admin-pink"
              @click="$emit('toast', `Data ${tabTitle} berhasil disimpan`)"
            >
              + Tambah Konten Baru
            </button>
          </div>

          <div class="cms-placeholder-card">
            <div class="placeholder-icon">⚙️</div>
            <h3>Modul {{ tabTitle }} Siap Digunakan</h3>
            <p>Fitur pengelolaan live terintegrasi dengan komponen frontend website Koafy by HSK Secret.</p>
            <button
              type="button"
              class="btn-admin-pink"
              style="margin-top: 14px;"
              @click="$emit('toast', `Sinkronisasi data ${tabTitle} ke live store berhasil!`)"
            >
              Sinkronkan ke Toko Live
            </button>
          </div>
        </div>
      </section>
    </main>

    <!-- MODAL TAMBAH / EDIT PRODUK FLASH SALE (REF IMAGE 2) -->
    <div v-if="isAddModalOpen" class="admin-modal-backdrop" @click="isAddModalOpen = false">
      <div class="admin-modal-card" @click.stop>
        <div class="admin-modal-header">
          <h3>{{ editingItem ? 'Edit Produk Flash Sale' : 'Tambah Produk ke Flash Sale' }}</h3>
          <button type="button" class="modal-close-btn" @click="isAddModalOpen = false">✕</button>
        </div>

        <form class="admin-modal-form" @submit.prevent="saveFlashSaleItem">
          <div class="form-group">
            <label class="form-label">Nama Produk*</label>
            <input
              v-model="newItemForm.name"
              type="text"
              required
              placeholder="cth. Koafy Crystal Butterbalm Tint"
              class="form-control"
            />
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Harga Asli (Coret)*</label>
              <input
                v-model="newItemForm.originalPriceFormatted"
                type="text"
                required
                placeholder="Rp 190.000"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Harga Flash Sale*</label>
              <input
                v-model="newItemForm.flashPriceFormatted"
                type="text"
                required
                placeholder="Rp 146.510"
                class="form-control"
              />
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Diskon %</label>
              <input
                v-model.number="newItemForm.discountPercent"
                type="number"
                min="1"
                max="99"
                required
                placeholder="23"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Batas Kuota Stok FS (pcs)*</label>
              <input
                v-model.number="newItemForm.quotaStock"
                type="number"
                min="1"
                required
                placeholder="10"
                class="form-control"
              />
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Status Produk di Flash Sale</label>
            <label class="form-checkbox-row">
              <input v-model="newItemForm.active" type="checkbox" class="checkbox-pink" />
              <span>Aktif ditampilkan dalam promo Flash Sale</span>
            </label>
          </div>

          <div class="admin-modal-actions">
            <button type="button" class="btn-outline-sm" @click="isAddModalOpen = false">Batal</button>
            <button type="submit" class="btn-admin-pink">Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  isFlashSaleActive: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(['go-to-store', 'toast', 'update:isFlashSaleActive']);

const isMobileSidebarOpen = ref(false);
const currentTab = ref('dashboard');
const adminSearch = ref('');
const orderFilter = ref('all');

// =========================================================================
// FLASH SALE MANAGEMENT STATE (REF IMAGE 2)
// =========================================================================
const flashSaleSearch = ref('');
const isAddModalOpen = ref(false);
const editingItem = ref(null);

const newItemForm = ref({
  name: '',
  originalPriceFormatted: 'Rp 190.000',
  flashPriceFormatted: 'Rp 146.510',
  discountPercent: 23,
  quotaStock: 10,
  soldCount: 0,
  image: '/images/product-butterbalm-1.jpg',
  active: true,
});

const flashSaleItems = ref([
  {
    id: 'fs-1',
    name: 'Koafy Rose Hydrating Serum 50ml',
    image: '/images/cat-serum-conseler.png',
    originalPriceFormatted: 'Rp 320.000',
    flashPriceFormatted: 'Rp 150.000',
    discountPercent: 53,
    quotaStock: 10,
    soldCount: 8,
    active: true,
  },
  {
    id: 'fs-2',
    name: 'Skintific 5X Ceramide Barrier Moisture Gel 50g',
    image: '/images/banner-healthy-barrier.jpg',
    originalPriceFormatted: 'Rp 189.000',
    flashPriceFormatted: 'Rp 99.000',
    discountPercent: 48,
    quotaStock: 15,
    soldCount: 13,
    active: true,
  },
  {
    id: 'fs-3',
    name: 'Rose All Day Velvet Lip Whip - Soft Mauve',
    image: '/images/product-lip-velvet.jpg',
    originalPriceFormatted: 'Rp 129.000',
    flashPriceFormatted: 'Rp 85.000',
    discountPercent: 34,
    quotaStock: 8,
    soldCount: 6,
    active: true,
  },
  {
    id: 'fs-4',
    name: 'Koafy Crystal Butterbalm Tint — Rosewood Glow',
    image: '/images/product-butterbalm-1.jpg',
    originalPriceFormatted: 'Rp 190.000',
    flashPriceFormatted: 'Rp 146.510',
    discountPercent: 23,
    quotaStock: 12,
    soldCount: 10,
    active: true,
  },
  {
    id: 'fs-5',
    name: 'Koafy Crystal Butterbalm Tint — Berry Mauve',
    image: '/images/product-butterbalm-2.jpg',
    originalPriceFormatted: 'Rp 190.000',
    flashPriceFormatted: 'Rp 146.510',
    discountPercent: 23,
    quotaStock: 15,
    soldCount: 11,
    active: true,
  },
  {
    id: 'fs-6',
    name: 'Koafy Soft-Square Multi Balm Trio Compact',
    image: '/images/banner-koafy-trio.jpg',
    originalPriceFormatted: 'Rp 255.000',
    flashPriceFormatted: 'Rp 200.000',
    discountPercent: 24,
    quotaStock: 10,
    soldCount: 8,
    active: true,
  },
]);

const filteredFlashSaleItems = computed(() => {
  if (!flashSaleSearch.value.trim()) return flashSaleItems.value;
  const q = flashSaleSearch.value.toLowerCase();
  return flashSaleItems.value.filter((item) =>
    item.name.toLowerCase().includes(q)
  );
});

function toggleItemStatus(item) {
  item.active = !item.active;
  emit('toast', `Status ${item.name} diubah menjadi ${item.active ? 'AKTIF' : 'NONAKTIF'}`);
}

function deleteItem(item) {
  const idx = flashSaleItems.value.findIndex((x) => x.id === item.id);
  if (idx > -1) {
    flashSaleItems.value.splice(idx, 1);
    emit('toast', `${item.name} berhasil dihapus dari promo Flash Sale`);
  }
}

function openAddModal() {
  editingItem.value = null;
  newItemForm.value = {
    name: '',
    originalPriceFormatted: 'Rp 190.000',
    flashPriceFormatted: 'Rp 146.510',
    discountPercent: 23,
    quotaStock: 10,
    soldCount: 0,
    image: '/images/product-butterbalm-1.jpg',
    active: true,
  };
  isAddModalOpen.value = true;
}

function openEditModal(item) {
  editingItem.value = item;
  newItemForm.value = { ...item };
  isAddModalOpen.value = true;
}

function saveFlashSaleItem() {
  if (!newItemForm.value.name) return;
  if (editingItem.value) {
    Object.assign(editingItem.value, newItemForm.value);
    emit('toast', `Data flash sale "${editingItem.value.name}" berhasil diperbarui!`);
  } else {
    flashSaleItems.value.unshift({
      id: `fs-${Date.now()}`,
      ...newItemForm.value,
    });
    emit('toast', `Produk baru berhasil ditambahkan ke promo Flash Sale!`);
  }
  isAddModalOpen.value = false;
}

// Master Switch Toggle Flash Sale
function toggleFlashSaleMaster() {
  const nextVal = !props.isFlashSaleActive;
  emit('update:isFlashSaleActive', nextVal);
  emit('toast', nextVal ? 'Section Flash Sale diaktifkan dan tampil di beranda toko!' : 'Section Flash Sale dinonaktifkan dari beranda toko.');
}

function selectTab(tabKey) {
  currentTab.value = tabKey;
  isMobileSidebarOpen.value = false;
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

const tabTitle = computed(() => {
  const map = {
    'dashboard': 'Dashboard Ringkasan Toko',
    'homepage-banner': 'Kelola Homepage & Banner Hero',
    'faq': 'Kelola FAQ & Bantuan Pelanggan',
    'flash-sale': 'Kelola Flash Sale & Countdown Promo',
    'rating': 'Kelola Rating & Ulasan Bintang',
    'instagram': 'Kelola Feed Instagram & Social Hub',
    'video': 'Kelola Video & Reels Tutorial',
    'products': 'Kelola Produk & Katalog',
    'categories': 'Kelola Kategori Produk',
    'stock': 'Stok & Inventori Barang',
    'orders': 'Pesanan & Pembayaran',
    'shipping': 'Pengiriman & Resi Kurir',
    'customers': 'Data Pelanggan & WhatsApp Member',
    'vouchers': 'Voucher & Diskon Promo',
  };
  return map[currentTab.value] || 'Dashboard Admin';
});

// 1. Data Banner Slider
const heroSlides = ref([
  {
    id: 'slide-1',
    title: 'NEW LOOK: Healthy Barrier Solution',
    subtitle: 'Klaim Voucher Diskon 50K untuk produk barrier terlaris Koafy',
    image: '/images/banner-healthy-barrier.jpg',
    badge: 'Diskon 50K',
    voucherValue: 'Rp 50.000',
    active: true,
  },
  {
    id: 'slide-2',
    title: 'KOAFY BY HSK SECRET: The Next Level Cushion',
    subtitle: 'Formula eksklusif perawatan bibir & wajah dengan tone Cushion rose-pink',
    image: '/images/banner-koafy-trio.jpg',
    badge: 'Voucher 50K',
    voucherValue: 'Rp 50.000',
    active: true,
  },
]);

function toggleSlideStatus(slide) {
  slide.active = !slide.active;
  emit('toast', `Status banner "${slide.title}" diubah menjadi ${slide.active ? 'Aktif' : 'Nonaktif'}`);
}

// 2. Data Pesanan Terbaru
const recentOrders = ref([
  {
    id: 'ORD-2026-9081',
    buyer: 'Kayla Anindita',
    email: 'kayla.anindita@example.com',
    phone: '812-4567-8910',
    waNumber: '6281245678910',
    items: 'Koafy Crystal Butterbalm Duo',
    shade: 'Rosewood & Mauve',
    total: 68,
    status: 'Lunas (Perlu Dikirim)',
    statusClass: 'orange',
    courier: 'J&T Express',
    trackingNo: 'JT981245102',
    date: '17 Nov 2026, 08:30',
  },
  {
    id: 'ORD-2026-9080',
    buyer: 'Siti Rahmadani',
    email: 'siti.r@example.com',
    phone: '821-9988-1234',
    waNumber: '6282199881234',
    items: 'Koafy Velvet Lip & Brush Set',
    shade: 'Rosewood Matte',
    total: 38,
    status: 'Sedang Dikirim',
    statusClass: 'blue',
    courier: 'SiCepat BEST',
    trackingNo: 'SI881203491',
    date: '17 Nov 2026, 07:15',
  },
  {
    id: 'ORD-2026-9079',
    buyer: 'Amanda Clarissa',
    email: 'amanda.c@example.com',
    phone: '878-1122-3344',
    waNumber: '6287811223344',
    items: 'HSK Secret Glow Cushion SPF 50',
    shade: '02 Neutral Rose',
    total: 42,
    status: 'Selesai',
    statusClass: 'green',
    courier: 'J&T Express',
    trackingNo: 'JT980112348',
    date: '16 Nov 2026, 21:40',
  },
  {
    id: 'ORD-2026-9078',
    buyer: 'Nadia Putri',
    email: 'nadia.putri@example.com',
    phone: '813-7766-5544',
    waNumber: '6281377665544',
    items: 'Koafy Soft-Square Multi Balm Trio',
    shade: '3 Shades Set',
    total: 54,
    status: 'Menunggu Verifikasi',
    statusClass: 'pink',
    courier: 'GoSend Instant',
    trackingNo: 'GS1290341',
    date: '16 Nov 2026, 19:20',
  },
]);

const filteredOrders = computed(() => {
  if (orderFilter.value === 'paid') {
    return recentOrders.value.filter((o) => o.status.includes('Lunas'));
  }
  if (orderFilter.value === 'shipping') {
    return recentOrders.value.filter((o) => o.status.includes('Dikirim'));
  }
  return recentOrders.value;
});

function handleOrderAction(order) {
  emit('toast', `Membuka detail pesanan ${order.id} untuk ${order.buyer}`);
}

// 3. Data Produk Katalog
const catalogProducts = ref([
  {
    id: 'p1',
    name: 'Koafy Crystal Butterbalm Duo',
    brand: 'KOAFY BY HSK',
    volume: '2 x 4.5g',
    category: 'Lipbam',
    price: 68,
    originalPrice: 98,
    discountPercent: 30,
    hasShades: true,
    stock: 24,
    image: '/images/new-arrival-1.png',
  },
  {
    id: 'p2',
    name: 'HSK Secret Glow Cushion SPF 50',
    brand: 'HSK SECRET',
    volume: '15g + Refill',
    category: 'Cushion',
    price: 42,
    originalPrice: 65,
    discountPercent: 35,
    hasShades: true,
    stock: 8, // low
    image: '/images/cat-cushion.png',
  },
  {
    id: 'p3',
    name: 'Koafy Velvet Lip & Brush Set',
    brand: 'KOAFY BY HSK',
    volume: '4.5g',
    category: 'Lipbam',
    price: 38,
    originalPrice: 55,
    discountPercent: 30,
    hasShades: true,
    stock: 18,
    image: '/images/new-arrival-2.png',
  },
  {
    id: 'p4',
    name: 'Koafy Soft-Square Multi Balm Trio',
    brand: 'KOAFY BEAUTY',
    volume: '3 x 3.8g',
    category: 'Lipbam',
    price: 54,
    originalPrice: 85,
    discountPercent: 36,
    hasShades: true,
    stock: 12,
    image: '/images/new-arrival-3.png',
  },
  {
    id: 'p5',
    name: 'Skin Barrier Calm Liquid Foundation',
    brand: 'KOAFY LABS',
    volume: '30 ml',
    category: 'Liquid Pondation',
    price: 48,
    originalPrice: 70,
    discountPercent: 31,
    hasShades: true,
    stock: 35,
    image: '/images/cat-liquid-pondation.png',
  },
  {
    id: 'p6',
    name: 'Rose Hyaluronic Hydrating Cleanser',
    brand: 'HSK SECRET',
    volume: '120 ml',
    category: 'Cleanser',
    price: 28,
    originalPrice: 40,
    discountPercent: 30,
    hasShades: false,
    stock: 45,
    image: '/images/cat-cleanser.png',
  },
]);

// 4. Data 6 Kategori
const categoriesList = ref([
  { name: 'Cushion', itemCount: 12, image: '/images/cat-cushion.png' },
  { name: 'Liquid Pondation', itemCount: 8, image: '/images/cat-liquid-pondation.png' },
  { name: 'Serum Conseler', itemCount: 6, image: '/images/cat-serum-conseler.png' },
  { name: 'Lipbam', itemCount: 16, image: '/images/cat-lipbam.png' },
  { name: 'Cleanser', itemCount: 7, image: '/images/cat-cleanser.png' },
  { name: 'Masker', itemCount: 9, image: '/images/cat-masker.png' },
]);

// 5. Data Voucher Promo
const vouchersList = ref([
  { code: 'KOAFY50K', amount: 'Rp 50.000', minSpend: '$35.00', claimed: 128, quota: 200 },
  { code: 'ROSEGLOW', amount: 'Diskon 25%', minSpend: '$50.00', claimed: 64, quota: 100 },
  { code: 'NEWBIE', amount: 'Gratis Ongkir', minSpend: '$30.00', claimed: 210, quota: 500 },
]);

// 6. Data Pelanggan (dengan No WhatsApp dari form register)
const customersList = ref([
  {
    id: 'CUST-001',
    name: 'Kayla Anindita',
    email: 'kayla.anindita@example.com',
    phone: '812-4567-8910',
    waNumber: '6281245678910',
    tier: 'Rose VIP Member',
    totalSpent: 284,
    orderCount: 4,
    joinDate: '12 Nov 2026',
  },
  {
    id: 'CUST-002',
    name: 'Siti Rahmadani',
    email: 'siti.r@example.com',
    phone: '821-9988-1234',
    waNumber: '6282199881234',
    tier: 'Gold Member',
    totalSpent: 142,
    orderCount: 2,
    joinDate: '14 Nov 2026',
  },
  {
    id: 'CUST-003',
    name: 'Amanda Clarissa',
    email: 'amanda.c@example.com',
    phone: '878-1122-3344',
    waNumber: '6287811223344',
    tier: 'Rose VIP Member',
    totalSpent: 350,
    orderCount: 5,
    joinDate: '10 Nov 2026',
  },
  {
    id: 'CUST-004',
    name: 'Nadia Putri',
    email: 'nadia.putri@example.com',
    phone: '813-7766-5544',
    waNumber: '6281377665544',
    tier: 'Silver Member',
    totalSpent: 54,
    orderCount: 1,
    joinDate: '16 Nov 2026',
  },
]);
</script>
