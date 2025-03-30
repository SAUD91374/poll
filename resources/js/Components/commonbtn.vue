<template>
    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        <button
            type="button"
            class="bg-white text-[#4363EC] rounded-full text-xl px-6 py-3 shadow-xl"
        >
            View examples
        </button>

        <!-- Reset Button -->
        <button
            type="button"
            @click="resetForm"
            class="rounded-full px-4 py-2 shadow-md bg-[#4363EC] text-white font-semibold ring-1 ring-transparent transition hover:bg-gray-100 hover:text-[#4363EC] hover:ring-[#4363EC] focus:outline-none focus-visible:ring-[#4363EC]"
        >
            Reset
        </button>
    </div>
</template>
<script setup></script>
