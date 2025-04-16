<script setup lang="ts">
import { Button } from '@/components/ui/button';

interface Props {
    currentPage: number;
    lastPage: number;
    search?: string;
    routeName?: string;
}

const props = defineProps<Props>();

const emit = defineEmits(['pageChanged']);

const goToPage = (page: number) => {
    if (props.routeName) {
        // Navegação via rota (Inertia.js)
        window.location.href = route(props.routeName, {
            page,
            search: props.search,
        });
    } else {
        // Emite evento para o componente pai
        emit('pageChanged', page);
    }
};
</script>

<template>
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-500 dark:text-gray-400">Mostrando página {{ currentPage }} de {{ lastPage }}</div>
        <div class="flex gap-1">
            <Button variant="outline" size="sm" :disabled="currentPage === 1" class="border-gray-300" @click="goToPage(currentPage - 1)">
                Anterior
            </Button>

            <Button
                v-for="page in lastPage"
                v-show="Math.abs(page - currentPage) <= 2 || page === 1 || page === lastPage"
                :key="page"
                variant="outline"
                size="sm"
                :class="{
                    'border-indigo-500 bg-indigo-50 text-indigo-600': currentPage === page,
                    'border-gray-300': currentPage !== page,
                }"
                @click="goToPage(page)"
            >
                {{ page }}
            </Button>

            <Button variant="outline" size="sm" :disabled="currentPage === lastPage" class="border-gray-300" @click="goToPage(currentPage + 1)">
                Próxima
            </Button>
        </div>
    </div>
</template>
