<template>

    <!-- Appointment -->
    <div class="appointment">
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-4 col-xl-3 appointment-sidebar border-end order-1 order-lg-0 p-3 overflow-y-scroll scrollbar">

                    <div class="fs-4 ps-2 mb-3 pt-3 pt-md-3 fw-bold">
                        Appointments
                    </div>

                    <div class="fs-5 ps-2 mb-3 fw-bold">
                        Upcoming
                    </div>

                    <!-- Upcoming appointment -->
                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-01.jpg`" class="w-62 h-62 rounded-3" alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Jhalak Burdan</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                    <!-- No data text -->
                    <div class="fs-6 mb-3 text-secondary text-opacity-50 fw-normal d-none">
                        You have no upcoming appointments
                    </div>

                    <!-- Past appointment -->
                    <div class="mb-1 ps-2">
                        <div class="d-flex align-items-center">
                            <span class="me-2 fs-4 fw-bold">
                                Past
                            </span>
                            <span
                                class="badge bg-theme-opacity text-dark rounded-circle p-2 w-20 h-20 d-flex align-items-center justify-content-center">
                                5
                            </span>
                        </div>
                    </div>

                    <!-- Appointment data -->
                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-01.jpg`" class="w-64 h-64 rounded-3 object-fit-cover"
                             alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Thai odjay spa</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-02.jpg`" class="w-64 h-64 rounded-3 object-fit-cover"
                             alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Clay Beauty</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-03.jpg`" class="w-64 h-64 rounded-3 object-fit-cover"
                             alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Trendy Trim</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-04.jpg`" class="w-64 h-64 rounded-3 object-fit-cover"
                             alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Family Salon Academy</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                    <a href="javascript:void(0)"
                       class="bg-effect text-decoration-none d-flex align-items-center p-2 rounded-3 mb-1">
                        <img :src="`/images/home/post/post-05.jpg`" class="w-64 h-64 rounded-3 object-fit-cover"
                             alt="appointment 1">
                        <div class="ms-2">
                            <div class="fw-semibold mb-1 text-dark"> Body delight thai spa</div>
                            <small class="d-block text-dark">
                                <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                            </small>
                        </div>
                    </a>

                </div>
                <div class="col-lg-8 col-xl-9 appointment-content order-0 order-lg-1 p-3">

                    <!-- Appointment single data -->
                    <div class="position-relative">

                        <!-- Appointment single data - image -->
                        <img :src="`/images/home/post/post-01.jpg`" class="img-fluid w-100 object-fit-cover"
                             alt="appointment">

                        <!-- Appointment single data - title -->
                        <div
                            class="position-absolute bottom-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-end">
                            <div class="fs-2 p-3 text-start fw-bold mt-3 text-white">
                                Lia Asthetic | Laser & skin clinic
                            </div>
                        </div>
                    </div>

                    <div class="p-2 p-lg-4">

                        <!-- Appointment single data - status -->

                        <div class="badge ms-2 bg-theme text-white py-2 px-4 rounded-pill">
                            <div class="d-flex align-items-center">
                                <img :src="`/images/home/appointment/check-circle.svg`" class="w-12 h-12"
                                     alt="check-circle">
                                <span class="ms-2"> Confirmed </span>
                            </div>
                        </div>

                        <div class="badge ms-2 bg-danger text-white py-2 px-4 rounded-pill d-none">
                            <div class="d-flex align-items-center">
                                <img :src="`/images/home/appointment/cancel.svg`" class="w-12 h-12" alt="check-circle">
                                <span class="ms-2"> Cancel </span>
                            </div>
                        </div>

                        <!-- Appointment single data - date and time -->
                        <div class="mt-3 ms-2 fs-4 fw-bold">
                            Fri 16 Feb 2024 at 11:00
                        </div>

                        <!-- Appointment single data - duration -->
                        <small class="mt-2 ms-2 text-secondary d-block">
                            1 hour duration
                        </small>

                        <!-- Appointment single data - activity of modal -->
                        <div class="my-3">

                            <a href="javascript:void(0)"
                               class="bg-light-effect d-flex align-items-center text-decoration-none px-2 rounded-2"
                               @click="openCalendarModal">
                                <div
                                    class="bg-theme-opacity w-38 h-38 rounded-circle d-flex align-items-center justify-content-center">
                                    <img :src="`/images/home/appointment/calendar.svg`" class="w-20 h-20"
                                         alt="appoint-getting">
                                </div>
                                <div class="ms-2 border-bottom w-100 py-3">
                                    <div class="h6 mb-0 text-dark">Add to calendar</div>
                                    <div class="text-secondary">Set yourself a reminder</div>
                                </div>
                            </a>

                            <router-link :to="{name: 'Address'}"
                                         class="bg-light-effect d-flex align-items-center text-decoration-none px-2 rounded-2">
                                <div
                                    class="bg-theme-opacity w-38 h-38 rounded-circle d-flex align-items-center justify-content-center">
                                    <img :src="`/images/home/appointment/getting.svg`" class="w-20 h-20"
                                         alt="appoint-getting">
                                </div>
                                <div class="ms-2 border-bottom w-100 py-3">
                                    <div class="h6 mb-0 text-dark">Getting there</div>
                                    <div class="text-secondary">Jessore, Airport, Bypass Road, Jessore, Khulna
                                        Division
                                    </div>
                                </div>
                            </router-link>

                            <a href="javascript:void(0)"
                               class="bg-light-effect d-flex align-items-center text-decoration-none px-2 rounded-2"
                               @click="openManageAppointmentModal">
                                <div
                                    class="bg-theme-opacity w-38 h-38 rounded-circle d-flex align-items-center justify-content-center">
                                    <img :src="`/images/home/appointment/reschedule.svg`" class="w-20 h-20"
                                         alt="appoint-getting">
                                </div>
                                <div class="ms-2 border-bottom w-100 py-3">
                                    <div class="h6 mb-0 text-dark">Management Appointment</div>
                                    <div class="text-secondary">Book your next appointment</div>
                                </div>
                            </a>

                            <a href="javascript:void(0)"
                               class="bg-light-effect d-flex align-items-center text-decoration-none px-2 rounded-2">
                                <div
                                    class="bg-theme-opacity w-38 h-38 rounded-circle d-flex align-items-center justify-content-center">
                                    <img :src="`/images/home/appointment/cart.svg`" class="w-20 h-20"
                                         alt="appoint-getting">
                                </div>
                                <div class="ms-2 border-bottom w-100 py-3">
                                    <div class="h6 mb-0 text-dark">Booking</div>
                                    <div class="text-secondary">Book your next appointment</div>
                                </div>
                            </a>

                            <router-link :to="{name:'SalonSingle', params:{id:1} }"
                                         class="bg-light-effect d-flex align-items-center text-decoration-none px-2 rounded-2">
                                <div
                                    class="bg-theme-opacity w-38 h-38 rounded-circle d-flex align-items-center justify-content-center">
                                    <img :src="`/images/home/appointment/store.svg`" class="w-20 h-20"
                                         alt="appoint-getting">
                                </div>
                                <div class="ms-2 border-bottom w-100 py-3">
                                    <div class="h6 mb-0 text-dark">Venue details</div>
                                    <div class="text-secondary">John Smith</div>
                                </div>
                            </router-link>

                        </div>

                        <!-- Appointment single data - overview -->
                        <div class="fs-5 mt-5 ps-3 fw-bold">Overview</div>

                        <!-- Appointment single data - services and prices -->
                        <div class="p-3 d-flex align-items-start justify-content-between border-bottom">
                            <div class="d-inline-block">
                                <div class="mb-1">service one</div>
                                <div class="d-block">1 hour pricing one</div>
                            </div>
                            <div class="d-inline-block fw-semibold">
                                BDT 33
                            </div>
                        </div>

                        <!-- Appointment single data - total amount -->
                        <div class="p-3 d-flex align-items-center justify-content-between fw-bold">
                            <div>
                                Total
                            </div>
                            <div>
                                BDT 33
                            </div>
                        </div>

                        <!-- Appointment single data - aftercare description -->
                        <div class="fw-bold fs-5 py-3 ps-3">
                            Important info
                        </div>

                        <div class="ps-3 pb-3">
                            If more then 1000 rupees then need to extra payment as transport cost. Before booking please
                            call us.
                        </div>

                        <!-- Appointment single data - booking reference -->
                        <div class="ps-3 pb-3 text-secondary text-opacity-75">
                            Booking ref: 48A1770A
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- calendar Modal -->
        <div class="modal fade" id="calendarModule" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Add to calendar</h1>
                        <button type="button" class="btn-close shadow-none" @click="closeCalendarModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center px-3 py-2 rounded-3 mb-1">
                            <img :src="`/images/home/post/post-01.jpg`" class="w-62 h-62 rounded-3" alt="appointment 1">
                            <div class="ms-4">
                                <div class="d-block fw-bold"> Fri 16 Feb 2024 at 11:00</div>
                                <div class="fw-semibold mb-1 text-dark"> John Smith</div>
                                <div class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-theme position-relative height-50 w-100 mb-2">
                                <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                    <img :src="`/images/authentication/google.png`" alt="google">
                                </span>
                                Google Calendar
                            </button>

                            <button type="button" class="btn-theme has-border height-50 w-100">
                                Other Calendar
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- management appointment Modal -->
        <div class="modal fade" id="managementAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Manage appointment</h1>
                        <button type="button" class="btn-close shadow-none"
                                @click="closeManageAppointmentModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center px-3 py-2 rounded-3 mb-1">
                            <img :src="`/images/home/post/post-01.jpg`" class="w-64 h-64 rounded-3" alt="appointment 1">
                            <div class="ms-4">
                                <div class="d-block fw-bold"> Fri 16 Feb 2024 at 11:00</div>
                                <div class="fw-semibold mb-1 text-dark"> John Smith</div>
                                <div class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn-white has-border text-start height-50 w-100 mb-2 px-3">
                                <img :src="`/images/home/appointment/appointment-reschedule.svg`" class="w-20 h-20 me-2"
                                     alt="appointment-reschedule">
                                Reschedule appointment
                            </button>

                            <button type="button" class="btn-white has-border text-start height-50 w-100 px-3"
                                    data-bs-toggle="modal" @click="openCancelAppointment">
                                <img :src="`/images/home/appointment/appointment-cancel.svg`" class="w-20 h-20 me-2"
                                     alt="appointment-cancel">
                                Cancel appointment
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- cancel appointment -->
        <div class="modal fade" id="cancelAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header border-bottom-0">
                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Cancel appointment</h1>
                        <button type="button" class="btn-close shadow-none" @click="closeCancelAppointment"></button>
                    </div>
                    <div class="modal-body">

                        <div class="fs-3 mb-3 fw-bold">
                            Are you sure you want to cancel?
                        </div>

                        <div class="mb-3">
                            If you want to change the appointment time, you can reschedule your appointment.
                        </div>
                        <div class="mb-3">
                            Are you sure you want to cancel your appointment?
                        </div>

                        <button type="button" class="btn btn-white has-border w-100 height-50">
                            Yes, Cancel
                        </button>

                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>

export default {

    data() {

        return {}

    },

    mounted() {


    },

    methods: {

        /* Function to open calendar modal */
        openCalendarModal() {
            let modal = new bootstrap.Modal(document.getElementById('calendarModule'))
            modal.show();
        },

        /* Function to close calendar modal */
        closeCalendarModal() {
            const Modal = document.querySelector('#calendarModule');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open manage appointment modal */
        openManageAppointmentModal() {
            let modal = new bootstrap.Modal(document.getElementById('managementAppointmentModal'))
            modal.show();
        },

        /* Function to close manage appointment modal */
        closeManageAppointmentModal() {
            const Modal = document.querySelector('#managementAppointmentModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open cancel appointment */
        openCancelAppointment() {
            let modal = new bootstrap.Modal(document.getElementById('cancelAppointmentModal'))
            modal.show();
        },

        /* Function to open cancel appointment */
        closeCancelAppointment() {
            const Modal = document.querySelector('#cancelAppointmentModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

    }

}

</script>
