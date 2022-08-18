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
    nim: '',
    old_nim: '',
    nama_mahasiswa: '',
});


const id = usePage().props.value.id
const mahasiswa = usePage().props.value.mahasiswa
form.nim = mahasiswa[0].nim;
form.old_nim = mahasiswa[0].nim;
form.nama_mahasiswa = mahasiswa[0].nama_mahasiswa;

const submit = () => {
    form.put('/mahasiswa/'+id, {
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

        <Head title="Edit Mahasiswa" />

        <div class="bg-white rounded p-5 w-2/4 mx-auto mt-3">
            <h1 class="bold text-center text-2xl my-3">Edit Mahasiswa</h1>
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="nim" value="Nim" />
                    <BreezeInput id="nim" type="text" class="mt-1 block w-full" v-model="form.nim" required autofocus
                        autocomplete="nim" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="nama_mahasiswa" value="Nama Mahasiswa" />
                    <BreezeInput id="nama_mahasiswa" type="text" class="mt-1 block w-full" v-model="form.nama_mahasiswa"
                        required autocomplete="nama_mahasiswa" />
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