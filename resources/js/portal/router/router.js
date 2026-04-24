import {createRouter, createWebHistory} from "vue-router";


//=====================
// Pages
//=====================
import Layout from "../pages/layout/layout.vue";
import Dashboard from "../pages/dashboard/dashboard.vue";
import Calendar from "../pages/calendar/calendar.vue";
import Sales from "../pages/sales/sales.vue";

import CustomerLayout from "../pages/customer/layout/layout.vue";
import Customer from "../pages/customer/pages/list.vue";
import CustomerManage from "../pages/customer/pages/manage.vue";
import CustomerReview from "../pages/customer/pages/review.vue";
import CustomerAutoMatedMessage from "../pages/customer/pages/automated-message.vue";
import CustomerForm from "../pages/customer/pages/forms.vue";
import CustomerOverview from "../pages/customer/pages/overview.vue";
import CustomerNotification from "../pages/customer/pages/notification.vue";
// import file csv
import ImportLayout from "../pages/customer/import-customer/layout/layout.vue";
import ImportCustomerData from "../pages/customer/import-customer/import-customer-data.vue";
import ImportCustomerReviewColumn from "../pages/customer/import-customer/import-review-column.vue";
import ImportComplete from "../pages/customer/import-customer/import-complete.vue";
// config messages
import ConfigMessageLayout from "../pages/customer/configuration-rules/layout/layout.vue";
import ConfigTigger from "../pages/customer/configuration-rules/config-tigger.vue";
import ConfigChannel from "../pages/customer/configuration-rules/config-select-channel.vue";
import ConfigDone from "../pages/customer/configuration-rules/config-done.vue";

import ProfileLayout from "../pages/profile/layout/layout.vue";
import Profile from "../pages/profile/details/profile.vue";
import Review from "../pages/profile/review/review.vue";
import Settings from "../pages/profile/settings/settings.vue";
import Workspaces from "../pages/profile/workspaces/workspaces.vue";
import Notification from "../pages/profile/workspaces/notification/notification.vue";
import workspaceSettings from "../pages/profile/workspaces/workspace-settings.vue";
import CalendarLayout from "../pages/profile/workspaces/calender/layout/layout.vue";
import CalenderChoose from "../pages/profile/workspaces/calender/calender-choose.vue";
import CalenderSync from "../pages/profile/workspaces/calender/calender-sync.vue";
import CalenderExportType from "../pages/profile/workspaces/calender/calender-export-type.vue";

import CatalogueLayout from "../pages/catalogue/layout/layout.vue";
import CatalogueManageLayout from "../pages/catalogue/layout/manage-layout.vue";
import Services from "../pages/catalogue/pages/services/services.vue"
import ServiceType from "../pages/catalogue/pages/service-type/service-type.vue";
import ServiceCreate from "../pages/catalogue/pages/service-manage/service-manage.vue";
import Memberships from "../pages/catalogue/pages/memberships/memberships.vue";
import MembershipManage from "../pages/catalogue/pages/memberships-manage/manage-memberships.vue";

import SetupSettings from "../pages/settings/dashboard/setup-settings.vue";

import Account from "../pages/settings/account/account.vue";

import Employees from "../pages/settings/teams/employees.vue";
import EmployeeAdd from "../pages/settings/teams/manage.vue";
import WorkingHours from "../pages/settings/working-hours/working-hours.vue";
import BusinessClosePeriod from "../pages/settings/working-hours/business-close-period.vue";
import SetRegularShift from "../pages/settings/working-hours/setRegularShift.vue";

import ReportGroup from "../pages/report/report.vue";
import ReportDetails from "../pages/report/details.vue";

// Marketplace
import MarketPlaceLayout from "../pages/online-booking/layout/main-layout.vue";
import MarketPlaceProfile from "../pages/online-booking/pages/marketPlaceProfile.vue";

// Online booking
import onlineBookingLayout from "../pages/online-booking/layout/layout.vue";
import onlineBookingLocationDetails from "../pages/online-booking/pages/location-details.vue";
import onlineBookingLocationAddress from "../pages/online-booking/pages/location-address.vue";
import onlineBookingLocationWorkingHours from "../pages/online-booking/pages/location-working-hours.vue";
import onlineBookingLocationPhoto from "../pages/online-booking/pages/location-photos.vue";
import OnlineBookingDone from "../pages/online-booking/pages/done.vue";

// Engage
import EngageLayout from "../pages/engage/layout/layout.vue"
import EngageManageLayout from "../pages/engage/layout/manageLayout.vue"
import Deals from "../pages/engage/pages/deals.vue";
import DealSingle from "../pages/engage/pages/deal-single.vue";
import DealType from "../pages/engage/pages/deal-type.vue";
import DealManage from "../pages/engage/pages/deal-manage.vue";
import SelectTeam from "../pages/engage/pages/select-team.vue";
import PromotionApply from "../pages/engage/pages/promotion-apply.vue";
import DealCompleted from "../pages/engage/pages/completed.vue";

import Resources from "../pages/settings/resources/resources.vue";

const TITLE = window.core.APP_NAME
const ROOT_URL = "/portal";

const routes = [

    // Portal Layout
    {
        path: ROOT_URL, name: 'Layout', component: Layout,
        children: [
            {path: '', name: 'Dashboard', component: Dashboard, meta: {title: TITLE + 'Dashboard'}},
            {path: ROOT_URL + '/calendar', name: 'Calendar', component: Calendar, meta: {title: TITLE + 'Calendar'}},
            {path: ROOT_URL + '/sales', name: 'Sales', component: Sales, meta: {title:  TITLE+'Sales'}},
            {path: ROOT_URL +'/customer/', name:'CustomerLayout' ,component: CustomerLayout,
                children: [
                    {path:'list', name: 'Customer', component: Customer, meta: {title: TITLE + 'Customer'}},
                    {path:'review', name: 'CustomerReview', component: CustomerReview, meta: {title: TITLE + 'Customer review'}},
                    {path:'automated-message', name: 'CustomerAutoMatedMessage', component: CustomerAutoMatedMessage, meta: {title: TITLE + 'Customer AutoMated Message'}},
                    {path:'form', name: 'CustomerForm', component: CustomerForm, meta: {title: TITLE + 'Customer Form'}},
                    {path:'overview', name: 'CustomerOverview', component: CustomerOverview, meta: {title: TITLE + 'Customer Overview'}},
                    {path:'notification', name: 'CustomerNotification', component: CustomerNotification, meta: {title: TITLE + 'Customer Notification'}},
                ]
            },

            // Report
            {path: ROOT_URL + '/report-group', name: 'ReportGroup', component: ReportGroup, meta: {title: TITLE + 'Report Group'}},
            {path: ROOT_URL + '/report-details', name: 'ReportDetails', component: ReportDetails, meta: {title: TITLE + 'Report Details'}},

            // Profile layout
            {path: ROOT_URL , component: ProfileLayout,
                children: [
                    {path: ROOT_URL + '/profile', name: 'Profile', component: Profile, meta: {title: TITLE + 'Profile'} },
                    {path: ROOT_URL + '/reviews', name: 'Reviews', component: Review, meta: {title: TITLE + 'Review'} },
                    {path: ROOT_URL + '/settings', name: 'Settings', component: Settings, meta: {title: TITLE + 'Settings'} },
                    {path: ROOT_URL + '/workspaces', name: 'Workspaces', component: Workspaces, meta: {title: TITLE + 'Workspaces'} },
                    {path: ROOT_URL + '/workspace-settings', name: 'WorkspaceSettings', component: workspaceSettings, meta: {title: TITLE + 'Workspaces Settings'} },
                ]
            },

        //  Catalogue Layout

            {path: ROOT_URL + '/catalogue/',component:CatalogueLayout , name:'CatalogueLayout',
                children: [
                    {path: 'services' , name: 'Services', component: Services, meta: {title: TITLE + 'Services'} },
                    {path: 'memberships' , name: 'Memberships', component: Memberships, meta: {title: TITLE + 'Memberships'} },
                ]
            },

        //   Setting
            {path: ROOT_URL + '/setup',
                children: [
                    {path: '', name: 'SetupSettings', component: SetupSettings, meta: {title: TITLE+ 'Setup Settings'}},
                    {path: 'account', name: 'Account', component: Account, meta: {title: TITLE+ 'Account'}},
                    {path: 'employees', name: 'Employees', component: Employees, meta: {title: TITLE+ 'employees'}},
                    {path: 'working-hour', name: 'workingHour', component: WorkingHours, meta: {title: TITLE+ 'working hour'}},
                    {path: 'working-hour/business-close-period', name: 'BusinessClosePeriod', component: BusinessClosePeriod, meta: {title: TITLE+ 'Business Close Period'}},
                    {path: 'resources', name: 'Resources', component: Resources, meta: {title: TITLE+ 'Resources'}},
                ]
            },

            // online booking
            {path: ROOT_URL + '/online-booking', name:'OnlineBooking', component: MarketPlaceLayout,
                children: [
                    {path: '', name: 'MarketPlaceProfile', component: MarketPlaceProfile, meta: {title: TITLE+ 'Market Place Profile'}},
                ]
            },

            //     Engage
            {path:  ROOT_URL + '/deals' ,name: 'EngageLayout' ,component: EngageLayout ,
                children: [
                    {path: '', name: 'Deals', component: Deals,meta:{title: TITLE + 'Deals'} },
                    {path: ':id', name: 'DealSingle', component: DealSingle,meta:{title: TITLE + 'Deal'} }
                ]}
        ],
    },

    // set regular shift layout
    {path: ROOT_URL + '/working-hour/set-regular-shift', name: 'SetRegularShift', component: SetRegularShift, meta: {title: TITLE+ 'Set Regular Shift'}},

    // Employee Add Layout
    {path: ROOT_URL + '/employee/create', name: 'EmployeeCreate', component: EmployeeAdd, meta: {title: TITLE + 'Employee Create'}},
    {path: ROOT_URL + '/employee/edit/:id', name: 'EmployeeUpdate', component: EmployeeAdd, meta: {title: TITLE + 'Employee Update'}},

    // Customer Manage Layout
    {path: ROOT_URL + '/customer/:id', name: 'CustomerManage', component: CustomerManage, meta: {title: TITLE + 'Customer Manage'}},


    // Catalogue manage layout
    { component: CatalogueManageLayout,
    children: [
        {path: ROOT_URL + '/catalogue/service-type', name:'ServiceType', component:ServiceType, meta: {title: TITLE + 'Service Type'} },
        {path: ROOT_URL + '/catalogue/service/create', name:'ServiceCreate', component:ServiceCreate, meta: {title: TITLE + 'Service Create'} },
        {path: ROOT_URL + '/catalogue/service/edit/:id', name:'ServiceUpdate', component:ServiceCreate, meta: {title: TITLE + 'Service Update'} },
        {path: ROOT_URL + '/catalogue/membership/create', name: 'MembershipCreate', component: MembershipManage, meta: {title: TITLE + 'Membership Create'}},
        {path: ROOT_URL + '/catalogue/membership/edit/:id', name: 'MembershipUpdate', component: MembershipManage, meta: {title: TITLE + 'Membership Update'}},
    ]},

    // Sync Calendar Layout
    {
        path: ROOT_URL +'/sync-calendar/', name: 'CalendarLayout', component: CalendarLayout,
        children: [
            {path: 'choose', name: 'CalendarChoose', component: CalenderChoose, meta: {title: TITLE + 'Calendar Choose'}},
            {path: 'sync', name: 'CalendarSync', component: CalenderSync, meta: {title: TITLE + 'Calender Sync'}},
            {path: 'export-type', name: 'CalendarExportType', component: CalenderExportType, meta: {title: TITLE + 'Calender Export Type'}},
        ]
    },

    // Sync Notification Layout
    {path: ROOT_URL+'/manage-notification' , name: 'Notification', component: Notification, meta: {title: TITLE + 'Notification'}},

    // Import file Layout
    {
        path: ROOT_URL + '/customer/import/', name: 'ImportLayout', component: ImportLayout,
        children: [
            {path: 'import-customer-data-file', name: 'ImportCustomerData', component: ImportCustomerData, meta: {title: TITLE + 'Import Customer Data'}},
            {path: 'import-customer-review-column', name: 'ImportCustomerReviewColumn', component: ImportCustomerReviewColumn, meta: {title: TITLE + 'Import Customer Review Column'}},
            {path: 'import-customer-preview', name: 'ImportComplete', component: ImportComplete, meta: {title: TITLE + 'Import Complete'}},
        ]
    },

    // config message
    {
        path: ROOT_URL + '/customer/configuration/', name: 'ConfigMessageLayout', component: ConfigMessageLayout,
        children: [
            {path:  'rules', name: 'ConfigTigger', component: ConfigTigger, meta: {title: TITLE + 'Config Tigger'}},
            {path:  'channels', name: 'ConfigChannel', component: ConfigChannel, meta: {title: TITLE + 'Config Channel'}},
            {path:  'done', name: 'ConfigDone', component: ConfigDone, meta: {title: TITLE + 'Config Done'}},
        ]
    },

    // online booking layout
    {
        path: ROOT_URL + '/online-booking', name: 'OnlineBookingLayout', component: onlineBookingLayout,
        children: [
            {path: 'location-details', name: 'OnlineBookingLocationDetails', component: onlineBookingLocationDetails, meta: {title: TITLE + 'Online Booking Location Details'}},
            {path: 'location-address', name: 'OnlineBookingLocationAddress', component: onlineBookingLocationAddress, meta: {title: TITLE + 'Online Booking Address'}},
            {path: 'location-working-hours', name: 'OnlineBookingWorkingHours', component: onlineBookingLocationWorkingHours, meta: {title: TITLE + 'Online Booking Working'}},
            {path: 'location-photo', name: 'OnlineBookingLocationPhoto', component: onlineBookingLocationPhoto, meta: {title: TITLE + 'Online Booking Photo'}},
            {path: 'done', name: 'OnlineBookingDone', component: OnlineBookingDone, meta: {title: TITLE + 'Online Booking Done'}},
        ]
    },


//Deal manage layout
    {
        path: ROOT_URL , name: 'EngageManageLayout', component: EngageManageLayout,
        children: [
            {path: 'deals/type', name: 'DealType', component: DealType, meta: {title: TITLE + 'Deal Type'}},
            {path: 'deals/:id/:name', name: 'NewDeal', component: DealManage, meta: {title: TITLE + 'New Deal'}},
            {path: 'deals/:id/:name', name: 'EditDeal', component: DealManage, meta: {title: TITLE + 'Edit Deal'}},
            {path: 'deals/:id/:name/select-team', name: 'SelectTeam', component: SelectTeam, meta: {title: TITLE + 'Select team'}},
            {path: 'deals/:id/:name/apply', name: 'PromotionApply', component: PromotionApply, meta: {title: TITLE + 'Promotion apply'}},
            {path: 'deals/:id/:name/completed', name: 'DealCompleted', component: DealCompleted, meta: {title: TITLE + 'Completed'}},
        ]
    }


];

const router = createRouter({
    history: createWebHistory(),
    routes
})


export default router;
