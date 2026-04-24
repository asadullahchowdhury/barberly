<template>

    <router-link :to="{name: 'CustomerAutoMatedMessage'}" class="btn-theme btn-anchor padding-x-40">
        Done
    </router-link>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 p-3">
                <div class="mt-5 text-center">
                    <img :src="`/images/portal/check-circle-smooth.svg`" class="img-fluid w-120 h-120" alt="ok">
                </div>
                <div class="mb-3 text-center font-size-22 d-flex justify-content-center">
                    <div class="col-12 col-sm-8">
                        Your 3 hour appointment reminder automated message is setup
                    </div>
                </div>
                <div class="p-3 bg-light rounded-3">
                    <div class="fw-semibold">
                        Automated message details
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <img :src="`/images/portal/check-circle-smooth.svg`" class="img-fluid w-24 h-24 me-3" alt="check-circle-smooth">
                        automatically sends to all clients 3 hours ahead of their upcomming appointment
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <img :src="`/images/portal/announce.svg`" class="img-fluid w-24 h-24 me-3" alt="announce">
                        send by email
                    </div>
                    <div class="mt-3 d-flex align-items-center">
                        <img :src="`/images/portal/calendar-theme.svg`" class="img-fluid w-24 h-24 me-3" alt="calendar">
                        <span>
                            Clients who book their own appointments online may still receive messages.
                            <a href="javascript:void(0)" class="text-theme text-decoration-none">Learn more</a>
                        </span>
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
