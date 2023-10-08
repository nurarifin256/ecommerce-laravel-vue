<script setup>
import QrcodeVue from 'qrcode.vue'
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import api from '../../api';

const route = useRoute()
const router = useRouter()
const val = ref([])
const qrcode = ref(route.params.bar);

// router.push('/').catch(() => { })
const getBarang = async () => {
    const response = await api.post('/api/get-barang/print', { bar: qrcode.value })
    val.value = response.data.data
    // window.print()
};

const print = () => {
    getBarang();
    const printContainer = document.getElementById('print-container');
    printContainer.style.display = 'block';
    window.print();
    printContainer.style.display = 'none';
};

// const print = () => {
//     getBarang();
//     const printContainer = document.getElementById('print-container');
//     printContainer.style.display = 'block';

//     const printWindow = window.open('', '_blank');
//     printWindow.document.open();
//     printWindow.document.write('<html><head><title>Cetak</title></head><body>');
//     printWindow.document.write(printContainer.innerHTML);
//     printWindow.document.write('</body></html>');
//     printWindow.document.close();
//     printWindow.print();
//     printWindow.close();

//     printContainer.style.display = 'none';
// };

onMounted(() => {
    getBarang()
    setTimeout(() => {
        print();
    }, 5000);
});
</script>

<!-- <p>this is show page</p>
<p>{{ qrcode }}</p> -->
<template>
    <!-- <div class="mt-3">
        <ul>
            <li v-for="(item, index) in val" :key="index">
                <qrcode-vue :value="item.name" :size="50" level="H" />
            </li>
        </ul>
    </div> -->

    <div>
        <div id="print-container" style="display: none;">
            <ul>
                <li v-for="(item, index) in val" :key="index">
                    <qrcode-vue :value="item.name" :size="50" level="H" />
                </li>
            </ul>
        </div>
    </div>
</template>