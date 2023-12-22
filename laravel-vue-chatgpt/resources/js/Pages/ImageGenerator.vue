<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { ref } from 'vue';

const prompt = ref(null);
const generatedImages = ref(null);
const loading = ref(false);

const generateImage = () => {
    const searchText = prompt.value.trim();

    if (!searchText) {
        return;
    }

    if (loading.value) {
        return;
    }

    loading.value = true;

    axios.post('/image-generator', {
        prompt: searchText
    })
    .then(response => {
        generatedImages.value = response.data.images.data;
    })
    .finally(() => {
        loading.value = false;
    });
};
</script>

<template>
    <AppLayout title="Image Generator">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Image Generator
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Main container -->
                    <div class="pt-8 bg-white flex flex-col justify-center items-center">
                        <!-- Title -->
                        <h1 class="text-2xl font-bold text-gray-800 mb-8">AI-Powered Image Generator</h1>

                        <!-- Form -->
                        <form @submit.prevent="generateImage" class="w-1/2">
                            <!-- Text input -->
                            <div class="mb-4">
                                <label for="text" class="block text-gray-700 font-bold mb-2">Text</label>
                                <div class="flex space-x-2">
                                    <input v-model="prompt" type="text" id="text"
                                        placeholder="panda mad scientist mixing sparkling chemicals, digital art"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <!-- Generate button -->
                                    <button type="submit" :disabled="loading"
                                        class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span>Generate</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Image preview -->
                        <div class="mt-4 relative w-1/2 h-1/2 mb-8">
                            <img v-for="image in generatedImages" :src="image.url" alt="Generated image"
                                class="w-full h-full rounded-lg object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
