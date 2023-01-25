<template>
    <div class="product-quantity">
        <template v-if="product.stockQuantity > 0">
            <div class="stepper stepper--style-1">
                <input type="number"
                       class="stepper__input"
                       min="0"
                       v-model="quantity"
                       @blur="handleBlur"
                >
                <div class="stepper__controls">
                    <button type="button" spinner-button="up" @click="addProduct">+</button>
                    <button type="button" spinner-button="down" @click="removeProduct">−</button>
                </div>
            </div>
        </template>
        <template v-else>
            Нет в наличии
        </template>
    </div>
</template>

<script>
import {
    mapGetters,
    mapActions
} from "vuex";

export default {
    props: {
        product: {
            type: Object
        }
    },
    data() {
        return {
            cartLoaded: false,
            quantity: 0,
            step: parseInt(this.product.multiplicity[0]),
            isValid: false,
            validMessage: null
        }
    },
    mounted() {
        this.quantity = this.cartQuantity()
        this.$nextTick(() => {
            this.cartLoaded = true
        })
    },
    computed: {
        ...mapGetters({
            cartItems: 'cart/products'
        })
    },
    methods: {
        ...mapActions({
            addItem: 'cart/addItem'
        }),
        handleBlur() {
            if (this.quantity === '') {
                this.quantity = 0
            }
        },
        addProduct() {
            this.quantity = parseInt(this.quantity) + this.step
        },
        removeProduct() {
            this.quantity = parseInt(this.quantity) - this.step

            if (this.quantity < 0) {
                this.quantity = 0
            }
        },
        cartQuantity() {
            let item = this.cartItems.find(p => p.product_id === this.product.id)

            if (item) {
                return item.quantity
            }

            return 0
        },
        quantityValidation() {
            if (this.quantity > this.product.stockQuantity) {
                this.isValid = false
                this.validMessage = 'Превышен лимит количества, доступно к выбору: ' + this.product.stockQuantity
            } else {
                if (this.quantity) {
                    const result = this.quantity % this.step
                    if (result === 0) {
                        this.isValid = true
                        this.validMessage = 'Успешно добавлено'
                    } else {
                        this.isValid = false
                        this.validMessage = 'Проверьте кратность'
                    }
                }

            }
        },
        cartSender() {
            this.addItem({
                productId: this.product.id,
                quantity: this.quantity
            })
        }
    },
    watch: {
        quantity(value) {
            if (!isNaN(parseInt(value))) {
                this.quantity = parseInt(value)
                this.quantityValidation()
                this.$emit('change-quantity', this.isValid, this.validMessage, parseInt(this.quantity), this.step)

                if (this.cartLoaded) {
                    this.cartSender()
                }
            }
        }
    }
}
</script>