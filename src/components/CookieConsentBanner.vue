<script setup lang="ts">
import { ref, onMounted } from 'vue'
import CookiePolicyDocument from './documents/CookiePolicyDocument.vue'

const STORAGE_KEY = 'eb_cookie_consent_v1'

const visible = ref(false)
const policyRef = ref<InstanceType<typeof CookiePolicyDocument> | null>(null)

onMounted(() => {
  try {
    visible.value = localStorage.getItem(STORAGE_KEY) !== '1'
  } catch {
    visible.value = true
  }
})

function accept() {
  try {
    localStorage.setItem(STORAGE_KEY, '1')
  } catch {
    /* ignore */
  }
  visible.value = false
}

function openPolicy() {
  policyRef.value?.open()
}
</script>

<template>
  <Teleport to="body">
    <CookiePolicyDocument ref="policyRef" />
    <Transition name="cookie-banner">
      <div v-if="visible" class="cookie-banner" role="banner" aria-label="Согласие на cookie">
        <div class="cookie-banner__inner">
          <div class="cookie-banner__art" aria-hidden="true">
            <!-- Печенье 1 -->
            <svg class="cookie-banner__cookie cookie-banner__cookie--1" viewBox="0 0 64 64" width="64" height="64">
              <defs>
                <linearGradient id="cookieGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#d4a574" />
                  <stop offset="100%" style="stop-color:#b8956a" />
                </linearGradient>
              </defs>
              <circle cx="32" cy="32" r="28" fill="url(#cookieGrad1)" />
              <circle cx="22" cy="24" r="3.5" fill="#5c4033" opacity="0.85" />
              <circle cx="38" cy="20" r="2.8" fill="#5c4033" opacity="0.85" />
              <circle cx="44" cy="34" r="3.2" fill="#5c4033" opacity="0.85" />
              <circle cx="28" cy="42" r="2.5" fill="#5c4033" opacity="0.85" />
              <circle cx="18" cy="38" r="2.2" fill="#5c4033" opacity="0.75" />
            </svg>
            <!-- Печенье 2 -->
            <svg class="cookie-banner__cookie cookie-banner__cookie--2" viewBox="0 0 52 52" width="52" height="52">
              <defs>
                <linearGradient id="cookieGrad2" x1="0%" y1="100%" x2="100%" y2="0%">
                  <stop offset="0%" style="stop-color:#e8c9a8" />
                  <stop offset="100%" style="stop-color:#c9a882" />
                </linearGradient>
              </defs>
              <circle cx="26" cy="26" r="23" fill="url(#cookieGrad2)" />
              <circle cx="18" cy="18" r="2.5" fill="#4a3428" opacity="0.8" />
              <circle cx="32" cy="16" r="2" fill="#4a3428" opacity="0.8" />
              <circle cx="34" cy="30" r="2.8" fill="#4a3428" opacity="0.8" />
              <circle cx="20" cy="32" r="2.2" fill="#4a3428" opacity="0.75" />
            </svg>
            <!-- Крошка -->
            <span class="cookie-banner__crumb" />
          </div>

          <div class="cookie-banner__text">
            <p class="cookie-banner__title">Мы используем cookie</p>
            <p class="cookie-banner__desc">
              Продолжая пользоваться сайтом, вы соглашаетесь на обработку файлов cookie в соответствии с
              <button type="button" class="cookie-banner__link" @click="openPolicy">
                политикой обработки cookie
              </button>.
            </p>
          </div>

          <div class="cookie-banner__actions">
            <button type="button" class="cookie-banner__btn cookie-banner__btn--ghost" @click="openPolicy">
              Подробнее
            </button>
            <button type="button" class="cookie-banner__btn cookie-banner__btn--primary" @click="accept">
              Принять
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.cookie-banner {
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1100;
  padding: 1rem;
  padding-bottom: max(1rem, env(safe-area-inset-bottom));
  pointer-events: none;
}

.cookie-banner__inner {
  pointer-events: auto;
  max-width: 960px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 1rem 1.25rem;
  padding: 1rem 1.25rem;
  background: linear-gradient(
    135deg,
    rgba(15, 23, 42, 0.94) 0%,
    rgba(30, 41, 59, 0.92) 100%
  );
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: var(--radius-lg, 12px);
  box-shadow:
    0 -8px 40px rgba(0, 0, 0, 0.35),
    0 0 0 1px rgba(255, 255, 255, 0.04) inset;
  backdrop-filter: blur(12px);
}

.cookie-banner__art {
  position: relative;
  flex-shrink: 0;
  width: 88px;
  height: 72px;
}

.cookie-banner__cookie {
  position: absolute;
  filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.25));
}

.cookie-banner__cookie--1 {
  left: 0;
  top: 0;
  transform: rotate(-8deg);
}

.cookie-banner__cookie--2 {
  right: 0;
  bottom: 0;
  transform: rotate(12deg);
}

.cookie-banner__crumb {
  position: absolute;
  left: 50%;
  top: 8px;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #c9a882;
  opacity: 0.9;
}

.cookie-banner__text {
  flex: 1 min(100%, 420px);
  min-width: 0;
}

.cookie-banner__title {
  margin: 0 0 0.35rem;
  font-size: 0.9375rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.02em;
}

.cookie-banner__desc {
  margin: 0;
  font-size: 0.8125rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.72);
}

.cookie-banner__link {
  display: inline;
  padding: 0;
  border: none;
  background: none;
  color: #fbbf24;
  font: inherit;
  text-decoration: underline;
  text-underline-offset: 2px;
  cursor: pointer;
}

.cookie-banner__link:hover {
  color: #fcd34d;
}

.cookie-banner__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-left: auto;
}

.cookie-banner__btn {
  padding: 0.55rem 1.1rem;
  border-radius: 8px;
  font-size: 0.8125rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, color 0.2s, border-color 0.2s;
}

.cookie-banner__btn--ghost {
  border: 1px solid rgba(255, 255, 255, 0.25);
  background: transparent;
  color: rgba(255, 255, 255, 0.9);
}

.cookie-banner__btn--ghost:hover {
  background: rgba(255, 255, 255, 0.08);
}

.cookie-banner__btn--primary {
  border: none;
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
  color: #0f172a;
}

.cookie-banner__btn--primary:hover {
  filter: brightness(1.05);
}

.cookie-banner-enter-active,
.cookie-banner-leave-active {
  transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.cookie-banner-enter-from,
.cookie-banner-leave-to {
  opacity: 0;
   transform: translateY(0.75rem);
}

@media (max-width: 640px) {
  .cookie-banner__inner {
    flex-direction: column;
    align-items: stretch;
  }

  .cookie-banner__art {
    margin: 0 auto;
  }

  .cookie-banner__actions {
    margin-left: 0;
    justify-content: stretch;
  }

  .cookie-banner__btn {
    flex: 1;
    text-align: center;
  }
}
</style>
