<script setup>
// import QRious from 'qrious';
import { onMounted, ref } from 'vue';
import QrcodeVue from 'qrcode.vue' //pake yang ini
import jsPDF from 'jspdf';
import html2pdf from 'html2pdf.js';
import api from '../../api';
const barangs = ref([])
// const barangs2 = ref([])

// const value = 'https://example.com'
// const size = 300

const getBarang = async () => {
    const response = await api.get("/api/inventory/barang")
    console.log(response);
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
    doc.setFontSize(20);
    var elementHTML = document.querySelector("#table");

    // doc.html(elementHTML, {
    //     callback: function (doc) {
    //         // Save the PDF
    //         // doc.save('sample-document.pdf');
    //         doc.output('dataurlnewwindow');
    //         // doc.output("stream");
    //     },
    //     x: 15,
    //     y: 15,
    //     width: 170, //target width in the PDF document
    //     windowWidth: 650 //window width in CSS pixels
    // });

    doc.html(elementHTML, {
        callback: function (doc) {
            doc.save();
        },
        x: 10,
        y: 10,
        width: 170,
        windowWidth: 650
    });

};

const printPreview2 = async () => {
    const element = document.getElementById('table');

    // Konfigurasi HTML2PDF
    const pdfOptions = {
        margin: 10,
        filename: 'print-preview.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
    };

    html2pdf(element).set(pdfOptions).output();
    // html2pdf().from(element).set(pdfOptions).outputPdf();

    // const blob = new Blob([pdfBlob], { type: 'application/pdf' });
    // const url = window.URL.createObjectURL(blob);
    // window.open(url, '_blank');


    // html2pdf(element).toPdf();
    // var opt = {
    //     margin: 1,
    //     filename: 'myfile.pdf',
    //     html2canvas: { scale: 2 },
    //     jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    // };

    // New Promise-based usage:
    // html2pdf().set(opt).from(element).save();
    // html2pdf().set(opt).from(element).output();

    // window.open('_blank');

    // const response = await api.get("/api/inventory/barang");
    // const barangs2 = response.data.data;

    // console.log(barangs2);

    // Render tampilan "print preview" sebagai PDF
    //     const printPreviewHTML = `
    //     <table>
    //       <thead>
    //         <tr>
    //           <th>ID</th>
    //           <th>Name</th>
    //           <th>Price</th>
    //         </tr>
    //       </thead>
    //       <tbody>
    //         </tbody>
    //         ${barangs2.map((barang, index) => `
    //             <tr>
    //                 <td>${barang.id}</td>
    //                 <td>${barang.name}</td>
    //                 <td>${barang.price}</td>
    //             </tr>
    //         `).join('')}
    //     </table>
    //   `;

    //     // Konfigurasi HTML2PDF
    //     const pdfOptions = {
    //         margin: 10,
    //         filename: 'print-preview.pdf',
    //         image: { type: 'jpeg', quality: 0.98 },
    //         html2canvas: { scale: 2 },
    //         jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
    //     };

    //     const pdf = await html2pdf().from(printPreviewHTML).set(pdfOptions).outputPdf();

    //     // Buka tampilan "preview" dalam jendela baru
    //     const blob = new Blob([pdf], { type: 'application/pdf' });
    //     const url = window.URL.createObjectURL(blob);
    //     window.open(url, '_blank');


    // const pdf = await html2pdf().from(printPreviewHTML).set(pdfOptions).outputPdf();

    // // Unduh PDF
    // const blob = new Blob([pdf], { type: 'application/pdf' });
    // const url = window.URL.createObjectURL(blob);
    // const a = document.createElement('a');
    // a.href = url;
    // a.download = 'print-preview.pdf';
    // a.click();
};

</script>

<template>
    <div class="container">
        <!-- <div class="my-3">
            <qrcode-vue :value="GHJK12" :size="50" level="H" />
        </div> -->

        <!-- <button type="button" class="btn btn-primary" @click="print">Print</button> -->
        <button type="button" class="btn btn-primary" @click="printPreview">Print</button>
        <button type="button" class="btn btn-primary" @click="printPreview2">Print 2</button>

        <div class="my-3" id="table">
            <table class="table table-bordered">
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