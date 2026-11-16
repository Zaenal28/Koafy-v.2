<template>
  <!-- =====================================================================
       PRODUCT CATEGORIES STRIP (BELOW HERO SLIDER)
       ===================================================================== -->
  <section class="category-strip-section" aria-label="Kategori Produk Koafy">
    <div class="category-strip-card">
      <div class="category-grid">
        <button
          v-for="cat in categories"
          :key="cat.id"
          type="button"
          class="category-item"
          :class="{ active: activeCategory === cat.id }"
          @click="selectCategory(cat)"
        >
          <div class="category-icon-circle">
            <img
              :src="cat.icon"
              :alt="cat.name"
              class="category-icon-img"
            />
          </div>
          <span class="category-label">{{ cat.name }}</span>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['select-category']);

const activeCategory = ref(null);

const categories = ref([
  {
    id: 'cushion',
    name: 'Cushion',
    icon: '/images/categories/cushion.png',
  },
  {
    id: 'liquid-pondation',
    name: 'Liquid Pondation',
    icon: '/images/categories/liquid-pondation.png',
  },
  {
    id: 'serum-conseler',
    name: 'Serum Conseler',
    icon: '/images/categories/serum-conseler.png',
  },
  {
    id: 'lipbam',
    name: 'Lipbam',
    icon: '/images/categories/lipbam.png',
  },
  {
    id: 'cleanser',
    name: 'Cleanser',
    icon: '/images/categories/cleanser.png',
  },
  {
    id: 'masker',
    name: 'Masker',
    icon: '/images/categories/masker.png',
  },
]);

function selectCategory(cat) {
  activeCategory.value = cat.id;
  emit('select-category', cat);
}
</script>
