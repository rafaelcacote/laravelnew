<script setup lang="ts">
import { type LucideIcon } from 'lucide-vue-next';

interface Props {
    title: string;
    description?: string;
    icon?: LucideIcon;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <div class="flex items-center gap-3">
            <component :is="icon" v-if="icon" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" />
            <h2 class="text-xl font-semibold tracking-tight">{{ title }}</h2>
        </div>
        <p v-if="description" class="text-muted-foreground text-sm">
            {{ description }}
        </p>
    </div>
</template>
