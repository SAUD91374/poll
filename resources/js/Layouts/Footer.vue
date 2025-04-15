<template>
    <footer class="font-rajdhani">
        <div class="bg-gray-100 mt-5">
            <div class="container mx-auto px-4 py-5">
                <footer class="py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- About Section -->
                        <div class="mb-8">
                            <h1 class="text-gray-800 text-4xl font-bold">POLL</h1>
                            <p class="text-gray-600 mt-2">Making it easy to create instant, real-time polls and surveys for free.</p>
                            <ul class="flex flex-wrap space-x-4 mt-4 text-3xl">
                                <li><Link class="text-[#4363EC] hover:text-gray-800" href="#"><i class="bi bi-facebook"></i></Link></li>
                                <li><Link class="text-[#4363EC] hover:text-gray-800" href="#"><i class="bi bi-instagram"></i></Link></li>
                                <li><Link class="text-[#4363EC] hover:text-gray-800" href="#"><i class="bi bi-twitter"></i></Link></li>
                                <li><Link class="text-[#4363EC] hover:text-gray-800" href="#"><i class="bi bi-linkedin"></i></Link></li>
                            </ul>
                        </div>

                        <!-- Solution Section -->
                        <div class="mb-8">
                            <h5 class="text-gray-800 text-lg font-semibold">Solution</h5>
                            <ul class="space-y-2 mt-2">
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">POLL MAKER</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">DISCORD</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">POLL API</Link></li>
                            </ul>
                        </div>

                        <!-- Support Section -->
                        <div class="mb-8">
                            <h5 class="text-gray-800 text-lg font-semibold">Support</h5>
                            <ul class="space-y-2 mt-2">
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">PRICING</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">HELP CENTER</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">GUIDE</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">F.A.Q</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">INTEGRATION</Link></li>
                            </ul>
                        </div>

                        <!-- Company / Legal Section -->
                        <div class="mb-8">
                            <h5 class="text-gray-800 text-lg font-semibold">Company / Legal</h5>
                            <ul class="space-y-2 mt-2">
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">ABOUT US</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">IMPRINT</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">CONTACT US</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">PRIVACY</Link></li>
                                <li><Link href="#" class="text-gray-600 hover:text-gray-800">TERMS AND CONDITION</Link></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="bg-gray-200 py-2">
            <div class="container mx-auto text-center">
                <p class="text-gray-800">© {{ currentYear }} Poll. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3';
const date = new Date();
const year = date.getFullYear();
export default {
    components: {
        Link,
    },
    data() {
        return {
            currentYear: year
        };
    }
};
</script>

<style scoped>
/* Add additional mobile styles if needed */
@media (max-width: 640px) {
    .text-3xl {
        font-size: 1.5rem;
    }
}
</style>
