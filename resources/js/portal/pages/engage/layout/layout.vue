<template>
    <div class="engage-layout">
        <sidebar/>

        <div class="engage-main-body">
            <router-view/>
        </div>
    </div>
</template>

<script>
import Sidebar from "../layout/include/sidebar.vue"

export default {
    data() {
        return {}
    },
    components: {
        Sidebar
    }
}
</script>
