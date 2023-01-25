<template>
    <div class="table__wrap">
        <div class="switch-wrap form__switch">
            <label class="switch">
                <input type="checkbox" class="js-dop_table">
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
                    <SortField field="product_brand"/>
                </th>
                <th class="table__img">Фото</th>
                <th class="table__name">Название</th>
                <th class="table__multiplicity">Кратность
                    <i class="ic-info js-info" data-toggle="tooltip" data-placement="left"
                       title="Вы можете заказать товар только в количестве, кратном указанном"></i>
                </th>
                <th class="table__izmer">Ед. изм.</th>
                <th class="table__scale">
                    Наличие
                    <SortField field="stock"/>
                </th>
                <th class="table__PPC">РРЦ, <span>руб</span></th>
                <th class="table__cena">
                    Цена, <span>руб</span>
                    <SortField field="price"/>
                </th>
                <th class="table__basket">В корзину</th>
            </tr>
            </thead>
            <tbody>
            <ProductListItem v-for="product in products" :key="product.id" :product="product"/>
            </tbody>
        </table>
    </div>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'
import ProductListItem from "@modules/catalog/components/ProductListItem"
import SortField from "@modules/catalog/components/SortField"

export default {
    components: {
        ProductListItem,
        SortField
    },
    computed: {
        ...mapGetters({
            products: 'catalog/products',
            type: 'catalog/type',
            categoryId: 'catalog/categoryId',
            limit: 'catalog/limit',
            taxOrder: 'catalog/taxOrder'
        })
    },
    methods: {
        ...mapActions([
            'catalog/setPaged',
            'catalog/setTaxOrder',
            'catalog/getProducts'
        ])
    }
}
</script>