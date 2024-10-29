<template>
    <!-- Success message div that disappears after 3 seconds -->
    <!-- <div>
        <div
            v-if="showSuccessMessage"
            class="bg-[#4363EC] text-white text-center p-3 mx-auto sm:mx-96 rounded-lg relative"
            role="alert"
        >
            <span class="block sm:inline">{{ page.props.flash.success }}</span>
        </div>
    </div> -->

    <div
        class="border-t-4 border-[#4363EC] font-rajdhani container mx-auto mt-2 p-4 sm:p-6 bg-white shadow-lg rounded-lg max-w-ful sm:max-w-screen-sm"
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
                        :href="`/edit_poll/${form.poll_name}/${polls[index].id}`"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                        <i class="fa-solid fa-pen mr-2"></i>
                        Edit
                        </Link
                    >
                    <Link
                        :href="`/delete_poll/${form.poll_name}/${polls[index].id}`"
                        class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100"
                        >
                        <i class="fa-solid fa-trash mr-2"></i>
                        Delete
                        </Link
                    >
                </div>
            </div>
        </div>
        <form @submit.prevent="submitPoll">
            <!-- Poll Title and Description -->
            <div class="flex">
                <input
                    v-model="form.title"
                    class="block p-0 border-none w-full text-xl sm:text-3xl font-bold text-[#4363EC] pb-2"
                    readonly
                />
            </div>

            <span class="block text-black mt-2 text-sm sm:text-lg">
                {{ polls[index].description }}
            </span>
            <!-- Use the TimeAgo component to display the creation time -->
            <div
                class="text-gray-600 text-sm sm:text-lg"
            >
                by <span class="">{{ user }}</span>
                <!-- Use the TimeAgo component to display the creation time -->
                <i class="fa-regular fa-clock mx-2"></i>
                <TimeAgo class="font-medium" :createdAt="polls[index].created_at" />
            </div>
            <!-- Poll Image -->
            <div class="flex justify-center mb-6">
                <img
                    :src="`/photos/${polls[index].image}`"
                    alt="Poll Image"
                    class="w-full h-full object-fit rounded-lg shadow-md"
                    loading="lazy"
                />
            </div>

            <!-- Poll Options -->
            <p class="text-lg sm:text-2xl text-gray-800 mt-6">Make a choice:</p>
            <div class="space-y-4 mt-4">
                <div
                    v-for="(option, i) in parsedOptions"
                    :key="i"
                    class="flex items-center border border-[#4363EC] bg-white rounded-lg p-2 mb-2"
                >
                    <span
                        class="w-6 h-6 flex items-center justify-center rounded-full bg-[#4363EC] text-white font-bold text-lg mr-3"
                        >{{ i + 1 }}</span
                    >
                    <label
                        :for="i"
                        class="text-gray-700 text-sm sm:text-lg font-medium flex-grow"
                    >
                        {{ option }}
                    </label>
                    <label class="flex items-center">
                        <input
                            v-model="form.selectedOption"
                            :id="i"
                            type="radio"
                            name="option"
                            :value="option"
                            class="form-radio h-4 w-4 sm:h-6 sm:w-6 text-[#0FA31E] focus:ring-[#0FA31E]"
                        />
                    </label>
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

        <!-- Navigation Buttons -->
        <PollNavigation
            :currentIndex="index"
            :totalPolls="polls.length"
            @prev="prevPoll"
            @next="nextPoll"
        />
    </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, onMounted,onBeforeUnmount } from "vue";
import PollNavigation from "@/Components/common.vue";
import TimeAgo from "@/Components/time_ago.vue"; // Adjust the import path as needed

const props = defineProps({
    polls: { type: Array, required: true },
    votes: { type: Array, required: true },
    user: String,
});

const index = ref(0);
const isSubmitting = ref(false); // Track submission state

const form = useForm({
    poll_name: "imagepoll",
    title: props.polls[index.value].title,
    selectedOption: null,
});
// On page load, check if a poll index is provided in the URL or default to the last poll
onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const pollIndexFromUrl = params.get("poll");

    if (pollIndexFromUrl !== null && !isNaN(pollIndexFromUrl)) {
        index.value = parseInt(pollIndexFromUrl, 10);
    } else {
        index.value = props.polls.length - 1; // Default to last poll
    }

    // Set the form title to the current poll
    form.title = props.polls[index.value].title;
});
const parsedOptions = computed(() => {
    return JSON.parse(props.polls[index.value].options || "[]");
});

// Share link functionality
const shareLink = () => {
    const pollUrl = `${window.location.origin}/images_vote_page/?poll=${index.value}`;
    navigator.clipboard
        .writeText(pollUrl)
        .then(() => {
            alert("Poll link copied to clipboard!");
        })
        .catch((err) => {
            console.error("Failed to copy link: ", err);
        });
};

// Navigate to the previous poll
const prevPoll = () => {
    if (index.value > 0) {
        index.value--;
        form.title = props.polls[index.value].title;
        form.selectedOption = null;
    }
};

const nextPoll = () => {
    if (index.value < props.polls.length - 1) {
        index.value++;
        form.title = props.polls[index.value].title;
        form.selectedOption = null;
    }
};
// Dropdown state
const isDropdownOpen = ref(false);

// Toggle dropdown visibility
const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};
// Close dropdown when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    isDropdownOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});

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
