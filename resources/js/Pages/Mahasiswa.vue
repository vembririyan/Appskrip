<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head } from '@inertiajs/inertia-vue3';
import DatatableDosen from '../Datatables/DatatableDosen.vue';
import { Inertia } from '@inertiajs/inertia';
import DatatableMahasiswa from '../Datatables/DatatableMahasiswa.vue';

const addMahasiswa = () => {
    Inertia.visit('/mahasiswa/create')
}
</script>

<template>

    <Head title="Mahasiswa" />
    <BreezeAuthenticatedLayout>
        <div class="m-2">
            <div class="rounded bg-white p-2">
                <DatatableMahasiswa />
            </div>
            <BreezeButton class="bg-teal-700 hover:bg-teal-900 rounded-lg fixed bottom-20 right-10"  @click="addMahasiswa">
                <fontawesome icon="plus" class="px-1 py-3 text-md" />
            </BreezeButton>
        </div>
    </BreezeAuthenticatedLayout>
</template>