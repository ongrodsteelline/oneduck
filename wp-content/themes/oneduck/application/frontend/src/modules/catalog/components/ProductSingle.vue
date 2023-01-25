<template>
    <div class="tovar nf__tovar js-tr__wrap" :class="rootClass">
        <ProductGallery :product="product"/>

        <div class="nf__tovar__content">
            <div class="nf__tovar__content-top">
                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Артикул</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.sku }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Код товара (1С)</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.productCode1C }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Родина бренда</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.brandCountry }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Страна производства</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.countryProduction }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line" v-if="product.weight">
                    <div class="nf__tovar__content-characteristic">
                        <p>Вес</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.weight }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line" v-if="product.volume">
                    <div class="nf__tovar__content-characteristic">
                        <p>Объем</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.volume }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Бренд</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.brand.name }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>
                            Ш/Ф/У
                            <i class="ic-info js-info"
                               data-toggle="tooltip"
                               data-placement="left"
                               title=""
                               data-original-title="Вы можете заказать товар только в количестве, кратном первому числу значения Ш/Ф/У."
                            />
                        </p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ getMultiplicity }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Ед. изм.</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.unit }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line" v-if="product.shk1">
                    <div class="nf__tovar__content-characteristic">
                        <p>ШК1</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.shk1 }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line" v-if="product.shk2">
                    <div class="nf__tovar__content-characteristic">
                        <p>ШК2</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.shk2 }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line" v-if="product.shk3">
                    <div class="nf__tovar__content-characteristic">
                        <p>ШК3</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p>{{ product.shk3 }}</p>
                    </div>
                </div>

                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Наличие</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <div class="table__scale table__warehouses" :class="stockClass">
                                <div class="bar"></div>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="nf__tovar__content-line">
                    <div class="nf__tovar__content-characteristic">
                        <p>Склад</p>
                    </div>
                    <div class="nf__tovar__content-discription">
                        <p :class="stockClass">
                            <template v-if="hasAvailableWarehouses">
                                {{ listAvailableWarehouses }}
                            </template>
                
                            <template v-else>
                                Товар отсутствует на выбранном складе
                            </template>
                        </p>
                    </div>
                </div>                
                
                
                <div class="price_box">
                    <div v-if="!userLogged">
                        
                        <div class="nf__tovar__content-line">
                            <div class="nf__tovar__content-characteristic">
                                <p>Оптовая цена</p>
                            </div>
                            <div class="nf__tovar__content-discription">
                                <p>
                                    <a href="#" data-toggle="modal" data-target="#Modal">
                                        Доступна после авторизации
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div v-else>
                        
                        <div class="nf__tovar__content-line">
                            <div class="nf__tovar__content-characteristic">
                                <p>Цена</p>
                            </div>
                            <div class="nf__tovar__content-discription">
                                <p v-if="!hasHiddenColumn('rrp')">{{ product.rrp }} руб</p><p v-else>Скрыта</p>
                            </div>
                        </div>
                       
                        
                    </div>    
                </div>
                
                


                
            </div>

            <div class="nf__tovar__content-number">
                
                <div class="nf__tovar__content-number-left">
                    <!--РОЗНИЦА, АВТОРИЗОВАН-->
                    <div v-if="!userLogged">   
                        <p>
                            Цена за 1 шт:
                        </p>
                        <span href="#" v-if="!userLogged" data-toggle="modal" data-target="#Modal">
                            {{ product.rrp }} руб
                        </span>
                    </div>
                    <!--РОЗНИЦА, АВТОРИЗОВАН-->
                    
                    <!--ОПТ, АВТОРИЗОВАН-->
                    <div v-else-if="!hasHiddenColumn('price')">
                        <p>
                            Оптовая цена за 1 шт при {{ getUserGroup }} оплате <i class="ic-info js-info"
                               data-toggle="tooltip"
                               data-placement="left"
                               title=""
                               data-original-title="Изменить отображаемый способ оплаты вы можете в настройках своего профиля"
                            />:
                        </p>
                        <span>
                            {{ getPrice }} руб
                        </span>
                    </div>
                    <!--ОПТ, АВТОРИЗОВАН-->
                    
                    <!--ОПТ, АВТОРИЗОВАН, СКРЫТА ЦЕНА-->
                    <div v-else>
                        <p>
                            Оптовая цена за 1 шт при {{ getUserGroup }} оплате <i class="ic-info js-info"
                               data-toggle="tooltip"
                               data-placement="left"
                               title=""
                               data-original-title="Изменить отображаемый способ оплаты вы можете в настройках своего профиля"
                            />:
                        </p>   
                        <span>
                            Скрыта
                        </span>
                    </div>
                    <!--ОПТ, АВТОРИЗОВАН, СКРЫТА ЦЕНА-->
                </div>    
                

                
                
          
                
                
                
                
                <div class="nf__tovar__content-number-right">
                    <p>В корзине</p>
                    <ProductQuantity :product="product" @change-quantity="quantityValidation"></ProductQuantity>
                </div>
                <div class="clearfix"></div>
            </div><!-- /nf__tovar__content-number -->
        </div>
    </div>

    <div class="nf__tovar__additional" v-if="product.attributes.length">
        <h3>дополнительные характеристики</h3>

        <div class="nf__tovar__content-line"
             v-for="attribute in product.attributes"
             :key="attribute.key"
        >
            <div class="nf__tovar__content-characteristic">
                <p>{{ attribute.label }}</p>
            </div>
            <div class="nf__tovar__content-discription">
                <p v-if="attribute.type === 'toggle'">
                    Да
                </p>

                <p v-else v-html="attribute.values.join(', ')"/>
            </div>
        </div>
    </div>

    <div class="nf__tovar__additional" v-if="product.description">
        <h3>Описание</h3>
        {{ product.description }}
    </div>

    <div class="nf__tovar__additional" v-if="showSimilar && product.related.length">
        <h3>Похожие товары</h3>

        <ProductSimilar :products="product.related"/>
    </div>
</template>

<script>
import ProductGallery from '@/modules/catalog/components/ProductGallery.vue'
import ProductQuantity from '@/modules/catalog/components/ProductQuantity.vue'
import ProductSimilar from '@/modules/catalog/components/ProductSimilar.vue'
import { mapGetters } from 'vuex'

export default {
    components: { ProductQuantity, ProductGallery, ProductSimilar },
    props: {
        product: {
            type: Object
        },
        showSimilar: {
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
            userGroup: 'user/group',
            userGroupMixed: 'user/groupMixed',
            userLogged: 'user/logged',
            userWarehouses: 'user/warehouses',
            hasHiddenColumn: 'catalog/hasHiddenColumn'
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
        },
        getUserGroup() {
            const group = (this.userGroup === 'mixed') ? this.userGroupMixed : this.userGroup

            return (group === 'cash') ? 'наличной' : 'безналичной'
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
