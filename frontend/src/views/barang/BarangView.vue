<script setup>
import { ref, onMounted, watchEffect } from 'vue';
import api from '../../api';
import Navbar from "../layouts/Navbar.vue";
import Sidebar from "../layouts/Sidebar.vue";
import Footer from "../layouts/Footer.vue";

import "admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
import "admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
import "admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"

import "admin-lte/plugins/datatables/jquery.dataTables.min.mjs"
import "admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.mjs"
import "admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.mjs"
import "admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.mjs"

import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

import 'datatables.net-select';
import 'datatables.net-responsive';

DataTable.use(DataTablesCore);

const barang = ref([]);
const currentPage = ref(1);
const totalPages = ref(0);

const fetchDataBarang = async () => {

    await api.get(`/api/inventory/barang?page=${currentPage}`)

        .then(response => {
            console.log('sini', response);
            barang.value = response.data.data.data;
            totalPages.value = response.data.last_page;

        });
}


onMounted(() => {
    fetchDataBarang();
});

const data = ref([]);

watchEffect(() => {
    data.value = barang.value.map(item => [item.name, item.price]);
});
</script>

<template>
    <div>
        <Navbar />>
        <Sidebar />>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Fixed Navbar Layout</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Fixed Navbar Layout</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Title</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <DataTable :data="data" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                    </DataTable>
                                </div>

                                <div class="card-body">

                                </div>

                                <div class="card-footer">
                                    Footer
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <Footer />
    </div>
</template>