<template>
    <div
        class="deals-header bg-white p-md-4 p-3 d-flex bg-white justify-content-between align-items-center position-relative mb-3">

        <div class="d-flex align-items-center">
            <!--Cancel button-->
            <a href="javascript:void(0)" class="btn-icon" @click="cancel">
                <img :src="`/images/global/x.svg`" class="w-20 h-15" alt="close-btn">
            </a>

            <span class="vr margin-x-10" v-if="$route.name !== 'DealType' && $route.name !== 'DealCompleted'"></span>

            <!--Previous button-->
            <a href="javascript:void(0)" @click="previous()"
               v-if="$route.name !== 'DealType' && $route.name !== 'DealCompleted' && formData.id === undefined || formData.id === 'new'"
               class="padding-x-20 text-decoration-none ">
                <span class="underline-anim text-theme">Previous</span>
            </a>

        </div>


        <!--Next step button-->
        <button type="button" class="btn-theme h-45 px-md-5 px-4" @click="next()"
                v-if="$route.name !== 'NewDeal' && $route.name !== 'EditDeal' && $route.name !== 'SelectTeam' &&
                $route.name !== 'PromotionApply' && $route.name !== 'DealCompleted'">
            <span>
                <span class="d-sm-block d-none">Next Step</span>
                <span class="d-sm-none d-block">
                    <img :src="`/images/global/arrow-right-white.svg`" alt="arrow-right">
                </span>
            </span>
        </button>


        <!--Gradient progressbar-->
        <div class="import-gradient position-absolute bottom-0 start-0"></div>

    </div>
</template>

<script>

import {useRoute} from "vue-router";
import session from "../../../../../services/session.js";

export default {
    data() {
        return {
            route: '',
            formData: {},
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

        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            } else {

            }
        },

        // Function to store data in session storage
        submitAccount() {
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('dealData', jsonData)
        },


        /*Function for next page*/
        next() {
            this.retrieveDealsData();
            this.submitAccount();

            if (this.route.name === 'DealType') {
                if (this.formData.type === 'promotion') {
                    this.$router.push({name: 'NewDeal', params: {id: 'new', name: 'promotion'}})

                } else if (this.formData.type === 'flash_sale') {
                    this.$router.push({name: 'NewDeal', params: {id: 'new', name: 'flash-sale'}})

                } else if (this.formData.type === 'last_minute') {
                    this.$router.push({name: 'NewDeal', params: {id: 'new', name: 'last-minute'}})
                }

            } else if (this.route.name === 'NewDeal') {

                if (this.formData.type === 'promotion') {
                    this.$router.push({name: 'PromotionApply'})

                } else if (this.formData.type === 'last_minute') {
                    this.$router.push({name: 'SelectTeam'})

                } else if (this.formData.type === 'flash_sale') {
                    this.$router.push({name: 'DealCompleted'})
                }

            } else if (this.route.name === 'PromotionApply') {
                this.$router.push({name: 'SelectTeam'})

            } else if (this.route.name === 'SelectTeam') {
                this.$router.push({name: 'DealCompleted'})

            } else if (this.route.name === 'DealCompleted') {
                this.$router.push({name: 'Deals'})
            }

        },

        /*Function for previous page*/
        previous() {
            if (this.route.name === 'NewDeal') {
                this.$router.push({name: 'DealType'})

            } else if (this.route.name === 'PromotionApply') {
                this.$router.push({name: 'NewDeal'})

            } else if (this.route.name === 'SelectTeam') {
                if (this.formData.type === 'promotion') {
                    this.$router.push({name: 'PromotionApply'})
                } else {
                    this.$router.push({name: 'NewDeal'})
                }

            } else if (this.route.name === 'DealCompleted') {
                if (this.formData.type === 'promotion' || this.formData.type === 'last_minute') {
                    this.$router.push({name: 'SelectTeam'})
                } else {
                    this.$router.push({name: 'NewDeal'})
                }
            }
        },


        /*Function that defines the progress level*/
        progress() {
            let progress = document.querySelector('.import-gradient');
            if (this.route.name === 'DealType') {
                progress.classList.remove('progress-45')
                progress.classList.remove('progress-60')
                progress.classList.add('progress-15')

            } else if (this.route.name === 'NewDeal') {
                if (this.formData.type === 'flash_sale') {
                    progress.classList.remove('progress-100');
                    progress.classList.add('progress-60')
                } else {
                    progress.classList.remove('progress-15')
                    progress.classList.remove('progress-75')
                    progress.classList.remove('progress-60')
                    progress.classList.add('progress-45')
                }

            } else if (this.route.name === 'PromotionApply') {
                progress.classList.remove('progress-45');
                progress.classList.remove('progress-75');
                progress.classList.add('progress-60');

            } else if (this.route.name === 'SelectTeam') {
                progress.classList.remove('progress-45')
                progress.classList.remove('progress-60');
                progress.classList.remove('progress-100');
                progress.classList.add('progress-75')

            } else if (this.route.name === 'DealCompleted') {
                progress.classList.remove('progress-75')
                progress.classList.add('progress-100')

            }
        },

        cancel() {
            sessionStorage.removeItem('dealData')
            this.$router.push({name: 'Deals'})
        }


    },
}
</script>

