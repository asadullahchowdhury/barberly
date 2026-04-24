<template>

    <div class="manage-employee" v-if="formData.id !== userData.id">

        <form autocomplete="off" @submit.prevent="manageMember">

            <div
                class="employee-header d-flex justify-content-between align-items-center">
                <button type="button" class="employee-add-close-btn" @click="goBack()">
                    <img :src="`/images/global/x.svg`" class="w-20 h-15" alt="close-btn">
                </button>

                <div class="title fw-semibold fs-5 d-sm-inline d-none">
                    <span v-if="formData.id === undefined">Add a new</span>
                    <span v-if="formData.id !== undefined">Edit</span>
                    team member
                </div>

                <span>
                    <button type="submit" class="btn-theme w-150" v-if="createLoading === false">
                        <span v-if="formData.id === undefined "> Save </span>
                        <span v-if="formData.id !== undefined "> Update </span>
                    </button>
                    <button type="button"
                            class="btn-theme d-flex align-items-center justify-content-center w-150 btn-loading"
                            v-if="createLoading === true">
                        <span class="loading"></span>
                    </button>
                </span>
            </div>

            <div class="container-fluid">
                <div class="p-3 h3 fw-semibold text-center">
                    <span v-if="formData.id === undefined">Add a new team member</span>
                    <span v-if="formData.id !== undefined">Edit team member</span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-11 col-xl-8">
                        <div class="row">
                            <div class="col-12 col-lg-4 col-xxl-3 p-3">
                                <div class="p-4 border w-100 rounded-4">
                                    <div class="fw-semibold h5 mb-3 px-3">
                                        Personal
                                    </div>
                                    <a href="javascript:void(0)"
                                       class="text-decoration-none text-dark badge-hover-effect active d-block px-3 py-2 border-radius-5">
                                        Profile
                                    </a>
                                    <hr>
                                    <div class="fw-semibold h5 mb-3 px-3">
                                        Workspace
                                    </div>
                                    <a href="javascript:void(0)"
                                       class="disable-feature text-decoration-none text-dark d-flex justify-content-between px-3 py-2 mb-3">
                                        Services <span
                                        class="badge text-dark d-flex align-items-center badge-hover-effect active">7</span>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="disable-feature text-decoration-none text-dark d-flex justify-content-between px-3 py-2 mb-3">
                                        Locations <span
                                        class="badge text-dark d-flex align-items-center badge-hover-effect active">1</span>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="disable-feature text-decoration-none text-dark d-flex justify-content-between px-3 py-2 mb-3">
                                        Settings
                                    </a>
                                    <div class="fw-semibold h5 mb-3 px-3">
                                        Compensation
                                    </div>
                                    <a href="javascript:void(0)"
                                       class="disable-feature text-decoration-none text-dark d-block px-3 py-2">
                                        Commissions
                                    </a>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8 col-xxl-9 p-3">
                                <div class="p-4 pb-3 border w-100 rounded-4 mb-4">
                                    <div class="fw-semibold h5 mb-1">
                                        Profile
                                    </div>
                                    <div class="text-secondary mb-3">
                                        Manage your team members personal profile
                                    </div>

                                    <div class="d-flex justify-content-center mb-3">
                                        <label for="upload-avatar"
                                               class="form-label bg-theme-opacity d-inline-block rounded-circle w-210 h-210 d-flex justify-content-center align-items-center avatar"
                                               @change="attachAvatar($event)"
                                               v-if="uploadLoading === false && formData.avatar === null || formData.avatar === ''">
                                            <img :src="`/images/portal/camera.svg`" class="w-45 h-45" alt="camera">
                                            <input id="upload-avatar" type="file" name="avatar" class="d-none"
                                                   autocomplete="off" accept="image/*">
                                        </label>
                                        <div class="placeholder-loading w-210 h-210" v-if="uploadLoading === true">
                                            <div class="placeholder-anim w-210 h-210 border-radius-100"></div>
                                        </div>
                                        <div class="position-relative"
                                             v-if="formData.avatar !== null && formData.avatar !== ''">
                                            <div class="w-210 h-210 overflow-hidden rounded-circle border border-3">
                                                <img :src="`/storage/media/image/`+formData.avatar"
                                                     class="w-100 h-100 img-fluid object-fit-cover" alt="avatar">
                                            </div>
                                            <div class="position-absolute top-100 start-50 translate-middle">
                                                <img :src="`/images/portal/delete.svg`"
                                                     class="w-40 h-40 btn btn-light rounded-circle" alt="delete"
                                                     @click="removeAvatar">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="first_name" class="form-label">First name *</label>
                                                <input type="text" name="first_name" class="form-control"
                                                       placeholder="Enter employee first name"
                                                       v-model="formData.first_name" autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="last_name" class="form-label">Last name *</label>
                                                <input type="text" name="last_name" class="form-control"
                                                       placeholder="Enter employee last name"
                                                       v-model="formData.last_name" autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="Enter employee email name" v-model="formData.email"
                                                       autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="mobile" class="form-label">Mobile phone *</label>
                                                <input type="text" name="mobile" class="form-control"
                                                       placeholder="Enter employee mobile phone"
                                                       @keypress="checkNumber($event)"
                                                       v-model="formData.mobile" autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="color" class="form-label">Color *</label>
                                                <div class="d-flex align-items-center flex-wrap">
                                                    <span v-for="each in color">
                                                        <input type="radio" name="color" class="color me-2 mb-3"
                                                               :style="{background:each}"
                                                               @change="formData.color = each"
                                                               :checked="formData.color === each">
                                                    </span>
                                                </div>
                                                <div class="error-report"></div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="job_title" class="form-label">job Title *</label>
                                            <input type="text" name="job_title" class="form-control"
                                                   v-model="formData.job_title"
                                                   placeholder="Enter employee job title" autocomplete="off">
                                            <span
                                                class="text-small text-secondary ms-1">Visible to clients online</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="p-4 border w-100 rounded-4">
                                    <div class="fw-semibold h5 mb-1">
                                        Employment details
                                    </div>
                                    <div class="text-secondary mb-3">
                                        Manage your team members start date, and employment details
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="start_date" class="form-label">Start date *</label>
                                                <input type="text" id="start_date" name="start_date"
                                                       class="form-control" v-model="formData.start_date"
                                                       placeholder="Enter your employee start date" autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="end_date" class="form-label">End date *</label>
                                                <input type="text" id="end_date" name="end_date" class="form-control"
                                                       v-model="formData.end_date"
                                                       placeholder="Enter your employee end date" autocomplete="off">
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <label for="description" class="form-label">Notes</label>
                                                    <span>{{ noteLength }}/{{ maxNoteLength }}</span>
                                                </div>
                                                <textarea name="description" v-model="formData.notes"
                                                          :maxlength="maxNoteLength"
                                                          @keyup="lengthAlphabet(formData.notes.length)"
                                                          id="description"
                                                          placeholder="Add a private note only viewable in the team member list"
                                                          class="form-textarea" cols="30" rows="5"></textarea>
                                                <div class="error-report"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <appAccess
        :message="`Looks like you don't have access to this.`"
        :icon="`/images/global/file-not-found.png`"
        :btn="true"
        :btn_title="`Go back`"
        @onClick="matchTeamMember()"
        v-if="userData.id === formData.id"
    />

</template>

<script>

import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import {useRoute} from "vue-router";
import {createToaster} from "@meforma/vue-toaster";
import flatpickr from "flatpickr";
import axios from "axios";
import {colors} from "../../../../constants/color";
import appAccess from "../../../../components/app-access.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        appAccess
    },

    data() {

        return {
            maxNoteLength: '1000',
            text: '',
            noteLength: '0',
            color: colors,
            formData: {
                avatar: null,
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                start_date: this.startDateCustom(),
                end_date: '',
                color: 'rgb(255, 156, 187)',
                job_title: '',
                notes: '',
            },
            uploadLoading: false,
            createLoading: false,
            userData: window.core.UserInfo,
        }

    },

    mounted() {

        this.fixedHeader();

        const route = useRoute()

        if (route.params.id !== undefined) {
            this.getSingle(route.params.id)
        }

        this.startDateFlatpickr();
        this.endDateFlatpickr();

    },
    watch: {
        'formData.notes'(desc) {
            if (desc !== null) {
                if (desc?.length < 100) {
                    this.noteLength = '0' + desc?.length
                }else {
                    this.noteLength = desc?.length
                }
            }
        },
    },
    methods: {

        goBack() {
            this.$router.back()
        },

        startDateCustom() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
        },

        lengthAlphabet(num) {
            if (num === 1000) {
                this.noteLength = ('0' + num).slice(-4)
            } else {
                this.noteLength = ('0' + num).slice(-3)
            }
        },

        //Attach avatar
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

        /*number check*/
        checkNumber(e) {
            let theEvent = e || window.event;
            let key;
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');

            } else {
                key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            const regex = /^\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },

        removeAvatar() {
            this.formData.avatar = null
        },

        manageMember() {
            apiService.ClearErrorHandler();
            this.createLoading = true;
            if (this.formData.id != null) {
                /* update api */
                axios.patch(apiRoutes.TeamMemberUpdate, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.createLoading = false;
                    toaster.info('Team member has been updated successfully.');
                    if (window.history?.state?.module_name === 'working-hour') {
                        this.$router.push({name: 'workingHour'});
                    } else {
                        this.$router.push({name: 'Employees'});
                    }
                }).catch(err => {
                    this.createLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                    } else {
                        toaster.error('Server error!')
                    }
                })
            } else {
                /* create api */
                axios.post(apiRoutes.TeamMembers, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.createLoading = false;
                    toaster.info('Team member has been created successfully.')
                    if (window.history?.state?.module_name === 'working-hour') {
                        this.$router.push({name: 'workingHour'});
                    } else {
                        this.$router.push({name: 'Employees'});
                    }
                }).catch(err => {
                    this.createLoading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                    } else {
                        toaster.error('Server error!')
                    }
                })
            }
        },


        /*member single api*/
        getSingle(id) {
            let param = {
                id: id
            }
            axios.get(apiRoutes.TeamMembers, {params: param}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.formData = res.member;
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    toaster.error('Member not found.')
                    apiService.ErrorHandler(res?.data?.errors);
                    this.$router.push({name: 'Employees'});
                } else {
                    toaster.error('Server error!');
                    this.$router.push({name: 'Employees'});
                }
            })
        },


        /*Fixed header*/
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.employee-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        // flatpickr

        startDateFlatpickr() {
            let THIS = this
            flatpickr("#start_date", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                defaultDate: this.startDateCustom(),
                disableMobile: true,
                onChange: function (date, dateStr) {
                    THIS.formData.start_date = dateStr;
                    THIS.endDateFlatpickr()
                }
            })
        },

        endDateFlatpickr() {
            let THIS = this;
            flatpickr("#end_date", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                disableMobile: true,
                minDate: THIS.formData?.start_date !== undefined ? THIS.formData?.start_date : ''
            })
        },

        // Function to route team member
        matchTeamMember() {
            this.$router.push( { name: 'Employees' } )
        }

    }

}

</script>
