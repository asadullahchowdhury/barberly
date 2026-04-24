<template>
    <div class="sign-up-review padding-top-32">
        <!--back btn-->
        <router-link :to="{name:'AcceptInvitation'}" class="btn-icon fixed-btn">
            <img :src="`/images/global/arrow-left.svg`" alt="back">
        </router-link>
        <!--back btn-->

        <div class="form-center padding-md-x-70 padding-x-50">
            <h3 class="title margin-bottom-10">Review and confirm</h3>
            <p class="font-weight-500 text-center">
                Please review your details filled out by
                <strong>Barber</strong>
                and make sure <br> they’re correct before creating your account.
            </p>
            <br>
            <p class="font-weight-500 text-center">
                Please note, data entered here will be visible to clients after <br> booking an appointment with you.
            </p>

            <div class="form-group margin-top-30 margin-bottom-20 avatar-upload-wrapper">
                <!--Upload-->
                <label for="avatar" class="avatar-upload padding-20 text-center">
                    <img :src="`/images/portal/camera.svg`" class="w-32 h-32" alt="camera">
                    <input id="avatar" type="file" name="avatar" class="d-none">
                </label>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="first_name" class="form-label font-weight-600">First Name</label>
                <input id="first_name" type="text" name="first_name" placeholder="Enter first name"
                       v-model="formData.first_name"
                       class="form-control padding-left-20" autocomplete="new-first-name">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="last_name" class="form-label font-weight-600">Last Name</label>
                <input id="last_name" type="text" name="last_name" placeholder="Enter last name"
                       v-model="formData.last_name"
                       class="form-control padding-left-20" autocomplete="new-last-name">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="email" class="form-label font-weight-600">Email</label>
                <input id="email" type="text" name="email" placeholder="Enter email address"
                       v-model="formData.last_name"
                       class="form-control padding-left-20" autocomplete="new-last-name">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="number_field" class="form-label font-weight-600">Mobile Number</label>

                <input id="mobile_number" type="text" name="mobile" v-model="formData.mobile"
                       placeholder="Enter your mobile number"
                       class="form-control padding-left-20 mobile-input" autocomplete="new-mobile-number"
                       @keypress="checkNumber($event)">
                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23">
                <label for="country" class="form-label font-weight-600">Country</label>

                <!--country selection-->
                <div
                    class="country-select-btn d-flex justify-content-between align-items-center padding-x-15 padding-y-12 bg-theme-fade border-radius-10 h-50"
                    v-if="!countrySelection">
                    <div class="">{{ formData.country }}</div>
                    <a href="javascript:void(0)" @click="countrySelection = true">Edit</a>
                </div>

                <select name="country" id="country" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.country"
                        v-if="countrySelection"
                        autocomplete="new-country">
                    <option v-for="each in countries" v-if="countries.length > 0" :value="each.name">{{ each.name }}
                    </option>
                    <option v-if="countries.length === 0" disabled>No data!</option>

                </select>

                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23" v-if="countrySelection">
                <label for="time_zone" class="form-label font-weight-600">Time Zone</label>

                <select name="time-zone" id="time_zone" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.timezone"
                        autocomplete="new-time-zone">
                    <option v-for="each in timezones" v-if="timezones.length > 0" :value="each.text">{{ each.text }}
                    </option>
                    <option v-if="timezones.length === 0" disabled>No data!</option>
                </select>

                <div class="error-report"></div>
            </div>

            <div class="form-group padding-bottom-23" v-if="countrySelection">
                <label for="currency" class="form-label font-weight-600">Currency</label>

                <select name="currency" id="currency" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.currency"
                        autocomplete="new-currency">
                    <option v-for="each in currencies" v-if="currencies.length > 0" :value="each.code">{{ each.name }}
                    </option>
                    <option v-if="currencies.length === 0" disabled>No data!</option>

                </select>
            </div>

            <div class="form-group padding-bottom-40" v-if="countrySelection">
                <label for="language" class="form-label font-weight-600">Language</label>

                <select name="language" id="language" class="form-select padding-left-18 padding-right-16"
                        v-model="formData.language"
                        autocomplete="new-lang">
                    <option v-if="languages.length > 0" v-for="each in languages" :value="each.name">
                        {{ each.name }}
                    </option>

                    <option v-if="languages.length === 0" disabled>
                        No data!
                    </option>

                </select>

            </div>

            <div class="form-group padding-bottom-23">
                <router-link :to="{name:'SignUpPassword'}" class="btn btn-theme btn-anchor">
                    Continue
                </router-link>
            </div>
        </div>

    </div>
</template>

<script>
import sort from "../../../services/sorting"

export default {
    data() {
        return {
            formData: {
                email: '',
                first_name: '',
                last_name: '',
                mobile: '',
                country: 'Bangladesh',
                timezone: '(UTC+06:00) Dhaka',
                currency: 'BDT',
                language: 'Bengali',
                password: '',
                password_confirmation: '',
            },
            countrySelection: false,
            loading: false,
        }
    },

    mounted() {
        this.countryList();
        this.currencyList();
        this.languageList();
        this.timezones = window.core.timezones;
    },

    methods: {
        countryList() {
            this.countries = window.core.countries;
            sort.Sort(this.countries, 'name')
        },

        currencyList() {
            this.currencies = window.core.currencies;
            sort.Sort(this.currencies, 'name')
        },
        languageList() {
            this.languages = window.core.languages;
            sort.Sort(this.languages, 'name')
        },

        /*number check*/
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
    }
}
</script>
