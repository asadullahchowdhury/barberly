<template>
    <div class="sales">
        <div class="page-wrap">

            <!-- customers start-->
            <div class="customers">
                <div class="heading">
                    <div class="title">Customer</div>
                    <div class="search-icon">
                        <img :src="`/images/portal/search.svg`" alt="search">
                    </div>
                </div>
                <div class="content">
                    <a href="javascript:void(0)" class="walk-in-btn">
                        <div class="icon">
                            <img :src="`/images/portal/walk-in-service.svg`" alt="walk in service">
                        </div>
                        <div class="title">Walk In Service</div>
                    </a>
                    <div class="customer-list">
                        <table>
                            <tbody>
                            <tr @click="isCustomer = true" v-for="each in [1,2,3]">
                                <td class="avatar">
                                    <img
                                        :src="`https://ui-avatars.com/api/?background=4ac1c040&color=4AC1C0&font-size=0.30&bold=true&rounded=true&name=Omar Farida`"
                                        alt="user avatar">
                                </td>
                                <td>
                                    <div class="name text-ellipsis">John Smith</div>
                                </td>
                                <td class="text-end">
                                    <div class="number text-ellipsis">052 0364 3369</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- customers end-->

            <!-- services start-->
            <div class="services">
                <div class="heading">
                    <div class="tabs d-flex align-items-center">
                        <button class="btn-sm active" @click="tabChange">Product</button>
                        <button class="btn-sm" @click="tabChange">Service</button>
                    </div>
                    <div class="search-icon">
                        <img :src="`/images/portal/search.svg`" alt="search">
                    </div>
                </div>
                <div class="content">
                    <div class="service-list">
                        <table>
                            <tbody>
                            <tr @click="addSales">
                                <td>
                                    <div class="name">Bedhead Blond</div>
                                </td>
                                <td>
                                    <div class="amount">1000ml</div>
                                </td>
                                <td>
                                    <div class="price">90AED</div>
                                </td>
                                <td>
                                    <div class="new">
                                        <img :src="`/images/portal/plus.svg`" alt="plus">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="divider">
                                    <div class="h-10"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- services start-->

            <!-- sales details start-->
            <div class="sales-details">
                <div class="heading" :class="isCustomer === false ? 'hide' : ''">
                    <div class="avatar">JS</div>
                    <div class="name">John Smith</div>
                    <div class="number">052 0364 3369</div>
                    <div class="email">jsmith@gmail.com</div>
                </div>
                <div class="content">
                    <div v-if="isCustomer" class="h-full">
                        <div class="sales-details-list">
                            <table>
                                <thead>
                                <tr>
                                    <th class="text-start">Item</th>
                                    <th></th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end padding-right-15">Price</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="sales.length > 0" v-for="(each, index) in sales">
                                    <tr>
                                        <td>
                                            <div class="title">Bedhead Blond</div>
                                            <div class="sub-title">SKU: BED-51037</div>
                                        </td>
                                        <td class="user">
                                            <div class="d-flex align-items-center">
                                                <img :src="`/images/portal/user-rect.svg`" alt="user icon"
                                                     class="user-icon">
                                                <span class="name">Omar Ferada</span>
                                                <img :src="`/images/portal/arrow-down-theme.svg`" alt="arrow down">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-between qty">
                                                <a href="javascript:void(0)">
                                                    <img :src="`/images/portal/minus.svg`" alt="minus icon"
                                                         class="decrement">
                                                </a>
                                                <span>2</span>
                                                <a href="javascript:void(0)">
                                                    <img :src="`/images/portal/plus.svg`" alt="plus icon"
                                                         class="increment">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="price">100AED</div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" class="delete">
                                                <img :src="`/images/portal/delete.svg`" alt="delete icon">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="divider">
                                            <div class="h-10"></div>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="payment">
                            <div class="modal-buttons">
                                <button class="btn-item btn-add-service-charge" @click="openServiceChargeModal">Add
                                    Service Charge
                                </button>

                                <button class="btn-item btn-tips" @click="openTipsModal">Tips</button>

                                <button class="btn-item btn-note" @click="openNoteModal">Note</button>

                                <button class="btn-item btn-discount" @click="openDiscountModal">Add Discount</button>
                            </div>
                            <div class="payment-details">
                                <div class="d-flex align-items-center justify-content-between mb-20">
                                    <div class="title">Subtotal</div>
                                    <div class="price">{{ subTotal }} AED</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-20">
                                    <div class="title">Tax</div>
                                    <div class="price">{{ tax }} AED</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-20">
                                    <div class="title">Total</div>
                                    <div class="price">{{ total }} AED</div>
                                </div>
                                <div class="charge-btn">
                                    <button type="button" class="btn-theme">Charge</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--no data text start-->
                    <div class="d-flex justify-content-center flex-column gap-20 align-items-center no-data"
                         v-if="!isCustomer">
                        <div class="icon">
                            <img :src="`/images/global/no-task.png`" alt="no data">
                        </div>

                        <div class="font-size-30 font-weight-300 text-lighter">Empty List</div>
                    </div>
                    <!--no data text end  -->

                </div>
            </div>
            <!-- sales details end-->
        </div>

        <!--responsive-->
        <div class="page-wrap-responsive">
            <div class="page-header-responsive text-center">
                <div class="heading" @click="tab = 'customer'" :class="{'active' : tab === 'customer'}">Customer</div>

                <div class="heading" @click="tab = 'service'" :class="{'active' : tab === 'service'}">Service</div>

                <div class="heading" @click="tab = 'selected'" :class="{'active' : tab === 'selected'}">Selected</div>
            </div>

            <!--page content tab start-->
            <div class="page-content-tab padding-25">

                <!--customer tab start -->
                <div class="customer-tab-content" v-if="tab === 'customer'">

                    <!--search input start-->
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="search-icon">
                            <img :src="`/images/global/search.svg`" alt="search">
                        </div>
                    </div>
                    <!--search input end  -->

                    <!--walk in button-->
                    <a href="javascript:void(0)" class="walk-in-btn">
                        <div class="icon">
                            <img :src="`/images/portal/walk-in-service.svg`" alt="walk in service">
                        </div>
                        <div class="title">Walk In Service</div>
                    </a>

                    <!--customer list start-->
                    <div class="customer-list">
                        <table>
                            <tbody>
                            <tr @click="isCustomer = true" v-for="each in [1,2,3]">
                                <td class="avatar">
                                    <img
                                        :src="`https://ui-avatars.com/api/?background=4ac1c040&color=4AC1C0&font-size=0.30&bold=true&rounded=true&name=Omar Farida`"
                                        alt="user avatar">
                                </td>
                                <td>
                                    <div class="name text-ellipsis">John Smith</div>
                                </td>
                                <td class="text-end">
                                    <div class="number text-ellipsis">052 0364 3369</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--customer list end-->

                </div>
                <!--customer tab end -->


                <!--service tab start-->
                <div class="service-tab-content" v-if="tab === 'service'">

                    <!--search input start-->
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="search-icon">
                            <img :src="`/images/global/search.svg`" alt="search">
                        </div>
                    </div>
                    <!--search input end  -->

                    <!--service list start-->
                    <div class="service-list margin-top-10">
                        <table>
                            <tbody>
                            <tr @click="addSales" v-for="each in [1,2,3]">
                                <td>
                                    <div class="font-weight-700 name">Bedhead Blond</div>
                                </td>
                                <td class="amount">
                                    <div>1000ml</div>
                                </td>
                                <td class="price">
                                    <div class="font-weight-700">90AED</div>
                                </td>
                                <td>
                                    <div class="new">
                                        <img :src="`/images/portal/plus.svg`" alt="plus">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="divider">
                                    <div class="h-10"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--service list end  -->

                </div>
                <!--service tab end  -->

                <!--selected tab start-->
                <div class="selected-tab-content" v-if="tab === 'selected'">

                    <!--no data text start-->
                    <div class="d-flex justify-content-center flex-column gap-20 align-items-center no-data">
                        <div class="icon">
                            <img :src="`/images/global/no-task.png`" alt="no data">
                        </div>

                        <div class="font-size-30 font-weight-300 text-lighter">Empty List</div>
                    </div>
                    <!--no data text end  -->
                </div>
                <!--selected tab end  -->

            </div>
            <!--page content tab end  -->

        </div>

        <!--Service Charge modal start-->
        <div class="modal service-charge-modal modal-lg fade" id="serviceChargeModal" data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="serviceChargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header p-md-4">
                        <h1 class="modal-title fs-4 fw-normal" id="serviceChargeModalLabel">Service Charge</h1>
                        <button type="button" class="btn btn-theme w-153" @click="hideServiceChargeModal">Save</button>
                    </div>
                    <div class="modal-body py-md-4 px-md-5">
                        <div class="form-group mb-5">
                            <label for="description" class="form-label mb-3">Description</label>
                            <input type="text" class="form-control shadow-none" id="description">
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount" class="form-label mb-3">Amount</label>
                            <div class="amount-field">
                                <input type="text" class="form-control shadow-none" id="amount">
                                <span class="currency">AED</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0 d-md-flex d-none"></div>
                </div>
            </div>
        </div>
        <!--Service Charge modal end  -->


        <!--Tips modal start-->
        <div class="modal tips-modal modal-lg fade" id="tipsModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="tipsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header p-md-4">
                        <h1 class="modal-title fs-4 fw-normal" id="tipsModalLabel">Tips</h1>
                        <button type="button" class="btn btn-theme w-153" @click="hideTipsModal">Save</button>
                    </div>
                    <div class="modal-body py-md-4 px-md-5">
                        <div class="form-group mb-5">
                            <label for="staff" class="form-label">Staff</label>
                            <select name="staff" class="form-control shadow-none">
                                <option value="">Select</option>
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label for="percentage" class="form-label">Percentage</label>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="percentage">5%</div>
                                <div class="percentage">10%</div>
                                <div class="percentage">25%</div>
                                <div class="percentage">50%</div>
                                <div class="percentage">100%</div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <div class="amount-field">
                                <input type="text" class="form-control shadow-none" id="amount">
                                <span class="currency">AED</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0 d-md-flex d-none"></div>
                </div>
            </div>
        </div>
        <!--Tips modal end  -->


        <!--Note modal start-->
        <div class="modal note-modal modal-lg fade" id="noteModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="noteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header p-md-4">
                        <h1 class="modal-title fs-4 fw-normal" id="noteModalLabel">Note</h1>
                        <button type="button" class="btn btn-theme w-153" @click="hideNoteModal">Save</button>
                    </div>
                    <div class="modal-body py-md-4 px-md-5">
                        <div class="form-group mb-5">
                            <label for="description" class="form-label mb-3">Description</label>
                            <textarea class="form-control shadow-none h-200" name="" id="" cols="30"
                                      rows="10"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer border-0 d-md-flex d-none"></div>
                </div>
            </div>
        </div>
        <!--Note modal end  -->


        <!--Discount modal start-->
        <div class="modal discount-modal modal-lg fade" id="discountModal" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="discountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header p-md-4">
                        <h1 class="modal-title fs-4 fw-normal" id="discountModalLabel">Discount</h1>
                        <button type="button" class="btn btn-theme w-153" @click="hideDiscountModal">Save</button>
                    </div>
                    <div class="modal-body py-md-4 px-md-5">

                        <div class="form-group mb-5">
                            <label for="percentage" class="form-label">Percentage</label>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="percentage">5%</div>
                                <div class="percentage">10%</div>
                                <div class="percentage">25%</div>
                                <div class="percentage">50%</div>
                                <div class="percentage">100%</div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <div class="amount-field">
                                <input type="text" class="form-control shadow-none" id="amount">
                                <span class="currency">AED</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-0 d-md-flex d-none"></div>
                </div>
            </div>
        </div>
        <!--Discount modal end  -->


    </div>
</template>

<script>
export default {
    data() {
        return {
            sales: [],
            isCustomer: false,
            subTotal: 0,
            tax: 0,
            total: 0,
            tab: 'customer',
        }
    },

    methods: {
        tabChange(e) {
            const buttons = e.target.closest('.tabs').querySelectorAll('.btn-sm');
            buttons.forEach(btn => {
                if (e.target !== btn) {
                    btn.classList.remove('active')
                } else {
                    btn.classList.add('active')
                }
            })
        },

        addSales() {
            this.sales.push('');
        },


        // Service Charge Modal
        openServiceChargeModal() {
            let modal = new bootstrap.Modal(document.getElementById('serviceChargeModal'))
            modal.show();
        },

        hideServiceChargeModal() {
            const Modal = document.querySelector('#serviceChargeModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        // Tips Modal
        openTipsModal() {
            let modal = new bootstrap.Modal(document.getElementById('tipsModal'))
            modal.show();
        },

        hideTipsModal() {
            const Modal = document.querySelector('#tipsModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },


        // Tips Modal
        openNoteModal() {
            let modal = new bootstrap.Modal(document.getElementById('noteModal'))
            modal.show();
        },

        hideNoteModal() {
            const Modal = document.querySelector('#noteModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },


        // Discount Modal
        openDiscountModal() {
            let modal = new bootstrap.Modal(document.getElementById('discountModal'))
            modal.show();
        },

        hideDiscountModal() {
            const Modal = document.querySelector('#discountModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },
    },

    mounted() {
    }
}
</script>
