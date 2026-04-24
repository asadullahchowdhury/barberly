<template>
    <div class="header">

        <!-- toggle bar -->
        <button type="button" class="toggle-bar border-0 p-1" @click="toggleNav();">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <!--header brand start-->
        <div class="header-brand">
            <img :src="`/images/global/logo-name.svg`" alt="logo name">
        </div>
        <!--header brand end  -->

        <!--search input start and will be visible from full width to 767px-->
        <div class="search-input-wrapper position-relative">
            <div class="form-group">
                <input type="text" class="form-control search-input shadow-none" @focus="suggestionPopup=true">
                <div class="search-icon">
                    <img :src="`/images/global/search.svg`" alt="search">
                </div>
            </div>

            <!--Search suggestion popup box start-->
            <div class="suggestion-popup popup" :class="{'active' : suggestionPopup}">
                <p class="text-dark-gray margin-bottom-30">Search by client name, mobile, email or booking reference</p>

                <!--upcoming title-->
                <h4 class="margin-bottom-15 fs-5">Upcoming appointments</h4>
                <p class="text-dark-gray mb-0">None found</p>

                <!--clients title-->
                <h4 class="margin-bottom-15 fs-5 margin-top-30">Clients (recently added)</h4>

                <!--client list start-->
                <ul class="client-list">
                    <li class="each-client d-flex align-items-center">
                        <div class="client-avatar margin-right-15">
                            <avatarImage :name="`John doe`" :avatar="null"/>
                        </div>
                        <div class="client-info">
                            <p class="name font-weight-600 mb-0">Omar Farida</p>
                            <p class="mail text-gray mb-0">omar@gmail.com</p>
                        </div>
                    </li>
                    <li class="each-client d-flex align-items-center">
                        <div class="client-avatar margin-right-15">
                            <avatarImage :name="`John doe`" :avatar="null"/>
                        </div>
                        <div class="client-info">
                            <p class="name font-weight-600 mb-0">John Doe</p>
                            <p class="mail text-gray mb-0">johndoe@gmail.com</p>
                        </div>
                    </li>
                </ul>
                <!--client list end  -->
            </div>
            <!--Search suggestion popup box end  -->

        </div>
        <!--search input end  and will be visible from full width to 767px -->

        <!--header action start-->
        <div class="d-flex align-items-center">

            <!--Top up box start-->
            <div class="top-up-box disable-feature">
                <div class="icon">
                    <img :src="`/images/portal/message.svg`" alt="message">
                </div>
                SMS Balance: 45
                <a href="javascript:void(0)" class="top-up-btn">Topup</a>
            </div>
            <!--Top up box end-->

            <!--Header menu start-->
            <ul class="header-menu mb-0">
                <li class="header-menu-item">
                    <a href="javascript:void(0)" class="search-btn-responsive" @click="searchPopup = true">
                        <img :src="`/images/global/search.svg`" alt="search">
                    </a>
                </li>

                <li class="header-menu-item">
                    <!--top-up responsive will show in 1199px-->
                    <a href="javascript:void(0)" class="top-up-res disable-feature">
                        <img :src="`/images/portal/message.svg`" alt="message">
                    </a>
                    <!--top-up responsive will show in 1199px-->
                </li>

                <li class="header-menu-item">
                    <a href="javascript:void(0)" class="disable-feature">
                        <img :src="`/images/portal/theme-plus.svg`" alt="theme-plus">
                    </a>
                </li>

                <li class="header-menu-item">
                    <a href="javascript:void(0)" class="notification-controller" @click="notificationSidebar = true">
                        <img :src="`/images/portal/bell.svg`" alt="notification">
                    </a>
                </li>

                <!-- news sidebar controller -->
                <li class="header-menu-item">
                    <a href="javascript:void(0)" class="news-controller" @click="newsSidebar = true">
                        <img :src="`/images/portal/wallet.svg`" alt="wallet">
                    </a>
                </li>

                <!-- news sidebar show and hide -->
                <li class="news-sidebar" :class="{'active' : newsSidebar}">
                    <span
                        class="news-header h-57 d-block d-flex align-items-center justify-content-between justify-content-sm-center border-bottom px-3">

                        <!-- news sidebar title -->
                        <span class="font-size-21 fw-semibold text-center">
                            news
                        </span>

                        <!-- news sidebar close btn -->
                        <span
                            class="news-close-btn w-46 h-46 border rounded-circle d-flex justify-content-center align-items-center cursor-pointer news-close">
                            <img :src="`/images/global/x.svg`" class="w-21 h-21" alt="x">
                        </span>
                    </span>

                    <!-- news sidebar body | d-block use every span use purpose & show div as issue inside of li -->
                    <span class="news-body d-block scrollbar">

                        <span class="padding-y-16 border-bottom w-100 d-block">

                            <span class="padding-y-16 border-bottom w-100 d-block">

                                <!-- news body content image -->
                                <span class="d-block px-3 pb-3">
                                    <img :src="`/images/home/for-business.webp`" class="img-fluid object-fit-cover"
                                         alt="picture">
                                </span>

                                <!-- news body content header -->
                                <span class="font-size-21 fw-semibold d-block px-4 pb-3">
                                    Welcome to Barbarly! 👋
                                </span>

                                <!-- news body content body -->
                                <span class="d-block px-4 pb-3">
                                    You're now part of the largest network of beauty and wellness professionals, with unmissable opportunities to attract, convert and retain your clients.
                                </span>

                                <!-- news body content footer -->
                                <span class="news-footer-text d-block px-4">
                                    <small class="d-block text-secondary pb-3">
                                        2 months ago
                                    </small>
                                </span>

                            </span>

                        </span>

                        <!-- if api implement please remove then | dummy content in news sidebar body start -->
                        <span class="padding-y-16 border-bottom w-100 d-block">
                            <span class="font-size-21 fw-semibold d-block px-4 pb-3">
                                📊 Two weeks left of old reports
                            </span>
                            <span class="d-block px-4 pb-3">
                                Our old reports won’t be accessible after 31st January. Get prepared by taking Barberly's smarter, faster and more convenient reports for a spin now.
                            </span>
                            <span class="news-footer-text d-block px-4">
                                <small class="d-block text-secondary pb-3">
                                    15 days ago
                                </small>
                                <button type="button" class="btn btn-theme padding-x-12 padding-y-10">
                                    Go to report
                                </button>
                            </span>
                        </span>

                        <span class="padding-y-16 border-bottom w-100 d-block">
                            <span class="font-size-21 fw-semibold d-block px-4 pb-3">
                                NEW: Let clients choose different team members for multi-treatment bookings! 🌟
                            </span>
                            <span class="d-block px-4 pb-3">
                                Clients can now choose individual team members per service when they book multiple services online, letting them customise and create their ideal appointment.
                            </span>
                            <span class="news-footer-text d-block px-4">
                                <small class="d-block text-secondary pb-3">
                                    1 month ago
                                </small>
                                <button type="button" class="btn btn-theme padding-x-12 padding-y-10">
                                    Go to profile
                                </button>
                            </span>
                        </span>

                        <!-- if api implement please remove then | dummy content in news sidebar body end -->

                    </span>
                </li>

                <li class="header-menu-item position-relative">

                    <!--User avatar start-->
                    <a href="javascript:void(0)" class="user-avatar text-decoration-none" @click="headerDropdownPopup = true">

                        <avatarImage v-if="userData != null" :name="userData.first_name + ' ' + userData.last_name" :avatar="userData.avatar"/>
                    </a>
                    <!--User avatar end  -->

                    <!--header popup box start-->
                    <div class="header-dropdown popup" :class="{'active' : headerDropdownPopup}">
                        <div class="user-info d-flex justify-content-between align-items-center margin-bottom-10">
                            <div class="user-name flex-grow-1 font-weight-600 font-size-17">
                                {{ userData.first_name + ' ' + userData.last_name }}
                            </div>
                            <div class="dropdown-avatar margin-left-10">
                                <avatarImage v-if="userData != null" :name="userData.first_name + ' ' + userData.last_name" :avatar="userData.avatar" :size="`lg`"/>
                            </div>
                        </div>

                        <!--header dropdown list start-->
                        <ul class="header-dropdown-list">
                            <li class="dropdown-list-item">
                                <router-link :to="{name: 'Profile'}" class="padding-12 border-radius-5">
                                    Profile
                                </router-link>
                            </li>

                            <li class="dropdown-list-item">
                                <router-link :to="{name: 'Reviews'}" class="padding-12 disable-feature border-radius-5">
                                    Reviews
                                </router-link>
                            </li>

                            <li class="dropdown-list-item">
                                <router-link :to="{name: 'Settings'}" class="padding-12 border-radius-5">
                                    Settings
                                </router-link>
                            </li>

                            <li class="dropdown-list-item">
                                <router-link :to="{name: 'Workspaces'}"
                                             class="padding-12 border-radius-5">
                                    Workspaces
                                </router-link>
                            </li>

                            <li class="dropdown-list-item padding-12">
                                <span class="divider"></span>
                            </li>

                            <li class="dropdown-list-item">
                                <a href="javascript:void(0)" class="padding-12 disable-feature border-radius-5">Help
                                    center</a>
                            </li>

                            <li class="dropdown-list-item">
                                <a href="javascript:void(0)"
                                   class="padding-12 disable-feature border-radius-5">English</a>
                            </li>

                            <li class="dropdown-list-item">
                                <a href="javascript:void(0)" class="padding-12 border-radius-5" v-if="!loading"
                                   @click="logout">Logout</a>
                                <button type="button"
                                        class="logout-btn btn-loading h-43 padding-left-30 justify-content-start border-radius-5"
                                        v-if="loading">
                                    <span class="loading black"></span>
                                </button>
                            </li>

                        </ul>
                        <!--header dropdown list end  -->

                    </div>
                    <!--header popup box end  -->
                </li>

            </ul>
            <!--Header menu end  -->

            <!--Search popup start-->
            <div class="search-popup" :class="{'active' : searchPopup}">
                <!--search pop up close button-->
                <div class="close-btn" @click="searchPopup = false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <!--search pop up close button-->

                <!--Search input responsive-->
                <div class="position-relative">
                    <input type="text" class="search-input-responsive" placeholder="What are you looking for?"
                           v-model="searchParam">

                    <!--Search input clear btn-->
                    <a href="javascript:void(0)" class="search-clear-btn" v-if="searchParam != ''"
                       @click="searchParam = ''">
                        <img :src="`/images/portal/x-circle-fill.svg`" alt="x-circle">
                    </a>
                    <!--Search input clear btn-->
                </div>

                <!--search suggestion responsive contents start-->
                <p class="text-dark-gray margin-bottom-30 margin-top-10 text-start">Search by client name, mobile, email
                    or booking reference</p>

                <!--upcoming title-->
                <h4 class="margin-bottom-15 fs-5">Upcoming appointments</h4>
                <p class="text-dark-gray mb-0">None found</p>


                <!--clients title-->
                <h4 class="margin-bottom-15 fs-5 margin-top-30">Clients (recently added)</h4>

                <!--client list start-->
                <ul class="client-list">
                    <li class="each-client d-flex align-items-center">
                        <div class="client-avatar margin-right-15">
                            <avatarImage :name="`John doe`" :avatar="null"/>
                        </div>
                        <div class="client-info">
                            <p class="name mb-0 font-weight-600">Omar Farida</p>
                            <p class="mail mb-0 text-gray">omar@gmail.com</p>
                        </div>
                    </li>
                    <li class="each-client d-flex align-items-center">
                        <div class="client-avatar margin-right-15">
                            <avatarImage :name="`John doe`" :avatar="null"/>
                        </div>
                        <div class="client-info">
                            <p class="name mb-0 font-weight-600">John Doe</p>
                            <p class="mail mb-0 text-gray">johndoe@gmail.com</p>
                        </div>
                    </li>
                </ul>
                <!--client list end  -->

                <!--search suggestion responsive contents end  -->

            </div>
            <!--Search popup end  -->

            <!-- notification sidebar -->
            <div class="notification-sidebar" :class="{ 'active' : notificationSidebar }">

                <!-- notification close btn -->
                <span
                    class="w-45 h-45 border rounded-circle d-flex justify-content-center align-items-center cursor-pointer notification-close">
                    <img :src="`/images/global/x.svg`" class="w-21 h-21" alt="close">
                </span>

                <div class="notification-button-group">

                    <!-- appointment btn -->
                    <button class="notification-button mb-0 mb-md-3" @click="setTab('appointment')"
                            :class="{'active' : this.tab === 'appointment'}">
                        <span class="w-100 d-flex justify-content-center">
                            <span
                                class="notification-icon w-51 h-51 rounded-circle d-flex justify-content-center align-items-center">
                                <img :src="`/images/portal/appointments.svg`" class="w-26 h-26" alt="calendar">
                            </span>
                        </span>
                        <span class="w-100 mt-2 text-center fw-bold d-none d-md-inline-block">Appointments</span>
                    </button>

                    <!-- review btn -->
                    <button class="notification-button mb-0 mb-md-3" @click="setTab('review')"
                            :class="{'active' : this.tab === 'review'}">
                        <span class="w-100 d-flex justify-content-center">
                            <span
                                class="notification-icon w-51 h-51 rounded-circle d-flex justify-content-center align-items-center">
                                <img :src="`/images/portal/star.svg`" class="w-26 h-26" alt="star">
                            </span>
                        </span>
                        <span class="w-100 mt-2 text-center fw-bold d-none d-md-inline-block">Reviews</span>
                    </button>

                    <!-- tips btn -->
                    <button class="notification-button mb-0 mb-md-3" @click="setTab('tips')"
                            :class="{'active' : this.tab === 'tips'}">
                        <span class="w-100 d-flex justify-content-center">
                            <span
                                class="notification-icon w-51 h-51 rounded-circle d-flex justify-content-center align-items-center">
                                <img :src="`/images/portal/tips.svg`" class=" w-26 h-26" alt="tips">
                            </span>
                        </span>
                        <span class="w-100 mt-2 text-center fw-bold d-none d-md-inline-block">Tips</span>
                    </button>

                    <!-- tag btn -->
                    <button class="notification-button mb-0 mb-md-3" @click="setTab('online-sales')"
                            :class="{'active' : this.tab === 'online-sales'}">
                        <span class="w-100 d-flex justify-content-center">
                            <span
                                class="notification-icon w-51 h-51 rounded-circle d-flex justify-content-center align-items-center">
                                <img :src="`/images/portal/tag.svg`" class="w-26 h-26" alt="tips">
                            </span>
                        </span>
                        <span class="w-100 mt-2 text-center fw-bold d-none d-md-inline-block">Online Sales</span>
                    </button>

                    <!-- actions btn -->
                    <button class="notification-button mb-0 mb-md-3" @click="setTab('actions')"
                            :class="{'active' : this.tab === 'actions'}">
                        <span class="w-100 d-flex justify-content-center">
                            <span
                                class="notification-icon w-51 h-51 rounded-circle d-flex justify-content-center align-items-center">
                                <img :src="`/images/portal/actions.svg`" class="w-26 h-26" alt="actions">
                            </span>
                        </span>
                        <span class="w-100 mt-2 text-center fw-bold d-none d-md-inline-block">Actions</span>
                    </button>

                </div>

                <!-- Appointment content -->
                <div class="notification-content-group p-3" v-if="tab === 'appointment'">

                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="font-size-21 fw-bolder ps-4 ps-md-0">
                            Appointments
                        </span>
                        <button type="button"
                                class="w-45 h-45 bg-white btn-gear border-0 d-flex justify-content-center align-items-center rounded-circle">
                            <img :src="`/images/global/settings.svg`" class="w-21 h-21" alt="settings">
                        </button>
                    </div>

                    <div class="notification-body">
                        <!--Empty screen-->
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center"
                             v-if="appointmentTableData.length === 0">
                            <epmty-screen :title="'appointments'"/>
                        </div>


                        <div class="p-3">

                            <div
                                class="shadow rounded-3 bg-white py-3 ps-3 pe-4 d-flex align-items-center justify-content-start mb-2"
                                v-for="each in appointmentTableData">
                                <div class="position-relative customer-appointment">
                                    <img :src="each.file_path" class="w-64 h-64 rounded-circle" alt="avatar">
                                    <div
                                        class="position-absolute appointment-icon w-24 h-24 d-flex justify-content-center align-items-center rounded-circle">
                                        <img :src="`/images/portal/appointments.svg`" class="w-12 h-12"
                                             alt="appointments">
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <div class="fw-semibold">
                                        {{ each.name }} booked <span v-if="each.status === 1">online</span> <span
                                        v-if="each.status === 2">offline</span> BDT {{ each.amount }}
                                    </div>
                                    <small class="d-block text-secondary">
                                        34 seconds ago
                                    </small>
                                    <div class="fw-semibold">
                                        16:00 today service one booked on Book Now link with 52
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Review content -->
                <div class="notification-content-group p-3" v-if="tab === 'review'">

                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="font-size-21 fw-bolder ps-4 ps-md-0">
                            Reviews
                        </span>
                        <button type="button"
                                class="w-45 h-45 bg-white btn-gear border-0 d-flex justify-content-center align-items-center rounded-circle">
                            <img :src="`/images/global/settings.svg`" class="w-21 h-21" alt="settings">
                        </button>
                    </div>

                    <div class="notification-body">

                        <!--Empty screen-->
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center"
                             v-if="reviewTableData.length === 0">
                            <epmty-screen :title="'reviews'"/>
                        </div>

                        <div class="p-3">
                            <div class="shadow rounded-3 bg-white py-3 ps-3 pe-4 mb-2" v-for="each in reviewTableData">
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="position-relative customer-appointment">
                                        <img :src="each.file_path" class="w-64 h-64 rounded-circle" alt="avatar">
                                        <div
                                            class="position-absolute appointment-icon w-24 h-24 d-flex justify-content-center align-items-center rounded-circle">
                                            <img :src="`/images/portal/appointments.svg`" class="w-12 h-12"
                                                 alt="appointments">
                                        </div>
                                    </div>
                                    <div class="ms-2">
                                        <div class="fw-semibold">
                                            5 star review from John doe
                                        </div>
                                        <small class="d-block text-secondary">
                                            2 min ago
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start mt-3">
                                    <img :src="`/images/portal/star-golden.svg`" class="w-19 h-19 me-1"
                                         alt="star-golden">
                                    <img :src="`/images/portal/star-golden.svg`" class="w-19 h-19 me-1"
                                         alt="star-golden">
                                    <img :src="`/images/portal/star-golden.svg`" class="w-19 h-19 me-1"
                                         alt="star-golden">
                                    <img :src="`/images/portal/star-golden.svg`" class="w-19 h-19 me-1"
                                         alt="star-golden">
                                    <img :src="`/images/portal/star-golden.svg`" class="w-19 h-19" alt="star-golden">
                                </div>
                                <div class="mt-2 text-secondary text-opacity-75">
                                    this is so google for me. i am confortable with this activities
                                </div>
                                <button type="button"
                                        class="btn btn-white padding-x-12 padding-y-10 mt-3 border rounded-pill">
                                    <img :src="`/images/portal/chat.svg`" class="w-19 h-19 me-2" alt="chat"> Reply
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Tips content -->
                <div class="notification-content-group p-3" v-if="tab === 'tips'">

                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="font-size-21 fw-bolder ps-4 ps-md-0">
                            Tips
                        </span>
                        <button type="button"
                                class="w-45 h-45 bg-white btn-gear border-0 d-flex justify-content-center align-items-center rounded-circle">
                            <img :src="`/images/global/settings.svg`" class="w-21 h-21" alt="settings">
                        </button>
                    </div>

                    <div class="notification-body">
                        <!--Empty screen-->
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                            <epmty-screen :title="'tips'"/>
                        </div>
                    </div>

                </div>

                <!-- Online sales content -->
                <div class="notification-content-group p-3" v-if="tab === 'online-sales'">

                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="font-size-21 fw-bolder ps-4 ps-md-0">
                            Online Sales
                        </span>
                        <span class="d-flex align-items-center">
                            <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim me-2">
                                see all review
                            </a>
                            <button type="button"
                                    class="w-45 h-45 bg-white btn-gear border-0 d-flex justify-content-center align-items-center rounded-circle">
                                <img :src="`/images/global/settings.svg`" class="w-21 h-21" alt="settings">
                            </button>
                        </span>
                    </div>

                    <div class="notification-body">
                        <!--Empty screen-->
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                            <epmty-screen :title="'online sales'"/>
                        </div>
                    </div>

                </div>

                <!-- Actions content -->
                <div class="notification-content-group p-3" v-if="tab === 'actions'">

                    <div class="d-flex justify-content-between align-items-center p-3">
                        <span class="font-size-21 fw-bolder ps-4 ps-md-0">
                            Actions
                        </span>
                        <span class="d-flex align-items-center">
                            <span class="dropdown me-2">
                                <button type="button"
                                        class="btn btn-white has-border padding-y-10 padding-x-12 w-130 dropdown-toggle border-radius-10"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ actionsText }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-0 m-0 overflow-hidden">
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item px-3 py-2"
                                           @click="insertActionText($event)">
                                            All Actions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item px-3 py-2"
                                           @click="insertActionText($event)">
                                            Stock
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item px-3 py-2"
                                           @click="insertActionText($event)">
                                            Marketing
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="dropdown-item px-3 py-2"
                                           @click="insertActionText($event)">
                                            Pay run
                                        </a>
                                    </li>
                                </ul>
                            </span>
                            <button type="button"
                                    class="w-45 h-45 bg-white btn-gear border-0 d-flex justify-content-center align-items-center rounded-circle">
                                <img :src="`/images/global/settings.svg`" class="w-21 h-21" alt="settings">
                            </button>
                        </span>
                    </div>

                    <div class="notification-body">
                        <!--Empty screen-->
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                            <epmty-screen :title="'actions'"/>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!--header action end  -->
    </div>
</template>

<script>
import apiService from "../../../../services/apiService";
import apiRoutes from "../../../../services/apiRoutes.js";
import avatarImage from "../../../../components/avatarImage.vue";
import {createToaster} from "@meforma/vue-toaster";

const toaster = createToaster({
    position: 'top-left',
});

import epmtyScreen from "../../../../components/empty-screen.vue"
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";
import axios from "axios";

export default {
    components: {
        epmtyScreen, avatarImage
    },
    data() {
        return {
            loading: false,
            searchPopup: false,
            suggestionPopup: false,
            headerDropdownPopup: false,
            searchParam: '',
            getProfileLoading: false,
            profileData: null,
            userData: window.core.UserInfo,
            tab: 'appointment',
            actionsText: 'All Actions',
            notificationSidebar: false,
            appointmentTableData: [
                {
                    id: '1',
                    file_path: '/images/home/customer/customer-image-01.jpg',
                    name: 'Noyon',
                    amount: '31.50',
                    status: '1'
                },
                {
                    id: '1',
                    file_path: '/images/home/customer/customer-image-02.jpg',
                    name: 'Noyon',
                    amount: '31.50',
                    status: '1'
                },
                {
                    id: '1',
                    file_path: '/images/home/customer/customer-image-03.jpg',
                    name: 'Noyon',
                    amount: '31.50',
                    status: '1'
                },
            ],

            reviewTableData: [
                {
                    id: '1',
                    file_path: '/images/home/customer/customer-image-01.jpg',
                    name: 'Noyon',
                    amount: '31.50',
                    status: '1'
                },
            ],
            newsSidebar: false,
            nav: false,
        }
    },
    created() {
        // Listen for UserInfo update event
        EventBus.$on('updateUserInfo', updatedUserInfo => {
            // Update userInfo with the received data
            this.userData = updatedUserInfo;
            this.profileData = updatedUserInfo;
        });
    },
    mounted() {
        /*This function makes the popup visible/ invisible*/
        this.popupHandler();

    },
    methods: {

        /*This function makes the popup visible/ invisible*/
        popupHandler() {
            document.addEventListener('click', (event) => {

                // for header dropdown Popup
                const headerDropdownContainer = document.querySelector('.header-dropdown');
                const user = document.querySelector('.user-avatar')
                if (headerDropdownContainer != null) {
                    this.headerDropdownPopup = !(!headerDropdownContainer.contains(event.target) && !user.contains(event.target));
                }

                // for Suggestion Popup
                const suggestionContainer = document.querySelector('.suggestion-popup');
                const inputField = document.querySelector('.search-input');
                if (suggestionContainer != null) {
                    this.suggestionPopup = !(!suggestionContainer.contains(event.target) && !inputField.contains(event.target));
                }

                // for news sidebar dropdown Popup
                const newsSideContainer = document.querySelector('.news-sidebar');
                const newsController = document.querySelector('.news-controller');
                const newsClose = document.querySelector('.news-close');
                if (newsSideContainer != null) {
                    this.newsSidebar = !(!newsSideContainer.contains(event.target) && !newsController.contains(event.target)) && !newsClose.contains(event.target);
                }

                // for notification sidebar
                const notificationContainer = document.querySelector('.notification-sidebar');
                const notificationController = document.querySelector('.notification-controller');
                const notificationClose = document.querySelector('.notification-close');
                if (notificationContainer != null) {
                    this.notificationSidebar = !(!notificationContainer.contains(event.target) && !notificationController.contains(event.target)) && !notificationClose.contains(event.target);
                }
            })
        },


        /*Logout api*/
        logout() {
            apiService.ClearErrorHandler()
            this.loading = true;
            axios.get(apiRoutes.Logout, {params: null}, {headers: apiService.headerContent}).then((response) => {
                this.loading = false;
                window.location.reload()
            }).catch(err => {
                this.loading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        setTab(tab) {
            this.tab = tab
        },

        insertActionText(e) {
            this.actionsText = e.target.innerText
        },

        /*Function to toggle the sidenav*/
        toggleNav() {
            this.nav = true;
            EventBus.$emit('NavToggle', this.nav);
        },

    },
}

</script>
