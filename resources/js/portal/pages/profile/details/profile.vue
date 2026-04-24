<template>

    <!-- Profile content -->
    <div class="card-content" v-if="profileData != null && getProfileLoading === false">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title"> Your Profile</div>
            <div class="text-end">

                <!-- Edit profile -->
                <button type="button" class="btn-theme manage-profile-model padding-x-16" @click="openProfileModal">
                    <span class="btn-text"> Edit </span>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap padding-top-16">
            <div class="card-profile border-radius-5 padding-xl-24 padding-12 margin-xl-0 margin-bottom-20">
                <div class="d-flex justify-content-center">

                    <!-- Photo of avatar or person -->
                    <avatarImage :name="profileData.first_name + ' ' + profileData.last_name"
                                 :avatar="profileData.avatar" :size="profileSize"/>

                    <!--                    <img v-if="profileData.avatar != null" :src="'/storage/media/image/'+profileData.avatar"-->
                    <!--                         class="card-profile-avatar border" :alt="profileData.avatar">-->
                </div>
                <div class="name text-center margin-top-12">
                    {{ profileData.first_name + ' ' + profileData.last_name }}
                </div>

                <!-- User others information -->
                <div class="padding-bottom-16 padding-top-24 d-flex align-items-center"><img
                    :src="`/images/portal/profile-calender.svg`" class="small-icon margin-right-10" alt="calender">
                    Joined {{ profileData.created_at_formatted }}
                </div>
                <div class="padding-bottom-16 d-flex align-items-center"><img
                    :src="`/images/portal/geo.svg`" class="small-icon margin-right-10" alt="geo">
                    {{ profileData.country }}
                </div>
                <div class="padding-bottom-16 d-flex align-items-center"><img
                    :src="`/images/portal/star.svg`" class="small-icon margin-right-10" alt="star">
                    No reviews
                </div>
                <div class="padding-bottom-16 d-flex align-items-center"><img
                    :src="`/images/portal/event-profile.svg`" class="small-icon margin-right-10" alt="event-profile">
                    No appointments booked yet
                </div>
            </div>
            <div class="card-about border-radius-5 margin-bottom-20">
                <div class="card-about-title padding-xl-24 padding-12">About me</div>
                <div class="padding-xl-24 padding-12">

                    <!-- Add description -->
                    <a href="javascript:void(0)" v-if="profileData.about === null"
                       class="text-decoration-none d-flex align-items-center text-theme addDescription"
                       @click="openProfileModal">
                        <img :src="`/images/portal/plus-lg.svg`" class="plus margin-right-10 w-24 h-24" alt="plus-lg">
                        Add Description
                    </a>

                    <div class="line-height-2 text-break text-dark-gray" v-if="profileData.about !== null">
                        {{ profileData.about }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading page -->
    <div class="card-content" v-if="getProfileLoading === true">

        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">

                <div class="placeholder-loading w-100">
                    <div class="placeholder-anim"></div>
                </div>

            </div>
            <div class="text-end">
                <!-- Loading edit button -->
                <div class="placeholder-loading w-60">
                    <div class="placeholder-anim"></div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap padding-top-16">
            <div class="card-profile border-radius-5 padding-md-24 padding-12 margin-xl-0 margin-bottom-20">

                <div class="placeholder-loading d-flex  align-items-center justify-content-center ">
                    <div class="placeholder-anim h-150 w-150 border-radius-100"></div>
                </div>


                <div class="name text-center margin-top-12">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim"></div>
                    </div>
                </div>
                <!-- Loading user others information -->
                <div class="padding-bottom-16 padding-top-24 d-flex align-items-center">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim"></div>
                    </div>
                </div>
                <div class="padding-bottom-16 d-flex align-items-center">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim"></div>
                    </div>
                </div>
                <div class="padding-bottom-16 d-flex align-items-center">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim"></div>
                    </div>
                </div>
                <div class="padding-bottom-16 d-flex align-items-center">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim"></div>
                    </div>
                </div>
            </div>
            <div class="card-about border-radius-5">
                <div class="card-about-title padding-md-24 padding-12">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim w-100"></div>
                    </div>
                </div>
                <div class="padding-md-24 padding-12">
                    <div class="placeholder-loading">
                        <div class="placeholder-anim w-150"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit profile modal -->
    <div class="modal profile-modal fade" id="editProfile" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-md-4 pt-md-4 border-0">
                    <h1 class="modal-title fs-5" id="editProfileLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" @click="hideProfileModal"></button>
                </div>
                <form @submit.prevent="updateProfile">
                    <div class="modal-body px-md-4">

                        <div class="mb-3 d-flex justify-content-center">
                            <!-- Upload avatar -->
                            <label for="avatar" class="avatar-upload padding-20 text-center"
                                   v-if="formData.avatar === null && !uploadLoading">
                                <img :src="`/images/portal/camera.svg`" class="w-32 h-32" alt="camera">
                                <input id="avatar" type="file" name="avatar" class="d-none" accept="image/*"
                                       @change="attachAvatar($event)">
                            </label>

                            <!-- Loading -->
                            <div class="placeholder-loading h-150 w-150" v-if="uploadLoading">
                                <div class="placeholder-anim h-150 border-radius-100"></div>
                            </div>

                            <!-- Preview -->
                            <label for="preview-avatar" class="preview-avatar position-relative"
                                   v-if="formData.avatar != null && !uploadLoading">
                                <img :src="`/storage/media/image/`+formData.avatar"
                                     class="popup-avatar margin-bottom-10" alt="avatar">

                                <a href="javascript:void(0)" class="position-absolute delete-btn"
                                   @click="removeAvatar">
                                    <img :src="`/images/portal/delete.svg`" alt="delete.svg">
                                </a>

                            </label>

                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" name="first_name" placeholder="Enter your first name"
                                   v-model="formData.first_name"
                                   class="form-control shadow-none padding-left-20" autocomplete="new-first-name">
                            <div class="error-report"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" name="last_name" placeholder="Enter your last name"
                                   v-model="formData.last_name"
                                   class="form-control shadow-none padding-left-20" autocomplete="new-last-name">
                            <div class="error-report"></div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-start">
                                <label for="about" class="form-label">About</label>
                                <div id="about" class="count-alphabet">{{ initNoteLength }}/{{ maxNoteLength }}</div>
                            </div>
                            <textarea name="about" rows="3" class="form-textarea"
                                      v-model="formData.about"
                                      placeholder="Enter about you" :maxlength="maxNoteLength"
                                      @keyup="lengthAlphabet(formData.about.length)"></textarea>
                            <div class="error-report"></div>
                        </div>
                    </div>
                    <div class="modal-footer px-md-4 pb-md-4 border-0 flex-nowrap">
                        <button type="button" @click="hideProfileModal()"
                                class="btn btn-outline-dark border-radius-10 w-50 h-45 margin-right-10">
                            Cancel
                        </button>

                        <button type="submit" v-if="!updateLoading" class="btn btn-theme w-50">
                            <span class="btn-text">Confirm</span>
                        </button>
                        <button type="button" v-if="updateLoading"
                                class="btn btn-theme w-50 btn-loading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

import apiService from "../../../../services/apiService";
import apiRoutes from "../../../../services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";
import axios from "axios";
import avatarImage from "../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        avatarImage
    },
    data() {

        return {
            /* Return property data */
            maxNoteLength: '500',
            text: '',
            initNoteLength: '0',
            editProfileModal: false,
            getProfileLoading: false,
            profileData: null,
            updateLoading: false,
            uploadLoading: false,
            formData: {
                first_name: '',
                last_name: '',
                about: '',
                avatar: null,
            },
            profileSize: 'xxl',
            windowSize: window.innerWidth,
        }

    },

    mounted() {
        /* Function to get profile data */
        this.Profile();

        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize);
        });
        if (window.innerWidth <  576) {
            this.profileSize = 'xl'
        }else {
            this.profileSize = 'xxl'
        }


    },
    beforeDestroy() {
        window.removeEventListener('resize', this.onResize);
    },
    watch: {
        'formData.about'(desc) {
            if (desc !== null) {
                if (desc?.length < 100) {
                    this.initNoteLength = '0' + desc?.length
                } else {
                    this.initNoteLength = desc?.length
                }
            }
        },
        'windowSize'(size) {

            if (size <  576) {
                this.profileSize = 'xl'
            }else {
                this.profileSize = 'xxl'
            }
        }
    },


    methods: {
        onResize() {
            this.windowSize = window.innerWidth
        },

        /* Function to getting profile data api*/
        Profile() {
            this.getProfileLoading = true;
            axios.get(apiRoutes.Profile, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                this.getProfileLoading = false;
                let res = response.data;
                this.profileData = res.details;
            }).catch(err => {
                this.getProfileLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function to open profile modal */
        openProfileModal() {
            apiService.ClearErrorHandler();
            let userData = this.profileData
            this.formData = {
                first_name: userData.first_name,
                last_name: userData.last_name,
                about: userData.about,
                avatar: userData.avatar,
            }

            if (this.formData.about === null || this.formData.about === '') {

                this.initNoteLength = 0
            }
            const myModal = new bootstrap.Modal("#editProfile", {keyboard: false});
            myModal.show();
        },

        /* Function to hide profile modal */
        hideProfileModal() {
            const Modal = document.querySelector('#editProfile');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to profile update api */
        updateProfile() {
            apiService.ClearErrorHandler();
            this.updateLoading = true;
            axios.patch(apiRoutes.ProfileUpdate, this.formData, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.updateLoading = false;
                EventBus.$emit('updateUserInfo', res.user);
                toaster.info('Update data successfully')
                this.hideProfileModal();
                this.Profile();
            }).catch(err => {
                this.updateLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function to profile update avatar */
        attachAvatar(event) {
            this.uploadLoading = true;
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file);
            formData.append("media_type", 1);
            formData.append("media_use", 1);
            axios.post(apiRoutes.Media, formData, {headers: apiService.mediaHeaderContent}).then((response) => {
                let res = response.data
                this.uploadLoading = false;
                event.target.value = '';
                this.formData.avatar = res.data.file_path;
            }).catch(err => {
                this.uploadLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /* Function to Remove avatar */
        removeAvatar() {
            this.formData.avatar = null;
        },

        /* Function to control length about input */
        lengthAlphabet(num) {
            this.noteLength = ('0' + num).slice(-3)
        },


    }

}

</script>
