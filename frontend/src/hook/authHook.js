/** @format */
import api from "../api";

export async function loginUser(formData) {
  try {
    const response = await api.post("/api/auth/login", formData);
    const data = response.data;

    if (data.message === "Wrong email or password") {
      return { error: true, message: data.message };
    }

    localStorage.setItem("user", JSON.stringify(data.data));
    return { error: false, data: data.data };
  } catch (error) {
    if (error.response) {
      return { error: true, message: error.response.data.errors };
    } else {
      return { error: true, message: "Network error" };
    }
  }
}
