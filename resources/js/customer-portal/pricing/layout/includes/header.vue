<template>

    <header class="w-100 pricing-header fixed-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between p-3 fw-bold">
                <router-link :to="{name: 'Home'}" class="logo">
                    <img :src="`/images/global/logo.svg`" class="h-auto img-fluid logo-black" alt="logo">
                </router-link>
                <div class="d-flex align-items-center">
                    <div class="nav-item">
                        <router-link :to="{name: 'UserFlow'}" class="nav-link py-3 px-4 rounded-pill mx-1 d-none d-lg-inline-block button-effect">
                            Sign up for free
                        </router-link>
                    </div>
                    <div class="nav-item">
                        <router-link :to="{name: 'UserFlow'}" class="nav-link py-3 px-4 rounded-pill mx-1 d-none d-lg-inline-block">
                            Login
                        </router-link>
                    </div>
                    <div class="nav-item">
                        <router-link :to="{name: 'Pricing'}" class="nav-link py-3 px-4 rounded-pill mx-1 d-none d-lg-inline-block">
                            Pricing
                        </router-link>
                    </div>
                    <div class="nav-item">
                        <div class="nav-item dropdown">
                            <a class="nav-link py-3 px-4 rounded-pill mx-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="">
                            </a>
                            <ul class="dropdown-menu m-0 p-2 overflow-hidden dropdown-menu-end border">
                                <li>
                                    <router-link :to="{name: 'UserFlow'}" class="dropdown-item py-2 px-3 border-radius-5">
                                        Log in
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'Pricing'}" class="dropdown-item py-2 px-3 border-radius-5">
                                        Pricing
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'DownloadApp'}" class="dropdown-item py-2 px-3 border-radius-5">
                                        Download the app
                                    </router-link>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3 border-radius-5 disable-feature" href="javascript:void(0)">
                                        Card terminals
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3 border-radius-5 disable-feature" href="javascript:void(0)">
                                        Support for business
                                    </a>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item py-2 px-3 border-radius-5" @click="openLanguageModal">
                                        <small class="me-2">GB</small> English
                                    </button>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <router-link :to="{name: 'Home'}" class="dropdown-item py-2 px-3 border-radius-5">
                                        For Customer
                                    </router-link>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>

</template>

<script>

export default {

    data() {
        return {}

    },

    mounted() {
        // Lifecycle hook: Called after the component is mounted
        if (window.core.UserInfo !== null) {
            this.userInfo = window.core.UserInfo
        }

        window.addEventListener('scroll', this.onScroll);
        setTimeout(() => (this.loading = false), 1500);
    },

    beforeUnmount() {
        // Lifecycle hook: Called before the component is beforeUnmounted
        window.removeEventListener('scroll', this.onScroll);
    },

    methods: {

        // Function of header scroll effect
        onScroll(event) {
            if (window.scrollY > 25) {
                document.querySelector('.pricing-header').classList.add('header-scrolled');
            } else {
                document.querySelector('.pricing-header').classList.remove('header-scrolled');
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
