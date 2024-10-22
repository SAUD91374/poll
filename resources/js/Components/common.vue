<template>
  <!-- Navigation Buttons -->
  <div class="flex justify-center mt-8 space-x-3 sm:space-x-5">
    <button
      @click="$emit('prev')"
      :preserve-scroll="true"
      :disabled="currentIndex === 0"
      class="bg-[#4363EC] text-white px-4 py-2 rounded-full shadow hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed w-full sm:w-auto"
    >
      Previous Poll
    </button>
    <button
      @click="$emit('next')"
      :preserve-scroll="true"
      :disabled="currentIndex === totalPolls - 1"
      class="bg-[#4363EC] text-white px-4 py-2 rounded-full shadow hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed w-full sm:w-auto"
    >
      Next Poll
    </button>
  </div>
  
</template>

<script setup>
const props = defineProps({
  currentIndex: {
    type: Number,
    required: true,
  },
  totalPolls: {
    type: Number,
    required: true,
  },
});


</script>
