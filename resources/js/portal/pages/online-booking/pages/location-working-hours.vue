<template>

    <div class="p-1">
        <div class="h3 fw-semibold px-3 text-center">
            Add your opening hours
        </div>

        <div class="my-3 text-center px-3 d-block line-height-2">
            Set standard opening hours to show on your profile page, these hours do not impact your calendar
            availability.
        </div>

        <div class="px-3 mb-3 border rounded-3">

            <form action="" autocomplete="off" @submit.prevent="submitAccount">
                <div class="row py-3 single-working-hour" v-for="(each,parentIndex) in formData.days">
                    <!--Showing all the days of working hours-->
                    <div class="col-12 col-md-4 mb-md-0 mb-3 d-flex justify-content-between">

                        <label :for="each" class="d-flex align-items-center">
                            <input :id="each.name" type="checkbox" class="form-checkbox" :checked="each.status === 1"
                                   @change="toggleStatus(each)">
                            <span class="ms-2">
                            <span class="fw-semibold">{{ each.name }}</span>
                        </span>
                        </label>

                        <button type="button" class="btn-icon d-md-none d-block w-40 h-40"
                                v-if="each.shifts.length === 1"
                                @click="addTimes(each)">
                            <img :src="`/images/portal/plus.svg`" class="w-15 h-15" alt="plus-icon"/>
                        </button>

                    </div>

                    <!--Showing all the time of working hours-->
                    <div class="col-12 col-md-8">
                        <div class="col-12" :class="{ 'd-none' : each.status === 1 }">
                            Closed
                        </div>
                        <div :class="{ 'd-none' : each.status === 2 }">

                            <!--time inputs-->
                            <div class="row align-items-center gx-3" :class="{ 'mb-3' : each.shifts.length > 1 }"
                                 v-for="(shiftTime, index) in each.shifts">
                                <div class="col-md-10" :class="each.shifts.length > 1 ? 'col-10' : 'col-12'">
                                    <div class="row gx-3">
                                        <div class="col-6">
                                            <input :id="`startTime`+each.name+parentIndex+index" type="text"
                                                   :name="'start_time'+each.name+parentIndex+index"
                                                   class="form-control"
                                                   autocomplete="new-start-time" v-model="shiftTime.start_time"
                                                   placeholder="Start time">
                                        </div>
                                        <div class="col-6">
                                            <input :id="`endTime`+each.name+parentIndex+index" type="text"
                                                   :name="'end_time'+each.name+parentIndex+index"
                                                   v-model="shiftTime.end_time"
                                                   class="form-control" autocomplete="new-end-time"
                                                   placeholder="End time">
                                        </div>
                                    </div>
                                </div>
                                <!--Delete button-->
                                <div class="col-2 text-end" v-if="each.shifts.length > 1">
                                    <button type="button" class="btn-icon w-40 h-40" @click="deleteGroup(each, index)">
                                        <img :src="`/images/portal/delete.svg`" class="w-20 h-20" alt="delete-icon">
                                    </button>
                                </div>

                                <!--Add extra shift button-->
                                <div class="col-2 text-end d-md-block d-none" v-if="each.shifts.length === 1">
                                    <button type="button" class="btn-icon w-40 h-40" v-if="each.shifts.length === 1"
                                            @click="addTimes(each,parentIndex,index)">
                                        <img :src="`/images/portal/plus.svg`" class="w-15 h-15" alt="plus-icon"/>
                                    </button>
                                </div>
                            </div>

                            <!--input copy text-->
                            <div class="p-3 bg-theme-opacity mt-3" v-if="each.shifts.length > 1 && allShow === false">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img :src="`/images/portal/light.svg`" class="w-24 h-24 me-2" alt="light">
                                    Copy these working hours to all days?
                                </div>
                                <a href="javascript:void(0)" class=" text-theme underline-anim mt-3 ps-2"
                                   @click="allTimes()">
                                    Yes, copy
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-theme my-3 w-150">Next Step</button>
                </div>
            </form>


        </div>
    </div>

</template>

<script>

import flatpickr from "flatpickr";
import session from "../../../../services/session.js";
import {forEach} from "vuedraggable/dist/vuedraggable.common.js";

export default {
    /*Data and variables*/
    data() {

        return {
            shiftsArray: [],
            formData: {},
            allShow: false,

        }

    },

    mounted() {

        this.retrieveMarketplaceData();
    },
    watch: {},

    methods: {

        // Function to store data in session storage
        submitAccount() {
            // Convert the data to a JSON string before storing
            const jsonData = JSON.stringify(this.formData);

            // Store the JSON string in session storage
            session.setSession('marketplaceInfo', jsonData)

            // Navigate to the next page
            this.$router.push({name: 'OnlineBookingLocationPhoto'})
        },


        // Function to push start and end time in single
        addTimes(each, parentIndex, index) {
            this.formData.days[parentIndex].shifts.push({start_time: '', end_time: ''})
            /*  each.shifts.push({
                  start_time: '',
                  end_time: '',
              })
              each.shifts.forEach((v,i) => {
                  setTimeout(() => {
                      flatpickr(`#startTime${each.name + parentIndex+i}`, {
                          enableTime: true,
                          noCalendar: true,
                          dateFormat: "H:i",
                          disableMobile: true,
                          defaultDate: "10:00"
                      })
                      flatpickr(`#endTime${each.name + parentIndex+i}`, {
                          enableTime: true,
                          noCalendar: true,
                          dateFormat: "H:i",
                          disableMobile: true,
                          defaultDate: "20:00"
                      })
                  }, 200)
              })*/
        },

        /*Function to push start and end time in all shifts*/
        allTimes() {
            /*  this.formData.days.forEach((v) => {
                  if (v.shifts.length === 1) {
                      v.shifts.push({
                          start_time: '',
                          end_time: '',
                      })
                      setTimeout(() => {
                          flatpickr(`#startTime${v.shifts.length - 1}`, {
                              enableTime: true,
                              noCalendar: true,
                              dateFormat: "H:i",
                              disableMobile: true,
                              defaultDate: "10:00"
                          })
                          flatpickr(`#endTime${v.shifts.length - 1}`, {
                              enableTime: true,
                              noCalendar: true,
                              dateFormat: "H:i",
                              disableMobile: true,
                              defaultDate: "20:00"
                          })
                      }, 200)
                  }
              })
              this.allShow = true*/
        },


        /*Function to delete*/
        deleteGroup(each, index) {
            each.shifts.splice(index, 1)
        },

        /*Function to initialize end date*/
        endDateFlatpickr() {
            /* flatpickr("#endDate", {
                 dateFormat: "Y-m-d",
                 altFormat: 'M j, Y',
                 altInput: true,
                 disableMobile: true,
             })*/
        },

        /*Function to initialize end time*/
        endTimeFlatpickr() {
            /* flatpickr("#endTime0", {
                 enableTime: true,
                 noCalendar: true,
                 dateFormat: "H:i",
                 disableMobile: true,
                 defaultDate: "20:00"
             })*/
        },

        // Function to retrieve data from session storage
        retrieveMarketplaceData() {
            const storedDataJson = session.getSession('marketplaceInfo')
            // Convert the JSON string back to a JavaScript object
            if (storedDataJson != null) {
                this.formData = JSON.parse(storedDataJson);
                /*These functions will called when the page loads.*/
                setTimeout(() => {
                    this.startTimeFlatpickr();
                }, 100)
            }
        },

        /*Function to initialize start date */
        startDateFlatpickr() {
            /*flatpickr("#startDate0", {
                dateFormat: "Y-m-d",
                altFormat: 'M j, Y',
                altInput: true,
                defaultDate: this.startFormatDate(),
                disableMobile: true,
            })*/
        },

        /*Function to format the date */

        // function to initialize start date
        startTimeFlatpickr() {
            this.formData.days.forEach((day, i) => {
                day.shifts.forEach((v, j) => {
                    flatpickr("#startTime" + day.name + i + j, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        disableMobile: true,
                        defaultDate: "10:00"
                    })
                    flatpickr("#endTime" + day.name + i + j, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        disableMobile: true,
                        defaultDate: "20:00"
                    })
                })
            })

        },




        /*Function to change the day status*/
        toggleStatus(data) {
            if (data.status === 1) {
                data.status = 2
            } else {
                data.status = 1
            }

        },



    },


}

</script>
