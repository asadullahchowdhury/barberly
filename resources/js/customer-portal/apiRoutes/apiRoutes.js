const apiVersion = '/api/customer/';

const apiRoutes = {

    // Authentication
    CheckAccount: apiVersion + 'auth/check/account',

    Login: apiVersion + 'auth/login',

    LoginFacebook: apiVersion + 'auth/login/facebook',

    Register: apiVersion + 'auth/register',

    ForgotRequest: apiVersion + 'auth/forgot/request',

    ResetPassword: apiVersion + 'auth/reset/password',

    GetAccount: apiVersion + 'auth/get/account',

    CustomerLogout: apiVersion + 'profile/logout',

    ProfileDetails: apiVersion + 'profile/me',

    UpdateProfile: apiVersion + 'profile/update',

    ChangePassword: apiVersion + 'profile/change/password',

    Marketplace: apiVersion + 'marketplace',

    Media: apiVersion + 'media/upload'

}
export default apiRoutes;
