<template>

    <section class="form-section" v-if="step === 'reset_password'">

        <!-- Route back to password -->
        <router-link :to="{name: 'Password'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div class="text-center mt-2">
            <img :src="`/images/global/logo.svg`" class="logo img-fluid" alt="logo">
        </div>

        <div class="h4 pt-5 text-center fw-semibold text-brand-dark-grey">Forgot password?</div>

        <div class="alert alert-danger rounded-3 text-center mt-3" v-if="error">The selected email is invalid.</div>
        <div class="d-flex justify-content-center">
            <div class="py-3 text-center text-black-opacity-55">
                We’ll send you a secure link to create a password to <span
                class="fw-semibold"> {{ formData.email }} </span>
            </div>
        </div>

        <!-- Forget request form -->
        <form autoComplete="off">

            <div class="pb-3 form-group">
                <button v-if="!loading" type="submit" name="reset_password" class="btn btn-theme w-100"
                        @click="forgotRequest">
                    Reset Password
                </button>

                <button type="button" v-if="loading" class="btn btn-theme btn-loading height-45 w-100">
                    <span class="loading"></span>
                </button>
            </div>

        </form>

        <div class="pb-3 text-center">
            <div class="fw-semibold mb-2">
                Have a business account?
            </div>
            <a href="/portal/auth/sign-in" target="_blank" class="text-theme text-decoration-none">
                Sign in as a professional
            </a>
            to manage your business and clients
        </div>

    </section>

    <section class="form-section" v-if="step === 'email-sent'">

        <!-- Route back to password -->
        <router-link :to="{name: 'Password'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div class="pt-5 text-center mb-3">
            <img :src="'/images/authentication/check.svg'" class="w-25 h-25" alt="check.svg">
        </div>

        <div class="text-center h4 fw-semibold">
            Reset password email has been sent to {{ formData.email }}.
        </div>

        <div class="text-center mt-3 text-black-opacity-55">
            Please check your inbox to reset your password. If you didn’t receive your email, please check your junk
            mail
        </div>

        <div class="mt-3">
            <router-link :to="{name: 'Password'}" class="btn btn-theme w-100">
                Continue to login
            </router-link>
        </div>

        <div class="mt-3 text-center">
            <div class="fw-semibold">
                Have a business account?
            </div>
            <div class="mt-2">
                <a href="/portal/auth/sign-in" target="_blank" class="text-theme text-decoration-none"> Sign in as a
                    professional </a> to manage your business and clients
            </div>
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
})

export default {

    data() {

        return {
            // Data properties for the component
            step: 'reset_password',
            formData: {
                email: '',
            },
            loading: false,
            error: false,
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

        // Function of forget password request
        forgotRequest() {
            this.error = false;
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.patch(apiRoutes.ForgotRequest, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.error = false;
                this.step = 'email-sent'

            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    this.error = true;
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

    }

}

</script>
