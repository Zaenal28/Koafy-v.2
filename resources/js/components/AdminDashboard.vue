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
              <span>Target: Rp 150.000.000</span>
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
                    <strong class="order-total">Rp {{ formatRupiah(order.total) }}</strong>
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
           TAB 3: PRODUK & KATALOG (REF GAMBAR MANAJEMEN PRODUK & KATALOG)
           ================================================================= -->
      <section v-else-if="currentTab === 'products'" class="admin-tab-body">
        <div class="admin-card-table-wrap">

          <!-- Top Bar: Header Title + Subtitle + Admin Pill -->
          <div class="catalog-manage-header">
            <div>
              <h2 class="card-table-title" style="font-size: 20px; font-weight: 800; color: #111827; margin: 0;">Manajemen Produk &amp; Katalog</h2>
              <p class="card-table-subtitle" style="font-size: 13px; color: #6B7280; margin: 4px 0 0 0;">Kelola operasional e-commerce real-time</p>
            </div>
            <div class="header-admin-pill">
              <span class="admin-avatar-mini">👤</span>
              <span class="admin-pill-name">Admin</span>
            </div>
          </div>

          <!-- Controls Bar: Search + Category Filter + Add Product Button -->
          <div class="catalog-controls-bar">
            <div class="controls-left">
              <!-- Search Input -->
              <div class="search-box-wrap">
                <svg class="search-box-icon" width="16" height="16" fill="none" stroke="#9CA3AF" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input
                  v-model="productSearchQuery"
                  type="text"
                  placeholder="Cari produk / SKU.."
                  class="catalog-search-input"
                />
              </div>

              <!-- Category Dropdown Filter -->
              <div class="category-select-wrap">
                <select v-model="selectedCategoryFilter" class="catalog-cat-select" aria-label="Filter Kategori">
                  <option value="all">-- Semua Kategori --</option>
                  <option value="Skincare">Skincare</option>
                  <option value="Makeup">Makeup</option>
                  <option value="Hair Care">Hair Care</option>
                  <option value="Body Care">Body Care</option>
                </select>
              </div>
            </div>

            <!-- Add Product Button (Pink) -->
            <button
              type="button"
              class="btn-add-product-pink"
              @click="openAddProductModal"
            >
              + Tambah Produk Baru
            </button>
          </div>

          <!-- Table Container (Responsive) -->
          <div class="table-responsive catalog-table-scroll">
            <table class="catalog-admin-table">
              <thead>
                <tr>
                  <th class="th-sortable" @click="handleProductSort('name')">
                    <span>Produk</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('sku')">
                    <span>SKU</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('category')">
                    <span>Kategori</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('normalPrice')">
                    <span>Harga Normal</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('discountPrice')">
                    <span>Harga Diskon</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('stock')">
                    <span>Stok</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('status')">
                    <span>Status</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('tglMasuk')">
                    <span>Tgl Masuk</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('tglExpired')">
                    <span>Tgl Expired</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('masaBerlaku')">
                    <span>Masa Berlaku</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-sortable" @click="handleProductSort('statusExpired')">
                    <span>Status Expired</span>
                    <span class="sort-arrows">↑↓</span>
                  </th>
                  <th class="th-actions">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="prod in paginatedProducts" :key="prod.id">
                  <!-- 1. Produk (Image + Name) -->
                  <td>
                    <div class="product-cell-group">
                      <img :src="prod.image" :alt="prod.name" class="table-product-thumb" />
                      <span class="table-product-name" :title="prod.name">{{ prod.name }}</span>
                    </div>
                  </td>

                  <!-- 2. SKU -->
                  <td>
                    <span class="sku-cell-text">{{ prod.sku }}</span>
                  </td>

                  <!-- 3. Kategori -->
                  <td>
                    <span class="cat-cell-text">{{ prod.category }}</span>
                  </td>

                  <!-- 4. Harga Normal -->
                  <td>
                    <span class="price-normal-cell">{{ prod.normalPriceFormatted }}</span>
                  </td>

                  <!-- 5. Harga Diskon (Pink Rose) -->
                  <td>
                    <span class="price-discount-cell">{{ prod.discountPriceFormatted }}</span>
                  </td>

                  <!-- 6. Stok (Green or Red if <= 5) -->
                  <td>
                    <span :class="['stock-badge-cell', prod.stock <= 5 ? 'danger' : 'safe']">
                      {{ prod.stock }} PCS
                    </span>
                  </td>

                  <!-- 7. Status (ACTIVE pill) -->
                  <td>
                    <button
                      type="button"
                      class="btn-status-active-pill"
                      :class="{ inactive: prod.status !== 'ACTIVE' }"
                      :title="'Klik untuk toggle status'"
                      @click="toggleProductActive(prod)"
                    >
                      {{ prod.status }}
                    </button>
                  </td>

                  <!-- 8. Tgl Masuk -->
                  <td>
                    <span class="date-cell-text">{{ prod.tglMasuk }}</span>
                  </td>

                  <!-- 9. Tgl Expired -->
                  <td>
                    <span class="date-cell-text">{{ prod.tglExpired }}</span>
                  </td>

                  <!-- 10. Masa Berlaku -->
                  <td>
                    <span class="remaining-cell-text">{{ prod.masaBerlaku }}</span>
                  </td>

                  <!-- 11. Status Expired (SAFE, WARNING, DANGER, EXPIRED) -->
                  <td>
                    <span :class="['expired-status-pill', prod.statusExpired.toLowerCase()]">
                      {{ prod.statusExpired }}
                    </span>
                  </td>

                  <!-- 12. Aksi (3 icons: Eye, Pencil, Trash) -->
                  <td>
                    <div class="row-actions-group">
                      <!-- View / Eye -->
                      <button
                        type="button"
                        class="icon-action-btn view"
                        title="Lihat Detail Produk"
                        @click="openViewProductModal(prod)"
                      >
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                      </button>

                      <!-- Edit / Pencil -->
                      <button
                        type="button"
                        class="icon-action-btn edit"
                        title="Edit Produk"
                        @click="openEditProductModal(prod)"
                      >
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </button>

                      <!-- Delete / Trash -->
                      <button
                        type="button"
                        class="icon-action-btn delete"
                        title="Hapus Produk"
                        @click="deleteCatalogProduct(prod)"
                      >
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>

                <tr v-if="filteredCatalogProducts.length === 0">
                  <td colspan="12" style="text-align: center; padding: 40px; color: #9CA3AF;">
                    Tidak ada produk yang cocok dengan pencarian atau filter kategori.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Table Footer: entries per page, showing entries, pagination (Ref Gambar) -->
          <div class="catalog-table-footer">
            <div class="footer-entries-select">
              <select v-model.number="entriesPerPage" class="entries-select" aria-label="Entries per page">
                <option :value="5">5</option>
                <option :value="8">8</option>
                <option :value="10">10</option>
                <option :value="25">25</option>
              </select>
              <span>entries per page</span>
            </div>

            <div class="footer-showing-info">
              Showing <strong>{{ showingStart }}</strong> to <strong>{{ showingEnd }}</strong> of <strong>{{ filteredCatalogProducts.length }}</strong> entries
            </div>

            <div class="footer-pagination">
              <button
                type="button"
                class="pag-btn"
                :disabled="currentPage <= 1"
                @click="currentPage = 1"
              >
                &laquo;
              </button>
              <button
                type="button"
                class="pag-btn"
                :disabled="currentPage <= 1"
                @click="currentPage--"
              >
                &lsaquo;
              </button>
              <button
                v-for="page in totalPages"
                :key="page"
                type="button"
                class="pag-btn page-num"
                :class="{ active: currentPage === page }"
                @click="currentPage = page"
              >
                {{ page }}
              </button>
              <button
                type="button"
                class="pag-btn"
                :disabled="currentPage >= totalPages"
                @click="currentPage++"
              >
                &rsaquo;
              </button>
              <button
                type="button"
                class="pag-btn"
                :disabled="currentPage >= totalPages"
                @click="currentPage = totalPages"
              >
                &raquo;
              </button>
            </div>
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
                  <td><strong style="color:#F51487;">Rp {{ formatRupiah(ord.total) }}</strong></td>
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
                  <td><strong>Rp {{ formatRupiah(cust.totalSpent) }}</strong> ({{ cust.orderCount }} pesanan)</td>
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

    <!-- MODAL TAMBAH / EDIT PRODUK KATALOG (REF GAMBAR) -->
    <div v-if="isProductModalOpen" class="admin-modal-backdrop" @click="isProductModalOpen = false">
      <div class="admin-modal-card" @click.stop style="max-width: 580px;">
        <div class="admin-modal-header">
          <h3>{{ editingProduct ? 'Edit Data Produk & Katalog' : 'Tambah Produk Baru' }}</h3>
          <button type="button" class="modal-close-btn" @click="isProductModalOpen = false">✕</button>
        </div>

        <form class="admin-modal-form" @submit.prevent="saveProductForm">
          <div class="form-group">
            <label class="form-label">Nama Produk*</label>
            <input
              v-model="productForm.name"
              type="text"
              required
              placeholder="cth. Koafy Rose Hydrating Serum 50ml"
              class="form-control"
            />
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Kode SKU*</label>
              <input
                v-model="productForm.sku"
                type="text"
                required
                placeholder="cth. KFY-SER-001"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Kategori Produk*</label>
              <select v-model="productForm.category" required class="form-control" style="background:#FFF;">
                <option value="Skincare">Skincare</option>
                <option value="Makeup">Makeup</option>
                <option value="Hair Care">Hair Care</option>
                <option value="Body Care">Body Care</option>
              </select>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Harga Normal*</label>
              <input
                v-model="productForm.normalPriceFormatted"
                type="text"
                required
                placeholder="Rp 320.000"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Harga Diskon*</label>
              <input
                v-model="productForm.discountPriceFormatted"
                type="text"
                required
                placeholder="Rp 269.000"
                class="form-control"
              />
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Jumlah Stok (PCS)*</label>
              <input
                v-model.number="productForm.stock"
                type="number"
                min="0"
                required
                placeholder="45"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Status Produk*</label>
              <select v-model="productForm.status" class="form-control" style="background:#FFF;">
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
              </select>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Tanggal Masuk (DD-MM-YYYY)*</label>
              <input
                v-model="productForm.tglMasuk"
                type="text"
                required
                placeholder="15-08-2026"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Tanggal Expired (DD-MM-YYYY)*</label>
              <input
                v-model="productForm.tglExpired"
                type="text"
                required
                placeholder="15-08-2029"
                class="form-control"
              />
            </div>
          </div>

          <div class="admin-modal-actions">
            <button type="button" class="btn-outline-sm" @click="isProductModalOpen = false">Batal</button>
            <button type="submit" class="btn-admin-pink">Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL PREVIEW DETAIL PRODUK (REF GAMBAR) -->
    <div v-if="isProductViewModalOpen" class="admin-modal-backdrop" @click="isProductViewModalOpen = false">
      <div class="admin-modal-card" @click.stop style="max-width: 520px;">
        <div class="admin-modal-header">
          <h3>Detail Produk &amp; Informasi Expired</h3>
          <button type="button" class="modal-close-btn" @click="isProductViewModalOpen = false">✕</button>
        </div>

        <div v-if="viewingProduct" style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; gap: 16px; align-items: center; padding-bottom: 14px; border-bottom: 1px solid #F3F4F6;">
            <img :src="viewingProduct.image" :alt="viewingProduct.name" style="width: 68px; height: 68px; border-radius: 12px; object-fit: cover; border: 1px solid #E5E7EB;" />
            <div>
              <h4 style="font-size: 16px; font-weight: 700; color: #111827; margin: 0 0 4px 0;">{{ viewingProduct.name }}</h4>
              <div style="display: flex; gap: 8px; align-items: center;">
                <span class="sku-cell-text" style="font-size: 12px; background: #F3F4F6; padding: 2px 8px; border-radius: 4px;">{{ viewingProduct.sku }}</span>
                <span class="cat-cell-text" style="font-size: 12px; font-weight: 600;">{{ viewingProduct.category }}</span>
              </div>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; font-size: 13px;">
            <div>
              <span style="color: #6B7280; display: block;">Harga Normal</span>
              <strong style="color: #374151;">{{ viewingProduct.normalPriceFormatted }}</strong>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Harga Diskon</span>
              <strong style="color: #D36279; font-size: 15px;">{{ viewingProduct.discountPriceFormatted }}</strong>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Jumlah Stok</span>
              <strong :class="[viewingProduct.stock <= 5 ? 'danger' : 'safe']" style="font-weight: 800;">{{ viewingProduct.stock }} PCS</strong>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Status Toko</span>
              <span class="btn-status-active-pill" style="display: inline-block; cursor: default;">{{ viewingProduct.status }}</span>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Tanggal Masuk</span>
              <span>{{ viewingProduct.tglMasuk }}</span>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Tanggal Expired</span>
              <span>{{ viewingProduct.tglExpired }}</span>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Masa Berlaku Tersisa</span>
              <strong style="color: #111827;">{{ viewingProduct.masaBerlaku }}</strong>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Status Expired</span>
              <span :class="['expired-status-pill', viewingProduct.statusExpired.toLowerCase()]">
                {{ viewingProduct.statusExpired }}
              </span>
            </div>
          </div>

          <div class="admin-modal-actions" style="margin-top: 10px;">
            <button type="button" class="btn-outline-sm" @click="isProductViewModalOpen = false">Tutup</button>
            <button
              type="button"
              class="btn-admin-pink"
              @click="openEditProductModal(viewingProduct); isProductViewModalOpen = false;"
            >
              Edit Produk Ini
            </button>
          </div>
        </div>
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

function formatRupiah(val) {
  return Number(val || 0).toLocaleString('id-ID');
}

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
    total: 288600,
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
    total: 175000,
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
    total: 185000,
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
    total: 210000,
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

// =========================================================================
// 3. DATA PRODUK & KATALOG (REF GAMBAR BARU MANAJEMEN PRODUK & KATALOG)
// =========================================================================
const productSearchQuery = ref('');
const selectedCategoryFilter = ref('all');
const sortField = ref('name');
const sortAsc = ref(true);
const entriesPerPage = ref(10);
const currentPage = ref(1);

const isProductModalOpen = ref(false);
const editingProduct = ref(null);
const isProductViewModalOpen = ref(false);
const viewingProduct = ref(null);

const productForm = ref({
  name: '',
  sku: '',
  category: 'Skincare',
  normalPriceFormatted: 'Rp 320.000',
  discountPriceFormatted: 'Rp 269.000',
  stock: 45,
  status: 'ACTIVE',
  tglMasuk: '15-08-2026',
  tglExpired: '15-08-2029',
  image: '/images/categories/serum-conseler.png',
});

// Hitung otomatis masa berlaku dan status expired
function calculateExpiry(expiredDateStr) {
  if (!expiredDateStr) return { durationText: '-', statusExpired: 'SAFE' };
  const parts = expiredDateStr.split('-');
  if (parts.length !== 3) return { durationText: '-', statusExpired: 'SAFE' };

  const expDay = parseInt(parts[0], 10);
  const expMonth = parseInt(parts[1], 10) - 1;
  const expYear = parseInt(parts[2], 10);
  const expDate = new Date(expYear, expMonth, expDay);

  const anchorDate = new Date(2026, 7, 15); // Anchor date: 15-08-2026
  const diffTime = expDate - anchorDate;

  if (diffTime <= 0) {
    return { durationText: '0 Thn, 0 Bln, 0 Hari', statusExpired: 'EXPIRED' };
  }

  let years = expDate.getFullYear() - anchorDate.getFullYear();
  let months = expDate.getMonth() - anchorDate.getMonth();
  let days = expDate.getDate() - anchorDate.getDate();

  if (days < 0) {
    months -= 1;
    const prevMonthDays = new Date(expDate.getFullYear(), expDate.getMonth(), 0).getDate();
    days += prevMonthDays;
  }
  if (months < 0) {
    years -= 1;
    months += 12;
  }

  const durationText = `${years} Thn, ${months} Bln, ${days} Hari`;

  let statusExpired = 'SAFE';
  if (years >= 2) {
    statusExpired = 'SAFE';
  } else if (years === 1) {
    statusExpired = 'WARNING';
  } else if (months >= 1 || days > 0) {
    statusExpired = 'DANGER';
  } else {
    statusExpired = 'EXPIRED';
  }

  return { durationText, statusExpired };
}

const catalogProducts = ref([
  {
    id: 'p-001',
    name: 'Koafy Rose Hydrating Serum 50ml',
    sku: 'KFY-SER-001',
    category: 'Skincare',
    normalPrice: 320000,
    normalPriceFormatted: 'Rp 320.000',
    discountPrice: 269000,
    discountPriceFormatted: 'Rp 269.000',
    stock: 45,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-08-2029',
    masaBerlaku: '3 Thn, 0 Bln, 0 Hari',
    statusExpired: 'SAFE',
    image: '/images/categories/serum-conseler.png',
  },
  {
    id: 'p-002',
    name: 'Skintific 5X Ceramide Barrier Moisture Gel 50g',
    sku: 'SKN-GEL-002',
    category: 'Skincare',
    normalPrice: 189000,
    normalPriceFormatted: 'Rp 189.000',
    discountPrice: 149000,
    discountPriceFormatted: 'Rp 149.000',
    stock: 82,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-08-2028',
    masaBerlaku: '2 Thn, 0 Bln, 0 Hari',
    statusExpired: 'SAFE',
    image: '/images/banner-healthy-barrier.jpg',
  },
  {
    id: 'p-003',
    name: 'Rose All Day Velvet Lip Whip - Soft Mauve',
    sku: 'RAD-LIP-003',
    category: 'Makeup',
    normalPrice: 129000,
    normalPriceFormatted: 'Rp 129.000',
    discountPrice: 99000,
    discountPriceFormatted: 'Rp 99.000',
    stock: 24,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-08-2027',
    masaBerlaku: '1 Thn, 0 Bln, 0 Hari',
    statusExpired: 'WARNING',
    image: '/images/product-lip-velvet.jpg',
  },
  {
    id: 'p-004',
    name: 'Somethinc Niacinamide + Moisture Sabi Beet Serum 20ml',
    sku: 'SMT-SER-004',
    category: 'Skincare',
    normalPrice: 115000,
    normalPriceFormatted: 'Rp 115.000',
    discountPrice: 89000,
    discountPriceFormatted: 'Rp 89.000',
    stock: 5,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-03-2027',
    masaBerlaku: '0 Thn, 7 Bln, 0 Hari',
    statusExpired: 'DANGER',
    image: '/images/categories/serum-conseler.png',
  },
  {
    id: 'p-005',
    name: 'Laneige Water Sleeping Mask EX 70ml',
    sku: 'LNG-MSK-005',
    category: 'Skincare',
    normalPrice: 450000,
    normalPriceFormatted: 'Rp 450.000',
    discountPrice: 385000,
    discountPriceFormatted: 'Rp 385.000',
    stock: 18,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-08-2026',
    masaBerlaku: '0 Thn, 0 Bln, 0 Hari',
    statusExpired: 'EXPIRED',
    image: '/images/categories/masker.png',
  },
  {
    id: 'p-006',
    name: 'COSRX Low pH Good Morning Gel Cleanser 150ml',
    sku: 'COS-CLN-006',
    category: 'Skincare',
    normalPrice: 155000,
    normalPriceFormatted: 'Rp 155.000',
    discountPrice: 119000,
    discountPriceFormatted: 'Rp 119.000',
    stock: 60,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '10-05-2026',
    masaBerlaku: '0 Thn, 0 Bln, 0 Hari',
    statusExpired: 'EXPIRED',
    image: '/images/categories/cleanser.png',
  },
  {
    id: 'p-007',
    name: 'Koafy Botanical Hair Repair Oil 100ml',
    sku: 'KFY-HIR-007',
    category: 'Hair Care',
    normalPrice: 249000,
    normalPriceFormatted: 'Rp 249.000',
    discountPrice: 215000,
    discountPriceFormatted: 'Rp 215.000',
    stock: 30,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '01-12-2029',
    masaBerlaku: '3 Thn, 3 Bln, 16 Hari',
    statusExpired: 'SAFE',
    image: '/images/product-butterbalm-1.jpg',
  },
  {
    id: 'p-008',
    name: 'Koafy Silk Glow Body Lotion 250ml',
    sku: 'KFY-BDY-008',
    category: 'Body Care',
    normalPrice: 199000,
    normalPriceFormatted: 'Rp 199.000',
    discountPrice: 169000,
    discountPriceFormatted: 'Rp 169.000',
    stock: 40,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '20-01-2027',
    masaBerlaku: '0 Thn, 5 Bln, 5 Hari',
    statusExpired: 'DANGER',
    image: '/images/product-butterbalm-2.jpg',
  },
]);

// Filter & Search Logic
const filteredCatalogProducts = computed(() => {
  let list = [...catalogProducts.value];

  // 1. Search filter
  const q = productSearchQuery.value.trim().toLowerCase();
  if (q) {
    list = list.filter(
      (p) =>
        p.name.toLowerCase().includes(q) ||
        p.sku.toLowerCase().includes(q) ||
        p.category.toLowerCase().includes(q)
    );
  }

  // 2. Category filter
  if (selectedCategoryFilter.value !== 'all') {
    list = list.filter((p) => p.category === selectedCategoryFilter.value);
  }

  // 3. Sorting
  const field = sortField.value;
  const isAsc = sortAsc.value;
  list.sort((a, b) => {
    let valA = a[field];
    let valB = b[field];

    if (typeof valA === 'string') {
      const cmp = valA.localeCompare(valB);
      return isAsc ? cmp : -cmp;
    }
    return isAsc ? valA - valB : valB - valA;
  });

  return list;
});

// Pagination
const totalPages = computed(() => {
  return Math.ceil(filteredCatalogProducts.value.length / entriesPerPage.value) || 1;
});

const paginatedProducts = computed(() => {
  const start = (currentPage.value - 1) * entriesPerPage.value;
  return filteredCatalogProducts.value.slice(start, start + entriesPerPage.value);
});

const showingStart = computed(() => {
  if (filteredCatalogProducts.value.length === 0) return 0;
  return (currentPage.value - 1) * entriesPerPage.value + 1;
});

const showingEnd = computed(() => {
  const end = currentPage.value * entriesPerPage.value;
  return Math.min(end, filteredCatalogProducts.value.length);
});

function handleProductSort(field) {
  if (sortField.value === field) {
    sortAsc.value = !sortAsc.value;
  } else {
    sortField.value = field;
    sortAsc.value = true;
  }
}

function toggleProductActive(prod) {
  prod.status = prod.status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
  emit('toast', `Status produk ${prod.name} diubah menjadi ${prod.status}`);
}

function deleteCatalogProduct(prod) {
  const idx = catalogProducts.value.findIndex((p) => p.id === prod.id);
  if (idx > -1) {
    catalogProducts.value.splice(idx, 1);
    emit('toast', `Produk "${prod.name}" berhasil dihapus dari katalog!`);
  }
}

function openAddProductModal() {
  editingProduct.value = null;
  productForm.value = {
    name: '',
    sku: `KFY-${Date.now().toString().slice(-4)}`,
    category: 'Skincare',
    normalPriceFormatted: 'Rp 200.000',
    discountPriceFormatted: 'Rp 160.000',
    stock: 20,
    status: 'ACTIVE',
    tglMasuk: '15-08-2026',
    tglExpired: '15-08-2029',
    image: '/images/categories/cleanser.png',
  };
  isProductModalOpen.value = true;
}

function openEditProductModal(prod) {
  editingProduct.value = prod;
  productForm.value = { ...prod };
  isProductModalOpen.value = true;
}

function openViewProductModal(prod) {
  viewingProduct.value = prod;
  isProductViewModalOpen.value = true;
}

function saveProductForm() {
  if (!productForm.value.name || !productForm.value.sku) return;

  const expiryInfo = calculateExpiry(productForm.value.tglExpired);

  // Parse numeric prices if needed for sorting
  const numNormal = parseInt(productForm.value.normalPriceFormatted.replace(/[^0-9]/g, ''), 10) || 0;
  const numDiscount = parseInt(productForm.value.discountPriceFormatted.replace(/[^0-9]/g, ''), 10) || 0;

  if (editingProduct.value) {
    Object.assign(editingProduct.value, {
      ...productForm.value,
      normalPrice: numNormal,
      discountPrice: numDiscount,
      masaBerlaku: expiryInfo.durationText,
      statusExpired: expiryInfo.statusExpired,
    });
    emit('toast', `Data produk "${productForm.value.name}" berhasil diperbarui!`);
  } else {
    catalogProducts.value.unshift({
      id: `p-${Date.now()}`,
      ...productForm.value,
      normalPrice: numNormal,
      discountPrice: numDiscount,
      masaBerlaku: expiryInfo.durationText,
      statusExpired: expiryInfo.statusExpired,
    });
    emit('toast', `Produk baru "${productForm.value.name}" berhasil ditambahkan!`);
  }

  isProductModalOpen.value = false;
}

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
  { code: 'KOAFY50K', amount: 'Rp 50.000', minSpend: 'Rp 150.000', claimed: 128, quota: 200 },
  { code: 'ROSEGLOW', amount: 'Diskon 25%', minSpend: 'Rp 200.000', claimed: 64, quota: 100 },
  { code: 'NEWBIE', amount: 'Gratis Ongkir', minSpend: 'Rp 100.000', claimed: 210, quota: 500 },
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
    totalSpent: 1240000,
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
    totalSpent: 620000,
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
    totalSpent: 1550000,
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
    totalSpent: 210000,
    orderCount: 1,
    joinDate: '16 Nov 2026',
  },
]);
</script>
