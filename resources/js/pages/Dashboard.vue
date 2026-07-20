<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { dashboard } from '@/routes';

interface Equipo {
    id: number;
    nombre: string;
    descripcion: string | null;
    marca: string | null;
    modelo: string | null;
    numero_serie: string | null;
    propiedad: string;
    f_ingreso: string;
    f_entrega: string | null;
}

interface Cliente {
    id: number;
    cedula: string;
    nombre: string;
    apellido: string;
    telefono: string;
    correo: string;
    direccion: string;
}

defineProps<{
    equipos: Equipo[];
    clientes: Cliente[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const getInitials = (nombre: string, apellido: string) => {
    return (nombre.charAt(0) + apellido.charAt(0)).toUpperCase();
};
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Dashboard</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Vista general del sistema de mantenimiento.
            </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-muted-foreground">Total Equipos</p>
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-semibold tracking-tight">{{ equipos.length }}</p>
            </div>

            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-muted-foreground">Total Clientes</p>
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-semibold tracking-tight">{{ clientes.length }}</p>
            </div>

            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-muted-foreground">En Mantenimiento</p>
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17l-5.657-5.657a8.023 8.023 0 010-11.348 8.023 8.023 0 0111.348 0 8.023 8.023 0 010 11.348L11.42 15.17z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-semibold tracking-tight">{{ equipos.filter(e => !e.f_entrega).length }}</p>
            </div>

            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-muted-foreground">Entregados</p>
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent">
                        <svg class="h-4 w-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="mt-3 text-3xl font-semibold tracking-tight">{{ equipos.filter(e => e.f_entrega).length }}</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold tracking-tight">Equipos</h2>
                        <p class="mt-1 text-sm text-muted-foreground">Todos los equipos registrados.</p>
                    </div>
                    <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium text-primary">{{ equipos.length }}</span>
                </div>
                <div class="mt-4 space-y-3">
                    <div
                        v-for="equipo in equipos"
                        :key="equipo.id"
                        class="flex items-center gap-3 rounded-lg border border-border p-3 transition-colors hover:bg-accent/50"
                    >
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-accent">
                            <svg class="h-5 w-5 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ equipo.nombre }}</p>
                            <p class="truncate text-xs text-muted-foreground">{{ equipo.marca }} {{ equipo.modelo }}</p>
                        </div>
                        <span
                            class="shrink-0 rounded-full px-2 py-0.5 text-xs font-medium"
                            :class="equipo.f_entrega ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400'"
                        >
                            {{ equipo.f_entrega ? 'Entregado' : 'En Mantenimiento' }}
                        </span>
                    </div>
                    <div v-if="equipos.length === 0" class="flex flex-col items-center py-8 text-muted-foreground">
                        <svg class="mb-2 h-6 w-6 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <p class="text-xs">Sin equipos registrados</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold tracking-tight">Clientes</h2>
                        <p class="mt-1 text-sm text-muted-foreground">Clientes registrados en el sistema.</p>
                    </div>
                    <span class="rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-medium text-primary">{{ clientes.length }}</span>
                </div>
                <div class="mt-4 space-y-3">
                    <div
                        v-for="cliente in clientes"
                        :key="cliente.id"
                        class="flex items-center gap-3 rounded-lg border border-border p-3 transition-colors hover:bg-accent/50"
                    >
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10 text-xs font-semibold text-primary">
                            {{ getInitials(cliente.nombre, cliente.apellido) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium">{{ cliente.nombre }} {{ cliente.apellido }}</p>
                            <p class="truncate text-xs text-muted-foreground">{{ cliente.correo }}</p>
                        </div>
                        <span class="shrink-0 text-xs text-muted-foreground">{{ cliente.telefono }}</span>
                    </div>
                    <div v-if="clientes.length === 0" class="flex flex-col items-center py-8 text-muted-foreground">
                        <svg class="mb-2 h-6 w-6 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <p class="text-xs">Sin clientes registrados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
