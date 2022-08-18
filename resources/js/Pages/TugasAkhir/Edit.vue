<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const form = useForm({
    mahasiswa_id: '',
    dosbing1_id: '',
    dosbing2_id: '',
    judul_tugas_akhir: ''
});



const id = usePage().props.value.id
const mahasiswa = usePage().props.value.mahasiswa
const dosenpembimbing = usePage().props.value.dosen
const mahasiswaedit = usePage().props.value.mahasiswaedit
form.mahasiswa_id = mahasiswaedit[0].mahasiswa_id
form.dosbing1_id = mahasiswaedit[0].dosbing1_id
form.dosbing2_id = mahasiswaedit[0].dosbing2_id
form.judul_tugas_akhir = mahasiswaedit[0].judul_tugas_akhir

const submit = () => {
    form.put('/tugas_akhir/'+id, {
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

        <Head title="Edit Tugas Akhir" />

        <div class="bg-white rounded p-5 w-2/4 mx-auto mt-3">
            <h1 class="bold text-center text-2xl my-3">Edit Mahasiswa Tugas Akhir</h1>
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="submit">
                <div>
                    <BreezeLabel for="dosbing_1" value="Mahasiswa" />
                    <v-select id="dosbing_1" v-model="form.mahasiswa_id" :value="form.mahasiswa_id" :options="mahasiswa"
                        :reduce="nama_mahasiswa => nama_mahasiswa.id" class="mt-1 block w-full" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="dosbing_1" value="Dosen Pembimbing 1" />
                    <v-select id="dosbing_1" v-model="form.dosbing1_id" :value="form.dosbing1_id"
                        :options="dosenpembimbing" :reduce="nama_dosen => nama_dosen.id" class="mt-1 block w-full" />
                </div>
                <div class="mt-4">
                    <BreezeLabel for="dosbing_2" value="Dosen Pembimbing 2" />
                    <v-select id="dosbing_2" v-model="form.dosbing2_id" :value="form.dosbing2_id"
                        :options="dosenpembimbing" :reduce="nama_dosen => nama_dosen.id" class="mt-1 block w-full" />
                </div>

                <div class="mt-4">
                    <BreezeLabel for="judul_tugas_akhir" value="Judul Tugas Akhir" />
                    <BreezeInput id="judul_tugas_akhir" type="text" class="mt-1 block w-full"
                        v-model="form.judul_tugas_akhir" required autocomplete="judul_tugas_akhir" />
                </div>

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