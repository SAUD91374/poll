<template>
    <main class="font-rajdhani max-w-screen-md mx-auto p-2">
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- {{rankingpoll}} -->
            <div class="space-y-4 sm:space-y-6">
                <!-- Form header and description -->
                <div>
                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl text-[#4363EC] font-semibold"
                    >
                        Create a Poll
                    </h3>
                    <p
                        class="text-base sm:text-lg lg:text-2xl text-gray-600 mt-2 sm:mt-4"
                    >
                        Complete the below fields to create your poll.
                    </p>
                    <form
                        @submit.prevent="submit(form.method, rankingpoll[0].id)"
                        class="space-y-4 sm:space-y-6"
                    >
                        <!-- Title input -->
                        <div>
                            <label
                                for="title"
                                class="mt-2 font-bold block text-[#4363EC] text-base sm:text-lg"
                            >
                                Title
                            </label>
                            <input
                                type="text"
                                v-model="form.title"
                                @input="clearError('title')"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full text-base sm:text-lg focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{ 'border-red-500': errors.title }"
                                name="title"
                                id="title"
                                placeholder="Your question here"
                            />
                            <span
                                v-if="props.errors.title"
                                class="text-red-600 text-sm"
                            >
                                {{ props.errors.title }}
                            </span>
                        </div>

                        <!-- Description textarea -->
                        <div>
                            <label
                                for="description"
                                class="mt-2 font-bold block text-[#4363EC] text-base sm:text-lg"
                            >
                                Description
                            </label>
                            <textarea
                                v-model="form.description"
                                id="description"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full text-base sm:text-lg focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{
                                    'border-red-500': errors.description,
                                }"
                                placeholder="Add a description here"
                                @input="clearError('description')"
                            ></textarea>
                            <span
                                v-if="props.errors.description"
                                class="text-red-500 text-sm"
                            >
                                {{ props.errors.description }}
                            </span>
                        </div>

                        <!-- Answer options -->
                        <div>
                            <label
                                class="mt-2 font-bold block text-[#4363EC] text-base sm:text-lg"
                            >
                                Answer Options
                            </label>
                            <div
                                v-for="(option, index) in options"
                                :key="index"
                                class="mb-4 flex items-center justify-between relative"
                            >
                                <input
                                    type="text"
                                    class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full text-base sm:text-lg focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    :class="{
                                        'border-red-600':
                                            errors[`options.${index}`],
                                    }"
                                    :name="`option[${index}]`"
                                    :id="`option${index}`"
                                    :placeholder="`Option ${index + 1}`"
                                    v-model="form.options[index]"
                                    @input="clearError(`options.${index}`)"
                                />
                                <span
                                    v-if="index >= 2"
                                    @click="deleteOption(index)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-[#4363EC]"
                                >
                                    &#10005;
                                </span>
                                <span
                                    v-if="errors[`options.${index}`]"
                                    class="text-red-500 text-sm"
                                >
                                    {{ errors[`options.${index}`] }}
                                </span>
                            </div>

                            <button
                                type="button"
                                @click="addOption"
                                class="mt-2 bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10"
                            >
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-4"
                                >
                                    +
                                </span>
                                <span class="pr-4">Add Option</span>
                            </button>
                            <span
                                v-if="props.errors.options"
                                class="text-red-500 text-sm"
                            >
                                {{ props.errors.options }}
                            </span>
                        </div>

                        <!-- Settings toggles -->
                        <div v-if="showAdvancedSettings" class="space-y-4">
                            <span class="font-bold text-[#4363EC] block">Settings</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div
                                    class="flex items-center border-l-[3px] border-[#4363EC] bg-white rounded-lg shadow-md h-11"
                                    v-for="check in checks"
                                    :key="check.id"
                                >
                                    <div class="flex-1 pl-3 ml-2">
                                        <span class="text-gray-800">{{
                                            check.label
                                        }}</span>
                                    </div>
                                    <label
                                        class="relative inline-flex items-center cursor-pointer"
                                    >
                                        <input
                                            :id="check.name"
                                            type="checkbox"
                                            v-model="form[check.name]"
                                            :true-value="'on'"
                                            :false-value="'off'"
                                            class="sr-only peer"
                                        />
                                        <div
                                            class="w-8 h-4 bg-gray-300 rounded-full peer-checked:bg-[#1A73E8] transition-colors duration-400 mr-2"
                                        ></div>
                                        <div
                                            class="absolute left-0 top-0 h-4 w-4 bg-white border rounded-full shadow transform peer-checked:translate-x-full transition-transform duration-300 mr-2"
                                        ></div>
                                    </label>
                                </div>
                            </div>

                            <!-- Voting restrictions -->
                            <span class="font-bold text-[#4363EC] block mb-2"
                                >Voting restrictions</span
                            >
                            <div>
                                <select
                                    class="border-l-[3px] border-[#4363EC] bg-white text-[#4363EC] rounded-lg px-4 py-2 w-full"
                                >
                                    <option>One Vote per Ip address</option>
                                    <option>Require Participants Names</option>
                                </select>
                            </div>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-6"
                        >
                            <button
                                type="button"
                                @click="toggleAdvancedSettings"
                                class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10"
                            >
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-4"
                                >
                                    +
                                </span>
                                <span class="pr-4">{{
                                    showAdvancedSettings
                                        ? "Hide Advanced Settings"
                                        : "Show Advanced Settings"
                                }}</span>
                            </button>
                        </div>
                        <!-- Common buttons for form -->

                        <div
                            class="sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4"
                        >
                            <button
                                type="submit"
                                class="bg-blue-600 text-white rounded-full text-xl px-6 py-3 shadow-xl mr-1 transition duration-500 ease-in-out transform hover:scale-110"
                                :disabled="loading"
                            >
                                <span v-if="!loading">Create Poll</span>
                                <span v-if="loading">
                                    <!-- Simple Spinner -->
                                    <div
                                        class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin"
                                    ></div>
                                </span>
                            </button>
                            <button
                                type="button"
                                class="bg-white text-[#4363EC] rounded-full text-xl px-6 py-3 shadow-xl transition duration-500 ease-in-out transform hover:scale-105"
                            >
                                View examples
                            </button>

                            <!-- Reset Button -->
                            <button
                                type="button"
                                @click="resetForm"
                                class="rounded-full mx-2 px-4 py-3 shadow-md bg-[#4363EC] text-white font-semibold ring-1 ring-transparent transition hover:bg-gray-100 hover:text-red-500"
                            >
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Common Page Content -->
    <Pagecontent />
</template>

<script setup>
import { ref, defineProps, onMounted, watch } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { checks } from "@/Components/watchmethod";
import Pagecontent from "@/Components/pagecontent.vue";

const props = defineProps({
    errors: {
        type: Object,
        required: false, // Optional if there may be no errors initially
        default: () => ({}),
    },
    rankingpoll: Object,
});

const form = useForm({
    title: props.rankingpoll[0].title,
    description: props.rankingpoll[0].description,
    method: "rankingpoll",
    options: ["", ""],
    vote_per_ip: props.rankingpoll[0]?.vote_per_ip || "off",
    require_names: props.rankingpoll[0]?.require_names || "off",
    other_option_vote: props.rankingpoll[0]?.other_option_vote || "off",
    other_option_results: props.rankingpoll[0]?.other_option_results || "off",
});

const showDescription = ref(false);
const showAdvancedSettings = ref(false);
const options = ref(JSON.parse(props.rankingpoll[0].options));
onMounted(() => {
    form.options = [...options.value]; // Copy options to form
});
function addOption() {
    options.value.push("");
    form.options.push("");
}

function deleteOption(index) {
    // Check if the number of options is greater than 2 before allowing deletion
    if (form.options.length > 2) {
        options.value.splice(index, 1);
        form.options.splice(index, 1);
    } else {
        // Optionally, you can notify the user that they cannot remove more options
        alert("You cannot remove the last two options.");
    }
}

const loading = ref(false);
function submit(pollType, id) {
    loading.value = true;
console.log(form);

    // Submit the form
    router.put(`/update_poll/${pollType}/${id}`, form, {
        onFinish: () => {
            loading.value = false; // Turn off loading after completion
        },
        onSuccess: () => {
            loading.value = false;
            toast.fire({icon:"success",title:"Poll updated Successfully!!!"})
            router.visit('/vote_page');
            // Redirect or show success message if necessary
        },
        onError: () => {
            loading.value = false; // Turn off loading if there's an error
        },
    });
}

function toggleDescription() {
    showDescription.value = !showDescription.value;
}
if (props.rankingpoll[0].description) {
    showDescription.value = true;
}

function toggleAdvancedSettings() {
    showAdvancedSettings.value = !showAdvancedSettings.value;
}

if (
    props.rankingpoll[0]?.vote_per_ip == "on" ||
    props.rankingpoll[0]?.require_names == "on" ||
    props.rankingpoll[0]?.other_option_vote == "on" ||
    props.rankingpoll[0]?.other_option_results == "on"
) {
    showAdvancedSettings.value = true;
}
// Watch each form field to remove specific error upon input change
const clearError = (field) => {
    if (props.errors[field]) {
        delete props.errors[field];
    }
};
// Method to reset the form
const resetForm = () => {
    Object.assign(form, {
        title: "",
        description: "",
        options: ["", ""],
        vote_per_ip: false,
        require_names: false,
        other_option_vote: false,
        other_option_results: "",
    });
};
</script>
