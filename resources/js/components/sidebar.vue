<template>
    <div class="sidebar" :class="{'active' : sidebarActivation}">

        <div class="position-relative">
            <button type="button"
                    class="sidebar-toggler position-absolute d-flex justify-content-center align-items-center"
                    @click="sidebarToggler" :class="{'active' : sidebarActivation}">
                <img :src="`/images/global/sidebar-chevron.svg`" class="w-20 h-20" alt="chevron">
            </button>
        </div>

        <!--Loop of item-->
        <div v-for="item in items">
            <div class="position-relative">
                <div class="sidebar-title fw-semibold margin-top-6">
                    {{ item.title }}
                </div>
            </div>

            <!--Loop of routes-->
            <template v-for="each in item.routes">
                <router-link  :to="{name: each.routeName}" v-if="each.routeName !== ''" class="link border-radius-5"
                              :class="{'disable-feature' : each.active === false}"> {{ each.name }}
                </router-link>

                <a href="javascript:void(0)" v-if="each.routeName === ''" class="link border-radius-5"
                   :class="{'disable-feature' : each.active === false}"> {{ each.name }}
                </a>
            </template>


        </div>

    </div>
</template>

<script>

export default {

    props: {
        items: []
    },

    data() {
        return {
            sidebarActivation: false,
        }
    },
    mounted() {
    },
    methods: {
        sidebarToggler() {
            this.sidebarActivation = !this.sidebarActivation;
        },
    }
}
</script>
