<template>
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <img :src="'/images/global/logo.svg'" alt="logo.png">
        <router-link :to="{name: 'Registration'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>
    <div class="title padding-top-56 padding-bottom-26">
        Verify your mobile number
    </div>
    <div class="form-center">

        <!-- Form action -->
        <form class="form-section" autocomplete="off">
            <div class="subtitle">
                To protect your account, we’ll send a text message with a 4-digit code to the mobile number
                below.
            </div>
            <div class="form-group padding-bottom-16">
                <label for="mobile_number" class="form-label">Mobile Number</label>
                <div class="mobile-content">
                    <div class="mobile-select">
                        <select class="form-select padding-left-18 padding-right-16" id="mobile_number"
                                autocomplete="false">
                            <option value="">+971</option>
                            <option value="">+880</option>
                            <option value="">+442</option>
                            <option value="">+932</option>
                            <option value="">+765</option>
                            <option value="">+321</option>
                            <option value="">+345</option>
                            <option value="">+678</option>
                        </select>
                    </div>
                    <input id="mobile_number" type="text" name="mobile_number"
                           placeholder="Enter your mobile number"
                           class="form-control mobile-input padding-left-20" autocomplete="off">
                </div>
            </div>
            <div class="form-group padding-bottom-16">
                <router-link :to="{name: 'Verification-code'}" class="btn-theme w-100">
                    <div class="btn-text">
                        Send Code
                    </div>
                </router-link>
            </div>
        </form>
    </div>
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
