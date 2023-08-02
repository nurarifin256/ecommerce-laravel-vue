/** @format */

import api from "../api";

export async function getBarangs() {
  const response = await api.get("/api/inventory/barang");
  const data = JSON.stringify(response.data);
  return data;
}
