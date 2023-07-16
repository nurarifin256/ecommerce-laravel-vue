/** @format */

//import axios
import axios from "axios";

const Api = axios.create({
  //set default endpoint API
  baseURL: "http://192.168.255.76:8000",
});

export default Api;
