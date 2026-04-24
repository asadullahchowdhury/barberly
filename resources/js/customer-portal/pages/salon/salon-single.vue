<template>
    <div class="salon container p-4 pt-5" v-if="marketplaceData !== null">
        <!--breadcrumb start-->
        <div class="header-breadcrumb d-flex flex-wrap mb-3 mt-5 pt-5">
            <router-link :to="{name:'Home'}" href="javascript:void(0)" class="text-decoration-none me-4">Home
            </router-link>
            <a href="javascript:void(0)" class="text-decoration-none me-4">Massage</a>
            <a href="javascript:void(0)" class="text-decoration-none me-4">London</a>
            <router-link :to="{name:'SalonSingle',params:{id:marketplaceData.id}}"
                         class="text-decoration-none me-4">
                {{ marketplaceData.company.business_name }}
            </router-link>
        </div>
        <!--breadcrumb end   -->

        <!--salon title start-->
        <div class="salon-title mb-4">
            <h3 class="fs-1 fw-bold">{{ marketplaceData.company.business_name }}</h3>
            <div class="sub d-flex small fw-semibold flex-md-row flex-column">

                <div class="d-flex each align-items-center">
                    <span class="">4.9</span>
                    <div class="d-flex mx-2">
                        <img :src="`/images/home/star.svg`" class="star" alt="star">
                        <img :src="`/images/home/star.svg`" class="star" alt="star">
                        <img :src="`/images/home/star.svg`" class="star" alt="star">
                        <img :src="`/images/home/star.svg`" class="star" alt="star">
                        <img :src="`/images/home/star.svg`" class="star" alt="star">
                    </div>
                    <div class="text-theme">(2302)</div>
                </div>

                <div class="text-muted each mx-md-3">
                    Closed opens at 9:00AM
                </div>

                <div class="text-muted each ">
                    {{ marketplaceData.location_name + ', ' + marketplaceData.address }}
                    <a href="javascript:void(0)" class="text-decoration-none text-theme ms-2">Get direction</a>
                </div>
            </div>
        </div>
        <!--salon title end  -->

        <!--salon image gallery start-->
        <div class="row img-glry mb-5">
            <div class="" :class="imageArray.length > 1 ? 'col-md-8 mb-md-0 mb-3' : 'col-12'">
                <a href="javascript:void(0)" @click="galleryView">
                    <img :src="'/storage/media/image/' + imageArray[0]?.photo_path" height="480"
                         alt="image 1" class="object-fit-cover w-100 rounded-3">
                </a>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mb-3" v-if="imageArray?.length > 1">
                        <a href="javascript:void(0)" @click="galleryView">
                            <img :src="'/storage/media/image/' + imageArray[1]?.photo_path" height="232"
                                 alt="image 2" class="object-fit-cover w-100 rounded-3">
                        </a>

                    </div>
                    <div class="col-12" v-if="imageArray?.length > 2">
                        <a href="javascript:void(0)" class="position-relative" @click="galleryView">
                            <img :src="'/storage/media/image/' + imageArray[2]?.photo_path" height="232"
                                 alt="image 3" class="object-fit-cover w-100 rounded-3">

                            <button type="button" class="btn btn-white" @click="galleryView">See all images</button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <!--salon image gallery end  -->


        <div class="row mb-md-5">
            <div class="col-xl-8">

                <!--Services start-->
                <h3 class="fs-1 fw-bold title mb-3">Services</h3>

                <Filter/>

                <!--Service list start-->
                <div class="service-list mt-4 mb-5">
                    <a href="javascript:void(0)" v-for="each in [1,2,3,4]"
                       class="each-service p-3 border d-flex justify-content-between align-items-center w-100 rounded-3 text-decoration-none text-dark mb-3">
                        <div class="">
                            <div class="">Deep Tissue Massage</div>
                            <div class="text-muted">30min - 2h</div>
                            <div class="mt-2">From 40$</div>
                        </div>

                        <router-link :to="{name:'SelectServices',state:{id:singleID}}"
                                     class="btn btn-outline-dark rounded-pill">
                            Book
                            <!--                            <img :src="`/images/global/plus.svg`" alt="plus">-->
                        </router-link>
                    </a>

                    <a href="javascript:void(0)"
                       class="btn btn-outline-dark padding-x-12 padding-y-10 border-radius-10">See all</a>

                </div>
                <!--Service list end  -->

                <!--Services end  -->

                <!--Team start-->
                <h3 class="fs-1 fw-bold title mb-3">Team</h3>

                <div class="team-list row mb-5">
                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-1.jpg`" alt="member-1">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-2.jpg`" alt="member-2">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-3.jpg`" alt="member-3">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-4.jpg`" alt="member-4">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-5.jpg`" alt="member-5">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-6.jpg`" alt="member-6">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-7.jpg`" alt="member-1">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <a href="javascript:void(0)" class="each-member">
                            <div class="member-head position-relative">
                                <div class="member-img-wrap mb-3">
                                    <img :src="`/images/home/salon/team/member-1.jpg`" alt="member-1">
                                </div>
                                <div class="rating rounded-pill border fw-semibold">
                                    5.0
                                    <img :src="`/images/home/star.svg`" class="star" alt="star">
                                </div>
                            </div>
                            <div class="info">
                                <div class="name">Ewelina</div>
                                <div class="sub text-muted">Physiotherapist HCPC, FHT regd</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12">
                        <a href="javascript:void(0)"
                           class="btn btn-outline-dark d-inline-block padding-x-12 padding-y-10 border-radius-10">
                            See all
                        </a>
                    </div>
                </div>

                <!--Team end  -->


                <!--Reviews start-->
                <h3 class="fs-1 fw-bold title mb-3">Reviews</h3>
                <div class="review-sub mb-4">
                    <div class="d-flex">
                        <img width="35" height="35" :src="`/images/home/star.svg`" class="me-2" alt="star">
                        <img width="35" height="35" :src="`/images/home/star.svg`" class="me-2" alt="star">
                        <img width="35" height="35" :src="`/images/home/star.svg`" class="me-2" alt="star">
                        <img width="35" height="35" :src="`/images/home/star.svg`" class="me-2" alt="star">
                        <img width="35" height="35" :src="`/images/home/star.svg`" class="me-2" alt="star">
                    </div>
                    <div class="fw-semibold mt-2 fs-6">4.9 <span class="text-theme">(2,302)</span></div>
                </div>

                <div class="review-list d-grid mb-5">

                    <div class="each-review mb-3" v-for="each in [1,1,1,1]">
                        <div class="user d-flex align-items-center">
                            <div class="avatar">
                                <img
                                    :src="`https://ui-avatars.com/api/?background=4ac1c040&color=4AC1C0&font-size=0.30&bold=true&rounded=true&name=John+Doe`"
                                    alt="user">
                            </div>
                            <div class="user-info ms-2">
                                <div class="name">John Doe</div>
                                <div class="date-time text-muted small">23 Dec 2023 12:02pm</div>
                            </div>
                        </div>
                        <div class="rating my-2">
                            <img width="20" height="20" :src="`/images/home/star.svg`" alt="star">
                            <img width="20" height="20" :src="`/images/home/star.svg`" alt="star">
                            <img width="20" height="20" :src="`/images/home/star.svg`" alt="star">
                            <img width="20" height="20" :src="`/images/home/star.svg`" alt="star">
                            <img width="20" height="20" :src="`/images/home/star.svg`" alt="star">
                        </div>
                        <div class="review">
                            Efficient and polite staff; clean and appealing environment; high
                            quality treatments
                        </div>
                    </div>

                    <div class="">
                        <a href="javascript:void(0)"
                           class="btn btn-outline-dark padding-x-12 padding-y-10 border-radius-10 d-inline-block">See
                            all</a>
                    </div>
                </div>

                <!--Reviews end  -->


                <!--About start-->
                <h3 class="fs-1 fw-bold title mb-3">About</h3>

                <p class="fw-normal">
                    {{ marketplaceData.description }}
                </p>

                <div class="map mb-5">
                    <iframe class="rounded-3 my-3"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d117329.93660808657!2d89.2567552!3d23.222681599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1703582673743!5m2!1sen!2sbd"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                    <div class="location fs-6 mb-2">
                        {{ marketplaceData.address }}
                        <a href="javascript:void(0)" class="ms-2 underline-anim text-decoration-none text-theme">Get
                            direction</a>
                    </div>
                    <div class="text-muted">
                        Near by Fitzrovia, West End, Westminster, Marylebone High Street, Carnaby, Marylebone and
                        Bloomsbury
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 pe-md-5">
                        <h4 class="fw-bold mb-3">Opening times</h4>
                        <ul class="list-unstyled m-0 p-0">
                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Monday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18 fw-semibold">
                                <div class="day">Tuesday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Wednesday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Thursday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Friday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Saturday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>
                            <li class="d-flex justify-content-between align-items-center mb-2 font-size-18">
                                <div class="day">Sunday</div>
                                <div class="time">9:00am - 9:00pm</div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4 class="fw-bold mb-3">Additional information</h4>
                        <ul class="list-unstyled m-0 p-0">
                            <li class="mb-2 font-size-18">
                                <img width="20" height="20" :src="`/images/global/check.svg`" class="me-2" alt="check">
                                Instant Confirmation
                            </li>

                            <li class="mb-2 font-size-18">
                                <img width="20" height="20" :src="`/images/global/card.svg`" class="me-2" alt="check">
                                Pay by app
                            </li>
                        </ul>
                    </div>
                </div>
                <!--About emd  -->

            </div>

            <div class="col-xl-4 my-xl-0 my-4">
                <div class="card rounded-3 position-sticky card sticky-card">
                    <div class="card-header  rounded-top-3 p-md-4 bg-white">
                        <h1 class="card-title fs-1 fw-bolder">{{ marketplaceData.company.business_name }}</h1>
                        <h4 class="fw-bold d-flex align-items-center">
                            4.9
                            <img width="25" height="25" :src="`/images/home/star.svg`" class="ms-2" alt="star">
                            <img width="25" height="25" :src="`/images/home/star.svg`" class="" alt="star">
                            <img width="25" height="25" :src="`/images/home/star.svg`" class="" alt="star">
                            <img width="25" height="25" :src="`/images/home/star.svg`" class="" alt="star">
                            <img width="25" height="25" :src="`/images/home/star.svg`" class="" alt="star">

                            <div class="text-theme ms-2">(2,302)</div>
                        </h4>

                        <div class="badge badge-theme px-3 py-2 font-size-14 me-2">Featured</div>
                        <div class="badge badge-success px-3 py-2 font-size-14 me-2">Deals</div>

                        <button type="button" class="btn btn-theme w-100 mt-3">Book now</button>
                    </div>

                    <div class="card-body p-md-4">
                        <ul class="list-unstyled p-0 m-0">
                            <li class="mb-3 font-size-18 d-flex align-items-start">
                                <img class="me-2" :src="`/images/global/clock.svg`" alt="clock">
                                <span class="text-theme me-2">Closed</span> opens at 9:00am
                            </li>

                            <li class="mb-3 font-size-18 d-flex align-items-start">
                                <img class="me-2" :src="`/images/global/map-pin.svg`" alt="map pin">
                                <div>
                                    {{ marketplaceData.address }}
                                    <a href="javascript:void(0)"
                                       class="ms-2 underline-anim text-theme text-decoration-none">Get
                                        directions</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="card-footer rounded-bottom-3 p-md-4 bg-white">
                        <ul class="list-unstyled p-0 m-0">
                            <li class="d-flex justify-content-between align-items-center mb-3">
                                <div class="">
                                    <div class="">Membership</div>
                                    <p class="text-muted m-0">Buy a bundle of appointments.</p>
                                </div>
                                <a href="javascript:void(0)"
                                   class="btn btn-outline-dark ms-2 padding-x-12 padding-y-10 w-70">Buy</a>
                            </li>

                            <li class="d-flex justify-content-between align-items-center mb-3">
                                <div class="">
                                    <div class="">Vouchers</div>
                                    <p class="text-muted m-0">Treat yourself or a friend to future visits.</p>
                                </div>
                                <a href="javascript:void(0)"
                                   class="btn btn-outline-dark ms-2 padding-x-12 padding-y-10 w-70">Buy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3 class="fs-3 fw-bold title mt-4">Venues Nearby</h3>

            <!--venues nearby start-->
            <Splide :options="{ rewind: true, perPage: 1, }" class="recommended-carousel pb-3 px-1">
                <SplideSlide class="d-flex align-items-center">
                    <router-link :to="{name:'SalonSingle',params:{id:1}}"
                                 class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-01.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </router-link>
                    <router-link :to="{name:'SalonSingle',params:{id:1}}"
                                 class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-02.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </router-link>
                    <router-link :to="{name:'SalonSingle',params:{id:1}}"
                                 class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-03.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </router-link>
                    <router-link :to="{name:'SalonSingle',params:{id:1}}"
                                 class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-04.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </router-link>
                </SplideSlide>

                <SplideSlide class="d-flex align-items-center">
                    <a href="javascript:void(0)"
                       class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-05.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:void(0)"
                       class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-06.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:void(0)"
                       class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-07.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:void(0)"
                       class="p-3 col-12 col-sm-6 col-md-4 col-lg-3 text-decoration-none text-dark effect-box">
                        <div class="border rounded-3 overflow-hidden box-effect">
                            <div class="overflow-hidden mb-3">
                                <img :src="`/images/home/post/post-08.jpg`" class="image-effect w-100" alt="post">
                            </div>
                            <div class="p-3">
                                <div class="fw-bold mb-3"> Decadence Hair and Beauty</div>
                                <div class="fw-semibold d-flex justify-content-start align-items-center mb-3">
                                    5.0 <img :src="`/images/home/star.svg`" class="mx-2 w-15 h-15"
                                             alt="star"> (1626)
                                </div>
                                <div class="text-secondary mb-3"> 36 Store St. London</div>
                                <span class="badge bg-white border text-dark rounded-pill"> Hair Salon </span>
                            </div>
                        </div>
                    </a>
                </SplideSlide>
            </Splide>
            <!--venues nearby end  -->
        </div>

    </div>

    <Gallery :image-array="imageArray" :galleryAction="galleryAction"/>
</template>

<script>

import Gallery from "../../../components/gallery.vue";
import Filter from "../../../components/filter.vue";

// Default theme
import '@splidejs/vue-splide/css';
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";

import {Splide, SplideSlide} from '@splidejs/vue-splide';
import apiService from "../../../services/apiService.js";
import apiRoutes from "../../../customer-portal/apiRoutes/apiRoutes.js";
import axios from "axios";

export default {
    name: 'SalonSingle',
    props: ['imageArray', 'galleryAction'],
    components: {
        Splide,
        SplideSlide,
        Gallery,
        Filter,
    },
    data() {
        return {
            imageArray: [],
            galleryAction: false,
            loading: false,
            singleID: '',
            marketplaceData: null,
        }
    },

    mounted() {
        if (window.history.state.id !== undefined || window.history.state.id !== null || window.history.state.id !== '') {
            this.singleID = window.history.state.id;
            this.getSingle(this.singleID)
        } else {
            this.$router.push({name: 'Home'})
        }
    },

    methods: {
        /*function to view Gallery*/
        galleryView() {
            EventBus.$emit('openGallery', true);
        },

        /*Single API*/
        getSingle(id) {
            this.loading = true;
            apiService.ClearErrorHandler();
            axios.get(apiRoutes.Marketplace + '/' + id, {headers: apiService.headerContent}).then((response) => {
                this.marketplaceData = response.data
                this.imageArray = this.marketplaceData?.photos;
                console.log(this.imageArray)
            }).catch(err => {
                let res = err?.response?.data
                apiService.ErrorHandler(res.errors)
            }).finally(() => {
                this.loading = false;
            })
        },
    },

}
</script>
