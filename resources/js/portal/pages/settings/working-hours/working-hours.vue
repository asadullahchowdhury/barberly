<template>

    <div class="working-hour">
        <div class="p-3 p-sm-5">

            <!-- working hour header -->
            <div class="working-hour-header d-flex justify-content-between align-items-center">
                <div class="fw-semibold fs-3">
                    Scheduled shifts
                </div>
                <div class="d-flex justify-content-end">
                    <div class="dropdown">
                        <button href="button" class="btn btn-theme padding-y-10 padding-x-12 w-150"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Add
                            <img :src="`/images/portal/arrow-down-white.svg`"
                                 class="img-fluid w-12 h-12 ms-2 d-sm-inline-block d-none" alt="plus">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                            <li>
                                <button type="button" class="dropdown-item px-3 py-2 rounded-2"
                                        @click="openTimeOffModal">
                                    Time off
                                </button>
                            </li>
                            <li>
                                <router-link :to="{name: 'EmployeeCreate',state:{module_name:'working-hour'}}"
                                             class="dropdown-item px-3 py-2 rounded-2">
                                    New team member
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'BusinessClosePeriod'}"
                                             class="dropdown-item px-3 py-2 rounded-2">
                                    Business closed period
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- working hour button group -->
            <div class="bg-light p-3 mt-3 working-hour-button-group rounded-3">
                <div class="d-flex justify-content-end align-items-center working-hour-button-manage">


                    <button
                        class="rounded-start-4 rounded-start-sm-5 icon-btn d-flex justify-content-center align-items-center border"
                        @click="goToPreviousWeek()">
                        <img :src="`/images/portal/chevron-left.svg`" class="img-fluid w-17 h-17" alt="chevron left">
                    </button>

                    <div class="d-flex">
                        <button class="rounded-0 btn-week border disable-feature d-none d-md-inline-block">
                            this week
                        </button>

                        <input id="startEndDate" name="defaultDate"
                               class="form-control shadow-none rounded-0 bg-white border text-center font-size-13"/>
                    </div>

                    <button
                        class="rounded-end-4 rounded-end-sm-5 rounded-0 icon-btn d-flex justify-content-center align-items-center border"
                        @click="goToNextWeek()">
                        <img :src="`/images/portal/chevron-right.svg`" class="img-fluid w-17 h-17" alt="chevron right">
                    </button>

                </div>
            </div>

            <!-- working hour content-group with responsive -->
            <div class="working-hour-content-group mt-4">

                <!--working-hour-content-group -->
                <div class="working-hour-flex-content">

                    <div
                        class="team-table-column border h-90 d-flex justify-content-center align-items-center text-center">
                        <div class="fw-semibold">
                            Team member
                            <a href="javascript:void(0)" class="text-decoration-none text-theme ms-1"
                               @click="openTeamChangeModal()">
                                Change
                            </a>
                        </div>
                    </div>

                    <div class="team-schedule-column border h-90" v-for="(each, index) in selectedWeek" :key="index">
                        <div class="h-85 d-flex justify-content-center align-items-center flex-column text-center">
                            <div class="fw-semibold">
                                {{ each.date_str }}
                            </div>
                            <div class="text-secondary text-opacity-75">
                                12 hours
                            </div>
                        </div>
                    </div>

                </div>

                <div class="working-hour-flex-content" v-for="each in teamData">

                    <div
                        class="team-table-column border h-90 p-2 d-flex justify-content-between align-items-center h-86">
                        <div class="d-flex justify-content-start align-items-center">

                            <avatarImage :name="each.first_name + ' ' + each.last_name"
                                         :avatar="each.avatar"/>

                            <div class="ms-2">
                                <div class="fw-semibold mb-1 w-130">
                                    <div class="text-truncate">
                                        {{ each.first_name + ' ' + each.last_name }}
                                    </div>
                                </div>
                                <div class="text-secondary text-opacity-75">
                                    52 hours
                                </div>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button type="button" class="btn-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <img :src="`/images/portal/pencil.svg`" class="w-17 h-17" alt="pencil">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                <li>
                                    <router-link :to="{name: 'SetRegularShift'}"
                                                 class="dropdown-item px-3 py-2 rounded-2">
                                        Set regular shift
                                    </router-link>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                       class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                        Unassign from location
                                    </a>
                                </li>
                                <li>
                                    <router-link :class="{ 'disable-feature' : each.id === userData.id }"
                                                 :to="{name: 'EmployeeUpdate',params:{id:each.id},state:{module_name:'working-hour'}}"
                                                 class="dropdown-item px-3 py-2 rounded-2">
                                        Edit team member
                                    </router-link>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2 text-danger">
                                        Delete all shift
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="team-schedule-column border h-90 p-1" v-for="index in [1,2,3,4,5,6,7]">
                        <div class="dropdown mb-1 w-100">
                            <button type="button" class="btn btn-light border-0 w-100" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                10:00 - 19:00
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2"
                                       @click="openAddShiftModal(each.id)">
                                        Edit this day
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                       class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                        Set regular shift
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2"
                                       @click="openTimeOffModal(each.id)">
                                        Add time off
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                       class="dropdown-item px-3 py-2 rounded-2 text-danger disable-feature">
                                        Delete this shift
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown w-100">
                            <button type="button" class="btn btn-light border-0 w-100" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <img :src="`/images/portal/plus-circle.svg`" class="w-20 h-20" alt="plus-circle">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border p-2 overflow-hidden rounded-2">
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2"
                                       @click="openAddShiftModal(each.id)">
                                        Add shift
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"
                                       class="dropdown-item px-3 py-2 rounded-2 disable-feature">
                                        Set regular shifts
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item px-3 py-2 rounded-2"
                                       @click="openTimeOffModal(each.id)">
                                        Add time off
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Add time off modal -->
            <div class="modal fade" id="timeOffModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Add time off</h1>
                            <button type="button" class="btn-close" @click="closeTimeOffModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="team-member" class="form-label">Team member</label>
                                        <select name="team-member" id="team-member" class="form-select"
                                                v-model="addTimeOffData.teamMember">
                                            <option value="">Select Team member</option>
                                            <option value="">Nafisa Hossain</option>
                                            <option value="">Noyon Ahammed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="reasonType" class="form-label">Type</label>
                                        <select name="reasonType" id="reasonType" class="form-select"
                                                v-model="addTimeOffData.reasonType">
                                            <option value="0">Annual Leave</option>
                                            <option value="1">Sick Leave</option>
                                            <option value="2">Training</option>
                                            <option value="3">Other absence reasons</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="startDate" class="form-label">Start date</label>
                                        <input id="startDate" type="text" name="startDate" class="form-control"
                                               v-model="addTimeOffData.startDate" placeholder="Enter your start date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="startTime" class="form-label">Start time</label>
                                                <input id="startTime" type="text" class="form-control" name="startTime"
                                                       v-model="addTimeOffData.startTime" placeholder="Start Time">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label for="endTime" class="form-label">End time</label>
                                                <input id="endTime" type="text" class="form-control" name="endTime"
                                                       v-model="addTimeOffData.endTime" placeholder="End time">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="repeat" class="form-label">
                                        <input type="checkbox" id="repeat" class="form-checkbox"
                                               v-model="addTimeOffData.repeatCheck" @change="repeatController">
                                        Repeat
                                    </label>
                                    <div class="form-group">
                                        <div class="mt-3" :class="{'d-none' : repeat !== true}">
                                            <label for="repeatStartDate" class="form-label">Repeat Until</label>
                                            <input id="repeatStartDate" type="text" name="repeatStartDate"
                                                   class="form-control" v-model="addTimeOffData.repeatStartDate"
                                                   placeholder="Enter your repeat date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-textarea" cols="30"
                                                  rows="3" placeholder="Add description or note [optional]" required
                                                  v-model="addTimeOffData.description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
                                    <label for="approved" class="form-label">
                                        <input type="checkbox" id="approved" name="approved" class="form-checkbox">
                                        Approved
                                    </label>
                                    <span>
                                            Time off total: 0h
                                        </span>
                                </div>
                                <div class="col-md-12">
                                    <small class="text-opacity-75 text-secondary">
                                        Online bookings cannot be placed during time off.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary w-130 h-45 border-radius-10"
                                    data-bs-dismiss="modal">Close
                            </button>
                            <button type="button" class="btn btn-theme w-130 h-45">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- this date modal -->
            <div class="modal fade" id="shiftModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel" v-if="memberData !== null">
                                {{ memberData.first_name + ' ' + memberData.last_name }}'s shift Mon, 25 Dec
                            </h1>
                            <button type="button" class="btn-close" @click="closeAddShiftModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row" v-for="(each, index) in multipleParam.times">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label :for="'multipleStartTime'+index" class="form-label">Start time</label>
                                        <input :id="'multipleStartTime'+index" type="text" name="startTime"
                                               placeholder="Start time"
                                               class="form-control" v-model="each.startTime">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex justify-content-between align-items-center"
                                     :class="{ 'col-md-5' : multipleParam.times.length > 1 }">
                                    <div class="col">
                                        <label :for="'multipleEndTime'+index" class="form-label">End time</label>
                                        <div class="row align-items-center">
                                            <div :class="{ 'col-10':multipleParam.times.length > 1 }">
                                                <div class="form-group">
                                                    <input :id="'multipleEndTime'+index" type="text" name="endTime"
                                                           placeholder="End time"
                                                           class="form-control" v-model="each.endTime">
                                                </div>
                                            </div>
                                            <div class="col-2" v-if="multipleParam.times.length > 1">
                                                <button type="button" class="btn btn-light border-0 delete-group"
                                                        @click="deleteGroup(index)">
                                                    <img :src="`/images/portal/delete.svg`" class="w-21 h-21"
                                                         alt="delete">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button type="button" class="btn border-0 d-flex align-items-center ps-0"
                                        @click="addGroup()">
                                    <img :src="`/images/portal/plus-circle.svg`" class="w-21 h-21 me-2"
                                         alt="plus-circle">
                                    Add a shift
                                </button>
                                <span class="text-secondary text-opacity-75">
                                    12h 50mins
                                </span>
                            </div>
                            <div class="text-secondary text-opacity-75">
                                You are editing this day's shifts only. To set regular shifts, go to
                                <a href="javascript:void(0)" class="text-theme text-decoration-none">
                                    scheduled shifts.
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary w-130 h-45 border-radius-10"
                                    @click="closeAddShiftModal"> Close
                            </button>
                            <button type="button" class="btn btn-theme w-130 h-45"> Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- change team member -->
            <div class="modal fade" id="changeTeamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content p-3">
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">
                                Change team member
                            </h1>
                            <button type="button" class="btn-close" @click="closeTeamChangeModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="allSelectTeam" class="form-label">
                                        <input id="allSelectTeam" type="checkbox" class="form-checkbox"
                                               :checked="teamData.length > 0 && teamData.length === selected.length"
                                               @change="toggleTeamCheckAll($event)">
                                        All team members
                                    </label>
                                </div>
                                <div class="col-md-6 mb-3" v-for="(each) in teamData">
                                    <label :for="each.id"
                                           class="form-label d-flex justify-content-start align-items-center">
                                        <input :id="each.id" type="checkbox" class="form-checkbox"
                                               :checked="CheckTeamIfChecked(each.id)"
                                               @change="toggleTeamCheck($event,each.id)">

                                        <span class="me-2">
                                            <avatarImage :name="each.first_name + ' ' + each.last_name"
                                                         :avatar="each.avatar"/>
                                        </span>

                                        {{ each.first_name + ' ' + each.last_name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary w-130 h-45 border-radius-10"
                                    @click="closeTeamChangeModal">Close
                            </button>
                            <button type="button" class="btn btn-theme w-130 h-45">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>

import apiService from "../../../../services/apiService.js";
import apiRoutes from "../../../../services/apiRoutes.js";
import flatpickr from "flatpickr";
import axios from "axios";
import {createToaster} from "@meforma/vue-toaster";
import avatarImage from "../../../../components/avatarImage.vue";

const toaster = createToaster({
    position: 'top-left',
})

export default {

    components: {
        avatarImage
    },
    data() {

        return {
            DefaultDate: [],
            currentMonth: new Date().getMonth() + 1,
            currentYear: new Date().getFullYear(),
            currentWeek: '',
            selectedWeek: [],
            formattedWeek: '',
            addTimeOffData: {
                teamMember: '',
                reasonType: '0',
                startDate: '',
                startTime: '',
                endTime: '',
                repeatStartDate: '',
                description: '',
                repeatCheck: '',
            },
            repeat: false,
            multipleParam: {
                times: [{startTime: '', endTime: ''}],
            },
            loading: false,
            teamData: [],
            total_pages: 0,
            current_page: 0,
            buttons: [],
            searchTimeout: null,
            error: null,
            responseData: null,
            table_data: 0,
            selected: [],
            formData: {
                status: '',
                keyword: '',
                limit: 20,
                page: 1,
                sort_by: 'id',
                sort_mode: 'asc'
            },
            memberData: null,
            userData: window.core.UserInfo,
        }

    },

    mounted() {
        this.getCurrentWeekNumberInMonth()
        this.getWeekDates()
        this.teamList();
        this.startEndDateFlatpickr();
        this.startTimeFlatpickr();
        this.endTimeFlatpickr();
        this.startDateFlatpickr();
        this.repeatStartDateFlatpickr();

    },

    methods: {

        /*member single api*/
        getSingle(id) {
            let param = {
                id: id
            }
            axios.get(apiRoutes.TeamMembers, {params: param}, {headers: apiService.headerContent}).then((response) => {
                this.memberData = response.data.member;
            }).catch(err => {
                let res = err?.response;
                if (res?.data?.errors !== undefined) {
                    toaster.error('Member not found.')
                    apiService.ErrorHandler(res?.data?.errors);
                } else {
                    toaster.error('Server error!');
                }
            })
        },

        getWeekDates() {
            const firstDateOfRequestedWeek = this.getFirstDateOfRequestedWeek();

            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            const dates = [];
            for (let i = 0; i < 7; i++) {
                const date = new Date(this.currentYear, this.currentMonth - 1, firstDateOfRequestedWeek + i);
                const formattedDate = `${days[date.getDay()]}, ${months[date.getMonth()]} ${date.getDate()}`;
                dates.push({date: date.toISOString().split('T')[0], date_str: formattedDate});
            }
            this.getCurrentWeekFirstAndLastDates()
            this.selectedWeek = dates;
        },


        getFirstDateOfRequestedWeek() {
            const firstDayOfMonth = new Date(this.currentYear, this.currentMonth - 1, 1);
            const firstDayOfWeek = firstDayOfMonth.getDay();
            return 1 + (this.currentWeek - 1) * 7 - firstDayOfWeek;
        },

        getCurrentWeekNumberInMonth() {
            const currentDate = new Date();
            const firstDayOfMonth = new Date(this.currentYear, this.currentMonth - 1, 1);
            const firstDayOfWeek = firstDayOfMonth.getDay();

            const currentDateOfMonth = currentDate.getDate();
            this.currentWeek = Math.ceil((currentDateOfMonth + firstDayOfWeek) / 7);
        },

        goToNextWeek() {
            this.calculateNextWeek();
            this.getWeekDates();
        },

        calculateNextWeek() {
            const daysInMonth = new Date(this.currentYear, this.currentMonth, 0).getDate();
            const firstDayOfMonth = new Date(this.currentYear, this.currentMonth - 1, 1);
            const firstDayOfWeek = firstDayOfMonth.getDay();
            let firstDateOfNextWeek = 1 + (this.currentWeek * 7) - firstDayOfWeek;

            if (firstDateOfNextWeek > daysInMonth) {
                this.currentMonth += 1;
                if (this.currentMonth > 12) {
                    this.currentYear += 1;
                    this.currentMonth = 1;
                }
                firstDateOfNextWeek -= daysInMonth;
            }
            this.currentWeek += 1;
        },

        goToPreviousWeek() {
            this.calculatePreviousWeek();
            this.getWeekDates();
        },

        calculatePreviousWeek() {
            const daysInPreviousMonth = new Date(this.currentYear, this.currentMonth - 1, 0).getDate();
            const firstDayOfCurrentMonth = new Date(this.currentYear, this.currentMonth - 1, 1);
            const firstDayOfWeek = firstDayOfCurrentMonth.getDay();
            let firstDateOfPreviousWeek = 1 + ((this.currentWeek - 2) * 7) - firstDayOfWeek;

            if (firstDateOfPreviousWeek <= 0) {
                this.currentMonth -= 1;
                if (this.currentMonth < 1) {
                    this.currentYear -= 1;
                    this.currentMonth = 12;
                }
                firstDateOfPreviousWeek += daysInPreviousMonth;
            }
            this.currentWeek -= 1;
        },
        getCurrentWeekFirstAndLastDates() {
            const firstDayOfMonth = new Date(this.currentYear, this.currentMonth - 1, 1);
            const firstDayOfWeek = firstDayOfMonth.getDay();
            const firstDateOfRequestedWeek = 1 + (this.currentWeek - 1) * 7 - firstDayOfWeek;

            const firstDate = new Date(this.currentYear, this.currentMonth - 1, firstDateOfRequestedWeek);
            const lastDate = new Date(this.currentYear, this.currentMonth - 1, firstDateOfRequestedWeek + 6);

            const formatDate = date => {
                const year = date.getFullYear();
                const month = `${date.getMonth() + 1}`.padStart(2, '0');
                const day = `${date.getDate()}`.padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            this.DefaultDate = [formatDate(firstDate), formatDate(lastDate)]
        },

        startFormatDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
        },

        startToEndFormatDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
        },

        formatDate(date) {
            const options = {weekday: "short", day: "numeric", month: "short"};
            return new Intl.DateTimeFormat("en-us", options).format(date)
        },

        prev7Date() {
            const today = new Date()
            return Array.from({length: 7}, (_, index) => {
                const days = new Date(today);
                days.setDate(today.getDate() + index - 7);
                const formattedDate = this.formatDate(days);
                return {formattedDate}
            });
        },

        next7Date() {
            const today = new Date()
            return Array.from({length: 7}, (_, index) => {
                const days = new Date(today);
                days.setDate(today.getDate() + index + 7);
                const formattedDate = this.formatDate(days);

                return {formattedDate}
            });
        },

        repeatController() {
            this.repeat = this.repeat !== true;
        },

        addGroup() {
            this.multipleParam.times.push({
                startTime: '',
                endTime: '',
            })
            setTimeout(() => {
                flatpickr(`#multipleStartTime${this.multipleParam.times.length - 1}`, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: true,
                })
                flatpickr(`#multipleEndTime${this.multipleParam.times.length - 1}`, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: true,
                })
            }, 100)
        },

        deleteGroup(index) {
            this.multipleParam.times.splice(index, 1)
        },

        openTeamChangeModal() {
            let modal = new bootstrap.Modal(document.getElementById('changeTeamModal'))
            modal.show();
        },

        closeTeamChangeModal() {
            const Modal = document.querySelector('#changeTeamModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        teamList() {
            this.loading = true;
            this.formData.page = this.current_page;
            axios.get(apiRoutes.TeamMembers, {params: this.formData}, {headers: apiService.headerContent}).then((response) => {
                let res = response.data
                this.loading = false;
                this.selected = [];
                this.teamData = res.members?.data;
                this.total_pages = res.members?.total < res.members?.per_page ? 1 : Math.ceil((res.members?.total / res.members?.per_page));
                this.current_page = res.members?.current_page;
                this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
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

        toggleTeamCheckAll(e) {
            if (e.target.checked) {
                this.teamData.forEach((v) => {
                    this.selected.push(v.id);
                });
            } else {
                this.selected = [];
            }
        },

        toggleTeamCheck(e, id) {
            if (e.target.checked) {
                this.selected.push(id);
            } else {
                let index = this.selected.indexOf(id);
                this.selected.splice(index, 1);
            }
        },

        CheckTeamIfChecked(id) {
            return this.selected.map(function (id) {
                return id
            }).indexOf(id) > -1;
        },

        // flatpickr

        startEndDateFlatpickr() {
            flatpickr("#startEndDate", {
                mode: 'range',
                altFormat: 'M j, Y',
                altInput: true,
                disableMobile: true,
                dateFormat: "Y-m-d",
                defaultDate: this.DefaultDate,
            })
        },

        startTimeFlatpickr() {
            flatpickr("#startTime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        endTimeFlatpickr() {
            flatpickr("#endTime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        startDateFlatpickr() {
            flatpickr("#startDate", {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: this.startFormatDate(),
                disableMobile: true,
            })
        },

        repeatStartDateFlatpickr() {
            flatpickr("#repeatStartDate", {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: this.startFormatDate(),
                disableMobile: true,
            })
        },

        openAddShiftModal(id) {
            let modal = new bootstrap.Modal(document.getElementById('shiftModal'))
            modal.show();
            this.getSingle(id)
            flatpickr("#multipleStartTime0", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })

            flatpickr("#multipleEndTime0", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })

        },

        closeAddShiftModal() {
            const Modal = document.querySelector('#shiftModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        openTimeOffModal() {
            let modal = new bootstrap.Modal(document.getElementById('timeOffModal'))
            modal.show();
        },

        closeTimeOffModal() {
            const Modal = document.querySelector('#timeOffModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

    }

}

</script>
