<template>
  <!-- =====================================================================
       1. TOP ANNOUNCEMENT BAR (FLUSH AT Y=0, #F51487)
       ===================================================================== -->
  <div class="announcement-bar">
    <div class="marquee-track">
      <div class="marquee-group">
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
      </div>
      <div class="marquee-group" aria-hidden="true">
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
        <span class="marquee-item">{{ t('announcement') }}</span>
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
          {{ t('navHome') }}
        </a>
        <a
          href="#shop-all"
          class="nav-item"
          :class="{ active: activeNav === 'shop-all' }"
          @click.prevent="selectNav('shop-all')"
        >
          {{ t('navShopAll') }}
        </a>
        <a
          href="#our-story"
          class="nav-item"
          :class="{ active: activeNav === 'our-story' }"
          @click.prevent="selectNav('our-story')"
        >
          {{ t('navOurStory') }}
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
            <span>{{ t('navPages') }}</span>
            <svg class="chevron-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
          </button>
          <div class="dropdown-menu">
            <a href="#about" class="dropdown-link" @click.prevent="handleSubnav(t('aboutUs'))">{{ t('aboutUs') }}</a>
            <a href="#ingredients" class="dropdown-link" @click.prevent="handleSubnav(t('ingredients'))">{{ t('ingredients') }}</a>
            <a href="#faq" class="dropdown-link" @click.prevent="handleSubnav(t('faq'))">{{ t('faq') }}</a>
            <a href="#contact" class="dropdown-link" @click.prevent="handleSubnav(t('contact'))">{{ t('contact') }}</a>
          </div>
        </div>
      </nav>

      <!-- RIGHT: Search -> Language Switcher -> Love/Wishlist -> Shopping Bag -> User Profile -->
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

        <!-- Language Selector Pill & Dropdown (Immediately after Search) -->
        <div ref="langDropdownRef" class="lang-dropdown-wrapper">
          <button
            type="button"
            class="lang-pill-btn"
            :class="{ active: isLangOpen }"
            aria-label="Select Language"
            @click.stop="isLangOpen = !isLangOpen"
          >
            <!-- Circular Flag Icon -->
            <span class="flag-icon-wrap">
              <svg v-if="currentLang === 'id'" viewBox="0 0 24 24" width="18" height="18" class="flag-icon-svg">
                <rect width="24" height="12" fill="#E11D48"/>
                <rect y="12" width="24" height="12" fill="#FFFFFF"/>
              </svg>
              <svg v-else viewBox="0 0 24 24" width="18" height="18" class="flag-icon-svg">
                <defs><clipPath id="us-clip-nav"><circle cx="12" cy="12" r="12"/></clipPath></defs>
                <g clip-path="url(#us-clip-nav)">
                  <rect width="24" height="24" fill="#B22234"/>
                  <rect y="1.85" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect y="5.54" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect y="9.23" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect y="12.92" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect y="16.61" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect y="20.30" width="24" height="1.85" fill="#FFFFFF"/>
                  <rect width="11" height="13" fill="#3C3B6E"/>
                  <circle cx="3" cy="3" r="0.8" fill="#FFF"/>
                  <circle cx="6" cy="3" r="0.8" fill="#FFF"/>
                  <circle cx="9" cy="3" r="0.8" fill="#FFF"/>
                  <circle cx="4.5" cy="5.5" r="0.8" fill="#FFF"/>
                  <circle cx="7.5" cy="5.5" r="0.8" fill="#FFF"/>
                  <circle cx="3" cy="8" r="0.8" fill="#FFF"/>
                  <circle cx="6" cy="8" r="0.8" fill="#FFF"/>
                  <circle cx="9" cy="8" r="0.8" fill="#FFF"/>
                  <circle cx="4.5" cy="10.5" r="0.8" fill="#FFF"/>
                  <circle cx="7.5" cy="10.5" r="0.8" fill="#FFF"/>
                </g>
              </svg>
            </span>
            <span class="lang-code-text">{{ currentLang.toUpperCase() }}</span>
            <svg class="lang-chevron-icon" :class="{ rotate: isLangOpen }" viewBox="0 0 20 20" fill="currentColor" width="13" height="13">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>

          <!-- Dropdown Card -->
          <div v-if="isLangOpen" class="lang-dropdown-menu">
            <button
              type="button"
              class="lang-option-item"
              :class="{ selected: currentLang === 'id' }"
              @click="chooseLanguage('id')"
            >
              <div class="lang-option-content">
                <span class="flag-icon-wrap">
                  <svg viewBox="0 0 24 24" width="20" height="20" class="flag-icon-svg">
                    <rect width="24" height="12" fill="#E11D48"/>
                    <rect y="12" width="24" height="12" fill="#FFFFFF"/>
                  </svg>
                </span>
                <span class="lang-option-label">Bahasa Indonesia</span>
              </div>
              <svg v-if="currentLang === 'id'" class="lang-check-icon" viewBox="0 0 20 20" fill="#F51487" width="16" height="16">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
            </button>

            <button
              type="button"
              class="lang-option-item"
              :class="{ selected: currentLang === 'en' }"
              @click="chooseLanguage('en')"
            >
              <div class="lang-option-content">
                <span class="flag-icon-wrap">
                  <svg viewBox="0 0 24 24" width="20" height="20" class="flag-icon-svg">
                    <defs><clipPath id="us-clip-opt"><circle cx="12" cy="12" r="12"/></clipPath></defs>
                    <g clip-path="url(#us-clip-opt)">
                      <rect width="24" height="24" fill="#B22234"/>
                      <rect y="1.85" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect y="5.54" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect y="9.23" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect y="12.92" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect y="16.61" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect y="20.30" width="24" height="1.85" fill="#FFFFFF"/>
                      <rect width="11" height="13" fill="#3C3B6E"/>
                      <circle cx="3" cy="3" r="0.8" fill="#FFF"/>
                      <circle cx="6" cy="3" r="0.8" fill="#FFF"/>
                      <circle cx="9" cy="3" r="0.8" fill="#FFF"/>
                      <circle cx="4.5" cy="5.5" r="0.8" fill="#FFF"/>
                      <circle cx="7.5" cy="5.5" r="0.8" fill="#FFF"/>
                      <circle cx="3" cy="8" r="0.8" fill="#FFF"/>
                      <circle cx="6" cy="8" r="0.8" fill="#FFF"/>
                      <circle cx="9" cy="8" r="0.8" fill="#FFF"/>
                      <circle cx="4.5" cy="10.5" r="0.8" fill="#FFF"/>
                      <circle cx="7.5" cy="10.5" r="0.8" fill="#FFF"/>
                    </g>
                  </svg>
                </span>
                <span class="lang-option-label">English</span>
              </div>
              <svg v-if="currentLang === 'en'" class="lang-check-icon" viewBox="0 0 20 20" fill="#F51487" width="16" height="16">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- 2. Love / Wishlist Icon (After Language Pill) -->
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
            <div class="profile-header" @click="handleOpenProfile('addresses')">
              <div class="profile-avatar">
                <img
                  v-if="user?.avatar"
                  :src="user.avatar"
                  :alt="user.name"
                  style="width:100%;height:100%;border-radius:50%;object-fit:cover;"
                />
                <span v-else>SR</span>
              </div>
              <div>
                <div class="profile-name">{{ user?.name || 'Siti Rahma' }}</div>
                <div class="profile-tier">{{ user?.tier || 'GOLD MEMBER' }}</div>
              </div>
            </div>

            <!-- 1. Alamat Pengiriman (Ref Gambar 1) -->
            <button
              type="button"
              class="profile-menu-link"
              style="background-color: #FFF0F5; color: #C7436E; font-weight: 700; border-radius: 8px; margin-bottom: 5px;"
              @click="handleOpenProfile('addresses')"
            >
              <span>📍 Daftar Alamat Pengiriman</span>
              <span>&rsaquo;</span>
            </button>

            <!-- 2. Barang Dibeli (Order History) -->
            <button
              type="button"
              class="profile-menu-link"
              @click="handleOpenProfile('orders')"
            >
              <span>🛍️ Barang Dibeli (Pesanan)</span>
              <span style="color:#C7436E;font-weight:700;font-size:11px;">2 Pesanan</span>
            </button>

            <!-- 3. Wishlist Saya -->
            <button
              type="button"
              class="profile-menu-link"
              @click="handleOpenProfile('wishlist')"
            >
              <span>❤️ Wishlist Saya</span>
              <span style="color:#C7436E;font-weight:700;font-size:11px;">{{ wishlistCount }} item</span>
            </button>

            <!-- 4. Keranjang Belanja -->
            <button
              type="button"
              class="profile-menu-link"
              @click="handleOpenProfile('cart')"
            >
              <span>🛒 Keranjang Belanja</span>
              <span style="color:#C7436E;font-weight:700;font-size:11px;">{{ cartCount }} item</span>
            </button>

            <!-- 5. Ubah Informasi Data Diri -->
            <button
              type="button"
              class="profile-menu-link"
              @click="handleOpenProfile('profile-info')"
            >
              <span>👤 Ubah Data Informasi</span>
              <span>&rsaquo;</span>
            </button>

            <!-- 6. Ubah Kata Sandi Akun -->
            <button
              type="button"
              class="profile-menu-link"
              @click="handleOpenProfile('password')"
            >
              <span>🔑 Ubah Kata Sandi</span>
              <span>&rsaquo;</span>
            </button>

            <!-- 7. Panel Admin Toko & Switch Mode -->
            <div style="border-top: 1px dashed #F1DDE7; margin: 6px 0; padding-top: 6px;">
              <button
                type="button"
                class="profile-menu-link"
                style="background-color: #FFF5F9; color: #D36279; font-weight: 600; border-radius: 8px; margin-bottom: 4px;"
                @click="handleAdminClick"
              >
                <span>{{ t('adminPanel') }}</span>
                <span>&rsaquo;</span>
              </button>
              <button
                type="button"
                class="profile-menu-link"
                style="color: #8A6B78; font-size: 12px;"
                @click="handleAuthClick"
              >
                <span>Ganti Akun / Masuk Baru</span>
                <span>&rsaquo;</span>
              </button>
            </div>
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
          :placeholder="t('searchPlaceholder')"
          @keydown.enter="submitSearch"
        />
        <button id="search-close" type="button" class="search-close" @click="closeSearch">{{ t('searchClose') }}</button>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, nextTick, onMounted, onUnmounted } from 'vue';
import { currentLang, setLanguage, t } from '../i18n.js';

defineProps({
  user: {
    type: Object,
    default: () => ({
      name: 'Siti Rahma',
      email: 'siti.rahma@example.com',
      tier: 'GOLD MEMBER',
      avatar: '/images/siti-rahma-avatar.jpg',
    }),
  },
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

const emit = defineEmits([
  'update:activeNav',
  'open-drawer',
  'toast',
  'open-auth',
  'open-admin',
  'open-profile',
]);

const isScrolled = ref(false);
const isPagesOpen = ref(false);
const isProfileOpen = ref(false);
const isSearchOpen = ref(false);
const isLangOpen = ref(false);
const searchQuery = ref('');

const pagesDropdownRef = ref(null);
const profileWrapperRef = ref(null);
const langDropdownRef = ref(null);
const searchInputRef = ref(null);

function chooseLanguage(lang) {
  setLanguage(lang);
  isLangOpen.value = false;
  emit('toast', lang === 'id' ? 'Bahasa berhasil diubah ke Bahasa Indonesia' : 'Language switched to English');
}

function handleOpenProfile(tab = 'addresses') {
  isProfileOpen.value = false;
  emit('open-profile', tab);
}

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
  if (langDropdownRef.value && !langDropdownRef.value.contains(e.target)) {
    isLangOpen.value = false;
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
