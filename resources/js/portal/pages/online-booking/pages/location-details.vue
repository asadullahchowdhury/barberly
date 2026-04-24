<template>

    <div class="p-1 mb-3">
        <div class="h3 fw-semibold text-center">
            Add your business info
        </div>

        <div class="mt-3 text-center d-block">
            Add key details about your business to display on your online booking profile.
        </div>

        <!--Business info header-->
        <div class="mt-3 border p-3 rounded-3">
            <div class="d-flex justify-content-start align-items-center">
                <img v-if="formData.photoPath !== ''"
                     :src="'/storage/media/image/'+formData.photoPath"
                     class="w-64 h-64 object-fit-cover rounded-3" alt="avatar">
                <div v-if="formData.photoPath === ''"
                     class="theme-badge w-64 h-64 rounded-3 border-0 d-flex align-items-center justify-content-center">
                    <img :src="`/images/portal/workshop.svg`" class="w-24 h-24"
                         alt="avatar">
                </div>
                <div class="ms-3">
                    <div class="fw-semibold d-block">
                        <span v-if="formData.location_name !== ''">{{ formData.location_name }}</span>
                        <span v-if="formData.location_name === ''">N/A</span>
                    </div>
                    <div class="text-secondary d-block">
                        <span v-if="formData.address !== null || formData.address !== ''">{{ formData.address }}</span>
                        <span v-if="formData.address === null || formData.address === ''">N/A</span>
                    </div>
                </div>
            </div>
        </div>

        <!--location details form-->
        <form class="mt-3 border p-3 rounded-3" @submit.prevent="submitAccount">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="location-name" class="form-label">Location name</label>
                        <input id="location-name" type="text" name="location-name" class="form-control"
                               :class="{'is-invalid-custom' : errors.location_name}"
                               autocomplete="new-location-name" placeholder="Enter profile location name"
                               v-model="formData.location_name">
                        <div v-if="errors.location_name" class="error-report">{{ errors.location_name }}</div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="location-phone-number" class="form-label">Location phone number</label>
                        <input id="location-phone-number" type="text" name="location-phone-number" class="form-control"
                               :class="{'is-invalid-custom' : errors.phone}"
                               @keypress="checkNumber($event)"
                               autocomplete="new-location-phone-number"
                               placeholder="Enter profile location phone number" v-model="formData.phone">
                        <div v-if="errors.phone" class="error-report">{{ errors.phone }}</div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="location-email" class="form-label">Location email</label>
                        <input id="location-email" type="email" name="location-email" class="form-control"
                               :class="{'is-invalid-custom' : errors.email}"
                               autocomplete="new-location-email" placeholder="Enter profile email"
                               v-model="formData.email">
                        <div v-if="errors.email" class="error-report">{{ errors.email }}</div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="service-available-for" class="form-label">Services available for</label>
                        <select id="service-available-for" name="service-available-for" class="form-select"
                                :class="{'is-invalid-custom' : errors.services_for}"
                                autocomplete="new-service-available-for" v-model="formData.services_for">
                            <option value="0">Everyone</option>
                            <option value="1">Female only</option>
                            <option value="2">Male only</option>
                        </select>
                        <div v-if="errors.services_for" class="error-report">{{ errors.services_for }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="form-label d-flex justify-content-between align-items-center">
                    Description
                    <span class="fw-normal text-muted">
                        {{ initialDescLength }}/{{ maxDescLength }}
                    </span>
                </label>
                <textarea name="description" id="description" class="form-textarea" cols="30" rows="5"
                          :class="{'is-invalid-custom' : errors.description}"
                          autocomplete="new-description" placeholder="Enter profile description"
                          v-model="formData.description" :maxlength="maxDescLength" @keyup="lengthAlphabet(formData.description.length)"></textarea>
                <div v-if="errors.description" class="error-report">
                    {{ errors.description }}
                </div>
            </div>

            <!--Temporary submit button-->
            <div class="form-group text-end mt-3">
                <button type="submit" class="btn btn-theme w-150">Next Step</button>
            </div>
        </form>

    </div>

</template>

<script>

import session from "../../../../services/session.js";
import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left'
})

export default {
    
    watch: {
        'formData.description'(desc) {
            this.initialDescLength = '0' + desc?.length
        }
    },

    data() {

        return {
            loading: false,
            marketplaceData: null,
            formData: {
                id: '',
                location_name: '',
                phone: null,
                email: '',
                services_for: '0',
                description: '',
                address: '',
                apt: '',
                district: '',
                city: '',
                region: '',
                postcode: '',
                country: '',
                status: '2',
                photoPath: '',
                days: [
                    {shifts: [{start_time: '', end_time: '',}], name: 'monday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'tuesday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'wednesday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'thursday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'friday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'saturday', day_status: 1, status: 1,},
                    {shifts: [{start_time: '', end_time: '',}], name: 'sunday', day_status: 1, status: 1,},
                ],
            },
            errors: {},
            maxDescLength: '600',
            initialDescLength: '0',
        }

    },

    mounted() {

        this.getMarketplace();

    },

    methods: {

        /*Function that calls the marketplace*/
        getMarketplace() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.get(apiRoutes.Marketplace, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.marketplaceData = response.data;
                if (this.marketplaceData.status === undefined) {
                    this.formData.id = this.marketplaceData.profile?.id;
                    this.formData.location_name = this.marketplaceData.profile?.location_name;
                    this.formData.phone = this.marketplaceData.profile?.phone;
                    this.formData.email = this.marketplaceData.profile?.email;
                    this.formData.services_for = this.marketplaceData.profile?.services_for;
                    this.formData.description = this.marketplaceData.profile?.description;
                    this.formData.status = this.marketplaceData.profile?.status;
                    this.formData.address_name = this.marketplaceData.profile?.address;
                    this.formData.address = this.marketplaceData.profile?.address;
                    this.formData.apt = this.marketplaceData.profile?.apt;
                    this.formData.district = this.marketplaceData.profile?.district;
                    this.formData.city = this.marketplaceData.profile?.city;
                    this.formData.region = this.marketplaceData.profile?.region;
                    this.formData.postcode = this.marketplaceData.profile?.postcode;
                    this.formData.country = this.marketplaceData.profile?.country;
                    if (this.marketplaceData?.profile?.photos.length > 0) {
                        this.formData.photoPath = this.marketplaceData?.profile?.photos[0]?.photo_path;
                    }

                    //   Loop of start and end time
                    /*  this.formData.days.forEach((daysArr)=>{
                          daysArr.shifts.forEach((time) =>{

                          })
                      })*/
                    this.setSessionData();
                } else {
                    // Function to retrieve all stored marketplace data
                    this.retrieveMarketplaceData();
                }
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },


        // Function to store data in session storage
        submitAccount() {
            if (this.validateForm()) {

                // Convert the data to a JSON string before storing
                this.setSessionData()

                // Navigate to the next page
                this.$router.push({name: 'OnlineBookingLocationAddress'})
            }
        },

        // Function to store data in session storage
        setSessionData() {
            const jsonData = JSON.stringify(this.formData);
            // Store the JSON string in session storage
            session.setSession('marketplaceInfo', jsonData)
        },


        // Function to retrieve data from session storage
        retrieveMarketplaceData() {
            const storedDataJson = session.getSession('marketplaceInfo');
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
                if (this.formData.id == undefined) {
                    this.getCompanyDetails();
                }
            } else {
                this.getCompanyDetails();
            }
        },

        // Function to call the company details
        getCompanyDetails() {
            apiService.ClearErrorHandler();
            this.loading = true;
            axios.get(apiRoutes.Company, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                let res = response.data.company;
                this.formData.location_name = res.business_name;
                this.formData.address_name = res.address;
                this.formData.address = res.address;
                this.formData.apt = res.apartment;
                this.formData.district = res.district;
                this.formData.city = res.city;
                this.formData.region = res.region;
                this.formData.postcode = res.postcode;
                this.formData.country = res.country;
                // Submitting session when all data has been assigned.
                this.setSessionData();
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },


        /*Function to check number*/
        checkNumber(e) {
            let theEvent = e || window.event;
            let key;
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');

            } else {
                key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            const regex = /^\d*$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        },

        validateForm() {
            // Reset errors
            this.errors = {};

            // Validate each field
            if (!this.formData.location_name) {
                this.errors.location_name = 'Location Name is required.';
            }

            if (!this.formData.phone) {
                this.errors.phone = 'Phone is required.';
            }

            if (!this.formData.email) {
                this.errors.email = 'Email is required.';
            }

            if (!this.formData.services_for) {
                this.errors.services_for = 'Services available for is required.';
            }

            if (this.formData.description) {
                if (this.formData.description.length <= 200) {
                    this.errors.description = 'Must be longer than or equal to 200 characters.';
                }
            }else {
                this.errors.description = 'Description is required.';
            }

            // Check if there are any errors
            return Object.keys(this.errors).length === 0;
        },

        /* Function to control length textarea of description */
        lengthAlphabet(num) {
            this.initialDescLength = ('0' + num).slice(-3)
        },
    }

}

</script>
