<template>

    <div class="dropdown" v-if="userInfo !== null">
        <a href="javascript:void(0)" class="user-drop rounded-pill border d-block padding-x-12 padding-y-10" role="button"
           data-bs-toggle="dropdown" data-bs-target="#headerDrop" aria-expanded="false">
            <img v-if="userInfo.avatar != null" class="user-img img-fluid me-sm-3"
                 :src="`/storage/media/image/`+userInfo.avatar"
                 alt="avatar">

            <img class="chevron d-sm-inline-block d-none" :src="`/images/global/chevron-down.svg`" alt="chevron down">
        </a>

        <ul class="dropdown-menu shadow rounded-3 border-0 p-3" id="headerDrop">
            <li class="fw-semibold ps-2 mb-2">{{ userInfo.first_name + ' ' + userInfo.last_name }}</li>
            <li>
                <router-link :to="{name:'Profile'}" class="dropdown-item p-2 rounded-3 small">Profile</router-link>
            </li>
            <li>
                <router-link :to="{name: 'Appointments'}" class="dropdown-item p-2 rounded-3 small">
                    Appointment
                </router-link>
            </li>
            <li>
                <router-link :to="{name:'GiftCards'}" class="dropdown-item p-2 rounded-3 small">
                    Gift cards
                </router-link>
            </li>
            <li>
                <a class="dropdown-item p-2 rounded-3 small disable-feature" href="javascript:void(0)">
                    Vouchers
                </a>
            </li>
            <li>
                <router-link :to="{name: 'Memberships'}" class="dropdown-item p-2 rounded-3 small">
                    Memberships
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Favorites'}" class="dropdown-item p-2 rounded-3 small">
                    Favorites
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Forms'}" class="dropdown-item p-2 rounded-3 small">
                    Forms
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Orders'}" class="dropdown-item p-2 rounded-3 small">
                    Product orders
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Profile'}" class="dropdown-item p-2 rounded-3 small">
                    Payment methods
                </router-link>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <router-link :to="{name: 'DownloadApp'}" class="dropdown-item p-2 rounded-3 small">
                    Download the app
                </router-link>
            </li>
            <li>
                <a class="dropdown-item p-2 rounded-3 small disable-feature" href="javascript:void(0)">
                    Customer support
                </a>
            </li>
            <li>
                <button type="button" class="dropdown-item p-2 rounded-3 small" @click="openLanguageModal()">
                    English
                </button>
            </li>
            <li>
                <a class="dropdown-item p-2 rounded-3 small" href="javascript:void(0)" v-if="!logoutLoading"
                   @click="logout()">Logout</a>

                <a class="dropdown-item p-2 rounded-3 small btn-loading h-37" href="javascript:void(0)"
                   v-if="logoutLoading">
                    <span class="loading black"></span>
                </a>

            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <router-link :to="{name: 'ForBusiness'}" class="dropdown-item">
                    Barberly for Business
                </router-link>
            </li>
        </ul>
    </div>

</template>

<script>
import apiService from "../../../services/apiService.js";
import apiRoutes from "../../apiRoutes/apiRoutes.js";
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    name: 'HeaderDropdown',
    data() {
        return {
            userInfo: null,
            logoutLoading: false,
        }
    },
    created() {
        // Listen for UserInfo update event
        EventBus.$on('updateUserInfo', updatedUserInfo => {
            // Update userInfo with the received data
            this.userInfo = updatedUserInfo;
            this.profileData = updatedUserInfo;
        });
    },
    mounted() {
        if (window.core.UserInfo !== null) {
            this.userInfo = window.core.UserInfo
        }
    },
    methods: {
        /*Logout api*/
        logout() {
            apiService.ClearErrorHandler()
            this.logoutLoading = true;
            axios.get(apiRoutes.CustomerLogout, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.logoutLoading = false;
                toaster.info('Logout successful')
                window.location.reload();
            }).catch(err => {
                this.logoutLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        openLanguageModal() {
            let modal = new bootstrap.Modal(document.getElementById('languageModal'))
            modal.show();
        },

    }
}
</script>

