<template>

    <div class="profile position-relative">

        <!--Sidebar-->
        <Sidebar :items="items"/>

        <div class="profile-content" :class="{'profile-content-scrollable' : $route.name === 'Settings'}">
            <div class="d-flex justify-content-center align-items-start px-3 pt-5">
                <router-view/>
            </div>
        </div>
    </div>

</template>

<script>

import Sidebar from "../../../../components/sidebar.vue"

export default {

    components: {
        Sidebar
    },

    data(){

        return {
            items: [
                {
                    title: 'Your Account',
                    routes: [
                        {name: 'Profile', routeName: 'Profile', active: true},
                        {name: 'Reviews', routeName: 'Reviews', active: false},
                        {name: 'Settings', routeName: 'Settings', active: true},
                        {name: 'Workspaces', routeName: 'Workspaces', active: true},
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
