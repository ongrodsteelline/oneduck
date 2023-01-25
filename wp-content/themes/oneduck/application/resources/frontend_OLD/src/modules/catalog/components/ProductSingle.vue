<template>
    <div class="tovar js-tr__wrap" :class="rootClass">
        <ProductGallery :product="product" />
        <div class="tovar__content">
            <div class="tovar__content__top">
                <div>
                    <p>Артикул</p>
                    <p>{{ product.sku }}</p>
                </div>
                <div v-if="product.productCode1C">
                    <p>Код товара (1С)</p>
                    <p>{{ product.productCode1C }}</p>
                </div>
                <div v-if="product.brandCountry">
                    <p>Родина бренда</p>
                    <p>{{ product.brandCountry }}</p>
                </div>
                <div v-if="product.countryProduction">
                    <p>Страна производства</p>
                    <p>{{ product.countryProduction }}</p>
                </div>
                <div v-if="product.weight">
                    <p>Вес</p>
                    <p>{{ product.weight }}</p>
                </div>
                <div v-if="product.volume">
                    <p>Объем</p>
                    <p>{{ product.volume }}</p>
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
                <div v-if="product.shk1">
                    <p>ШК1</p>
                    <p>{{ product.shk1 }}</p>
                </div>
                <div v-if="product.shk2">
                    <p>ШК2</p>
                    <p>{{ product.shk2 }}</p>
                </div>
                <div v-if="product.shk3">
                    <p>ШК3</p>
                    <p>{{ product.shk3 }}</p>
                </div>
                <div>
                    <p>Наличие</p>
                    <div class="table__scale" :class="stockClass">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="tovar__content__bot">
                <div v-if="product.description">
                    {{ product.description }}
                </div>
                <div class="tovar__content__bot__head">
                    <p>
                                <span>РРЦ, <span>руб</span>
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
                        <p>{{ getPrice }}</p>
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
import { mapGetters } from 'vuex'
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
        ...mapGetters({
            userGroup: 'user/group',
            userGroupMixed: 'user/groupMixed'
        }),
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
        getPrice() {
            const group = (this.userGroup === 'mixed') ? this.userGroupMixed : this.userGroup

            return (group === 'cash') ? this.product.priceForCash : this.product.priceForCashless
        }
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