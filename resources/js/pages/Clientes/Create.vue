<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { dashboard } from '@/routes';
import { index as clientesIndex, create as clientesCreate, store as clientesStore } from '@/routes/clientes';

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
            {
                title: 'Nuevo Cliente',
                href: clientesCreate(),
            },
        ],
    },
});

const form = useForm({
    cedula: '',
    nombre: '',
    apellido: '',
    telefono: '',
    correo: '',
    direccion: '',
});

const submit = () => {
    form.post(clientesStore().url);
};
</script>

<template>
    <Head title="Nuevo Cliente" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Nuevo Cliente</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Registrar un nuevo cliente en el sistema.
            </p>
        </div>

        <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
            <form @submit.prevent="submit" class="space-y-6">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <Label for="cedula" class="text-sm font-medium">Cedula *</Label>
                        <Input
                            id="cedula"
                            v-model="form.cedula"
                            required
                            placeholder="Numero de cedula"
                            class="h-10"
                        />
                        <InputError :message="form.errors.cedula" />
                    </div>

                    <div class="space-y-2">
                        <Label for="nombre" class="text-sm font-medium">Nombre *</Label>
                        <Input
                            id="nombre"
                            v-model="form.nombre"
                            required
                            placeholder="Nombre del cliente"
                            class="h-10"
                        />
                        <InputError :message="form.errors.nombre" />
                    </div>

                    <div class="space-y-2">
                        <Label for="apellido" class="text-sm font-medium">Apellido *</Label>
                        <Input
                            id="apellido"
                            v-model="form.apellido"
                            required
                            placeholder="Apellido del cliente"
                            class="h-10"
                        />
                        <InputError :message="form.errors.apellido" />
                    </div>

                    <div class="space-y-2">
                        <Label for="telefono" class="text-sm font-medium">Telefono *</Label>
                        <Input
                            id="telefono"
                            v-model="form.telefono"
                            required
                            placeholder="Numero de telefono"
                            class="h-10"
                        />
                        <InputError :message="form.errors.telefono" />
                    </div>

                    <div class="space-y-2">
                        <Label for="correo" class="text-sm font-medium">Correo *</Label>
                        <Input
                            id="correo"
                            v-model="form.correo"
                            type="email"
                            required
                            placeholder="Correo electronico"
                            class="h-10"
                        />
                        <InputError :message="form.errors.correo" />
                    </div>

                    <div class="space-y-2">
                        <Label for="direccion" class="text-sm font-medium">Direccion *</Label>
                        <Input
                            id="direccion"
                            v-model="form.direccion"
                            required
                            placeholder="Direccion del cliente"
                            class="h-10"
                        />
                        <InputError :message="form.errors.direccion" />
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <Button :disabled="form.processing" class="gap-2">
                        <svg v-if="form.processing" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Guardar
                    </Button>
                    <Link :href="clientesIndex()" class="text-sm text-muted-foreground transition-colors hover:text-foreground">
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
