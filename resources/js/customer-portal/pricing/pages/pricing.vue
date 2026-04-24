<template>

    <div class="pricing">

        <div class="padding-top-110"></div>
        <!-- hero content -->
        <div class="container">
            <div class="py-5">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4 text-center text-lg-start" data-aos="fade-right">
                        <div class="mb-3 fs-3 fw-bold text-theme">Pricing</div>
                        <div class="mb-3 fs-3 fw-semibold">
                            The only free software for beauty and wellness professionals
                        </div>
                        <div class="mb-4 lead fw-medium">
                            Join the world's top beauty and wellness platform, it's totally subscription-free! Stop
                            paying expensive fees and be part of the revolution.
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-theme">
                                Sign up for free
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8 mt-4 mt-xl-0" data-aos="fade-left">
                        <img :src="`/images/home/pricing-heroDesktop.webp`" class="img-fluid w-100"
                             alt="pricing desktop image">
                    </div>
                </div>
            </div>
        </div>

        <!-- free for all -->
        <div class="w-100 py-5" data-aos="fade-down">
            <div class="container">
                <div class="fs-1 text-center fw-bold">Free for all, <span class="text-theme"> no monthly fee </span>
                </div>
                <div class="small text-center"><span class="fw-bold"> Unlimited usage with no subscription fees! </span>
                    The only free platform for salons and spas.
                </div>
                <div class="mt-3">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2">
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="100">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited appointment bookings</div>
                                <div class="">Super easy to use across mobiles, tablets and desktops</div>
                            </div>
                        </div>
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="200">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited clients and email notifications</div>
                                <div class="">Track client history, keep notes and stay in contact with integrated
                                    email
                                </div>
                            </div>
                        </div>
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="300">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited team members</div>
                                <div class="">Invite your team to join your account and stay up-to-date with appointment
                                    notifications
                                </div>
                            </div>
                        </div>
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="400">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited product inventory</div>
                                <div class="">Record and track stock inventory with support for supplier ordering</div>
                            </div>
                        </div>
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="500">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited locations</div>
                                <div class="">Manage multiple venues from one main account with no limitations</div>
                            </div>
                        </div>
                        <div class="p-3 d-flex align-items-center" data-aos="fade-down" data-aos-duration="1000"
                             data-aos-delay="600">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-35 h-35" alt="check">
                            <div class="ms-2">
                                <div class="fw-bold">Unlimited reporting and much more</div>
                                <div class="">Everything you need to manage your business in one easy-to-use solution
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pick a business type -->
        <div class="w-100 py-5 pick-a-business-type" data-aos="fade-down">
            <div class="container">
                <div class="fs-2 fw-bold text-center mb-5">
                    Pick a business type to get started for free
                </div>
                <div class="d-flex justify-content-center justify-content-lg-start align-items-center flex-wrap gap-3">
                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="50">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/hair-style.svg`" class="w-35 h-35"
                                 alt="service 1">
                            <div class="mt-2"> Hair Salon</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/nail-salon.svg`" class="w-35 h-35"
                                 alt="service 2">
                            <div class="mt-2"> Nail Salon</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="150">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/waxing-salon.svg`" class="w-35 h-35"
                                 alt="service 3">
                            <div class="mt-2"> Waxing Salon</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/beauty-salon.svg`" class="w-35 h-35"
                                 alt="service 4">
                            <div class="mt-2"> Beauty Salon</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="250">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/barber-shop.svg`" class="w-35 h-35"
                                 alt="service 5">
                            <div class="mt-2"> Barbershop</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/eyebrow-lashes.svg`" class="w-35 h-35"
                                 alt="service 6">
                            <div class="mt-2"> Eyebrows & Lashes</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="350">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/message.svg`" class="w-35 h-35"
                                 alt="service 7">
                            <div class="mt-2"> Massage</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/spa.svg`" class="w-35 h-35" alt="service 8">
                            <div class="mt-2"> Spa</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="450">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/gym-fitness.svg`" class="w-35 h-35"
                                 alt="service 9">
                            <div class="mt-2"> Gym & Fitness</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/personal-trainer.svg`" class="w-35 h-35"
                                 alt="service 10">
                            <div class="mt-2"> Personal Trainer</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="550">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/theraphy.svg`" class="w-35 h-35"
                                 alt="service 11">
                            <div class="mt-2"> Therapy Center</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="600">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/tattoo-piercing.svg`" class="w-35 h-35"
                                 alt="service 12">
                            <div class="mt-2"> Tattoo & Piercing</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="650">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/training-studio.svg`" class="w-35 h-35"
                                 alt="service 13">
                            <div class="mt-2"> Tanning Studio</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="700">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/aesthetics.svg`" class="w-35 h-35"
                                 alt="service 14">
                            <div class="mt-2"> Aesthetics</div>
                        </a>
                    </div>

                    <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="750">
                        <a href="javascript:void(0)"
                           class="text-dark text-decoration-none w-140 h-140 rounded-4 d-flex justify-content-center align-items-center flex-column text-center bg-white box-hover p-2">
                            <img :src="`/images/for-business/service-icon/weight-loss.svg`" class="w-35 h-35"
                                 alt="service 15">
                            <div class="mt-2"> Weight Loss</div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Download the app -->
        <section class="w-100 py-5 bg-white" data-aos="fade-down">
            <div class="container">
                <div class="fs-2 fw-bold text-center mb-3">
                    Download the app
                </div>
                <div class="text-center mb-3 fs-6">
                    Manage your appointments with Barberly's top-rated app
                </div>
                <div class="d-block d-xl-flex justify-content-start">

                    <!-- business app for customer -->
                    <div class="w-100 p-3 text-center text-md-start" data-aos="fade-right">
                        <div class="bg-theme rounded-4 rounded-md-5">
                            <div class="row align-items-center align-items-md-end">
                                <div class="col-md-6 d-flex justify-content-center pt-3 order-1 order-md-0">
                                    <img :src="`/images/for-business/download-app-for-customers-desktop.webp`"
                                         class="img-fluid" alt="download app for business desktop">
                                </div>
                                <div class="col-md-6 p-5 py-md-5 ps-md-3 pe-md-5 order-0 order-md-1">
                                    <div class="mb-3 text-white fw-bold fs-4">Barberly</div>
                                    <div class="text-white fw-bold fs-4 mb-3">Business app for customers</div>
                                    <div class="mb-4 text-white fw-medium">
                                        Instantly book salons and spas near you
                                    </div>
                                    <div
                                        class="d-flex justify-content-center justify-content-md-start align-items-center flex-wrap">
                                        <div class="col-7 col-md-5 mb-4 me-0 me-md-2">
                                            <a href="javascript:void(0)" class="btn-opacity-effect">
                                                <img :src="`/images/for-business/google-play-dark.svg`"
                                                     class="w-100 img-fluid" alt="google play">
                                            </a>
                                        </div>
                                        <div class="col-7 col-md-5 mb-4">
                                            <a href="javascript:void(0)" class="btn-opacity-effect">
                                                <img :src="`/images/for-business/app-store-dark.svg`"
                                                     class="w-100 img-fluid" alt="app store">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- business app for professional -->
                    <div class="w-100 p-3 text-center text-md-start" data-aos="fade-left">
                        <div class="bg-dark rounded-4 rounded-md-5">
                            <div class="row align-items-center align-items-md-end">
                                <div class="col-md-6 p-5 py-md-5 ps-md-5 pe-md-3">
                                    <div class="mb-3 text-white fw-bold fs-4">Barberly</div>
                                    <div class="text-white fw-bold fs-4 mb-3">Business app for professionals</div>
                                    <div class="mb-4 text-white fw-medium">
                                        Simple, flexible and powerful software for your business
                                    </div>
                                    <div
                                        class="d-flex justify-content-center justify-content-md-start align-items-center flex-wrap">
                                        <div class="col-7 col-md-5 mb-4 me-0 me-md-2">
                                            <a href="javascript:void(0)" class="btn-opacity-effect">
                                                <img :src="`/images/for-business/google-play.svg`"
                                                     class="w-100 img-fluid" alt="google play">
                                            </a>
                                        </div>
                                        <div class="col-7 col-md-5 mb-4">
                                            <a href="javascript:void(0)" class="btn-opacity-effect">
                                                <img :src="`/images/for-business/app-store.svg`" class="w-100 img-fluid"
                                                     alt="app store">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center pt-3">
                                    <img :src="`/images/for-business/download-app-for-business-desktop.webp`"
                                         class="img-fluid" alt="download app for business desktop">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="text-center mt-4" data-aos="fade-down">
                    <a href="javascript:void(0)" class="btn btn-theme px-4">
                        Download App
                    </a>
                </div>
            </div>
        </section>

    </div>

</template>

<script>

import 'aos/dist/aos';

export default {

    data() {
        return {}
    },

    mounted() {
    },

    methods: {}

}

</script>
