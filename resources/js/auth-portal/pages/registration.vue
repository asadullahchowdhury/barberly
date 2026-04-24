<template>
    <div class="logo position-relative padding-md-top-87 padding-top-70">
        <img :src="'/images/global/logo.svg'" alt="logo.png">
        <router-link :to="{name: 'Sign-In'}" class="arrow-btn">
            <img :src="'/images/authentication/arrow-left.png'" alt="arrow-left">
        </router-link>
    </div>
    <div class="title padding-top-55 padding-md-bottom-26 padding-bottom-30 padding-x-20">
        Signup or sign in to start managing your salon
    </div>
    <div class="form-center">

        <!-- Registration form action -->
        <form class="form-section" autocomplete="off" @submit.prevent="register">
            <div class="subtitle">
                You’re almost there! Create your new account for <b class="text-dark">{{ this.formData.email }}</b> by completing these
                details.
            </div>

            <!-- First name input -->
            <div class="form-group padding-bottom-23">
                <label for="first_name" class="form-label">First Name</label>
                <input id="first_name" type="text" name="first_name" placeholder="Enter first name"
                       v-model="formData.first_name"
                       class="form-control padding-left-20" autocomplete="new-first-name">
                <div class="error-report"></div>
            </div>

            <!-- Last name input -->
            <div class="form-group padding-bottom-23">
                <label for="last_name" class="form-label">Last Name</label>
                <input id="last_name" type="text" name="last_name" placeholder="Enter last name"
                       v-model="formData.last_name"
                       class="form-control padding-left-20" autocomplete="new-last-name">
                <div class="error-report"></div>
            </div>

            <!-- Password input -->
            <div class="form-group padding-bottom-23">
                <label for="password" class="form-label">Password</label>
                <div class="password-content">
                    <input id="password" :type="passwordFieldType" name="password" v-model="formData.password"
                           placeholder="Enter a password" class="form-control padding-left-20"
                           autocomplete="new-password">

                    <a href="javascript:void(0)" class="password-hide-show" @click="passwordVisibility">
                        <span v-if="passwordFieldType === 'text'">
                            <img :src="'/images/authentication/eye.svg'" alt="eye">
                        </span>
                        <span v-if="passwordFieldType === 'password'">
                            <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                        </span>
                    </a>

                    <div class="error-report"></div>
                </div>
            </div>

            <!-- Confirm password input -->
            <div class="form-group padding-bottom-23">
                <label for="password" class="form-label">Confirm Password</label>
                <div class="password-content">
                    <input id="password_confirmation" :type="passwordConfirmationFieldType" name="password_confirmation"
                           v-model="formData.password_confirmation"
                           placeholder="Confirm Password" class="form-control padding-left-20"
                           autocomplete="new-password-confirmation">

                    <a href="javascript:void(0)" class="password-hide-show" @click="passwordConfirmVisibility">
                        <span v-if="passwordConfirmationFieldType === 'text'">
                            <img :src="'/images/authentication/eye.svg'" alt="eye">
                        </span>
                        <span v-if="passwordConfirmationFieldType === 'password'">
                            <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                        </span>
                    </a>

                    <div class="error-report"></div>
                </div>
            </div>

            <!-- Mobile number input -->
            <div class="form-group padding-bottom-23">
                <label for="number_field" class="form-label">Mobile Number</label>
                <input id="mobile_number" type="text" name="mobile" v-model="formData.mobile"
                       placeholder="Enter your mobile number"
                       class="form-control padding-left-20 mobile-input" autocomplete="new-mobile-number"
                       @keypress="checkNumber($event)">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="country" class="form-label">Country</label>

                <!-- Country selection -->
                <div
                    class="country-select-btn d-flex justify-content-between align-items-center padding-x-15 padding-y-12 bg-theme-fade border-radius-10 h-50"
                    v-if="!countrySelection">
                    <div class="">{{ formData.country }}</div>
                    <a href="javascript:void(0)" @click="countrySelection = true">Edit</a>
                </div>

                <select name="country" id="country" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.country" v-if="countrySelection" autocomplete="new-country"
                        @change="changeCountry()">
                    <option v-for="each in countries" v-if="countries.length > 0" :value="each.name">
                        {{ each.name }}
                    </option>
                </select>
            </div>

            <!-- Time Zone selection -->
            <div class="form-group padding-bottom-23" v-if="countrySelection">
                <label for="time_zone" class="form-label">Time Zone</label>

                <select name="time-zone" id="time_zone" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.timezone" autocomplete="new-time-zone">
                    <option v-for="each in timezones" v-if="timezones.length > 0" :value="each.text">
                        {{ each.text }}
                    </option>
                    <option v-if="timezones.length === 0" value="">
                        No timezone found
                    </option>
                </select>

                <div class="error-report"></div>
            </div>

            <!-- Currency selection -->
            <div class="form-group padding-bottom-23" v-if="countrySelection">
                <label for="currency" class="form-label">Currency</label>

                <select name="currency" id="currency" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.currency" autocomplete="new-currency">
                    <option v-for="each in currencies" :value="each.code" v-if="currencies.length > 0">
                        {{ '(' + each.symbol + ') ' }} {{ each.name }}
                    </option>
                    <option value="" v-if="currencies.length === 0">
                        No currencies found
                    </option>
                </select>

                <div class="error-report"></div>
            </div>

            <!-- Language selection -->
            <div class="form-group padding-bottom-40" v-if="countrySelection">
                <label for="language" class="form-label">Language</label>

                <select name="language" id="language" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.language"
                        autocomplete="new-lang">
                    <option v-for="each in languages" :value="each.name" v-if="languages.length > 0">
                        {{ each.name }}
                    </option>
                    <option value="" v-if="languages.length === 0">
                        No language found
                    </option>

                </select>
            </div>

            <div class="form-group padding-bottom-23">
                <button type="submit" class="btn-theme w-100 padding-x-12" v-if="!loading" @click="scrollShowError">
                    <span class="btn-text">
                        Create Account
                    </span>
                </button>

                <button type="button" class="btn-theme btn-loading w-100 padding-x-12" v-if="loading">
                    <span class="loading"></span>
                </button>
            </div>

        </form>

    </div>
</template>

<script>
import {useRoute} from 'vue-router';
import apiService from "../../services/apiService";
import apiRoutes from "../../services/apiRoutes";
import sort from "../../services/sorting";
import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";

const toaster = createToaster({
    position: 'top-left',
});

export default {

    data() {

        return {
            // Data properties for the component
            password: '',
            passwordFieldType: 'password',
            passwordConfirmationFieldType: 'password',
            formData: {
                email: '',
                first_name: '',
                last_name: '',
                mobile: '',
                country: 'Australia',
                timezone: '(UTC+11) Oranjestad, Australian Eastern Daylight Time ',
                currency: 'AUD',
                language: 'English',
                password: '',
                password_confirmation: '',
            },
            countrySelection: false,
            selectedCountry: null,
            loading: false,
            countries: [],
            currencies: [],
            languages: [],
            timezones: [],
        }

    },

    mounted() {
        // First input will be focused when the page loads
        document.getElementById('first_name').focus()

        // Lifecycle hook: Called after the component is mounted
        if (window.history.state.email !== undefined) {
            /*getting the email from check account page*/
            const route = useRoute();
            this.formData.email = window.history.state.email;
            this.countryList();
            this.currencyList();
            this.languageList();
            this.getValueOfSelectedCountry()
        } else {
            this.$router.push({name: 'Sign-In'})
        }

    },

    methods: {
        // Function of country list from json file
        countryList() {
            this.countries = window.core.countries;
            sort.Sort(this.countries, 'name')
        },

        // Function of currency list from json file
        currencyList() {
            this.currencies = window.core.currencies;
            sort.Sort(this.currencies, 'name')
        },

        // Function of language list from json file
        languageList() {
            this.languages = window.core.languages;
            sort.Sort(this.languages, 'name')
        },

        // Function of password visibility
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        // Function of confirm password visibility
        passwordConfirmVisibility() {
            this.passwordConfirmationFieldType = this.passwordConfirmationFieldType === "password" ? "text" : "password";
        },

        // Function of Registration api
        register() {
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.post(apiRoutes.Register, this.formData, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                this.$router.push({name: 'Verification-code', state: {email: this.formData.email}})
            }).catch(err => {
                this.loading = false;
                let res = err.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    this.scrollToError()
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // Function of mobile number check
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

        // Function of change country
        changeCountry() {
            this.getValueOfSelectedCountry()
            this.formData.currency = this.selectedCountry.currency[0].code
            this.formData.timezone = this.selectedCountry.timeZone[0].text
        },

        // Function of change country to set value of other input like time zone
        getValueOfSelectedCountry() {
            const selectedCountryName = this.formData.country;
            this.selectedCountry = this.countries.find(country => country.name === selectedCountryName);
            if (this.selectedCountry) {
                this.timezones = this.selectedCountry.timeZone
            }
        },

        scrollToError() {
            const element = document.querySelector(".form-section");
            element.scrollIntoView({behavior: 'smooth'});
        }

    }

}

</script>
