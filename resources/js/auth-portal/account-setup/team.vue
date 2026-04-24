<template>
    <form class="account-setup" @submit.prevent="submitAccount">

        <!-- Next button -->
        <div class="manage-button">
            <button type="submit" :disabled="formData.team_size === ''"
                    :class="{'disabled':formData.team_size === ''}"
                    class="btn-theme padding-y-10 padding-x-12 w-110 h-45">
                <span class="btn-text">Next</span>
            </button>
        </div>

        <!-- Team size content -->
        <div class="account-setup-content padding-x-20">

            <div class="text-center margin-bottom-24 account-setup-sub-title">
                Account Setup
            </div>

            <div class="padding-top-24">
                <div class="text-center account-setup-title">
                    How big is your team size?
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="box-section margin-top-74">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center outer-box margin-x-10" @click="selectTeamSize(1)"
                             :class="{'selected': formData.team_size == '1', 'disabled':formData.team_size != '1' && formData.team_size != ''}">
                            <div class="icon-box">
                                <img :src="'/images/team/single.svg'" class="" alt="single.svg">
                            </div>
                            <div class="padding-top-18 padding-bottom-30 box-title">
                                Just 1
                            </div>
                        </div>
                        <div class="text-center outer-box margin-x-10" @click="selectTeamSize('2 to 5')"
                             :class="{'selected': formData.team_size == '2 to 5', 'disabled':formData.team_size != '2 to 5' && formData.team_size != ''}">
                            <div class="icon-box">
                                <img :src="'/images/team/two-to-five.svg'" class="" alt="two-to-five.svg">
                            </div>
                            <div class="padding-top-18 padding-bottom-30 box-title">
                                2 - 5
                            </div>
                        </div>
                        <div class="text-center outer-box margin-x-10" @click="selectTeamSize('6+')"
                             :class="{'selected': formData.team_size == '6+', 'disabled':formData.team_size != '6+' && formData.team_size != ''}">
                            <div class="icon-box">
                                <img :src="'/images/team/more-then-six.svg'" class="" alt="more-then-six.svg">
                            </div>
                            <div class="padding-top-18 padding-bottom-30 box-title">
                                6+
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <Footer class="padding-y-30"/>
    </form>
</template>

<script>
import Footer from "../../portal/pages/layout/includes/footer.vue";
import session from "../../services/session.js";

export default {
    data() {
        return {
            // Data properties for the component
            formData: {},
        }
    },
    components: {
        // Import Footer component
        Footer,
    },
    methods: {

        // Function of store data in session storage
        submitAccount() {
            if (this.formData.team_size === ''){
                return
            }
            // Convert the data to a JSON string before storing
            const jsonData = JSON.stringify(this.formData);

            // Store the JSON string in session storage
            session.setSession('accountInformation',jsonData)
            this.$router.push({name: 'BusinessLocation'})
        },

        // Retrieve data from session storage
        retrieveAccountData() {
            const storedDataJson = session.getSession('accountInformation')

            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                let data = JSON.parse(storedDataJson);
                if(data.team_size == null){
                    data.team_size = ''
                }
                this.formData = data


            }
        },

        // Function of select team size
        selectTeamSize(size) {
            if (this.formData.team_size == size) {
                this.formData.team_size = ''
            } else {
                this.formData.team_size = size
            }
        }

    },
    mounted() {
        // Lifecycle hook: Called after the component is mounted
        this.retrieveAccountData();

        // Checking if required data is not empty. if it's empty then it will redirect to previous page.
        if (this.formData.services === undefined || this.formData.services === null || this.formData.services === '') {
            this.$router.push({name: 'Service'})
        }
    }
}
</script>
