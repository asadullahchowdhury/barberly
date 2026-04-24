<template>

    <div class="container-fluid">
        <div class="content-wrapper justify-content-center align-items-center flex-column card-content">
            <div>
                <div class="text-center">
                    <img :src="`/images/home/gift-card.svg`" class="w-64 h-64 mb-3" alt="membership">
                    <div class="fs-4 fw-bold mb-3">
                        You have no active gift cards
                    </div>
                    <div class="text-secondary text-opacity-75">
                        Find salons to buy a gift card or book a service.
                    </div>
                    <router-link :to="{name: 'Address'}" class="btn btn-theme px-4 mt-3">
                        Find salons near you
                    </router-link>
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
