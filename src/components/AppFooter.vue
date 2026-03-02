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
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M21.579 6.855c.14-.465 0-.806-.662-.806h-2.193c-.558 0-.813.295-.953.619 0 0-1.115 2.719-2.695 4.482-.51.51-.743.673-.982.673-.14 0-.341-.163-.341-.628V6.855c0-.558-.161-.806-.626-.806H9.642c-.348 0-.558.259-.558.504 0 .528.79.65.871 2.138v3.228c0 .707-.128.836-.407.836-.743 0-2.551-2.729-3.624-5.853-.21-.607-.42-.852-.98-.852H2.75c-.627 0-.75.295-.75.619 0 .58.743 3.462 3.461 7.271 1.812 2.601 4.363 4.011 6.687 4.011 1.393 0 1.565-.313 1.565-.852v-1.966c0-.627.132-.752.574-.752.325 0 .882.163 2.183 1.417 1.486 1.486 1.732 2.153 2.568 2.153h2.193c.627 0 .94-.313.76-.931-.198-.616-.907-1.51-1.849-2.569-.51-.603-1.277-1.253-1.51-1.579-.326-.418-.233-.603 0-.975 0 0 2.672-3.761 2.95-5.04Z"/></svg>
            </a>
            <a href="#" class="footer__social" title="MAX" target="_blank" rel="noopener">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2Zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.2-.02-.09.02-1.49.95-4.22 2.79-.4.27-.76.41-1.08.4-.36-.01-1.04-.2-1.55-.37-.63-.2-1.12-.31-1.08-.66.02-.18.27-.37.74-.55 2.92-1.27 4.86-2.11 5.83-2.51 2.78-1.16 3.35-1.36 3.73-1.36.08 0 .27.02.39.12.1.08.13.19.14.27-.01.06.01.24 0 .38Z"/></svg>
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
        <a href="#" class="footer__privacy">Политика конфиденциальности</a>
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
  font-size: 0.6875rem;
  font-weight: 700;
  color: var(--c-text-muted);
  transition: all var(--transition);
}

.footer__social:hover {
  border-color: var(--c-accent);
  color: #fff;
  background: rgba(230, 57, 70, 0.12);
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

.footer__privacy {
  font-size: 0.8125rem;
  color: var(--c-text-muted);
  transition: color var(--transition);
  white-space: nowrap;
}

.footer__privacy:hover {
  color: #fff;
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
