<template>
    <div class="container-fluid deals px-md-5 pt-5 pb-4 px-4">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-10 col-12">
                <!--Deals header section start-->
                <div
                    class="mb-3 d-flex justify-content-between align-items-md-start align-items-center">
                    <h3 class="title fw-semibold fs-3">Deals
                        <sup class="font-size-10 border bg-white px-2 py-1 rounded-circle">{{
                                dealData?.data?.length
                            }}</sup>
                        <span class="sm fs-6 fw-normal d-md-block d-none">
                            Set up and manage the deals you offer to your
                            clients.
                            <a href="javascript:void(0)" class="text-theme underline-anim">Learn more.</a>
                        </span>
                    </h3>


                    <router-link :to="{name:'DealType'}" type="button"
                                 class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 new-res-btn">
                        <span class="new-res-text me-3">New</span> <img :src="`/images/portal/plus-white.svg`"
                                                                        class="w-15 h-15" alt="plus-white">
                    </router-link>
                </div>
                <!--Deals header section end  -->

                <!--Deals filter start-->
                <div class="bg-theme-opacity deal-filter py-3">
                    <div class="row gx-3">
                        <!--Search-->
                        <div class="col-lg-5 col-md-4 mb-md-0 mb-3">
                            <div class="form-group position-relative">
                                <input type="text" name="keyword" v-model="formData.keyword" @keyup="searchData()"
                                       class="form-control ps-5 h-45" placeholder="Search Here" autocomplete="off">
                                <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                    <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                         alt="search.svg">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 d-flex justify-content-between">

                            <!--Filter btn-->
                            <button type="button"
                                    class="btn btn-white has-border h-45 padding-x-12 padding-y-10 new-res-btn border-radius-10 me-2"
                                    @click="openFilterModal">
                                <span class="new-res-text me-1">Filter</span>
                                <img class="w-15 h-15 filter-icon" :src="`/images/portal/filter-black.svg`" alt="black">
                            </button>

                            <!--Sort-->
                            <select class="form-select border-radius-10 h-45" @change="updateSort()" v-model="sort">
                                <option value="name-asc">Deal name (A-Z)</option>
                                <option value="name-desc">Deal name (Z-A)</option>
                                <option value="created-at-asc">Created at (oldest first)</option>
                                <option value="created-at-desc">Created at (newest first)</option>
                            </select>

                        </div>

                        <!--If filtered anything-->
                        <div class="col-12 mt-2 d-flex align-items-center gap-10 flex-wrap"
                             v-if="formData.status !== '' || formData.type !== ''">
                            <div v-if="formData.type !== ''"
                                 class="py-1 px-2 bg-white rounded-pill border border-theme text-theme d-inline-flex gap-15 align-items-center justify-content-between">
                                <div class="text font-size-12 fw-semibold ps-2">
                                    <div v-if="formData.type == 'promotion'">Promotion</div>
                                    <div v-if="formData.type == 'last_minute'">Last minute</div>
                                    <div v-if="formData.type == 'flash_sale'">Flash sale</div>
                                </div>
                                <a href="javascript:void(0)" @click="clearTypeFilter">
                                    <img class="w-20 h-20 px-1" :src="`/images/global/x-theme.svg`" alt="x-theme">
                                </a>
                            </div>

                            <div v-if="formData.status !== ''"
                                 class="py-1 px-2 bg-white rounded-pill border border-theme text-theme d-inline-flex gap-15 align-items-center justify-content-between">
                                <div class="text font-size-12 fw-semibold ps-2">
                                    <div v-if="formData.status === 1">Active</div>
                                    <div v-if="formData.status === 2">Inactive</div>
                                    <div v-if="formData.status === 3">Archived</div>
                                </div>
                                <a href="javascript:void(0)" @click="clearStatusFilter">
                                    <img class="w-20 h-20 px-1" :src="`/images/global/x-theme.svg`" alt="x-theme">
                                </a>
                            </div>

                            <a href="javascript:void(0)" class="text-theme underline-anim" @click="clearAllFilter">
                                Clear All
                            </a>
                        </div>
                    </div>

                </div>
                <!--Deals filter end  -->


                <!--Deals list start-->
                <div class="row gx-3 mt-3 deals-list scrollbar">
                    <div class="col-12">
                        <!--If list data exists-->
                        <a href="javascript:void(0)"
                           v-if="dealData?.data?.length > 0 && !loading"
                           v-for="each in dealData.data"
                           class="each-deal p-3 border rounded-3 gap-20 mb-3 d-flex align-items-md-center">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div
                                    class="deal-icon w-64 h-64 d-sm-flex d-none justify-content-center align-items-center rounded-circle bg-theme-opacity p-0 me-md-3 me-2"
                                    @click="goToSingle(each.id)">
                                    <img v-if="each.type === 'promotion'" class="w-28 h-28"
                                         :src="`/images/portal/coupon.svg`" alt="coupon">
                                    <img v-if="each.type === 'flash_sale'" class="w-28 h-28"
                                         :src="`/images/portal/flash-sale.svg`" alt="flash-sale">
                                    <img v-if="each.type === 'last_minute'" class="w-28 h-28"
                                         :src="`/images/portal/timer.svg`" alt="timer">
                                </div>

                                <!--Deal info-->
                                <div class="content flex-grow-1 d-flex flex-column" @click="goToSingle(each.id)">
                                    <div class="title fw-semibold">{{ each.name }}</div>
                                    <p class="deal text-muted mb-0">
                                        <!--Will be visible till 767-->
                                        <span
                                            class="d-md-block d-none">
                                        <span v-if="each.type === 'promotion'">Promotion :</span>
                                        <span v-if="each.type === 'flash_sale'">Flash sale :</span>
                                        <span v-if="each.type === 'last_minute'">Last minute :</span>
                                        {{ each.promotion_value + each.promotion_type }} off all services, all gift cards
                                    </span>

                                        <!--Will be showing from 767-->
                                        <span class="d-md-none d-block">{{ each.promotion_value + each.promotion_type }}
                                        <span v-if="each.type === 'promotion'">Promotion :</span>
                                        <span v-if="each.type === 'flash_sale'">Flash sale :</span>
                                        <span v-if="each.type === 'last_minute'">Last minute :</span>
                                    </span>
                                    </p>
                                    <p class="duration text-muted mb-0">{{ each.start_date_formatted }} -
                                        <span v-if="each.end_date !== null">{{ each.end_date_formatted }}</span>
                                        <span v-if="each.end_date === null">Ongoing</span>
                                    </p>

                                    <div class="d-md-none d-inline mt-2">
                                        <div class="badge badge-success text-success px-3 py-2 "
                                             v-if="each.status === 1">
                                            Active
                                        </div>

                                        <div class="badge badge-warning text-warning px-3 py-2 "
                                             v-if="each.status === 2">
                                            Inactive
                                        </div>

                                        <div class="badge badge-danger text-danger px-3 py-2 " v-if="each.status === 3">
                                            Archived
                                        </div>
                                    </div>

                                </div>

                                <div class="status d-md-block d-none">
                                    <div class="badge badge-success text-success px-3 py-2" v-if="each.status === 1">
                                        Active
                                    </div>
                                    <div class="badge badge-warning text-warning px-3 py-2 " v-if="each.status === 2">
                                        Inactive
                                    </div>

                                    <div class="badge badge-danger text-danger px-3 py-2 " v-if="each.status === 3">
                                        Archived
                                    </div>
                                </div>

                                <!--Sale price-->
                                <div class="sale w-101 text-end d-md-block d-none" @click="goToSingle(each.id)">
                                    <p class="mb-1">Total sales</p>
                                    <p class="fw-semibold">BDT 0</p>
                                </div>
                            </div>


                            <div class="dropdown">
                                <a href="javascript:void(0)" class="btn-icon ms-md-3" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <img :src="`/images/portal/three-dots.svg`" alt="dots">
                                </a>
                                <ul class="dropdown-menu rounded-3 shadow-sm w-80">
                                    <li>
                                        <router-link v-if="each.type === 'promotion'"
                                                     :to="{name:'EditDeal', params:{id:each.id,name:'promotion'},state:{id:each.id}}"
                                                     class="dropdown-item">
                                            Edit
                                        </router-link>

                                        <router-link v-if="each.type === 'flash_sale'"
                                                     :to="{name:'EditDeal', params:{id:each.id,name:'flash-sale'},state:{id:each.id}}"
                                                     class="dropdown-item">
                                            Edit
                                        </router-link>

                                        <router-link v-if="each.type === 'last_minute'"
                                                     :to="{name:'EditDeal', params:{id:each.id,name:'last-minute'},state:{id:each.id}}"
                                                     class="dropdown-item">
                                            Edit
                                        </router-link>

                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           @click="openStatusModal(each.id , each.status,'inactive')">
                                            <span v-if="each.status === 1">Deactivate</span>
                                            <span v-if="each.status === 2">Activate</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0)"
                                           @click="openDuplicateModal(each.id)">Duplicate</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                           @click="openStatusModal(each.id , each.status,'archive')">
                                            <span v-if="each.status === 1">Archive</span>
                                            <span v-if="each.status === 3">Unarchive</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                           @click="openDeleteModal(each.id)">
                                            Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>


                        </a>

                        <!--Loading-->
                        <AppLoader v-if="loading"/>

                        <!-- no data text -->
                        <emptyScreen
                            class="h-400"
                            :title="`deals`"
                            :sub_title="`Click “New +” to create new deal.`"
                            :btn="true"
                            :btn_title="`New`"
                            :plus-icon="true"
                            @handler="newDeal()"
                            v-if="dealData?.data?.length === 0 && !loading"
                        />

                    </div>
                </div>
                <!--Deals list end-->

                <!-- Pagination -->
                <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                            @page-change="handlePageChange" v-if="last_page > 1 && !loading"/>

            </div>
        </div>


        <!--Filter Modal start-->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="filterModalLabel">Filters</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" @submit.prevent="filterByTypeStatus">
                        <div class="modal-body">
                            <div class="form-group mb-4">
                                <label for="deal-status" class="form-label">Deal status</label>
                                <select class="form-select" name="by_status" id="deal-status"
                                        v-model="filter.by_status">
                                    <option value="">All</option>
                                    <option :value="1">Active</option>
                                    <option :value="2">Inactive</option>
                                    <option :value="3">Archived</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="deal-type" class="form-label">Deal type</label>
                                <select class="form-select" name="by_type" id="deal-type" v-model="filter.by_type">
                                    <option value="">All types</option>
                                    <option value="promotion">Promotion</option>
                                    <option value="last_minute">Last minute</option>
                                    <option value="flash_sale">Flash sale</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="javascript:void(0)" class="text-theme underline-anim" @click="clearAllFilter">
                                Clear all filters
                            </a>
                            <div class="">
                                <button type="button" class="btn btn-outline-dark h-45 me-2 w-90 border-radius-10"
                                        @click="hideFilterModal">Cancel
                                </button>
                                <button type="submit" class="btn btn-theme w-90">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Filter Modal end  -->

        <!-- Status change Modal -->
        <div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="!apiSuccess">
                            <span v-if="statusParam.status === 1">Active deal?</span>
                            <span v-if="statusParam.status === 2">Deactive deal?</span>
                            <span v-if="statusParam.status === 3">Archive deal?</span>
                        </h1>
                        <button type="button" class="btn-close" @click="closeStatusModal" v-if="!apiSuccess"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="!apiSuccess">
                            Are you sure you want to
                            <span class="fw-semibold" v-if="statusParam.status === 1">Active</span>
                            <span class="fw-semibold" v-if="statusParam.status === 2">Deactive</span>
                            <span class="fw-semibold" v-if="statusParam.status === 3">Archive</span>
                            this deal? This operation can’t be undone.
                        </div>

                        <!--Success msg-->
                        <div v-if="apiSuccess" class="text-center">
                            <div class=" mb-4">
                                <img class="w-80 h-80" v-if="statusParam.status === 1"
                                     :src="`/images/global/checked.png`"
                                     alt="success">

                                <img class="w-80 h-80" v-if="statusParam.status === 2"
                                     :src="`/images/global/slash.png`"
                                     alt="deactivate">

                                <img class="w-80 h-80" v-if="statusParam.status === 3"
                                     :src="`/images/global/archive.png`"
                                     alt="archived">
                            </div>
                            The deal has been successfully
                            <span class="fw-semibold" v-if="statusParam.status === 1">Activated!</span>
                            <span class="fw-semibold" v-if="statusParam.status === 2">Deactivated!</span>
                            <span class="fw-semibold" v-if="statusParam.status === 3">Archived!</span>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0" :class="{'justify-content-center' : apiSuccess}">
                        <button type="button" class="btn btn-secondary h-45 w-110" @click="closeStatusModal">
                            Close
                        </button>

                        <button type="button" class="btn btn-danger h-45 w-110" v-if="!statusLoading && !apiSuccess"
                                @click="changeStatus">
                            Confirm
                        </button>
                        <button type="button" class="btn btn-danger btn-loading h-45 w-110"
                                v-if="statusLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Duplicate Modal -->
        <div class="modal fade" id="duplicateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="!apiSuccess">
                            Duplicate deal?
                        </h1>
                        <button type="button" class="btn-close" @click="closeDuplicateModal"
                                v-if="!apiSuccess"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="!apiSuccess">
                            Are you sure you want to <span class="fw-semibold">duplicate</span> this deal? This
                            operation can’t be undone.
                        </div>

                        <!--Success msg-->
                        <div v-if="apiSuccess" class="text-center">
                            <div class=" mb-4">
                                <img class="w-80 h-80" :src="`/images/global/duplicate.png`"
                                     alt="success">
                            </div>
                            The deal has been successfully <span class="fw-semibold">Duplicated.</span>

                        </div>
                    </div>
                    <div class="modal-footer border-top-0" :class="{'justify-content-center' : apiSuccess}">
                        <button type="button" class="btn border-radius-10 btn-secondary h-45 w-110"
                                @click="closeDuplicateModal">
                            Close
                        </button>

                        <a type="button" class="btn btn-theme h-45 w-110" v-if="apiSuccess"
                           @click="closeDuplicateModal();goToSingle(duplicatedData?.id)">
                            View
                        </a>

                        <button type="button" class="btn border-radius-10 btn-danger h-45 w-110"
                                v-if="!duplicateLoading && !apiSuccess"
                                @click="duplicateDeal">
                            Confirm
                        </button>
                        <button type="button" class="btn border-radius-10 btn-danger btn-loading h-45 w-110"
                                v-if="duplicateLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel" v-if="!apiSuccess">
                            Delete deal?
                        </h1>
                        <button type="button" class="btn-close" @click="closeDeleteModal"
                                v-if="!apiSuccess"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="!apiSuccess">
                            Are you sure you want to <span class="fw-semibold">delete</span> this deal? This
                            operation can’t be undone.
                        </div>

                        <!--Success msg-->
                        <div v-if="apiSuccess" class="text-center">
                            <div class=" mb-4">
                                <img class="w-80 h-80" :src="`/images/global/checkmark-success-animated.gif`"
                                     alt="success">
                            </div>
                            The deal has been successfully <span class="fw-semibold">deleted.</span>

                        </div>
                    </div>
                    <div class="modal-footer border-top-0" :class="{'justify-content-center' : apiSuccess}">
                        <button type="button" class="btn border-radius-10 btn-secondary h-45 w-110"
                                @click="closeDeleteModal">
                            Close
                        </button>


                        <button type="button" class="btn border-radius-10 btn-danger h-45 w-110"
                                v-if="!deleteLoading && !apiSuccess"
                                @click="deleteDeal">
                            Confirm
                        </button>
                        <button type="button" class="btn border-radius-10 btn-danger btn-loading h-45 w-110"
                                v-if="deleteLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import axios from "axios";
import pagination from "../../../../components/pagination.vue";
import AppLoader from "../../../../components/app-loader.vue";
import emptyScreen from "../../../../components/empty-screen.vue";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
})


export default {
    components: {pagination, AppLoader, emptyScreen},
    data() {
        return {
            /*Data and variables*/
            loading: false,
            singleLoading: false,
            filter: {
                by_status: '',
                by_type: '',
            },
            dealData: [],
            formData: {
                keyword: '',
                limit: 20,
                page: 1,
                sort_by: 'id',
                sort_mode: 'desc',
                status: '',
                type: '',
            },
            searchTimeout: null,
            // Pagination
            last_page: 0,
            current_page: 0,
            total_pages: 0,
            buttons: [],
            statusParam: {
                id: '',
                status: '',
            },
            statusLoading: false,
            duplicateLoading: false,
            deleteLoading: false,
            apiSuccess: false,
            duplicateParam: {
                id: '',
            },
            duplicatedData: null,
            sort: 'name-asc',
            deleteParam: {
                id: ''
            }

        }
    },
    watch: {},
    mounted() {
        /*Calling the list API when the page loads*/
        this.dealList();
    },
    methods: {
        /*Function to search list data*/
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.dealList();
            }, 800);
        },

        // Function to page change from global component pagination
        handlePageChange(page) {
            this.current_page = page;
            this.dealList();
        },

        /*Function to get the list of deals*/
        dealList() {
            this.loading = true;
            this.formData.page = this.current_page
            apiService.ClearErrorHandler();
            axios.get(apiRoutes.Deals, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                let res = response.data;
                this.dealData = res.deals;
                this.last_page = res.deals.last_page
                this.total_pages = res?.deals?.total < res?.deals?.per_page ? 1 : Math.ceil((res?.deals?.total / res?.deals?.per_page));
                this.current_page = res?.deals?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
            }).catch((err) => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to filter*/
        filterByTypeStatus() {
            this.formData.status = this.filter.by_status;
            this.formData.type = this.filter.by_type;
            this.dealList();
            this.hideFilterModal();
        },

        /*Function to clear all the filter*/
        clearAllFilter() {
            this.formData.status = '';
            this.formData.type = '';
            this.filter.by_status = '';
            this.filter.by_type = '';
            this.dealList();
            this.hideFilterModal();
        },

        /*Function to clear type filter*/
        clearTypeFilter() {
            this.formData.type = '';
            this.filter.by_type = '';
            this.dealList();
        },

        /*Function to clear status filter*/
        clearStatusFilter() {
            this.formData.status = '';
            this.filter.by_status = '';
            this.dealList();
        },

        /*Function to open filter modal*/
        openFilterModal() {
            let modal = new bootstrap.Modal(document.getElementById('filterModal'))
            modal.show();
        },

        /*Function to hide filter modal*/
        hideFilterModal() {
            const Modal = document.querySelector('#filterModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /*Function to change the status*/
        changeStatus() {
            this.statusLoading = true;
            apiService.ClearErrorHandler();
            axios.patch(apiRoutes.ChangeDealStatus, this.statusParam, {headers: apiService.headerContent}).then((response) => {
                this.statusLoading = false;
                this.apiSuccess = true;
            }).catch(err => {
                this.statusLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to open status modal*/
        openStatusModal(id, status, name) {
            this.apiSuccess = false;
            this.statusParam.id = id;
            if (name === 'inactive' && status === 1) {
                this.statusParam.status = 2;
            } else if (name === 'inactive' && status === 2) {
                this.statusParam.status = 1;
            } else if (name === 'archive' && status === 1) {
                this.statusParam.status = 3;
            } else if (name === 'archive' && status === 3) {
                this.statusParam.status = 1;
            }
            let modal = new bootstrap.Modal(document.getElementById('statusChangeModal'))
            modal.show();
        },

        /*Function to open status modal*/
        closeStatusModal() {
            this.apiSuccess = false;
            const myModal = document.querySelector("#statusChangeModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            this.dealList();
        },

        /*Function for redirecting to single page*/
        goToSingle(id) {
            this.$router.push({name: 'DealSingle', params: {id: id}, state: {id: id}})
        },

        /*Function to duplicate the deal*/
        duplicateDeal() {
            this.duplicateLoading = true;
            axios.post(apiRoutes.DuplicateDeal, this.duplicateParam, {headers: apiService.headerContent}).then((response) => {
                this.duplicateLoading = false;
                this.apiSuccess = true;
                this.duplicatedData = response.data.deal
            }).catch(err => {
                this.duplicateLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to open status modal*/
        openDuplicateModal(id) {
            this.apiSuccess = false;
            this.duplicateParam.id = id;
            let modal = new bootstrap.Modal(document.getElementById('duplicateModal'))
            modal.show();
        },

        /*Function to open status modal*/
        closeDuplicateModal() {
            this.apiSuccess = false;
            const myModal = document.querySelector("#duplicateModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            this.dealList();
        },

        /*Function to update the sort*/
        updateSort() {
            if (this.sort === 'name-asc') {
                this.formData.sort_by = 'name'
                this.formData.sort_mode = 'asc'
            } else if (this.sort === 'name-desc') {
                this.formData.sort_by = 'name'
                this.formData.sort_mode = 'desc'
            } else if (this.sort === 'created-at-asc') {
                this.formData.sort_by = 'created_at'
                this.formData.sort_mode = 'asc'
            } else if (this.sort === 'created-at-desc') {
                this.formData.sort_by = 'created_at'
                this.formData.sort_mode = 'desc'
            }
            this.dealList();
        },

        /*Function to open delete modal*/
        openDeleteModal(id) {
            this.apiSuccess = false;
            this.deleteParam.id = id;
            let modal = new bootstrap.Modal(document.getElementById('deleteModal'))
            modal.show();
        },

        /*Function to open status modal*/
        closeDeleteModal() {
            this.apiSuccess = false;
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            this.dealList();
        },

        /*Function for delete API*/
        deleteDeal() {
            apiService.ClearErrorHandler();
            this.deleteLoading = true;
            axios.delete(apiRoutes.Deals, {params: {id: this.deleteParam.id}}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                this.closeDeleteModal();
                toaster.info('Deal has been deleted permanently');
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


        /*Function for creating new deal from empty screen*/
        newDeal() {
            this.$router.push({name: 'DealType'})
        }
    }
}
</script>

