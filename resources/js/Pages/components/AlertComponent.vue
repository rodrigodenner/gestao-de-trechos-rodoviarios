<template>
  <div v-if="message" :class="`alert alert-${type}`" class="p-4 rounded mb-4">
    <strong>{{ message }}</strong>
  </div>
</template>

<script>
export default {
  name: 'AlertComponent',
  props: {
    message: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'success'
    }
  }
}
</script>

<style scoped>
.alert {
  border: 1px solid transparent;
  border-radius: .25rem;
}
.alert-success {
  background-color: #d4edda;
  color: #155724;
  border-color: #c3e6cb;
}
.alert-error {
  background-color: #f8d7da;
  color: #721c24;
  border-color: #f5c6cb;
}
</style>
