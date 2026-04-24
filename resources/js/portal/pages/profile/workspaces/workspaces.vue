<template>

    <div class="card-content">

        <div class="card-header">
            <div class="card-title margin-bottom-15">
                Workspaces
                <div class="card-sub-title padding-top-10">
                    Manage your workspace settings.
                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                        Learn more
                    </a>
                </div>
            </div>
        </div>

        <div class="card-workshop rounded-3 border d-sm-flex justify-content-between align-items-center
                    padding-24 border-radius-5 flex-wrap" v-if="!loading">
            <div class="d-sm-flex align-items-center">
                <div class="w-85 h-85 bg-theme-opacity d-flex justify-content-center align-items-center rounded-circle">
                    <img :src="`/images/portal/workshop.svg`" class="workshop-icon w-40 h-40" alt="workshop">
                </div>
                <div class="ms-0 mt-4 ms-sm-3 mt-sm-0">
                    <div class="font-weight-900 padding-bottom-5">
                        {{ companyData.business_name }}
                    </div>
                    <div class="font-weight-300 padding-bottom-5">
                        Owner access
                    </div>
                    <div class="font-weight-300">
                        Joined on {{ companyData.created_at_formatted }}
                    </div>
                </div>
            </div>
            <router-link :to="{name: 'WorkspaceSettings'}" class="btn btn-outline-theme padding-y-10 padding-x-20">
                Manage
            </router-link>
        </div>

        <!-- page loading -->
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
