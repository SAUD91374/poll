<template>
    <div
        class="border-t-4 border-[#4363EC] container mx-auto mt-3 p-2 bg-white shadow-lg rounded-lg max-w-full sm:max-w-screen-xs lg:max-w-screen-sm lg:p-6 font-rajdhani"
    >
    <div class="relative flex justify-end">
            <!-- Ellipsis Icon Button -->
            <button @click="toggleDropdown" class="focus:outline-none">
                <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
            </button>

            <!-- Dropdown Menu -->
            <div
                v-if="isDropdownOpen"
                class="absolute right-0 mt-6 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
            >
                <div class="py-1">
                    <Link
                        :href="`/edit_poll/${form.poll_name}/${multiple[index].id}`"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                        <i class="fa-solid fa-pen mr-2"></i>
                        Edit
                        </Link
                    >
                    <Link
                        :href="`/delete_poll/${form.poll_name}/${multiple[index].id}`"
                        class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100"
                        >
                        <i class="fa-solid fa-trash mr-2"></i>
                        Delete
                        </Link
                    >
                </div>
            </div>
        </div>

        <!-- Title and description -->
        <h1 class="text-2xl font-bold text-[#4363EC] mb-2">
            {{ multiple[index].title }}
        </h1>
        <p class="text-lg text-black mb-2">{{ multiple[index].description }}</p>
        <!-- Use the TimeAgo component to display the creation time -->
        <div
                class="text-gray-600 text-sm sm:text-lg"
            >
                by <span class="">{{ user }}</span>
                <!-- Use the TimeAgo component to display the creation time -->
                <i class="fa-regular fa-clock mx-2"></i>
                <TimeAgo class="font-medium" :createdAt="multiple[index].created_at" />
            </div>
        <p class="text-2xl text-black mt-6">Make a choice:</p>

        <!-- Poll Form -->
        <form @submit.prevent="submitPoll">
            <!-- Grid of images and options in two columns -->

            <div class="grid grid-cols-2 gap-7">
                <input
                    :id="`title_${index + 1}`"
                    type="text"
                    :value="multiple[index].title"
                    v-model="form.title"
                    class="hidden"
                />
            </div>
            <!-- grid layout -->
            <div class="grid grid-cols-2 gap-8 mt-2">
                <div
                    v-for="(image, imgIndex) in JSON.parse(
                        multiple[index].images || '[]'
                    )"
                    :key="imgIndex"
                    class="flex flex-col items-center"
                >
                    <!-- Image -->
                    <img
                        :src="`/photos/${image}`"
                        alt="Image"
                        class="w-auto h-24 rounded-lg object-scale-down sm:h-44 sm:object-fill sm:rounded-lg"
                        @click="form.selectedOption = `option_${imgIndex + 1}`"
                    />

                    <!-- Option Label and Radio -->
                    <div
                        class="flex items-center mt-3 p-3 border rounded-lg border-[#4363EC] w-full bg-white justify-between"
                        @click="form.selectedOption = `option_${imgIndex + 1}`"
                    >
                        <div class="flex items-center">
                            <span
                                class="w-6 h-6 rounded-full bg-[#4363EC] text-white text-center font-bold"
                                >{{ imgIndex + 1 }}</span
                            >
                            <label
                                class="ml-3 text-lg font-medium text-[#535974]"
                                >Option {{ imgIndex + 1 }}</label
                            >
                        </div>
                        <label class="flex items-center ml-4">
                            <input
                                type="radio"
                                :value="`option_${imgIndex + 1}`"
                                name="option"
                                v-model="form.selectedOption"
                                class="hidden"
                            />
                            <span
                                class="relative w-5 h-5 rounded-full border border-[#4363EC] cursor-pointer"
                            >
                                <span
                                    v-if="
                                        form.selectedOption ===
                                        `option_${imgIndex + 1}`
                                    "
                                    class="absolute inset-1 bg-[#4363EC] rounded-full"
                                ></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- list layout -->
            <div
                v-for="(list, i) in JSON.parse(multiple[index].images_list)"
                :key="i"
                class="flex my-4 items-start p-5 border border-gray-300 rounded-lg relative"
                @click="form.selectedOption = `list_option_${i + 1}`"
            >
                <!-- Radio button positioned at the top right -->
                <input
                    type="radio"
                    v-model="form.selectedOption"
                    :value="`list_option_${i + 1}`"
                    class="absolute top-2 right-2 z-10"
                />

                <!-- Left side: Image -->
                <div class="mr-2">
                    <img
                        :src="`/photos/${list.image}`"
                        alt="Image"
                        class="w-52 h-20 lg:h-24 rounded-lg object-cover"
                    />
                </div>

                <!-- Right side: Title and Description -->
                <div class="flex flex-col justify-center mb-2 w-full">
                    <!-- Line between image and text -->
                    <span
                        class="font-semibold text-lg border-b border-gray-300"
                        >{{ list.title }}</span
                    >
                    <span class="text-gray-600">{{ list.description }}</span>
                </div>
            </div>

            <!-- Vote and Share Buttons -->
            <div
                class="flex flex-col sm:flex-row justify-between items-center mt-6"
            >
                <button
                    type="submit"
                    :disabled="isSubmitting"
                    class="bg-[#4363EC] text-white text-base sm:text-xl px-4 py-2 sm:px-6 sm:py-2 rounded-full hover:bg-blue-700 transition focus:ring-4 focus:ring-blue-500 shadow-lg w-full sm:w-auto"
                >
                    {{ isSubmitting ? "Voting..." : "Vote Now" }}
                </button>
                <p
                    @click="shareLink"
                    class="text-[#4363EC] text-base sm:text-xl hover:underline cursor-pointer mt-4 sm:mt-0"
                >
                    Share Link
                </p>
            </div>
        </form>

        <!-- Previous and Next buttons -->
        <PollNavigation
            :currentIndex="index"
            :totalPolls="multiple.length"
            @prev="prevPoll"
            @next="nextPoll"
        />
    </div>
</template>

<script setup>
import { router, useForm,usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import PollNavigation from "@/Components/common.vue";
import TimeAgo from "@/Components/time_ago.vue"; // Adjust the import path as needed

const props = defineProps({
    multiple: { type: Array, required: true },
    user: String,
});
const isDropdownOpen = ref(false);

// Toggle dropdown visibility
const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};
// Track the currently selected index of the multiple array
const index = ref(0);
const isSubmitting = ref(false); // Track submission state
// Form state
const form = useForm({
    poll_name: "multiplepoll",
    title: props.multiple[index.value].title,
    selectedOption: null,
});
// On page load, check if a poll index is provided in the URL or default to the last poll
onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const pollIndexFromUrl = params.get("poll");

    if (pollIndexFromUrl !== null && !isNaN(pollIndexFromUrl)) {
        index.value = parseInt(pollIndexFromUrl, 10);
    } else {
        index.value = props.multiple.length - 1; // Default to last poll
    }

    // Set the form title to the current poll
    form.title = props.multiple[index.value].title;
});

// Function to navigate to the previous element
const prevPoll = () => {
    if (index.value > 0) {
        index.value--;
        form.title = props.multiple[index.value].title;
        form.selectedOption = null; // Reset the selected image index when switching polls
    }
};

// Function to navigate to the next element
const nextPoll = () => {
    if (index.value < props.multiple.length - 1) {
        index.value++;
        form.title = props.multiple[index.value].title;
        form.selectedOption = null; // Reset the selected image index when switching polls
    }
};

// Share link functionality
const shareLink = () => {
    const pollUrl = `${window.location.origin}/multiple_vote_page/?poll=${index.value}`;
    navigator.clipboard
        .writeText(pollUrl)
        .then(() => {
            alert("Poll link copied to clipboard!");
        })
        .catch((err) => {
            console.error("Failed to copy link: ", err);
        });
};

// Submit the selected poll
const submitPoll = () => {
    if (form.selectedOption !== null) {
        isSubmitting.value = true; // Set the button to "Voting..."
        setTimeout(() => {
            isSubmitting.value = false; // Revert the button after 2 seconds
            router.post("/poll", form); // Submit the form
            toast.fire({
                icon: "success",
                title: "Your vote has been saved",
            });
        }, 2000);
    } else {
        alert("Please select an option before voting.");
    }
};
</script>
