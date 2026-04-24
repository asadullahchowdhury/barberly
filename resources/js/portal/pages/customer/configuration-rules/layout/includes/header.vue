<template>
    <div class="import-customer-header padding-x-20 d-flex align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <router-link :to="{name: 'CustomerAutoMatedMessage'}" class="sync-close-btn">
                <img :src="`/images/global/x.svg`" class="close-btn" alt="close btn">
            </router-link>
            <div class="vr margin-x-10" v-if="$route.name === 'ConfigChannel' || $route.name === 'ConfigDone'"></div>
            <span v-if="$route.name === 'ConfigChannel'">
            <router-link :to="{name: 'ConfigTigger'}"
                         class="padding-x-20 padding-y-20  sync-back-btn text-decoration-none">
                <span class="underline-anim text-theme">Previous</span>
            </router-link>
        </span>
        </div>
        <span v-if="$route.name === 'ConfigDone'">
            <router-link :to="{name: 'ConfigChannel'}"
                         class="padding-x-20 padding-y-20 sync-back-btn text-decoration-none text-theme">
                Previous
            </router-link>
        </span>
    </div>
    <div class="import-gradient"
         :class="$route.name === 'ConfigTigger' ? 'progress-33' : '' || $route.name === 'ConfigChannel' ? 'progress-66' : '' || $route.name === 'ConfigDone' ? 'progress-100' : '' "></div>
</template>

<script>

export default {

    data() {

        return {}

    },

    mounted() {

    },

    methods: {}

}

</script>
