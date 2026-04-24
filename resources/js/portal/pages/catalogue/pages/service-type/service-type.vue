<template>
    <div class="service-type">
        <!--header start-->
        <div class="catalogue-header d-flex justify-content-end">
            <router-link :to="{name:'Services'}" href="javascript:void(0)" class="close-btn">
                <img :src="`/images/global/x.svg`" alt="close">
            </router-link>
        </div>
        <!--header end  -->

        <div class="d-flex justify-content-center align-items-center margin-top-100">
            <!--service type box start-->
            <div class="service-type-content-box d-flex justify-content-center align-items-center flex-column">
                <h3 class="mb-4">Choose a service type</h3>

                <!--single service box start-->
                <router-link :to="{name:'ServiceCreate',state:{id:category_id, module_name:module}}"
                             class="card service-card d-flex justify-content-between flex-row align-items-center rounded-3 mb-3 mt-2 text-decoration-none">
                    <div class="content">
                        <div class="title fw-semibold">Single Service</div>
                        <div class="sub text-muted">Services which can be booked individually</div>
                    </div>
                    <span class="icon ps-4">
                        <img class="img-fluid" :src="`/images/portal/service-file.svg`" alt="file">
                    </span>
                </router-link>
                <!--single service box end  -->

                <!--package service box start-->
                <a href="javascript:void(0)"
                   class="card service-card disable-feature d-flex justify-content-between flex-row align-items-center rounded-3 text-decoration-none">
                    <div class="content">
                        <div class="title fw-semibold">Package</div>
                        <div class="sub text-muted">Services which can be booked individually</div>
                    </div>
                    <span class="icon ps-4">
                        <img class="img-fluid" :src="`/images/portal/service-box.svg`" alt="box">
                    </span>
                </a>
                <!--package service box end  -->

            </div>
            <!--service type box end  -->
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            category_id: '',
            module: '',
        }
    },
    mounted() {
        this.category_id = window.history.state.id;
        this.module = window.history.state.module_name;

    }
}
</script>
