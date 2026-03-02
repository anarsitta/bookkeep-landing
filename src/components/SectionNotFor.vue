<script setup lang="ts">
const items = [
  'Если вы ищете самый дешёвый вариант',
  'Если вы хотите скрыть незаконные операции',
  'Если вы не готовы предоставлять документы',
]
</script>

<template>
  <section class="section notfor">
    <div class="container">
      <div class="notfor__inner" v-reveal>
        <span class="section-label">Важно</span>
        <h2 class="section-title">Кому мы не подходим</h2>

        <div class="notfor__list">
          <div
            v-for="(item, i) in items"
            :key="i"
            class="notfor__item"
          >
            <span class="notfor__cross">×</span>
            <span class="notfor__text">{{ item }}</span>
          </div>
        </div>

        <p class="notfor__note">
          Мы работаем только с клиентами, которые готовы к прозрачному
          и профессиональному взаимодействию.
        </p>
      </div>
    </div>
  </section>
</template>

<style scoped>
.notfor__inner {
  max-width: 680px;
  margin: 0 auto;
  text-align: center;
}

.notfor__list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin: 2.5rem 0;
}

.notfor__item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1.25rem 1.5rem;
  background: var(--c-light-alt);
  border: 1px solid var(--c-border);
  border-radius: var(--radius-md);
  text-align: left;
  transition: all var(--transition);
}

.notfor__item:hover {
  border-color: var(--c-accent);
}

.notfor__cross {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: rgba(230, 57, 70, 0.08);
  color: var(--c-accent);
  font-size: 1.25rem;
  font-weight: 700;
  flex-shrink: 0;
}

.notfor__text {
  font-size: 1rem;
  font-weight: 500;
  color: var(--c-text);
}

.notfor__note {
  font-size: 0.9375rem;
  color: var(--c-text-secondary);
  line-height: 1.6;
}
</style>
