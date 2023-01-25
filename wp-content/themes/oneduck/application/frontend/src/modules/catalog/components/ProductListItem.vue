<template>
    <tr class="js-tr__wrap" :class="rootClass">
        <td class="table__article">{{ product.sku }}</td>
        <td class="table__brend">
            <a :href="`/product_brand/${product.brand.slug}/`">{{ product.brand.name }}</a>
        </td>
        <td class="table__img" @click="setPreviewProduct(product)" data-target="#product-view" data-toggle="modal">
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
            <slot name="status"/>
            <div>
                <div class="attr_1">Бренд:
                    <a :href="`/product_brand/${product.brand.slug}/`">{{ product.brand.name }}</a>
                </div>
                <div class="attr_2">Арт.:
                    <p>{{ product.sku }}</p>
                </div>
                <div class="attr_3">Ш/Ф/У / eд.изм:
                    <p>{{ getMultiplicity }} / {{ product.unit }}</p>
                </div>

                <div class="attr_4" v-if="!hasHiddenColumn('rrp')">
                
                <span>Цена: </span>
                
                    <p>{{ product.rrp }} руб</p>
                    
                </div>
                    
                <div class="attr_5" v-if="!hasHiddenColumn('price')"><span>Опт.цена:</span>
                    <span v-if="userLogged"><p>{{ getPrice }} руб</p></span>
                    <span v-else>
                        <a href="#" v-if="!userLogged" data-toggle="modal" data-target="#Modal">
                            Доступна после авторизации
                        </a>
                    </span>
                </div>    
                
                
                <div class="table__scale attr_6" :class="stockClass" :data-quantity="product.stockQuantity">
                    <div class="table__warehouses">
                        <template v-if="hasAvailableWarehouses">
                            <div class="warehouses_list"><span>На складах:</span> <p> {{ listAvailableWarehouses }} </p> <div class="clearfix"></div></div>
                            <div class="availability_bar"><span>Наличие</span><div class="bar"></div><div class="clearfix"></div></div>
                        </template>
                
                        <template v-else>
                            <div class="warehouses_list"><span class="no_availability">Товар отсутствует на выбранном складе</span></div>
                        </template>
                    </div>
                </div>
            </div>
            
            
            <div class="table__cena_mobile" v-if="!hasHiddenColumn('price')">
                <span v-if="userLogged">{{ getPrice }} руб</span>
                <span v-else>{{ product.rrp }} руб</span>
            </div>
            
            <div class="productquantity_mob">
            <ProductQuantity :product="product" @change-quantity="quantityValidation"/>
            </div>
            
            

            
        </td>
        <td class="table__multiplicity">
            {{ getMultiplicity }}
        </td>
        <td class="table__izmer">{{ product.unit }}</td>
        <td class="table__scale" :class="stockClass" :data-quantity="product.stockQuantity">
            <div class="table__warehouses">
                <template v-if="hasAvailableWarehouses">
                    <div class="bar"></div>
                    <div class="warehouses_list"><span>На складах:</span> <br> {{ listAvailableWarehouses }}</div>
                </template>

                <template v-else>
                    Товар отсутствует на выбранном складе
                </template>
            </div>
        </td>
        <td class="table__PPC" v-if="!hasHiddenColumn('rrp')">
            {{ product.rrp }}
        </td>
        <td class="table__cena" v-if="!hasHiddenColumn('price')">
            <span v-if="userLogged">{{ getPrice }}</span>
            <span v-else>
                <a href="#" v-if="!userLogged" data-toggle="modal" data-target="#Modal">
                    Доступна после авторизации
                </a>
            </span>
        </td>
        <td class="table__basket" v-if="canChooseQuantity">
            
            <div class="table__cena_mobile" v-if="!hasHiddenColumn('price')">
                <span v-if="userLogged">{{ getPrice }} руб</span>
                <span v-else>{{ product.rrp }} руб</span>
            </div>
            
            <ProductQuantity :product="product" @change-quantity="quantityValidation"/>

            
            
        </td>
        <slot name="cell"/>
    </tr>
    

</template>

<script>
import ProductQuantity from '@/modules/catalog/components/ProductQuantity.vue'
import { mapGetters, mapMutations } from 'vuex'

export default {
    components: { ProductQuantity },
    props: {
        product: {
            type: Object
        },
        canChooseQuantity: {
            type: Boolean,
            default: true
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
            cartItems: 'cart/products',
            userGroup: 'user/group',
            userGroupMixed: 'user/groupMixed',
            userLogged: 'user/logged',
            userWarehouses: 'user/warehouses',
            hasHiddenColumn: 'catalog/hasHiddenColumn'
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
        },
        getPrice() {
            const group = (this.userGroup === 'mixed') ? this.userGroupMixed : this.userGroup

            return (group === 'cash') ? this.product.priceForCash : this.product.priceForCashless
        },
        hasAvailableWarehouses() {
            if (this.product.warehouses) {
                return this.product.warehouses.map((warehouse) => {
                    return warehouse.term_id
                }).some(e => this.userWarehouses.includes(e))
            }

            return false
        },
        listAvailableWarehouses() {
            const result = []

            this.product.warehouses.forEach((warehouse) => {
                if (this.userWarehouses.includes(warehouse.term_id)) {
                    result.push(warehouse.name)
                }
            })

            return result.join(', ')
        }
    },
    methods: {
        ...mapMutations({
            setPreviewProduct: 'catalog/SET_PREVIEW_PRODUCT'
        }),
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
