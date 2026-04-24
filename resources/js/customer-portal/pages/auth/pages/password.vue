<template>

    <section class="form-section">

        <!-- Route back to sign-in -->
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div class="text-center mt-2">
            <img :src="`/images/global/logo.svg`" class="logo img-fluid" alt="logo">
        </div>

        <div class="h4 pt-4 text-center fw-semibold text-brand-dark-grey">Welcome back</div>

        <div class="d-flex justify-content-center">
            <div class="py-3 text-center text-black-opacity-55">
                Enter your password and login as <span class="fw-semibold"> {{ formData.email }} </span>
            </div>
        </div>

        <!-- Login form -->
        <form @submit.prevent="login" autoComplete="off">

            <div class="alert alert-danger text-center" role="alert" v-if="error !== null" v-text="error"></div>

            <!-- Password input -->
            <div class="pb-2 form-group">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <input id="password" :type="passwordFieldType" name="password" class="form-control"
                           v-model="formData.password"
                           placeholder="Enter your password" autoComplete="off">
                    <a href="javascript:void(0)" class="position-absolute end-0 top-50 translate-middle-y pe-3"
                       @click="passwordVisibility">
                        <span v-if="passwordFieldType === 'text'">
                            <img :src="`/images/authentication/eye.svg`" class="img-fluid"
                                 style="width: 20px; height: 20px;" alt="eye">
                        </span>
                        <span v-if="passwordFieldType === 'password'">
                            <img :src="`/images/authentication/eye-off.svg`" class="img-fluid"
                                 style="width: 20px; height: 20px;" alt="eye">
                        </span>
                    </a>
                </div>
                <div class="error-report"></div>
            </div>

            <!-- Route go to forget password -->
            <div class="text-end">
                <router-link :to="{name: 'Forget_password',state:formData}" class="text-decoration-none underline-anim d-inline-block mb-3 text-theme">
                    Forget your password ?
                </router-link>
            </div>

            <div class="pb-3 form-group">
                <button v-if="!loading" type="submit" class="btn btn-theme height-45 w-100">
                    Login
                </button>
                <button v-if="loading" type="submit" class="btn btn-theme btn-loading height-45 w-100">
                    <span class="loading"></span>
                </button>

            </div>

        </form>

    </section>

</template>

<script>

import apiService from "../../../../services/apiService";
import apiRoutes from "../../../apiRoutes/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});

export default {

    data() {

        return {
            // Data properties for the component
            formData: {
                email: '',
                password: '',
            },
            passwordFieldType: 'password',
            loading: false,
            error: null,
        }

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.history.state.email !== undefined) {
            this.formData.email = window.history.state.email;
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
            this.error = null,
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.post(apiRoutes.Login, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                toaster.info('Login successfully')
                window.location.href = '/customer';
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    if (res?.data?.errors.error !== undefined){
                        this.error = res?.data?.errors.error;
                    }
                } else {
                    toaster.error('Server error!')
                }
            })
        },
    }

}

</script>
