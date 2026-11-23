<template>
  <div>
    <!-- Header & Top Announcement Bar (Hidden on Auth & Admin view) -->
    <NavbarHeader
      v-if="currentView !== 'auth' && currentView !== 'admin'"
      v-model:activeNav="activeNav"
      :user="currentUser"
      :wishlist-count="wishlistItems.length"
      :cart-count="cartTotalQty"
      :claimed-vouchers-count="claimedVouchersCount"
      @open-drawer="openDrawer"
      @open-auth="openAuthPage('login')"
      @open-admin="openAdminPage"
      @open-profile="openUserProfile"
      @toast="showToast"
    />

    <!-- Main Content Area: Home | Detail | Auth | Admin -->
    <main>
      <!-- 1. HOME VIEW (http://127.0.0.1:8000/) -->
      <template v-if="currentView === 'home'">
        <HeroSlider
          @claim-voucher="handleClaimVoucher"
          @toast="showToast"
        />

        <ProductCategories
          @select-category="handleSelectCategory"
        />

        <!-- SECTION FLASH SALE (SEBELUM NEW ARRIVAL SESUAI REQUEST) -->
        <FlashSaleSection
          v-if="isFlashSaleActive"
          :wishlist-ids="wishlistIds"
          @add-to-cart="handleAddNewArrivalToCart"
          @view-detail="openProductDetail"
          @toggle-favorite="toggleFavorite"
          @view-all="openProductsPage('all')"
        />

        <NewArrivalSection
          :wishlist-ids="wishlistIds"
          @add-to-cart="handleAddNewArrivalToCart"
          @view-detail="openProductDetail"
          @toggle-favorite="toggleFavorite"
          @view-all="openProductsPage('all')"
        />

        <!-- SECTION CONTENT KOAFY MAKEUP (DIBAWAH NEW ARRIVAL SESUAI REQUEST) -->
        <KoafyMakeupStorySection
          @explore-makeup="openProductsPage('makeup')"
        />
      </template>

      <!-- 2. ALL PRODUCTS / SHOP ALL CATALOG VIEW (Ref Gambar 1 & Gambar 2) -->
      <template v-else-if="currentView === 'products'">
        <AllProductsPage
          :initial-category="initialCategory"
          :initial-subcategory="initialSubcategory"
          :wishlist-ids="wishlistIds"
          @add-to-cart="handleAddNewArrivalToCart"
          @view-detail="openProductDetail"
          @toggle-favorite="toggleFavorite"
          @back-to-home="backToHome"
          @toast="showToast"
        />
      </template>

      <!-- 3. PRODUCT DETAIL VIEW -->
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

      <!-- 3. AUTH VIEW (http://127.0.0.1:8000/login & http://127.0.0.1:8000/register) -->
      <template v-else-if="currentView === 'auth'">
        <AuthPage
          :initial-mode="authMode"
          @switch-mode="handleAuthSwitchMode"
          @back-to-home="backToHome"
          @toast="showToast"
          @login-success="handleLoginSuccess"
        />
      </template>

      <!-- 4. ADMIN DASHBOARD VIEW (http://127.0.0.1:8000/admin) -->
      <template v-else-if="currentView === 'admin'">
        <AdminDashboard
          v-model:is-flash-sale-active="isFlashSaleActive"
          @go-to-store="backToHome"
          @toast="showToast"
        />
      </template>

      <!-- 5. USER PROFILE & ACCOUNT DASHBOARD VIEW (Ref Gambar 1 & Gambar 2) -->
      <template v-else-if="currentView === 'profile'">
        <UserProfilePage
          v-model:user="currentUser"
          :wishlist-items="wishlistItems"
          :cart-items="cartItems"
          :active-discount-value="activeDiscountValue"
          :initial-tab="userProfileTab"
          @back-to-home="backToHome"
          @toast="showToast"
          @move-to-cart="moveToCart"
          @move-all-to-cart="moveAllToCart"
          @toggle-favorite="toggleFavorite"
          @change-qty="changeCartQty"
          @checkout="handleCheckout"
          @logout="handleLogout"
        />
      </template>
    </main>

    <!-- Site Footer (Hidden on Auth & Admin view) -->
    <SiteFooter
      v-if="currentView !== 'auth' && currentView !== 'admin'"
      @navigate="handleFooterNavigate"
      @toast="showToast"
    />

    <!-- Slide-over Drawers (Hidden on Admin view) -->
    <SideDrawers
      v-if="currentView !== 'admin'"
      v-model:activeNav="activeNav"
      :active-drawer="activeDrawer"
      :wishlist-items="wishlistItems"
      :cart-items="cartItems"
      :active-discount-value="activeDiscountValue"
      @close-drawers="closeAllDrawers"
      @open-auth="openAuthPage('login')"
      @open-admin="openAdminPage"
      @move-to-cart="moveToCart"
      @move-all-to-cart="moveAllToCart"
      @change-qty="changeCartQty"
      @checkout="handleCheckout"
    />

    <!-- Floating WhatsApp Chat CS Admin (Only on E-Commerce Storefront, hidden on admin) -->
    <FloatingWhatsAppChat
      v-if="currentView !== 'admin'"
      @toast="showToast"
    />

    <!-- Toast Feedback -->
    <div id="koafy-toast" class="koafy-toast" :class="{ show: toastVisible }">
      {{ toastMessage }}
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import NavbarHeader from './components/NavbarHeader.vue';
import HeroSlider from './components/HeroSlider.vue';
import ProductCategories from './components/ProductCategories.vue';
import FlashSaleSection from './components/FlashSaleSection.vue';
import NewArrivalSection from './components/NewArrivalSection.vue';
import ProductDetail from './components/ProductDetail.vue';
import SiteFooter from './components/SiteFooter.vue';
import SideDrawers from './components/SideDrawers.vue';
import AuthPage from './components/AuthPage.vue';
import AdminDashboard from './components/AdminDashboard.vue';
import AllProductsPage from './components/AllProductsPage.vue';
import FloatingWhatsAppChat from './components/FloatingWhatsAppChat.vue';
import KoafyMakeupStorySection from './components/KoafyMakeupStorySection.vue';
import UserProfilePage from './components/UserProfilePage.vue';

const defaultUser = {
  name: 'Siti Rahma',
  email: 'siti.rahma@example.com',
  phone: '081234567890',
  tier: 'GOLD MEMBER',
  avatar: '/images/siti-rahma-avatar.jpg',
  gender: 'Wanita',
  birthDate: '1998-05-14',
};

const currentUser = ref(JSON.parse(localStorage.getItem('koafy_user') || 'null') || defaultUser);
const userProfileTab = ref('addresses');

watch(currentUser, (val) => {
  localStorage.setItem('koafy_user', JSON.stringify(val));
}, { deep: true });

const activeNav = ref('home');
const currentView = ref('home'); // 'home' | 'products' | 'detail' | 'auth' | 'admin' | 'profile'
const previousView = ref('home');
const authMode = ref('login'); // 'login' | 'register'
const selectedProduct = ref(null);
const initialCategory = ref('all');
const initialSubcategory = ref(null);
const isFlashSaleActive = ref(localStorage.getItem('koafy_fs_active') !== 'false');

watch(isFlashSaleActive, (val) => {
  localStorage.setItem('koafy_fs_active', String(val));
});

// Synchronize SPA view with window.location.pathname
function syncRouteFromPath() {
  const path = window.location.pathname.toLowerCase();
  if (path === '/admin' || path.startsWith('/admin/')) {
    currentView.value = 'admin';
  } else if (path === '/profile' || path === '/akun' || path === '/alamat') {
    currentView.value = 'profile';
    userProfileTab.value = 'addresses';
  } else if (path === '/orders' || path === '/pesanan' || path === '/barang-dibeli') {
    currentView.value = 'profile';
    userProfileTab.value = 'orders';
  } else if (path === '/wishlist') {
    currentView.value = 'profile';
    userProfileTab.value = 'wishlist';
  } else if (path === '/cart' || path === '/keranjang') {
    currentView.value = 'profile';
    userProfileTab.value = 'cart';
  } else if (path === '/register' || path.startsWith('/register/')) {
    currentView.value = 'auth';
    authMode.value = 'register';
  } else if (path === '/login' || path.startsWith('/login/')) {
    currentView.value = 'auth';
    authMode.value = 'login';
  } else if (
    path === '/products' ||
    path === '/shop-all' ||
    path === '/shop' ||
    path === '/kategori' ||
    path.startsWith('/products/')
  ) {
    currentView.value = 'products';
    activeNav.value = 'shop-all';
  } else {
    currentView.value = 'home';
    activeNav.value = 'home';
  }
}

onMounted(() => {
  syncRouteFromPath();
  window.addEventListener('popstate', syncRouteFromPath);
});

onUnmounted(() => {
  window.removeEventListener('popstate', syncRouteFromPath);
});

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
  openProductsPage(cat.id);
}

function openProductsPage(cat = 'all', sub = null) {
  initialCategory.value = cat;
  initialSubcategory.value = sub;
  previousView.value = 'home';
  currentView.value = 'products';
  activeNav.value = 'shop-all';
  if (window.location.pathname !== '/products') {
    window.history.pushState(null, '', '/products');
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openProductDetail(product) {
  previousView.value = currentView.value;
  selectedProduct.value = product;
  currentView.value = 'detail';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openAuthPage(mode = 'login') {
  authMode.value = mode;
  currentView.value = 'auth';
  const targetUrl = mode === 'register' ? '/register' : '/login';
  if (window.location.pathname !== targetUrl) {
    window.history.pushState(null, '', targetUrl);
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function handleAuthSwitchMode(mode) {
  authMode.value = mode;
  const targetUrl = mode === 'register' ? '/register' : '/login';
  if (window.location.pathname !== targetUrl) {
    window.history.pushState(null, '', targetUrl);
  }
}

function openAdminPage() {
  currentView.value = 'admin';
  if (window.location.pathname !== '/admin') {
    window.history.pushState(null, '', '/admin');
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openUserProfile(tab = 'addresses') {
  userProfileTab.value = tab;
  previousView.value = currentView.value;
  currentView.value = 'profile';
  const targetPath = tab === 'orders' ? '/orders' : tab === 'wishlist' ? '/wishlist' : tab === 'cart' ? '/cart' : '/profile';
  if (window.location.pathname !== targetPath) {
    window.history.pushState(null, '', targetPath);
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function handleLogout() {
  currentUser.value = { ...defaultUser };
  showToast('Anda telah keluar dari akun');
  backToHome();
}

function handleLoginSuccess(user) {
  currentUser.value = {
    ...currentUser.value,
    name: user.name || 'Siti Rahma',
    email: user.email || 'siti.rahma@example.com',
    phone: user.phone || currentUser.value.phone,
  };
  showToast(`Selamat datang, ${user.name || 'Member Koafy'}! Membuka halaman akun Anda...`);
  openUserProfile('addresses');
}

function backToHome() {
  if (previousView.value === 'products' && currentView.value === 'detail') {
    previousView.value = 'home';
    openProductsPage(initialCategory.value, initialSubcategory.value);
    return;
  }
  previousView.value = 'home';
  currentView.value = 'home';
  activeNav.value = 'home';
  if (window.location.pathname !== '/') {
    window.history.pushState(null, '', '/');
  }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

watch(activeNav, (newNav) => {
  if (newNav === 'home' && currentView.value !== 'home') {
    backToHome();
  } else if (newNav === 'shop-all' && currentView.value !== 'products') {
    openProductsPage();
  }
});

function handleFooterNavigate(nav) {
  activeNav.value = nav;
  if (nav === 'home') {
    backToHome();
  } else if (nav === 'shop-all') {
    openProductsPage();
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
