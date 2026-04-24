<template>
    <div class="report scrollbar">

        <!-- sidebar-nav -->
        <div class="sidebar-nav" :class="{'active' : reportSidebarActive}">
            <div class="report-sidebar-title fw-semibold margin-top-6">
                Reports
            </div>
            <button type="button"
                    class="sidebar-toggler position-absolute d-flex justify-content-center align-items-center"
                    @click="sidebarToggler" :class="{'active' : reportSidebarActive}">
                <img :src="`/images/global/sidebar-chevron.svg`" class="w-20 h-20" alt="chevron">
            </button>
            <a href="javascript:void(0)"
               class="nav-link mb-2 px-3 py-2 d-flex justify-content-between align-items-center"
               :class="{ 'active' : tab === 1 }" @click="setTab(1)">
                <span>
                    <img :src="`../../images/portal/list.svg`" class="w-19 h-19 me-1" alt="icon">
                    All reports
                </span>
                <span class="badge bg-white border text-dark"> {{ allReportCount }} </span>
            </a>
            <a href="javascript:void(0)"
               class="nav-link mb-2 px-3 py-2 d-flex justify-content-between align-items-center"
               :class="{ 'active' : tab === 10 }" @click="setTab(10)">
                <span>
                    <img :src="`../../images/portal/star.svg`" class="w-19 h-19 me-1" alt="icon">
                    Favourites
                </span>
                <span class="badge bg-white border text-dark"> {{ favouritesCount }} </span>
            </a>
            <a href="javascript:void(0)"
               class="nav-link mb-2 px-3 py-2 d-flex justify-content-between align-items-center"
               :class="{ 'active' : tab === 8 }" @click="setTab(8)">
                <span>
                    <img :src="`../../images/portal/bar-analysis.svg`" class="w-19 h-19 me-1" alt="icon">
                    Dashboards
                </span>
                <span class="badge bg-white border text-dark"> 2 </span>
            </a>

            <a href="javascript:void(0)"
               class="nav-link mb-2 px-3 py-2 d-flex justify-content-between align-items-center"
               :class="{ 'active' : tab === 9 }" @click="setTab(9)">
                <span>
                    <img :src="`../../images/portal/standard.svg`" class="w-19 h-19 me-1" alt="icon">
                    Standard
                </span>
                <span class="badge bg-white border text-dark"> {{ allReportCount }} </span>
            </a>

            <a href="javascript:void(0)"
               class="nav-link mb-2 px-3 py-2 d-flex justify-content-between align-items-center disable-feature">
                <span>
                    <img :src="`../../images/portal/target.svg`" class="w-19 h-19 me-1" alt="icon">
                    Targets
                </span>
                <span class="badge bg-white border text-dark"></span>
            </a>
        </div>

        <div class="row justify-content-center px-3 pt-3 report-group-content overflow-y-scroll overflow-x-hidden scrollbar">
            <div class="col-lg-8 mt-3">

                <!-- title -->
                <div class="h3 fw-semibold pt-2">
                    Reporting and analytics
                </div>

                <!-- description -->
                <div class="pb-2 text-secondary text-opacity-75">
                    Access all of your Barberly reports. <a href="javascript:void(0)" class="beauty-text-hover"> Learn
                    more </a>
                </div>

                <div class="mt-3 padding-x-12">
                    <div class="row bg-light py-3 px-0 px-sm-1 rounded-3">
                        <div class="col-xl-6 mb-3 mb-xl-0">
                            <div class="position-relative">
                                <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                    <img :src="`../../images/portal/search.svg`" class="w-20 h-20" alt="search">
                                </div>
                                <input type="text" name="keyword" placeholder="Search here"
                                       class="form-control bg-white ps-5" required>
                            </div>
                        </div>
                        <div class="col-xl-6 d-flex justify-content-end align-items-center">
                            <div class="dropdown me-2 disable-feature">
                                <button class="btn btn-white has-border dropdown-toggle padding-x-12 padding-y-10" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Created By
                                </button>
                                <div class="dropdown-menu dropdown-menu-end p-0 m-0 overflow-hidden">
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Anyone
                                    </button>
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Barberly
                                    </button>
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Me
                                    </button>
                                </div>
                            </div>
                            <div class="dropdown disable-feature">
                                <button class="btn btn-white has-border dropdown-toggle padding-x-12 padding-y-10" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Category
                                </button>
                                <div class="dropdown-menu dropdown-menu-end p-0 m-0 overflow-hidden">
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Category
                                    </button>
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Last Update
                                    </button>
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        A - Z
                                    </button>
                                    <button type="button" class="dropdown-item px-3 py-2">
                                        Z - A
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- categories -->
                <div
                    class="d-md-flex d-none align-items-center justify-content-between justify-content-sm-start flex-wrap mt-3 gap-0 gap-sm-1"
                    :class="{ 'd-none' : tab === 8 || tab === 10 }">
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 1 || tab === 9 }" @click="setTab(1)">
                        All reports
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 2 }" @click="setTab(2)">
                        Sales
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 3 }" @click="setTab(3)">
                        Finance
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 4 }" @click="setTab(4)">
                        Appointment
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 5 }" @click="setTab(5)">
                        Team
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 6 }" @click="setTab(6)">
                        Customers
                    </button>
                    <button type="button" class="btn rounded-pill me-auto me-sm-1 fw-bold border-0 padding-x-12 padding-y-10"
                            :class="{ 'btn-theme' : tab === 7 }" @click="setTab(7)">
                        Inventory
                    </button>
                </div>

                <!--Responsive categories start-->
                <div class="form-group d-md-none mt-3">
                    <select id="" class="form-select" v-model="tab">
                        <option :value="1" @click="setTab(1)">All reports</option>
                        <option :value="2" @click="setTab(2)">Sales</option>
                        <option :value="3" @click="setTab(3)">Finance</option>
                        <option :value="4" @click="setTab(4)">Appointment</option>
                        <option :value="5" @click="setTab(5)">Team</option>
                        <option :value="6" @click="setTab(6)">Customers</option>
                        <option :value="7" @click="setTab(7)">Inventory</option>
                    </select>
                </div>
                <!--Responsive categories end  -->

                <div class="list-content-data mt-3 pt-3 scrollbar">

                    <!-- table data for reports -->
                    <div class="mb-3" v-for="each in filteredTableData" :key="each.id">
                        <div class="border p-3 rounded-3 hover-effect">
                            <div class="d-block d-md-none">
                                <div class="d-flex justify-content-between align-items-center p-3 mb-3">
                                    <img :src="each.iconImage" class="w-30 h-30" :alt="each.filterCategory"/>
                                    <a href="javascript:void(0)" @click="toggleClick(each)">
                                        <img :src="`../../images/portal/star.svg`"
                                             class="w-40 h-40 border-radius-5 btn-hover p-1" v-if="each.status === 1"
                                             alt="icon"/>
                                        <img :src="`../../images/portal/star-golden.svg`"
                                             class="w-40 h-40 border-radius-5 btn-hover p-1" v-if="each.status === 2"
                                             alt="icon"/>
                                    </a>
                                </div>
                            </div>
                            <span class="d-block d-md-flex justify-content-between align-items-center px-2">
                                <router-link :to="{ name: 'ReportDetails', state: each }"
                                             class="text-decoration-none d-flex align-items-center res-content">
                                    <img :src="each.iconImage" class="w-30 h-30 d-none d-md-inline-block"
                                         :alt="each.filterCategory"/>
                                    <span class="px-3">
                                        <span class="fw-bold text-dark d-block">
                                            {{ each.title }}
                                        </span>
                                        <span class="text-secondary">
                                            {{ each.description }}
                                        </span>
                                    </span>
                                </router-link>
                                <a href="javascript:void(0)" @click="toggleClick(each)">
                                    <img :src="`../../images/portal/star.svg`"
                                         class="w-40 h-40 d-none d-md-inline-block btn-hover p-1 border-radius-5"
                                         v-if="each.status === 1" alt="icon"/>
                                    <img :src="`../../images/portal/star-golden.svg`"
                                         class="w-40 h-40 d-none d-md-inline-block btn-hover p-1 border-radius-5"
                                         v-if="each.status === 2" alt="icon"/>
                                </a>
                            </span>
                        </div>
                    </div>

                    <!-- when no data found in favourite reports -->
                    <div
                        class="border d-flex justify-content-center align-items-center flex-column rounded-3 no-data-founded"
                        v-if="favouritesCount === 0 && tab === 10">
                        <div class="text-center">
                            <img :src="`../../images/portal/star-theme.svg`" class="w-45 h-45 mb-3" alt="star">
                            <div class="h4 mb-3 fw-semibold">
                                No favourite reports
                            </div>
                            <div class="h6 text-secondary text-opacity-75">
                                Favourite a report to view here
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</template>

<script>

export default {

    computed: {
        filteredTableData() {
            if (this.tab === 1) {
                return this.tableData;
            } else if (this.tab === 9) {
                return this.tableData;
            } else if (this.tab === 10) {
                return this.tableData.filter((data) => data.status === 2);
            }
            return this.tableData.filter((data) => data.filterCategory === this.getCategoryName());
        },
    },

    data() {

        return {
            favouritesCount: 0,
            allReportCount: 33,
            tab: 1,
            reportSidebarActive: false,
            loading: false,
            tableData: [
                {
                    id: 1,
                    filterCategory: 'dashboard',
                    iconImage: '../../images/portal/bar-analysis-theme.svg',
                    title: 'Performance dashboard',
                    description: 'Dashboard of your business performance',
                    status: 1
                },
                {
                    id: 2,
                    filterCategory: 'dashboard',
                    iconImage: '../../images/portal/bar-analysis-theme.svg',
                    title: 'Online presence dashboard',
                    description: 'Online sales and online client performance',
                    status: 1
                },
                {
                    id: 3,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Sales summary',
                    description: 'Dynamic sales summary with advanced filters and groupings.',
                    status: 1
                },
                {
                    id: 4,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Sales list',
                    description: 'Complete listing of all sales transactions.',
                    status: 1
                },
                {
                    id: 5,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Sales log detail',
                    description: 'In-depth view into each sale transaction.',
                    status: 1
                },
                {
                    id: 6,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Gift card list',
                    description: 'Full list of issued and outstanding gift cards.',
                    status: 1
                },
                {
                    id: 7,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Membership list',
                    description: 'Complete list of active memberships.',
                    status: 1
                },
                {
                    id: 8,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Discount summary',
                    description: 'Overview of discounts granted and their impact on sales.',
                    status: 1
                },
                {
                    id: 9,
                    filterCategory: 'sales',
                    iconImage: '../../images/portal/tag-theme.svg',
                    title: 'Taxes summary',
                    description: 'Summary of all tax-related transactions.',
                    status: 1
                },
                {
                    id: 10,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Finance summary',
                    description: 'High-level summary of sales, payments and liabilities',
                    status: 1
                },
                {
                    id: 11,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Payments summary',
                    description: 'Payments split by payment methods.',
                    status: 1
                },
                {
                    id: 12,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Payment transactions',
                    description: 'Detailed view of all payment transactions.',
                    status: 1
                },
                {
                    id: 13,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Cash flow summary',
                    description: 'Detailed view of all payment transactions.',
                    status: 1
                },
                {
                    id: 14,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Cash flow statement',
                    description: 'Detailed view of all payment transactions.',
                    status: 1
                },
                {
                    id: 15,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Service charges',
                    description: 'Breakdown of service charge revenue.',
                    status: 1
                },
                {
                    id: 16,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Liability summary',
                    description: 'Overview of company liabilities by type.',
                    status: 1
                },
                {
                    id: 17,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Liability activity',
                    description: 'Detailed view of liability-related transactions.',
                    status: 1
                },
                {
                    id: 18,
                    filterCategory: 'finance',
                    iconImage: '../../images/portal/money-theme.svg',
                    title: 'Deposit list',
                    description: 'Complete record of all deposits.',
                    status: 1
                },
                {
                    id: 19,
                    filterCategory: 'appointment',
                    iconImage: '../../images/portal/calendar-report-theme.svg',
                    title: 'Appointments summary',
                    description: 'General overview of appointment trends and patterns, including cancellations and no-shows.',
                    status: 1
                },
                {
                    id: 20,
                    filterCategory: 'appointment',
                    iconImage: '../../images/portal/calendar-report-theme.svg',
                    title: 'Appointments list',
                    description: 'Full list of scheduled appointments.',
                    status: 1
                },
                {
                    id: 21,
                    filterCategory: 'appointment',
                    iconImage: '../../images/portal/calendar-report-theme.svg',
                    title: 'Appointments cancellations & no-show summary',
                    description: 'Insight into appointment cancellations and no-shows.',
                    status: 1
                },
                {
                    id: 22,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Working hours summary',
                    description: 'Overview of operational hours and productivity.',
                    status: 1
                },
                {
                    id: 23,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Team time off report',
                    description: 'Detailed view of team time off.',
                    status: 1
                },
                {
                    id: 24,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Tips summary',
                    description: 'Analysis of gratuity income.',
                    status: 1
                },
                {
                    id: 25,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Tips detail',
                    description: 'Comprehensive breakdown of all tips received.',
                    status: 1
                },
                {
                    id: 26,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Commission detailed',
                    description: 'Full list of all sales with commissions payable.',
                    status: 1
                },
                {
                    id: 27,
                    filterCategory: 'team',
                    iconImage: '../../images/portal/team-theme.svg',
                    title: 'Commission summary',
                    description: 'Summary of commissions grouped by item and team member.',
                    status: 1
                },
                {
                    id: 28,
                    filterCategory: 'customer',
                    iconImage: '../../images/portal/face-theme.svg',
                    title: 'Customer list',
                    description: 'Comprehensive list of all active customers.',
                    status: 1
                },
                {
                    id: 29,
                    filterCategory: 'inventory',
                    iconImage: '../../images/portal/product-theme.svg',
                    title: 'Stock on hand',
                    description: 'Current status and quantity of stock items.',
                    status: 1
                },
                {
                    id: 30,
                    filterCategory: 'inventory',
                    iconImage: '../../images/portal/product-theme.svg',
                    title: 'Stock movement summary',
                    description: 'Summary of stock inflow and outflow.',
                    status: 1
                },
                {
                    id: 31,
                    filterCategory: 'inventory',
                    iconImage: '../../images/portal/product-theme.svg',
                    title: 'Stock movement log',
                    description: 'Detailed record of all stock movements.',
                    status: 1
                },
                {
                    id: 32,
                    filterCategory: 'inventory',
                    iconImage: '../../images/portal/product-theme.svg',
                    title: 'Product list',
                    description: 'Comprehensive list of all products.',
                    status: 1
                },
                {
                    id: 33,
                    filterCategory: 'inventory',
                    iconImage: '../../images/portal/product-theme.svg',
                    title: 'Ordered stock',
                    description: 'Detailed record of all stock orders.',
                    status: 1
                },
            ]
        }

    },

    mounted() {

    },

    methods: {
        setTab(tab) {
            this.tab = tab;
        },

        toggleClick(data) {
            if (data.status === 1) {
                this.favouritesCount++;
            } else if (data.status === 2) {
                this.favouritesCount--;
            }
            data.status = data.status === 1 ? 2 : 1;
        },

        getCategoryName() {
            switch (this.tab) {
                case 1:
                    return this.tableData;
                case 2:
                    return 'sales';
                case 3:
                    return 'finance';
                case 4:
                    return 'appointment';
                case 5:
                    return 'team';
                case 6:
                    return 'customer';
                case 7:
                    return 'inventory';
                case 8:
                    return 'dashboard';
                default:
                    return this.tableData;
            }
        },

        sidebarToggler() {
            this.reportSidebarActive = !this.reportSidebarActive;
        },

    }

}

</script>
