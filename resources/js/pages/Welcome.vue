<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { dashboard, login } from '@/routes';
import { register } from '@/routes';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-background p-6 text-foreground lg:justify-center lg:p-8 dark:bg-background"
    >
        <header
            class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-lg border border-border px-5 py-2 text-sm leading-normal text-foreground transition-colors hover:bg-accent"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-lg border border-transparent px-5 py-2 text-sm leading-normal text-foreground transition-colors hover:border-border"
                    >
                        Iniciar sesion
                    </Link>
                    <Link
                        :href="register()"
                        class="inline-block rounded-lg bg-primary px-5 py-2 text-sm leading-normal text-primary-foreground transition-opacity hover:opacity-90"
                    >
                        Registrarse
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full max-w-[335px] flex-col overflow-hidden lg:max-w-3xl lg:flex-row"
            >
                <div
                    class="flex-1 rounded-l-xl rounded-tr-xl bg-card p-8 pb-12 text-sm leading-relaxed shadow-sm ring-1 ring-border lg:rounded-bl-xl lg:rounded-tr-none lg:p-14 dark:bg-card dark:ring-border"
                >
                    <div class="mb-8 flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary"
                        >
                            <AppLogoIcon class="size-5 text-primary-foreground" />
                        </div>
                        <h1 class="text-xl font-semibold tracking-tight">Mantenka</h1>
                    </div>

                    <p class="mb-6 text-muted-foreground">
                        Sistema de gestion y mantenimiento de equipos.
                        Administra tu inventario de forma simple y eficiente.
                    </p>

                    <div class="space-y-3 mb-8">
                        <div class="flex items-center gap-3 text-sm text-muted-foreground">
                            <div class="flex h-7 w-7 items-center justify-center rounded-md bg-accent">
                                <svg class="h-3.5 w-3.5 text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>Registro completo de equipos</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-muted-foreground">
                            <div class="flex h-7 w-7 items-center justify-center rounded-md bg-accent">
                                <svg class="h-3.5 w-3.5 text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span>Seguimiento de fechas de ingreso y entrega</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-muted-foreground">
                            <div class="flex h-7 w-7 items-center justify-center rounded-md bg-accent">
                                <svg class="h-3.5 w-3.5 text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                            </div>
                            <span>Filtros y busqueda avanzada</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <Link
                            :href="login()"
                            class="inline-block rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-primary-foreground transition-opacity hover:opacity-90"
                        >
                            Comenzar
                        </Link>
                    </div>
                </div>

                <div
                    class="relative -mb-px aspect-[335/260] w-full shrink-0 overflow-hidden rounded-br-xl rounded-tl-xl bg-accent lg:mb-0 lg:-ml-px lg:aspect-auto lg:w-[340px] lg:rounded-tl-none lg:rounded-br-xl dark:bg-accent"
                >
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="flex flex-col items-center gap-4 opacity-60">
                            <AppLogoIcon class="size-16 text-foreground/20" />
                            <div class="flex gap-1">
                                <div class="h-1 w-8 rounded-full bg-foreground/10"></div>
                                <div class="h-1 w-12 rounded-full bg-foreground/10"></div>
                                <div class="h-1 w-6 rounded-full bg-foreground/10"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-0 rounded-br-xl shadow-[inset_0_0_0_1px_rgba(0,0,0,0.05)] lg:rounded-tl-none lg:rounded-br-xl dark:shadow-[inset_0_0_0_1px_rgba(255,255,255,0.05)]"
                    ></div>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
