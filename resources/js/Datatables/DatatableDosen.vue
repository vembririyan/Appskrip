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
    { text: "NIPY", value: "nipy" },
    { text: "Nama Dosen", value: "nama_dosen" },
    { text: "Operation", value: "operation" },
];


const datadosen = usePage().props.value.dosen
const items: Item[] = datadosen;

function deleteItem(item){
    swal({
        title: "Anda yakin?",
        text: "Data dosen "+item.nama_dosen+" akan dihapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("Data terhapus!", {
                    icon: "success",
                });
                axios.delete('dosen/' + item.id)
                Inertia.visit('dosen', {
                    only: ['dosen'],
                })
            } else {
                swal("Dibatalkan!", { icon: "success" });
            }
        });
}

function editItem(item) {
    Inertia.visit('dosen/' + item.id + '/edit');
}
</script>
