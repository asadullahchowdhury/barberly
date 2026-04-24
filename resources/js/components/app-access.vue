<template>

    <div class="p-3 bg-theme-opacity vh-100">
        <div class="d-flex justify-content-center align-items-center flex-column bg-white shadow p-3 h-100">
            <img :src="icon" class="img-fluid w-300 h-auto" alt="icon">
            <div class="fs-5 text-center">
                {{message}}
            </div>
            <button type="button" class="btn btn-theme px-4 mt-4" v-if="btn" @click="newHandler()">
                {{ btn_title }}
            </button>
            <div class="mt-4 text-dark-gray">

            </div>
        </div>
    </div>

</template>

<script>

export default {

    props: {
        icon: {
            type: String,
            default: ''
        },
        message: {
            type: String,
            default: '',
        },
        btn: {
            type: String,
            default: false,
        },
        btn_title: {
            type: String,
            default: '',
        },
        sub_message: {
            type: String,
            default: '',
        }
    },
    data() {
        return {}
    },
    mounted() {},
    methods: {
        newHandler() {
            this.$emit('onClick');
        }
    }

}

</script>
