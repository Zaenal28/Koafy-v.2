<template>
  <!-- =====================================================================
       LOGIN & REGISTER PAGE (REF IMAGES 1 & 2)
       - Split 2-column layout (Form Left, Image 2 Hero Banner Right)
       - Toggle between Login and Register (with No Telepon / WhatsApp)
       ===================================================================== -->
  <section class="auth-page-wrapper" aria-label="Halaman Masuk dan Daftar Koafy">
    <div class="auth-grid-container">

      <!-- LEFT COLUMN: Forms, Social Logins, and Switcher -->
      <div class="auth-form-column">
        <!-- Top Nav: Logo & Back Button -->
        <div class="auth-top-nav">
          <a href="#home" class="auth-logo-link" @click.prevent="$emit('back-to-home')">
            <img
              src="/images/koafy-logo.png"
              alt="Koafy by HSK Secret"
              class="auth-logo-img"
            />
          </a>

          <button
            type="button"
            class="auth-back-btn"
            aria-label="Kembali ke Beranda"
            @click="$emit('back-to-home')"
          >
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Beranda</span>
          </button>
        </div>

        <!-- Form Center Content -->
        <div class="auth-form-content">
          <!-- Heading & Subtitle -->
          <div class="auth-header-text">
            <h1 class="auth-main-title">
              {{ isRegister ? 'Create Your Account' : 'Start Your Journey' }}
              <span class="highlight-koafy">with Koafy</span>
            </h1>
            <p class="auth-sub-title">
              {{
                isRegister
                  ? 'Daftar akun baru untuk menikmati diskon eksklusif dan voucher member'
                  : 'Enter your email and password for Koafy to continue'
              }}
            </p>
          </div>

          <!-- Social Login Buttons (Google & Apple) -->
          <div class="auth-social-row">
            <button
              type="button"
              class="auth-social-btn"
              @click="handleSocialLogin('Google')"
            >
              <!-- Google SVG Icon -->
              <svg width="18" height="18" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.66v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.15z" />
                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.26v3.15C3.27 21.36 7.33 24 12 24z" />
                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.26C.46 8.16 0 9.94 0 12s.46 3.84 1.26 5.42l4.02-3.15z" />
                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.27 2.64 1.26 6.58l4.02 3.15c.95-2.83 3.6-4.98 6.72-4.98z" />
              </svg>
              <span>Login in with Google</span>
            </button>

            <button
              type="button"
              class="auth-social-btn"
              @click="handleSocialLogin('Apple')"
            >
              <!-- Apple SVG Icon -->
              <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.38c.62-.75 1.04-1.8 0.93-2.85-.9.04-1.99.6-2.63 1.35-.57.65-1.07 1.71-.94 2.73 1 .08 2.02-.48 2.64-1.23z" />
              </svg>
              <span>Login in with Apple</span>
            </button>
          </div>

          <!-- Divider "or" -->
          <div class="auth-divider-row">
            <span class="auth-divider-line"></span>
            <span class="auth-divider-text">or</span>
            <span class="auth-divider-line"></span>
          </div>

          <!-- ===================================================================
               1. LOGIN FORM
               =================================================================== -->
          <form v-if="!isRegister" class="auth-form" @submit.prevent="submitLogin">
            <!-- Email -->
            <div class="form-group">
              <label for="login-email" class="form-label">Email*</label>
              <div class="form-input-wrap">
                <input
                  id="login-email"
                  v-model="loginForm.email"
                  type="email"
                  required
                  placeholder="example@domain.com"
                  class="form-control"
                />
              </div>
            </div>

            <!-- Password -->
            <div class="form-group">
              <div class="form-label-row">
                <label for="login-password" class="form-label">Password*</label>
                <a
                  href="#forgot"
                  class="form-link-muted"
                  @click.prevent="$emit('toast', 'Instruksi reset password dikirim ke email')"
                >
                  Forgot password?
                </a>
              </div>
              <div class="form-input-wrap">
                <input
                  id="login-password"
                  v-model="loginForm.password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                  placeholder="min 8 chars"
                  class="form-control"
                />
                <button
                  type="button"
                  class="password-toggle-btn"
                  :aria-label="showPassword ? 'Sembunyikan password' : 'Lihat password'"
                  @click="showPassword = !showPassword"
                >
                  <svg v-if="showPassword" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                  </svg>
                  <svg v-else width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Agreement Checkbox -->
            <label class="form-checkbox-row">
              <input v-model="loginForm.agreed" type="checkbox" required class="checkbox-pink" />
              <span>I hereby agree to the <a href="#terms" class="form-link-pink" @click.prevent="$emit('toast', 'Membuka Syarat & Ketentuan Koafy')">Terms &amp; Conditions</a> of Koafy</span>
            </label>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit">
              Sign in
            </button>
          </form>

          <!-- ===================================================================
               2. REGISTER FORM (TERMASUK NO TELEPON / WHATSAPP SESUAI REQUEST)
               =================================================================== -->
          <form v-else class="auth-form" @submit.prevent="submitRegister">
            <!-- Full Name -->
            <div class="form-group">
              <label for="reg-name" class="form-label">Nama Lengkap*</label>
              <div class="form-input-wrap">
                <input
                  id="reg-name"
                  v-model="registerForm.name"
                  type="text"
                  required
                  placeholder="cth. Kayla Anindita"
                  class="form-control"
                />
              </div>
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="reg-email" class="form-label">Email*</label>
              <div class="form-input-wrap">
                <input
                  id="reg-email"
                  v-model="registerForm.email"
                  type="email"
                  required
                  placeholder="example@domain.com"
                  class="form-control"
                />
              </div>
            </div>

            <!-- No Telepon / WhatsApp (REQUEST USER KHUSUS) -->
            <div class="form-group">
              <label for="reg-phone" class="form-label">No. Telepon / WhatsApp*</label>
              <div class="form-input-wrap">
                <span class="phone-prefix">+62</span>
                <input
                  id="reg-phone"
                  v-model="registerForm.phone"
                  type="tel"
                  required
                  placeholder="812-3456-7890"
                  class="form-control with-prefix"
                />
                <span class="phone-icon-indicator" title="Terhubung untuk konfirmasi pesanan via WhatsApp">
                  💬
                </span>
              </div>
              <small class="form-hint">Nomor akan digunakan untuk notifikasi pesanan dan klaim voucher via WhatsApp</small>
            </div>

            <!-- Password -->
            <div class="form-group">
              <label for="reg-password" class="form-label">Password*</label>
              <div class="form-input-wrap">
                <input
                  id="reg-password"
                  v-model="registerForm.password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                  minlength="8"
                  placeholder="min 8 chars"
                  class="form-control"
                />
                <button
                  type="button"
                  class="password-toggle-btn"
                  @click="showPassword = !showPassword"
                >
                  <svg v-if="showPassword" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                  </svg>
                  <svg v-else width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Agreement Checkbox -->
            <label class="form-checkbox-row">
              <input v-model="registerForm.agreed" type="checkbox" required class="checkbox-pink" />
              <span>Saya menyetujui <a href="#terms" class="form-link-pink" @click.prevent="$emit('toast', 'Membuka Syarat & Ketentuan Koafy')">Syarat &amp; Ketentuan</a> serta Kebijakan Privasi Koafy</span>
            </label>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit">
              Daftar Akun Baru
            </button>
          </form>

          <!-- Toggle Switcher: Login <-> Register -->
          <div class="auth-switch-footer">
            <span v-if="!isRegister">
              Don't have an account?
              <button type="button" class="auth-switch-btn" @click="isRegister = true">Sign up</button>
            </span>
            <span v-else>
              Already have an account?
              <button type="button" class="auth-switch-btn" @click="isRegister = false">Sign in</button>
            </span>
          </div>

          <!-- Bottom Copyright -->
          <p class="auth-copyright">
            Copyright &copy; 2026 Koafy by HSK Secret. All rights reserved.
          </p>
        </div>
      </div>

      <!-- RIGHT COLUMN: Image 2 Hero Banner with Overlay & Story Card -->
      <div class="auth-banner-column">
        <img
          src="/images/auth-hero.jpg"
          alt="Koafy by HSK Secret Beauty Journey"
          class="auth-hero-bg-img"
        />

        <!-- Top Text Header Overlay -->
        <div class="auth-hero-top-overlay">
          <h2 class="auth-hero-headline">
            Guiding you to<br />better health &amp; glow
          </h2>
          <button
            type="button"
            class="auth-hero-close-btn"
            aria-label="Tutup"
            @click="$emit('back-to-home')"
          >
            ✕
          </button>
        </div>

        <!-- Bottom Story Glassmorphism Card (Ref Image 1 Style) -->
        <div class="auth-hero-story-card">
          <h3 class="story-title">Kayla's Story</h3>
          <p class="story-quote">
            "Formula Koafy Crystal Butterbalm benar-benar mengunci hidrasi bibir dan merawat skin barrier seharian tanpa rasa lengket."
          </p>
          <a
            href="#explore"
            class="story-action-link"
            @click.prevent="$emit('back-to-home')"
          >
            <span>Explore Koafy Beauty</span>
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
          </a>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue';

const emit = defineEmits(['back-to-home', 'login-success', 'toast']);

const isRegister = ref(false);
const showPassword = ref(false);

const loginForm = ref({
  email: '',
  password: '',
  agreed: true,
});

const registerForm = ref({
  name: '',
  email: '',
  phone: '',
  password: '',
  agreed: true,
});

function handleSocialLogin(provider) {
  emit('toast', `Menghubungkan autentikasi dengan akun ${provider}...`);
  setTimeout(() => {
    emit('login-success', {
      name: 'Kayla Anindita',
      email: 'kayla.anindita@example.com',
    });
  }, 1000);
}

function submitLogin() {
  if (!loginForm.value.email || !loginForm.value.password) return;
  emit('login-success', {
    name: loginForm.value.email.split('@')[0],
    email: loginForm.value.email,
  });
}

function submitRegister() {
  if (!registerForm.value.name || !registerForm.value.email || !registerForm.value.phone) return;
  emit('login-success', {
    name: registerForm.value.name,
    email: registerForm.value.email,
    phone: registerForm.value.phone,
  });
}
</script>
