<template>
    <div class="deal-type">
        <!--Header text-->
        <div class="text-center mb-3">
            <p class="text-muted mb-1">Create a deal</p>
            <h3 class="fs-4 fw-semibold">Select deal type</h3>
            <p class="mb-0">Choose the type of deal you want to create.
                <a href="javascript:void(0)" class="underline-anim text-theme">Learn more</a>
            </p>
        </div>

        <!--Deal type list start-->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-12">
                <!--Promotion deal-->
                <div
                    class="each-deal-box h-120 mb-3 border p-md-4 p-3 rounded-3 d-flex justify-content-between align-items-center"
                    :class="{'selected' : formData.type === 'promotion'}" @click="selectDeal('promotion')">
                    <div class="content flex-grow-1">
                        <h5 class="fw-semibold mb-1">Promotion</h5>
                        <p class="text-muted mb-0 text-break lh-sm text-ellipsis2">
                            Create a discount redeemed by clients entering the code when booking online or
                            during checkout at Point of Sale
                        </p>
                    </div>
                    <div class="icon ps-md-4 ps-3 p-2">
                        <img class="w-32 h-32" :src="`/images/portal/promotion.svg`" alt="promotion">
                    </div>

                    <!--If selected check icon-->
                    <img v-if="formData.type === 'promotion'" class="selected-icon w-20 h-20"
                         :src="`/images/portal/check.png`" alt="check">

                </div>

                <!--flash sale deal-->
                <div
                    class="each-deal-box h-120 mb-3 border p-md-4 p-3 rounded-3 d-flex justify-content-between align-items-center"
                    :class="{'selected' : formData.type === 'flash_sale'}" @click="selectDeal('flash_sale')">
                    <div class="content flex-grow-1">
                        <h5 class="fw-semibold mb-1">Flash Sale</h5>
                        <p class="text-muted mb-0 text-break lh-sm text-ellipsis2">
                            Immediately apply a discount online and let your team members manually add it to
                            appointments and sales
                        </p>
                    </div>
                    <div class="icon ps-md-4 ps-3 p-2">
                        <img class="w-32 h-32" :src="`/images/portal/flash-sale.svg`" alt="flash sale">
                    </div>

                    <!--If selected check icon-->
                    <img v-if="formData.type === 'flash_sale'" class="selected-icon w-20 h-20"
                         :src="`/images/portal/check.png`" alt="check">

                </div>

                <!--last minute deal-->
                <div
                    class="each-deal-box h-120 mb-3 border p-md-4 p-3 rounded-3 d-flex justify-content-between align-items-center"
                    :class="{'selected' : formData.type === 'last_minute'}" @click="selectDeal('last_minute')">
                    <div class="content flex-grow-1">
                        <h5 class="fw-semibold mb-1">Last minute offer</h5>
                        <p class="text-muted mb-0 text-break lh-sm text-ellipsis2">
                            Apply a discount for bookings made just before an appointment starts
                        </p>
                    </div>
                    <div class="icon ps-md-4 ps-3 p-2">
                        <img class="w-32 h-32" :src="`/images/portal/timer.svg`" alt="timer">
                    </div>

                    <!--If selected check icon-->
                    <img v-if="formData.type === 'last_minute'" class="selected-icon w-20 h-20"
                         :src="`/images/portal/check.png`" alt="check">

                </div>

            </div>
        </div>

        <!--Deal type list end  -->
    </div>
</template>

<script>
import session from "../../../../services/session.js";

export default {
    data() {
        return {
            formData: {
                name: '',
                type: 'promotion',
                description: '',
                gift_card: 1,
                start_date: '',
                end_date: '',
                promotion_value: 10,
                promotion_type: '%',
                check_limit_per_client: 1,
                limit_uses: 1,
                set_minimum_amount: 2,
                minimum_amount: 100,
                enable_point_of_sale: 1,
                enable_discount: 2,
                discount_code: '',
                appointment_time: 1,
                appointment_type: 2,
                services: [],
                products: [],
                members: [],
                memberships: [],
            }
        }
    },

    mounted() {
        this.retrieveDealsData();
    },

    methods: {
        selectDeal(type) {
            this.formData.type = type;
            this.submitAccount();
        },

        // Function to retrieve/get data from session storage
        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            } else {
                this.submitAccount();
            }
        },

        // Function to store data in session storage
        submitAccount() {
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('dealData', jsonData)
        },

    }
}
</script>

