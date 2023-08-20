/** @format */

import axios from "axios";

const Api = axios.create({
  baseURL: "http://192.168.70.76:8000",
});

export default Api;
