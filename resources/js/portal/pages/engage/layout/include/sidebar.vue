<template>
    <div class="sidebar px-2 py-3">
        <button type="button" class="sidebar-toggler" @click="sidebarToggler">
            <img :src="`/images/global/sidebar-chevron.svg`" alt="chevron">
        </button>
        <div class="sidebar-content">
            <div class="sidebar-title fw-semibold">Promotions</div>

            <ul class="sidebar-menu list-unstyled p-0 mb-2">
                <li>
                    <router-link :to="{name:'Deals'}">Deals</router-link>
                </li>

                <li>
                    <a class="disable-feature" href="javascript:void(0)">Smart pricing</a>
                </li>

                <li>
                    <a class="disable-feature" href="javascript:void(0)">Integrations</a>
                </li>

            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {}
    },
    mounted() {
    },
    methods: {
        sidebarToggler() {
            let sidebar = document.querySelector('.sidebar')
            let toggler = document.querySelector('.sidebar-toggler')
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active')
                toggler.classList.remove('opened')
            } else {
                sidebar.classList.add('active')
                toggler.classList.add('opened')
            }
        }
    }
}
</script>
