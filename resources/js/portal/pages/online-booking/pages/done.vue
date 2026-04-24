<template>

    <div class="p-1 mt-5">
        <div class="d-flex justify-content-center">
            <img :src="`/images/portal/hand-click.svg`" class="w-200 h-200" alt="hand-click">
        </div>

        <div class="h3 fw-semibold text-center">
            You're almost done!
        </div>

        <div class="mt-3 d-flex justify-content-center">
            <div class="line-height-2 col-12 col-md-7 text-center">
                Preview your profile and see how it would look on Barberly.com and the Barberly app.
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <!--Preview profile button-->
            <div class="col-12 col-md-4 mb-3">
                <button type="button" class="btn btn-white has-border w-100 padding-x-12 padding-y-10 border-radius-10">
                    Preview Profile
                </button>
            </div>
            <!--Publish button-->
            <div class="col-12 col-md-4 mb-3">
                <button type="button" class="btn btn-theme w-100" @click="publishMarketPlace" v-if="!loading">
                    Publish
                </button>
                <button type="button" class="btn btn-theme btn-loading w-100" v-if="loading">
                    <span class="loading"></span>
                </button>
            </div>
        </div>
    </div>

</template>

<script>
import session from "../../../../services/session.js";
import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left'
})

export default {

    data() {

        return {
            loading: false,
            formData: {}
        }

    },

    mounted() {
        this.retrieveMarketplaceData();
    },

    methods: {

        // Function to store data in session storage
        submitAccount() {
            if (this.validateForm()) {
                // Convert the data to a JSON string before storing
                const jsonData = JSON.stringify(this.formData);

                // Store the JSON string in session storage
                session.setSession('marketplaceInfo', jsonData)
                this.publishMarketPlace();
            }
        },

        /*Function to initialize time in all input and push another index in shifts */
        retrieveMarketplaceData() {
            const storedDataJson = session.getSession('marketplaceInfo')

            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        },

        /*Function to publish marketplace*/
        publishMarketPlace() {
            this.formData.status = 1;
            apiService.ClearErrorHandler();
            this.loading = true;
            if (this.formData.id === '' || this.formData.id === null) {
                // Working for create api
                axios.post(apiRoutes.Marketplace, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.loading = false;
                    toaster.info('Marketplace has been published successfully.')
                    sessionStorage.removeItem('marketplaceInfo');
                    this.$router.push({name: 'MarketPlaceProfile'})
                }).catch(err => {
                    this.loading = false;
                })
            } else {
                // Working for update api
                axios.patch(apiRoutes.Marketplace, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.loading = false;
                    toaster.info('Marketplace has been Saved  successfully.');
                    sessionStorage.removeItem('marketplaceInfo');
                    this.$router.push({name: 'MarketPlaceProfile'})
                }).catch(err => {
                    this.loading = false;
                })
            }

        }
    }

}

</script>
