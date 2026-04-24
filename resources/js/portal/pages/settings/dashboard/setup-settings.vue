<template>

    <div class="settings w-100 pt-5" :style="{ backgroundImage: 'url(../images/portal/settings-background.png)' }">
        <div class="row justify-content-center p-3">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="h1 fw-bold">
                            Business Settings
                        </div>
                        <div class="text-secondary mb-3">
                            Manage all your Barberly settings in one place.
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">

                        <!-- Account Setup -->
                        <div class="border w-100 rounded-4 mb-3 bg-white">
                            <div class="h4 fw-bold mb-0 mb-sm-3 pt-3 pt-sm-4 pb-0 px-3 px-sm-4">
                                Account Setup
                            </div>

                            <router-link :to="{name: 'Account'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4">
                                <div>
                                    <div class="fw-bold">Business details</div>
                                    <div class="text-secondary">
                                        Manage settings such as your business name and time zone
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Location</div>
                                    <div class="text-secondary">
                                        Manage multiple outlets for your business
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Online Booking</div>
                                    <div class="text-secondary">
                                        Adjust the way clients are able to book and manage their appointments online
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <router-link :to="{name: 'Resources'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Resources</div>
                                    <div class="text-secondary">
                                        set up bookable resources such as rooms and equipment and assign them to
                                        services
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Business close period</div>
                                    <div class="text-secondary">
                                        Set the period when your business is closed
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                        </div>

                        <!-- Services -->
                        <div class="border w-100 rounded-4 mb-3 bg-white">
                            <div class="h4 fw-bold mb-0 mb-sm-3 pt-3 pt-sm-4 pb-0 px-3 px-sm-4">
                                Services
                            </div>

                            <router-link :to="{name: 'Services'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4">
                                <div>
                                    <div class="fw-bold">Services menu</div>
                                    <div class="text-secondary">
                                        Add, edit and delete the types of services available for appointment bookings
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                            <router-link :to="{name: 'Memberships'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Memberships</div>
                                    <div class="text-secondary">
                                        Add, edit and delete multi session memberships available for sale
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                        </div>

                        <!-- Team -->
                        <div class="border w-100 rounded-4 mb-3 bg-white">
                            <div class="h4 fw-bold mb-0 mb-sm-3 pt-3 pt-sm-4 pb-0 px-3 px-sm-4">
                                Team
                            </div>

                            <router-link :to="{name: 'Employees'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4">
                                <div>
                                    <div class="fw-bold">Team members</div>
                                    <div class="text-secondary">
                                        Add, edit and delete your team members
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                            <router-link :to="{name: 'workingHour'}"
                               class="btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Working hours</div>
                                    <div class="text-secondary">
                                        Manage working hours of your team members
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </router-link>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Permissions</div>
                                    <div class="text-secondary">
                                        Configure level of access to Fresha for each of your team members
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Commissions</div>
                                    <div class="text-secondary">
                                        Set up the calculation of commissions for team members
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Time off types</div>
                                    <div class="text-secondary">
                                        Set up custom reasons for when team members add time off
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                        </div>

                    </div>

                    <div class="col-12 col-xl-6">

                        <!-- Clients -->
                        <div class="border w-100 rounded-4 mb-3 bg-white">
                            <div class="h4 fw-bold mb-0 mb-sm-3 pt-3 pt-sm-4 pb-0 px-3 px-sm-4">
                                Clients
                            </div>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4">
                                <div>
                                    <div class="fw-bold">Client notifications</div>
                                    <div class="text-secondary">
                                        Review messages sent to clients about their appointments
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Referral sources</div>
                                    <div class="text-secondary">
                                        Set up custom sources to track how clients found your business
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Cancellation reasons</div>
                                    <div class="text-secondary">
                                        Track why clients did not arrive for their appointments
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                        </div>

                        <!-- Sales -->
                        <div class="border w-100 rounded-4 mb-3 bg-white">
                            <div class="h4 fw-bold mb-0 mb-sm-3 pt-3 pt-sm-4 pb-0 px-3 px-sm-4">
                                Sales
                            </div>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4">
                                <div>
                                    <div class="fw-bold">Receipt sequencing</div>
                                    <div class="text-secondary">
                                        Configure details displayed on sales receipts issued to your clients
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Receipt template</div>
                                    <div class="text-secondary">
                                        Configure details displayed on sales receipts issued to your clients
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Taxes</div>
                                    <div class="text-secondary">
                                        Manage tax rates that apply to items sold at checkout
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Service charges</div>
                                    <div class="text-secondary">
                                        Manage any extra charges that apply to services and items sold at checkout
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Tips</div>
                                    <div class="text-secondary">
                                        Manage tipping settings for your business
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Payment types</div>
                                    <div class="text-secondary">
                                        Set up manual payment types for use during checkout
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Gift cards</div>
                                    <div class="text-secondary">
                                        Setup your gift cards
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                            <a href="javascript:void(0)"
                               class="disable-feature btn-effect text-decoration-none text-dark d-flex align-items-center justify-content-between p-3 p-sm-4 border-top">
                                <div>
                                    <div class="fw-bold">Upselling</div>
                                    <div class="text-secondary">
                                        Upsell services when clients book online
                                    </div>
                                </div>
                                <img :src="`/images/global/chevron-right.svg`" class="setting-arrow" alt="chevron">
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</template>

<script>

export default {

    data() {

        return {

        }

    },

    mounted() {


    },

    methods: {}

}

</script>
