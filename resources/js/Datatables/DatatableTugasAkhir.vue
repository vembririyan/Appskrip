<template>
    <EasyDataTable buttons-pagination :headers="headers" :items="items" show-index
        empty-message="Tidak Ada Data Yang Tersedia" rows-per-page-message="Baris per halaman">
        <template #item-operation="item">
            <div class="operation-wrapper">
                <button class="text-red-400 mx-1 hover:bg-gray-300 px-2 py-1 rounded-lg text-lg">
                    <fontawesome icon="trash" @click="deleteItem(item)" />
                </button>
                <button class="text-blue-400 mx-1 hover:bg-gray-300 px-2 py-1 rounded-lg text-lg">
                    <fontawesome icon="pencil" @click="editItem(item)" />
                </button>
            </div>
        </template>
    </EasyDataTable>
</template>

<script lang="ts" setup>
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3'
import axios from 'axios';
import { computed } from 'vue';
import type { Header, Item } from "vue3-easy-data-table";

const headers: Header[] = [
    { text: "Nim", value: "nim" },
    { text: "Nama Mahasiswa", value: "nama_mahasiswa" },
    { text: "Dosen Pembimbing 1", value: "dosen_pembimbing_1" },
    { text: "Dosen Pembimbing 2", value: "dosen_pembimbing_2" },
    { text: "Judul Tugas Akhir", value: "judul_tugas_akhir" },
    { text: "Operation", value: "operation" },
];

const datamahasiswa = usePage().props.value.tugasakhirmahasiswa
const items: Item[] = datamahasiswa

function deleteItem(item){
    swal({
        title: "Anda yakin?",
        text: "Data Tugas Akhir Mahasiswa "+item.nama_mahasiswa+" akan dihapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Data terhapus!", {
                    icon: "success",
                });
                axios.delete('tugas_akhir/' + item.id)
                Inertia.visit('tugas_akhir')
            } else {
                swal("Dibatalkan!", { icon: "success" });
            }
        });
}

function editItem(item) {
    Inertia.visit('tugas_akhir/' + item.id + '/edit');
}
</script>
