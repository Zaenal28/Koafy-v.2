<template>
  <!-- =====================================================================
       ABOUT US / TENTANG KAMI PAGE
       - Reference Image 3: Hero section with staggered imagery & tag pills
       - Reference Image 1: Cerita Kami (Featured image left, 3 story cards right)
       - Reference Image 2: Mengapa Memilih Koafy (Timeline/step icons left, image right)
       - Section 4: Komitmen Kami (Elevated brand commitment showcase)
       - Images used: Images 4, 5, 6, 7, 8
       ===================================================================== -->
  <section class="about-page-wrapper" aria-label="Tentang Koafy">
    <div class="about-container">

      <!-- Breadcrumbs Navigation -->
      <nav class="about-breadcrumb" aria-label="Breadcrumb">
        <a href="#home" class="breadcrumb-link" @click.prevent="$emit('back-to-home')">Beranda</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">Tentang Koafy</span>
      </nav>

      <!-- ===============================================================
           SECTION 1: HERO & INTRO (REFERENSI GAMBAR 2 SINGLE IMAGE)
           - 1 Featured Model Image (about-hero-cushion.webp)
           - Welcome lead text & tag pills below
           =============================================================== -->
      <section class="about-hero-section">
        <div class="about-hero-header">
          <span class="about-section-tag">TENTANG KOAFY</span>
          <h1 class="about-hero-title">
            Ruang Kecantikan Modern yang Merayakan Pesona Perempuan Indonesia
          </h1>
        </div>

        <div class="about-single-hero-container">
          <!-- Featured Image Card (1 Image seperti Gambar 2) -->
          <div class="about-image-card about-hero-main-card">
            <img
              src="/images/about/about-hero-cushion.webp"
              alt="Model Koafy Cushion - Flawless Skin Barrier"
              class="about-img-fluid about-single-hero-img"
              loading="eager"
            />
            <div class="img-badge-overlay">
              <span class="badge-dot"></span>
              <span>Flawless Skin Barrier</span>
            </div>
          </div>

          <!-- Intro Text Box (Sesuai Teks User) -->
          <div class="about-intro-text-box">
            <p class="about-paragraph-lead">
              Selamat datang di <strong>Koafy</strong>, ruang kecantikan modern yang merayakan pesona setiap perempuan Indonesia. Kami percaya bahwa makeup terbaik adalah yang membuat Anda merasa nyaman, percaya diri, dan tetap menjadi diri sendiri—baik saat menjalani rutinitas padat maupun di momen paling istimewa.
            </p>

            <!-- Tag Pills (Ref Gambar 3) -->
            <div class="about-tag-pills-row">
              <span class="about-tag-pill">Nyaman &amp; Percaya Diri</span>
              <span class="about-tag-pill">Kecantikan Alami</span>
              <span class="about-tag-pill">Kulit Tropis Sehat</span>
              <span class="about-tag-pill">Self-Care Ritual</span>
              <span class="about-tag-pill">Modern Beauty</span>
              <span class="about-tag-pill">Elegan</span>
            </div>
          </div>
        </div>
      </section>

      <!-- ===============================================================
           SECTION 2: CERITA KAMI (REFERENSI GAMBAR 1)
           - Left: Image 6 (about-story-cleanser.jpg)
           - Right: 3 Value Blocks & Story Paragraphs
           =============================================================== -->
      <section class="about-story-section">
        <div class="story-grid-layout">

          <!-- Left Column: Large Image (Image 6) -->
          <div class="story-image-column">
            <div class="story-image-card">
              <img
                src="/images/about/about-story-cleanser.jpg"
                alt="Cerita Koafy Beauty Care"
                class="story-img-main"
              />
              <div class="story-float-card">
                <div class="float-card-icon">🌿</div>
                <div class="float-card-content">
                  <span class="float-card-title">Formula Ramah Kulit</span>
                  <span class="float-card-sub">Dirancang khusus untuk iklim tropis</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column: 3 Story Cards / Content (Sesuai Teks User) -->
          <div class="story-content-column">
            <div class="story-header-wrap">
              <span class="about-section-tag">OUR JOURNEY</span>
              <h2 class="about-section-heading">Cerita Kami</h2>
            </div>

            <div class="story-cards-stack">
              <!-- Item 1 -->
              <div class="story-value-block">
                <h3 class="story-value-title">Lahir untuk Menemani Setiap Perjalanan Anda</h3>
                <p class="story-value-desc">
                  Berawal dari keinginan menghadirkan kosmetik berkualitas premium yang praktis dan ramah di kulit tropis, Koafy lahir untuk menemani setiap fase perjalanan Anda.
                </p>
              </div>

              <!-- Item 2 -->
              <div class="story-value-block">
                <h3 class="story-value-title">Menuju 2027: Perawatan Klinik &amp; Makeup Terintegrasi</h3>
                <p class="story-value-desc">
                  Memasuki tahun 2027, kami terus mendampingi perjalanan kesehatan kulit Anda melalui layanan perawatan klinik bersama dokter ahli, serta produk makeup berkualitas tinggi yang disesuaikan dengan jenis kulit atau kebutuhan kulit Anda.
                </p>
              </div>

              <!-- Item 3 -->
              <div class="story-value-block">
                <h3 class="story-value-title">Untuk Remaja, Profesional, hingga MUA</h3>
                <p class="story-value-desc">
                  Mulai dari remaja yang baru mulai bereksplorasi, pekerja kantoran yang membutuhkan riasan tahan lama seharian, hingga para Makeup Artist (MUA) profesional yang menuntut hasil akhir sempurna di setiap pulasan.
                </p>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- ===============================================================
           SECTION 3: MENGAPA MEMILIH KOAFY? (REFERENSI GAMBAR 2)
           - Left: Headline & 4 Step/Timeline Points with Icons
           - Right: Image 7 (about-why-swatches.png)
           =============================================================== -->
      <section class="about-why-section">
        <div class="why-grid-layout">

          <!-- Left Column: Timeline / Steps with Icons (Ref Gambar 2) -->
          <div class="why-content-column">
            <span class="about-section-tag">KEUNGGULAN KAMI</span>
            <h2 class="about-section-heading">Mengapa Memilih Koafy?</h2>
            <p class="why-section-sub">
              Dedikasi kami untuk menghadirkan kualitas terbaik di setiap pulasan riasan Anda.
            </p>

            <div class="why-steps-timeline">
              <!-- Step 1: Formula Nyaman & Tahan Lama -->
              <div class="why-step-item">
                <div class="step-badge-circle">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                  </svg>
                </div>
                <div class="step-text-wrap">
                  <h3 class="step-title">Formula Nyaman &amp; Tahan Lama</h3>
                  <p class="step-desc">
                    Tekstur ringan yang menyatu alami di kulit tanpa terasa berat, diperkaya bahan perawatan kulit agar wajah tetap sehat terhidrasi.
                  </p>
                </div>
              </div>

              <!-- Step 2: Pilihan Warna Inklusif -->
              <div class="why-step-item">
                <div class="step-badge-circle">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                  </svg>
                </div>
                <div class="step-text-wrap">
                  <h3 class="step-title">Pilihan Warna Inklusif</h3>
                  <p class="step-desc">
                    Kurasi shade elegan yang dirancang khusus untuk menonjolkan keindahan alami berbagai warna dan undertone kulit wanita Indonesia.
                  </p>
                </div>
              </div>

              <!-- Step 3: Aman & Terpercaya -->
              <div class="why-step-item">
                <div class="step-badge-circle">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                  </svg>
                </div>
                <div class="step-text-wrap">
                  <h3 class="step-title">Aman &amp; Terpercaya</h3>
                  <p class="step-desc">
                    Seluruh rangkaian produk Koafy telah teruji secara dermatologis, terdaftar resmi di BPOM, halal, serta cruelty-free.
                  </p>
                </div>
              </div>

              <!-- Step 4: Kualitas Profesional, Praktis Digunakan -->
              <div class="why-step-item">
                <div class="step-badge-circle">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                  </svg>
                </div>
                <div class="step-text-wrap">
                  <h3 class="step-title">Kualitas Profesional, Praktis Digunakan</h3>
                  <p class="step-desc">
                    Mudah diaplikasikan bahkan oleh pemula, namun memiliki pigmentasi tinggi yang dapat diandalkan oleh para MUA.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column: Image 7 (about-why-swatches.png) -->
          <div class="why-image-column">
            <div class="why-image-card">
              <img
                src="/images/about/about-why-swatches.png"
                alt="Koafy Foundation Swatches & Shade Diversity"
                class="why-img-main"
              />
              <div class="why-stamp-badge">
                <span class="stamp-icon">✓</span>
                <span class="stamp-text">Teruji Dermatologis &amp; BPOM</span>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!-- ===============================================================
           SECTION 4: KOMITMEN KAMI (SHOWCASE BANNER DENGAN GAMBAR 8)
           - Image 8: about-commitment-mua.png
           - Statement, Trust Badges, and Action Button
           =============================================================== -->
      <section class="about-commitment-section">
        <div class="commitment-card">
          <div class="commitment-grid">

            <!-- Text Content Left -->
            <div class="commitment-content">
              <span class="commitment-tag">KOMITMEN KAMI</span>
              <h2 class="commitment-heading">
                Kemewahan Sejati dalam Setiap Rasa Percaya Diri Anda
              </h2>

              <p class="commitment-quote">
                "Bagi kami, kemewahan sejati terletak pada kualitas dan rasa percaya diri yang Anda pancarkan. Koafy berkomitmen untuk terus menghadirkan inovasi makeup yang elegan, aman, dan relevan bagi setiap generasi."
              </p>

              <!-- Trust Guarantee Badges -->
              <div class="commitment-badges-grid">
                <div class="c-badge-pill">
                  <span class="c-badge-icon">🌿</span>
                  <span>BPOM Terdaftar</span>
                </div>
                <div class="c-badge-pill">
                  <span class="c-badge-icon">✨</span>
                  <span>Halal Certified</span>
                </div>
                <div class="c-badge-pill">
                  <span class="c-badge-icon">🐰</span>
                  <span>Cruelty-Free</span>
                </div>
                <div class="c-badge-pill">
                  <span class="c-badge-icon">🔬</span>
                  <span>Dermatologist Tested</span>
                </div>
              </div>

              <!-- Button CTA -->
              <div class="commitment-action-row">
                <button
                  type="button"
                  class="btn-about-shop"
                  @click="$emit('explore-products')"
                >
                  Jelajahi Koleksi Koafy
                  <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Image 8 Right -->
            <div class="commitment-image-wrap">
              <img
                src="/images/about/about-commitment-mua.png"
                alt="Koafy Brand Ambassador & Professional Glam"
                class="commitment-img"
              />
            </div>

          </div>
        </div>
      </section>

    </div>
  </section>
</template>

<script setup>
const emit = defineEmits(['back-to-home', 'explore-products', 'toast']);
</script>
