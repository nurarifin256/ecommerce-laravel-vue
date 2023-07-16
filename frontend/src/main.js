/** @format */

import App from "./App.vue";
import router from "./router";
import { createApp } from "vue";
import { createPinia } from "pinia";

import "admin-lte/plugins/fontawesome-free/css/all.min.css";
import "admin-lte/dist/css/adminlte.min.css?v=3.2.0";

import "admin-lte/plugins/jquery/jquery.min.js";
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js";
import "admin-lte/dist/js/adminlte.min.js";

const app = createApp(App);

app.use(createPinia());

app.use(router);

app.mount("#app");
