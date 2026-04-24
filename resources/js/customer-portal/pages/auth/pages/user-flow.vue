<template>

    <section class="form-section">

        <!-- Route to back home -->
        <router-link :to="{name: 'Home'}" class="arrow-btn">
            <img :src="`/images/authentication/arrow-left.png`" alt="arrow-left">
        </router-link>

        <!-- Title -->
        <div class="text-center mt-4 h4 text-brand-dark-grey fw-semibold">
            Sign up / Log in
        </div>

        <!-- route to go customer sign in page -->
        <div class="mt-5">
            <router-link :to="{name: 'Sign-In'}" class="text-dark fw-semibold text-decoration-none w-100 user-flow-btn border border-secondary-subtle rounded-3 d-flex justify-content-between align-items-center px-2">
                <div class="p-3">
                    <div>For everyone</div>
                    <div>Book salon and spas near you</div>
                </div>
                <div class="p-3 d-none d-sm-inline-block">
                    <img :src="`/images/portal/arrow-right.svg`" class="w-24 h-24" alt="arrow-right">
                </div>
            </router-link>
        </div>

        <!-- route to go portal sign in page -->
        <div class="mt-3">
            <a href="/portal/auth/" class="text-dark fw-semibold text-decoration-none w-100 user-flow-btn border border-secondary-subtle rounded-3 d-flex justify-content-between align-items-center px-2">
                <div class="p-3">
                    <div>For business</div>
                    <div>Manage and grow your business</div>
                </div>
                <div class="p-3 d-none d-sm-inline-block">
                    <img :src="`/images/portal/arrow-right.svg`" class="w-24 h-24" alt="arrow-right">
                </div>
            </a>
        </div>

    </section>

</template>

<script>

export default {

    data() {
        return {}
    },

    mounted() {  },

    methods: {  }

}

</script>
