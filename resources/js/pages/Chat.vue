<script setup lang="ts">
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import axios from 'axios'
import Message from '@/components/Message.vue'

const props = defineProps<{
    role?: string;
}>();

const messages = ref([])
const userInput = ref('')
const isLoading = ref(false)

const addMessage = (role, content, sources = []) => {
    messages.value.push({ role, content, sources })
}

const addMessageResponse = (role, response) => {
    messages.value.push({
        ...{role: role},
        ...response
    })
}

const sendMessage = async () => {
    const msg = userInput.value.trim()
    if (!msg) return
    addMessage('user', msg)
    userInput.value = ''
    isLoading.value = true
    try {
        const response = await axios.post('/chat', { message: msg, useAgent: 1 })
        addMessageResponse('agent', response.data);
    } catch (err) {
        addMessage('agent', `Error: ${err.response?.data?.error || err.message}`)
    } finally {
        isLoading.value = false
    }
}

</script>

<template>
    <Head title="Chatbot"/>
    <div class="w-screen h-screen flex flex-col items-center justify-end bg-black pa-4 pb-17">
        <div class="messages w-full overflow-y-auto p-2">
            <Message
                v-for="(message, i) in messages"
                :key="i"
                :message="message"
                :role="role"
            />
            <div v-if="messages.length === 0" class="empty">
                Start asking questions to our <strong>{{ role || 'agent'}}</strong>!
            </div>
            <div v-if="isLoading" class="loading bg-indigo-500/30 p-1 pl-4 flex items-center rounded">
                <img src="https://freesvg.org/img/1544764567.png" class="mr-3 size-5 animate-spin"/>
                <span class="text-sm">Thinking...</span>
            </div>
        </div>
        <div class="input-area fixed w-full p-4 bottom-0 bg-stone-800 flex items-center justify-center gap-4">
            <div>
                <input
                    v-model="userInput"
                    @keyup.enter="sendMessage"
                    class="block min-w-0 grow py-1.5 pr-3 p-2 text-base text-stone-200 placeholder:text-stone-400 focus:outline-none sm:text-sm/6 dark:bg-stone-900 dark:text-white dark:placeholder:text-gray-500"
                    placeholder="Ask something..."
                    :disabled="isLoading"
                />
            </div>
            <button
                type="button"
                @click.stop="sendMessage"
                :disabled="isLoading || !userInput.trim()"
            >
                Ask
            </button>
        </div>
    </div>
</template>