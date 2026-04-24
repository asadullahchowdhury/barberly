<template>
    <div>
        <!--Header-->
        <Header/>
        <!--Main page content-->
        <div class="row justify-content-center g-0">
            <div class="col-xxl-6 col-xl-8 col-lg-10 col-12">
                <div class="p-3">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '../layout/include/header.vue'

export default {
    components: {Header},
    setup() {
        return {}
    }
}
</script>
