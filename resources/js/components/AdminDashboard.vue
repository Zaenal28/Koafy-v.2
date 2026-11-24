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

          <!-- Notification Bell (Notif Transaksi Masuk) -->
          <div style="position: relative;">
            <button
              type="button"
              class="admin-top-icon-btn"
              :title="`${unreadNotifCount} Notifikasi Transaksi Baru`"
              @click="toggleNotifDropdown"
            >
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
              <span v-if="unreadNotifCount > 0" class="admin-notif-badge-count">{{ unreadNotifCount }}</span>
            </button>

            <!-- Dropdown Panel Notifikasi Transaksi -->
            <div v-if="isNotifDropdownOpen" class="admin-notif-dropdown-card" @click.stop>
              <div class="notif-dropdown-header">
                <div>
                  <strong>Notifikasi Transaksi Masuk</strong>
                  <small style="display:block; color:#6B7280; font-size:11px;">{{ unreadNotifCount }} transaksi menunggu dicek</small>
                </div>
                <button
                  v-if="unreadNotifCount > 0"
                  type="button"
                  class="btn-mark-all-read"
                  @click="markAllNotificationsRead"
                >
                  Tandai Dibaca
                </button>
              </div>

              <div class="notif-dropdown-list">
                <div
                  v-if="recentOrders.length === 0"
                  style="padding: 20px; text-align: center; color: #9CA3AF; font-size: 12.5px;"
                >
                  Belum ada notifikasi transaksi terbaru.
                </div>

                <div
                  v-for="ord in recentOrders.slice(0, 6)"
                  :key="'notif-' + ord.id"
                  class="notif-item-row"
                  :class="{ unread: !ord.is_notif_read }"
                  @click="openOrderFromNotif(ord)"
                >
                  <div class="notif-item-icon">🛍️</div>
                  <div class="notif-item-content">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                      <strong style="font-size:12.5px; color:#111827;">{{ ord.buyer }}</strong>
                      <span style="font-size:11px; color:#F51487; font-weight:700;">Rp {{ formatRupiah(ord.total) }}</span>
                    </div>
                    <div style="font-size:11.5px; color:#4B5563; margin: 2px 0;">
                      {{ ord.id }} • {{ ord.metode_pembayaran || 'Transfer BCA' }}
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                      <span class="notif-status-mini">{{ ord.status }}</span>
                      <small style="font-size:10.5px; color:#9CA3AF;">{{ ord.date }}</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Admin Avatar & JWT Info -->
          <div class="admin-user-pill">
            <div class="admin-user-avatar">AK</div>
            <div class="admin-user-info">
              <span class="admin-user-name">{{ adminUser.name || 'Admin Koafy' }}</span>
              <span class="admin-user-role">{{ adminUser.email || 'admin.koafy@gmail.com' }} • JWT</span>
            </div>
            <button
              type="button"
              class="btn-admin-logout-mini"
              title="Logout dari Sesi JWT Admin"
              @click="$emit('admin-logout')"
            >
              Keluar
            </button>
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
           TAB 6: PESANAN & TRANSAKSI + PENGIRIMAN & RESI MANUAL
           ================================================================= -->
      <section v-else-if="currentTab === 'orders' || currentTab === 'shipping'" class="admin-tab-body">
        <div class="admin-card-table-wrap">
          <div class="card-table-header">
            <div>
              <h2 class="card-table-title">
                {{ currentTab === 'shipping' ? 'Penyiapan, Pengiriman & Input Nomor Resi Manual' : 'Daftar Transaksi, Verifikasi Pembayaran & Cetak Slip Resi' }}
              </h2>
              <p class="card-table-subtitle">
                Cek bukti transfer, ubah status menjadi Pembayaran Berhasil, cetak resi slip barang, dan input nomor resi kurir secara manual
              </p>
            </div>
            <div class="table-filter-group">
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'all' }]"
                @click="orderFilter = 'all'"
              >
                Semua ({{ recentOrders.length }})
              </button>
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'pending' }]"
                @click="orderFilter = 'pending'"
              >
                Perlu Verifikasi
              </button>
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'paid' }]"
                @click="orderFilter = 'paid'"
              >
                Pembayaran Berhasil
              </button>
              <button
                type="button"
                :class="['filter-btn', { active: orderFilter === 'shipping' }]"
                @click="orderFilter = 'shipping'"
              >
                Sudah Dikirim
              </button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>No. Invoice</th>
                  <th>Tanggal</th>
                  <th>Pelanggan &amp; Alamat</th>
                  <th>No. WhatsApp</th>
                  <th>Barang &amp; Qty</th>
                  <th>Jasa Kirim &amp; No. Resi</th>
                  <th>Total Pembayaran</th>
                  <th>Status Pembayaran</th>
                  <th style="text-align: right;">Aksi Admin</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="ord in filteredOrders" :key="ord.id">
                  <td>
                    <strong style="color:#111827;">{{ ord.id }}</strong>
                    <span v-if="!ord.is_notif_read" class="new-notif-tag">BARU</span>
                  </td>
                  <td>{{ ord.date }}</td>
                  <td>
                    <div class="order-buyer">
                      <strong>{{ ord.buyer }}</strong>
                      <small style="max-width: 210px; display: block; white-space: normal; color:#6B7280; line-height:1.3;">
                        {{ ord.alamat || 'Jl. Senopati No. 45, Jakarta Selatan' }}
                      </small>
                    </div>
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
                  <td>
                    <div>
                      <strong>{{ ord.items_summary || ord.items }}</strong>
                      <small style="display:block; color:#F51487; font-weight:700;">
                        Total: {{ ord.total_qty || 1 }} Barang (PCS)
                      </small>
                    </div>
                  </td>
                  <td>
                    <div style="display:flex; flex-direction:column; gap:4px;">
                      <span class="resi-badge">{{ ord.courier }}: <strong>{{ ord.trackingNo }}</strong></span>
                      <small style="font-size:11px; color:#6B7280;">Status: {{ ord.status_pengiriman || 'Sedang Dikemas' }}</small>
                    </div>
                  </td>
                  <td>
                    <strong style="color:#F51487; font-size:14px;">Rp {{ formatRupiah(ord.total) }}</strong>
                    <small style="display:block; font-size:11px; color:#6B7280;">{{ ord.metode_pembayaran || 'Transfer BCA' }}</small>
                  </td>
                  <td>
                    <span :class="['status-pill', ord.statusClass]">{{ ord.status }}</span>
                  </td>
                  <td style="text-align: right;">
                    <div style="display:flex; gap:6px; justify-content:flex-end; flex-wrap:wrap;">
                      <button
                        type="button"
                        class="btn-admin-pink-sm"
                        title="Cek Transaksi, Ubah Status Pembayaran Berhasil & Input Resi Manual"
                        @click="handleOrderAction(ord)"
                      >
                        🔍 Cek &amp; Resi
                      </button>
                      <button
                        type="button"
                        class="btn-outline-sm"
                        title="Cetak Resi Slip Barang yang Dibeli"
                        @click="openPrintReceiptModal(ord)"
                      >
                        🖨️ Cetak Slip
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

    <!-- =====================================================================
         MODAL TAMBAH / EDIT DATABASE DATA BARANG (LENGKAP 4 GAMBAR 1:1 800x800 & SHADE)
         ===================================================================== -->
    <div v-if="isProductModalOpen" class="admin-modal-backdrop" @click="isProductModalOpen = false">
      <div class="admin-modal-card" style="max-width: 720px; max-height: 90vh; overflow-y: auto;" @click.stop>
        <div class="admin-modal-header">
          <h3>{{ editingProduct ? 'Edit Database Data Barang' : 'Tambah Data Barang Baru' }}</h3>
          <button type="button" class="modal-close-btn" @click="isProductModalOpen = false">✕</button>
        </div>

        <form class="admin-modal-form" @submit.prevent="saveProductForm">
          <!-- Nama Barang -->
          <div class="form-group">
            <label class="form-label">Nama Barang*</label>
            <input
              v-model="productForm.name"
              type="text"
              required
              placeholder="cth. Koafy Rose Hydrating Serum 50ml"
              class="form-control"
            />
          </div>

          <!-- SKU & Kategori Produk -->
          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">ID / Kode SKU Barang*</label>
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

          <!-- Harga Normal & Harga Promo / Harga Coret -->
          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Harga Normal (Rp)*</label>
              <input
                v-model="productForm.normalPriceFormatted"
                type="text"
                required
                placeholder="Rp 320.000"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Harga Promo / Harga Coret (Rp)*</label>
              <input
                v-model="productForm.discountPriceFormatted"
                type="text"
                required
                placeholder="Rp 269.000"
                class="form-control"
              />
            </div>
          </div>

          <!-- Stok & Status (active / inactive) -->
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
              <label class="form-label">Status Barang (Active / Inactive)*</label>
              <select v-model="productForm.status" class="form-control" style="background:#FFF;">
                <option value="ACTIVE">ACTIVE (Aktif Ditampilkan)</option>
                <option value="INACTIVE">INACTIVE (Nonaktif)</option>
              </select>
            </div>
          </div>

          <!-- Tanggal Masuk & Tanggal Expired -->
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

          <!-- Deskripsi Barang & Rekomendasi Tipe Kulit -->
          <div class="form-group">
            <label class="form-label">Deskripsi Barang</label>
            <textarea
              v-model="productForm.deskripsi_barang"
              rows="2"
              placeholder="Tuliskan deskripsi lengkap keunggulan produk..."
              class="form-control"
              style="height:auto; padding:8px 12px;"
            ></textarea>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Kandungan / Ingredients</label>
              <textarea
                v-model="productForm.kandungan_ingredients"
                rows="2"
                placeholder="cth. 5X Ceramide, Niacinamide, Shea Butter..."
                class="form-control"
                style="height:auto; padding:8px 12px;"
              ></textarea>
            </div>
            <div class="form-group">
              <label class="form-label">Manfaat Utama</label>
              <textarea
                v-model="productForm.manfaat_utama"
                rows="2"
                placeholder="cth. Melembapkan 24 jam, mencerahkan..."
                class="form-control"
                style="height:auto; padding:8px 12px;"
              ></textarea>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label">Cara Pakai</label>
              <input
                v-model="productForm.cara_pakai"
                type="text"
                placeholder="cth. Oleskan merata pada wajah/bibir bersih..."
                class="form-control"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Rekomendasi Tipe Kulit</label>
              <input
                v-model="productForm.rekomendasi_tipe_kulit"
                type="text"
                placeholder="cth. Semua Jenis Kulit / Kulit Sensitif"
                class="form-control"
              />
            </div>
          </div>

          <!-- 4 GAMBAR PRODUK (Rasio 1:1 800x800 px) -->
          <div class="form-group" style="background:#FFF5F9; border:1.5px dashed #F8B4D2; border-radius:12px; padding:14px;">
            <label class="form-label" style="color:#C70F6B; margin-bottom:4px;">
              📸 4 Gambar Produk (Utama &amp; Galeri Detail)
            </label>
            <p style="font-size:11.5px; color:#6E3B52; margin:0 0 12px; line-height:1.45;">
              <strong>Rekomendasi Dimensi:</strong> Gunakan gambar rasio <strong>1:1 (Kotak)</strong> dengan ukuran ideal <strong>800 x 800 px</strong> agar gambar presisi (tidak terlalu besar / kecil / terpotong) di halaman detail toko.
            </p>

            <div class="form-grid-2" style="gap:10px;">
              <div v-for="slot in [1, 2, 3, 4]" :key="'img-slot-' + slot" style="background:#FFFFFF; border:1px solid #F1DDE7; border-radius:10px; padding:10px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                  <strong style="font-size:11.5px; color:#2D101C;">
                    Gambar Produk {{ slot }} {{ slot === 1 ? '(Utama)*' : '(Galeri)' }}
                  </strong>
                  <span style="font-size:10px; color:#9CA3AF;">1:1 • 800x800px</span>
                </div>
                <div style="display:flex; gap:8px; align-items:center;">
                  <img
                    v-if="productForm['gambar_produk_' + slot]"
                    :src="productForm['gambar_produk_' + slot]"
                    alt="Preview"
                    style="width:44px; height:44px; border-radius:8px; object-fit:cover; border:1px solid #E5E7EB; flex-shrink:0;"
                  />
                  <div style="flex:1; min-width:0;">
                    <input
                      v-model="productForm['gambar_produk_' + slot]"
                      type="text"
                      :placeholder="'URL / Path Gambar ' + slot"
                      class="form-control"
                      style="height:30px; font-size:11.5px; margin-bottom:4px;"
                    />
                    <input
                      type="file"
                      accept="image/*"
                      style="font-size:10.5px; width:100%;"
                      @change="handleProductImageUpload($event, slot)"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- VARIAN WARNA / SHADE (OPSIONAL: KODE WARNA & GAMBAR SESUAI WARNA) -->
          <div class="form-group" style="background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:12px; padding:14px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
              <div>
                <label class="form-label" style="margin:0;">🎨 Varian Warna / Shade (Opsional)</label>
                <small style="font-size:11px; color:#64748B;">Tambahkan kode warna hex &amp; gambar produk sesuai warna shade</small>
              </div>
              <button
                type="button"
                class="btn-outline-sm"
                style="font-size:11.5px; padding:5px 10px;"
                @click="addShadeRow"
              >
                + Tambah Shade
              </button>
            </div>

            <div v-if="!productForm.shades || productForm.shades.length === 0" style="font-size:12px; color:#94A3B8; text-align:center; padding:8px;">
              Belum ada varian warna / shade ditambahkan (Opsional).
            </div>

            <div
              v-for="(sh, sIdx) in productForm.shades"
              :key="'shade-' + sIdx"
              style="display:grid; grid-template-columns: 1fr 120px 1.3fr auto; gap:8px; align-items:center; background:#FFFFFF; padding:8px; border-radius:8px; border:1px solid #E2E8F0; margin-bottom:8px;"
            >
              <input
                v-model="sh.nama_shade"
                type="text"
                placeholder="Nama Shade (cth: 01 Rosewood)"
                class="form-control"
                style="height:34px; font-size:12px;"
              />
              <div style="display:flex; align-items:center; gap:4px;">
                <input
                  v-model="sh.kode_warna"
                  type="color"
                  style="width:30px; height:30px; border:none; padding:0; cursor:pointer; background:none;"
                />
                <input
                  v-model="sh.kode_warna"
                  type="text"
                  placeholder="#C95B73"
                  class="form-control"
                  style="height:34px; font-size:11.5px;"
                />
              </div>
              <div style="display:flex; flex-direction:column; gap:2px;">
                <input
                  v-model="sh.gambar_produk"
                  type="text"
                  placeholder="Gambar sesuai warna"
                  class="form-control"
                  style="height:28px; font-size:11px;"
                />
                <input
                  type="file"
                  accept="image/*"
                  style="font-size:10px;"
                  @change="handleShadeImageUpload($event, sIdx)"
                />
              </div>
              <button
                type="button"
                style="background:#FEE2E2; color:#DC2626; border:none; border-radius:6px; width:28px; height:28px; cursor:pointer; font-weight:700;"
                title="Hapus Shade"
                @click="removeShadeRow(sIdx)"
              >
                ✕
              </button>
            </div>
          </div>

          <div class="admin-modal-actions">
            <button type="button" class="btn-outline-sm" @click="isProductModalOpen = false">Batal</button>
            <button type="submit" class="btn-admin-pink">Simpan ke Database Barang</button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL PREVIEW DETAIL PRODUK (REF GAMBAR) -->
    <div v-if="isProductViewModalOpen" class="admin-modal-backdrop" @click="isProductViewModalOpen = false">
      <div class="admin-modal-card" style="max-width: 560px;" @click.stop>
        <div class="admin-modal-header">
          <h3>Detail Data Barang &amp; Informasi Expired</h3>
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
              <span style="color: #6B7280; display: block;">Harga Promo / Diskon</span>
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
              <span style="color: #6B7280; display: block;">Rekomendasi Tipe Kulit</span>
              <strong>{{ viewingProduct.rekomendasi_tipe_kulit || 'Semua Jenis Kulit' }}</strong>
            </div>
            <div>
              <span style="color: #6B7280; display: block;">Status Expired</span>
              <span :class="['expired-status-pill', (viewingProduct.statusExpired || 'SAFE').toLowerCase()]">
                {{ viewingProduct.statusExpired || 'SAFE' }}
              </span>
            </div>
          </div>

          <div v-if="viewingProduct.deskripsi_barang" style="font-size:12.5px; color:#374151; background:#F9FAFB; padding:10px; border-radius:8px;">
            <strong>Deskripsi:</strong> {{ viewingProduct.deskripsi_barang }}
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

    <!-- =====================================================================
         MODAL ADMIN 1: CEK TRANSAKSI, UBAH STATUS PEMBAYARAN BERHASIL & INPUT RESI MANUAL
         ===================================================================== -->
    <div v-if="isOrderManageModalOpen && managingOrder" class="admin-modal-backdrop" @click="isOrderManageModalOpen = false">
      <div class="admin-modal-card" style="max-width: 680px; max-height: 90vh; overflow-y: auto;" @click.stop>
        <div class="admin-modal-header">
          <div>
            <h3 style="margin:0;">Verifikasi Transaksi &amp; Pengiriman Resi</h3>
            <small style="color:#6B7280; font-size:12px;">Invoice: <strong style="color:#F51487;">{{ managingOrder.id }}</strong> • Tanggal: {{ managingOrder.date }}</small>
          </div>
          <button type="button" class="modal-close-btn" @click="isOrderManageModalOpen = false">✕</button>
        </div>

        <div style="display:flex; flex-direction:column; gap:16px;">
          <!-- 1. Data Customer & Alamat -->
          <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; padding:14px; font-size:12.5px;">
            <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
              <strong style="color:#0F172A; font-size:13.5px;">👤 Data Customer &amp; Alamat Pengiriman</strong>
              <span style="color:#64748B;">ID Customer: #{{ managingOrder.id_customer || 1 }}</span>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px;">
              <div><strong>Nama Penerima:</strong> {{ managingOrder.buyer }}</div>
              <div><strong>No. Telepon / WA:</strong> +62 {{ managingOrder.phone }}</div>
              <div style="grid-column: span 2;">
                <strong>Alamat Lengkap:</strong> {{ managingOrder.alamat || 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan' }}
                <span v-if="managingOrder.kecamatan"> ({{ managingOrder.kecamatan }} {{ managingOrder.kode_pos }})</span>
              </div>
            </div>
          </div>

          <!-- 2. Rincian Barang yang Dibeli & Total Pembayaran -->
          <div style="background:#FFFFFF; border:1px solid #E5E7EB; border-radius:12px; padding:14px;">
            <strong style="display:block; font-size:13.5px; color:#111827; margin-bottom:10px;">
              🛍️ Detail Barang yang Dibeli ({{ managingOrder.total_qty || 1 }} PCS)
            </strong>
            <table style="width:100%; border-collapse:collapse; font-size:12.5px; margin-bottom:10px;">
              <thead>
                <tr style="border-bottom:1px solid #E5E7EB; text-align:left; color:#6B7280;">
                  <th style="padding:6px 4px;">Nama Produk</th>
                  <th style="padding:6px 4px;">Varian</th>
                  <th style="padding:6px 4px;">Qty</th>
                  <th style="padding:6px 4px; text-align:right;">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <template v-if="Array.isArray(managingOrder.items) && managingOrder.items.length">
                  <tr v-for="(it, idx) in managingOrder.items" :key="idx" style="border-bottom:1px dashed #F3F4F6;">
                    <td style="padding:6px 4px; font-weight:600;">{{ it.name || it.nama_produk }}</td>
                    <td style="padding:6px 4px; color:#6B7280;">{{ it.shade || 'Standar' }}</td>
                    <td style="padding:6px 4px; font-weight:700;">{{ it.qty }}x</td>
                    <td style="padding:6px 4px; text-align:right; font-weight:700;">Rp {{ formatRupiah((it.price || it.harga || 156510) * (it.qty || 1)) }}</td>
                  </tr>
                </template>
                <tr v-else>
                  <td style="padding:6px 4px; font-weight:600;">{{ managingOrder.items_summary || managingOrder.items }}</td>
                  <td style="padding:6px 4px; color:#6B7280;">{{ managingOrder.shade || 'Standar' }}</td>
                  <td style="padding:6px 4px; font-weight:700;">{{ managingOrder.total_qty || 1 }}x</td>
                  <td style="padding:6px 4px; text-align:right; font-weight:700;">Rp {{ formatRupiah(managingOrder.total) }}</td>
                </tr>
              </tbody>
            </table>

            <div style="display:flex; justify-content:space-between; font-size:12px; color:#6B7280; padding-top:6px;">
              <span>Metode Pembayaran: <strong>{{ managingOrder.metode_pembayaran || 'Transfer Bank BCA' }}</strong></span>
              <span>Ongkir: <strong>Rp {{ formatRupiah(managingOrder.ongkir || 0) }}</strong></span>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:8px; padding-top:8px; border-top:1px solid #E5E7EB;">
              <strong style="font-size:13.5px; color:#111827;">Total Pembayaran</strong>
              <strong style="font-size:17px; color:#F51487;">Rp {{ formatRupiah(managingOrder.total) }}</strong>
            </div>
          </div>

          <!-- 3. Bukti Transfer BCA (Jika Ada) & Tombol Ubah Status Pembayaran Berhasil -->
          <div style="background:#FFF5F9; border:1.5px solid #F8B4D2; border-radius:12px; padding:14px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
              <div>
                <strong style="font-size:13.5px; color:#2D101C;">💳 Verifikasi Status Pembayaran</strong>
                <div style="font-size:12px; color:#7A5B69;">
                  Status Saat Ini: <strong style="color:#F51487;">{{ managingOrder.status }}</strong>
                </div>
              </div>
              <button
                type="button"
                class="btn-admin-pink"
                style="background:#16A34A; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);"
                @click="markPaymentSuccess(managingOrder)"
              >
                ✔ Ubah Status: Pembayaran Berhasil
              </button>
            </div>

            <div v-if="managingOrder.nama_rekening_pengirim || managingOrder.bukti_transfer" style="background:#FFFFFF; border:1px solid #FCE4EC; border-radius:10px; padding:10px; display:flex; gap:12px; align-items:center;">
              <img
                v-if="managingOrder.bukti_transfer"
                :src="managingOrder.bukti_transfer"
                alt="Bukti Transfer"
                style="width:70px; height:70px; object-fit:cover; border-radius:8px; border:1px solid #E5E7EB;"
              />
              <div style="font-size:12px;">
                <div><strong>Rekening Pengirim:</strong> {{ managingOrder.nama_rekening_pengirim || managingOrder.buyer }}</div>
                <div><strong>Bank Pengirim:</strong> {{ managingOrder.bank_pengirim || 'BCA' }}</div>
                <span style="color:#16A34A; font-weight:700; font-size:11.5px;">✓ Bukti screenshot transfer terlampir</span>
              </div>
            </div>
          </div>

          <!-- 4. Penyiapan & Penyerahan Barang: Input Nomor Resi Secara Manual -->
          <div style="background:#F0F9FF; border:1.5px solid #BAE6FD; border-radius:12px; padding:14px;">
            <strong style="display:block; font-size:13.5px; color:#0369A1; margin-bottom:10px;">
              🚚 Penyiapan &amp; Penyerahan Barang (Input Nomor Resi Manual)
            </strong>
            <div class="form-grid-2" style="gap:10px; margin-bottom:10px;">
              <div>
                <label class="form-label" style="font-size:11.5px;">Jasa Pengiriman / Kurir</label>
                <select v-model="resiForm.jasa_pengiriman" class="form-control" style="background:#FFFFFF; height:38px;">
                  <option value="J&T Express - Regular">J&amp;T Express - Regular</option>
                  <option value="SiCepat BEST (Next Day)">SiCepat BEST (Next Day)</option>
                  <option value="JNE YES Express">JNE YES Express</option>
                  <option value="Anteraja Regular Eco">Anteraja Regular Eco</option>
                  <option value="Instant GoSend / Grab">Instant GoSend / Grab</option>
                  <option value="Ambil di Klinik Koafy">Ambil di Klinik Koafy</option>
                </select>
              </div>
              <div>
                <label class="form-label" style="font-size:11.5px;">Status Pengiriman</label>
                <select v-model="resiForm.status_pengiriman" class="form-control" style="background:#FFFFFF; height:38px;">
                  <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                  <option value="Sedang Dikemas / Siap Kirim">Sedang Dikemas / Siap Kirim</option>
                  <option value="Dikirim">Dikirim (Diserahkan ke Kurir)</option>
                  <option value="Selesai">Selesai (Diterima Customer)</option>
                </select>
              </div>
            </div>

            <div style="display:flex; gap:10px; align-items:flex-end;">
              <div style="flex:1;">
                <label class="form-label" style="font-size:11.5px;">Input Nomor Resi Secara Manual*</label>
                <input
                  v-model="resiForm.no_resi"
                  type="text"
                  placeholder="Ketik nomor resi pengiriman (cth: JT8829104599)"
                  class="form-control"
                  style="background:#FFFFFF; height:38px; font-family:monospace; font-weight:700;"
                />
              </div>
              <button
                type="button"
                class="btn-admin-pink"
                style="height:38px; background:#0284C7;"
                @click="saveManualResi(managingOrder)"
              >
                💾 Simpan No. Resi
              </button>
            </div>
          </div>

          <!-- Modal Bottom Actions -->
          <div class="admin-modal-actions" style="justify-content:space-between;">
            <button
              type="button"
              class="btn-admin-pink"
              @click="openPrintReceiptModal(managingOrder)"
            >
              🖨️ Cetak Resi / Slip Barang
            </button>
            <button type="button" class="btn-outline-sm" @click="isOrderManageModalOpen = false">
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- =====================================================================
         MODAL ADMIN 2: CETAK RESI / PACKING SLIP (FORMAT GAMBAR KE-2 • 100 x 150 mm)
         ===================================================================== -->
    <div v-if="isPrintReceiptModalOpen && printingOrder" class="admin-modal-backdrop" @click="isPrintReceiptModalOpen = false">
      <div class="admin-modal-card print-slip-modal-card" style="max-width: 440px; padding: 20px;" @click.stop>
        <div class="admin-modal-header no-print" style="margin-bottom: 12px; padding-bottom: 10px;">
          <div>
            <h3 style="margin:0; font-size:15px;">🖨️ Cetak Packing Slip / Resi</h3>
            <small style="color:#6B7280; font-size:11.5px;">Ukuran Kertas: <strong>100 x 150 mm (10 x 15 cm / A6)</strong></small>
          </div>
          <button type="button" class="modal-close-btn" @click="isPrintReceiptModalOpen = false">✕</button>
        </div>

        <!-- Printable Slip 100 x 150 mm (Exact Match Image 2) -->
        <div id="printable-resi-slip" class="packing-slip-100x150">
          <!-- Top Header: Brand + Packing Slip (Left) | Order ID + Timestamp (Right) -->
          <div class="ps-header">
            <div class="ps-header-left">
              <div class="ps-brand-name">HSK SECRET</div>
              <div class="ps-doc-type">PACKING SLIP</div>
            </div>
            <div class="ps-header-right">
              <div class="ps-order-code">{{ printingOrder.id }}</div>
              <div class="ps-order-date">{{ printingOrder.date }}{{ printingOrder.date && !printingOrder.date.includes('WIB') ? ', 15:40 WIB' : '' }}</div>
            </div>
          </div>

          <div class="ps-divider-solid"></div>

          <!-- Penerima Section -->
          <div class="ps-recipient-section">
            <div class="ps-recipient-label">PENERIMA</div>
            <div class="ps-recipient-name-phone">
              <strong>{{ printingOrder.buyer }}</strong> &middot; +62{{ String(printingOrder.phone || '').replace(/^(\+62|62|0)/, '') }}
            </div>
            <div class="ps-recipient-address">
              {{ printingOrder.alamat || 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan' }}<template v-if="printingOrder.kecamatan">, {{ printingOrder.kecamatan }}</template><template v-if="printingOrder.kode_pos"> {{ printingOrder.kode_pos }}</template>
            </div>
          </div>

          <!-- Produk & Qty List (Minimalist Horizontal Lines Only) -->
          <div class="ps-products-table">
            <div class="ps-prod-thead">
              <span>Produk</span>
              <span class="ps-col-qty">Qty</span>
            </div>

            <template v-if="Array.isArray(printingOrder.items) && printingOrder.items.length">
              <div
                v-for="(item, idx) in printingOrder.items"
                :key="idx"
                class="ps-prod-row"
              >
                <div class="ps-prod-info">
                  <div class="ps-prod-title">{{ item.name || item.nama_produk }}</div>
                  <div class="ps-prod-variant">
                    {{ formatProductSlug(item.name || item.nama_produk) }} &middot; {{ item.shade || 'Default' }}
                  </div>
                </div>
                <div class="ps-prod-qty">{{ item.qty }}</div>
              </div>
            </template>

            <div v-else class="ps-prod-row">
              <div class="ps-prod-info">
                <div class="ps-prod-title">{{ printingOrder.items_summary || printingOrder.items }}</div>
                <div class="ps-prod-variant">
                  {{ formatProductSlug(printingOrder.items_summary || printingOrder.items) }} &middot; {{ printingOrder.shade || 'Default' }}
                </div>
              </div>
              <div class="ps-prod-qty">{{ printingOrder.total_qty || 1 }}</div>
            </div>
          </div>

          <!-- Bottom Dashed Line + Terbayar / Courier / Resi -->
          <div class="ps-footer">
            <div class="ps-footer-top">
              <strong class="ps-paid-status">
                {{ isOrderPaidStatus(printingOrder.status) ? 'Terbayar' : printingOrder.status }}
              </strong>
              <span class="ps-courier-name">{{ printingOrder.courier }}</span>
            </div>
            <div class="ps-resi-line">
              Resi: {{ printingOrder.trackingNo && printingOrder.trackingNo !== 'BELUM DIINPUT' ? printingOrder.trackingNo : '-' }}
            </div>
          </div>
        </div>

        <div class="admin-modal-actions no-print" style="margin-top:16px;">
          <button type="button" class="btn-outline-sm" @click="isPrintReceiptModalOpen = false">Tutup</button>
          <button type="button" class="btn-admin-pink" @click="triggerPrintSlip">
            🖨️ Cetak Resi (100 x 150 mm)
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  isFlashSaleActive: {
    type: Boolean,
    default: true,
  },
});

const emit = defineEmits(['go-to-store', 'toast', 'update:isFlashSaleActive', 'admin-logout']);

const isMobileSidebarOpen = ref(false);
const currentTab = ref('dashboard');
const adminSearch = ref('');
const orderFilter = ref('all');

const adminUser = ref(
  JSON.parse(localStorage.getItem('koafy_admin_user') || 'null') || {
    name: 'Admin Koafy Official',
    email: 'admin.koafy@gmail.com',
    role: 'admin',
  }
);

function formatRupiah(val) {
  return Number(val || 0).toLocaleString('id-ID');
}

// =========================================================================
// NOTIFIKASI TRANSAKSI & MODAL VERIFIKASI / RESI / CETAK SLIP
// =========================================================================
const isNotifDropdownOpen = ref(false);
const isOrderManageModalOpen = ref(false);
const managingOrder = ref(null);
const isPrintReceiptModalOpen = ref(false);
const printingOrder = ref(null);

const resiForm = ref({
  jasa_pengiriman: 'J&T Express - Regular',
  no_resi: '',
  status_pengiriman: 'Dikirim',
});

const unreadNotifCount = computed(() => {
  return recentOrders.value.filter((o) => !o.is_notif_read).length;
});

function toggleNotifDropdown() {
  isNotifDropdownOpen.value = !isNotifDropdownOpen.value;
}

async function markAllNotificationsRead() {
  recentOrders.value.forEach((o) => {
    o.is_notif_read = true;
  });
  try {
    await fetch('/api/admin/transactions/notifications/read', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify({}),
    });
  } catch (e) {
    console.warn('Error marking notifications read:', e);
  }
  emit('toast', 'Semua notifikasi transaksi ditandai sudah dibaca.');
}

async function openOrderFromNotif(order) {
  isNotifDropdownOpen.value = false;
  order.is_notif_read = true;
  if (order.db_id) {
    try {
      await fetch('/api/admin/transactions/notifications/read', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({ id_transaksi: order.db_id }),
      });
    } catch (e) {
      // ignore
    }
  }
  handleOrderAction(order);
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

function toggleFlashSaleMaster() {
  const nextVal = !props.isFlashSaleActive;
  emit('update:isFlashSaleActive', nextVal);
  emit('toast', nextVal ? 'Section Flash Sale diaktifkan dan tampil di beranda toko!' : 'Section Flash Sale dinonaktifkan dari beranda toko.');
}

function selectTab(tabKey) {
  currentTab.value = tabKey;
  isMobileSidebarOpen.value = false;
  isNotifDropdownOpen.value = false;
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
    'products': 'Kelola Produk & Katalog (Database Barang)',
    'categories': 'Kelola Kategori Produk',
    'stock': 'Stok & Inventori Barang',
    'orders': 'Transaksi, Verifikasi Pembayaran & Slip Resi',
    'shipping': 'Penyiapan, Pengiriman & Input Resi Manual',
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

// =========================================================================
// 2. DATA PESANAN & TRANSAKSI (TERSINKRONISASI DENGAN DATABASE TRANSAKSI)
// =========================================================================
const recentOrders = ref([
  {
    db_id: 1,
    id: 'INV/20261124/KFY/8492',
    buyer: 'Siti Rahma',
    email: 'siti.rahma@example.com',
    phone: '81234567890',
    waNumber: '6281234567890',
    alamat: 'Jl. Senopati No. 45, RT 02 / RW 05, Kebayoran Baru, Jakarta Selatan',
    kecamatan: 'Kebayoran Baru, Jakarta Selatan',
    kode_pos: '12110',
    items: 'Koafy Crystal Butterbalm Tint Duo (1x), HSK Secret Pink Radiance Cream (1x)',
    items_summary: 'Koafy Crystal Butterbalm Tint Duo (1x), HSK Secret Pink Radiance Cream (1x)',
    shade: '01 Rosewood Dew',
    total_qty: 2,
    ongkir: 15000,
    diskon_voucer: 25000,
    voucer: 'BEAUTY2027',
    total: 463600,
    metode_pembayaran: 'Transfer Bank BCA (No. Rekening)',
    status: 'Menunggu Verifikasi Admin',
    statusClass: 'pink',
    courier: 'J&T Express - Regular',
    trackingNo: 'BELUM DIINPUT',
    status_pengiriman: 'Menunggu Konfirmasi Pembayaran',
    nama_rekening_pengirim: 'Siti Rahma',
    bank_pengirim: 'BCA',
    bukti_transfer: '/images/product-butterbalm-duo.jpg',
    is_notif_read: false,
    date: '24 Nov 2026',
  },
  {
    db_id: 2,
    id: 'INV/20261124/KFY/8491',
    buyer: 'Kayla Anindita',
    email: 'kayla.anindita@gmail.com',
    phone: '81294827100',
    waNumber: '6281294827100',
    alamat: 'Jl. Kemang Raya No. 18B, Bangka, Jakarta Selatan',
    kecamatan: 'Mampang Prapatan, Jakarta Selatan',
    kode_pos: '12730',
    items: 'Koafy Crystal Butterbalm Tint Duo (2x)',
    items_summary: 'Koafy Crystal Butterbalm Tint Duo (2x)',
    shade: '02 Mauve Petal',
    total_qty: 2,
    ongkir: 25000,
    diskon_voucer: 0,
    total: 338020,
    metode_pembayaran: 'BCA Virtual Account',
    status: 'Pembayaran Berhasil',
    statusClass: 'green',
    courier: 'SiCepat BEST (Next Day)',
    trackingNo: 'BELUM DIINPUT',
    status_pengiriman: 'Sedang Dikemas / Siap Kirim',
    is_notif_read: false,
    date: '24 Nov 2026',
  },
]);

const filteredOrders = computed(() => {
  let list = recentOrders.value;
  if (orderFilter.value === 'pending') {
    list = list.filter((o) =>
      o.status.toLowerCase().includes('menunggu') || o.status.toLowerCase().includes('verifikasi')
    );
  } else if (orderFilter.value === 'paid') {
    list = list.filter((o) =>
      o.status.toLowerCase().includes('berhasil') || o.status.toLowerCase().includes('lunas')
    );
  } else if (orderFilter.value === 'shipping') {
    list = list.filter((o) =>
      (o.status_pengiriman && o.status_pengiriman.toLowerCase().includes('dikirim')) ||
      (o.trackingNo && o.trackingNo !== 'BELUM DIINPUT')
    );
  }

  if (adminSearch.value.trim()) {
    const q = adminSearch.value.trim().toLowerCase();
    list = list.filter(
      (o) =>
        o.id.toLowerCase().includes(q) ||
        o.buyer.toLowerCase().includes(q) ||
        (o.trackingNo && o.trackingNo.toLowerCase().includes(q))
    );
  }
  return list;
});

function handleOrderAction(order) {
  managingOrder.value = order;
  order.is_notif_read = true;
  resiForm.value = {
    jasa_pengiriman: order.courier || 'J&T Express - Regular',
    no_resi: order.trackingNo && order.trackingNo !== 'BELUM DIINPUT' ? order.trackingNo : '',
    status_pengiriman: order.status_pengiriman || 'Sedang Dikemas / Siap Kirim',
  };
  isOrderManageModalOpen.value = true;
}

async function markPaymentSuccess(order) {
  order.status = 'Pembayaran Berhasil';
  order.status_pembayaran = 'Pembayaran Berhasil';
  order.statusClass = 'green';
  order.is_notif_read = true;
  if (!order.status_pengiriman || order.status_pengiriman.includes('Menunggu')) {
    order.status_pengiriman = 'Sedang Dikemas / Siap Kirim';
    resiForm.value.status_pengiriman = 'Sedang Dikemas / Siap Kirim';
  }

  if (order.db_id) {
    try {
      await fetch(`/api/admin/transactions/${order.db_id}/payment-status`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({ status_pembayaran: 'Pembayaran Berhasil' }),
      });
    } catch (e) {
      console.warn('Error updating payment status:', e);
    }
  }

  // Update localStorage koafy_orders so customer profile page reflects Lunas status
  try {
    const localOrders = JSON.parse(localStorage.getItem('koafy_orders') || '[]');
    const idx = localOrders.findIndex((o) => o.id === order.id);
    if (idx > -1) {
      localOrders[idx].status = 'processing';
      localOrders[idx].statusLabel = 'Pembayaran Berhasil (Diproses)';
      localOrders[idx].statusClass = 'status-processing';
      localStorage.setItem('koafy_orders', JSON.stringify(localOrders));
    }
  } catch (e) {
    // ignore
  }

  emit('toast', `Status pembayaran ${order.id} berhasil diubah menjadi: PEMBAYARAN BERHASIL!`);
}

async function saveManualResi(order) {
  if (!resiForm.value.no_resi.trim()) {
    emit('toast', 'Silakan ketik nomor resi pengiriman secara manual terlebih dahulu.');
    return;
  }

  order.courier = resiForm.value.jasa_pengiriman;
  order.trackingNo = resiForm.value.no_resi.trim().toUpperCase();
  order.status_pengiriman = resiForm.value.status_pengiriman || 'Dikirim';
  order.is_notif_read = true;

  if (order.db_id) {
    try {
      await fetch(`/api/admin/transactions/${order.db_id}/shipment`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({
          jasa_pengiriman: order.courier,
          no_resi: order.trackingNo,
          status_pengiriman: order.status_pengiriman,
        }),
      });
    } catch (e) {
      console.warn('Error updating shipment resi:', e);
    }
  }

  // Sync with customer localStorage orders
  try {
    const localOrders = JSON.parse(localStorage.getItem('koafy_orders') || '[]');
    const idx = localOrders.findIndex((o) => o.id === order.id);
    if (idx > -1) {
      localOrders[idx].courier = order.courier;
      localOrders[idx].trackingNumber = order.trackingNo;
      localOrders[idx].status = 'shipping';
      localOrders[idx].statusLabel = `Dikirim (Resi: ${order.trackingNo})`;
      localStorage.setItem('koafy_orders', JSON.stringify(localOrders));
    }
  } catch (e) {
    // ignore
  }

  emit('toast', `Nomor resi manual ${order.trackingNo} (${order.courier}) berhasil disimpan ke database!`);
}

function formatProductSlug(name) {
  return String(name || 'produk-koafy')
    .replace(/\([0-9]+x\)/gi, '')
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '')
    .slice(0, 28);
}

function isOrderPaidStatus(statusText) {
  const s = String(statusText || '').toLowerCase();
  return s.includes('berhasil') || s.includes('lunas') || s.includes('terbayar') || s.includes('dikirim') || s.includes('selesai');
}

function openPrintReceiptModal(order) {
  printingOrder.value = order;
  isPrintReceiptModalOpen.value = true;
}

function triggerPrintSlip() {
  const slipEl = document.getElementById('printable-resi-slip');
  if (!slipEl) {
    window.print();
    return;
  }

  const printWin = window.open('', '_blank', 'width=460,height=680');
  if (!printWin) {
    window.print();
    return;
  }

  printWin.document.write(`<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Packing Slip - ${printingOrder.value?.id || 'HSK SECRET'}</title>
  <style>
    @page {
      size: 100mm 150mm;
      margin: 0;
    }
    * {
      box-sizing: border-box;
    }
    html, body {
      width: 100mm;
      min-height: 150mm;
      margin: 0;
      padding: 0;
      background: #FFFFFF;
      color: #111111;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      -webkit-print-color-adjust: exact;
    }
    .packing-slip-100x150 {
      width: 100mm;
      min-height: 150mm;
      padding: 7mm 7mm;
      background: #FFFFFF;
      color: #111111;
    }
    .ps-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 8px;
    }
    .ps-brand-name {
      font-size: 18px;
      font-weight: 800;
      color: #000000;
      letter-spacing: 0.01em;
      line-height: 1.15;
    }
    .ps-doc-type {
      font-size: 12px;
      font-weight: 700;
      color: #000000;
      margin-top: 4px;
      letter-spacing: 0.02em;
    }
    .ps-header-right {
      text-align: right;
    }
    .ps-order-code {
      font-size: 13px;
      font-weight: 700;
      color: #000000;
      line-height: 1.2;
    }
    .ps-order-date {
      font-size: 11px;
      color: #555555;
      margin-top: 4px;
    }
    .ps-divider-solid {
      border-top: 1.5px solid #111111;
      margin: 11px 0;
    }
    .ps-recipient-section {
      margin-bottom: 14px;
    }
    .ps-recipient-label {
      font-size: 11px;
      color: #555555;
      text-transform: uppercase;
      letter-spacing: 0.03em;
      margin-bottom: 4px;
    }
    .ps-recipient-name-phone {
      font-size: 13px;
      color: #000000;
      margin-bottom: 5px;
    }
    .ps-recipient-address {
      font-size: 12.5px;
      color: #111111;
      line-height: 1.42;
    }
    .ps-products-table {
      width: 100%;
    }
    .ps-prod-thead {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid #222222;
      border-bottom: 1px solid #222222;
      padding: 6px 0;
      font-size: 12px;
      font-weight: 700;
      color: #000000;
    }
    .ps-col-qty {
      width: 34px;
      text-align: center;
    }
    .ps-prod-row {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 9px 0;
      border-bottom: 1px solid #E5E7EB;
      gap: 10px;
    }
    .ps-prod-info {
      flex: 1;
      min-width: 0;
    }
    .ps-prod-title {
      font-size: 12.5px;
      color: #111111;
      line-height: 1.35;
    }
    .ps-prod-variant {
      font-size: 11px;
      color: #666666;
      margin-top: 3px;
    }
    .ps-prod-qty {
      width: 34px;
      text-align: center;
      font-size: 12.5px;
      color: #111111;
      flex-shrink: 0;
    }
    .ps-footer {
      border-top: 1px dashed #888888;
      margin-top: 10px;
      padding-top: 9px;
    }
    .ps-footer-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .ps-paid-status {
      font-size: 13px;
      font-weight: 700;
      color: #000000;
    }
    .ps-courier-name {
      font-size: 12.5px;
      color: #111111;
    }
    .ps-resi-line {
      font-size: 12.5px;
      color: #111111;
      margin-top: 4px;
    }
  </style>
</head>
<body>
  <div class="packing-slip-100x150">${slipEl.innerHTML}</div>
  <script>
    window.onload = function() {
      setTimeout(function() {
        window.print();
      }, 150);
    };
  <\/script>
</body>
</html>`);
  printWin.document.close();
}

// =========================================================================
// 3. DATA PRODUK & KATALOG (DATABASE DATA BARANG + 4 GAMBAR 800x800 + SHADES)
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
  deskripsi_barang: '',
  kandungan_ingredients: '',
  manfaat_utama: '',
  cara_pakai: '',
  rekomendasi_tipe_kulit: 'Semua Jenis Kulit',
  image: '/images/product-butterbalm-duo.jpg',
  gambar_produk_1: '/images/product-butterbalm-duo.jpg',
  gambar_produk_2: '/images/product-velvet-lip.jpg',
  gambar_produk_3: '/images/product-multibalm-trio.jpg',
  gambar_produk_4: '/images/product-pink-cream.jpg',
  shades: [],
});

function handleProductImageUpload(event, slot) {
  const file = event.target.files?.[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (e) => {
    productForm.value[`gambar_produk_${slot}`] = e.target.result;
    if (slot === 1) {
      productForm.value.image = e.target.result;
    }
    emit('toast', `Gambar Produk ${slot} (Rasio 1:1) berhasil dimuat`);
  };
  reader.readAsDataURL(file);
}

function addShadeRow() {
  if (!Array.isArray(productForm.value.shades)) {
    productForm.value.shades = [];
  }
  productForm.value.shades.push({
    nama_shade: '',
    kode_warna: '#C95B73',
    gambar_produk: productForm.value.gambar_produk_1 || '/images/product-butterbalm-duo.jpg',
  });
}

function removeShadeRow(idx) {
  productForm.value.shades.splice(idx, 1);
}

function handleShadeImageUpload(event, idx) {
  const file = event.target.files?.[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (e) => {
    if (productForm.value.shades[idx]) {
      productForm.value.shades[idx].gambar_produk = e.target.result;
      emit('toast', `Gambar varian shade #${idx + 1} berhasil dimuat`);
    }
  };
  reader.readAsDataURL(file);
}

// Hitung otomatis masa berlaku dan status expired
function calculateExpiry(expiredDateStr) {
  if (!expiredDateStr) return { durationText: '-', statusExpired: 'SAFE' };
  const parts = expiredDateStr.split('-');
  if (parts.length !== 3) return { durationText: '-', statusExpired: 'SAFE' };

  const expDay = parseInt(parts[0], 10);
  const expMonth = parseInt(parts[1], 10) - 1;
  const expYear = parseInt(parts[2], 10);
  const expDate = new Date(expYear, expMonth, expDay);

  const anchorDate = new Date(2026, 7, 15);
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
    id: 1,
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
    gambar_produk_1: '/images/categories/serum-conseler.png',
    shades: [],
  },
]);

// Filter & Search Logic
const filteredCatalogProducts = computed(() => {
  let list = [...catalogProducts.value];

  const q = productSearchQuery.value.trim().toLowerCase();
  if (q) {
    list = list.filter(
      (p) =>
        p.name.toLowerCase().includes(q) ||
        p.sku.toLowerCase().includes(q) ||
        p.category.toLowerCase().includes(q)
    );
  }

  if (selectedCategoryFilter.value !== 'all') {
    list = list.filter((p) => p.category === selectedCategoryFilter.value);
  }

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

async function toggleProductActive(prod) {
  prod.status = prod.status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
  if (typeof prod.id === 'number') {
    try {
      await fetch(`/api/admin/products/${prod.id}/toggle-status`, {
        method: 'PATCH',
        headers: { Accept: 'application/json' },
      });
    } catch (e) {
      // ignore
    }
  }
  emit('toast', `Status produk ${prod.name} diubah menjadi ${prod.status}`);
}

async function deleteCatalogProduct(prod) {
  if (typeof prod.id === 'number') {
    try {
      await fetch(`/api/admin/products/${prod.id}`, {
        method: 'DELETE',
        headers: { Accept: 'application/json' },
      });
    } catch (e) {
      // ignore
    }
  }
  const idx = catalogProducts.value.findIndex((p) => p.id === prod.id);
  if (idx > -1) {
    catalogProducts.value.splice(idx, 1);
    emit('toast', `Produk "${prod.name}" berhasil dihapus dari database!`);
  }
}

function openAddProductModal() {
  editingProduct.value = null;
  productForm.value = {
    name: '',
    sku: `KFY-${Date.now().toString().slice(-4)}`,
    category: 'Makeup',
    normalPriceFormatted: 'Rp 200.000',
    discountPriceFormatted: 'Rp 160.000',
    stock: 25,
    status: 'ACTIVE',
    tglMasuk: '24-11-2026',
    tglExpired: '24-11-2029',
    deskripsi_barang: '',
    kandungan_ingredients: '',
    manfaat_utama: '',
    cara_pakai: '',
    rekomendasi_tipe_kulit: 'Semua Jenis Kulit',
    image: '/images/product-butterbalm-duo.jpg',
    gambar_produk_1: '/images/product-butterbalm-duo.jpg',
    gambar_produk_2: '/images/product-velvet-lip.jpg',
    gambar_produk_3: '/images/product-multibalm-trio.jpg',
    gambar_produk_4: '/images/product-pink-cream.jpg',
    shades: [
      { nama_shade: '01 Rosewood Dew', kode_warna: '#C95B73', gambar_produk: '/images/product-butterbalm-duo.jpg' },
    ],
  };
  isProductModalOpen.value = true;
}

function openEditProductModal(prod) {
  editingProduct.value = prod;
  productForm.value = {
    ...prod,
    gambar_produk_1: prod.gambar_produk_1 || prod.image || '/images/product-butterbalm-duo.jpg',
    gambar_produk_2: prod.gambar_produk_2 || '',
    gambar_produk_3: prod.gambar_produk_3 || '',
    gambar_produk_4: prod.gambar_produk_4 || '',
    shades: Array.isArray(prod.shades)
      ? prod.shades.map((s) => ({ ...s }))
      : [],
  };
  isProductModalOpen.value = true;
}

function openViewProductModal(prod) {
  viewingProduct.value = prod;
  isProductViewModalOpen.value = true;
}

async function saveProductForm() {
  if (!productForm.value.name || !productForm.value.sku) return;

  const expiryInfo = calculateExpiry(productForm.value.tglExpired);
  const numNormal = parseInt(String(productForm.value.normalPriceFormatted).replace(/[^0-9]/g, ''), 10) || 0;
  const numDiscount = parseInt(String(productForm.value.discountPriceFormatted).replace(/[^0-9]/g, ''), 10) || 0;

  const payload = {
    ...productForm.value,
    nama_barang: productForm.value.name,
    kategori_produk: productForm.value.category,
    harga_normal: numNormal,
    harga_promo: numDiscount,
    stok: productForm.value.stock,
    tanggal_masuk: productForm.value.tglMasuk,
    tanggal_expired: productForm.value.tglExpired,
    image: productForm.value.gambar_produk_1 || productForm.value.image,
  };

  try {
    const isEdit = editingProduct.value && typeof editingProduct.value.id === 'number';
    const url = isEdit ? `/api/admin/products/${editingProduct.value.id}` : '/api/admin/products';
    const method = isEdit ? 'PUT' : 'POST';

    const res = await fetch(url, {
      method,
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify(payload),
    });
    const data = await res.json();

    if (res.ok && data.success && data.product) {
      const savedProd = {
        ...data.product,
        masaBerlaku: expiryInfo.durationText,
        statusExpired: expiryInfo.statusExpired,
      };
      if (editingProduct.value) {
        Object.assign(editingProduct.value, savedProd);
      } else {
        catalogProducts.value.unshift(savedProd);
      }
      isProductModalOpen.value = false;
      emit('toast', data.message || 'Data barang berhasil disimpan ke database!');
      return;
    }
  } catch (e) {
    console.warn('Error saving product to backend:', e);
  }

  if (editingProduct.value) {
    Object.assign(editingProduct.value, {
      ...productForm.value,
      image: productForm.value.gambar_produk_1 || productForm.value.image,
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
      image: productForm.value.gambar_produk_1 || productForm.value.image,
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

// 6. Data Pelanggan
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
]);

onMounted(async () => {
  const token = localStorage.getItem('koafy_admin_jwt') || '';
  const headers = {
    Accept: 'application/json',
    ...(token ? { Authorization: `Bearer ${token}` } : {}),
  };

  // 1. Fetch Transaksi & Notifikasi dari Database
  try {
    const resTrans = await fetch('/api/transactions', { headers });
    const dataTrans = await resTrans.json();
    if (resTrans.ok && dataTrans.success && Array.isArray(dataTrans.transactions) && dataTrans.transactions.length > 0) {
      recentOrders.value = dataTrans.transactions;
    }
  } catch (e) {
    console.warn('Error fetching transactions:', e);
  }

  // 2. Fetch Data Barang & Varian Shade dari Database
  try {
    const resProd = await fetch('/api/products', { headers });
    const dataProd = await resProd.json();
    if (resProd.ok && dataProd.success && Array.isArray(dataProd.products) && dataProd.products.length > 0) {
      catalogProducts.value = dataProd.products.map((p) => {
        const exp = calculateExpiry(p.tglExpired);
        return {
          ...p,
          masaBerlaku: exp.durationText,
          statusExpired: exp.statusExpired,
        };
      });
    }
  } catch (e) {
    console.warn('Error fetching products:', e);
  }

  // 3. Fetch Data Pelanggan dari Database
  try {
    const resCust = await fetch('/api/admin/customers', { headers });
    const dataCust = await resCust.json();
    if (resCust.ok && dataCust.success && Array.isArray(dataCust.customers) && dataCust.customers.length > 0) {
      customersList.value = dataCust.customers;
    }
  } catch (e) {
    console.warn('Error fetching customers:', e);
  }
});
</script>
