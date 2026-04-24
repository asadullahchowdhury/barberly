<template>
    <div class="deal-manage">
        <!--Header text-->
        <div class="text-center mb-3">
            <p class="text-muted mb-1">Create a deal</p>
            <h3 class="fs-4 fw-semibold">Customize
                <span v-if="formData.type === 'promotion'">promotion</span>
                <span v-if="formData.type === 'flash_sale'">flash sale</span>
                <span v-if="formData.type === 'last_minute'">last-minute</span>
                details</h3>
            <p class="mb-0">Choose how and when to apply the
                <span v-if="formData.type === 'promotion'">promotion</span>
                <span v-if="formData.type === 'flash_sale'">flash sale</span>
                <span v-if="formData.type === 'last_minute'">last-minute offer</span>.
                <a href="javascript:void(0)" class="underline-anim text-theme">Learn more</a>
            </p>
        </div>

        <!--Main deal form-->
        <form action="" @submit.prevent="submitAccount">


            <!--Deal-->
            <div class="card rounded-3 mb-4">
                <div class="card-header bg-white rounded-top-3 p-md-4 p-3">
                    <h5 class="card-title fw-bold mb-1">Basic details</h5>
                    <p class="mb-0 lh-sm">Choose a unique name, active dates and items to sell with the deal</p>
                </div>
                <div class="card-body p-md-4 p-3">
                    <div class="form-group mb-4">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter deal name here"
                               v-model="formData.name"
                               :class="{'is-invalid-custom' : errors.name}"
                               name="name">
                        <div v-if="errors.name" class="error-report">{{ errors.name }}</div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="description" class="form-label fw-semibold">
                                Description <span
                                class="text-muted fw-normal">(Optional)</span>
                            </label>
                            <div class="text-muted me-1 mb-1">{{ descLength }}/600</div>
                        </div>

                        <textarea class="form-textarea h-120" name="description" id="" cols="30" rows="10"
                                  :maxlength="600"
                                  v-model="formData.description" @keyup="lengthAlphabet(formData.description.length)"
                                  placeholder="Enter promotion description here"></textarea>
                        <div class="error-report"></div>
                    </div>

                    <!--Apply to-->
                    <label for="" class="form-label fw-semibold">Apply
                        <span v-if="formData.type === 'promotion'">promotion</span>
                        <span v-if="formData.type === 'flash_sale'">flash sale</span>
                        <span v-if="formData.type === 'last_minute'">last-minute offer</span>
                        to
                    </label>

                    <!--Services-->
                    <div class="mb-3">
                        <div class="bg-body-tertiary rounded-3 d-flex justify-content-between align-items-center p-3 "
                             :class="{'border border-danger' : errors.services}">
                            <div class="name" v-if="servicesLength === formData.services?.length">All Services</div>
                            <div class="name" v-if="servicesLength !== formData.services?.length">
                                {{ formData.services?.length }} Services
                            </div>
                            <a href="javascript:void(0)" class="underline-anim text-theme"
                               @click="openServiceModal">Edit</a>
                        </div>
                        <div v-if="errors.services" class="error-report">{{ errors.services }}</div>
                    </div>


                    <!--Products-->
                    <div class="mb-3" v-if="formData.type !== 'last_minute'">
                        <div class="bg-body-tertiary rounded-3 d-flex justify-content-between align-items-center p-3 "
                             :class="{'border border-danger' : errors.products}">
                            <div class="name">No products</div>
                            <a href="javascript:void(0)" class="underline-anim text-theme"
                               @click="openProductModal">Edit</a>
                        </div>
                        <div v-if="errors.products" class="error-report">{{ errors.products }}</div>
                    </div>


                    <!--Membership-->
                    <div class="mb-3" v-if="formData.type !== 'last_minute'">
                        <div class="bg-body-tertiary rounded-3 d-flex justify-content-between align-items-center p-3 "
                             :class="{'border border-danger' : errors.memberships}">
                            <div class="name">No memberships</div>
                            <a href="javascript:void(0)" class="underline-anim text-theme"
                               @click="openMembershipModal">Edit</a>
                        </div>
                        <div v-if="errors.products" class="error-report">{{ errors.memberships }}</div>
                    </div>


                    <div class="toggle d-flex mb-4" v-if="formData.type !== 'last_minute'">
                        <input type="checkbox" :checked="formData.gift_card === 1" @change="toggleSwitch('gift_card')"/>
                        <label></label>
                        <div class="ms-3">Enable for gift cards</div>
                    </div>

                    <div class="row" v-if="formData.type !== 'last_minute'">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="form-group ">
                                <label for="" class="form-label fw-semibold">Start date</label>
                                <input type="text" class="form-control" placeholder="Start date" id="start_date"
                                       :class="{'is-invalid-custom' : errors.start_date}">
                                <div class="error-report" v-if="errors.start_date">{{ errors.start_date }}</div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label fw-semibold">End date</label>
                                <input type="text" class="form-control" placeholder="End date" id="end_date">
                            </div>
                        </div>

                    </div>

                    <!--Flash sale informative text-->
                    <div class="p-3 bg-theme-opacity d-flex justify-content-between align-items-center mt-4"
                         v-if="formData.type === 'flash_sale'">
                        <img class="w-20 h-20 me-3" :src="`/images/portal/light.svg`" alt="">
                        Flash sale applies to online sales and appointments booked between the start and end date.
                        Customers
                        will receive the discount for any selected appointment date.
                    </div>

                </div>
            </div>

            <!--Promotion value for promotion-->
            <div class="card rounded-3 mb-4" v-if="formData.type === 'promotion'">
                <div class="card-header bg-white rounded-top-3 p-md-4 p-3">
                    <h5 class="card-title fw-bold mb-1">Promotion value and limits</h5>
                    <p class="mb-0 lh-sm">Reduce the price by a fixed amount or a percentage, and limit the number of
                        times
                        this promotion can be used</p>
                </div>
                <div class="card-body p-md-4 p-3">
                    <div class="row gx-sm-3">
                        <div class="col-md-6 col-7">
                            <div class="form-group mb-4">
                                <label for="promotion_value" class="form-label fw-semibold">Promotion value</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control padding-left-60" id="promotion_value"
                                           v-model="formData.promotion_value" @keypress="checkNumber($event)"
                                           name="promotion_value">
                                    <div
                                        class="type position-absolute small text-muted top-0 ps-3 pt-2 margin-top-6 fw-semibold">
                                        {{ formData.promotion_type }}
                                    </div>
                                </div>
                                <div class="error-report"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-5">
                            <!--Promotion type button -->
                            <div class="btn-group mt-4 pt-1 border-radius-10">
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-end-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === '%'}"
                                        @click="promotionTypeChange('%')">
                                    %
                                </button>
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-start-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === 'BDT'}"
                                        @click="promotionTypeChange('BDT')">
                                    BDT
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="toggle d-flex mb-1">
                        <input type="checkbox" :checked="formData.check_limit_per_client === 1"
                               @change="toggleSwitch('check_limit_per_client')"/>
                        <label></label>
                        <div class="ms-3">Limit total number of uses</div>
                    </div>
                    <p class="ps-5 ms-2 small text-muted">Set the total amount of times this promotion can be used.</p>

                    <div class="col-md-6 mb-4" v-if="formData.check_limit_per_client === 1">
                        <div class="form-data">
                            <label for="" class="form-label fw-semibold">Max uses</label>
                            <input type="text" class="form-control" placeholder="Set max uses" name="limit_uses"
                                   v-model="formData.limit_uses" @keypress="checkNumber($event)">
                            <div class="error-report"></div>
                        </div>
                    </div>

                    <div class="toggle d-flex mb-1">
                        <input type="checkbox" :checked="formData.set_minimum_amount === 1"
                               @change="toggleSwitch('set_minimum_amount')"/>
                        <label></label>
                        <div class="ms-3">Set minimum purchase amount</div>
                    </div>
                    <p class="ps-5 ms-2 small text-muted">
                        The client must spend a minimum amount to qualify for this
                        promotion.
                    </p>

                    <div class="col-md-6 mb-4" v-if="formData.set_minimum_amount === 1">
                        <div class="form-data">
                            <label for="" class="form-label fw-semibold">Max uses</label>
                            <input type="text" class="form-control" placeholder="Set max uses" name="limit_uses"
                                   v-model="formData.minimum_amount" @keypress="checkNumber($event)">
                            <div class="error-report"></div>
                        </div>
                    </div>

                </div>
            </div>

            <!--Discount value and limits for flash sale-->
            <div class="card rounded-3 mb-4" v-if="formData.type === 'flash_sale'">
                <div class="card-header bg-white rounded-top-3 p-md-4 p-3">
                    <h5 class="card-title fw-bold mb-1">Discount value and limits</h5>
                    <p class="mb-0 lh-sm">Reduce the price by a fixed amount or a percentage, and limit the number of
                        times
                        this flash sale can be used</p>
                </div>
                <div class="card-body p-md-4 p-3">
                    <div class="row gx-sm-3">
                        <div class="col-md-6 col-7">
                            <div class="form-group mb-4">
                                <label for="promotion_value" class="form-label fw-semibold">Discount value</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control padding-left-60" id="promotion_value"
                                           v-model="formData.promotion_value" @keypress="checkNumber($event)"
                                           name="promotion_value">
                                    <div
                                        class="type position-absolute small text-muted top-0 ps-3 pt-2 margin-top-6 fw-semibold">
                                        {{ formData.promotion_type }}
                                    </div>
                                </div>
                                <div class="error-report"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-5">
                            <!--Promotion type button -->
                            <div class="btn-group mt-4 pt-1 border-radius-10">
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-end-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === '%'}"
                                        @click="promotionTypeChange('%')">
                                    %
                                </button>
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-start-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === 'BDT'}"
                                        @click="promotionTypeChange('BDT')">
                                    BDT
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="toggle d-flex mb-1">
                        <input type="checkbox" :checked="formData.check_limit_per_client === 1"
                               @change="toggleSwitch('check_limit_per_client')"/>
                        <label></label>
                        <div class="ms-3">Limit total number of uses</div>
                    </div>
                    <p class="ps-5 ms-2 small text-muted">Set the total amount of times this deal can be used.</p>

                    <div class="col-md-6 mb-4" v-if="formData.check_limit_per_client === 1">
                        <div class="form-data">
                            <label for="" class="form-label fw-semibold">Max uses</label>
                            <input type="text" class="form-control" placeholder="Set max uses" name="limit_uses"
                                   v-model="formData.limit_uses" @keypress="checkNumber($event)">
                            <div class="error-report"></div>
                        </div>
                    </div>

                </div>
            </div>

            <!--Last-minute discount and time for last minute-->
            <div class="card rounded-3 mb-4" v-if="formData.type === 'last_minute'">
                <div class="card-header bg-white rounded-top-3 p-md-4 p-3">
                    <h5 class="card-title fw-bold mb-1">Last-minute discount and time</h5>
                    <p class="mb-0 lh-sm">Reduce the price by a fixed amount or a percentage, and choose the time before
                        appointment clients need to book to get this offer.</p>
                </div>
                <div class="card-body p-md-4 p-3">
                    <div class="row gx-sm-3">
                        <div class="col-md-6 col-7">
                            <div class="form-group mb-4">
                                <label for="promotion_value" class="form-label fw-semibold">Discount value</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control padding-left-60" id="promotion_value"
                                           v-model="formData.promotion_value"
                                           name="promotion_value" @keypress="checkNumber($event)">
                                    <div
                                        class="type position-absolute small text-muted top-0 ps-3 pt-2 margin-top-6 fw-semibold">
                                        {{ formData.promotion_type }}
                                    </div>
                                </div>
                                <div class="error-report"></div>
                            </div>
                        </div>
                        <div class="col-md-6 col-5">
                            <!--Promotion type button -->
                            <div class="btn-group mt-4 pt-1 border-radius-10">
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-end-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === '%'}"
                                        @click="promotionTypeChange('%')">
                                    %
                                </button>
                                <button type="button"
                                        class="btn border px-0 width-50 height-50 small rounded-start-0 border-radius-10"
                                        :class="{'btn-theme' : formData.promotion_type === 'BDT'}"
                                        @click="promotionTypeChange('BDT')">
                                    BDT
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="p-3 bg-theme-opacity d-flex align-items-center my-4">
                        <img class="w-20 h-20 me-3" :src="`/images/portal/light.svg`" alt="">
                        Customers will receive this discount if they book within the selected time before the start of
                        their
                        appointment.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-md-0 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label fw-semibold">Before appointment time</label>
                                <input type="text" class="form-control" v-model="formData.appointment_time">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="" id="" class="form-select mt-md-4 pt-1" v-model="formData.appointment_type">
                                <option :value="1">Days</option>
                                <option :value="2">Hours</option>
                                <option :value="3">Minutes</option>
                            </select>
                        </div>
                    </div>


                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-theme px-5">Next step</button>
            </div>

        </form>


        <!--Service list Modal -->
        <div class="modal modal-lg fade" id="ServiceListModal" tabindex="-1" aria-labelledby="ServiceListModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-semibold fs-5" id="ServiceListModalLabel">Select services</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--Search-->
                    <div class="border-bottom p-3">
                        <div class="form-group position-relative">
                            <input type="text" name="keyword"
                                   class="form-control ps-5 h-45" placeholder="Search services" autocomplete="off"
                                   v-model="serviceSearch"
                                   @keyup="handleSearch()">
                            <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                     alt="search.svg">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body h-500 overflow-auto">

                        <!--Service list-->
                        <ul class="list-unstyled service-list m-0 p-0" v-if="categoryData.length > 0 && !listLoading">
                            <!--Select all-->
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

                            <!--Category and service loop-->
                            <li class="" v-for="(categories,parentIndex) in categoryData">
                                <div class="form-group">
                                    <!--Category list item-->
                                    <label for="select" class="p-3 item border-bottom w-100"
                                           v-if="categories.services.length > 0">
                                        <span class="fw-medium fs-5">{{ categories.name }}</span>
                                    </label>

                                    <!--Service list item   -->
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

                        <!--Loading-->
                        <AppLoader v-if="listLoading"/>

                        <!--No data-->
                        <emptyScreen class="h-100" :title="`service`" :icon="`no-data`"
                                     v-if="!listLoading && categoryData.length === 0"/>

                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark h-45 border-radius-10 w-110"
                                @click="hideServiceModal">Close
                        </button>
                        <button type="button" class="btn btn-theme w-110" @click="pushService()">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Product list Modal -->
        <div class="modal modal-lg fade" id="ProductListModal" tabindex="-1" aria-labelledby="ProductListModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-semibold fs-5" id="ProductListModalLabel">Select products</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--Search-->
                    <div class="border-bottom p-3">
                        <div class="form-group position-relative">
                            <input type="text" name="keyword"
                                   class="form-control ps-5 h-45" placeholder="Search product" autocomplete="off">
                            <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                     alt="search.svg">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body h-500 overflow-auto">

                        <!--No data-->
                        <emptyScreen
                            class="h-100"
                            :title="`products`"
                            :icon="`no-data`"
                        />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark h-45 border-radius-10 w-110"
                                @click="hideProductModal">
                            Close
                        </button>
                        <button type="button" class="btn btn-theme w-110">Apply</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Membership list Modal -->
        <div class="modal modal-lg fade" id="MembershipListModal" tabindex="-1"
             aria-labelledby="MembershipListModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-semibold fs-5" id="MembershipListModalLabel">Select
                            memberships</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--Search-->
                    <div class="border-bottom p-3">
                        <div class="form-group position-relative">
                            <input type="text" name="keyword"
                                   class="form-control ps-5 h-45" placeholder="Search memberships"
                                   autocomplete="off">
                            <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                     alt="search.svg">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body h-500 overflow-auto">

                        <!--No data-->
                        <emptyScreen class="h-100" :title="`membership`" :icon="`no-data`"/>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark h-45 border-radius-10 w-110"
                                @click="hideMembershipModal">
                            Close
                        </button>
                        <button type="button" class="btn btn-theme w-110">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import flatpickr from "flatpickr";
import axios from "axios";
import apiRoutes from "../../../../services/apiRoutes.js";
import apiService from "../../../../services/apiService.js";
import session from "../../../../services/session.js";
import AppLoader from "../../../../components/app-loader.vue";
import emptyScreen from "../../../../components/empty-screen.vue";
import formatDate from "../../../../services/date.js"
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
})

export default {
    components: {AppLoader, emptyScreen},
    data() {
        return {
            listLoading: false,
            singleLoading: false,
            removeLoading: false,
            formData: {},
            categoryData: [],
            serviceData: [],
            serviceSelected: [],
            descLength: '0',
            errors: {},
            manageLoading: false,
            dealData: null,
            servicesLength: 0,
            removeServiceParam: {
                id: '',
                deal_id: '',
                type: 'service',
            },
            searchResults: [],
            serviceSearch: '',
        }
    },
    watch: {
        'formData.description'(desc) {
            if (desc?.length < 10) {
                this.descLength = '0' + desc?.length
            } else {
                this.descLength = desc?.length
            }
        },
    },
    mounted() {
        this.retrieveDealsData();
        this.dateInitializer();
    },

    methods: {

        /* Function to retrieve/get data from session storage */
        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
                if (!this.formData.start_date) {
                    this.formData.start_date = formatDate()
                }
                this.categoriesList()
            } else {
                if (window.history.state.id != undefined && window.history.state.id != null && window.history.state.id != '') {
                    this.getSingleDeal(window.history.state.id);
                }
            }
        },

        /* Pushing all services id in form data if form data service is empty */
        pushAllService() {
            if (this.formData.services?.length === 0) {
                if (this.categoryData.length > 0) {
                    this.categoryData.forEach((category) => {
                        category.services.forEach((service) => {
                            this.serviceSelected.push(service.id)
                            this.formData.services.push(service.id)
                        })
                    })
                }
            }
        },

        /* Function to push selected service id */
        pushService() {
            this.formData.services = [];
            if (this.serviceSelected.length > 0) {
                this.formData.services = this.serviceSelected;
                this.hideServiceModal();
            } else {
            }
        },

        /* Function to store data in session storage */
        submitAccount() {
            if (this.validateForm()) {
                const jsonData = JSON.stringify(this.formData);
                // Store the JSON string in session storage
                session.setSession('dealData', jsonData)
                if (this.formData.type === 'promotion') {
                    this.$router.push({name: 'PromotionApply'})
                } else if (this.formData.type === 'last_minute') {
                    this.$router.push({name: 'SelectTeam'})
                } else if (this.formData.type === 'flash_sale') {
                    this.manageDeal();
                    this.$router.push({name: 'DealCompleted'})
                }
            }
        },

        /* Function to create/edit the deal */
        manageDeal() {
            this.manageLoading = true;
            apiService.ClearErrorHandler();
            axios.post(apiRoutes.Deals, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.manageLoading = false;
                let res = response.data.deal
                let data = {
                    type: res.type,
                    promotion_type: res.promotion_type,
                    promotion_value: res.promotion_value,
                    enable_point_of_sale: res.enable_point_of_sale,
                    discount_code: res.discount_code,
                    start_date: res.start_date,
                    end_date: res.end_date,
                }
                this.$router.push({name: 'DealCompleted', state: data})
            }).catch(err => {
                this.manageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Single deal api */
        getSingleDeal(id) {
            this.singleLoading = true;
            apiService.ClearErrorHandler();
            axios.get(apiRoutes.Deals, {params: {id: id}}, {headers: apiService.headerContent}).then((response) => {
                this.singleLoading = false;
                let res = response.data.deal;
                this.formData.id = res.id
                this.formData.name = res.name
                this.formData.type = res.type
                this.formData.description = res.description
                this.formData.gift_card = res.gift_card
                this.formData.start_date = res.start_date
                this.formData.end_date = res.end_date
                this.formData.promotion_value = res.promotion_value
                this.formData.promotion_type = res.promotion_type
                this.formData.check_limit_per_client = res.check_limit_per_client
                this.formData.limit_uses = res.limit_uses
                this.formData.set_minimum_amount = res.set_minimum_amount
                this.formData.minimum_amount = res.minimum_amount
                this.formData.enable_point_of_sale = res.enable_point_of_sale
                this.formData.enable_discount = res.enable_discount
                this.formData.discount_code = res.discount_code
                this.formData.appointment_time = res.appointment_time
                this.formData.appointment_type = res.appointment_type
                this.formData.services = [];
                res.services.forEach((service) => {
                    this.formData.services.push(service.service_id)
                })
                this.formData.products = res.products

                this.formData.members = [];
                res.members.forEach((member) => {
                    this.formData.members.push(member.member_id);
                });
                this.formData.memberships = res.memberships
                this.categoriesList();
                this.removeServiceParam.deal_id = res.id;
            }).catch(err => {
                this.singleLoading = false;
            })
        },

        /* Function to initialize the start and end date of the deal. */
        dateInitializer() {
            let THIS = this
            setTimeout(() => {
                this.startDate();

                flatpickr('#end_date', {
                    dateFormat: "Y-m-d",
                    altFormat: 'M j, Y',
                    altInput: true,
                    disableMobile: true,
                    onChange: function (selectedDates, dateStr, instance) {
                        THIS.formData.end_date = dateStr
                    }
                });
            }, 100)
        },
        startDate() {
            let THIS = this
            flatpickr('#start_date', {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: "today",
                disableMobile: true,
                onChange: function (selectedDates, dateStr, instance) {
                    THIS.formData.start_date = dateStr;
                    THIS.endDate();

                }
            })
        },
        endDate() {
            let THIS = this
            flatpickr('#end_date', {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                disableMobile: true,
                minDate: THIS.formData?.start_date !== undefined ? THIS.formData?.start_date : '',
                onChange: function (selectedDates, dateStr, instance) {
                    THIS.formData.end_date = dateStr
                }
            });
        },

        /* Function to open Service list modal */
        openServiceModal() {
            let modal = new bootstrap.Modal(document.getElementById('ServiceListModal'))
            modal.show();
        },

        /* Function to hide Service list modal */
        hideServiceModal() {
            const Modal = document.querySelector('#ServiceListModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open Product list modal */
        openProductModal() {
            let modal = new bootstrap.Modal(document.getElementById('ProductListModal'))
            modal.show();
        },

        /* Function to hide Product list modal */
        hideProductModal() {
            const Modal = document.querySelector('#ProductListModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open Service list modal */
        openMembershipModal() {
            let modal = new bootstrap.Modal(document.getElementById('MembershipListModal'))
            modal.show();
        },

        /* Function to hide Membership list modal */
        hideMembershipModal() {
            const Modal = document.querySelector('#MembershipListModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Categories list API */
        categoriesList() {
            this.listLoading = true;
            axios.get(apiRoutes.CategoriesList, {params: null}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.listLoading = false;
                this.categoryData = res?.categories?.data ?? [];
                if (this.formData.id === undefined) {
                    this.pushAllService();
                    this.categoryData.forEach((category) => {
                        this.servicesLength += category.services.length
                    })
                }
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
                if (window.history.state.id != undefined && window.history.state.id != '') {
                    this.removeServiceID(id);
                }
            }
        },

        /* Function to check if service is checked */
        serviceCheckIfChecked(id) {
            return this.serviceSelected.map(function (id) {
                return id
            }).indexOf(id) > -1;
        },

        /* Function to toggle switch */
        toggleSwitch(type) {
            this.formData[type] = this.formData[type] == 1 ? 2 : 1;
        },

        /* Function to change the promotion type and the options are (% ,BDT) */
        promotionTypeChange(type) {
            this.formData.promotion_type = type;
        },

        /* Function for length check */
        lengthAlphabet(num) {
            if (num < 10) {
                this.descLength = ('0' + num).slice(-3)
            } else {
                this.descLength = ('' + num).slice(-3)
            }
        },

        validateForm() {
            /* Function to Reset errors */
            this.errors = {};

            /* Validate each field */
            if (!this.formData.name || this.formData.name.length < 3) {
                this.errors.name = 'Name is required.';
            }

            if (!this.formData.start_date) {
                this.errors.start_date = 'Start date is required.';
            }

            if (this.formData?.services?.length === 0) {
                this.errors.services = 'Services is required.';
            }

            if (!this.formData.members) {
                this.errors.members = 'Member is required.';
            }

            if (Object.keys(this.errors).length !== 0) {
                toaster.error('PLease correct all forms')
            }
            /* Check if there are any errors */
            return Object.keys(this.errors).length === 0;
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
            const regex = /^\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },

        /* Function to remove service id API */
        removeServiceID(id) {
            this.removeLoading = true;
            axios.delete(apiRoutes.RemoveServiceID, {
                params: {
                    id: id,
                    deal_id: this.removeServiceParam.deal_id,
                    type: this.removeServiceParam.type,
                }
            }, {headers: apiService.headerContent}).then((response) => {
                this.removeLoading = false;
            }).catch(err => {
                this.removeLoading = false;
            })
        },

        /* Function to search service data */
        serviceSearchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.categoriesList();
            }, 800);
        },


        /* Function to service type search */
        handleSearch() {
            this.searchResults = this.searchByName(this.serviceSearch.toLowerCase().trim());
        },

        /* Function to service type search by name */
        searchByName(name) {
            if (!name) {
                return [];
            }
            let serviceData = [];
            this.categoryData.forEach((category) => {
                serviceData = category.services
            })
            const matchingServices = serviceData.map((service) => {
                return {
                    title: service.name,
                };
            }).filter((service) => service.length > 0);
            return matchingServices;
        },


    }
}
</script>
