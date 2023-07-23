/** @format */

import { createRouter, createWebHistory } from "vue-router";
import requireAuth from "./requireAuth";
import JlDatatable from "../views/barang/baranView.vue";

const routes = [
  {
    path: "/",
    name: "login",
    component: () => import("../views/auth/LoginView.vue"),
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import("../views/DashboardView.vue"),
    beforeEnter: requireAuth,
  },
  {
    path: "/barang",
    name: "barang",
    component: () => import("../views/barang/BarangView.vue"),
    beforeEnter: requireAuth,
  },
  {
    path: "/barang-table",
    name: "barang-table",
    component: () => import("../views/barang/BarangTableView.vue"),
  },
  {
    path: "/table-barang",
    name: "table-barang",
    component: () => import("../views/barang/TableBarangView.vue"),
  },
  {
    path: "/baran",
    name: "baran",
    component: JlDatatable,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
