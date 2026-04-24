<template>


    <div class="container-fluid p-3 p-sm-4 card-automated-message-section">
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-11 col-xl-10 col-xxl-9">
                <div class="pt-5 pt-xl-4">

                    <div class="font-size-26 fw-semibold margin-bottom-10 cart-title">
                        Automated messages
                    </div>
                    <div class="font-weight-400 margin-bottom-20">
                        View and manage all automated messages sent to your clients.
                        <a href="javascript:void(0)" class="beauty-text-hover">
                            Learn more
                        </a>
                    </div>
                </div>

                <div class="sticky-top bg-white pt-3 pb-2 auto-message-group-btn z-1">
                    <div class="d-flex justify-content-start flex-wrap margin-bottom-20">
                        <a href="#reminder" class="btn btn-white rounded-pill me-2 mb-3 mb-md-0 padding-y-10 padding-x-12" :class="{ 'active' : tab === 1 }" @click="setTab(1)">
                            Reminders
                        </a>
                        <a href="#appointment" class="btn btn-white rounded-pill me-2 mb-3 mb-md-0 padding-y-10 padding-x-12" :class="{ 'active' : tab === 2 }" @click="setTab(2)">
                            Appointment Updates
                        </a>
                        <a href="#increase_booking" class="btn btn-white rounded-pill me-2 mb-3 mb-md-0 padding-y-10 padding-x-12" :class="{ 'active' : tab === 3 }" @click="setTab(3)">
                            Increase bookings
                        </a>
                    </div>
                </div>

                    <!-- reminders -->

                    <div class="font-size-26 fw-semibold margin-bottom-20 cart-title" id="reminder">
                        Reminders
                    </div>

                    <div class="row mb-4">

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img :src="`/images/portal/red-bell.svg`" class="img-fluid w-35 h-35" alt="red-bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        24 hour upcoming appointment reminder
                                    </div>
                                    Notifies clients reminding them of their upcoming appointment.
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img :src="`/images/portal/red-bell.svg`" class="img-fluid w-35 h-35" alt="red-bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        24 hour upcoming appointment reminder
                                    </div>
                                    Notifies clients reminding them of their upcoming appointment.
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="javascript:void(0)" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3 text-decoration-none">
                            <div class="border rounded-3 d-flex flex-column justify-content-center align-items-center border padding-y-40 h-100">
                                <div class="margin-bottom-20">
                                    <img :src="`/images/portal/plus-circle.svg`" class="w-45 h-45" alt="plus-circle">
                                </div>
                                <div class="text-theme text-decoration-none">
                                    Create new
                                </div>
                            </div>
                        </a>

                    </div>

                    <!-- appointment updates -->

                    <div class="font-size-26 fw-semibold margin-bottom-20 cart-title" id="appointment">
                        Appointment updates
                    </div>

                    <div class="row mb-4">

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img :src="`/images/appointment/calender-plus.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        Rescheduled appointment message
                                    </div>
                                    Reach out to clients when their appointment is booked for them.
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img :src="`/images/appointment/calendar-time.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        New appointment message
                                    </div>
                                    <div class="font-weight-400 margin-bottom-16">
                                        Automatically sends to clients when their appointment start time is changed.
                                    </div>
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img :src="`/images/appointment/calendar-cancel.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                <div class="fw-semibold margin-bottom-16">
                                    Cancelled appointment message
                                </div>
                                <div class="font-weight-400 margin-bottom-16">
                                    Automatically sends to clients when their appointment is cancelled.
                                </div>
                                <div class="my-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                Enabled
                                            </button>
                                        </div>
                                        <div class="col-6 text-end">
                                            <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                        <img :src="`/images/appointment/notshow.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        Did not show up message
                                    </div>
                                    <div class="font-weight-400 margin-bottom-16">
                                        Automatically sends to clients when their appointment is marked as a no-show.
                                    </div>
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                        <img :src="`/images/appointment/thanks.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        Thank you for visiting
                                    </div>
                                    <div class="font-weight-400 margin-bottom-16">
                                        Reach out to clients when their appointment is checked out, with a link to leave a review.
                                    </div>
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                        <img :src="`/images/appointment/heart.svg`" class="w-35 h-35" alt="bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        Thank you for tips
                                    </div>
                                    <div class="font-weight-400 margin-bottom-16">
                                        Notifies clients reminding them of their upcoming appointment.
                                    </div>
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- increase booking -->

                    <div class="font-size-26 fw-semibold margin-bottom-20 cart-title" id="increase_booking">
                        Increase booking
                    </div>

                    <div class="row">

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 p-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                        <img :src="`/images/portal/red-bell.svg`" class="w-35 h-35" alt="red-bell">
                                    <div class="customer-dropdown d-flex justify-content-end">
                                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-controller padding-x-10 padding-y-5">
                                            <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                        </a>
                                        <div class="customer-dropdown-menu margin-top-25 border-radius-5 outsideClick w-120">
                                            <div class="tip-arrow"></div>
                                            <router-link :to="{name: 'ConfigTigger'}" class="border-radius-5"> Edit </router-link>
                                            <a href="javascript:void(0)" class="border-radius-5 text-danger" data-bs-toggle="modal" data-bs-target="#ReminderDeleteModal"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-2 px-2">
                                    <div class="fw-semibold margin-bottom-16">
                                        24 hour upcoming appointment reminder
                                    </div>
                                    <div class="font-weight-400 margin-bottom-16">
                                        Remind your clients to rebook a few weeks after their last appointment.
                                    </div>
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn-badge text-success badge bg-success bg-opacity-25">
                                                    Enabled
                                                </button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <img :src="`/images/portal/envelope.svg`" class="img-fluid w-15 h-15" alt="envlope">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    <div class="modal fade" id="ReminderDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Remove reminder</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this reminder? This will also remove any customisation you've made.
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-secondary px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4 py-2">Remove</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {

    data() {

        return {
            tab: 1,
        }

    },

    mounted() {
        this.dropdownInit();
    },

    methods: {

        setTab(tab) {
            this.tab = tab;
        },

        // dropdown work on table
        dropdown(e) {
            let dropdown = document.querySelectorAll('.customer-dropdown-menu');
            dropdown.forEach(drop => {
                drop.classList.remove('active');
            })
            const dropdownMenu = e.target.closest('.customer-dropdown').querySelector('.customer-dropdown-menu');
            dropdownMenu.classList.add('active');
        },

        // dropdown outside control to remove dropdown
        dropdownInit() {
            document.addEventListener('mouseup', function (e) {
                const containers = Array.from(document.querySelectorAll('.outsideClick'));
                for (let i = 0; i < containers.length; i++) {
                    const clickedElement = e.target;
                    const isContainer = containers[i].contains(clickedElement);
                    if (isContainer) {
                        break;
                    } else {
                        containers[i].classList.remove('active');
                    }
                }
            });
        },

    }

}

</script>
