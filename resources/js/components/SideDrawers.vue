<template>
  <!-- =====================================================================
       4. INTERACTIVE DRAWERS (WISHLIST, SHOPPING CART, MOBILE NAV)
       ===================================================================== -->
  <div
    id="drawer-backdrop"
    class="drawer-backdrop"
    :class="{ open: activeDrawer !== null }"
    @click="$emit('close-drawers')"
  ></div>

  <!-- Wishlist / Favorites Drawer -->
  <aside
    id="wishlist-drawer"
    class="side-drawer right"
    :class="{ open: activeDrawer === 'wishlist' }"
    :aria-label="t('favoriteItemsTitle')"
  >
    <div class="drawer-header">
      <div class="drawer-title-group">
        <span>{{ t('favoriteItemsTitle') }}</span>
        <span id="wishlist-drawer-count" class="badge-pill" style="position:static;">{{ wishlistItems.length }}</span>
      </div>
      <button type="button" class="icon-btn" aria-label="Tutup" @click="$emit('close-drawers')">✕</button>
    </div>

    <div id="wishlist-items-container" class="drawer-body">
      <p
        v-if="wishlistItems.length === 0"
        style="text-align:center;color:#6B7280;padding:32px 0;font-size:14px;"
      >
        {{ t('emptyWishlist') }}
      </p>

      <div
        v-for="item in wishlistItems"
        :key="item.id"
        class="drawer-item"
      >
        <div class="drawer-thumb">K</div>
        <div class="drawer-item-info">
          <div class="drawer-item-name">{{ item.name }}</div>
          <div class="drawer-item-meta">{{ item.meta }}</div>
          <div class="drawer-item-bottom">
            <strong style="font-size:14px;">Rp {{ formatRupiah(item.price) }}</strong>
            <button
              type="button"
              style="font-size:12px;font-weight:700;color:#F51487;"
              @click="$emit('move-to-cart', item.id)"
            >
              {{ t('addToCart') }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="drawer-footer">
      <button
        id="move-all-to-cart"
        type="button"
        class="primary-Pink-btn"
        @click="$emit('move-all-to-cart')"
      >
        {{ t('moveAllToCartBtn') }}
      </button>
    </div>
  </aside>

  <!-- Shopping Bag / Cart Drawer -->
  <aside
    id="cart-drawer"
    class="side-drawer right"
    :class="{ open: activeDrawer === 'cart' }"
    :aria-label="t('shoppingBagTitle')"
  >
    <div class="drawer-header">
      <div class="drawer-title-group">
        <span>{{ t('shoppingBagTitle') }}</span>
        <span id="cart-drawer-count" class="badge-pill" style="position:static;">{{ cartTotalQty }}</span>
      </div>
      <button type="button" class="icon-btn" aria-label="Tutup" @click="$emit('close-drawers')">✕</button>
    </div>

    <div id="cart-items-container" class="drawer-body">
      <p
        v-if="cartItems.length === 0"
        style="text-align:center;color:#6B7280;padding:32px 0;font-size:14px;"
      >
        {{ t('emptyCart') }}
      </p>

      <div
        v-for="item in cartItems"
        :key="item.id"
        class="drawer-item"
      >
        <div class="drawer-thumb">K</div>
        <div class="drawer-item-info">
          <div class="drawer-item-name">{{ item.name }}</div>
          <div class="drawer-item-meta">{{ item.meta }}</div>
          <div class="drawer-item-bottom">
            <div class="qty-control">
              <button
                type="button"
                class="qty-btn"
                @click="$emit('change-qty', { id: item.id, delta: -1 })"
              >
                −
              </button>
              <span class="qty-val">{{ item.qty }}</span>
              <button
                type="button"
                class="qty-btn"
                @click="$emit('change-qty', { id: item.id, delta: 1 })"
              >
                +
              </button>
            </div>
            <strong style="font-size:14px;">Rp {{ formatRupiah(item.price * item.qty) }}</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="drawer-footer">
      <div style="display:flex;justify-content:space-between;font-size:13px;color:#6B7280;margin-bottom:6px;">
        <span>{{ t('discountCouponLabel') }}</span>
        <span id="cart-discount-label" style="color:#F51487;font-weight:700;">
          {{ discountLabel }}
        </span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;color:#1A1A1A;margin-bottom:14px;">
        <span>Total</span>
        <span id="cart-subtotal-label">Rp {{ formatRupiah(finalTotal) }}</span>
      </div>
      <button
        type="button"
        class="primary-Pink-btn"
        @click="$emit('checkout')"
      >
        {{ t('checkoutBtn') }}
      </button>
    </div>
  </aside>

  <!-- Mobile Navigation Drawer -->
  <aside
    id="mobile-drawer"
    class="side-drawer left"
    :class="{ open: activeDrawer === 'mobile' }"
    aria-label="Mobile Navigation"
  >
    <div class="drawer-header">
      <img
        src="/images/koafy-logo.png"
        alt="Koafy by HSK Secret"
        style="height: 36px; width: auto; object-fit: contain;"
      />
      <button type="button" class="icon-btn" aria-label="Tutup" @click="$emit('close-drawers')">✕</button>
    </div>
    <div class="drawer-body" style="display:flex;flex-direction:column;gap:8px;">
      <a
        href="#home"
        class="dropdown-link"
        :class="{ active: activeNav === 'home' }"
        @click.prevent="selectMobileNav('home')"
      >
        {{ t('navHome') }}
      </a>
      <a
        href="#shop-all"
        class="dropdown-link"
        :class="{ active: activeNav === 'shop-all' }"
        @click.prevent="selectMobileNav('shop-all')"
      >
        {{ t('navShopAll') }}
      </a>
      <a
        href="#our-story"
        class="dropdown-link"
        :class="{ active: activeNav === 'our-story' }"
        @click.prevent="selectMobileNav('our-story')"
      >
        {{ t('navOurStory') }}
      </a>
      <a
        href="#pages"
        class="dropdown-link"
        :class="{ active: activeNav === 'pages' }"
        @click.prevent="selectMobileNav('pages')"
      >
        {{ t('navPages') }}
      </a>
      <div style="margin-top: 14px; padding-top: 14px; border-top: 1px solid #F3F4F6; display: flex; flex-direction: column; gap: 8px;">
        <button
          type="button"
          class="btn-primary"
          style="width: 100%; height: 42px; font-size: 13.5px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"
          @click="openAuthFromMobile"
        >
          <span>👤 {{ t('authMenu') }}</span>
        </button>
        <button
          type="button"
          class="btn-outline-sm"
          style="width: 100%; height: 40px; font-size: 13px; font-weight: 700; color: #D36279; border-color: rgba(211, 98, 121, 0.3); background-color: #FFF0F4; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"
          @click="openAdminFromMobile"
        >
          <span>{{ t('adminPanel') }}</span>
        </button>
      </div>
    </div>
    <div class="drawer-footer" style="font-size:12px;color:#6B7280;">
      <strong>Koafy by HSK Secret</strong> &bull; {{ t('announcement') }}
    </div>
  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { t } from '../i18n.js';

const props = defineProps({
  activeDrawer: {
    type: String,
    default: null,
  },
  activeNav: {
    type: String,
    default: 'home',
  },
  wishlistItems: {
    type: Array,
    default: () => [],
  },
  cartItems: {
    type: Array,
    default: () => [],
  },
  activeDiscountValue: {
    type: Number,
    default: 0,
  },
});

const emit = defineEmits([
  'close-drawers',
  'move-to-cart',
  'move-all-to-cart',
  'change-qty',
  'checkout',
  'update:activeNav',
  'open-auth',
  'open-admin',
]);

const cartTotalQty = computed(() =>
  props.cartItems.reduce((sum, item) => sum + item.qty, 0)
);

function formatRupiah(val) {
  return Number(val || 0).toLocaleString('id-ID');
}

const rawSubtotal = computed(() =>
  props.cartItems.reduce((sum, item) => sum + item.price * item.qty, 0)
);

const discountRupiah = computed(() =>
  props.activeDiscountValue > 0
    ? Math.min(rawSubtotal.value, props.activeDiscountValue)
    : 0
);

const finalTotal = computed(() => Math.max(0, rawSubtotal.value - discountRupiah.value));

const discountLabel = computed(() =>
  discountRupiah.value > 0
    ? `-Rp ${formatRupiah(discountRupiah.value)}`
    : 'Rp 0'
);

function selectMobileNav(nav) {
  emit('update:activeNav', nav);
  emit('close-drawers');
}

function openAuthFromMobile() {
  emit('close-drawers');
  emit('open-auth');
}

function openAdminFromMobile() {
  emit('close-drawers');
  emit('open-admin');
}
</script>
