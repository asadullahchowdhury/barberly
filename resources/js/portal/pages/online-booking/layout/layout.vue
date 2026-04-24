<template>

    <div class="online-booking-wrapper">
        <Header/>

        <small class="d-block text-center text-secondary text-opacity-75 mt-3" :class="{'d-none' : $route.name === 'OnlineBookingDone' }">
            Set up Barberly profile
        </small>

        <div class="container-fluid">
            <div class="w-100 mt-3">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-xl-8 col-lg-10 col-12">
                        <router-view/>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import Header from "../layout/includes/header.vue";

export default {

    components: {
        Header
    },

    data(){

        return{



        }

    },

    mounted() {



    },

    methods: {



    }

}

</script>
