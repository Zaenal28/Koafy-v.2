<template>
  <!-- =====================================================================
       KOAFY MAKEUP CONTENT SECTION (DIBAWAH NEW ARRIVAL)
       - Referensi Tata Letak: Gambar 1
       - Model Gambar 2: Cushion Application (Glow Cheek)
       - Model Gambar 3: Lip Tint Application (Glam Lip)
       ===================================================================== -->
  <section class="koafy-makeup-story-section" aria-label="Koafy Makeup Beauty Philosophy">
    <div class="makeup-story-container">

      <div class="makeup-story-grid">

        <!-- LEFT COLUMN: Large Vertical Model Image (Model Gambar 3: Lip Application) -->
        <div class="story-left-col">
          <div class="story-image-card-tall">
            <img
              src="/images/koafy-makeup-lip.jpg"
              alt="Koafy Makeup — Radiant Velvet Lip Tint"
              class="story-img-tall"
              loading="lazy"
            />
            <div class="image-subtle-overlay">
              <span class="image-subtle-tag">KOAFY MAKEUP</span>
            </div>
          </div>
        </div>

        <!-- RIGHT COLUMN: Manifesto Quote + Bottom Split (Info Card + Model Cushion) -->
        <div class="story-right-col">

          <!-- Top: Manifesto Text (Ref Gambar 1: Large typography with Koafy Makeup) -->
          <div class="story-quote-block">
            <h2 class="story-quote-text">
              {{ t('makeupPhilosophyQuote') }}
            </h2>
          </div>

          <!-- Bottom: Split 2-Box Sub-grid (Info Card on Left | Model Cushion on Right) -->
          <div class="story-bottom-split-grid">

            <!-- Sub-Box 1: Info Card with "More About ->" Button -->
            <div class="story-info-card">
              <span class="info-card-badge">KOAFY MAKEUP</span>
              <h3 class="info-card-title">{{ t('beautyBeginsTitle') }}</h3>
              <p class="info-card-desc">
                {{ t('beautyBeginsDesc') }}
              </p>
              <button
                type="button"
                class="btn-story-more"
                aria-label="Lihat Lebih Banyak tentang Koafy Makeup"
                @click="$emit('explore-makeup')"
              >
                <span>{{ t('moreAboutBtn') }}</span>
                <span class="btn-arrow-circle">
                  <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                  </svg>
                </span>
              </button>
            </div>

            <!-- Sub-Box 2: Model Image (Model Gambar 2: Cushion Application) -->
            <div class="story-image-card-small">
              <img
                src="/images/koafy-makeup-cushion.jpg"
                alt="Koafy Makeup — Flawless Glow Cushion"
                class="story-img-small"
                loading="lazy"
              />
              <div class="image-subtle-overlay">
                <span class="image-subtle-tag">GLOW CUSHION</span>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </section>
</template>

<script setup>
import { t } from '../i18n.js';

defineEmits(['explore-makeup']);
</script>
