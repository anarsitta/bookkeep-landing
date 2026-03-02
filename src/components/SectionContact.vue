<script setup lang="ts">
import { reactive, ref } from 'vue'

const form = reactive({
  name: '',
  phone: '',
  message: '',
  needLawyer: false,
  needFinancist: false,
})

const isSubmitting = ref(false)
const isSubmitted = ref(false)

const handleSubmit = async () => {
  if (!form.name || !form.phone) return
  isSubmitting.value = true
  // TODO: подключить отправку формы
  await new Promise((resolve) => setTimeout(resolve, 1200))
  isSubmitting.value = false
  isSubmitted.value = true
}
</script>

<template>
  <section id="contact" class="contact video-bg">
    <video class="video-bg__video" autoplay muted loop playsinline>
      <!-- <source src="/videos/contact-bg.mp4" type="video/mp4"> -->
    </video>
    <div class="video-bg__overlay contact__overlay" />

    <div class="video-bg__content section">
      <div class="container">
        <div class="contact__grid">
          <div class="contact__info">
            <span class="section-label" v-reveal>Заявка</span>
            <h2 class="contact__title" v-reveal>
              Каждый день просрочки<br>увеличивает риски
            </h2>
            <p class="contact__subtitle" v-reveal>
              Получите план действий уже сегодня.
              Первичная консультация — бесплатно.
            </p>

            <div class="contact__features" v-reveal>
              <div class="contact__feature">
                <span class="contact__feature-dot" />
                Ответ в течение 15 минут
              </div>
              <div class="contact__feature">
                <span class="contact__feature-dot" />
                Полная конфиденциальность
              </div>
              <div class="contact__feature">
                <span class="contact__feature-dot" />
                Работа по договору
              </div>
            </div>
          </div>

          <div class="contact__form-wrap" v-reveal>
            <form
              v-if="!isSubmitted"
              class="contact__form"
              @submit.prevent="handleSubmit"
            >
              <div class="form-field">
                <label class="form-label" for="name">Имя</label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="form-input"
                  placeholder="Ваше имя"
                  required
                >
              </div>

              <div class="form-field">
                <label class="form-label" for="phone">Телефон</label>
                <input
                  id="phone"
                  v-model="form.phone"
                  type="tel"
                  class="form-input"
                  placeholder="+7 (___) ___-__-__"
                  required
                >
              </div>

              <div class="form-field">
                <label class="form-label" for="message">Краткое описание ситуации</label>
                <textarea
                  id="message"
                  v-model="form.message"
                  class="form-input form-textarea"
                  placeholder="Опишите вашу ситуацию..."
                />
              </div>

              <div class="form-checkboxes">
                <label class="form-checkbox">
                  <input v-model="form.needLawyer" type="checkbox">
                  <span>Нужна консультация юриста</span>
                </label>
                <label class="form-checkbox">
                  <input v-model="form.needFinancist" type="checkbox">
                  <span>Нужна консультация финансиста</span>
                </label>
              </div>

              <button
                type="submit"
                class="btn btn--primary btn--lg contact__submit"
                :disabled="isSubmitting"
              >
                {{ isSubmitting ? 'Отправка...' : 'Получить план действий' }}
              </button>
            </form>

            <div v-else class="contact__success">
              <div class="contact__success-icon">✓</div>
              <h3 class="contact__success-title">Заявка отправлена</h3>
              <p class="contact__success-text">
                Мы свяжемся с вами в течение 15 минут.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact__overlay {
  background: linear-gradient(
    to bottom right,
    rgba(11, 17, 32, 0.95),
    rgba(11, 17, 32, 0.88)
  );
}

.contact__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
}

.contact__title {
  font-size: clamp(1.75rem, 4vw, 2.5rem);
  font-weight: 800;
  line-height: 1.2;
  color: #fff;
  margin-bottom: 1rem;
}

.contact__subtitle {
  font-size: 1.125rem;
  color: var(--c-text-muted);
  line-height: 1.7;
  margin-bottom: 2.5rem;
}

.contact__features {
  display: flex;
  flex-direction: column;
  gap: 0.875rem;
}

.contact__feature {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 0.9375rem;
  color: rgba(255, 255, 255, 0.75);
}

.contact__feature-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--c-accent);
  flex-shrink: 0;
}

.contact__form-wrap {
  padding: 2.5rem;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: var(--radius-lg);
  backdrop-filter: blur(8px);
}

.contact__form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-field {
  display: flex;
  flex-direction: column;
  gap: 0.375rem;
}

.form-label {
  font-size: 0.8125rem;
  font-weight: 500;
  color: var(--c-text-muted);
}

.form-input {
  padding: 0.8125rem 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: var(--radius-sm);
  color: #fff;
  font-size: 0.9375rem;
  transition: border-color var(--transition);
}

.form-input:focus {
  outline: none;
  border-color: var(--c-accent);
}

.form-input::placeholder {
  color: rgba(255, 255, 255, 0.25);
}

.form-textarea {
  min-height: 100px;
  resize: vertical;
}

.form-checkboxes {
  display: flex;
  flex-direction: column;
  gap: 0.625rem;
}

.form-checkbox {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  cursor: pointer;
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.7);
}

.form-checkbox input {
  width: 18px;
  height: 18px;
  accent-color: var(--c-accent);
  cursor: pointer;
}

.contact__submit {
  width: 100%;
  margin-top: 0.5rem;
}

.contact__submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.contact__success {
  text-align: center;
  padding: 2rem 0;
}

.contact__success-icon {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: #22c55e;
  color: #fff;
  font-size: 1.5rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.25rem;
}

.contact__success-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 0.5rem;
}

.contact__success-text {
  font-size: 0.9375rem;
  color: var(--c-text-muted);
}

@media (max-width: 768px) {
  .contact__grid {
    grid-template-columns: 1fr;
    gap: 2.5rem;
  }

  .contact__form-wrap {
    padding: 1.5rem;
  }
}
</style>
