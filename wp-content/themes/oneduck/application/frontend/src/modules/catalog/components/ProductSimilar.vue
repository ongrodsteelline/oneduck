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
                <th class="table__multiplicity">Ш/Ф/У</th>
                <th class="table__izmer">Ед. изм.</th>
                <th class="table__scale">
                    Наличие
                </th>
                <th class="table__PPC" v-if="!store.getters['catalog/hasHiddenColumn']('rrp')">
                    Цена, <span>руб</span>
                </th>
                <th class="table__cena" v-if="!store.getters['catalog/hasHiddenColumn']('price')">
                    Опт. цена, <span>руб</span>
                </th>
                <th class="table__basket">Количество</th>
            </tr>
            </thead>
            <tbody>
            <ProductListItem v-for="product in products" :key="product.id" :product="product"/>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { useStore } from 'vuex'
import ProductListItem from './ProductListItem.vue'

const props = defineProps({
    products: Array
})

const store = useStore()
</script>
