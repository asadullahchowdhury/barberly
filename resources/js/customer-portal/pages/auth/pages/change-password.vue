<template>

    <section class="form-section">

        <!-- Route back to password -->
        <router-link :to="{name: 'Password'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div v-if="step === 'change-password'">

            <div class="text-center mt-2">
                <img :src="`/images/global/logo.svg`" class="logo img-fluid" alt="logo">
            </div>

            <div class="h4 pt-5 text-center fw-semibold text-brand-dark-grey">Change password</div>

            <div class="d-flex justify-content-center">
                <div class="py-3 text-center text-black-opacity-55 col-12 col-md-9">
                    Please enter a new password below for <span class="fw-semibold"> {{ formData.email }} </span>
                </div>
            </div>

            <!-- Update password form -->
            <form @submit.prevent="updatePassword" autoComplete="off">

                <div class="pb-3 form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input id="password" :type="passwordFieldType" name="password" class="form-control"
                               v-model="formData.password"
                               placeholder="Enter your password" autoComplete="off">
                        <a href="javascript:void(0)" class="position-absolute end-0 top-50 translate-middle-y pe-3"
                           @click="passwordVisibility">
                            <span v-if="passwordFieldType === 'text'">
                                <img :src="`/images/authentication/eye.svg`" class="img-fluid w-20 h-20" alt="eye">
                            </span>
                            <span v-if="passwordFieldType === 'password'">
                                <img :src="`/images/authentication/eye-off.svg`" class="img-fluid w-20 h-20" alt="eye">
                            </span>
                        </a>
                    </div>
                    <div class="error-report"></div>
                </div>

                <div class="pb-3 form-group">
                    <label for="password" class="form-label">Confirm Password</label>
                    <div class="position-relative">
                        <input id="password" :type="conformPasswordFieldType" name="password" class="form-control"
                               v-model="formData.password_confirmation"
                               placeholder="Enter your password" autoComplete="off">
                        <a href="javascript:void(0)" class="position-absolute end-0 top-50 translate-middle-y pe-3"
                           @click="confirmPasswordVisibility">
                            <span v-if="conformPasswordFieldType === 'text'">
                                <img :src="`/images/authentication/eye.svg`" class="img-fluid w-20 h-20" alt="eye">
                            </span>
                            <span v-if="conformPasswordFieldType === 'password'">
                                <img :src="`/images/authentication/eye-off.svg`" class="img-fluid w-20 h-20" alt="eye">
                            </span>
                        </a>
                    </div>
                    <div class="error-report"></div>
                </div>

                <div class="pb-3 form-group">
                    <button v-if="!loading" type="submit" class="btn btn-theme height-45 w-100">Update Password</button>
                    <button type="button" v-if="loading" class="btn btn-theme btn-loading height-45 w-100">
                        <span class="loading"></span>
                    </button>
                </div>

            </form>

        </div>

        <div v-if="step === 'password-updated'" class="text-center">

            <div class="text-center mb-3">
                <img :src="`/images/authentication/check.svg`" class="w-90 h-90" alt="check.svg">
            </div>

            <div class="py-1 h3 fw-semibold">
                Password updated!
            </div>

            <p class="d-block text-secondary text-opacity-75">
                You have successfully changed your password from <b class="text-dark"> {{ formData.email }} </b>.
                you can now log in with your new details
            </p>

            <div class="pt-1">
                <router-link :to="{name: 'Sign-In'}" class="btn-theme w-100">
                    back to login
                </router-link>
            </div>

        </div>

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
            step: 'change-password',
            passwordFieldType: 'password',
            conformPasswordFieldType: 'password',
            formData: {
                email: '',
                token: '',
                password: '',
                password_confirmation: '',
            },
            loading: false,
            user: true,
        }

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        this.formData.token = this.$route.params.token;
        this.getAccount();

    },

    methods: {

        // Function of get account api
        getAccount() {
            let formData = {token: this.formData.token}
            axios.get(apiRoutes.GetAccount, {params: formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.formData.email = res.user.email;
            }).catch(err => {
                let res = err.response
                if(res?.data?.errors !== undefined) {
                    this.user = false;
                    this.$router.push({name: 'Sign-In'})
                }else {
                    this.$router.push({name: 'Sign-In'})
                    toaster.error('User not found!')
                }
            })
        },

        // Function of update password
        updatePassword() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.patch(apiRoutes.ResetPassword, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                toaster.info('Password has been reset successful')
                this.step = 'password-updated';
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!');
                }
            })
        },

        // Function of password visibility of password update
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        // Function of confirm password visibility of password update
        confirmPasswordVisibility() {
            this.conformPasswordFieldType = this.conformPasswordFieldType === "password" ? "text" : "password";
        },

    }

}

</script>
