<script setup lang="ts">
const stats = [
  { value: '24/7', label: 'Работаем без выходных, 364 дня в году' },
  { value: '50+', label: 'Квалифицированных специалистов по всей стране' },
  { value: '15 мин', label: 'Первичная реакция на обращение' },
  { value: '2 этапа', label: 'Контроль качества каждой работы' },
]
</script>

<template>
  <section class="section section--dark stats">
    <div class="container">
      <div class="stats__grid">
        <div
          v-for="(stat, i) in stats"
          :key="i"
          class="stats__item"
          v-reveal
        >
          <span class="stats__value">{{ stat.value }}</span>
          <span class="stats__label">{{ stat.label }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.stats {
  padding-top: 4rem;
  padding-bottom: 4rem;
}

.stats__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}

.stats__item {
  text-align: center;
  padding: 1rem;
}

.stats__value {
  display: block;
  font-size: clamp(1.75rem, 3.5vw, 2.5rem);
  font-weight: 800;
  color: var(--c-accent);
  margin-bottom: 0.5rem;
}

.stats__label {
  display: block;
  font-size: 0.875rem;
  color: var(--c-text-muted);
  line-height: 1.5;
}

@media (max-width: 768px) {
  .stats__grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }
}

@media (max-width: 480px) {
  .stats__grid {
    grid-template-columns: 1fr;
  }
}
</style>
