<template>
    <div class="professional">
        <!--Professionals-->
        <h3 class="fs-1 fw-bold title mb-3">Select professional</h3>

        <div class="row">
            <!--Any professional card-->
            <div class="col-md-4 col-sm-6  mb-4">
                <div class="card professional-card border-2"
                     :class="{'selected' : formData.professional === 0}" @click="selectProfessional(0)">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <div class="user-img my-3">
                            <img :src="`/images/global/user-group.svg`" width="32" height="32" alt="user-grp">
                        </div>

                        <p class="fw-semibold mb-0">Any professionals</p>
                        <p class="text-lighter small">for maximum availability</p>
                        <p>From 200 BDT</p>
                    </div>
                </div>
            </div>

            <!--Team cards-->
            <div class="col-md-4 col-sm-6  mb-4" v-for="each in [1,2,3,4,5]">
                <div class="card professional-card border-2" @click="selectProfessional(each)"
                     :class="{'selected' : formData.professional === each}">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <div class="user-img my-3">
                            <!--User image-->
                            <img class="user position-relative rounded-circle object-fit-cover"
                                 :src="`/images/home/customer/customer-image-01.jpg`"
                                 alt="team member">

                            <!--Rating-->
                            <div
                                class="members-rating px-2 border position-absolute bg-white rounded-pill d-flex align-items-center gap-">
                                5.0 <img :src="`/images/home/star.svg`" width="10" height="10" alt="star">
                            </div>

                        </div>

                        <p class="fw-semibold mb-0">Arch</p>
                        <p class="text-lighter small">Creative & Colour Director</p>
                        <p>200 BDT</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            formData: {
                professional: 0
            },
        }
    },
    mounted() {
    },

    methods: {
        /*Function for selection*/
        selectProfessional(professional) {
            this.formData.professional = professional;
        }
    }
}
</script>
