<template>

    <!-- Account Setup Form -->
    <form class="account-setup">

        <!-- Next Button -->
        <div class="manage-button">
            <button type="button" :disabled="formData?.business_name?.length < 3 || url" @click="submitAccount"
                    :class="{'disabled':formData?.business_name?.length < 3 || url}"
                    class="btn-theme padding-y-10 padding-x-12 w-110 h-45">
                <span class="btn-text">Next</span>
            </button>
        </div>

        <!-- Account setup content -->
        <div class="account-setup-content padding-x-20">

            <div class="text-center margin-bottom-24 account-setup-sub-title">
                Account Setup
            </div>

            <!-- Business Name Section -->
            <div class="account-setup-title text-center margin-bottom-12">
                Enter your business name
            </div>

            <div class="d-flex justify-content-center">

                <div class="form-section">

                    <!-- Information text -->
                    <div class="text-center account-setup-sub-title margin-bottom-43">
                        This is the brand name your clients will see. Your billing and legal name can be added
                        later.
                    </div>

                    <!-- Business Name Input -->
                    <div class="form-group margin-bottom-43">
                        <label for="business_name" class="form-label">Business Name <span
                            class="text-danger">*</span></label>
                        <input type="text" name="business_name" id="business_name" class="form-control"
                               :class="{'is-invalid-custom' : nameError}"
                               v-model="formData.business_name"
                               placeholder="Enter business name">
                        <div class="error-report" v-if="nameError">The Business name field must be at least 3
                            characters.
                        </div>
                    </div>

                    <!-- Website Input -->
                    <div class="form-group margin-bottom-43">
                        <label for="website" class="form-label">Website <span>(optional)</span></label>
                        <input type="text" name="website" class="form-control" placeholder="https://www.yourwebsite.com"
                               @keypress="isURL(formData.website)" :class="{'is-invalid-custom' : url}"
                               v-model="formData.website">
                        <div class="error-report" v-if="url">Please enter a valid URL address.</div>
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
import isURL from "../../services/validation";
import session from "../../services/session.js";

export default {

    data() {

        return {
            // Data properties for the component
            step: 'enter-business-name',
            check: false,
            addApartment: false,
            addPostCode: false,
            formData: {
                business_name: '',
                website: '',
                services: '',
                address: '',
                apartment: '',
                district: '',
                city: '',
                region: '',
                postcode: '',
                country: '',
                team_size: '',
                is_physical: 1,
            },
            url: false,
            nameError: false,

        }

    },

    mounted() {
        // First input will be focused when the page loads
        document.getElementById('business_name').focus();

        // Lifecycle hook: Called after the component is mounted
        this.retrieveAccountData();

    },
    watch: {
        // Watcher for changes in the website input
        'formData.website'(newVal) {
            if (newVal === '') {
                this.url = false;
            }
        },
    },
    components: {
        // Import Footer component
        Footer
    },

    methods: {

        // Function to validate if the input is a valid URL
        isURL(str) {
            if (isURL.isURL(str)) {
                this.url = false
            } else {
                this.url = true
            }
        },

        // Function to store data in session storage
        submitAccount() {
            this.nameError = false;
            if (this.formData?.business_name?.length < 3) {
                this.nameError = true;
                return
            }
            if (this.url === true) {
                return
            }


            // Convert the data to a JSON string before storing
            const jsonData = JSON.stringify(this.formData);

            // Store the JSON string in session storage
            session.setSession('accountInformation', jsonData)

            // Navigate to the next page (Service)
            this.$router.push({name: 'Service'})

        },

        // Function to retrieve data from session storage
        retrieveAccountData() {
            const storedDataJson = session.getSession('accountInformation')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        }

    }

}

</script>
