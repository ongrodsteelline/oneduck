<template>
    <div class="table__wrap">
        <div class="switch-wrap form__switch">
            <label class="switch">
                <input class="js-dop_table" type="checkbox">
                <span class="switch__btn"></span>
                <span class="switch__text">Показать доп. характеристики</span>
            </label>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th class="table__article">Артикул</th>
                <th class="table__brend">
                    Бренд
                </th>
                <th class="table__img">Фото</th>
                <th class="table__name">Название</th>
                <th class="table__multiplicity">Кратность</th>
                <th class="table__izmer">Ед. изм.</th>
                <th class="table__scale">
                    Наличие
                </th>
                <th class="table__PPC">РРЦ, <span>руб</span></th>
                <th class="table__cena">
                    Цена, <span>руб</span>
                </th>
                <th class="table__basket">Количество</th>
            </tr>
            </thead>
            <tbody v-for="category in itemsByCategory"
                   :key="category.term_id"
            >
            <tr data-caption="radiator">
                <td colspan="11">
                    <h2>{{ category.name }}</h2>
                </td>
            </tr>

            <ProductListItem v-for="product in category.children"
                             :key="product.id"
                             :product="product"
            />
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import ProductListItem from './ProductListItem.vue'
import { useStore } from 'vuex'

const props = defineProps({
    products: Array,
    brandId: Number
})

const store = useStore()
store.dispatch('catalog/setType', 'brand')
store.dispatch('catalog/setBrandId', props.brandId)
store.dispatch('catalog/setProducts', props.products)

const itemsByCategory = computed(() => {
    const categories = []

    store.getters['catalog/products'].forEach((product) => {
        let finder = categories.findIndex(c => c.term_id === product.category[0].term_id)
        if (finder !== -1) {
            categories[finder].children.push(product)
        } else {
            let category = product.category[0]
            category.children = [product]
            categories.push(category)
        }
    })

    return categories
})
</script>
