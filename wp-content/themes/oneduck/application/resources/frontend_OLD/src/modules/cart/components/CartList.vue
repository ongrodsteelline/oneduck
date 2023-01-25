<template>
    <div class="table__wrap">
        <div class="switch-wrap form__switch">
            <label class="switch">
                <input class="js-dop_table" type="checkbox">
                <span class="switch__btn"></span>
                <span class="switch__text">Показать доп. характеристики</span>
            </label>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th class="table__article">Артикул</th>
                <th class="table__brend">
                    Бренд
                </th>
                <th class="table__img">Фото</th>
                <th class="table__name">Название</th>
                <th class="table__multiplicity">Кратность</th>
                <th class="table__izmer">Ед. изм.</th>
                <th class="table__scale">
                    Наличие
                </th>
                <th class="table__PPC">РРЦ, <span>руб</span></th>
                <th class="table__cena">
                    Цена, <span>руб</span>
                </th>
                <th class="table__basket">Количество</th>
                <th class="table__comment">Комментарий</th>
                <th class="table__del">Удалить</th>
            </tr>
            </thead>
            <CartListCategory v-for="category in itemsByCategory"
                              :name="category.name"
                              :sum="category.sum"
                              :key="category.term_id"
            >
                <ProductListItem v-for="item in category.children"
                                 :key="item.product_id"
                                 :product="item.product">
                    <template v-slot:cell>
                        <td class="table__comment">
                            <textarea cols="20" v-model="comments[item.key]" rows="5" @input="updateComments"></textarea>
                        </td>
                        <td class="table__del" @click="deleteItem(item.key)">
                            <span></span>
                        </td>
                    </template>
                </ProductListItem>
            </CartListCategory>
        </table>
    </div>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'
import ProductListItem from "@/modules/catalog/components/ProductListItem"
import CartListCategory from "@/modules/cart/components/CartListCategory"
import { buildFormData } from '@core/utils/utils'
import axiosCancel from 'axios-cancel'
import axios from 'axios'

export default {
    components: {
        CartListCategory,
        ProductListItem
    },
    data() {
        return {
            comments: {}
        }
    },
    computed: {
        ...mapGetters({
            items: 'cart/products',
            type: 'catalog/type',
            categoryId: 'catalog/categoryId',
            limit: 'catalog/limit'
        }),
        itemsByCategory() {
            let self = this
            let categories = []

            this.items.forEach((item) => {
                let finder = categories.findIndex(c => c.term_id === item.product.category[0].term_id)
                if (finder !== -1) {
                    categories[finder].children.push(item)
                    categories[finder].sum = self.calculateCategory(categories[finder].sum, item.product.regularPrice * item.quantity)
                } else {
                    let category = item.product.category[0]
                    category.children = [item]
                    category.sum = self.calculateCategory(0, item.product.regularPrice * item.quantity)
                    categories.push(category)
                }

                this.comments[item.key] = item.comment
            });

            return categories
        },
    },
    methods: {
        ...mapActions({
            removeItem: 'cart/removeItem'
        }),
        calculateCategory(total, plus) {
            let calculate = total + plus
            return Number(parseFloat(calculate).toFixed(2))
        },
        deleteItem(key) {
            this.removeItem(key)
        },
        updateComments() {
            const data = {
                action: 'store_comments',
                comments: this.comments
            }
            const form = new FormData()

            buildFormData(form, data)

            axiosCancel(axios)

            axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form,
                requestId: 'storeComments'
            })
        }
    }
}
</script>

<style lang="scss">
@keyframes fadeOutLeft {

    0% {
        opacity: 1;
        -webkit-transform: translateX(0);
        -ms-transform: translateX(0);
        transform: translateX(0);
    }

    100% {
        opacity: 0;
        -webkit-transform: translateX(-20px);
        -ms-transform: translateX(-20px);
        transform: translateX(-20px);
    }
}

.slide-leave-active {
    -webkit-animation: fadeOutLeft 1s infinite; /* Safari and Chrome */
    animation: fadeOutLeft 1s infinite;
}
</style>