<template>
    <div class="container-fluid deals px-lg-5 pt-5 p-4 px-4">
        <div class="row justify-content-center" v-if="dealData !== null && !loading">
            <div class="col-xxl-8 col-xl-10 col-12">
                <!--Deal single header start-->
                <div class="deal-header w-100 d-flex justify-content-between align-items-sm-center">

                    <div class="d-sm-flex align-items-center">
                        <router-link :to="{name:'Deals'}" class="me-3 d-block d-sm-inline-block mb-3 mb-sm-0">
                            <img :src="`/images/global/arrow-left.svg`" alt="arrow left">
                        </router-link>

                        <h3 class="fs-3 mb-0 fw-semibold">
                            <span class="me-2 d-block d-sm-inline-block mb-2 mb-sm-0">
                                {{ dealData.name }}
                            </span>

                            <span class="badge badge-success text-success font-size-14 mb-3 mb-sm-0"
                                  v-if="dealData?.status === 1">
                                Active
                            </span>

                            <span class="badge badge-warning text-warning font-size-14 mb-3 mb-sm-0"
                                  v-if="dealData?.status === 2">
                                Inactive
                            </span>

                            <span class="badge badge-danger text-danger font-size-14 mb-3 mb-sm-0"
                                  v-if="dealData?.status === 3">
                                Archived
                            </span>

                        </h3>
                    </div>

                    <button type="button" class="btn border h-45 px-4 d-md-block d-none border-radius-10"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Option
                        <img class="ms-3" :src="`/images/global/chevron-down.svg`" alt="arrow-down">
                    </button>

                    <a href="javascript:void(0)"
                       class="btn-icon d-md-none d-block d-flex justify-content-center align-items-center"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img :src="`/images/portal/three-dots.svg`" alt="dots">
                    </a>

                    <ul class="dropdown-menu rounded-3 shadow-sm w-80">
                        <li>
                            <router-link v-if="dealData.type === 'promotion'"
                                         :to="{name:'EditDeal', params:{id:dealData.id,name:'promotion'},state:{id:dealData.id}}"
                                         class="dropdown-item">
                                Edit
                            </router-link>

                            <router-link v-if="dealData.type === 'flash_sale'"
                                         :to="{name:'EditDeal', params:{id:dealData.id,name:'flash-sale'},state:{id:dealData.id}}"
                                         class="dropdown-item">
                                Edit
                            </router-link>

                            <router-link v-if="dealData.type === 'last_minute'"
                                         :to="{name:'EditDeal', params:{id:dealData.id,name:'last-minute'},state:{id:dealData.id}}"
                                         class="dropdown-item">
                                Edit
                            </router-link>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)"
                               @click="openStatusModal(dealData.id , dealData.status,'inactive')">
                                <span v-if="dealData.status === 1">Deactivate</span>
                                <span v-if="dealData.status === 2">Activate</span>
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0)" @click="openDuplicateModal(dealData.id)">Duplicate</a>
                        </li>
                        <li><a class="dropdown-item text-danger" href="javascript:void(0)"
                               @click="openStatusModal(dealData.id , dealData.status,'archive')">
                            <span v-if="dealData.status === 1">Archive</span>
                            <span v-if="dealData.status === 3">Unarchive</span>
                        </a></li>

                        <li><a class="dropdown-item text-danger" href="javascript:void(0)"
                               @click="openDeleteModal(dealData.id)">Delete</a></li>
                    </ul>


                </div>


                <p>
                    <span v-if="dealData.type === 'promotion'">Promotion :</span>
                    <span v-if="dealData.type === 'flash_sale'">Flash sale :</span>
                    <span v-if="dealData.type === 'last_minute'">Last minute :</span>
                    {{ dealData.promotion_value + dealData.promotion_type }} off all services</p>
                <!--Deal single header end  -->

                <!--deal content section start-->
                <div class="row gx-3">
                    <!--Sale-->
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="summary-box border p-3 rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-semibold mb-0">Total sales</p>
                                <div
                                    class="bg-theme rounded-circle w-32 h-32 d-flex justify-content-center align-items-center">
                                    <img class="w-20 h-20" :src="`/images/portal/bag-white.svg`" alt="bag">
                                </div>
                            </div>
                            <h5 class="price fw-semibold">BDT 0</h5>
                        </div>
                    </div>

                    <!--Promotions-->
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="summary-box border p-3 rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-semibold mb-0">Promotions applied</p>
                                <div
                                    class="bg-theme rounded-circle w-32 h-32 d-flex justify-content-center align-items-center">
                                    <img class="w-20 h-20" :src="`/images/portal/tag-white.svg`" alt="tag">
                                </div>
                            </div>
                            <h5 class="price fw-semibold">0</h5>
                        </div>
                    </div>

                    <!--Clients-->
                    <div class="col-md-4">
                        <div class="summary-box border p-3 rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-semibold mb-0">Total clients</p>
                                <div
                                    class="bg-theme rounded-circle w-32 h-32 d-flex justify-content-center align-items-center">
                                    <img class="w-20 h-20" :src="`/images/portal/user-white.svg`" alt="user">
                                </div>
                            </div>
                            <h5 class="price fw-semibold">0</h5>
                        </div>
                    </div>


                    <div class="col-12 mt-3">
                        <div class="border p-3 rounded-3">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Apply to</p>
                                    <p class="small mb-0">
                                        <span class="comma"
                                              v-for="(each,index) in dealData.services" :key="index">
                                            {{ each.service_details.name }}
                                            <template v-if="index !== dealData.services.length - 1">, </template>
                                            <template v-else>.</template>
                                        </span>
                                    </p>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Promotion limits</p>
                                    <p class="small mb-0" v-if="dealData.limit_uses !== null">{{
                                            dealData.limit_uses
                                        }}</p>
                                    <p class="small mb-0" v-if="dealData.limit_uses === null">_</p>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Created</p>
                                    <p class="small mb-0">{{ dealData.created_at_formatted }}</p>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Discount code</p>
                                    <p class="small mb-0" v-if="dealData.discount_code !== null">
                                        {{ dealData.discount_code }}</p>
                                    <p class="small mb-0" v-if="dealData.discount_code === null">_</p>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Start date</p>
                                    <p class="small mb-0">{{ dealData.created_at_formatted }}</p>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">End date</p>
                                    <p class="small mb-0" v-if="dealData.end_date !== null">
                                        {{ dealData.end_date_formatted }}</p>
                                    <p class="small mb-0" v-if="dealData.end_date === null">Ongoing</p>
                                </div>

                                <div class="col-sm-6 mb-3" v-if="dealData.members.length > 0">
                                    <p class="fw-semibold mb-0">Team members</p>
                                    <p class="small mb-0">
                                        <span v-for="(each,index) in dealData.members" :key="index">
                                                {{
                                                each.member_details.first_name + ' ' + each.member_details.last_name
                                            }}
                                            <template v-if="index !== dealData.members.length - 1">, </template>
                                            <template v-else>.</template>
                                        </span>
                                    </p>
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <p class="fw-semibold mb-0">Promotion value</p>
                                    <p class="small mb-0">{{ dealData.promotion_value + dealData.promotion_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--deal content section end  -->
            </div>
        </div>

        <!--Loading start-->
        <div class="row justify-content-center" v-if="loading">
            <div class="col-xxl-8 col-xl-10 col-12">
                <!--Loading header-->
                <div class="row">
                    <div class="col-md-4 col-8 placeholder-glow mb-3">
                        <div class="placeholder w-100 p-3 "></div>
                    </div>
                    <div class="col-6 d-md-block d-none"></div>
                    <div class="col-md-2 col-4 placeholder-glow ">
                        <div class="placeholder w-100 p-3"></div>
                    </div>

                    <div class="col-5 placeholder-glow mb-3">
                        <div class="placeholder w-100 p-3 "></div>
                    </div>
                </div>

                <!--Loading body-->
                <div class="row gx-3 placeholder-glow mt-3">
                    <!--Sale-->
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="placeholder w-100 h-98"></div>
                    </div>

                    <!--Promotions-->
                    <div class="col-md-4 mb-md-0 mb-3">
                        <div class="placeholder w-100 h-98"></div>
                    </div>

                    <!--Clients-->
                    <div class="col-md-4">
                        <div class="placeholder w-100 h-98"></div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="border p-3 rounded-3">
                            <div class="row placeholder-glow">
                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-75 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-75 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-25 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-25 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-50 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-50 p-3"></div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-75 p-3"></div>
                                </div>


                                <div class="col-sm-6 mb-3">
                                    <div class="placeholder w-75 p-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!--Loading end  -->

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
import axios from "axios";
import apiRoutes from "../../../../services/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left'
})

export default {
    data() {
        return {
            loading: false,
            dealData: null,
            statusParam: {
                id: '',
                status: '',
            },
            statusLoading: false,
            deleteLoading: false,
            duplicateLoading: false,
            apiSuccess: false,
            duplicatedData: null,
            deleteParam: {
                id: ''
            },
            duplicateParam: {
                id: '',
            },
        }
    },
    mounted() {
        /*Function if there's no id found will redirect to list else call the single function*/
        if (window.history.state.id !== undefined) {
            this.getSingleDeal(window.history.state.id)
        } else {
            toaster.error('Server error');
            this.$router.push({name: 'Deals'})
        }
    },

    methods: {
        /*Single deal api*/
        getSingleDeal(id) {
            this.laoding = true;
            apiService.ClearErrorHandler();
            axios.get(apiRoutes.Deals, {params: {id: id}}, {headers: apiService.headerContent}).then((response) => {
                this.laoding = false;
                this.dealData = response.data.deal;
            }).catch(err => {
                this.laoding = false;
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
            this.getSingleDeal(window.history.state.id);
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
            this.getSingleDeal(window.history.state.id);
        },

        /*Function for redirecting to single page*/
        goToSingle(id) {
            this.$router.push({name: 'DealSingle', params: {id: id}, state: {id: id}})
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
            this.$router.push({name: 'Deals'});
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
        }


    }
}
</script>

