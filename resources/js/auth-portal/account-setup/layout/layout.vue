<template>

    <Header/>

    <router-view/>

</template>

<script>

import Header from "./components/account-setup-header.vue";

export default {

    components: {
        Header
    },

    data(){

        return  {
            core:window.core
        }

    },

    mounted() {
        if(this.core.UserInfo.company_id != null){
            this.$router.push({name: 'Dashboard'})
        }
    },

    methods: {

    }

}

</script>
