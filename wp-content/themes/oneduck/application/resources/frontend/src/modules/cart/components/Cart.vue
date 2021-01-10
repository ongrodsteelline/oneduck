<template>
    <div>
        <template v-if="this.cartItems.length">
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
            <Modal :heading="modal.heading" :content="modal.content" ref="modal"/>
        </template>
        <template v-else>
            Ваша корзина пока пуста
        </template>
    </div>
</template>

<script>
import CartList from "@/modules/cart/components/CartList";
import {mapActions, mapGetters} from "vuex";
import Modal from "@/core/components/Modal";

export default {
    components: {Modal, CartList},
    props: {
        isAuth: {
            type: Boolean,
            default: false
        },
        checkoutUrl: {
            type: String
        }
    },
    data() {
        return {
            modal: {
                heading: 'Прозошла ошибка',
                content: 'В корзине присутствуют товары с некорректной кратностью или в количестве, превышающее доступное. Проверьте список и попробуйте еще раз.'
            }
        }
    },
    computed: {
        ...mapGetters({
            cartItems: 'cart/products',
            totalAmount: 'cart/totalAmount',
            isCartValid: 'cart/isValid'
        })
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
                this.modal.content = 'Необходимо авторизоваться/зарегистрироваться'
                this.$refs['modal'].open()
                return false
            }

            if (!this.isCartValid) {
                e.preventDefault()
                this.$refs['modal'].open()
                return false
            }
        }
    }
}
</script>