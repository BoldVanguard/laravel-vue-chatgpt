<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Home" />

    <div class="bg-gray-100">
        <div class="container mx-auto py-12 px-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">OpenAI Starter Kit</h1>
            <p class="text-gray-700 text-xl mb-8">
                Build AI-powered web applications with the Laravel, Vue, Inertia JS, Tailwind CSS, and OpenAI
            </p>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Chatbot</h2>
                        <p class="text-gray-700 mb-4">
                            You can ask anything to this chatbot. This will return the well formatted response which is easy to read.
                        </p>
                        <Link href="/chatbot">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">View
                            Demo</button>
                        </Link>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">AI Image Generator</h2>
                        <p class="text-gray-700 mb-4">
                            An AI image generator is a tool that uses artificial intelligence to generate original
                            images based on a set of input parameters.
                        </p>
                        <Link href="/image-generator">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">View
                            Demo</button>
                        </Link>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Code Explainer</h2>
                        <p class="text-gray-700 mb-4">

                            A code explainer is a tool that uses artificial intelligence to break down and explain a code snippet in a step-by-step manner.
                        </p>
                        <Link href="/code-explainer">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">View
                            Demo</button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
