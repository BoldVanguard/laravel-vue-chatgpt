<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import markdownIt from 'markdown-it';

defineProps({
    nameInitial: String,
});

const message = ref(null);
const conversations = ref([]);
const loading = ref(false);
const scrollerContent = ref(null);
const messageInput = ref(null);

const handleSubmit = (e) => {
    const key = e.key;
    if (key === 'Enter' && ! e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }

    if (! key) { sendMessage(); }
};

const sendMessage = () => {
    const msg = message.value.trim();

    if (!msg) {
        return;
    }

    if (loading.value) {
        return;
    }

    message.value = '';
    loading.value = true;
    conversations.value.push(msg);

    axios.post('/conversations', {
        message: msg,
    })
    .then((response) => {
        conversations.value.push(markdownIt().render(response.data.text));
    })
    .finally(() => {
        loading.value = false;
    })
};
</script>

<template>
    <AppLayout title="Chatbot">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chatbot
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-100 h-screen flex flex-col">
                        <div class="bg-white px-4 py-6 border-b border-gray-200 flex-none">
                            <h1 class="text-xl font-bold text-gray-800">AI Chatbot</h1>
                        </div>
                        <div class="overflow-y-scroll flex-1 scroller">
                            <div class="px-4 py-6 scroller-content" ref="scrollerContent">
                                <template v-for="(conversation, index) in conversations" :key="index">
                                    <div v-if="index % 2" class="mb-4">
                                        <div class="bg-gray-200 rounded p-4 flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-500 flex justify-center items-center text-white">
                                                AI</div>
                                            <div class="ml-4 text-gray-800 font-semibold prose" v-html="conversation">
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else class="mb-4">
                                        <div class="bg-gray-300 rounded-full p-4 flex items-center justify-end">
                                            <div class="mr-4 text-gray-800 font-semibold">{{ conversation }}</div>
                                            <div
                                                class="w-8 h-8 rounded-full bg-gray-600 flex justify-center items-center text-white">
                                                {{ nameInitial }}
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div v-if="loading" class="mb-4">
                                    <div class="bg-gray-200 rounded p-4 flex items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-500 flex justify-center items-center text-white">
                                            AI</div>
                                        <div class="ml-4 text-gray-800 text-4xl font-semibold animate-bounced">
                                            <div class="ml-4 dot-flashing"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 py-6 flex-none">
                            <form @submit.prevent="handleSubmit">
                                <div class="relative rounded-md shadow-sm">
                                    <textarea v-model="message"
                                        ref="messageInput"
                                        @keydown.shift.enter="handleSubmit"
                                        @keydown.enter="handleSubmit"
                                        class="form-input py-3 px-4 block w-full leading-5 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        placeholder="Ask me anything..."></textarea>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-500 hover:bg-blue-400 focus:outline-none focus:border-blue-600 focus:shadow-outline-blue active:bg-blue-800">
                                            <span v-if="loading">...</span>
                                            <span v-else>Send</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
