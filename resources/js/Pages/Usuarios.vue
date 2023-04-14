<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, inject } from "vue";
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm, router } from "@inertiajs/vue3";

const swal = inject('$swal');

const props = defineProps({
    users: Array,
});

const createReporte = () => {
    const url = `/reporte-formulario`;
    window.open(url, "_blank");

};

</script>

<template>
    <AppLayout title="Usuarios">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <Link
                        class="
                            m-5
                            px-6
                            p-2
                            text-green-100
                            bg-green-500
                            rounded"
                            :href="route('usuario.create')"
                            >
                        + Nuevo usuario
                    </Link>
                    <button
                        class="
                            m-5
                            px-6
                            p-2
                            text-white
                            bg-slate-700
                            rounded"
                            @click="createReporte" >
                            Crear reporte
                    </button>

                    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nombres</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Rol</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ user.name }}</td>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">
                                <ul>
                                    <li
                                    class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
                                    v-for="permission in user.roles" :key="permission.id">{{ permission.name }}</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                <a x-data="{ tooltip: 'Edite' }" :href="route('usuario.edit', user.id)">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-6 w-6"
                                    x-tooltip="tooltip"
                                >
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                    />
                                </svg>
                                </a>
                            </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
               </div>
            </div>
        </div>
    </AppLayout>
</template>


