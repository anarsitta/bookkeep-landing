<script setup lang="ts">
import { ref, onMounted, onUnmounted, watch } from 'vue'

const isScrolled = ref(false)
const isMobileMenuOpen = ref(false)

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

const toggleMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const closeMenu = () => {
  isMobileMenuOpen.value = false
}

watch(isMobileMenuOpen, (open) => {
  document.body.style.overflow = open ? 'hidden' : ''
})

onMounted(() => window.addEventListener('scroll', handleScroll, { passive: true }))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))
</script>

<template>
  <header class="header" :class="{ 'header--scrolled': isScrolled }">
    <div class="header__inner container">
      <a href="#" class="header__logo">
        Экстренная бухгалтерия
      </a>

      <nav class="header__nav" :class="{ 'header__nav--open': isMobileMenuOpen }">
        <a href="#problems" class="header__link" @click="closeMenu">Когда обращаются</a>
        <a href="#process" class="header__link" @click="closeMenu">Как работаем</a>
        <a href="#trust" class="header__link" @click="closeMenu">Почему мы</a>
        <a href="#cases" class="header__link" @click="closeMenu">Кейсы</a>
        <a href="#contact" class="btn btn--primary header__cta" @click="closeMenu">Связаться</a>
      </nav>

      <button
        class="header__burger"
        :class="{ 'header__burger--active': isMobileMenuOpen }"
        @click="toggleMenu"
        aria-label="Меню"
      >
        <span /><span /><span />
      </button>
    </div>
  </header>

  <Transition name="fade">
    <div v-if="isMobileMenuOpen" class="header__backdrop" @click="closeMenu" />
  </Transition>
</template>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  padding: 1rem 1.5rem;
  transition: all 0.35s ease;
}

.header--scrolled {
  background: rgba(11, 17, 32, 0.96);
  backdrop-filter: blur(16px);
  padding: 0.6rem 1.5rem;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.06);
}

.header__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.header__logo {
  font-size: 1rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.01em;
}

.header__nav {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.header__link {
  font-size: 0.875rem;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.65);
  transition: color var(--transition);
}

.header__link:hover {
  color: #fff;
}

.header__cta {
  padding: 0.5rem 1.25rem;
  font-size: 0.8125rem;
}

.header__burger {
  display: none;
  flex-direction: column;
  justify-content: center;
  gap: 5px;
  width: 32px;
  height: 32px;
  padding: 0;
}

.header__burger span {
  display: block;
  width: 22px;
  height: 2px;
  background: #fff;
  border-radius: 2px;
  transition: all 0.3s ease;
  transform-origin: center;
}

.header__burger--active span:nth-child(1) {
  transform: rotate(45deg) translate(5px, 5px);
}

.header__burger--active span:nth-child(2) {
  opacity: 0;
}

.header__burger--active span:nth-child(3) {
  transform: rotate(-45deg) translate(5px, -5px);
}

.header__backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 90;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .header__burger {
    display: flex;
  }

  .header__nav {
    position: fixed;
    top: 0;
    right: 0;
    width: 280px;
    height: 100dvh;
    flex-direction: column;
    align-items: flex-start;
    background: var(--c-dark);
    padding: 5rem 2rem 2rem;
    gap: 1.5rem;
    transform: translateX(100%);
    transition: transform 0.35s ease;
    z-index: 95;
    border-left: 1px solid var(--c-dark-border);
  }

  .header__nav--open {
    transform: translateX(0);
  }

  .header__link {
    font-size: 1rem;
  }

  .header__cta {
    margin-top: 1rem;
    width: 100%;
    text-align: center;
  }
}
</style>
