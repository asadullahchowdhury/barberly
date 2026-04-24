<template>

    <section class="form-section">

        <!-- Route back to sign-in -->
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>

        <div class="text-center mt-2">
            <img :src="'/images/global/logo.svg'" class="logo img-fluid" alt="logo.png">
        </div>

        <div class="h4 pt-5 text-center fw-semibold text-brand-dark-grey">Create account</div>

        <div class="d-flex justify-content-center">
            <div class="py-3 text-center text-black-opacity-55">
                You're almost there! Create your new account for
                <span class="fw-semibold"> {{ formData.email }} </span>
                by completing these details
            </div>
        </div>

        <!-- Registration form action -->
        <form @submit.prevent="register" autocomplete="off" class="mb-5">

            <!-- First name input -->
            <div class="pb-3 form-group">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter your first name"
                       autocomplete="new-first-name" v-model="formData.first_name">
                <div class="error-report"></div>
            </div>

            <!-- Last name input -->
            <div class="pb-3 form-group">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter your last name"
                       autocomplete="new-last-name" v-model="formData.last_name">
                <div class="error-report"></div>
            </div>

            <!-- Password input -->
            <div class="pb-3 form-group">
                <label for="password" class="form-label">Password</label>
                <div class="position-relative">
                    <input id="password" :type="passwordFieldType" name="password" class="form-control"
                           placeholder="Enter your password" autoComplete="new-password" v-model="formData.password">
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

            <!-- Confirm password input -->
            <div class="pb-3 form-group">
                <label for="password" class="form-label">Confirm Password</label>
                <div class="position-relative">
                    <input id="password" :type="conformPasswordFieldType" name="password" class="form-control"
                           placeholder="Enter your password" autoComplete="new-confirm-password"
                           v-model="formData.password_confirmation">

                    <a href="javascript:void(0)" class="position-absolute end-0 top-50 translate-middle-y pe-3"
                       @click="confirmPasswordVisibility">
                        <span v-if="conformPasswordFieldType === 'text'">
                            <img :src="`/images/authentication/eye.svg`" class="img-fluid w-20 h-20" alt="eye">
                        </span>
                        <span v-if="conformPasswordFieldType === 'password'">
                            <img :src="`/images/authentication/eye-off.svg`" class="img-fluid w-20 h-20" alt="eye">
                        </span>
                    </a>

                    <div class="error-report"></div>
                </div>
            </div>

            <!-- Mobile input -->
            <div class="pb-3 form-group">
                <label for="mobile_number" class="form-label">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" placeholder="Enter your mobile number"
                       @keypress="checkNumber($event)" autocomplete="new-mobile-number">
                <div class="error-report"></div>
            </div>

            <!-- Terms and condition or privacy and policy -->
            <div class="form-group mb-4">
                <label for="check-privacy" class="form-label line-height-2 mb-2">
                    <input type="checkbox" id="check-privacy" class="form-checkbox" :checked="privacyPolicy === 1"
                           @change="privacyPolicyCheck">
                    I agree to the <a href="javascript:void(0)" class="text-decoration-none underline-anim text-theme">
                    Privacy
                    Policy </a>,
                    <a href="javascript:void(0)" class="text-decoration-none underline-anim text-theme"> Terms of
                        Use </a> and
                    <a href="javascript:void(0)" class="text-decoration-none underline-anim text-theme"> Terms of
                        Service </a>
                </label>
            </div>

            <div class="form-group pb-3">
                <label for="marketing-notification" class="form-label line-height-2 mb-2">
                    <input type="checkbox" id="marketing-notification" class="form-checkbox">
                    I agree to receive marketing notifications with offers and news
                </label>
            </div>

            <!-- This is privacy and policy after switch it access to registration successfully -->
            <div class="pb-3 form-group">
                <button type="submit" v-if="!loading" class="btn btn-theme height-45 w-100"
                        :disabled="privacyPolicy === 2">
                    Continue
                </button>

                <button type="button" v-if="loading" class="btn btn-theme btn-loading height-45 w-100">
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
            password: '',
            passwordFieldType: 'password',
            conformPassword: '',
            conformPasswordFieldType: 'password',
            formData: {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                country_id: '',
                timezone: '',
                currency: '',
                language: '',
                password: '',
                password_confirmation: '',
            },
            loading: false,
            privacyPolicy: 2,
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

        // Function of registration api
        register() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.post(apiRoutes.Register, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                toaster.info('Registration successful')
                window.location.href = '/customer';
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

        // Function of password visibility of registration
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        // Function of confirm password visibility of registration
        confirmPasswordVisibility() {
            this.conformPasswordFieldType = this.conformPasswordFieldType === "password" ? "text" : "password";
        },

        // Function of number check
        checkNumber(e) {
            let theEvent = e || window.event;
            let key;
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');

            } else {
                key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            const regex = /^\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },

        // Function of toggle switch
        privacyPolicyCheck() {
            this.privacyPolicy = this.privacyPolicy === 1 ? 2 : 1;
        },

    }

}

</script>
