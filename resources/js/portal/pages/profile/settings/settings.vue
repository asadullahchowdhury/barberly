<template>

    <div class="card-content" v-if="userData != null">
        <div class="card-header">
            <div class="card-title margin-bottom-15">
                Settings
                <div class="card-sub-title mb-4">
                    Keep your account secure and manage your personal information and social logins.
                </div>
            </div>
        </div>

        <!-- personal info section -->
        <section class="d-flex mb-4">
            <div class="card-settings border-radius-5">
                <div
                    class="d-flex align-items-center justify-content-between padding-x-12 padding-sm-x-24 border-bottom">
                    <div class="settings-title padding-y-24"> Personal info</div>
                    <a href="javascript:void(0)" class="text-theme underline-anim text-decoration-none"
                       @click="openPersonalInfoModal()">
                        Edit
                    </a>
                </div>
                <div class="padding-sm-24 padding-12">
                    <div class="font-weight-700 margin-bottom-5">Legal Name</div>
                    <div>{{ userData.first_name + ' ' + userData.last_name }}</div>
                </div>
            </div>

            <div class="card-security ms-3 padding-sm-24 padding-12 border-radius-5">
                <div class="margin-bottom-10">
                    <img :src="'/images/portal/shield-profile.svg'" class="w-70 h-70" alt="shield-profile">
                </div>
                <div class="margin-bottom-10  font-weight-700 font-size-22">
                    Your information
                </div>
                <div>
                    Details are private and kept between you and barberly. We hide some account details to protect your
                    identity.
                </div>
            </div>
        </section>

        <!-- contact info section -->
        <section class="card-settings border-radius-5 margin-bottom-10">
            <div class="d-flex align-items-center justify-content-between padding-x-12 padding-sm-x-24 border-bottom">
                <div class="settings-title padding-y-24">
                    Contact Details
                </div>
                <a href="javascript:void(0)" class="text-theme underline-anim text-decoration-none" @click="openContactModal">
                    Edit
                </a>
            </div>
            <div class="padding-sm-24 padding-12">
                <div class="padding-bottom-16">
                    <div class="font-weight-700 margin-bottom-5">Mobile number</div>
                    <div>
                        <span v-if="userData.mobile">
                            {{ userData.mobile }}
                        </span>
                        <span v-else>
                            N/A
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="font-weight-700 margin-bottom-5">Email address</div>
                    <div>{{ userData.email }}</div>
                </div>

            </div>
        </section>

        <!-- password and social media section -->
        <section class="card-settings border-radius-5 margin-bottom-10">
            <div class="padding-x-12 padding-sm-x-24 border-bottom">
                <div class="settings-title padding-y-24">
                    Security
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between padding-sm-x-24 padding-x-12 flex-wrap">
                <div class="padding-sm-y-24 padding-y-12">
                    <div class="font-weight-700 padding-bottom-16">Password</div>
                    Your password is managed by social logins.
                </div>
                <button type="button" class="btn btn-outline-theme padding-y-10 padding-x-20"
                        @click="openPasswordModal">
                    Create New Password
                </button>
            </div>
            <div class="padding-sm-24 padding-12">
                <div class="font-weight-700 padding-bottom-16">Social logins</div>
                Manage the social logins you use to access to Barberly.
            </div>
            <div class="media-icon-section disable-feature">
                <div class="padding-sm-24 padding-12 d-flex justify-content-between align-items-center border-bottom">
                    <div class="d-flex align-items-center">
                        <img :src="`/images/portal/google.png`" class="social-media-icon" alt="apple">
                        <div class="margin-left-10">
                            <div class="font-weight-700">Google</div>
                            <div class="margin-top-5">Connect</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-theme padding-y-10 padding-x-20">Disconnect</button>
                </div>
                <div class="padding-sm-24 padding-12 d-flex justify-content-between align-items-center border-bottom">
                    <div class="d-flex align-items-center">
                        <img :src="`/images/portal/apple.png`" class="social-media-icon" alt="apple">
                        <div class="margin-left-10">
                            <div class="font-weight-700">Apple</div>
                            <div class="margin-top-5">Connect</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-theme padding-y-10 padding-x-20">Disconnect</button>
                </div>
                <div class="padding-sm-24 padding-12 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img :src="`/images/portal/facebook.png`" class="social-media-icon" alt="apple">
                        <div class="margin-left-10">
                            <div class="font-weight-700">Facebook</div>
                            <div class="margin-top-5">Connect</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-theme padding-y-10 padding-x-20">Disconnect</button>
                </div>
            </div>
        </section>

        <!-- delete account section -->
        <section class="card-settings border-radius-5 margin-bottom-10">
            <div class="padding-sm-x-24 padding-x-12 border-bottom">
                <div class="settings-title padding-y-24">
                    Delete account
                </div>
            </div>
            <div class="padding-sm-24 padding-12">
                <div class="font-weight-400 margin-bottom-20">
                    You will delete all your personal info and won't be able to retrieve it. Are you sure you want to
                    delete your account?
                </div>
                <button type="button" class="btn btn-danger padding-y-10 padding-x-12 w-180 disable-feature" @click="openAccountDeleteModal">Delete your
                    account
                </button>
            </div>
        </section>


        <!--Personal modal start-->
        <div class="modal fade" id="personalInfoModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="personalInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header px-md-4 pt-md-3 border-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit personal info</h1>
                        <button type="button" class="btn-close" @click="hidePersonalInfoModal"
                                aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="updateProfile">
                        <div class="modal-body px-md-4">

                            <div class="form-group mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input id="first_name" type="text" name="first_name" class="form-control"
                                       v-model="infoData.first_name"
                                       placeholder="Enter your first name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control"
                                       v-model="infoData.last_name"
                                       placeholder="Enter your last name">
                                <div class="error-report"></div>
                            </div>

                        </div>
                        <div class="modal-footer flex-nowrap px-md-4 pb-md-3 border-0">
                            <button type="button"
                                    class="btn btn-outline-dark h-45 border-radius-10 w-50 margin-right-10"
                                    @click="hidePersonalInfoModal">
                                Cancel
                            </button>

                            <button type="submit" class="btn-theme w-50" v-if="!updateLoading">Save</button>
                            <button type="button" class="btn-theme btn-loading w-50" v-if="updateLoading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Personal modal end  -->


        <!--contact modal start-->
        <div class="modal fade" id="contactDetailsModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="personalInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header px-md-4 pt-md-3 border-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit contact details</h1>
                        <button type="button" class="btn-close" @click="hideContactModal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="updateProfile">
                        <div class="modal-body px-md-4">

                            <div class="form-group padding-bottom-16">
                                <label for="number_field" class="form-label">Mobile Number</label>
                                <div class="input-group">
                                    <input id="mobile_number" type="text" name="mobile_number" v-model="infoData.mobile"
                                           @keypress="checkNumber($event)" placeholder="Enter your mobile number"
                                           class="form-control" autocomplete="new-mobile-number">
                                </div>
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control disable-feature"
                                       v-model="infoData.email"
                                       placeholder="Enter your email">
                                <div class="error-report"></div>
                            </div>

                        </div>
                        <div class="modal-footer flex-nowrap px-md-4 pb-md-3 border-0">
                            <button type="button"
                                    class="btn btn-outline-dark border-radius-10 h-45 w-50 margin-right-10"
                                    @click="hideContactModal">
                                Cancel
                            </button>

                            <button type="submit" class="btn-theme w-50" v-if="!updateLoading">Save</button>
                            <button type="button" class="btn-theme btn-loading w-50" v-if="updateLoading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--contact modal end  -->


        <!--password modal start-->
        <div class="modal fade" id="passwordModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header px-md-4 pt-md-3 border-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Password</h1>
                        <button type="button" class="btn-close" @click="hidePasswordModal"></button>
                    </div>
                    <form @submit.prevent="updatePassword">
                        <div class="modal-body px-md-4">
                            <div class="form-group mb-3">
                                <label for="current-password" class="form-label">Current Password</label>
                                <div class="position-relative">
                                    <input id="current-password" :type="currentPasswordFieldType"
                                           name="current_password" placeholder="Current password"
                                           class="form-control padding-left-20" autocomplete="current-password"
                                           v-model="passwordForm.current_password">

                                    <a href="javascript:void(0)" class="password-icon"
                                       @click="currentPasswordVisibility()">
                                        <span v-if="currentPasswordFieldType === 'password'">
                                            <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                                        </span>
                                        <span v-if="currentPasswordFieldType === 'text'">
                                            <img :src="'/images/authentication/eye.svg'" alt="eye">
                                        </span>
                                    </a>

                                </div>
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="new-password" class="form-label">New Password</label>

                                <div class="position-relative">

                                    <input id="new-password" :type="newPasswordFieldType" name="password"
                                           placeholder="Set up your new password" class="form-control padding-left-20"
                                           autocomplete="new-password" v-model="passwordForm.password">

                                    <a href="javascript:void(0)" class="password-icon"
                                       @click="newPasswordVisibility()">
                                        <span v-if="newPasswordFieldType === 'password'">
                                            <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                                        </span>
                                        <span v-if="newPasswordFieldType === 'text'">
                                            <img :src="'/images/authentication/eye.svg'" alt="eye">
                                        </span>
                                    </a>

                                </div>

                                <div class="error-report"></div>
                            </div>

                            <div class="form-group">
                                <label for="confirm-password" class="form-label">Confirm Password</label>

                                <div class="position-relative">
                                    <input id="confirm-password" :type="confirmPasswordFieldType"
                                           name="password_confirmation" placeholder="Repeat your new password"
                                           class="form-control padding-left-20" autocomplete="new-confirm-password"
                                           v-model="passwordForm.password_confirmation">

                                    <a href="javascript:void(0)" class="password-icon"
                                       @click="newConfirmPasswordVisibility()">
                                            <span v-if="confirmPasswordFieldType === 'password'">
                                                <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                                            </span>
                                        <span v-if="confirmPasswordFieldType === 'text'">
                                                <img :src="'/images/authentication/eye.svg'" alt="eye">
                                            </span>
                                    </a>

                                </div>

                                <div class="error-report"></div>
                            </div>

                        </div>
                        <div class="modal-footer flex-nowrap px-md-4 pb-md-3 border-0">
                            <button type="button"
                                    class="btn  btn-outline-dark h-45 border-radius-10 w-50 margin-right-10"
                                    @click="hidePasswordModal">
                                Cancel
                            </button>

                            <button type="submit" class="btn-theme w-50" v-if="!updateLoading">Save</button>
                            <button type="button" class="btn-theme btn-loading w-50" v-if="updateLoading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Delete account modal -->
        <div class="modal fade" id="deleteAccountModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="passwordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header px-md-4 pt-md-3 border-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Account can’t be deleted</h1>
                        <button type="button" class="btn-close" @click="hideAccountDeleteModal"></button>
                    </div>
                    <form>
                        <div class="modal-body px-md-4">
                            <div class="padding-bottom-16">
                                You need to delete the workspace you own before you can delete your account.
                            </div>
                            <div class="padding-bottom-16 font-weight-700">
                                Delete workspaces from within the
                                <router-link :to="{name: 'Workspaces'}" @click="hideAccountDeleteModal"
                                             class="text-theme text-decoration-none font-weight-400">
                                    workspace list
                                </router-link>
                            </div>
                        </div>
                        <div class="modal-footer px-md-4 pb-md-3 border-0">
                            <button type="button" class="btn btn-outline-dark h-45 border-radius-10 w-100"
                                    @click="hideAccountDeleteModal">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>

import apiService from "../../../../services/apiService";
import apiRoutes from "../../../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";

const toaster = createToaster({
    position: 'top-left',
});

export default {

    data() {

        return {
            personalInfoModalActive: false,
            contactModalActive: false,
            currentPasswordFieldType: 'password',
            newPasswordFieldType: 'password',
            confirmPasswordFieldType: 'password',
            deleteAccountModalActive: false,
            userData: window.core.UserInfo,
            updateLoading: false,
            infoData: {
                first_name: '',
                last_name: '',
                mobile: '',
                email: '',
            },
            modalType: 'contact',

            passwordForm: {
                password: '',
                new_password: '',
                password_confirmation: '',
            }
        }

    },

    mounted() {

    },

    methods: {


        // Personal Information modal
        openPersonalInfoModal() {
            apiService.ClearErrorHandler();
            this.modalType = 'personal'
            this.infoData = {
                first_name: this.userData.first_name,
                last_name: this.userData.last_name,
            }
            let modal = new bootstrap.Modal(document.getElementById('personalInfoModal'))
            modal.show();
        },

        // profile update api
        updateProfile() {
            apiService.ClearErrorHandler();
            this.updateLoading = true;
            axios.patch(apiRoutes.ProfileUpdate, this.infoData, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                console.log(response.data)
                EventBus.$emit('updateUserInfo', res.user);
                if (this.modalType !== 'contact') {
                    this.updateLoading = false;
                    toaster.info('Legal name update successfully')
                    this.userData.first_name = res.user.first_name;
                    this.userData.last_name = res.user.last_name;
                    this.hidePersonalInfoModal();
                } else {
                    this.updateLoading = false;
                    toaster.info('Contact and email update successfully')
                    this.userData.mobile = res.user.mobile;
                    this.userData.email = res.user.email;
                    this.hideContactModal();
                }
            }).catch(err => {
                this.updateLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // password update
        updatePassword(){
            apiService.ClearErrorHandler();
            this.updateLoading = true;
            axios.patch(apiRoutes.UpdatePassword, this.passwordForm, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.updateLoading = false;
                toaster.info('Password has been updated successfully.')
                this.passwordForm = {
                    password: '',
                    new_password: '',
                    password_confirmation: '',
                }
                if (res.errors === undefined) {
                    this.hidePasswordModal();
                }
            }).catch(err => {
                this.updateLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },


        hidePersonalInfoModal() {
            const Modal = document.querySelector('#personalInfoModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },


        // Contact details modal
        openContactModal() {
            apiService.ClearErrorHandler();
            this.modalType = 'contact'
            this.infoData = {
                first_name: this.userData.first_name,
                last_name: this.userData.last_name,
                mobile: this.userData.mobile,
                email: this.userData.email,
            }

            let modal = new bootstrap.Modal(document.getElementById('contactDetailsModal'))
            modal.show();
        },

        hideContactModal() {
            const Modal = document.querySelector('#contactDetailsModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        // password modal
        openPasswordModal() {
            this.passwordForm = {
                password: '',
                new_password: '',
                password_confirmation: '',
            }
            this.currentPasswordFieldType = 'password';
            this.newPasswordFieldType = 'password';
            this.confirmPasswordFieldType = 'password';
            apiService.ClearErrorHandler();
            let modal = new bootstrap.Modal("#passwordModal", {keyboard: false})
            modal.show();
        },

        hidePasswordModal() {
            apiService.ClearErrorHandler();
            this.passwordForm = {
                password: '',
                new_password: '',
                password_confirmation: '',
            }
            const Modal = document.querySelector('#passwordModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },


        // Account delete modal
        openAccountDeleteModal() {
            let modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'))
            modal.show();
        },

        hideAccountDeleteModal() {
            const Modal = document.querySelector('#deleteAccountModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        currentPasswordVisibility() {
            this.currentPasswordFieldType = this.currentPasswordFieldType === "password" ? "text" : "password";
        },

        newPasswordVisibility() {
            this.newPasswordFieldType = this.newPasswordFieldType === "password" ? "text" : "password";
        },

        newConfirmPasswordVisibility() {
            this.confirmPasswordFieldType = this.confirmPasswordFieldType === "password" ? "text" : "password";
        },

        // Check number
        checkNumber(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                // @ts-ignore
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /^\d*\.?\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }

        },

    }

}

</script>
