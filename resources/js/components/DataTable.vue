<script setup lang="ts">
import { type ColumnDef } from '@/components/types';
import { Badge } from '@/components/ui/badge';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

interface Props {
    columns: ColumnDef[];
    data: any[];
    emptyMessage?: string;
    emptyAction?: () => void;
    emptyActionText?: string;
}

defineProps<Props>();
</script>

<template>
    <div
        class="flex-1 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-800"
    >
        <div class="h-full overflow-auto">
            <Table class="w-full">
                <TableHeader class="sticky top-0 z-10 bg-gray-50 dark:bg-gray-700">
                    <TableRow class="hover:bg-transparent">
                        <TableHead v-for="column in columns" :key="column.key" :class="column.class">
                            {{ column.header }}
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="(item, index) in data" :key="index" class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <TableCell v-for="column in columns" :key="column.key" :class="column.cellClass">
                            <template v-if="column.key === 'id'">
                                <Badge
                                    variant="outline"
                                    class="border-indigo-200 bg-indigo-50 text-indigo-700 dark:border-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300"
                                >
                                    #{{ item[column.key] }}
                                </Badge>
                            </template>
                            <template v-else-if="column.format">
                                {{ column.format(item[column.key]) }}
                            </template>
                            <template v-else-if="column.render">
                                <component :is="column.render" :item="item" v-bind="column.props || {}" />
                            </template>
                            <template v-else>
                                {{ item[column.key] }}
                            </template>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <div v-if="data.length === 0" class="flex h-[calc(100%-49px)] flex-col items-center justify-center gap-4 p-12 text-center">
                <div class="rounded-full bg-indigo-50 p-4 dark:bg-indigo-900/20">
                    <slot name="empty-icon">
                        <SearchIcon class="h-8 w-8 text-indigo-500 dark:text-indigo-400" />
                    </slot>
                </div>
                <p class="text-gray-500 dark:text-gray-400">
                    <slot name="empty-message">{{ emptyMessage || 'Nenhum item encontrado' }}</slot>
                </p>
                <Button v-if="emptyAction" variant="outline" class="border-indigo-500 text-indigo-600" @click="emptyAction">
                    {{ emptyActionText || 'Limpar filtros' }}
                </Button>
            </div>
        </div>
    </div>
</template>
