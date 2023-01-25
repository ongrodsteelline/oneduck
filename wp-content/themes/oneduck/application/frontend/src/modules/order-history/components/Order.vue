<template>
    <div class="card">
        <div class="card-header card__header" :id="['heading' + orderItem.order.id]">
            <h5 class="mb-0">
                <button class="btn btn-link card__header__btn collapsed" type="button"
                        data-toggle="collapse" :data-target="['#collapse' + orderItem.order.id]"
                        aria-expanded="false"
                        aria-controls="collapseOne">
                    <div>
                        <p>Заказ N{{ orderItem.order.id }}</p>
                        <i class="ic-arrow_down i_down"></i>
                        <i class="ic-arrow_down i_up"></i>
                    </div>
                    <div>
                        <span>Оформлен {{ orderItem.order.created }}</span><span>{{ orderItem.order.total }} BYN</span>
                    </div>
                </button>
            </h5>
        </div>

        <div :id="['collapse' + orderItem.order.id]" class="collapse card__collapse"
             :aria-labelledby="['#heading' + orderItem.order.id]"
             data-parent="#accordionExample">
            <div class="card-body card__body">

                <div class="table__wrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="table__article">Артикул</th>
                            <th class="table__brend">Бренд</th>
                            <th class="table__img">Фото</th>
                            <th class="table__name">Название</th>
                            <th class="table__multiplicity">Ш/Ф/У</th>
                            <th class="table__izmer">Ед. изм.</th>
                            <th class="table__scale">Наличие</th>
                            <th class="table__PPC">Цена, руб</th>
                            <th class="table__cena">Опт.цена, руб</th>
                            <th class="table__basket">Количество</th>
                        </tr>
                        </thead>
                        <CartListCategory v-for="category in orderItem.categories"
                                          :name="category.name"
                                          :sum="category.sum"
                                          :key="category.term_id"
                        >
                            <OrderItem v-for="item in category.children" :key="item.product_id" :item="item"
                                       :copy-state="copyStatuses[item.product_id]"/>
                        </CartListCategory>
                    </table>
                </div>
                <div class="card__body__btn">
                    <!--<a href="#">
                        <i class="ic-file"></i> СЧЕТ В PDF
                    </a>
                    <a href="#">
                        <i class="ic-file_text"></i> ЗАКАЗ В PDF
                    </a>-->
                    <a href="#" class="active" @click.prevent="copyOrder(orderItem.order.id)">
                        <i class="ic-shopping2"></i>{{ copyTextBtn }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { buildFormData } from '@/core/utils/utils'
import axios from 'axios'
import CartListCategory from '@/modules/cart/components/CartListCategory.vue'
import OrderItem from '@/modules/order-history/components/OrderItem.vue'
import { mapActions } from 'vuex'

export default {
    components: {
        OrderItem,
        CartListCategory
    },
    props: {
        orderItem: {
            type: Object
        }
    },
    data() {
        return {
            copyLoading: false,
            copyTextBtn: 'Повторно в корзину',
            copyStatuses: []
        }
    },
    methods: {
        ...mapActions({
            'setCart': 'cart/setProducts'
        }),
        copyOrder(orderId) {
            if (this.copyLoading) {
                return false
            }

            const data = {
                action: 'copy_order',
                order_id: orderId
            }
            const form = new FormData()

            buildFormData(form, data)

            this.copyTextBtn = 'Загрузка...'
            this.copyLoading = true

            axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form
            }).then((response) => {
                this.copyTextBtn = 'Выполнено'
                this.copyStatuses = response.data.data.result
                this.setCart(response.data.data.cart)

                setTimeout(() => {
                    this.copyTextBtn = 'Повторно в корзину'
                    this.copyLoading = false
                }, 3000)
            })
        }
    }
}
</script>
