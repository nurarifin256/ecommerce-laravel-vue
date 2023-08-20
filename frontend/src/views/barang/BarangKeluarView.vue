<script setup>
import { onMounted, ref } from 'vue';
import api from '../../api';


const idUser = 3;
const headerName = 'Inventory';
const detailName = 'Barang Keluar';

const accessPermission = ref(false);
const addPermission = ref(false);

const getPermissions = async () => {
    try {
        const response = await api.post('api/get-permissions', { idUser, headerName, detailName });
        // console.log('ini', response);
        accessPermission.value = response.data.data.access;
        addPermission.value = response.data.data.add;
    } catch (error) {
        console.error('Error fetching permissions:', error);
    }
};

onMounted(() => {
    getPermissions();
});
</script>

<template>
    <div>
        <p>ini barang keluar</p>

        <!-- jika access true munculkan button di bawah -->
        <button v-if="accessPermission && addPermission">Add data</button>
    </div>
</template>