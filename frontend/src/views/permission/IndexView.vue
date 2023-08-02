<script setup>
import { onMounted, ref } from 'vue';
import api from '../../api';
import Footer from '../layouts/Footer.vue';
import Navbar from '../layouts/Navbar.vue';
import Sidebar from '../layouts/Sidebar.vue';

const menus = ref([])

const fetchMenus = async () => {
    await api.get('api/permissions')
        .then(res => {
            console.log(res.data.data);
            menus.value = res.data.data
        })
        .catch(err => {
            console.log(err);
        })
}

onMounted(() => {
    fetchMenus()
});

</script>

<template>
    <div>
        <Navbar />
        <Sidebar />
        <div class="content-wrapper">
            <div class="container">
                <div v-for="m in menus" :key="m.id" class="ml-5">
                    <input class="form-check-input" type="checkbox" id="read" data-aksi="lihat">
                    <label class="form-check-label" for="read">{{ m.name }}</label>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>