<template>
    <div class="success-overview">
        <div class="wrapper">
            <div class="success-icon margin-bottom-40">
                <img :src="`/images/authentication/check.svg`" alt="check success">
            </div>
            <div class="title margin-bottom-40">Welcome to Barber</div>

            <!--success card start -->
            <div class="card success-card margin-bottom-40">
                <div class="card-header padding-20">
                    <div class="card-title font-weight-600 font-size-20">What can you do with a Barbarly workspace</div>
                </div>
                <div class="card-body padding-x-20 padding-bottom-20">
                    <ul class="workspace-list">
                        <li>
                            <img class="margin-right-15" :src="`/images/portal/calendar-theme.svg`" alt="calendar">
                            <div>
                                You can now receive notifications and access the calendar to view your appointments.
                            </div>
                        </li>
                        <li>
                            <img class="margin-right-15" :src="`/images/portal/card.svg`" alt="card">
                            <div>
                                Receive and track commissions, tips, and payments from this team.
                            </div>
                        </li>
                        <li>
                            <img class="margin-right-15" :src="`/images/portal/star-theme.svg`" alt="star">
                            <div>
                                Collect reviews for the services you perform there.
                            </div>
                        </li>
                    </ul>


                    <p class="text-lighter margin-top-20">Barber controls what you have access to within their
                        workspace.</p>
                </div>
            </div>
            <!--success card end   -->

            <a href="javascript:void(0)" class="btn btn-theme btn-anchor">Get Started</a>

        </div>
    </div>
</template>

<script>
export default {
    setup() {
        return {}
    }
}
</script>

<style lang="scss" scoped>

</style>
