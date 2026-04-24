<template>
    <div class="d-flex justify-content-center flex-column align-items-center no-data">

        <!--Icon-->
        <img :class="icon" class="img-fluid w-32 h-32 mb-4" alt="no data">

        <!--Title-->
        <div class="fw-semibold mb-2">There are currently no {{ title }}</div>

        <!--Subtitle-->
        <div class="text-lighter" v-if="sub_title !== ''">{{ sub_title }}</div>

        <!--Button-->
        <button type="button" class="btn btn-theme mt-3 px-5" v-if="btn" @click="newHandler()">
            {{ btn_title }}
            <img v-if="plusIcon" :src="`/images/portal/plus-white.svg`" class="w-15 h-15 ms-2"
                 alt="plus-white">
        </button>
    </div>
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: 'no-data'
        },
        plusIcon: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: '...'
        },
        sub_title: {
            type: String,
            default: ''
        },
        btn_title: {
            type: String,
            default: ''
        },
        btn: {
            type: Boolean,
            default: false
        },
        url: {
            type: String,
            default: ''
        },
        params: {},
        state: {},
    },


    data() {
        return {}
    },
    mounted() {
    },
    methods: {
        newHandler() {
            this.$emit('handler');
        }
    }
}
</script>
