<template>
    <div>
        <template v-if="this.cartItems.length">
            <div class="basket__notice">
                Обратите внимание, в корзине вы видите цены для <b>{{ currentGroup }}</b> способа оплаты. Для отображения цен <b>{{ alternativeGroup }}</b> способа оплаты переключите формат цен в настройках вашего профиля.
            </div>
            <CartList/>
            <div class="td_btn">
                <div>
                    <a href="#" @click.prevent="emptyCart"><span></span> ОЧИСТИТЬ КОРЗИНУ</a>
                </div>
                <div class="td_btn__pos">
                    <p>Итого: <span>{{ totalAmount }}</span></p>
                    <a :href="checkoutUrl" class="active" @click="checkout">ОФОРМИТЬ ЗАКАЗ</a>
                </div>
            </div>
            <Modal heading="Прозошла ошибка" ref="modal">
                <template v-if="!isAuth">
                    Необходимо авторизоваться/зарегистрироваться
                </template>

                <template v-if="!isCartValid">
                    <p>
                        В корзине присутствуют товары с некорректной кратностью или в количестве, превышающее доступное.
                    </p>
                    <button class="btn" @click="continueCheckout">Все равно оформить заказ</button>
                    <button class="btn" @click="closeModal">Вернуться и исправить</button>
                </template>
            </Modal>
        </template>
        <template v-else>
            <div class="empty_cart">
              Ваша корзина пока пуста
            </div>
        </template>
    </div>
</template>

<script>
import CartList from '@/modules/cart/components/CartList.vue'
import { mapActions, mapGetters } from 'vuex'
import Modal from '@/core/components/Modal.vue'

export default {
    components: { Modal, CartList },
    props: {
        isAuth: {
            type: Boolean,
            default: false
        },
        checkoutUrl: {
            type: String
        }
    },
    computed: {
        ...mapGetters({
            cartItems: 'cart/products',
            totalAmount: 'cart/totalAmount',
            isCartValid: 'cart/isValid',
            userGroupMixed: 'user/groupMixed'
        }),
        currentGroup() {
            return (this.userGroupMixed === 'cash') ? 'наличного' : 'безналичного'
        },
        alternativeGroup() {
            return (this.userGroupMixed === 'cash') ? 'безналичного' : 'наличного'
        }
    },
    methods: {
        ...mapActions({
            clearCart: 'cart/clear'
        }),
        emptyCart() {
            if (confirm('Вы уверены?')) {
                this.clearCart()
            }
        },
        checkout(e) {
            if (!this.isAuth) {
                e.preventDefault()
                this.$refs['modal'].open()
                return false
            }

            if (!this.isCartValid) {
                e.preventDefault()
                this.$refs['modal'].open()
                return false
            }
        },
        continueCheckout() {
            window.location.href = this.checkoutUrl
        },
        closeModal() {
            this.$refs['modal'].close()
        }
    }
}
</script>
