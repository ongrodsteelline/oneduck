<template>
    <div class="tovar js-tr__wrap" :class="rootClass">
        <ProductGallery :product="product" />
        <div class="tovar__content">
            <div class="tovar__content__top">
                <div>
                    <p>Артикул</p>
                    <p>{{ product.sku }}</p>
                </div>
                <div>
                    <p>Бренд</p>
                    <p>{{ product.brand.name }}</p>
                </div>
                <div>
                    <p>Кратность <i class="ic-info js-info"
                                    data-toggle="tooltip"
                                    data-placement="left"
                                    title=""
                                    data-original-title="Вы можете заказать товар только в количестве, кратном указанном"></i>
                    </p>
                    <p>{{ getMultiplicity }}</p>
                </div>
                <div>
                    <p>Ед. изм.</p>
                    <p>{{ product.unit }}</p>
                </div>
                <div>
                    <p>Наличие</p>
                    <div class="table__scale" :class="stockClass">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="tovar__content__bot">
                <div class="tovar__content__bot__head">
                    <p>
                                <span>РЦ, <span>руб</span>
                                    <i class="ic-info js-info"
                                       data-toggle="tooltip"
                                       data-placement="left"
                                       title=""
                                       data-original-title="Вы можете заказать товар только в количестве, кратном указанном"
                                    ></i>
                                </span>
                        <span>{{ product.rrp }}</span>
                    </p>
                    <div>
                        <p><span class="sp_color">Цена, <span>руб</span></span></p>
                        <p>{{ product.regularPrice }}</p>
                    </div>
                </div>
                <div class="tovar__content__bot__footer">
                    <div>
                        <p>В КОРЗИНУ</p>
                        <ProductQuantity :product="product" @change-quantity="quantityValidation"></ProductQuantity>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductGallery from "@/modules/catalog/components/ProductGallery";
import ProductQuantity from "@/modules/catalog/components/ProductQuantity";
export default {
    components: {ProductQuantity, ProductGallery},
    props: {
        product: {
            type: Object
        }
    },
    data() {
        return {
            rootClass: {},
            tooltipClass: null,
            tooltipMessage: null
        }
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