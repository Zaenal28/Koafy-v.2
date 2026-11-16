<template>
  <!-- =====================================================================
       PURE IMAGE-ONLY RESPONSIVE HERO SLIDER
       ===================================================================== -->
  <section class="hero-section" aria-label="Koafy Campaign Banner Slider">
    <div id="hero-stage-container" class="hero-stage-container">
      <div
        id="hero-viewport"
        class="hero-viewport"
        @touchstart.passive="onTouchStart"
        @touchend.passive="onTouchEnd"
      >
        <!-- Left & Right Circular Navigation Arrows (< and >) -->
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
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Pagination Dots Centered Below Banner -->
    <div class="hero-pagination-bar" role="tablist" aria-label="Navigasi Slide Banner">
      <button
        v-for="(slide, index) in slides"
        :key="'dot-' + slide.id"
        type="button"
        class="hero-dot"
        :class="{ active: currentSlide === index }"
        :aria-label="'Slide ' + (index + 1)"
        @click="selectSlide(index)"
      ></button>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const emit = defineEmits(['claim-voucher']);

const slides = ref([
  {
    id: 0,
    campaignTitle: 'Koafy Healthy Barrier, Happy Bestie Voucher (Hingga 50K)',
    src: '/images/banner-healthy-barrier.jpg',
    alt: 'Koafy by HSK Secret - Healthy Barrier, Happy Bestie',
  },
  {
    id: 1,
    campaignTitle: 'Koafy Soft-Square Trio Voucher (Hingga 50K)',
    src: '/images/banner-koafy-trio.jpg',
    alt: 'Koafy by HSK Secret - Soft-Square Trio Edition',
  },
]);

const currentSlide = ref(0);
let autoSlideInterval = null;
let touchStartX = 0;

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
  autoSlideInterval = setInterval(() => {
    goToSlide(currentSlide.value + 1);
  }, 5500);
}

function resetAutoSlide() {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval);
  }
  startAutoSlide();
}

function onTouchStart(e) {
  if (e.changedTouches && e.changedTouches.length > 0) {
    touchStartX = e.changedTouches[0].screenX;
  }
}

function onTouchEnd(e) {
  if (e.changedTouches && e.changedTouches.length > 0) {
    const touchEndX = e.changedTouches[0].screenX;
    const swipeDistance = touchEndX - touchStartX;
    if (Math.abs(swipeDistance) > 40) {
      if (swipeDistance < 0) {
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
