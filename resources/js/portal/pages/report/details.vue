<template>

    <div class="report">

        <div class="p-3 p-sm-5 details-page-content">
            <div class="d-flex align-items-center justify-content-start flex-wrap">
                <router-link :to="{name: 'ReportGroup'}" class="btn btn-white has-border rounded-pill px-4">
                    <span class="arrow-icon">
                        <span class="arrow-icon-black">
                            <img :src="`../../images/portal/arrow-left.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                        </span>
                        <span class="arrow-icon-white">
                            <img :src="`../../images/portal/arrow-left-white.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                        </span>
                    </span>
                    Back
                </router-link>
                <a href="javascript:void(0)" class="text-theme disable-feature text-decoration-none mx-2 mt-2 mt-sm-0">
                    All reports
                </a>
                .
                <a href="javascript:void(0)" class="text-secondary disable-feature text-decoration-none mx-2 mt-2 mt-sm-0">
                    {{detailsParam.title}}
                </a>
            </div>

            <div class="h3 fw-semibold pt-2 d-flex justify-content-start align-items-center mt-2">
                {{detailsParam.title}}
                <span class="btn btn-hover ms-2 px-2 py-1 d-none d-sm-inline-block">
                    <img :src="`../../images/portal/star.svg`" class="w-24 h-24" alt="icon" v-if="detailsParam.status === 1">
                    <img :src="`../../images/portal/star-golden.svg`" class="w-24 h-24" alt="icon" v-if="detailsParam.status === 2">
                </span>
            </div>

            <div class="pb-2 text-secondary text-opacity-75">
                {{detailsParam.description}}
            </div>

            <div class="p-3 bg-light mt-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center flex-wrap gap-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-white btn-anchor has-border rounded-pill px-3" data-bs-toggle="dropdown" aria-expanded="false">
                                Month to date
                                <span class="arrow-icon">
                                    <span class="arrow-icon-black modal-open-btn">
                                        <img :src="`../../images/portal/calendar-report-black.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                                    </span>
                                    <span class="arrow-icon-white modal-open-btn">
                                        <img :src="`../../images/portal/calendar-report-white.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-date-custom p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="date-range" class="form-label">Date Range</label>
                                            <select name="" class="form-select">
                                                <option value="">Today</option>
                                                <option value="">Yesterday</option>
                                                <option value="">Last 7 days</option>
                                                <option value="">Last 30 days</option>
                                                <option value="">Last 90 days</option>
                                                <option value="">Last week</option>
                                                <option value="">Last month</option>
                                                <option value="">Last 3 month</option>
                                                <option value="">Last 6 month</option>
                                                <option value="">Week to date</option>
                                                <option value="">Month to date</option>
                                                <option value="">Quarter to date</option>
                                                <option value="">Year to date</option>
                                                <option value="">All Time</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="startDate" class="form-label">Starting</label>
                                            <input id="startDate" type="text" name="startDate" class="form-control" v-model="formData.startDate" placeholder="Enter Start Date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="endDate" class="form-label">Ending</label>
                                            <input id="endDate" type="text" name="endDate" class="form-control" v-model="formData.endDate" placeholder="Enter End Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-sm-end align-items-center mt-3">
                                    <button type="button" class="btn btn-white btn-anchor border-radius-10 w-25 has-border me-2">Close</button>
                                    <button type="button" class="btn btn-theme border-radius-10 w-25">Apply</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-white btn-anchor has-border rounded-pill px-3 mt-2 mt-sm-0" @click="openCompareModal">
                            <span class="d-none d-sm-inline-block me-2"> Compare to: </span> 31 Oct - 18 Nov 2023
                        </button>
                        <button type="button" class="btn btn-white btn-anchor has-border rounded-pill px-3 mt-2 mt-sm-0" @click="openFilterModal">
                            Filters
                            <span class="arrow-icon">
                                <span class="arrow-icon-black modal-open-btn">
                                    <img :src="`../../images/portal/filter-black.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                                </span>
                                <span class="arrow-icon-white modal-open-btn">
                                    <img :src="`../../images/portal/filter-white.svg`" class="img-fluid w-15 h-15 me-1" alt="arrow-left">
                                </span>
                            </span>
                        </button>
                    </div>

                    <span class="text-secondary mt-2 mt-sm-0">
                        Last updated 13:00
                    </span>

                </div>
            </div>

            <div class="row">
                <div class="col-xxl-4 col-xl-6 p-3">
                    <div class="p-3 border rounded-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="fw-semibold">Total sales</div>
                            <img :src="`../../images/portal/warning-circle.svg`" class="w-21 h-21" alt="exclamation">
                        </div>
                        <div class="mb-3">
                            <img :src="`../../images/portal/up-down-arrow.svg`" class="w-21 h-21" alt="up-down-arrow">
                            <span class="mx-2"> 0% </span> vs comp period
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="padding-left-16 mw-220">Services</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-220">Products</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-220">No shows</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-220">Cancellations</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-220">Memberships</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-220">Shipping</td>
                                    <td class="max-100px">BDT 0.00</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-6 p-3">
                    <div class="p-3 border rounded-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span class="d-flex justify-content-start align-items-center'">
                                Total sales over time
                                <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-21 h-21" alt="exclamation">
                            </span>
                            <a href="javascript:void(0)" class="text-theme text-decoration-none">View report</a>
                        </div>
                        <div class="chart-box" style="height: 430px"></div>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                    <div class="p-3">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-3">Average sale value</div>
                            <div class="fw-bold h3 mb-3"> BDT 0.00 </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge bg-light text-dark">
                                    <img :src="`../../images/portal/up-down-arrow.svg`" class="w-18 h-18" alt="up-down-arrow">
                                    <span class="mx-2"> 0% </span>
                                </span>
                                <span class="ms-2">
                                    vs comp period
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-3">Online sales</div>
                            <div class="fw-bold h3 mb-3"> BDT 0.00 </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge bg-light text-dark">
                                    <img :src="`../../images/portal/up-down-arrow.svg`" class="w-18 h-18" alt="up-down-arrow">
                                    <span class="mx-2"> 0% </span>
                                </span>
                                <span class="ms-2">
                                    vs comp period
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-3">Appointments</div>
                            <div class="fw-bold h3 mb-3"> 0 </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge bg-light text-dark">
                                    <img :src="`../../images/portal/up-down-arrow.svg`" class="w-18 h-18" alt="up-down-arrow">
                                    <span class="mx-2"> 0% </span>
                                </span>
                                <span class="ms-2">
                                    vs comp period
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-3">Occupancy rate</div>
                            <div class="fw-bold h3 mb-3"> 0% </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge bg-light text-dark">
                                    <img :src="`../../images/portal/up-down-arrow.svg`" class="w-18 h-18" alt="up-down-arrow">
                                    <span class="mx-2"> 0% </span>
                                </span>
                                <span class="ms-2">
                                    vs comp period
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="p-3 border rounded-3">
                            <div class="fw-semibold mb-3">Returning client rate</div>
                            <div class="fw-bold h3 mb-3"> 0% </div>
                            <div class="d-flex justify-content-start">
                                <span class="badge bg-light text-dark">
                                    <img :src="`../../images/portal/up-down-arrow.svg`" class="w-18 h-18" alt="up-down-arrow">
                                    <span class="mx-2"> 0% </span>
                                </span>
                                <span class="ms-2">
                                    vs comp period
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="row border p-3 rounded-3">
                    <div class="d-flex justify-content-between flex-wrap mb-3">
                        <div class="fw-semibold mb-3 d-flex align-items-center">
                            Sales by channel
                            <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                        </div>
                        <a href="javascript:void(0)" class="text-decoration-none text-theme">View report</a>
                    </div>
                    <div class="col-xxl-6">
                        <div class="fw-bold h3 mb-3">
                            BDT 0.00
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                    <span class="d-flex justify-content-start align-items-center">
                                        <span class="bg-info rounded-circle w-10 h-10 me-2"></span> Barberly marketplace
                                    </span>
                                    </td>
                                    <td class="max-100px mw-100">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                    <span class="d-flex justify-content-start align-items-center">
                                        <span class="bg-primary rounded-circle w-10 h-10 me-2"></span> Book now link
                                    </span>
                                    </td>
                                    <td class="max-100px mw-100">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                    <span class="d-flex justify-content-start align-items-center">
                                        <span class="bg-danger rounded-circle w-10 h-10 me-2"></span> Social
                                    </span>
                                    </td>
                                    <td class="max-100px mw-100">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                    <span class="d-flex justify-content-start align-items-center">
                                        <span class="bg-warning rounded-circle w-10 h-10 me-2"></span> Marketing
                                    </span>
                                    </td>
                                    <td class="max-100px mw-100">BDT 0.00</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                    <span class="d-flex justify-content-start align-items-center">
                                        <span class="bg-secondary rounded-circle w-10 h-10 me-2"></span> Offline
                                    </span>
                                    </td>
                                    <td class="max-100px mw-100">BDT 0.00</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    <div class="col-xxl-6"></div>
                </div>
            </div>

            <div class="p-3">
                <div class="row border p-3 rounded-3">
                    <div class="d-flex justify-content-between flex-wrap mb-3">
                        <div class="fw-semibold mb-3 d-flex align-items-center">
                            Appointments
                            <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                        </div>
                        <a href="javascript:void(0)" class="text-decoration-none text-theme">View report</a>
                    </div>
                    <div class="col-xxl-4 col-xl-6">
                        <div class="fw-bold h3 mb-3">
                            0
                        </div>
                        <div class="mb-3">
                            <img :src="`../../images/portal/up-down-arrow.svg`" class="w-21 h-21" alt="up-down-arrow">
                            <span class="mx-2"> 0% </span> vs comp period
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                        Completed
                                    </td>
                                    <td class="max-100px mw-100">0</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                        Not completed
                                    </td>
                                    <td class="max-100px mw-100">0</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                        No shows
                                    </td>
                                    <td class="max-100px mw-100">0</td>
                                </tr>
                                <tr>
                                    <td class="padding-left-16 mw-250">
                                        Cancelled
                                    </td>
                                    <td class="max-100px mw-100">0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-6">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 p-3">
                    <div class="border p-3 rounded-3">
                        <div class="d-flex justify-content-between mb-3 flex-wrap">
                            <div class="fw-semibold mb-3 d-flex align-items-center">
                                Occupancy rate
                                <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                            </div>
                            <a href="javascript:void(0)" class="text-decoration-none text-theme">
                                View report
                            </a>
                        </div>
                        <div class="border-top">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="padding-left-16 mw-200">Working hours</td>
                                                <td class="text-end padding-right-16 mw-200">
                                                    129h 0m
                                                    <span class="ms-2 badge bg-danger-subtle text-danger">
                                                        <img :src="`../../images/portal/arrow-danger-down.svg`" class="w-15" alt="arrow-danger-down">
                                                        12.2%
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="padding-left-16 mw-200">Unbooked hours</td>
                                                <td class="text-end padding-right-16 mw-200">
                                                    129h 0m
                                                    <span class="ms-2 badge bg-danger-subtle text-danger">
                                                        <img :src="`../../images/portal/arrow-danger-down.svg`" class="w-15" alt="arrow-danger-down">
                                                        12.2%
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="padding-left-16 mw-200">Booked hours</td>
                                                <td class="text-end padding-right-16 mw-200">
                                                    0h 0m
                                                    <span class="ms-2 badge bg-secondary-subtle text-secondary">
                                                        <img :src="`../../images/portal/up-down-arrow.svg`" class="w-15" alt="arrow-up-down">
                                                        0%
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 p-3">
                    <div class="border p-3 rounded-3">
                        <div class="d-flex justify-content-between flex-wrap mb-3">
                            <div class="fw-semibold mb-3 d-flex align-items-center">
                                Returning customer rate
                                <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                            </div>
                            <a href="javascript:void(0)" class="text-decoration-none text-theme">
                                View report
                            </a>
                        </div>
                        <div class="border-top">
                            <div class="p-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td class="padding-left-16 mw-200">New customers</td>
                                            <td class="text-end padding-right-16 mw-100 max-100px">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="padding-left-16 mw-200">Returning customers</td>
                                            <td class="text-end padding-right-16 mw-100 max-100px">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="padding-left-16 mw-200">Walk ins</td>
                                            <td class="text-end padding-right-16 mw-100 max-100px">
                                                0
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3 border rounded-3">
                <div class="d-flex justify-content-between flex-wrap mb-3">
                    <div class="fw-semibold mb-3 d-flex align-items-center px-2">
                        Top 5 team members
                        <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                    </div>
                    <a href="javascript:void(0)" class="text-decoration-none text-theme">
                        View report
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="mw-250 text-truncate">Team member</th>
                                <th class="mw-250 text-truncate">Sales</th>
                                <th class="mw-250 text-truncate">Occupancy</th>
                                <th class="mw-250 text-truncate">% returning clients</th>
                                <th class="mw-250 text-truncate">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
    <!--                        <tr>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                        </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-3 border rounded-3 mt-3">
                <div class="d-flex justify-content-between flex-wrap mb-3">
                    <div class="fw-semibold mb-3 d-flex align-items-center px-2">
                        Bottom 5 team members
                        <img :src="`../../images/portal/warning-circle.svg`" class="ms-2 w-17 h-17" alt="exclamation">
                    </div>
                    <a href="javascript:void(0)" class="text-decoration-none text-theme">
                        View report
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="mw-250 text-truncate">Team member</th>
                                <th class="mw-250 text-truncate">Sales</th>
                                <th class="mw-250 text-truncate">Occupancy</th>
                                <th class="mw-250 text-truncate">% returning clients</th>
                                <th class="mw-250 text-truncate">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
    <!--                        <tr>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                            <td></td>-->
    <!--                        </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- Compare Modal -->
    <div class="modal fade" id="compareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Compare to</h1>
                    <button type="button" class="btn-close" @click="closeCompareModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <select name="compare" class="form-select">
                            <option value="previous-month">Previous month</option>
                            <option value="previous-year">Previous Year</option>
                            <option value="no-comparison">No Comparison</option>
                        </select>
                    </div>
                    <span class="text-secondary text-opacity-75">
                        Compare to:
                            <span> 31 Oct - 18 Nov 2023 </span>
                            <span class="d-none"> 1 Dec - 18 Dec 2022 </span>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white btn-anchor border-radius-10 w-25 has-border" @click="closeCompareModal">Close</button>
                    <button type="button" class="btn btn-theme border-radius-10 w-25">Apply</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Filters</h1>
                    <button type="button" class="btn-close" @click="closeFilterModal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="location" class="form-label">location</label>
                        <select id="location" name="location" class="form-select">
                            <option value="">All location</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="team-member" class="form-label">Team member</label>
                        <select id="team-member" name="team-member" class="form-select">
                            <option value="">All team member</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white btn-anchor border-radius-10 w-25 has-border" @click="closeFilterModal">Close</button>
                    <button type="button" class="btn btn-theme border-radius-10 w-25">Apply</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


export default {

    data(){

        return{
            formData: {
                startDate: '',
                endDate: '',
            },
            dateLoading: false,
            detailsParam: {
                title: '',
                description: '',
                status: '',
            }
        }

    },

    mounted() {

        flatpickr("#startDate", {
            altFormat: 'M j, Y',
            altInput: true,
            dateFormat: 'Y-m-d',
            disableMobile: true,
            inline: true,
            responsive: true
        })

        flatpickr("#endDate", {
            altFormat: 'M j, Y',
            altInput: true,
            dateFormat: 'Y-m-d',
            disableMobile: true,
            inline: true,
            responsive: true
        })

        this.dateLoading = true
        this.detailsParam = window.history.state

    },

    methods: {

        openCompareModal(){
            const myModal = new bootstrap.Modal( "#compareModal", { keyboard: false } );
            myModal.show();
        },

        closeCompareModal(){
            let myModalEl = document.getElementById('compareModal');
            let modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();
        },

        openFilterModal(){
            const myModal = new bootstrap.Modal( "#filterModal", { keyboard: false } );
            myModal.show();
        },

        closeFilterModal(){
            let myModalEl = document.getElementById('filterModal');
            let modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();
        },

    }

}

</script>
