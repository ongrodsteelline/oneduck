<template>
    <ProductListItem :product="item.product"
                     :can-choose-quantity="false"
    >
        <template v-slot:status>
            <div class="copy-status" :class="['copy-status--' + copyStatusColor]" v-if="copyState">
                {{ copyStatusFormatted }}
            </div>
        </template>
        <template v-slot:cell>
            <td class="table__basket">
                <span>{{ item.total }}</span>
                <input type="number" :value="item.quantity" disabled>
            </td>
        </template>
    </ProductListItem>
</template>

<script>
import ProductListItem from '@/modules/catalog/components/ProductListItem.vue'

export default {
    components: { ProductListItem },
    props: {
        item: {
            type: Object
        },
        copyState: {
            type: Object
        }
    },
    computed: {
        copyStatusFormatted() {
            if (this.copyState.status === 'exists') {
                return 'Не добавлен в корзину, товар уже есть в корзине'
            } else if (this.copyState.status === 'outofstock') {
                return 'Не добавлен в корзину, товара нет в наличии'
            } else if (this.copyState.status === 'trash') {
                return 'Не добавлен в корзину, товар больше недоступен'
            } else {
                return 'Добавлен в корзину'
            }
        },
        copyStatusColor() {
            if (this.copyState.status === 'available') {
                return 'success'
            } else {
                return 'fail'
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.copy-status {
    display: flex;

    &--success {
        color: blue;
    }

    &--fail {
        color: red;
    }
}
</style>
