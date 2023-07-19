/** @format */

const requireAuth = (to, from, next) => {
  const user = JSON.parse(localStorage.getItem("user"));
  if (to.name === "barang") {
    // Akses halaman "barang" membutuhkan pengguna yang sudah login dan memiliki peran (role) admin
    if (user && user.user.role === "admin") {
      next(); // Lanjutkan navigasi
    } else {
      next({ path: "/dashboard" }); // Redirect ke halaman dashboard
    }
  } else if (to.name === "dashboard") {
    // Akses halaman "dashboard" membutuhkan pengguna yang sudah login
    if (user) {
      next(); // Lanjutkan navigasi
    } else {
      next({ path: "/" }); // Redirect ke halaman login
    }
  } else {
    next(); // Halaman lain, izinkan akses
  }
};

export default requireAuth;
