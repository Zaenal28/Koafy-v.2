<template>
  <!-- =====================================================================
       PRODUCT DETAIL PAGE COMPONENT
       - Ref Image 1: Gallery with Arrows & Thumbnails, Meta, Tabs
       - Ref Image 2: Dynamic Shade Swatches with Image Switching
       - Ref Image 3: "Tambahkan ke Favorit", "Tambah ke Cart", "Beli Sekarang"
       ===================================================================== -->
  <section class="product-detail-section" aria-label="Detail Produk Koafy">
    <div class="product-detail-container">

      <!-- Breadcrumbs & Back Navigation -->
      <nav class="detail-breadcrumb" aria-label="Breadcrumb">
        <button type="button" class="breadcrumb-back-btn" @click="$emit('back-to-home')">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
          </svg>
          <span>Kembali ke Beranda</span>
        </button>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item">Katalog Produk</span>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">{{ currentProduct.name }}</span>
      </nav>

      <!-- Main 2-Column Product Detail Layout (Desktop: 2 Col, Mobile: 1 Col) -->
      <div class="product-detail-grid">

        <!-- LEFT COLUMN: Image Gallery (Main Image with Arrows + Thumbnail Strip) -->
        <div class="detail-gallery-col">
          <div class="detail-main-media">
            <span class="detail-badge-discount">{{ currentProduct.badge || '-22%' }}</span>

            <!-- Main Product Image -->
            <img
              :src="activeImage"
              :alt="currentProduct.name"
              class="detail-main-img"
            />

            <!-- Gallery Navigation Arrows (< and >) -->
            <button
              type="button"
              class="gallery-arrow prev"
              aria-label="Foto sebelumnya"
              @click="prevGalleryImage"
            >
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
              </svg>
            </button>
            <button
              type="button"
              class="gallery-arrow next"
              aria-label="Foto berikutnya"
              @click="nextGalleryImage"
            >
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
              </svg>
            </button>
          </div>

          <!-- Thumbnails Strip (Click to change main image) -->
          <div class="detail-thumbnails-row">
            <button
              v-for="(thumb, idx) in galleryImages"
              :key="'thumb-' + idx"
              type="button"
              class="detail-thumb-btn"
              :class="{ active: activeImageIndex === idx }"
              @click="selectGalleryImage(idx)"
            >
              <img :src="thumb" :alt="'Thumbnail ' + (idx + 1)" class="detail-thumb-img" />
            </button>
          </div>
        </div>

        <!-- RIGHT COLUMN: Product Info, Shades, Sizes, Qty & Action Buttons -->
        <div class="detail-info-col">
          <!-- Category & Stock Status -->
          <div class="detail-category-row">
            <span class="detail-category-tag">{{ currentProduct.brand || 'KOAFY PARIS' }}</span>
            <span class="detail-stock-badge">
              <span class="stock-dot"></span> In Stock (Tersedia)
            </span>
          </div>

          <!-- Product Title -->
          <h1 class="detail-title">{{ currentProduct.name }}</h1>

          <!-- Star Rating & Review Count -->
          <div class="detail-rating-row">
            <div class="detail-stars">
              <svg
                v-for="s in 5"
                :key="s"
                width="16"
                height="16"
                viewBox="0 0 20 20"
                fill="#FF9E00"
              >
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
            <span class="detail-rating-score">4.9</span>
            <span class="detail-rating-reviews">(245 Reviews)</span>
          </div>

          <!-- Price & Old Strikethrough Price -->
          <div class="detail-price-row">
            <span class="detail-price-current">{{ currentProduct.priceFormatted || 'Rp 156.510' }}</span>
            <span class="detail-price-old">{{ currentProduct.oldPriceFormatted || 'Rp 200.000' }}</span>
            <span class="detail-discount-pill">-22% HEMAT</span>
          </div>

          <!-- Short Description -->
          <p class="detail-short-desc">
            Formula inovatif yang dirancang khusus untuk menutrisi, melembapkan, dan memberikan perlindungan skin barrier bibir dengan kilau alami tanpa rasa lengket sepanjang hari.
          </p>

          <!-- ===================================================================
               PILIHAN SHADE (REFERENSI GAMBAR 2)
               - Lingkaran warna dengan outer ring saat aktif
               - Klik shade otomatis mengubah nama shade dan foto produk utama
               =================================================================== -->
          <div class="detail-shade-section">
            <div class="detail-shade-header">
              <span class="shade-label-title">Shade:</span>
              <span class="shade-label-selected">{{ selectedShade.name }}</span>
            </div>

            <div class="detail-shades-row" role="radiogroup" aria-label="Pilih Shade Warna">
              <button
                v-for="shade in shades"
                :key="shade.id"
                type="button"
                class="shade-swatch-btn"
                :class="{ active: selectedShade.id === shade.id }"
                :title="shade.name"
                :aria-label="shade.name"
                @click="selectShade(shade)"
              >
                <span class="shade-swatch-circle" :style="{ backgroundColor: shade.color }"></span>
              </button>
            </div>
          </div>

          <!-- Size / Volume Options -->
          <div class="detail-size-section">
            <span class="detail-size-title">Pilihan Ukuran / Kemasan:</span>
            <div class="detail-sizes-row">
              <button
                v-for="size in sizes"
                :key="size"
                type="button"
                class="size-pill-btn"
                :class="{ active: selectedSize === size }"
                @click="selectedSize = size"
              >
                {{ size }}
              </button>
            </div>
          </div>

          <!-- Quantity Selector & Stock Info -->
          <div class="detail-qty-row">
            <span class="detail-qty-label">Jumlah:</span>
            <div class="detail-qty-counter">
              <button
                type="button"
                class="qty-counter-btn"
                aria-label="Kurangi kuantitas"
                @click="decrementQty"
              >
                −
              </button>
              <span class="qty-counter-val">{{ quantity }}</span>
              <button
                type="button"
                class="qty-counter-btn"
                aria-label="Tambah kuantitas"
                @click="incrementQty"
              >
                +
              </button>
            </div>
            <span class="qty-subtotal-hint">
              Total: <strong>Rp {{ formatRupiah(unitPrice * quantity) }}</strong>
            </span>
          </div>

          <!-- ===================================================================
               ACTION BUTTONS (REFERENSI GAMBAR 3)
               - Atas: "Tambahkan ke Favorit"
               - Bawah: "Tambah ke Cart" & "Beli Sekarang"
               =================================================================== -->
          <div class="detail-action-buttons-group">
            <!-- Row 1: Tambahkan ke Favorit (Full width) -->
            <button
              type="button"
              class="btn-favorite-outline"
              :class="{ favorited: isFavorite }"
              @click="$emit('toggle-favorite', currentProduct)"
            >
              <svg width="20" height="20" :fill="isFavorite ? '#F51487' : 'none'" :stroke="isFavorite ? '#F51487' : 'currentColor'" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
              </svg>
              <span>{{ isFavorite ? 'Sudah Ada di Favorit' : 'Tambahkan ke Favorit' }}</span>
            </button>

            <!-- Row 2: Tambah ke Cart & Beli Sekarang -->
            <div class="detail-cart-buy-row">
              <button
                type="button"
                class="btn-add-cart-outline"
                @click="handleAddToCart"
              >
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>
                <span>Tambah ke Cart</span>
              </button>

              <button
                type="button"
                class="btn-buy-now-solid"
                @click="handleBuyNow"
              >
                <span>Beli Sekarang</span>
              </button>
            </div>
          </div>

          <!-- SKU & Share Meta Details -->
          <div class="detail-meta-box">
            <div class="meta-line">
              <span class="meta-label">SKU:</span>
              <span class="meta-value">KOAFY-LP-2026</span>
            </div>
            <div class="meta-line">
              <span class="meta-label">Kategori:</span>
              <span class="meta-value">Lip Care, Butterbalm, Beauty Routine</span>
            </div>
            <div class="meta-line">
              <span class="meta-label">Bagikan:</span>
              <div class="share-icons-list">
                <button type="button" class="share-icon-btn" title="Bagikan ke WhatsApp" @click="$emit('toast', 'Tautan produk disalin ke WhatsApp')">
                  WA
                </button>
                <button type="button" class="share-icon-btn" title="Bagikan ke Instagram" @click="$emit('toast', 'Tautan produk siap dibagikan ke Instagram')">
                  IG
                </button>
                <button type="button" class="share-icon-btn" title="Salin Tautan" @click="$emit('toast', 'Tautan produk berhasil disalin!')">
                  URL
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ===================================================================
           PRODUCT TABS (Description / Additional Information / Review)
           =================================================================== -->
      <div class="detail-tabs-container">
        <div class="detail-tabs-header" role="tablist">
          <button
            type="button"
            class="detail-tab-btn"
            :class="{ active: activeTab === 'description' }"
            @click="activeTab = 'description'"
          >
            Description
          </button>
          <button
            type="button"
            class="detail-tab-btn"
            :class="{ active: activeTab === 'info' }"
            @click="activeTab = 'info'"
          >
            Additional Information
          </button>
          <button
            type="button"
            class="detail-tab-btn"
            :class="{ active: activeTab === 'reviews' }"
            @click="activeTab = 'reviews'"
          >
            Review (245)
          </button>
        </div>

        <div class="detail-tab-content-panel">
          <!-- Tab 1: Description -->
          <div v-if="activeTab === 'description'" class="tab-pane">
            <h3 class="tab-section-heading">Kelebihan &amp; Formula Utama</h3>
            <p>
              Koafy Crystal Butterbalm Tint menghadirkan formulasi hibrida antara perawatan bibir intensif dan sentuhan warna alami yang segar. Diformulasikan dengan ekstrak Shea Butter murni, Vitamin E, dan Tri-Peptide Complex untuk mengunci kelembapan bibir hingga 12 jam.
            </p>
            <ul class="tab-feature-list">
              <li>✨ Memberikan hidrasi mendalam tanpa rasa lengket ataupun berminyak.</li>
              <li>✨ Warna buildable yang menyatu lembut dengan warna asli bibir Anda.</li>
              <li>✨ Aman untuk bibir sensitif dan pecah-pecah, teruji secara dermatologis.</li>
              <li>✨ Dilengkapi aroma vanilla mawar yang menenangkan dan mewah.</li>
            </ul>
          </div>

          <!-- Tab 2: Additional Information -->
          <div v-if="activeTab === 'info'" class="tab-pane">
            <table class="info-specs-table">
              <tbody>
                <tr>
                  <th>Berat Bersih</th>
                  <td>4.5 Gram / 0.16 oz</td>
                </tr>
                <tr>
                  <th>Nomor Registrasi BPOM</th>
                  <td>NA18241300892 (Resmi &amp; Terverifikasi)</td>
                </tr>
                <tr>
                  <th>Kandungan Kunci</th>
                  <td>Shea Butter, Jojoba Oil, Ceramide NP, Peptide, Vitamin E</td>
                </tr>
                <tr>
                  <th>Masa Simpan</th>
                  <td>24 Bulan dari tanggal produksi (12 Bulan setelah kemasan dibuka)</td>
                </tr>
                <tr>
                  <th>Sertifikasi</th>
                  <td>100% Halal MUI &amp; Cruelty-Free</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Tab 3: Reviews -->
          <div v-if="activeTab === 'reviews'" class="tab-pane">
            <div class="reviews-summary-box">
              <div class="summary-score-col">
                <span class="big-score">4.9</span>
                <div class="detail-stars">
                  <svg v-for="s in 5" :key="s" width="18" height="18" viewBox="0 0 20 20" fill="#FF9E00">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                </div>
                <span class="summary-count">Berdasarkan 245 Ulasan Pembeli</span>
              </div>
            </div>

            <div class="customer-reviews-list">
              <div class="review-item-card">
                <div class="reviewer-header">
                  <div class="reviewer-avatar">AN</div>
                  <div>
                    <strong class="reviewer-name">Audrey Natalia</strong>
                    <span class="verified-badge">✔ Pembeli Terverifikasi</span>
                  </div>
                  <span class="review-date">2 hari yang lalu</span>
                </div>
                <div class="review-stars-row">
                  ⭐⭐⭐⭐⭐ <span class="review-shade-bought">Shade: Rd01 Soft Mauve</span>
                </div>
                <p class="review-comment">
                  Suka banget sama teksturnya! Bener-bener melting di bibir dan warnanya natural bikin wajah kelihatan segar seketika. Packaging-nya juga cantik dan kokoh. Bakal repurchase shade lainnya!
                </p>
              </div>

              <div class="review-item-card">
                <div class="reviewer-header">
                  <div class="reviewer-avatar">CL</div>
                  <div>
                    <strong class="reviewer-name">Clarissa L.</strong>
                    <span class="verified-badge">✔ Pembeli Terverifikasi</span>
                  </div>
                  <span class="review-date">5 hari yang lalu</span>
                </div>
                <div class="review-stars-row">
                  ⭐⭐⭐⭐⭐ <span class="review-shade-bought">Shade: Pk04 Berry Mauve</span>
                </div>
                <p class="review-comment">
                  Warnanya keluar banget tapi tetap melembapkan seharian. Biasanya pakai lip product lain bibir gampang ngelupas, pakai Koafy ini bibir tetap halus dan plump!
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
  product: {
    type: Object,
    default: () => ({}),
  },
  isFavorite: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits([
  'back-to-home',
  'add-to-cart',
  'buy-now',
  'toggle-favorite',
  'toast',
]);

const currentProduct = computed(() => {
  return props.product && props.product.name
    ? props.product
    : {
        id: 'na-1',
        brand: 'KOAFY PARIS',
        name: 'Koafy Crystal Butterbalm Tint — Rosewood Glow',
        price: 38,
        priceFormatted: 'Rp 156.510',
        oldPriceFormatted: 'Rp 200.000',
        image: '/images/product-butterbalm-1.jpg',
      };
});

// Pilihan Warna / Shade (Referensi Gambar 2)
const shades = ref([
  { id: 's1', code: 'Rd01', name: 'Rd01 Soft Mauve', color: '#C87B8E', image: '/images/product-butterbalm-1.jpg' },
  { id: 's2', code: 'Or02', name: 'Or02 Sunset Coral', color: '#DF6953', image: '/images/product-butterbalm-2.jpg' },
  { id: 's3', code: 'Pk03', name: 'Pk03 Rose Petal', color: '#D26782', image: '/images/product-lip-velvet.jpg' },
  { id: 's4', code: 'Pk04', name: 'Pk04 Berry Mauve', color: '#D97C95', image: '/images/product-butterbalm-2.jpg' },
  { id: 's5', code: 'Rd05', name: 'Rd05 Crimson Ruby', color: '#D2374E', image: '/images/product-butterbalm-1.jpg' },
  { id: 's6', code: 'Br06', name: 'Br06 Warm Brick', color: '#A04739', image: '/images/product-butterbalm-duo.jpg' },
]);

const selectedShade = ref(shades.value[0]);
const sizes = ['4.5 Gram (Standar)', 'Set Duo Bundle', 'Trio Compact Set'];
const selectedSize = ref('4.5 Gram (Standar)');
const quantity = ref(1);
const activeTab = ref('description');

// Image Gallery
const galleryImages = ref([
  '/images/product-butterbalm-1.jpg',
  '/images/product-butterbalm-2.jpg',
  '/images/product-lip-velvet.jpg',
  '/images/product-butterbalm-duo.jpg',
]);

const activeImageIndex = ref(0);
const activeImage = computed(() => galleryImages.value[activeImageIndex.value]);

watch(
  () => props.product,
  (newVal) => {
    if (newVal && newVal.image) {
      if (!galleryImages.value.includes(newVal.image)) {
        galleryImages.value[0] = newVal.image;
      }
      activeImageIndex.value = 0;
    }
  },
  { immediate: true }
);

function selectGalleryImage(idx) {
  activeImageIndex.value = idx;
}

function nextGalleryImage() {
  activeImageIndex.value = (activeImageIndex.value + 1) % galleryImages.value.length;
}

function prevGalleryImage() {
  activeImageIndex.value =
    (activeImageIndex.value - 1 + galleryImages.value.length) % galleryImages.value.length;
}

function selectShade(shade) {
  selectedShade.value = shade;
  // Automatically switch the gallery main image to match selected shade
  const existingIdx = galleryImages.value.indexOf(shade.image);
  if (existingIdx > -1) {
    activeImageIndex.value = existingIdx;
  } else {
    galleryImages.value.unshift(shade.image);
    activeImageIndex.value = 0;
  }
  emit('toast', `Shade terpilih: ${shade.name}`);
}

function incrementQty() {
  quantity.value += 1;
}

function decrementQty() {
  if (quantity.value > 1) {
    quantity.value -= 1;
  }
}

const unitPrice = 156510;

function formatRupiah(val) {
  return val.toLocaleString('id-ID');
}

function handleAddToCart() {
  emit('add-to-cart', {
    ...currentProduct.value,
    selectedShade: selectedShade.value.name,
    selectedSize: selectedSize.value,
    qty: quantity.value,
  });
  emit('toast', `${currentProduct.value.name} (${selectedShade.value.name}) berhasil ditambahkan ke Shopping Bag!`);
}

function handleBuyNow() {
  emit('buy-now', {
    ...currentProduct.value,
    selectedShade: selectedShade.value.name,
    selectedSize: selectedSize.value,
    qty: quantity.value,
  });
}
</script>
