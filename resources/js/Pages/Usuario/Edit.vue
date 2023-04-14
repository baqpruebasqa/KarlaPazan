<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, inject } from "vue";
import Checkbox from '@/Components/Checkbox.vue'
import { Head, Link, useForm, router } from "@inertiajs/vue3";

const swal = inject('$swal');

const props = defineProps({
    rolesDisponible: Array,
    user: Object,
});


const defaultObj = {
    name: props.user.name,
    email: props.user.email,
    password:'',
    password_confirmation:'',
    roles: '',
};

let form = useForm(defaultObj);

const updateUser = () => {
    form.put(route('usuario.update', props.user.id), {
        onSuccess: () => {
            swal.fire('El usuario ha sido actualizado exitósamente.', 'Aviso', 'info');
        }
    });

};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <form @submit.prevent="updateUser">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Usuario</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Administar modulos</p>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nombres</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.name" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            </div>

                            <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <input id="email" v-model="form.email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                            <div class="mt-2">
                                <input type="password" v-model="form.password" name="password" id="password" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            </div>

                            <div class="sm:col-span-2">
                            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirmar contraseña</label>
                            <div class="mt-2">
                                <input type="password" v-model="form.password_confirmation"  name="password_confirmation" id="password_confirmation" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                            <p v-if="form.errors.password" class="text-xs text-red-600">
                                {{ form.errors.password }}
                            </p>

                            <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Rol</label>
                                <div class="mt-2">
                                    <select id="roles"  v-model="form.roles" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option v-for="(rolesDisponible, index) in props.rolesDisponible" :key="index" :value="rolesDisponible.name">{{ rolesDisponible.name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:col-span-2" v-if="user.userRoles.length > 0">
                                <div v-for="role in user.userRoles" :key="role.id">
                                    Rol: {{ role.name }}
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                    </form>
               </div>
            </div>
        </div>
    </AppLayout>
</template>


