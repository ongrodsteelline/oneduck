<template>
    <div>
        <form method="POST">
            <span>Показывать по:</span>
            <select v-model="getLimit">
                <option v-for="option in options"
                        :key="option.value"
                        :value="option.value"
                >
                    {{ option.value }}
                </option>
            </select>
        </form>
    </div>
</template>

<script>
import {
    mapGetters,
    mapActions
} from "vuex";

export default {
    data() {
        return {
            state: 10,
            options: [
                {
                    value: 10,
                    selected: false
                },
                {
                    value: 20,
                    selected: false
                },
                {
                    value: 50,
                    selected: false
                },
                {
                    value: 100,
                    selected: false
                }
            ]
        }
    },
    computed: {
        ...mapGetters({
            type: 'catalog/type',
            category: 'catalog/categoryId',
            limit: 'catalog/limit'
        }),
        getLimit: {
            get() {
                return this.limit ? this.limit : this.state
            },
            async set(val) {
                this.state = val

                this.setLimit(val)
                await this.getProducts()

                this.$router.push({
                    name: 'index'
                })
            }
        }
    },
    methods: {
        ...mapActions({
            setLimit: 'catalog/setLimit',
            getProducts: 'catalog/getProducts'
        })
    }
}
</script>