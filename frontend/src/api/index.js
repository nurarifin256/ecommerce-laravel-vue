/** @format */

import axios from "axios";

const Api = axios.create({
  baseURL: "http://192.168.137.76:8000",
});

export default Api;
