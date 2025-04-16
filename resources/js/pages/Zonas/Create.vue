<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import ListHeader from '@/components/ListHeader.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Map } from 'lucide-vue-next';

interface Zona {
    id: number;
    nome: string;
    description: string | null;
    created_at: string;
}

interface Props {
    zonas: {
        data: Zona[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    filters: {
        search: string;
    };
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Zonas',
        href: '/zonas/index',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Zonas" />
        <div class="px-4 py-2">
            <Heading title="Zonas" description="Gerencie as Zonas dos Bairros" :icon="Map" />
        </div>

        <div class="flex h-full flex-col p-6">
            <div class="flex flex-col gap-6 pb-6">
                <ListHeader title="Cadastro de Zonas" />
            </div>
        </div>
    </AppLayout>
</template>
