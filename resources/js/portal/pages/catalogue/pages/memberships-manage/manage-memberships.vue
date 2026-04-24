<template>
    <div class="membership-manage">
        <form autocomplete="off" @submit.prevent="manageMembership">

            <!-- Header -->
            <div class="catalogue-header d-flex justify-content-between align-items-center">
                <div class="w-100">
                    <router-link :to="{name:'Memberships'}" class="close-btn">
                        <img :src="`/images/global/x.svg`" alt="close">
                    </router-link>
                </div>
                <div class="w-100 d-md-inline d-none text-center">
                    <div class="title fw-semibold fs-5">
                        <span v-if="formData.id === undefined">Create a new</span>
                        <span v-if="formData.id !== undefined">Edit</span>
                        membership
                    </div>
                </div>
                <div class="w-100 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger padding-x-12 padding-y-10 res-btn me-2 border-radius-10"
                            v-if="formData.id !== undefined" @click="openDeleteMemberShip">
                        Delete
                    </button>
                    <button type="submit" class="btn btn-theme padding-x-12 padding-y-10 res-btn" v-if="!manageLoading">
                        <span v-if="formData.id === undefined">Save</span>
                        <span v-if="formData.id !== undefined">Update</span>
                    </button>
                    <button type="button" class="btn btn-theme btn-loading padding-x-12 padding-y-10 res-btn"
                            v-if="manageLoading">
                        <span class="loading"></span>
                    </button>
                </div>
            </div>

            <!-- Form content -->
            <div class="d-flex justify-content-center align-items-center flex-column">

                <h3 class="mb-4 pb-2 fw-semibold">
                    <span v-if="formData.id === undefined">Create a new</span>
                    <span v-if="formData.id !== undefined">Edit</span>
                    membership
                </h3>

                <div
                    class="membership-form-content-box d-flex justify-content-center align-items-sm-center align-items-start flex-column">

                    <!-- Basic info -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Basic Info
                            </div>
                        </div>
                        <div class="card-body p-md-4">
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    Membership name
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" id="name"
                                       v-model="formData.name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label fw-semibold d-flex justify-content-between">
                                    Membership description
                                    <span class="fw-normal text-muted">
                                        {{ initialDescLength }}/{{ maxDescLength }}
                                    </span>
                                </label>

                                <textarea class="form-control h-110" placeholder="Add a description"
                                          id="description"
                                          name="description" v-model="formData.description"
                                          cols="30" rows="10" :maxlength="maxDescLength"
                                          @keyup="lengthAlphabet(formData.description.length)"></textarea>
                                <div class="error-report"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Services and sessions -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Services and sessions
                            </div>
                            <div class="mt-2 text-secondary">
                                Add the services and sessions included in the membership.
                            </div>
                        </div>
                        <div class="card-body p-md-4">
                            <div class="form-group mb-4">
                                <div class="alert alert-danger team-alert text-center" v-if="serviceError !== null"
                                     v-text="serviceError"></div>
                                <label for="service" class="form-label fw-semibold">
                                    Included services
                                </label>
                                <div class="position-relative">
                                    <div
                                        class="w-100 border height-50 border-radius-10 bg-light d-flex align-items-center padding-left-13 disable-feature">
                                        {{ formData.services.length }} Services
                                    </div>
                                    <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                                        <a href="javascript:void(0)" class="text-theme underline-anim"
                                           @click="openSelectServiceModal">
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="sessions" class="form-label fw-semibold">
                                            Sessions
                                        </label>
                                        <select name="sessions" class="form-select border-radius-10" id="sessions"
                                                v-model="formData.sessions" autocomplete="new-sessions">
                                            <option :value="1">Limited</option>
                                            <option :value="2">Unlimited</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3" :class="{'disable-feature' : formData.sessions === 2}">
                                        <label for="number-of-sessions" class="form-label fw-semibold">
                                            Number of sessions
                                        </label>
                                        <input id="number-of-sessions" type="text" class="form-control"
                                               :disabled="formData.sessions === 2"
                                               v-model="formData.session_no"
                                               autocomplete="new-number-of-sessions" @keypress="checkNumber($event)">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Pricing and payment -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Pricing and payment
                            </div>
                            <div class="mt-2 text-secondary">
                                Choose how you'd like your clients to pay.
                            </div>
                        </div>
                        <div class="card-body p-md-4">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="valid-for" class="form-label fw-semibold">
                                            Valid for
                                        </label>
                                        <select name="valid-for" id="valid-for" class="form-select border-radius-10"
                                                v-model="formData.valid_for">
                                            <option v-for="each in selectDays" :value="each.dayText">
                                                {{ each.dayText }}
                                            </option>
                                        </select>
                                        <div class="error-report"></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tax-rate" class="form-label fw-semibold">
                                            Tax rate
                                        </label>
                                        <select name="tax-rate" id="tax-rate" class="form-select border-radius-10"
                                                v-model="formData.tax">
                                            <option value="no-tax">No Tax</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="form-label fw-semibold">
                                            Price
                                        </label>

                                        <div class="position-relative">
                                            <div
                                                class="position-absolute bottom-0 start-0 h-100 d-flex align-items-center padding-y-1 disable-feature px-3">
                                                BDT
                                            </div>
                                            <input type="text" name="price" class="form-control padding-left-55"
                                                   placeholder="Amount"
                                                   v-model="formData.price"
                                                   @change="initPrice(formData.price)"
                                                   @keypress="checkNumber($event);">
                                        </div>
                                        <div class="error-report"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Color customization -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Color customization
                            </div>
                            <div class="mt-2 text-secondary">
                                Select a colour that matches your business.
                            </div>
                        </div>
                        <div class="card-body p-md-4">

                            <div class="form-group">
                                <div class="d-flex align-items-center flex-wrap">
                                    <span v-for="each in color">
                                        <input type="radio" name="color" class="color me-2 mb-3"
                                               :style="{background:each}" @change="formData.color = each"
                                               :checked="formData.color === each">
                                    </span>
                                </div>
                                <div class="error-report"></div>
                            </div>

                        </div>
                    </div>

                    <!-- Online sales -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Online sales
                            </div>
                            <div class="mt-2 text-secondary">
                                Choose if you would like to sell your membership online.
                            </div>
                        </div>
                        <div class="card-body p-md-4">

                            <label for="online-sales"
                                   class="d-flex align-items-center justify-content-start cursor-pointer">
                                <span class="toggle">
                                    <input id="online-sales" type="checkbox"/>
                                    <label></label>
                                </span>

                                <span class="fw-semibold ms-3">
                                    Enable online sales
                                </span>
                            </label>

                            <div class="mt-3">
                                <div class="bg-theme-opacity p-3 text-secondary">
                                    Online membership sales are coming soon to Bangladesh with payments in Barberly
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white py-md-3 px-md-4">
                            <div class="font-size-23 fw-semibold">
                                Terms & Conditions
                            </div>
                            <div class="mt-2 text-secondary">
                                If there are any rules attached to your membership it's a good place to mention them.
                            </div>
                        </div>
                        <div class="card-body p-md-4">

                            <div class="form-group mb-4">
                                <label for="after_care" class="form-label fw-semibold d-flex justify-content-between">
                                    Terms & conditions (optional)
                                    <span class="fw-normal text-muted">
                                        {{ initialTermsConditions }}/{{ termsConditionsLength }}
                                    </span>
                                </label>
                                <textarea class="form-control h-110" placeholder="Add terms & conditions"
                                          name="after_care" id="after_care"
                                          v-model="formData.terms_conditions"
                                          cols="300" rows="30" :maxlength="termsConditionsLength"
                                          @keyup="lengthTermsConditions(formData.terms_conditions.length)"></textarea>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </form>

    </div>

    <!-- Service list Modal -->
    <div class="modal modal-lg fade" id="ServiceListModal" tabindex="-1" aria-labelledby="ServiceListModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-semibold fs-5" id="ServiceListModalLabel">Select services</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Search -->
                <div class="border-bottom p-3">
                    <div class="form-group position-relative">
                        <input type="text" name="keyword"
                               class="form-control ps-5 h-45" placeholder="Search services"
                               v-model="serviceData.keyword" @keyup="serviceSearchData">
                        <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                            <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                 alt="search.svg">
                        </div>
                    </div>
                </div>

                <div class="modal-body h-500 overflow-auto">

                    <!-- Service list -->
                    <ul class="list-unstyled service-list m-0 p-0" v-if="categoryData.length > 0 && !listLoading">
                        <!-- Select all -->
                        <li class="">
                            <div class="form-group">
                                <label for="select_all" class="p-3 border-bottom item w-100">
                                    <input type="checkbox" class="form-checkbox" id="select_all"
                                           @change="serviceToggleCheckAll($event)"
                                           :checked="servicesLength > 0 && servicesLength === serviceSelected.length">
                                    <span class="fw-medium fs-5">All Services</span>
                                </label>
                            </div>
                        </li>

                        <!-- Category and service loop -->
                        <li class="" v-for="(categories,parentIndex) in categoryData">
                            <div class="form-group">
                                <!-- Category list item -->
                                <label for="select" class="p-3 item border-bottom w-100"
                                       v-if="categories.services.length > 0">
                                    <span class="fw-medium fs-5">{{ categories.name }}</span>
                                </label>

                                <!-- Service list item -->
                                <label v-for="(each,index) in categories.services"
                                       :for="'service_' + parentIndex + index"
                                       class="ps-3 item w-100">

                                       <span class="border-bottom p-3 d-block">
                                            <input type="checkbox" class="form-checkbox"
                                                   :id="'service_' + parentIndex + index"
                                                   :checked="serviceCheckIfChecked(each.id)"
                                                   @change="serviceToggleCheck($event,each.id)">

                                        <span class="fs-6">{{ each.name }}</span>
                                       </span>
                                </label>
                            </div>

                        </li>

                    </ul>

                    <!-- Loading -->
                    <appLoader v-if="listLoading"/>

                    <!-- no data text start -->
                    <emptyScreen
                        class="h-100"
                        :title="'services'"
                        :sub_title="`Click “New +” to create new category/service.`"
                        :btn="true"
                        :btn_title="`New`"
                        :plus-icon="true"
                        @handler="goServiceRoute()"
                        v-if="categoryData.length === 0 && !listLoading"/>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark h-45 border-radius-10 w-110"
                            @click="closeSelectServiceModal">
                        Close
                    </button>
                    <button type="button" class="btn btn-theme w-110" @click="pushService()">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form @submit.prevent="deleteMemberShip" class="modal-content">
                <div class="modal-header border-0 px-md-4 pt-md-4">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Membership ?</h1>
                    <button type="button" class="btn-close" @click="closeDeleteMemberShip"></button>
                </div>
                <div class="modal-body px-md-4">
                    <p>
                        Are you sure you want to delete this membership? <br>
                        This operation can’t be undone.
                    </p>
                </div>
                <div class="modal-footer border-0 px-md-4 pb-md-4">
                    <button type="button" class="btn btn-secondary h-45 w-110" @click="closeDeleteMemberShip">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger h-45 w-110" v-if="!deleteLoading">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-danger btn-loading h-45 w-110" v-if="deleteLoading">
                        <span class="loading"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>

import axios from "axios";
import apiRoutes from "../../../../../services/apiRoutes.js";
import apiService from "../../../../../services/apiService.js";
import {colors} from "../../../../../constants/color.js";
import {useRoute} from "vue-router";
import {createToaster} from "@meforma/vue-toaster";
import appLoader from "../../../../../components/app-loader.vue";
import emptyScreen from "../../../../../components/empty-screen.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        /* Component of draggable, pagination and app-loader */
        appLoader, emptyScreen
    },
    data() {
        return {
            // Data properties for the component
            maxDescLength: '360',
            termsConditionsLength: '3000',
            initialDescLength: '0',
            initialTermsConditions: '0',
            color: colors,
            selectDays: [
                {dayText: '7 days'},
                {dayText: '14 days'},
                {dayText: '1 month'},
                {dayText: '2 months'},
                {dayText: '3 months'},
                {dayText: '4 months'},
                {dayText: '6 months'},
                {dayText: '8 months'},
                {dayText: '18 months'},
                {dayText: '2 years'},
                {dayText: '5 years'},
            ],
            formData: {
                name: '',
                description: '',
                includedServices: '0 Services',
                sessions: 1,
                session_no: '5',
                valid_for: '7 days',
                price: 1.00,
                tax: 'no-tax',
                color: 'rgb(255, 156, 187)',
                terms_conditions: '',
                services: [],
            },
            listLoading: false,
            serviceTableData: [],
            manageLoading: false,
            serviceSelected: [],
            servicePushLoading: false,
            categoryData: [],
            servicesLength: 0,
            serviceData: {keyword: '', page: 1},
            deleteLoading: false,
            serviceError: null,
        }
    },
    watch: {
        'formData.sessions'(newSession) {
            if (newSession === 2) {
                this.formData.session_no = ''
            } else {
                this.formData.session_no = 5
            }
        },

        /*Checks the length of terms and condition*/
        'formData.terms_conditions'(terms) {
            this.initialTermsConditions = '0' + terms?.length
        },
        /*Checks the length of terms and condition*/
        'formData.description'(desc) {
            this.initialDescLength = '0' + desc?.length
        },
    },

    mounted() {

        this.route = useRoute();
        if (this.route.params.id !== undefined) {
            this.getSingle(this.route.params.id)
        }

        this.fixedHeader();
        this.categoryServiceList();

    },

    methods: {

        /* Function to open select service modal */
        openSelectServiceModal() {
            if (this.formData.services.length === 0) {
                this.serviceSelected = [];
            } else {
            }
            let modal = new bootstrap.Modal(document.getElementById('ServiceListModal'))
            modal.show();
        },

        /* Function to close select service modal */
        closeSelectServiceModal() {
            const Modal = document.querySelector('#ServiceListModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to control length textarea of description */
        lengthAlphabet(num) {
            this.initialDescLength = ('0' + num).slice(-3)
        },

        /* Function to control length textarea of terms & privacy*/
        lengthTermsConditions(num) {
            this.initialTermsConditions = ('0' + num).slice(-4)
        },

        /* function to Fixed header */
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.catalogue-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        /* Function of Categories list api */
        categoryServiceList() {
            this.listLoading = true;
            this.serviceData.page = this.current_page;
            axios.get(apiRoutes.CategoriesList, {params: this.serviceData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.listLoading = false;
                this.categoryData = res?.categories?.data ?? [];
                this.categoryData.forEach((category) => {
                    this.servicesLength += category.services.length
                })
            }).catch(err => {
                this.listLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function to number check */
        checkNumber(e) {
            let theEvent = e || window.event;
            let key;
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            const regex = /^\d*\.?\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },


        /* Function to push selected service id */
        pushService() {
            this.formData.services = [];
            this.formData.services = this.serviceSelected
            this.closeSelectServiceModal();
        },

        /* Function to check all services */
        serviceToggleCheckAll(e) {
            if (e.target.checked) {
                this.serviceSelected = []
                this.categoryData.forEach((category) => {
                    category.services.forEach((service) => {
                        this.serviceSelected.push(service.id);
                    })
                });
            } else {
                this.serviceSelected = [];
            }
        },

        /* Function to check single service */
        serviceToggleCheck(e, id) {
            if (e.target.checked) {
                this.serviceSelected.push(id);
            } else {
                let index = this.serviceSelected.indexOf(id);
                this.serviceSelected.splice(index, 1);
            }
        },

        /* Function to check if service is checked */
        serviceCheckIfChecked(id) {
            return this.serviceSelected.map(function (id) {
                return id
            }).indexOf(id) > -1;
        },

        /* Function to manage membership api */
        manageMembership() {
            apiService.ClearErrorHandler();
            this.serviceError = null;
            if (this.route.params.id !== undefined) {

                /* Function to call update api */
                this.manageLoading = true;
                axios.patch(apiRoutes.MemberShip + '/update', this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.manageLoading = false;
                    toaster.info('Membership has been updated successfully.');
                    this.$router.push({name: 'Memberships'});
                }).catch(err => {
                    this.manageLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                        if (res?.data?.errors?.services !== undefined) {
                            this.serviceError = res?.data?.errors?.services[0];
                        }
                    } else {
                        toaster.error('Server error!')
                    }
                })

            } else {

                /* Function to call create api */
                this.manageLoading = true;
                axios.post(apiRoutes.MemberShip, this.formData, {headers: apiService.headerContent}).then((response) => {
                    toaster.info('Membership has been created successfully.');
                    this.$router.push({name: 'Memberships'});
                }).catch(err => {
                    this.manageLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                        if (res?.data?.errors?.services !== undefined) {
                            this.serviceError = res?.data?.errors?.services[0];
                        }
                    } else {
                        toaster.error('Server error!')
                    }
                })
            }
        },

        /* Function to memberships single api */
        getSingle(id) {
            let param = {
                id: id
            }
            axios.get(apiRoutes.MemberShip, {params: param}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.formData = res?.membership
                res?.membership.services.forEach((v) => {
                    this.serviceSelected.push(v.service_id)
                })
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    toaster.error('Member not found.')
                    apiService.ErrorHandler(res?.data?.errors);
                    this.$router.push({name: 'Memberships'});
                } else {
                    toaster.error('Server error!');
                    this.$router.push({name: 'Memberships'});
                }
            })
        },

        /* Function to redirect services */
        goServiceRoute() {
            this.closeSelectServiceModal();
            this.$router.push({name: 'Services'})
        },

        /* Function to search service data */
        serviceSearchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.categoryServiceList();
            }, 800);
        },

        /* Function to show delete membership */
        openDeleteMemberShip() {
            const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false});
            myModal.show();
        },

        /* Function to hide delete membership */
        closeDeleteMemberShip() {
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        /* Function to delete membership */
        deleteMemberShip() {
            let deleteParam = {
                id: this.formData.id
            }
            this.deleteLoading = true;
            axios.delete(apiRoutes.MemberShip, {params: deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Membership has been deleted successfully.');
                this.closeDeleteMemberShip();
                this.$router.push({name: 'Memberships'})
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

        initPrice(price) {
            new Intl.NumberFormat('de-DE', {style: 'currency', currency: 'BDT'}).format(
                price
            )
            console.log(price, 'p')
        },
    }
}
</script>
