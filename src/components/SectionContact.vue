<script setup lang="ts">
import { reactive, ref, computed, nextTick } from 'vue'
import DocumentModals from './DocumentModals.vue'

const form = reactive({
  name: '',
  phone: '',
  message: '',
  needLawyer: false,
  needFinancist: false,
  agreeConsent: false,
  consentMarketing: false,
})

const docModalsRef = ref<InstanceType<typeof DocumentModals> | null>(null)

const isSubmitting = ref(false)
const isSubmitted = ref(false)
const submitError = ref('')
const phoneTouched = ref(false)

/** Нормализует цифры: 8 в начале → 7, иначе подставляем 7 в начало (российский номер). */
function normalizePhoneDigits(raw: string): string {
  let d = raw.replace(/\D/g, '')
  if (d.startsWith('8')) d = '7' + d.slice(1)
  else if (d.length > 0 && d[0] !== '7') d = '7' + d
  return d.slice(0, 11)
}

/** Из цифр собирает строку в формате +7 (XXX) XXX-XX-XX (ожидает начало с 7 или пусто). */
function formatPhoneMask(digits: string): string {
  if (digits.length === 0) return ''
  if (digits.length <= 1) return '+7'
  if (digits.length <= 4) return `+7 (${digits.slice(1)}`
  if (digits.length <= 7) return `+7 (${digits.slice(1, 4)}) ${digits.slice(4)}`
  return `+7 (${digits.slice(1, 4)}) ${digits.slice(4, 7)}-${digits.slice(7, 9)}-${digits.slice(9, 11)}`
}

function onPhoneInput(e: Event) {
  const el = e.target as HTMLInputElement
  const digits = normalizePhoneDigits(el.value || '')
  form.phone = formatPhoneMask(digits)
  const cursorAfter = digits.length
  nextTick(() => {
    const pos = positionAfterDigits(form.phone, cursorAfter)
    el.setSelectionRange(pos, pos)
  })
}

/** Позиция в строке после N цифр (для курсора) */
function positionAfterDigits(str: string, digitCount: number): number {
  let count = 0
  for (let i = 0; i < str.length; i++) {
    if (/\d/.test(str.charAt(i))) count++
    if (count >= digitCount) return i + 1
  }
  return str.length
}

/** Валидация российского номера: +7/8 и 10 цифр, или 10 цифр (с ведущей 7). */
function isRussianPhone(value: string): boolean {
  const digits = value.replace(/\D/g, '')
  if (digits.length === 11) return digits[0] === '7' || digits[0] === '8'
  if (digits.length === 10) return true
  return false
}

const phoneError = computed(() => {
  const v = form.phone.trim()
  if (!v) return 'Укажите номер телефона'
  if (!isRussianPhone(v)) return 'Введите корректный российский номер (+7 …)'
  return ''
})

const showPhoneError = computed(() => phoneTouched.value && phoneError.value)

const canSubmit = computed(() =>
  form.name.trim() &&
  form.phone.trim() &&
  !phoneError.value &&
  form.message.trim() &&
  form.agreeConsent
)

function openDoc(doc: 'policy' | 'consent') {
  docModalsRef.value?.open(doc)
}

function closeSuccess() {
  isSubmitted.value = false
}

const handleSubmit = async () => {
  if (!canSubmit.value) return
  submitError.value = ''
  isSubmitting.value = true
  try {
    const res = await fetch('/api/send.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        name: form.name.trim(),
        phone: form.phone.trim(),
        message: form.message.trim(),
        needLawyer: form.needLawyer,
        needFinancist: form.needFinancist,
        consentMarketing: form.consentMarketing,
      }),
    })
    const data = await res.json().catch(() => ({}))
    if (!res.ok) {
      const msg = data.detail
        ? `${data.error} ${data.detail}`
        : (data.error || `Ошибка ${res.status}`)
      throw new Error(msg)
    }
    isSubmitted.value = true
    form.name = ''
    form.phone = ''
    form.message = ''
    form.needLawyer = false
    form.needFinancist = false
    form.agreeConsent = false
    form.consentMarketing = false
  } catch (e) {
    submitError.value = e instanceof Error ? e.message : 'Не удалось отправить. Попробуйте позже.'
  } finally {
    isSubmitting.value = false
  }
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
              class="contact__form"
              @submit.prevent="handleSubmit"
            >
              <div class="form-field">
                <label class="form-label" for="name">Имя <span class="form-label__required">*</span></label>
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
                <label class="form-label" for="phone">Телефон <span class="form-label__required">*</span></label>
                <input
                  id="phone"
                  :value="form.phone"
                  type="tel"
                  inputmode="numeric"
                  autocomplete="tel"
                  maxlength="18"
                  class="form-input"
                  :class="{ 'form-input--error': showPhoneError }"
                  placeholder="+7 (___) ___-__-__"
                  required
                  :aria-invalid="Boolean(showPhoneError)"
                  :aria-describedby="showPhoneError ? 'phone-error' : undefined"
                  @input="onPhoneInput"
                  @blur="phoneTouched = true"
                >
                <span v-if="showPhoneError" id="phone-error" class="form-field__error">{{ phoneError }}</span>
              </div>

              <div class="form-field">
                <label class="form-label" for="message">Краткое описание ситуации <span class="form-label__required">*</span></label>
                <textarea
                  id="message"
                  v-model="form.message"
                  class="form-input form-textarea"
                  placeholder="Опишите вашу ситуацию..."
                  required
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

              <!-- Блок согласий — визуально отделён от остальных галочек -->
              <div class="form-consents">
                <label class="form-checkbox">
                  <input v-model="form.agreeConsent" type="checkbox" required>
                  <span>
                    Я даю
                    <button type="button" class="form-link" @click.prevent="openDoc('consent')">согласие</button>
                    на обработку персональных данных в связи с
                    <button type="button" class="form-link" @click.prevent="openDoc('policy')">политикой</button>
                  </span>
                </label>

                <label class="form-checkbox">
                  <input v-model="form.consentMarketing" type="checkbox">
                  <span>Согласие на рекламные рассылки (получение рекламы и т.д.)</span>
                </label>
              </div>

              <p v-if="submitError" class="form-field__error form-field__error--block">
                {{ submitError }}
              </p>

              <button
                type="submit"
                class="btn btn--primary btn--lg contact__submit"
                :disabled="isSubmitting || !canSubmit"
              >
                {{ isSubmitting ? 'Отправка...' : 'Получить план действий' }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <DocumentModals ref="docModalsRef" />

    <Teleport to="body">
      <Transition name="success-popup">
        <div
          v-if="isSubmitted"
          class="success-popup__backdrop"
          role="dialog"
          aria-modal="true"
          aria-labelledby="success-title"
          @click.self="closeSuccess"
        >
          <div class="success-popup__box">
            <div class="success-popup__icon">✓</div>
            <h3 id="success-title" class="success-popup__title">Заявка отправлена</h3>
            <p class="success-popup__text">
              Мы свяжемся с вами в течение 15 минут.
            </p>
            <button
              type="button"
              class="success-popup__btn"
              @click="closeSuccess"
            >
              Закрыть
            </button>
          </div>
        </div>
      </Transition>
    </Teleport>
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
  grid-template-columns: 1fr 1.1fr;
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
  padding: 1.8rem;
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

.form-label__required {
  color: var(--c-accent);
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

.form-input--error {
  border-color: var(--c-accent);
}

.form-field__error {
  font-size: 0.8125rem;
  color: var(--c-accent);
}

.form-field__error--block {
  margin: 0;
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

.form-consents {
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.form-link {
  padding: 0;
  border: none;
  background: none;
  font: inherit;
  color: var(--c-accent);
  text-decoration: underline;
  cursor: pointer;
  transition: color 0.2s;
}

.form-link:hover {
  color: #ff6b7a;
}

.contact__submit {
  width: 100%;
  margin-top: 0.5rem;
}

.contact__submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Всплывашка успешной отправки по центру */
.success-popup__backdrop {
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

.success-popup__box {
  text-align: center;
  padding: 2rem 2.5rem;
  background: #0b1120;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: var(--radius-lg);
  box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4);
  max-width: 360px;
}

.success-popup__icon {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: rgba(34, 197, 94, 0.2);
  color: #22c55e;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
  font-weight: 700;
  margin: 0 auto 1rem;
}

.success-popup__title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  margin: 0 0 0.5rem;
}

.success-popup__text {
  font-size: 0.9375rem;
  color: var(--c-text-muted);
  margin: 0 0 1.5rem;
  line-height: 1.5;
}

.success-popup__btn {
  padding: 0.625rem 1.5rem;
  background: var(--c-accent);
  color: #fff;
  border: none;
  border-radius: var(--radius-sm);
  font-size: 0.9375rem;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s;
}

.success-popup__btn:hover {
  opacity: 0.9;
}

.success-popup-enter-active,
.success-popup-leave-active {
  transition: opacity 0.25s ease;
}

.success-popup-enter-from,
.success-popup-leave-to {
  opacity: 0;
}

.success-popup-enter-active .success-popup__box,
.success-popup-leave-active .success-popup__box {
  transition: transform 0.25s ease;
}

.success-popup-enter-from .success-popup__box,
.success-popup-leave-to .success-popup__box {
  transform: scale(0.96);
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
