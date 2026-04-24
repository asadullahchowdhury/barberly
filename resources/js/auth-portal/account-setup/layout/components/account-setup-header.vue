<template>

    <div class="account-setup">

        <!-- account setup header -->
        <div
            class="padding-top-sm-53 padding-top-30 padding-bottom-sm-10 margin-bottom-30 padding-md-x-56 padding-x-20">
            <!-- route -->
            <a href="javascript:void(0)" @click="goBack()" v-if="$route.name !== 'AccountSetup'" class="btn-arrow">
                <img :src="'/images/global/arrow-left.svg'" alt="arrow-left.svg">
            </a>
        </div>

        <!-- logo -->
        <div :class="{'padding-top-54' : $route.name === 'AccountSetup'}"></div>
        <div class="logo text-center margin-bottom-sm-53 margin-bottom-30 padding-x-20">
            <img :src="'/images/global/logo.svg'" alt="logo">
        </div>

    </div>

</template>

<script>
import {useRoute} from "vue-router";

export default {

    data() {

        return {
            route: ''
        }

    },

    mounted() {
        this.route = useRoute();
    },

    methods: {
        goBack() {
            if (this.route.name === 'Service') {
                this.$router.push({name: 'AccountSetup'})
            } else if (this.route.name === 'TeamSize') {
                this.$router.push({name: 'Service'})
            } else if (this.route.name === 'BusinessLocation') {
                this.$router.push({name: 'TeamSize'})
            }
        }
    }

}

</script>
