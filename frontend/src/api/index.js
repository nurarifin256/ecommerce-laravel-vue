/** @format */

import axios from "axios";

const Api = axios.create({
  baseURL: "http://192.168.215.76:8000",
});

export default Api;
