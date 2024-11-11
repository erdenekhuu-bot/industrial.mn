<template>
    <div class="mb-5">
        <div v-if="loading">Loading...</div>
        <div v-else>
            <swiper
                :slides-per-view="1"
                :loop="true"
                @swiper="onSwiper"
                @slideChange="onSlideChange"
                class="custom-display"
            >
                <swiper-slide v-for="(image, i) in backgroundimg" :key="i">
                    <img
                        :loading="loading"
                        :src="getUrl(image.backgroud_img)"
                        class="custom-show"
                    />
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            console.log("slide change");
        };
        return {
            onSwiper,
            onSlideChange,
        };
    },
    data: () => ({
        backgroundimg: [],
        loading: true,
        carouselOption: {
            slidesPerView: 1,
            spaceBetween: 1,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                // when window width is >= 320px
                599: {
                    slidesPerView: 1,
                    spaceBetween: 0,
                },
                // when window width is >= 480px
                960: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                // when window width is >= 640px
                1264: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1904: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        },
    }),

    async created() {
        const res = await this.call_api("get", "background");
        if (res.data.success) {
            this.backgroundimg = res.data.data;
            this.loading = false;
        }
    },
    methods: {
        getUrl(arg) {
            return "http://127.0.0.1:8000/public/storage/" + arg;
        },
    },
};
</script>

<style scoped>
.custom-display {
    width: 100%;
    height: 500px;
    overflow: hidden;
}
.custom-show {
    object-fit: cover;
    width: 100%;
    height: 100%;
    flex-shrink: 1;
}
</style>
