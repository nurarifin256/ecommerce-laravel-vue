<script setup>
// import jsPDF from 'jspdf';
import { ref } from 'vue';
import QRious from 'qrious';
import api from '../../api';
const barangs = ref([])

const getBarang = async () => {
    const response = await api.get("/api/inventory/barang")
    console.log(response.data);
    barangs.value = response.data.data
};

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

const printPreview = async () => {
    const response = await api.get("/api/inventory/barang")
    // barangs.value = response.data
    const barangsData = response.data.data;


    const printWindow = window.open('', '', 'width=600,height=600');
    printWindow.document.open();
    printWindow.document.write(`
    <html>
        <head>
            <title>Print Preview</title>
        </head>
        <body>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>
                ${barangsData.map((barang, index) => `
                    <tr>
                        <td>${barang.id}</td>
                        <td>${barang.name}</td>
                        <td>${barang.price}</td>
                        <td><div id="qrcode-${index}"></div></td>
                    </tr>
                `).join('')}
            </tbody>
            </table>
        </body>
    </html>
    `);

    // Generate QR codes
    barangsData.forEach((barang, index) => {
        const qrCode = new QRious({
            element: document.getElementById(`qrcode-${index}`),
            value: `${barang.id}`,
            size: 100,
        });
    });

    printWindow.document.close();
    printWindow.print();
};

</script>

<template>
    <div class="container">
        <!-- <button type="button" class="btn btn-primary" @click="print">Print</button> -->
        <button type="button" class="btn btn-primary" @click="printPreview">Print</button>
    </div>
</template>