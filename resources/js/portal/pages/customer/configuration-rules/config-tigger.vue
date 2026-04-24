<template>

    <router-link :to="{name: 'ConfigChannel'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="container-fluid">

        <div class="mt-4 text-center">
            <div class="text-lighter">Appointment reminder automated message</div>
            <div class="font-size-28 fw-semibold padding-y-12">Set up automation rules</div>
            <div class="">Adjust when the message sends to your clients.
                <a href="javascript:void(0)" class="beauty-text-hover"> Learn more </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-6 col-xxl-4 p-3">
                <div class="p-3 border mb-4 rounded-3">
                    <div class="fw-semibold font-size-20 mb-3">
                        Trigger
                    </div>
                    Automatically sends to all clients ahead of their upcoming appointment.
                </div>
                <div class="p-3 border rounded-3">
                    <div class="fw-semibold font-size-20 mb-3">
                        Reminder timeframe
                    </div>
                    Choose how far in advance your automated messages are sent to clients.

                    <div class="mt-3 mb-2 fw-semibold">
                            Reminder advance notice
                    </div>
                        <select name="" class="form-select">
                            <option value="">2 hours</option>
                            <option value="">3 hours</option>
                            <option value="">24 hours</option>
                            <option value="">48 hours</option>
                            <option value="">72 hours</option>
                        </select>
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
