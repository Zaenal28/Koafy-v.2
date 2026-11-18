<template>
  <div class="floating-chat-container">

    <!-- =====================================================================
         1. POPUP CHAT CS ADMIN WIDGET (REFERENSI GAMBAR 2)
         ===================================================================== -->
    <transition name="chat-fade-scale">
      <div v-if="isOpen" class="chat-popup-card">

        <!-- Header: Hot Pink Koafy (#F51487 / #E01E5A) + Avatar + Online status + Close btn -->
        <div class="chat-header">
          <div class="header-profile-group">
            <div class="header-avatar-wrap">
              <div class="avatar-circle">
                <span class="avatar-logo-text">Koafy</span>
              </div>
              <span class="online-indicator-dot" title="Online"></span>
            </div>
            <div class="header-title-wrap">
              <h3 class="header-agent-name">{{ t('chatCsTitle') }}</h3>
              <div class="header-agent-status">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                </svg>
                <span>{{ t('chatOnlineStatus') }}</span>
              </div>
            </div>
          </div>

          <button
            type="button"
            class="chat-close-btn"
            aria-label="Tutup Obrolan"
            @click="toggleChat"
          >
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Body: Date Pill + Welcome Bubble + Quick Question Topics -->
        <div class="chat-body">

          <!-- Date Badge -->
          <div class="chat-date-pill-wrap">
            <span class="chat-date-pill">{{ t('todayDatePill') }}</span>
          </div>

          <!-- Admin Welcome Bubble (Ref Gambar 2) -->
          <div class="chat-bubble-admin">
            <p class="admin-message-text">
              {{ t('chatGreeting') }}
            </p>
            <span class="admin-message-time">Admin &bull; Sekarang</span>
          </div>

          <!-- User Sent Message (if user clicked quick topic or typed) -->
          <div v-if="lastUserMessage" class="chat-bubble-user">
            <p class="user-message-text">{{ lastUserMessage }}</p>
            <span class="user-message-time">Anda &bull; Baru saja</span>
          </div>

          <!-- Quick Topics Section (Ref Gambar 2) -->
          <div class="chat-topics-section">
            <div class="topics-title-label">{{ t('quickTopicsTitle') }}</div>
            <div class="topics-button-list">
              <button
                v-for="topic in quickTopics"
                :key="topic.id"
                type="button"
                class="topic-choice-btn"
                @click="handleSelectTopic(topic)"
              >
                <span class="topic-icon">{{ topic.icon }}</span>
                <span class="topic-label">{{ topic.label }}</span>
              </button>
            </div>
          </div>

        </div>

        <!-- Footer / Input Area (Ref Gambar 2) -->
        <div class="chat-footer">
          <form class="chat-input-form" @submit.prevent="handleSendCustomMessage">
            <input
              v-model="userTypedMessage"
              type="text"
              :placeholder="t('typeMessagePlaceholder')"
              class="chat-text-input"
            />
            <button
              type="submit"
              class="chat-send-btn"
              aria-label="Kirim pesan ke WhatsApp"
            >
              <!-- Send Paper Plane Icon -->
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
              </svg>
            </button>
          </form>
        </div>

      </div>
    </transition>

    <!-- =====================================================================
         2. FLOATING BUTTON: CHAT CS ADMIN + WHATSAPP LOGO (REFERENSI GAMBAR 1)
         ===================================================================== -->
    <button
      type="button"
      class="floating-chat-pill-btn"
      :class="{ 'btn-active-open': isOpen }"
      aria-label="Buka Chat CS Admin WhatsApp"
      @click="toggleChat"
    >
      <!-- WhatsApp Logo SVG -->
      <span class="wa-icon-circle">
        <svg
          class="wa-svg-icon"
          width="20"
          height="20"
          viewBox="0 0 24 24"
          fill="currentColor"
        >
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
      </span>

      <!-- Label Text: Chat CS Admin -->
      <span class="floating-chat-label">{{ t('chatCsAdmin') }}</span>

      <!-- Pulse indicator dot -->
      <span class="floating-pulse-badge"></span>
    </button>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import { t } from '../i18n.js';

const emit = defineEmits(['toast']);

const isOpen = ref(false);
const userTypedMessage = ref('');
const lastUserMessage = ref('');

// Official Koafy WhatsApp CS phone number
const waPhoneNumber = '6281809607187';

// 4 Quick Question Topics (Ref Gambar 2)
const quickTopics = [
  {
    id: 't1',
    icon: '✨',
    label: 'Konsultasi Skincare & Tipe Kulit',
    waText: 'Halo Admin Koafy! Saya ingin konsultasi produk skincare yang cocok untuk tipe kulit saya.',
  },
  {
    id: 't2',
    icon: '💄',
    label: 'Konsultasi Makeup Sesuai Jenis Kulit',
    waText: 'Halo Admin Koafy! Saya ingin tanya rekomendasi makeup & shade yang sesuai untuk jenis kulit saya.',
  },
  {
    id: 't3',
    icon: '📦',
    label: 'Cek Status Pengiriman / No Resi',
    waText: 'Halo Admin Koafy! Saya ingin menanyakan status pengiriman dan nomor resi pesanan saya.',
  },
  {
    id: 't4',
    icon: '🏷️',
    label: 'Info Promo Diskon & Voucher',
    waText: 'Halo Admin Koafy! Mau tanya tentang promo diskon dan voucher gratis ongkir yang sedang aktif.',
  },
];

function toggleChat() {
  isOpen.value = !isOpen.value;
}

function handleSelectTopic(topic) {
  lastUserMessage.value = topic.label;
  emit('toast', `Mengarahkan ke WhatsApp CS Admin: "${topic.label}"...`);

  // Direct to WhatsApp after short natural delay
  const targetUrl = `https://wa.me/${waPhoneNumber}?text=${encodeURIComponent(topic.waText)}`;
  setTimeout(() => {
    window.open(targetUrl, '_blank');
  }, 450);
}

function handleSendCustomMessage() {
  const msg = userTypedMessage.value.trim();
  if (!msg) return;

  lastUserMessage.value = msg;
  userTypedMessage.value = '';
  emit('toast', 'Membuka WhatsApp Admin...');

  const fullText = `Halo Admin Koafy Beauty, ${msg}`;
  const targetUrl = `https://wa.me/${waPhoneNumber}?text=${encodeURIComponent(fullText)}`;
  setTimeout(() => {
    window.open(targetUrl, '_blank');
  }, 400);
}
</script>
