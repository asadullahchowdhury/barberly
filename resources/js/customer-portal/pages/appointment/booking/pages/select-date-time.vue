<template>
    <div class="select-date-time">

        <h3 class="fs-1 fw-bold title mb-3">Select time</h3>

        <div class="row">
            <div class="col-md-6 mb-md-0 mb-3">
                <div class="form-group">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" class="form-control" id="date" placeholder="Select date">
                </div>
            </div>
        </div>
        <!--                <h3 class="fs-1 fw-bold title mb-3">Select time</h3>-->

        <!--                <div class="picker-wrapper">
                            &lt;!&ndash;Calendar header start&ndash;&gt;
                            <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                                <div class="title fw-bold">March 2024</div>

                                <div class="buttons">
                                    <button type="button" class="btn btn-icon mx-1 previous" @click="previous">
                                        <img :src="`/images/global/chevron-left.svg`" alt="previous">
                                    </button>
                                    <button type="button" class="btn btn-icon mx-1 next" @click="next">
                                        <img :src="`/images/global/chevron-right.svg`" alt="next">
                                    </button>
                                </div>
                            </div>
                        </div>-->
        <!--Calendar header end  -->

        <!--Dates start-->
        <!--                <div class="dates-wrapper gap-4 mb-4">
                            <div class="each-date text-center" v-if="datesArray.length > 0" v-for="each in datesArray">
                                <div
                                    class="date p-3 border rounded-circle d-flex justify-content-center align-items-center fw-bold fs-4 w-64 h-64">
                                    {{ each?.formattedDate }}
                                </div>
                                <div class="fw-bold mt-1">{{ each.dayOfWeek }}</div>
                            </div>
                        </div>-->
        <!--Dates end  -->

        <!--                Time list start-->
        <div class="time-wrapper mt-4">
            <template v-for="each in timeArray">
                <div class="card card-time card-body mb-3 fw-semibold" @click="assignTime(each.time)"
                     :class="{'selected' : formData.time == each.time}">
                    {{ each.time }}
                </div>
            </template>
        </div>
        <!--                Time list end  -->


    </div>
</template>

<script>
import flatpickr from "flatpickr";

export default {
    setup() {
        return {
            datesArray: [],
            formData: {
                date: '',
                time: '',
            },
            loading: false,
            currentMonth: '',
            timeArray: [
                {time: '08:00am'},
                {time: '09:00am'},
                {time: '10:00am'},
                {time: '11:00am'},
                {time: '12:00pm'},
                {time: '01:00pm'},
                {time: '02:00pm'},
                {time: '03:00pm'},
                {time: '04:00pm'},
                {time: '05:00pm'},
                {time: '06:00pm'},
                {time: '07:00pm'},
                {time: '08:00pm'}
            ],
            singleID: '',

        }
    }
    ,
    mounted() {

        // this.generateDate();
        this.dateTimeInitializer()

    },


    methods: {
        /*generateDate() {
            this.loading = true;
            // Get the current date
            const currentDate = new Date();

// Get the current month and year
            this.currentMonth = currentDate.toLocaleString('default', {month: 'long'});

            const currentYear = currentDate.getFullYear();

// Get the number of days in the current month
            const numDays = new Date(currentYear, currentDate.getMonth() + 1, 0).getDate();

// Generate an array of dates for the current month
            this.datesArray = [];
            for (let day = 1; day <= numDays; day++) {
                const date = new Date(currentYear, currentDate.getMonth(), day);
                const formattedDate = date.toLocaleDateString('en-US', {
                    // year: 'numeric',
                    // month: '2-digit',
                    day: '2-digit'
                }).replace(/\//g, '-');
                const dayOfMonth = date.getDate();
                const dayOfWeek = date.toLocaleDateString('en-US', {weekday: 'short'});
                this.datesArray.push({month: this.currentMonth, dayOfWeek, dayOfMonth, formattedDate});
                this.loading = false;
            }

// Print the array of formatted dates
            console.log(this.datesArray);
            let today = currentDate.getDay()
            console.log(today)

        },

        next() {
            const rightBtn = document.querySelector('.next');
            rightBtn.addEventListener("click", function (event) {
                const content = document.querySelector('.picker-wrapper');
                content.scrollLeft += 300;
                event.preventDefault();
            });
        },

        previous() {
            const leftBtn = document.querySelector('.previous');
            leftBtn.addEventListener("click", function (event) {
                const content = document.querySelector('.picker-wrapper');
                content.scrollLeft -= 300;
                event.preventDefault();
            });
        },*/

        dateTimeInitializer() {
            setTimeout(()=>{
                flatpickr("#date", {
                    dateFormat: "Y-m-d",
                    altFormat: 'M j, Y',
                    altInput: true,
                    minDate: 'today',
                    defaultDate: 'today',
                    disableMobile: true,
                })
            },200)
        },

        assignTime(time) {
            this.formData.time = time;
        }

    }
}
</script>
