<template>
    <div class="side-nav">
        <!--navbar brand start-->
        <div class="nav-brand">
            <img :src="`/images/global/short-logo.svg`" alt="short logo">
        </div>
        <!--navbar brand end  -->

        <!--nav menu start-->
        <ul class="nav-menu">
            <li>
                <router-link :to="{name:'Dashboard'}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             data-bs-title="Dashboard">
                    <img :src="`/images/portal/dashboard.svg`" alt="dashboard" class="nav-icon">
                </router-link>
            </li>

            <li>
                <router-link :to="{name:'Calendar'}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             data-bs-title="Calendar">
                    <img :src="`/images/portal/calendar.svg`" alt="calendar" class="nav-icon">
                </router-link>
            </li>

            <li>
                <router-link :to="{name:'Sales'}" class="disable-feature" data-bs-toggle="tooltip"
                             data-bs-custom-class="custom-tooltip" data-bs-title="Sales" data-bs-placement="right">
                    <img :src="`/images/portal/file-money.svg`" alt="file-money" class="nav-icon">
                </router-link>
            </li>


            <li>
                <router-link :to="{name:'Customer'}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             :class=" {'router-link-exact-active': matchedRouteCheck('CustomerLayout')}"
                             data-bs-title="Customer">
                    <img :src="`/images/portal/face-man.svg`" alt="face-man" class="nav-icon">
                </router-link>
            </li>

            <li>
                <router-link :to="{name:'MarketPlaceProfile'}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             data-bs-title="Online Booking" data-bs-placement="right">
                    <img :src="`/images/portal/onlineBooking.svg`" alt="online-booking" class="nav-icon w-28 h-28">
                </router-link>
            </li>


            <li>
                <router-link :to="{name:'Services'}" :class=" {'router-link-exact-active': matchedRouteCheck('CatalogueLayout')}"
                             data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             data-bs-title="Catalogue" data-bs-placement="right">
                    <img :src="`/images/portal/scissor.svg`" alt="scissor" class="nav-icon">
                </router-link>
            </li>


            <li>
                <router-link :to="{name:'Deals'}" data-bs-toggle="tooltip"
                   data-bs-custom-class="custom-tooltip" data-bs-title="Engage" data-bs-placement="right">
                    <img :src="`/images/portal/spray-can.svg`" alt="spray-can:" class="nav-icon">
                </router-link>
            </li>


            <li>
                <a href="javascript:void(0)" class="disable-feature">
                    <img :src="`/images/portal/delivery.svg`" alt="delivery" class="nav-icon">
                </a>
            </li>


            <li>
                <router-link :to="{name: 'ReportGroup'}" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                             data-bs-title="Reports" data-bs-placement="right">
                    <img :src="`/images/portal/chart-bar.svg`" alt="chart-bar" class="nav-icon">
                </router-link>
            </li>

            <li>
                <router-link :to="{name: 'SetupSettings'}" data-bs-toggle="tooltip"
                             data-bs-custom-class="custom-tooltip" data-bs-title="Settings" data-bs-placement="right">
                    <img :src="`/images/portal/setting-gear.svg`" alt="setting-gear" class="nav-icon">
                </router-link>
            </li>

        </ul>
        <!--nav menu end  -->

    </div>
</template>

<script>
import {useRoute} from 'vue-router'
import {computed} from 'vue'

export default {

    data() {
        return {
            route: '',
        }
    },
    mounted() {
        this.route = useRoute();
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    },

    methods: {
        // This function will check from the route if it's matched with parameter name and return a boolean value.
        matchedRouteCheck(routeName) {
            if (this.route !== undefined && this.route !== '') {
                return this.route.matched.some(item => item.name === routeName);
            }
        }
    },
    watch: {}
}
</script>
