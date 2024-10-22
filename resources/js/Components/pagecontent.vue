<template>
    <div class="font-rajdhani">
        <div class="container mx-auto px-24 my-8">
            <div class="text-center">
                <span class="text-2xl md:text-3xl">How it works</span><br />
                <span
                    class="font-semibold text-3xl md:text-4xl lg:text-5xl text-[#4363EC]"
                >
                    New to Poll? No problem. </span
                ><br />
                <span class="text-gray-700 text-sm md:text-base lg:text-lg">
                    We have designed our poll maker to be as easy and intuitive
                    to use as possible. At the same time, we are constantly
                    optimizing the workflow of creating online polls on Poll.
                </span>
            </div>
        </div>

        <div class="container mx-auto px-24 py-14">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="bg-[#4363EC] text-white text rounded-full w-12 h-12 md:w-16 md:h-16 mx-auto flex items-center justify-center font-extrabold text-3xl md:text-4xl lg:text-5xl"
                    >
                        1
                    </div>
                    <h3
                        class="text-lg md:text-xl lg:text-2xl font-semibold mt-4"
                    >
                        Create a poll
                    </h3>
                    <p
                        class="text-gray-600 text-sm md:text-base lg:text-lg mt-2"
                    >
                        Choose a title, a set of answer options, and some basic
                        settings.
                    </p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-[#4363EC] text-white rounded-full w-12 h-12 md:w-16 md:h-16 mx-auto flex items-center justify-center font-extrabold text-3xl md:text-4xl lg:text-5xl"
                    >
                        2
                    </div>
                    <h3
                        class="text-lg md:text-xl lg:text-2xl font-semibold mt-4"
                    >
                        Share your link
                    </h3>
                    <p
                        class="text-gray-600 text-sm md:text-base lg:text-lg mt-2"
                    >
                        Invite participants by sharing your StrawPoll link.
                    </p>
                </div>
                <div class="text-center">
                    <div
                        class="bg-[#4363EC] text-white rounded-full w-12 h-12 md:w-16 md:h-16 mx-auto flex items-center justify-center font-extrabold text-3xl md:text-4xl lg:text-5xl"
                    >
                        3
                    </div>
                    <h3
                        class="text-lg md:text-xl lg:text-2xl font-semibold mt-4"
                    >
                        Get results
                    </h3>
                    <p
                        class="text-gray-600 text-sm md:text-base lg:text-lg mt-2"
                    >
                        When a vote is cast, results will be updated in
                        real-time.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-center mx-auto px-6 py-10">
            <div
                class="flex flex-col lg:flex-row items-center justify-between lg:justify-between gap-8"
            >
                <div class="lg:pr-10">
                    <img
                        src="/assets/images/Frame (1).png"
                        class="w-auto h-64 object-fit rounded-lg"
                        alt="Create Poll"
                        loading="lazy"
                    />
                </div>
                <div class="flex-1 lg:pl-8">
                    <h3
                        class="text-lg md:text-xl lg:text-5xl font-semibold mb-4 text-[#4363EC] max-w-sm"
                    >
                        Create an
                        <span class="text-black">online poll</span>
                        in a matter of
                        <span class="text-black">seconds</span>
                    </h3>
                    <p
                        class="text-gray-700 text-sm md:text-base lg:text-lg mb-4 max-w-xs"
                    >
                        Whether it's a quick poll with friends or the solution
                        to an eternal discussion in your forum, Poll helps you
                        find the answer quickly and easily. Are you on social
                        media and have you ever wanted to know whatyour
                        followers really think? Here you can create a free poll
                        in seconds, without any signup or registration. Of
                        course, for complex features and to manage your polls,
                        we also offer a login, which is not mandatory
                    </p>

                    <div class="mt-4">
                        <button
                            class="bg-[#4363EC] text-white py-2 px-6 rounded-full text-base md:text-lg"
                        >
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mx-auto px-6 py-8">
            <!-- Increased padding -->
            <div
                class="flex flex-col lg:flex-row-reverse items-center gap-8 py-6"
            >
                <!-- Increased gap and padding -->
                <div class="w-full h-auto sm:w-8/12 md:w-7/12 lg:w-5/12">
                    <!-- Slightly increased width -->
                    <img
                        src="/assets/images/aaaaa.png"
                        class="w-auto h-96 object-cover rounded-lg"
                        alt="Real-time Polling"
                        loading="lazy"
                    />
                </div>
                <div>
                    <h3
                        class="mb-4 text-2xl md:text-2xl lg:text-5xl font-bold text-[#4363EC] max-w-md"
                    >
                        <!-- Increased text sizes -->
                        Get your results in
                        <span class="text-primary text-black">real-time</span>
                    </h3>
                    <p
                        class="text-lg md:text-xl lg:text-2xl max-w-xs break-words"
                    >
                        <!-- Increased text sizes and max-width -->
                        The results of a poll are updated in real time via
                        server-to-client push communication. The admin of a poll
                        can change who should have access to the results at any
                        time and can choose other useful settings.
                    </p>
                    <div class="mt-6">
                        <button
                            class="bg-[#4363EC] text-white py-3 px-8 rounded-full text-lg md:text-xl"
                        >
                            <!-- Increased button size -->
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative h-auto w-full bg-[#0a218c] overflow-hidden">
            <div
                class="relative flex flex-col items-center justify-center text-center text-white w-full h-80 md:h-96 lg:h-[600px]"
            >
                <img
                    src="/assets/images/banner.png"
                    alt="Banner Image"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="relative z-10 p-4 md:p-8">
                    <h3
                        class="text-base md:text-lg lg:text-2xl leading-tight tracking-wide uppercase"
                    >
                        Help center
                    </h3>
                    <h4
                        class="text-lg md:text-xl lg:text-5xl mt-2 leading-tight"
                    >
                        We're here to help
                    </h4>
                    <p
                        class="text-sm md:text-base font-semibold lg:text-2xl mt-4 leading-relaxed max-w-3xl"
                    >
                        While the basic interface is kept simple, Poll provides
                        powerful tools to enable on-demand adjustments for many
                        different purposes. Our help center is an ever-growing
                        resource to help you get assistance with problems and
                        discover features you don't know yet.
                    </p>
                    <button
                        class="bg-white text-[#4363EC] py-2 px-4 md:px-6 mt-4 rounded-full text-md md:text-base shadow-md"
                    >
                        Visit the help center
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// Add any script setup code here if needed
</script>
