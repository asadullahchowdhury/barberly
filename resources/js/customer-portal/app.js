import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min'
window.bootstrap = bootstrap
import axios from "axios";
import VueSplide from '@splidejs/vue-splide';
import App from "./App.vue";
import {createApp} from "vue";
import router from "./router/router";
import AOS from 'aos';
import 'aos/dist/aos.css';
createApp(App).use(router, axios, AOS.init()).use(VueSplide).mount('#app')
