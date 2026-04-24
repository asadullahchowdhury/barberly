<template>

    <router-link :to="{name: 'CalendarExportType'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="text-center">
        <div class="padding-top-24 text-lighter">Set up</div>
        <div class="font-size-28 font-weight-900 padding-y-24">Choose how you want to sync your calendar</div>
        <div class="font-size-16 font-weight-400">Sync events from your external calendar to barberly or vice versa.</div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="sync-calendar-body padding-y-34">
            <button type="button" class="btn btn-check d-flex align-items-center justify-content-between padding-x-25 padding-y-12">
                <span class="check">
                    <img :src="`/images/portal/check.png`" class="w-20 h-20" alt="check-circle">
                </span>
                <div class="text-start">
                    <div class="font-weight-800">Export your barberly calendar</div>
                    <div class="font-weight-400">Copy a link to add to your external calendar</div>
                </div>
                <img :src="`/images/portal/calendar-right-arrow.svg`" class="w-40 h-40" alt="calendar-right-arrow">
            </button>
            <button type="button" class="btn btn-check d-flex align-items-center justify-content-between padding-x-25 padding-y-12 margin-top-24">
                <span class="check">
                    <img :src="`/images/portal/check.png`" class="w-20 h-20" alt="check-circle">
                </span>
                <div class="text-start">
                    <div class="font-weight-800">Export your barberly calendar</div>
                    <div class="font-weight-400">Copy a link to add to your external calendar</div>
                </div>
                <img :src="`/images/portal/calendar-right-arrow.svg`" class="w-40 h-40" alt="calendar-right-arrow">
            </button>
        </div>
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
