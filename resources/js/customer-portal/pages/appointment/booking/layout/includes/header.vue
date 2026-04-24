<template>
    <div class="">
        <!--header start-->
        <div class="appointment-header d-flex justify-content-between align-items-center py-3 px-4">
            <a href="javascript:void(0)" class="btn-icon width-50 height-50" @click="previousPage">
                <img :src="`/images/global/arrow-left.svg`" alt="close">
            </a>

            <!--           <div class="fw-semibold">Select Services</div>-->

            <a href="javascript:void(0)" class="btn-icon width-50 height-50" @click="cancel">
                <img :src="`/images/global/x.svg`" alt="close">
            </a>
        </div>
        <!--header end  -->
    </div>
</template>

<script>
import {useRoute} from "vue-router";

export default {
    data() {
        return {
            route: '',
            singleID: '',
        }
    },
    mounted() {
        if (window.history.state.id !== undefined || window.history.state.id !== null || window.history.state.id !== '') {
            this.singleID = window.history.state.id;
        }

        this.fixedHeader();
        this.route = useRoute();

    },
    methods: {
        /* Function to fixed header */
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.appointment-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        /*Function for previous page*/
        previousPage() {
            if (this.route.name === 'SelectServices') {
                this.$router.push({name: 'SalonSingle', params: {id: this.singleID}, state: {id: this.singleID}})

            } else if (this.route.name === 'SelectProfessional') {
                this.$router.push({name: 'SelectServices', state: {id: this.singleID}})

            } else if (this.route.name === 'selectDateTime') {
                this.$router.push({name: 'SelectProfessional', state: {id: this.singleID}})

            } else if (this.route.name === 'ConfirmAppointment') {
                this.$router.push({name: 'selectDateTime', state: {id: this.singleID}})
            }
        },
        cancel() {
            this.$router.push({name: 'SalonSingle', params: {id: this.singleID}, state: {id: this.singleID}})
        }
    }
}
</script>
