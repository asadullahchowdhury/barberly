<template>
    <div class="select-service">

        <!--Services start-->
        <h3 class="fs-1 fw-bold title mb-3">Services</h3>

        <Filter/>

        <!--Service list start-->
        <div class="service-list mt-4 mb-3">
            <a href="javascript:void(0)" v-for="each in [1,2,3,4,5,6,7,8,9,]"
               class="each-service p-3 border d-flex justify-content-between align-items-center w-100 rounded-3 text-decoration-none text-dark mb-3">
                <div class="">
                    <div class="">Deep Tissue Massage</div>
                    <div class="text-muted">30min - 2h</div>
                    <div class="mt-2">From 40$</div>
                </div>

                <a href="javascript:void (0)" class="btn btn-icon">
                    <img :src="`/images/global/plus.svg`" alt="plus">
                </a>
            </a>


        </div>
        <!--Service list end  -->
        <!--Services end  -->

    </div>
</template>

<script>
import Filter from "../../../../../components/filter.vue";

export default {
    components: {Filter},
    data() {
        return {
        }
    },
    mounted() {
    }
}
</script>
