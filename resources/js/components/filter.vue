<template>
    <div class="filter position-relative">
        <div class="each-filter" id="services">
            <a href="javascript:void(0)"
               class="btn btn-light btn-dark rounded-pill fw-semibold">Featured</a>

            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>
            <a href="javascript:void(0)" class="btn btn-light rounded-pill fw-semibold">Featured</a>

        </div>


        <div class="filter-controller position-absolute d-flex">
            <button type="button" class="btn btn-icon rounded-circle" id="left-button"
                    @click="filterScrollLeft">
                <img :src="`/images/global/chevron-left.svg`" alt="left">
            </button>

            <button type="button" class="btn btn-icon rounded-circle" id="right-button"
                    @click="filterScrollRight">
                <img :src="`/images/global/chevron-right.svg`" alt="right">
            </button>
        </div>

    </div>
</template>

<script>
export default {
    name:'Filter',
    data() {
        return {}
    },
    mounted() {
        this.filterScrollRight();
        this.filterScrollLeft();
    },
    methods:{
        filterScrollRight() {
            const rightBtn = document.querySelector('#right-button');
            rightBtn.addEventListener("click", function (event) {
                const conent = document.querySelector('#services');
                conent.scrollLeft += 300;
                event.preventDefault();
            });
        },

        filterScrollLeft() {
            const leftBtn = document.querySelector('#left-button');
            leftBtn.addEventListener("click", function (event) {
                const conent = document.querySelector('#services');
                conent.scrollLeft -= 300;
                event.preventDefault();
            });
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
