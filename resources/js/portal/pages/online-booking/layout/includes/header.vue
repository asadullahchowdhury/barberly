<template>
    <div class="p-3 p-sm-4 d-flex justify-content-between align-items-center position-relative">

        <div class="d-flex align-items-center">
            <!--Cancel button-->
            <a href="javascript:void(0)" class="btn-icon" @click="cancel()">
                <img :src="`/images/global/x.svg`" class="w-20 user-select-none h-15" alt="close-btn">
            </a>

            <span class="vr margin-x-10" v-if="route.name !== 'OnlineBookingLocationDetails' && route.name !== 'OnlineBookingDone'"></span>

            <!--Previous button-->
            <a href="javascript:void(0)" @click="previous()" v-if="route.name !== 'OnlineBookingLocationDetails' && route.name !== 'OnlineBookingDone'"
               class="padding-20 text-decoration-none ">
                <span class="underline-anim text-theme">Previous</span>
            </a>

        </div>

        <div class="d-flex align-items-center actions-buttons">
            <!--Option button-->
            <div class="dropdown" v-if="route.name !== 'OnlineBookingDone'">
                <button type="button" class="btn btn-option h-45 border border-radius-10 padding-x-12 padding-y-10"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-sm-block d-none">Option <img class="ms-3" :src="`/images/global/chevron-down.svg`"
                                                                alt="arrow-down"></span>
                    <span class="d-sm-none d-block">
                       <img :src="`/images/global/settings.svg`" alt="settings">
                   </span>
                </button>
                <ul class="dropdown-menu p-2 mt-2 overflow-hidden">
                    <li>
                        <a href="javascript:void(0)" class="dropdown-item py-2 px-3">
                            Preview Profile
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="dropdown-item py-2 px-3 h-40" @click="submitAccount()">
                            <span v-if="!loading">Save and exit</span>
                            <span v-if="loading" class="btn-loading">
                                <span class="loading black"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!--Gradient progressbar-->
        <div class="import-gradient position-absolute bottom-0 start-0"></div>

    </div>

</template>

<script>

import {useRoute} from "vue-router";
import session from "../../../../../services/session.js";
import apiService from "../../../../../services/apiService.js";
import apiRoutes from "../../../../../services/apiRoutes.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left'
})

export default {

    data() {

        return {
            route: '',
            loading: false,
            formData: {}
        }

    },

    mounted() {
        this.route = useRoute();
        this.progress();
    },

    watch: {
        'route.name'(newRoute) {
            this.progress()
        }
    },


    methods: {

        /* Function to remove session data and redirect to marketplace profile page */
        cancel(){
            sessionStorage.removeItem('marketplaceInfo');
            this.$router.push( { name: 'MarketPlaceProfile'} );
        },

        /*Function to initialize time in all input and push another index in shifts */
        retrieveMarketplaceData() {
            const storedDataJson = session.getSession('marketplaceInfo')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        },


        // Function to store data in session storage
        submitAccount() {
            this.retrieveMarketplaceData();
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('marketplaceInfo', jsonData)
            this.saveMarketPlace();
        },


        saveMarketPlace() {
            if (this.formData.id === undefined || this.formData.id === '' || this.formData.id === null) {
                // Working for create api
                this.formData.status = 2;
                apiService.ClearErrorHandler();
                this.loading = true;
                axios.post(apiRoutes.Marketplace, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.loading = false;
                    toaster.info('Marketplace has been Saved as draft successfully.');
                    sessionStorage.removeItem('marketplaceInfo');
                    this.$router.push({name: 'MarketPlaceProfile'})
                }).catch(err => {
                    this.loading = false;
                })
            } else {
                // Working for update api
                this.formData.status = 1
                apiService.ClearErrorHandler();
                this.loading = true;
                axios.patch(apiRoutes.Marketplace, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.loading = false;
                    toaster.info('Marketplace has been Saved  successfully.');
                    sessionStorage.removeItem('marketplaceInfo');
                    this.$router.push({name: 'MarketPlaceProfile'})
                }).catch(err => {
                    this.loading = false;
                })
            }


        },


        /*Function for previous page*/
        previous() {
             if (this.route.name === 'OnlineBookingLocationAddress') {
                this.$router.push({name: 'OnlineBookingLocationDetails'})

            } else if (this.route.name === 'OnlineBookingWorkingHours') {
                this.$router.push({name: 'OnlineBookingLocationAddress'})

            } else if (this.route.name === 'OnlineBookingLocationPhoto') {
                this.$router.push({name: 'OnlineBookingWorkingHours'})

            } else if (this.route.name === 'OnlineBookingDone') {
                this.$router.push({name: 'OnlineBookingLocationPhoto'})
            }
        },

        /*Function that defines the progress level*/
        progress() {
            let progress = document.querySelector('.import-gradient');
            if (this.route.name === 'OnlineBookingLocationDetails') {
                progress.classList.remove('progress-45')
                progress.classList.add('progress-30')

            } else if (this.route.name === 'OnlineBookingLocationAddress') {
                progress.classList.remove('progress-30')
                progress.classList.remove('progress-60')
                progress.classList.add('progress-45')

            } else if (this.route.name === 'OnlineBookingWorkingHours') {
                progress.classList.remove('progress-45')
                progress.classList.remove('progress-75')
                progress.classList.add('progress-60')

            } else if (this.route.name === 'OnlineBookingLocationPhoto') {
                progress.classList.remove('progress-60')
                progress.classList.remove('progress-100')
                progress.classList.add('progress-75')

            } else if (this.route.name === 'OnlineBookingDone') {
                progress.classList.remove('progress-75')
                progress.classList.add('progress-100')
            }
        },
    }

}

</script>
