<template>
    <div class="tovar__slider">
        <div class="tovar__slider__bigfoto" data-toggle="modal" data-target="#product-image">
            <img :src="product.image.url" :alt="product.name" ref="featureImage">
            <span class="js-info"
                  :class="['info_' + tooltipClass]"
                  data-toggle="tooltip"
                  data-placement="right"
                  :title="tooltipMessage"
                  :data-original-title="tooltipMessage"
            />
        </div>

        <div class="tovar__slider__mini">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div v-for="image in product.gallery" :key="image.id" class="swiper-slide sl__mini__slide">
                        <img :src="image.url" :alt="product.name">
                        <span class="js-info"
                              :class="['info_' + tooltipClass]"
                              data-toggle="tooltip"
                              data-placement="right"
                              :title="tooltipMessage"
                              :data-original-title="tooltipMessage"
                        />
                    </div>
                </div>
            </div>
        </div>

        <PopupGallery :image="featureImage"/>
    </div>
</template>

<script>
import Swiper from 'swiper/js/swiper.esm.bundle';
import PopupGallery from "@/modules/catalog/components/PopupGallery";

export default {
    components: {PopupGallery},
    props: {
        product: {
            type: Object
        }
    },
    data() {
        return {
            featureImage: null,
            rootClass: {},
            tooltipClass: null,
            tooltipMessage: null
        }
    },
    mounted() {
        const loop = (this.product.gallery.length > 1)
        const swiper = new Swiper('.swiper-container', {
            slideToClickedSlide: true,
            slidesPerView: 'auto',
            spaceBetween: 16,
            loop: loop,
            breakpoints: {
                460: {
                    slidesPerView: 4,
                }
            },
            slideVisibleClass: 'slide-visible'
        });

        this.featureImage = this.product.gallery[0].url

        swiper.on('slideChange', () => {
            const image = this.product.gallery[swiper.realIndex].url
            this.$refs['featureImage'].src = image
            this.featureImage = image
        })
    },
    computed: {
        getMultiplicity() {
            return this.product.multiplicity.join(' / ')
        },
        stockClass() {
            const result = {}
            if (this.product.stockQuantity >= 0 && this.product.stockQuantity <= 3) {
                result['table__scale_min'] = true
            }

            if (this.product.stockQuantity >= 4 && this.product.stockQuantity <= 6) {
                result['table__scale_sr'] = true
            }

            if (this.product.stockQuantity >= 7) {
                result['table__scale_max'] = true
            }

            return result
        },
    },
    methods: {
        quantityValidation(isValid, message, quantity) {
            this.tooltipMessage = message
            if (quantity) {
                if (isValid) {
                    this.rootClass = {
                        success: true
                    }
                    this.tooltipClass = 'success'
                } else {
                    this.rootClass = {
                        error: true
                    }
                    this.tooltipClass = 'error'
                }
            } else {
                this.rootClass = {}
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>