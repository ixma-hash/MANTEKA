<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';
import { index as equiposIndex, create as equiposCreate, edit as equiposEdit, destroy as equiposDestroy } from '@/routes/equipos';

interface Cliente {
    id: number;
    nombre: string;
    apellido: string;
}

interface Equipo {
    id: number;
    cliente_id: number | null;
    nombre: string;
    descripcion: string | null;
    marca: string | null;
    modelo: string | null;
    numero_serie: string | null;
    propiedad: string;
    f_ingreso: string;
    f_entrega: string | null;
    cliente: Cliente | null;
}

defineProps<{
    equipos: Equipo[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
            {
                title: 'Equipos',
                href: equiposIndex(),
            },
        ],
    },
});

const eliminar = (id: number) => {
    if (confirm('¿Estás seguro de que deseas eliminar este equipo?')) {
        router.delete(equiposDestroy(id));
    }
};
</script>

<template>
    <Head title="Equipos" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Equipos</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Gestion de equipos registrados en el sistema.
                </p>
            </div>
            <Link :href="equiposCreate()">
                <Button class="gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Equipo
                </Button>
            </Link>
        </div>

        <div class="rounded-xl border border-border bg-card shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border">
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">ID</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Nombre</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Cliente</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Descripcion</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Marca</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Modelo</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">N. Serie</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">Propiedad</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">F. Ingreso</th>
                            <th class="px-4 py-3 text-left font-medium text-muted-foreground">F. Entrega</th>
                            <th class="px-4 py-3 text-right font-medium text-muted-foreground">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="equipo in equipos"
                            :key="equipo.id"
                            class="border-b border-border last:border-0 transition-colors hover:bg-accent/50"
                        >
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.id }}</td>
                            <td class="px-4 py-3 font-medium">{{ equipo.nombre }}</td>
                            <td class="px-4 py-3 text-muted-foreground">
                                <span v-if="equipo.cliente">{{ equipo.cliente.nombre }} {{ equipo.cliente.apellido }}</span>
                                <span v-else class="text-xs italic">Sin cliente</span>
                            </td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.descripcion }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.marca }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.modelo }}</td>
                            <td class="px-4 py-3 font-mono text-xs text-muted-foreground">{{ equipo.numero_serie }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.propiedad }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.f_ingreso }}</td>
                            <td class="px-4 py-3 text-muted-foreground">{{ equipo.f_entrega }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <Link :href="equiposEdit(equipo.id)">
                                        <Button variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </Button>
                                    </Link>
                                    <Button variant="ghost" size="sm" class="text-muted-foreground hover:text-destructive" @click="eliminar(equipo.id)">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="equipos.length === 0">
                            <td colspan="11" class="px-4 py-16 text-center">
                                <div class="flex flex-col items-center text-muted-foreground">
                                    <svg class="mb-3 h-8 w-8 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                    <p class="text-sm">No hay equipos registrados.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
