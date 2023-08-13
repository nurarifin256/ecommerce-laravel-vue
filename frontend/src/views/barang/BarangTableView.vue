<script setup>
import { onMounted, ref } from "vue"
import api from "../../api"
import JsonExcel from "vue-json-excel3";

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
            barangs.value = response.data;

        });
}

const fetchData = async () => {
    const response = await api.get('/api/inventory/barang')
    console.log(response);
    return response.data.data;

}

onMounted(() => {
    fetchDataBarang();
});

// const myinput = ref(null);
// const myValue = ref(null);
// const myValue2 = ref('tes bosku')

const formData = ref({
    name: "",
    lastName: ""
});


// function submitData() {
//     myinput.value.focus()
// }

// function autoFocus() {
//     const length = myValue.value
//     if (length.length > 2) {
//         console.log(length);
//         myValue2.value = null
//         myinput.value.focus()

//     }
// }


function save() {
    // console.log(formData)
}

const clearForm = () => {
    // Reset the formData object to its initial state
    formData.value = {
        name: "",
        lastName: ""
    };
    return { formData }
};

const json_fields = {
    "Complete name": "name",
    City: "city",
    Telephone: "phone.mobile",
    "Telephone 2": {
        field: "phone.landline",
        callback: (value) => {
            return `Landline Phone - ${value}`;
        },
    },
}

const json_data = [
    {
        name: "Tony Peña",
        city: "New York",
        country: "United States",
        birthdate: "1978-03-15",
        phone: {
            mobile: "1-541-754-3010",
            landline: "(541) 754-3010",
        },
    },
    {
        name: "Thessaloniki",
        city: "Athens",
        country: "Greece",
        birthdate: "1987-11-23",
        phone: {
            mobile: "+1 855 275 5071",
            landline: "(2741) 2621-244",
        },
    },
]
const json_fields_2 = {
    "ID": "id",
    "Name": "name",
    "Price": "price",
}
function startDownload() {
    // alert('show loading');
    console.log('loading');
}
function finishDownload() {
    // alert('hide loading');
    console.log('sudah');
}
const json_meta = [
    [
        {
            key: "charset",
            value: "utf-8",
        },
    ],
];

</script>

<template>
    <div class="container mt-5">

        <div class="row mb-3">
            <div class="col-md-12">
                <input type="text" v-model="myValue" @keyup="autoFocus" class="form-control" name="search" id="search"
                    autocomplete="off">

            </div>
        </div>
        <div class="row mb-3">
            <input type="text" ref="myinput" autofocus class="form-control mb-3" v-model="myValue2">
            <button @click="submitData">Autofocus</button>
        </div>

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

        <JsonExcel class="btn btn-default" :data="json_data" :fields="json_fields" worksheet="My Worksheet"
            name="filename.xls">
            Download Excel (you can customize this with html code!)
        </JsonExcel>

        <JsonExcel class="btn btn-success" :fetch="fetchData" :fields="json_fields_2" :before-generate="startDownload"
            :before-finish="finishDownload" worksheet="My Worksheet" name="filename.xls">
            Download Excel Data From DB
        </JsonExcel>


        <a href="#/dashboard">About</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form key="">
                            <input type="text" v-model="formData.name" />
                            <input type="text" v-model="formData.lastName" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="clearForm"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>