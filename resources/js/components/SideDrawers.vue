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
    aria-label="Favorite Items"
  >
    <div class="drawer-header">
      <div class="drawer-title-group">
        <span>Favorite Items</span>
        <span id="wishlist-drawer-count" class="badge-pill" style="position:static;">{{ wishlistItems.length }}</span>
      </div>
      <button type="button" class="icon-btn" aria-label="Tutup" @click="$emit('close-drawers')">✕</button>
    </div>

    <div id="wishlist-items-container" class="drawer-body">
      <p
        v-if="wishlistItems.length === 0"
        style="text-align:center;color:#6B7280;padding:32px 0;font-size:14px;"
      >
        Belum ada produk favorit.
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
            <strong style="font-size:14px;">${{ item.price }}.00</strong>
            <button
              type="button"
              style="font-size:12px;font-weight:700;color:#F51487;"
              @click="$emit('move-to-cart', item.id)"
            >
              + Move to Bag
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
        Move All Favorites to Bag
      </button>
    </div>
  </aside>

  <!-- Shopping Bag / Cart Drawer -->
  <aside
    id="cart-drawer"
    class="side-drawer right"
    :class="{ open: activeDrawer === 'cart' }"
    aria-label="Shopping Bag"
  >
    <div class="drawer-header">
      <div class="drawer-title-group">
        <span>Your Shopping Bag</span>
        <span id="cart-drawer-count" class="badge-pill" style="position:static;">{{ cartTotalQty }}</span>
      </div>
      <button type="button" class="icon-btn" aria-label="Tutup" @click="$emit('close-drawers')">✕</button>
    </div>

    <div id="cart-items-container" class="drawer-body">
      <p
        v-if="cartItems.length === 0"
        style="text-align:center;color:#6B7280;padding:32px 0;font-size:14px;"
      >
        Keranjang belanja Anda masih kosong.
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
            <strong style="font-size:14px;">${{ item.price * item.qty }}.00</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="drawer-footer">
      <div style="display:flex;justify-content:space-between;font-size:13px;color:#6B7280;margin-bottom:6px;">
        <span>Voucher Discount</span>
        <span id="cart-discount-label" style="color:#F51487;font-weight:700;">
          {{ discountLabel }}
        </span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700;color:#1A1A1A;margin-bottom:14px;">
        <span>Total</span>
        <span id="cart-subtotal-label">${{ finalTotal }}.00</span>
      </div>
      <button
        type="button"
        class="primary-Pink-btn"
        @click="$emit('checkout')"
      >
        Proceed to Checkout
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
        Home
      </a>
      <a
        href="#shop-all"
        class="dropdown-link"
        :class="{ active: activeNav === 'shop-all' }"
        @click.prevent="selectMobileNav('shop-all')"
      >
        Shop All
      </a>
      <a
        href="#our-story"
        class="dropdown-link"
        :class="{ active: activeNav === 'our-story' }"
        @click.prevent="selectMobileNav('our-story')"
      >
        Our Story
      </a>
      <a
        href="#pages"
        class="dropdown-link"
        :class="{ active: activeNav === 'pages' }"
        @click.prevent="selectMobileNav('pages')"
      >
        Pages
      </a>
    </div>
    <div class="drawer-footer" style="font-size:12px;color:#6B7280;">
      <strong>Koafy by HSK Secret</strong> &bull; Free shipping over $200
    </div>
  </aside>
</template>

<script setup>
import { computed } from 'vue';

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
]);

const cartTotalQty = computed(() =>
  props.cartItems.reduce((sum, item) => sum + item.qty, 0)
);

const rawSubtotal = computed(() =>
  props.cartItems.reduce((sum, item) => sum + item.price * item.qty, 0)
);

const discountDollar = computed(() =>
  props.activeDiscountValue > 0
    ? Math.min(rawSubtotal.value, Math.round(props.activeDiscountValue * 0.35))
    : 0
);

const finalTotal = computed(() => Math.max(0, rawSubtotal.value - discountDollar.value));

const discountLabel = computed(() =>
  discountDollar.value > 0
    ? `-$${discountDollar.value}.00 (${props.activeDiscountValue}K Voucher)`
    : '-$0.00'
);

function selectMobileNav(nav) {
  emit('update:activeNav', nav);
  emit('close-drawers');
}
</script>
