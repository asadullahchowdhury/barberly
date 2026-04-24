<template>

    <div class="container-fluid">
        <div class="content-wrapper">
            <div class="sidebar-address"  :class="{'active': map}">
                <div class="d-none d-lg-block">
                    <div class="d-flex justify-content-between align-items-center w-100 p-3">
                        <small>
                            15 venues nearby
                        </small>
                        <button type="button" class="btn btn-outline-dark px-4 rounded-pill py-2" @click="openFilterModal">
                            <span class="d-flex align-items-center">
                                <img :src="`/images/portal/filter-black.svg`" class="w-20 h-20 img-fluid me-2" alt="filter">
                                Filter
                            </span>
                        </button>
                    </div>
                </div>
                <div class="d-block d-lg-none py-1 py-sm-3 px-1 visible-content">

                    <div class="d-flex align-items-center justify-content-between border rounded-pill w-100 px-1 py-1">
                        <div class="d-flex align-items-center justify-content-start">
                            <router-link :to="{name: 'Appointments'}" class="btn-icon rounded-circle">
                                <img :src="`/images/global/arrow-left.svg`" class="w-21 h-21" alt="search">
                            </router-link>
                            <button type="button" class="ms-0 ms-sm-3 text-start border-0 btn" @click="openSearchModal">
                                <span class="d-block">Any Treatment or venue</span>
                                <span class="text-secondary text-truncate">Any date. Current Location</span>
                            </button>
                        </div>
                        <button type="button" class="btn-icon border rounded-circle w-55 h-55" @click="contentManage()">
                            <img :src="`/images/home/map.svg`" class="w-24 h-24" alt="map">
                        </button>
                    </div>

                    <div class="w-100 group-button">
                        <div class="d-flex align-items-center justify-content-start gap-1 mt-3 w-500">
                            <button type="button" class="btn-icon border w-65 rounded-pill" @click="openFilterModal">
                                <img :src="`/images/portal/filter-black.svg`" class="w-20 h-20" alt="filter">
                            </button>
                            <button type="button" class="btn-icon border w-95 rounded-pill" @click="openSortModalOpen">
                                Sort <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                            <button type="button" class="btn-icon border w-130 rounded-pill" @click="openMaximumPriceModal">
                                Max Price <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                            <button type="button" class="btn-icon border w-130 rounded-pill" @click="openVenueModal">
                                Venue Type <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                        </div>
                    </div>

                    <div class="text-center">15 venues nearby</div>
                </div>

                <div class="sidebar-address-inner overflow-y-scroll scrollbar">

                    <div class="p-3 address-card">

                        <Splide :options="{ rewind: true, perPage: 1, }" class="py-3 px-1">
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-01.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-02.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-03.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-04.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                        </Splide>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="mt-1 fw-bold">
                                    Jhelah bransua
                                </div>
                                <div class="mb-1 fw-bold d-flex align-items-center justify-content-start">
                                    <span class="me-2">5.0</span>
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                </div>
                                <div class="text-secondary text-opacity-75">
                                    KhaliBazar, Badamata, Bardhaman
                                </div>
                            </div>
                            <div class="col-2 fw-bold">
                                >50km
                            </div>
                        </div>
                        <hr>
                        <ul class="p-0 m-0">
                            <li class="d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <router-link :to="{name: 'SelectServices'}" class="text-decoration-none text-theme underline-anim">
                                See more
                            </router-link>
                        </div>
                    </div>

                    <div class="p-3 address-card">
                        <Splide :options="{ rewind: true, perPage: 1, }" class="py-3 px-1">
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-05.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-06.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-07.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-08.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                        </Splide>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="mt-1 fw-bold">
                                    Jhelah bransua
                                </div>
                                <div class="mb-1 fw-bold d-flex align-items-center justify-content-start">
                                    <span class="me-2">5.0</span>
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                </div>
                                <div class="text-secondary text-opacity-75">
                                    KhaliBazar, Badamata, Bardhaman
                                </div>
                            </div>
                            <div class="col-2 fw-bold">
                                >50km
                            </div>
                        </div>
                        <hr>
                        <ul class="p-0 m-0">
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <router-link :to="{name: 'SelectServices'}" class="text-decoration-none text-theme underline-anim">
                                See more
                            </router-link>
                        </div>
                    </div>

                    <div class="p-3 address-card">
                        <Splide :options="{ rewind: true, perPage: 1, }" class="py-3 px-1">
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-09.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-10.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-11.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                            <SplideSlide class="w-100">
                                <router-link :to="{name:'Appointments'}" class="w-100">
                                    <div class="overflow-hidden rounded-3">
                                        <img :src="`/images/home/post/post-12.jpg`" class="image-effect" alt="venue">
                                    </div>
                                </router-link>
                            </SplideSlide>
                        </Splide>
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="mt-1 fw-bold">
                                    Jhelah bransua
                                </div>
                                <div class="mb-1 fw-bold d-flex align-items-center justify-content-start">
                                    <span class="me-2">5.0</span>
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                    <img :src="`/images/home/star-black.svg`" class="w-19 h-19 ms-1" alt="black-start">
                                </div>
                                <div class="text-secondary text-opacity-75">
                                    KhaliBazar, Badamata, Bardhaman
                                </div>
                            </div>
                            <div class="col-2 fw-bold">
                                >50km
                            </div>
                        </div>
                        <hr>
                        <ul class="p-0 m-0">
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                            <li class="btn border-0 d-flex align-items-center justify-content-between hover-effect py-1 px-2">
                                <span class="w-100">
                                    <span class="fw-semibold text-start d-block">
                                        Hair Cut (Rs 100 - Rs 350)
                                    </span>
                                    <span class="d-block text-secondary text-start d-block">
                                        20 mins
                                    </span>
                                </span>
                                <span class="w-200 text-end">
                                    from $10
                                </span>
                            </li>
                        </ul>
                        <div class="mt-3">
                            <router-link :to="{name: 'SelectServices'}" class="text-decoration-none text-theme underline-anim">
                                See more
                            </router-link>
                        </div>
                    </div>

                </div>

            </div>
            <div class="content-address position-relative" :class="{'active':!map}">

                <div class="position-absolute w-100 p-1 p-sm-3 group-activity">
                    <div class="d-flex align-items-center justify-content-between border rounded-pill w-100 px-1 py-1 bg-white">
                        <div class="d-flex align-items-center justify-content-start">
                            <router-link :to="{name: 'Appointments'}" class="btn-icon rounded-circle">
                                <img :src="`/images/global/arrow-left.svg`" class="w-21 h-21" alt="search">
                            </router-link>
                            <button type="button" class="ms-0 ms-sm-3 text-start border-0 btn" @click="openSearchModal">
                                <span class="d-block">Any Treatment or venue</span>
                                <span class="text-secondary text-truncate">Any date. Current Location</span>
                            </button>
                        </div>
                        <button type="button" class="btn-icon border rounded-circle w-55 h-55" @click="contentManage">
                            <img :src="`/images/home/menu-icon.svg`" class="w-24 h-24" alt="map">
                        </button>
                    </div>
                    <div class="w-100 group-button">
                        <div class="d-flex align-items-center justify-content-start gap-1 mt-3 w-500">
                            <button type="button" class="btn-icon border w-65 rounded-pill bg-white" @click="openFilterModal">
                                <img :src="`/images/portal/filter-black.svg`" class="w-20 h-20" alt="filter">
                            </button>
                            <button type="button" class="btn-icon border w-95 rounded-pill bg-white" @click="openSortModalOpen">
                                Sort <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                            <button type="button" class="btn-icon border w-130 rounded-pill bg-white" @click="openMaximumPriceModal">
                                Max Price <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                            <button type="button" class="btn-icon border w-130 rounded-pill bg-white" @click="openVenueModal">
                                Venue Type <img :src="`/images/global/chevron-down.svg`" class="ms-2 w-12 h-12" alt="chevron-down">
                            </button>
                        </div>
                    </div>
                </div>

                <div id="canvas-for-googlemap" class="w-100 h-100 animated-up" :class="{'active': !map}">
                    <iframe class="w-100 h-100 border-0"
                            src="https://www.google.com/maps/embed/v1/place?q=Australian+Museum,+William+Street,+Darlinghurst+NSW,+Australia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Filter</h1>
                    <button type="button" class="btn-close shadow-none" @click="closeFilterModal"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="fw-bold mb-2 py-2">Sort</div>
                    <label for="recommended" class="form-label d-flex align-items-center py-2">
                        <input id="recommended" name="sort" type="radio" class="form-radio">
                        Recommended
                    </label>
                    <label for="Nearest" class="form-label d-flex align-items-center py-2">
                        <input id="Nearest" name="sort" type="radio" class="form-radio">
                        Nearest
                    </label>
                    <label for="top-rated" class="form-label d-flex align-items-center py-2">
                        <input id="top-rated" name="sort" type="radio" class="form-radio">
                        Top rated
                    </label>
                    <div class="py-2">
                        <label for="price" class="form-label w-100 d-flex align-items-center justify-content-between fw-bold">
                            <span>
                                Price
                            </span>
                            <span>
                                ${{ displayPrice }}
                            </span>
                        </label>
                        <input id="price" type="range" class="form-range" min="1" :max="10000" v-model="price" @input="updateDisplayPrice">
                    </div>
                    <div class="py-2">
                        <label for="venue-type" class="form-label fw-bold mb-3">
                            Venue Type
                        </label>
                        <div class="mt-2 d-flex justify-content-start align-items-center flex-wrap">
                            <button class="btn py-sm-2 px-sm-4 rounded-pill m-1" type="button" :class="{ 'bg-light border': tab !== 1, 'bg-theme text-white': tab === 1 }" @click="setOption(1)">
                                Everyone
                            </button>
                            <button class="btn py-sm-2 px-sm-4 rounded-pill m-1" type="button" :class="{ 'bg-light border': tab !== 2, 'bg-theme text-white': tab === 2 }" @click="setOption(2)">
                                Female only
                            </button>
                            <button class="btn py-sm-2 px-sm-4 rounded-pill m-1" type="button" :class="{ 'bg-light border': tab !== 3, 'bg-theme text-white': tab === 3 }" @click="setOption(3)">
                                Male only
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-light col-5 border height-50" @click="closeFilterModal">
                        Clear all
                    </button>
                    <button type="button" class="btn btn-theme col-5 height-50 d-flex align-items-center justify-content-center">
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sort modal -->
    <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Sort by</h1>
                    <button type="button" class="btn-close shadow-none" @click="closeSortModal"></button>
                </div>
                <div class="modal-body py-0">

                    <label for="sort-recommended" class="form-label d-flex align-items-center py-2">
                        <input id="sort-recommended" name="sort" type="radio" class="form-radio">
                        Recommended
                    </label>

                    <label for="sort-nearest" class="form-label d-flex align-items-center py-2">
                        <input id="sort-nearest" name="sort" type="radio" class="form-radio">
                        Nearest
                    </label>

                    <label for="sort-top-rated" class="form-label d-flex align-items-center py-2">
                        <input id="sort-top-rated" name="sort" type="radio" class="form-radio">
                        Top rated
                    </label>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-light col-5 border height-50" @click="closeSortModal">
                        Clear
                    </button>
                    <button type="button" class="btn btn-theme col-5 height-50 d-flex align-items-center justify-content-center">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- maximum price -->
    <div class="modal fade" id="maximumPriceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel"> Maximum price </h1>
                    <button type="button" class="btn-close shadow-none" @click="closeMaximumPriceModal"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="py-2">
                        <label for="price" class="form-label w-100 d-flex align-items-center justify-content-between fw-bold">
                            <span>
                                Price
                            </span>
                            <span>
                                ${{ displayPrice }}
                            </span>
                        </label>
                        <input id="price" type="range" class="form-range" min="1" :max="10000" v-model="price" @input="updateDisplayPrice">
                    </div>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-light col-5 border height-50" @click="closeMaximumPriceModal">
                        Clear
                    </button>
                    <button type="button" class="btn btn-theme col-5 height-50 d-flex align-items-center justify-content-center">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Venue modal -->
    <div class="modal fade" id="venueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">Venue types</h1>
                    <button type="button" class="btn-close shadow-none" @click="closeVenueModal"></button>
                </div>
                <div class="modal-body py-0">

                    <label for="everyone" class="form-label my-3">
                        <input id="everyone" type="radio" name="venueType" class="form-radio">
                        Everyone
                    </label>

                    <label for="female" class="form-label my-3">
                        <input id="female" type="radio" name="venueType" class="form-radio">
                        Female only
                    </label>

                    <label for="male" class="form-label my-3">
                        <input id="male" type="radio" name="venueType" class="form-radio">
                        Male only
                    </label>

                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-light col-5 border height-50" @click="closeVenueModal">
                        Clear
                    </button>
                    <button type="button" class="btn btn-theme col-5 height-50 d-flex align-items-center justify-content-center">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- search content modal  -->
    <div class="modal fade" id="searchContentModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="searchModalLabel">Search Anything</h1>
                    <button type="button" class="btn-close shadow-none" @click="closeSearchModal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <div class="position-relative">
                                        <input type="text" class="form-control ps-5" placeholder="Any treatment">
                                        <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                            <img :src="`/images/global/search.svg`" class="w-21 h-21" alt="search">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <div class="position-relative">
                                        <input type="text" name="address" id="google_autocomplete"
                                               v-model="formData.address" class="ps-5 form-control"
                                               placeholder="Current location">
                                        <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                            <img :src="`/images/home/geo-map.svg`" class="w-21 h-21" alt="geo-alt">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-sm-0 mb-3">
                                <div class="form-group">
                                    <label for="date" class="form-label d-none d-sm-inline-block">Date</label>
                                    <input id="date" type="text" name="date" class="form-control" placeholder="Any date" autocomplete="off" v-model="formData.date" >

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="time" class="form-label d-none d-sm-inline-block">Time</label>
                                    <input id="time" type="text" name="time" class="form-control" placeholder="Any Time" autocomplete="off" v-model="formData.time">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-theme w-100">Search</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</template>

<script>

import '@splidejs/vue-splide/css';
import {Splide, SplideSlide} from '@splidejs/vue-splide';
import flatPickr from "vue-flatpickr-component";
import flatpickr from "flatpickr";

export default {

    components: {
        // Component of splide, splideSlide for slider of review and recommended sources
        Splide,
        SplideSlide,
        flatPickr,
    },

    data() {

        return {
            tab: 1,
            price: 10000,
            displayPrice: 10000,
            map: true,
            formData: {
                date: '',
                time: '',
                address: '',
            },
            dateLoading: false,
        }

    },

    mounted() {
        this.flatpickrConfigDate();
        this.flatpickrConfigTime();
        this.initializeInput();
    },

    methods: {

        // Function to google autocomplete
        initializeInput() {
            setTimeout(() => {
                let input = document.getElementById('google_autocomplete');
                let autoComplete = new google.maps.places.Autocomplete(input);
                google.maps.event.addListener(autoComplete, 'place_changed', () => {
                    let place = autoComplete.getPlace();
                })
            }, 500)
        },

        /* Function to set tab */
        setOption(tab){
            this.tab = tab
        },

        /* Function to open payment modal */
        openFilterModal() {
            let modal = new bootstrap.Modal(document.getElementById('filterModal'))
            modal.show();
        },

        /* Function to close payment modal */
        closeFilterModal() {
            const Modal = document.querySelector('#filterModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to update display price */
        updateDisplayPrice() {
            this.displayPrice = this.price
        },

        /* Function to show map or sidebar */
        contentManage() {
            this.map = !this.map
        },

        /* Function to open sort modal */
        openSortModalOpen() {
            let modal = new bootstrap.Modal(document.getElementById('sortModal'))
            modal.show();
        },

        /* Function to close sort modal */
        closeSortModal() {
            const Modal = document.querySelector('#sortModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open maximum price modal */
        openMaximumPriceModal() {
            let modal = new bootstrap.Modal(document.getElementById('maximumPriceModal'))
            modal.show();
        },

        /* Function to close maximum price modal */
        closeMaximumPriceModal() {
            const Modal = document.querySelector('#maximumPriceModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open venue modal */
        openVenueModal() {
            let modal = new bootstrap.Modal(document.getElementById('venueModal'))
            modal.show();
        },

        /* Function to close venue modal */
        closeVenueModal() {
            const Modal = document.querySelector('#venueModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        /* Function to open search modal */
        openSearchModal() {
            let modal = new bootstrap.Modal(document.getElementById('searchContentModal'))
            modal.show();
        },

        /* Function to close search modal */
        closeSearchModal() {
            const Modal = document.querySelector('#searchContentModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        // Function of config date
        flatpickrConfigDate() {
            flatpickr("#date", {
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                disableMobile: true,
            })
        },

        // Function of config time
        flatpickrConfigTime() {
            flatpickr("#time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                defaultDate: "",
                disableMobile: true,
            })
        },

    }

}

</script>
