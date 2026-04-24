<template>
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <img :src="'/images/global/logo.svg'" alt="logo.png">
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>
    <div class="title padding-md-top-75 padding-md-bottom-46 padding-top-60 padding-bottom-40 padding-x-20">
        Welcome back to your business account,
    </div>
    <div class="form-center">
        <div class="form-section">
            <div class="subtitle">
                Choose from provided login methods to log in as <b class="text-dark">{{ this.formData.email }}</b>
            </div>
        </div>

        <!-- Form password -->
        <div class="form-section margin-top-30">

            <form @submit.prevent="login" v-if="formData.provider === 'system'">

                <div class="alert alert-danger text-center" role="alert" v-if="error">
                    Invalid Credentials!
                </div>

                <!-- Password input -->
                <div class="form-group padding-bottom-16">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-content">
                        <input id="password" :type="passwordFieldType" name="password" placeholder="Enter a password"
                               v-model="formData.password"
                               class="form-control padding-left-20" autocomplete="new-password">

                        <a href="javascript:void(0)" class="password-hide-show" @click="passwordVisibility">
                        <span v-if="passwordFieldType === 'text'">
                            <img :src="'/images/authentication/eye.svg'" alt="eye">
                        </span>
                            <span v-if="passwordFieldType === 'password'">
                            <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                        </span>
                        </a>

                        <div class="error-report"></div>
                    </div>
                </div>

                <div class="form-group padding-bottom-16">
                    <button type="submit" class="btn-theme w-100 padding-x-12" v-if="!loading">
                        <span class="btn-text"> Continue </span>
                    </button>

                    <button type="button" class="btn-theme btn-loading w-100 padding-x-12" v-if="loading">
                        <span class="loading"></span>
                    </button>
                </div>

                <router-link :to="{name: 'Forget_password' ,state: this.formData}"
                             class="text-theme  d-inline-block underline-anim">
                    Forgot your password?
                </router-link>
            </form>

            <div class="form-section" v-if="formData.provider !== 'system'">

                <!-- Google -->
                <div class="form-group padding-bottom-16" v-if="formData.provider === 'google'">
                    <a href="javascript:void(0)" class="btn-white">Continue with Google</a>
                    <div class="icon-media">
                        <img :src="'/images/authentication/google.png'" alt="google">
                    </div>
                </div>

                <!-- Apple -->
                <div class="form-group padding-bottom-16" v-if="formData.provider === 'apple'">
                    <a href="javascript:void(0)" class="btn-white">Continue with Apple</a>
                    <div class="icon-media">
                        <img :src="'/images/authentication/apple.png'" alt="apple">
                    </div>
                </div>

                <!-- Facebook -->
                <div class="form-group padding-bottom-16" v-if="formData.provider === 'facebook'">
                    <a href="javascript:void(0)" class="btn-white">Continue with Facebook</a>
                    <div class="icon-media">
                        <img :src="'/images/authentication/facebook.png'" alt="facebook">
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>

import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});


export default {

    data() {

        return {
            // Data properties for the component
            loading: false,
            passwordType: 1,
            password: '',
            passwordFieldType: 'password',
            formData: {
                email: '',
                password: '',
                provider: 'system',
            },
            error: null,
        }

    },

    mounted() {
        // First input will be focused when the page loads
        document.getElementById('password').focus();

        // Lifecycle hook: Called after the component is mounted
        if (window.history.state.email !== undefined) {
            this.formData.email = window.history.state.email;
            this.formData.provider = window.history.state.provider;
        } else {
            this.$router.push({name: 'Sign-In'})
        }

    },

    methods: {
        // Function of password visibility
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        // Function of login dependent on password
        login() {
            this.error = null;
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.post(apiRoutes.Login, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                toaster.info('Login successfully')
                window.location.reload();
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    this.error = res?.data?.errors.error
                    if (res?.data?.errors.otp !== undefined) {
                        this.$router.push({name: 'Verification-code', state: this.formData})
                        toaster.info('Please verify you account. New otp has been sent to your email')
                    }
                } else {
                    toaster.error('Server error!')
                }
            })
        },
    }

}

</script>
