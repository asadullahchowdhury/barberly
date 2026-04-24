<template>

    <form class="set-regular-shift">

        <!-- set regular shift header -->
        <div class="set-regular-shift-header d-flex justify-content-between align-items-center">
            <router-link :to="{name: 'workingHour'}" class="set-regular-shift-add-close-btn">
                <img :src="`/images/global/x.svg`" class="w-20 h-15" alt="close-btn">
            </router-link>

            <div class="title fw-semibold fs-5 d-sm-inline d-none">
                Set Noyon’s regular shifts
            </div>

            <div class="d-flex align-items-center">

                <button type="submit" class="btn-theme">
                    Save
                </button>

            </div>

        </div>


        <div class="p-3 p-sm-4 pb-sm-0">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-lg-8">

                    <!-- Title with subTitle of set regular shift -->
                    <div class="fw-semibold fs-2 text-center">Set Noyon’s regular shifts</div>
                    <div class="text-center text-secondary">
                        Set weekly, biweekly or custom shifts. Changes saved will apply to all upcoming shifts for the
                        selected period.
                    </div>

                    <!-- body of set regular shift -->
                    <div class="row">
                        <div class="col-xl-4 p-3">

                            <div class="border p-3 rounded-3">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="scheduleType" class="form-label">Schedule type</label>
                                        <select name="scheduleType" id="scheduleType" class="form-select" required
                                                autocomplete="new-schedule-type" v-model="formData.scheduleType">
                                            <option value="">Every week</option>
                                            <option value="">Every 2 week</option>
                                            <option value="">Every 3 week</option>
                                            <option value="">Every 4 week</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="startDate" class="form-label">Start date</label>
                                        <input id="startDate" type="text" class="form-control" required
                                               autocomplete="new-start-date" placeholder="Enter Your Start Date"
                                               v-model="formData.startDate">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="endDate" class="form-label">End date</label>
                                        <input id="endDate" type="text" class="form-control" required
                                               autocomplete="new-end-date" placeholder="Enter Your End Date"
                                               v-model="formData.endDate">
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 line-height-2 d-flex align-items-center bg-theme-opacity mt-3">
                                <img :src="`/images/portal/light.svg`" class="w-25 h-24 me-1" alt="light">
                                Team members will not be scheduled on business closed periods.
                            </div>

                        </div>
                        <div class="col-xl-8 p-3">
                            <div class="border p-3 rounded-3">

                                <div class="row"  :class="{ 'align-items-center' : !each.checked }" v-for="each in shiftData">
                                    <div class="col-12 col-md-4 mb-2">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" class="form-checkbox" :checked="each.checked" @click="checkIfChecked(each)">
                                            <div class="ms-2">
                                                <div class="fw-semibold">{{each.dayName}}</div>
                                                <div class="text-secondary">9h</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8 mb-2">
                                        <div class="col-12" :class="{ 'd-none' : each.checked }">
                                            No Shift
                                        </div>
                                        <div :class="{ 'd-none' : !each.checked }">

                                            <div class="row align-items-center" :class="{ 'mb-3' : each.shifts.length > 1 }" v-for="(shiftTime, index) in each.shifts">
                                                <div class="col-10">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input :id="`startTime`+index" type="text" name="startTime"
                                                                   class="form-control" required
                                                                   autocomplete="new-start-time" v-model="shiftTime.startTime" placeholder="Start time">
                                                        </div>
                                                        <div class="col-6">
                                                            <input :id="`endTime`+index" type="text" name="endTime"
                                                                   v-model="shiftTime.endTime"
                                                                   class="form-control" required autocomplete="new-end-time"
                                                                   placeholder="End time">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 text-end" v-if="each.shifts.length > 1">
                                                    <img :src="`/images/global/delete.svg`" class="delete-icon" @click="deleteGroup(each, index)"
                                                         alt="delete-icon">
                                                </div>
                                                <div class="col-2 text-end" v-if="each.shifts.length === 1">
                                                    <img :src="`/images/global/delete.svg`" class="delete-icon" @click="checkIfChecked(each)"
                                                         alt="delete-icon">
                                                </div>
                                            </div>

                                            <button type="button" class="btn border-0" @click="addTimes(each)">
                                                <span class="text-theme">Add a shift</span>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>

</template>

<script>

import flatpickr from "flatpickr";

export default {

    data() {

        return {

            checked: false,
            formData: {
                scheduleType: '',
                startDate: '',
                endDate: '',
            },

            shiftData: [
                { id: '1', dayName: 'Monday', checked: true, shifts:[ { startTime: '', endTime: ''} ] },
                { id: '2', dayName: 'Tuesday', startTime: '', endTime: '', checked: true, shifts:[ { startTime: '', endTime: ''} ]  },
                { id: '3', dayName: 'Wednesday', startTime: '', endTime: '', checked: true, shifts:[ { startTime: '', endTime: ''} ]  },
                { id: '4', dayName: 'Thursday', startTime: '', endTime: '', checked: true, shifts:[ { startTime: '', endTime: ''} ]  },
                { id: '5', dayName: 'Friday', startTime: '', endTime: '', checked: true, shifts:[ { startTime: '', endTime: ''} ]  },
                { id: '6', dayName: 'Saturday', startTime: '', endTime: '', checked: true, shifts:[ { startTime: '', endTime: ''} ]  },
                { id: '7', dayName: 'Sunday', startTime: '', endTime: '', checked: false, shifts:[ { startTime: '', endTime: ''} ]  },
            ]

        }

    },

    mounted() {

        this.fixedHeader();

        this.startFormatDate();
        this.startDateFlatpickr();
        this.endDateFlatpickr();

        this.startTimeFlatpickr();
        this.endTimeFlatpickr();

    },

    methods: {

        startFormatDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;
            return yyyy + '-' + mm + '-' + dd;
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

        endDateFlatpickr() {
            flatpickr("#endDate", {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                disableMobile: true,
            })
        },

        startTimeFlatpickr() {
            flatpickr("#startTime0", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        endTimeFlatpickr() {
            flatpickr("#endTime0", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: true,
            })
        },

        /*Fixed header*/
        fixedHeader() {
            window.addEventListener('scroll', function () {
                let header = document.querySelector('.set-regular-shift-header')
                if (header != null) {
                    header.classList.toggle('sticky', scrollY > 100)
                }
            })
        },

        addTimes(each){
            each.shifts.push({
                startTime: '',
                endTime: '',
            })
            setTimeout(() => {
                flatpickr(`#startTime${each.shifts.length - 1}`, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: true,
                })
                flatpickr(`#endTime${each.shifts.length - 1}`, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: true,
                })
            }, 200)
        },

        checkIfChecked(each){
            each.checked = !each.checked
        },

        deleteGroup(each, index) {
            each.shifts.splice(index, 1)
        },

    }

}

</script>
