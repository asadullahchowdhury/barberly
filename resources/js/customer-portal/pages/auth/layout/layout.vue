<template>

    <div style="background-image: url('/images/authentication/auth-background.png')" class="img-fluid w-100 vh-100 customer-authentication-background">

        <div class="container-fluid customer-authentication">

            <div class="row">

                <div class="form-content-section d-flex align-items-center justify-content-between flex-column pb-3 pt-3 pt-sm-5 overflow-y-scroll vh-100 effect">

                    <router-view/>

                    <section class="disable-feature">
                        <div class="text-center mb-3">
                            <a href="javascript:void(0)" class="btn btn-theme px-5">
                                Download
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)" class="text-decoration-none text-theme mx-2 d-flex align-items-center">
                                <img :src="'/images/authentication/frame.png'" class="me-2" alt="frame"> English
                            </a>
                            <a href="javascript:void(0)" class="text-decoration-none text-theme mx-2 d-flex align-items-center">
                                <img :src="'/images/authentication/support.png'" class="me-2" alt="support"> Support
                            </a>
                            <a href="javascript:void(0)" class="text-decoration-none text-theme mx-2">
                                Privacy & Policy
                            </a>
                        </div>
                    </section>

                </div>

            </div>

        </div>

    </div>

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
