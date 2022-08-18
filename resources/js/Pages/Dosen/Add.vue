<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

const form = useForm({
    nipy: '',
    nama_dosen: '',
});

const submit = () => {
    form.post('/dosen', {
        onSuccess: () => swal("Data baru tersimpan!", {
            icon: "success",
        })
        ,
        onError: () =>
            swal("Gagal Menyimpan!", {
                icon: "warning",
            })
    })
};
</script>

<template>
    <BreezeAuthenticatedLayout>

        <Head title="Tambah Dosen" />

        <div class="bg-white rounded p-5 w-2/4 mx-auto mt-3">
            <h1 class="bold text-center text-2xl my-3">Tambah Dosen</h1>
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
                        <fontawesome icon="save" class="mr-2"/>Simpan
                    </BreezeButton>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
