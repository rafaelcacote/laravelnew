<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { EyeIcon, PencilIcon, Trash2Icon } from 'lucide-vue-next';

interface Props {
    item: any;
    viewAction?: (item: any) => void;
    editAction?: (item: any) => void;
    deleteAction?: (item: any) => void;
}

defineProps<Props>();
</script>

<template>
    <div class="flex justify-end gap-2">
        <Button
            v-if="viewAction"
            variant="ghost"
            size="sm"
            class="h-8 w-8 p-0 text-blue-600 hover:bg-blue-50 hover:text-blue-700 dark:text-blue-400 dark:hover:bg-blue-900/20"
            title="Visualizar"
            @click="viewAction(item)"
        >
            <EyeIcon class="h-4 w-4" />
        </Button>
        <Button
            v-if="editAction"
            variant="ghost"
            size="sm"
            class="h-8 w-8 p-0 text-green-600 hover:bg-green-50 hover:text-green-700 dark:text-green-400 dark:hover:bg-green-900/20"
            title="Editar"
            @click="editAction(item)"
        >
            <PencilIcon class="h-4 w-4" />
        </Button>
        <Button
            v-if="deleteAction"
            variant="ghost"
            size="sm"
            class="h-8 w-8 p-0 text-red-600 hover:bg-red-50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-900/20"
            title="Excluir"
            @click="deleteAction(item)"
        >
            <Trash2Icon class="h-4 w-4" />
        </Button>
    </div>
</template>
