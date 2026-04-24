<template>
    <!-- authentication section -->
    <section class="authentication" :style="{ backgroundImage: 'url(/images/email/invitation-layout-cover.jpg)' }">
        <div class="content d-flex flex-column justify-content-between invitation">
            <!--page content-->
            <div class="content-body-section">
                <router-view></router-view>
            </div>

            <!-- footer section -->
            <div class="content-footer-section">
                <div class="footer-section padding-top-20">
                    <div class="bottom-content">
                        <a href="javascript:void(0)" >
                            <img :src="`/images/global/logo.svg`" alt="logo" >
                        </a>
                    </div>
                    <div class="flex-box padding-top-20 padding-bottom-20 disable-feature">

                        <!-- language -->
                        <a href="javascript:void(0)" class="flex-content padding-x-7 padding-sm-x-10">
                            <img :src="'/images/authentication/frame.png'" alt="frame"> English
                        </a>
                        <a href="javascript:void(0)" class="flex-content padding-x-7 padding-sm-x-10">
                            <img :src="'/images/authentication/support.png'" alt="support"> Support
                        </a>
                        <a href="javascript:void(0)" class="flex-content padding-x-7 padding-sm-x-10">
                            Privacy & Policy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    data() {
        return {}
    },
    mounted() {
    }
}
</script>
