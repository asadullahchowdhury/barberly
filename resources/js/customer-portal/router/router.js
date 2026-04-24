import {createRouter, createWebHistory} from "vue-router";


//=====================
// Pages
//=====================
import Layout from "../pages/auth/layout/layout.vue";
import Login from "../pages/auth/pages/login.vue";
import Password from "../pages/auth/pages/password.vue";
import ForgetPassword from "../pages/auth/pages/forget-password.vue";
import ChangePassword from "../pages/auth/pages/change-password.vue";
import Registration from "../pages/auth/pages/registration.vue";
import UserFlow from "../pages/auth/pages/user-flow.vue";

import HomeLayout from "../layout/layout.vue";
import Home from "../pages/home/home.vue";

import Appointments from "../pages/appointment/appointment.vue";
import Address from "../pages/address/address.vue";
import Favorites from "../pages/favorite/favorite.vue";
import Forms from "../pages/form/form.vue";
import Memberships from "../pages/membership/membership.vue";
import Orders from "../pages/orders/orders.vue";
import GiftCards from "../pages/gift-card/gift-card.vue";

import SalonLayout from "../pages/salon/layout/layout.vue"
import SalonSingle from "../pages/salon/salon-single.vue";

import BookingLayout from "../pages/appointment/booking/layout/layout.vue"
import SelectServices from "../pages/appointment/booking/pages/select-services.vue";
import SelectProfessional from "../pages/appointment/booking/pages/select-professional.vue";
import selectDateTime from "../pages/appointment/booking/pages/select-date-time.vue";
import ConfirmAppointment from "../pages/appointment/booking/pages/confirm-booking.vue";

import PartnerLayout from "../partners/layout/layout.vue";
import ForBusiness from "../partners/pages/for-business.vue";
import DownloadApp from "../pages/download-app/download-app.vue";

import PricingLayout from "../pricing/layout/layout.vue";
import Pricing from "../pricing/pages/pricing.vue";

import Profile from "../pages/profile/profile.vue";

const TITLE = window.core.APP_NAME
const ROOT_URL = "/customer";
const routes = [

    // Home layout and routes
    {
        path: ROOT_URL, name: 'HomeLayout', component: HomeLayout,
        children: [
            {path: '', name: 'Home', component: Home, meta: {title: TITLE + 'Home'}},
        ]
    },

    // Salon layout and routes
    {
        path: ROOT_URL, name: 'SalonLayout', component: SalonLayout,
        children: [
            { path: 'salon/single/:id', name: 'SalonSingle', component: SalonSingle, meta: {title: TITLE + 'Salon Single'} },
            { path: 'profile', name: 'Profile', component: Profile, meta: {title: TITLE + 'Profile', requiresAuth: true } },
            {path: 'appointments', name: 'Appointments', component: Appointments, meta: {title: TITLE + 'Appointments'}},
            {path: 'search', name: 'Address', component: Address, meta: {title: TITLE + 'Address'}},
            {path: 'favorites', name: 'Favorites', component: Favorites, meta: {title: TITLE + 'Favorites'}},
            {path: 'forms', name: 'Forms', component: Forms, meta: {title: TITLE + 'Forms'}},
            {path: 'memberships', name: 'Memberships', component: Memberships, meta: {title: TITLE + 'Memberships'}},
            {path: 'orders', name: 'Orders', component: Orders, meta: {title: TITLE + 'Orders'}},
            {path: 'gift-cards', name: 'GiftCards', component: GiftCards, meta: {title: TITLE + 'Gift cards'}},
            {path: 'download-app', name: 'DownloadApp', component: DownloadApp, meta: {title: TITLE + 'Download App'}},
        ]
    },

    // Booking layout and routes
    {
        path: ROOT_URL, name: 'BookingLayout', component: BookingLayout,
        children: [
            { path: 'appointment/select/services', name: 'SelectServices', component: SelectServices, meta: {title: TITLE + 'Select Services'} },
            { path: 'appointment/select/professional', name: 'SelectProfessional', component: SelectProfessional, meta: {title: TITLE + 'Select Professional'} },
            { path: 'appointment/select/time', name: 'selectDateTime', component: selectDateTime, meta: {title: TITLE + 'Select Date and time'} },
            { path: 'appointment/confirm', name: 'ConfirmAppointment', component: ConfirmAppointment, meta: {title: TITLE + 'Confirm Appointment'} }
        ]
    },

    // Auth layout and routes
    {
        path: ROOT_URL + '/auth/', name: 'Layout', component: Layout,
        children: [
            { path: 'sign-in', name: 'Sign-In', component: Login, meta: {title: TITLE + 'Sign In'} },
            { path: 'sign-in/password', name: 'Password', component: Password, meta: {title: TITLE + ' Password'} },
            { path: 'forget/password', name: 'Forget_password', component: ForgetPassword, meta: {title: TITLE + ' Forget Password'} },
            { path: 'registration', name: 'Registration', component: Registration, meta: {title: TITLE + ' Registration'} },
            { path: 'change/password/:token', name: 'Change_password', component: ChangePassword, meta: {title: TITLE + ' Change Password'} },
            { path: 'user-flow', name: 'UserFlow', component: UserFlow, meta: {title: TITLE + ' User Flow'} }
        ]
    },

    // Partners layout and routes
    {
        path: ROOT_URL + '/for-business', name: 'PartnerLayout', component: PartnerLayout,
        children: [
            { path: '', name: 'ForBusiness', component: ForBusiness, meta: {title: TITLE + 'For Business'} },
        ]
    },

    // Pricing layout and routes
    {
        path: ROOT_URL + '/pricing', name: 'PricingLayout', component: PricingLayout,
        children: [
            { path: '', name: 'Pricing', component: Pricing, meta: {title: TITLE + 'Pricing'} },
        ]
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
})
const checkAuthMiddleware = (to, from, next) => {
    const userInfo = window.core.UserInfo;
    const requiresAuth = to.matched.some(route => route.meta.requiresAuth);

    if (requiresAuth && !userInfo) {
        // Redirect unauthenticated users to the sign-in page
        next({name: 'Sign-In'});
    } else if (to.name === 'Sign-In' && userInfo) {
        // Prevent authenticated users from accessing the Sign-In page
        next({name: 'Profile'});
    } else {
        // Proceed to the requested route
        next();
    }
};

router.beforeEach(checkAuthMiddleware);


export default router;
