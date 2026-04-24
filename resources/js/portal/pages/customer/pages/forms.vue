<template>

    <div class="container-fluid p-3 p-sm-4 card-automated-message-section">
        <div class="d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-11 col-xl-10 col-xxl-9">
                <div class="pt-5 pt-xl-4">

                <div class="row align-items-center mt-3">
                    <div class="col-md-9">
                        <div class="h3 fw-semibold">
                            Forms
                        </div>
                        Create and send forms to your client. <a href="javascript:void(0)" class="beauty-text-hover"> Learn more </a>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <a href="javascript:void(0)" class="btn btn-theme btn-anchor">
                            Create Form
                        </a>
                    </div>
                </div>

                <!-- table data start -->
                <table class="table mt-5 padding-x-16">
                    <thead>
                        <tr>
                            <th class="fw-semibold padding-left-18">Consultation form name</th>
                            <th class="fw-semibold">Services</th>
                            <th class="fw-semibold">Request</th>
                            <th class="fw-semibold">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="padding-left-18">COVID 19</td>
                            <td>All Services</td>
                            <td>Before appointment</td>
                            <td> <span class="badge bg-warning-subtle text-warning px-3"> inActive </span> </td>
                            <td>
                                <div class="customer-dropdown d-flex justify-content-end margin-right-10">
                                    <a href="javascript:void(0)" @click="dropdown($event)">
                                        <img :src="`/images/portal/horizontal-dots.svg`" class="w-20 h-20" alt="horizontal-dots.svg">
                                    </a>
                                    <div class="customer-dropdown-menu border-radius-5 outsideClick w-170">
                                        <div class="tip-arrow"></div>
                                        <router-link :to="{name: 'CustomerOverview'}" class="border-radius-5"> Overview </router-link>
                                        <a href="javascript:void(0)" class="border-radius-5"> Edit </a>
                                        <a href="javascript:void(0)" class="border-radius-5"> Preview </a>
                                        <a href="javascript:void(0)" class="border-radius-5"> Activate </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>

</template>

<script>

export default {

    data(){

        return{}

    },

    mounted() {

        this.dropdownInit();

    },

    methods: {

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
