<template>

    <div class="notification">

        <!-- Notification header -->
        <div class="notification-header padding-x-20 d-flex justify-content-between align-items-center">
            <div class="w-100">
                <router-link :to="{name: 'Workspaces'}" class="notification-close-btn">
                    <img :src="`/images/global/x.svg`" class="close-btn" alt="close btn">
                </router-link>
            </div>
            <div class="w-100 text-center notification-title fw-semibold">
                Workspace notification settings
            </div>
            <div class="w-100 text-end">
                <button type="button" class="btn btn-anchor btn-theme padding-x-40">
                    Save
                </button>
            </div>
        </div>

        <!-- Notification body -->
        <div class="d-flex justify-content-center">
            <div class="notification-body">
                <div class="fw-semibold font-size-22 py-3 text-center">
                    Workspace notification settings
                </div>
                <div class="p-3 text-center">
                    Stay up to date with notifications.
                    <a href="javascript:void(0)" class="text-theme text-decoration-none">
                        Learn more
                    </a>
                </div>

                <div class="padding-x-20">

                    <!-- Activity and locations -->
                    <div class="notification-card-body border-radius-5 margin-top-24">
                        <div class="p-2 p-sm-3">
                            <div class="font-size-22 fw-semibold">
                                Activity and locations
                            </div>
                            <div class="padding-top-16">
                                Choose which events and locations you want to be notified about.
                            </div>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="p-2 p-sm-3">
                            <label for="notify_me_about" class="form-label">
                                Notify me about
                            </label>
                            <select id="notify_me_about" name="notify_me_about" class="form-select padding-x-20">
                                <option value="">Active Concerning all team members</option>
                                <option value="">My activity only</option>
                            </select>
                        </div>
                        <div class="p-2 p-sm-3">
                            <div class="notification-select-btn padding-x-20 d-flex justify-content-between align-items-center padding-x-15 padding-y-12 bg-theme-fade border-radius-10 h-50" v-if="!businessSelection">
                                Berber_io_moio
                                <a href="javascript:void(0)" @click="businessSelection = true">
                                    Edit
                                </a>
                            </div>
                            <div v-if="businessSelection">
                                <label for="for_location" class="form-label">
                                    For locations
                                </label>
                                <select id="for_location" name="for_location" class="form-select padding-x-20">
                                    <option value="">Berber_io_moio</option>
                                    <option value="">My activity only</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card-body border-radius-5 margin-y-24">

                        <!-- Appointments -->
                        <div class="p-2 p-sm-3 border-bottom">
                            <div class="font-size-22 fw-semibold">
                                Appointments
                            </div>
                            <div class="padding-top-16">
                                Choose the types of appointment activity to get notified about.
                            </div>
                        </div>

                        <!-- New appointments -->
                        <label for="market_place" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="market_place" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    New appointments & marketplace sales
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when new appointments are blocked and vouchers or membership brought
                                </span>
                            </span>
                        </label>

                        <!-- Marketplace sales -->
                        <label for="confirmations" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="confirmations" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Confirmations
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when appointments are marked as confirmed
                                </span>
                            </span>
                        </label>

                        <!-- Reschedules -->
                        <label for="reschedules" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="reschedules" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Reschedules
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when appointment times are updated
                                </span>
                            </span>
                        </label>

                        <!-- No shows -->
                        <label for="no-shows" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="no-shows" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    No-shows
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when appointments are marked as no-show
                                </span>
                            </span>
                        </label>

                        <!-- Arrivals -->
                        <label for="arrivals" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="arrivals" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Arrivals
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when appointments are marked as arrived
                                </span>
                            </span>
                        </label>

                        <!-- Started -->
                        <label for="started" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="started" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">Started</span>
                                <span class="text-lighter font-weight-300 w-100">
                                    When appointments are marked as started
                                </span>
                            </span>
                        </label>

                        <!-- Started -->
                        <label for="started" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="started" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">Cancellations</span>
                                <span class="text-lighter font-weight-300 w-100">
                                    When appointment become cancelled
                                </span>
                            </span>
                        </label>

                    </div>

                    <!-- Online sales -->
                    <div class="notification-card-body border-radius-5 my-3">
                        <div class="p-2 p-sm-3 border-bottom">
                            <div class="font-size-22 fw-semibold">
                                Online sales
                            </div>
                            <div class="padding-top-16">
                                Choose the types of online sales activity to get notified about.
                            </div>
                        </div>

                        <label for="product_orders" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="product_orders" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Product orders
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when new appointments are blocked and vouchers or membership brought
                                </span>
                            </span>
                        </label>

                    </div>

                    <div class="notification-card-body border-radius-5 margin-y-24">
                        <div class="p-2 p-sm-3 border-bottom">

                            <!-- Online tips -->
                            <div class="font-size-22 fw-semibold">
                                Online tips
                            </div>
                            <div class="padding-top-16">
                                Choose the types of online tips activity to get notified about.
                            </div>
                        </div>

                        <!-- Product orders -->
                        <label for="product_orders" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="product_orders" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    tips
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when clicks leave a tip online
                                </span>
                            </span>
                        </label>

                    </div>

                    <div class="notification-card-body border-radius-5 my-3">

                        <!-- Ratings -->
                        <div class="p-2 p-sm-3 border-bottom">
                            <div class="font-size-22 fw-semibold">
                                Ratings and reviews
                            </div>
                            <div class="padding-top-16">
                                Choose how you want to be notified about new reviews.
                            </div>
                        </div>

                        <!-- Reviews -->
                        <label for="reviews" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="reviews" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">Reviews</span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when clicks leave a review online
                                </span>
                            </span>
                        </label>

                        <!-- Activity summary email -->
                        <label for="activity-summary-email" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="activity-summary-email" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Activity summary email
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when clicks leave a review online
                                </span>
                            </span>
                        </label>

                        <!-- Daily or weekly -->
                        <div class="px-2 px-sm-3">
                            <label for="activity_summary_email_daily" class="form-label d-flex align-items-center padding-12">
                                <input id="activity_summary_email_daily" name="active_summary_email" type="radio" class="form-radio margin-right-10">
                                Daily
                            </label>
                            <label for="activity_summary_email_weekly" class="form-label d-flex align-items-center padding-12">
                                <input id="activity_summary_email_weekly" name="active_summary_email" type="radio" class="form-radio margin-right-10">
                                Weekly
                            </label>
                        </div>

                    </div>

                    <!-- Product stock -->
                    <div class="notification-card-body border-radius-5 my-3">
                        <div class="p-2 p-sm-3 border-bottom">
                            <div class="font-size-22 fw-semibold">
                                Product stock
                            </div>
                            <div class="pb-2">
                                Choose the types of product stock notifications to get notified about.
                            </div>
                        </div>

                        <!-- Low stock alert -->
                        <label for="low_stock_alert" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="low_stock_alert" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Low stock alert
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    when a particular product reaches it's low stock level
                                </span>
                            </span>
                        </label>

                        <!-- Low stock alert -->
                        <label for="low_stock_summary" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="low_stock_summary" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-2">
                                <span class="text-dark-gray w-100">
                                    Low stock summary
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    opt into a summary of all products low in stock
                                </span>
                            </span>
                        </label>

                        <!-- Daily or weekly or monthly -->
                        <div class="px-sm-3 px-2">
                            <label for="low_stock_summary_day" class="form-label padding-12">
                                <input id="low_stock_summary_day" name="low-stock-summary" type="radio" class="form-radio margin-right-10">
                                Daily
                            </label>
                            <label for="low_stock_summary_weekly" class="form-label d-flex align-items-center padding-12">
                                <input id="low_stock_summary_weekly" name="low-stock-summary" type="radio" class="form-radio margin-right-10">
                                Weekly
                            </label>
                            <label for="low_stock_summary_monthly" class="form-label d-flex align-items-center padding-12">
                                <input id="low_stock_summary_monthly" name="low-stock-summary" type="radio" class="form-radio margin-right-10">
                                Monthly
                            </label>
                        </div>

                    </div>

                    <div class="notification-card-body border-radius-5 pt-3 my-3">

                        <!-- Marketing -->
                        <div class="px-sm-3 px-2 border-bottom">
                            <div class="font-size-22 fw-semibold">
                                Marketing
                            </div>
                            <div class="py-2">
                                Choose the types of marketing activity to get notified about.
                            </div>
                        </div>

                        <!-- Blast campaign resending -->
                        <label for="blast_campaign_resending" class="form-label p-3 d-flex align-items-center">
                            <span class="w-30">
                                <input id="blast_campaign_resending" checked type="checkbox" class="form-checkbox">
                            </span>
                            <span class="me-3">
                                <span class="text-dark-gray w-100">
                                    Blast campaign resending
                                </span>
                                <span class="text-lighter font-weight-300 w-100">
                                    Receive reminders to resend blast campaigns to clients who have not yet opened them
                                </span>
                            </span>
                        </label>

                    </div>

                </div>

            </div>
        </div>
    </div>

</template>

<script>

export default {
    data(){
        return{
            /* Return property data */
            businessSelection: false,
        }
    },
    mounted() {
        /*This function for scroll */
        window.addEventListener('scroll', this.onScroll);
        setTimeout(() => (this.loading = false), 3000);
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.onScroll);
    },
    methods: {

        /* Function to scroll */
        onScroll(event){
            if(window.scrollY > 50){
                document.querySelector('.notification-header').classList.add('header-scrolled');
            }else{
                document.querySelector('.notification-header').classList.remove('header-scrolled');
            }
        },
    }
}

</script>
