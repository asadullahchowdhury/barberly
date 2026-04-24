<template>
    <div class="service-manage">
        <form autocomplete="off" @submit.prevent="manageService">

            <!-- Header -->
            <div class="catalogue-header d-flex justify-content-between align-items-center">

                <div class="w-100">
                    <router-link :to="{name:'Services'}" href="javascript:void(0)" class="close-btn">
                        <img :src="`/images/global/x.svg`" alt="close">
                    </router-link>
                </div>

                <div class="w-100 d-md-inline d-none text-center">
                    <div class="title fw-semibold fs-5" v-if="route !== null">
                        <span v-if="route.name === 'ServiceCreate'">Add a new</span>
                        <span v-if="route.name === 'ServiceUpdate'">Edit</span>
                        single service
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-end">
                    <div class="d-flex">
                        <button type="button"
                                class="btn btn-danger me-3 border-radius-10 padding-x-12 padding-y-10 res-btn"
                                @click="openDeleteModal()" v-if="route !== null && route.name === 'ServiceUpdate'">
                            Delete
                        </button>

                        <button type="submit" class="btn btn-theme padding-x-12 padding-y-10 res-btn"
                                v-if="!manageLoading && route !== null">
                            <span v-if="route.name === 'ServiceCreate'"> Save </span>
                            <span v-if="route.name === 'ServiceUpdate'"> Update </span>
                        </button>

                        <button type="button" class="btn btn-theme btn-loading padding-x-12 padding-y-10 res-btn"
                                v-if="manageLoading">
                            <span class="loading"></span>
                        </button>
                    </div>

                </div>

            </div>

            <!-- Form content -->
            <div class="d-flex justify-content-center align-items-center flex-column">

                <h3 class="mb-4 pb-2" v-if="route !== null">
                    <span v-if="route.name === 'ServiceCreate'">Add a new</span>
                    <span v-if="route.name === 'ServiceUpdate'">Edit</span>
                    single service
                </h3>

                <div
                    class="service-form-content-box d-flex justify-content-center align-items-sm-center align-items-start flex-column">

                    <!-- Basic info -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Basic Info</div>
                            <p class="fw-normal">Add a service name and choose the service type.</p>
                        </div>
                        <div class="card-body p-md-4">
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-semibold">Service name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" id="name"
                                       v-model="formData.name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="select-box">
                                    <label for="" class="form-label fw-semibold">Service type</label>
                                    <div class="position-relative dropdown" data-bs-toggle="dropdown"
                                         aria-expanded="false">
                                        <input type="text" name="type" placeholder="Select service type"
                                               v-model="formData.type" class="form-control" @keyup="handleSearch()">
                                        <button type="button"
                                                class="border-0 bg-transparent position-absolute top-50 end-0 translate-middle-y pe-3">
                                            <img :src="`/images/portal/arrow-down.svg`" class="w-12 h-12 select-icon"
                                                 alt="arrow-down">
                                        </button>
                                    </div>
                                    <div class="dropdown-menu service-dropdown mt-2">
                                        <div v-for="each in serviceTypes" class="border-bottom"
                                             v-if="searchResults.length === 0">
                                            <div class=" fw-semibold text-dark p-2" v-if="each.types.length > 0">
                                                {{ each.title }}
                                            </div>
                                            <div v-for="type in each.types" :key="each.value"
                                                 class="text-hover-effect p-2 rounded-3"
                                                 @click="textInsert($event)">
                                                {{ type.name }}
                                            </div>
                                        </div>
                                        <div v-for="each in searchResults" class="border-bottom"
                                             v-if="searchResults.length > 0">
                                            <div class=" fw-semibold text-dark p-2" v-if="each.types.length > 0">
                                                {{ each.title }}
                                            </div>
                                            <div v-for="type in each.types" :key="each.value"
                                                 class="text-hover-effect p-2 rounded-3"
                                                 @click="textInsert($event)">
                                                {{ type.name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="category_id" class="form-label fw-semibold">Service category</label>
                                <select class="form-select form-control" name="category_id" id="category_id"
                                        v-model="formData.category_id">
                                    <option value="">Select category type</option>
                                    <option v-for="each in categoryListData" :value="each.id"
                                            v-if="categoryListData.length > 0">{{ each.name }}
                                    </option>
                                    <option value="" v-if="categoryListData.length === 0" disabled>No category
                                        available
                                    </option>
                                </select>
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="description" class="form-label fw-semibold d-flex justify-content-between">
                                    Service description
                                    <span class="fw-normal text-muted">
                                        {{ initialDescLength }}/{{ maxDescLength }}
                                    </span>
                                </label>

                                <textarea class="form-control h-110" placeholder="Add a short description"
                                          id="description"
                                          name="description" v-model="formData.description"
                                          cols="30" rows="10" :maxlength="maxDescLength"
                                          @keyup="lengthAlphabet(formData.description.length)"></textarea>
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="after_care" class="form-label fw-semibold d-flex justify-content-between">Aftercare
                                    description
                                    <span class="fw-normal text-muted">
                                        {{ initialAfterCareLength }}/{{ maxAfterCareLength }}
                                    </span>
                                </label>
                                <textarea class="form-control h-110" placeholder="Add aftercare description"
                                          name="after_care" id="after_care" v-model="formData.after_care"
                                          cols="300" rows="30" :maxlength="maxAfterCareLength"
                                          @keyup="lengthAfterCareAlphabet(formData.after_care.length)"></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="available_for" class="form-label fw-semibold">Service available for</label>
                                <select class="form-select form-control" name="available_for" id="available_for"
                                        v-model="formData.available_for">
                                    <option selected value="3">Everyone</option>
                                    <option value="2">Females only</option>
                                    <option value="1">Males only</option>
                                </select>
                                <div class="error-report"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Online booking -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Online booking</div>
                            <p class="fw-normal">
                                Enable online bookings, choose who the service is available for and add
                                a short description.
                            </p>
                        </div>
                        <div class="card-body p-md-4">
                            <div class="form-group my-3">
                                <div class="toggle d-flex">
                                    <input type="checkbox" :checked="formData.online_booking === 1"
                                           @change="toggleSwitch('online_booking')"/>
                                    <label></label>
                                    <div class="ms-3">Enable online bookings</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Team -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Team</div>
                            <p class="fw-normal">Assign team members to the service and manage commission</p>
                        </div>

                        <!-- team list loading -->
                        <appLoader class="p-3 p-md-4" v-if="loading"/>

                        <!-- no data -->
                        <div
                            class="d-flex justify-content-center flex-column gap-20 align-items-center no-data h-100 py-5"
                            v-if="teamData.length === 0 && loading === false">
                            <img :src="`/images/global/no-task.png`" class="img-fluid w-45 h-45" alt="no data">
                            <div class="font-size-30 font-weight-300 text-lighter">Empty List</div>
                        </div>

                        <div class="card-body position-relative p-md-4" v-if="teamData.length > 0 && loading === false">
                            <!--member add /remove loading-->
                            <div class="position-absolute team-manage-loading" v-if="!memberManageLoading">
                                <div class="loading-spin-1"></div>
                            </div>

                            <div class="alert alert-danger team-alert text-center" v-if="teamError !== null"
                                 v-text="teamError"></div>
                            <div class="form-group mb-3">
                                <label for="select_all">
                                    <input type="checkbox" class="form-checkbox" id="select_all"
                                           :checked="teamData.length > 0 && teamData.length === teamSelected.length"
                                           @change="teamToggleCheckAll($event)">
                                    <span class="fw-semibold fs-5"> Select all</span>
                                </label>
                            </div>

                            <div class="form-group mb-3" v-for="(each, index) in teamData">
                                <label :for="`team`+each.id" class="d-flex align-items-center">
                                    <input type="checkbox" class="form-checkbox" :id="`team`+each.id"
                                           :checked="teamCheckIfChecked(each.id)"
                                           @change="teamToggleCheck($event,each.id)">

                                        <!-- avatar image -->
                                        <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar" :size="'md'"/>
                                    <span class="fw-semibold ms-2">
                                        {{ each.first_name + ' ' + each.last_name }}
                                    </span>
                                </label>
                            </div>

                        </div>

                        <div class="card-footer bg-white px-md-4 py-md-4">
                            <div class="card-title mb-0">Team member commission</div>
                            <p class="fw-normal">Calculate team member commission when the service is sold.</p>

                            <div class="form-group mt-4 mb-3">
                                <div class="toggle d-flex">
                                    <input type="checkbox" :checked="formData.team_commission == 1"
                                           @change="toggleSwitch('team_commission')"/>
                                    <label></label>

                                    <div class="ms-3">Enable team member commission</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing and duration -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Pricing and Duration</div>
                            <p class="fw-normal">Add the pricing options and duration of the service.</p>
                        </div>
                        <div class="card-body p-md-4">

                            <!-- Pricing box -->
                            <template v-if="formData.pricing.length > 0" v-for="(each, index) in formData.pricing">
                                <div class="card w-100 card-price-option bg-secondary-subtle"
                                     :class="{'mb-3' : formData.pricing.length > 1}">
                                    <div
                                        class="card-header d-flex justify-content-between align-items-center bg-secondary-subtle border-0">
                                        <div class="card-title">Pricing option {{ index + 1 }}</div>

                                        <a href="javascript:void(0)" class="btn-icon" v-if="formData.pricing.length > 1"
                                           @click="removePricingOption(index)">
                                            <img :src="`/images/global/x.svg`" alt="x-icon">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group padding-bottom-16">
                                                    <label for="duration"
                                                           class="form-label fw-semibold">Duration</label>
                                                    <select name="duration" id="duration"
                                                            class="form-select form-control"
                                                            v-model="each.duration">
                                                        <option v-for="each in timeDuration" :value="each.value">
                                                            {{ each.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group padding-bottom-16">
                                                    <label for="price_type" class="form-label fw-semibold">Price
                                                        type</label>
                                                    <select name="price_type" id="Price_type"
                                                            class="form-select form-control"
                                                            v-model="each.type">
                                                        <option value="3">Free</option>
                                                        <option value="2">From</option>
                                                        <option value="1">Fixed</option>
                                                    </select>
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group padding-bottom-16">
                                                    <label for="pricing" class="form-label fw-semibold">Pricing</label>
                                                    <input type="text" class="form-control"
                                                           :name="'pricing.' + index + '.price'"
                                                           id="pricing"
                                                           placeholder="Price"
                                                           v-model="each.price" @keypress="checkNumber($event)">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group padding-bottom-16">
                                                    <label for="" class="form-label fw-semibold">Pricing name<span
                                                        class="fw-normal text-muted d-none">(optional)</span></label>
                                                    <input type="text" class="form-control"
                                                           :name="'pricing.' + index + '.name'"
                                                           placeholder="Price Name"
                                                           v-model="each.name">
                                                    <div class="error-report"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <a href="javascript:void(0)"
                                           class="text-theme mt-4 d-none fw-semibold underline-anim">
                                            Advanced pricing options
                                        </a>
                                    </div>
                                </div>
                            </template>

                            <a href="javascript:void(0)" class="mt-4 d-block text-theme" @click="addPricingOption">
                                <img :src="`/images/global/plus-circle-theme.svg`" alt="plus circle theme"
                                     class="me-2 w-24 h-24">
                                <span class="underline-anim text-theme"> Add pricing option</span>
                            </a>

                        </div>
                        <div class="card-footer bg-white px-md-4 py-md-4">
                            <div class="card-title mb-0">Extra time</div>
                            <p class="fw-normal">Enable extra time after the service.</p>

                            <div class="form-group mt-4 mb-3">
                                <div class="toggle d-flex">
                                    <input type="checkbox" :checked="formData.extra === true"
                                           @change="extraTimeToggler"/>
                                    <label></label>

                                    <div class="ms-3">Enable extra time</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" v-if="formData.extra === true">
                                        <label for="extra_time" class="form-label fw-semibold">Duration</label>
                                        <select name="extra_time" id="" class="form-select form-control"
                                                v-model="formData.extra_time">
                                            <option v-for="each in timeDuration" :value="each.value">
                                                {{ each.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification setting -->
                    <div class="card manage-card mb-4 d-none">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Notification settings</div>
                            <p class="fw-normal">Manage automated messages sent for this service.</p>
                        </div>
                        <div class="card-body p-md-4">
                            <div class="form-group my-3">
                                <label for="select_all">
                                    <input type="checkbox" class="form-checkbox" id="select_all">
                                    <span class="w-100">Reminder to rebook notifications</span>
                                    <span class="w-100 small text-muted ms-4 ps-1">Choose when you would like to notify your
                                        clients to rebook this service
                                    </span>
                                </label>

                            </div>
                        </div>
                    </div>

                    <!-- Resources -->
                    <div class="card manage-card mb-4" v-if="resourceData.length > 0">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Resources</div>
                            <p class="fw-normal">Enable resources required for the service.</p>
                        </div>
                        <div class="card-body p-md-4">
                            <label for="resourceToggler" class="d-flex align-items-center cursor-pointer">
                                <span class="toggle">
                                    <input id="resourceToggler" type="checkbox" :checked="formData.resource === 1"
                                           @change="resourceToggler"/>
                                    <label></label>
                                </span>
                                <span class="ms-3">
                                    <span class="d-block fw-semibold mb-2">Resource required</span>
                                    <small class="d-block text-secondary">
                                        When enabled, a combination of team members and resource will be needed to book the service.
                                    </small>
                                </span>
                            </label>
                            <div class="mt-4" v-if="formData.resource">
                                <div class="fw-semibold fs-5 mb-3">
                                    John Smith
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3" v-for="each in resourceData">
                                        <label :for="`resource`+each.id" class="form-label">
                                            <input :id="`resource`+each.id" type="checkbox" class="form-checkbox">
                                            {{ each.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales setting -->
                    <div class="card manage-card mb-4">
                        <div class="card-header bg-white px-md-4 pt-md-4">
                            <div class="card-title mb-0">Sales settings</div>
                            <p class="fw-normal">Manage automated messages sent for this service.</p>
                        </div>
                        <div class="card-body p-md-4">
                            <h5 class="mb-3">Set the tax rate</h5>

                            <div class="form-group">
                                <label for="tax" class="form-label">Tax
                                    <span class="small text-muted">(Included in price)</span>
                                </label>
                                <select name="tax" id="tax" class="form-select form-control" v-model="formData.tax">
                                    <option value="Tax">Tax</option>
                                    <option value="No Tax">Default: No Tax</option>
                                </select>

                                <div class="error-report"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </form>

        <!-- Delete modal -->
        <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form @submit.prevent="serviceDelete" class="modal-content">
                    <div class="modal-header border-0 px-md-4 pt-md-4">
                        <h1 class="modal-title fs-5" id="deleteServiceModalLabel">Delete the service</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-4">
                        <p>Are you sure you want to delete this service? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer border-0 px-md-4 pb-md-4">
                        <button type="button" class="btn btn-secondary h-45 w-110" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-danger h-45 w-110" v-if="!deleteLoading">
                            Confirm
                        </button>
                        <button type="button" class="btn btn-danger h-45 btn-loading w-110" v-if="deleteLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import apiService from "../../../../../services/apiService";
import apiRoutes from "../../../../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import {useRoute} from "vue-router";
import {forEach} from "vuedraggable/dist/vuedraggable.common.js";
import axios from "axios";
import appLoader from "../../../../../components/app-loader.vue";
import avatarImage from "../../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        /* Component of app-loader */
        appLoader, avatarImage
    },

    data() {
        return {
            // Data properties for the component
            manageLoading: false,
            maxDescLength: '1000',
            maxAfterCareLength: '5000',
            initialDescLength: '0',
            initialAfterCareLength: '0',
            formData: {
                id: '',
                name: '',
                type: '',
                category_id: '',
                description: '',
                after_care: '',
                available_for: 3,
                team_commission: 2,
                team_members: [],
                extra_time: '',
                extra: false,
                tax: 'No Tax',
                pricing: [
                    {
                        duration: '60',
                        type: 1,
                        price: '',
                        name: '',
                    }
                ],
                online_booking: 1,
                resource: false,
            },
            listParam: {
                keyword: '',
                limit: 500,

            },
            categoryListData: [],
            listLoading: false,
            serviceTypes: [],
            timeDuration: [
                {name: '5min', value: '5'},
                {name: '10min', value: '10'},
                {name: '15min', value: '15'},
                {name: '20min', value: '20'},
                {name: '25min', value: '25'},
                {name: '30min', value: '30'},
                {name: '35min', value: '35'},
                {name: '40min', value: '40'},
                {name: '45min', value: '45'},
                {name: '50min', value: '50'},
                {name: '55min', value: '55'},
                {name: '1h', value: '60'},
                {name: '1h 5min', value: '65'},
                {name: '1h 10min', value: '70'},
                {name: '1h 15min', value: '75'},
                {name: '1h 20min', value: '80'},
                {name: '1h 25min', value: '85'},
                {name: '1h 30min', value: '90'},
                {name: '1h 35min', value: '95'},
                {name: '1h 40min', value: '100'},
                {name: '1h 45min', value: '105'},
                {name: '1h 50min', value: '110'},
                {name: '1h 55min', value: '115'},
                {name: '2h', value: '120'},
                {name: '2h 15min', value: '135'},
                {name: '2h 30min', value: '150'},
                {name: '2h 45min', value: '165'},
                {name: '3h', value: '180'},
                {name: '3h 15min', value: '195'},
                {name: '3h 30min', value: '210'},
                {name: '3h 45min', value: '225'},
                {name: '4h', value: '240'},
                {name: '4h 30min', value: '270'},
                {name: '5h', value: '300'},
                {name: '5h 30min', value: '330'},
                {name: '6h', value: '360'},
                {name: '6h 30min', value: '390'},
                {name: '7h', value: '420'},
                {name: '7h 30min', value: '450'},
                {name: '8h', value: '480'},
                {name: '9h', value: '540'},
                {name: '10h', value: '600'},
                {name: '11h', value: '660'},
                {name: '12h', value: '720'},
            ],
            route: null,
            deleteLoading: false,
            addPrice: [''],
            teamData: [],
            resourceData: [
                {id: '', name: 'chair', description: 'lorem 115'},
            ],
            loading: false,
            teamSelected: [],
            searchResults: [],
            teamError: null,
            serviceID: null,
            memberManageLoading: false,
        }
    },
    watch: {
        'formData.description'(desc) {
            if (desc !== null) {
                if (desc?.length < 100) {
                    this.initialDescLength = '0' + desc?.length
                } else {
                    this.initialDescLength = desc?.length
                }
            }
        },
        'formData.after_care'(care) {
            if (care !== null) {
                if (care?.length < 1000) {
                    this.initialAfterCareLength = '0' + care?.length
                } else {
                    this.initialAfterCareLength = care?.length
                }
            }
        }
    },
    mounted() {

        /* Mounted route define id defined or undefined */
        this.route = useRoute();
        if (this.route.params.id !== undefined) {
            this.getSingle(this.route.params.id)
            this.serviceID = this.route.params.id;
        }

        /* Mounted of Fixed top header */
        this.fixedHeader();

        /* Mounted of category list */
        this.categoriesList();

        /* Mounted of team list */
        this.teamList();

        /* Mounted of formData */
        this.formData.category_id = window.history.state.id;

        /* Mounted of service type */
        this.serviceTypes = window.core.serviceType
    },

    methods: {

        /* Function to team toggle check all */
        teamToggleCheckAll(e) {
            if (e.target.checked) {
                this.teamSelected = []
                this.teamData.forEach((v) => {
                    this.teamSelected.push(v.id);
                });
            } else {
                this.teamSelected = [];
            }
        },

        /* Function to team toggle check single */
        teamToggleCheck(e, id) {
            if (e.target.checked) {
                this.teamSelected.push(id);
                if (this.serviceID !== null) {
                    this.addTeamMember(id);
                }
            } else {
                let index = this.teamSelected.indexOf(id);
                if (this.serviceID !== null) {
                    this.removeTeamMember(id)
                }
                this.teamSelected.splice(index, 1);
            }
        },

        /* Function to team toggle check if check */
        teamCheckIfChecked(id) {
            return this.teamSelected.map(function (id) {
                return id
            }).indexOf(id) > -1;
        },

        /* Function to add pricing option */
        addPricingOption() {
            console.log(this.formData.pricing,)
            this.formData.pricing.push(
                {
                    duration: '60',
                    type: 1,
                    price: '',
                    name: '',
                }
            )
        },

        /* Function to remove pricing option */
        removePricingOption(index) {
            this.formData.pricing.splice(index, 1)
        },

        /* Function to fixed header */
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.catalogue-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        /* Function to service manage api */
        manageService() {
            apiService.ClearErrorHandler();
            this.teamError = null;
            this.manageLoading = true;
            if (this.teamSelected.length > 0) {
                this.formData.team_members = this.teamSelected
            }
            if (this.route.params.id !== undefined) {
                axios.patch(apiRoutes.ServiceUpdate, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.manageLoading = false;
                    toaster.info('Service has been updated successfully.');
                    this.$router.push({name: 'Services'});
                }).catch(err => {
                    this.manageLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                        if (res?.data?.errors?.team_members !== undefined) {
                            this.teamError = res?.data?.errors?.team_members[0];
                        }
                    } else {
                        toaster.error('Server error!')
                    }
                })
            } else {
                axios.post(apiRoutes.ServiceCreate, this.formData, {headers: apiService.headerContent}).then((response) => {
                    toaster.info('Service has been created successfully.');
                    if (window.history?.state?.module_name === 'calendar') {
                        this.$router.push({name: 'Calendar'});
                    } else {
                        this.$router.push({name: 'Services'});
                    }
                }).catch(err => {
                    this.manageLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                        if (res?.data?.errors?.team_members !== undefined) {
                            this.teamError = res?.data?.errors?.team_members[0];
                        }
                    } else {
                        toaster.error('Server error!')
                    }
                })
            }
        },

        /* Function to service single api */
        getSingle(id) {
            let param = {
                id: id
            }
            axios.get(apiRoutes.ServiceSingle, {params: param}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.formData = res.service
                this.teamSelected = this.formData.team_members;
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!');
                    this.$router.push({name: 'Services'});
                }
            })
        },

        /* Function of categories list api */
        categoriesList() {
            axios.get(apiRoutes.CategoriesList, {params: this.listParam}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.listLoading = false;
                this.categoryListData = res.categories.data;
            }).catch(err => {
                toaster.error('Category list has some errors.')
            })
        },

        /* Function to service delete api */
        serviceDelete() {
            let deleteParam = {
                id: this.formData.id
            }
            this.deleteLoading = true;
            axios.delete(apiRoutes.ServiceDelete, {params: deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Service has been delete successfully');
                this.closeDeleteModal();
                this.$router.push({name: 'Services'})
            }).catch(err => {
                this.deleteLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    toaster.info('Service not found');
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function to initial description length input */
        lengthAlphabet(num) {
            if (num === 1000) {
                this.initialDescLength = ('0' + num).slice(-4)
            } else {
                this.initialDescLength = ('0' + num).slice(-3)
            }
        },

        /* Function to initial after care description length input */
        lengthAfterCareAlphabet(num) {
            this.initialAfterCareLength = ('0' + num).slice(-4)
        },

        /* Function to toggle switch */
        toggleSwitch(type) {
            this.formData[type] = this.formData[type] == 1 ? 2 : 1;
        },

        /* Function to extra time toggle */
        extraTimeToggler() {
            this.formData.extra = !this.formData.extra
            if (this.formData.extra) {
                this.formData.extra_time = 15
            } else {
                this.formData.extra_time = ''
            }
        },

        /* Function to extra time toggle */
        resourceToggler() {
            this.formData.resource = !this.formData.resource
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
            const regex = /^[0-9]*\.?[0-9]*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },

        /* Function to open delete modal */
        openDeleteModal() {
            let modal = new bootstrap.Modal(document.getElementById('deleteServiceModal'))
            modal.show();
        },

        /* Function to close delete modal */
        closeDeleteModal() {
            const Modal = document.querySelector('#deleteServiceModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to insert service type text */
        textInsert(e) {
            this.formData.type = e.target.innerText
            this.serviceTypeActive = false;
        },

        /* Function to team list api */
        teamList() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.TeamMembers, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.loading = false;
                if (!this.formData.id !== undefined) {
                    if (res.members.data.length > 0) {
                        if (this.teamSelected.length === 0) {
                            this.teamSelected = [res.members.data[0].id];
                        }
                    }
                }
                this.teamData = res.members.data;
                this.total_pages = res.members.total < res.members.per_page ? 1 : Math.ceil((res.memberstotal / res.members.per_page));
                this.current_page = res.members.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
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

        /* Function to service type search */
        handleSearch() {
            this.searchResults = this.searchByName(this.formData.type.toLowerCase().trim());
        },

        /* Function to service type search by name */
        searchByName(name) {
            if (!name) {
                return [];
            }
            const matchingServices = this.serviceTypes.map((service) => {
                const matchingTypes = service.types.filter((type) =>
                    type.name.toLowerCase().includes(name)
                );
                return {
                    title: service.title,
                    types: matchingTypes,
                };
            }).filter((service) => service.types.length > 0);
            return matchingServices;
        },


        /*Add team member api*/
        addTeamMember(memberID) {
            this.memberManageLoading = true;
            apiService.ClearErrorHandler();
            axios.post(apiRoutes.ServiceList + '/' + this.serviceID + '/member/' + memberID + '/add', null, {headers: apiService.headerContent}).then((response) => {
                console.log(response.data)
            }).catch(err => {
                let res = err?.response?.data;
                console.log(res)
            }).finally(() => {
                this.memberManageLoading = false;
            })
        },


        /*Remove team member API*/
        removeTeamMember(memberID) {
            this.memberManageLoading = true;
            apiService.ClearErrorHandler();
            axios.delete(apiRoutes.ServiceList + '/' + this.serviceID + '/member/' + memberID + '/remove', {params: null}, {headers: apiService.headerContent}).then((response) => {
                console.log(response.data);
            }).catch(err => {
                let res = err?.response?.data;
                console.log(res)
            }).finally(() => {
                this.memberManageLoading = false;
            })
        },


    }
}
</script>
