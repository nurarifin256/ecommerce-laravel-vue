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
    path: "/barang/masuk",
    name: "barang-masuk",
    component: () => import("../views/barang/BarangMasukView.vue"),
  },
  {
    path: "/barang/keluar",
    name: "barang-keluar",
    component: () => import("../views/barang/BarangKeluarView.vue"),
  },
  {
    path: "/user",
    name: "user",
    component: () => import("../views/auth/UserView.vue"),
  },
  {
    path: "/table-barang",
    name: "table-barang",
    component: () => import("../views/barang/TableBarangView.vue"),
  },
  {
    path: "/permisson",
    name: "permission",
    component: () => import("../views/permission/IndexView.vue"),
  },
  {
    path: "/modal",
    name: "modal",
    component: () => import("../views/barang/ModalView.vue"),
  },
  {
    path: "/pivot",
    name: "pivot",
    component: () => import("../views/sizes/IndexView.vue"),
  },
  {
    path: "/print",
    name: "print",
    component: () => import("../views/print/IndexView.vue"),
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
