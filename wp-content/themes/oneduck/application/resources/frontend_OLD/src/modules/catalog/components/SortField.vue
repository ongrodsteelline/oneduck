<template>
    <span>
        <i class="ic-filter_up" :class="activeClass('ASC')" @click="orderBy('ASC')"></i>
        <i class="ic-filter_down" :class="activeClass('DESC')" @click="orderBy('DESC')"></i>
    </span>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    props: {
        type: {
            type: String
        },
        field: {
            type: String
        }
    },
    computed: {
        ...mapGetters({
            order: 'catalog/order'
        }),
        activeClass() {
            return function (index) {
                if (this.order) {
                    if (this.order[this.field] === index) {
                        return {
                            active: true
                        }
                    }
                }

                return {
                    active: false
                }
            }
        }
    },
    methods: {
        ...mapActions({
            setPaged: 'catalog/setPaged',
            setOrder: 'catalog/setOrder',
            getProducts: 'catalog/getProducts'
        }),
        async orderBy(index) {
            this.setPaged(1)

            const order = {}
            order[this.field] = index
            this.setOrder(order);
            await this.getProducts()

            let route = {
                name: 'index'
            }
            let next = this.$router.resolve(route)
            if (next.route.path !== this.$route.path) {
                this.$router.push(route)
            }
        }
    }
}
</script>