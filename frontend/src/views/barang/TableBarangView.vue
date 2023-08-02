

<script setup>
import $ from "jquery";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import api from "../../api"
import _ from 'lodash';



import "admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css";
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
import { onMounted, ref } from "vue";
import { getBarangs } from "../../hook/barangHook";

// import DataTable from 'datatables.net-vue3';
// import DataTablesCore from 'datatables.net';

// DataTable.use(DataTablesCore);

const options = ref([])
const selectedOption = ref(null);
const initialState = {
    email: '',
    password: ''
}

const formData = ref(initialState)





function reset() {
    // email.value = null
    // password.value = null

    // formData.email = null
    // formData.password = null
    ref.formData.reset()
}

const email = ref('')
const password = ref('')

function tesData() {
    console.log('masuk');
    setTimeout(() => {
        console.log('timeout');

        // formData.value = null
    }, 1500)
}

// const fetchBarangs = async () => {
//     const response = await getBarangs()
//     console.log(response);
// }

// onMounted(() => {
//     fetchBarangs()
// })

const fetchOptions = async (search, loading) => {
    if (search.length > 2) {
        loading(true)
        try {
            const response = await api.get(`/api/inventory/barang/cari/${search}`)
            options.value = response.data;
            console.log(response.data);
            loading(false);
        } catch (error) {
            console.error('Terjadi kesalahan saat mengambil data:', error);
            loading(false);
        }
    }

}

const saveData = async () => {
    console.log(selectedOption);
}


// function onSearch(search, loading) {
//     if (search.length > 2) {
//         loading(true)
//         searchBarang(search, loading)
//     }
// }

// const searchBarang = async (search, loading) => {
//     // console.log('async', search);
//     await api.get(`/api/inventory/barang/cari/${search}`)
//         .then(response => {
//             // let data = response.data
//             // response.data.then(json => (vm.options = json.name))
//             // options.value = response.data.name
//             loading(false);
//             console.log(response);
//         })
//         .catch(err => {
//             console.log(err);
//         });
// }

// const searchBarang = _.debounce((loading, search) => {
//     api.get(`/api/inventory/barang/cari/${search}`)
//         .then(res => {
//             console.log(res);
//         })
// });

//     axios
// .get(`https://api.github.com/search/repositories?q=${escape(search)}`)
// .then(res => {
//   options.value = res.data.items;
//   loading(false);
// })
// }, 350);



$(function () {

    let table;
    table = $('#data-table').DataTable({
        'processing': true,
        'serverSide': true,
        'responsive': true,
        'ordering': false,
        'orderable': false,
        'lengthChange': true,
        'sDom': 'lrtip',
        "language": {
            "infoFiltered": ""
        },
        // ajax: {
        //     url: 'http://192.168.215.76:8000/api/inventory/list',
        //     type: 'GET',
        // },
        // dom: 'Bfrtip',
        // buttons: [
        //     'excelHtml5',
        //     'pdfHtml5',
        //     'print',
        //     'copy',
        // ],
        "ajax": {
            "url": "http://192.168.67.76:8000/api/inventory/list",
            "type": "POST",
            "data": function (data) {
                data.search = $('#search').val()
            }
        },
        // "columns": [
        //     {
        //         data: null, render: function (data, type, row, meta) { return `${meta.row + 1}` }
        //     },
        //     { data: 'name' },
        //     { data: 'price' },
        // ]
    })
    $('#btn-cari').click(function () {
        table.ajax.reload();
    });
    $('#btn-reset').click(function () {
        $('#search').val("");
        table.ajax.reload();
    });
});

const placeholderText = 'Pilih salah satu opsi...';

import { useQuery } from "@tanstack/vue-query";

const { data } = useQuery({
    queryKey: ['barangs'],
    queryFn: getBarangs,
});
</script>

<template>
    <div v-if="data">
        <ul>

            <!-- syntax ini yang tampil hanya lenght nya saja -->
            <li v-for="b in data" :key="b.id">{{ b.name }}</li>

            <!-- syntax ini data tidak tampil -->
            <li v-for="b in data.data" :key="b.id">{{ b.name }}</li>

            <!-- syntax ini tampil, tapi semua field -->
            {{ data }} <br>
        </ul>
    </div>
</template>











    <!-- <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label class="text-info">Barang</label>
                    <vSelect :options="['Canada', 'United States']"></vSelect>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form>
                    <div class="form-group">
                        <label class="text-info">Barang Ajax</label>
                        <vSelect v-model="selectedOption" :filterable="false" :placeholder="placeholderText"
                            :options="options" :reduce="option => option.id" label="name" @search="fetchOptions">
                        </vSelect>
                    </div>
                    <button type="button" @click="saveData">Save</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                </button>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-4 col-md-3">
                <input type="text" class="form-control" name="search" id="search" autofocus autocomplete="off">
            </div>
            <div class="col-md-2">
                <button type="button" name="find" value="find" id="btn-cari" class="btn btn-sm btn-success">Caru</button>
                <button type="button" name="reset" value="reset" id="btn-reset" class="btn btn-sm btn-primary"
                    @click="reset">Reset</button>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

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
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" v-model="formData.email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    v-model="formData.password">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="reset" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="reset">Save changes</button>
                    </div>
                </div>
            </div>
            <input type="email" class="form-control" id="exampleInputEmail1" v-model="email">
            <input type="text" class="form-control" id="exampleInputPassword1" v-model="password">
        </div>
    </div> -->
<!-- </template> -->