<template>
    <div class="order__checkout">
        <template v-if="isAuth && cartTotal">
            <h1>Оформить заказ <span>{{ cartSum }} BYN / {{ cartTotal }} тов.</span></h1>
            <p>Заказы обрабатываются с понедельника по пятницу, с 08:00 до 19:00.</p>
            <p>После оформления заказа с вами свяжется наш менеджер для уточнения деталей заказа.</p>
            <p>Пожалуйста, ответьте на несколько вопросов, для завершения выполнения заказа.</p>
            <form class="order__info" :class="{ edit: isEditedAddress && form.isDelivery }">
                <div class="order__info__delivery" :class="{ show: form.isDelivery }">
                    <h4>Нужна доставка?</h4>
                    <div class="switch-wrap form__switch">
                        <label class="switch">
                            <input type="checkbox" v-model="form.isDelivery">
                            <span class="switch__btn"></span>
                        </label>
                    </div>
                    <p>Доставка будет осуществлена по адресу </p>
                    <div class="adress__field__wrap">
                        <p class="p_b">{{ form.address }}</p>
                        <i class="btn__adress" @click="editAddress"></i>
                    </div>
                    <div class="edit_adress">
                        <input type="text" v-model="form.address">
                        <button type="button" @click="confirmAddress">OK</button>
                    </div>
                    <div v-if="!isValidAddress && isEditedAddress && form.isDelivery" class="error_address">Минимальная
                        длина адреса - 10 символов
                    </div>
                </div>
                
                    
                    
                <div class="order__info__pay" style="display: none;">
                    <h4>Способ оплаты</h4>
                    <div class="switch-wrap form__switch js-switch-pay">
                        <label class="switch">
                            <input type="radio" class="js-check__pay" v-model="form.payment" value="first">
                            <span class="switch__btn"></span>
                            <span class="switch__text">Первая форма</span>
                        </label>
                    </div>
                    <div class="switch-wrap form__switch js-switch-pay">
                        <label class="switch">
                            <input type="radio" class="js-check__pay" v-model="form.payment" value="second">
                            <span class="switch__btn"></span>
                            <span class="switch__text">Вторая форма</span>
                        </label>
                    </div>
                    <div class="switch-wrap form__switch js-switch-pay">
                        <label class="switch">
                            <input type="radio" class="js-check__pay" v-model="form.payment" value="mixed">
                            <span class="switch__btn"></span>
                            <span class="switch__text">Смешанная форма</span>
                        </label>
                    </div>
                </div>
                
                
                <div class="order__info__comment">
                    <h4>Комментарий</h4>
                    <textarea v-model="form.comment"></textarea>
                </div>
            </form>
            <a href="#" class="btn_order" @click="confirmOrder">{{ sendButton }}</a>

            <Modal heading="Произошла ошибка" content="Форма заполнена некорректно, проверьте еще раз" ref="modal"/>
        </template>
        <template v-else>
            <h1>Оформить заказ</h1>
            <template v-if="!isAuth">
                Необходимо авторизоваться/зарегистрироваться.
            </template>
            <template v-if="cartTotal === 0">
                Ваша корзина пока пуста.
            </template>
        </template>
    </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import Modal from '@/core/components/Modal.vue'
import { buildFormData } from '@/core/utils/utils'

export default {
    components: { Modal },
    props: {
        isAuth: {
            type: Boolean
        },
        customerAddress: {
            type: String
        }
    },
    data() {
        return {
            isSending: false,
            isEditedAddress: false,
            form: {
                isDelivery: false,
                address: this.customerAddress,
                payment: 'first',
                comment: null
            },
            sendButton: 'Оформить заказ'
        }
    },
    computed: {
        ...mapGetters({
            cartTotal: 'cart/totalItems',
            cartSum: 'cart/totalAmount',
            isCartValid: 'cart/isValid'
        }),
        isValidAddress() {
            if (this.form.address.length >= 10) {
                return true
            }

            return false
        }
    },
    methods: {
        editAddress() {
            this.isEditedAddress = !this.isEditedAddress
        },
        confirmAddress() {
            if (this.isValidAddress) {
                this.isEditedAddress = false
            }
        },
        confirmOrder(e) {
            e.preventDefault()

            if (this.isSending) {
                return false
            }

            if (!this.isValidAddress && this.form.isDelivery) {
                this.$refs['modal'].open()
                return false
            }

            this.isSending = true
            this.sendButton = 'Отправка...'

            const data = {
                action: 'create_order',
                form: this.form
            }
            const form = new FormData()

            buildFormData(form, data)

            axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form
            }).then((response) => {
                if (response.data.success) {
                    window.location.href = response.data.url
                }
            })
        }
    }
}
</script>

<style>
.error_address {
    color: red;
    padding: 5px 0;
}
</style>
