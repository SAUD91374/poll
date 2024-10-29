<template>
    <div
        class="min-h-screen-lg sm:min-h-screen flex flex-col bg-white justify-center items-center bg-gradient-to-r from-[#4363EC] via-indigo-500 to-blue-400 text-black rounded-lg"
    >
        <!-- Icon or Illustration -->
        <div class="mb-6">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-20 w-20"
                fill="none"
                viewBox="0 0 24 24"
                stroke="black"
            >
                <circle
                    cx="10"
                    cy="10"
                    r="5"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M15 15l4 4"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <line
                    x1="8.5"
                    y1="8.5"
                    x2="11.5"
                    y2="11.5"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <line
                    x1="11.5"
                    y1="8.5"
                    x2="8.5"
                    y2="11.5"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>

        <!-- 404 Heading -->
        <h1 class="text-8xl font-bold mb-2 animate-pulse">404</h1>

        <!-- Description -->
        <p class="text-center text-2xl text-white opacity-90 mb-8">
            Sorry, we couldn’t find the page you’re looking for!
        </p>

        <!-- Go Back Button -->
        <Link
            href="/"
            class="px-8 py-4 mb-2 bg-white text-blue-500 font-semibold rounded-lg shadow-lg hover:bg-gray-200 hover:text-blue-600 transition duration-300 ease-in-out transform hover:scale-105"
        >
            Go to the Home Page
        </Link>
    </div>
</template>

<script setup>
// No additional logic needed
</script>

<style scoped>
/* Optionally, you can add more animations or custom styles here */
</style>
