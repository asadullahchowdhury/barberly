<template>

    <router-link :to="{name: 'CalendarSync'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="text-center">
        <div class="padding-top-24 text-lighter">Set up</div>
        <div class="font-size-28 font-weight-900 padding-y-24">Choose which calendar you would like to sync</div>
        <div class="font-size-16 font-weight-400">Sync your Google calendar or block out your barberly appointments on other calendars. Learn more</div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="sync-calendar-body padding-y-34">
            <button type="button" class="btn btn-check d-flex align-items-center padding-x-25 padding-y-12">
                <span class="check">
                    <img :src="`/images/portal/check.png`" class="w-20 h-20" alt="check-circle">
                </span>
                <img :src="`/images/portal/google.png`" class="margin-right-20" alt="google">
                Google calendar
            </button>
            <button type="button" class="btn btn-check d-flex align-items-center padding-x-25 padding-y-12 margin-top-24">
                <span class="check">
                    <img :src="`/images/portal/check.png`" class="w-20 h-20" alt="check-circle">
                </span>
                <img :src="`/images/portal/calendar.svg`" class="margin-right-20" alt="calendar">
                Others Calendar
            </button>
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
