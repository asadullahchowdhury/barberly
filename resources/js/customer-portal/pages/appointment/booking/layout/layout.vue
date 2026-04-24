<template>
    <div>
        <Header/>
        <div class="container appointment">
            <!--Breadcrumb section start-->
            <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url('/images/global/chevron-right.svg')">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <router-link :to="{name:'SelectServices'}" class="text-decoration-none text-dark">
                            Services
                        </router-link>
                    </li>

                    <li class="breadcrumb-item">
                        <router-link :to="{name:'SelectProfessional'}" class="text-decoration-none text-lighter">
                            Professional
                        </router-link>
                    </li>
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'selectDateTime'}" class="text-decoration-none text-lighter">
                            Time
                        </router-link>

                    </li>
                    <li class="breadcrumb-item">
                        <router-link :to="{name:'ConfirmAppointment'}" class="text-decoration-none text-lighter">
                            Confirm
                        </router-link>
                    </li>
                </ol>
            </nav>
            <!--Breadcrumb section end  -->

            <div class="row">
                <div class="col-xl-8">
                    <router-view/>
                </div>

                <div class="col-xl-4">

                    <!--Appointment info card start-->
                    <div class="card appointment-info-card rounded-3 p-2 mb-3">
                        <div class="card-header border-0 bg-white d-flex gap-10 py-3">
                            <div class="service-img">
                                <img class="width-70 height-70 img-fluid rounded"
                                     :src="`/images/home/salon/image-1.avif`"
                                     alt="img">
                            </div>
                            <div class="">
                                <p class="card-title fw-semibold mb-0">Decadence Hair and Beauty</p>
                                <div class="d-flex align-items-center">
                                    4.9
                                    <img width="16" height="16" :src="`/images/home/star.svg`" class="ms-2" alt="star">
                                    <img width="16" height="16" :src="`/images/home/star.svg`" class="" alt="star">
                                    <img width="16" height="16" :src="`/images/home/star.svg`" class="" alt="star">
                                    <img width="16" height="16" :src="`/images/home/star.svg`" class="" alt="star">
                                    <img width="16" height="16" :src="`/images/home/star.svg`" class="" alt="star">

                                    <div class="text-theme ms-2">(2,302)</div>
                                </div>
                                <p class="text-muted mb-0">36 Store St, London</p>
                            </div>

                        </div>
                        <div class="card-body">

                            <!--Selected service list-->
                            <ul class="list-unstyled mb-2 pb-3 border-bottom">
                                <li class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!--Content-->
                                        <div>
                                            <!--Title-->
                                            <p class="fw-semibold mb-0">Colour Consultation</p>
                                            <!--Duration-->
                                            <p class="text-decoration-none mb-0">15 mins</p>
                                        </div>

                                        <!--Price-->
                                        <p>free</p>

                                    </div>
                                </li>
                            </ul>

                            <!--Total-->
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fw-semibold mb-0">Total</p>
                                <p class="fw-semibold mb-0">free</p>
                            </div>

                        </div>
                        <div class="card-footer border-0 bg-white">
                            <a href="javascript:void(0)" @click="next"
                               class="btn btn-theme w-100">
                                Continue
                            </a>
                        </div>

                    </div>
                    <!--Appointment info card end  -->

                </div>
            </div>


        </div>
    </div>
</template>

<script>
import Header from "../layout/includes/header.vue"
import Filter from "../../../../../components/filter.vue";
import {useRoute} from "vue-router";

export default {
    components: {
        Filter,
        Header
    },
    data() {
        return {
            route: '',
            singleID: '',
        }
    },
    mounted() {
        if (window.history.state.id !== undefined || window.history.state.id !== null || window.history.state.id !== '') {
            this.singleID = window.history.state.id;
            console.log(window.history.state.id, this.singleID)
        }

        this.route = useRoute();
    },

    methods: {
        /*Function for next page*/
        next() {
            if (this.route.name === 'SelectServices') {
                this.$router.push({name: 'SelectProfessional', state: {id: this.singleID}})
            } else if (this.route.name === 'SelectProfessional') {
                this.$router.push({name: 'selectDateTime', state: {id: this.singleID}})
            } else if (this.route.name === 'selectDateTime') {
                this.$router.push({name: 'ConfirmAppointment', state: {id: this.singleID}})
            } else if (this.route.name === 'ConfirmAppointment') {
                this.$router.push({name: 'SalonSingle', params: {id: this.singleID}, state: {id: this.singleID}})
            }
        }
    },
}
</script>
