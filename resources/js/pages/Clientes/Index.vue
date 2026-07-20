<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { dashboard } from '@/routes';
import { index as clientesIndex, create as clientesCreate, edit as clientesEdit, destroy as clientesDestroy } from '@/routes/clientes';

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
    clientes: Cliente[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
            {
                title: 'Clientes',
                href: clientesIndex(),
            },
        ],
    },
});

const eliminar = (id: number) => {
    if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
        router.delete(clientesDestroy(id));
    }
};

const getInitials = (nombre: string, apellido: string) => {
    return (nombre.charAt(0) + apellido.charAt(0)).toUpperCase();
};
</script>

<template>
    <Head title="Clientes" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">Clientes</h1>
                <p class="mt-1 text-sm text-muted-foreground">
                    Panel de clientes registrados en el sistema.
                </p>
            </div>
            <Link :href="clientesCreate()">
                <Button class="gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Cliente
                </Button>
            </Link>
        </div>

        <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                    <svg class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground">Total de clientes</p>
                    <p class="text-2xl font-semibold">{{ clientes.length }}</p>
                </div>
            </div>
        </div>

        <div v-if="clientes.length > 0" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="cliente in clientes"
                :key="cliente.id"
                class="group rounded-xl border border-border bg-card p-5 shadow-xs transition-all hover:shadow-md hover:border-primary/30"
            >
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold text-primary">
                            {{ getInitials(cliente.nombre, cliente.apellido) }}
                        </div>
                        <div>
                            <h3 class="font-semibold leading-tight">{{ cliente.nombre }} {{ cliente.apellido }}</h3>
                            <p class="text-xs text-muted-foreground">CI: {{ cliente.cedula }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 opacity-0 transition-opacity group-hover:opacity-100">
                        <Link :href="clientesEdit(cliente.id)">
                            <Button variant="ghost" size="sm" class="h-8 w-8 p-0 text-muted-foreground hover:text-foreground">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </Button>
                        </Link>
                        <Button variant="ghost" size="sm" class="h-8 w-8 p-0 text-muted-foreground hover:text-destructive" @click="eliminar(cliente.id)">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </Button>
                    </div>
                </div>

                <div class="mt-4 space-y-2.5 border-t border-border pt-4">
                    <div class="flex items-center gap-2.5 text-sm">
                        <svg class="h-4 w-4 shrink-0 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <span class="text-muted-foreground">{{ cliente.telefono }}</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-sm">
                        <svg class="h-4 w-4 shrink-0 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span class="truncate text-muted-foreground">{{ cliente.correo }}</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-sm">
                        <svg class="h-4 w-4 shrink-0 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <span class="truncate text-muted-foreground">{{ cliente.direccion }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="rounded-xl border border-border bg-card p-16 shadow-xs">
            <div class="flex flex-col items-center text-muted-foreground">
                <svg class="mb-3 h-10 w-10 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <p class="text-sm">No hay clientes registrados.</p>
                <Link :href="clientesCreate()" class="mt-3">
                    <Button variant="outline" size="sm" class="gap-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Registrar primer cliente
                    </Button>
                </Link>
            </div>
        </div>
    </div>
</template>
