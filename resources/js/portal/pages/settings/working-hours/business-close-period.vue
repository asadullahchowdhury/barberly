<template>

    <div class="working-hour">
        <div class="p-3 p-sm-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8">

                    <!-- business close period header -->
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <router-link :to="{name: 'SetupSettings'}"
                                                     class="text-secondary text-decoration-none">
                                            Settings
                                        </router-link>
                                    </li>
                                    <li class="breadcrumb-item text-theme disable-feature"> Business close period</li>
                                </ol>
                            </nav>
                            <div class="h3 fw-semibold"> Close periods</div>
                            <small class="text-secondary">
                                Set the period when your business is closed.
                            </small>
                        </div>
                        <div class="mb-3 col-12 col-md-6 text-end">
                            <button type="button" class="btn btn-theme px-4" @click="openBusinessClosePeriodModal">
                                Add closed period
                            </button>
                        </div>
                    </div>

                    <!-- business close period body -->
                    <div class="business-close-period-body">
                        <div class="mb-3 border p-4 w-100 cursor-pointer rounded-3"
                             @click="openBusinessClosePeriodModal">
                            <div class="fw-semibold mb-1">
                                Mon, 1 Jan, 2024 - Mon, 31, 2024
                            </div>
                            <div class="text-secondary mb-1">
                                Location: All location
                            </div>
                            <div class="text-secondary">
                                Description: Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Exercitationem, quia?
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- business close period modal -->
    <div class="modal fade" id="businessClosePeriod" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form class="modal-content p-2">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Business Close Period</h1>
                    <button type="button" class="btn-close" @click="closeBusinessClosePeriodModal"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 line-height-2 d-flex align-items-center bg-theme-opacity mb-3">
                        <img :src="`/images/portal/warning-circle.svg`" class="w-24 h-24 me-2" alt="exclamation">
                        Online bookings cannot be placed when your business is closed.
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input id="startDate" type="text" name="startDate" class="form-control" required
                                       autocomplete="new-start-date" placeholder="Enter your Start Date"
                                       v-model="formData.startDate">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="endDate" class="form-label">End Date</label>
                                <input id="endDate" type="text" name="endDate" class="form-control" required
                                       autocomplete="new-end-date" placeholder="Enter your End Date"
                                       v-model="formData.endDate">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-textarea" cols="30" rows="3"
                                          required autocomplete="new-description"
                                          placeholder="Enter your public holiday"
                                          v-model="formData.holidayDescription"></textarea>
                            </div>
                        </div>
                        <div class="px-2">
                            <hr class="border">
                        </div>
                        <div class="col-12">
                            <label class="mb-3 fw-semibold form-label">
                                <input type="checkbox" class="form-checkbox me-2">
                                <span class="fs-5">
                                    Select all locations
                                </span>
                            </label>

                            <label for="location" class="form-label d-block">
                                <input id="location" type="checkbox" class="form-checkbox me-2"
                                       v-model="formData.location">
                                barberly_io
                            </label>

                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary h-45 w-110" @click="closeBusinessClosePeriodModal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger h-45 w-110">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>

import flatpickr from "flatpickr";

export default {

    data() {

        return {

            formData: {
                startDate: '',
                endDate: '',
                holidayDescription: '',
                location: '',
            }

        }

    },

    mounted() {

        this.startFormatDate();
        this.startDateFlatpickr();
        this.endDateFlatpickr();

    },

    methods: {

        openBusinessClosePeriodModal() {
            const myModal = new bootstrap.Modal("#businessClosePeriod", {keyboard: false, backdrop: 'static'});
            myModal.show();
        },

        closeBusinessClosePeriodModal() {
            const myModal = document.querySelector("#businessClosePeriod");
            const modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
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
                defaultDate: this.startFormatDate(),
                disableMobile: true,
            })
        },

    }

}

</script>
