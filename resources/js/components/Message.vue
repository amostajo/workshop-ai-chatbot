<script setup lang="ts">
    interface Message {
        role: string
        content: string
        sources?: array
    }

    const props = defineProps<{
        message: Message
        role: string
    }>();
</script>

<style lang="scss">
    .message {
        ul {
            display: flex;
            flex-direction: column;
            padding: 0;
            margin: 0;
            li {
                margin-left: 20px;
            }
        }
        ul {
            list-style: circle;
        }
        ol {
            list-style: decimal;
        }
    }
</style>

<template>
    <div :class="[
        'message p-2 mb-4',
        message.role,
        {
            'bg-lime-800': message.role === 'user',
            'bg-cyan-800': message.role !== 'user',
        }
    ]">
        <div class="mb-2">
            <strong>{{ message.role === 'user' ? 'You' : (role || 'Aegent') }}:</strong>
        </div>
        <div class="text-sm" style="white-space: pre-wrap;" v-html="message.content || message.text"/>
        <div v-if="message.sources?.length" class="sources mt-4">
            <small class="text-gray-400">Sources used:</small>
            <div>
                <span
                    v-for="(src, idx) in message.sources"
                    :key="idx"
                    class="inline-flex items-center rounded-md bg-gray-200/10 px-2 py-1 text-xs font-medium text-gray-400 inset-ring inset-ring-gray-200/20 mr-1"
                >
                    {{ src.file }}<span v-if="src.confidence"> (conf: {{ src.confidence.toFixed(2) }})</span>
                </span>
            </div>
        </div>
    </div>
</template>