<template>
    <div class="nf__tovar__slider js-nf__tovar__slider">
        <span class="nf__close js-nf__close"></span>

        <div class="nf__tovar__slider-single-wrap">
            <span :class="['info_' + tooltipClass]"
                  :data-original-title="tooltipMessage"
                  :title="tooltipMessage"
                  class="js-info"
                  data-placement="right"
                  data-toggle="tooltip"
            />

            <div class="slider slider-single nf__tovar__slider-single">
                <div class="js-nf__tovar__slider-inner"
                     v-for="image in product.gallery"
                     :key="image.id"
                >
                    <img :src="image.url" :alt="product.name">
                </div>
            </div>
        </div>

        <div class="slider slider-nav nf__tovar__slider-nav"
             v-if="product.gallery.length > 1"
        >
            <div v-for="image in product.gallery"
                 :key="image.id"
            >
                <div class="nf__tovar-img_wrap">
                    <img :src="image.url" :alt="product.name">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
        setTimeout(() => {
            document.dispatchEvent(new CustomEvent('product-gallery-mounted'))
        }, 200)
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
