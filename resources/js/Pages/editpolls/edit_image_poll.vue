<template>
    <main class="font-rajdhani max-w-screen-md mx-auto p-2">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- <h1>{{ multiplepoll[0] }}</h1> -->
            <h3 class="text-4xl sm:text-5xl text-[#4363EC] font-semibold">
                Create a Poll
            </h3>
            <p class="text-gray-600 text-xl sm:text-2xl mt-4">
                Complete the below fields to create your poll.
            </p>
            <form
                @submit.prevent="submit(form.method, multiplepoll[0].id)"
                enctype="multipart/form-data"
                class="space-y-4"
                @inertia:preserve-scroll="true"
            >
                <!-- title area -->
                <div>
                    <label
                        for="title"
                        class="mt-2 font-semibold block text-[#4363EC]"
                        >Title</label
                    >
                    <input
                        type="text"
                        v-model="form.title"
                        @input="clearError('title')"
                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                        :class="{ 'border-red-500': errors.title }"
                        name="title"
                        id="title"
                        placeholder="Your question here"
                    />
                    <span
                        v-if="props.errors.title"
                        class="text-red-600 text-m"
                        >{{ props.errors.title }}</span
                    >
                </div>

                <!-- Description textarea -->
                <transition name="fade" mode="in-out">
                    <div v-if="showDescription">
                        <label
                            for="description"
                            class="mt-2 font-bold block text-[#4363EC]"
                            >Description</label
                        >
                        <textarea
                            v-model="form.description"
                            id="description"
                            class="border-l-[3px] border-0 border-[#4363EC] rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                            :class="{ 'border-red-500': errors.description }"
                            placeholder="Add a description here"
                            @input="clearError('description')"
                        ></textarea>
                        <span
                            v-if="props.errors.description"
                            class="text-red-500 text-sm"
                            >{{ props.errors.description }}</span
                        >
                    </div>
                </transition>
                <!-- File upload and description buttons -->
                <div
                    class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4"
                >
                    <button
                        type="button"
                        @click="toggleDescription"
                        class="bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10"
                    >
                        <span
                            class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-6"
                            >{{ showDescription ? "&times;" : "+" }}</span
                        >
                        <span class="pr-4">{{
                            showDescription
                                ? "Remove Description"
                                : "Add Description"
                        }}</span>
                    </button>
                </div>

                <div>
                    <label
                        for="layout"
                        class="mt-2 font-semibold block text-[#4363EC]"
                        >Layout</label
                    >
                    <select
                        v-model="form.layout"
                        class="w-full px-3 py-2 border-l-[3px] border-0 border-[#4363EC] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300"
                    >
                        <option
                            v-if="multiplepoll[0].layout == 'grid'"
                            value="grid"
                        >
                            Grid
                        </option>
                        <option
                            v-if="multiplepoll[0].layout == 'list'"
                            value="list"
                        >
                            List
                        </option>
                    </select>
                </div>

                <div>
                    <label class="mt-2 font-semibold block text-[#4363EC]"
                        >Options</label
                    >

                    <!-- Loop through the image options and display them in a 2-column grid -->
                    <div
                        v-if="form.layout == 'grid'"
                        class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-6"
                    >
                        <div
                            v-for="(image, index) in image"
                            :key="index"
                            class="relative flex items-center"
                        >
                            <label
                                class="flex flex-col items-center justify-center bg-white border-t-4 border-[#4363EC] rounded-lg shadow-lg cursor-pointer w-full sm:w-[224px] sm:h-[156px] px-2 py-4 relative"
                            >
                                <input
                                    @input="clearError(`images.${index}`)"
                                    type="file"
                                    :id="`file-upload-${index}`"
                                    accept="image/*"
                                    class="hidden"
                                    @change="
                                        (event) =>
                                            handleImageUpload(event, index)
                                    "
                                />
                                <!-- Show uploaded image or default placeholder -->
                                <img
                                    v-if="
                                        image.src ||
                                        (typeof image === 'string' && image)
                                    "
                                    :src="image.src || `/photos/${image}`"
                                    alt="Uploaded Image"
                                    class="object-fill w-44 h-28 rounded-md"
                                />
                                <img
                                    v-else
                                    src="/assets/images/upload_images.png"
                                    alt="Upload Image"
                                    class="w-10 h-10 mb-2"
                                />

                                <span
                                    class="text-[#4363EC] font-Rajdhani text-s font-bold capitalize"
                                    >{{ `Option ${index + 1}` }}</span
                                >
                            </label>

                            <span
                                v-if="props.errors[`images.${index}`]"
                                class="text-red-500 text-sm ml-2"
                                >{{ props.errors[`images.${index}`] }}</span
                            >
                            <span
                                v-if="index >= 2"
                                @click.stop="deleteImage(index)"
                                class="absolute top-2 right-2 text-xl cursor-pointer text-[#4363EC] z-10"
                                >&#10005;</span
                            >
                        </div>
                    </div>
                    <!-- Show the options section if a list layout is selected -->
                    <!-- list layout -->
                    <div>
                        <div
                            class="flex flex-col space-y-4"
                            v-if="form.layout == 'list'"
                        >
                            <div
                                v-for="(image, index) in image"
                                :key="index"
                                class="flex border border-[#4363EC] rounded-lg shadow-md p-2"
                            >
                                <label class="flex items-center mr-4">
                                    <input
                                        @input="clearError(`images.${index}`)"
                                        type="file"
                                        :id="`file-upload-${index}`"
                                        accept="image/*"
                                        class="hidden"
                                        @change="
                                            (event) =>
                                                handleImageUpload(event, index)
                                        "
                                    />
                                    <!-- Show uploaded image or default placeholder -->
                                    <img
                                        v-if="image.src || image.image"
                                        :src="
                                            image.src ||
                                            `/photos/${image.image}`
                                        "
                                        alt="Uploaded Image"
                                        loading="lazy"
                                        class="sm:w-44 sm:h-auto object-cover mx-2 rounded-lg"
                                    />
                                    <img
                                        v-else
                                        src="/assets/images/upload_images.png"
                                        alt="Upload Image"
                                        class="w-14 h-14 object-contain mx-2"
                                    />
                                </label>
                                <div class="flex flex-col w-full">
                                    <input
                                        type="text"
                                        v-model="image.title"
                                        placeholder="Title (optional)"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg p-2 mb-5"
                                    />
                                    <textarea
                                        v-model="image.description"
                                        placeholder="Description (optional)"
                                        class="border-l-[3px] border-0 border-[#4363EC] rounded-lg p-2"
                                        rows="2"
                                    ></textarea>
                                </div>

                                <div>
                                    <span
                                        v-if="index >= 2"
                                        @click="deleteImage(index)"
                                        class="font-semibold m-2 ml-6 text-lg cursor-pointer text-[#4363EC]"
                                        >&#10005;</span
                                    >
                                </div>
                            </div>
                            <div class="flex">
                                <span
                                    v-if="props.errors[`images.${index}`]"
                                    class="text-red-500 text-sm ml-2"
                                    >{{ props.errors[`images.${index}`] }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <!-- Add Image Button -->
                    <div class="flex">
                        <button
                            type="button"
                            @click="addImage"
                            class="mt-5 bg-white font-semibold text-[#4363EC] rounded-lg flex items-center cursor-pointer shadow-lg text-s h-9 leading-10"
                        >
                            <span
                                class="flex items-center justify-center bg-[#4363EC] text-white rounded-l-lg w-8 h-9 text-2xl mr-6"
                                >+</span
                            >
                            <span class="pr-4">Add Option</span>
                        </button>
                    </div>
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

                <div class="sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
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
    </main>

    <Pagecontent />
</template>

<script setup>
import { ref, defineProps, reactive, watch } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { checks } from "@/Components/watchmethod";
import Pagecontent from "@/Components/pagecontent.vue";
import Swal from 'sweetalert2';

const props = defineProps({
    errors: {
        type: Object,
        required: false, // Optional if there may be no errors initially
        default: () => ({}),
    },
    multiplepoll: Object,
});
// Determine which image array to use based on layout
const image = ref(
    props.multiplepoll[0].layout === "grid"
        ? JSON.parse(props.multiplepoll[0].images)
        : JSON.parse(props.multiplepoll[0].images_list)
);
// Define form data with reactive object
const form = useForm({
    title: props.multiplepoll[0].title,
    description: props.multiplepoll[0].description,
    layout: props.multiplepoll[0].layout,
    method: "multiplepoll",
    vote_per_ip: props.multiplepoll[0]?.vote_per_ip || "off",
    require_names: props.multiplepoll[0]?.require_names || "off",
    other_option_vote: props.multiplepoll[0]?.other_option_vote || "off",
    other_option_results: props.multiplepoll[0]?.other_option_results || "off",
    images: image
});

const loading = ref(false);
const errors = ref({}); // Error object to hold validation errors
const previewImage = ref(null);

const index = ref(0);
function submit(pollType, id) {
    loading.value = true;

    // Submit the form
    router.post(`/update_poll/${pollType}/${id}`, 
    {
        _method: 'put',
        title: form.title,
        description: form.description,
        method: form.method,
        layout: form.layout,
        vote_per_ip: form.vote_per_ip,
        require_names: form.require_names,
        other_option_vote: form.other_option_vote,
        other_option_results: form.other_option_results,
        images: form.images,
    }, {
        onFinish: () => {
            loading.value = false; // Turn off loading after completion
        },
        onSuccess: () => {
            loading.value = false;
            
            // Show SweetAlert success message
            Swal.fire({
                title: 'Success!',
                text: 'Poll updated successfully',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4363EC'
            }).then(() => {
                // Use Inertia router for SPA navigation instead of window.location
                router.visit('/multiple_vote_page');
            });
        },
        onError: (errors) => {
            loading.value = false; // Turn off loading if there's an error
            
            // Show error message if needed
            if (Object.keys(errors).length > 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please check the form for errors',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4363EC'
                });
            }
        },
    });
}

// Method to add a new image option
function addImage() {
    const newImage = {
        file: null,
        src: null,
    };
    image.value.push(newImage);
    form.images.push(newImage);
}

//this function handle the preview of uploaded image in options
function handleImageUpload(event, index) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const newImage = {
                file: file,
                src: e.target.result,
                title: form.images[index].title, // Retain title and description if needed
                description: form.images[index].description,
            };
            image.value[index] = newImage; // Update image array
            form.images[index] = newImage; // Update form array
        };
        reader.readAsDataURL(file);
    }
}

// Method to delete an image option
function deleteImage(index) {
    // Check if the number of options is greater than 2 before allowing deletion
    if (image.value.length > 2) {
        image.value.splice(index, 1); // Remove the image from images array at the specific index
        form.images.splice(index, 1); // Remove the image from form images array at the specific index
    }
}

const showDescription = ref(false);
if (props.multiplepoll[0].description) {
    showDescription.value = true;
}
// Method to toggle description visibility
function toggleDescription() {
    if (showDescription.value) {
        // If it's currently shown, reset the description
        form.description = ""; // Reset the description input value
    }
    showDescription.value = !showDescription.value; // Toggle the visibility
}

const showAdvancedSettings = ref(false);
if (
    props.multiplepoll[0]?.vote_per_ip == "on" ||
    props.multiplepoll[0]?.require_names == "on" ||
    props.multiplepoll[0]?.other_option_vote == "on" ||
    props.multiplepoll[0]?.other_option_results == "on"
) {
    showAdvancedSettings.value = true;
}
// Method to toggle advanced settings visibility
function toggleAdvancedSettings() {
    showAdvancedSettings.value = !showAdvancedSettings.value;
}

// Watch each form field to remove specific error upon input change

// Watch each form field to remove specific error upon input change

const clearError = (field) => {
    // Implement your error clearing logic
    // Example: If using `props.errors`, ensure to define `props` in the setup context
    delete props.errors[field];
};
// Method to reset the form
const resetForm = () => {
    Object.assign(form, {
        title: "",
        description: "",
        images: ["", ""],
        others: false,
        vote_per_ip: false,
        require_names: false,
        other_option_vote: false,
        other_option_results: "",
    });
};
</script>

<style scoped>
.fade-leave-active,
.fade-enter-active {
    transition: opacity 0.5s ease-in-out;
}
.fade-leave-to /* .fade-leave-active in versions <2.1.8 */ {
    opacity: 0;
}
</style>
