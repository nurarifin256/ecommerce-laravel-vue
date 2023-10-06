<script setup>
import QrcodeVue from 'qrcode.vue'
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

const route = useRoute()
const router = useRouter()
const val = ref([])
const qrcode = ref(route.params.bar);

const getBarang = async () => {
    const response = await api.post('/api/get-barang/print', { bar: qrcode.value })
    console.log(response.data);
    val.value = response.data.data
    window.print()
    // router.push('/').catch(() => { })
};

onMounted(() => {
    getBarang()
});
</script>

<template>
    <!-- <p>this is show page</p>
    <p>{{ qrcode }}</p> -->
    <div class="mt-3">
        <ul>
            <li v-for="(item, index) in val" :key="index">
                <qrcode-vue :value="item.name" :size="50" level="H" />
            </li>
        </ul>
    </div>
</template>