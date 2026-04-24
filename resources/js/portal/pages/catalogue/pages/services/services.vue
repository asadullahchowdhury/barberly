<template>
    <!--service start-->
    <div class="services">

        <div class="service-box position-relative pt-5 px-md-5 px-3">

            <!--Service header start-->
            <div class="service-header mb-4 d-flex justify-content-between">
                <div class="fs-3 fw-semibold">Services menu</div>

                <div class="d-flex justify-content-end">
                    <div class="d-flex header-actions">
                        <button type="button"
                                class="btn disable-feature btn-white has-border me-2 padding-y-10 w-110 border-radius-10 new-res-btn h-45"
                                data-bs-toggle="dropdown"
                                data-bs-target="#option" aria-expanded="false">
                            <span class="new-res-text">Options</span>
                            <img :src="`/images/global/settings.svg`" class="w-15 h-15 hide-icon icon-gear" alt="gear">
                        </button>

                        <ul class="dropdown-menu service-dropdown rounded-3" id="option">
                            <li><a class="dropdown-item" href="javascript:void(0)">Download PDF</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Download Exel</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Download CVS</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Create share link</a></li>
                        </ul>

                        <button type="button"
                                class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 new-res-btn"
                                @click="openCategoryModal()">
                            <span class="new-res-text me-2"> New </span> <img :src="`/images/portal/plus-white.svg`"
                                                                              class="w-15 h-15" alt="plus-white">
                        </button>
                    </div>
                </div>
            </div>
            <!--Service header end  -->

            <!--Service menu organizer start-->
            <div class="service-menu-organizer p-3 bg-light rounded-3 mb-3"
                 :class="{'d-none' : listData.length === 0}">
                <div class="collapse-switch btn-group border rounded-5 btn p-0" @click="collapseController()">
                    <button type="button" class="btn rounded-5 border-0 padding-y-10" :class="{'active' : !collapse}">
                        <img :src="`/images/portal/expand.svg`" class="w-24 h-24 icon" alt="expand">
                    </button>
                    <button type="button" class="btn rounded-5 border-0 padding-y-10" :class="{'active' : collapse}">
                        <img :src="`/images/portal/collapse.svg`" class="w-24 h-24 icon" alt="collapse">
                    </button>
                </div>
            </div>
            <!--Service menu organizer end  -->

            <!--service menu content start-->
            <div class="service-menu-content position-relative scrollbar "
                 :class="{ 'card-body-pagination-not-exist' : last_page === 1,
                 'card-body-pagination-exist' : last_page > 1 }">

                <!--Category item start-->
                <draggable v-if="listData.length > 0 && !listLoading"
                           v-model="listData"
                           group="people"
                           animation="350"
                           ghostClass="sortable-ghost"
                           forceFallback=true
                           fallbackClass="sortable-fallback"
                           @start="drag=true"
                           @end="drag=false;"
                           @change="sortUpdate"
                           item-key="id">
                    <template #item="{element}">
                        <div class="each-service mb-3" :class="{'border-transparent' : !collapse}">
                            <div
                                class="service-title-wrap d-flex justify-content-between align-items-center padding-left-20 py-3">
                                <div class="title d-flex align-items-center">
                                    <img class="me-2 pe-1" :src="`/images/portal/service-bar.svg`" alt="bar">
                                    {{ element.name }}
                                </div>

                                <a href="javascript:void(0)" role="button" class="btn-menu" :class="{'pe-4' : collapse}"
                                   data-bs-toggle="dropdown"
                                   data-bs-target="#action" aria-expanded="false">
                                    <img :src="`/images/portal/three-dots.svg`" alt="three dots">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2"
                                    id="action">
                                    <li>
                                        <router-link
                                            :to="{name:'ServiceType',state:{id:element.id,module_name:module}}"
                                            class="dropdown-item px-3 py-2 rounded-2">
                                            Add new Service
                                        </router-link>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-3 py-2 rounded-2" href="javascript:void(0)"
                                           @click="openCategoryModal(element)">
                                            Edit Category
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-3 py-2 rounded-2" href="javascript:void(0)"
                                           @click="openCategoryDeleteModal(element.id)">
                                            Delete Category
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="service-body" :class="{'collapsed' : collapse}">

                                <!--Service item start-->
                                <draggable
                                    v-model="element.services"
                                    group="people"
                                    put="true"
                                    animation="300"
                                    @start="drag=true"
                                    @end="drag=false;"
                                    @change="sortServiceUpdate($event);categoriesList( false)"
                                    item-key="id">
                                    <template #item="{element}">
                                        <a href="javascript:void(0)" @click="editService(element.id)"
                                           class="d-block each-service-item text-decoration-none text-dark align-items-center justify-content-between p-3"
                                           :style="{borderLeftColor: element.color}">
                                            <div class="title fw-semibold max-full">
                                                <img class="me-2 pe-1" :src="`/images/portal/service-bar.svg`"
                                                     alt="bar">
                                                {{ element.name }}
                                            </div>

                                            <!--multiple price option start-->
                                            <span class="multiple-pricing d-none d-sm-block">
                                                <table class="table table-borderless table-price mb-0">
                                                    <tbody>
                                                    <tr v-for="(each,index) in element.pricing">

                                                        <td class="text-start text-muted fw-medium">
                                                           <div class="name">{{ each.name }}</div>

                                                        <div class="d-sm-none d-block text-muted fw-medium">
                                                            {{ each?.duration + 'Min' }}
                                                        </div>

                                                        </td>
                                                        <td class="text-start text-muted fw-medium d-sm-block d-none">
                                                            {{ each?.duration + 'Min' }}
                                                        </td>
                                                        <td class="text-end fw-bold">{{ 'BDT ' + each.price }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </span>

                                            <span class="w-100 py-2 ps-3 d-block d-sm-none multiple-pricing"
                                                  v-for="(each, index) in element.pricing">
                                                <span class="d-block mb-3 text-truncate">
                                                    {{ each.name }}
                                                </span>
                                                <span class="d-block mb-3 text-truncate">
                                                    {{ each?.duration + 'Min' }}
                                                </span>
                                                <span class="d-block text-truncate">
                                                    {{ 'BDT ' + each.price }}
                                                </span>
                                            </span>

                                            <!--multiple price option end  -->

                                        </a>
                                    </template>
                                </draggable>

                                <!--No service data text start-->
                                <emptyScreen
                                    class="h-350"
                                    :title="'service'"
                                    :sub_title="`Click “New Service” to create new resource.`"
                                    :btn="true"
                                    :btn_title="`New Service`"
                                    @handler="createService(element.id,module)"
                                    v-if="element.services.length === 0"/>
                                <!--No service data text end  -->
                            </div>
                        </div>
                    </template>
                </draggable>
                <!--Category item end  -->

                <!--list loading start-->
                <appLoader v-if="listLoading"/>
                <!--list loading end-->

                <!--no data text start-->
                <emptyScreen
                    class="h-100"
                    :title="'categories'"
                    :sub_title="`Click “New +” to create new category.`"
                    :btn="true"
                    :btn_title="`New`"
                    :plus-icon="true"
                    @handler="openCategoryModal()"
                    v-if="listData.length === 0 && !listLoading"/>
                <!--no data text end  -->

            </div>
            <!--service menu content end  -->

            <div class="overlay-loading" v-if="sortLoading">
                <div class="loading-spin-1 opacity-75"></div>
            </div>

            <!-- Pagination -->
            <pagination :total_pages="total_pages" :current_page="current_page" :buttons="buttons"
                        @page-change="handlePageChange" v-if="last_page > 1 && !listLoading"/>

        </div>

        <!--Category Modal start-->
        <div class="modal fade" id="categoryModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pt-md-4 px-md-4">
                        <h1 class="modal-title fs-5" id="categoryModalLabel">
                            <span v-if="categoryForm.id === undefined">New</span>
                            <span v-if="categoryForm.id !== undefined">Edit</span>
                            category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="categoryManage">
                        <div class="modal-body px-md-4">
                            <div class="form-group mb-3">
                                <label for="category-name" class="form-label">Category name</label>
                                <input id="category-name" type="text" class="form-control"
                                       placeholder="e.g. Hair Services"
                                       v-model="categoryForm.name" name="name">
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="appointment-color" class="form-label">Appointment color</label>
                                <div id="appointment-color" class="appointment-color-input position-relative"
                                     name="color"
                                     :class="this.selectBox === true ? 'focused' : ''" @click="manageColorBox()">
                                    <div class="color-box" :style="{backgroundColor: categoryForm.color}"></div>
                                    <div class="icon" :class="this.selectBox === true ? 'rotate' : ''">
                                        <img :src="`/images/global/chevron-down.svg`" alt="chevron down">
                                    </div>
                                    <div class="color-select-box" :class="this.selectBox === true ? 'active' : ''">

                                        <div class="color-wrap" v-for="each in categoriesColor"
                                             :class="{'focused' : categoryForm.color === each}">
                                            <div class="color" :style="{backgroundColor:each}"
                                                 @click="categoryForm.color = each"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-lighter small line-height-1p2 mt-1">
                                    See your Calendar Settings page under Setup to set how colors are displayed on the
                                    calendar
                                </div>
                                <div class="error-report"></div>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Category description</label>
                                <textarea class="form-control h-86" name="" id="" cols="30" rows="10"
                                          placeholder="Start typing..." v-model="categoryForm.description"></textarea>
                                <div class="error-report"></div>
                            </div>

                        </div>
                        <div class="modal-footer border-0 px-md-4 pb-md-4">
                            <button type="submit" class="btn btn-theme w-100" v-if="!manageLoading">
                                <span v-if="categoryForm.id === undefined"> Confirm </span>
                                <span v-if="categoryForm.id !== undefined"> Update </span>
                            </button>
                            <button type="button" class="btn btn-theme btn-loading w-100" v-if="manageLoading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--Category Modal end  -->


        <!--Delete modal start-->
        <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 px-md-4 pt-md-4">
                        <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">
                            Delete Category ?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-4">
                        <p>
                            Are you sure you want to delete this category? <br> This operation can’t be undone.
                        </p>
                    </div>
                    <div class="modal-footer border-0 px-md-4 pb-md-4">
                        <button type="button" class="btn btn-secondary h-45 w-110" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger h-45 w-110" v-if="!deleteLoading"
                                @click="categoryDelete">
                            Confirm
                        </button>
                        <button type="button" class="btn btn-danger h-45 btn-loading w-110" v-if="deleteLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete modal End  -->

    </div>
    <!--service end  -->
</template>

<script>
import draggable from 'vuedraggable';
import apiService from "../../../../../services/apiService";
import apiRoutes from "../../../../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import {forEach, left} from "vuedraggable/dist/vuedraggable.common.js";
import pagination from "../../../../../components/pagination.vue";
import axios from "axios";
import appLoader from "../../../../../components/app-loader.vue";
import emptyScreen from "../../../../../components/empty-screen.vue";
import {colors} from "../../../../../constants/color";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        /* Component of draggable, pagination and app-loader */
        draggable, pagination, appLoader, emptyScreen
    },
    data() {
        return {
            // Data properties for the component
            collapse: false,
            drag: false,
            colorVar: 1,
            categoriesColor: colors,
            selectBox: false,
            listLoading: false,
            manageLoading: false,
            deleteLoading: false,
            listParam: {
                keyword: '',
                limit: 30,
                page: 1,
            },
            serviceParam: {
                keyword: '',
                limit: 20,
                page: 1,
            },
            listData: [],
            serviceData: [],
            categoryForm: {
                name: '',
                color: 'rgb(255, 156, 187)',
                description: '',
            },
            deleteParam: {id: ''},
            sortParam: {
                sort: [
                    {
                        id: '',
                        sort: 0,
                    }
                ]
            },
            last_page: 0,
            current_page: 0,
            total_pages: 0,
            buttons: [],
            module: '',
            sortLoading: false,
        }
    },
    mounted() {
        this.module = window.history.state.module_name

        /* Mounted categories list */
        this.categoriesList();

        /* Mounted color input box popup handler */
        this.popupHandler();
    },
    methods: {

        /* Function to page change from global component pagination */
        handlePageChange(page) {
            this.current_page = page;
            this.categoriesList();
        },

        /* Function to collapse controller */
        collapseController() {
            this.collapse = !this.collapse
        },

        /* Function of categories list api */
        categoriesList(loading = true) {
            this.listLoading = loading;
            this.listParam.page = this.current_page;
            axios.get(apiRoutes.CategoriesList, {params: this.listParam}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.listLoading = false;
                this.listData = res?.categories?.data ?? [];
                if (this.listData.length > 0) {
                    this.listData.forEach((v) => {
                        v.services.forEach((j) => {
                            j['color'] = v.color
                        })
                    })
                }
                this.last_page = res.categories.last_page
                this.total_pages = res?.categories?.total < res?.categories?.per_page ? 1 : Math.ceil((res?.categories?.total / res?.categories?.per_page));
                this.current_page = res?.categories?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
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

        /* Function of category manage api */
        categoryManage() {
            apiService.ClearErrorHandler();
            this.manageLoading = true;
            if (this.categoryForm.id === undefined || this.categoryForm.id === '') {
                this.categoryCreate();
            } else {
                this.categoryUpdate();
            }
        },

        /* Function of category create api */
        categoryCreate() {
            axios.post(apiRoutes.CategoriesCreate, this.categoryForm, {headers: apiService.headerContent}).then((response) => {
                this.manageLoading = false;
                toaster.info('Category has been save successfully');
                this.hideCategoryModal();
                this.categoriesList();
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

        /* Function of category update api */
        categoryUpdate() {
            axios.patch(apiRoutes.CategoriesUpdate, this.categoryForm, {headers: apiService.headerContent}).then((response) => {
                this.manageLoading = false;
                toaster.info('Category has been updated successfully');
                this.hideCategoryModal();
                this.categoriesList();
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

        /* Function of category delete api */
        categoryDelete() {
            this.deleteLoading = true;
            axios.delete(apiRoutes.CategoriesDelete, {params: this.deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.deleteLoading = false;
                toaster.info('Category has been deleted successfully')
                this.hideCategoryDeleteModal();
                this.categoriesList();
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

        /* Function of sort update api */
        sortUpdate() {
            this.sortLoading = true;
            let param = {
                sort: []
            }
            this.listData.forEach((v, i) => {
                param.sort.push({id: v.id, sort: i})
            })
            axios.patch(apiRoutes.CategoriesSortUpdate, param, {headers: apiService.headerContent}).then((response) => {
                    this.sortLoading = false;
            }).catch(err => {
                this.sortLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function of sort service update api */
        sortServiceUpdate(e) {
            this.sortLoading = true;
            let param = {
                sort: []
            }
            this.listData.forEach((v, i) => {
                v.services.forEach((j, k) => {
                    param.sort.push({category_id: v.id, id: j.id, sort: k, name: j.name})
                })
            })
            axios.patch(apiRoutes.CategoriesServiceSortUpdate, param, {headers: apiService.headerContent}).then((response) => {
                    this.sortLoading = false;
            }).catch(err => {
                this.sortLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function of route edit service */
        editService(id) {
            this.$router.push({name: 'ServiceUpdate', params: {id: id}})
        },

        /* Function of open category modal */
        openCategoryModal(data = null) {
            apiService.ClearErrorHandler();
            if (data === null) {
                this.categoryForm = {
                    name: '',
                    color: 'rgb(255, 156, 187)',
                    description: '',
                }
            } else {
                this.categoryForm = {
                    id: data.id,
                    name: data.name,
                    color: data.color,
                    description: data.description ?? null,
                }
            }
            let modal = new bootstrap.Modal(document.getElementById('categoryModal'))
            modal.show();
        },

        /* Function of hide category modal */
        hideCategoryModal() {
            const Modal = document.querySelector('#categoryModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function of open delete category modal */
        openCategoryDeleteModal(id = null) {
            this.deleteParam = {
                id: id,
            }
            let modal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'))
            modal.show();
        },

        /* Function of close delete category modal */
        hideCategoryDeleteModal() {
            const Modal = document.querySelector('#deleteCategoryModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function of manage color box */
        manageColorBox() {
            let input = document.querySelector('.appointment-color-input');
            let colorBox = document.querySelector('.color-select-box')
            if (input != null) {
                this.selectBox = true;
                colorBox.classList.add('active')
            } else {
                colorBox.classList.remove('active')
                this.selectBox = false;
            }
        },

        /* Function of popup visible and invisible */
        popupHandler() {
            document.addEventListener('click', (event) => {

                // for color input dropdown Popup
                let input = document.querySelector('.appointment-color-input');
                let colorBox = document.querySelector('.color-select-box')
                if (input !== null && colorBox !== null) {
                    if (input.value !== null && colorBox.value !== null) {
                        this.selectBox = !(!input.contains(event.target) && !colorBox.contains(event.target));
                    }
                }

            })
        },

        /*Function for creating new service from empty screen*/
        createService(stateID, moduleName) {
            this.$router.push({name: 'ServiceType', state: {id: stateID, module_name: moduleName}})
        }

    },
}
</script>
