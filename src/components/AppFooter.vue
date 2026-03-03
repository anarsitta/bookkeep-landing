<script setup lang="ts">
const currentYear = new Date().getFullYear()
</script>

<template>
  <footer class="footer">
    <div class="container">
      <div class="footer__top">
        <div class="footer__brand">
          <div class="footer__logo">Экстренная бухгалтерия</div>
          <p class="footer__tagline">
            Оперативно закрываем вопросы клиента,
            сохраняя максимальное качество.
          </p>
        </div>

        <div class="footer__nav">
          <h4 class="footer__heading">Навигация</h4>
          <a href="#problems" class="footer__link">Когда обращаются</a>
          <a href="#process" class="footer__link">Как работаем</a>
          <a href="#trust" class="footer__link">Почему мы</a>
          <a href="#cases" class="footer__link">Кейсы</a>
          <a href="#contact" class="footer__link">Заявка</a>
        </div>

        <div class="footer__contacts">
          <h4 class="footer__heading">Связаться</h4>
          <a href="tel:+70000000000" class="footer__link">+7 (000) 000-00-00</a>
          <a href="mailto:info@example.com" class="footer__link">info@example.com</a>
          <div class="footer__socials">
            <a href="#" class="footer__social" title="VK" target="_blank" rel="noopener">
              <img src="/vk_icon.svg" alt="VK" class="footer__social-icon" width="20" height="20" />
            </a>
            <a href="#" class="footer__social" title="MAX" target="_blank" rel="noopener">
              <img src="/max_icon.svg" alt="MAX" class="footer__social-icon" width="20" height="20" />
            </a>
          </div>
        </div>
      </div>

      <div class="footer__bottom">
        <div class="footer__legal">
          <p>&copy; {{ currentYear }} ООО «Автопрофи». Все права защищены.</p>
          <p class="footer__requisites">
            ИНН 0000000000 &middot; ОГРН 0000000000000 &middot;
            Юридический адрес: г. Москва, ул. Примерная, д. 1
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: #070d18;
  color: var(--c-text-muted);
  padding: 4rem var(--section-px) 2rem;
}

.footer__top {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr;
  gap: 3rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid var(--c-dark-border);
}

.footer__logo {
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 1rem;
}

.footer__tagline {
  font-size: 0.875rem;
  line-height: 1.6;
  max-width: 320px;
}

.footer__heading {
  font-size: 0.8125rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: rgba(255, 255, 255, 0.5);
  margin-bottom: 1rem;
}

.footer__link {
  display: block;
  font-size: 0.875rem;
  color: var(--c-text-muted);
  padding: 0.25rem 0;
  transition: color var(--transition);
}

.footer__link:hover {
  color: #fff;
}

.footer__socials {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

.footer__social {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: var(--radius-sm);
  background: var(--c-dark-card);
  border: 1px solid var(--c-dark-border);
  color: var(--c-text-muted);
  transition: all var(--transition);
}

.footer__social-icon {
  display: block;
  width: 20px;
  height: 20px;
  object-fit: contain;
  opacity: 0.85;
  transition: opacity var(--transition);
}

.footer__social:hover {
  border-color: var(--c-accent);
  background: rgba(230, 57, 70, 0.12);
}

.footer__social:hover .footer__social-icon {
  opacity: 1;
}

.footer__bottom {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  padding-top: 2rem;
  gap: 1rem;
}

.footer__legal p {
  font-size: 0.8125rem;
  line-height: 1.5;
}

.footer__requisites {
  margin-top: 0.25rem;
  font-size: 0.75rem !important;
  opacity: 0.6;
}

@media (max-width: 768px) {
  .footer__top {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .footer__bottom {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
