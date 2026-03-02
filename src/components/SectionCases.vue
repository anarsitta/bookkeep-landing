<script setup lang="ts">
import { ref } from 'vue'

const carouselRef = ref<HTMLElement | null>(null)

const scroll = (direction: 'left' | 'right') => {
  if (!carouselRef.value) return
  const card = carouselRef.value.querySelector('.cases__card') as HTMLElement
  if (!card) return
  const gap = parseFloat(getComputedStyle(carouselRef.value).gap) || 0
  const amount = card.offsetWidth + gap
  carouselRef.value.scrollBy({
    left: direction === 'left' ? -amount : amount,
    behavior: 'smooth',
  })
}

const cases = [
  {
    industry: 'IT',
    problem: 'Сложность учёта множества проектов, ручные процессы, риски в налоговой отчётности.',
    results: [
      { value: '–40%', label: 'времени на бухгалтерию' },
      { value: '0', label: 'ошибок в декларациях' },
      { value: '+25%', label: 'рост продаж за год' },
    ],
    quote: 'Сотрудничество с бухгалтерской компанией стало для нас настоящим открытием. Мы смогли не только оптимизировать процессы, но и сосредоточиться на том, что действительно важно — развитии наших проектов.',
  },
  {
    industry: 'Коммерческая недвижимость',
    problem: 'Разрозненные учётные системы, сложность учёта множества объектов, налоговые риски.',
    results: [
      { value: '–50%', label: 'времени на бухгалтерию' },
      { value: '0', label: 'ошибок в отчётности' },
      { value: '100%', label: 'прозрачность финансов' },
    ],
    quote: 'Мы получили не только качественный учёт, но и уверенность в том, что все налоговые обязательства выполняются вовремя.',
  },
  {
    industry: 'Производство',
    problem: 'Неактуальная отчётность, уход ключевых сотрудников, необходимость восстановления данных за прошлые периоды.',
    results: [
      { value: '100%', label: 'отчётность восстановлена' },
      { value: '0', label: 'штрафов и санкций' },
      { value: '↑', label: 'репутация налогоплательщика' },
    ],
    quote: 'Сотрудничество с вашей компанией стало для нас спасением в сложной ситуации. Благодаря вашему профессионализму мы смогли восстановить отчётность и избежать серьёзных последствий.',
  },
]
</script>

<template>
  <section id="cases" class="section section--alt cases">
    <div class="container">
      <span class="section-label" v-reveal>Кейсы</span>
      <h2 class="section-title" v-reveal>Реальные результаты</h2>

      <div class="cases__slider" v-reveal>
        <button class="cases__arrow cases__arrow--prev" @click="scroll('left')" aria-label="Назад">
          <span />
        </button>

        <div ref="carouselRef" class="cases__carousel">
          <div
            v-for="(item, i) in cases"
            :key="i"
            class="cases__card"
          >
            <div class="cases__card-head">
              <span class="cases__tag">{{ item.industry }}</span>
            </div>

            <p class="cases__problem">{{ item.problem }}</p>

            <div class="cases__results">
              <div
                v-for="(r, j) in item.results"
                :key="j"
                class="cases__result"
              >
                <span class="cases__result-value">{{ r.value }}</span>
                <span class="cases__result-label">{{ r.label }}</span>
              </div>
            </div>

            <blockquote class="cases__quote">
              «{{ item.quote }}»
            </blockquote>

            <div class="cases__author">
              <span class="cases__author-name">Клиент компании</span>
            </div>
          </div>
        </div>

        <button class="cases__arrow cases__arrow--next" @click="scroll('right')" aria-label="Вперёд">
          <span />
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped>
.cases__slider {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-top: 2.5rem;
}

.cases__arrow {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border: 1.5px solid var(--c-border);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all var(--transition);
  flex-shrink: 0;
  background: var(--c-light);
}

.cases__arrow:hover {
  border-color: var(--c-accent);
  background: rgba(230, 57, 70, 0.06);
}

.cases__arrow span {
  display: block;
  width: 9px;
  height: 9px;
  border-right: 2px solid var(--c-text);
  border-bottom: 2px solid var(--c-text);
}

.cases__arrow--prev span {
  transform: rotate(135deg);
  margin-left: 3px;
}

.cases__arrow--next span {
  transform: rotate(-45deg);
  margin-right: 3px;
}

.cases__carousel {
  display: flex;
  gap: 1.25rem;
  overflow: hidden;
  flex: 1;
  min-width: 0;
}

.cases__card {
  flex: 0 0 calc((100% - 2 * 1.25rem) / 3);
  padding: 1.75rem 1.5rem;
  background: var(--c-light);
  border: 1px solid var(--c-border);
  border-radius: var(--radius-md);
  display: flex;
  flex-direction: column;
  transition: all var(--transition);
}

.cases__card:hover {
  border-color: var(--c-accent);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
}

.cases__card-head {
  margin-bottom: 1rem;
}

.cases__tag {
  display: inline-block;
  font-size: 0.6875rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--c-accent);
  background: rgba(230, 57, 70, 0.08);
  padding: 0.25rem 0.625rem;
  border-radius: 4px;
}

.cases__problem {
  font-size: 0.8125rem;
  color: var(--c-text-secondary);
  line-height: 1.55;
  margin-bottom: 1.25rem;
}

.cases__results {
  display: flex;
  gap: 1rem;
  padding: 1rem 0;
  border-top: 1px solid var(--c-border);
  border-bottom: 1px solid var(--c-border);
  margin-bottom: 1.25rem;
}

.cases__result {
  flex: 1;
  text-align: center;
}

.cases__result-value {
  display: block;
  font-size: 1.25rem;
  font-weight: 800;
  color: var(--c-accent);
  line-height: 1.2;
  margin-bottom: 0.25rem;
}

.cases__result-label {
  display: block;
  font-size: 0.6875rem;
  color: var(--c-text-secondary);
  line-height: 1.35;
}

.cases__quote {
  font-size: 0.8125rem;
  line-height: 1.6;
  color: var(--c-text);
  font-style: italic;
  flex: 1;
  margin-bottom: 1rem;
}

.cases__author {
  display: flex;
  flex-direction: column;
}

.cases__author-name {
  font-size: 0.8125rem;
  font-weight: 600;
  color: var(--c-text);
  line-height: 1.3;
}


@media (max-width: 1024px) {
  .cases__card {
    flex: 0 0 calc((100% - 1.25rem) / 2);
  }
}

@media (max-width: 768px) {
  .cases__arrow {
    display: none;
  }

  .cases__carousel {
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
  }

  .cases__carousel::-webkit-scrollbar {
    display: none;
  }

  .cases__card {
    flex: 0 0 85vw;
    scroll-snap-align: start;
  }
}
</style>
