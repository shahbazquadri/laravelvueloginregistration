import "./bootstrap";
import router from "./router.js";
import { createApp } from "vue";
import App from "./layouts/app.vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

const app = createApp(App);
app.use(router);
app.mount("#app");
