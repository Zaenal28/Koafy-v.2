import { ref, computed } from 'vue';

// Available languages: 'id' (Bahasa Indonesia) & 'en' (English)
const savedLang = localStorage.getItem('koafy_language');
export const currentLang = ref(savedLang === 'en' ? 'en' : 'id');

export function setLanguage(lang) {
  if (lang === 'en' || lang === 'id') {
    currentLang.value = lang;
    localStorage.setItem('koafy_language', lang);
  }
}

export const translations = {
  id: {
    // Header & Announcement
    announcement: 'Dapatkan gratis ongkos kirim (ongkir) untuk pembelian di atas 200 RIBU',
    navHome: 'Home',
    navShopAll: 'Shop All',
    navOurStory: 'Our Story',
    navPages: 'Pages',
    searchPlaceholder: 'Cari Koafy Lip Velvet, Crystal Butterbalm, atau Soft-Square Trio...',
    searchClose: 'Tutup',
    aboutUs: 'Tentang Kami',
    ingredients: 'Bahan Alami',
    faq: 'FAQ & Bantuan',
    contact: 'Kontak',
    myProfile: 'Profil Saya',
    myOrders: 'Pesanan Saya',
    claimedVouchers: 'Voucher Saya',
    accountSettings: 'Pengaturan Akun',
    authMenu: 'Masuk / Daftar Akun',
    adminPanel: '⚙️ Panel Admin Toko',

    // Hero Slider
    heroBadgeDefault: 'Voucher Diskon',
    claimVoucherBtn: 'Klaim Voucher',
    claimedBtn: '✓ Tersimpan di Bag',
    shopNowBtn: 'Belanja Sekarang',
    termsApply: 'S&K berlaku • Khusus hari ini',

    // Flash Sale Section
    flashSaleTitle: 'Flash Sale',
    flashSaleSubtitle: 'PENAWARAN TERBATAS HARI INI',
    endsIn: 'Berakhir dalam',
    hours: 'Jam',
    minutes: 'Menit',
    seconds: 'Detik',
    viewAll: 'Lihat Semua',
    addToCart: '+ Keranjang',
    buyNow: 'Beli Sekarang',
    discount: 'Diskon',
    viewProduct: 'Lihat Produk',
    soldText: 'Terjual',
    leftText: 'Sisa',
    flashTagline: 'Diskon Kilat Terbatas • Hemat Ekstra',
    limitedStock: 'Stok Terbatas',

    // New Arrival Section
    newArrivalTitle: 'New Arrival',
    newArrivalSubtitle: 'KOAFY EKSKLUSIF • PALING FAVORIT',

    // Koafy Makeup Story Section
    makeupPhilosophyQuote: 'Kami percaya kecantikan berawal dari kulit yang sehat dan terawat. Koleksi Koafy Makeup dirancang untuk menyempurnakan kilau alami wajah Anda dan membuat setiap hari terasa istimewa.',
    beautyBeginsTitle: 'Beauty Begins With You',
    beautyBeginsDesc: 'Jelajahi koleksi esensial Koafy Makeup yang menutrisi kulit dan memancarkan pesona rona alami Anda setiap hari.',
    moreAboutBtn: 'More About',

    // All Products Catalog Page
    catalogBannerBadge: 'KATALOG KECANTIKAN KOAFY',
    catalogBannerTitle: 'Semua Koleksi Produk',
    catalogBannerSubtitle: 'Jelajahi formulasi premium kecantikan, riasan wajah bersertifikasi, dan perawatan kulit berkualitas tinggi dari Koafy by HSK Secret.',
    filterChoices: 'Filter Pilihan',
    searchSection: 'Pencarian',
    searchKeywordsPlaceholder: 'Cari kata kunci...',
    categorySection: 'Kategori',
    allCategories: 'Semua Kategori',
    allMakeup: 'Semua Makeup',
    allSkincare: 'Semua Skincare',
    allBodyCare: 'Semua Perawatan Tubuh',
    allHairCare: 'Semua Perawatan Rambut',
    skinTypeSection: 'Tipe Kulit',
    resetFilterBtn: 'Reset Filter',
    showingText: 'Menampilkan',
    productsText: 'Produk',
    sortByLabel: 'Urutkan:',
    sortPopular: 'Paling Populer',
    sortNewest: 'Produk Terbaru',
    sortPriceLowHigh: 'Harga: Rendah ke Tinggi',
    sortPriceHighLow: 'Harga: Tinggi ke Rendah',
    sortRating: 'Rating Tertinggi',
    noProductFoundTitle: 'Produk Tidak Ditemukan',
    noProductFoundDesc: 'Tidak ada produk yang sesuai dengan kriteria filter Anda. Silakan reset filter untuk melihat seluruh koleksi.',
    resetAllFilterBtn: 'Reset Semua Filter',

    // Product Detail Page
    backToHome: 'Kembali ke Beranda',
    productCatalogBreadcrumb: 'Katalog Produk',
    selectShadeLabel: 'Pilihan Warna / Shade (Klik untuk ganti foto)',
    selectSizeLabel: 'Pilihan Ukuran / Varian',
    quantityLabel: 'Jumlah',
    subtotalEstimate: 'Estimasi Subtotal:',
    addFavoriteBtn: 'Tambahkan ke Favorit',
    removeFavoriteBtn: 'Hapus dari Favorit',
    tabDesc: 'Kelebihan & Formula Utama',
    tabInfo: 'Informasi Tambahan',
    tabReviews: 'Ulasan Pembeli',

    // Floating Chat CS
    chatCsAdmin: 'Chat CS Admin',
    chatCsTitle: 'CS Admin Koafy Beauty',
    chatOnlineStatus: 'Online | Balas cepat',
    todayDatePill: 'Hari ini',
    chatGreeting: 'Halo Kak! 👋 Selamat datang di Koafy Beauty Store. Ada yang bisa kami bantu seputar produk skincare, konsultasi tipe kulit, atau pemesanan?',
    quickTopicsTitle: 'Pilih topik pertanyaan cepat:',
    typeMessagePlaceholder: 'Tulis pesan ke WhatsApp Admin...',

    // Drawers (Wishlist & Cart)
    favoriteItemsTitle: 'Item Favorit',
    shoppingBagTitle: 'Shopping Bag',
    emptyWishlist: 'Belum ada produk favorit.',
    emptyCart: 'Shopping Bag Anda masih kosong.',
    moveAllToCartBtn: 'Pindahkan Semua ke Keranjang',
    subtotalLabel: 'Subtotal Belanja',
    discountCouponLabel: 'Kupon Diskon',
    freeShippingNotice: '🎉 Gratis Ongkir Otomatis Aktif!',
    checkoutBtn: 'Lanjut ke Pembayaran',

    // Site Footer
    footerBrandDesc: 'Mendampingi perjalanan kesehatan kulit Anda melalui layanan perawatan klinik bersama dokter ahli serta produk skincare berkualitas tinggi.',
    footerInfoHsk: 'INFORMASI HSK',
    footerServices: 'LAYANAN',
    footerContact: 'CONTACT HSK SECRET',
    footerAbout: 'Tentang HSK',
    footerHelp: 'Pusat Bantuan',
    footerClinic: 'Treatment Klinik',
    footerShopSkincare: 'Belanja Skincare',
    footerCopyright: 'Koafy by HSK Secret. Hak cipta dilindungi undang-undang.',
  },

  en: {
    // Header & Announcement
    announcement: 'Get free shipping on all orders over IDR 200,000',
    navHome: 'Home',
    navShopAll: 'Shop All',
    navOurStory: 'Our Story',
    navPages: 'Pages',
    searchPlaceholder: 'Search Koafy Lip Velvet, Crystal Butterbalm, or Soft-Square Trio...',
    searchClose: 'Close',
    aboutUs: 'About Us',
    ingredients: 'Ingredients',
    faq: 'FAQ & Help',
    contact: 'Contact',
    myProfile: 'My Profile',
    myOrders: 'My Orders',
    claimedVouchers: 'My Claimed Vouchers',
    accountSettings: 'Account Settings',
    authMenu: 'Sign In / Register',
    adminPanel: '⚙️ Store Admin Panel',

    // Hero Slider
    heroBadgeDefault: 'Discount Voucher',
    claimVoucherBtn: 'Claim Voucher',
    claimedBtn: '✓ Saved in Bag',
    shopNowBtn: 'Shop Now',
    termsApply: 'T&C apply • Today only',

    // Flash Sale Section
    flashSaleTitle: 'Flash Sale',
    flashSaleSubtitle: 'LIMITED TIME OFFERS TODAY',
    endsIn: 'Ends in',
    hours: 'Hours',
    minutes: 'Mins',
    seconds: 'Secs',
    viewAll: 'View All',
    addToCart: '+ Add to Bag',
    buyNow: 'Buy Now',
    discount: 'Off',
    viewProduct: 'View Product',
    soldText: 'Sold',
    leftText: 'Left',
    flashTagline: 'Limited Flash Deals • Extra Savings',
    limitedStock: 'Limited Stock',

    // New Arrival Section
    newArrivalTitle: 'New Arrival',
    newArrivalSubtitle: 'KOAFY EXCLUSIVE • MOST FAVORITE',

    // Koafy Makeup Story Section
    makeupPhilosophyQuote: 'We believe beauty begins with healthy, nourished skin. Our thoughtfully curated Koafy Makeup and beauty essentials are designed to enhance your natural glow and make every day feel special.',
    beautyBeginsTitle: 'Beauty Begins With You',
    beautyBeginsDesc: 'Discover Koafy Makeup essentials that nourish your skin and reveal your effortless natural glow every day.',
    moreAboutBtn: 'More About',

    // All Products Catalog Page
    catalogBannerBadge: 'KOAFY BEAUTY CATALOG',
    catalogBannerTitle: 'All Product Collections',
    catalogBannerSubtitle: 'Explore premium beauty formulations, certified cosmetics, and high-performance skincare by Koafy by HSK Secret.',
    filterChoices: 'Filter Choices',
    searchSection: 'Search',
    searchKeywordsPlaceholder: 'Search keywords...',
    categorySection: 'Category',
    allCategories: 'All Categories',
    allMakeup: 'All Makeup',
    allSkincare: 'All Skincare',
    allBodyCare: 'All Body Care',
    allHairCare: 'All Hair Care',
    skinTypeSection: 'Skin Type',
    resetFilterBtn: 'Reset Filter',
    showingText: 'Showing',
    productsText: 'Products',
    sortByLabel: 'Sort by:',
    sortPopular: 'Most Popular',
    sortNewest: 'Newest Arrivals',
    sortPriceLowHigh: 'Price: Low to High',
    sortPriceHighLow: 'Price: High to Low',
    sortRating: 'Highest Rating',
    noProductFoundTitle: 'No Products Found',
    noProductFoundDesc: 'No products matched your filter criteria. Please reset your filters to view our full collection.',
    resetAllFilterBtn: 'Reset All Filters',

    // Product Detail Page
    backToHome: 'Back to Home',
    productCatalogBreadcrumb: 'Product Catalog',
    selectShadeLabel: 'Select Shade / Color (Click to switch image)',
    selectSizeLabel: 'Select Size / Variant',
    quantityLabel: 'Quantity',
    subtotalEstimate: 'Estimated Subtotal:',
    addFavoriteBtn: 'Add to Wishlist',
    removeFavoriteBtn: 'Remove from Wishlist',
    tabDesc: 'Key Formula & Benefits',
    tabInfo: 'Additional Information',
    tabReviews: 'Customer Reviews',

    // Floating Chat CS
    chatCsAdmin: 'Chat CS Admin',
    chatCsTitle: 'CS Admin Koafy Beauty',
    chatOnlineStatus: 'Online | Quick reply',
    todayDatePill: 'Today',
    chatGreeting: 'Hello! 👋 Welcome to Koafy Beauty Store. How may we assist you with skincare recommendations, skin type consultation, or your order?',
    quickTopicsTitle: 'Choose quick inquiry topic:',
    typeMessagePlaceholder: 'Type a message to WhatsApp Admin...',

    // Drawers (Wishlist & Cart)
    favoriteItemsTitle: 'Favorite Items',
    shoppingBagTitle: 'Shopping Bag',
    emptyWishlist: 'No favorite items yet.',
    emptyCart: 'Your shopping bag is currently empty.',
    moveAllToCartBtn: 'Move All to Bag',
    subtotalLabel: 'Subtotal',
    discountCouponLabel: 'Discount Coupon',
    freeShippingNotice: '🎉 Free Shipping Automatically Applied!',
    checkoutBtn: 'Proceed to Checkout',

    // Site Footer
    footerBrandDesc: 'Guiding your skin health journey through clinical care with certified doctors and high-quality premium skincare essentials.',
    footerInfoHsk: 'HSK INFORMATION',
    footerServices: 'SERVICES',
    footerContact: 'CONTACT HSK SECRET',
    footerAbout: 'About HSK',
    footerHelp: 'Help Center',
    footerClinic: 'Clinic Treatment',
    footerShopSkincare: 'Shop Skincare',
    footerCopyright: 'Koafy by HSK Secret. All rights reserved.',
  },
};

export function t(key) {
  const lang = currentLang.value;
  return translations[lang]?.[key] || translations['id']?.[key] || key;
}
