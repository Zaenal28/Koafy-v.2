<template>
  <!-- =====================================================================
       NEW ARRIVAL / PRODUK TERLARIS SECTION
       - Web PC: 4-Column Grid or Horizontal Slider with Controls
       - Web Android & iOS: Horizontal Touch Slider with Auto-Slide (Tidak ke bawah)
       ===================================================================== -->
  <section class="new-arrival-section" aria-label="New Arrival Koafy">
    <!-- Section Header with Arrows & Catalog Link -->
    <div class="new-arrival-header">
      <div class="new-arrival-heading-group">
        <span class="new-arrival-subtitle">KOAFY EXCLUSIVE &bull; MOST FAVORITE</span>
        <h2 class="new-arrival-title">New Arrival</h2>
      </div>

      <div class="new-arrival-header-actions">
        <!-- Navigation Arrows (< and >) -->
        <div class="slider-nav-arrows">
          <button
            type="button"
            class="slider-arrow-btn"
            aria-label="Slide sebelumnya"
            @click="scrollPrev"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
          </button>
          <button
            type="button"
            class="slider-arrow-btn"
            aria-label="Slide berikutnya"
            @click="scrollNext"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
          </button>
        </div>

        <a
          href="#all-catalog"
          class="new-arrival-catalog-link"
          @click.prevent="$emit('view-all')"
        >
          <span>Lihat Semua</span>
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Product Slider / Grid Container -->
    <div
      ref="trackRef"
      class="new-arrival-track"
      @mouseenter="stopAutoSlide"
      @mouseleave="startAutoSlide"
      @touchstart.passive="stopAutoSlide"
      @touchend.passive="startAutoSlide"
    >
      <article
        v-for="product in products"
        :key="product.id"
        class="product-card"
      >
        <!-- Product Image Box + Discount Badge Top-Left -->
        <div class="product-card-media">
          <span class="product-badge-discount">{{ product.badge }}</span>
          <img
            :src="product.image"
            :alt="product.name"
            class="product-card-img"
            loading="lazy"
          />
        </div>

        <!-- Product Meta, Title, Rating, Price & Dual Action Buttons -->
        <div class="product-card-body">
          <div class="product-card-meta">
            <span>{{ product.brand }}</span>
            <span class="meta-dot">&bull;</span>
            <span>{{ product.volume }}</span>
          </div>

          <h3 class="product-card-name" :title="product.name">{{ product.name }}</h3>

          <!-- Star Rating (Reference Image Style) -->
          <div class="product-rating-row">
            <div class="rating-stars" aria-label="Rating 5 bintang">
              <svg
                v-for="s in 5"
                :key="s"
                width="14"
                height="14"
                viewBox="0 0 20 20"
                fill="#FF9E00"
              >
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
            <span class="rating-score">{{ product.rating }}</span>
            <span class="rating-count">({{ product.reviews }})</span>
          </div>

          <!-- Price Block (Image 2 Style with #F51487) -->
          <div class="product-price-row">
            <span class="product-price-current">{{ product.priceFormatted }}</span>
            <span class="product-price-old">{{ product.oldPriceFormatted }}</span>
          </div>

          <!-- Bottom Action Buttons: [Detail] & [+ Keranjang] -->
          <div class="product-actions-row">
            <button
              type="button"
              class="btn-product-detail"
              @click="$emit('view-detail', product)"
            >
              <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Detail</span>
            </button>

            <button
              type="button"
              class="btn-product-cart"
              @click="$emit('add-to-cart', product)"
            >
              <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
              </svg>
              <span>+ Keranjang</span>
            </button>
          </div>
        </div>
      </article>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

defineEmits(['add-to-cart', 'view-all', 'view-detail']);

const trackRef = ref(null);
let autoSlideInterval = null;

const products = ref([
  {
    id: 'na-1',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Rosewood Glow',
    rating: '4.9',
    reviews: 128,
    badge: '-22%',
    price: 38,
    priceFormatted: 'Rp 156.510',
    oldPriceFormatted: 'Rp 200.000',
    image: '/images/product-butterbalm-1.jpg',
  },
  {
    id: 'na-2',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Berry Mauve',
    rating: '4.8',
    reviews: 340,
    badge: '-22%',
    price: 38,
    priceFormatted: 'Rp 156.510',
    oldPriceFormatted: 'Rp 200.000',
    image: '/images/product-butterbalm-2.jpg',
  },
  {
    id: 'na-3',
    brand: 'HSK SECRET',
    volume: 'SET DUO',
    name: 'Koafy Velvet Lip & Precision Brush Set',
    rating: '5.0',
    reviews: 95,
    badge: '-22%',
    price: 45,
    priceFormatted: 'Rp 175.000',
    oldPriceFormatted: 'Rp 225.000',
    image: '/images/product-lip-velvet.jpg',
  },
  {
    id: 'na-4',
    brand: 'KOAFY PARIS',
    volume: '2 X 4.5 G',
    name: 'Koafy Crystal Butterbalm Duo Bundle',
    rating: '4.9',
    reviews: 214,
    badge: '-22%',
    price: 68,
    priceFormatted: 'Rp 288.600',
    oldPriceFormatted: 'Rp 370.000',
    image: '/images/product-butterbalm-duo.jpg',
  },
  {
    id: 'na-5',
    brand: 'KOAFY PARIS',
    volume: '3 SHADES',
    name: 'Koafy Soft-Square Multi Balm Trio Compact',
    rating: '4.9',
    reviews: 180,
    badge: '-20%',
    price: 54,
    priceFormatted: 'Rp 210.000',
    oldPriceFormatted: 'Rp 265.000',
    image: '/images/banner-koafy-trio.jpg',
  },
]);

function getScrollDistance() {
  if (!trackRef.value) return 280;
  const firstCard = trackRef.value.querySelector('.product-card');
  if (firstCard) {
    const gap = 16;
    return firstCard.offsetWidth + gap;
  }
  return 280;
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
  const maxScroll = track.scrollWidth - track.clientWidth;
  const distance = getScrollDistance();

  if (track.scrollLeft <= 15) {
    track.scrollTo({ left: maxScroll, behavior: 'smooth' });
  } else {
    track.scrollBy({ left: -distance, behavior: 'smooth' });
  }
}

function startAutoSlide() {
  stopAutoSlide();
  autoSlideInterval = setInterval(() => {
    scrollNext();
  }, 3800);
}

function stopAutoSlide() {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
    autoSlideInterval = null;
  }
}

onMounted(() => {
  startAutoSlide();
});

onUnmounted(() => {
  stopAutoSlide();
});
</script>
