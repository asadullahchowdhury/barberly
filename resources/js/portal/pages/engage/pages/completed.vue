<template>
    <div class="deal-completed h-600 row justify-content-center align-items-center">
        <div class="col-xl-8 col-md-10">

            <!--Header text-->
            <div class="text-center mb-3">
                <img class="w-120 h-120 mb-3" :src="`/images/portal/check-circle.svg`" alt="check">
                <h3 class="fs-4 fw-semibold">Your
                    <span v-if="formData.type === 'promotion'">Promotion</span>
                    <span v-if="formData.type === 'flash_sale'">Flash Sale</span>
                    <span v-if="formData.type === 'last_minute'">Last minute offer</span>
                    is set!
                </h3>
            </div>

            <div class="card rounded-3 my-4">
                <div class="card-body p-md-4 p-3">
                    <label for="" class="fw-semibold form-label mb-3 text-capitalize">
                        <span v-if="formData.type === 'promotion'">Promotion</span>
                        <span v-if="formData.type === 'flash_sale'">Flash Sale</span>
                        <span v-if="formData.type === 'last_minute'">Last minute offer</span>
                        details</label>

                    <ul class="deal-info-list list-unstyled m-0 p-0">
                        <li class="mb-2 d-flex">
                            <img class="pe-2 w-30 h-30" :src="`/images/portal/tag-success.svg`" alt="tag">
                            <p class="mb-0"><span>{{ formData.promotion_value + formData.promotion_type }}</span>
                                discount on all services, all gift cards</p>
                        </li>

                        <li class="mb-2 d-flex">
                            <img class="pe-2 w-30 h-30" :src="`/images/portal/coupon-success.svg`" alt="coupon">
                            <p class="mb-0">
                                <span v-if="formData.type === 'promotion'">Promotion</span>
                                <span v-if="formData.type === 'flash_sale'">Flash Sale</span>
                                <span v-if="formData.type === 'last_minute'">Last minute offer</span>
                                can be redeemed at
                                <strong>Point of Sale</strong> <span
                                v-if="formData.enable_discount === 1">and by <strong>Discount code</strong></span>
                            </p>
                        </li>


                        <li class="mb-2 d-flex ">
                            <img class="pe-2 w-30 h-30" :src="`/images/portal/calendar-success.svg`" alt="calendar">
                            <p class="mb-0">
                                <span v-if="formData.type === 'promotion'">Promotion</span>
                                <span v-if="formData.type === 'flash_sale'">Flash Sale</span>
                                <span v-if="formData.type === 'last_minute'">Last minute offer</span>
                                applies to appointments and sales from
                                <strong>{{ formData.start_date }} and is <span
                                    v-if="formData.end_date !== ''">{{ formData.end_date }}</span><span
                                    v-if="formData.end_date === ''">ongoing</span></strong></p>
                        </li>

                    </ul>
                </div>

            </div>

            <!--Copy discount code-->
            <a href="javascript:void(0)" v-if="formData.enable_discount === 1"
               @click="copyDiscountCode()"
               class="card mb-4 p-3 d-flex justify-content-between align-items-center flex-row text-decoration-none fw-semibold">
                Copy discount code
                <img class="w-24 h-24" :src="`/images/portal/coupon.svg`" alt="coupon">

                <input class="discount-code opacity-0 position-absolute" type="text" v-model="formData.discount_code">
            </a>

            <a href="javascript:void(0)" class="btn btn-theme w-100 mb-4" @click="routeToListPage">Done</a>

        </div>

    </div>
</template>

<script>
import session from "../../../../services/session.js";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left'
})


export default {
    data() {
        return {
            formData: {}
        }
    },
    methods: {
        routeToListPage() {
            sessionStorage.removeItem('dealData');
            this.$router.push({name: 'Deals'})
        },

        /* Function to retrieve/get data from session storage */
        retrieveDealsData() {
            const storedDataJson = session.getSession('dealData')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
                console.log(this.formData, 'fd')
            }
        },

        /*Function to copy the discount code to clipboard*/
        copyDiscountCode() {
            let input = document.querySelector('.discount-code')
            input.select();
            document.execCommand('copy');
            toaster.info('Discount code copied to clipboard')

        }

    },
    mounted() {
        this.retrieveDealsData();
    }
}
</script>

