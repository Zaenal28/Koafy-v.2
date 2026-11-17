<template>
  <!-- =====================================================================
       1. TOP ANNOUNCEMENT BAR (FLUSH AT Y=0, #F51487)
       ===================================================================== -->
  <div class="announcement-bar">
    <div class="marquee-track">
      <div class="marquee-group">
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
      </div>
      <div class="marquee-group" aria-hidden="true">
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
        <span class="marquee-item">Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU</span>
      </div>
    </div>
  </div>

  <!-- =====================================================================
       2. MAIN 3-COLUMN HEADER (Logo Left | Nav Center | 4 Icons Right)
       ===================================================================== -->
  <header id="site-header" class="site-header" :class="{ scrolled: isScrolled }">
    <div class="header-container">

      <!-- LEFT: Mobile Menu Button + Koafy by HSK Secret SVG Logo -->
      <div class="header-left">
        <button
          id="mobile-menu-btn"
          type="button"
          class="mobile-trigger"
          aria-label="Buka Menu"
          @click="$emit('open-drawer', 'mobile')"
        >
          <svg fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24" width="24" height="24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>

        <a
          href="#home"
          class="brand-logo"
          aria-label="Koafy by HSK Secret"
          @click.prevent="selectNav('home')"
        >
          <img
            src="/images/koafy-logo.png"
            alt="Koafy by HSK Secret"
            class="brand-logo-img"
          />
        </a>
      </div>

      <!-- CENTER: Navigation Links (#F51487 Active/Hover State) -->
      <nav class="header-nav" aria-label="Main Navigation">
        <a
          href="#home"
          class="nav-item"
          :class="{ active: activeNav === 'home' }"
          @click.prevent="selectNav('home')"
        >
          Home
        </a>
        <a
          href="#shop-all"
          class="nav-item"
          :class="{ active: activeNav === 'shop-all' }"
          @click.prevent="selectNav('shop-all')"
        >
          Shop All
        </a>
        <a
          href="#our-story"
          class="nav-item"
          :class="{ active: activeNav === 'our-story' }"
          @click.prevent="selectNav('our-story')"
        >
          Our Story
        </a>

        <div
          id="pages-dropdown"
          ref="pagesDropdownRef"
          class="dropdown-wrapper"
          :class="{ open: isPagesOpen }"
        >
          <button
            id="pages-trigger"
            type="button"
            class="nav-item"
            :class="{ active: activeNav === 'pages' }"
            :aria-expanded="isPagesOpen ? 'true' : 'false'"
            @click.stop="togglePagesDropdown"
          >
            <span>Pages</span>
            <svg class="chevron-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
          </button>
          <div class="dropdown-menu">
            <a href="#about" class="dropdown-link" @click.prevent="handleSubnav('About Us')">About Us</a>
            <a href="#ingredients" class="dropdown-link" @click.prevent="handleSubnav('Ingredients')">Ingredients</a>
            <a href="#faq" class="dropdown-link" @click.prevent="handleSubnav('FAQ')">FAQ</a>
            <a href="#contact" class="dropdown-link" @click.prevent="handleSubnav('Contact')">Contact</a>
          </div>
        </div>
      </nav>

      <!-- RIGHT: Search -> Love/Wishlist (2) -> Shopping Bag (3) -> User Profile -->
      <div class="header-utilities">
        <!-- 1. Search Icon -->
        <button
          id="search-btn"
          type="button"
          class="icon-btn"
          :class="{ active: isSearchOpen }"
          aria-label="Search Products"
          @click="toggleSearch"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
          </svg>
        </button>

        <!-- 2. Love / Wishlist Icon (Before Cart) -->
        <button
          id="wishlist-btn"
          type="button"
          class="icon-btn"
          aria-label="Favorite Items"
          @click="$emit('open-drawer', 'wishlist')"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
          <span id="wishlist-badge" class="badge-pill">{{ wishlistCount }}</span>
        </button>

        <!-- 3. Shopping Bag / Cart Icon -->
        <button
          id="cart-btn"
          type="button"
          class="icon-btn"
          aria-label="Shopping Bag"
          @click="$emit('open-drawer', 'cart')"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
          </svg>
          <span id="cart-badge" class="badge-pill">{{ cartCount }}</span>
        </button>

        <!-- 4. User Profile Icon (Far Right after Cart) -->
        <div ref="profileWrapperRef" class="profile-wrapper">
          <button
            id="profile-btn"
            type="button"
            class="icon-btn"
            :class="{ active: isProfileOpen }"
            aria-label="User Account Profile"
            @click.stop="isProfileOpen = !isProfileOpen"
          >
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
          </button>

          <div id="profile-popover" class="profile-popover" :class="{ open: isProfileOpen }">
            <div class="profile-header">
              <div class="profile-avatar">KA</div>
              <div>
                <div class="profile-name">Kayla Anindita</div>
                <div class="profile-tier">Koafy Rose VIP Member</div>
              </div>
            </div>
            <button
              type="button"
              class="profile-menu-link"
              style="background-color: var(--koafy-pink-soft); color: var(--koafy-pink); font-weight: 700; border-radius: 8px; margin-bottom: 6px;"
              @click="handleAuthClick"
            >
              <span>Masuk / Daftar Akun</span>
              <span>&rsaquo;</span>
            </button>
            <button
              type="button"
              class="profile-menu-link"
              style="background-color: #FFF0F4; color: #D36279; font-weight: 700; border-radius: 8px; margin-bottom: 6px;"
              @click="handleAdminClick"
            >
              <span>⚙️ Panel Admin Toko</span>
              <span>&rsaquo;</span>
            </button>
            <button type="button" class="profile-menu-link" @click="triggerProfileToast('Membuka halaman My Profile')">
              <span>My Profile</span>
              <span>&rsaquo;</span>
            </button>
            <button type="button" class="profile-menu-link" @click="triggerProfileToast('Membuka riwayat My Orders')">
              <span>My Orders</span>
              <span style="color:#F51487;font-weight:700;font-size:11px;">2 Active</span>
            </button>
            <button type="button" class="profile-menu-link" @click="triggerProfileToast(`Anda memiliki ${claimedVouchersCount} voucher aktif`)">
              <span>My Claimed Vouchers</span>
              <span id="profile-voucher-count" style="color:#F51487;font-weight:700;font-size:11px;">{{ claimedVouchersCount }}</span>
            </button>
            <button type="button" class="profile-menu-link" @click="triggerProfileToast('Membuka pengaturan akun')">
              <span>Account Settings</span>
              <span>&rsaquo;</span>
            </button>
          </div>
        </div>
      </div>

    </div>

    <!-- Expandable Search Bar -->
    <div id="search-panel" class="search-panel" :class="{ open: isSearchOpen }">
      <div class="search-inner">
        <svg width="18" height="18" fill="none" stroke="#F51487" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        <input
          id="search-input"
          ref="searchInputRef"
          v-model="searchQuery"
          type="text"
          placeholder="Cari Koafy Lip Velvet, Crystal Butterbalm, atau Soft-Square Trio..."
          @keydown.enter="submitSearch"
        />
        <button id="search-close" type="button" class="search-close" @click="closeSearch">Tutup</button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, nextTick, onMounted, onUnmounted } from 'vue';

defineProps({
  activeNav: {
    type: String,
    default: 'home',
  },
  wishlistCount: {
    type: Number,
    default: 0,
  },
  cartCount: {
    type: Number,
    default: 0,
  },
  claimedVouchersCount: {
    type: Number,
    default: 0,
  },
});

const emit = defineEmits(['update:activeNav', 'open-drawer', 'toast', 'open-auth', 'open-admin']);

const isScrolled = ref(false);
const isPagesOpen = ref(false);
const isProfileOpen = ref(false);
const isSearchOpen = ref(false);
const searchQuery = ref('');

const pagesDropdownRef = ref(null);
const profileWrapperRef = ref(null);
const searchInputRef = ref(null);

function handleAuthClick() {
  isProfileOpen.value = false;
  emit('open-auth');
}

function handleAdminClick() {
  isProfileOpen.value = false;
  emit('open-admin');
}

function selectNav(nav) {
  emit('update:activeNav', nav);
  isPagesOpen.value = false;
}

function togglePagesDropdown() {
  emit('update:activeNav', 'pages');
  isPagesOpen.value = !isPagesOpen.value;
}

function handleSubnav(pageTitle) {
  isPagesOpen.value = false;
  emit('toast', `Membuka halaman ${pageTitle}`);
}

function toggleSearch() {
  isSearchOpen.value = !isSearchOpen.value;
  if (isSearchOpen.value) {
    nextTick(() => {
      searchInputRef.value?.focus();
    });
  }
}

function closeSearch() {
  isSearchOpen.value = false;
}

function submitSearch() {
  const q = searchQuery.value.trim();
  if (q) {
    emit('toast', `Mencari produk: "${q}"`);
    isSearchOpen.value = false;
  }
}

function triggerProfileToast(msg) {
  isProfileOpen.value = false;
  emit('toast', msg);
}

function handleScroll() {
  isScrolled.value = window.scrollY > 8;
}

function handleDocumentClick(e) {
  if (pagesDropdownRef.value && !pagesDropdownRef.value.contains(e.target)) {
    isPagesOpen.value = false;
  }
  if (profileWrapperRef.value && !profileWrapperRef.value.contains(e.target)) {
    isProfileOpen.value = false;
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true });
  document.addEventListener('click', handleDocumentClick);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  document.removeEventListener('click', handleDocumentClick);
});
</script>
