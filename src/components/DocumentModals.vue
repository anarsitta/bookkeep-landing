<script setup lang="ts">
import { ref } from 'vue'
import PolicyDocument from './documents/PolicyDocument.vue'
import ConsentDocument from './documents/ConsentDocument.vue'

const policyRef = ref<InstanceType<typeof PolicyDocument> | null>(null)
const consentRef = ref<InstanceType<typeof ConsentDocument> | null>(null)

function open(doc: 'policy' | 'consent') {
  if (doc === 'policy') policyRef.value?.open()
  else consentRef.value?.open()
}

defineExpose({ open })
</script>

<template>
  <PolicyDocument ref="policyRef" />
  <ConsentDocument ref="consentRef" />
</template>
