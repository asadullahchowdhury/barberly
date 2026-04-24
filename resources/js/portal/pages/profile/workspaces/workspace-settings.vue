<template>

    <div class="card-content">

        <div v-if="!loading">
            <div class="card-header">
                <div class="card-title margin-bottom-15 d-flex justify-content-start align-items-center">
                    <router-link :to="{name: 'Workspaces'}">
                        <img :src="`/images/portal/arrow-left.svg`" class="w-24 h-15 h-18 margin-right-20" alt="arrow-left">
                    </router-link>
                    {{ companyData.business_name }}
                </div>
                <div class="card-title margin-bottom-15">
                    <div class="card-sub-title">
                        Manage your workspace settings.
                        <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-workshop rounded-3 border margin-bottom-16 d-none">
                <div class="padding-12 padding-sm-24 border-bottom font-weight-900 font-size-18">Calender sync</div>
                <div class="padding-12 padding-sm-24">
                    <router-link :to="{name: 'CalendarChoose'}" class="text-decoration-none text-theme d-flex align-items-center">
                        <img :src="`/images/portal/plus-circle.svg`" class="w-24 h-24 margin-right-10" alt="plus-circle">
                        Sync a calendar
                    </router-link>
                </div>
            </div>

            <div class="card-workshop rounded-3 border mb-3">
                <div
                    class="padding-12 padding-sm-24 border-bottom font-weight-900 font-size-18 d-sm-flex align-items-center justify-content-between">
                    <div class="w-100 mb-3 mb-sm-0">
                        workspace notifications
                    </div>
                    <div class="w-100 text-end">
                        <router-link :to="{name: 'Notification'}" class="text-decoration-none text-theme font-weight-400">
                            Manage
                        </router-link>
                    </div>
                </div>
                <div class="padding-12 padding-sm-24">
                    You have chosen to be notified about Activity concerning all team members, and have 11 notifications
                    settings turned on.
                </div>
            </div>

            <button type="button" class="btn btn-danger padding-x-12 padding-y-10 w-200 disable-feature">
                Delete workspace
            </button>
        </div>

        <appLoader class="ps-0" v-if="loading"/>

    </div>

</template>

<script>

import axios from "axios";
import apiRoutes from "../../../../services/apiRoutes.js";
import apiService from "../../../../services/apiService.js";
import appLoader from "../../../../components/app-loader.vue";

export default {

    components: {
        appLoader
    },

    data() {

        return {
            cardWorkUp: 1,
            loading: false,
            companyData: '',
        }

    },

    mounted() {

        this.getAccount();

    },

    methods: {

        /* Function to get company api */
        getAccount() {
            this.loading = true;
            axios.get(apiRoutes.Company, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                let res = response.data;
                this.companyData = res.company;
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
