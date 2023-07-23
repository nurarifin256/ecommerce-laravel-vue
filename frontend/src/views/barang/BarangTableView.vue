<script setup>
import { onMounted, ref } from "vue"
import api from "../../api"

import "admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
import "admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
import "admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"

import "admin-lte/plugins/datatables/jquery.dataTables.min.mjs"
import "admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.mjs"
import "admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.mjs"
import "admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.mjs"
import "admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"
import "admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"
import "admin-lte/plugins/datatables-buttons/js/buttons.print.min.js"
import "admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js"

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import ButtonsHtml5 from 'admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js'
import pdfmake from 'admin-lte/plugins/pdfmake/pdfmake.min.js'
import pdfFonts from 'admin-lte/plugins/pdfmake/vfs_fonts.js'

pdfmake.vfs = pdfFonts.pdfMake.vfs;
import JsZip from 'jszip'
window.JSZip = JsZip

// import 'datatables.net-select';
// import 'datatables.net-responsive';

DataTable.use(pdfmake)
DataTable.use(ButtonsHtml5)
DataTable.use(DataTablesCore);

const barangs = ref([])
const columns = [
    {
        data: null, render: function (data, type, row, meta) { return `${meta.row + 1}` }
    },
    { data: 'name' },
    { data: 'price' },
    { data: null, render: function (data) { return `<button class="btn btn-primary">${data.id}</button>` } }
];

const tombol = [
    {
        title: 'Export Excel',
        extend: 'excelHtml5',
        text: '<i class="fas fa-file-excel"></i> Excel',
        className: 'btn btn-success'
    },
    {
        title: 'Export Pdf',
        extend: 'pdfHtml5',
        text: '<i class="fas fa-file-pdf"></i> Pdf',
        className: 'btn btn-danger'
    },
    {
        title: 'Print',
        extend: 'print',
        text: '<i class="fas fa-print"></i> Print',
        className: 'btn btn-dark'
    },
    {
        title: 'copy',
        extend: 'copy',
        text: '<i class="fas fa-copy"></i> Copy',
        className: 'btn btn-light'
    },
];

const fetchDataBarang = async () => {
    await api.get('/api/inventory/barang')
        .then(response => {
            console.log(response);
            barangs.value = response.data;

        });
}

onMounted(() => {
    fetchDataBarang();
});

</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="table-responsive">
                <DataTable :data="barangs" :columns="columns" class="table table-striped table-bordered display"
                    :options="{ responsive: true, autoWidth: false, dom: 'Bfrtip', buttons: tombol, searchDelay: 400 }">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </DataTable>
            </div>
        </div>
    </div>
</template>