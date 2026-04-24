<template>

    <router-link :to="{name: 'ConfigDone'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="container-fluid">

        <div class="mt-4 text-center">
            <div class="text-lighter">Appointment reminder automated message</div>
            <div class="font-size-28 fw-semibold padding-y-12">Select channels</div>
            <div class="">Choose how the automated message should be sent to your clients.
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-6 col-xxl-4 p-3">
                <div class="row m-0 border rounded-3 overflow-hidden">
                    <div class="col-md-6 bg-light d-flex align-items-center justify-content-center">
                        <img :src="`/images/portal/mobile-message.svg`" class="img-fluid" alt="mobile-message">
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="font-size-20 fw-semibold">Email</div>
                            <span>
                                <div class="toggle">
                                    <input type="checkbox"/>
                                    <label></label>
                                </div>
                            </span>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-50 px-2 py-1">
                                Free
                            </span>
                        </div>
                        <div class="mt-3">
                            Send this automated message via email. Customise your email with important information for clients.
                        </div>
                        <button type="button" class="btn w-100 btn-white has-border mt-4">
                            Preview and edit
                        </button>
                    </div>
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
