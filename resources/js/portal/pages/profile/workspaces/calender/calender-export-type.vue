<template>

    <router-link :to="{name: 'Workspaces'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="text-center">
        <div class="padding-top-24 text-lighter">Set up</div>
        <div class="font-size-28 font-weight-900 padding-y-24">Export to other calendars</div>
        <div class="font-size-16 font-weight-400">Copy your unique link to export barberly appointments to other
            calendars.
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="sync-calendar-body padding-y-34">
            <div class="sync-card padding-20 padding-sm-10 border-radius-5">
                <div class="font-weight-22">
                    Copy calendar URL
                </div>
                <div class="padding-y-10">
                    <div class="position-relative">
                        <input type="text" name="calendar_url_link"  id="copy-id" value="https://calendar-export.barberly.com/c214f109-7c5e-406a-9825-e08d3e12a9f8" class="form-control" disabled>
                        <button type="button" class="position-absolute copy-icon" @click="copy">
                            <img :src="`/images/portal/copy.svg`" class="w-25 h-25" alt="copy">
                        </button>
                    </div>
                </div>
                <div class="padding-y-10">
                    <span class="padding-right-10">
                        Only applications you share this link with will have access to your barberly calendar. Read our guide
                        on where to find your external calendar settings
                    </span>
                    <a href="javascript:void(0)" class="text-theme text-decoration-none">here</a>
                </div>
            </div>
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

    methods: {
        copy(){
            let copyText = document.getElementById('copy-id')
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
        }
    }

}

</script>
