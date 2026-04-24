<template>

    <div class="home">
        <div class="home-bg" :style="{ backgroundImage: 'url(/images/home/background.jpeg)' }">

        </div>
        <!-- Hero section -->
        <div class="container hero-section d-flex justify-content-center align-items-center flex-column ">
            <div class="col-12 col-sm-11 col-md-10">
                <div class="global-title hero-title lh-base fw-bolder col-12 col-sm-11 col-md-10 col-lg-9 mb-md-5 mb-3"
                     data-aos="fade-up">
                    Book local beauty and wellness services
                </div>

                <!-- Form action for location with time and date -->
                <form class="col-12 form-content border-theme rounded-pill d-flex flex-wrap" data-aos="fade-up"
                      data-aos-delay="200">
                    <div class="form-flex">
                        <div class="position-relative">
                            <input type="text" name="" class="form-control radius-left rounded-0 ps-5"
                                   placeholder="Any treatment" :value="categoryText" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <img :src="`/images/portal/search.svg`" class="w-15 h-15" alt="search">
                            </div>
                            <ul class="dropdown-menu treatment-dropdown text-capitalize w-100 p-2 mt-2">
                                <li>
                                    <div class="fw-bold h6 my-3 ms-2">Top Categories</div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/barber.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="barber">
                                        barber
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/face-skin.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="face-skin">
                                        face skin
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/hair-extensions.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="hair-extensions">
                                        hair extensions
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/hair-removal.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="hair-removal">
                                        hair removal
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/haircut-styling.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="haircut-styling">
                                        haircut styling
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/injectables.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="injectables">
                                        injectables
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/lashes-brows.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="lashes-brows">
                                        lashes brows
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/makeup.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="makeup">
                                        makeup
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/massage.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="massage">
                                        massage
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/nails.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="nails">
                                        nails
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/piercing-tattoo.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="piercing-tattoo">
                                        piercing tattoo
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/massage.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="massage">
                                        massage
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item rounded my-2 p-2" @click="textSelect($event)">
                                        <img :src="`/images/services/spa-wellness.svg`"
                                             class="w-35 h-35 border p-1 rounded me-3" alt="piercing-tattoo">
                                        spa wellness
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-flex">
                        <div class="position-relative">
                            <input type="text" name="address" id="google_autocomplete" v-model="formData.address"
                                   class="form-control rounded-0 ps-5" placeholder="Current location">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <img :src="`/images/home/geo.svg`" class="w-15 h-15" alt="geo">
                            </div>
                        </div>
                    </div>
                    <div class="form-flex">
                        <div class="position-relative">
                            <input type="date" class="form-control rounded-0 ps-5" placeholder="Start Date" id="anyDate"
                                   autocomplete="off">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <img :src="`/images/home/calendar.svg`" class="w-15 h-15" alt="calendar">
                            </div>
                        </div>
                    </div>
                    <div class="form-flex">
                        <div class="position-relative">
                            <input type="text" class="form-control rounded-0 w-100 ps-5" placeholder="Any Time"
                                   id="anyTime" autocomplete="off">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <img :src="`/images/home/time.svg`" class="w-15 h-15" alt="time">
                            </div>
                        </div>
                    </div>
                    <div class="btn-flex">
                        <button type="button"
                                class="btn btn-theme h-100 px-3 w-100 d-flex px-0 justify-content-center align-items-center rounded-0 radius-right"
                                @click="pushSearch">
                            Search
                        </button>
                    </div>
                </form>

                <!-- Appointment counter -->
                <div class="fw-bold text-center mt-5 h4" data-aos="fade-up" data-aos-delay="300">
                    276,022 appointments booked today
                </div>

                <!-- Button for app of barberly -->
                <div class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="qr-btn-wrapper margin-top-40 position-relative">

                        <!-- get the app -->
                        <router-link :to="{name: 'DownloadApp'}" class="btn btn-outline-light rounded-pill px-4">
                            Get the app
                            <!--                            <img :src="`/images/home/app-code-black.svg`" class="w-19 h-19" alt="app-code">-->
                            <img :src="`/images/global/qr-white.png`" class="ms-2" alt="qr-code">

                        </router-link>

                        <!-- Qr code scanner -->
                        <div class="position-absolute qr-code">
                            <div class="text-center bg-white fw-bold w-180 shadow rounded-3">
                                <img :src="`/images/home/code-scan.png`" class="img-fluid px-3 pt-3" alt="code-scan">
                                <div class="py-2">Scan to download</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <!-- appointment section -->
        <section class="container py-3 pb-md-5">
            <div class="h3 fw-bold mb-3 ms-2" data-aos="fade-up">Appointments</div>
            <Splide :options="{ rewind: true, perPage: 1}" class="appointment-carousel" data-aos="fade-up"
                    data-aos-delay="200">
                <SplideSlide class="d-flex align-items-center">

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden hover-appointment border-0 mx-2">
                            <div class="appointment-card d-flex align-items-start justify-content-start">
                                <div
                                    class="appointment-image d-flex justify-content-center align-items-center flex-column text-white">
                                    <div class="fw-bold"> Thursday</div>
                                    <div class="fs-1"> 7</div>
                                    <div class="fw-bold"> March</div>
                                </div>
                                <div class="appointment-info ps-3 w-100 text-white pt-2">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block"> BDT 33 . 3 Items </span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </router-link>

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden bg-white mx-2">
                            <div class="appointment-card d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/post/post-02.jpg`" class="appointment-image"
                                     alt="appointment 2">
                                <div class="appointment-info ps-3 w-100">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                                    </small>
                                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                                        See details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </router-link>

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden bg-white mx-2">
                            <div class="appointment-card d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/post/post-03.jpg`" class="appointment-image"
                                     alt="appointment 3">
                                <div class="appointment-info ps-3 w-100">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                                    </small>
                                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                                        Book again
                                    </a>
                                </div>
                            </div>
                        </div>
                    </router-link>

                </SplideSlide>
                <SplideSlide class="d-flex align-items-center">

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden bg-white mx-2">
                            <div class="appointment-card d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/post/post-01.jpg`" class="appointment-image"
                                     alt="appointment 1">
                                <div class="appointment-info ps-3 w-100">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                                    </small>
                                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                                        Book again
                                    </a>
                                </div>
                            </div>
                        </div>
                    </router-link>

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden bg-white mx-2">
                            <div class="appointment-card d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/post/post-02.jpg`" class="appointment-image"
                                     alt="appointment 2">
                                <div class="appointment-info ps-3 w-100">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                                    </small>
                                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                                        Book again
                                    </a>
                                </div>
                            </div>
                        </div>
                    </router-link>

                    <router-link :to="{ name: 'Appointments' }" class="text-decoration-none col-12 col-md-6 col-xl-4">
                        <div class="card overflow-hidden bg-white mx-2">
                            <div class="appointment-card d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/post/post-03.jpg`" class="appointment-image"
                                     alt="appointment 3">
                                <div class="appointment-info ps-3 w-100">
                                    <div class="fw-semibold mb-1"> John Smith</div>
                                    <small class="d-block mb-2">
                                        <span class="d-block"> Fri 16 Feb 2024 at 11:00 </span>
                                        <span class="d-block text-secondary text-opacity-75"> BDT 33 . 3 Items </span>
                                    </small>
                                    <a href="javascript:void(0)" class="text-decoration-none text-theme underline-anim">
                                        Book again
                                    </a>
                                </div>
                            </div>
                        </div>
                    </router-link>

                </SplideSlide>
            </Splide>
        </section>

        <!-- Recommended  slider section -->
        <section class="container post py-3 py-md-5" v-if="recommendedData?.length > 0 && !marketplaceLoading">
            <div class="h3 fw-bold mb-3 ms-2" data-aos="fade-up">Recommended</div>

            <!--Slider start-->
            <Splide data-aos="fade-up" data-aos-delay="200"
                    :options="{ rewind: true, perPage: 4, breakpoints:{1199 : {perPage: 3} ,991: {perPage: 2}, 575: {perPage: 1}} }"
                    class="recommended-carousel">

                <SplideSlide
                    v-for="each in recommendedData">
                    <router-link :to="{name:'SalonSingle',params:{id:each.id},state:{id:each.id}}"
                                 class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border h-425 rounded-3 overflow-hidden box-effect mx-2">
                            <div class="overflow-hidden mb-3">
                                <img :src="'/storage/media/image/' + each.photos[0].photo_path" height="200"
                                     class="image-effect w-100 object-fit-cover" alt="post">
                            </div>
                            <div class="p-3 bg-white">
                                <div class="fw-bold mb-3 text-ellipsis"> {{ each?.company?.business_name }}</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15" alt="star">
                                    (1626)
                                </div>
                                <div class="text-secondary mb-3 text-ellipsis"> {{ each.address }}</div>
                                <span class="badge bg-white border text-dark rounded-pill me-1"
                                      v-for="service in each?.company.services">{{ service }}</span>
                            </div>
                        </div>
                    </router-link>
                </SplideSlide>

            </Splide>
            <!--Slider end  -->

        </section>

        <!-- New for barberly slider section -->
        <section class="container post py-3 py-md-5" v-if="newData?.length > 0 && !marketplaceLoading">
            <div class="h3 mb-3 fw-bold ms-2" data-aos="fade-up">New for Barberly</div>

            <!--Slider start-->
            <Splide data-aos="fade-up" data-aos-delay="200"
                    :options="{ rewind: true, perPage: 4,gap: '15px', breakpoints:{1199 : {perPage: 3} ,991: {perPage: 2}, 575: {perPage: 1}} }"
                    class="recommended-carousel">
                <SplideSlide
                    v-for="each in newData">
                    <router-link :to="{name:'SalonSingle',params:{id:each.id},state:{id:each.id}}"
                                 class="col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border h-425 rounded-3 overflow-hidden box-effect mx-2">
                            <div class="overflow-hidden mb-3">
                                <img :src="'/storage/media/image/' + each.photos[0].photo_path" height="200"
                                     class="image-effect w-100 object-fit-cover" alt="post">
                            </div>
                            <div class="p-3 bg-white">
                                <div class="fw-bold mb-3 text-ellipsis"> {{ each?.company?.business_name }}</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15" alt="star">
                                    (1626)
                                </div>
                                <div class="text-secondary mb-3 text-ellipsis"> {{ each.address }}</div>
                                <span class="badge bg-white border text-dark rounded-pill me-1"
                                      v-for="service in each?.company.services">{{ service }}</span>
                            </div>
                        </div>
                    </router-link>
                </SplideSlide>
            </Splide>
            <!--Slider end  -->

        </section>

        <!-- Download section -->
        <section class="container download-section py-md-5 py-3">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="mb-3 fw-bold">
                        Available on:
                        <img :src="`/images/authentication/apple.png`" class="ms-3 w-15 h-15" alt="apple">
                        <img :src="`/images/authentication/google.png`" class="ms-3 w-15 h-15" alt="google">
                    </div>
                    <div class="mb-3 global-title fw-bolder">
                        Download the Barberly app
                    </div>
                    <div class="mb-3 lead">Book unforgettable beauty and wellness experiences with the Barberly mobile
                        app
                    </div>
                    <div class="mb-3">
                        <div class="w-25 p-sm-3 border rounded-3 bg-white">
                            <img :src="`/images/home/code-scan.png`" class="img-fluid scale-effect" alt="code-scan">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 d-flex align-items-center justify-content-center"
                     data-aos="fade-left" data-aos-delay="200">
                    <img :src="`/images/home/mobile-photo.webp`" class="animation-top-bottom animation-sm translate-0 translate-30 img-fluid image-res image-mobile-photo mx-3"
                         alt="mobile-photo">
                    <span id="mapVid">
                    <video autoplay loop muted playsinline :src="`/images/home/mobile-video.mp4`"
                           class=" img-fluid image-res image-mobile-video mx-3 border border-3 border-dark rounded-3"></video>
                    </span>
                </div>
            </div>
        </section>

        <!-- Review of barberly splide slide -->
        <section class="container post py-md-5 py-3">
            <div class="h3 mb-3 fw-bold" data-aos="fade-up">Review</div>

            <Splide data-aos="fade-up" data-aos-delay="200"
                    :options="{ rewind: true,gap:'20px',perPage:4 ,breakpoints:{1199:{perPage:3},991:{perPage:2},576:{perPage:1}}}"
                    class="p-3">
                <SplideSlide class="d-flex align-items-center" v-for="each in [1,2,3,4,5,6,7,8,9,10 ]">
                    <div class="p-1 col-12 col-md-6 col-lg-3 w-100">
                        <div class="bg-light rounded-3 p-3">
                            <div class="mb-3 d-flex align-items-center justify-content-start">
                                <img :src="`/images/home/star.svg`" class="w-15 h-15" alt="star">
                                <img :src="`/images/home/star.svg`" class="w-15 h-15 ms-2" alt="star">
                                <img :src="`/images/home/star.svg`" class="w-15 h-15 ms-2" alt="star">
                                <img :src="`/images/home/star.svg`" class="w-15 h-15 ms-2" alt="star">
                                <img :src="`/images/home/star.svg`" class="w-15 h-15 ms-2" alt="star">
                            </div>
                            <div class="h4 fw-bold"> the best booking system</div>
                            <div class="text-secondary"> Great experience, easy to book. Paying for treatments is so
                                convenient — no cash or cards needed!
                            </div>
                            <div class="customer-info mt-5 d-flex align-items-center">
                                <img :src="`/images/home/customer/customer-image-01.jpg`" class="customer-image"/>
                                <div class="customer-source ms-2">
                                    <div class="fw-bold">Pat</div>
                                    <div class="text-secondary">Dublin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </SplideSlide>

            </Splide>
        </section>

        <!-- About section -->
        <section class="container py-md-5 py-3 about text-sm-center">
            <div class="h3 fw-bolder mb-3" data-aos="fade-up">
                The top-rated destination for beauty and wellness
            </div>
            <div class="h5 mb-3" data-aos="fade-up" data-aos-delay="200">
                One solution, one software. Trusted by the best in the beauty and wellness industry
            </div>
            <div class="global-title fw-bolder text-theme pt-3 mb-3 text-center" data-aos="fade-up"
                 data-aos-delay="400">
                700 million+
            </div>
            <div class="h5 pb-5 text-center" data-aos="fade-up" data-aos-delay="500">Appointments booked on Barberly
            </div>
            <div class="row mt-3" data-aos="fade-up" data-aos-delay="600">
                <div class="col-12 col-md-4 mb-3 text-center">
                    <div class="h3 fw-bolder">
                        1,00,000 +
                    </div>
                    <div class="h5">
                        partner businesses
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3 text-center">
                    <div class="h3 fw-bolder">
                        120 + countries
                    </div>
                    <div class="h5">
                        using barberly
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3 text-center">
                    <div class="h3 fw-bolder">
                        4,50,000 +
                    </div>
                    <div class="h5">
                        stylists and professionals
                    </div>
                </div>
            </div>
        </section>

        <!-- Business for barberly -->
        <section class="container business-section">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000">
                    <div class="global-title mb-3">Barberly for business</div>
                    <div class="lead text-secondary mb-3">
                        Supercharge your business for free with the world's top booking platform for salons and spas.
                        Independently voted no. 1 by industry professionals.
                    </div>
                    <a href="javascript:void(0)"
                       class="btn btn-white btn-anchor fix-width has-border mb-3 rounded-pill padding-x-12 padding-y-10">
                        Find out more
                    </a>
                    <div class="fw-bold mb-3 h3">
                        Excellent 5/5
                    </div>
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <img :src="`/images/home/star.svg`" class="w-30 h-30" alt="star">
                        <img :src="`/images/home/star.svg`" class="w-30 h-30 ms-2" alt="star">
                        <img :src="`/images/home/star.svg`" class="w-30 h-30 ms-2" alt="star">
                        <img :src="`/images/home/star.svg`" class="w-30 h-30 ms-2" alt="star">
                        <img :src="`/images/home/star.svg`" class="w-30 h-30 ms-2" alt="star">
                    </div>
                    <div class="text-secondary fw-bold">Over 1250 reviews on barberly</div>
                </div>
                <div class="col-md-6 vh-100 position-relative" data-aos="fade-left" data-aos-delay="300"
                     data-aos-duration="1000">
                    <img :src="`/images/home/for-business.webp`" class="image-absolute" alt="for-business">
                </div>
            </div>
        </section>

    </div>

</template>

<script>

import '@splidejs/vue-splide/css';
import {Splide, SplideSlide} from '@splidejs/vue-splide';
import apiRoutes from "../../../customer-portal/apiRoutes/apiRoutes.js";
import axios from "axios";
import apiService from "../../../services/apiService.js";

export default {

    components: {
        // Component of splide, splideSlide for slider of review and recommended sources
        Splide,
        SplideSlide,
    },

    data() {

        return {
            // Data properties for the component
            searchTreatmentActive: false,
            categoryText: '',
            formData: {},
            marketplaceParam: {
                type: '',
                keyword: '',
            },
            marketplaceLoading: false,
            recommendedData: [],
            newData: [],
        }

    },

    mounted() {

        // Lifecycle hook: Called after the component is mounted
        this.initializeVideo();

        this.initializeInput();

        this.anyTimeFlatpickr();

        this.anyDateFlatpickr();

        this.marketplaceList('recommended');

        this.marketplaceList('new');


    },

    methods: {

        // Marketplace list API
        marketplaceList(type) {
            this.marketplaceLoading = true;
            let url = apiRoutes.Marketplace + '?type=' + type;
            if (this.marketplaceParam.keyword) {
                url = apiRoutes.Marketplace + '?type=' + type + '&keyword=' + this.marketplaceParam.keyword;
            }
            axios.get(url, {headers: apiService.headerContent}).then((response) => {
                if (type === 'recommended') {
                    this.recommendedData = response.data;
                    this.recommendedData.forEach((data) => {
                        data.company.services = data.company.services.split(',');
                    })
                } else {
                    this.newData = response.data;
                    this.newData.forEach((data) => {
                        data.company.services = data.company.services.split(',');
                    })
                }
            }).catch(err => {
                let res = err?.response?.data;
            }).finally(() => {
                this.marketplaceLoading = false;
            })
        },

        // Function of google map autocomplete
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                })
            }, 1000)
        },

        // Function of initializing the video first
        initializeVideo() {
            let sp1 = document.createElement("span");

            // Get the reference element
            let sp2 = document.getElementById("mapVid");
            // Get the parent element
            let parentDiv = sp2.parentNode;

            // Insert the new element into before sp2
            parentDiv.insertBefore(sp1, sp2);
        },

        // Function of insert text select of hero section
        textSelect(e) {
            this.categoryText = e.target.innerText;
        },

        // Function of any time flatpickr of hero section
        anyTimeFlatpickr() {
            flatpickr('#anyTime', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "",
                disableMobile: true,
            })
        },

        // Function of any date flatpickr of hero section
        anyDateFlatpickr() {
            flatpickr('#anyDate', {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                disableMobile: true,
            })
        },

        // Function of route to push search
        pushSearch() {
            this.$router.push({name: 'Address'})
        },

    }

}

</script>
