<template>

    <div class="memberships-content d-xl-flex justify-content-center align-items-center scrollbar"
         v-if="membershipExistPage === false">

        <!-- Background shape -->
        <img :src="`/images/portal/market-place-shape.svg`" class="img-fluid market-place-curve"
             alt="market-place-shape">

        <!-- Memberships text content -->
        <div class="col-xl-6 col-xxl-4 p-3 d-flex justify-content-start align-items-center flex-column">
            <div class="me-lg-3">
                <span class="badge text-success badge badge-success px-3 py-2">
                    Free to use
                </span>
                <div class="my-2 fs-3 fw-semibold">
                    Manage multi-session memberships
                </div>
                <div class="text-secondary my-2">
                    Boost your revenue by combining multiple treatments into a membership and turn your clients into
                    regulars.
                </div>
                <p class="line-height-2 d-flex align-items-center justify-content-start">
                    <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                    Ensure a steady income with recurring memberships
                </p>
                <p class="line-height-2 d-flex align-items-center justify-content-start">
                    <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                    Encourage clients to buy an upfront course of treatments
                </p>
                <p class="line-height-2 d-flex align-items-center justify-content-start">
                    <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                    Customers can easily book and keep track of their remaining sessions
                </p>
                <div class="mt-3 row">
                    <!--Start now button-->
                    <div class="col-xxl-4 col-xl-6 col-sm-5">
                        <router-link :to="{name: 'MembershipCreate'}"
                                     class="btn btn-theme w-100 h-45 me-2 mb-sm-0 mb-3">
                            Start Now
                        </router-link>
                    </div>
                    <!--Learn more button-->
                    <div class="col-xxl-4 col-xl-6 col-sm-5">
                        <button type="button"
                                class="btn btn-white has-border w-100 h-45 d-flex justify-content-center align-items-center border-radius-10 padding-y-10">
                            Learn more
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Memberships images -->
        <div class="col-xxl-3 d-flex align-items-center justify-content-center p-3">
            <div class="position-relative">
                <img :src="`/images/portal/membership-back.png`" class="img-fluid object-fit-cover back-image"
                     alt="membership-back">
                <div class="position-absolute bottom-0 end-0">
                    <img :src="`/images/portal/membership-front.png`" class="img-fluid front-image"
                         alt="membership-front">
                </div>
            </div>
        </div>

    </div>

    <div v-if="this.membershipExistPage === true">
        <div class="row justify-content-center pt-5 px-3">
            <div class="col-xl-8 pt-3">

                <!-- Memberships header -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="font-size-25 fw-semibold mb-3 w-100">
                        Memberships
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <router-link :to="{name: 'MembershipCreate'}"
                                     class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 new-res-btn mb-3">
                            <span class="new-res-text me-3">New</span>
                            <img :src="`/images/portal/plus-white.svg`" class="w-15 h-15" alt="plus-white">
                        </router-link>
                    </div>
                </div>

                <div class="mt-2 px-1 mb-4 bg-theme-opacity rounded-3 w-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="col-9 col-md-7 col-lg-6 p-1 p-sm-3">
                            <div class="position-relative">
                                <input type="text" name="keyword" class="form-control ps-5 w-100"
                                       v-model="formData.keyword"
                                       @keyup="searchData" placeholder="Search here"
                                       required autocomplete="new-search-here">
                                <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                    <img :src="`/images/global/search.svg`" class="w-24 h-24" alt="search">
                                </div>
                            </div>
                        </div>
                        <div class="p-1 p-sm-3 text-end">
                            <button type="button"
                                    class="btn btn-white has-border h-45 padding-x-12 padding-y-10 new-res-btn border-radius-10"
                                    @click="openFilterMemberShip">
                                <span class="new-res-text me-3">Filter</span>
                                <img class="w-15 h-15 filter-icon" :src="`/images/portal/filter-black.svg`" alt="black">
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Memberships body with scrollbar -->
                <div class="memberships-body scrollbar" v-if="tableData.length > 0 && !loading">

                    <!-- Table data will show till 568px -->
                    <table class="padding-x-16 padding-bottom-20 memberships-list table border-none">
                        <thead>
                        <tr>
                            <th class="padding-left-18 fw-semibold">
                                <div class="d-flex align-items-center" @click="sortList('name')">
                                    Membership name
                                    <div class="d-flex flex-column align-items-center margin-left-10">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'name'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'name'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="padding-left-0 fw-semibold">
                                <div class="d-flex align-items-center" @click="sortList('valid_for')">
                                    Valid for
                                    <div class="d-flex flex-column align-items-center margin-left-10">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'valid_for'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'valid_for'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="padding-left-0 fw-semibold">
                                <div class="d-flex align-items-center" @click="sortList('sessions')">
                                    Sessions
                                    <div class="d-flex flex-column align-items-center margin-left-10">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'sessions'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'sessions'}">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                            <th class="padding-left-0 fw-semibold">
                                <div class="d-flex align-items-center" @click="sortList('price')">
                                    Price
                                    <div class="d-flex flex-column align-items-center margin-left-10">
                                        <a href="javascript:void(0)" class="sort-up h-7"
                                           :class="{'active' : formData.sort_mode === 'asc' && formData.sort_by === 'price'}">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down"
                                           :class="{'active' : formData.sort_mode === 'desc' && formData.sort_by === 'price'}">
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
                                    <div
                                        class="w-64 h-64 rounded-3 d-flex justify-content-center align-items-center"
                                        :style="`background:`+each.color">
                                        <img :src="`/images/portal/calendar-clock.svg`"
                                             class="w-24 h-24 overflow-hidden" alt="icon">
                                    </div>
                                    <span class="ms-3 d-block">
                                        <span class="d-block fw-semibold text-theme name text-truncate">
                                            {{ each.name }}
                                        </span>
                                        <span class="d-block fw-semibold text-secondary service">
                                            {{ each.services.length }} services
                                        </span>
                                        <span class="dropdown d-block">
                                            <button type="button" class="btn border-0 p-0 dropdown-toggle"
                                                    data-bs-toggle="dropdown" data-bs-target="#action"
                                                    aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu border p-2 overflow-hidden rounded-2">
                                                <li>
                                                    <router-link :to="{name: 'MembershipUpdate', params:{id:each.id}}"
                                                                 class="dropdown-item px-3 py-2 rounded-2">
                                                        Edit
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)"
                                                       class="dropdown-item px-3 py-2 rounded-2"
                                                       @click="openDeleteMemberShip(each.id)">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </span>
                                    </span>
                                </div>
                            </td>
                            <td class="padding-left-0">
                                {{ each.valid_for }}
                            </td>
                            <td class="padding-left-0">
                                {{ each.sessions }} sessions
                            </td>
                            <td class="padding-left-0">
                                {{ 'BDT ' + each.price }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- table data will show on 568px -->
                    <div class="card-list padding-5" v-for="(each) in tableData">
                        <div class="card-info margin-bottom-20 padding-20">
                            <div
                                class="card-info-header padding-bottom-20 d-flex align-items-start justify-content-between">
                                <div
                                    class="w-64 h-64 rounded-3 bg-theme d-flex justify-content-center align-items-center">
                                    <img :src="`/images/portal/calendar-clock.svg`" class="w-24 h-24 overflow-hidden"
                                         alt="icon">
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn border-0 px-0" data-bs-toggle="dropdown"
                                            data-bs-target="#action" aria-expanded="false">
                                        <img :src="`/images/global/vertical-dots.svg`" alt="dots">
                                    </button>
                                    <ul class="dropdown-menu border p-2 overflow-hidden rounded-2">
                                        <li>
                                            <router-link :to="{name: 'MembershipUpdate', params:{id:each.id}}"
                                                         class="dropdown-item px-3 py-2 rounded-2">
                                                Edit
                                            </router-link>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2"
                                               @click="openDeleteMemberShip(each.id)">
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-info-body">
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Name :</strong>
                                    <div class="text-truncate">
                                        {{ each.name }}
                                    </div>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Valid for :</strong>
                                    <div class="text-truncate">
                                        {{ each.valid_for }}
                                    </div>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Sessions :</strong>
                                    <div class="text-truncate">
                                        {{ each.sessions }} sessions
                                    </div>
                                </div>
                                <div class="d-grid grid-template-col-2">
                                    <strong>Price :</strong>
                                    <div class="text-truncate">
                                        {{ 'BDT ' + each.price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Page loading -->
                <AppLoader v-if="loading" class="ps-0"/>

                <!-- No data text -->
                <emptyScreen class="memberships-body scrollbar"
                             :title="`memberships`"
                             :sub_title="`Click “New +” to create new membership.`"
                             :btn="true"
                             :btn_title="`New`"
                             :plus-icon="true"
                             @handler="newMembership()"
                             v-if="tableData.length === 0 && !loading"/>

            </div>

            <!-- Pagination -->
            <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                        @page-change="handlePageChange" v-if="last_page > 1 && !loading"/>

        </div>
    </div>

    <!-- Filter modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 px-md-4 pt-md-4">
                    <h1 class="modal-title fs-5" id="filterModalLabel">Filter</h1>
                    <button type="button" class="btn-close" @click="closeFilterMemberShip"></button>
                </div>
                <div class="modal-body px-md-4">
                    <div class="form-group mb-3">
                        <label for="sessions" class="form-label">Sessions</label>
                        <select name="sessions" class="form-select" id="sessions" v-model="formData.sessions">
                            <option value="">Any number of sessions</option>
                            <option :value="2">Unlimited</option>
                            <option :value="1">Limited</option>
                        </select>
                        <div class="error-report"></div>
                    </div>
                    <div class="form-group mb-3 disable-feature">
                        <label for="payment" class="form-label">Payment</label>
                        <select name="payment" id="payment" class="form-select">
                            <option value="0">One-time and recurring</option>
                            <option value="1">Recurring</option>
                            <option value="2">One-off</option>
                        </select>
                        <div class="error-report"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="valid-for" class="form-label">Valid for</label>
                        <select name="valid-for" id="valid-for" class="form-select" v-model="formData.valid_for">
                            <option value="">Any Period</option>
                            <option v-for="each in selectDays" :value="each.dayText">
                                {{ each.dayText }}
                            </option>
                        </select>
                        <div class="error-report"></div>
                    </div>
                    <div class="form-group">
                        <label for="display" class="form-label d-flex align-items-center">
                            <input id="display" type="checkbox" class="form-checkbox"
                                   @change="toggleSwitch('all_service')"
                                   :checked="formData.all_service === 1">
                            Display only memberships which cover all services
                        </label>
                    </div>
                </div>
                <div class="modal-footer px-md-4 pb-md-4 justify-content-between">
                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim"
                       @click="clearFilter()">
                        Clear all filters
                    </a>
                    <span>
                        <button type="button" class="btn btn-secondary h-45 w-90 me-2 border-radius-10"
                                @click="closeFilterMemberShip">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-theme h-45 w-90 border-radius-10"
                                @click="list();closeFilterMemberShip();">
                            Confirm
                        </button>
                    </span>
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
import {createToaster} from "@meforma/vue-toaster";
import AppLoader from "../../../../../components/app-loader.vue";
import pagination from "../../../../../components/pagination.vue";
import emptyScreen from "../../../../../components/empty-screen.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {

    components: {
        /* Component of draggable, pagination and app-loader */
        AppLoader, pagination, emptyScreen
    },

    data() {

        return {
            // Data properties for the component
            membershipExistPage: false,
            loading: false,
            tableData: [],
            formData: {
                keyword: '',
                limit: 20,
                page: 1,
                sort_by: 'id',
                sort_mode: 'asc',
                sessions: '',
                valid_for: '',
                all_service: 2,
            },
            total_pages: 0,
            current_page: 0,
            buttons: [],
            searchTimeout: null,
            error: null,
            responseData: null,
            table_data: 0,
            last_page: 0,
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
            deleteParam: {id: ''},
            deleteLoading: false,
        }

    },

    mounted() {

        this.list();
        this.membershipExistPage = true

    },

    methods: {

        /* Function to page change from global component pagination */
        handlePageChange(page) {
            this.current_page = page;
            this.list();
        },

        /* Function to sort list of memberships */
        sortList(sort) {
            this.formData.sort_by = sort
            if (this.formData.sort_mode === 'asc') {
                this.formData.sort_mode = 'desc'
            } else {
                this.formData.sort_mode = 'asc'
            }
            this.list();
        },

        /* Function to show filter membership */
        openFilterMemberShip() {
            const myModal = new bootstrap.Modal("#filterModal", {keyboard: false});
            myModal.show();
        },

        /* Function to hide filter membership */
        closeFilterMemberShip() {
            const myModal = document.querySelector("#filterModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        /* Function to show delete membership */
        openDeleteMemberShip(id) {
            this.deleteParam.id = id
            const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false});
            myModal.show();
        },

        /* Function to hide delete membership */
        closeDeleteMemberShip() {
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        /* Function to call list of memberships table data */
        list() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.MemberShip, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                let res = response.data
                this.tableData = res?.memberships.data
                this.last_page = res?.memberships.last_page
                this.total_pages = res.memberships.total < res.memberships.per_page ? 1 : Math.ceil((res.memberships.total / res.memberships.per_page));
                this.current_page = res.memberships.current_page;
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

        /* Function to call search data of memberships table data */
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.list();
            }, 800);
        },

        /* Function for new memberships in empty screen */
        newMembership() {
            this.$router.push({name: 'MembershipCreate', params: {id: 'new'}})
        },

        /* Function to delete membership */
        deleteMemberShip() {
            this.deleteLoading = true;
            axios.delete(apiRoutes.MemberShip, {params: this.deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Membership has been deleted successfully.');
                this.list();
                this.closeDeleteMemberShip();
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

        /*toggle switch*/
        toggleSwitch(type) {
            this.formData[type] = this.formData[type] == 1 ? 2 : 1;
            console.log(this.formData.all_service)
        },

        /*Function to clear the filter*/
        clearFilter() {
            this.formData.sessions = '';
            this.formData.all_service = 2;
            this.formData.valid_for = '';
        },


    }

}

</script>
