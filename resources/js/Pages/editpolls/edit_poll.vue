<template>
    <main class="font-rajdhani max-w-screen-md mx-auto">
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <div class="space-y-6">
                <!-- Form header and description -->
                <div>
                    <h3 class="text-3xl sm:text-5xl text-[#4363EC] font-semibold">
                        Create a Poll
                    </h3>
                    <p class="text-gray-600 text-xl sm:text-2xl mt-2 sm:mt-4">
                        Complete the below fields to create your poll.
                    </p>
                    <!-- Poll form -->
                    <form @submit.prevent="submit(form.method, imagepoll[0].id)" enctype="multipart/form-data"
                        class="space-y-4 sm:space-y-6">
                        <!-- Title input -->
                        <div>
                            <label for="title" class="font-bold text-[#4363EC] block">Title</label>
                            <input type="text" v-model="form.title" @input="clearError('title')"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{ 'border-red-500': errors.title }" placeholder="Your title here" />
                            <span v-if="props.errors.title" class="text-red-600 text-sm">{{ props.errors.title }}</span>
                        </div>

                        <!-- Description textarea -->
                        <div v-if="showDescription">
                            <label for="description" class="font-bold text-[#4363EC] block">Description</label>
                            <textarea v-model="form.description" id="description"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{
                                    'border-red-500': errors.description,
                                }" placeholder="Add a description here" @input="clearError('description')"></textarea>
                            <span v-if="props.errors.description" class="text-red-500 text-sm">{{
                                props.errors.description }}</span>
                        </div>
                        <div class="relative mt-3" v-if="previewImage || form.image">
                            <img :src="previewImage || `/photos/${form.image}`
                                " alt="Image Preview"
                                class="w-52 h-auto object-cover rounded-md shadow-md sm:w-52 sm:h-auto" />
                        </div>

                        <!-- File upload and description buttons -->
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <div>
                                <label for="img"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10">
                                    <input @change="
                                        handleFileInput($event),
                                        clearError('image')
                                        " type="file" class="hidden" id="img" ref="fileInput" />
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-5">+</span>
                                    <span class="pr-4">Update Image</span>
                                </label>

                                <!-- Error message -->
                                <span v-if="props.errors.image" class="text-red-500 text-sm">
                                    {{ props.errors.image }}
                                </span>
                            </div>

                            <button @click="toggleDescription"
                                class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10"
                                type="button">
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3">{{
                                        showDescription ? "&times;" : "+"
                                    }}</span>
                                <span class="pr-4">{{
                                    showDescription
                                        ? "Remove Description"
                                        : "Add Description"
                                }}</span>
                            </button>
                        </div>
                        <!-- Answer options -->
                        <div>
                            <label class="font-bold text-[#4363EC] block">Answer Options</label>
                            <div>
                                <!-- Options Loop -->
                                <div v-for="(option, index) in options" :key="index"
                                    class="mb-4 flex items-center justify-start relative">
                                    <input type="text"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                        :class="{
                                            'border-red-600':
                                                errors[`options.${index}`],
                                        }" :placeholder="`Option ${index + 1}`" v-model="form.options[index]"
                                        @input="clearError(`options.${index}`)" />
                                    <span v-if="index >= 2" @click="deleteOption(index)"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-[#4363EC]">
                                        &#10005;
                                    </span>
                                    <span v-if="errors[`options.${index}`]" class="text-red-500 text-sm">
                                        {{ errors[`options.${index}`] }}
                                    </span>
                                </div>

                                <!-- Conditionally Render "Other" Input Below Options -->
                                <div v-if="other" class="mb-4 flex items-center">
                                    <input type="text"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                        placeholder="Other" v-model="form.others" @input="clearError('other')" />
                                    <span v-if="errors.others" class="text-red-500 text-sm">
                                        {{ errors.other }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                <button type="button" @click="addOption"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10">
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3">+</span>
                                    <span class="pr-4">Add Option</span>
                                </button>
                                <button type="button" @click="addOther"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10">
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3">{{
                                        other ? "&times;" : "+" }}</span>
                                    <span class="pr-4">{{
                                        other ? "Remove Other" : "Add Other"
                                        }}</span>
                                </button>
                            </div>
                            <span v-if="props.errors.options" class="text-red-500">{{ props.errors.options }}</span>
                        </div>

                        <!-- Settings -->
                        <div v-if="showAdvancedSettings" class="space-y-4">
                            <span class="font-bold text-[#4363EC] block">Settings</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center border-l-[3px] border-[#4363EC] bg-white rounded-lg shadow-md h-11"
                                    v-for="check in checks" :key="check.id">
                                    <div class="flex-1 pl-3 ml-2">
                                        <span class="text-gray-800">{{
                                            check.label
                                            }}</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input :id="check.name" type="checkbox" v-model="form[check.name]"
                                            class="sr-only peer" :true-value="'on'" :false-value="'off'" />
                                        <div
                                            class="w-8 h-4 bg-gray-300 rounded-full peer-checked:bg-[#1A73E8] transition-colors duration-400 mr-2">
                                        </div>
                                        <div
                                            class="absolute left-0 top-0 h-4 w-4 bg-white border rounded-full shadow transform peer-checked:translate-x-full transition-transform duration-300 mr-2">
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Voting restrictions -->
                            <span class="font-bold text-[#4363EC] block mb-2">Voting restrictions</span>
                            <div>
                                <select
                                    class="border-l-[3px] border-0 border-[#4363EC] bg-white text-[#4363EC] rounded-lg px-4 py-2 w-full">
                                    <option>One Vote per Ip address</option>
                                    <option>Require Participants Names</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex space-x-4 mb-6">
                            <button type="button" @click="toggleAdvancedSettings"
                                class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10">
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-6">+</span>
                                <span class="pr-4">{{
                                    showAdvancedSettings
                                        ? "Hide Advanced Settings"
                                        : "Show Advanced Settings"
                                }}</span>
                            </button>
                        </div>
                        <!-- Common buttons for form -->
                        <div class="sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded-full text-xl px-6 py-3 shadow-xl mr-1 transition duration-500 ease-in-out transform hover:scale-110"
                                :disabled="loading">
                                <span v-if="!loading">Create Poll</span>
                                <span v-if="loading">
                                    <!-- Simple Spinner -->
                                    <div
                                        class="w-5 h-5 border-2 border-t-transparent border-white rounded-full animate-spin">
                                    </div>
                                </span>
                            </button>
                            <button type="button"
                                class="bg-white text-[#4363EC] rounded-full text-xl px-6 py-3 shadow-xl transition duration-500 ease-in-out transform hover:scale-105">
                                View examples
                            </button>

                            <!-- Reset Button -->
                            <button type="button" @click="resetForm"
                                class="rounded-full mx-2 px-4 py-3 shadow-md bg-[#4363EC] text-white font-semibold ring-1 ring-transparent transition hover:bg-gray-100 hover:text-red-500">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <Pagecontent />
</template>

<script setup>
import { ref, defineProps, onMounted, reactive, watch } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { checks } from "@/Components/watchmethod";
import Pagecontent from "@/Components/pagecontent.vue";

const props = defineProps({
    errors: {
        type: Object,
        required: false,
        default: () => ({}),
    },
    imagepoll: Object,
});

// Initialize the form as a reactive object
const form = useForm({
    title: props.imagepoll[0].title,
    image: props.imagepoll[0].image,
    description: props.imagepoll[0].description,
    method: "imagepoll",
    options: ["", ""],
    others: "",
    vote_per_ip: props.imagepoll[0]?.vote_per_ip,
    require_names: props.imagepoll[0]?.require_names,
    other_option_vote: props.imagepoll[0]?.other_option_vote,
    other_option_results: props.imagepoll[0]?.other_option_results,
});
// Define other reactive properties
const showDescription = ref(false);
// const showOtherOption = ref(false);
const loading = ref(false);
const previewImage = ref(null);
const fileInput = ref(null);
// const isImageUploaded = ref(false);
const showAdvancedSettings = ref(false);
const other = ref(false); // New reactive property for adding "Other" option
const options = ref(JSON.parse(props.imagepoll[0].options));

// Function to toggle additional "Other" option
function addOther() {
    other.value = !other.value;
    if (other.value) {
        form.others = null;
    }
}
// Delete a specific option
function deleteOption(index) {
    options.value.splice(index, 1);
    form.options.splice(index, 1);
}

// Add a new option
function addOption() {
    options.value.push("");
    form.options.push("");
}
function handleFileInput(event) {

    const file = event.target.files[0];

    form.image = file;
    console.log(form.image);

    if (file) {
        previewImage.value = URL.createObjectURL(file); // Create a URL for the preview
    }
}

// Submit the form
function submit(pollType, id) {
    loading.value = true; // Start loading before submission
    router.post(`/update_poll/${pollType}/${id}`, {
        _method: 'put',
        title: form.title,
        description: form.description,
        method: form.method,
        image: form.image,
        options: form.options,
        others: form.others,
        vote_per_ip: form.vote_per_ip,
        require_names: form.require_names,
        other_option_vote: form.other_option_vote,
        other_option_results: form.other_option_results,
    }
        , {
            onFinish: () => {
                loading.value = false; // Stop loading after completion
            },
            onSuccess: () => {
                loading.value = false;
                toast.fire({
                    icon: "success",
                    title: "Poll Updated <h1>SuccessFully!!!</h1>",
                });
                router.visit("/images_vote_page");
                // Handle success, e.g., redirect or show a message
            },
            onError: (error) => {
                loading.value = false;
                console.error(error);
                // Show error messages in UI if necessary
            },
        });
}
//if description have a value then open it
if (props.imagepoll[0].description) {
    showDescription.value = true;
}
// Toggle description visibility
function toggleDescription() {
    if (showDescription.value) {
        form.description = ""; // Reset if hidden
    }
    showDescription.value = !showDescription.value;
}
// Toggle advanced settings
function toggleAdvancedSettings() {
    showAdvancedSettings.value = !showAdvancedSettings.value;
}
//if advanced setting have a value
if (
    props.imagepoll[0]?.vote_per_ip == "on" ||
    props.imagepoll[0]?.require_names == "on" ||
    props.imagepoll[0]?.other_option_vote == "on" ||
    props.imagepoll[0]?.other_option_results == "on"
) {
    showAdvancedSettings.value = true;
}
// Handle file input

// Initialize options on mount
onMounted(() => {
    form.options = [...options.value]; // Copy options to form
});

// Clear specific error
const clearError = (field) => {
    if (props.errors[field]) {
        delete props.errors[field];
    }
};

// Reset the form to its initial state
const resetForm = () => {
    Object.assign(form, {
        title: "",
        image: null,
        description: "",
        options: ["", ""],
        others: false,
        vote_per_ip: false,
        require_names: false,
        other_option_vote: false,
        other_option_results: false,
    });
    previewImage.value = null; // Reset the image preview
};
</script>

<style></style>
