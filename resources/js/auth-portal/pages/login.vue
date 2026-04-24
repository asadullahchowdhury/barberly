<template>

    <div class="logo padding-md-top-87 padding-top-70">
        <img :src="'/images/global/logo.svg'" alt="logo.png">
    </div>

    <div class="title padding-md-top-75 padding-md-bottom-46 padding-top-45 padding-bottom-35 padding-x-20">
        Signup or sign in to start managing your salon
    </div>
    <div class="form-center">

        <!-- Account check form -->
        <form class="form-section" autocomplete="off" @submit.prevent="checkAccount">

            <div class="form-group padding-bottom-16">
                <input type="email" name="email" placeholder="Email Address" id="email"
                       v-model="formData.email"
                       class="form-control" autocomplete="new-email">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-16">
                <button type="submit" class="btn-theme w-100 padding-x-12" v-if="!loading">
                    <span class="btn-text"> Continue </span>
                </button>

                <button type="button" class="btn-theme btn-loading w-100 padding-x-12" v-if="loading">
                    <span class="loading"></span>
                </button>
            </div>
        </form>

        <div class="auth-hr">
            <div class="hr"></div>
            <div class="or-text">or</div>
            <div class="hr"></div>
        </div>

        <!--  Social media buttons -->
        <div class="form-section margin-top-28">

            <!-- Google -->
            <div class="form-group padding-bottom-16">
                <a href="javascript:void(0)" class="btn-white border disable-feature">Continue with Google</a>
                <div class="icon-media">
                    <img class="disable-feature" :src="'/images/authentication/google.png'" alt="google">
                </div>
            </div>

            <!-- Apple -->
            <div class="form-group padding-bottom-16">
                <a href="javascript:void(0)" class="btn-white disable-feature">Continue with Apple</a>
                <div class="icon-media">
                    <img class="disable-feature" :src="'/images/authentication/apple.png'" alt="apple">
                </div>
            </div>

            <!-- Facebook -->
            <div class="form-group padding-bottom-16" @click="initLogin" v-if="facebookLoading === false">
                <a href="javascript:void(0)" class="btn-white">Continue with Facebook</a>
                <div class="icon-media">
                    <img :src="'/images/authentication/facebook.png'" alt="facebook">
                </div>
            </div>
            <div class="form-group padding-bottom-16 disable-feature" v-if="facebookLoading === true">
                <button type="button" class="btn btn-white btn-loading height-50 w-100">
                    <span class="loading black"></span>
                </button>
            </div>

        </div>

    </div>
</template>

<script>
import axios from "axios";
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
});


export default {

    data() {

        return {
            // Data properties for the component
            formData: {
                email: '',
                provider: 'system'
            },
            loading: false,
            facebookLoading: false,
            emailSource: true,
        }

    },

    mounted() {
        // First input will be focused when the page loads
        document.getElementById('email').focus();

        // Lifecycle hook: Called after the component is mounted
        this.initFb()
    },

    methods: {
        // Function of check account api
        checkAccount() {
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.get(apiRoutes.CheckAccount, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
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

        // Function of initialize facebook popup
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

        // Function of check facebook account api
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

        // Function of init login facebook account as show app
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
        },

    }

}

</script>
