<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, inject } from "vue";
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm, router } from "@inertiajs/vue3";

const swal = inject('$swal');

const props = defineProps({
    acciones: Array,
});

const defaultObj = {
    name:'',
    permission: []
};

let items = ref([]);
let form = useForm(defaultObj);


const createRol = () => {
    form.post(route('roles.store'), {
        onSuccess: () => {
            swal.fire('El rol ha sido creado exitósamente.', 'Aviso', 'info');
        }
    });

};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crea un nuevo Rol
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="createRol">
                        <div class="space-y-12 p-4">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Crea un nuevo rol</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Administar modulos</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Descripcion</label>
                                <div class="mt-2">
                                <input type="text"
                                v-model="form.name"
                                name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>
                            </div>

                            <!-- <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                <div class="mt-2">
                                <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                                </div>
                            </div> -->
                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 space-y-10">
                                <fieldset>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">Acciones</legend>

                                </fieldset>
                                <Checkbox  v-model="form.permission" :value="accion.id" v-for="accion in acciones" :key="accion.id"  :id-name="'acciones' + accion.id">
                                    {{ accion.name }}
                                </Checkbox>
                            </div>
                        </div>
                        </div>

                        <div class="mt-6 p-2 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </AppLayout>
</template>


