

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="offset-md-4 col-md-3">
                <input type="text" class="form-control" name="search" id="search" autofocus autocomplete="off">
            </div>
            <div class="col-md-2">
                <button type="button" name="find" value="find" id="btn-cari" class="btn btn-sm btn-success">Caru</button>
                <button type="button" name="reset" value="reset" id="btn-reset"
                    class="btn btn-sm btn-primary">Reset</button>
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
    </div>
</template>

<script setup>
import $ from "jquery";

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

// import DataTable from 'datatables.net-vue3';
// import DataTablesCore from 'datatables.net';

// DataTable.use(DataTablesCore);

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
            "url": "http://192.168.215.76:8000/api/inventory/list",
            "type": "POST",
            "data": function (data) {
                data.search = $('#search').val()
            }
        },
    })
    $('#btn-cari').click(function () {
        table.ajax.reload();
    });
    $('#btn-reset').click(function () {
        $('#search').val("");
        table.ajax.reload();
    });

});


</script>