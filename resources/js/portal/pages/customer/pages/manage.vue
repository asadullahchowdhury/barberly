<template>

    <div class="manage-customer scrollbar">

        <form autocomplete="off" @submit.prevent="manageCustomer()">

            <div class="customer-header d-flex justify-content-between align-items-center">

                <div class="w-100">
                    <button type="button" class="customer-add-close-btn" @click="goBack()">
                        <img :src="`/images/global/x.svg`" class="w-20 h-15" alt="close-btn">
                    </button>
                </div>
                <div class="w-100 d-sm-inline d-none text-center">
                    <div class="title fw-semibold fs-5">
                        <span v-if="isNew">Add a new</span>
                        <span v-if="!isNew">Edit</span>
                        customer
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-danger h-45 border-radius-10 me-2 res-btn"
                                @click="openDeleteCustomer(customerParam.id)" v-if="!isNew">
                            Delete
                        </button>
                        <button type="submit" class="btn-theme padding-x-12 padding-y-10 res-btn"
                                v-if="createLoading === false">
                            <span v-if="isNew"> Save </span>
                            <span v-if="!isNew"> Update </span>
                        </button>
                        <button type="button"
                                class="btn-theme d-flex align-items-center justify-content-center btn-loading padding-x-12 padding-y-10 res-btn"
                                v-if="createLoading === true">
                            <span class="loading"></span>
                        </button>
                    </div>
                </div>

            </div>

            <div class="container-fluid">
                <div class="d-flex justify-content-center">
                    <div class="col-12 col-md-12 col-lg-11 col-xl-10 col-xxl-8">
                        <div class="pt-5 pt-xl-4">

                            <div class="font-size-26 fw-semibold text-center margin-bottom-20">
                                <span v-if="isNew">Add a new</span>
                                <span v-if="!isNew">Edit</span>
                                customer
                            </div>

                            <div class="row">

                                <div class="col-12 col-lg-8 padding-20">

                                    <div class="card-form margin-bottom-20 border border-radius-5">
                                        <div
                                            class="font-size-18 font-weight-600 padding-12 padding-sm-24 border-bottom">
                                            Basic info
                                        </div>
                                        <div class="padding-12 padding-sm-24 row">

                                            <div class="col-md-6">
                                                <div class="form-group mb-3 me-md-2">
                                                    <label for="first_name" class="form-label">First name</label>
                                                    <input id="first_name" type="text" name="first_name"
                                                           v-model="customerParam.first_name"
                                                           placeholder="Enter customer first name"
                                                           class="form-control padding-x-20" autocomplete="off">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="last_name" class="form-label">Last name</label>
                                                    <input id="last_name" type="text" name="last_name"
                                                           v-model="customerParam.last_name"
                                                           placeholder="Enter customer last name"
                                                           class="form-control padding-x-20" autocomplete="off">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3 me-md-2">
                                                    <label for="mobile" class="form-label">Mobile number</label>
                                                    <input type="text" name="mobile" id="mobile"
                                                           v-model="customerParam.mobile"
                                                           class=" form-control padding-x-20"
                                                           @keypress="checkNumber($event)"
                                                           placeholder="Enter customer mobile number"
                                                           autocomplete="off">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input type="email" name="email" id="email"
                                                           class="form-control padding-x-20"
                                                           v-model="customerParam.email"
                                                           placeholder="Enter customer email" autocomplete="off">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-3 me-md-2">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select name="gender" id="gender" v-model="customerParam.gender"
                                                            class="form-select border-radius-10">
                                                        <option value="">Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                        <option value="3">no-binary</option>
                                                        <option value="4">prefer not to say</option>
                                                    </select>
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mb-0 mb-md-3">
                                                    <label for="date" class="form-label">Date of birth</label>
                                                    <div class="form-group">
                                                        <input id="dob" type="text" name="dob" class="form-control"
                                                               v-model="customerParam.dob"
                                                               placeholder="Enter date of birth">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-form margin-bottom-20 border border-radius-5">

                                        <div class="padding-12 padding-sm-24 border-bottom">
                                            <div class="font-size-18 font-weight-600 padding-bottom-10">
                                                Important customer info
                                            </div>
                                            <div class="font-weight-400">
                                                Important customer info will only be visible to you and team members.
                                            </div>
                                        </div>

                                        <div class="padding-12 padding-sm-24">
                                            <div class="form-group padding-bottom-16">
                                                <label for="customer_info" class="form-label">Customer info</label>
                                                <textarea v-model="customerParam.clients_info" name="clients_info"
                                                          placeholder="Enter customer info" id="customer_info" cols="30"
                                                          rows="5" class="form-textarea padding-20"
                                                          autocomplete="off"></textarea>
                                            </div>
                                            <label for="display" class="form-label">
                                                <input id="display" type="checkbox" name="display_booking"
                                                       :checked="customerParam.display_booking === 1"
                                                       @change="toggleSwitch('display_booking')"
                                                       class="form-checkbox margin-right-10" autocomplete="off">
                                                display on all bookings
                                            </label>
                                        </div>
                                    </div>

                                    <div class="card-form margin-bottom-20 border border-radius-5">
                                        <div
                                            class="font-size-18 font-weight-600 padding-12 padding-sm-24 border-bottom">
                                            Additional info
                                        </div>
                                        <div class="padding-12 padding-sm-24">
                                            <div class="form-group padding-bottom-16">
                                                <label for="additional_mobile" class="form-label">Additional phone
                                                    number</label>
                                                <input type="text" name="additional_mobile"
                                                       v-model="customerParam.additional_mobile"
                                                       @keypress="checkNumber($event)" class="form-control padding-x-20"
                                                       placeholder="Enter customer additional mobile number"
                                                       autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="source" class="form-label">Customer Source</label>
                                                <select name="source" id="source" v-model="customerParam.source"
                                                        class="form-select padding-x-20" autocomplete="off">
                                                    <option value="walk-in">Walk-in</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-form margin-bottom-20 border border-radius-5">
                                        <div
                                            class="font-size-18 font-weight-600 padding-12 padding-sm-24 border-bottom">
                                            Address
                                        </div>
                                        <div class="padding-12 padding-sm-24">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Address Name</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="Enter Address Name" name="address_name"
                                                               v-model="customerParam.address_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" id="google_autocomplete"
                                                               v-model="customerParam.address" name="address"
                                                               class="form-control"
                                                               placeholder="Start typing to search your address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Apt/Suite etc</label>
                                                        <input type="text" class="form-control" name="apartment"
                                                               placeholder="Enter Apt/Suite etc"
                                                               v-model="customerParam.apartment">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">District</label>
                                                        <input type="text" class="form-control" name="district"
                                                               placeholder="Enter District"
                                                               v-model="customerParam.district">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">City</label>
                                                        <input type="text" class="form-control" name="city"
                                                               placeholder="Enter City" v-model="customerParam.city">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Region</label>
                                                        <input type="text" class="form-control" name="region"
                                                               placeholder="Enter Region"
                                                               v-model="customerParam.region">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Postcode</label>
                                                        <input type="text" class="form-control" name="post_code"
                                                               placeholder="Enter Post code"
                                                               v-model="customerParam.post_code">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="address" class="form-label">Country</label>
                                                        <input type="text" class="form-control" name="country"
                                                               placeholder="Enter Country"
                                                               v-model="customerParam.country">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-lg-4 padding-20">

                                    <div class="border border-radius-5">
                                        <div class="border-bottom">
                                            <div class="padding-12 padding-sm-24">
                                                <div class="font-size-18 font-weight-600 padding-bottom-16">
                                                    Notifications
                                                </div>
                                                <div class="font-weight-400">
                                                    Choose how you'd like to keep this customer up to date about their
                                                    appointments and sales, like vouchers and memberships.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="font-size-18 font-weight-600 padding-12 padding-sm-24">
                                                Customer notifications
                                            </div>
                                            <label for="customer-notifications"
                                                   class="d-flex align-items-center padding-12 padding-sm-24">
                                                <span class="toggle">
                                                    <input id="customer-notifications" type="checkbox"
                                                           :checked="customerParam.email_notification === 1"
                                                           @change="toggleSwitch('email_notification')"/>
                                                    <label></label>
                                                </span>
                                                <span class="margin-left-10">
                                                    Send email notifications
                                                </span>
                                            </label>
                                        </div>
                                        <div class="border-bottom">
                                            <div class="padding-12 font-size-18 font-weight-600 padding-sm-24">
                                                Marketing notifications
                                            </div>
                                            <label for="marketing-notifications"
                                                   class="d-flex align-items-center padding-12 padding-sm-24">
                                                <span class="toggle">
                                                    <input id="marketing-notifications" type="checkbox"
                                                           :checked="customerParam.email_marketing_notification === 1"
                                                           @change="toggleSwitch('email_marketing_notification')"/>
                                                    <label></label>
                                                </span>
                                                <span class="margin-left-10">
                                                    Customer accepts email marketing notifications
                                                </span>
                                            </label>
                                            <label for="customer-accepts-email-marketing-notification"
                                                   class="d-flex align-items-center padding-12 padding-sm-24">
                                                <span class="toggle">
                                                    <input id="customer-accepts-email-marketing-notification"
                                                           type="checkbox"
                                                           :checked="customerParam.text_message_notification === 1"
                                                           @change="toggleSwitch('text_message_notification')"/>
                                                    <label></label>
                                                </span>
                                                <span class="margin-left-10">
                                                    Customer accepts text message marketing notifications
                                                </span>
                                            </label>
                                        </div>
                                        <div class="padding-12 padding-sm-24">
                                            <div class="form-group">
                                                <label for="select_language" class="form-label">Preferred
                                                    Language</label>
                                                <select id="select_language" v-model="customerParam.language"
                                                        name="language" class="form-select padding-x-20">
                                                    <option value="">Select Language</option>
                                                    <option v-for="each in languages"
                                                            :value="each.name">
                                                        {{ each.name }}
                                                    </option>

                                                    <option v-if="languages.length === 0" disabled>
                                                        No data!
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form @submit.prevent="deleteCustomer" autocomplete="off" class="modal-content p-2">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Customer ?</h1>
                    <button type="button" class="btn-close" @click="closeDeleteCustomer"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customer? This operation can’t be undone.
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary h-45 w-110" @click="closeDeleteCustomer">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger h-45 w-110" v-if="deleteLoading === false">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-danger btn-loading h-45 w-110" v-if="deleteLoading === true">
                        <span class="loading"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>

import apiService from "../../../../services/apiService";
import apiRoutes from "../../../../services/apiRoutes.js";
import sort from "../../../../services/sorting";
import VueGoogleAutocomplete from "vue-google-autocomplete";
import {useRoute} from 'vue-router';

import {createToaster} from "@meforma/vue-toaster";
import flatpickr from "flatpickr";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        VueGoogleAutocomplete
    },

    data() {

        return {
            address: false,
            password: '',
            passwordFieldType: 'password',
            confirmPasswordFieldType: 'password',
            createLoading: false,
            customerParam: {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                gender: '',
                dob: '',
                country: '',
                timezone: '',
                currency: '',
                language: 'English',
                additional_mobile: '',
                source: 'walk-in',
                address_name: '',
                address: '',
                apartment: '',
                district: '',
                city: '',
                post_code: '',
                region: '',
                display_booking: 1,
                email_notification: 2,
                email_marketing_notification: 2,
                text_message_notification: 2,
            },
            loading: false,
            isNew: false,
            deleteCustomerPopup: false,
            deleteLoading: false,
            deleteParam: {id: ''},
            customer: [],
            languages: [],
            dateLoading: false,
        }

    },

    mounted() {
        this.fixedHeader();

        /*initialize the language list from language json file*/
        this.languageList();

        const route = useRoute()
        if (route.params.id !== 'new') {
            this.getSingle(route.params.id)
        } else {
            this.isNew = true
        }

        this.initializeInput();

        this.dateLoading = true

        this.dateOfBirthFlatpickr();

    },

    methods: {

        goBack() {
            this.$router.back()
        },

        languageList() {
            this.languages = window.core.languages;
            sort.Sort(this.languages, 'name')
        },

        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                    this.customerParam.lat = place.geometry.location.lat()
                    this.customerParam.lng = place.geometry.location.lng()
                    this.customerParam.address = place.formatted_address
                    let addressComponents = place.address_components;
                    for (let component of addressComponents) {
                        if (component.types.includes('administrative_area_level_1')) {
                            this.customerParam.district = component.long_name;
                        }
                        if (component.types.includes('locality')) {
                            this.customerParam.city = component.long_name;
                        }
                        if (component.types.includes('postal_code')) {
                            this.customerParam.post_code = component.long_name;
                        }
                        if (component.types.includes('country')) {
                            this.customerParam.country = component.long_name;
                        }
                    }
                    this.fullAddress = true;
                })
            }, 1000)
        },

        // password visibility show and hide
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        // confirmation password visibility show and hide
        confirmPasswordVisibility() {
            this.confirmPasswordFieldType = this.confirmPasswordFieldType === "password" ? "text" : "password";
        },

        // this function work for create customer data
        manageCustomer() {
            apiService.ClearErrorHandler();
            this.createLoading = true;
            if (this.isNew === false) {
                this.updateCustomer()
            } else {
                this.createCustomer()
            }
        },

        // this function work for update customer data
        updateCustomer() {
            this.createLoading = true;
            axios.patch(apiRoutes.CustomerUpdate, this.customerParam, {headers: apiService.headerContent}).then((response) => {
                this.createLoading = false;
                toaster.info('Customer has been updated successfully.');
                this.$router.push({name: 'Customer'});
            }).catch(err => {
                this.createLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // this function work for create customer data
        createCustomer() {
            this.createLoading = true;
            axios.post(apiRoutes.CustomerCreate, this.customerParam, {headers: apiService.headerContent}).then((response) => {
                this.createLoading = false;
                toaster.info('Customer has been created successfully.');
                this.$router.push({name: 'Customer'});
            }).catch(err => {
                this.createLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* customer single api */
        getSingle(id = null) {
            let param = {
                id: id
            }
            axios.get(apiRoutes.CustomerSingle, {params: param}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.customerParam = res.customer;
                setTimeout(() => {
                    this.dateOfBirthFlatpickr()
                }, 200)
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!');
                    this.$router.push({name: 'Customer'});
                }
            })
        },

        /*number check*/
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

        /*toggle switch*/
        toggleSwitch(type) {
            this.customerParam[type] = this.customerParam[type] == 1 ? 2 : 1;
        },

        // show delete customer popup
        openDeleteCustomer(id) {
            this.deleteParam.id = id
            const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false});
            myModal.show();
        },

        // hide delete customer popup = true;
        closeDeleteCustomer() {
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        // this function work for delete customer
        deleteCustomer() {
            this.deleteLoading = true;
            axios.delete(apiRoutes.CustomerDelete, {params: this.deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Customer has been deleted successfully.');
                this.closeDeleteCustomer();
                this.$router.push({name: 'Customer'});
            }).catch(err => {
                this.deleteLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // handle backdrop click for popup
        handleBackDropClick() {
            event.stopPropagation();
        },

        /*Fixed header*/
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.customer-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        dateOfBirthFlatpickr() {
            flatpickr("#dob", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                maxDate: 'today',
                disableMobile: true,
            })
        }

    }
}

</script>
