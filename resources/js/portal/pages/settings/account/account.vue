<template>

    <div class="settings w-100 pt-sm-5 pt-1">
        <div class="row justify-content-center p-3">
            <form autocomplete="off" class="col-12 col-lg-10 col-xl-8 p-3">

                <!-- head section -->
                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                    <div class="w-100">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link :to="{name: 'SetupSettings'}"
                                                 class="text-secondary text-decoration-none">
                                        Settings
                                    </router-link>
                                </li>
                                <li class="breadcrumb-item text-theme disable-feature"> Business details</li>
                            </ol>
                        </nav>
                        <div class="h3 me-3 fw-semibold mb-4"> Business details</div>
                    </div>
                    <div class="w-100 d-flex align-items-center justify-content-end mb-3">
                        <button type="submit" class="btn btn-theme padding-x-12 padding-y-10 res-btn">
                            Save
                        </button>
                    </div>
                </div>

                <!-- business name, country and currency -->
                <div class="row">
                    <div class="col-lg-6 pb-4">
                        <div class="fw-semibold h5 mb-3">
                            Business info
                        </div>
                        <div class="text-secondary text-opacity-75">
                            Your business name is displayed across many areas including on your online booking profile,
                            sales receipts and messages to clients
                        </div>
                    </div>
                    <div class="col-lg-6 pb-4">
                        <div class="border p-3 p-sm-4 rounded-3">
                            <div class="form-group">
                                <label for="business_name" class="form-label">Business name</label>
                                <input type="text" name="business_name" v-model="formData.business_name"
                                       class="form-control" autocomplete="off">
                            </div>
                            <div class="p-3 bg-light shadow-sm rounded-3 mt-3 d-flex align-items-center">
                                <img :src="`/images/portal/warning-circle.svg`" class="w-24 h-24 me-2"
                                     alt="warning-circle">
                                <span>
                                    Your country is set to <strong
                                    class="mx-1"> {{ formData.country }} </strong> with <strong
                                    class="mx-1"> {{ formData.currency }} </strong> currency.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- time zone, format time, week start and appointment source -->
                <div class="row">
                    <div class="col-lg-6 pb-4">
                        <div class="fw-semibold h5 mb-3">
                            Time and calendar settings
                        </div>
                        <div class="text-secondary text-opacity-75">
                            Choose the time zone and format which suit your business. Daylight savings changes will
                            automatically apply based on your selected time zone
                        </div>
                    </div>
                    <div class="col-lg-6 pb-4">
                        <div class="border p-3 p-sm-4 rounded-3 mb-3">
                            <div class="form-group mb-3">
                                <label for="time_zone" class="form-label">Time zone</label>
                                <select name="timezone" id="time_zone"
                                        class="form-select padding-left-18 padding-right-16" v-model="formData.timezone"
                                        autocomplete="new-time-zone">
                                    <option v-for="each in timezones" v-if="timezones.length > 0" :value="each.text">
                                        {{ each.text }}
                                    </option>
                                    <option v-if="timezones.length === 0" disabled>No data!</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="time_format" class="form-label">Time format</label>
                                <select id="time_format" name="time_format" class="form-select"
                                        v-model="formData.timeFormat">
                                    <option value="12hour">12 hours (e.g 9:00pm)</option>
                                    <option value="24hour">24 hours (e.g 21:00)</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="week_start" class="form-label">Week start</label>
                                <select id="week_start" name="week_start" class="form-select"
                                        v-model="formData.weekStart">
                                    <option value="sunday">Sunday</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                    <option value="saturday">Saturday</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="appointment-color-source" class="form-label">Appointment color
                                    source</label>
                                <select id="appointment-color-source" name="appointment_color_Source"
                                        class="form-select" v-model="formData.appointmentSource">
                                    <option value="teamMember">Team member</option>
                                    <option value="serviceGroup">Service group</option>
                                    <option value="status">Status</option>
                                </select>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- language setup of client notification and team -->
                <div class="row">
                    <div class="col-lg-6 pb-4">
                        <div class="fw-semibold h5 mb-3">
                            Language settings
                        </div>
                        <div class="text-secondary text-opacity-75">
                            Choose the default language for appointment notification messages sent to your clients.
                            Per-client language preferences can also be set within the settings for each client.
                        </div>
                    </div>
                    <div class="col-lg-6 pb-4">
                        <div class="border p-3 p-sm-4 rounded-3 mb-3">
                            <div class="form-group mb-3">
                                <label for="time-format" class="form-label">Client notification language</label>
                                <select name="language" id="language" class="form-select" v-model="formData.language"
                                        autocomplete="new-lang">
                                    <option v-if="languages.length > 0" v-for="each in languages" :value="each.name">
                                        {{ each.name }}
                                    </option>

                                    <option v-if="languages.length === 0" disabled>
                                        No data!
                                    </option>

                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="time-format" class="form-label">Default language for your team</label>
                                <select name="language" id="language" class="form-select" v-model="formData.language"
                                        autocomplete="new-lang">
                                    <option v-if="languages.length > 0" v-for="each in languages" :value="each.name">
                                        {{ each.name }}
                                    </option>

                                    <option v-if="languages.length === 0" disabled>
                                        No data!
                                    </option>

                                </select>
                            </div>

                            <div class="p-3 bg-light shadow-sm rounded-3 mt-3 d-flex align-items-start">
                                <img :src="`/images/portal/warning-circle.svg`" class="w-24 h-24 me-2"
                                     alt="warning-circle">
                                <span>
                                    New team members will see Barberly in this language but they can override this in
                                    their personal user settings.
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- website and social media link -->
                <div class="row">
                    <div class="col-lg-6 pb-4">
                        <div class="fw-semibold h5 mb-3">
                            Online links
                        </div>
                        <div class="text-secondary text-opacity-75">
                            Add your company website and social media links for sharing with clients
                        </div>
                    </div>
                    <div class="col-lg-6 pb-4">
                        <div class="border p-3 p-sm-4 rounded-3 mb-3">
                            <div class="form-group mb-3">
                                <label for="website_link" class="form-label">Website</label>
                                <input id="website_link" type="url" name="website_link" class="form-control"
                                       placeholder="www.yourwebsite.com" v-model="formData.websiteLink"
                                       autocomplete="new-website">
                            </div>
                            <div class="form-group mb-3">
                                <label for="facebook_page" class="form-label">Facebook page</label>
                                <input id="facebook_page" type="url" name="facebook_page" class="form-control"
                                       placeholder="www.facebook.com/yoursite" v-model="formData.facebookLink"
                                       autocomplete="new-facebook-page">
                            </div>
                            <div class="form-group mb-3">
                                <label for="instagram_page" class="form-label">Instagram page</label>
                                <input id="instagram_page" type="url" name="instagram_page" class="form-control"
                                       placeholder="www.instagram.com/yoursite" v-model="formData.instagramLink"
                                       autocomplete="new-instagram-page">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</template>

<script>
import sort from "../../../../services/sorting"

export default {

    data() {

        return {
            formData: {
                business_name: 'Barberly',
                country: 'Australia',
                timezone: '(UTC+11) Oranjestad, Australian Eastern Daylight Time ',
                currency: 'AUD',
                language: 'English',
                timeFormat: '12hour',
                weekStart: 'monday',
                appointmentSource: 'status',
                websiteLink: '',
                facebookLink: '',
                instagramLink: '',
            },
            languages: [],
            timezones: [],
            countries: [],
        }

    },

    mounted() {
        this.countryList();
        this.currencyList();
        this.languageList();
        this.timezones = window.core.timezones
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
    }

}

</script>
