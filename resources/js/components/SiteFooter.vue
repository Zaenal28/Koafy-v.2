<template>
  <!-- =====================================================================
       SITE FOOTER (MATCHING HEADER COLOR & TONE + RESPONSIVE PC/ANDROID/IOS)
       ===================================================================== -->
  <footer class="site-footer" aria-label="Koafy by HSK Secret Footer">
    <div class="footer-container">

      <!-- TOP SECTION: 4 COLUMNS (Brand | Informasi HSK | Layanan | Contact Card) -->
      <div class="footer-top-grid">

        <!-- COL 1: Logo (Same as Header) + HSK SECRET + Description -->
        <div class="footer-brand-col">
          <a href="#home" class="footer-logo-link" @click.prevent="$emit('navigate', 'home')">
            <img
              src="/images/koafy-logo.png"
              alt="Koafy by HSK Secret"
              class="footer-logo-img"
            />
          </a>
          <h3 class="footer-brand-heading">HSK SECRET</h3>
          <p class="footer-brand-desc">
            {{ t('footerBrandDesc') }}
          </p>
        </div>

        <!-- COL 2: INFORMASI HSK -->
        <div class="footer-nav-col">
          <h4 class="footer-col-title">{{ t('footerInfoHsk') }}</h4>
          <ul class="footer-link-list">
            <li>
              <a href="#tentang-hsk" class="footer-link" @click.prevent="$emit('toast', 'Membuka halaman Tentang HSK')">
                <svg class="footer-link-icon" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <span>{{ t('footerAbout') }}</span>
              </a>
            </li>
            <li>
              <a href="#bantuan" class="footer-link" @click.prevent="$emit('toast', 'Membuka halaman Pusat Bantuan')">
                <svg class="footer-link-icon" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                </svg>
                <span>{{ t('footerHelp') }}</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- COL 3: LAYANAN -->
        <div class="footer-nav-col">
          <h4 class="footer-col-title">{{ t('footerServices') }}</h4>
          <ul class="footer-link-list">
            <li>
              <a href="#treatment-klinik" class="footer-link" @click.prevent="$emit('toast', 'Membuka layanan Treatment Klinik')">
                <svg class="footer-link-icon" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                </svg>
                <span>{{ t('footerClinic') }}</span>
              </a>
            </li>
            <li>
              <a href="#belanja-skincare" class="footer-link" @click.prevent="$emit('toast', 'Membuka katalog Belanja Skincare')">
                <svg class="footer-link-icon" fill="none" stroke="currentColor" stroke-width="1.9" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                </svg>
                <span>{{ t('footerShopSkincare') }}</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- COL 4: CONTACT HSK SECRET CARD -->
        <div class="footer-contact-col">
          <div class="footer-contact-card">
            <h4 class="footer-contact-title">{{ t('footerContact') }}</h4>

            <a
              href="https://wa.me/6281809607187"
              target="_blank"
              rel="noopener noreferrer"
              class="footer-contact-item"
            >
              <span class="footer-contact-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.85" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
              </span>
              <span class="footer-contact-text">+62 818-0960-7187</span>
            </a>

            <a
              href="mailto:CS@hsksecret.id"
              class="footer-contact-item"
            >
              <span class="footer-contact-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.85" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
              </span>
              <span class="footer-contact-text">CS@hsksecret.id</span>
            </a>
          </div>
        </div>

      </div>

      <!-- DIVIDER LINE -->
      <div class="footer-divider"></div>

      <!-- BOTTOM SECTION: PENGIRIMAN & PENGAMBILAN + METODE PEMBAYARAN -->
      <div class="footer-bottom-row">

        <!-- Left: Pengiriman & Pengambilan -->
        <div class="footer-partner-group">
          <h5 class="footer-partner-title">{{ currentLang === 'en' ? 'Shipping & Pickup' : 'Pengiriman & Pengambilan' }}</h5>
          <div class="footer-badges-row">
            <!-- SiCepat Ekspres Badge -->
            <div class="footer-badge-pill">
              <span class="badge-sicepat">
                <span class="sicepat-icon">⚡</span>
                <span>SICEPAT<small>EKSPRES</small></span>
              </span>
            </div>

            <!-- Ambil di KLINIK Badge -->
            <div class="footer-badge-pill">
              <span class="badge-klinik">
                <svg width="16" height="16" fill="none" stroke="#F51487" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>
                <span class="klinik-label">
                  <small>{{ currentLang === 'en' ? 'Pickup at' : 'Ambil di' }}</small>
                  <strong>KLINIK</strong>
                </span>
              </span>
            </div>
          </div>
        </div>

        <!-- Right: Metode Pembayaran -->
        <div class="footer-partner-group">
          <h5 class="footer-partner-title">{{ currentLang === 'en' ? 'Payment Methods' : 'Metode Pembayaran' }}</h5>
          <div class="footer-badges-row payment-badges-grid">
            <!-- BCA -->
            <div class="footer-badge-pill">
              <span class="pay-bca">BCA</span>
            </div>
            <!-- BRI -->
            <div class="footer-badge-pill">
              <span class="pay-bri">BRI</span>
            </div>
            <!-- BNI -->
            <div class="footer-badge-pill">
              <span class="pay-bni">BNI</span>
            </div>
            <!-- PermataBank -->
            <div class="footer-badge-pill">
              <span class="pay-permata">PermataBank</span>
            </div>
            <!-- VISA -->
            <div class="footer-badge-pill">
              <span class="pay-visa">VISA</span>
            </div>
            <!-- ATM Bersama -->
            <div class="footer-badge-pill">
              <span class="pay-atm">ATM<small>Bersama</small></span>
            </div>
            <!-- LinkAja -->
            <div class="footer-badge-pill">
              <span class="pay-linkaja">LinkAja!</span>
            </div>
            <!-- Alfamart -->
            <div class="footer-badge-pill">
              <span class="pay-alfamart">Alfamart</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </footer>
</template>

<script setup>
import { currentLang, t } from '../i18n.js';

defineEmits(['navigate', 'toast']);
</script>
