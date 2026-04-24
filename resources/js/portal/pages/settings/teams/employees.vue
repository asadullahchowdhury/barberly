<template>

    <div class="settings w-100 pt-sm-5 pt-1">
        <div class="row justify-content-center px-3 pt-3">
            <div class="col-12 col-sm-11 col-lg-10 col-xl-8">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'SetupSettings'}"
                                         class="text-secondary text-decoration-none">
                                Settings
                            </router-link>
                        </li>
                        <li class="breadcrumb-item text-theme disable-feature"> Team members</li>
                    </ol>
                </nav>

                <!-- head section of team member list -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-3 fw-semibold"> Team members</div>

                    <div class="d-flex align-items-center justify-content-end">
                        <span class="dropdown me-2">
                            <button type="button"
                                    class="disable-feature btn btn-white has-border border-radius-10 h-45 padding-y-10 padding-x-12 new-res-btn d-flex justify-content-center align-items-center"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="new-res-text">Options</span>
                                <img :src="`/images/global/settings.svg`" class="w-15 h-15 hide-icon" alt="gear">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        Download CSV
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        Download Excel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        Create share link
                                    </a>
                                </li>
                            </ul>
                        </span>

                        <router-link :to="{name: 'EmployeeCreate'}"
                                     class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 padding-y-10 new-res-btn">
                            <div class="new-res-text me-2">New</div>
                            <img :src="`/images/portal/plus-white.svg`" class="w-15 h-15" alt="plus-white">
                        </router-link>

                    </div>

                </div>

                <!-- head section of team member list search and option filter -->
                <div class="bg-theme-opacity px-3 rounded-3">
                    <div class="row box-wrapper">
                        <div class="col-sm-4">
                            <div class="my-1 my-sm-2">
                                <div class="position-relative">
                                    <input type="text" name="keyword" v-model="formData.keyword"
                                           @keyup="searchData()"
                                           class="form-control ps-5 h-45 w-350" placeholder="Search Here"
                                           autocomplete="off">
                                    <div class="position-absolute top-50 start-0 ps-3 translate-middle-y">
                                        <img :src="`/images/portal/search.svg`" class="img-fluid w-15 h-15"
                                             alt="search.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-2 mt-2 mt-sm-0">
                            <div class="my-1 my-sm-2 d-flex justify-content-end">
                                <select name="status" v-model="formData.status" class="form-select rounded-3 h-45 w-130"
                                        @change="searchData">
                                    <option value="">All</option>
                                    <option value="1" aria-label="default">Pending</option>
                                    <option value="2">Active</option>
                                    <option value="3">Archive</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- body section of team member list -->
                <div class="card-body mt-3 scrollbar" :class="{ 'card-body-pagination-not-exist' : last_page === 1,
                     'card-body-pagination-exist' : last_page > 1 }">

                    <!-- table data will show till 568px -->
                    <table class="padding-x-16 padding-bottom-20 team-list table border-none"
                           v-if="tableData.length > 0 && loading === false">
                        <thead>
                        <tr>
                            <th class="padding-left-18">
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
                            <th class="ps-0">
                                <div class="d-flex align-items-center">
                                    Contact
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
                            <th class="ps-0">
                                <div class="d-flex align-items-center">
                                    Rating
                                    <div class="d-flex flex-column align-items-center margin-left-10 disable-feature"
                                         @click="sortList('rating')">
                                        <a href="javascript:void(0)" class="sort-up h-7">
                                            <img :src="`/images/global/sort-up.svg`" class="w-10 sort-icon" alt="sort">
                                        </a>
                                        <a href="javascript:void(0)" class="sort-down">
                                            <img :src="`/images/global/sort-down.svg`" class="w-10 sort-icon"
                                                 alt="sort">
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(each, index) in tableData">
                            <td class="padding-left-18">
                                <div class="d-flex align-items-center justify-content-start ">
                                    <!--Avatar-->
                                    <div class="margin-right-18">
                                        <avatarImage :name="each.first_name + ' ' + each.last_name"
                                                     :avatar="each.avatar"/>
                                    </div>

                                    <span>
                                            <span class="text-theme fw-bold d-block">
                                                {{ each.first_name + ' ' + each.last_name }}
                                            </span>
                                            <span class="status d-block">
                                                <span v-if="each.status === `1`" class="text-secondary"> Pending </span>
                                                <span v-if="each.status === `2`" class="text-secondary"> Active </span>
                                                <span v-if="each.status === `3`" class="text-secondary"> Archive </span>
                                            </span>
                                            <span class="dropdown d-block"
                                                  :class="{ 'disable-feature' : each.id === userData.id }">
                                                <button class="btn btn-controller ps-0 py-0 dropdown-toggle"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                                    <li v-if="each.status !== `3`">
                                                        <router-link :to="{name: 'EmployeeUpdate', params:{id:each.id}}"
                                                                     class="dropdown-item px-3 py-2 rounded-2">
                                                            Edit
                                                        </router-link>
                                                    </li>
                                                    <li v-if="each.status !== `3`">
                                                        <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                                                @click="openStatusModal(each.id, 3)">
                                                            Archive
                                                        </button>
                                                    </li>
                                                    <li v-if="each.status === `3`">
                                                        <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                                                @click="changeStatusUnarchived(each.id, 1)">
                                                            Unarchive
                                                        </button>
                                                    </li>
                                                    <li v-if="each.status === `3`">
                                                        <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                                                @click="openDeleteModal(each.id)">
                                                            Permanently delete
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                                            View calendar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                                            View working hours
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                                            Add time off
                                                        </a>
                                                    </li>
                                                </ul>
                                            </span>
                                        </span>
                                </div>
                            </td>
                            <td>
                                <a :href="`mailto:`+each.email" class="text-theme text-decoration-none">
                                    {{ each.email }}
                                </a> <br>
                                <a :href="`tel:`+each.mobile" class="text-theme text-decoration-none"
                                   v-if="each.mobile">
                                    {{ each.mobile }}
                                </a>
                                <span v-else>
                                        N/A
                                    </span>
                            </td>
                            <td>
                                    <span class="text-secondary">
                                        No review yet
                                    </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- table data will show till 568px -->

                    <!-- table data will show on 568px -->
                    <div class="team-list-res" v-if="tableData.length > 0 && loading === false">
                        <div class="p-3 w-100 border rounded-4 mb-3" v-for="each in tableData">
                            <div class="d-flex align-items-start justify-content-between margin-bottom-15">
                                <div class="me-3">
                                    <avatarImage :name="each.first_name + ' ' + each.last_name"
                                                 :avatar="each.avatar"/>
                                </div>

                                <div class="dropdown" :class="{ 'disable-feature' : each.id === userData.id }">
                                    <button class="btn btn-controller" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        <img :src="`/images/global/vertical-dots.svg`" alt="vertical-dots">
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end overflow-hidden p-3">
                                        <li v-if="each.status !== `3`">
                                            <router-link :to="{name: 'EmployeeUpdate', params:{id:each.id}}"
                                                         class="dropdown-item">
                                                Edit
                                            </router-link>
                                        </li>
                                        <li v-if="each.status !== `3`">
                                            <button type="button" class="dropdown-item rounded-3 transition-3"
                                                    @click="openStatusModal(each.id, 3)">
                                                Archive
                                            </button>
                                        </li>
                                        <li v-if="each.status === `3`">
                                            <button type="button" class="dropdown-item rounded-3 transition-3"
                                                    @click="changeStatusUnarchived(each.id, 1)">
                                                Unarchive
                                            </button>
                                        </li>
                                        <li v-if="each.status === `3`">
                                            <button type="button"
                                                    class="dropdown-item text-danger rounded-3 transition-3"
                                                    @click="openDeleteModal(each.id)">
                                                Permanently delete
                                            </button>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="dropdown-item rounded-3 transition-3 disable-feature">
                                                View calendar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="dropdown-item rounded-3 transition-3 disable-feature">
                                                View working hours
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="dropdown-item rounded-3 transition-3 disable-feature">
                                                Add time off
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Status:</strong>
                                    <span v-if="each.status === `1`" class="text-secondary"> Pending </span>
                                    <span v-if="each.status === `2`" class="text-secondary"> Active </span>
                                    <span v-if="each.status === `3`" class="text-secondary"> Archive </span>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Name:</strong>
                                    <div class="text-truncate text-theme">
                                        {{ each.first_name + ' ' + each.last_name }}
                                    </div>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Email</strong>
                                    <a :href="`mailto:`+each.email"
                                       class="text-decoration-none text-theme text-truncate">
                                        {{ each.email }}
                                    </a>
                                </div>
                                <div class="margin-bottom-15 d-grid grid-template-col-2">
                                    <strong>Phone</strong>
                                    <a :href="`tel:`+each.mobile" class="text-decoration-none text-theme text-truncate"
                                       v-if="each.mobile">
                                        {{ each.mobile }}
                                    </a>
                                    <span v-else>N/A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table data will show on 568px -->

                    <!-- team list loading -->
                    <appLoader v-if="loading"/>

                    <!-- no data start-->

                    <!-- no data start-->

                    <emptyScreen
                        class="h-100"
                        :title="`members`"
                        :sub_title="`Click “New +” to add new member.`"
                        :btn="true"
                        :btn_title="`New`"
                        :plus-icon="true"
                        @handler="newEmployee()"
                        v-if="tableData.length === 0 && loading === false"
                    />

                </div>

                <!-- pagination -->
                <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                            @page-change="handlePageChange" v-if="last_page > 1 && !loading"/>

            </div>
        </div>

        <!-- delete team member modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form @submit.prevent="deleteMember" class="modal-content p-2">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Permanently delete</h1>
                        <button type="button" class="btn-close" @click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to permanently delete this team member? This action cannot be undone.
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary h-45 w-110" @click="closeDeleteModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger h-45 w-110" v-if="deleteLoading === false">Confirm
                        </button>
                        <button type="button" class="btn btn-danger btn-loading h-45 w-110"
                                v-if="deleteLoading === true"><span class="loading"></span></button>
                    </div>
                </form>
            </div>
        </div>

        <!-- status change of team member modal -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form @submit.prevent="changeStatus" class="modal-content p-2">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Status change of team member</h1>
                        <button type="button" class="btn-close" @click="closeStatusModal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to archive this team member? Archived team members may be viewed by
                        adjusting your filter settings, and may be restored at any time.
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-secondary h-45 w-110" @click="closeStatusModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger h-45 w-110" v-if="changeLoading === false">Archive
                        </button>
                        <button type="button" class="btn btn-danger btn-loading h-45 w-110"
                                v-if="changeLoading === true"><span class="loading"></span></button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</template>

<script>

import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
import appLoader from "../../../../components/app-loader.vue";
import emptyScreen from "../../../../components/empty-screen.vue";
import pagination from "../../../../components/pagination.vue"
import avatarImage from "../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
})

export default {

    components: {
        appLoader, pagination, emptyScreen, avatarImage,
    },

    data() {

        return {
            loading: false,
            deleteParam: {id: ''},
            members: [],
            tableData: [],
            formData: {
                status: '',
                keyword: '',
                limit: 20,
                page: 1,
                sort_by: 'id',
                sort_mode: 'asc'
            },
            statusData: {
                id: '',
                status: '',
            },
            total_pages: 0,
            current_page: 0,
            buttons: [],
            searchTimeout: null,
            error: null,
            responseData: null,
            table_data: 0,
            selected: [],
            deleteLoading: false,
            changeLoading: false,
            memberParam: [],
            userData: window.core.UserInfo,
            last_page: 0,
        }

    },

    mounted() {
        this.list();
    },

    methods: {

        // Function to page change from global component pagination
        handlePageChange(page) {
            this.current_page = page;
            this.list();
        },

        // sort list use for team list
        sortList(sort) {
            this.formData.sort_by = sort
            if (this.formData.sort_mode === 'asc') {
                this.formData.sort_mode = 'desc'
            } else {
                this.formData.sort_mode = 'asc'
            }
            this.list()
        },

        // team list show
        list() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.TeamMembers, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.loading = false;
                this.selected = [];
                this.tableData = res.members.data;
                this.last_page = res.members.last_page
                this.total_pages = res.members.total < res.members.per_page ? 1 : Math.ceil((res.members.total / res.members.per_page));
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

        // search data to change of team member list
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.list();
            }, 800);
        },

        // Fetch information of team member
        getSingle(id = null) {
            let param = {id: ''}
            if (id != null) {
                param.id = id
            } else {
                param.id = this.selected[0]
            }
            apiService.POST2(apiRoutes.TeamMemberSingle, param, (res) => {
                if (parseInt(res.status) === 200) {
                    this.memberParam = res.data;
                } else {
                    this.error = res.errors;
                }
            })
        },

        // open delete modal
        openDeleteModal(id) {
            this.deleteParam.id = id;
            const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false, backdrop: 'static'});
            myModal.show();
        },

        // close delete modal
        closeDeleteModal() {
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        // delete Team Member
        deleteMember() {
            this.deleteLoading = true;
            axios.delete(apiRoutes.TeamMembers, {params: this.deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Member has been deleted successfully.')
                this.closeDeleteModal();
                this.list();
                this.selected = [];
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

        //   open status modal
        openStatusModal(id, status) {
            this.statusData = {id: id, status: status};
            const myModal = new bootstrap.Modal("#statusModal", {keyboard: false, backdrop: 'static'});
            myModal.show();
        },

        //  close status modal
        closeStatusModal() {
            const myModal = document.querySelector("#statusModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        // status change
        changeStatus() {
            this.changeLoading = true;
            axios.patch(apiRoutes.TeamMemberUpdate, this.statusData, {headers: apiService.headerContent}).then((response) => {
                this.changeLoading = false;
                toaster.info('Member has been archived successfully.')
                this.list();
                this.closeStatusModal();
            }).catch(err => {
                this.changeLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },


        // Unarchived
        changeStatusUnarchived(id, status) {
            let param = {id: id, status: status}
            this.changeLoading = true;
            axios.patch(apiRoutes.TeamMemberUpdate, param, {headers: apiService.headerContent}).then((response) => {
                this.changeLoading = false;
                toaster.info('Member has been unarchived successfully.')
                this.list();
            }).catch(err => {
                this.changeLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },


        /*Function for creating new employee from empty screen*/
        newEmployee() {
            this.$router.push({name: 'EmployeeCreate'})
        }

    }

}

</script>
