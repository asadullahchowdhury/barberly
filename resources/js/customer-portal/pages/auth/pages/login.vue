<template>

    <section class="form-section">

        <!-- Route back to sign-in -->
        <router-link :to="{name: 'UserFlow'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div class="text-center mt-2">
            <img :src="`/images/global/logo.svg`" class="logo img-fluid" alt="logo">
        </div>

        <div class="h4 pt-5 text-center text-brand-dark-grey fw-semibold">Barberly for customers</div>

        <div class="d-flex justify-content-center">
            <div class="py-3 col-12 col-md-9 text-black-opacity-55 text-center">
                Create an account or log in to book and manage your appointments.
            </div>
        </div>

        <!-- This is login system for facebook user -->
        <div class="pb-3">
            <button type="button" class="btn-white has-border position-relative height-50 w-100" @click="initLogin"
                    v-if="facebookLoading === false">
                <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                    <img :src="`/images/authentication/facebook.png`" alt="facebook">
                </span>
                Continue with facebook
            </button>
            <button type="button" class="btn-white has-border btn-loading w-100 height-50 disable-feature"
                    v-if="facebookLoading === true">
                <span class="loading black"></span>
            </button>
        </div>

        <!-- This is login system for google user -->
        <div class="pb-3">
            <button type="button" class="btn-white has-border position-relative height-50 w-100 disable-feature">
                <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                    <img :src="`/images/authentication/google.png`" alt="google">
                </span>
                Continue with google
            </button>
        </div>

        <div class="auth-hr my-3">
            <div class="hr"></div>
            <div class="or-text">or</div>
            <div class="hr"></div>
        </div>

        <!-- Action form for customer portal -->
        <form @submit.prevent="checkAccount" autocomplete="off">

            <div class="pb-3 form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email"
                       autocomplete="new-email" v-model="formData.email">
                <div class="error-report"></div>
            </div>

            <div class="pb-3 form-group">
                <button type="submit" v-if="!loading" class="btn btn-theme height-45 w-100">
                    Continue
                </button>

                <button type="button" v-if="loading" class="btn btn-theme btn-loading height-45 w-100">
                    <span class="loading"></span>
                </button>
            </div>

        </form>

        <!-- This is route for professional business -->
        <div class="pb-3 text-center">
            Have a business account?
            <a href="/portal/auth/sign-in" target="_blank" class="text-decoration-none text-theme d-block">
                Sign in as a professional
            </a>
        </div>

    </section>

</template>

<script>

import apiService from "../../../../services/apiService";
import apiRoutes from "../../../apiRoutes/apiRoutes.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
});

(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk')
);

export default {

    data() {

        return {
            // Data properties for the component
            formData: {
                email: '',
            },
            loading: false,
            facebookLoading: false,
        }

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        this.initFb()
    },

    methods: {

        // Function of check account api
        checkAccount() {
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.get(apiRoutes.CheckAccount, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.loading = false;
                this.formData.provider = res.provider;
                if (res.provider === 'register') {
                    this.$router.push({name: 'Registration', state: this.formData})
                } else {
                    this.$router.push({name: 'Password', state: this.formData})
                }
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of Initialize facebook popup
        initFb() {
            (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) {
                        return;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk')
            );
        },

        loginFacebook(facebookInfo) {
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.post(apiRoutes.LoginFacebook, facebookInfo, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.facebookLoading = false;
                this.loading = false;
                this.formData.provider = res.provider;
                window.location.reload()
            }).catch(err => {
                this.facebookLoading = false;
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        initLogin: function () {
            let _this = this;
            this.facebookLoading = true
            FB.init({
                appId: '176091665574404',
                xfbml: true,
                version: 'v18.0',
                autoLogAppEvents: true,
            });
            FB.login(function (response) {
                if (response.authResponse) {
                    FB.api('/me', {fields: 'id, first_name, last_name, name, email'}, function (response) {
                        let param = {
                            first_name: response.first_name,
                            last_name: response.last_name,
                            provider_id: response.id,
                        }
                        _this.loginFacebook(param)
                    });
                } else {
                    _this.facebookLoading = false
                }
            });
        }
    }

}

</script>
