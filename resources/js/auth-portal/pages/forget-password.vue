<template>

    <!-- Route to go password -->
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <router-link :to="{name: 'Password', state: {email:this.formData.email,provider:this.provider}}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>

    <!-- Forgot section -->
    <div v-if="step === 'send-request'">
        <div class="logo">
            <img :src="'/images/global/logo.svg'" alt="logo.png">
        </div>
        <div class="form-center">
            <!-- Send request -->
            <div class="form-section">
                <div class="title padding-top-56 padding-bottom-26">
                    Forget your Business account password, {{ formData.email }}?
                </div>
                <div class="subtitle">
                    We'll send you a secure link to create a new password to <b class="text-dark">{{ this.formData.email }} ?</b>
                </div>

                <div class="form-group padding-bottom-16">
                    <a href="javascript:void(0)" class="btn-theme btn-anchor w-100 padding-x-12" @click="forgotRequest"
                       v-if="!loading">
                        <span class="btn-text"> Reset Password </span>
                    </a>

                    <a href="javascript:void(0)" class="btn btn-theme btn-anchor btn-loading w-100 padding-x-12" v-if="loading">
                        <span class="loading"></span>
                    </a>
                </div>
                <div class="mid-title">
                    Remembered your password?
                </div>
               <div class="text-center">
                   <router-link :to="{name: 'Password' ,state: {email:this.formData.email,provider:this.provider}}"
                                class="text-theme underline-anim  d-inline-block">
                       Go back to login
                   </router-link>
               </div>
            </div>
        </div>
    </div>

    <!-- Reset mail text -->
    <div class="form-center" v-if="step === 'email-sent'">
        <div class="check text-center">
            <img :src="'/images/authentication/check.svg'" alt="check.svg">
        </div>
        <div class="title padding-top-20 padding-bottom-20">
            Reset email sent!
        </div>
        <div class="form-center">
            <!-- Your junk mail folder -->
            <div class="form-section">
                <div class="subtitle">
                    Please check your inbox to reset your password. if you didn't receive your email.
                    Please check your junk mail folder.
                </div>
                <div class="form-group padding-bottom-16">
                    <router-link :to="{name: 'Sign-In'}" class="btn-theme btn-anchor w-100">
                        <span class="btn-text">
                            back to login
                        </span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
const toaster = createToaster({
    position: 'top-left',
});

export default {

    data() {

        return {
            // Data properties for the component
            step: 'send-request',
            formData: {
                email: '',
            },
            loading: false,
            provider: '',
        }

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.history.state.email !== undefined) {
            this.formData.email = window.history.state.email;
            this.provider = window.history.state.provider;
        } else {
            this.$router.push({name: 'Sign-In'})
        }

    },

    methods: {

        // Forget password request
        forgotRequest() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.patch(apiRoutes.ForgotRequest, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.step = 'email-sent'
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined){
                    apiService.ErrorHandler(res?.data?.errors);
                }else {
                    toaster.error('Server error!')
                }
            })
        },
    }
}

</script>
