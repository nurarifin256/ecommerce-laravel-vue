<script setup>
import $ from "jquery";
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
        "ajax": {
            "url": "http://192.168.194.76:8000/api/inventory/list_2",
            "type": "POST",
            data: function (data) {
                data.search = ""
            },
            // success: function (res) {
            //     console.log(res);
            // },
            // dataSrc: function (json) {
            //     if (json && json.header_names) {
            //         var headers = json.header_names;
            //         var table = $('#data-table').DataTable();
            //         var columns = table.columns().header();
            //         columns.each(function (colHeader, i) {
            //             $(colHeader).text(headers[i]);
            //         });
            //     }
            //     return json.data;
            // }
        },

        // "columns": [
        //     { "data": "po_code" },
        //     { "data": "size_29", "defaultContent": "" },
        //     { "data": "size_30", "defaultContent": "" },
        //     { "data": "size_31", "defaultContent": "" },
        //     { "data": "size_32", "defaultContent": "" }
        // ],

        // "columnDefs": [
        //     {
        //         "targets": [1, 2, 3, 4], // Kolom sizes dimulai dari index 1
        //         "render": function (data, type, row, meta) {
        //             return data !== null ? data : '';
        //         }
        //     }
        // ]
    })
    // $('#btn-cari').click(function () {
    //     table.ajax.reload();
    // });
    // $('#btn-reset').click(function () {
    //     $('#search').val("");
    //     table.ajax.reload();
    // });
});
</script>

<template>
    <div class="row">
        <div class="table-responsive">
            <table id="data-table" class="table table-striped table-bordered display">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Po Code</th>
                        <th>29</th>
                        <th>30</th>
                        <th>31</th>
                        <th>32</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</template>