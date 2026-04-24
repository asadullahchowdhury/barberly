import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min'
window.bootstrap = bootstrap

import axios from "axios";

import App from "./App.vue";
import {createApp} from "vue";
import router from "./router/router";

createApp(App)
    .use(router,  axios)
    .mount('#app')

