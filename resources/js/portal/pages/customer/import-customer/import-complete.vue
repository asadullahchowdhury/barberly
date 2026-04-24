<template>

    <router-link :to="{name: 'Customer'}" class="btn-theme btn-anchor padding-x-40">
        Next Step
    </router-link>

    <div class="h-75 d-flex justify-content-center align-items-center">
        <div class="p-3 text-center">
            <div class="mb-3">
                <img :src="`/images/portal/check-circle-smooth.svg`" class="img-fluid w-90 h-90" alt="check-circle-smooth">
            </div>
            <div class="text-theme">
                Upload File Successfully
            </div>
            <div class="btn btn-loading mt-4 border-0">
                <span class="loading black"></span>
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
