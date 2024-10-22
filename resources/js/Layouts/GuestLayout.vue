<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center pt-8 sm:justify-center sm:pt-0 dark:bg-gray-900"
    >
        <div class="mb-8">
            <span class="flex justify-center mb-4">
                <img
                    src="/assets/images/Poll.png"
                    alt="Poll Logo"
                    class="h-10 w-auto"
                    loading="lazy"
                />
                </span>
            <div class="flex ">

                <!-- Login Button -->
                <div v-if="route().current('register')">
                    <span class="text-[#4363EC] font-semibold text-4xl block">Create a free account</span>
                    <div class="text-center">
                    <p class="text-xl">or</p>
                    <Link

                        :href="route('login')"
                        class="rounded-full py-2 text-[#4363EC] font-semibold hover:text-black"
                    >
                        Log in to your account
                    </Link>
                </div>
                </div>

                <!-- Register Button -->
                <div v-if="route().current('login')">
                    <span class="text-[#4363EC] font-semibold text-4xl">Login in to your account</span>
                    <div class="text-center">

                    <p class="text-xl">or</p>
                    <Link

                        :href="route('register')"
                        class="rounded-full py-2 text-[#4363EC] font-semibold hover:text-black"
                    >
                        Create a account
                    </Link>
                </div>

                </div>
            </div>

        </div>

        <div
            class="w-full bg-white px-6 py-8 shadow-lg rounded-lg sm:max-w-md dark:bg-gray-800 border-t-[3px] border-[#4363EC]"
        >
            <!-- Slot for additional content -->
            <slot />
        </div>
    </div>
</template>
