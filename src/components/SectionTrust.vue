<script setup lang="ts">
const trustItems = [
  {
    title: 'Комплексный подход',
    text: 'Объединяем бухгалтерскую экспертизу и правовой анализ, чтобы учитывать не только отчётность, но и возможные последствия для собственников и руководителей.',
    icon: 'layers',
  },
  {
    title: 'Стратегическое мышление',
    text: 'Не ограничиваемся устранением симптомов. Формируем позицию и выстраиваем действия с учётом дальнейшего развития ситуации.',
    icon: 'target',
  },
  {
    title: 'Контроль рисков',
    text: 'Каждый этап работы сопровождается оценкой налоговых и правовых последствий.',
    icon: 'shield',
  },
  {
    title: 'Регламентированный процесс',
    text: 'Чёткий порядок взаимодействия, поэтапная реализация и прозрачная структура проекта.',
    icon: 'list',
  },
  {
    title: 'Конфиденциальность и этика',
    text: 'Информация о финансовом состоянии компании защищена и не выходит за рамки профессионального взаимодействия.',
    icon: 'eye-off',
  },
]

const highlights = [
  {
    title: 'Двухэтапный контроль качества',
    text: 'Бухгалтеры высшей категории проверяют работу, прежде чем отправить результат заказчику. Риск ошибки минимальный.',
  },
  {
    title: 'Технологии + экспертиза',
    text: 'Мы объединили технический прогресс в области ИИ с высокой компетенцией наших специалистов.',
  },
]
</script>

<template>
  <section id="trust" class="section section--dark trust">
    <div class="container">
      <span class="section-label" v-reveal>Преимущества</span>
      <h2 class="section-title" v-reveal>Почему нам доверяют сложные ситуации</h2>
      <p class="section-subtitle section-subtitle--light" v-reveal>
        Экстренные бухгалтерские вопросы требуют точности, системности
        и взвешенных решений. Мы работаем с кейсами, где цена ошибки особенно высока.
      </p>

      <div class="trust__grid">
        <div
          v-for="(item, i) in trustItems"
          :key="i"
          class="trust__card"
          v-reveal
        >
          <div class="trust__card-header">
            <div class="trust__card-icon">
              <svg v-if="item.icon === 'layers'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
            <svg v-if="item.icon === 'target'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
            <svg v-if="item.icon === 'shield'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
            <svg v-if="item.icon === 'list'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8Z"/><polyline points="16 3 16 8 21 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/><line x1="8" y1="9" x2="11" y2="9"/></svg>
            <svg v-if="item.icon === 'eye-off'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/><path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/></svg>
            </div>
            <h3 class="trust__card-title">{{ item.title }}</h3>
          </div>
          <p class="trust__card-text">{{ item.text }}</p>
        </div>
      </div>

      <div class="trust__highlights">
        <div
          v-for="(item, i) in highlights"
          :key="i"
          class="trust__highlight"
          v-reveal
        >
          <div class="trust__highlight-border" />
          <h3 class="trust__highlight-title">{{ item.title }}</h3>
          <p class="trust__highlight-text">{{ item.text }}</p>
        </div>
      </div>

      <p class="trust__tagline" v-reveal>
        Наши специалисты способны потушить любой пожар в вашей отчётности
      </p>
    </div>
  </section>
</template>

<style scoped>
.trust__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
  margin: 3rem 0;
}

.trust__card {
  padding: 2rem 1.5rem;
  background: var(--c-dark-card);
  border: 1px solid var(--c-dark-border);
  border-radius: var(--radius-md);
  transition: all var(--transition);
}

.trust__card:hover {
  border-color: var(--c-accent);
  transform: translateY(-2px);
}

.trust__card-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.75rem;
}

.trust__card-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  flex-shrink: 0;
  border-radius: var(--radius-sm);
  background: rgba(230, 57, 70, 0.12);
  color: var(--c-accent);
}

.trust__card-title {
  font-size: 1.0625rem;
  font-weight: 700;
  margin: 0;
  color: #fff;
}

.trust__card-text {
  font-size: 0.875rem;
  color: var(--c-text-muted);
  line-height: 1.6;
}

.trust__highlights {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.25rem;
  margin-bottom: 3rem;
}

.trust__highlight {
  padding: 1.75rem 1.5rem;
  background: rgba(230, 57, 70, 0.06);
  border-radius: var(--radius-md);
  position: relative;
  overflow: hidden;
}

.trust__highlight-border {
  position: absolute;
  top: 0;
  left: 0;
  width: 3px;
  height: 100%;
  background: var(--c-accent);
}

.trust__highlight-title {
  font-size: 1rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: #fff;
  padding-left: 0.75rem;
}

.trust__highlight-text {
  font-size: 0.875rem;
  color: var(--c-text-muted);
  line-height: 1.6;
  padding-left: 0.75rem;
}

.trust__tagline {
  font-size: 1.125rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.6);
  text-align: center;
  font-style: italic;
}

@media (max-width: 1024px) {
  .trust__grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .trust__grid {
    grid-template-columns: 1fr;
  }

  .trust__highlights {
    grid-template-columns: 1fr;
  }
}
</style>
