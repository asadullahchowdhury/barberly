<template>

    <div class="container-fluid" v-if="favorite === 'no-data'">
        <div class="content-wrapper justify-content-center align-items-center flex-column card-content">
            <div>
                <div class="text-center">
                    <img :src="`/images/home/find-salon.svg`" class="w-64 h-64 mb-3" alt="find-salon">
                    <div class="fs-4 fw-bold mb-3">No favorites yet</div>
                    <div class="text-secondary mb-3">
                        Your favorites list is empty. Let's fill it up!
                    </div>
                    <router-link :to="{name: 'Address'}" class="btn btn-theme px-4">
                        Find salon near you
                    </router-link>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin-top-110" v-if="favorite === 'has-data'">
        <div class="pt-4">
            <router-link :to="{name: 'Home'}">
                <img :src="`/images/portal/arrow-left.svg`" class="w-24 h-24" alt="arrow-right">
            </router-link>
            <div class="mt-3 fs-4 fw-bold">
                My favorite
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            <div class="p-3">
                <div class="card p-0 border rounded-2 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="position-relative">
                            <div class="position-absolute top-0 end-0 pt-3 pe-3">
                                <button type="button" class="btn border-0 p-0" @click="heartClickManage">
                                    <img :src="`/images/home/heart.svg`" class="w-23 h-23" alt="heart" v-if="heartClick === false">
                                    <img :src="`/images/home/heart-red.svg`" class="w-23 h-23" alt="heart-red" v-if="heartClick === true">
                                </button>
                            </div>
                        </div>
                        <img :src="`/images/home/post/post-01.jpg`" class="img-fluid w-100" alt="">
                        <div class="p-3">
                            <div class="fs-4 fw-bold">
                                Decadence hair and beauty
                            </div>
                            <div class="mb-2">
                                <router-link :to="{name: 'Appointments'}" class="text-decoration-none text-secondary text-opacity-75 fw-semibold">
                                    36 store, St, London, England
                                </router-link>
                            </div>
                            <div class="d-flex align-items-center fw-bold">
                                <img :src="`/images/portal/star-golden.svg`" class="img-fluid w-24 h-24 me-1" alt="star-gold">
                                5.0
                                <span class="text-secondary text-opacity-75 ms-2">
                                    1809
                                </span>
                            </div>
                            <div class="badge bg-theme-opacity text-theme shadow-sm mt-3">
                                Featured
                            </div>
                        </div>
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
            favorite: 'has-data',
            heartClick: false,
        }

    },

    mounted() {



    },

    methods: {

        heartClickManage() {
            this.heartClick = !this.heartClick;
        }

    }

}

</script>
