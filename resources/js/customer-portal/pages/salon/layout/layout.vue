<template>
    <div>
        <Header/>
        <router-view/>
        <Footer/>
    </div>
</template>

<script>
import Header from '../layout/includes/header.vue'
import Footer from '../../../layout/includes/footer.vue'

export default {
    data() {
        return {
            route: null
        }
    },
    components: {Header, Footer},
    mounted() {
        this.route = this.$route
        this.handleFooter();
    },
    methods: {

        /* Function to handle footer show or not show */
        handleFooter() {
            let customerFooter = document.querySelector('.customer-footer');
            if(this.route.name === 'Profile') {
                customerFooter.classList.add('d-none')
            } else if(this.route.name === 'Appointments') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'Address') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'Favorites') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'Forms') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'Memberships') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'Orders') {
                customerFooter.classList.add('d-none')
            }else if(this.route.name === 'GiftCards') {
                customerFooter.classList.add('d-none')
            }
        }


    }
}
</script>
