<script setup lang="ts">
const steps = [
  { num: '01', title: 'Первичный звонок', desc: 'Бесплатная консультация — 15 минут' },
  { num: '02', title: 'Подписание NDA', desc: 'Гарантия полной конфиденциальности' },
  { num: '03', title: 'Диагностика', desc: 'Платный анализ текущей ситуации' },
  { num: '04', title: 'План и смета', desc: 'Чёткий план действий с фиксацией стоимости' },
  { num: '05', title: 'Реализация', desc: 'Выполнение работ в согласованные сроки' },
  { num: '06', title: 'Отчёт', desc: 'Детальный отчёт о выполненной работе' },
]
</script>

<template>
  <section id="process" class="section section--alt process">
    <div class="container">
      <div class="process__head" v-reveal>
        <span class="section-label">Процесс</span>
        <h2 class="section-title">Как мы работаем</h2>
      </div>

      <div class="process__grid">
        <div
          v-for="(step, i) in steps"
          :key="i"
          class="process__card"
          v-reveal
        >
          <div class="process__card-header">
            <span class="process__num">{{ step.num }}</span>
            <span class="process__connector" />
          </div>
          <h3 class="process__title">{{ step.title }}</h3>
          <p class="process__desc">{{ step.desc }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.process__head {
  margin-bottom: 3rem;
}

.process__grid {
  position: relative;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
}

.process__card {
  position: relative;
  padding: 2rem 1.5rem 1.75rem;
  background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
  border: 1px solid var(--c-border);
  border-radius: var(--radius-md);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
  transition: all var(--transition);
}

.process__card:hover {
  border-color: rgba(230, 57, 70, 0.35);
  box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08), 0 2px 8px rgba(230, 57, 70, 0.06);
  transform: translateY(-2px);
}

.process__card-header {
  display: flex;
  align-items: center;
  margin-bottom: 1.25rem;
}

.process__num {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--c-dark);
  color: #fff;
  font-size: 0.8125rem;
  font-weight: 700;
  flex-shrink: 0;
  transition: background var(--transition);
}

.process__card:hover .process__num {
  background: var(--c-accent);
}

.process__connector {
  flex: 1;
  min-width: 0.5rem;
  height: 2px;
  background: linear-gradient(90deg, var(--c-border) 0%, rgba(226, 232, 240, 0.6) 100%);
  margin-left: 0.75rem;
  border-radius: 1px;
}

.process__title {
  font-size: 1.0625rem;
  font-weight: 700;
  margin-bottom: 0.375rem;
  line-height: 1.3;
  color: var(--c-text);
}

.process__desc {
  font-size: 0.875rem;
  color: var(--c-text-secondary);
  line-height: 1.55;
}

@media (max-width: 1024px) {
  .process__grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .process__grid {
    grid-template-columns: 1fr;
  }

  .process__connector {
    display: none;
  }
}
</style>
