<template>
    <a :href="cartUrl" id="shopping" class="shopping" :class="rootClass">
        <i class="ic-shopping"></i>
        <p>{{ totalAmount }} BYN / <span>{{ totalItems }} тов.</span></p>
        <span class="shopping__col">{{ totalItems }}</span>
    </a>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'

export default {
    data() {
        return {
            loaded: false,
            rootClass: null
        }
    },
    props: {
        cartUrl: {
            type: String,
            required: true
        },
        cartItems: {
            type: Array,
            required: true
        }
    },
    mounted() {
        this.setProducts(this.cartItems)
        this.$nextTick(() => {
            this.loaded = true
        })
    },
    computed: {
        ...mapGetters({
            totalAmount: 'cart/totalAmount',
            totalItems: 'cart/totalItems'
        })
    },
    methods: {
        ...mapActions({
            setProducts: 'cart/setProducts'
        }),
        animation() {
            this.rootClass = 'add'

            setTimeout(() => {
                this.rootClass = null
            }, 1000)
        }
    },
    watch: {
        totalAmount() {
            if (this.loaded) {
                this.animation()
            }
        },
        totalItems() {
            if (this.loaded) {
                this.animation()
            }
        }
    }
}
</script>