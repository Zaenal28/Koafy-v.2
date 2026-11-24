<template>
  <!-- =====================================================================
       HALAMAN LOGIN ADMIN KOAFY (http://127.0.0.1:8000/login/admin)
       Autentikasi Gmail & Password menggunakan JWT (JSON Web Token)
       ===================================================================== -->
  <section class="admin-login-page" aria-label="Halaman Login Admin Koafy">
    <div class="admin-login-card">
      <!-- Top Bar: Brand Logo + Back to Store -->
      <div class="admin-login-topbar">
        <div class="admin-login-brand">
          <img src="/images/koafy-logo.png" alt="Koafy Logo" class="admin-login-logo" />
          <span class="admin-jwt-badge">ADMIN PORTAL • JWT</span>
        </div>
        <button
          type="button"
          class="admin-back-store-btn"
          @click="$emit('back-to-home')"
        >
          ← Ke Toko
        </button>
      </div>

      <!-- Header Title -->
      <div class="admin-login-header">
        <div class="admin-shield-icon">🔐</div>
        <h1 class="admin-login-title">Login Administrator Koafy</h1>
        <p class="admin-login-subtitle">
          Masuk menggunakan akun <strong>Gmail Admin</strong> dan <strong>Password</strong> dengan keamanan token <strong>JWT (HS256)</strong>.
        </p>
      </div>

      <!-- Error Alert Banner -->
      <div v-if="errorMessage" class="admin-login-error-alert">
        <span>⚠️ {{ errorMessage }}</span>
      </div>

      <!-- Quick Demo Gmail Credential Helper -->
      <div class="admin-demo-credentials-box">
        <div class="demo-cred-info">
          <span class="demo-cred-tag">AKUN GMAIL ADMIN RESMI</span>
          <div class="demo-cred-text">
            <span>Gmail: <strong>admin.koafy@gmail.com</strong></span>
            <span>Password: <strong>password123</strong></span>
          </div>
        </div>
        <button
          type="button"
          class="btn-fill-demo"
          @click="fillDemoAdmin"
        >
          Gunakan Akun Ini
        </button>
      </div>

      <!-- Login Form -->
      <form class="admin-login-form" @submit.prevent="handleAdminLogin">
        <!-- Gmail Input -->
        <div class="admin-form-group">
          <label for="admin-gmail" class="admin-form-label">
            Email / Gmail Administrator <span class="req-star">*</span>
          </label>
          <div class="admin-input-wrap">
            <span class="admin-input-icon">✉️</span>
            <input
              id="admin-gmail"
              v-model="form.email"
              type="email"
              required
              placeholder="admin.koafy@gmail.com"
              class="admin-form-input"
            />
          </div>
          <small class="admin-field-hint">Mendukung akun @gmail.com resmi Administrator Koafy</small>
        </div>

        <!-- Password Input -->
        <div class="admin-form-group">
          <label for="admin-password" class="admin-form-label">
            Password <span class="req-star">*</span>
          </label>
          <div class="admin-input-wrap">
            <span class="admin-input-icon">🔑</span>
            <input
              id="admin-password"
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              required
              minlength="6"
              placeholder="Masukkan password admin"
              class="admin-form-input"
            />
            <button
              type="button"
              class="admin-pw-toggle"
              @click="showPassword = !showPassword"
            >
              {{ showPassword ? 'Sembunyikan' : 'Lihat' }}
            </button>
          </div>
        </div>

        <!-- JWT Info Row -->
        <div class="jwt-security-info-row">
          <span class="jwt-dot"></span>
          <span>Sesi dilindungi dengan <strong>Bearer JWT Token</strong> terenkripsi</span>
        </div>

        <!-- Submit CTA -->
        <button
          type="submit"
          class="btn-admin-login-submit"
          :disabled="isLoading"
        >
          <span v-if="isLoading">Memverifikasi Token JWT...</span>
          <span v-else>Masuk ke Dashboard Admin →</span>
        </button>
      </form>

      <!-- Footer -->
      <div class="admin-login-footer">
        <span>Koafy by HSK Secret • Sistem Manajemen E-Commerce &amp; Transaksi</span>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['back-to-home', 'admin-login-success', 'toast']);

const form = ref({
  email: 'admin.koafy@gmail.com',
  password: 'password123',
});

const showPassword = ref(false);
const isLoading = ref(false);
const errorMessage = ref('');

function fillDemoAdmin() {
  form.value.email = 'admin.koafy@gmail.com';
  form.value.password = 'password123';
  errorMessage.value = '';
  emit('toast', 'Kredensial Gmail Admin telah diisi');
}

async function handleAdminLogin() {
  errorMessage.value = '';
  if (!form.value.email || !form.value.password) {
    errorMessage.value = 'Mohon isi Gmail dan Password Admin.';
    return;
  }

  isLoading.value = true;
  try {
    const response = await fetch('/api/auth/admin/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
      body: JSON.stringify({
        email: form.value.email,
        password: form.value.password,
      }),
    });

    const data = await response.json();

    if (!response.ok || !data.success) {
      errorMessage.value = data.message || 'Login Admin gagal. Periksa kembali Gmail dan Password Anda.';
      isLoading.value = false;
      return;
    }

    // Simpan JWT Token & Data Admin di localStorage
    localStorage.setItem('koafy_admin_jwt', data.token);
    localStorage.setItem('koafy_admin_user', JSON.stringify(data.admin));

    emit('toast', data.message || 'Login Admin JWT berhasil!');
    emit('admin-login-success', {
      admin: data.admin,
      token: data.token,
    });
  } catch (err) {
    console.error('Admin login error:', err);
    errorMessage.value = 'Gagal terhubung ke server autentikasi.';
  } finally {
    isLoading.value = false;
  }
}
</script>
