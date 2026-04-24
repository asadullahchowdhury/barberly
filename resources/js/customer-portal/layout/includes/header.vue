<template>

    <header class="header fixed-top">
        <div class="container p-3">
            <div class="d-flex justify-content-between align-items-center">
                <router-link :to="{name:'Home'}" class="logo">
                    <img :src="`/images/global/logo.svg`" class="logo-dark img-fluid object-fit-cover col-8" alt="logo">
                    <img :src="`/images/global/logo-white.svg`" class="logo-light img-fluid object-fit-cover col-8"
                         alt="logo">
                </router-link>


                <div class="d-flex align-items-center">
                    <span class="d-none " :class="userInfo === null ? 'd-sm-inline-block' : 'd-md-inline-block'">
                        <router-link :to="{name: 'ForBusiness'}"
                                     class="btn btn-white has-border btn-pill rounded-pill me-3 padding-y-10">
                            For Business
                        </router-link>
                    </span>
                    <!--If not logged in-->
                    <div class="d-none d-sm-inline-block dropdown" v-if="userInfo === null">
                        <button
                            class="btn btn-white has-border btn-pill rounded-pill dropdown-toggle padding-y-10"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu custom-dropdown-menu dropdown-menu-end mt-2">
                            <li>
                                <router-link :to="{name: 'UserFlow'}" class="dropdown-item">
                                    Log in
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'DownloadApp'}" class="dropdown-item">
                                    Download the app
                                </router-link>
                            </li>
                            <li><a class="dropdown-item disable-feature" href="javascript:void(0)">Customer support</a>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item w-100" @click="openLanguageModal">
                                    <span class="badge bg-transparent text-dark">GB</span>
                                    English
                                </button>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <router-link :to="{name: 'ForBusiness'}" class="dropdown-item">
                                    Barberly for Business
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- If logged in -->

                    <!-- Header dropdown -->
                    <header-dropdown v-if="userInfo!== null"/>

                </div>


                <!-- Header responsive off canvas button -->
                <button class="btn btn-controller d-inline-block d-sm-none" :class="userInfo === null ? '' : 'd-none'"
                        type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <img :src="`../images/home/justify.svg`" class="img-fluid" alt="justify">
                </button>

                <!--  Off canvas use for header responsive  -->
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                     id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                            <img :src="`/images/global/logo.svg`" class="img-fluid col-9" alt="logo">
                        </h5>
                        <button type="button" class="btn-close shadow-none border-0" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <router-link :to="{name: 'UserFlow'}" class="nav-link d-flex justify-content-between">
                            <span> Log in </span>
                            <span>
                            <img :src="`/images/home/chevron-right.svg`" class="arrow-right" alt="chevron-right">
                        </span>
                        </router-link>
                        <router-link :to="{name: 'DownloadApp'}" class="nav-link d-flex justify-content-between">
                            <span> Download the app </span>
                            <span>
                            <img :src="`/images/home/chevron-right.svg`" class="arrow-right" alt="chevron-right">
                        </span>
                        </router-link>
                        <a href="javascript:void(0)" class="nav-link disable-feature d-flex justify-content-between">
                            <span> Customer support </span>
                            <span>
                            <img :src="`/images/home/chevron-right.svg`" class="arrow-right" alt="chevron-right">
                        </span>
                        </a>
                        <button type="button" class="nav-link d-flex justify-content-between w-100"
                                @click="openLanguageModal">
                            <span>
                                <span class="badge bg-transparent text-dark small">GB</span> English </span>
                            <span>
                            <img :src="`/images/home/chevron-right.svg`" class="arrow-right" alt="chevron-right">
                        </span>
                        </button>
                        <a href="/portal" class="nav-link d-flex justify-content-between">
                            <span> Barberly for business </span>
                            <span>
                            <img :src="`/images/home/chevron-right.svg`" class="arrow-right" alt="chevron-right">
                        </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>

</template>

<script>

import HeaderDropdown from "../../layout/includes/header-dropdown.vue"

export default {

    data() {

        return {
            // Data properties for the component
            userInfo: null,
        }

    },
    components: {
        // Component of header dropdown
        HeaderDropdown
    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.core.UserInfo !== null) {
            this.userInfo = window.core.UserInfo
        }

        window.addEventListener('scroll', this.onScroll);
        setTimeout(() => (this.loading = false), 3000);

    },

    beforeUnmount() {
        // Lifecycle hook: Called before the component is beforeUnmounted
        window.removeEventListener('scroll', this.onScroll);
    },

    methods: {

        // Function of header scroll effect
        onScroll(event) {
            if (window.scrollY > 50) {
                document.querySelector('.header').classList.add('header-scrolled');
            } else {
                document.querySelector('.header').classList.remove('header-scrolled');
            }
        },

        /* Function to open language modal */
        openLanguageModal() {
            let modal = new bootstrap.Modal(document.getElementById('languageModal'))
            modal.show();
        },

    }

}

</script>
