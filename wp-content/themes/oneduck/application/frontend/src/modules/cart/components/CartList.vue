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
                <th class="table__multiplicity">Ш/Ф/У</th>
                <th class="table__izmer">Ед. изм.</th>
                <th class="table__scale">
                    Наличие
                </th>
                <th class="table__PPC" v-if="!hasHiddenColumn('rrp')">
                    Цена, <span>руб</span>
                </th>
                <th class="table__cena" v-if="!hasHiddenColumn('price')">
                    Опт. цена, <span>руб</span>
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
                            {{ comments[item.key] }}
                            <a href="#" @click.prevent="editComment(item.key)" class="add_item_comment">
                            </a>
                        </td>
                        <td class="table__del" @click="deleteItem(item.key)">
                            <span></span>
                        </td>
                    </template>
                </ProductListItem>
            </CartListCategory>
        </table>
    </div>

    <Modal heading="Комментарий к товару" ref="modal">
        <div class="edit-comment">
            <textarea v-model="comments[editableCommentId]"
                      rows="5"
            />
            <button class="btn" @click="saveComment">Сохранить</button>
        </div>
    </Modal>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'
import ProductListItem from '@/modules/catalog/components/ProductListItem.vue'
import CartListCategory from '@/modules/cart/components/CartListCategory.vue'
import { buildFormData } from '@/core/utils/utils'
import axiosCancel from 'axios-cancel'
import axios from 'axios'
import Modal from '../../../core/components/Modal.vue'

export default {
    components: {
        Modal,
        CartListCategory,
        ProductListItem
    },
    data() {
        return {
            comments: {},
            editableCommentId: null
        }
    },
    computed: {
        ...mapGetters({
            items: 'cart/products',
            type: 'catalog/type',
            categoryId: 'catalog/categoryId',
            limit: 'catalog/limit',
            hasHiddenColumn: 'catalog/hasHiddenColumn'
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
            })

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
        },
        editComment(key) {
            this.$refs['modal'].open()
            this.editableCommentId = key
        },
        saveComment() {
            this.$refs['modal'].close()
            this.updateComments()
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

.edit-comment {
    display: flex;
    flex-direction: column;

    textarea {
        margin-bottom: 10px;
    }
}
</style>
