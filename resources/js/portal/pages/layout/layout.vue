<template>

    <div class="portal-layout">

        <!-- Side nav -->
        <Sidenav/>

        <!-- Side nav res -->
        <SideNavResponsive/>

        <div class="component-wrapper overflow-x-hidden">

            <!--header start-->
            <Header/>
            <!--header end  -->

            <!--pages start-->
            <router-view></router-view>
            <!--pages end  -->

        </div>

    </div>
</template>

<script>

/*components*/
import Header from "./includes/header.vue";
import Sidenav from "./includes/sidenav.vue";
import SideNavResponsive from "./includes/sidenav-responsive.vue";

export default {
    data() {
        return {
            core:window.core,
            sideNavActive: false,
        }
    },
    mounted() {
        if(this.core.UserInfo.company_id == null){
            window.location.href = '/portal/auth/account/setup';
        }
    },
    components: {
        Header,
        Sidenav,
        SideNavResponsive,
    },
}
</script>
