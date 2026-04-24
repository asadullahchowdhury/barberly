<template>

    <div class="p-3 p-sm-5">
        <div class="container-fluid resources">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-7">

                    <!-- Resources header -->

                    <!-- Breadcurmb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link :to="{name: 'SetupSettings'}"
                                             class="text-secondary text-decoration-none">
                                    Settings
                                </router-link>
                            </li>
                            <li class="breadcrumb-item text-theme disable-feature">
                                Resources
                            </li>
                        </ol>
                    </nav>

                    <!-- resources title and new button -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="w-100">
                            <div class="fs-3 fw-semibold">
                                Resources
                            </div>
                        </div>
                        <div class="w-100 d-flex align-items-center justify-content-end">
                            <button type="submit"
                                    class="btn btn-theme d-flex justify-content-center align-items-center padding-y-10 padding-x-12 new-res-btn"
                                    @click="openResourceModal">
                                <span class="new-res-text me-2">New</span> <img :src="`/images/portal/plus-white.svg`"
                                                                                class="w-15 h-15" alt="plus-white">
                            </button>
                        </div>
                    </div>

                    <!-- resources text -->
                    <div class="text-secondary mb-4">
                        Set up bookable resources such as rooms and equipment and assign them to services.
                        <a href="javascript:void(0)" class="text-theme underline-anim">
                            Learn more
                        </a>
                    </div>

                    <!-- Resources body -->
                    <div class="resources-body scrollbar w-100" v-if="listData.length > 0 && !loading">

                        <draggable v-model="listData" group="people" animation="350" ghostClass="sortable-ghost"
                                   forceFallback=true fallbackClass="sortable-fallback" @start="drag"
                                   @end="!drag;" item-key="id">

                            <template #item="{element}">
                                <div
                                    class="col-12 border p-2 p-sm-3 d-flex justify-content-start align-items-center mb-3 single-resource cursor-pointer"
                                    @click="openResourceModal(element)">
                                    <div class="p-1 p-sm-2">
                                        <img class="w-15 h-20" :src="`/images/portal/service-bar.svg`" alt="bar">
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-semibold">
                                            {{ element.name }}
                                        </div>
                                        <div class="text-secondary">
                                            <div class="truncate-to-2-line w-100">
                                                {{ element.description }}
                                            </div>
                                        </div>
                                        <div class="text-secondary">
                                            No attached service
                                        </div>
                                    </div>
                                </div>
                            </template>

                        </draggable>

                    </div>

                    <!-- Pagination -->
                    <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                                @page-change="handlePageChange" v-if="last_page > 1 && !loading"/>

                    <!-- Page loading -->
                    <appLoader v-if="loading" class="ps-0"/>

                    <!--Empty screen-->
                    <emptyScreen
                        class="resources-body scrollbar"
                        :title="`resources`"
                        :sub_title="`Click “New +” to create new resource.`"
                        :btn="true"
                        :btn_title="`New`"
                        :plus-icon="true"
                        v-if="listData.length === 0 && !loading"
                        @handler="openResourceModal"
                    />

                </div>
            </div>
        </div>
    </div>

    <!-- Resource modal -->
    <div class="modal fade" id="resourceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" @submit.prevent="manageResource" autocomplete="off">
                <div class="modal-header border-bottom-0 px-md-4 pt-md-4">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <span v-if="resourceParam.id === undefined">New</span>
                        <span v-if="resourceParam.id !== undefined">Edit</span>
                        resource
                    </h1>
                    <button type="button" class="btn-close" @click="closeResourceModal"></button>
                </div>
                <div class="modal-body px-md-4">
                    <div class="mb-3 form-group">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" type="text" name="name" class="form-control" autocomplete="new-name"
                               placeholder="e.g. Message room" v-model="resourceParam.name">
                        <div class="error-report"></div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-textarea" cols="30" rows="5"
                                  autocomplete="new-description" placeholder="Fill in description (optional)"
                                  v-model="resourceParam.description"></textarea>
                        <div class="error-report"></div>
                    </div>
                    <div class="border-top border-bottom py-3 px-2 mt-3" v-if="this.resourceParam.id !== undefined">
                        <div class="fw-semibold"> Services</div>
                        <div class="text-secondary"> You can set which services are assigned on your
                            <router-link :to="{name: 'Services'}" class="text-theme underline-anim"
                                         @click="closeResourceModal">
                                services menu.
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-md-4 pb-md-4"
                     :class="{ 'd-flex justify-content-between' : this.resourceParam.id !== undefined }">
                    <button type="button" class="btn btn-danger h-45 w-120 border-radius-10"
                            v-if="this.resourceParam.id !== undefined"
                            @click="openResourceDeleteModal(resourceParam.id)">
                        Delete
                    </button>
                    <span class="d-flex">
                        <button type="button" class="btn btn-white has-border h-45 w-120 border-radius-10 me-2"
                                @click="closeResourceModal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-theme h-45 w-120" v-if="!manageLoading">
                            <span v-if="resourceParam.id === undefined">
                                Confirm
                            </span>
                            <span v-if="resourceParam.id !== undefined">
                                Update
                            </span>
                        </button>
                        <button type="button" class="btn btn-theme btn-loading h-45 w-120" v-if="manageLoading">
                            <span class="loading"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Resource delete modal -->
    <div class="modal fade" id="resourceDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 px-md-4 pt-md-4">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Resource</h1>
                    <button type="button" class="btn-close" @click="closeResourceDeleteModal"></button>
                </div>
                <div class="modal-body px-md-4">
                    <div class="mb-3">
                        Are you sure you want to delete this resource? This operation can’t be undone.
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-md-4 pb-md-4">
                    <button type="button" class="btn btn-secondary h-45 mw-100 border-radius-10"
                            @click="closeResourceDeleteModal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger h-45 mw-100 border-radius-10" v-if="!deleteLoading"
                            @click="deleteResource">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-danger h-45 mw-100 border-radius-10 btn-loading"
                            v-if="deleteLoading">
                        <span class="loading"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import draggable from 'vuedraggable';
import axios from "axios";
import apiRoutes from "../../../../services/apiRoutes.js";
import apiService from "../../../../services/apiService.js";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
});
import appLoader from "../../../../components/app-loader.vue";
import emptyScreen from "../../../../components/empty-screen.vue";
import pagination from "../../../..//components/pagination.vue";

export default {

    components: {
        // Component of draggable
        draggable, appLoader, pagination, emptyScreen
    },

    data() {

        return {
            // Data properties for the component
            drag: false,
            listData: [],
            singleData: false,
            loading: false,
            manageLoading: false,
            resourceParam: {
                name: '',
                description: '',
            },
            deleteParam: {
                id: '',
            },
            deleteLoading: false,
            formData: {
                keyword: '',
                limit: 20,
                page: 1,
            },
            total_pages: 0,
            current_page: 0,
            buttons: [],
            last_page: 0,
        }

    },

    mounted() {
        // Mounted to call resource list
        this.resourceList();
    },

    methods: {

        /* Function to page change from global component pagination */
        handlePageChange(page) {
            this.current_page = page;
            this.resourceList();
        },

        /* Function to open resource modal */
        openResourceModal(data = null) {
            apiService.ClearErrorHandler();
            if (data === null) {
                this.resourceParam = {
                    name: '',
                    description: ''
                }
            } else {
                this.resourceParam = {
                    id: data.id,
                    name: data.name,
                    description: data.description ?? null,
                }
            }
            let modal = new bootstrap.Modal(document.getElementById('resourceModal'))
            modal.show();
        },

        /* Function to close resource modal */
        closeResourceModal() {
            const Modal = document.querySelector('#resourceModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open resource modal */
        openResourceDeleteModal(id) {
            this.deleteParam.id = id
            this.closeResourceModal();
            let modal = new bootstrap.Modal(document.getElementById('resourceDeleteModal'))
            modal.show();
        },

        /* Function to close resource modal */
        closeResourceDeleteModal() {
            const Modal = document.querySelector('#resourceDeleteModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to create resource */
        createResource() {
            axios.post(apiRoutes.Resource, this.resourceParam, {headers: apiService.headerContent}).then((response) => {
                this.manageLoading = false;
                this.resourceList();
                this.closeResourceModal();
                toaster.info('Resource has been created successfully.');
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

        /* Function to update resource */
        updateResource() {
            axios.patch(apiRoutes.Resource + '/update', this.resourceParam, {headers: apiService.headerContent}).then((response) => {
                this.manageLoading = false;
                this.resourceList();
                this.closeResourceModal();
                toaster.info('Resource has been update successfully.');
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

        /* Function to manage action of resource */
        manageResource() {
            apiService.ClearErrorHandler();
            this.manageLoading = true;
            if (this.resourceParam.id === undefined || this.resourceParam.id === '') {
                this.createResource();
            } else {
                this.updateResource();
            }
        },

        /* Function to delete action of resource */
        deleteResource() {
            this.deleteLoading = true;
            axios.delete(apiRoutes.Resource, {params: {id: this.deleteParam.id}}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                this.closeResourceDeleteModal();
                this.resourceList();
                toaster.info('Resource has been delete successfully.');
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

        /* Function to show all resource data */
        resourceList() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.Resource, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.listData = res?.resources.data
                this.last_page = res?.resources.last_page
                this.total_pages = res.resources.total < res.resources.per_page ? 1 : Math.ceil((res.resources.total / res.resources.per_page));
                this.current_page = res.resources.current_page;
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

    }

}

</script>
