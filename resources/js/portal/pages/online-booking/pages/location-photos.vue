<template>

    <div class="p-1">
        <div class="h3 fw-semibold text-center">
            Add your business photos
        </div>

        <div class="my-3 px-3 text-center d-block line-height-2">
            Upload photos showing your place of business and services offered, logos and stock images are not suitable.
            <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                See photo guidelines.
            </a>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-12 mb-3">

                    <!--Photo uploading input-->
                    <label for="avatar-upload" v-if="photoList.length === 0 && !uploadLoading"
                           class="w-100 location-photo bg-theme-opacity d-flex justify-content-center align-items-center flex-column cursor-pointer shadow-sm">
                        <input id="avatar-upload" type="file" name="avatar" class="d-none"
                               @change="attachAvatar($event)" accept="image/png, image/gif, image/jpeg">
                        <img :src="`/images/portal/camera.svg`" class="w-45 h-45 mb-2" alt="plus-theme">
                        <div class="fw-semibold">Add New Photo</div>
                    </label>

                    <!--Marketplace cover image -->
                    <div class="w-100 location-photo uploaded position-relative shadow-sm rounded-3"
                         v-if="photoList.length > 0 && !uploadLoading">

                        <!--Main photo badge-->
                        <small class="badge bg-white text-dark px-2 py-2 rounded-1 position-absolute top-0 start-0 m-2">
                            Main photo
                        </small>

                        <!--Photo delete button-->

                        <a class="position-absolute top-0 end-0 p-2 delete-btn" href="javascript:void(0)"
                           @click="openDeletePhoto(photoList[0].id)" v-if="photoList.length > 1 ">
                            <img :src="`/images/portal/trash-white.svg`" class="w-20 h-20" alt="delete-icon">
                        </a>
                        <!--Main cover image-->
                        <img :src="'/storage/media/image/'+photoList[0].photo_path"
                             class="img-fluid w-100 h-100 object-fit-cover rounded-3" alt="avatar">
                    </div>

                    <div class="w-100 location-photo btn-loading shadow-sm bg-theme-opacity  position-relative"
                         v-if="uploadLoading">
                        <div class="loading black"></div>
                    </div>

                </div>

                <!--new photo upload input file-->
                <div class="row pe-0">
                    <template v-for="(each, index) in photoList">
                        <div class="col-12 col-md-4 mb-3 pe-0" v-if="index > 0">
                            <div class="position-relative location-photo mini uploaded shadow-sm rounded-3"
                                 v-if="each.loading === false && index > 0">
                                <img :src="'/storage/media/image/'+each.photo_path"
                                     class="img-fluid w-100 h-170 object-fit-cover rounded-3" alt="avatar">


                                <a href="javascript:void(0)" class="position-absolute delete-btn top-0 end-0 m-2"
                                   @click="openDeletePhoto(each.id)">
                                    <img :src="`/images/portal/trash-white.svg`" class="w-20 h-20" alt="delete-icon">
                                </a>

                            </div>
                        </div>
                    </template>

                    <div class="col-12 col-md-4 mb-3 pe-0"
                         v-if="photoList.length > 0 && photoList.length < 10 && !uploadLoading2">
                        <label for="avatar-upload"
                               class="w-100 h-170 bg-theme-opacity d-flex justify-content-center align-items-center flex-column cursor-pointer shadow-sm">
                            <input id="avatar-upload" type="file" name="" class="d-none"
                                   @change="attachAvatar($event,true)"
                                   accept="image/png, image/gif, image/jpeg">
                            <img :src="`/images/portal/camera.svg`" class="w-24 h-24 mb-2" alt="plus-theme">
                            <div class="fw-semibold">Add New Photo</div>
                        </label>
                    </div>

                    <div class="col-12 col-md-4 mb-3 pe-0" v-if="uploadLoading2">
                        <div class="location-photo mini btn-loading bg-theme-opacity">
                            <div class="loading black"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <router-link :to="{name:'OnlineBookingDone'}" href="javascript:void(0)" class="btn btn-theme w-150"
                             :class="{'disable-feature' : photoList.length === 0}">Next
                    Step
                </router-link>
            </div>
        </div>


        <div class="p-3 mb-3 d-flex justify-content-start align-items-center line-height-2 bg-theme-opacity shadow-sm">
            <img :src="`/images/portal/light.svg`" class="w-23 h-23 me-3" alt="light-icon">
            At least one photo is required, drag and drop photos to rearrange the order and tap on photos to edit.
        </div>
    </div>

    <!-- delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form @submit.prevent="deletePhoto" autocomplete="off" class="modal-content p-2">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Photo ?</h1>
                    <button type="button" class="btn-close" @click="closeDeletePhoto"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this photo? This operation can’t be undone.
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary h-45 w-110" @click="closeDeletePhoto">
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

import apiRoutes from "../../../../services/apiRoutes.js";
import apiService from "../../../../services/apiService.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
})

export default {

    data() {

        return {
            /*Data and variables*/
            uploadLoading: false,
            uploadLoading2: false,
            formData: {
                avatar: null,
                subAvatar: null,
            },
            photoList: [],
            createPhotoLoading: false,
            getPhotoLoading: false,
            deleteLoading: false,
            deleteParam: {
                id: ''
            }
        }

    },

    mounted() {
        this.getPhoto();
    },

    methods: {

        //Attach avatar
        attachAvatar(event, loading = false) {
            if (!loading) {
                this.uploadLoading = true;
            } else {
                this.uploadLoading2 = true;
            }
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file);
            formData.append("media_type", 1);
            formData.append("media_use", 2);
            axios.post(apiRoutes.Media, formData, {headers: apiService.mediaHeaderContent}).then((response) => {
                let res = response.data
                this.uploadLoading = false;
                this.uploadLoading2 = false;
                event.target.value = '';
                this.createPhoto(res.data.file_path);

            }).catch(err => {
                this.uploadLoading = false;
                this.uploadLoading2 = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function to create marketplace photo
        createPhoto(path) {
            this.createPhotoLoading = true;
            axios.post(apiRoutes.MarketplacePhoto, {photo_path: path}, {headers: apiService.headerContent}).then((response) => {
                this.createPhotoLoading = false;
                this.getPhoto();
            }).catch(err => {
                this.createPhotoLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to get all photos of marketplace*/
        getPhoto() {
            this.getPhotoLoading = true;
            axios.get(apiRoutes.MarketplacePhoto, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.getPhotoLoading = false;
                this.photoList = response.data.data;
                this.photoList.forEach((v) => {
                    v['loading'] = false;
                })
            }).catch(err => {
                this.getPhotoLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to delete marketplace photo*/
        deletePhoto(id) {
            axios.delete(apiRoutes.MarketplacePhoto, {params: this.deleteParam}, {headers: apiService.headerContent}).then((response) => {
                this.closeDeletePhoto();
                this.getPhoto();
            }).catch(err => {
            })
        },

        // show delete customer popup
        openDeletePhoto(id) {
            this.deleteParam.id = id
            const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false});
            myModal.show();
        },

        // hide delete customer popup = true;
        closeDeletePhoto() {
            const myModal = document.querySelector("#deleteModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

    }

}

</script>
