<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import ListHeader from '@/components/ListHeader.vue';
import Pagination from '@/components/Pagination.vue';
import SearchFilter from '@/components/SearchFilter.vue';
import TableActions from '@/components/TableActions.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Map, PlusIcon } from 'lucide-vue-next';
import { ref } from 'vue';

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

const search = ref(props.filters.search);
const currentFilters = ref({});

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    });
};

const columns = [
    {
        key: 'id',
        header: 'ID',
        class: 'w-[100px]',
    },
    {
        key: 'nome',
        header: 'Nome',
    },
    {
        key: 'created_at',
        header: 'Criado em',
        class: 'text-right',
        cellClass: 'text-right text-gray-500 dark:text-gray-400',
        format: (value) => formatDate(value),
    },
    {
        key: 'actions',
        header: 'Ações',
        class: 'w-32 text-right',
        render: TableActions,
        props: {
            viewAction: (item) => console.log('View', item),
            editAction: (item) => console.log('Edit', item),
            deleteAction: (item) => console.log('Delete', item),
        },
    },
];

const viewAction = (zona) => {
    console.log('Visualizar:', zona.id);
    // window.location.href = `/zonas/${zona.id}`;
};

const editAction = (zona) => {
    console.log('Editar:', zona.id);
    // window.location.href = `/zonas/${zona.id}/edit`;
};

const deleteAction = (zona) => {
    console.log('Excluir:', zona.id);
    // if (confirm('Confirmar exclusão?')) { /* API call */ }
};

const goToPage = (page: number) => {
    // A busca agora é tratada pelo SearchFilter
    window.location.href = `/zonas?page=${page}&search=${search.value}`;
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Zonas" />
        <div class="px-4 py-2">
            <Heading title="Zonas" description="Gerencie as Zonas dos Bairros" :icon="Map" />
        </div>

        <div class="flex h-full flex-col p-6">
            <div class="flex flex-col gap-6 pb-6">
                <ListHeader title="Listagem de Zonas" buttonText="Adicionar Zona" :icon="PlusIcon" :href="route('zonas.create')" />

                <SearchFilter
                    v-model="search"
                    route-name="zonas.index"
                    placeholder="Pesquisar por nome..."
                    @update:filters="(filters) => (currentFilters = filters)"
                />
            </div>

            <DataTable :columns="columns" :data="zonas.data" empty-message="Nenhuma zona encontrada" :empty-action="resetSearch">
                <template #empty-icon>
                    <SearchIcon class="h-8 w-8 text-indigo-500 dark:text-indigo-400" />
                </template>
            </DataTable>

            <!-- Pagination -->
            <Pagination
                v-if="zonas.data.length > 0"
                :current-page="zonas.current_page"
                :last-page="zonas.last_page"
                :search="search"
                route-name="zonas.index"
            />
        </div>
    </AppLayout>
</template>
