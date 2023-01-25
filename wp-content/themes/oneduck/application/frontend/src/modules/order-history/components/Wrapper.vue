<template>
    <div class="accordion" id="accordionExample">
        <Order v-for="orderItem in orderList" :key="orderItem.order.id" :order-item="orderItem"/>

        <span @click="loadMore" v-if="!isLastPage">
            <i></i>{{ buttonText }}
        </span>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Order from '@/modules/order-history/components/Order.vue'

export default {
    components: { Order },
    props: {
        orders: {
            type: Array
        }
    },
    data() {
        return {
            buttonText: 'Загрузить больше',
            isLoading: false
        }
    },
    mounted() {
        this.setOrders(this.orders)
    },
    computed: {
        ...mapGetters({
            orderList: 'history/ordersByCategory',
            isLastPage: 'history/isLastPage'
        })
    },
    methods: {
        ...mapActions({
            setOrders: 'history/setOrders',
            loadOrders: 'history/load'
        }),
        loadMore() {
            if (this.isLoading) {
                return false
            }

            this.isLoading = true
            this.buttonText = 'Загрузка...'
            this.loadOrders().then(() => {
                this.isLoading = false
                this.buttonText = 'Загрузить больше'
            })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
