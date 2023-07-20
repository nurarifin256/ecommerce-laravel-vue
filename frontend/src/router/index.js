/** @format */

import { createRouter, createWebHistory } from "vue-router";
import requireAuth from "./requireAuth";

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
    path: "/baran",
    name: "baran",
    component: () => import("../views/barang/baranView.vue"),
    beforeEnter: requireAuth,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
