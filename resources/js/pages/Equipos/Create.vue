<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { dashboard } from '@/routes';
import { index as equiposIndex, create as equiposCreate, store as equiposStore } from '@/routes/equipos';

interface Cliente {
    id: number;
    nombre: string;
    apellido: string;
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
                title: 'Equipos',
                href: equiposIndex(),
            },
            {
                title: 'Nuevo Equipo',
                href: equiposCreate(),
            },
        ],
    },
});

const form = useForm({
    cliente_id: '',
    nombre: '',
    descripcion: '',
    marca: '',
    modelo: '',
    numero_serie: '',
    propiedad: '',
    f_ingreso: '',
    f_entrega: '',
});

const submit = () => {
    form.post(equiposStore().url);
};
</script>

<template>
    <Head title="Nuevo Equipo" />

    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Nuevo Equipo</h1>
            <p class="mt-1 text-sm text-muted-foreground">
                Agregar un nuevo equipo al sistema.
            </p>
        </div>

        <div class="rounded-xl border border-border bg-card p-6 shadow-xs">
            <form @submit.prevent="submit" class="space-y-6">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="space-y-2">
                        <Label for="cliente_id" class="text-sm font-medium">Cliente</Label>
                        <select
                            id="cliente_id"
                            v-model="form.cliente_id"
                            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <option value="">Sin cliente asignado</option>
                            <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                                {{ cliente.nombre }} {{ cliente.apellido }}
                            </option>
                        </select>
                        <InputError :message="form.errors.cliente_id" />
                    </div>

                    <div class="space-y-2">
                        <Label for="nombre" class="text-sm font-medium">Nombre *</Label>
                        <Input
                            id="nombre"
                            v-model="form.nombre"
                            required
                            placeholder="Nombre del equipo"
                            class="h-10"
                        />
                        <InputError :message="form.errors.nombre" />
                    </div>

                    <div class="space-y-2">
                        <Label for="descripcion" class="text-sm font-medium">Descripcion</Label>
                        <Input
                            id="descripcion"
                            v-model="form.descripcion"
                            placeholder="Descripcion del equipo"
                            class="h-10"
                        />
                        <InputError :message="form.errors.descripcion" />
                    </div>

                    <div class="space-y-2">
                        <Label for="marca" class="text-sm font-medium">Marca</Label>
                        <Input
                            id="marca"
                            v-model="form.marca"
                            placeholder="Marca del equipo"
                            class="h-10"
                        />
                        <InputError :message="form.errors.marca" />
                    </div>

                    <div class="space-y-2">
                        <Label for="modelo" class="text-sm font-medium">Modelo</Label>
                        <Input
                            id="modelo"
                            v-model="form.modelo"
                            placeholder="Modelo del equipo"
                            class="h-10"
                        />
                        <InputError :message="form.errors.modelo" />
                    </div>

                    <div class="space-y-2">
                        <Label for="numero_serie" class="text-sm font-medium">Numero de serie</Label>
                        <Input
                            id="numero_serie"
                            v-model="form.numero_serie"
                            placeholder="Numero de serie"
                            class="h-10"
                        />
                        <InputError :message="form.errors.numero_serie" />
                    </div>

                    <div class="space-y-2">
                        <Label for="propiedad" class="text-sm font-medium">Propiedad *</Label>
                        <Input
                            id="propiedad"
                            v-model="form.propiedad"
                            required
                            placeholder="Propiedad del equipo"
                            class="h-10"
                        />
                        <InputError :message="form.errors.propiedad" />
                    </div>

                    <div class="space-y-2">
                        <Label for="f_ingreso" class="text-sm font-medium">Fecha de ingreso *</Label>
                        <Input
                            id="f_ingreso"
                            v-model="form.f_ingreso"
                            type="date"
                            required
                            class="h-10"
                        />
                        <InputError :message="form.errors.f_ingreso" />
                    </div>

                    <div class="space-y-2">
                        <Label for="f_entrega" class="text-sm font-medium">Fecha de entrega</Label>
                        <Input
                            id="f_entrega"
                            v-model="form.f_entrega"
                            type="date"
                            class="h-10"
                        />
                        <InputError :message="form.errors.f_entrega" />
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
                    <Link :href="equiposIndex()" class="text-sm text-muted-foreground transition-colors hover:text-foreground">
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>
