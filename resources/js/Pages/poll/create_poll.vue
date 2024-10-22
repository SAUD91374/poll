<template>
    <main class="font-rajdhani max-w-screen-lg mx-auto">
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <div class="space-y-6">
                <!-- Form header and description -->
                <div>
                    <h3
                        class="text-3xl sm:text-5xl text-[#4363EC] font-semibold"
                    >
                        Create a Poll
                    </h3>
                    <p class="text-gray-600 text-xl sm:text-2xl mt-2 sm:mt-4">
                        Complete the below fields to create your poll.
                    </p>

                    <!-- Poll form -->
                    <form
                        @submit.prevent="submit"
                        enctype="multipart/form-data"
                        class="space-y-4 sm:space-y-6"
                    >
                        <!-- Title input -->
                        <div>
                            <label
                                for="title"
                                class="font-bold text-[#4363EC] block"
                                >Title</label
                            >
                            <input
                                type="text"
                                v-model="form.title"
                                @input="clearError('title')"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{ 'border-red-500': errors.title }"
                                placeholder="Your title here"
                            />
                            <span
                                v-if="props.errors.title"
                                class="text-red-600 text-sm"
                                >{{ props.errors.title }}</span
                            >
                        </div>

                        <!-- Description textarea -->
                        <div v-if="showDescription">
                            <label
                                for="description"
                                class="font-bold text-[#4363EC] block"
                                >Description</label
                            >
                            <textarea
                                v-model="form.description"
                                id="description"
                                class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                :class="{
                                    'border-red-500': errors.description,
                                }"
                                placeholder="Add a description here"
                                @input="clearError('description')"
                            ></textarea>
                            <span
                                v-if="props.errors.description"
                                class="text-red-500 text-sm"
                                >{{ props.errors.description }}</span
                            >

                        </div>
                        <div v-if="previewImage" class="relative mt-3">
                                <img
                                    :src="previewImage"
                                    alt="Image Preview"
                                    class="w-16 h-16 object-cover rounded-md shadow-md sm:w-52 sm:h-40"
                                />
                                <!-- Cross icon to remove the image -->
                                <button
                                    @click="removeImage"
                                    class="absolute top-0 left-20 bg-blue-500 sm:bg-gray-100 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-md sm:text-black sm:bottom-0 sm:right-0 sm:absolute sm:w-8 sm:h-8"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        <!-- File upload and description buttons -->
                        <div
                            class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4"
                        >

                            <div>
                                <label
                                    for="img"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10"
                                >
                                    <input
                                        @input="
                                            handleFileInput($event),
                                                clearError('image')
                                        "
                                        type="file"
                                        class="hidden"
                                        id="img"
                                        ref="fileInput"
                                    />
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-5"
                                        >+</span
                                    >
                                    <span class="pr-4">Add Image</span>
                                </label>

                                <!-- Error message -->
                                <span
                                    v-if="props.errors.image"
                                    class="text-red-500 text-sm"
                                >
                                    {{ props.errors.image }}
                                </span>
                            </div>

                            <button
                                @click="toggleDescription"
                                class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10"
                                type="button"
                            >
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3"
                                    >{{
                                        showDescription ? "&times;" : "+"
                                    }}</span
                                >
                                <span class="pr-4">{{
                                    showDescription
                                        ? "Remove Description"
                                        : "Add Description"
                                }}</span>
                            </button>
                        </div>

                        <!-- Method checkboxes -->
                        <div
                            class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4"
                        >
                            <div
                                class="flex items-center transition duration-500 ease-in-out transform hover:scale-105"
                                v-for="method in methods"
                                :key="method.id"
                            >
                                <input
                                    :id="method.name"
                                    v-model="form.method"
                                    type="radio"
                                    :value="method.name"
                                    class="mr-2"
                                />
                                <label
                                    :for="method.name"
                                    class="font-semibold text-[#4363EC] text-base sm:text-lg"
                                >
                                    {{ method.label }}
                                </label>
                            </div>
                        </div>

                        <!-- Answer options -->
                        <div>
                            <label class="text-[#4363EC] block"
                                >Answer Options</label
                            >
                            <div>
                                <!-- Options Loop -->
                                <div
                                    v-for="(option, index) in form.options"
                                    :key="index"
                                    class="mb-4 flex items-center justify-start relative"
                                >
                                    <input
                                        type="text"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                        :class="{
                                            'border-red-600':
                                                errors[`options.${index}`],
                                        }"
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

                                <!-- Conditionally Render "Other" Input Below Options -->
                                <div
                                    v-if="other"
                                    class="mb-4 flex items-center"
                                >
                                    <input
                                        type="text"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                                        placeholder="Other"
                                        v-model="form.others"
                                        @input="clearError('other')"
                                    />
                                    <span
                                        v-if="errors.others"
                                        class="text-red-500 text-sm"
                                    >
                                        {{ errors.other }}
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4"
                            >
                                <button
                                    type="button"
                                    @click="addOption"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10"
                                >
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3"
                                        >+</span
                                    >
                                    <span class="pr-4">Add Option</span>
                                </button>
                                <button
                                    type="button"
                                    @click="addOther"
                                    class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-sm h-9 leading-10"
                                >
                                    <span
                                        class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-3"
                                        >{{ other ? "&times;" : "+" }}</span
                                    >
                                    <span class="pr-4">{{
                                        other ? "Remove Other" : "Add Other"
                                    }}</span>
                                </button>
                            </div>
                            <span
                                v-if="props.errors.options"
                                class="text-red-500"
                                >{{ props.errors.options }}</span
                            >
                        </div>

                        <!-- Settings -->
                        <div v-if="showAdvancedSettings" class="space-y-4">
                            <span class="block text-[#4363EC]">Settings</span>
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
                                            :true-value="'On'"
                                            :false-value="'Off'"
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
                            <span class="block text-gray-700 font-semibold mb-2"
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
                        <div class="flex space-x-4 mb-6">
                            <button
                                type="button"
                                @click="toggleAdvancedSettings"
                                class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10"
                            >
                                <span
                                    class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-6"
                                    >+</span
                                >
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
    <Pagecontent />
</template>

<script setup>
import { ref, defineProps } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { useMethodWatcher, methods, checks } from "@/Components/watchmethod";
import Pagecontent from "@/Components/pagecontent.vue";
const form = useForm({
    title: "",
    image: "",
    description: "",
    method: "imagepoll",
    options: ["", ""],
    others: null,
    vote_per_ip: "Off",
    require_names: "Off",
    other_option_vote: "Off",
    other_option_results: "Off",
});

const showDescription = ref(false);
const other = ref(false); // New reactive property for adding "Other" option
const loading = ref(false);
const previewImage = ref(null); // for preview the image
const fileInput = ref(null); // Add a ref for the file input
const isImageUploaded = ref(false); //for check image is uploaded then the button change to remove
const showAdvancedSettings = ref(false); // New reactive property for advanced settings visibility

function addOption() {
    form.options.push("");
}
function addOther() {
    other.value = !other.value;
}

function deleteOption(index) {
    // Check if the number of options is greater than 2 before allowing deletion
    if (form.options.length > 2) {
        form.options.splice(index, 1);
    } else {
        // Optionally, you can notify the user that they cannot remove more options
        alert("You cannot remove the last two options.");
    }
}

function submit() {
    loading.value = true;

    // Submit the form
    router.post("/pollsubmit", form, {
        onFinish: () => {
            loading.value = false; // Turn off loading after completion
        },
        onSuccess: () => {
            loading.value = false;
            toast.fire({icon:"success",title:"Poll created Successfully!!"})
            // Redirect or show success message if necessary
        },
        onError: () => {
            loading.value = false; // Turn off loading if there's an error
        },
    });
}

function toggleDescription() {
    if (showDescription.value) {
        // If it's currently shown, reset the description
        form.description = ""; // Reset the description input value
    }
    showDescription.value = !showDescription.value; // Toggle the visibility
}

function toggleAdvancedSettings() {
    showAdvancedSettings.value = !showAdvancedSettings.value;
}

function handleFileInput(event) {
    const file = event.target.files[0];
    this.form.image = file;
    if (file) {
        previewImage.value = URL.createObjectURL(file); // Create a URL for the preview
        isImageUploaded.value = true; // Mark image as uploaded
    }
}

function removeImage() {
    previewImage.value = null; // Clear the image preview
    fileInput.value.value = ""; // Reset the file input value so the same image can be uploaded again
    isImageUploaded.value = false; // Reset the button text
}
const props = defineProps({
    errors: {
        type: Object,
        required: false, // Optional if there may be no errors initially
        default: () => ({}),
    },
});
// Watch each form field to remove specific error upon input change

const clearError = (field) => {
    if (props.errors[field]) {
        delete props.errors[field];
    }
};
// Method to reset the form
const resetForm = () => {
    form.reset();
};
// Watch the form for changes and update the method in the router
useMethodWatcher(form); // Call the watcher logic
</script>
<style></style>
