<template>
  <!-- =====================================================================
       PURE IMAGE-ONLY RESPONSIVE HERO SLIDER (REF GAMBAR KOAFY)
       - Card frame with rounded corners
       - Bottom-right pagination indicator inside banner
       - Responsive & balanced on desktop, tablet, Android, and iOS
       ===================================================================== -->
  <section class="hero-section" aria-label="Koafy Campaign Banner Slider">
    <div id="hero-stage-container" class="hero-stage-container">
      <div
        id="hero-viewport"
        class="hero-viewport"
        @mouseenter="pauseAutoSlide"
        @mouseleave="resumeAutoSlide"
        @touchstart.passive="onTouchStart"
        @touchmove.passive="onTouchMove"
        @touchend.passive="onTouchEnd"
      >
        <!-- Left & Right Sleek Navigation Arrows (< and >) -->
        <button
          id="hero-prev"
          type="button"
          class="hero-arrow prev"
          aria-label="Slide Sebelumnya"
          @click.stop="prevSlide"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
          </svg>
        </button>
        <button
          id="hero-next"
          type="button"
          class="hero-arrow next"
          aria-label="Slide Berikutnya"
          @click.stop="nextSlide"
        >
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </button>

        <!-- SLIDES TRACK -->
        <div id="hero-slides-track" class="hero-slides-track">
          <div
            v-for="(slide, index) in slides"
            :key="slide.id"
            class="hero-slide"
            :class="{ active: currentSlide === index }"
            :data-slide-index="index"
            :data-campaign-title="slide.campaignTitle"
            @click="claimSlideVoucher(slide)"
          >
            <img
              :id="'slide-img-' + index"
              class="hero-slide-img"
              :src="slide.src"
              :alt="slide.alt"
              loading="eager"
            />
          </div>
        </div>

        <!-- Pagination Dots Inside Banner at Bottom-Right (SESUAI GAMBAR REFERENSI) -->
        <div class="hero-pagination-dots" role="tablist" aria-label="Navigasi Slide Banner">
          <button
            v-for="(slide, index) in slides"
            :key="'dot-' + slide.id"
            type="button"
            class="hero-dot"
            :class="{ active: currentSlide === index }"
            :aria-label="'Slide ' + (index + 1)"
            @click.stop="selectSlide(index)"
          ></button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const emit = defineEmits(['claim-voucher']);

const slides = ref([
  {
    id: 0,
    campaignTitle: 'Koafy Soft-Square Trio Voucher (Hingga 50K)',
    src: '/images/banner-koafy-trio.jpg',
    alt: 'Koafy Soft-Square Trio Edition',
  },
  {
    id: 1,
    campaignTitle: 'Koafy Butterbalm Duo Special Edition',
    src: '/images/banner-koafy-butterbalm.jpg',
    alt: 'Koafy Butterbalm Duo Edition',
  },
  {
    id: 2,
    campaignTitle: 'Koafy Healthy Barrier Edition',
    src: '/images/banner-healthy-barrier.jpg',
    alt: 'Koafy Healthy Barrier Edition',
  },
]);

const currentSlide = ref(0);
let autoSlideInterval = null;
let touchStartX = 0;
let touchStartY = 0;

function goToSlide(index) {
  const total = slides.value.length;
  currentSlide.value = (index + total) % total;
}

function selectSlide(index) {
  goToSlide(index);
  resetAutoSlide();
}

function prevSlide() {
  goToSlide(currentSlide.value - 1);
  resetAutoSlide();
}

function nextSlide() {
  goToSlide(currentSlide.value + 1);
  resetAutoSlide();
}

function startAutoSlide() {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
  autoSlideInterval = setInterval(() => {
    goToSlide(currentSlide.value + 1);
  }, 5000);
}

function pauseAutoSlide() {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
    autoSlideInterval = null;
  }
}

function resumeAutoSlide() {
  startAutoSlide();
}

function resetAutoSlide() {
  pauseAutoSlide();
  resumeAutoSlide();
}

function onTouchStart(e) {
  if (e.changedTouches && e.changedTouches.length > 0) {
    touchStartX = e.changedTouches[0].clientX;
    touchStartY = e.changedTouches[0].clientY;
  }
}

function onTouchMove(e) {
  // Passive touch tracking
}

function onTouchEnd(e) {
  if (e.changedTouches && e.changedTouches.length > 0) {
    const touchEndX = e.changedTouches[0].clientX;
    const touchEndY = e.changedTouches[0].clientY;
    const swipeDistanceX = touchEndX - touchStartX;
    const swipeDistanceY = touchEndY - touchStartY;
    if (Math.abs(swipeDistanceX) > 35 && Math.abs(swipeDistanceX) > Math.abs(swipeDistanceY) * 1.2) {
      if (swipeDistanceX < 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
  }
}

function claimSlideVoucher(slide) {
  emit('claim-voucher', slide);
}

onMounted(() => {
  startAutoSlide();
});

onUnmounted(() => {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
});
</script>
