<template>

    <div class="side-nav-responsive overflow-y-scroll scrollbar" :class="{'active' : nav }">
        <div class="d-flex justify-content-end align-items-center padding-15">
            <button type="button"
                    class="side-nav-toggler w-32 h-32 d-flex justify-content-center align-items-center border-0"
                    @click="navToggler">
                <img :src="`/images/global/x-white.svg`" class="w-20 h-20" alt="close">
            </button>
        </div>
        <ul class="side-nav-body overflow-y-scroll scrollbar">
            <li>
                <div class="p-2">
                    <img :src="`/images/global/logo-white.svg`" class="h-24" alt="short logo">
                </div>
            </li>
            <li>
                <router-link :to="{name: 'Dashboard'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-dashboard.svg`" alt="dashboard" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/dashboard.svg`" alt="dashboard" class="nav-icon w-20 h-24 me-2">
                    Dashboard
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Calendar'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/calendar-theme.svg`" alt="calendar" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/calendar.svg`" alt="calendar" class="nav-icon w-20 h-24 me-2">
                    Calendar
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Sales'}" class="nav-item disable-feature" @click="navToggler">
                    <img :src="`/images/portal/theme-file-money.svg`" alt="file-money" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/file-money.svg`" alt="file-money" class="nav-icon w-20 h-24 me-2">
                    Sales
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Customer'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-face-man.svg`" alt="face-man" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/face-man.svg`" alt="face-man" class="nav-icon w-20 h-24 me-2">
                    Customer
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'MarketPlaceProfile'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-onlineBooking.svg`" alt="online-booking" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/onlineBooking.svg`" alt="online-booking" class="nav-icon w-20 h-24 me-2">
                    Online Booking
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Services'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-scissor.svg`" alt="scissor" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/scissor.svg`" alt="scissor" class="nav-icon w-20 h-24 me-2">
                    Catalogue
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'Deals'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-spray-can.svg`" alt="spray-can:" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/spray-can.svg`" alt="spray-can:" class="nav-icon w-20 h-24 me-2">
                    Engage
                </router-link>
            </li>
            <li>
                <a href="javascript:void(0)" class="nav-item disable-feature" @click="navToggler">
                    <img :src="`/images/portal/theme-delivery.svg`" alt="delivery" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/delivery.svg`" alt="delivery" class="nav-icon w-20 h-24 me-2">
                    delivery
                </a>
            </li>
            <li>
                <router-link :to="{name: 'ReportGroup'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-chart-bar.svg`" alt="chart-bar" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/chart-bar.svg`" alt="chart-bar" class="nav-icon w-20 h-24 me-2">
                    Reports
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'SetupSettings'}" class="nav-item" @click="navToggler">
                    <img :src="`/images/portal/theme-setting-gear.svg`" alt="setting-gear" class="nav-icon-hover w-20 h-24 me-2">
                    <img :src="`/images/portal/setting-gear.svg`" alt="setting-gear" class="nav-icon w-20 h-24 me-2">
                    Settings
                </router-link>
            </li>
        </ul>
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            <a href="javascript:void(0)" class="text-theme px-2 text-decoration-none">
                <img class="w-19 h-19" :src="`/images/portal/american-flag.svg`" alt="american flag">
                English
            </a>
            <a href="javascript:void(0)" class="text-theme px-2 text-decoration-none">
                <img class="w-19 h-19" :src="`/images/portal/support.svg`" alt="support">
                Support
            </a>
            <a href="javascript:void(0)" class="text-theme px-2 text-decoration-none">
                Privacy Policy
            </a>
        </div>
    </div>

</template>

<script>

import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";

export default {
    created() {
        // Listen for UserInfo update event
        EventBus.$on('NavToggle', ToggleResponse => {
            // Update userInfo with the received data
            this.nav = ToggleResponse;
        });
    },
    data() {
        return {
            nav: false
        }
    },
    mounted() {},
    methods: {
        /*Function to toggle the sidenav*/
        navToggler() {
            this.nav = !this.nav
        }
    }
}


</script>
