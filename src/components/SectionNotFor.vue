<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

const isOpen = ref(true)
const showAfterScroll = ref(false)

let observer: IntersectionObserver | null = null

function close() {
  isOpen.value = false
}

onMounted(() => {
  const hero = document.querySelector('.hero')
  if (hero) {
    observer = new IntersectionObserver(
      (entries) => {
        const [entry] = entries
        showAfterScroll.value = !entry.isIntersecting
      },
      { threshold: 0, rootMargin: '0px' }
    )
    observer.observe(hero)
  }
})

onUnmounted(() => {
  observer?.disconnect()
})

const items = [
  'Если вы ищете самый дешёвый вариант',
  'Если вы хотите скрыть незаконные операции',
  'Если вы не готовы предоставлять документы',
]
</script>

<template>
  <section class="notfor" aria-label="Важно: кому мы не подходим">
    <Transition name="notfor-fade">
      <div v-if="isOpen && showAfterScroll" class="notfor__card">
        <div class="notfor__header">
          <div class="notfor__warning-icon" aria-hidden="true">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 9v4"/><path d="M12 17h.01"/>
              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
            </svg>
          </div>
          <span class="notfor__label">Важно</span>
          <button
            type="button"
            class="notfor__close"
            aria-label="Закрыть"
            @click="close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <h2 class="notfor__title">Кому мы не подходим</h2>
        <p class="notfor__intro">Наши услуги не подходят, если:</p>

        <ul class="notfor__list">
          <li
            v-for="(item, i) in items"
            :key="i"
            class="notfor__item"
          >
            <span class="notfor__cross" aria-hidden="true">×</span>
            <span class="notfor__text">{{ item }}</span>
          </li>
        </ul>

        <p class="notfor__note">
          Мы работаем только с клиентами, которые готовы к прозрачному
          и профессиональному взаимодействию.
        </p>
      </div>
    </Transition>
  </section>
</template>

<style scoped>
.notfor {
  position: fixed;
  bottom: 1.25rem;
  right: 1.25rem;
  z-index: 1000;
  pointer-events: none;
}

.notfor__card {
  pointer-events: auto;
  max-width: 320px;
  width: calc(100vw - 2.5rem);
  padding: 0.75rem 1rem 1rem;
  background: #2b2d32;
  border-radius: var(--radius-md);
  text-align: left;
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.35);
}

.notfor__header {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.5rem;
}

.notfor__close {
  margin-left: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  padding: 0;
  border: none;
  background: rgba(255, 255, 255, 0.08);
  color: rgba(255, 255, 255, 0.7);
  border-radius: 4px;
  font-size: 1rem;
  line-height: 1;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}

.notfor__close:hover {
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
}

.notfor-fade-enter-active,
.notfor-fade-leave-active {
  transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.notfor-fade-enter-from,
.notfor-fade-leave-to {
  opacity: 0;
  transform: translateY(12px) scale(0.98);
}

.notfor__warning-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  flex-shrink: 0;
  background: rgba(245, 158, 11, 0.15);
  border-radius: 4px;
  color: #f59e0b;
}

.notfor__warning-icon :deep(svg) {
  width: 16px;
  height: 16px;
}

.notfor__label {
  font-size: 0.875rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.02em;
}

.notfor__title {
  font-size: 0.9375rem;
  font-weight: 800;
  color: #fff;
  margin-bottom: 0.25rem;
  line-height: 1.2;
}

.notfor__intro {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 0.5rem;
  line-height: 1.4;
}

.notfor__list {
  list-style: none;
  padding: 0;
  margin: 0 0 0.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.375rem;
}

.notfor__item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.notfor__cross {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 18px;
  height: 18px;
  flex-shrink: 0;
  color: var(--c-accent);
  font-size: 1rem;
  font-weight: 700;
  line-height: 1;
}

.notfor__text {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.35;
}

.notfor__note {
  font-size: 0.6875rem;
  color: rgba(255, 255, 255, 0.55);
  line-height: 1.4;
  margin: 0;
}

@media (max-width: 480px) {
  .notfor {
    bottom: 1rem;
    right: 1rem;
    left: 1rem;
    margin: 0;
  }

  .notfor__card {
    width: 100%;
    max-width: none;
  }
}
</style>
