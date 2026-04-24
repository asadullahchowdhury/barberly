<template>

    <div class="container-fluid pt-3 px-3 pt-sm-4 px-sm-3 customer-list-page scrollbar">
        <div class="d-flex justify-content-center">
            <div class="customer-box px-md-5">

                <!-- card-header section -->

                <div class="d-flex justify-content-between align-items-center pt-5 pt-xl-4">

                    <div class="fs-3 fw-semibold">
                        Customer list
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="dropdown me-2">
                            <button
                                class="btn btn-white has-border border-radius-10 h-45 option-dropdown disable-feature padding-y-10 new-res-btn"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="new-res-text">Options</span>
                                <img :src="`/images/global/settings.svg`" class="w-15 h-15 hide-icon" alt="gear">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Export as Excel</a></li>
                                <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                                <li>
                                    <router-link :to="{name: 'ImportCustomerData'}" class="dropdown-item">Import
                                        Customer
                                    </router-link>
                                </li>
                                <li><a class="dropdown-item" href="#">Merge Customer</a></li>
                            </ul>
                        </div>
                        <router-link :to="{name: 'CustomerManage', params:{id:'new'} }"
                                     class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 new-res-btn">
                            <span class="new-res-text me-2"> New </span> <img :src="`/images/portal/plus-white.svg`"
                                                                              class="w-15 h-15" alt="plus-white">
                        </router-link>
                    </div>
                </div>

                <div class="my-3 w-100">
                    View, add, edit and delete your customer's details.
                    <a href="javascript:void(0)"></a>
                    Learn more
                </div>

                <div class="bg-theme-opacity px-3 rounded-3">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-4 my-1 my-sm-2">
                            <div class="position-relative">
                                <input type="text" name="keyword" v-model="formData.keyword" @keyup="searchData()"
                                       class="form-control ps-5 h-45" placeholder="Search Here" autocomplete="off">
                                <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                    <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                         alt="search.svg">
                                </div>
                            </div>
                        </div>
                        <!--                        <div-->
                        <!--                            class="col-12 col-md-8 d-flex justify-content-between align-items-center my-1 my-sm-2 ps-0">-->
                        <!--                            <div class="w-100 d-flex">-->
                        <!--                                <div class="d-flex align-items-center"-->
                        <!--                                     v-if="tableData.length > 0 && loading === false && selected.length > 0">-->
                        <!--                                    <button type="button" class="selected-btn margin-right-10" @click="selectCustomerDelete()">-->
                        <!--                                        <img :src="`/images/portal/delete.svg`" class="h-20" alt="delete icon">-->
                        <!--                                    </button>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="w-100 d-flex justify-content-end">-->
                        <!--                                <button type="button" class="btn btn-white has-border border-radius-10 h-45 px-3 res-filter" data-bs-toggle="modal" data-bs-target="#filterModal">-->
                        <!--                                    <span class="res-text me-2"> Filter </span> <img :src="`/images/portal/black-filter.svg`" class="w-20 h-20 " alt="filter">-->
                        <!--                                </button>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>

                <div class="mt-3 card-body scrollbar"
                     :class="{ 'card-body-pagination-not-exist' : last_page === 1,
                     'card-body-pagination-exist' : last_page > 1 }">

                    <!-- table data will show till 568px -->
                    <table class="padding-x-16 padding-bottom-20 customer-list table border-none"
                           v-if="tableData.length > 0 && loading === false">
                        <thead>
                        <tr>
                            <th class="padding-left-18 fw-semibold">
                                <div class="d-flex align-items-center">
                                    Name
                                    <div class="d-flex flex-column align-items-center margin-left-10"
                                         @click="sortList('first_name')">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'first_name'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'first_name'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="ps-0 phone fw-semibold">
                                <div class="d-flex align-items-center">
                                    Mobile <span class="ms-1 d-none d-lg-inline-block"> Number </span>
                                    <div class="d-flex flex-column align-items-center margin-left-10"
                                         @click="sortList('mobile')">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'mobile'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'mobile'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="ps-0 fw-semibold">
                                <div class="d-flex align-items-center">
                                    Email
                                    <div class="d-flex flex-column align-items-center margin-left-10"
                                         @click="sortList('email')">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'email'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'email'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="ps-0 date fw-semibold">
                                <div class="d-flex align-items-center">
                                    Date Added
                                    <div class="d-flex flex-column align-items-center margin-left-10"
                                         @click="sortList('created_at')">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'created_at'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'created_at'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(each) in tableData">
                            <td class="padding-left-18">
                                <div class="d-flex align-items-center justify-content-start">

                                    <div class="margin-right-18">
                                        <!-- avatar image -->
                                        <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar"/>
                                    </div>

                                    <span class="d-flex justify-content-start align-items-start flex-column">
                                        <span class="text-theme d-block">{{
                                                each.first_name + ' ' + each.last_name
                                            }}</span>
                                        <span class="d-block dropdown">
                                            <button
                                                class="btn text-decoration-none text-dark px-0 border-0 dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                                <li>
                                                    <router-link :to="{name: 'CustomerManage', params: {id:each.id}}"
                                                                 class="dropdown-item px-3 py-2 rounded-2">
                                                        Edit
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                                            @click="openDeleteCustomer(each.id)">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </span>
                                    </span>
                                </div>
                            </td>
                            <td class="phone">
                                <div v-if="each.mobile !== null">{{ each.mobile }}</div>
                                <div class="fst-italic text-muted" v-if="each.mobile === null">N/A</div>
                            </td>
                            <td>
                                {{ each.email }}
                            </td>
                            <td class="date">
                                {{ each.created_at_formatted }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- table data will show on 568px -->
                    <div class="card-list padding-5">
                        <div class="card-info margin-bottom-20 padding-20 " v-for="each in tableData">
                            <div
                                class="card-info-header padding-bottom-20 d-flex align-items-start justify-content-between">

                                <!-- avatar image -->
                                <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar" :size="'lg'"/>

                                <div class="dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img :src="'/images/global/vertical-dots.svg'" class="padding-x-5"
                                             alt="vertical-dots">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                        <li>
                                            <router-link :to="{name: 'CustomerManage', params:{id:each.id}}"
                                                         class="dropdown-item px-3 py-2 rounded-2">
                                                Edit
                                            </router-link>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                                    @click="openDeleteCustomer(each.id)">
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-info-body">
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Name :</strong>
                                    <div class="text-theme text-truncate">{{
                                            each.first_name + ' ' + each.last_name
                                        }}
                                    </div>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Phone :</strong>
                                    <div class="text-truncate" v-if="each.mobile !== null">{{ each.mobile }}</div>
                                    <div class="fst-italic text-muted" v-if="each.mobile === null">N/A</div>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Email :</strong>
                                    <div class="text-truncate">{{ each.email }}</div>
                                </div>
                                <div class="d-grid grid-template-col-2">
                                    <strong>Date :</strong>
                                    <div class="text-truncate">{{ each.created_at_formatted }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- page loading -->
                    <appLoader class="padding-5" v-if="loading"/>

                    <!-- no data text -->
                    <emptyScreen
                        :title="`customer`"
                        :sub_title="`Click “New +” to create new customer.`"
                        :btn="true"
                        :btn_title="`New`"
                        :plus-icon="true"
                        @handler="newCustomer()"
                        v-if="tableData.length === 0 && loading === false"/>

                </div>

                <!-- pagination -->
                <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                            @page-change="handlePageChange" v-if="last_page > 1 && !loading"/>

            </div>
        </div>

    </div>

    <!-- filter modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content padding-10">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group padding-bottom-16">
                        <label for="customer_group" class="form-label"></label>
                        <select id="customer_group" name="customer_group" class="form-select h-45 padding-x-20">
                            <option value="">Barberly Added</option>
                            <option value="">Manually Added</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Gender</label>
                        <select name="" class="form-select padding-x-20 h-45">
                            <option value="">Select Gender</option>
                            <option value="">Male</option>
                            <option value="">Female</option>
                            <option value="">no-binary</option>
                            <option value="">prefer not to say</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between border-top-0">
                    <a href="javascript:void(0)" class="text-decoration-none theme-text">Clear all Filter</a>
                    <span class="d-flex align-items-center">
                        <button type="button" class="btn btn-secondary px-5 h-45 me-2"
                                data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-theme px-5 h-45">Apply</button>
                    </span>
                </div>
            </div>
        </div>
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

import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";

import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
import appLoader from "../../../../components/app-loader.vue";
import pagination from "../../../../components/pagination.vue";
import emptyScreen from "../../../../components/empty-screen.vue";
import avatarImage from "../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        appLoader, pagination, emptyScreen, avatarImage
    },

    data() {

        return {
            InfoPopup: false,
            customerPopup: false,
            password: '',
            passwordFieldType: 'password',
            confirmPasswordFieldType: 'password',
            loading: false,
            createLoading: false,
            deleteLoading: false,
            customerParam: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                mobile: '',
                country: '',
                timezone: '',
                currency: '',
                language: '',
                company_id: ''
            },
            deleteParam: {id: ''},
            customers: [],
            tableData: [],
            formData: {keyword: '', limit: 20, page: 1, sort_by: 'id', sort_mode: 'asc'},
            total_pages: 0,
            current_page: 0,
            buttons: [],
            searchTimeout: null,
            error: null,
            responseData: null,
            table_data: 0,
            selected: [],
            last_page: 0,
        }

    },

    mounted() {
        this.dropdownInit();
        this.customerList();
    },

    methods: {

        // Function to page change from global component pagination
        handlePageChange(page) {
            this.current_page = page;
            this.customerList();
        },

        sortList(sort) {
            this.formData.sort_by = sort
            if (this.formData.sort_mode === 'asc') {
                this.formData.sort_mode = 'desc'
            } else {
                this.formData.sort_mode = 'asc'
            }
            this.customerList()
        },


        handleBackDropClick() {
            event.stopPropagation();
        },

        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        confirmPasswordVisibility() {
            this.confirmPasswordFieldType = this.confirmPasswordFieldType === "password" ? "text" : "password";
        },

        // dropdown work on table
        dropdown(e) {
            let dropdown = document.querySelectorAll('.customer-dropdown-menu');
            dropdown.forEach(drop => {
                drop.classList.remove('active');
            })
            const dropdownMenu = e.target.closest('.customer-dropdown').querySelector('.customer-dropdown-menu');
            dropdownMenu.classList.add('active');
        },

        // dropdown outside control to remove dropdown
        dropdownInit() {
            document.addEventListener('mouseup', function (e) {
                const containers = Array.from(document.querySelectorAll('.outsideClick'));
                for (let i = 0; i < containers.length; i++) {
                    const clickedElement = e.target;
                    const isContainer = containers[i].contains(clickedElement);
                    if (isContainer) {
                        break;
                    } else {
                        containers[i].classList.remove('active');
                    }
                }
            });
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
                this.customerList();
                this.closeDeleteCustomer();
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

        // this function show all customer data
        customerList() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.CustomerList, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.tableData = res?.customers.data
                this.last_page = res?.customers.last_page
                this.total_pages = res.customers.total < res.customers.per_page ? 1 : Math.ceil((res.customers.total / res.customers.per_page));
                this.current_page = res.customers.current_page;
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

        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.customerList();
            }, 800);
        },

        /*Function for new Customer in empty screen*/
        newCustomer() {
            this.$router.push({name: 'CustomerManage', params: {id: 'new'}})
        }
    }

}

</script>
