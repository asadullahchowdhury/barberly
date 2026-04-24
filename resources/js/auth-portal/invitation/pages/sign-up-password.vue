<template>
    <div class="accept-invitation padding-50">

        <!--back btn-->
        <router-link :to="{name:'SignUpReview'}" class="btn-icon fixed-btn">
            <img :src="`/images/global/arrow-left.svg`" alt="back">
        </router-link>
        <!--back btn-->

        <div class="form-center">
            <div class="icon-box">
                <img :src="`/images/portal/workshop.svg`" alt="workshop" class="w-24 h-24">
            </div>
        </div>

        <div class="form-center">
            <div class="title text-dark padding-1 margin-top-10">Join Unnamed...</div>

            <p class="padding-md-x-30 text-center margin-top-15 margin-bottom-50 margin-md-x-20">
                To create a Barberly account, please enter a password for
                <br>
                <strong>sasda@mailinator.com</strong>
            </p>

            <form>
                <div class="form-group padding-bottom-23">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input id="password" :type="passwordFieldType" name="password" v-model="formData.password"
                               placeholder="Enter a password" class="form-control padding-left-20"
                               autocomplete="new-password">

                        <a href="javascript:void(0)" class="password-icon" @click="passwordVisibility">
                                    <span v-if="passwordFieldType === 'text'">
                                        <img :src="'/images/authentication/eye.svg'" alt="eye">
                                    </span>
                            <span v-if="passwordFieldType === 'password'">
                                        <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                                    </span>
                        </a>

                        <div class="error-report"></div>
                    </div>
                </div>

                <div class="form-group padding-bottom-23">
                    <label for="password" class="form-label">Confirm Password</label>
                    <div class="position-relative">
                        <input id="password_confirmation" :type="passwordConfirmationFieldType"
                               name="password_confirmation"
                               v-model="formData.password_confirmation"
                               placeholder="Confirm Password" class="form-control padding-left-20"
                               autocomplete="new-password-confirmation">

                        <a href="javascript:void(0)" class="password-icon" @click="passwordConfirmVisibility">
                                    <span v-if="passwordConfirmationFieldType === 'text'">
                                        <img :src="'/images/authentication/eye.svg'" alt="eye">
                                    </span>
                            <span v-if="passwordConfirmationFieldType === 'password'">
                                        <img :src="'/images/authentication/eye-off.svg'" alt="eye">
                                    </span>
                        </a>

                        <div class="error-report"></div>
                    </div>
                </div>

                <div class="form-group padding-bottom-23">

                    <router-link :to="{name:'SuccessOverview'}" class="btn-theme">

                                    Create Account
                    </router-link>

<!--                    <button type="submit" class="btn-theme" v-if="!loading">
                                <span class="btn-text">
                                    Create Account
                                </span>
                    </button>

                    <button type="button" class="btn-theme btn-loading w-100" v-if="loading">
                        <span class="loading"></span>
                    </button>-->
                </div>
            </form>

        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                password: '',
                password_confirmation: '',
            },
            passwordFieldType: 'password',
            passwordConfirmationFieldType: 'password',
        }
    },
    methods: {
        /*password visibility*/
        passwordVisibility() {
            this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
        },

        passwordConfirmVisibility() {
            this.passwordConfirmationFieldType = this.passwordConfirmationFieldType === "password" ? "text" : "password";
        },

    }
}
</script>
