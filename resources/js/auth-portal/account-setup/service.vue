<template>
    <form class="account-setup" @submit.prevent="submitAccount">
        <!-- account setup header -->

        <!-- Next button -->
        <div class="manage-button">
            <button type="submit" :disabled="selectedServices.length  < 1 && othersValue.length < 1 "
                    :class="{'disabled':selectedServices.length < 1 && othersValue.length < 1}"
                    class="btn-theme padding-y-10 padding-x-12 w-110 h-45">
                <span class="btn-text">Next</span>
            </button>
        </div>

        <!-- Service content -->
        <div class="account-setup-content padding-x-20">
            <div class="padding-top-24">
                <div class="text-center account-setup-title">
                    What kind of services do you offer?
                </div>
            </div>
            <div class="padding-top-12 padding-bottom-20">
                <div class="text-center account-setup-sub-title margin-bottom-10">
                    Select at least 1 service
                </div>
                <div class="text-center account-setup-sub-title">
                    Choose your primary and up to 3 related service types
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <div class="box-section">
                    <div class="d-flex flex-wrap justify-content-md-start justify-content-center" v-if="services.length > 0 && loading === false">
                        <div class="text-center outer-box margin-x-10 cursor-pointer" v-for="(each, index) in services"
                             :class="{'selected': checkIfSelected(each.name),'disabled': serviceDisabled()}"
                             @click="selectService(each.name)">
                            <div class="icon-box position-relative">
                                <img :src="'/images/services/'+each.icon" :alt="each.icon">
                                <div class="badge-icon-select" v-if="each.name === selectedServices[0]">P</div>
                                <div class="badge-icon-select" v-if="each.name === selectedServices[1]">2</div>
                                <div class="badge-icon-select" v-if="each.name === selectedServices[2]">3</div>
                                <div class="badge-icon-select" v-if="each.name === selectedServices[3]">4</div>
                            </div>
                            <div class="padding-top-18 padding-bottom-30 box-title">
                                {{ each.name }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-md-start justify-content-center" v-if="services.length > 0 && loading === false">
                        <div class="text-center outer-box margin-x-10 cursor-pointer" @click="selectOther()"
                             :class="{'selected': othersValue !== '','disabled':selectedServices.length === 4 && othersValue === ''}">
                            <div class="icon-box">
                                <img :src="'/images/services/other.svg'"
                                     :alt="'other.svg'">
                            </div>
                            <div class="padding-top-18 padding-bottom-20 box-title">
                                Other
                            </div>
                        </div>
                        <div class="form-content margin-bottom-20" v-if="others === true || othersValue !== ''">
                            <label for="" class="form-label">Select Other Service</label>
                            <input type="text" name="" class="form-control" placeholder="Please select one or more"
                                   v-model="othersValue">
                        </div>
                    </div>

                    <!-- Loading -->
                    <div class="box-loading" v-if="loading === true">
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
                            </div>
                        </div>
                        <div class="box-progress">
                            <div class="placeholder-loading">
                                <div class="placeholder-anim max-box"></div>
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
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes.js";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";
import session from "../../services/session.js";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    components: {
        // Import Footer component
        Footer,
    },
    data() {
        return {
            // Data properties for the component
            loading: false,
            others: false,
            othersValue: '',
            services: [],
            selectedServices: [],
            formData: {},
        }
    },
    watch: {
        'selectedServices.length'(newLength) {
            if (newLength === 4) {
                this.others = false
            }
        }
    },
    methods: {
        // Function of get services
        getServices() {
            this.loading = true;
            axios.get(apiRoutes.Services, {params: null}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.services = res.services
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                    this.$router.push({name: 'AccountSetup'})
                }
            })
        },

        // Function of store data in session storage
        submitAccount() {
            if (this.selectedServices?.length === 0){
                return
            }
            if (this.selectedServices.length < 4) {
                if (this.othersValue !== '') {
                    this.selectedServices.push('other__' + this.othersValue)
                }
            }
            this.formData.services = this.selectedServices.join(', ')

            // Convert the data to a JSON string before storing
            const jsonData = JSON.stringify(this.formData);

            // Store the JSON string in session storage
            session.setSession('accountInformation', jsonData)

            this.$router.push({name: 'TeamSize'})
        },

        // Function of retrieve data from session storage
        retrieveAccountData() {
            const storedDataJson = session.getSession('accountInformation')

            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
                if (this.formData.services !== '') {
                    this.selectedServices = this.formData.services.split(', ');
                    let otherService = this.selectedServices[this.selectedServices.length - 1];
                    if (otherService.includes('other__')) {
                        this.othersValue = otherService.replace('other__', '');
                        this.selectedServices = this.selectedServices.slice(0, -1);
                    }
                }
            }
        },

        // Function of select service
        selectService(name) {
            if (this.selectedServices.includes(name)) {
                this.removeSelected(name)
            } else {
                if (this.othersValue === '' && this.selectedServices.length < 4) {
                    this.selectedServices.push(name)
                } else if (this.othersValue !== '' && this.selectedServices.length < 3) {
                    this.selectedServices.push(name)
                }

            }
        },

        // Function of remove selected Service
        removeSelected(targetName) {
            const index = this.selectedServices.indexOf(targetName);
            this.selectedServices.splice(index, 1);
        },

        // Function of selected Service
        checkIfSelected(name) {
            return this.selectedServices.includes(name);
        },

        // Function of if selected service length more than 4 content will be disabled
        serviceDisabled() {
            if (this.othersValue === '' && this.selectedServices.length < 4) {
                return false
            } else if (this.othersValue !== '' && this.selectedServices.length < 3) {
                return false
            } else {
                return true;
            }
        },

        // Function of show and hide other selected service which is implement as text
        selectOther() {
            this.others = !this.others
        }
    },
    mounted() {
        // Show Services: called after the component is mounted
        this.getServices()
        // Lifecycle hook: Called after the component is mounted
        this.retrieveAccountData();

        // Checking if required data is not empty. if it's empty then it will redirect to AccountSetup page.
        if (this.formData.business_name === undefined || this.formData.business_name === null || this.formData.business_name === '') {
            this.$router.push({name: 'AccountSetup'})
        }
    },
}
</script>
