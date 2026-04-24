<template>
    <div class="confirm-booking">

        <!--confirm booking-->
        <h3 class="fs-1 fw-bold title mb-4">Is this your first visit to Decadence Hair and Beauty?</h3>

        <div class="row">
            <div class="col-12">
                <!--Yes-->
                <div class="card card-confirmation mb-3 w-75 px-2 border-2" @click="formData.visited = 1"
                     :class="{'border-theme' : formData.visited === 1}">
                    <div class="card-body">
                        <p class="fw-semibold mb-0">Yes</p>
                        <p class="text-lighter mb-0">This is my first visit</p>
                    </div>
                </div>

                <!--No-->
                <div class="card card-confirmation mb-3 w-75 px-2 border-2" @click="formData.visited = 2"
                     :class="{'border-theme' : formData.visited === 2}">
                    <div class="card-body">
                        <p class="fw-semibold mb-0">No</p>
                        <p class="text-lighter mb-0">I've visited before.</p>
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
                visited: null,
            },

        }
    },
    mounted() {
    },
    methods: {
    }
}
</script>
