<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Verificando permisos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-if="$page.props.user.permissions.includes('producto-list')">
                <button type="button">Listar</button>
            </div>

                <div v-if="$page.props.user.permissions.includes('producto-create')">
                    <button type="button">Crear </button>
                </div>

                <div v-if="$page.props.user.permissions.includes('producto-edit')">
                    <button type="button">Editar</button>

                </div>

                <div v-if="$page.props.user.permissions.includes('producto-delete')">
                    <button type="button">Eliminar</button>
                </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
