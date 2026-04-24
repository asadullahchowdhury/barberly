<template>

    <!-- Route to go sign-in -->
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>

    <div class="form-center" v-if="step === 'change-password'  && user">
        <div class="title padding-top-56 padding-bottom-26">
            Change password
        </div>
        <div class="form-center">

            <!-- Reset password form -->
            <form class="form-section" autocomplete="off" @submit.prevent="updatePassword">

                <div class="subtitle">
                    You can now change your password for <b class="text-dark"> {{ formData.email }}</b>
                </div>

                <!-- Password input -->
                <div class="form-group padding-bottom-16">

                    <label for="new-password" class="form-label">New Password</label>

                    <div class="password-content">
                        <input id="new-password" :type="newPasswordFieldType" name="password"
                               v-model="formData.password"
                               placeholder="Set up your new password" class="form-control padding-left-20"
                               autocomplete="new-password">

                        <a href="javascript:void(0)" class="password-hide-show" @click="newPasswordVisibility()">
                            <span v-if="newPasswordFieldType === 'password'">
                                <img :src="'/images/authentication/eye-off.svg'" alt="eye">

                            </span>
                            <span v-if="newPasswordFieldType === 'text'">
                                <img :src="'/images/authentication/eye.svg'" alt="eye">
                            </span>
                        </a>
                        <div class="error-report"></div>
                    </div>
                </div>

                <!-- Confirm password input -->
                <div class="form-group padding-bottom-16">

                    <label for="confirm-password" class="form-label">Repeat Password</label>

                    <div class="password-content">

                        <input id="confirm-password" :type="confirmPasswordFieldType" name="password_confirmation"
                               v-model="formData.password_confirmation"
                               placeholder="Repeat your new password" class="form-control padding-left-20"
                               autocomplete="new-confirm-password">

                        <a href="javascript:void(0)" class="password-hide-show" @click="newConfirmPasswordVisibility()">
                            <span v-if="confirmPasswordFieldType === 'password'">
                                <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                            </span>
                            <span v-if="confirmPasswordFieldType === 'text'">
                                <img :src="'/images/authentication/eye.svg'" alt="eye">
                            </span>
                        </a>
                        <div class="error-report"></div>
                    </div>

                </div>

                <!-- Submit button -->
                <div class="form-group padding-bottom-16">
                    <button type="submit" class="btn-theme w-100 padding-x-12" v-if="!loading">
                        <span class="btn-text">
                            Update password
                        </span>
                    </button>

                    <button type="button" class="btn-theme btn-loading w-100 padding-x-12" v-if="loading">
                        <span class="loading"></span>
                    </button>

                </div>
            </form>

        </div>
    </div>

    <!-- No user found text -->
    <div class="d-flex justify-content-center align-items-center" v-if="!user">
        <div
            class="d-flex justify-content-center align-items-center flex-column gap-20 invalid-url margin-y-20 padding-x-20">

            <div class="icon">
                <img :src="`/images/authentication/remove.png`" alt="no user">
            </div>

            <div class="text">Invalid URL</div>

            <div class="subtitle">
                The requested URL is not valid or does not exist.
                <br>
                Please check the URL and try again.
            </div>


            <router-link :to="{name:'Sign-In'}" class="btn-theme btn-anchor">
                <span class="btn-text">
                    back to login
                </span>
            </router-link>
        </div>
    </div>

    <!-- Password update message show -->
    <div class="form-center" v-if="step === 'password-updated'">
        <div class="check text-center">
            <img :src="'/images/authentication/check.svg'" alt="check.svg">
        </div>
        <div class="title padding-top-20 padding-bottom-20">
            Password updated!
        </div>
        <div class="form-section">
            <div class="subtitle">
                You have successfully changed you password for {{ formData.email }}.
                You can now log in with your new details.
            </div>
            <div class="form-group padding-bottom-16">
                <router-link :to="{name:'Sign-In'}" href="javascript:void(0)" class="btn-theme btn-anchor w-100">
                    <span class="btn-text">
                        back to login
                    </span>
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes.js";

import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
})

export default {

    data() {

        return {
            // Data properties for the component
            step: 'change-password',
            password: '',
            newPasswordFieldType: 'password',
            confirmPasswordFieldType: 'password',
            formData: {
                email: '',
                password_confirmation: '',
                token: '',
            },
            loading: false,
            user: true,
        }

    },

    mounted() {
        // First input will be focused when the page loads
        document.getElementById('new-password').focus();

        // Lifecycle hook: Called after the component is mounted
        this.formData.token = this.$route.params.token;
        this.getAccount();

    },

    methods: {

        // Function of new password visibility
        newPasswordVisibility() {
            this.newPasswordFieldType = this.newPasswordFieldType === "password" ? "text" : "password";
        },

        // Function of confirm new password visibility
        newConfirmPasswordVisibility() {
            this.confirmPasswordFieldType = this.confirmPasswordFieldType === "password" ? "text" : "password";
        },

        // Function of Get account api
        getAccount() {
            let formData = {token: this.formData.token}
            axios.get(apiRoutes.GetAccount, {params: formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.formData.email = res.user.email;
            }).catch(err => {
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    this.user = false;
                    this.$router.push({name: 'Sign-In'})
                } else {
                    this.$router.push({name: 'Sign-In'})
                    toaster.error('User not found!')
                }

            })
        },

        // Function of Update password
        updatePassword() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.patch(apiRoutes.ResetPassword, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.step = 'password-updated';
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

    }

}

</script>
