<template>
    <div class="import-customer-header padding-x-20 d-flex align-items-center">
        <router-link :to="{name: 'Customer'}" class="sync-close-btn">
            <img :src="`/images/global/x.svg`" class="close-btn" alt="close btn">
        </router-link>
        <div class="vr margin-x-10" v-if="$route.name === 'ImportCustomerReviewColumn' || $route.name === 'ImportComplete'"></div>
        <span v-if="$route.name === 'ImportCustomerReviewColumn'">
            <router-link :to="{name: 'ImportCustomerData'}" class="padding-x-20 padding-y-20 sync-back-btn text-decoration-none text-theme">
                Previous
            </router-link>
        </span>
        <span v-if="$route.name === 'ImportComplete'">
            <router-link :to="{name: 'ImportCustomerReviewColumn'}" class="padding-x-20 padding-y-20 sync-back-btn text-decoration-none text-theme">
                Previous
            </router-link>
        </span>
    </div>
    <div class="import-gradient" :class="$route.name === 'ImportCustomerData' ? 'progress-33' : '' || $route.name === 'ImportCustomerReviewColumn' ? 'progress-66' : '' || $route.name === 'ImportComplete' ? 'progress-100' : '' "></div>
</template>

<script>

export default {

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
