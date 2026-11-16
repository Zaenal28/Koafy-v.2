<template>
  <div>
    <!-- Header & Top Announcement Bar (Hidden on dedicated Auth view or shown smoothly) -->
    <NavbarHeader
      v-if="currentView !== 'auth'"
      v-model:activeNav="activeNav"
      :wishlist-count="wishlistItems.length"
      :cart-count="cartTotalQty"
      :claimed-vouchers-count="claimedVouchersCount"
      @open-drawer="openDrawer"
      @open-auth="openAuthPage"
      @toast="showToast"
    />

    <!-- Main Content Area: Home View | Product Detail View | Auth View -->
    <main>
      <!-- 1. HOME VIEW -->
      <template v-if="currentView === 'home'">
        <HeroSlider
          @claim-voucher="handleClaimVoucher"
          @toast="showToast"
        />

        <ProductCategories
          @select-category="handleSelectCategory"
        />

        <NewArrivalSection
          :wishlist-ids="wishlistIds"
          @add-to-cart="handleAddNewArrivalToCart"
          @view-detail="openProductDetail"
          @toggle-favorite="toggleFavorite"
          @view-all="showToast('Membuka seluruh katalog produk New Arrival Koafy...')"
        />
      </template>

      <!-- 2. PRODUCT DETAIL VIEW (Ref Images 1, 2, 3) -->
      <template v-else-if="currentView === 'detail'">
        <ProductDetail
          :product="selectedProduct"
          :is-favorite="wishlistIds.includes(selectedProduct?.id)"
          @back-to-home="backToHome"
          @add-to-cart="handleAddNewArrivalToCart"
          @buy-now="handleBuyNow"
          @toggle-favorite="toggleFavorite"
          @toast="showToast"
        />
      </template>

      <!-- 3. AUTH VIEW (LOGIN & REGISTER - REF IMAGES 1 & 2) -->
      <template v-else-if="currentView === 'auth'">
        <AuthPage
          @back-to-home="backToHome"
          @toast="showToast"
          @login-success="handleLoginSuccess"
        />
      </template>
    </main>

    <!-- Site Footer (Hidden on dedicated Auth view) -->
    <SiteFooter
      v-if="currentView !== 'auth'"
      @navigate="handleFooterNavigate"
      @toast="showToast"
    />

    <!-- Slide-over Drawers (Wishlist, Shopping Bag, Mobile Menu) -->
    <SideDrawers
      v-model:activeNav="activeNav"
      :active-drawer="activeDrawer"
      :wishlist-items="wishlistItems"
      :cart-items="cartItems"
      :active-discount-value="activeDiscountValue"
      @close-drawers="closeAllDrawers"
      @open-auth="openAuthPage"
      @move-to-cart="moveToCart"
      @move-all-to-cart="moveAllToCart"
      @change-qty="changeCartQty"
      @checkout="handleCheckout"
    />

    <!-- Toast Feedback -->
    <div id="koafy-toast" class="koafy-toast" :class="{ show: toastVisible }">
      {{ toastMessage }}
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import NavbarHeader from './components/NavbarHeader.vue';
import HeroSlider from './components/HeroSlider.vue';
import ProductCategories from './components/ProductCategories.vue';
import NewArrivalSection from './components/NewArrivalSection.vue';
import ProductDetail from './components/ProductDetail.vue';
import SiteFooter from './components/SiteFooter.vue';
import SideDrawers from './components/SideDrawers.vue';
import AuthPage from './components/AuthPage.vue';

const activeNav = ref('home');
const currentView = ref('home'); // 'home' | 'detail' | 'auth'
const selectedProduct = ref(null);

const activeDrawer = ref(null);
const activeDiscountValue = ref(0);
const claimedVouchersCount = ref(0);

const wishlistItems = ref([
  { id: 'w1', name: 'Koafy Velvet Lip & Brush Set', meta: 'Rosewood Matte • 4.5g', price: 38 },
  { id: 'w2', name: 'Koafy Soft-Square Multi Balm Trio', meta: '3 Shades Set', price: 54 },
]);

const wishlistIds = computed(() => wishlistItems.value.map((item) => item.id));

const cartItems = ref([
  { id: 'c1', name: 'Koafy Crystal Butterbalm Duo', meta: 'Rosewood & Mauve', price: 68, qty: 1 },
  { id: 'c2', name: 'HSK Secret Pink Radiance Cream', meta: '50 ml • Brightening', price: 42, qty: 2 },
]);

const cartTotalQty = computed(() =>
  cartItems.value.reduce((sum, item) => sum + item.qty, 0)
);

const toastMessage = ref('');
const toastVisible = ref(false);
let toastTimer = null;

function showToast(message) {
  toastMessage.value = message;
  toastVisible.value = true;
  if (toastTimer) {
    clearTimeout(toastTimer);
  }
  toastTimer = setTimeout(() => {
    toastVisible.value = false;
  }, 2800);
}

function openDrawer(drawerName) {
  activeDrawer.value = drawerName;
}

function closeAllDrawers() {
  activeDrawer.value = null;
}

function handleClaimVoucher(slide) {
  activeDiscountValue.value = 50;
  claimedVouchersCount.value = 5;
  showToast(`${slide.campaignTitle} berhasil diklaim & diterapkan ke Shopping Bag!`);
}

function handleSelectCategory(cat) {
  showToast(`Menampilkan kategori produk: ${cat.name}`);
}

function openProductDetail(product) {
  selectedProduct.value = product;
  currentView.value = 'detail';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openAuthPage() {
  currentView.value = 'auth';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function handleLoginSuccess(user) {
  showToast(`Selamat datang, ${user.name || 'Member Koafy'}! Akun Anda siap digunakan.`);
  backToHome();
}

function backToHome() {
  currentView.value = 'home';
  activeNav.value = 'home';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

watch(activeNav, (newNav) => {
  if (newNav === 'home') {
    currentView.value = 'home';
  }
});

function handleFooterNavigate(nav) {
  activeNav.value = nav;
  if (nav === 'home') {
    backToHome();
  }
}

function toggleFavorite(product) {
  const idx = wishlistItems.value.findIndex((item) => item.id === product.id);
  if (idx > -1) {
    wishlistItems.value.splice(idx, 1);
    showToast(`${product.name} dihapus dari Favorit`);
  } else {
    wishlistItems.value.push({
      id: product.id,
      name: product.name,
      meta: `${product.brand || 'KOAFY'} • ${product.volume || '4.5g'}`,
      price: product.price || 38,
    });
    showToast(`${product.name} ditambahkan ke Favorit ❤️`);
  }
}

function handleAddNewArrivalToCart(product) {
  const addQty = product.qty || 1;
  const existing = cartItems.value.find((item) => item.id === product.id);
  if (existing) {
    existing.qty += addQty;
  } else {
    cartItems.value.push({
      id: product.id,
      name: product.name,
      meta: product.selectedShade
        ? `${product.brand || 'KOAFY'} • ${product.selectedShade}`
        : `${product.brand || 'KOAFY'} • ${product.volume || 'Standar'}`,
      price: product.price || 38,
      qty: addQty,
    });
  }
  showToast(`${product.name} (${addQty} item) ditambahkan ke Shopping Bag!`);
}

function handleBuyNow(product) {
  handleAddNewArrivalToCart(product);
  openDrawer('cart');
}

function moveToCart(itemId) {
  const idx = wishlistItems.value.findIndex((x) => x.id === itemId);
  if (idx > -1) {
    const moved = wishlistItems.value.splice(idx, 1)[0];
    cartItems.value.push({ ...moved, qty: 1 });
    showToast(`${moved.name} dipindahkan ke keranjang!`);
  }
}

function moveAllToCart() {
  if (!wishlistItems.value.length) return;
  wishlistItems.value.forEach((item) => {
    cartItems.value.push({ ...item, qty: 1 });
  });
  wishlistItems.value = [];
  showToast('Semua item favorit berhasil dipindahkan ke keranjang!');
}

function changeCartQty({ id, delta }) {
  const item = cartItems.value.find((x) => x.id === id);
  if (!item) return;
  item.qty += delta;
  if (item.qty <= 0) {
    cartItems.value = cartItems.value.filter((x) => x.id !== id);
  }
}

function handleCheckout() {
  closeAllDrawers();
  showToast('Melanjutkan ke halaman Checkout Koafy...');
}
</script>
