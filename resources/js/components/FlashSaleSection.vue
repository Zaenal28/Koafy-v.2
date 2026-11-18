<template>
  <!-- =====================================================================
       FLASH SALE SECTION (REF IMAGES 1 & 2)
       - Placed directly before New Arrival Section
       - Top Bar: 3D Flash Sale Typo (Image 1) + Live Countdown Timer (Image 2)
       - Left: Promo Campaign Banner (Image 2)
       - Right: Flash Sale Products (Prices reduced by Rp 10.000 with Harga Coret)
       ===================================================================== -->
  <section class="flash-sale-section" aria-label="Flash Sale Koafy by HSK Secret">
    <div class="flash-sale-container">

      <!-- =================================================================
           1. TOP HEADER: FLASH SALE TITLE & LIVE COUNTDOWN TIMER (REF 1 & 2)
           ================================================================= -->
      <div class="flash-sale-header">
        <div class="flash-sale-title-group">
          <!-- 3D Flash Sale Badge (Ref Image 1 Aesthetic) -->
          <div class="flash-sale-badge-wrap">
            <span class="flash-lightning-icon">⚡</span>
            <span class="flash-sale-3d-text">FLASH SALE</span>
          </div>
          <span class="flash-sale-tagline">{{ t('flashTagline') }}</span>
        </div>

        <!-- Countdown Timer: "Akan berakhir dalam [ 21 : 57 : 59 ]" (Ref Image 2) -->
        <div class="flash-sale-timer-block">
          <span class="timer-label">{{ t('endsIn') }}</span>
          <div class="timer-display-pill">
            <span class="timer-icon">⏱</span>
            <div class="timer-digits-wrap">
              <span class="timer-box">{{ hours }}</span>
              <span class="timer-colon">:</span>
              <span class="timer-box">{{ minutes }}</span>
              <span class="timer-colon">:</span>
              <span class="timer-box">{{ seconds }}</span>
            </div>
          </div>
        </div>

        <!-- Arrows Navigation -->
        <div class="flash-header-arrows">
          <button
            type="button"
            class="slider-arrow-btn"
            aria-label="Geser ke kiri"
            @click="scrollPrev"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
          </button>
          <button
            type="button"
            class="slider-arrow-btn"
            aria-label="Geser ke kanan"
            @click="scrollNext"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
          </button>
        </div>
      </div>

      <!-- =================================================================
           2. MAIN CONTENT GRID: LEFT BANNER + RIGHT PRODUCTS TRACK (REF 2)
           ================================================================= -->
      <div class="flash-sale-main-grid">

        <!-- LEFT CAMPAIGN BANNER CARD (REF IMAGE 2) -->
        <div class="flash-promo-banner-card">
          <div class="flash-banner-overlay-content">
            <div class="banner-brand-chip">
              <img src="/images/koafy-logo.png" alt="Koafy by HSK Secret" class="banner-chip-logo" />
            </div>

            <div class="banner-text-block">
              <span class="banner-sub-badge">SPECIAL FLASH PROMO</span>
              <h3 class="banner-main-headline">
                LIMITED<br />
                <em>super sale</em>
              </h3>

              <div class="banner-discount-box">
                <span class="disc-label">DISC. UP TO</span>
                <span class="disc-number">40%</span>
              </div>
            </div>

            <button
              type="button"
              class="banner-shop-now-btn"
              @click="$emit('view-all')"
            >
              <span>{{ t('shopNowBtn') }}</span>
              <small>*{{ t('limitedStock') }}</small>
            </button>
          </div>

          <!-- Banner Visual Background -->
          <img
            src="/images/auth-hero.jpg"
            alt="Koafy Flash Sale Campaign"
            class="flash-banner-bg-img"
          />
        </div>

        <!-- RIGHT PRODUCTS TRACK / CAROUSEL -->
        <div class="flash-products-track-container">
          <div
            ref="trackRef"
            class="flash-products-track"
            @mouseenter="stopAutoSlide"
            @mouseleave="startAutoSlide"
            @touchstart.passive="stopAutoSlide"
            @touchend.passive="startAutoSlide"
          >
            <article
              v-for="item in flashProducts"
              :key="item.id"
              class="flash-product-card"
            >
              <!-- Card Media + Discount Tag Top-Right (Ref Image 2) + Love Icon -->
              <div class="flash-card-media" @click="$emit('view-detail', item)">
                <!-- Discount Tag (e.g. 23%, 25%, 27% matching Image 2 top-right) -->
                <span class="flash-discount-tag">{{ item.discountPercent }}%</span>

                <!-- Love / Favorite Button -->
                <button
                  type="button"
                  class="flash-love-btn"
                  :class="{ active: isFavorite(item.id) }"
                  :aria-label="isFavorite(item.id) ? 'Hapus dari favorit' : 'Tambah ke favorit'"
                  @click.stop="$emit('toggle-favorite', item)"
                >
                  <svg
                    width="18"
                    height="18"
                    :fill="isFavorite(item.id) ? '#F51487' : 'none'"
                    :stroke="isFavorite(item.id) ? '#F51487' : '#6B7280'"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>

                <img
                  :src="item.image"
                  :alt="item.name"
                  class="flash-card-img"
                  loading="lazy"
                />
              </div>

              <!-- Card Body: Title, Price with -10 RB & Coret, Stock Bar, Button "Lihat Produk" -->
              <div class="flash-card-body">
                <h4 class="flash-product-title" :title="item.name" @click="$emit('view-detail', item)">
                  {{ item.name }}
                </h4>

                <!-- Price Row: Harga Flash Sale (Kurang Rp 10.000) & Harga Coret -->
                <div class="flash-price-block">
                  <span class="flash-price-current">{{ item.priceFormatted }}</span>
                  <span class="flash-price-old">{{ item.oldPriceFormatted }}</span>
                </div>

                <!-- Limited Stock Progress Bar -->
                <div class="flash-stock-progress-wrap">
                  <div class="flash-progress-bar-bg">
                    <div
                      class="flash-progress-fill"
                      :style="{ width: `${item.soldPercent}%` }"
                    ></div>
                  </div>
                  <span class="flash-stock-text">
                    🔥 {{ t('soldText') }} {{ item.soldPercent }}% &bull; {{ t('leftText') }} {{ item.stockLeft }} pcs
                  </span>
                </div>

                <!-- Button "Lihat Produk" (Ref Image 2 Bottom Button) -->
                <button
                  type="button"
                  class="btn-lihat-produk"
                  @click="$emit('view-detail', item)"
                >
                  {{ t('viewProduct') }}
                </button>
              </div>
            </article>
          </div>
        </div>

      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { t } from '../i18n.js';

const props = defineProps({
  wishlistIds: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(['view-detail', 'add-to-cart', 'toggle-favorite', 'view-all']);

function isFavorite(id) {
  return props.wishlistIds.includes(id);
}

// 1. Live Real-time Countdown Timer (Hours : Minutes : Seconds)
const hours = ref('21');
const minutes = ref('57');
const seconds = ref('59');
let timerInterval = null;

function startCountdown() {
  let totalSec = 21 * 3600 + 57 * 60 + 59;
  timerInterval = setInterval(() => {
    if (totalSec <= 0) {
      totalSec = 24 * 3600; // Reset ke 24 jam
    }
    totalSec--;
    const h = Math.floor(totalSec / 3600);
    const m = Math.floor((totalSec % 3600) / 60);
    const s = totalSec % 60;
    hours.value = String(h).padStart(2, '0');
    minutes.value = String(m).padStart(2, '0');
    seconds.value = String(s).padStart(2, '0');
  }, 1000);
}

// 2. Flash Sale Products (Diambil dari Arrival Section dengan harga kurang 10 rb + harga coret)
const flashProducts = ref([
  {
    id: 'fs-1',
    arrivalRefId: 'na-1',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Rosewood Glow',
    price: 36, // Di dollar setara ~$36
    priceFormatted: 'Rp 146.510',      // Kurang 10 rb dari Rp 156.510
    oldPriceFormatted: 'Rp 190.000',  // Harga coret
    discountPercent: 23,
    soldPercent: 82,
    stockLeft: 8,
    image: '/images/product-butterbalm-1.jpg',
  },
  {
    id: 'fs-2',
    arrivalRefId: 'na-2',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Berry Mauve',
    price: 36,
    priceFormatted: 'Rp 146.510',      // Kurang 10 rb dari Rp 156.510
    oldPriceFormatted: 'Rp 190.000',  // Harga coret
    discountPercent: 23,
    soldPercent: 74,
    stockLeft: 12,
    image: '/images/product-butterbalm-2.jpg',
  },
  {
    id: 'fs-3',
    arrivalRefId: 'na-3',
    brand: 'HSK SECRET',
    volume: 'SET DUO',
    name: 'Koafy Velvet Lip & Precision Brush Set',
    price: 42,
    priceFormatted: 'Rp 165.000',      // Kurang 10 rb dari Rp 175.000
    oldPriceFormatted: 'Rp 215.000',  // Harga coret
    discountPercent: 27,
    soldPercent: 91,
    stockLeft: 4,
    image: '/images/product-lip-velvet.jpg',
  },
  {
    id: 'fs-4',
    arrivalRefId: 'na-4',
    brand: 'KOAFY PARIS',
    volume: '2 X 4.5 G',
    name: 'Koafy Crystal Butterbalm Duo Bundle',
    price: 65,
    priceFormatted: 'Rp 278.600',      // Kurang 10 rb dari Rp 288.600
    oldPriceFormatted: 'Rp 360.000',  // Harga coret
    discountPercent: 25,
    soldPercent: 68,
    stockLeft: 15,
    image: '/images/product-butterbalm-duo.jpg',
  },
  {
    id: 'fs-5',
    arrivalRefId: 'na-5',
    brand: 'KOAFY PARIS',
    volume: '3 SHADES',
    name: 'Koafy Soft-Square Multi Balm Trio Compact',
    price: 51,
    priceFormatted: 'Rp 200.000',      // Kurang 10 rb dari Rp 210.000
    oldPriceFormatted: 'Rp 255.000',  // Harga coret
    discountPercent: 24,
    soldPercent: 85,
    stockLeft: 6,
    image: '/images/banner-koafy-trio.jpg',
  },
]);

// 3. Slider Controls
const trackRef = ref(null);
let autoSlideTimer = null;

function getScrollDistance() {
  if (!trackRef.value) return 260;
  const firstCard = trackRef.value.querySelector('.flash-product-card');
  return firstCard ? firstCard.offsetWidth + 16 : 260;
}

function scrollNext() {
  if (!trackRef.value) return;
  const track = trackRef.value;
  const maxScroll = track.scrollWidth - track.clientWidth;
  const distance = getScrollDistance();
  if (track.scrollLeft >= maxScroll - 15) {
    track.scrollTo({ left: 0, behavior: 'smooth' });
  } else {
    track.scrollBy({ left: distance, behavior: 'smooth' });
  }
}

function scrollPrev() {
  if (!trackRef.value) return;
  const track = trackRef.value;
  const distance = getScrollDistance();
  if (track.scrollLeft <= 15) {
    track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
  } else {
    track.scrollBy({ left: -distance, behavior: 'smooth' });
  }
}

function startAutoSlide() {
  if (autoSlideTimer) clearInterval(autoSlideTimer);
  autoSlideTimer = setInterval(() => {
    scrollNext();
  }, 4500);
}

function stopAutoSlide() {
  if (autoSlideTimer) {
    clearInterval(autoSlideTimer);
    autoSlideTimer = null;
  }
}

onMounted(() => {
  startCountdown();
  startAutoSlide();
});

onUnmounted(() => {
  if (timerInterval) clearInterval(timerInterval);
  stopAutoSlide();
});
</script>
