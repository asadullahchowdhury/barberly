<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col-11 col-sm-10 col-md-8 p-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <img :src="`/images/portal/arrow-left.svg`" class="w-23 h-23" alt="arrow-left">
                        <div class="h3 mx-3">COVID 19</div>
                        <span class="badge bg-warning-subtle text-warning px-3">
                            InActive
                        </span>
                    </div>
                    Created on 29 Oct 2023
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <div class="customer-dropdown d-flex justify-content-end margin-right-10">
                        <a href="javascript:void(0)" @click="dropdown($event)" class="btn btn-theme btn-anchor">
                            options
                        </a>
                        <div class="customer-dropdown-menu border-radius-5 margin-top-30 outsideClick w-170">
                            <div class="tip-arrow"></div>
                            <router-link :to="{name: 'CustomerOverview'}" class="border-radius-5"> Overview </router-link>
                            <a href="javascript:void(0)" class="border-radius-5"> Edit </a>
                            <a href="javascript:void(0)" class="border-radius-5"> Preview </a>
                            <a href="javascript:void(0)" class="border-radius-5"> Activate </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data(){

        return{

        }

    },

    mounted() {

        this.dropdownInit();

    },

    methods: {

        // dropdown work on table
        dropdown(e) {
            let dropdown = document.querySelectorAll('.customer-dropdown-menu');
            dropdown.forEach(drop => {
                drop.classList.remove('active');
            })
            const dropdownMenu = e.target.closest('.customer-dropdown').querySelector('.customer-dropdown-menu');
            dropdownMenu.classList.add('active');
        },

        // dropdown outside control to remove dropdown
        dropdownInit() {
            document.addEventListener('mouseup', function (e) {
                const containers = Array.from(document.querySelectorAll('.outsideClick'));
                for (let i = 0; i < containers.length; i++) {
                    const clickedElement = e.target;
                    const isContainer = containers[i].contains(clickedElement);
                    if (isContainer) {
                        break;
                    } else {
                        containers[i].classList.remove('active');
                    }
                }
            });
        },

    }

}

</script>
