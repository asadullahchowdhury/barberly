<template>
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <img :src="'/images/global/logo.svg'" alt="logo.png">
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>
    <div class="title padding-top-56 padding-bottom-26">
        Enter the 6 digit code
    </div>
    <div class="form-center">
        <!-- Form otp code action -->
        <form class="form-section">
            <div class="subtitle">
                Code was sent to  <b class="text-dark">{{ formData.email }}</b>
            </div>
            <div class="alert-danger text-center" v-if="error != null">{{ error }}</div>
            <div class="form-group padding-bottom-16 verification-otp-box">

                <div class="otp-input-group form-group position-relative">
                    <v-otp-input v-model:value="formData.otp" input-classes="otp-input" name="otp"
                                 @on-complete="verification"
                                 separator="" :num-inputs="6" :should-auto-focus="true" input-type="number"
                                 @paste="onPaste($event)"
                    />

                    <!-- Loading -->
                    <div class="progress-animation position-absolute" v-if="loading">
                        <div class="progress-loading"></div>
                        <div class="progress-loading"></div>
                        <div class="progress-loading"></div>
                        <div class="progress-loading"></div>
                        <div class="progress-loading"></div>
                        <div class="progress-loading"></div>
                    </div>

                </div>
            </div>

            <div class="form-group padding-bottom-16" v-if="timerCount === 0">

                <div class="text-center">
                    <a href="javascript:void(0)" class="text-theme underline-anim" @click="ResendOtp"
                       v-if="!otpSendLoading">
                        Resend Code
                    </a>
                </div>

                <button type="button" class="btn btn-loading w-100 reset-loading" v-if="otpSendLoading">
                    <span class="loading black"></span>
                </button>

            </div>

            <!-- Count down message -->
            <div class="subtitle" v-if="timerCount > 0">
                You can resend code in {{ timerCount }} sec
            </div>

        </form>
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
            bindModal: '',
            timerCount: 30,
            formData: {
                email: '',
                otp: '',
            },
            loading: false,
            error: null,
            otpSendLoading: false,
        }

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.history.state.email !== undefined) {
            // Getting the email from check account page
            this.formData.email = window.history.state.email;
        } else {
            this.$router.push({name: 'Sign-In'})
        }

    },

    watch: {

        // Function of timer count to maintain
        timerCount: {
            handler(value) {
                if (value > 0) {
                    setTimeout(() => {
                        this.timerCount--;
                    }, 1000);
                }
            },
            immediate: true
        }

    },

    methods: {

        // Function of reset code timer to resend code
        ResendOtp() {
            this.otpSendLoading = true;
            axios.post(apiRoutes.ResendCode, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.otpSendLoading = false;
                this.timerCount = 30;
                this.formData.email = window.history.state.email;
                toaster.info('OTP code has been sent to your email.');
            }).catch(err => {
                this.otpSendLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of on paste function
        onPaste(e) {
            const text = e.clipboardData.getData('text/plain').replace(/[^0-9]/g, '');
            this.bindModal = text.slice(0, 6);
        },

        // Function of verify code api
        verification() {
            this.loading = true;
            axios.patch(apiRoutes.VerifyCode, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                toaster.info('Verification successful');
                window.location.href = '/portal/auth/account/setup';
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    this.otpErrorHandler();
                    toaster.error(res.data.errors.code[0]);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of otp error handler
        otpErrorHandler() {
            let input = document.querySelectorAll("input")
            input.forEach((i) => {
                i.classList.add('is-invalid')
            })
        },

    }

}

</script>
