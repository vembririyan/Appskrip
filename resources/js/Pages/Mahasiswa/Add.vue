<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm,usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

const selected = null

const form = useForm({
    nim: '',
    nama_mahasiswa: '',
});

const dosenpembimbing = usePage().props.value.dosenpembimbing

const submit = () => {
    form.post('/mahasiswa', {
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
            <h1 class="bold text-center text-2xl my-3">Tambah Mahasiswa</h1>
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="nim" value="Nim" />
                    <BreezeInput id="nim" type="text" class="mt-1 block w-full" v-model="form.nim" required autofocus
                        autocomplete="nim" />
                </div>
                <!-- <div class="mt-4">
                    <BreezeLabel for="dosbing_1" value="Dosen Pembimbing 1" />
                    <v-select id="dosbing_1" v-model="form.id_dosen_pembimbing_1" :value="form.id_dosen_pembimbing_1"
                        :options="dosenpembimbing" :reduce="nama_dosen => nama_dosen.id" class="mt-1 block w-full" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="dosbing_2" value="Dosen Pembimbing 2" />
                    <v-select id="dosbing_2" v-model="form.id_dosen_pembimbing_2" :value="form.id_dosen_pembimbing_2"
                        :options="dosenpembimbing" :reduce="nama_dosen => nama_dosen.id" class="mt-1 block w-full" />
                </div> -->

                <div class="mt-4">
                    <BreezeLabel for="nama_mahasiswa" value="Nama Mahasiswa" />
                    <BreezeInput id="nama_mahasiswa" type="text" class="mt-1 block w-full" v-model="form.nama_mahasiswa"
                        required autocomplete="nama_mahasiswa" />
                </div>
                <!-- <div class="mt-4">
                    <BreezeLabel for="judul_tugas_akhir" value="Judul Tugas Akhir" />
                    <BreezeInput id="judul_tugas_akhir" type="text" class="mt-1 block w-full" v-model="form.judul_tugas_akhir"
                        required autocomplete="judul_tugas_akhir" />
                </div> -->

                <div class="flex items-center justify-end mt-4">
                    <BreezeButton class="ml-4 ml-4 bg-teal-700 hover:bg-teal-900"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <fontawesome icon="save" class="mr-2" />Simpan
                    </BreezeButton>
                </div>
            </form>
        </div>
    </BreezeAuthenticatedLayout>
</template>
