<template>
  <div v-if="message && visible" :class="['p-4 mb-4 rounded-lg text-white', alertType, 'fade', 'show','max-w-md', 'w-full']" role="alert">
    {{ message }}
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
  message: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: 'success',
  },
});

const alertType = computed(() => {
  return {
    success: 'bg-green-400',
    error: 'bg-red-500',
  }[props.type];
});

const visible = ref(true);

onMounted(() => {
  if (props.message) {
    setTimeout(() => {
      visible.value = false;
    }, 5000);
  }
});
</script>
