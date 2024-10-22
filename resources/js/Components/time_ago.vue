<template>
    <span class="text-gray-500 text-sm">
      {{ formattedTime }}
    </span>
  </template>

  <script setup>
  import { ref, watchEffect } from 'vue';
  import dayjs from 'dayjs';
  import relativeTime from 'dayjs/plugin/relativeTime';

  dayjs.extend(relativeTime);

  // Define props to receive the creation time
  const props = defineProps({
    createdAt: {
      type: String, // or Date, depending on your data type
      required: true,
    },
  });

  // Reactive variable to hold the formatted time
  const formattedTime = ref('');

  // Watch the createdAt prop to update the formatted time whenever it changes
  watchEffect(() => {
    formattedTime.value = dayjs(props.createdAt).fromNow();
  });
  </script>

  <style scoped>
  /* You can add any specific styles here */
  </style>
    