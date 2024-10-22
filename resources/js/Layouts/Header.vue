<template>
    <nav class="bg-white shadow-sm border-b font-rajdhani sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <link rel="icon" type="image/x-icon" href="/assets/images/Poll.png">
            <!-- Logo -->
            <Link href="/" class="flex items-center">
                <img src="/assets/images/Poll.png" alt="Poll" class="h-8 w-auto" />
            </Link>
            <link
                    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
                    rel="stylesheet"
                />
            <!-- Hamburger menu for mobile -->
            <button
                @click="toggleMenu"
                class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none"
            >
                <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        :class="isMenuOpen ? 'hidden' : 'inline-flex'"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                        :class="isMenuOpen ? 'inline-flex' : 'hidden'"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex items-center space-x-6">
                <Link href="/" class="text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Home</Link>
                <Link href="/create_poll" class="text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Create Poll</Link>
                <!-- <Link href="/vote_page" class="text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Vote Page</Link>
                <Link href="/images_vote_page" class="bg-[#bdc4e3] text-black px-4 py-2 rounded-full shadow-lg hover:bg-gray-100 hover:text-blue-600 transition duration-300">Vote Page 2</Link>
                <Link href="/multiple_vote_page" class="bg-blue-600 text-white px-4 py-2 rounded-full shadow-lg hover:bg-gray-100 hover:text-blue-600 transition duration-300">Vote Page 3</Link> -->

                <!-- Social Icons -->
                <div class="flex space-x-4 font-medium">
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-facebook"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-instagram"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-twitter"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-linkedin"></i></Link>
                </div>
            </div>

            <!-- Profile Dropdown (Desktop only) -->
            <div class="hidden lg:block relative">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                            {{ $page.props.auth.user?.name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div v-if="isMenuOpen" class="lg:hidden block">
            <div class="space-y-2 px-4 py-4">
                <Link href="/" class="block text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Home</Link>
                <Link href="/create_poll" class="block text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Create Poll</Link>
                <!-- <Link href="/vote_page" class="block text-lg font-medium text-gray-800 hover:bg-gray-100 hover:text-blue-600 px-3 py-2 rounded-full transition duration-300">Vote Page</Link>
                <Link href="/images_vote_page" class="block bg-[#bdc4e3] text-black px-4 py-2 rounded-full shadow-lg hover:bg-gray-100 hover:text-blue-600 transition duration-300">Vote Page 2</Link>
                <Link href="/multiple_vote_page" class="block bg-blue-600 text-white px-4 py-2 rounded-full shadow-md hover:bg-gray-100 hover:text-blue-600 transition duration-300">Vote Page 3</Link> -->
                <div class="flex space-x-4 font-medium">
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-facebook"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-instagram"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-twitter"></i></Link>
                    <Link href="#" class="text-[#4363EC] hover:text-gray-700 text-3xl"><i class="bi bi-linkedin"></i></Link>
                </div>
                <!-- Profile Dropdown (Mobile) -->
                <div class="relative">
                    <Dropdown align="left" width="48">
                        <template #trigger>
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{ $page.props.auth.user?.name }}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { onMounted, onUnmounted, ref } from 'vue';

const isMenuOpen = ref(false);
let isOpening = false; // Flag to track if the menu was just opened

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
    isOpening = true; // Set the flag to prevent immediate closing

    // Reset the flag after a short delay to allow the menu to fully open
    setTimeout(() => {
        isOpening = false;
    }, 200);
}

// Function to close the mobile menu on scroll
const closeMenuOnScroll = () => {
    if (isMenuOpen.value && !isOpening) {
        isMenuOpen.value = false;
    }
};

// Lifecycle hooks to attach and detach scroll event listener
onMounted(() => {
    window.addEventListener('scroll', closeMenuOnScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', closeMenuOnScroll);
});

</script>


<style>
.font-rajdhani {
    font-family: "Rajdhani", sans-serif;
}
</style>
