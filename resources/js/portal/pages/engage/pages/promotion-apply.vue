<template>
    <div class="promotion-apply row justify-content-center">
        <div class="col-xl-8 col-md-10">
            <!--Header text-->
            <div class="text-center mb-3">
                <p class="text-muted mb-1">Create a deal</p>
                <h3 class="fs-4 fw-semibold">Choose how to apply this promotion</h3>
                <p class="mb-0">Choose how clients can get and apply this promotion.
                    <a href="javascript:void(0)" class="underline-anim text-theme">Learn more</a>
                </p>
            </div>
            <!--Form-->
            <form action="" @submit.prevent="submitAccount">
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-md-4 p-3">
                        <div class="toggle d-flex mb-1">
                            <input type="checkbox" :checked="formData.enable_point_of_sale === 1"
                                   @change="toggleSwitch('enable_point_of_sale')"/>
                            <label></label>
                            <div class="ms-3">Enable promotion at Point of Sale</div>
                        </div>
                        <p class="ps-5 ms-2 small text-muted">This allows you to apply this promotion manually during
                            checkout
                            at
                            Point of Sale.</p>

                        <div class="toggle d-flex mb-1">
                            <input type="checkbox" :checked="formData.enable_discount === 1"
                                   @change="toggleSwitch('enable_discount')"/>
                            <label></label>
                            <div class="ms-3">Enable discount code</div>
                        </div>
                        <p class="ps-5 ms-2 mb-0 small text-muted">
                            This promotion can be redeemed by clients entering the code when
                            booking or buying online.
                        </p>

                        <div class="row" v-if="formData.enable_discount === 1">
                            <div class="col-md-8">
                                <div class="form-data mt-4">
                                    <label for="" class="form-label fw-semibold">Discount code</label>
                                    <input type="text" class="form-control" placeholder="Enter a code, e.g. SALE10"
                                           name="discount_code"
                                           v-model="formData.discount_code">
                                    <div class="error-report"></div>
                                </div>
                                <p class="text-muted small">
                                    Tip: Create a catchy code using 4-20 capital letters and numbers.
                                </p>
                            </div>
                            <div class="col-12">
                                <div class="p-3 bg-theme-opacity d-flex justify-content-between align-items-center">
                                    <img class="w-20 h-20 me-3" :src="`/images/portal/light.svg`" alt="">
                                    <p class="mb-0 lh-sm">
                                        <strong>Discount codes only available for services and products.</strong>
                                        Clients cannot apply discount codes when buying memberships or gift cards
                                        online.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-theme px-5">Next step</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
import session from "../../../../services/session.js";

export default {
    data() {
        return {
            formData: {},
        }
    },
    mounted() {
        this.retrieveDealsData();
    },
    methods: {

        /*toggle switch*/
        toggleSwitch(type) {
            this.formData[type] = this.formData[type] == 1 ? 2 : 1;
        },

        // Function to retrieve/get data from session storage
        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        },

        // Function to store data in session storage
        submitAccount() {
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('dealData', jsonData)
            this.$router.push({name: 'SelectTeam'})
        },

    }
}
</script>

