/** @format */

import axios from "axios";

const Api = axios.create({
  baseURL: "http://172.28.16.1:8000",
});

export default Api;
