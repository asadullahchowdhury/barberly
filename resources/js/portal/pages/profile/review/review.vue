<template>

        <div class="card-content">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <div class="card-title">
                    Reviews
                    <div class="card-sub-title padding-top-10">
                        See star ratings and reviews left by clients after their visit.
                        <a href="javascript:void(0)" class="margin-left-10 text-decoration-none text-theme"> Learn more</a>
                    </div>
                </div>
                <button type="button" class="btn btn-theme manage-profile-model padding-x-20 padding-y-10 margin-md-top-0 margin-top-20" @click="openFilterModal">
                    <span class="d-flex align-items-center font-weight-700">
                        <span class="margin-right-10">Filter</span>
                        <img :src="`/images/portal/filter.svg`" class="w-24 h-24" alt="filter">
                    </span>
                </button>
            </div>

            <div class="padding-y-40 text-center">
                <div class="padding-y-10 font-weight-600">
                    No reviews yet
                </div>
                Collecting authentic reviews is a proven way to gain new clients. Reply to reviews to grow relationships, showing clients you care about their feedback.
            </div>
        </div>


<!--review modal start-->
    <div class="modal fade" id="filterModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 px-md-4 pt-md-4">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Filter</h1>
                    <button type="button" class="btn-close" @click="hideFilterModal" aria-label="Close"></button>
                </div>
                <form >
                    <div class="modal-body px-md-4">

                        <div class="form-group mb-3">
                            <label for="workshop" class="form-label">Workshops</label>
                            <select name="workshop" id="workshop" class="form-select padding-x-18">
                                <option value="0">All workshop</option>
                                <option value="1">berber_io_mojo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="d-flex flex-wrap justify-content-between">
                                <input type="button" class="btn-rating margin-bottom-16" value="All" @click="ratingControl($event)" />
                                <input type="button" class="btn-rating margin-bottom-16" value="5 Stars" @click="ratingControl($event)" />
                                <input type="button" class="btn-rating margin-bottom-16" value="4 Stars" @click="ratingControl($event)" />
                                <input type="button" class="btn-rating margin-bottom-16" value="3 Stars" @click="ratingControl($event)" />
                                <input type="button" class="btn-rating margin-bottom-16" value="2 Stars" @click="ratingControl($event)" />
                                <input type="button" class="btn-rating margin-bottom-16" value="1 Stars" @click="ratingControl($event)" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between border-0 px-md-4 pb-md-4">
                        <a href="javascript:void(0)" class="text-decoration-none text-theme">
                            Clear all filters
                        </a>
                        <div class="d-flex">
                            <button type="button" @click="hideFilterModal" class="btn d-sm-inline d-none btn-outline-dark border-radius-10 w-110 margin-right-10">
                                Cancel
                            </button>
                            <button type="button" class="btn btn-theme w-110">Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--review modal end  -->

</template>

<script>

export default {

    data(){

        return{
            reviewModal: false,
        }

    },

    mounted() {

    },

    methods: {

        // this handler manage modal inside function

        handleBackDropClick(){
            event.stopPropagation();
        },

        // manage profile modal

        reviewFilterModal() {
            this.reviewModal = !this.reviewModal;
        },


        openFilterModal(){
            let modal = new bootstrap.Modal(document.getElementById('filterModal'))
            modal.show();
        },

        hideFilterModal(){
            const Modal = document.querySelector('#filterModal');
            const Instance = bootstrap.Modal.getInstance(Modal);
            Instance.hide();
        },

        // this check input work as button checked to add border

        ratingControl(e) {
            const buttonChecks = document.querySelectorAll('.btn-rating');
            buttonChecks.forEach(btn => {
                if(btn !== e.target){
                    btn.classList.remove('active')
                }else{
                    btn.classList.add('active')
                }

            })
        },

    }

}

</script>
