<template>
    <!-- If Market place doesn't have any data -->
    <div class="market-place-content row gx-0 d-lg-flex justify-content-center align-items-center"
         v-if="marketplaceData !== null && marketplaceData.status === 2 && !loading">

        <!--Background shape-->
        <img :src="`/images/portal/market-place-shape.svg`" class="img-fluid market-place-curve"
             alt="market-place-shape">

        <!--Marketplace text content-->
        <div class="col-lg-6 col-xl-4 p-3 d-flex justify-content-center align-items-center flex-column">
            <div class="me-lg-3">
                <div class="font-size-26 fw-semibold mb-2">
                    Attract new clients with online bookings
                </div>
                <div class="mb-3">
                    Join the world's largest beauty and wellness marketplace
                </div>
                <div class="mb-3">
                    <div class="line-height-2 d-flex align-items-center">
                        <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                        Get your business listed on the Fresha app
                    </div>
                    <div class="line-height-2 d-flex align-items-center">
                        <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                        Reach thousands of new clients who visit Fresha every day
                    </div>
                    <div class="line-height-2 d-flex align-items-center">
                        <img :src="`/images/portal/review-check.svg`" class="w-23 h-23 me-2" alt="check">
                        Free up time and get your clients self-booking online 24/7
                    </div>
                </div>
                <div class="row">
                    <!--Start now button-->
                    <div class="col-xxl-4 col-xl-6 col-sm-5">
                        <router-link :to="{name: 'OnlineBookingLocationDetails'}"
                                     class="btn btn-theme w-100 h-45 me-2 mb-sm-0 mb-3">
                            Start Now
                        </router-link>
                    </div>

                    <!--Learn more button-->
                    <div class="col-xxl-4 col-xl-6 col-sm-5">
                        <a href="javascript:void(0)"
                           class="btn btn-white has-border w-100 h-45 d-flex justify-content-center align-items-center border-radius-10 padding-y-10">
                            Learn more
                        </a>
                    </div>


                </div>
            </div>
        </div>

        <!--Business profile and map image-->
        <div class="col-lg-3 d-flex align-items-center justify-content-center p-3">
            <img :src="`/images/home/mobile-photo.webp`" class="img-fluid image-res image-mobile-photo mx-3"
                 alt="mobile-photo">
            <span id="mapVid">
                <video autoplay loop muted playsinline :src="`/images/home/mobile-video.mp4`"
                       class="img-fluid image-res image-mobile-video mx-3 shadow rounded-3"></video>
            </span>
        </div>

    </div>

    <!-- If Market place exist show profile -->
    <div class="container-fluid market-place-list"
         v-if="marketplaceData !== null && marketplaceData.status !== 2 && !loading">
        <div class="row justify-content-center p-3 p-sm-5">
            <div class="col-xxl-8 col-xl-10 col-12 px-sm-3 px-0 pt-5 pt-sm-0">

                <!-- header -->
                <div class="fw-semibold fs-4">
                    Marketplace profile
                </div>
                <div class="mb-3">
                    Attract new clients to book online via your business profile on Fresha, the world's largest beauty
                    and wellness marketplace.
                    <a href="javascript:void(0)" class="underline-anim text-theme">Learn more</a>
                </div>

                <!-- profile -->
                <div class="border p-3 p-sm-4 rounded-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <img v-if="marketplaceData.profile.photos.length > 0"
                                 :src="`/storage/media/image/`+marketplaceData.profile.photos[0].photo_path"
                                 class="img-fluid object-fit-cover rounded-3 w-100 h-140" alt="avatar">
                            <!--if there's no image-->
                            <div
                                class="bg-theme-opacity rounded-3 w-100 h-140 d-flex justify-content-center align-items-center"
                                v-if="marketplaceData.profile.photos.length === 0">
                                <img :src="`/images/portal/workshop.svg`" class="w-60 h-60"
                                     alt="no image">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 lh-sm mt-lg-0 my-2">
                                    <span class="fs-4 fw-semibold">
                                        {{ marketplaceData.profile.location_name }}
                                    </span>
                                    <span
                                        class="d-lg-none d-block text-muted">{{ marketplaceData.profile.address }}</span>
                                </div>

                                <div
                                    class="col-lg-6 text-end text-muted d-flex justify-content-lg-end justify-content-between align-items-center mb-3">
                                     <span class="badge bg-success-subtle text-success d-lg-none d-block">
                                        Online
                                    </span>
                                    <div class="ms-3 text-truncate">Updated Fri 26 Jan, 2024</div>
                                </div>
                            </div>

                            <div class="row d-lg-flex d-none">
                                <div class="col-12 h-55 text-wrap text-muted text-truncate">
                                    {{ marketplaceData.profile.address }}
                                </div>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-lg-2 d-lg-block d-none">
                                    <span class="badge bg-success-subtle text-success">
                                        Online
                                    </span>
                                </div>

                                <div class="col-lg-10">
                                    <div
                                        class="d-flex market-place-list-buttons align-items-center justify-content-lg-end justify-content-between ">
                                        <div class="dropdown">
                                            <button type="button"
                                                    class="btn btn-white has-border h-45 border-radius-10"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                Options
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-2 overflow-hidden">
                                                <li>
                                                    <button type="button" class="dropdown-item py-2 px-3 rounded-2"
                                                            @click="GetProfile(marketplaceData)">
                                                        Edit Profile
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item py-2 px-3 rounded-2">
                                                        Unlist Profile
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>

                                        <button type="button" class="btn btn-theme ms-sm-2 disable-feature">
                                            View on Barberly
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--list loading start-->
    <appLoader class="container p-sm-5 p-3" v-if="loading"/>
    <!--list loading end-->

</template>

<script>

import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import axios from "axios";
import appLoader from "../../../../components/app-loader.vue";

export default {
    components: {appLoader},
    /*Data and variables*/
    data() {
        return {
            loading: false,
            marketplaceData: null,
        }
    },

    mounted() {
        /*Function to initialize the video first*/
        if (this.marketplaceData?.status === 2) {
            this.initializeVideo();
        }


        /*Function to call the marketplace when page loads*/
        this.getMarketplace();
    },

    methods: {
        /*Function to initialize the video first*/
        initializeVideo() {
            let sp1 = document.createElement("span");

            // Get the reference element
            let sp2 = document.getElementById("mapVid");
            // Get the parent element
            let parentDiv = sp2.parentNode;

            // Insert the new element into before sp2
            parentDiv.insertBefore(sp1, sp2);
        },

        /*Function that calls the marketplace*/
        getMarketplace() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.get(apiRoutes.Marketplace, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.marketplaceData = response.data
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        GetProfile() {
            this.$router.push({name: 'OnlineBookingLocationDetails'})
        }

    }

}

</script>
