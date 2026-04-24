<template>

    <div class="market-place-wrapper">

        <Sidebar :items="items"/>

        <router-view/>

    </div>

</template>

<script>

import Sidebar from "../../../../components/sidebar.vue"

export default {

    components: {
        Sidebar
    },

    data(){

        return{
            items: [
                {
                    title: 'Online Booking',
                    routes: [
                        {name: 'Marketplace profile', routeName: 'MarketPlaceProfile', active: true},
                        {name: 'Reserve with google', routeName: '', active: false},
                        {name: 'Facebook and instagram bookings', routeName: '', active: false},
                        {name: 'Link builder', routeName: '', active: false},
                    ]
                },
            ],
        }

    },

    mounted() {



    },

    methods: {



    }

}

</script>
