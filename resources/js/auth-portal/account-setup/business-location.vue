<template>
    <form class="account-setup" v-if="!loading" @submit.prevent="submitAccount()">

        <!-- Next Button -->
        <div class="manage-button">
            <button type="submit"
                    class="btn-theme padding-y-10 padding-x-12 w-110 h-45">
                <span class="btn-text">Next</span>
            </button>
        </div>

        <!-- Business location content -->
        <div class="account-setup-content padding-x-20">

            <div class="text-center margin-bottom-24 account-setup-sub-title">
                Account Setup
            </div>
            <div class="padding-top-24 padding-bottom-43">
                <div class="text-center account-setup-title">
                    Where is your business located?
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="form-section">

                    <!-- Full address -->
                    <div class="form-group padding-bottom-31">
                        <label for="" class="form-label">Business Address</label>

                        <input type="text" id="google_autocomplete" v-model="formData.address" name="address"
                               :class="{'is-invalid-custom' : error}"
                               class="form-control" placeholder="Start typing to search your address"
                               v-if="formData.is_physical == 1">

                        <div class="error-report" v-if="error && this.formData.is_physical == 1 ">Address is required.</div>

                        <input type="text" name="address" class="form-control" placeholder="Mobile and Online Only"
                               :class="{'is-invalid-custom' : error}"
                               v-model="formData.address" v-if="formData.is_physical == 2">

                        <div class="error-report" v-if="error && this.formData.is_physical == 2 ">Mobile and online field is required.</div>

                    </div>

                    <!-- Template where full details from google auto complete -->
                    <template v-if="formData.is_physical == 1 && fullAddress">
                        <div class="form-group padding-bottom-31">
                            <label for="" class="form-label">Address</label>
                            <h5>{{ formData.address }}</h5>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between">

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="apartment" class="form-label">Apartment/Suite/Shop</label>

                                <input id="apartment" type="text" name="apartment" class="form-control"
                                       v-model="formData.apartment">

                            </div>

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="district" class="form-label">District</label>

                                <input id="district" type="text" name="district" class="form-control"
                                       v-model="formData.district">

                            </div>

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="city" class="form-label">City</label>

                                <input id="city" type="text" name="city" class="form-control" v-model="formData.city">

                            </div>

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="region" class="form-label">Region</label>

                                <input id="region" type="text" name="region" class="form-control"
                                       v-model="formData.region">

                            </div>

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="postcode" class="form-label">PostCode</label>

                                <input id="postcode" type="text" name="postcode" class="form-control"
                                       v-model="formData.postcode">

                            </div>

                            <div class="form-group padding-bottom-31 px-2 col-12 col-md-6">
                                <label for="country" class="form-label">Country</label>

                                <input id="country" type="text" name="country" class="form-control"
                                       v-model="formData.country">

                            </div>
                        </div>
                    </template>

                    <div class="form-group padding-bottom-31 d-flex justify-content-between">
                        <span>
                            No physical location (mobile and online services)
                        </span>
                        <span>
                            <div class="toggle">
                                <input type="checkbox" :checked="formData.is_physical == 2" @change="isPhysical()"/>
                                <label></label>
                            </div>
                        </span>
                    </div>

                    <!-- Google map -->
                    <div id="map"></div>

                </div>
            </div>
        </div>

        <!-- Footer Component -->
        <Footer class="padding-y-30"/>
    </form>

    <div class="account-complete" v-if="loading">
        <div class="step-finish">
            <img :src="'/images/global/logo.svg'" class="margin-bottom-30" alt="logo.svg">
            <div class="account-setup-sub-title text-center">
                Your portal is being setup.. please wait.
            </div>
        </div>
    </div>
</template>

<script>
import Footer from "../../portal/pages/layout/includes/footer.vue";
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
import session from "../../services/session.js";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    data() {
        return {
            // Data properties for the component
            placeholder: '',
            formData: {
                address: '',
                apartment: '',
                district: '',
                city: '',
                region: '',
                postcode: '',
                country: '',
            },
            addApartment: false,
            addDistrict: false,
            addCity: false,
            addRegion: false,
            addPostcode: false,
            addCountry: false,
            loading: false,
            fullAddress: false,
            error: false,
        }
    },
    components: {
        // Import Footer component
        Footer,
    },
    methods: {

        // Maintain show and hide google auto complete with reset data
        isPhysical() {
            this.error = false;
            if (this.formData.is_physical === 1) {
                this.formData.address = '';
                this.formData.apartment = '';
                this.formData.district = '';
                this.formData.city = ''
                this.formData.region = ''
                this.formData.postcode = ''
                this.formData.country = ''
                this.formData.is_physical = 2
                this.fullAddress = false;
            } else {
                this.initializeInput();
                this.formData.address = null;
                this.formData.is_physical = 1
            }
        },

        // Store data in session storage
        submitAccount() {
            this.error = false;
            if (this.formData.address === '' || this.formData.address === null) {
                return this.error = true;
            }else{
                apiService.ClearErrorHandler()
                this.loading = true;
                axios.post(apiRoutes.SetupAccount, this.formData, {headers: apiService.headerContent}).then((response) => {
                    this.loading = false;
                    toaster.info('Account setup completed')
                    sessionStorage.removeItem('accountInformation');
                    window.location.href = '/portal'
                }).catch(err => {
                    this.loading = false;
                    let res = err?.response;
                    if (res?.data?.errors !== undefined) {
                        apiService.ErrorHandler(res?.data?.errors);
                        toaster.error('Please correct all form errors.')
                    } else {
                        toaster.error('Server error!')
                    }
                })
            }
        },

        // Retrieve data from session storage
        retrieveAccountData() {
            const storedDataJson = session.getSession('accountInformation')

            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        },

        // Google auto complete function call from google
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                    this.formData.lat = place.geometry.location.lat()
                    this.formData.lng = place.geometry.location.lng()
                    this.formData.address = place.formatted_address
                    let addressComponents = place.address_components;
                    for (let component of addressComponents) {
                        if (component.types.includes('administrative_area_level_1')) {
                            this.formData.district = component.long_name;
                        }
                        if (component.types.includes('locality')) {
                            this.formData.city = component.long_name;
                        }
                        if (component.types.includes('postal_code')) {
                            this.formData.post_code = component.long_name;
                        }
                        if (component.types.includes('country')) {
                            this.formData.country = component.long_name;
                        }
                    }
                    this.fullAddress = true;
                })
            }, 1000)
        },

    },
    mounted() {
        // Lifecycle hook: Called after the component is mounted
        this.retrieveAccountData()
        this.initializeInput()
        // Checking if required data is not empty. if it's empty then it will redirect to previous page.
        if (this.formData.team_size === undefined || this.formData.team_size === null || this.formData.team_size === '') {
            this.$router.push({name: 'TeamSize'})
        }
    }
}
</script>
`
