<script setup lang="ts">
</script>

<template>
  <section class="consult">
    <div class="container">
      <div class="consult__inner" v-reveal>
        <div class="consult__text">
          <h3 class="consult__title">Нужна консультация юриста или финансиста?</h3>
          <p class="consult__desc">
            Наши специалисты взаимодействуют между собой и формируют
            полную картину возникшей проблемы. Отметьте это в форме заявки.
          </p>
        </div>
        <a href="#contact" class="btn btn--primary">Оставить заявку</a>
      </div>
    </div>
  </section>
</template>

<style scoped>
.consult {
  padding: 0 var(--section-px);
}

.consult__inner {
  max-width: var(--container-w);
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
  padding: 2.5rem 2.5rem;
  background: var(--c-dark);
  border-radius: var(--radius-lg);
  transform: translateY(-2rem);
}

.consult__title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 0.375rem;
}

.consult__desc {
  font-size: 0.9375rem;
  color: var(--c-text-muted);
  line-height: 1.6;
  max-width: 540px;
}

@media (max-width: 768px) {
  .consult__inner {
    flex-direction: column;
    text-align: center;
    padding: 2rem 1.5rem;
  }

  .consult__desc {
    max-width: 100%;
  }
}
</style>
