<script setup>
// import QRious from 'qrious';
import { onMounted, ref } from 'vue';
import QrcodeVue from 'qrcode.vue' //pake yang ini
import jsPDF from 'jspdf';
import api from '../../api';
const barangs = ref([])

// const value = 'https://example.com'
// const size = 300

const getBarang = async () => {
    const response = await api.get("/api/inventory/barang")
    barangs.value = response.data.data
};

onMounted(() => {
    getBarang()
})

// function print() {
//     const doc = new jsPDF();
//     doc.text("Hello world!", 10, 10);
//     doc.save("a4.pdf");
// }


// const printPreview = async () => {
//     // await getBarang()
//     const response = await api.get("/api/inventory/barang")
//     barangs.value = response.data

//     const printWindow = window.open('', '', 'width=600,height=600');
//     printWindow.document.open();
//     printWindow.document.write(`
//     <html>
//   <head>
//     <title>Print Preview</title>
//   </head>
//   <body>
//     <table>
//       <thead>
//         <tr>
//           <th>ID</th>
//           <th>Name</th>
//           <th>Price</th>
//         </tr>
//       </thead>
//       <tbody>
//         ${generateTableRows(barangs.value)}
//       </tbody>
//     </table>
//   </body>
//   </html>
//       `);
//     printWindow.document.close();
//     printWindow.print();
// };

// <script src="https://cdn.jsdelivr.net/npm/qrious@4.1.1/dist/qrious.min.js">

// const printPreview = async () => {
//     const response = await api.get("/api/inventory/barang")
//     const barangsData = response.data.data;

//     const printWindow = window.open('', '', 'width=600,height=600');
//     printWindow.document.open();
//     printWindow.document.write(`
//     <html>
//         <head>
//             <title>Print Preview</title>
//         </head>
//         <body>
//             <table>
//             <thead>
//                 <tr>
//                     <th>ID</th>
//                     <th>Name</th>
//                     <th>Price</th>
//                     <th>QR Code</th>
//                 </tr>
//             </thead>
//             <tbody>
//                 ${barangsData.map((barang, index) => `
//                     <tr>
//                         <td>${barang.id}</td>
//                         <td>${barang.name}</td>
//                         <td>${barang.price}</td>
//                         <td>
//                             <img src="${await generateQRCode('A' + barang.id)}" alt="QR Code" />
//                         </td>
//                     </tr>
//                 `).join('')}
//             </tbody>
//             </table>
//         </body>
//     </html>
//     `);

//     // <qrcode-vue :value="${barang.name}" :size="50" level="H" />

//     printWindow.document.close();
//     printWindow.print();
// };

const printPreview = () => {
    const doc = new jsPDF();
    var elementHTML = document.querySelector("#table");

    doc.html(elementHTML, {
        callback: function (doc) {
            // Save the PDF
            // doc.save('sample-document.pdf');
            doc.output('dataurlnewwindow');
        },
        x: 15,
        y: 15,
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
    });
};

</script>

<template>
    <div class="container">
        <!-- <div class="my-3">
            <qrcode-vue :value="GHJK12" :size="50" level="H" />
        </div> -->

        <!-- <button type="button" class="btn btn-primary" @click="print">Print</button> -->
        <button type="button" class="btn btn-primary" @click="printPreview">Print</button>

        <div class="my-3">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(b, index) in barangs" :key="index">
                        <td>{{ b.id }}</td>
                        <td>{{ b.name }}</td>
                        <td>{{ b.price }}</td>
                        <td><qrcode-vue :value="b.name" :size="50" level="H" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>