<template>

    <div class="p-1">
        <div class="h3 fw-semibold text-center">
            Where is asdasda located?
        </div>

        <div class="mt-3 text-center d-block">
            Add your business location so your clients can easily find you.
        </div>

        <!--Address form-->
        <form class="mt-4" autocomplete="off" @submit.prevent="submitAccount">
            <div class="form-group mb-3">
                <label class="form-label">Location address</label>
                <input type="text" v-model="formData.address_name" id="google_autocomplete_marketplace"
                       name="address_name" class="form-control"
                       placeholder="Start typing to search your address">
            </div>
            <div class="border rounded-3 p-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" name="address" class="form-control"
                                   :class="{'is-invalid-custom' : errors.address}"
                                   v-model="formData.address">
                            <div v-if="errors.address" class="error-report">{{ errors.address }}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="apt/suite" class="form-label">Apt./Suite etc</label>
                            <input id="apt/suite" type="text" name="apt/suite" class="form-control"
                                   v-model="formData.apt">
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="district" class="form-label">District</label>
                            <input id="district" type="text" name="district" class="form-control"
                                   v-model="formData.district">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input id="city" type="text" name="city" class="form-control" v-model="formData.city">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="region" class="form-label">Region</label>
                            <input id="region" type="text" name="region" class="form-control" v-model="formData.region">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input id="postcode" type="text" name="postcode" class="form-control"
                                   v-model="formData.postcode">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="country" class="form-label">Country</label>
                            <input id="country" type="text" name="country" class="form-control"
                                   v-model="formData.country">
                        </div>
                    </div>
                </div>

               <div class="text-end">
                   <button type="submit" class="btn btn-theme w-150">Next Step</button>
               </div>

            </div>
        </form>

        <!--Map-->
        <div class="mt-3">
            <div id="map"></div>
        </div>
    </div>

</template>

<script>

import session from "../../../../services/session.js";

export default {

    data() {

        return {
            // Data and variables
            placeholder: '',
            formData: {},
            errors: {},

        }

    },

    methods: {
        // Google auto complete function call from google
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete_marketplace');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                    this.formData.lat = place.geometry.location.lat()
                    this.formData.lng = place.geometry.location.lng()
                    this.formData.address_name = place.formatted_address
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


        // Function to store data in session storage
        submitAccount() {
            this.errors = {};
            if (!this.formData.address) {
                this.errors.address = 'Address is required.';
            } else {
                // Convert the data to a JSON string before storing
                const jsonData = JSON.stringify(this.formData);

                // Store the JSON string in session storage
                session.setSession('marketplaceInfo', jsonData)

                // Navigate to the next page
                this.$router.push({name: 'OnlineBookingWorkingHours'})
            }

        },


        // Function to retrieve data from session storage
        retrieveMarketplaceData() {
            const storedDataJson = session.getSession('marketplaceInfo')
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
            }
        }

    },

    mounted() {
        this.initializeInput();
        this.retrieveMarketplaceData();
    },

}

</script>
