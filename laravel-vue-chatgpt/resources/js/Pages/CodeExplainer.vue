<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import markdownIt from 'markdown-it';

const prompt = ref(null);
const loading = ref(false);
const result = ref(null);

const explainCode = () => {
    const code = prompt.value.trim();

    if (!code) {
        return;
    }

    if (loading.value) {
        return;
    }

    loading.value = true;

    axios.post('/code-explainer', {
        code: code,
    })
    .then((response) => {
        result.value = markdownIt().render(response.data.text);
    })
    .finally(() => {
        loading.value = false;
    })
};
</script>

<template>
    <AppLayout title="Code Explainer">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Code Explainer
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between p-4 space-x-4">
                        <div class="w-6/12 flex flex-col">
                            <textarea v-model="prompt" rows="10" class="w-full p-2 rounded-md"
                                placeholder="Enter your code here">
                            </textarea>
                            <button @click.prevent="explainCode" class="bg-blue-500 text-white flex justify-center p-2 rounded-md mt-4">
                                <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span v-else>Explain</span>
                            </button>
                        </div>
                        <div class="w-6/12">
                            <div>Code Explanation:</div>
                            <div class="mt-4 text-gray-800 font-semibold prose" v-html="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
