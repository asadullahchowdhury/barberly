<template>

    <div class="customer-review-wrapper">
        <div class="position-relative">
            <div class="background-back-size"></div>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-wrap padding-top-50 padding-top-sm-0">
            <div class="card-review">
                <div class="padding-15 padding-sm-25">
                    <div class="font-size-26 fw-semibold margin-bottom-20">Engage with your clients and keep them up to date
                    </div>
                    <div class="font-weight-400 margin-bottom-20">
                        Promote client loyalty and reduce no-shows with Barberly’s
                        <router-link :to="{name: 'CustomerAutoMatedMessage'}" class="beauty-text-hover">automated messages</router-link> . Once sent, notifications will appear here on the notifications page.
                    </div>
                    <div>
                        <div class="d-flex margin-bottom-16">
                            <img :src="`/images/portal/review-check.svg`" class="w-20 h-20 margin-right-10" alt="review-check">
                            <span>
                            Keep your clients up to date with reminders and updates to avoid no-shows
                        </span>
                        </div>

                        <div class="d-flex margin-bottom-16">
                            <img :src="`/images/portal/review-check.svg`" class="w-20 h-20 margin-right-10" alt="review-check">
                            <span>
                            Encourage client loyalty and increase reviews with post appointment thank you messages
                        </span>
                        </div>

                        <div class="d-flex margin-bottom-16">
                            <img :src="`/images/portal/review-check.svg`" class="w-20 h-20 margin-right-10" alt="review-check">
                            <span>
                            Ensure your messages are received by sending them over text, email and app notifications
                        </span>
                        </div>
                        <a href="javascript:void(0)" class="beauty-text-hover">
                            learn more
                        </a>
                    </div>
                </div>
            </div>

            <div class="customer-review-resources">
                <img :src="`/images/portal/message-screen.png`" class="review-image" alt="mobile-screen">
                <div class="position-absolute review-stars">
                    <img :src="`/images/portal/message-text.png`" class="review-image appointment-message" alt="message-text">
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    data(){

        return{}

    },

    mounted() {



    },

    methods: {



    }

}

</script>
