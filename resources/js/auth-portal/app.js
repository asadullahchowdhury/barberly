
import axios from "axios";
import VOtpInput from "vue3-otp-input";
import App from "./App.vue";
import {createApp} from "vue";
import router from "./router/router";
createApp(App).component('v-otp-input', VOtpInput).use(router, axios)
    .mount('#app')

