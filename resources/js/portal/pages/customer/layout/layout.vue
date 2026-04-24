<template>
    <div class="customer">

        <!--Sidebar-->
        <Sidebar :items="items"/>

        <div class="customer-content">
            <router-view/>
        </div>

    </div>
</template>

<script>
import Sidebar from "../../../../components/sidebar.vue"

export default {
    components: {Sidebar},
    data() {

        return {
            /*Sidebar data*/
            items: [
                {
                    title: 'Customer',
                    routes: [
                        {name: 'Customer list', routeName: 'Customer', active: true},
                        {name: 'Reviews', routeName: 'CustomerReview', active: true},
                        {name: 'Automated message', routeName: 'CustomerAutoMatedMessage', active: true},
                        {name: 'Forms', routeName: 'CustomerForm', active: false},
                        {name: 'Notifications', routeName: 'CustomerNotification', active: true},
                    ]
                },
            ],


        }

    },

    mounted() {

    },

    methods: {}

}

</script>
