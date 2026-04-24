const apiVersion = '/api/';

const apiRoutes = {

    // Authentication
    CheckAccount: apiVersion + 'auth/check/account',

    Login: apiVersion + 'auth/login',

    LoginFacebook: apiVersion + 'auth/login/facebook',

    Register: apiVersion + 'auth/register',

    CustomerRegister: apiVersion + 'customer/auth/register',

    CustomerLogin: apiVersion + 'customer/auth/login',

    getCountries: apiVersion + 'countries',

    VerifyCode: apiVersion + 'auth/verify/account',

    ResendCode: apiVersion + 'auth/resend/code',

    ForgotRequest: apiVersion + 'auth/forgot/request',

    ResetPassword: apiVersion + 'auth/reset/password',

    GetAccount: apiVersion + 'auth/get/account',

    // Setup account

    SetupAccount: apiVersion + 'portal/setup/account',

    // Profile

    Profile: apiVersion + 'profile/me',

    ProfileUpdate: apiVersion + 'profile/update',

    UpdatePassword: apiVersion + 'profile/change/password',

    Logout: apiVersion + 'profile/logout',


    // Dashboard
    Dashboard: apiVersion + 'portal/dashboard',

    // Services

    Services: apiVersion + 'portal/services',

    // Customer

    CustomerList: apiVersion + 'portal/customers',

    CustomerCreate: apiVersion + 'portal/customers',

    CustomerUpdate: apiVersion + 'portal/customers/update',

    CustomerSingle: apiVersion + 'portal/customers',

    CustomerDelete: apiVersion + 'portal/customers',

    // Categories

    CategoriesList: apiVersion + 'portal/categories',

    CategoriesCreate: apiVersion + 'portal/categories',

    CategoriesUpdate: apiVersion + 'portal/categories/update',

    CategoriesSingle: apiVersion + 'portal/categories',

    CategoriesDelete: apiVersion + 'portal/categories',

    CategoriesSortUpdate: apiVersion + 'portal/categories/sort',

    CategoriesServiceSortUpdate: apiVersion + 'portal/categories/services/sort',

    // Service List

    ServiceList: apiVersion + 'portal/categories/services',

    ServiceCreate: apiVersion + 'portal/categories/services',

    ServiceUpdate: apiVersion + 'portal/categories/services/update',

    ServiceSingle: apiVersion + 'portal/categories/services',

    ServiceDelete: apiVersion + 'portal/categories/services',

    ServiceSortUpdate: apiVersion + 'portal/categories/sort',

    // Team Member or called employee

    TeamMembers: apiVersion + 'portal/team',

    TeamMemberUpdate: apiVersion + 'portal/team/update',

    TeamMemberSingle: apiVersion + 'portal/team/single',

    TeamMemberDelete: apiVersion + 'portal/team/delete',

    TeamMemberSortUpdate: apiVersion + 'portal/team/sort',

    TeamMemberStatusUpdate: apiVersion + 'portal/team/status',

    //Media

    Media: apiVersion + 'portal/media/upload',

    // Booking
    Booking: apiVersion + 'portal/booking',
    BookingSingle: apiVersion + 'portal/booking/single',
    BookingStatus: apiVersion + 'portal/booking/status',
    BookingCustomerAdd: apiVersion + 'portal/booking/add/customer',
    BookingCustomerRemove: apiVersion + 'portal/booking/remove/customer',
    BookingServiceRemove: apiVersion + 'portal/booking/remove/service',
    BookingServiceAdd: apiVersion + 'portal/booking/add/service',
    BookingCancel: apiVersion + 'portal/booking/cancel',


    // Marketplace
    Marketplace: apiVersion + 'portal/market-place',
    MarketplacePhoto: apiVersion + 'portal/market-place/photo',

    //Company
    Company: apiVersion + 'portal/company',
    // resources
    Resource: apiVersion + 'portal/resources',

    // Deals
    Deals: apiVersion + 'portal/deals',
    ChangeDealStatus: apiVersion + 'portal/deals/change/status',
    DuplicateDeal: apiVersion + 'portal/deals/duplicate',
    RemoveServiceID: apiVersion + 'portal/deals/remove/:type/:id',

    // MemberShips
    MemberShip: apiVersion + 'portal/categories/memberships',

}

export default apiRoutes;
