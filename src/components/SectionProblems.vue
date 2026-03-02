<script setup lang="ts">
const problems = [
  {
    title: 'Блокировка счёта',
    text: 'Счёт заблокирован банком, и бизнес не может проводить платежи',
    icon: 'lock',
  },
  {
    title: 'Запрос от ФНС',
    text: 'ФНС запросила документы или назначила проверку',
    icon: 'search',
  },
  {
    title: 'Пропущенная отчётность',
    text: 'Пропущена сдача отчётности за прошлые периоды',
    icon: 'calendar',
  },
  {
    title: 'Ошибки бухгалтера',
    text: 'Ошибки предыдущего бухгалтера или кадровые недочёты',
    icon: 'alert',
  },
  {
    title: 'Утеря документов',
    text: 'Утеря бухгалтерских документов или некорректное ведение учёта',
    icon: 'folder',
  },
  {
    title: 'Штрафы и доначисления',
    text: 'Высокие штрафы, пени и налоговые доначисления',
    icon: 'money',
  },
  {
    title: 'Неясная финансовая ситуация',
    text: 'Невозможность подготовить отчётность для банка или инвестора',
    icon: 'chart',
  },
  {
    title: 'Порог НДС',
    text: 'Вы перешли порог НДС и никогда с этим не сталкивались',
    icon: 'trending',
  },
]
</script>

<template>
  <section id="problems" class="section problems">
    <div class="container">
      <div class="problems__head" v-reveal>
        <span class="section-label">Ситуации</span>
        <h2 class="section-title">Когда к нам обращаются</h2>
        <p class="section-subtitle section-subtitle--light">
          Ваш бизнес может столкнуться с&nbsp;экстренными ситуациями, когда промедление
          грозит штрафами, блокировкой счетов или потерей контроля над&nbsp;финансами.
        </p>
      </div>

      <div class="problems__grid">
        <div
          v-for="(item, i) in problems"
          :key="i"
          class="problems__card"
          v-reveal
        >
          <span class="problems__icon">
            <svg v-if="item.icon === 'lock'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <svg v-if="item.icon === 'search'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><circle cx="11.5" cy="14.5" r="2.5"/><path d="M13.3 16.3 15 18"/></svg>
            <svg v-if="item.icon === 'calendar'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/><path d="m9 16 2 2 4-4"/></svg>
            <svg v-if="item.icon === 'alert'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <svg v-if="item.icon === 'folder'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/><circle cx="12" cy="13" r="1"/></svg>
            <svg v-if="item.icon === 'money'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            <svg v-if="item.icon === 'chart'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>
            <svg v-if="item.icon === 'trending'" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          </span>
          <div>
            <h3 class="problems__card-title">{{ item.title }}</h3>
            <p class="problems__card-text">{{ item.text }}</p>
          </div>
        </div>
      </div>

      <div class="problems__warning" v-reveal>
        <span class="problems__warning-mark">!</span>
        <p>
          Несдача или несвоевременная сдача отчётности является основанием
          для&nbsp;<strong>субсидиарной ответственности</strong> руководителя.
        </p>
      </div>

      <p class="problems__conclusion" v-reveal>
        Если вы столкнулись хотя бы с&nbsp;одной из этих проблем —
        мы&nbsp;подключаемся немедленно и&nbsp;берём ситуацию под&nbsp;контроль.
      </p>
    </div>
  </section>
</template>

<style scoped>
.problems__head {
  margin-bottom: 3rem;
}

.problems__grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  margin-bottom: 2.5rem;
}

.problems__card {
  display: flex;
  align-items: flex-start;
  gap: 1.125rem;
  padding: 1.5rem;
  background: var(--c-light);
  border: 1px solid var(--c-border);
  border-radius: var(--radius-md);
  transition: all var(--transition);
}

.problems__card:hover {
  border-color: var(--c-accent);
  box-shadow: 0 4px 20px rgba(230, 57, 70, 0.07);
  transform: translateY(-2px);
}

.problems__icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: var(--radius-sm);
  background: rgba(230, 57, 70, 0.07);
  color: var(--c-accent);
  flex-shrink: 0;
}

.problems__card-title {
  font-size: 0.9375rem;
  font-weight: 700;
  margin-bottom: 0.25rem;
  line-height: 1.3;
  color: var(--c-text);
}

.problems__card-text {
  font-size: 0.8125rem;
  color: var(--c-text-secondary);
  line-height: 1.5;
}

.problems__warning {
  display: flex;
  align-items: center;
  gap: 0.875rem;
  padding: 1.125rem 1.5rem;
  background: rgba(230, 57, 70, 0.05);
  border-left: 3px solid var(--c-accent);
  border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
  margin-bottom: 2rem;
}

.problems__warning-mark {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 26px;
  height: 26px;
  border-radius: 50%;
  background: var(--c-accent);
  color: #fff;
  font-size: 0.8125rem;
  font-weight: 800;
  flex-shrink: 0;
}

.problems__warning p {
  font-size: 0.875rem;
  line-height: 1.55;
  color: var(--c-text);
}

.problems__conclusion {
  font-size: 1.0625rem;
  font-weight: 500;
  color: var(--c-text);
  line-height: 1.6;
}

@media (max-width: 768px) {
  .problems__grid {
    grid-template-columns: 1fr;
  }
}
</style>
