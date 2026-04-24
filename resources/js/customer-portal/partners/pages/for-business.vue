<template>

    <div class="for-business">

        <div class="curve-content"></div>

        <!-- Hero content -->
        <div class="container position-relative z-3" data-aos="fade-down">
            <div class="pt-5 text-center text-white">
                <div class="h1 fw-bold">
                    The #1 Software for salons and spa
                </div>
                <div class="h5 fw-semibold">
                    Simple, flexible and powerful booking software for your business. And it's subscription-free!
                </div>
                <div class="mt-2 mt-md-4">
                    <button type="button" class="btn btn-theme px-4">
                        Join for free
                    </button>
                </div>
            </div>
            <div class="mt-3 mt-md-4">
                <img :src="`/images/for-business/for-business.webp`" class="img-fluid w-100 object-fit-cover" alt="for-business">
            </div>
        </div>

        <!-- Capture carousel -->
        <section class="w-100 py-5" data-aos="fade-down">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 py-3 py-md-5" data-aos="fade-right">
                        <div class="text-center">
                            <img :src="`/images/for-business/capterra.png`" class="img-fluid" alt="for-business">
                        </div>
                        <div class="mt-3 d-flex align-items-center justify-content-center">
                            <img :src="`/images/portal/star-golden.svg`" class="w-26 h-26 me-1" alt="golden-star">
                            <img :src="`/images/portal/star-golden.svg`" class="w-26 h-26 me-1" alt="golden-star">
                            <img :src="`/images/portal/star-golden.svg`" class="w-26 h-26 me-1" alt="golden-star">
                            <img :src="`/images/portal/star-golden.svg`" class="w-26 h-26 me-1" alt="golden-star">
                            <img :src="`/images/portal/star-golden.svg`" class="w-26 h-26" alt="golden-star">
                        </div>
                        <div class="mt-3 text-center h5 fw-bold">
                            5/5 on Capterra
                        </div>
                    </div>
                    <div class="col-md-9 capture-carousel" data-aos="fade-left">
                        <Splide :options="{ rewind: true }" class="p-3">
                            <SplideSlide class="w-100 py-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum dignissimos
                                earum, iusto minima obcaecati perspiciatis qui quis quisquam reiciendis, rem repudiandae
                                similique tempore velit veniam voluptatum! A aliquam atque aut consequuntur, dignissimos
                                earum exercitationem illum impedit laborum magnam nisi quasi similique suscipit tempore
                                voluptate. Accusamus alias aliquam aliquid, amet aperiam at autem cum ex expedita facere
                                fuga hic id impedit ipsum iusto magni minus mollitia nemo nulla obcaecati odio quas quisquam
                                quod quos ratione sequi sit soluta sunt tempore tenetur totam vel veniam vero voluptas
                                voluptatem voluptates voluptatibus. Ad aliquid, architecto at commodi, ipsa ipsum laboriosam
                                molestiae molestias neque placeat porro, praesentium quas quasi quia sed sunt veritatis
                                voluptas? Adipisci aliquam architecto commodi consequatur cumque deleniti dignissimos
                                dolorem eaque eos error esse est excepturi harum illum incidunt inventore ipsa ipsam itaque
                                iure laboriosam laborum modi nesciunt nihil, numquam odio omnis quae repellat repellendus
                                reprehenderit sint tempora unde vel.
                                <div class="mt-3 fw-bold text-secondary">
                                    Pamela B., Salon owner, NYC
                                </div>
                            </SplideSlide>
                            <splideSlide class="w-100 py-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum dignissimos
                                earum, iusto minima obcaecati perspiciatis qui quis quisquam reiciendis, rem repudiandae
                                similique tempore velit veniam voluptatum! A aliquam atque aut consequuntur, dignissimos
                                earum exercitationem illum impedit laborum magnam nisi quasi similique suscipit tempore
                                voluptate. Accusamus alias aliquam aliquid, amet aperiam at autem cum ex expedita facere
                                fuga hic id impedit ipsum iusto magni minus mollitia nemo nulla obcaecati odio quas quisquam
                                quod quos ratione sequi sit soluta sunt tempore tenetur totam vel veniam vero voluptas
                                voluptatem voluptates voluptatibus. Ad aliquid, architecto at commodi, ipsa ipsum laboriosam
                                molestiae molestias neque placeat porro, praesentium quas quasi quia sed sunt veritatis
                                voluptas? Adipisci aliquam architecto commodi consequatur cumque deleniti dignissimos
                                dolorem eaque eos error esse est excepturi harum illum incidunt inventore ipsa ipsam itaque
                                iure laboriosam laborum modi nesciunt nihil, numquam odio omnis quae repellat repellendus
                                reprehenderit sint tempora unde vel.
                                <div class="mt-3 fw-bold text-secondary">
                                    Pamela B., Salon owner, NYC
                                </div>
                            </splideSlide>
                            <splideSlide class="w-100 py-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at cum dignissimos
                                earum, iusto minima obcaecati perspiciatis qui quis quisquam reiciendis, rem repudiandae
                                similique tempore velit veniam voluptatum! A aliquam atque aut consequuntur, dignissimos
                                earum exercitationem illum impedit laborum magnam nisi quasi similique suscipit tempore
                                voluptate. Accusamus alias aliquam aliquid, amet aperiam at autem cum ex expedita facere
                                fuga hic id impedit ipsum iusto magni minus mollitia nemo nulla obcaecati odio quas quisquam
                                quod quos ratione sequi sit soluta sunt tempore tenetur totam vel veniam vero voluptas
                                voluptatem voluptates voluptatibus. Ad aliquid, architecto at commodi, ipsa ipsum laboriosam
                                molestiae molestias neque placeat porro, praesentium quas quasi quia sed sunt veritatis
                                voluptas? Adipisci aliquam architecto commodi consequatur cumque deleniti dignissimos
                                dolorem eaque eos error esse est excepturi harum illum incidunt inventore ipsa ipsam itaque
                                iure laboriosam laborum modi nesciunt nihil, numquam odio omnis quae repellat repellendus
                                reprehenderit sint tempora unde vel.
                                <div class="mt-3 fw-bold text-secondary">
                                    Pamela B., Salon owner, NYC
                                </div>
                            </splideSlide>
                        </Splide>
                    </div>
                </div>
            </div>
        </section>

        <!-- Count of business activities -->
        <section class="w-100 py-5" data-aos="fade-down">
            <div class="container">
                <div class="border-top">
                    <div class="row">
                        <div class="col-lg-5 px-3 py-3 py-lg-5">
                            <div class="h1 fw-bold">
                                The top-rated destination for beauty and wellness
                            </div>
                            <div class="mt-3">
                                One solution, one software. Trusted by the best in the beauty and wellness industry
                            </div>
                        </div>
                        <div class="col-lg-7 px-3 py-3 py-lg-5">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="h3 fw-bold">
                                        100,000+
                                    </div>
                                    partner businesses
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="h3 fw-bold">
                                        450,000+
                                    </div>
                                    stylists and professionals
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="h3 fw-bold">
                                        700 million+
                                    </div>
                                    appointments booked
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="h3 fw-bold">
                                        120+ countries
                                    </div>
                                    with Fresha available
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About -->
        <section class="w-100 bg-white" data-aos="fade-down">
            <div class="container py-3 py-md-5">
                <div class="h1 mb-4 text-center fw-bold">
                    A full solution to manage and grow your business
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-1.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Appointment scheduling
                                </div>
                                <div class="mt-3">
                                    A sleek and user-friendly salon software compatible with all devices for seamless
                                    appointments scheduling and management.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-2.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Payment processing
                                </div>
                                <div class="mt-3">
                                    Securely process client payments via pay by link, saved card and Fresha card terminals
                                    for a seamless checkout experience.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-3.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Point of sale (POS)
                                </div>
                                <div class="mt-3">
                                    All the tools to manage your salon retail operations with barcode scanners, receipt
                                    prints and more.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-4.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Marketing promotions
                                </div>
                                <div class="mt-3">
                                    The most powerful salon software with marketing features to grow your business and
                                    appointment bookings from new clients.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-5.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Product inventory and online store
                                </div>
                                <div class="mt-3">
                                    Manage your stock and set up your own online store to sell products worldwide.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 p-3" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="600">
                        <div class="about-card h-100 rounded-3 shadow-box">
                            <div class="p-4">
                                <img :src="`/images/for-business/svg/icon-6.svg`" class="w-34 h-34" alt="icon">
                            </div>
                            <div class="px-4 pb-4">
                                <div class="h5">
                                    Reporting and analytics
                                </div>
                                <div class="mt-3">
                                    Leverage Barberly's performance analytics and reporting tools to gain valuable insights
                                    into your salon's financials, client trends, and overall business growth.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Online booking -->
        <section class="w-100 bg-white" data-aos="fade-right">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex align-items-center justify-content-center py-3 py-md-5 order-1 order-md-0">
                        <img :src="`/images/for-business/online-booking.webp`" class="w-350 h-auto shadow-effect" alt="online-booking">
                    </div>
                    <div class="col-md-6 py-3 py-md-5 order-0 order-md-1">
                        <div class="mb-3 text-theme fw-semibold fs-6">
                            ONLINE BOOKING
                        </div>
                        <div class="h3 fw-semibold mb-3">
                            Grow sales by attracting new clients online
                        </div>
                        <div class="mb-3">
                            Be seen, be available, build your brand online. Create an online profile on our marketplace to
                            get noticed by thousands of potential clients in your area.
                            From your social feed to your door - add unlimited Book now buttons to your Instagram and
                            Facebook pages so new or existing clients can book instantly online.
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Attract and
                            retain clients
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Online
                            self-booking
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Get trusted
                            ratings and reviews
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Automated marketing -->
        <section class="w-100 bg-white" data-aos="fade-left">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 py-3 py-md-5">
                        <div class="mb-3 text-theme fw-semibold fs-6">
                            AUTOMATED MARKETING
                        </div>
                        <div class="h3 fw-semibold mb-3">
                            Stay in touch with auto campaigns and messages
                        </div>
                        <div class="mb-3">
                            Be seen, be available, build your brand online. Create an online profile on our marketplace to
                            get noticed by thousands of potential clients in your area.
                            From your social feed to your door - add unlimited Book now buttons to your Instagram and
                            Facebook pages so new or existing clients can book instantly online.
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Attract and
                            retain clients
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Online
                            self-booking
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`/images/for-business/svg/check.svg`" class="w-24 h-24 me-2" alt="check"> Get trusted
                            ratings and reviews
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center py-3 py-md-5">
                        <img :src="`/images/for-business/automation-message.webp`" class="w-350 h-auto shadow-effect"
                             alt="online-booking">
                    </div>
                </div>
            </div>
        </section>

        <!-- Our partners say -->
        <section class="w-100 bg-white position-relative" data-aos="fade-down">
            <div class="container py-5">
                <div class="fs-2 fw-bold text-center mb-5">
                    See what our partners say
                </div>
                <div class="position-relative">
                    <div class="bg-theme pt-5 pb-4 px-3 rounded-3 rounded-md-5">
                        <div class="d-flex justify-content-center flex-column">
                            <div class="fw-medium text-white text-sm-center">
                                "By far the best experience I’ve had with a salon booking system in 20 years! It’s super
                                user friendly and intuitive - their no-show and cancellation policy and text reminders
                                have ensured we have not had one no-show since we opened a year and a half ago!"
                            </div>
                            <div class="fw-semibold text-white text-center mt-3">
                                Ursula, Bond Salon
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <img :src="`/images/for-business/svg/star.svg`" class="img-fluid w-150" alt="star">
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute top-0 start-50 translate-middle">
                        <img :src="`/images/for-business/avatar.png`" class="w-80 h-80" alt="testimonial-avatar">
                    </div>
                </div>
                <div class="fs-2 fw-bold text-center mt-5">
                    Interested to find out more?
                </div>
                <div class="text-center mt-3">
                    <a href="javascript:void(0)" class="btn btn-theme px-4 py-2 position-relative z-2">
                        See Pricing
                    </a>
                </div>
            </div>
            <svg id="svg" viewBox="0, 0, 400,27.708333333333336" fill="#f2f2f2" class="position-absolute bottom-0 start-0 w-100">
                <g id="svgg">
                    <path id="path0" d="M0.000 13.854 L 0.000 27.708 200.000 27.708 L 400.000 27.708 400.000 14.216 L 400.000 0.725 395.573 1.822 C 322.012 20.064,241.242 29.243,178.709 26.467 C 123.876 24.033,57.451 14.315,4.123 0.926 C 2.094 0.417,0.336 0.000,0.217 0.000 C 0.069 0.000,0.000 4.399,0.000 13.854"></path>
                </g>
            </svg>
        </section>

        <!-- Pick a business type -->
        <div class="w-100 py-5 pick-a-business-type">
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

export default {

    data() {

        return {}

    },

    mounted() {},

    methods: {}

}

</script>
