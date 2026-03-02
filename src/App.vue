<script setup lang="ts">
import AppHeader from './components/AppHeader.vue'
import SectionHero from './components/SectionHero.vue'
import SectionProblems from './components/SectionProblems.vue'
import SectionStats from './components/SectionStats.vue'
import SectionProcess from './components/SectionProcess.vue'
import SectionTrust from './components/SectionTrust.vue'
import SectionNotFor from './components/SectionNotFor.vue'
import SectionCases from './components/SectionCases.vue'
import SectionConsult from './components/SectionConsult.vue'
import SectionContact from './components/SectionContact.vue'
import AppFooter from './components/AppFooter.vue'
</script>

<template>
  <AppHeader />
  <main>
    <SectionHero />
    <SectionProblems />
    <SectionStats />
    <SectionProcess />
    <SectionTrust />
    <SectionNotFor />
    <SectionCases />
    <SectionConsult />
    <SectionContact />
  </main>
  <AppFooter />
</template>
