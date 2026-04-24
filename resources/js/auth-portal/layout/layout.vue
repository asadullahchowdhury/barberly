<template>

    <!-- authentication section -->
    <section class="authentication" :style="{ backgroundImage: 'url(/images/authentication/auth-background.png)' }">
        <div class="content d-flex flex-column justify-content-between">
            <!--page content-->
            <div class="content-body-section">
                <router-view></router-view>
            </div>

            <!-- footer section -->
            <div class="content-footer-section">
                <div class="footer-section padding-top-20">
                    <div class="bottom-content">
                        <button class="btn-theme download-btn padding-left-34 padding-right-34 disable-feature">
                            <span class="btn-text">
                                Download App
                            </span>
                        </button>
                    </div>
                    <div class="flex-box padding-top-30 padding-bottom-30 disable-feature">
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

    components: {
    },


    data() {
        return {}
    },
    mounted() {
    }
}
</script>
