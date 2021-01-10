<template>
    <tr class="js-tr__wrap" :class="rootClass">
        <td class="table__img" data-toggle="modal" data-target="#Modal__img">
            <div>
                <img :src="product.image.url" alt="">
                <span class="js-info"
                      :class="['info_' + tooltipClass]"
                      data-toggle="tooltip"
                      data-placement="right"
                      :title="tooltipMessage"
                      :data-original-title="tooltipMessage"
                />
            </div>
        </td>
        <td class="table__name">
            <a :href="product.url">{{ product.name }}</a>
            <p><span>Бренд:</span> {{ product.brand.name }}</p>
            <div>
                <div>Бренд:
                    <p>{{ product.brand.name }}</p>
                </div>
                <div>Арт.:
                    <p>{{ product.sku }}</p>
                </div>
                <div>Кратность:
                    <p>{{ getMultiplicity }}</p>
                </div>
                <div>Ед. изм.: <p>{{ product.unit }}</p></div>
                <div class="table__scale" :class="stockClass">
                    Наличие:
                    <div></div>
                </div>
            </div>
        </td>
        <td class="table__article">{{ product.sku }}</td>
        <td class="table__brend">{{ product.brand.name }}</td>
        <td class="table__multiplicity">{{ getMultiplicity }}</td>
        <td class="table__izmer">{{ product.unit }}</td>
        <td class="table__scale" :class="stockClass" :data-quantity="product.stockQuantity">
            <div></div>
        </td>
        <td class="table__PPC">{{ product.rrp }}</td>
        <td class="table__cena">
            <span>{{ product.regularPrice }}</span>
        </td>
        <td class="table__basket">
            <span>0 р.</span>
            <ProductQuantity :product="this.product" @change-quantity="quantityValidation"/>
        </td>
        <slot name="cell"/>
        <td class="table__mob js-table__mob show">
            <table>
                <tr>
                    <td><span>Артикул:</span>
                        <p>{{ product.sku }}</p></td>
                    <td><span>Кратность:</span>
                        <p>{{ getMultiplicity }}</p></td>
                    <td><span>Ед.изм:</span>
                        <p>{{ product.unit }}</p></td>
                    <td><span>РРЦ:</span>
                        <p>{{ product.unit }}</p></td>
                    <td class="table__scale" :class="stockClass">
                        <span>Наличие:</span>
                        <div></div>
                    </td>
                </tr>
            </table>
            <span class="js-scroll__hands"><i class="ic-hands"></i></span>
        </td>
    </tr>
</template>

<script>
import ProductQuantity from "@/modules/catalog/components/ProductQuantity";
import {mapGetters} from "vuex";

export default {
    components: {ProductQuantity},
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
            cartItems: 'cart/products'
        }),
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
        getMultiplicity() {
            return this.product.multiplicity.join(' / ')
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