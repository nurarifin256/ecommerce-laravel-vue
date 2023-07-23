<template>
    <!-- <div class="container"> -->
    <JlDatatable :url="datatable.url" :columns="datatable.columns" />
    <!-- </div> -->
</template>
<script>
import JlDatatable from 'jl-datatable'
export default {
    name: 'Baran',
    components: {
        JlDatatable
    },
    data() {
        return {
            datatable: {
                url: 'http://192.168.237.76:8000/api/inventory/barang',
                columns: [
                    {
                        title: 'ID',
                        key: 'id',
                        width: '5%'
                    },
                    {
                        title: 'Name',
                        key: 'name',
                        isSort: true,
                        isSearch: true,
                    },
                    {
                        title: 'Price',
                        key: 'price',
                        isSort: true,
                        isSearch: true,
                    }
                ]
            }
        }
    }
}
</script>