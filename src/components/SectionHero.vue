<script setup lang="ts">
import heroVideo from '@/assets/video1.webm'

const steps = [
  'Анализ ситуации',
  'Чёткий план действий',
  'Работа с банком и ФНС',
  'Решение проблемы',
]
</script>

<template>
  <section class="hero video-bg">
    <video class="video-bg__video" autoplay muted loop playsinline>
      <source :src="heroVideo" type="video/webm">
    </video>
    <div class="video-bg__overlay hero__overlay" />

    <div class="video-bg__content">
      <div class="hero__inner container">
        <h1 class="hero__title" v-reveal>
          Экстренная бухгалтерия<br>
          <span class="hero__title-accent">для бизнеса в кризисе</span>
        </h1>

        <p class="hero__questions" v-reveal>
          Счёт заблокирован? ФНС требует документы? Отчётность не сдавалась?
          В 2025&nbsp;году вы перешли порог НДС?
        </p>

        <p class="hero__text" v-reveal>
          Каждый день промедления увеличивает штрафы и&nbsp;риски.
          Мы&nbsp;подключаемся немедленно: разблокируем счета, восстанавливаем учёт
          и&nbsp;выстраиваем план защиты от&nbsp;доначислений.
        </p>

        <div class="hero__pipeline" v-reveal>
          <div
            v-for="(step, i) in steps"
            :key="i"
            class="hero__pipe-item"
          >
            <div class="hero__pipe-top">
              <span class="hero__pipe-num">{{ i + 1 }}</span>
              <span v-if="i < steps.length - 1" class="hero__pipe-line" />
            </div>
            <span class="hero__pipe-label">{{ step }}</span>
          </div>
        </div>

        <div class="hero__response" v-reveal>
          <span class="hero__response-pulse" />
          <span class="hero__response-text">
            Первичная реакция — в&nbsp;течение <strong>15&nbsp;минут</strong>.
            Конфиденциально. По&nbsp;договору. С&nbsp;фиксацией ответственности.
          </span>
        </div>

        <div class="hero__actions" v-reveal>
          <a href="#contact" class="btn btn--primary btn--lg">
            Срочная консультация
          </a>
          <a href="#contact" class="btn btn--outline btn--lg">
            Связаться сейчас
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.hero {
  min-height: 100dvh;
  display: flex;
  align-items: center;
}

/* Видео чуть «отдалено», чтобы было видно больше кадра */
.hero :deep(.video-bg__video) {
  transform: translate(-50%, -50%) scale(0.8);
}

.hero__overlay {
  background: linear-gradient(
    145deg,
    rgba(11, 17, 32, 0.96) 0%,
    rgba(11, 17, 32, 0.88) 50%,
    rgba(11, 17, 32, 0.80) 100%
  );
}

.hero__inner {
  padding: 7rem var(--section-px) 4rem;
}

.hero__title {
  font-size: clamp(2rem, 5vw, 3.25rem);
  font-weight: 800;
  line-height: 1.15;
  color: #fff;
  margin-bottom: 1.75rem;
}

.hero__title-accent {
  color: var(--c-accent);
}

.hero__questions {
  font-size: clamp(1.0625rem, 2.5vw, 1.25rem);
  font-weight: 500;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 1rem;
  line-height: 1.6;
  max-width: 700px;
}

.hero__text {
  font-size: 1rem;
  color: var(--c-text-muted);
  line-height: 1.75;
  margin-bottom: 2.5rem;
  max-width: 700px;
}

/* Pipeline steps */
.hero__pipeline {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  margin-bottom: 2.5rem;
}

.hero__pipe-item {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.hero__pipe-top {
  display: flex;
  align-items: center;
}

.hero__pipe-num {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--c-accent);
  color: #fff;
  font-size: 0.8125rem;
  font-weight: 700;
  flex-shrink: 0;
}

.hero__pipe-line {
  flex: 1;
  height: 1px;
  background: linear-gradient(to right, var(--c-accent), rgba(139, 157, 195, 0.3));
  margin: 0 0.25rem;
}

.hero__pipe-label {
  font-size: 0.8125rem;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.7);
  line-height: 1.35;
  padding-right: 1rem;
}

/* Response badge */
.hero__response {
  display: flex;
  align-items: center;
  gap: 0.875rem;
  margin-bottom: 2.5rem;
  padding: 1rem 1.5rem;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: var(--radius-md);
  text-align: left;
}

.hero__response-pulse {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: var(--c-accent);
  flex-shrink: 0;
  animation: pulse 2s ease-in-out infinite;
}

.hero__response-text {
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.75);
  line-height: 1.55;
}

.hero__response-text strong {
  color: #fff;
  font-weight: 700;
}

@keyframes pulse {
  0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(230, 57, 70, 0.5); }
  50% { opacity: 0.8; box-shadow: 0 0 0 8px rgba(230, 57, 70, 0); }
}

.hero__actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}

@media (max-width: 768px) {
  .hero__inner {
    padding: 6rem var(--section-px) 3rem;
  }

  .hero__pipeline {
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem 0;
  }

  .hero__pipe-line {
    display: none;
  }

  .hero__actions {
    flex-direction: column;
  }

  .hero__actions .btn {
    width: 100%;
  }
}

@media (max-width: 480px) {
  .hero__pipeline {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .hero__pipe-item {
    flex-direction: row;
    align-items: center;
    gap: 0.75rem;
  }

  .hero__pipe-top {
    flex-shrink: 0;
  }
}
</style>
