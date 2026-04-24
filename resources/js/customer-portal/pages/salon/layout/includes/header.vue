<template>
    <div class="salon-header p-4 shadow-sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!--logo-->
                <div class="logo d-xxl-block" :class="$router.name = 'Address' ? 'd-block' : 'd-none'">
                    <router-link :to="{name:'Home'}" class="logo">
                        <img :src="`/images/global/logo.svg`" class="img-fluid object-fit-cover" alt="logo">
                    </router-link>
                </div>

                <div class="d-flex align-items-center">
                    <!-- responsive search toggler -->
                    <a href="javascript:void(0)"
                       class="border w-42 h-42 d-flex justify-content-center align-items-center d-xxl-none d-block rounded-circle me-3"
                       @click="openSearchModal">
                        <img width="24" height="24" :src="`/images/global/search.svg`" alt="search">
                    </a>

                    <!--booking input -->
                    <div class="d-xxl-flex d-none booking-inputs rounded-pill me-3">
                        <div class="form-group">
                            <input type="text" class="form-control ps-4 py-3 left-radius" placeholder="Any Treatment"
                                   :value="categoryText" data-bs-target="#treatment" data-bs-toggle="dropdown"
                                   aria-expanded="false">

                            <!--dropdown for treatment start-->
                            <ul class="dropdown-menu treatment-dropdown text-capitalize w-100 p-2 mt-2" id="treatment">
                                <li>
                                    <div class="fw-bold h6 my-3 ms-2">Top Categories</div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/barber.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3"
                                             alt="barber">
                                        barber
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/face-skin.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="face-skin">
                                        face skin
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/hair-extensions.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="hair-extensions">
                                        hair extensions
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/hair-removal.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="hair-removal">
                                        hair removal
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/haircut-styling.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="haircut-styling">
                                        haircut styling
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/injectables.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="injectables">
                                        injectables
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/lashes-brows.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="lashes-brows">
                                        lashes brows
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/makeup.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3"
                                             alt="makeup">
                                        makeup
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/massage.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3"
                                             alt="massage">
                                        massage
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/nails.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3"
                                             alt="nails">
                                        nails
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/piercing-tattoo.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="piercing-tattoo">
                                        piercing tattoo
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/massage.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3"
                                             alt="massage">
                                        massage
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-3 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/spa-wellness.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="piercing-tattoo">
                                        spa wellness
                                    </div>
                                </li>
                            </ul>
                            <!--dropdown for treatment end  -->
                        </div>

                        <div class="form-group">

                            <input type="text" name="address" id="google_autocomplete" v-model="formData.address"
                                   class="form-control py-3" placeholder="Current location">
                        </div>

                        <div class="form-group">
                            <input type="text" v-model="formData.date" id="date" name="date" class="form-control py-3"
                                   placeholder="Any date" autocomplete="off">
                        </div>

                        <div class="form-group no-after">
                            <div class="input-group">
                                <input type="text" v-model="formData.time" id="time" name="time"
                                       class="form-control py-3 right-radius" placeholder="Any time" autocomplete="off">
                                <button type="button" class="btn btn-theme rounded-pill" @click="push">Search</button>
                            </div>
                        </div>

                    </div>

                    <!-- header dropdown if not login -->
                    <div class="dropdown" v-if="userInfo === null">
                        <button
                            class="btn btn-white has-border btn-pill rounded-pill dropdown-toggle py-2 py-md-3 px-4"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end mt-2 p-2">
                            <li>
                                <router-link :to="{name: 'Sign-In'}" class="dropdown-item py-2 px-3 border-radius-5">
                                    Log in
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'DownloadApp'}"
                                             class="dropdown-item py-2 px-3 border-radius-5">
                                    Download the app
                                </router-link>
                            </li>
                            <li>
                                <a class="dropdown-item disable-feature py-2 px-3 border-radius-5"
                                   href="javascript:void(0)">
                                    Customer support
                                </a>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item py-2 px-3 border-radius-5"
                                        @click="openLanguageModal">
                                <span class="badge bg-transparent text-dark">
                                    GB
                                </span>
                                    English
                                </button>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3 border-radius-5" href="/portal">
                                    Barberly for Business
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--header dropdown start-->
                    <header-dropdown/>
                    <!--header dropdown end  -->

                </div>

            </div>
        </div>


    </div>

    <!--Search Modal start-->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="searchModalLabel">Search Anything</h1>
                    <button type="button" class="btn-close shadow-none" @click="closeLanguageModal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Treatment or venue</label>
                                    <input type="text" class="form-control" placeholder="Any treatment">
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="form-label">Location</label>
                                    <input type="text" name="address" id="google_autocomplete"
                                           v-model="formData.address" class="form-control"
                                           placeholder="Current location">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-sm-0 mb-3">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date</label>

                                    <input id="date" type="text" name="date" class="form-control" required
                                           autocomplete="new-date" v-model="formData.date">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time" class="form-label">Time</label>
                                    <input id="time" type="text" name="time" class="form-control" required
                                           autocomplete="new-time" v-model="formData.time">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-theme w-100" @click="pushSearch">Search</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--Search Modal end  -->
</template>

<script>
import flatPickr from "vue-flatpickr-component";
import HeaderDropdown from "../../../../layout/includes/header-dropdown.vue";
import 'flatpickr/dist/flatpickr.css';
import flatpickr from "flatpickr";

export default {
    data() {
        return {
            formData: {
                date: '',
                time: '',
                address: '',
            },
            dateLoading: false,
            categoryText: '',
            userInfo: null,
        }
    },
    components: {
        HeaderDropdown,
        flatPickr,
    },
    mounted() {
        if (window.core.UserInfo !== null) {
            this.userInfo = window.core.UserInfo
        }

        this.dateLoading = true;
        if (window.innerWidth === 991) {
            this.initializeInput();
        }

        this.initializeInput();
        this.flatpickrConfigDate();
        this.flatpickrConfigTime();
    },
    methods: {

        // Function to google autocomplete
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                })
            }, 1000)
        },

        // Function to insert category
        textSelect(e) {
            this.categoryText = e.target.innerText;
        },

        // Function of push search
        pushSearch() {
            this.$router.push({ name: 'Address' })
        },

        // Function of config Date
        flatpickrConfigDate() {
            flatpickr("#date", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                disableMobile: true,
            })
        },

        // Function of config Time
        flatpickrConfigTime() {
            flatpickr("#time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "",
                disableMobile: true,
            })
        },

        // Function to open language modal
        openLanguageModal() {
            let modal = new bootstrap.Modal(document.getElementById('languageModal'))
            modal.show();
        },

        // Function to open search modal
        openSearchModal() {
            let modal = new bootstrap.Modal(document.getElementById('searchModal'))
            modal.show();
        },

        /* Function to close search modal */
        closeLanguageModal() {
            const Modal = document.querySelector('#searchModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

    }
}
</script>
