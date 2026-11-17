<template>
  <div class="all-products-page">
    <div class="all-products-container">

      <!-- Breadcrumbs & Back Bar -->
      <nav class="products-breadcrumb" aria-label="Breadcrumb">
        <button type="button" class="breadcrumb-back-btn" @click="goHome">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
          </svg>
          <span>Beranda</span>
        </button>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item" :class="{ active: selectedCategory === 'all' && !selectedSubcategory }">
          Semua Produk
        </span>
        <template v-if="selectedCategory !== 'all'">
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-item" :class="{ active: !selectedSubcategory }">
            {{ getCategoryName(selectedCategory) }}
          </span>
        </template>
        <template v-if="selectedSubcategory">
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-item active">
            {{ selectedSubcategory }}
          </span>
        </template>
      </nav>

      <!-- Page Banner / Header -->
      <div class="products-header-banner">
        <div class="banner-text-col">
          <span class="banner-badge">KOAFY BEAUTY CATALOG</span>
          <h1 class="banner-title">
            {{ currentHeaderTitle }}
          </h1>
          <p class="banner-subtitle">
            Jelajahi formulasi premium kecantikan, riasan wajah bersertifikasi, dan perawatan kulit berkualitas tinggi dari Koafy by HSK Secret.
          </p>
        </div>
        <div class="banner-stats-col">
          <div class="banner-stat-chip">
            <span class="stat-number">{{ filteredProducts.length }}</span>
            <span class="stat-label">Produk Tersedia</span>
          </div>
        </div>
      </div>

      <!-- Mobile Filter Toggle Button (< 992px) -->
      <div class="mobile-filter-bar">
        <button
          type="button"
          class="mobile-filter-btn"
          @click="isMobileFilterOpen = true"
        >
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="4" y1="21" x2="4" y2="14"></line>
            <line x1="4" y1="10" x2="4" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12" y2="3"></line>
            <line x1="20" y1="21" x2="20" y2="16"></line>
            <line x1="20" y1="12" x2="20" y2="3"></line>
            <line x1="1" y1="14" x2="7" y2="14"></line>
            <line x1="9" y1="8" x2="15" y2="8"></line>
            <line x1="17" y1="16" x2="23" y2="16"></line>
          </svg>
          <span>Filter Pilihan</span>
          <span v-if="activeFilterCount > 0" class="filter-badge-count">{{ activeFilterCount }}</span>
        </button>

        <div class="mobile-sort-wrap">
          <select v-model="sortBy" class="sort-select-input" aria-label="Urutkan produk">
            <option value="populer">Paling Populer</option>
            <option value="terbaru">Produk Terbaru</option>
            <option value="harga-rendah">Harga: Rendah ke Tinggi</option>
            <option value="harga-tinggi">Harga: Tinggi ke Rendah</option>
            <option value="rating">Rating Tertinggi</option>
          </select>
        </div>
      </div>

      <!-- Main Layout: Left Sidebar Filter (Image 1) | Right Catalog Grid -->
      <div class="products-layout-grid">

        <!-- =================================================================
             LEFT COLUMN: FILTER PILIHAN (REFERENSI GAMBAR 1 & GAMBAR 2)
             ================================================================= -->
        <aside
          class="filter-sidebar-wrapper"
          :class="{ 'mobile-drawer-open': isMobileFilterOpen }"
        >
          <div class="filter-backdrop" @click="isMobileFilterOpen = false"></div>

          <div class="filter-card">
            <!-- Header Filter Pilihan (with sliders icon) -->
            <div class="filter-header-row">
              <div class="filter-title-group">
                <svg
                  class="filter-header-icon"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <line x1="4" y1="21" x2="4" y2="14"></line>
                  <line x1="4" y1="10" x2="4" y2="3"></line>
                  <line x1="12" y1="21" x2="12" y2="12"></line>
                  <line x1="12" y1="8" x2="12" y2="3"></line>
                  <line x1="20" y1="21" x2="20" y2="16"></line>
                  <line x1="20" y1="12" x2="20" y2="3"></line>
                  <line x1="1" y1="14" x2="7" y2="14"></line>
                  <line x1="9" y1="8" x2="15" y2="8"></line>
                  <line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
                <h2 class="filter-title">Filter Pilihan</h2>
              </div>
              <button
                type="button"
                class="mobile-filter-close-btn"
                aria-label="Tutup Filter"
                @click="isMobileFilterOpen = false"
              >
                ✕
              </button>
            </div>

            <!-- SECTION 1: Pencarian -->
            <div class="filter-section">
              <label for="filter-search-input" class="filter-section-title">Pencarian</label>
              <div class="filter-input-wrap">
                <input
                  id="filter-search-input"
                  v-model="searchKeyword"
                  type="text"
                  placeholder="Cari kata kunci..."
                  class="filter-search-input"
                />
                <button
                  v-if="searchKeyword"
                  type="button"
                  class="clear-input-btn"
                  @click="searchKeyword = ''"
                >
                  ✕
                </button>
              </div>
            </div>

            <!-- SECTION 2: Kategori (Gambar 1 + Makeup Subkategori Gambar 2) -->
            <div class="filter-section">
              <h3 class="filter-section-title">Kategori</h3>

              <!-- Button Semua Kategori (Ref Gambar 1: soft pink background) -->
              <button
                type="button"
                class="all-category-pill"
                :class="{ active: selectedCategory === 'all' && !selectedSubcategory }"
                @click="selectCategory('all')"
              >
                <span>Semua Kategori</span>
                <span v-if="selectedCategory === 'all' && !selectedSubcategory" class="active-dot">●</span>
              </button>

              <!-- Category Accordion Items -->
              <div class="category-accordion-list">

                <!-- 1. MAKEUP (Ref Gambar 1 & Rincian Gambar 2: EYE, FACE, LIP) -->
                <div class="accordion-item" :class="{ open: openCategories.includes('makeup') }">
                  <div
                    class="accordion-header"
                    :class="{ active: selectedCategory === 'makeup' }"
                    @click="toggleCategoryAccordion('makeup')"
                  >
                    <span class="category-name-text">Makeup</span>
                    <svg
                      class="accordion-chevron"
                      width="16"
                      height="16"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </div>

                  <!-- Expanded Subcategories for MAKEUP (Ref Gambar 2) -->
                  <div v-show="openCategories.includes('makeup')" class="accordion-body">
                    <!-- Quick Select All Makeup -->
                    <button
                      type="button"
                      class="subcategory-item all-sub-item"
                      :class="{ active: selectedCategory === 'makeup' && !selectedSubcategory }"
                      @click="selectCategory('makeup')"
                    >
                      <span>Semua Makeup</span>
                    </button>

                    <!-- Group 1: EYE (Gambar 2: Eyebrow, Eyeliner, Mascara, Eyeshadow) -->
                    <div class="subcategory-group">
                      <div class="group-header">EYE</div>
                      <div class="group-items">
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Eyebrow' }"
                          @click="selectSubcategory('makeup', 'Eyebrow')"
                        >
                          Eyebrow
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Eyeliner' }"
                          @click="selectSubcategory('makeup', 'Eyeliner')"
                        >
                          Eyeliner
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Mascara' }"
                          @click="selectSubcategory('makeup', 'Mascara')"
                        >
                          Mascara
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Eyeshadow' }"
                          @click="selectSubcategory('makeup', 'Eyeshadow')"
                        >
                          Eyeshadow
                        </button>
                      </div>
                    </div>

                    <!-- Group 2: FACE (Gambar 2: Cushion, Face Palette, Skin Tint, Concealer, Foundation, Two Way Cake, Loose Powder, Blush On) -->
                    <div class="subcategory-group">
                      <div class="group-header">FACE</div>
                      <div class="group-items">
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Cushion' }"
                          @click="selectSubcategory('makeup', 'Cushion')"
                        >
                          Cushion
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Face Palette' }"
                          @click="selectSubcategory('makeup', 'Face Palette')"
                        >
                          Face Palette
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Skin Tint' }"
                          @click="selectSubcategory('makeup', 'Skin Tint')"
                        >
                          Skin Tint
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Concealer' }"
                          @click="selectSubcategory('makeup', 'Concealer')"
                        >
                          Concealer
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Foundation' }"
                          @click="selectSubcategory('makeup', 'Foundation')"
                        >
                          Foundation
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Two Way Cake' }"
                          @click="selectSubcategory('makeup', 'Two Way Cake')"
                        >
                          Two Way Cake
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Loose Powder' }"
                          @click="selectSubcategory('makeup', 'Loose Powder')"
                        >
                          Loose Powder
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Blush On' }"
                          @click="selectSubcategory('makeup', 'Blush On')"
                        >
                          Blush On
                        </button>
                      </div>
                    </div>

                    <!-- Group 3: LIP (Gambar 2: Lipstick, Lip Cream, Lip Tint, Lip Balm) -->
                    <div class="subcategory-group">
                      <div class="group-header">LIP</div>
                      <div class="group-items">
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Lipstick' }"
                          @click="selectSubcategory('makeup', 'Lipstick')"
                        >
                          Lipstick
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Lip Cream' }"
                          @click="selectSubcategory('makeup', 'Lip Cream')"
                        >
                          Lip Cream
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Lip Tint' }"
                          @click="selectSubcategory('makeup', 'Lip Tint')"
                        >
                          Lip Tint
                        </button>
                        <button
                          type="button"
                          class="subcategory-item"
                          :class="{ active: selectedSubcategory === 'Lip Balm' }"
                          @click="selectSubcategory('makeup', 'Lip Balm')"
                        >
                          Lip Balm
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- 2. SKINCARE -->
                <div class="accordion-item" :class="{ open: openCategories.includes('skincare') }">
                  <div
                    class="accordion-header"
                    :class="{ active: selectedCategory === 'skincare' }"
                    @click="toggleCategoryAccordion('skincare')"
                  >
                    <span class="category-name-text">Skincare</span>
                    <svg
                      class="accordion-chevron"
                      width="16"
                      height="16"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </div>
                  <div v-show="openCategories.includes('skincare')" class="accordion-body">
                    <button
                      type="button"
                      class="subcategory-item all-sub-item"
                      :class="{ active: selectedCategory === 'skincare' && !selectedSubcategory }"
                      @click="selectCategory('skincare')"
                    >
                      Semua Skincare
                    </button>
                    <div class="group-items">
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Cleanser' }"
                        @click="selectSubcategory('skincare', 'Cleanser')"
                      >
                        Cleanser
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Toner & Essence' }"
                        @click="selectSubcategory('skincare', 'Toner & Essence')"
                      >
                        Toner &amp; Essence
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Serum & Ampoule' }"
                        @click="selectSubcategory('skincare', 'Serum & Ampoule')"
                      >
                        Serum &amp; Ampoule
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Moisturizer' }"
                        @click="selectSubcategory('skincare', 'Moisturizer')"
                      >
                        Moisturizer
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Sunscreen' }"
                        @click="selectSubcategory('skincare', 'Sunscreen')"
                      >
                        Sunscreen
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Face Mask' }"
                        @click="selectSubcategory('skincare', 'Face Mask')"
                      >
                        Face Mask
                      </button>
                    </div>
                  </div>
                </div>

                <!-- 3. PERAWATAN TUBUH -->
                <div class="accordion-item" :class="{ open: openCategories.includes('body-care') }">
                  <div
                    class="accordion-header"
                    :class="{ active: selectedCategory === 'body-care' }"
                    @click="toggleCategoryAccordion('body-care')"
                  >
                    <span class="category-name-text">Perawatan Tubuh</span>
                    <svg
                      class="accordion-chevron"
                      width="16"
                      height="16"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </div>
                  <div v-show="openCategories.includes('body-care')" class="accordion-body">
                    <button
                      type="button"
                      class="subcategory-item all-sub-item"
                      :class="{ active: selectedCategory === 'body-care' && !selectedSubcategory }"
                      @click="selectCategory('body-care')"
                    >
                      Semua Perawatan Tubuh
                    </button>
                    <div class="group-items">
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Body Wash' }"
                        @click="selectSubcategory('body-care', 'Body Wash')"
                      >
                        Body Wash
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Body Lotion' }"
                        @click="selectSubcategory('body-care', 'Body Lotion')"
                      >
                        Body Lotion &amp; Serum
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Body Scrub' }"
                        @click="selectSubcategory('body-care', 'Body Scrub')"
                      >
                        Body Scrub
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Deodorant' }"
                        @click="selectSubcategory('body-care', 'Deodorant')"
                      >
                        Deodorant
                      </button>
                    </div>
                  </div>
                </div>

                <!-- 4. PERAWATAN RAMBUT -->
                <div class="accordion-item" :class="{ open: openCategories.includes('hair-care') }">
                  <div
                    class="accordion-header"
                    :class="{ active: selectedCategory === 'hair-care' }"
                    @click="toggleCategoryAccordion('hair-care')"
                  >
                    <span class="category-name-text">Perawatan Rambut</span>
                    <svg
                      class="accordion-chevron"
                      width="16"
                      height="16"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                  </div>
                  <div v-show="openCategories.includes('hair-care')" class="accordion-body">
                    <button
                      type="button"
                      class="subcategory-item all-sub-item"
                      :class="{ active: selectedCategory === 'hair-care' && !selectedSubcategory }"
                      @click="selectCategory('hair-care')"
                    >
                      Semua Perawatan Rambut
                    </button>
                    <div class="group-items">
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Shampoo' }"
                        @click="selectSubcategory('hair-care', 'Shampoo')"
                      >
                        Shampoo
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Conditioner' }"
                        @click="selectSubcategory('hair-care', 'Conditioner')"
                      >
                        Conditioner
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Hair Mask' }"
                        @click="selectSubcategory('hair-care', 'Hair Mask')"
                      >
                        Hair Mask &amp; Treatment
                      </button>
                      <button
                        type="button"
                        class="subcategory-item"
                        :class="{ active: selectedSubcategory === 'Hair Serum' }"
                        @click="selectSubcategory('hair-care', 'Hair Serum')"
                      >
                        Hair Serum &amp; Oil
                      </button>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- SECTION 3: Tipe Kulit (Ref Gambar 1) -->
            <div class="filter-section">
              <h3 class="filter-section-title">Tipe Kulit</h3>
              <div class="skin-types-grid">
                <button
                  v-for="st in skinTypesList"
                  :key="st"
                  type="button"
                  class="skin-type-pill"
                  :class="{ active: selectedSkinTypes.includes(st) }"
                  @click="toggleSkinType(st)"
                >
                  {{ st }}
                </button>
              </div>
            </div>

            <!-- SECTION 4: Reset Filter Button (Ref Gambar 1: border pill with reload icon) -->
            <div class="filter-footer-action">
              <button
                type="button"
                class="btn-reset-filter"
                @click="resetAllFilters"
              >
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span>Reset Filter</span>
              </button>
            </div>

          </div>
        </aside>

        <!-- =================================================================
             RIGHT COLUMN: PRODUCTS CATALOG GRID
             ================================================================= -->
        <main class="products-catalog-content">

          <!-- Desktop Top Bar: Results Count, Active Filter Chips & Sort -->
          <div class="catalog-top-bar">
            <div class="top-bar-left">
              <span class="results-count-text">
                Menampilkan <strong>{{ filteredProducts.length }}</strong> Produk
              </span>

              <!-- Active Filter Chips -->
              <div v-if="activeFilterChips.length > 0" class="active-chips-wrap">
                <div
                  v-for="chip in activeFilterChips"
                  :key="chip.key"
                  class="filter-chip"
                >
                  <span>{{ chip.label }}</span>
                  <button type="button" class="chip-remove-btn" @click="chip.clear">✕</button>
                </div>
                <button
                  type="button"
                  class="clear-all-chips-btn"
                  @click="resetAllFilters"
                >
                  Hapus Semua
                </button>
              </div>
            </div>

            <div class="top-bar-right desktop-sort-wrap">
              <span class="sort-label">Urutkan:</span>
              <select v-model="sortBy" class="sort-select-input" aria-label="Urutkan produk">
                <option value="populer">Paling Populer</option>
                <option value="terbaru">Produk Terbaru</option>
                <option value="harga-rendah">Harga: Rendah ke Tinggi</option>
                <option value="harga-tinggi">Harga: Tinggi ke Rendah</option>
                <option value="rating">Rating Tertinggi</option>
              </select>
            </div>
          </div>

          <!-- Product Grid -->
          <div v-if="filteredProducts.length > 0" class="catalog-products-grid">
            <article
              v-for="product in filteredProducts"
              :key="product.id"
              class="catalog-product-card"
            >
              <!-- Media Box: Image + Discount Badge + Love/Favorite Heart -->
              <div class="card-media-box" @click="$emit('view-detail', product)">
                <span class="card-badge-discount">{{ product.badge }}</span>

                <button
                  type="button"
                  class="card-love-btn"
                  :class="{ active: isFavorite(product.id) }"
                  :aria-label="isFavorite(product.id) ? 'Hapus favorit' : 'Tambah favorit'"
                  @click.stop="$emit('toggle-favorite', product)"
                >
                  <svg
                    width="18"
                    height="18"
                    :fill="isFavorite(product.id) ? '#F51487' : 'none'"
                    :stroke="isFavorite(product.id) ? '#F51487' : '#4B5563'"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>
                </button>

                <img
                  :src="product.image"
                  :alt="product.name"
                  class="card-img"
                  loading="lazy"
                />

                <span v-if="product.tagSub" class="card-category-subtag">
                  {{ product.tagSub }}
                </span>
              </div>

              <!-- Product Info Body -->
              <div class="card-info-box">
                <div class="card-brand-row">
                  <span class="card-brand-name">{{ product.brand }}</span>
                  <span v-if="product.volume" class="card-volume-text">&bull; {{ product.volume }}</span>
                </div>

                <h3 class="card-product-title" @click="$emit('view-detail', product)">
                  {{ product.name }}
                </h3>

                <!-- Star Rating & Review Count -->
                <div class="card-rating-row">
                  <div class="stars-icon-group">
                    <span v-for="i in 5" :key="i" class="star-gold">★</span>
                  </div>
                  <span class="rating-num">{{ product.rating }}</span>
                  <span class="reviews-count">({{ product.reviews }})</span>
                </div>

                <!-- Price Row: Strikethrough Old Price + Pink Current Price -->
                <div class="card-price-row">
                  <span class="card-current-price">{{ product.priceFormatted }}</span>
                  <del v-if="product.oldPriceFormatted" class="card-old-price">{{ product.oldPriceFormatted }}</del>
                </div>

                <!-- Actions: Tambah ke Bag & Detail -->
                <div class="card-action-row">
                  <button
                    type="button"
                    class="btn-card-add-cart"
                    @click="$emit('add-to-cart', product)"
                  >
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                    </svg>
                    <span>+ Keranjang</span>
                  </button>
                  <button
                    type="button"
                    class="btn-card-quick-view"
                    aria-label="Lihat detail produk"
                    @click="$emit('view-detail', product)"
                  >
                    Detail
                  </button>
                </div>
              </div>
            </article>
          </div>

          <!-- Empty State: No Products Match Filter -->
          <div v-else class="catalog-empty-state">
            <div class="empty-icon-circle">🔍</div>
            <h3 class="empty-state-title">Produk Tidak Ditemukan</h3>
            <p class="empty-state-desc">
              Tidak ada produk yang sesuai dengan kriteria filter atau kata kunci "{{ searchKeyword }}". Silakan reset filter untuk melihat seluruh koleksi.
            </p>
            <button
              type="button"
              class="btn-primary"
              style="padding: 10px 24px; border-radius: 10px; font-size: 14px;"
              @click="resetAllFilters"
            >
              Reset Semua Filter
            </button>
          </div>

        </main>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';

const props = defineProps({
  wishlistIds: {
    type: Array,
    default: () => [],
  },
  initialCategory: {
    type: String,
    default: 'all',
  },
  initialSubcategory: {
    type: String,
    default: null,
  },
});

const emit = defineEmits([
  'add-to-cart',
  'view-detail',
  'toggle-favorite',
  'back-to-home',
  'toast',
]);

// Filter reactive states
const searchKeyword = ref('');
const selectedCategory = ref(props.initialCategory || 'all');
const selectedSubcategory = ref(props.initialSubcategory || null);
const selectedSkinTypes = ref([]);
const sortBy = ref('populer');
const isMobileFilterOpen = ref(false);

// Accordion open states
const openCategories = ref(['makeup', 'skincare']);

const skinTypesList = [
  'Sensitif',
  'Kering',
  'Berminyak',
  'Normal',
  'Acne-Prone',
  'Kombinasi',
];

// Master Products List
const allProducts = ref([
  // --- MAKEUP: LIP ---
  {
    id: 'na-1',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lip Balm',
    tagSub: 'Lip Balm',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Rosewood Glow',
    rating: '4.9',
    reviews: 128,
    badge: '-22%',
    price: 38,
    priceFormatted: 'Rp 156.510',
    oldPriceFormatted: 'Rp 200.000',
    image: '/images/product-butterbalm-1.jpg',
    skinTypes: ['Sensitif', 'Kering', 'Normal'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'na-2',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lip Balm',
    tagSub: 'Lip Balm',
    brand: 'KOAFY PARIS',
    volume: '4.5 G',
    name: 'Koafy Crystal Butterbalm Tint — Berry Mauve',
    rating: '4.8',
    reviews: 340,
    badge: '-22%',
    price: 38,
    priceFormatted: 'Rp 156.510',
    oldPriceFormatted: 'Rp 200.000',
    image: '/images/product-butterbalm-2.jpg',
    skinTypes: ['Sensitif', 'Kering', 'Kombinasi'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'na-3',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lip Cream',
    tagSub: 'Lip Cream',
    brand: 'HSK SECRET',
    volume: 'SET DUO',
    name: 'Koafy Velvet Lip & Precision Brush Set',
    rating: '5.0',
    reviews: 95,
    badge: '-22%',
    price: 45,
    priceFormatted: 'Rp 175.000',
    oldPriceFormatted: 'Rp 225.000',
    image: '/images/product-lip-velvet.jpg',
    skinTypes: ['Sensitif', 'Kering', 'Normal', 'Berminyak', 'Kombinasi', 'Acne-Prone'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'na-4',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lip Balm',
    tagSub: 'Lip Balm Duo',
    brand: 'KOAFY PARIS',
    volume: '2 X 4.5 G',
    name: 'Koafy Crystal Butterbalm Duo Bundle',
    rating: '4.9',
    reviews: 214,
    badge: '-22%',
    price: 68,
    priceFormatted: 'Rp 288.600',
    oldPriceFormatted: 'Rp 370.000',
    image: '/images/product-butterbalm-duo.jpg',
    skinTypes: ['Kering', 'Sensitif', 'Normal'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-lip-1',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lipstick',
    tagSub: 'Lipstick',
    brand: 'KOAFY PARIS',
    volume: '3.8 G',
    name: 'Koafy Satin Silk Moisture Lipstick',
    rating: '4.8',
    reviews: 86,
    badge: '-15%',
    price: 32,
    priceFormatted: 'Rp 135.000',
    oldPriceFormatted: 'Rp 160.000',
    image: '/images/categories/lipbam.png',
    skinTypes: ['Kering', 'Normal'],
    isPopular: false,
    isNew: true,
  },
  {
    id: 'm-lip-2',
    category: 'makeup',
    group: 'LIP',
    subcategory: 'Lip Tint',
    tagSub: 'Lip Tint',
    brand: 'KOAFY PARIS',
    volume: '4.2 G',
    name: 'Koafy Juicy Glassy Glow Lip Tint',
    rating: '4.9',
    reviews: 172,
    badge: '-18%',
    price: 29,
    priceFormatted: 'Rp 120.000',
    oldPriceFormatted: 'Rp 145.000',
    image: '/images/product-butterbalm-2.jpg',
    skinTypes: ['Normal', 'Berminyak', 'Kombinasi'],
    isPopular: true,
    isNew: false,
  },

  // --- MAKEUP: FACE ---
  {
    id: 'na-5',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Face Palette',
    tagSub: 'Face Palette',
    brand: 'KOAFY PARIS',
    volume: '3 SHADES',
    name: 'Koafy Soft-Square Multi Balm Trio Compact',
    rating: '4.9',
    reviews: 180,
    badge: '-20%',
    price: 54,
    priceFormatted: 'Rp 210.000',
    oldPriceFormatted: 'Rp 265.000',
    image: '/images/banner-koafy-trio.jpg',
    skinTypes: ['Normal', 'Kombinasi', 'Kering'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'm-face-cushion',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Cushion',
    tagSub: 'Cushion SPF 35',
    brand: 'KOAFY PARIS',
    volume: '15 G',
    name: 'Koafy Flawless Glow Hydrating Cushion SPF 35',
    rating: '4.9',
    reviews: 412,
    badge: '-25%',
    price: 49,
    priceFormatted: 'Rp 189.000',
    oldPriceFormatted: 'Rp 252.000',
    image: '/images/categories/cushion.png',
    skinTypes: ['Normal', 'Kering', 'Sensitif', 'Kombinasi'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'm-face-fnd',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Foundation',
    tagSub: 'Foundation',
    brand: 'HSK SECRET',
    volume: '30 ML',
    name: 'Koafy Liquid Luminous Serum Foundation',
    rating: '4.8',
    reviews: 230,
    badge: '-20%',
    price: 46,
    priceFormatted: 'Rp 178.000',
    oldPriceFormatted: 'Rp 222.500',
    image: '/images/categories/liquid-pondation.png',
    skinTypes: ['Normal', 'Kombinasi', 'Berminyak'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-face-cnc',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Concealer',
    tagSub: 'Concealer',
    brand: 'KOAFY PARIS',
    volume: '6 ML',
    name: 'Koafy High-Coverage Serum Concealer',
    rating: '4.9',
    reviews: 156,
    badge: '-15%',
    price: 28,
    priceFormatted: 'Rp 115.000',
    oldPriceFormatted: 'Rp 135.000',
    image: '/images/categories/serum-conseler.png',
    skinTypes: ['Sensitif', 'Acne-Prone', 'Normal', 'Berminyak'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-face-tint',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Skin Tint',
    tagSub: 'Skin Tint',
    brand: 'KOAFY PARIS',
    volume: '25 ML',
    name: 'Koafy Featherlight Bare Skin Tint SPF 25',
    rating: '4.7',
    reviews: 98,
    badge: '-18%',
    price: 36,
    priceFormatted: 'Rp 145.000',
    oldPriceFormatted: 'Rp 175.000',
    image: '/images/categories/liquid-pondation.png',
    skinTypes: ['Sensitif', 'Normal', 'Kering'],
    isPopular: false,
    isNew: true,
  },
  {
    id: 'm-face-powder',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Loose Powder',
    tagSub: 'Loose Powder',
    brand: 'KOAFY PARIS',
    volume: '12 G',
    name: 'Koafy Micro-Fine Translucent Blur Loose Powder',
    rating: '4.9',
    reviews: 310,
    badge: '-20%',
    price: 31,
    priceFormatted: 'Rp 125.000',
    oldPriceFormatted: 'Rp 155.000',
    image: '/images/categories/cushion.png',
    skinTypes: ['Berminyak', 'Kombinasi', 'Acne-Prone'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-face-twc',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Two Way Cake',
    tagSub: 'Two Way Cake',
    brand: 'KOAFY PARIS',
    volume: '11 G',
    name: 'Koafy Velveteen Matte Two Way Cake',
    rating: '4.8',
    reviews: 145,
    badge: '-15%',
    price: 34,
    priceFormatted: 'Rp 138.000',
    oldPriceFormatted: 'Rp 162.000',
    image: '/images/categories/cushion.png',
    skinTypes: ['Berminyak', 'Normal', 'Kombinasi'],
    isPopular: false,
    isNew: false,
  },
  {
    id: 'm-face-blush',
    category: 'makeup',
    group: 'FACE',
    subcategory: 'Blush On',
    tagSub: 'Blush On',
    brand: 'KOAFY PARIS',
    volume: '5 G',
    name: 'Koafy Silk Petal Velvet Blush On — Soft Rose',
    rating: '4.9',
    reviews: 260,
    badge: '-20%',
    price: 29,
    priceFormatted: 'Rp 118.000',
    oldPriceFormatted: 'Rp 148.000',
    image: '/images/banner-koafy-trio.jpg',
    skinTypes: ['Normal', 'Sensitif', 'Kering', 'Kombinasi'],
    isPopular: true,
    isNew: false,
  },

  // --- MAKEUP: EYE ---
  {
    id: 'm-eye-brow',
    category: 'makeup',
    group: 'EYE',
    subcategory: 'Eyebrow',
    tagSub: 'Eyebrow',
    brand: 'KOAFY PARIS',
    volume: '0.1 G',
    name: 'Koafy Precision Micro Brow Pencil & Spoolie',
    rating: '4.8',
    reviews: 185,
    badge: '-15%',
    price: 24,
    priceFormatted: 'Rp 95.000',
    oldPriceFormatted: 'Rp 112.000',
    image: '/images/product-lip-velvet.jpg',
    skinTypes: ['Normal', 'Berminyak', 'Kering', 'Sensitif', 'Acne-Prone', 'Kombinasi'],
    isPopular: false,
    isNew: true,
  },
  {
    id: 'm-eye-liner',
    category: 'makeup',
    group: 'EYE',
    subcategory: 'Eyeliner',
    tagSub: 'Eyeliner',
    brand: 'KOAFY PARIS',
    volume: '0.5 ML',
    name: 'Koafy Hyper-Stay 24H Waterproof Liquid Eyeliner',
    rating: '4.9',
    reviews: 290,
    badge: '-20%',
    price: 26,
    priceFormatted: 'Rp 105.000',
    oldPriceFormatted: 'Rp 130.000',
    image: '/images/product-lip-velvet.jpg',
    skinTypes: ['Normal', 'Berminyak', 'Sensitif', 'Kombinasi'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-eye-mascara',
    category: 'makeup',
    group: 'EYE',
    subcategory: 'Mascara',
    tagSub: 'Mascara',
    brand: 'KOAFY PARIS',
    volume: '8 ML',
    name: 'Koafy Dramatic Lash Lift & Curl Mascara',
    rating: '4.9',
    reviews: 320,
    badge: '-22%',
    price: 33,
    priceFormatted: 'Rp 132.000',
    oldPriceFormatted: 'Rp 169.000',
    image: '/images/product-butterbalm-1.jpg',
    skinTypes: ['Sensitif', 'Normal', 'Berminyak'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 'm-eye-shadow',
    category: 'makeup',
    group: 'EYE',
    subcategory: 'Eyeshadow',
    tagSub: 'Eyeshadow',
    brand: 'KOAFY PARIS',
    volume: '9 SHADES',
    name: 'Koafy Sunset Romance 9-Color Eyeshadow Palette',
    rating: '4.9',
    reviews: 215,
    badge: '-25%',
    price: 52,
    priceFormatted: 'Rp 205.000',
    oldPriceFormatted: 'Rp 275.000',
    image: '/images/banner-koafy-trio.jpg',
    skinTypes: ['Sensitif', 'Normal', 'Kering', 'Kombinasi'],
    isPopular: true,
    isNew: true,
  },

  // --- SKINCARE ---
  {
    id: 's-cleanser-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Cleanser',
    tagSub: 'Cleanser',
    brand: 'KOAFY PARIS',
    volume: '100 ML',
    name: 'Koafy Gentle Cloud Hydrating Gel Cleanser',
    rating: '4.9',
    reviews: 450,
    badge: '-20%',
    price: 28,
    priceFormatted: 'Rp 112.000',
    oldPriceFormatted: 'Rp 140.000',
    image: '/images/categories/cleanser.png',
    skinTypes: ['Sensitif', 'Acne-Prone', 'Kering', 'Normal'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 's-moist-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Moisturizer',
    tagSub: 'Moisturizer',
    brand: 'HSK SECRET',
    volume: '50 G',
    name: 'Koafy 5X Ceramide Barrier Moisture Gel',
    rating: '5.0',
    reviews: 580,
    badge: '-22%',
    price: 42,
    priceFormatted: 'Rp 165.000',
    oldPriceFormatted: 'Rp 210.000',
    image: '/images/banner-healthy-barrier.jpg',
    skinTypes: ['Sensitif', 'Kering', 'Acne-Prone', 'Kombinasi'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 's-mask-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Face Mask',
    tagSub: 'Face Mask',
    brand: 'KOAFY PARIS',
    volume: '80 ML',
    name: 'Koafy Rose Hydrating Glow Sleeping Mask',
    rating: '4.8',
    reviews: 195,
    badge: '-18%',
    price: 33,
    priceFormatted: 'Rp 129.000',
    oldPriceFormatted: 'Rp 158.000',
    image: '/images/categories/masker.png',
    skinTypes: ['Sensitif', 'Kering', 'Normal'],
    isPopular: false,
    isNew: false,
  },
  {
    id: 's-serum-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Serum & Ampoule',
    tagSub: 'Serum',
    brand: 'HSK SECRET',
    volume: '30 ML',
    name: 'Koafy Hyaluronic B5 Intensive Hydra Serum',
    rating: '4.9',
    reviews: 320,
    badge: '-24%',
    price: 40,
    priceFormatted: 'Rp 155.000',
    oldPriceFormatted: 'Rp 205.000',
    image: '/images/categories/serum-conseler.png',
    skinTypes: ['Kering', 'Sensitif', 'Kombinasi', 'Normal'],
    isPopular: true,
    isNew: false,
  },
  {
    id: 's-sunscreen-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Sunscreen',
    tagSub: 'Sunscreen',
    brand: 'KOAFY PARIS',
    volume: '50 ML',
    name: 'Koafy Cica Airy Sunscreen Serum SPF 50+ PA++++',
    rating: '4.9',
    reviews: 620,
    badge: '-20%',
    price: 35,
    priceFormatted: 'Rp 139.000',
    oldPriceFormatted: 'Rp 175.000',
    image: '/images/categories/cleanser.png',
    skinTypes: ['Sensitif', 'Acne-Prone', 'Berminyak', 'Kombinasi'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 's-toner-1',
    category: 'skincare',
    group: 'DAILY CARE',
    subcategory: 'Toner & Essence',
    tagSub: 'Toner',
    brand: 'KOAFY PARIS',
    volume: '150 ML',
    name: 'Koafy AHA BHA Mild Clarifying Exfoliating Toner',
    rating: '4.8',
    reviews: 210,
    badge: '-15%',
    price: 31,
    priceFormatted: 'Rp 124.000',
    oldPriceFormatted: 'Rp 146.000',
    image: '/images/categories/cleanser.png',
    skinTypes: ['Berminyak', 'Acne-Prone', 'Kombinasi'],
    isPopular: false,
    isNew: false,
  },

  // --- PERAWATAN TUBUH ---
  {
    id: 'b-wash-1',
    category: 'body-care',
    group: 'BODY ESSENTIALS',
    subcategory: 'Body Wash',
    tagSub: 'Body Wash',
    brand: 'KOAFY PARIS',
    volume: '300 ML',
    name: 'Koafy Brightening Niacinamide Petal Body Wash',
    rating: '4.8',
    reviews: 140,
    badge: '-18%',
    price: 27,
    priceFormatted: 'Rp 108.000',
    oldPriceFormatted: 'Rp 132.000',
    image: '/images/categories/cleanser.png',
    skinTypes: ['Normal', 'Kering', 'Sensitif'],
    isPopular: false,
    isNew: false,
  },
  {
    id: 'b-lotion-1',
    category: 'body-care',
    group: 'BODY ESSENTIALS',
    subcategory: 'Body Lotion',
    tagSub: 'Body Lotion',
    brand: 'KOAFY PARIS',
    volume: '250 ML',
    name: 'Koafy Cherry Blossom Silky Body Lotion',
    rating: '4.9',
    reviews: 260,
    badge: '-20%',
    price: 32,
    priceFormatted: 'Rp 128.000',
    oldPriceFormatted: 'Rp 160.000',
    image: '/images/product-butterbalm-1.jpg',
    skinTypes: ['Kering', 'Normal', 'Sensitif'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'b-scrub-1',
    category: 'body-care',
    group: 'BODY ESSENTIALS',
    subcategory: 'Body Scrub',
    tagSub: 'Body Scrub',
    brand: 'KOAFY PARIS',
    volume: '200 G',
    name: 'Koafy Gentle Sugar & Almond Exfoliating Scrub',
    rating: '4.8',
    reviews: 110,
    badge: '-15%',
    price: 29,
    priceFormatted: 'Rp 115.000',
    oldPriceFormatted: 'Rp 136.000',
    image: '/images/categories/masker.png',
    skinTypes: ['Normal', 'Kering', 'Kombinasi'],
    isPopular: false,
    isNew: false,
  },
  {
    id: 'b-deo-1',
    category: 'body-care',
    group: 'BODY ESSENTIALS',
    subcategory: 'Deodorant',
    tagSub: 'Deodorant',
    brand: 'KOAFY PARIS',
    volume: '50 ML',
    name: 'Koafy Invisible Fresh Bright Serum Deodorant',
    rating: '4.7',
    reviews: 95,
    badge: '-10%',
    price: 22,
    priceFormatted: 'Rp 88.000',
    oldPriceFormatted: 'Rp 98.000',
    image: '/images/categories/serum-conseler.png',
    skinTypes: ['Sensitif', 'Normal'],
    isPopular: false,
    isNew: false,
  },

  // --- PERAWATAN RAMBUT ---
  {
    id: 'h-shampoo-1',
    category: 'hair-care',
    group: 'HAIR ESSENTIALS',
    subcategory: 'Shampoo',
    tagSub: 'Shampoo',
    brand: 'KOAFY PARIS',
    volume: '280 ML',
    name: 'Koafy Botanical Keratin Repair Nourish Shampoo',
    rating: '4.8',
    reviews: 175,
    badge: '-18%',
    price: 30,
    priceFormatted: 'Rp 120.000',
    oldPriceFormatted: 'Rp 148.000',
    image: '/images/categories/cleanser.png',
    skinTypes: ['Normal', 'Berminyak', 'Sensitif'],
    isPopular: false,
    isNew: false,
  },
  {
    id: 'h-mask-1',
    category: 'hair-care',
    group: 'HAIR ESSENTIALS',
    subcategory: 'Hair Mask',
    tagSub: 'Hair Mask',
    brand: 'KOAFY PARIS',
    volume: '200 ML',
    name: 'Koafy Argan & Peptide Deep Treatment Hair Mask',
    rating: '4.9',
    reviews: 210,
    badge: '-22%',
    price: 36,
    priceFormatted: 'Rp 145.000',
    oldPriceFormatted: 'Rp 185.000',
    image: '/images/categories/masker.png',
    skinTypes: ['Kering', 'Normal'],
    isPopular: true,
    isNew: true,
  },
  {
    id: 'h-serum-1',
    category: 'hair-care',
    group: 'HAIR ESSENTIALS',
    subcategory: 'Hair Serum',
    tagSub: 'Hair Oil',
    brand: 'KOAFY PARIS',
    volume: '60 ML',
    name: 'Koafy Miracle Gloss Lightweight Hair Serum Oil',
    rating: '4.9',
    reviews: 310,
    badge: '-20%',
    price: 34,
    priceFormatted: 'Rp 135.000',
    oldPriceFormatted: 'Rp 169.000',
    image: '/images/categories/serum-conseler.png',
    skinTypes: ['Normal', 'Kering', 'Kombinasi'],
    isPopular: true,
    isNew: false,
  },
]);

// Header Title dynamic computation
const currentHeaderTitle = computed(() => {
  if (selectedSubcategory.value) {
    return `${selectedSubcategory.value} Koafy`;
  }
  if (selectedCategory.value === 'makeup') return 'Katalog Makeup Koafy';
  if (selectedCategory.value === 'skincare') return 'Katalog Skincare Koafy';
  if (selectedCategory.value === 'body-care') return 'Katalog Perawatan Tubuh';
  if (selectedCategory.value === 'hair-care') return 'Katalog Perawatan Rambut';
  return 'Semua Koleksi Produk';
});

// Category Names lookup
function getCategoryName(catId) {
  const map = {
    makeup: 'Makeup',
    skincare: 'Skincare',
    'body-care': 'Perawatan Tubuh',
    'hair-care': 'Perawatan Rambut',
  };
  return map[catId] || catId;
}

// Check favorite status
function isFavorite(productId) {
  return props.wishlistIds.includes(productId);
}

// Navigation helpers
function goHome() {
  emit('back-to-home');
}

// Accordion toggle
function toggleCategoryAccordion(catId) {
  const idx = openCategories.value.indexOf(catId);
  if (idx > -1) {
    openCategories.value.splice(idx, 1);
  } else {
    openCategories.value.push(catId);
  }
}

// Select main category
function selectCategory(catId) {
  selectedCategory.value = catId;
  selectedSubcategory.value = null;
  if (catId !== 'all' && !openCategories.value.includes(catId)) {
    openCategories.value.push(catId);
  }
  emit('toast', `Kategori dipilih: ${catId === 'all' ? 'Semua Kategori' : getCategoryName(catId)}`);
}

// Select subcategory
function selectSubcategory(catId, subName) {
  selectedCategory.value = catId;
  selectedSubcategory.value = subName;
  if (!openCategories.value.includes(catId)) {
    openCategories.value.push(catId);
  }
  isMobileFilterOpen.value = false;
  emit('toast', `Filter subkategori: ${subName}`);
}

// Skin type toggle
function toggleSkinType(st) {
  const idx = selectedSkinTypes.value.indexOf(st);
  if (idx > -1) {
    selectedSkinTypes.value.splice(idx, 1);
  } else {
    selectedSkinTypes.value.push(st);
  }
}

// Reset filters
function resetAllFilters() {
  searchKeyword.value = '';
  selectedCategory.value = 'all';
  selectedSubcategory.value = null;
  selectedSkinTypes.value = [];
  sortBy.value = 'populer';
  isMobileFilterOpen.value = false;
  emit('toast', 'Filter berhasil di-reset ke Semua Kategori');
}

// Active filters count
const activeFilterCount = computed(() => {
  let count = 0;
  if (searchKeyword.value.trim()) count++;
  if (selectedCategory.value !== 'all') count++;
  if (selectedSubcategory.value) count++;
  count += selectedSkinTypes.value.length;
  return count;
});

// Active Filter Chips
const activeFilterChips = computed(() => {
  const chips = [];
  if (searchKeyword.value.trim()) {
    chips.push({
      key: 'search',
      label: `"${searchKeyword.value.trim()}"`,
      clear: () => (searchKeyword.value = ''),
    });
  }
  if (selectedCategory.value !== 'all') {
    chips.push({
      key: 'cat',
      label: getCategoryName(selectedCategory.value),
      clear: () => {
        selectedCategory.value = 'all';
        selectedSubcategory.value = null;
      },
    });
  }
  if (selectedSubcategory.value) {
    chips.push({
      key: 'subcat',
      label: selectedSubcategory.value,
      clear: () => (selectedSubcategory.value = null),
    });
  }
  selectedSkinTypes.value.forEach((st) => {
    chips.push({
      key: `st-${st}`,
      label: `Kulit: ${st}`,
      clear: () => toggleSkinType(st),
    });
  });
  return chips;
});

// Filter & Sort Logic
const filteredProducts = computed(() => {
  let result = [...allProducts.value];

  // 1. Keyword search
  const q = searchKeyword.value.trim().toLowerCase();
  if (q) {
    result = result.filter(
      (p) =>
        p.name.toLowerCase().includes(q) ||
        p.brand.toLowerCase().includes(q) ||
        (p.subcategory && p.subcategory.toLowerCase().includes(q)) ||
        (p.group && p.group.toLowerCase().includes(q)) ||
        (p.tagSub && p.tagSub.toLowerCase().includes(q))
    );
  }

  // 2. Category filter
  if (selectedCategory.value !== 'all') {
    result = result.filter((p) => p.category === selectedCategory.value);
  }

  // 3. Subcategory filter
  if (selectedSubcategory.value) {
    const subLower = selectedSubcategory.value.toLowerCase();
    result = result.filter(
      (p) =>
        p.subcategory.toLowerCase() === subLower ||
        (p.tagSub && p.tagSub.toLowerCase().includes(subLower))
    );
  }

  // 4. Skin Type filter (any match)
  if (selectedSkinTypes.value.length > 0) {
    result = result.filter((p) => {
      if (!p.skinTypes || p.skinTypes.length === 0) return true;
      return selectedSkinTypes.value.some((st) => p.skinTypes.includes(st));
    });
  }

  // 5. Sorting
  if (sortBy.value === 'harga-rendah') {
    result.sort((a, b) => a.price - b.price);
  } else if (sortBy.value === 'harga-tinggi') {
    result.sort((a, b) => b.price - a.price);
  } else if (sortBy.value === 'rating') {
    result.sort((a, b) => parseFloat(b.rating) - parseFloat(a.rating));
  } else if (sortBy.value === 'terbaru') {
    result.sort((a, b) => (b.isNew ? 1 : 0) - (a.isNew ? 1 : 0));
  } else {
    // Populer
    result.sort((a, b) => b.reviews - a.reviews);
  }

  return result;
});

// Handle prop changes (e.g. if navigated with initialCategory)
watch(
  () => props.initialCategory,
  (val) => {
    if (val) {
      // Map category ID from category strip (e.g. cushion, cleanser, lipbam, liquid-pondation)
      if (val === 'cushion') {
        selectedCategory.value = 'makeup';
        selectedSubcategory.value = 'Cushion';
      } else if (val === 'liquid-pondation') {
        selectedCategory.value = 'makeup';
        selectedSubcategory.value = 'Foundation';
      } else if (val === 'serum-conseler') {
        selectedCategory.value = 'makeup';
        selectedSubcategory.value = 'Concealer';
      } else if (val === 'lipbam') {
        selectedCategory.value = 'makeup';
        selectedSubcategory.value = 'Lip Balm';
      } else if (val === 'cleanser') {
        selectedCategory.value = 'skincare';
        selectedSubcategory.value = 'Cleanser';
      } else if (val === 'masker') {
        selectedCategory.value = 'skincare';
        selectedSubcategory.value = 'Face Mask';
      } else {
        selectedCategory.value = val;
      }
    }
  },
  { immediate: true }
);

watch(
  () => props.initialSubcategory,
  (val) => {
    if (val) {
      selectedSubcategory.value = val;
    }
  },
  { immediate: true }
);
</script>
