<template>
    <div class="dashboard">
        <div class="page-wrap">
            <!--page title-->
            <div class="page-title">Dashboard Overview</div>
            <!--page title-->

            <!--Page content start-->
            <div class="page-content">
                <div class="dashboard-inner-content" v-if="dashboardData != null && !loading">
                    <!--Catalogue start-->
                    <router-link :to="{name:'Services'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/catalogue.png`" alt="catalogue">
                        </div>
                        <div class="service-title">
                            Catalogue Summary
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.catalogue }}</span>
                            <br>
                            Catalogues
                        </div>
                    </router-link>
                    <!--Catalogue end -->

                    <!--Customer start-->
                    <router-link :to="{name:'Customer'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/customer.png`" alt="customer">
                        </div>
                        <div class="service-title">
                            Customers Summary
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.customers }}</span>
                            <br>
                            Customers
                        </div>
                    </router-link>
                    <!--Customer end -->

                    <!--service start-->
                    <router-link :to="{name:'Services'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/service.png`" alt="service">
                        </div>
                        <div class="service-title">
                            Services Summary
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.services }}</span>
                            <br>
                            Services
                        </div>
                    </router-link>
                    <!--service end -->

                    <!--Team start-->
                    <router-link :to="{name:'Employees'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/team.png`" alt="team">
                        </div>
                        <div class="service-title">
                            Team Summary
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.team }}</span>
                            <br>
                            Team
                        </div>
                    </router-link>
                    <!--Team end -->

                    <!--Today's booking start-->
                    <router-link :to="{name:'Calendar'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/booking-today.png`" alt="today's booking">
                        </div>
                        <div class="service-title">
                            Today's bookings
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.today_bookings }}</span>
                            <br>
                            Bookings
                        </div>
                    </router-link>
                    <!--Today's booking end -->

                    <!--Total bookings start-->
                    <router-link :to="{name:'Calendar'}" class="service">
                        <div class="service-icon">
                            <img :src="`/images/portal/dashboard/booking-total.png`" alt="total">
                        </div>
                        <div class="service-title">
                            Total bookings
                        </div>
                        <div class="service-amount">
                            <span class="num">{{ dashboardData.total_bookings }}</span>
                            <br>
                            Total
                        </div>
                    </router-link>
                    <!--Total bookings end -->

                </div>

                <!--Page loading start-->
                <div class="dashboard-inner-content placeholder-glow" v-if="loading">
                    <div class="service placeholder"></div>

                    <div class="service placeholder"></div>

                    <div class="service placeholder"></div>

                    <div class="service placeholder"></div>

                    <div class="service placeholder"></div>

                    <div class="service placeholder"></div>

                </div>
                <!--Page loading end  -->

            </div>
            <!--Page content end  -->
        </div>
    </div>

    <!--footer start-->
    <Footer class="pt-3"/>
    <!--footer end  -->

</template>


<script>
import apiRoutes from "../../../services/apiRoutes.js";
import apiService from "../../../services/apiService.js";
import Footer from "../layout/includes/footer.vue";
import axios from "axios";

export default {
    data() {
        return {
            loading: false,
            dashboardData: null
        }
    },
    components: {
        Footer
    },
    mounted() {
        // Calling dashboard api when page loads.
        this.dashboard();
    },
    methods: {
        // Getting dashboard data.
        dashboard() {
            this.loading = true;
            axios.get(apiRoutes.Dashboard, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.dashboardData = response.data.data;
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
    },
}
</script>
