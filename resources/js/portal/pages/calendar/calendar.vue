<template>
    <div>
        <div class="calendar">
            <div class="calendar-header d-flex justify-content-between align-items-center p-15">

                <div class="w-100">
                    <!-- staff select dropdown -->
                    <div class="form-group">
                        <select name="teamDate" class="w-100 form-select staff-select shadow-none"
                                v-model="bookingFormData.team_member_id" @change="getBookings">
                            <option value="">All</option>
                            <option :value="each.id" v-for="each in teamMemberData" v-if="teamMemberData.length > 0">
                                {{ each.first_name + ' ' + each.last_name }}
                            </option>
                            <option disabled v-if="teamData.length === 0">No member found!</option>
                        </select>

                        <!--                    <select name="durationDay" class="form-select day-select ms-3  shadow-none"-->
                        <!--                            v-model="calendarOptions.views.timeGridSevenDay.duration.days">-->
                        <!--                        <option :value="1">day</option>-->
                        <!--                        <option :value="3">3 day</option>-->
                        <!--                        <option :value="7">Week</option>-->
                        <!--                    </select>-->
                    </div>
                </div>

                <div class="w-100">
                    <div class="form-group cal-grp d-flex align-items-center flex-1 middle w-100">
                        <button class="btn prev" @click="previousDay" data-toggle>
                            <img :src="`/images/global/caret-left.svg`" class="w-20 h-20" alt="">
                        </button>

                        <input id="calendarDateSingle" type="date"
                               class="form-control calendar-date text-center mx-1 mx-sm-3">

                        <input id="calendarDate" class="form-control text-center d-none calendar-date mx-sm-3 mx-1"
                               readonly/>

                        <button class="btn next" @click="nextDay" data-toggle>
                            <img :src="`/images/global/caret-right.svg`" class="w-20 h-20" alt="">
                        </button>
                    </div>
                </div>

                <div class="w-100 d-flex justify-content-end">
                    <div class="calendar-action-buttons d-sm-flex right justify-content-end w-100">

                        <button type="button"
                                class="btn btn-outline-theme padding-x-12 padding-y-10 me-0 me-sm-2 mb-3 mb-sm-0"
                                @click="bookingPopUp('block-time-popup')">
                            <span class="btn-text">Block Out Time</span>
                        </button>

                        <!-- calendar action button -->
                        <button type="button" class="btn btn-theme padding-x-12"
                                @click="bookingTimeCheck">
                            New Booking
                        </button>

                    </div>
                </div>

            </div>


            <div class="w-100 d-flex justify-content-between">
                <!--calendar start-->
                <div class="main-calendar" id="main-calendar">

                    <!-- help in scroll left and right -->
                    <div
                        class="d-flex justify-content-between align-items-center position-absolute top-0 start-0 w-100 z-2 pt-2 pt-sm-4 px-2 px-sm-3"
                        v-if="teamData.length > 1">
                        <button type="button" class="btn btn-light w-48 h-48 rounded-circle"
                                @click="scrollCalendarLeft">
                            <img :src="`/images/portal/arrow-left.svg`" class="w-24 h-24" alt="arrow-left">
                        </button>
                        <button type="button" class="btn btn-light w-48 h-48 rounded-circle"
                                @click="scrollCalendarRight">
                            <img :src="`/images/portal/arrow-right.svg`" class="w-24 h-24" alt="arrow-right">
                        </button>
                    </div>

                    <div class="scrollbar team-box shadow-sm d-flex bg-white pt-3 pb-3 position-relative"
                         id="content-left-right-control">
                        <div class="each-wrapper dropdown-center" v-for="(each, index) in teamData"
                             @click="">
                            <a class="each mt-4 mt-md-0 mb-3" role="button" data-bs-target="#memberOption"
                               data-bs-toggle="dropdown"
                               aria-expanded="false" @click="passIdtoList(each.id);step = ''">
                                <div class="avatar-wrap position-relative">

                                    <!-- avatar image -->
                                    <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar" :size="'lg'"/>

                                    <ul class="dropdown-menu team-drop shadow-sm border-radius-10" id="memberOption">
                                        <div class="fw-semibold px-3 my-2">Calendar views</div>

                                        <!--                                        <li>-->
                                        <!--                                            <a class="dropdown-item" href="javascript:void(0)"-->
                                        <!--                                               @click="calendarOptions.views.timeGridSevenDay.duration.days = 1">Day view-->
                                        <!--                                            </a>-->
                                        <!--                                        </li>-->
                                        <!--                                        <li>-->
                                        <!--                                            <a class="dropdown-item" href="javascript:void(0)"-->
                                        <!--                                               @click="calendarOptions.views.timeGridSevenDay.duration.days = 3">3 day view-->
                                        <!--                                            </a>-->
                                        <!--                                        </li>-->
                                        <!--                                        <li>-->
                                        <!--                                            <a class="dropdown-item" href="javascript:void(0)"-->
                                        <!--                                               @click="calendarOptions.views.timeGridSevenDay.duration.days = 7">Week view-->
                                        <!--                                            </a>-->
                                        <!--                                        </li>-->

                                        <div class="fw-semibold px-3 my-2">Schedule</div>

                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                               @click="step = 'block-time-popup'">Add
                                                blocked time</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)">Edit shift</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)">Edit time off</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"
                                               class="dropdown-item" @click="teamEditRoute(each.id)">Edit team member
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="name text-center">{{ each.first_name + ' ' + each.last_name }}</div>
                            </a>
                            <FullCalendar :ref="'fullCalendar_' + index" :options="generateCalendarOptions(each)"
                                          @click="passIdtoList(each.id)"
                                          @datesRender="previousDay"/>
                        </div>
                    </div>
                </div>
                <!--calendar end  -->

            </div>


            <!--This backdrop shadow will be visible when any of these popup is visible-->
            <div class="backdrop-shadow" @click="bookingPopUp(null);"
                 :class="{'active' : step === 'new-booking' || step === 'select-customer' ||step === 'change-selected-date' || step === 'new-customer' || step === 'service-popup' || step === 'block-time-popup' || step === 'event-view'}"></div>

            <!-- New booking popup -->
            <div class="booking new-booking-popup" :class="{'active' : step == 'new-booking'}">

                <!-- booking header -->
                <div class="booking-header">
                    <div class="header-title">New Booking</div>

                    <!--close btn-->
                    <a href="javascript:void(0)" class="booking-close-btn"
                       @click="bookingPopUp(null);">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </a>

                </div>

                <!-- Booking type selection -->
                <div
                    class="padding-x-15 padding-md-x-40 padding-top-15 padding-top-md-20 padding-bottom-15 padding-md-bottom-45 ">
                    <div class="label margin-bottom-16 margin-md-bottom-38">Customer</div>

                    <div class="form-group d-flex justify-content-between align-items-center position-relative">

                        <!-- Select customer button -->
                        <a href="javascript:void(0)" @click="bookingPopUp('select-customer')"
                           v-if="customerInsertData == null"
                           class="booking-light-btn d-flex justify-content-between align-items-center">
                            <span class=" d-flex align-items-center">
                                <img class="margin-right-12" :src="`/images/portal/booking-customer-select.svg`"
                                     alt="booking customer select">
                                Select Customer
                            </span>
                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>

                        <!-- Select customer button selected -->

                        <a href="javascript:void(0)" @click="bookingPopUp('select-customer')"
                           v-if="customerInsertData !== null"
                           class="booking-light-btn d-flex justify-content-between align-items-center active">
                            <div class="customer-info">
                                <div class="avatar">
                                    <!-- avatar image -->
                                    <avatarImage :name="customerInsertData.first_name + '' + customerInsertData.last_name" :avatar="customerInsertData.avatar" :size="'md'"/>
                                </div>
                                <div class="">
                                    <div class="font-weight-700">
                                        {{ customerInsertData.first_name + ' ' + customerInsertData.last_name }}
                                    </div>
                                    <div class="font-weight-400">
                                        <span v-if="customerInsertData.mobile">
                                            {{ customerInsertData.mobile }}
                                        </span>
                                        <span v-else>
                                            N/A
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>

                        <a href="javascript:void(0)" class="margin-right-3 selected-customer-x position-absolute"
                           @click="customerRemove"
                           v-if="customerInsertData !== null">
                            <img :src="`/images/global/x-white.svg`" alt="x white">
                        </a>


                        <div class="text-theme">Or</div>

                        <!--walk in service button-->
                        <a href="javascript:void(0)"
                           class="booking-light-btn d-flex justify-content-between align-items-center height-50 disable-feature"
                           :class="walkInService === true ? 'active' : '' " @click="walkInService = !walkInService">
                            <span class=" d-flex align-items-center">
                                <img class="margin-right-12" :src="`/images/portal/walk-in-service.svg`"
                                     alt="walk in service">
                                Walk In Service
                            </span>
                        </a>

                    </div>
                </div>

                <div class="booking-divider"></div>

                <!-- date section -->
                <div
                    class="padding-x-15 padding-md-x-40 padding-top-15 padding-md-top-20 padding-bottom-15 padding-md-bottom-45">
                    <div class="label margin-bottom-28">Date</div>

                    <div class="form-group d-flex justify-content-between align-items-center">

                        <!--date selection button-->
                        <a href="javascript:void(0)" v-if="bookingParam.booking_date_view != null"
                           @click="bookingPopUp('change-selected-date');"
                           class="booking-light-btn d-flex justify-content-between align-items-center padding-y-18 active">
                            <span>
                                <strong>{{ bookingParam.booking_date_view }}</strong>
                            </span>
                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>
                        <a href="javascript:void(0)" v-if="bookingParam.booking_date_view == null"
                           @click="bookingPopUp('change-selected-date');"
                           class="booking-light-btn d-flex justify-content-between align-items-center padding-y-18 active">
                            <span>
                                <strong>Select Date</strong>
                            </span>
                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>

                        <!--repeat button-->
                        <a href="javascript:void(0)"
                           class="booking-light-btn d-flex justify-content-between align-items-center height-50 disable-feature">
                            <span class="margin-left-7">
                                Does not repeat
                            </span>
                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>
                    </div>
                </div>

                <div class="booking-divider"></div>

                <!-- Service section -->
                <div
                    class="padding-x-15 padding-md-x-40 padding-y-15 padding-md-y-28 service-section overflow-y-scroll scrollbar">

                    <div class="label margin-bottom-28">Service</div>

                    <!-- insert service -->
                    <div v-if="bookingParam.booking_items.length > 0 && listLoading === false">
                        <div class="rounded-3 mt-3 cursor-pointer" :style="'border-left: 5px solid '+service.color"
                             v-for="(service,index) in bookingParam.booking_items">
                            <div class="p-3 border rounded-1 position-relative">
                                <div class="fw-bold"> {{ service.name }}</div>
                                <div class="text-secondary text-opacity-75">
                                    {{ service.start_time }} - {{ service.end_time }} (
                                    {{ formatDuration(service.duration) }} )
                                </div>
                                <div class="text-secondary text-opacity-75"> Price: {{ service.price }}</div>

                                <a href="javascript:void(0)" class="margin-right-3 bg-danger position-absolute remove-x"
                                   @click="bookingParam.booking_items.splice(index,1)">
                                    <img class="w-10 h-10" :src="`/images/global/x-white.svg`" alt="x white">
                                </a>
                            </div>


                        </div>
                    </div>

                    <div class="form-group my-3">

                        <!-- Add service button -->
                        <a href="javascript:void(0)" @click="categoryServiceList();bookingPopUp('service-popup');"
                           class="booking-light-btn d-flex justify-content-between align-items-center height-50">
                            <span class="margin-left-7">
                                Add a service
                            </span>
                            <span class="margin-right-5">
                                <img :src="`/images/global/chevron-right.svg`" alt="chevron right">
                            </span>
                        </a>

                    </div>

                </div>

                <div class="w-100 bottom-0 start-0 border bg-white">
                    <div class="px-0 px-md-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center fw-bold p-3">
                            <div> Total</div>
                            <div> BDT {{ getTotalPrice() }} ({{ getTotalDuration() }})</div>
                        </div>
                        <div class="px-4">
                            <div class="row justify-content-between align-items-center">
                                <button type="button" class="btn btn-white has-border col-5 h-45 rounded-3">
                                    Checkout
                                </button>
                                <button type="button" class="btn btn-theme col-5 h-45 rounded-3"
                                        @click="createBooking()" v-if="!bookingLoading">
                                    Save
                                </button>

                                <button type="button"
                                        class="btn-theme d-flex align-items-center justify-content-center col-5 h-45 btn-loading"
                                        v-if="bookingLoading">
                                    <span class="loading"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--select customer popup start-->
            <div class="booking select-customer-popup" :class="{'active' : step === 'select-customer'}">

                <!-- booking header -->
                <div class="booking-header">
                    <div class="header-title d-flex align-items-center">
                        <a href="javascript:void(0)" class="booking-close-btn margin-sm-right-30 margin-right-15 "
                           @click="bookingPopUp('new-booking');checkIfSingle(this.isCustomer)">
                            <img :src="`/images/global/arrow-left.svg`" alt="arrow left">
                        </a>
                        Select Customer
                    </div>

                    <!--close btn-->
                    <a href="javascript:void(0)" class="booking-close-btn margin-left-10"
                       @click="bookingPopUp(null)">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </a>

                </div>

                <!-- customer search section -->
                <div
                    class="padding-x-15 padding-md-x-40 padding-top-15 padding-md-top-20 padding-bottom-15 padding-md-bottom-50">
                    <div class="label margin-bottom-20">
                        Customer
                    </div>

                    <!-- customer search input -->
                    <div class="customer-search-input-wrapper d-flex justify-content-between align-items-center">
                        <div class="w-100">
                            <div class="position-relative w-100">
                                <input type="text" class="form-control" name="keyword" v-model="formData.keyword"
                                       @keyup="customerSearchData()" placeholder="Search">
                                <div class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                    <img :src="`/images/global/search.svg`" class="w-24 h-24" alt="search">
                                </div>
                            </div>
                        </div>

                        <div class="ms-2">
                            <button type="button"
                                    class="btn btn-theme d-flex justify-content-center align-items-center padding-x-12 padding-y-10 new-res-btn height-50 width-50"
                                    @click="bookingPopUp('new-customer')">
                                <span class="new-res-text me-2"> New </span> <img :src="`/images/portal/plus-white.svg`"
                                                                                  class="w-15 h-15" alt="plus-white">
                            </button>
                        </div>
                    </div>

                </div>

                <div class="booking-divider"></div>

                <!-- customer list section -->
                <div class="p-2 p-md-4" v-if="customerTableData.length > 0 && listLoading === false">
                    <table class="customer-list table">
                        <tbody>
                        <tr class="each-customer px-3" v-for="(each) in customerTableData">
                            <td class="padding-left-16">
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="me-2">
                                        <!-- avatar image -->
                                        <avatarImage :name="each.first_name + '' + each.last_name" :avatar="each.avatar"/>
                                    </div>
                                    <div class="w-160 text-truncate">
                                        {{ each.first_name + ' ' + each.last_name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-none d-md-inline-block text-opacity-75 text-secondary text-truncate">
                                    <span v-if="each.mobile">
                                        {{ each.mobile }}
                                    </span>
                                    <span v-else>
                                        N/A
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-none d-lg-inline-block text-opacity-75 text-secondary text-truncate">
                                    {{ each.email }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end padding-right-16">
                                    <button type="button" class="btn btn-outline-theme w-112"
                                            @click="customerInsertSingleData(each)">
                                        <span class="btn-text">
                                            {{ bookingParam.customer_id === each.id ? 'Selected' : 'Select' }}
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--customer list section end  -->

                <!-- Loading -->
                <appLoader v-if="listLoading"/>


                <!--No data-->
                <empty-screen
                    class="h-70-percent"
                    :title="'customer'"
                    :sub_title="`Click “New +” to create new customer.`"
                    :btn_title="`New`"
                    :btn="true"
                    :plus-icon="true"
                    v-if="customerTableData.length === 0 && listLoading === false"
                    @click="bookingPopUp('new-customer')"
                />

            </div>
            <!--select customer popup end  -->

            <!--add new customer popup start-->
            <div class="booking add-new-customer-popup" :class="{'active' : step === 'new-customer'}">
                <form @submit.prevent="createCustomer" autocomplete="off">

                    <!--booking header start-->
                    <div class="booking-header">
                        <div class="header-title d-flex align-items-center">

                            <a href="javascript:void(0)"
                               class="booking-close-btn margin-sm-right-30 margin-right-15 "
                               @click="bookingPopUp('new-booking')">
                                <img :src="`/images/global/arrow-left.svg`" alt="arrow left">
                            </a>

                            Add New Customer
                        </div>

                        <!--close btn-->
                        <div class="new-customer-header-action d-flex align-items-center">
                            <button type="button" class="booking-close-btn margin-left-10"
                                    @click="bookingPopUp(null)">
                                <img :src="`/images/global/x.svg`" alt="x">
                            </button>

                        </div>
                        <!--close btn-->
                    </div>
                    <!--booking header end  -->


                    <!--new customer form section start-->
                    <div class="padding-x-15 padding-y-15 padding-md-x-40 padding-md-y-30">
                        <div class="d-grid grid-template-col-md-2 gap-x-24">
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">First Name</div>
                                    <input type="text" class="form-control" placeholder="Enter first name"
                                           name="first_name" v-model="customerParam.first_name" autocomplete="off">
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">Last Name</div>
                                    <input type="text" class="form-control" placeholder="Enter last name"
                                           name="last_name" v-model="customerParam.last_name" autocomplete="off">
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">Email Address</div>
                                    <input type="email" class="form-control" placeholder="Enter email address"
                                           name="email" v-model="customerParam.email" autocomplete="off">
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">Mobile Number</div>
                                    <input type="text" class="form-control" placeholder="Enter mobile number"
                                           name="phone" v-model="customerParam.mobile" autocomplete="off"
                                           @keypress="checkNumber($event)">
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">Gender</div>
                                    <select name="gender" v-model="customerParam.gender"
                                            class="form-select border-radius-10">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">no-binary</option>
                                        <option value="4">prefer not to say</option>
                                    </select>
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <div class="label margin-bottom-5 margin-md-bottom-10">Date of birth</div>
                                    <input id="dob" type="text" class="form-control" v-model="customerParam.dob"
                                           name="dob" autocomplete="off">
                                    <div class="error-report"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="label margin-bottom-5 margin-md-bottom-10">Select Language</div>
                                <select id="select_language" v-model="customerParam.language" name="language"
                                        class="form-select padding-x-20">
                                    <option value="">Select Language</option>
                                    <option v-if="languages.length > 0" v-for="each in languages"
                                            :value="each.name">
                                        {{ each.name }}
                                    </option>
                                    <option v-if="languages.length === 0" disabled>
                                        No data!
                                    </option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <!--new customer form section end  -->

                    <div class="booking-divider"></div>

                    <div
                        class="padding-x-15 padding-md-x-40 padding-top-15 padding-md-top-30 padding-bottom-15 padding-md-bottom-45">

                        <div class="margin-md-bottom-43 margin-bottom-15">
                            <div class="font-size-18 font-weight-600 padding-bottom-10">
                                Important customer info
                            </div>
                            <div class="font-weight-400">
                                Important customer info will only be visible to you and team members.
                            </div>
                        </div>

                        <div class="margin-md-bottom-43 margin-bottom-15">
                            <div class="form-group padding-bottom-16">
                                <label for="customer_info" class="form-label">Customer info</label>
                                <textarea v-model="customerParam.clients_info" name="clients_info"
                                          placeholder="Enter customer info" id="customer_info" cols="30" rows="5"
                                          class="form-textarea padding-20" autocomplete="off"></textarea>
                            </div>
                            <label for="display" class="form-label">
                                <input id="display" type="checkbox" name="display_booking"
                                       :checked="customerParam.display_booking === 1"
                                       @change="toggleSwitch('display_booking')" class="form-checkbox margin-right-10"
                                       autocomplete="off">
                                display on all bookings
                            </label>
                        </div>

                        <div class="margin-md-bottom-43 margin-bottom-15">
                            <div class="form-group">
                                <div class="label margin-bottom-10">Address</div>
                                <input type="text" id="google_autocomplete" v-model="customerParam.address"
                                       name="address" class="form-control"
                                       placeholder="Start typing to search your address" autocomplete="off">
                                <div class="error-report"></div>
                            </div>
                        </div>

                        <div class="d-grid grid-template-col-md-2 gap-x-24">
                            <div class="margin-md-bottom-43 margin-bottom-20">
                                <div class="form-group">
                                    <label for="address" class="form-label">Apt/Suite etc</label>
                                    <input type="text" class="form-control" name="apartment"
                                           placeholder="Enter Apt/Suite etc" v-model="customerParam.apartment">
                                </div>
                            </div>
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <label for="address" class="form-label">District</label>
                                    <input type="text" class="form-control" name="district" placeholder="Enter District"
                                           v-model="customerParam.district">
                                </div>
                            </div>
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <label for="address" class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter City"
                                           v-model="customerParam.city">
                                </div>
                            </div>
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <label for="address" class="form-label">Region</label>
                                    <input type="text" class="form-control" name="region" placeholder="Enter Region"
                                           v-model="customerParam.region">
                                </div>
                            </div>
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <label for="address" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" name="post_code"
                                           placeholder="Enter Post code" v-model="customerParam.post_code">
                                </div>
                            </div>
                            <div class="margin-md-bottom-43 margin-bottom-15">
                                <div class="form-group">
                                    <label for="address" class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Enter Country"
                                           v-model="customerParam.country">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="booking-divider"></div>

                    <!--notification section start-->
                    <div
                        class="padding-x-15 padding-md-x-40 padding-top-15 padding-md-top-30 padding-bottom-15 padding-md-bottom-45">
                        <div class="label margin-bottom-23">
                            Notifications
                        </div>

                        <div
                            class="each-notification d-flex align-items-center justify-content-between margin-bottom-25">
                            <div class="text">
                                Email notifications
                            </div>
                            <div class="toggle">
                                <input type="checkbox" :checked="customerParam.email_notification === 1"
                                       @change="toggleSwitch('email_notification')"/>
                                <label></label>
                            </div>
                        </div>

                        <div
                            class="each-notification d-flex align-items-center justify-content-between margin-bottom-25">
                            <div class="text">
                                Marketing notifications
                            </div>
                            <div class="toggle">
                                <input type="checkbox" :checked="customerParam.email_marketing_notification === 1"
                                       @change="toggleSwitch('email_marketing_notification')"/>
                                <label></label>
                            </div>
                        </div>

                        <div class="each-notification d-flex align-items-center justify-content-between">
                            <div class="text">
                                Text message notifications
                            </div>
                            <div class="toggle">
                                <input type="checkbox" :checked="customerParam.text_message_notification === 1"
                                       @change="toggleSwitch('text_message_notification')"/>
                                <label></label>
                            </div>
                        </div>

                    </div>
                    <!--notification section end  -->

                    <div
                        class="padding-x-15 padding-md-x-40 padding-top-15 padding-md-top-30 padding-bottom-15 padding-md-bottom-45 text-md-end">
                        <button type="submit" class="btn btn-theme w-100" v-if="!customerLoading">
                            Save
                        </button>
                        <button type="button"
                                class="btn-theme ms-auto d-flex align-items-center justify-content-center w-100 btn-loading"
                                v-if="customerLoading">
                            <span class="loading"></span>
                        </button>
                    </div>
                </form>
            </div>
            <!--add new customer popup end  -->

            <!--Service select popup start-->
            <div class="booking service-select-popup" :class="{'active' : step === 'service-popup'}">

                <!--booking header start-->
                <div class="booking-header">
                    <div class="header-title d-flex align-items-center">

                        <a href="javascript:void(0)" class="booking-close-btn margin-sm-right-30 margin-right-15 "
                           @click="bookingPopUp('new-booking');checkIfSingle(this.isService)">
                            <img :src="`/images/global/arrow-left.svg`" alt="arrow left">
                        </a>

                        Select Service
                    </div>

                    <!--close btn-->
                    <a href="javascript:void(0)" class="booking-close-btn"
                       @click="bookingPopUp(null);">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </a>
                    <!--close btn-->
                </div>
                <!--booking header end  -->

                <!--service search section start-->
                <div class="padding-15 padding-md-40">

                    <!--service search input start-->
                    <div class="service-search-input-wrapper d-block">

                        <div class="position-relative">
                            <input type="text" class="form-control" name="keyword" v-model="serviceData.keyword"
                                   @keyup="serviceSearchData()" placeholder="Search">
                            <div class="position-absolute top-50 end-0 translate-middle-y pe-3">
                                <img :src="`/images/global/search.svg`" alt="search">
                            </div>
                        </div>

                    </div>
                    <!--service search input end  -->

                </div>
                <!--service search section end  -->

                <div class="booking-divider"></div>

                <!--service list section start-->
                <div class="padding-15 padding-md-40" v-if="serviceTableData.length > 0 && listLoading === false">

                    <div v-for="(each) in serviceTableData">
                        <div class="p-1 p-md-3">
                            <div class="service-title h3 fw-semibold d-flex justify-content-between align-items-center">
                                {{ each.name }}
                                <a href="javascript:void(0)" class="btn-option" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <img :src="`/images/portal/three-dots.svg`" alt="dots">
                                </a>
                                <ul class="dropdown-menu">
                                    <router-link :to="{name:'ServiceType',state:{id:each.id,module_name:'calendar'}}"
                                                 class="dropdown-item">
                                        Add new Service
                                    </router-link>

                                </ul>
                            </div>
                            <div class="rounded-3 mt-3 cursor-pointer"
                                 v-for="(service,index) in each.services">
                                <div class="p-3 border rounded-1 mb-2" v-for="pricing in  service.pricing"
                                     @click="pushService(service, pricing)"
                                     :style="'border-left: 5px solid '+each.color+'!important'">
                                    <div class="fw-bold">
                                        {{ service.name }}
                                    </div>
                                    <div class="text-secondary text-opacity-75">
                                        {{ formatDuration(pricing.duration) }}
                                    </div>
                                    <div class="text-secondary text-opacity-75">
                                        Price: {{ pricing.price }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="d-flex justify-content-center flex-column align-items-center no-data h-106 border"
                                :style="'border-left: 5px solid '+each.color+'!important'"
                                v-if="each.services.length === 0 && listLoading === false">
                                <div class="font-weight-300 text-center font-size-16">
                                    This catalogue does not have any services
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--service list section end  -->

                <!-- Loading -->
                <appLoader v-if="listLoading"/>

                <!--No data-->
                <empty-screen
                    class="h-70-percent"
                    :title="'category'"
                    :sub_title="`Click “New Category” to create new category.`"
                    :btn="true"
                    :btn_title="`New Category`"
                    v-if="serviceTableData.length === 0 && listLoading === false"
                    @handler="newCategory()"
                />

            </div>
            <!--Service select popup end  -->

            <!--Block time popup start-->
            <div class="booking block-time-popup" :class="{'active' : step === 'block-time-popup'}">

                <!--booking header start-->
                <div class="booking-header">
                    <div class="header-title">
                        Add blocked time
                    </div>

                    <!--close btn-->
                    <a href="javascript:void(0)" class="booking-close-btn"
                       @click="bookingPopUp(null)">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </a>
                    <!--close btn-->
                </div>
                <!--booking header end  -->

                <form>
                    <div class="padding-15 padding-md-40">

                        <div class="form-group mb-2 mb-md-4">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" placeholder="e.g. lunch meeting (optional)">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Team Member</label>
                                    <select name="" id="" class="form-select border-radius-10">
                                        <option value="">Select member</option>
                                        <option :value="each.id" v-for="each in teamData" v-if="teamData.length > 0">
                                            {{ each.first_name + ' ' + each.last_name }}
                                        </option>
                                        <option value="" v-if="teamData.length === 0" disabled>No member found!</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2 mb-md-4">
                                <div class="form-group">
                                    <label for="blocked-date" class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="Select date" id="blocked-date"
                                           v-model="blockedTimeParam.dateBlock" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-4">
                                <div class="form-group">
                                    <label for="formTime" class="form-label">From</label>
                                    <input id="formTime" type="text" name="formTime" class="form-control"
                                           v-model="blockedTimeParam.fromTime" placeholder="Select Time"
                                           autocomplete="off">
                                </div>
                            </div>

                            <div class="col-md-6 mb-2 mb-md-4">
                                <div class="form-group">
                                    <label for="toTime" class="form-label">To</label>
                                    <input id="toTime" type="text" name="toTime" class="form-control"
                                           v-model="blockedTimeParam.toTime" placeholder="Select Time"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Repeats</label>
                                    <select name="repeats" class="form-select border-radius-10">
                                        <option value="">Doesn't repeat</option>
                                        <option value="every_day">Every day</option>
                                        <option value="every_week">Every week</option>
                                        <option value="every_month">Every month</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="booking-divider"></div>


                    <div class="padding-15 padding-md-40">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Description <span
                                        class="text-muted">(optional)</span></label>
                                    <textarea name="" id="" class="form-control h-120" cols="30" rows="10"
                                              placeholder="Add description or note"></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="toggle d-flex align-items-center">
                                    <input type="checkbox"/>
                                    <label></label>
                                    <p class="mb-0 ms-3">Online booking allowed during blocked time</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="booking-divider"></div>


                    <div class="padding-15 padding-md-x-40 padding-md-y-30">
                        <button type="button" class="btn btn-theme w-100">Save</button>
                    </div>
                </form>

            </div>
            <!--Block time popup end  -->

            <!--Appointment details/Change selected date start-->
            <div class="booking select-customer-popup" :class="{'active' : step === 'change-selected-date'}">

                <!-- booking header -->
                <div class="booking-header">
                    <div class="header-title d-flex align-items-center">
                        <a href="javascript:void(0)" class="booking-close-btn margin-sm-right-30 margin-right-15"
                           @click="bookingPopUp('new-booking')">
                            <img :src="`/images/global/arrow-left.svg`" alt="arrow left">
                        </a>
                        Appointment details
                    </div>

                    <!--close btn-->
                    <button href="javascript:void(0)" class="booking-close-btn margin-left-10"
                            @click="bookingPopUp(null)">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </button>

                </div>

                <!-- Change Date -->
                <div class="padding-md-x-40 padding-x-15 padding-y-15 padding-md-top-20 padding-md-bottom-50">
                    <div class="label margin-md-bottom-20 margin-bottom-15">
                        Date
                    </div>
                    <div class="form-group">
                        <input id="bookingDate" class="form-control" type="text">
                    </div>


                    <div class="form-group text-end mt-3 mt-md-4">
                        <button type="button" class="btn btn-outline-dark w-25 height-50"
                                @click="bookingPopUp('new-booking')">
                            Back
                        </button>
                    </div>
                </div>
            </div>
            <!--Appointment details/Change selected date end  -->

            <!--time choosing popup start-->
            <div class="time-choose-popup" :class="{'active' : step === 'choose-time'}">
                <div class="time-header" v-if="selectedTime !== null">
                    {{ selectedTime }}
                </div>
                <div class="body">
                    <ul class="options">
                        <li class="p-2">
                            <a href="javascript:void(0)" @click="step = 'new-booking';">
                                <img class="me-2" :src="`/images/portal/calendar.svg`" alt="calendar">
                                Add appointment
                            </a>
                        </li>

                        <li class="p-2">
                            <a href="javascript:void(0)" @click="step = 'block-time-popup'">
                                <img class="me-2" :src="`/images/portal/blocked-circle.svg`" alt="blocked circle">
                                Add blocked time
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--time choosing popup end  -->

            <!--event view popup start-->
            <div class="booking event-view-popup" :class="{'active' : step === 'event-view'}">

                <!-- booking header start-->
                <div class="booking-header event-view-header pb-5">
                    <div class="header-title" v-if="BookingData !== null">
                        <span v-if="BookingData.status == 1">Booked</span>
                        <span v-if="BookingData.status == 2">Arrived</span>
                        <span v-if="BookingData.status == 3">Started</span>
                        <span v-if="BookingData.status == 4">No-show</span>
                    </div>


                    <!--Booking update options-->
                    <div class="dropdown">
                        <button type="button" class="btn h-40 border-none btn-change-status text-white fw-semibold"
                                data-bs-toggle="dropdown"
                                v-if="!statusLoading"
                                aria-expanded="false">
                            <span class="event-text">Change</span>
                            <span class="event-res-title">
                               <span v-if="BookingData?.status == 1">Pending</span>
                               <span v-if="BookingData?.status == 2">Arrived</span>
                               <span v-if="BookingData?.status == 3">Started</span>
                               <span v-if="BookingData?.status == 4">Completed</span>
                               <span v-if="BookingData?.status == 5">No-show</span>
                           </span>
                            <img class="ms-3" :src="`/images/global/chevron-down-semibold-white.svg`"
                                 alt="chevron down">
                        </button>

                        <button type="button"
                                class="btn h-40 border-none btn-change-status btn-loading text-white fw-semibold"
                                v-if="statusLoading">
                            <span class="loading"></span>
                        </button>

                        <ul class="dropdown-menu" v-if="BookingData !== null">
                            <li v-if="BookingData.status !== 1 && BookingData.status !== 5">
                                <a class="dropdown-item" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 1)">
                                    Pending
                                </a>
                            </li>
                            <li v-if="BookingData.status !== 4 && BookingData.status !== 5">
                                <a class="dropdown-item" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 4)">
                                    Confirmed
                                </a>
                            </li>
                            <li v-if="BookingData.status !== 2 && BookingData.status !== 5">
                                <a class="dropdown-item" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 2)">
                                    Arrived
                                </a>
                            </li>
                            <li v-if="BookingData.status !== 3 && BookingData.status !== 5">
                                <a class="dropdown-item" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 3)">
                                    Started
                                </a>
                            </li>
                            <li v-if="BookingData.status !== 5">
                                <a class="dropdown-item text-danger" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 5)">
                                    No-show
                                </a>
                            </li>
                            <li v-if="BookingData.status === 5">
                                <a class="dropdown-item" href="javascript:void(0)"
                                   @click="changeStatus(BookingData.id, 1)">
                                    Undo no-show
                                </a>
                            </li>
                            <li v-if="BookingData.status !== 5">
                                <a class="dropdown-item text-danger" href="javascript:void(0)"
                                   @click="openCancelAppointmentModal">
                                    Cancel
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!--close btn-->
                    <button href="javascript:void(0)" class="booking-close-btn rounded-circle margin-left-10"
                            @click="bookingPopUp(null)">
                        <img :src="`/images/global/x.svg`" alt="x">
                    </button>

                </div>
                <!-- booking header end  -->

                <div
                    class="padding-x-20 padding-md-x-42 padding-bottom-40 event-view-body overflow-y-scroll scrollbar"
                    v-if="BookingData !== null">

                    <div class="row">
                        <div class="col-12">
                            <!--client box start-->
                            <div class="card p-3 client-card z-1" v-if="customerData !== null">
                                <div class="user d-flex align-items-center">
                                    <img
                                        :src="`/storage/media/image/`+customerData.avatar"
                                        class="img-fluid rounded-circle w-65 h-65 me-3" alt="">

                                    <div class="info fw-semibold flex-grow-1">
                                        {{ customerData.first_name + ' ' + customerData.last_name }}
                                        <span class="text-muted d-block fw-normal">{{ customerData.email }}</span>
                                    </div>

                                    <div class="actions">
                                        <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                           data-bs-target="#client-drop"
                                           aria-expanded="false"
                                           class="btn btn-icon d-flex justify-content-center align-items-center">
                                            <img :src="`/images/portal/three-dots.svg`" alt="dots">
                                        </a>

                                        <ul class="dropdown-menu" id="client-drop">
                                            <li>
                                                <router-link :to="{name:'CustomerManage',params:{id:customerData.id}}"
                                                             class="dropdown-item" href="javascript:void(0)">Edit
                                                    profile
                                                </router-link>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:void(0)"
                                                   @click="openWarningModal('',BookingData.id,'customer');">Remove
                                                client</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--If there is no customer-->
                            <div class="card p-3 client-card z-1 cursor-pointer light-hover"
                                 v-if="customerData === null"
                                 @click="bookingPopUp('select-customer',true);this.addCustomerParam.id = this.BookingData.id">
                                <div class="user d-flex align-items-center">
                                    <div
                                        class="rounded-circle w-65 h-65 me-3 bg-theme-opacity d-flex justify-content-center align-items-center">
                                        <img class="w-24 h-24" :src="`/images/portal/user-black.svg`" alt="dummy user">
                                    </div>

                                    <div class="info fw-semibold flex-grow-1">
                                        Select a client
                                        <span class="text-muted d-block fw-normal">Leave empty for walk-in</span>
                                    </div>

                                    <div class="actions">
                                        <a href="javascript:void(0)"
                                           class="btn btn-icon d-flex justify-content-center align-items-center">
                                            <img :src="`/images/portal/plus.svg`" alt="dots">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--client box end  -->
                        </div>


                    </div>


                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!--Event changing date-->
                        <div class="event-date-select">
                            <input type="text"
                                   class="ps-0 form-control border-0 focus-none bg-white fw-semibold disable-feature"
                                   :value="BookingData.booking_date" id="event-date">
                            <div class="text-muted">Doesn't repeat</div>
                        </div>


                    </div>

                    <!--Service item start-->
                    <div class="rounded-3 mt-3 mb-3 position-relative" v-if="BookingData.items !== null"
                         :style="'border-left: 5px solid '+each.service?.catalogue?.color+'!important'"
                         v-for="(each, index) in BookingData.items">
                        <div class="p-3 border rounded-1">
                            <div class="fw-bold"> {{ each.service?.name }}</div>
                            <div class="text-secondary text-opacity-75">
                                {{ each.start_time }} - {{ each.end_time }} <span>({{ each.duration }} Min)</span>
                            </div>
                            <div class="text-secondary text-opacity-75">
                                <span v-if="customerData !== null">{{
                                        customerData.first_name + ' ' + customerData.last_name
                                    }}</span>
                                <span v-if="customerData === null">N/A</span>
                            </div>
                            <div class="text-secondary text-opacity-75"> {{ each.price + ' BDT' }}</div>
                        </div>
                        <a href="javascript:void(0)" v-if="BookingData.items.length > 1"
                           class="p-1 w-24 h-24 rounded-circle bg-danger position-absolute top-0 start-100 translate-middle d-flex justify-content-center align-items-center"
                           @click="openWarningModal(each.id,BookingData.id,'service')">
                            <img class="w-10 h-10" :src="`/images/global/x-white.svg`" alt="x white">
                        </a>
                    </div>
                    <!--Service item end  -->

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <img :src="`/images/global/clock.svg`" alt="clock"> {{ totalDurationSingleBooking() }}
                            processing time
                        </div>

                    </div>

                    <!--Add Another service-->
                    <a href="javascript:void(0)" class="d-block mb-2"
                       @click="bookingPopUp('service-popup',true);this.addAnotherServiceParam.booking_id = this.BookingData.id">
                        <img class="me-2 w-20 h-20" :src="`/images/global/plus-circle-theme.svg`"
                             alt="plus-circle-theme">
                        <span class="underline-anim text-theme">Add another service</span>
                    </a>


                </div>

                <!--Total section start-->
                <div class="w-100 border bg-white">
                    <div class="px-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center fw-bold p-3">
                            <div> Total</div>
                            <div> BDT
                                <span v-if="BookingData !== null">
                                    {{ totalPriceSingleBooking() }}
                                </span>
                                <span class="ms-2">
                                    {{ totalDurationSingleBooking() }}
                                </span>
                            </div>
                        </div>
                        <div class="row justify-content-end align-items-center px-3">
                            <button type="button" class="btn btn-white w-100 has-border col-5 h-45 rounded-3">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
                <!--Total section end  -->

            </div>
            <!--event view popup end  -->

            <!--Remove service Modal-->
            <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title text-capitalize fs-5" id="exampleModalLabel">Remove
                                {{ warningModalType }} ?</h1>
                            <button type="button" class="btn-close" @click="closeWarningModal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to remove this {{ warningModalType }}? This operation can’t be undone.
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary h-45 w-110" @click="closeWarningModal">
                                Close
                            </button>
                            <!--this button for service remove api-->
                            <button type="button" class="btn btn-danger h-45 w-110"
                                    v-if="warningModalType === 'service' && removeLoading === false"
                                    @click="removeService()">
                                Confirm
                            </button>
                            <!--this button for customer remove api-->
                            <button type="button" class="btn btn-danger h-45 w-110"
                                    v-if="warningModalType === 'customer' && removeLoading === false"
                                    @click="removeCustomer()">
                                Confirm
                            </button>

                            <button type="button" class="btn btn-danger btn-loading h-45 w-110"
                                    v-if="removeLoading === true">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Cancel appointment Modal -->
            <div class="modal modal-lg fade" id="cancelAppointmentModal" tabindex="-1"
                 aria-labelledby="cancelAppointmentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 p-md-4">
                            <h1 class="modal-title fs-5" id="cancelAppointmentModalLabel">Cancel appointment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    @click="closeCancelAppointmentModal"></button>
                        </div>
                        <div class="modal-body p-md-4">
                            <p class="mb-4">This appointment was booked by Name at 17:28, 16 February</p>

                            <div class="form-group mb-4">
                                <label for="" class="form-label fw-semibold">Cancellation reason</label>
                                <textarea class="form-textarea" name="reason" id="" cols="10" rows="3"></textarea>
                            </div>


                        </div>
                        <div class="modal-footer border-0 p-md-4">
                            <button type="button" class="btn btn-theme w-200 px-4" v-if="!cancelAppointmentLoading"
                                    @click="cancelAppointment">Cancel
                                Appointment
                            </button>
                            <button type="button" class="btn btn-theme w-200 px-4 btn-loading"
                                    v-if="cancelAppointmentLoading">
                                <span class="loading"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import apiService from "../../../services/apiService.js";
import ApiService from "../../../services/apiService.js";
import apiRoutes from "../../../services/apiRoutes.js";
// import { INITIAL_EVENTS, createEventId } from '@fullcalendar/core';
import flatpickr from "flatpickr";

import {createToaster} from "@meforma/vue-toaster";
import axios from "axios";
import appLoader from "../../../components/app-loader.vue";
import emptyScreen from "../../../components/empty-screen.vue";
import avatarImage from "../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
});

export default {
    data() {
        return {
            step: null,
            updateSelectedDate: false,
            selectedTime: null,
            previousStep: null,
            walkInService: false,
            serviceSelected: false,
            customerSelected: false,
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: 'timeGridSevenDay',
                views: {
                    timeGridSevenDay: {
                        type: 'timeGridDay',
                        duration: {days: 1}
                    }
                },
                dayHeaderContent: (args) => {
                    return this.formatDate2(args.date);
                },
                selectable: true,
                editable: true,
                dateClick: this.handleDateClick,
                slotDuration: '00:05:00',
                locale: 'en', // Adjust the locale as needed
                scrollTime: '10:00:00',
                nowIndicator: true,
                allDaySlot: false,
                headerToolbar: {
                    start: '',
                    center: '',
                    end: '',
                },
                events: [
                    {
                        title: 'Event 1',
                        start: new Date().toISOString().substr(0, 10) + 'T12:00:00',
                        end: new Date().toISOString().substr(0, 10) + 'T13:00:00',
                        editable: false,
                    },
                ],
                eventClick(event, jssEvent, view) {
                    this.eventId = event.id;
                },
            },

            backdrop: false,
            // api implement data return
            listLoading: false,
            formData: {keyword: '', limit: 20, page: 1, sort_by: 'id', sort_mode: 'asc'},
            serviceData: {member_id: '', keyword: '', limit: 20, page: 1, sort_by: 'id', sort_mode: 'asc'},
            customerTableData: [],
            total_pages: 0,
            current_page: 0,
            buttons: [],
            searchTimeout: null,
            error: null,
            responseData: null,
            table_data: 0,
            customerInsertData: null,
            customerParam: {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                gender: '',
                dob: '',
                country: '',
                timezone: '',
                currency: '',
                language: 'English',
                additional_mobile: '',
                source: 'walk-in',
                address_name: '',
                address: '',
                apartment: '',
                district: '',
                city: '',
                post_code: '',
                region: '',
                display_booking: 1,
                email_notification: 2,
                email_marketing_notification: 2,
                text_message_notification: 2,
            },
            dateLoading: false,
            bookingLoading: false,
            serviceTableData: [],
            blockedTimeParam: {},
            todaysDate: '',
            formattedToday: '',
            languages: [],
            teamListLoading: false,
            teamData: [],
            teamMemberData: [],
            flatpickr: null,
            customButtons: {
                prev: { // this overrides the prev button
                    text: "PREV",
                    click: () => {
                        let calendarApi = this.$refs.fullCalendar.getApi();
                        calendarApi.prev();
                    }
                },
                next: { // this overrides the next button
                    text: "PREV",
                    click: () => {
                        let calendarApi = this.$refs.fullCalendar.getApi();
                        calendarApi.next();
                    }
                }
            },
            bookingParam: {
                customer_id: '',
                team_member_id: 2,
                booking_date: '',
                booking_date_view: null,
                booking_items: [],
            },
            customerLoading: false,
            bookingFormData: {
                keyword: '',
                limit: 20,
                page: 1,
                sort_by: 'id',
                sort_mode: 'asc',
                start_date: '',
                end_date: '',
                team_member_id: '',
            },
            singleBookLoading: false,
            BookingData: null,
            customerData: null,
            duration: null,
            statusParam: {
                id: '',
                status: '',
            },
            customerManageLoading: false,
            isCustomer: false,
            isService: false,
            addCustomerParam: {
                id: '',
                customer_id: '',
            },
            addAnotherServiceParam: {
                booking_id: '',
                service_id: '',
                catalogue_id: '',
                pricing_id: '',
                start_time: '',
                end_time: '',
            },
            statusLoading: false,
            warningModalType: '',
            removeServiceParam: {
                id: '',
                booking_id: '',
            },
            removeCustomerParam: {
                id: ''
            },
            removeLoading: false,
            cancelAppointmentLoading: false,
            appointmentParam: {
                id: '',
                reason: '',
            }
        }
    },
    mounted() {
        this.customerList();
        this.teamList();
        this.bookingFormData.start_date = this.formatDate(this.formattedToday)
        this.bookingFormData.end_date = this.formatDate(this.formattedToday)
        this.getBookings();
        this.initializeInput();

        /*getting language data from storage*/
        this.languageList();
        this.formattedToday = this.formatDate()

        this.calendarDateFlatpickr();
        this.calendarDateFlatpickrSingle();
        this.blockedDateFlatpickr();
        this.dateOfBirthDateFlatpickr();
        this.formTimeFlatpickr();
        this.toTimeFlatpickr();
        this.eventChangeDate();
        if (this.BookingData !== null) {
            this.totalPriceSingleBooking();
            this.totalDurationSingleBooking();
        }
    },
    components: {
        FullCalendar, appLoader, emptyScreen, avatarImage
    },
    methods: {

        totalPriceSingleBooking() {
            let totalPrice = 0
            this.BookingData.items.forEach((v, i) => {
                totalPrice += parseInt(v.price)
            })
            return Number.parseFloat(totalPrice).toFixed(2)
        },

        totalDurationSingleBooking() {
            let duration = 0
            this.BookingData?.items?.forEach((v, i) => {
                duration += parseInt(v.duration)
            })
            if (duration > 0) {
                return this.formatDuration(duration)
            }
            return duration
        },

        languageList() {
            this.languages = window.core.languages;
            this.languages.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        },

        generateCalendarOptions(user) {
            let THIS = this;
            let events = [];
            let customerName = 'N/A';
            let serviceName = 'N/A';
            let pricingName = 'N/A';
            user?.booking_events.forEach(event => {
                if (event.customer !== null) {
                    customerName = event.customer?.first_name + ' ' + event.customer?.last_name;
                }
                if (event.service !== null) {
                    serviceName = event.service?.name;
                }
                if (event.pricing !== null) {
                    pricingName = event.pricing.name
                }
                let formattedEvent = {
                    id: event.booking_id,
                    title: customerName + ', ' + serviceName + ', ' + pricingName,
                    start: event.start,
                    end: event.end,
                    backgroundColor: event.catalogue.color,
                };

                events.push(formattedEvent);
            });

            return {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: 'timeGridSevenDay',
                views: {
                    timeGridSevenDay: {
                        type: 'timeGridDay',
                        duration: {days: 1}
                    }
                },
                dayHeaderContent: (args) => {
                    let formattedDate = this.formatDate2(args.date)
                    return formattedDate;
                },
                selectable: true,
                editable: false,
                dateClick: this.handleDateClick,
                slotDuration: '00:05:00',
                locale: 'en', // Adjust the locale as needed
                scrollTime: user?.booking_events[0]?.start ?? '10:00:00',
                nowIndicator: true,
                allDaySlot: false,
                headerToolbar: {
                    start: '',
                    center: '',
                    end: '',
                },
                events: events,
                eventClick: function (event) {
                    let eventId = event.event._def.publicId
                    THIS.singleBooking(eventId);
                    THIS.bookingPopUp('event-view');
                    THIS.appointmentParam.id = eventId;
                },
            };
        },

        teamEditRoute(id) {
            this.$router.push({
                name: 'EmployeeUpdate',
                params: {id: id},
            })
        },

        dobFormatDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
        },

        formatDate(date = null) {
            const today = date != null && date !== '' ? new Date(date) : new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
        },

        /*will only show date and day as example ==> 12 wednesday */
        formatDate2(date = null) {
            const today = date != null && date !== '' ? new Date(date) : new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            let day = today.getDay();
            let dayList = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return dd + ' ' + dayList[day];
        },

        nextDay() {
            let date = null
            this.teamData.forEach((v, i) => {
                let calendarApi = this.$refs[`fullCalendar_${i}`][0].getApi();
                calendarApi.next();
                date = this.formatDate(calendarApi?.currentData?.viewTitle)
            })
            this.formattedToday = date;
            this.bookingFormData.start_date = this.formattedToday
            this.bookingFormData.end_date = this.formattedToday
            this.calendarDateFlatpickrSingle(this.formattedToday);

            this.getBookings()
        },

        previousDay() {
            let date = null
            this.teamData.forEach((v, i) => {
                let calendarApi = this.$refs[`fullCalendar_${i}`][0].getApi();
                calendarApi.prev();
                date = this.formatDate(calendarApi?.currentData?.viewTitle)
            })
            this.formattedToday = date;
            this.bookingFormData.start_date = this.formattedToday
            this.bookingFormData.end_date = this.formattedToday
            this.calendarDateFlatpickrSingle(this.formattedToday);
            this.getBookings()
        },

        // popup function which make all the side popups visible and invisible.
        bookingPopUp(step, single = false) {
            apiService.ClearErrorHandler();
            this.step = step;
            if (step == null) {
                this.customerInsertData = null; // will reset new booking inserted data when step is null.
                this.bookingParam.booking_items = []; // will reset new booking inserted data when step is null.
                this.selectedTime = null
                this.updateSelectedDate = false

            } else {
                this.updateSelectedDate = step === 'change-selected-date';
            }
            if (step === 'change-selected-date') {
                this.bookingDateFlatpickr();
            }

            if (step === 'event-view') {
                setTimeout(() => {
                    this.eventChangeDate();
                }, 300)
            }
            if (step === 'new-customer') {
                this.customerParam = {
                    first_name: '',
                    last_name: '',
                    email: '',
                    mobile: '',
                    gender: '',
                    dob: '',
                    country: '',
                    timezone: '',
                    currency: '',
                    language: 'English',
                    additional_mobile: '',
                    source: 'walk-in',
                    address_name: '',
                    address: '',
                    apartment: '',
                    district: '',
                    city: '',
                    post_code: '',
                    region: '',
                    display_booking: 1,
                    email_notification: 2,
                    email_marketing_notification: 2,
                    text_message_notification: 2,
                }
            }
            if (step === 'select-customer') {
                this.isCustomer = single;
            }
            if (step === 'service-popup') {
                this.isService = single;
            }
        },

        handleDateClick: function (arg) {
            this.bookingPopUp('choose-time');
            this.getPosition(arg.jsEvent);
            const dateString = arg.dateStr;
            const dateObj = new Date(dateString);

            let hours = dateObj.getHours();
            let minutes = dateObj.getMinutes();
            if (minutes < 10) {
                minutes = '0' + minutes
            }
            if (hours < 10) {
                hours = '0' + hours
            }
            this.selectedTime = `${hours}:${minutes}`
            this.bookingParam.booking_date_view = arg?.view?.title
            this.bookingParam.booking_date = this.formatDate(dateString)
        },

        // helper function to get an element's exact position
        getPosition(el) {
            let container = document.querySelector('.fc-timegrid-slot');
            let pop = document.querySelector('.time-choose-popup');
            let xPosition = el.clientX;
            let yPosition = el.clientY;
            /*Here im getting the clientX/Y from mobile version.*/
            document.addEventListener('touchstart', (e) => {
                xPosition = e.touches[0].clientX
                yPosition = e.touches[0].clientY
            })


            let threshold = 300; // Threshold distance from the edge

            let nearLeft = xPosition < threshold;
            let nearRight = container.offsetWidth - xPosition < threshold;
            let nearTop = yPosition < threshold;
            let nearBottom = window.innerHeight - yPosition < threshold;

            if (nearLeft === true) {
                xPosition = xPosition + 100
            }

            if (nearRight === true) {
                xPosition = xPosition - 250
            }

            if (nearTop === true) {
                yPosition = yPosition + 50
            }
            if (nearBottom === true) {
                yPosition = yPosition - 150
            }

            pop.style.left = xPosition + 'px';
            pop.style.top = yPosition + 'px';
        },


        customerList() {
            this.listLoading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.CustomerList, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.listLoading = false;
                this.customerTableData = res?.customers.data
                this.customerTableData.forEach(each => {
                    each.selected = false
                })
                this.total_pages = res.customers.total < res.customers.per_page ? 1 : Math.ceil((res.customers.total / res.customers.per_page));
                this.current_page = res.customers.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
            }).catch(err => {
                this.listLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        // team list show
        teamList() {
            axios.get(apiRoutes.TeamMembers, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.teamListLoading = false;
                this.teamMemberData = res.members.data;
                this.bookingParam.team_member_id = this.teamData[0]?.id
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

        customerInsertSingleData(data) {
            this.customerInsertData = data;
            this.bookingParam.customer_id = data.id;
            data.selected = true;
            if (!this.isCustomer) {
                this.bookingPopUp('new-booking')
            } else {
                this.addCustomerParam.customer_id = data.id;
                this.addCustomer();
                this.bookingPopUp('event-view');
            }

        },

        customerRemove() {
            this.customerInsertData = null
            this.bookingParam.customer_id = ''
        },

        customerSearchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.customerList();
            }, 800);
        },

        serviceSearchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.categoryServiceList();
            }, 800);
        },

        // this function work for create customer data
        createCustomer() {
            this.customerLoading = true
            axios.post(apiRoutes.CustomerCreate, this.customerParam, {headers: apiService.headerContent}).then((response) => {
                this.customerLoading = false;
                this.customerList();
                this.bookingPopUp('select-customer');
                toaster.info('Customer has been created successfully.');
                this.customerParam = {
                    first_name: '',
                    last_name: '',
                    email: '',
                    mobile: '',
                    gender: '',
                    dob: '',
                    country: '',
                    timezone: '',
                    currency: '',
                    language: '',
                    additional_mobile: '',
                    source: 'walk-in',
                    address_name: '',
                    address: '',
                    apartment: '',
                    district: '',
                    city: '',
                    post_code: '',
                    region: '',
                    display_booking: 1,
                    email_notification: 2,
                    email_marketing_notification: 2,
                    text_message_notification: 2,
                };
            }).catch(err => {
                this.customerLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    toaster.error('Please Correct all form errors.')
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*toggle switch*/
        toggleSwitch(type) {
            this.customerParam[type] = this.customerParam[type] == 1 ? 2 : 1;
        },

        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                    this.customerParam.lat = place.geometry.location.lat()
                    this.customerParam.lng = place.geometry.location.lng()
                    this.customerParam.address = place.formatted_address
                    let addressComponents = place.address_components;
                    for (let component of addressComponents) {
                        if (component.types.includes('administrative_area_level_1')) {
                            this.customerParam.district = component.long_name;
                        }
                        if (component.types.includes('locality')) {
                            this.customerParam.city = component.long_name;
                        }
                        if (component.types.includes('postal_code')) {
                            this.customerParam.post_code = component.long_name;
                        }
                        if (component.types.includes('country')) {
                            this.customerParam.country = component.long_name;
                        }
                    }
                    this.fullAddress = true;
                })
            }, 1000)
        },

        categoryServiceList() {
            this.listLoading = true;
            axios.get(apiRoutes.CategoriesList, {params: this.serviceData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.listLoading = false;
                this.serviceTableData = res?.categories?.data ?? [];
                if (this.serviceTableData.length > 0) {
                    this.serviceTableData.forEach((v) => {
                        v.services.forEach((j) => {
                            j['color'] = v.color
                        })
                    })
                }
                this.total_pages = res?.categories?.total < res?.categories?.per_page ? 1 : Math.ceil((res?.categories?.total / res?.categories?.per_page));
                this.current_page = res?.categories?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
            }).catch(err => {
                this.listLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        twoDigit(time) {
            let [hours, minutes] = time.split(':');
            if (minutes.length === 1) {
                minutes = "0" + minutes;
            }
            return `${hours}:${minutes}`
        },

        pushService(service, pricing) {
            let getStartTime = null
            let getEndTime = null
            if (!this.isService) {
                if (this.bookingParam.booking_items.length === 0) {
                    getStartTime = this.twoDigit(this.selectedTime)
                    getEndTime = this.getEndTime(getStartTime, parseInt(pricing.duration))
                } else {
                    const lastIndex = this.bookingParam.booking_items.length - 1;
                    getStartTime = this.bookingParam.booking_items[lastIndex].end_time
                    getEndTime = this.getEndTime(getStartTime, parseInt(pricing.duration))
                }
                let modifyData = {
                    catalogue_id: service.category_id,
                    pricing_id: pricing.id,
                    name: service.name,
                    color: service.color,
                    duration: parseInt(pricing.duration),
                    price: pricing.price,
                    service_id: service.id,
                    start_time: getStartTime,
                    end_time: getEndTime
                }
                this.bookingParam.booking_items.push(modifyData)
                this.bookingPopUp('new-booking');
            } else {
                /*For adding another service*/
                this.addAnotherServiceParam.service_id = service.id;
                this.addAnotherServiceParam.catalogue_id = service.category_id;
                this.addAnotherServiceParam.pricing_id = service.pricing_id;
                this.addAnotherServiceParam.start_time = '10:50';
                this.addAnotherServiceParam.end_time = '11:50';
                this.addAnotherService();
            }

        },

        getEndTime(startTime, minutesToAdd) {
            // Split the time into hours and minutes
            const [startHour, startMinute] = startTime.split(':').map(Number);

            // Calculate total minutes from the start time
            const totalStartMinutes = startHour * 60 + startMinute;

            // Add the given minutes
            const totalEndMinutes = totalStartMinutes + minutesToAdd;

            // Calculate hours and minutes for the end time
            const endHour = Math.floor(totalEndMinutes / 60) % 24; // Modulo 24 for next day
            const endMinute = totalEndMinutes % 60;

            // Format the end time
            const formattedEndTime = `${String(endHour).padStart(2, '0')}:${String(endMinute).padStart(2, '0')}`;

            return formattedEndTime;
        },

        changeDate(e) {
            let originalDate = new Date(e);

            let months = [
                'January', 'February', 'March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December'
            ];

            let day = originalDate.getDate();
            let month = months[originalDate.getMonth()];
            let year = originalDate.getFullYear();

            this.bookingParam.booking_date_view = month + ' ' + day + ', ' + year;
        },

        formatDuration(durationInMinutes) {
            if (durationInMinutes >= 60) {
                // Calculate hours and remaining minutes
                const hours = Math.floor(durationInMinutes / 60);
                const remainingMinutes = durationInMinutes % 60;

                // Construct the output based on hours and remaining minutes
                if (remainingMinutes > 0) {
                    return `${hours} hour${hours > 1 ? 's' : ''} ${remainingMinutes} minute${remainingMinutes > 1 ? 's' : ''}`;
                } else {
                    return `${hours} hour${hours > 1 ? 's' : ''}`;
                }
            } else {
                return `${durationInMinutes} minute${durationInMinutes > 1 ? 's' : ''}`;
            }
        },

        getTotalPrice() {
            let totalPrice = 0
            if (this.bookingParam.booking_items.length > 0) {
                this.bookingParam.booking_items.forEach((v, i) => {
                    totalPrice += v.price
                })
            }
            return Number.parseFloat(totalPrice).toFixed(2)
        },

        getTotalDuration() {
            let duration = 0
            if (this.bookingParam.booking_items.length > 0) {
                this.bookingParam.booking_items.forEach((v, i) => {
                    duration += v.duration
                })
            }
            if (duration > 0) {
                return this.formatDuration(duration)
            }
            return duration
        },

        createBooking() {
            this.bookingLoading = true;
            axios.post(apiRoutes.Booking, this.bookingParam, {headers: apiService.headerContent}).then((response) => {
                this.bookingLoading = false
                this.step = null
                toaster.info('Appointment booked successfully')
                this.resetBookingParam();
                this.getBookings();
            }).catch(err => {
                this.bookingLoading = false
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                    apiService.toasterError(res?.data?.errors)
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        resetBookingParam() {
            this.bookingParam = {
                customer_id: '',
                team_member_id: 2,
                booking_date: '',
                booking_date_view: null,
                booking_items: [],
            }
            this.selectedTime = null
            this.customerInsertData = null
        },

        getBookings() {
            this.bookingFormData.booking_date = this.formatDate(this.formattedToday)
            axios.get(apiRoutes.Booking, {params: this.bookingFormData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data;
                this.teamData = res;
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        bookingTimeCheck() {
            toaster.info('Select a time to book')
        },

        // flatpickr related function
        calendarDateFlatpickr() {
            let THIS = this
            let start = null
            let end = null
            flatpickr('#calendarDate', {
                // mode: 'range',
                altInput: true,
                dateFormat: "Y-m-d",
                altFormat: "F j, Y",
                disableMobile: "true",
                defaultDate: this.formatDate(),
                onChange: function (selectedDates, dateStr, instance) {
                    if (selectedDates.length > 1) {
                        const date = dateStr.split("to");
                        start = date[0]
                        end = date[1] ?? date[0]
                        THIS.bookingFormData.start_date = start
                        THIS.bookingFormData.end_date = end
                        THIS.getBookings()
                    }
                },
            })
        },

        calendarDateFlatpickrSingle(date = null) {
            let THIS = this
            let start = null
            let end = null
            flatpickr('#calendarDateSingle', {
                altInput: true,
                dateFormat: "Y-m-d",
                altFormat: "F j, Y",
                disableMobile: "true",
                defaultDate: date !== null ? date : this.formatDate(),
                onChange: function (selectedDates, dateStr, instance) {
                    // if (selectedDates.length > 1) {
                    //     const date = dateStr.split("to");
                    //     start = date[0]
                    //     end = date[1] ?? date[0]
                    //     THIS.bookingFormData.start_date = start
                    //     THIS.bookingFormData.end_date = end
                    //     THIS.getBookings()
                    // }
                    THIS.bookingFormData.start_date = dateStr;
                    THIS.bookingFormData.end_date = dateStr;
                    setTimeout(() => {
                        THIS.teamData.forEach((v, i) => {
                            let calendarApi = THIS.$refs[`fullCalendar_${i}`][0].getApi();
                            console.log(calendarApi)
                            console.log(calendarApi.getDate())
                            THIS.formatDate2()
                        })
                    },1000)

                },
            })
        },

        blockedDateFlatpickr() {
            flatpickr('#blocked-date', {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: "today",
                disableMobile: true,
            })
        },

        dateOfBirthDateFlatpickr() {
            flatpickr('#dob', {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: "today",
                maxDate: "today",
                disableMobile: true,
            })
        },

        formTimeFlatpickr() {
            flatpickr('#formTime', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        toTimeFlatpickr() {
            flatpickr('#toTime', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        bookingDateFlatpickr() {
            let THIS = this
            let input = document.getElementById('bookingDate');
            if (this.bookingParam && this.bookingParam.booking_date) {
                input.value = this.bookingParam.booking_date;
            }

            flatpickr('#bookingDate', {
                dateFormat: "Y-m-d",
                altFormat: "F j, Y",
                disableMobile: "true",
                altInput: true,
                onChange: function (selectedDates, dateStr) {
                    THIS.changeDate(dateStr)
                    THIS.bookingParam.booking_date = dateStr;
                }
            });
        },

        eventChangeDate() {
            flatpickr('#event-date', {
                dateFormat: "Y-m-d",
                altFormat: "F j, Y",
                disableMobile: "true",
                altInput: true,
            });
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


        //  Booking single api
        singleBooking(booking_id) {
            this.singleBookLoading = true;
            apiService.ClearErrorHandler();
            axios.get(apiRoutes.BookingSingle, {params: {booking_id: booking_id}}, {headers: apiService.headerContent}).then((response) => {
                this.singleBookLoading = false;
                this.BookingData = response.data.booking;
                this.customerData = this.BookingData.customer;
                this.headerStatusColor();
            }).catch(err => {

                this.singleBookLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })

        },

        showDuration(v) {
            let start = this.timeToMinutes(v.start_time)
            let end = this.timeToMinutes(v.end_time)
            return end - start + 'min';
        },

        // Converting time to minutes.
        timeToMinutes(time) {
            const [hours, minutes] = time.split(':').map(Number);
            return hours * 60 + minutes;
        },

        /*passing id to list*/
        passIdtoList(id) {
            this.bookingParam.team_member_id = id;
            this.serviceData.member_id = id;
        },

        /* Function to scroll control left side of calendar */
        scrollCalendarLeft() {
            document.getElementById('content-left-right-control').scrollLeft -= 360;
        },

        /* Function to scroll control right side of calendar */
        scrollCalendarRight() {
            document.getElementById('content-left-right-control').scrollLeft += 360;
        },

        /*Function for redirecting to catalogue page*/
        newCategory() {
            this.$router.push({name: 'Services', state: {module_name: 'calendar'}})
        },

        /*Function for redirecting to catalogue page*/
        newService() {
            this.$router.push({name: 'Services', state: {module_name: 'calendar'}})
        },

        /*Function for changing the status*/
        changeStatus(id, status) {
            this.statusLoading = true;
            this.statusParam.id = id;
            this.statusParam.status = status;
            apiService.ClearErrorHandler();
            axios.patch(apiRoutes.BookingStatus, this.statusParam, {headers: apiService.headerContent}).then((response) => {
                this.statusLoading = false;
                this.singleBooking(id)
                toaster.info('Booking status has been updated successfully')
            }).catch(err => {
                this.statusLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function for removing customer from single booking*/
        removeCustomer() {
            this.removeLoading = true;
            apiService.ClearErrorHandler();
            axios.patch(apiRoutes.BookingCustomerRemove, this.removeCustomerParam, {headers: apiService.headerContent}).then((response) => {
                this.removeLoading = false;
                toaster.info('Customer has been removed successfully.')
                this.singleBooking(this.removeCustomerParam.id);
                this.closeWarningModal();
                this.bookingParam.customer_id = '';
            }).catch(err => {
                this.removeLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function for adding customer in single booking*/
        addCustomer() {
            this.customerManageLoading = true;
            apiService.ClearErrorHandler();
            axios.patch(apiRoutes.BookingCustomerAdd, this.addCustomerParam, {headers: apiService.headerContent}).then((response) => {
                this.customerManageLoading = false;
                toaster.info('Customer has been added successfully.')
                this.singleBooking(this.addCustomerParam.id);
            }).catch(err => {
                this.customerManageLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to add another service*/
        addAnotherService() {
            axios.post(apiRoutes.BookingServiceAdd, this.addAnotherServiceParam, {headers: ApiService.headerContent}).then((response) => {
                toaster.info('Service has been added successfully.');
                this.singleBooking(this.addAnotherServiceParam.booking_id);
                this.bookingPopUp('event-view');
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*Function to add remove service from single booking*/
        removeService() {
            this.removeLoading = true;
            axios.delete(apiRoutes.BookingServiceRemove, {params: {id: this.removeServiceParam.id}}, {headers: apiService.headerContent}).then((response) => {
                this.removeLoading = false;
                toaster.info('Service has been removed successfully.');
                this.singleBooking(this.removeServiceParam.booking_id);
                this.closeWarningModal();
            }).catch(err => {
                this.removeLoading = false;
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!')
                }
            })
        },

        /*This function will check if it's from view page or not. if it's view page then it will redirect to the view page*/
        checkIfSingle(single = false) {
            if (single === true) {
                this.step = 'event-view';
            }
        },

        /*This function will check the status and change bacground of the header by status code.*/
        headerStatusColor() {
            let header = document.querySelector('.event-view-header')
            if (this.BookingData !== null) {
                if (this.BookingData.status == 1) {
                    header.classList.add('pending')
                    header.classList.remove('arrived')
                    header.classList.remove('started')
                    header.classList.remove('no-show')
                    header.classList.remove('confirmed')
                }
                if (this.BookingData.status == 2) {
                    header.classList.add('arrived')
                    header.classList.remove('pending')
                    header.classList.remove('started')
                    header.classList.remove('no-show')
                    header.classList.remove('confirmed')
                }
                if (this.BookingData.status == 3) {
                    header.classList.add('started')
                    header.classList.remove('pending')
                    header.classList.remove('arrived')
                    header.classList.remove('no-show')
                    header.classList.remove('confirmed')
                }
                if (this.BookingData.status == 4) {
                    header.classList.add('confirmed')
                    header.classList.remove('pending')
                    header.classList.remove('arrived')
                    header.classList.remove('no-started')
                    header.classList.remove('no-show')
                }
                if (this.BookingData.status == 5) {
                    header.classList.add('no-show')
                    header.classList.remove('pending')
                    header.classList.remove('arrived')
                    header.classList.remove('no-started')
                    header.classList.remove('confirmed')
                }
            }
        },

        /*Function for opening warning modal*/
        openWarningModal(id, booking_id, type) {
            this.warningModalType = type;
            if (type === 'service') {
                this.removeServiceParam.id = id;
                this.removeServiceParam.booking_id = booking_id;
            } else if (type === 'customer') {
                this.removeCustomerParam.id = booking_id;
            }
            let modal = new bootstrap.Modal(document.getElementById('warningModal'))
            modal.show();
        },

        /*Function for closing warning modal*/
        closeWarningModal() {
            const myModal = document.querySelector("#warningModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },


        /*Function to open cancel appointment modal*/
        openCancelAppointmentModal() {
            let modal = new bootstrap.Modal(document.getElementById('cancelAppointmentModal'))
            modal.show();
        },

        /*Function to close cancel appointment modal*/
        closeCancelAppointmentModal() {
            const myModal = document.querySelector("#cancelAppointmentModal");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
        },

        cancelAppointment() {
            this.cancelAppointmentLoading = true;
            axios.delete(apiRoutes.BookingCancel, {params: {id: this.appointmentParam.id}}, {headers: apiService.headerContent}).then((response) => {
                this.cancelAppointmentLoading = false;
                toaster.info('Booking has been cancelled successfully');
                this.closeCancelAppointmentModal();
                this.bookingPopUp(null, false);
                this.getBookings();
            }).catch(err => {
                this.cancelAppointmentLoading = false;
            })

        }

    },


}
</script>
