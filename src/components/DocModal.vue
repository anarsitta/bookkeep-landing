<script setup lang="ts">
import { ref } from 'vue'

defineProps<{
  show: boolean
  title: string
}>()

const emit = defineEmits<{
  close: []
}>()

const bodyRef = ref<HTMLElement | null>(null)

function onOverlayClick(e: MouseEvent) {
  if ((e.target as HTMLElement).classList.contains('doc-modal__backdrop')) {
    emit('close')
  }
}

function onBodyClick(e: MouseEvent) {
  const a = (e.target as HTMLElement).closest('a[href^="#"]')
  if (!a || (a.getAttribute('href') ?? '') === '#') return
  e.preventDefault()
  const id = a.getAttribute('href')?.slice(1)
  if (!id) return
  const el = bodyRef.value?.querySelector(`#${id}`)
  el?.scrollIntoView({ behavior: 'smooth', block: 'start' })
}
</script>

<template>
  <Teleport to="body">
    <Transition name="doc-modal">
      <div
        v-if="show"
        class="doc-modal__backdrop"
        role="dialog"
        aria-modal="true"
        :aria-label="title"
        @click="onOverlayClick"
      >
        <div class="doc-modal__box">
          <div class="doc-modal__header">
            <h3 class="doc-modal__title">{{ title }}</h3>
            <button
              type="button"
              class="doc-modal__close"
              aria-label="Закрыть"
              @click="emit('close')"
            >
              ×
            </button>
          </div>
          <div ref="bodyRef" class="doc-modal__body" @click="onBodyClick">
            <slot />
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.doc-modal__backdrop {
  position: fixed;
  inset: 0;
  z-index: 2000;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(4px);
}

.doc-modal__box {
  width: 100%;
  max-width: 1100px;
  max-height: 85vh;
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: var(--radius-lg);
  box-shadow: 0 24px 48px rgba(0, 0, 0, 0.25);
  overflow: hidden;
}

.doc-modal__header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid #e2e8f0;
  flex-shrink: 0;
}

.doc-modal__title {
  font-size: 1.125rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0;
}

.doc-modal__close {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  border: none;
  background: #f1f5f9;
  color: #64748b;
  border-radius: var(--radius-sm);
  font-size: 1.5rem;
  line-height: 1;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}

.doc-modal__close:hover {
  background: #e2e8f0;
  color: #0f172a;
}

.doc-modal__body {
  padding: 1.5rem;
  overflow-y: auto;
  font-size: 0.875rem;
  line-height: 1.65;
  color: #334155;
}

.doc-modal__body :deep(p) {
  margin: 0 0 0.75rem;
  text-align: justify;
}

.doc-modal__body :deep(p:last-child) {
  margin-bottom: 0;
}

.doc-modal__body :deep(.doc-content) {
  text-align: justify;
}

.doc-modal__body :deep(.doc-h) {
  font-size: 1.0625rem;
  font-weight: 700;
  text-align: center;
  margin-top: 1.25rem;
  margin-bottom: 0.5rem;
  color: #0f172a;
}

.doc-modal__body :deep(.doc-content .doc-h:first-child) {
  margin-top: 0;
}

.doc-modal__body :deep(.doc-with-nav) {
  display: flex;
  gap: 1.5rem;
  align-items: flex-start;
}

.doc-modal__body :deep(.doc-nav) {
  flex-shrink: 0;
  width: 180px;
  position: sticky;
  top: 0;
  display: flex;
  flex-direction: column;
  gap: 0.375rem;
  padding-right: 1rem;
  border-right: 1px solid #e2e8f0;
}

.doc-modal__body :deep(.doc-nav a) {
  font-size: 0.8125rem;
  color: #475569;
  text-decoration: none;
  line-height: 1.35;
  transition: color 0.2s;
}

.doc-modal__body :deep(.doc-nav a:hover) {
  color: var(--c-accent);
}

.doc-modal__body :deep(.doc-content) {
  flex: 1;
  min-width: 0;
}

.doc-modal__body :deep(.doc-h) {
  scroll-margin-top: 0.5rem;
}

.doc-modal__body :deep(code) {
  font-size: 0.8125em;
  padding: 0.15em 0.4em;
  background: #f1f5f9;
  color: #475569;
  border-radius: 4px;
}

@media (max-width: 768px) {
  .doc-modal__body :deep(.doc-nav) {
    display: none;
  }

  .doc-modal__body :deep(.doc-with-nav) {
    display: block;
  }
}

.doc-modal-enter-active,
.doc-modal-leave-active {
  transition: opacity 0.25s ease;
}

.doc-modal-enter-from,
.doc-modal-leave-to {
  opacity: 0;
}

.doc-modal-enter-active .doc-modal__box,
.doc-modal-leave-active .doc-modal__box {
  transition: transform 0.25s ease;
}

.doc-modal-enter-from .doc-modal__box,
.doc-modal-leave-to .doc-modal__box {
  transform: scale(0.96);
}
</style>
