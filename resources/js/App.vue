<template>
  <div>
    <!-- Header & Top Announcement Bar -->
    <NavbarHeader
      v-model:activeNav="activeNav"
      :wishlist-count="wishlistItems.length"
      :cart-count="cartTotalQty"
      :claimed-vouchers-count="claimedVouchersCount"
      @open-drawer="openDrawer"
      @toast="showToast"
    />

    <!-- Main Content: Responsive Campaign Hero Slider + Product Categories + New Arrival -->
    <main>
      <HeroSlider
        @claim-voucher="handleClaimVoucher"
        @toast="showToast"
      />

      <ProductCategories
        @select-category="handleSelectCategory"
      />

      <NewArrivalSection
        @add-to-cart="handleAddNewArrivalToCart"
        @view-detail="(product) => showToast('Membuka detail produk ' + product.name)"
        @view-all="showToast('Membuka seluruh katalog produk New Arrival Koafy...')"
      />
    </main>

    <!-- Site Footer (Matching Header Tone & Responsive Web PC / Android / iOS) -->
    <SiteFooter
      @navigate="(nav) => (activeNav = nav)"
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
import { ref, computed } from 'vue';
import NavbarHeader from './components/NavbarHeader.vue';
import HeroSlider from './components/HeroSlider.vue';
import ProductCategories from './components/ProductCategories.vue';
import NewArrivalSection from './components/NewArrivalSection.vue';
import SiteFooter from './components/SiteFooter.vue';
import SideDrawers from './components/SideDrawers.vue';

const activeNav = ref('home');
const activeDrawer = ref(null);
const activeDiscountValue = ref(0);
const claimedVouchersCount = ref(0);

const wishlistItems = ref([
  { id: 'w1', name: 'Koafy Velvet Lip & Brush Set', meta: 'Rosewood Matte • 4.5g', price: 38 },
  { id: 'w2', name: 'Koafy Soft-Square Multi Balm Trio', meta: '3 Shades Set', price: 54 },
]);

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

function handleAddNewArrivalToCart(product) {
  const existing = cartItems.value.find((item) => item.id === product.id);
  if (existing) {
    existing.qty += 1;
  } else {
    cartItems.value.push({
      id: product.id,
      name: product.name,
      meta: `${product.brand} • ${product.volume}`,
      price: product.price,
      qty: 1,
    });
  }
  showToast(`${product.name} ditambahkan ke Shopping Bag!`);
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
