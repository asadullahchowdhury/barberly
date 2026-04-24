<template>
    <div class="accept-invitation padding-50">

        <div class="form-center">
            <div class="icon-box">
                <img :src="`/images/portal/workshop.svg`" alt="workshop" class="w-24 h-24">
            </div>
        </div>

        <div class="form-center">
            <div class="title text-dark padding-1 margin-top-10">Join Unnamed...</div>

            <p class="padding-md-x-30 text-center margin-top-15 margin-bottom-50 margin-md-x-20"
               v-if="invitationStep === 1">
                You’re almost there sdasdas! Would you like to use
                <strong>sasda@mailinator.com</strong>
                or
                <a href="javascript:void(0)" class="underline-anim text-theme">use another account?</a>
            </p>

            <button type="button" class="btn btn-theme btn-anchor h-45" v-if="invitationStep === 1"
                    @click="invitationStep = 2">
                Accept Invite
            </button>
        </div>


        <div class="form-center" v-if="invitationStep === 2">
            <p class="padding-md-x-30 text-center margin-top-15 padding-bottom-30">
                Create an account or log in to accept the invite.
            </p>

            <!-- social media buttons start-->
            <div class="form-section">
                <!-- google -->
                <div class="form-group padding-bottom-16">
                    <a href="javascript:void(0)" class="btn-white has-border disable-feature">Continue with Google</a>
                    <div class="icon-media">
                        <img class="disable-feature" :src="'/images/authentication/google.png'" alt="google">
                    </div>
                </div>
                <!-- apple -->
                <div class="form-group padding-bottom-16">
                    <a href="javascript:void(0)" class="btn-white has-border disable-feature">Continue with Apple</a>
                    <div class="icon-media">
                        <img class="disable-feature" :src="'/images/authentication/apple.png'" alt="apple">
                    </div>
                </div>
                <!-- facebook -->
                <div class="form-group padding-bottom-16">
                    <a href="javascript:void(0)" class="btn-white disable-feature has-border">Continue with Facebook</a>
                    <div class="icon-media">
                        <img :src="'/images/authentication/facebook.png'" alt="facebook">
                    </div>
                </div>
            </div>
            <!-- social media buttons end  -->

            <div class="auth-hr margin-top-10">
                <div class="hr"></div>
                <div class="or-text">OR</div>
                <div class="hr"></div>
            </div>


            <form action="">

                <div class="form-group padding-y-16">
                    <input type="text" class="form-control" placeholder="Enter Email" name="email"
                           v-model="formData.email">
                    <div class="error-report"></div>
                </div>

                <div class="form-group padding-bottom-30">
                    <router-link :to="{name:'SignUpReview'}" href="javascript:void(0)" class="btn btn-theme btn-anchor">
                        Continue
                    </router-link>
                </div>

            </form>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            invitationStep: 1,
            formData: {
                email: '',
            }
        }
    }
}
</script>
