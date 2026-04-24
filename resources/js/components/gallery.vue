<template>
    <div class="position-fixed gallery fadeInUp" v-if="gallery === true" :class="{'fadeInGallery' : gallery === true}">
        <button type="button" class="btn btn-icon position-absolute" @click="manageGallery()">
            <img :src="`/images/global/x.svg`" alt="x">
        </button>
        <div
            class="main-content mx-auto overflow-auto d-flex flex-column align-items-center px-md-5 px-3 pt-md-5 pt-3 vh-100">
            <div class="image-viewer-big rounded-3 mb-3">
                <img class="img-fluid rounded-3" :src="'/storage/media/image/' + mainImage" alt="image 1">
            </div>

            <div class="mini-image-viewer  d-flex justify-content-center align-items-center flex-wrap">
                <img v-for="each in imageArray" class="img-fluid rounded-3 mx-2 my-2"
                     :src="'/storage/media/image/' + each?.photo_path " alt="image 1"
                     @click="changeImage(each.photo_path)">
            </div>
        </div>
    </div>

</template>

<script>
import EventBus from "@meforma/vue-toaster/src/helpers/event-bus.js";

export default {
    name: 'Gallery',
    props: ['imageArray', 'galleryAction'],
    data() {
        return {
            mainImage: null,
            gallery: this.galleryAction,
        }
    },
    created() {
        // Listen for UserInfo update event
        EventBus.$on('openGallery', updatedUserInfo => {
            this.manageGallery()
        });
    },
    mounted() {

        setTimeout(() => {
            this.mainImage = this.imageArray[0]?.photo_path;
        }, 500)
    },

    methods: {
        changeImage(v) {
            this.mainImage = v
        },

        manageGallery() {
            this.gallery = this.gallery !== true;
        }
    }
}
</script>
