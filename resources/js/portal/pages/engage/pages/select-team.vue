<template>
    <div class="select-team">
        <!--Header text-->
        <div class="text-center mb-3">
            <p class="text-muted mb-1">Create a deal</p>
            <h3 class="fs-4 fw-semibold">Select team members</h3>
            <p class="mb-0">Choose which team members can be booked with this deal.</p>
        </div>

        <!--Form-->
        <form @submit.prevent="submitAccount">
            <div class="card rounded-3 mb-4">
                <div class="card-body p-md-4 p-3">

                    <div class="alert alert-danger text-center" v-if="teamError">Team member is required!</div>

                    <!-- team list loading -->
                    <appLoader v-if="loading"/>

                    <!-- no data -->
                    <div
                        class="d-flex justify-content-center flex-column gap-20 align-items-center no-data h-100 py-5"
                        v-if="teamData.length === 0 && loading === false">
                        <img :src="`/images/global/no-task.png`" class="img-fluid w-45 h-45" alt="no data">
                        <div class="font-size-30 font-weight-300 text-lighter">Empty List</div>
                    </div>

                    <div class="card-body p-md-4" v-if="teamData.length > 0 && loading === false">
                        <!--                    <div class="alert alert-danger team-alert text-center" v-if="teamError !== null"
                                                 v-text="teamError"></div>-->
                        <div class="form-group mb-3">
                            <label for="select_all">
                                <input type="checkbox" class="form-checkbox" id="select_all"
                                       :checked="teamData.length > 0 && teamData.length === teamSelected.length"
                                       @change="teamToggleCheckAll($event)">
                                <span class="fw-semibold fs-5"> Select all</span>
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-6" v-for="(each, index) in teamData">
                                <div class="form-group mb-3">
                                    <label :for="`team`+each.id" class="d-flex align-items-center">
                                        <input type="checkbox" class="form-checkbox" :id="`team`+each.id"
                                               :checked="teamCheckIfChecked(each.id)"
                                               @change="teamToggleCheck($event,each.id)">

                                        <!-- avatar image -->
                                        <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar"/>
                                        
                                        <span class="fw-semibold ms-2">
                                        {{ each.first_name + ' ' + each.last_name }}
                                    </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-theme w-150" v-if="!manageLoading">Next step</button>
                <button type="button" class="btn btn-theme btn-loading w-150" v-if="manageLoading">
                    <span class="loading"></span>
                </button>
            </div>
        </form>


    </div>
</template>

<script>
import appLoader from "../../../../components/app-loader.vue";
import axios from "axios";
import apiRoutes from "../../../../services/apiRoutes.js";
import apiService from "../../../../services/apiService.js";
import {createToaster} from "@meforma/vue-toaster";
import session from "../../../../services/session.js";
import avatarImage from "../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {appLoader, avatarImage},
    data() {
        return {
            loading: false,
            formData: {},
            teamData: [],
            teamSelected: [],
            manageLoading: false,
            teamError: false,
        }
    },
    mounted() {
        this.retrieveDealsData();
        this.teamList();
    },
    methods: {

        // Function to retrieve/get data from session storage
        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        },

        // Function to store data in session storage
        submitAccount() {
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('dealData', jsonData)
            this.manageDeal();
        },

        teamList() {
            this.loading = true;
            axios.get(apiRoutes.TeamMembers, {params: null}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.loading = false;
                this.teamData = res.members.data;
                if (this.formData.id === undefined || this.formData.id === null || this.formData.id === ''){
                    this.teamData.forEach((data) => {
                        this.teamSelected.push(data.id);
                    })
                    this.formData.members = this.teamSelected;
                }
                else {

                    // this.formData.members.forEach((v)=>{
                    //    this.teamSelected.push(v.member_id)
                    //     console.log(this.teamSelected,'ts')
                    // })
                    this.teamSelected = this.formData.members;
                }
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

        teamToggleCheckAll(e) {
            if (e.target.checked) {
                this.teamSelected = []
                this.teamData.forEach((v) => {
                    this.teamSelected.push(v.id);
                    this.formData.members = this.teamSelected;
                });
            } else {
                this.teamSelected = [];
                this.formData.members = [];
            }
        },

        teamToggleCheck(e, id) {
            if (e.target.checked) {
                this.teamSelected.push(id);
                this.formData.members.push(id)
            } else {
                let index = this.teamSelected.indexOf(id);
                let formIndex = this.formData.members.indexOf(id);
                this.teamSelected.splice(index, 1);
                // this.formData.members.splice(formIndex, 1);
            }
        },

        teamCheckIfChecked(id) {
            return this.teamSelected.map(function (id) {
                return id
            }).indexOf(id) > - 1;
        },

        /*Function to create/edit the deal*/
        manageDeal() {
            this.teamError = false;
            this.manageLoading = true;
            apiService.ClearErrorHandler();
            if (this.formData.id === undefined) {
                if (this.formData.members?.length === 0) {
                    this.teamError = true;
                    this.manageLoading = false;
                } else {
                    axios.post(apiRoutes.Deals, this.formData, {headers: apiService.headerContent}).then((response) => {
                        this.manageLoading = false;
                        let res = response.data.deal
                        let data = {
                            type: res.type,
                            promotion_type: res.promotion_type,
                            promotion_value: res.promotion_value,
                            enable_point_of_sale: res.enable_point_of_sale,
                            discount_code: res.discount_code,
                            start_date: res.start_date,
                            end_date: res.end_date,
                        }
                        this.$router.push({name: 'DealCompleted', state: data})
                    }).catch(err => {
                        this.manageLoading = false;
                        let res = err?.response;
                        if (res?.data?.errors !== undefined) {
                            apiService.ErrorHandler(res?.data?.errors);
                        } else {
                            toaster.error('Server error!')
                        }
                    })
                }
            } else {
                if (this.formData.members?.length === 0) {
                    this.teamError = true;
                    this.manageLoading = false;
                } else {
                    axios.patch(apiRoutes.Deals, this.formData, {headers: apiService.headerContent}).then((response) => {
                        this.manageLoading = false;
                        let res = response.data.deal
                        let data = {
                            type: res.type,
                            promotion_type: res.promotion_type,
                            promotion_value: res.promotion_value,
                            enable_point_of_sale: res.enable_point_of_sale,
                            discount_code: res.discount_code,
                            start_date: res.start_date,
                            end_date: res.end_date,
                        }
                        this.$router.push({name: 'DealCompleted', state: data})
                    }).catch(err => {
                        this.manageLoading = false;
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
    }
}
</script>
