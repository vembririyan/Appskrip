<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const form = useForm({
    nipy: '',
    nama_dosen: '',
});

const id = usePage().props.value.id
const dosen = usePage().props.value.dosen
form.nipy = dosen[0].nipy;
form.nama_dosen = dosen[0].nama_dosen;

const submit = () => {
    form.put('/dosen/'+id, {
        onSuccess: () => swal("Perubahan tersimpan!", {
            icon: "success",
        }),
        onError: () =>
            swal("Gagal Menyimpan Perubahan!", {
                icon: "warning",
            })
    })
};
</script>

<template>
    <BreezeAuthenticatedLayout>

        <Head title="Edit Dosen" />

        <div class="bg-white rounded p-5 w-2/4 mx-auto mt-3">
            <h1 class="bold text-center text-2xl my-3">Edit Dosen</h1>
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="nipy" value="NIPY" />
                    <BreezeInput id="nipy" type="text" class="mt-1 block w-full" v-model="form.nipy" required autofocus
                        autocomplete="nipy" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="nama_dosen" value="Nama Dosen" />
                    <BreezeInput id="nama_dosen" type="text" class="mt-1 block w-full" v-model="form.nama_dosen"
                        required autocomplete="nama_dosen" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton class="ml-4 ml-4 bg-teal-700 hover:bg-teal-900"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <fontawesome icon="pencil" class="mr-2" />
                        Edit
                    </BreezeButton>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>