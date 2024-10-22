<template>
    <main class="font-rajdhani container max-w-screen-2xl mx-auto py-8">
        <!-- Hero Section -->
        <div class="container mx-auto px-4 py-5">
            <div
                class="flex flex-col lg:flex-row-reverse items-center justify-center gap-2 py-5"
            >
                <div class="lg:w-1/1">
                    <img
                        src="/assets/images/Frame (1).png "
                        class="mx-auto lg:w-2/3"
                        alt="Poll Illustration"
                        loading="lazy"
                    />
                </div>
                <div class="">
                    <h3 class="mb-3 text-[#4363EC] text-5xl font-bold">
                        Create your
                        <span class="text-black"
                            >poll in
                            <br />
                            seconds</span
                        >
                    </h3>
                    <p class="text-lg text-gray-700">
                        Want to ask your friends where to go <br />
                        Friday night or arrange a meeting with <br />
                        co-workers? Create a poll - and get answers <br />
                        in no time.
                    </p>
                    <div class="text mt-5 space-x-3">
                        <Link href="create_poll">
                            <button
                                type="button"
                                class="bg-blue-600 text-white text-xl py-4 px-6 rounded-full shadow-xl"
                            >
                                Create a Poll
                            </button>
                        </Link>
                        <button
                            type="button"
                            class="bg-white text-[#4363EC] text-xl py-4 px-6 rounded-full shadow-xl"
                        >
                            View examples
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advance Poll Maker Section -->
        <div class="container mx-auto px-2 py-8">
            <div class="text-center">
                <h3 class="mb-3 text-5xl font-bold text-[#4363EC]">
                    Use Our Advance<span class="text-black"> Poll Maker</span>
                </h3>
                <p class="text-2xl text-gray-700">
                    A Poll is a voting that can be used to help people
                    easily determine the opinion of a group or the public on
                    some issue. Polls are <br />
                    very useful when only the majority opinion is important and
                    not the opinion of each individual participant.
                </p>
            </div>
        </div>

        <!-- Categories Section -->
        <div
            class="container mx-auto px-32 py-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4"
        >
            <div class="text-center">
                <div class="relative">
                    <img
                        src="/assets/images/123 1.png"
                        class="w-full h-auto mx-auto"
                        alt="Category Image"
                        loading="lazy"
                    />
                    <span
                        class="absolute top-0 left-0 text-white font-semibold px-2 py-1"
                    >
                        Science
                    </span>

                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-5 space-x-3">
            <Link href="create_poll">
                <button
                    type="button"
                    class="bg-blue-600 text-white text-xl py-4 px-6 rounded-full shadow-xl"
                >
                    Create a Poll
                </button>
            </Link>
            <button
                type="button"
                class="bg-white text-[#4363EC] text-xl py-4 px-6 rounded-full shadow-xl"
            >
                View examples
            </button>
        </div>
        <!-- Features Section -->
        <div
            class="container mx-auto px-1 sm:px-24 py-8 grid grid-cols-1 sm:grid-cols-3 gap-4"
        >
            <div>
                <div class="bg-white rounded-lg p-5">
                    <div class="relative">
                        <img
                            src="/assets/images/branding-design 1.png"
                            class="w-full h-auto mx-auto"
                            alt="Branding Design"
                            loading="lazy"
                        />
                        <p
                            class="absolute bottom-0 left-0 right-0 text-base font-semibold text-[#4363EC] bg-white rounded-t-lg mx-4"
                        >
                            <span class="p-4 align-text-top">76 Vote</span><br />
                            <span class="p-4 text-gray-500 font-thin"
                                >Final Design Selection</span
                            >
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-lg p-5">
                    <div class="relative">
                        <img
                            src="/assets/images/about-photo 1.png"
                            class="w-full h-auto mx-auto"
                            alt="About Photo"
                            loading="lazy"
                        />
                        <p
                            class="absolute bottom-0 left-0 right-0 text-base font-semibold text-[#4363EC] bg-white rounded-t-lg mx-4"
                        >
                            <span class="p-4 align-text-top">76 Vote</span><br />
                            <span class="p-4 text-gray-500 font-thin"
                                >Final Design Selection</span
                            >
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-lg p-5">
                    <div class="relative">
                        <img
                            src="/assets/images/ecommerce-development 1.png"
                            class="w-full h-auto mx-auto"
                            alt="Ecommerce Development"
                            loading="lazy"
                        />
                        <p
                            class="absolute bottom-0 left-0 right-0 text-base font-semibold text-[#4363EC] bg-white rounded-t-lg mx-4"
                        >
                            <span class="p-4 align-text-top">76 Vote</span><br />
                            <span class="p-4 text-gray-500 font-thin"
                                >Final Design Selection</span
                            >
                        </p>
                    </div>
                </div>
            </div>

            <!-- Repeat the above block for other features as needed -->
        </div>

        <!-- Ready to Get Started Section -->
        <section class="py-5 text-center bg-white mt-5">
            <div class="container mx-auto">
                <p class="text-7xl">Ready To get started <br />?</p>
                <p class="text-7xl text-[#4363EC] mt-3 font-bold">It's Free!</p>
                <div class="mt-5 space-x-4">
                    <Link href="create_poll">
                        <button
                            type="button"
                            class="bg-blue-600 text-white text-xl py-4 px-6 rounded-full shadow-xl"
                        >
                            Create a Poll
                        </button>
                    </Link>
                    <button
                        type="button"
                        class="bg-white text-[#4363EC] text-xl py-4 px-6 rounded-full shadow-xl"
                    >
                        View examples
                    </button>
                </div>
            </div>
        </section>

        <!-- Poll Features Section -->
        <div class="bg-blue-50 px-0 py-10">
            <div class="container mx-auto px-4 text-center mb-7">
                <h5 class="text-lg">POLLING MADE EASY</h5>
                <h3 class="text-3xl text-[#4363EC]">
                    Simple Polls with powerful configuration
                </h3>
                <p class="text-lg text-gray-700">
                    While we make our polls as simple and beautiful as possible,
                    we also offer powerful customization <br />
                    options to enable on-demand adjustments for many different
                    purposes.
                </p>
            </div>

            <div
                class="container mx-auto px-20 py-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5"
            >
                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 78.png"
                        class="w-24 h-24 justify-center"
                        alt="Fake Detection Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        FAKE DETECTION
                    </h4>
                    <p class="text-gray-600">
                        By default, bots and VPN users are blocked from voting
                        on straw polls.
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 79.png"
                        class="w-24 h-24"
                        alt="Deadlines Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        DEADLINES
                    </h4>
                    <p class="text-gray-600">
                        Our polls run indefinitely. You can change that by
                        setting a deadline.
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 82.png"
                        class="w-24 h-24"
                        alt="Emoji Support Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        EMOJI SUPPORT
                    </h4>
                    <p class="text-gray-600">
                        We support all Emojis natively. Feel free to use as many
                        as you want!
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 81.png"
                        class="w-24 h-24"
                        alt="Live Results Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        LIVE RESULTS
                    </h4>
                    <p class="text-gray-600">
                        Evaluate your poll results in a pie chart or bar graph
                        in real-time.
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 80.png"
                        class="w-24 h-24"
                        alt="Poll API Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        POLL API
                    </h4>
                    <p class="text-gray-600">
                        We provide an easy-to-use API for poll creation and
                        result analysis.
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow">
                    <img
                        src="/assets/images/Group 83.png"
                        class="w-24 h-24"
                        alt="Active Development Icon"
                        loading="lazy"
                    />
                    <h4 class="mt-3 text-xl font-semibold text-gray-800">
                        ACTIVE DEVELOPMENT
                    </h4>
                    <p class="text-gray-600">
                        We are continuously working on additional features and
                        quality-of-life updates.
                    </p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { Link } from "@inertiajs/vue3";
// import AppLayout from "@/Shared/AppLayout.vue";

export default {
    components: { Link },
    // layout:AppLayout,
};
</script>
