<template>
    <div class="sync-calendar-header padding-x-20 d-flex align-items-center">
        <router-link :to="{name: 'Workspaces'}" class="sync-close-btn">
            <img :src="`/images/global/x.svg`" class="close-btn" alt="close btn">
        </router-link>
        <div class="vr margin-x-10" v-if="$route.name === 'CalendarSync' || $route.name === 'CalendarExportType'"></div>
        <span v-if="$route.name === 'CalendarSync'">
            <router-link :to="{name: 'CalendarChoose'}" class="padding-x-20 padding-y-20 sync-back-btn text-decoration-none text-theme">
                Previous
            </router-link>
        </span>
        <span v-if="$route.name === 'CalendarExportType'">
            <router-link :to="{name: 'CalendarSync'}" class="padding-x-20 padding-y-20 sync-back-btn text-decoration-none text-theme">
                Previous
            </router-link>
        </span>
    </div>
    <div class="gradient" :class="$route.name === 'CalendarChoose' ? 'progress-33' : '' || $route.name === 'CalendarSync' ? 'progress-66' : '' || $route.name === 'CalendarExportType' ? 'progress-100' : '' "></div>
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
