<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { PlusIcon } from 'lucide-vue-next';
import { useSlots } from 'vue';

// Definindo as props
interface Props {
    title: string;
    buttonText?: string;
    showButton?: boolean;
    icon?: any;
    href?: string;
}

// Valores padrão
const props = withDefaults(defineProps<Props>(), {
    buttonText: 'Novo Item',
    showButton: true,
    icon: PlusIcon,
});

// Acessando os slots explicitamente
const slots = useSlots();

// Emitindo eventos
const emit = defineEmits(['action']);
</script>

<template>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ title }}</h1>

        <div>
            <!-- Slot personalizado tem prioridade -->
            <slot v-if="slots.action" name="action"></slot>

            <!-- Botão padrão se não houver slot -->
            <Button v-if="showButton" as-child class="gap-2 bg-indigo-600 hover:bg-indigo-700">
                <a :href="href">
                    <component :is="icon" class="h-4 w-4" />
                    {{ buttonText }}
                </a>
            </Button>
        </div>
    </div>
</template>
