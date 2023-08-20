<script setup>
import $ from "jquery"
import { onMounted, ref } from "vue";
import api from "../../api";

const idUser = 3;
const menus = ref([''])
const getMenus = async () => {
    const response = await api.post("api/get-menus-v2", { idUser })
    console.log(response);
    menus.value = response.data.data
}

onMounted(() => {
    getMenus()
    $('[data-widget="treeview"]').Treeview('init')
});
</script>
<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="../../index3.html" class="brand-link elevation-4">
            <img src="../../assets/logoo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>
        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../assets/logoo.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li v-for="m in menus" :key="m.headerId" class="nav-item">

                        <a :href="m.header_url" class="nav-link">
                            <i :class="['nav-icon', m.header_icon]"></i>
                            <p>
                                {{ m.header_name }}
                                <i v-if="m.header_url == '#'" class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul v-if="m.header_url == '#'" class="nav nav-treeview">
                            <li v-for="submenu in m.submenus" :key="submenu.id" class="nav-item">
                                <a :href="submenu.detail_url" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ submenu.detail_name }}</p>
                                </a>
                            </li>
                        </ul>

                    </li>


                </ul>
            </nav>

        </div>
    </aside>
</template>

<script>


export default {
    name: 'Sidebar'
}
</script>
