<template>
    <div class="customer-profile bg-body-tertiary">

        <div class="container">
            <div class="profile-box mt-5 pt-5">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow mt-md-5 mt-4 mb-4 border-0 rounded-3 profile-basic-card">
                            <div class="card-header p-3 rounded-top-3 text-center bg-white">

                                <!-- Customer profile avatar input -->
                                <div class="avatar-wrapper position-relative mx-auto">
                                    <div class="img-inner overflow-hidden border">
                                        <img v-if="userInfo?.avatar != null && !uploadLoading"
                                             :src="`/storage/media/image/`+userInfo?.avatar"
                                             alt="avatar">

                                        <div class="placeholder-glow w-100 h-100" v-if="uploadLoading">
                                            <div class="placeholder w-100 h-100"></div>
                                        </div>

                                    </div>
                                    <label for="avatar" class="avatar-upload">
                                        <img class="w-16 h-16 edit-icon" :src="`/images/global/edit-pen-white.svg`"
                                             alt="edit">
                                        <input type="file" class="d-none" id="avatar" accept="image/*"
                                               @change="attachAvatar($event)">
                                    </label>
                                </div>

                                <h5 class="card-title mt-3 fw-bold" v-if="userInfo !== null">
                                    {{ userInfo.first_name + ' ' + userInfo.last_name }}
                                </h5>
                                <a href="javascript:void(0)" class="text-theme underline-anim" @click="openProfileModal">
                                    Edit basic info
                                </a>

                            </div>

                            <!-- Customer profile information -->
                            <div class="card-body p-3 px-md-4" v-if="userInfo !== null">
                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">First Name</p>
                                    <p>{{ userInfo.first_name }}</p>
                                </div>
                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">Last Name</p>
                                    <p>{{ userInfo.last_name }}</p>
                                </div>

                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">Mobile Number</p>
                                    <p v-if="userInfo.mobile !== null">{{ userInfo.mobile }}</p>
                                    <p v-if="userInfo.mobile === null" class="text-muted fst-italic">N/A</p>
                                </div>

                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">Email Address</p>
                                    <p>{{ userInfo.email }}</p>
                                </div>

                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">Date of birth</p>
                                    <p v-if="userInfo.dob !==  null">{{ userInfo.dob_formatted }}</p>
                                    <p class="text-muted fst-italic" v-if="userInfo.dob === null">N/A</p>
                                </div>

                                <div class="mb-2">
                                    <p class="fw-semibold mb-0">Gender</p>
                                    <p v-if="userInfo.gender === 1">Male</p>
                                    <p v-if="userInfo.gender === 2">Female</p>
                                    <p v-if="userInfo.gender === 3">Non-binary</p>
                                    <p v-if="userInfo.gender === 4">Prefer not to say</p>
                                    <p class="text-muted fst-italic" v-if="userInfo.gender === null">N/A</p>
                                </div>

                            </div>
                            <div class="card-footer bg-white text-center rounded-bottom-3 p-4">
                                <a href="javascript:void(0)" class="text-danger underline-anim fw-semibold"
                                   v-if="!logoutLoading" @click="logout">Logout</a>
                                <a href="javascript:void(0)" class=" btn-loading h-24" v-if="logoutLoading">
                                    <span class="loading black"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">

                        <!-- Address card -->
                        <div class="card shadow mt-lg-5 mb-4 border-0 rounded-3">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">My Address</h5>

                            </div>
                            <div class="card-body p-3 p-md-4">

                                <!-- Update profile full address -->
                                <form @submit.prevent="updateProfile" autocomplete="off">
                                    <div class="form-group mb-md-4 mb-3">
                                        <label for="address_name" class="form-label">Address name</label>
                                        <input type="text" class="form-control" placeholder="Address name"
                                               name="address_name" v-model="formData.address_name">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                       id="google_location"
                                                       v-model="formData.address"
                                                       placeholder="Start typing to search your address">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">Apt./Suite etc</label>
                                                <input type="text" class="form-control" placeholder="" name="apartment"
                                                       v-model="formData.apartment">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="" name="city"
                                                       v-model="formData.city">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">District</label>
                                                <input type="text" class="form-control" placeholder="" name="district"
                                                       v-model="formData.district">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">Region</label>
                                                <input type="text" class="form-control" placeholder="" name="region"
                                                       v-model="formData.region">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">Post code</label>
                                                <input type="text" class="form-control" placeholder="" name="post_code"
                                                       v-model="formData.post_code">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-md-4 mb-3">
                                                <label for="address_name" class="form-label">Country</label>
                                                <select name="" id="" class="form-select" v-model="formData.country">
                                                    <option v-if="countries.length > 0" v-for="each in countries"
                                                            :value="each.name">{{ each.name }}
                                                    </option>
                                                    <option v-if="countries.length === 0" disabled>No data found !
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-theme w-100" v-if="!loading">
                                                Save
                                            </button>
                                            <button type="button" class="btn btn-loading btn-theme w-100"
                                                    v-if="loading">
                                                <span class="loading"></span>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Password card -->
                        <div class="card shadow mb-4 border-0 rounded-3">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">
                                    Change password
                                </h5>
                            </div>
                            <div class="card-body p-3 p-md-4">

                                <!-- Update password -->
                                <form @submit.prevent="changePass" autocomplete="off" class="pass-form">
                                    <div class="form-group mb-md-4 mb-3">
                                        <label for="current_password" class="form-label">Current password</label>
                                        <input type="password" class="form-control"
                                               v-model="passwordForm.current_password"
                                               name="current_password" id="current_password">
                                        <div class="error-report"></div>
                                    </div>

                                    <div class="form-group mb-md-4 mb-3">
                                        <label for="new_password" class="form-label">New password</label>
                                        <input type="password" class="form-control"
                                               v-model="passwordForm.password"
                                               name="password" id="new_password">
                                        <div class="error-report"></div>
                                    </div>

                                    <div class="form-group mb-md-4 mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm new
                                            password</label>
                                        <input type="password" class="form-control"
                                               v-model="passwordForm.password_confirmation"
                                               name="password_confirmation  " id="password_confirmation">
                                        <div class="error-report"></div>
                                    </div>

                                    <button type="submit" class="btn btn-theme mt-2 w-100" v-if="!passLoading">Confirm
                                    </button>
                                    <button type="submit" class="btn btn-theme btn-loading mt-2 w-100"
                                            v-if="passLoading">
                                        <span class="loading"></span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Payment card -->
                        <div class="card shadow mb-4 border-0 rounded-3">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">
                                    My payment methods
                                </h5>
                                <p class="mb-0">
                                    Securely save your card details for hassle-free payments.
                                </p>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <a href="javascript:void(0)" @click="openPaymentModal()">
                                    <img :src="`/images/global/plus-circle-theme.svg`" alt="plus circle theme"
                                         class="me-2 w-24 h-24">
                                    <span class="underline-anim text-theme">
                                        Add payment method
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- Social login card -->
                        <div class="card shadow mb-4 border-0 rounded-3 disable-feature">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">
                                    My social logins
                                </h5>
                                <p class="mb-0">
                                    Link social profiles for easier access to your Barberly account.
                                </p>
                            </div>
                            <div class="card-body p-3 p-md-4">

                                <!-- Facebook login -->
                                <div class="d-flex mb-3 justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                                class="btn btn-icon border d-flex justify-content-center align-items-center">
                                            <img :src="`/images/global/facebook-f.svg`" alt="facebook">
                                        </button>
                                        <div class="ms-3 me-3">Facebook</div>
                                    </div>
                                    <a href="javascript:void(0)" class="text-theme underline-anim">Connect</a>
                                </div>

                                <!-- Google login -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                                class="btn btn-icon border d-flex justify-content-center align-items-center">
                                            <img :src="`/images/authentication/google.png`" alt="facebook">
                                        </button>
                                        <div class="ms-3 me-3">Google</div>
                                    </div>
                                    <a href="javascript:void(0)" class="text-theme underline-anim">Connect</a>
                                </div>

                            </div>
                        </div>

                        <!-- Notification card -->
                        <div class="card shadow mb-4 border-0 rounded-3">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">
                                    My notifications
                                </h5>
                                <p class="mb-0">
                                    We'll send you updates about your appointments, news and marketing offers.
                                </p>
                            </div>
                            <div class="card-body p-3 p-md-4">

                                <!-- Text message notification -->
                                <div class="toggle mb-2 d-flex justify-content-between">

                                    <div>
                                        <p class="mb-0 fw-semibold">Text message appointment notifications</p>
                                        <p class="text-muted">Receive texts based on your sender's settings</p>
                                    </div>

                                    <input type="checkbox" :checked="formData.text_message_notification === 1"
                                           @change="toggleSwitch('text_message_notification')"/>
                                    <label></label>
                                </div>

                                <!-- Email notification -->
                                <div class="toggle mb-2 d-flex justify-content-between">

                                    <div>
                                        <p class="mb-0 fw-semibold">Email notifications</p>
                                        <p class="text-muted">Receive texts based on your sender's settings</p>
                                    </div>

                                    <input type="checkbox" :checked="formData.email_notification === 1"
                                           @change="toggleSwitch('email_notification')"/>
                                    <label></label>
                                </div>

                                <!-- Email marketing notification -->
                                <div class="toggle mb-2 d-flex justify-content-between">

                                    <div class="">
                                        <p class="mb-0 fw-semibold">Email marketing notifications</p>
                                        <p class="text-muted">Receive texts based on your sender's settings</p>
                                    </div>

                                    <input type="checkbox" :checked="formData.email_marketing_notification === 1"
                                           @change="toggleSwitch('email_marketing_notification')"/>
                                    <label></label>
                                </div>

                            </div>
                        </div>

                        <!-- Delete card -->
                        <div class="card shadow mb-4 border-0 rounded-3 disable-feature">
                            <div class="card-header p-3 px-md-4 rounded-top-3 bg-white">
                                <h5 class="card-title fw-bold">Delete account</h5>
                            </div>
                            <div class="card-body p-3 p-md-4">
                                <p>Are you sure you want to leave Fresha?</p>
                                <a href="javascript:void(0)" class="text-danger underline-anim fw-semibold">
                                    Delete my account</a>
                            </div>
                        </div>

                        <div class="row disable-feature">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-white bg-white py-2 mb-md-0 mb-4 shadow w-100 fw-semibold">
                                    My favorite
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-white bg-white py-2 mb-md-0 mb-4 shadow w-100 fw-semibold">
                                    My List your business
                                </button>
                            </div>
                        </div>

                        <div class="my-4 font-size-18 text-center">
                            © Barberly.com |
                            <a href="javascript:void(0)" class="text-theme underline-anim">
                                Terms of Use
                            </a>
                            |
                            <a href="javascript:void(0)" class="text-theme underline-anim">
                                Privacy Policy
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Basic info modal -->
        <div class="modal fade" id="basicInfoModal" tabindex="-1" aria-labelledby="basicInfoModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="basicInfoModalLabel">Edit Basic info</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="updateProfile" autocomplete="off">
                        <div class="modal-body px-md-4">
                            <div class="form-group mb-4">
                                <label for="first_name" class="form-label">First name</label>
                                <input id="first_name" type="text" class="form-control" placeholder="First name" name="first_name"
                                       v-model="formData.first_name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="last_name" class="form-label">Last name</label>
                                <input id="last_name" type="text" class="form-control" placeholder="Last name" name="last_name"
                                       v-model="formData.last_name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label">Email address</label>
                                <input id="email" type="text" class="form-control" placeholder="Email Address" name="email"
                                       v-model="formData.email">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="mobile" class="form-label">Mobile number</label>
                                <input id="mobile" type="text" class="form-control" placeholder="Mobile Number" name="mobile"
                                       @keypress="checkNumber($event)"
                                       v-model="formData.mobile">
                            </div>

                            <div class="form-group mb-4">
                                <label for="dob" class="form-label">Date of birth</label>
                                <input v-model="formData.dob"
                                       id="dob" name="date"
                                       class="form-control" placeholder="Date of birth"
                                       autocomplete="off"/>
                            </div>

                            <div class="form-group mb-4">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender" class="form-select" v-model="formData.gender">
                                    <option :value="null" :selected="formData.gender === null">Select Gender</option>
                                    <option :value="1">Male</option>
                                    <option :value="2">Female</option>
                                    <option :value="3">Non-binary</option>
                                    <option :value="4">Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer flex-nowrap px-md-4">
                            <button type="button" class="btn btn-outline-dark h-45 rounded-3 w-50 me-3"
                                    @click="closeProfileModal()">Cancel
                            </button>
                            <button type="submit" class="btn btn-theme w-50" v-if="!loading">Save</button>
                            <button type="submit" class="btn btn-theme btn-loading w-50" v-if="loading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- payment method modal -->
        <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Add new card</h1>
                        <button type="button" class="btn-close shadow-none" @click="closePaymentModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            Security save your card details for hassle-free payment
                        </div>
                        <div class="mb-3">
                            <label for="card-holder-full-name" class="form-label fw-bold">Card holder full name</label>
                            <input id="card-holder-full-name" type="text" name="card-holder-full-name" class="form-control" required autocomplete="new-card-holder-full-name">
                        </div>
                        <div class="mb-3">
                            <label for="card-name" class="form-label fw-bold">Card name</label>
                            <input id="card-name" type="text" name="card-name" class="form-control" required autocomplete="new-card-name">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expire-date" class="form-label fw-bold">Expire date</label>
                                <input id="expire-date" type="text" name="expire-date" class="form-control" required autocomplete="new-expire-date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label fw-bold">CVV</label>
                                <input id="cvv" type="text" name="cvv" class="form-control" required autocomplete="new-cvv">
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center flex-wrap">
                            <div class="text-secondary text-opacity-75 fw-bold me-2">
                                Pay securely with
                            </div>
                            <div class="d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/payment/payment-1.svg`" class="w-35 h-35 me-1" alt="payment 1">
                                <img :src="`/images/home/payment/payment-2.svg`" class="w-35 h-35 me-1" alt="payment 2">
                                <img :src="`/images/home/payment/payment-3.svg`" class="w-35 h-35 me-1" alt="payment 3">
                                <img :src="`/images/home/payment/payment-4.svg`" class="w-35 h-35 me-1" alt="payment 4">
                                <img :src="`/images/home/payment/payment-5.svg`" class="w-35 h-35 me-1" alt="payment 5">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-light border height-50 border-radius-10 col-4" @click="closePaymentModal">Cancel</button>
                        <button type="button" class="btn btn-theme height-50 border-radius-10 col-4">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import apiService from "../../../services/apiService.js";
import sort from "../../../services/sorting";
import apiRoutes from "../../apiRoutes/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";
import flatpickr from "flatpickr";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});
export default {
    data() {
        return {
            // Data properties for the component
            countries: [],
            userInfo: null,
            logoutLoading: false,
            profileLoading: false,
            passLoading: false,
            passwordForm: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
            formData: {
                first_name: '',
                last_name: '',
                mobile: '',
                avatar: null,
                gender: '',
                dob: '',
                country: '',
                currency: '',
                timezone: '',
                language: '',
                clients_info: '',
                display_booking: '',
                additional_mobile: '',
                source: '',
                address_name: '',
                address: '',
                apartment: '',
                district: '',
                city: '',
                region: '',
                post_code: '',
                state: '',
                email_notification: 1,
                email_marketing_notification: 1,
                text_message_notification: 1,
            },
            loading: false,
            uploadLoading: false,
            uploading: false,
        }
    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.core.UserInfo !== null) {
            this.userInfo = window.core.UserInfo;
            this.basicData();
        }
        this.countryList();
        this.dateLoading = true;
        this.initializeInput();
        this.dob();
    },
    methods: {

        // Function of country list from json file
        countryList() {
            this.countries = window.core.countries;
            sort.Sort(this.countries,'name')
        },

        // Function of assigns User basic data to the form data
        basicData() {
            let userData = JSON.parse(JSON.stringify(this.userInfo))
            this.formData = {
                first_name: userData.first_name ?? '',
                last_name: userData.last_name ?? '',
                mobile: userData.mobile ?? '',
                email: userData.email ?? '',
                gender: userData.gender ?? null,
                dob: userData.dob ?? '',
                avatar: userData.avatar ?? '',
                country: userData.country ?? '',
                currency: userData.currency ?? '',
                timezone: userData.timezone ?? '',
                language: userData.language ?? '',
                clients_info: userData.clients_info ?? '',
                display_booking: userData.display_booking ?? '',
                additional_mobile: userData.additional_mobile ?? '',
                source: userData.source ?? '',
                address_name: userData.address_name ?? '',
                address: userData.address ?? '',
                apartment: userData.apartment ?? '',
                district: userData.district ?? '',
                city: userData.city ?? '',
                region: userData.region ?? '',
                post_code: userData.post_code ?? '',
                state: userData.state ?? '',
                email_notification: userData.email_notification ?? '',
                email_marketing_notification: userData.email_marketing_notification ?? '',
                text_message_notification: userData.text_message_notification ?? '',
            }
        },

        // Function of open profile modal
        openProfileModal() {
            apiService.ClearErrorHandler();
            this.basicData();
            setTimeout(() => {
                this.dob();
            }, 200)
            let modal = new bootstrap.Modal(document.getElementById('basicInfoModal'))
            modal.show();
        },

        // Function of close profile modal
        closeProfileModal() {
            const Modal = document.querySelector('#basicInfoModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        // Function of logout api
        logout() {
            apiService.ClearErrorHandler()
            this.logoutLoading = true;
            axios.get(apiRoutes.CustomerLogout, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.logoutLoading = false;
                toaster.info('Logout successful')
                window.location.reload();
            }).catch(err => {
                this.logoutLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of update profile
        updateProfile() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.patch(apiRoutes.UpdateProfile, this.formData, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.loading = false;
                EventBus.$emit('updateUserInfo', res.user);
                this.uploadLoading = false;
                this.userInfo = res.user
                toaster.info('Profile has been updated successfully.');
                window.core.UserInfo = this.formData;
                let basicModal = document.getElementById('basicInfoModal')
                if (basicModal.classList.contains('show')) {
                    this.closeProfileModal();
                }
            }).catch(err => {
                this.loading = false;
                this.uploadLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of date of birth initializer
        dob() {
            flatpickr("#dob", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                disableMobile: true,
                onChange: (selectedDates, dateStr, instance) => {
                    this.formData.dob = dateStr;
                },
            })
        },

        // Function of update password
        changePass() {
            apiService.ClearErrorHandler();
            this.passLoading = true;
            axios.patch(apiRoutes.ChangePassword, this.passwordForm, {headers: apiService.headerContent}).then((response) => {
                this.passLoading = false;
                this.passwordForm = {
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }
                toaster.info('Password has been updated successfully.')
            }).catch(err => {
                this.passLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of profile avatar attachment
        attachAvatar(event) {
            this.uploadLoading = true;
            this.uploading = true;
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file);
            formData.append("media_type", 1);
            formData.append("media_use", 1);
            axios.post(apiRoutes.Media, formData, {headers: apiService.mediaHeaderContent}).then((response) => {
                let res = response.data;
                event.target.value = '';
                    this.uploading = false;
                    this.userInfo.avatar = res.data.file_path;
                    this.formData.avatar = res.data.file_path;
                    this.updateProfile();
            }).catch(err => {
            })
        },

        // Function of toggle switch
        toggleSwitch(type) {
            this.formData[type] = this.formData[type] == 1 ? 2 : 1;
            this.updateProfile();
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

        // Function of google address autocomplete
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_location');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                    this.formData.lat = place.geometry.location.lat()
                    this.formData.lng = place.geometry.location.lng()
                    this.formData.address = place.formatted_address
                    let addressComponents = place.address_components;
                    for (let component of addressComponents) {
                        if (component.types.includes('administrative_area_level_1')) {
                            this.formData.district = component.long_name;
                        }
                        if (component.types.includes('locality')) {
                            this.formData.city = component.long_name;
                        }
                        if (component.types.includes('postal_code')) {
                            this.formData.post_code = component.long_name;
                        }
                        if (component.types.includes('country')) {
                            this.formData.country = component.long_name;
                        }
                    }
                    this.fullAddress = true;
                })
            }, 1000)
        },

        /* Function to open payment modal */
        openPaymentModal() {
            let modal = new bootstrap.Modal(document.getElementById('paymentMethodModal'))
            modal.show();
        },

        /* Function to close payment modal */
        closePaymentModal() {
            const Modal = document.querySelector('#paymentMethodModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

    }
}
</script>
