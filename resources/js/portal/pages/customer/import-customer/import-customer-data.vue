<template>

    <router-link :to="{name: 'ImportCustomerReviewColumn'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="text-center">
        <div class="padding-top-24 text-lighter">Import clients</div>
        <div class="font-size-28 fw-semibold padding-y-24">Upload file</div>
        <div class="font-size-16 font-weight-400">Upload a CSV file with your client data, or download and fill the template below.
            <a href="javascript:void(0)" class="beauty-text-hover"> Learn more </a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-4 pt-5">
            <div class="border p-4 text-center">
                <label for="upload-file" class="fw-bold text-theme py-5 bg-theme-opacity w-100 cursor-pointer">
                    <img :src="`/images/portal/upload-file.svg`" class="img-fluid w-45 h-45" alt="upload-file">
                    <div class="mt-3">
                        Upload CSV File
                    </div>
                    <input id="upload-file" type="file" name="" class="d-none" accept="application/vnd.ms-excel">
                </label>
                <div class="text-start mt-4">
                    Don’t have a file? Fill our template with your client information and upload.
                    <a href="javascript:void(0)" class="beauty-text-hover">Download template</a>
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
