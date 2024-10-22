<!-- resources/js/Components/FormErrors.vue -->
<template>
    <div>
      <div
        v-for="(error, index) in Object.values(errors)"
        :key="index"
        class="bg-red-50 text-red-600 border border-red-300 rounded-lg px-4 py-3 mb-3 flex items-center"
      >
        <svg
          class="w-5 h-5 mr-2 text-red-500"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
        <span>{{ error }}</span>
      </div>
      <slot />
    </div>
  </template>

  <script setup>
  import { defineProps } from 'vue';

  const props = defineProps({
    errors: {
        type: Object,
        required: false, // Optional if there may be no errors initially
        default: () => ({})
    }
});

// Watch each form field to remove specific error upon input change
const clearError = (field) => {
  if (props.errors[field]) {
    delete props.errors[field];
  }
};
</script>
  <style scoped>
  /* Add any specific styles for the error component here if needed */
  </style>
