import {createRouter, createWebHistory} from "vue-router";


//=====================
// Pages
//=====================
import Layout from "../layout/layout.vue";
import InvitationLayout from "../invitation/layout/layout.vue"
import SuccessLayout from "../invitation/layout/success-layout.vue"
import Login from "../pages/login.vue";
import Password from "../pages/password.vue";
import Registration from "../pages/registration.vue";
import Verification_page from "../pages/verification-page.vue";
import Verification_code from "../pages/verification-code.vue";
import Email_verification from "../pages/email-verification.vue";
import Change_password from "../pages/change-password.vue";
import Forget_password from "../pages/forget-password.vue";
import AcceptInvitation from "../invitation/pages/accept-invitation.vue"
import AcceptWorkspaceError from "../invitation/pages/active-workspace-error.vue"
import SignUpReview from "../invitation/pages/sign-up-review.vue";
import SignUpPassword from "../invitation/pages/sign-up-password.vue";
import SuccessOverview from "../invitation/pages/success-overview.vue";
import AccountSetupLayout from "../account-setup/layout/layout.vue";
import AccountSetup from "../account-setup/account-setup.vue";
import Service from "../account-setup/service.vue";
import TeamSize from "../account-setup/team.vue";
import BusinessLocation from "../account-setup/business-location.vue";


const TITLE = window.core.APP_NAME
const ROOT_URL = "/portal/auth";
const routes = [

    /*auth layout*/
    {
        path: ROOT_URL, name: 'Layout', component: Layout,
        children: [
            {path: 'sign-in', name: 'Sign-In', component: Login, meta: {title: TITLE+'Sign-In'}},
            {path: 'sign-in/password', name: 'Password', component: Password, meta: {title: TITLE+'Password'}},
            {path: 'registration', name: 'Registration', component: Registration, meta: {title: TITLE+'Registration'}},
            // {path: '/verification-page', name: 'Verification-page', component: Verification_page, meta: {title: TITLE+'var_page'}},
            {path: 'verification-code', name: 'Verification-code', component: Verification_code, meta: {title: TITLE+'Verification code'}},
            {path: 'email-verification', name: 'Email_verification', component: Email_verification, meta: {title: TITLE+'Email verification'}},
            {path: 'change/password/:token', name: 'Change-password', component: Change_password, meta: {title: TITLE+'Change password'}},
            {path: 'forget/password', name: 'Forget_password', component: Forget_password, meta: {title: TITLE+'Forget password'}},
        ]
    },

    // Account setup
    {
        path: ROOT_URL , name:  'Account-Setup-Layout', component: AccountSetupLayout,
        children: [
            {path: 'account/setup', name: 'AccountSetup', component: AccountSetup, meta: {title: TITLE + 'Account Setup'}},
            {path: 'account/setup/service', name: 'Service', component: Service, meta: {title: TITLE + 'Service'}},
            {path: 'account/setup/team-size', name: 'TeamSize', component:TeamSize , meta: {title: TITLE + 'Team Size'}},
            {path: 'account/setup/business-location', name: 'BusinessLocation', component: BusinessLocation, meta: {title: TITLE + 'Business Location'}},
        ]
    },

     /*invitation layout*/
    {
        path: ROOT_URL, name: 'InvitationLayout',component: InvitationLayout,
        children: [
            {path: 'accept-invitation' ,name: 'AcceptInvitation',component:AcceptInvitation ,meta: {title: 'Accept invitation'}},
            {path: 'accept-invitation/sign-up/review' ,name: 'SignUpReview',component:SignUpReview ,meta: {title: 'Signup review'}},
            {path: 'accept-invitation/sign-up/password' ,name: 'SignUpPassword',component:SignUpPassword ,meta: {title: 'Signup Password'}}
        ]
    },

    /*success layout*/
    {
        path: ROOT_URL, name: 'SuccessLayout',component: SuccessLayout,
        children: [
            {path: 'success-overview' ,name: 'SuccessOverview',component:SuccessOverview ,meta: {title: 'Success overview'}},
            {path: 'accept-invitation/active-workspace-error' ,name: 'AcceptWorkspaceError',component:AcceptWorkspaceError ,meta: {title: 'Accept workspace error'}}
        ]
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
})




export default router;
