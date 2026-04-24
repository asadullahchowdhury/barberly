<template>
    <div class="catalogue-layout">

        <sidebar :items="items"/>

        <div class="catalogue-main-body">
            <router-view/>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../../../components/sidebar.vue"

export default {
    data() {
        return {
            items: [
                {
                    title: 'Catalogue',
                    routes: [
                        {name: 'Services', routeName: 'Services', active: true},
                        {name: 'Memberships', routeName: 'Memberships', active: true},
                        {name: 'Products', routeName: '', active: false},
                        {name: 'Gift Cards', routeName: '', active: false},
                    ]
                },
                {
                    title: 'Inventory',
                    routes: [
                        {name: 'Stock Takes', routeName: '', active: false},
                        {name: 'Stock Orders', routeName: '', active: false},
                        {name: 'Suppliers', routeName: '', active: false},
                    ]
                }
            ],
        }
    },
    components: {
        Sidebar
    }
}
</script>
