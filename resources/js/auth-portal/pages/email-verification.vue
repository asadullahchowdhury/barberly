<template>

    <!-- Route to go sign-in -->
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>

    <!-- Email verification show -->
    <div class="form-center">
        <div class="check text-center">
            <img :src="'/images/authentication/check.svg'" alt="check.svg">
        </div>
        <div class="title padding-top-20 padding-bottom-20">
            Email Address Verified!
        </div>
        <div class="form-section">
            <div class="subtitle">
                Thanks for verifying your email address. You can now go to Barberly and manage your business in one
                place.
            </div>
            <div class="form-group padding-bottom-16">
                <router-link :to="{name:'Sign-In'}" class="btn-theme btn-anchor w-100">
                    <span class="btn-text">
                        Go to Barberly
                    </span>
                </router-link>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    data() {

        return {

        }

    },

    mounted() {


    },

    methods: {

    }

}

</script>
