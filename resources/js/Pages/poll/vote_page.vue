<template>
    <div
        class="border-t-4 border-[#4363EC] font-rajdhani container mx-auto mt-5 p-4 sm:p-6 bg-white shadow-lg rounded-lg max-w-full sm:max-w-screen-md"
    >
        <!-- {{rpolls[index]}} -->
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
                        :href="`/edit_poll/${form.poll_name}/${rpolls[index].id}`"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-pen mr-2"></i>
                        Edit
                    </Link>
                    <Link
                        @click.prevent="successMessage"
                        :href="`/delete_poll/${form.poll_name}/${rpolls[index].id}`"
                        class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-trash mr-2"></i>
                        Delete
                    </Link>
                </div>
            </div>
        </div>
        <!-- Poll Title and Description -->
        <form @submit.prevent="submitPoll">
            <input
                v-model="form.title"
                class="block w-full border-0 text-xl sm:text-3xl font-bold text-[#4363EC]"
                readonly
            />
            <span class="block text-black mt-2 text-sm sm:text-lg ml-4">
                {{ rpolls[index].description }}
            </span>
            <!-- Use the TimeAgo component to display the creation time -->
            <TimeAgo class="ml-4" :createdAt="rpolls[index].created_at" />

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
        <!-- Previous and Next buttons -->
        <PollNavigation
            :currentIndex="index"
            :totalPolls="rpolls.length"
            @prev="prevPoll"
            @next="nextPoll"
        />
    </div>
    <!-- Poll Results Section -->
    <div class="container items-center mx-auto mt-8 max-w-full sm:max-w-screen-lg p-5">
        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <!-- Poll Results Section -->
            <div
                class="w-full lg:w-1/2 mb-8 lg:mb-0"
                v-if="totalVotesForCurrentPoll > 0"
            >
                <div class="flex justify-between">
                    <p class="text-2xl sm:text-3xl font-bold text-[#4363EC]">
                        Poll Result
                    </p>
                    <p class="text-black mt-1 text-xl sm:text-xl">
                        Total votes: {{ totalVotesForCurrentPoll }}
                    </p>
                </div>
                <div class="mt-4 space-y-4">
                    <div v-for="(result, i) in currentPollVotes" :key="i">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm sm:text-lg font-medium">
                                {{ result.selectedOption }}
                            </p>
                            <span
                                class="text-[#4363EC] font-bold text-sm sm:text-base"
                            >
                                {{ calculatePercentage(result.votes) }}% -
                                {{ result.votes }} votes
                            </span>
                        </div>
                        <div
                            class="h-2 sm:h-3 bg-white rounded-full border border-blue-200"
                        >
                            <div
                                class="h-full rounded-full transition-all"
                                :style="{
                                    width:
                                        calculatePercentage(result.votes) + '%',
                                    backgroundColor: colors[i],
                                }"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-else
                class="flex flex-col sm:items-center sm:justify-center justify-center items-center absolute right-14 left-14"
            >
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-4">
                    No Votes Yet!!
                </h1>
                <p class="text-gray-600 text-sm sm:text-lg">
                    Be the first to cast your vote.
                </p>
            </div>

            <!-- Pie Chart Section -->
            <div class="w-full lg:w-1/2 flex flex-col justify-between">
                <div class="flex flex-col items-center">
                    <p
                        class="text-2xl sm:text-3xl text-center font-bold text-[#4363EC]"
                        v-if="totalVotesForCurrentPoll > 0"
                    >
                        Poll Chart Result
                    </p>
                    <canvas
                        id="pollPieChart"
                        class="relative w-full max-w-xs h-56 sm:h-72"
                    ></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch, onBeforeUnmount } from "vue";
import { useForm, router, usePage } from "@inertiajs/vue3";
import PollNavigation from "@/Components/common.vue";
import { Chart } from "chart.js/auto"; // Import Chart.js
import TimeAgo from "@/Components/time_ago.vue"; // Adjust the import path as needed

const props = defineProps({
    rpolls: { type: Array, required: true },
    votes: { type: Array, required: true },
});

const index = ref(0);
const isSubmitting = ref(false); // Track submission state
const colors = ["#3490dc", "#ffed4a", "#38c172", "#e3342f", "#6c757d"];
// totalVotesForCurrentPoll=ref(0);
// Form state for poll selection
const form = useForm({
    poll_name: "ranking",
    title: props.rpolls[index.value].title,
    selectedOption: null,
});
// On page load, check if a poll index is provided in the URL or default to the last poll
onMounted(() => {
    const params = new URLSearchParams(window.location.search);
    const pollIndexFromUrl = params.get("poll");

    if (pollIndexFromUrl !== null && !isNaN(pollIndexFromUrl)) {
        index.value = parseInt(pollIndexFromUrl, 10);
    } else {
        index.value = props.rpolls.length - 1; // Default to last poll
    }

    // Set the form title to the current poll
    form.title = props.rpolls[index.value].title;
});

// Compute poll options from the current poll
const parsedOptions = computed(() => {
    return JSON.parse(props.rpolls[index.value].options || "[]");
});
const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};
// Close dropdown when clicking outside
const handleClickOutside = (event) => {
    if (!event.target.closest(".relative")) {
        isDropdownOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", handleClickOutside);
});

// Calculate the currentPollVotes
const currentPollVotes = computed(() => {
    const currentPollTitle = props.rpolls[index.value].title;
    return props.votes.filter((vote) => vote.title === currentPollTitle);
});

// Calculate the total votes for the current poll
const totalVotesForCurrentPoll = computed(() => {
    if (currentPollVotes.value.length === 0) return 0;
    return currentPollVotes.value.reduce(
        (total, vote) => total + Number(vote.votes),
        0
    );
});
// const voteExist=ref(false);
// if(totalVotesForCurrentPoll > 0){
//     voteExist.value=true;
// }
// Function to calculate percentage
function calculatePercentage(votes) {
    if (totalVotesForCurrentPoll.value === 0) {
        return 0;
    }
    return ((votes / totalVotesForCurrentPoll.value) * 100).toFixed(2);
}

// Function to render the pie chart
let chartInstance = null;
function renderChart() {
    const ctx = document.getElementById("pollPieChart").getContext("2d");

    const data = {
        labels: currentPollVotes.value.map((vote) => vote.selectedOption),
        datasets: [
            {
                data: currentPollVotes.value.map((vote) =>
                    calculatePercentage(vote.votes)
                ),
                backgroundColor: colors,
                hoverOffset: 4,
            },
        ],
    };

    if (chartInstance) {
        chartInstance.destroy(); // Destroy previous chart instance before creating a new one
    }

    chartInstance = new Chart(ctx, {
        type: "pie",
        data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            const value = tooltipItem.raw;
                            return value + "%"; // Append % symbol to the value
                        },
                    },
                },
            },
        },
    });
}

// Watch for changes in the votes and update the chart
watch(currentPollVotes, () => {
    if (currentPollVotes.value.length > 0) {
        renderChart();
    }
});

// Run on initial load
onMounted(() => {
    if (currentPollVotes.value.length > 0) {
        renderChart();
    }
});

// Navigation between polls
const prevPoll = () => {
    if (index.value > 0) {
        index.value--;
        form.title = props.rpolls[index.value].title;
        form.selectedOption = null;
        if (chartInstance) {
            chartInstance.destroy(); // Destroy previous chart instance before creating a new one
        }
    }
};

const nextPoll = () => {
    if (index.value < props.rpolls.length - 1) {
        index.value++;
        form.title = props.rpolls[index.value].title;
        form.selectedOption = null;
        if (chartInstance) {
            chartInstance.destroy(); // Destroy previous chart instance before creating a new one
        }
    }
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
// function deletePoll() {

//     // Submit the form
//     router.delete(`/delete_poll/${form.poll_name}/${rpolls[index].id}`, form, {
//         onSuccess: () => {
//             loading.value = false;
//             toast.fire({
//                 icon: "success",
//                 title: "Poll created Successfully!!",
//                 customClass: {
//                     popup: "text-[#4363EC] rounded-lg shadow-md p-4", // Tailwind classes for background, text, and padding
//                     title: "font-semibold", // Tailwind class for title styling
//                     icon: "text-[#4363EC]", // Tailwind class for icon styling
//                 },
//             });
//             // Redirect or show success message if necessary
//         },

//     });
// }
function successMessage() {
    toast.fire({ icon: "warning", title: "Poll Deleting..." });
}
// Share link functionality
const shareLink = () => {
    const pollUrl = `${window.location.origin}/vote_page/?poll=${index.value}`;
    navigator.clipboard
        .writeText(pollUrl)
        .then(() => {
            alert("Poll link copied to clipboard!");
        })
        .catch((err) => {
            console.error("Failed to copy link: ", err);
        });
};
</script>

<style scoped>
canvas {
    width: 100%;
    height: 100%;
}
</style>
