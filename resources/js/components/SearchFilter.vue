<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { router } from '@inertiajs/vue3';
import { Eraser, SearchIcon, XIcon } from 'lucide-vue-next';
import { ref, watch } from 'vue';

interface Props {
    modelValue: string;
    placeholder?: string;
    routeName: string;
    additionalFilters?: Record<string, any>;
}

const props = withDefaults(defineProps<Props>(), {
    placeholder: 'Pesquisar...',
    additionalFilters: () => ({}),
});

const emit = defineEmits(['update:modelValue', 'update:filters']);

const searchValue = ref(props.modelValue);
const localFilters = ref({ ...props.additionalFilters });

// Atualiza o valor do search no pai quando mudar
watch(searchValue, (value) => {
    emit('update:modelValue', value);
});

// Atualiza os filtros no pai quando mudarem
watch(
    localFilters,
    (value) => {
        emit('update:filters', value);
    },
    { deep: true },
);

const performSearch = () => {
    router.get(
        route(props.routeName),
        {
            search: searchValue.value,
            ...localFilters.value,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
};

const resetSearch = () => {
    searchValue.value = '';
    localFilters.value = { ...props.additionalFilters };
    router.get(
        route(props.routeName),
        {},
        {
            preserveState: true,
            replace: true,
        },
    );
};
</script>

<template>
    <div class="flex items-center justify-between gap-4">
        <div class="flex flex-1 flex-wrap items-center gap-4">
            <div class="relative min-w-[200px] flex-1">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <SearchIcon class="h-5 w-5 text-gray-400" />
                </div>
                <Input
                    v-model="searchValue"
                    :placeholder="placeholder"
                    class="w-full pr-10 pl-10 transition-all duration-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800"
                    @keyup.enter="performSearch"
                />
                <Button
                    v-if="searchValue"
                    variant="ghost"
                    size="sm"
                    class="absolute inset-y-0 right-0 my-auto mr-2 h-7 w-7 p-0 text-gray-400 hover:text-gray-600"
                    @click="searchValue = ''"
                >
                    <XIcon class="h-4 w-4" />
                </Button>
            </div>

            <div v-if="$slots.filters" class="flex flex-wrap items-center gap-2">
                <slot name="filters" v-bind="{ filters: localFilters }" />
            </div>
        </div>

        <div class="flex gap-2">
            <Button variant="outline" class="border-indigo-500 text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700" @click="performSearch">
                <SearchIcon class="h-4 w-4" />
                Pesquisar
            </Button>

            <Button variant="outline" class="border-gray-300 text-gray-600 hover:bg-gray-50 hover:text-gray-700" @click="resetSearch">
                <Eraser class="h-4 w-4" />
                Limpar
            </Button>
        </div>
    </div>
</template>
