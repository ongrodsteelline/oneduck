<template>
    <div class="catalog">
        <ProductList/>
        <nav aria-label="Page navigation example" class="pagination__wrap">
            <Pagination/>
            <CountPerPage/>
        </nav>
    </div>
</template>

<script>
import {
    mapActions
} from 'vuex'
import Cookies from 'js-cookie'
import ProductList from "@modules/catalog/components/ProductList"
import Pagination from "@modules/catalog/components/Pagination"
import CountPerPage from "@modules/catalog/components/CountPerPage"
export default {
    components: {
        ProductList,
        Pagination,
        CountPerPage
    },
    props: {
        type: {
            type: String
        },
        categoryId: {
            type: Number
        },
        limit: {
            type: Number
        },
        products: {
            type: Array
        },
        pages: {
            type: Array
        }
    },
    mounted() {
        this.setType(this.type)
        this.setCategory(this.categoryId)
        this.setLimit(this.limit)
        this.setProducts(this.products)
        this.setPages(this.pages)

        const orderCookie = Cookies.get('cf_catalog_order') ? JSON.parse(Cookies.get('cf_catalog_order')) : {}
        this.setOrder(orderCookie)
    },
    methods: {
        ...mapActions({
            setType: 'catalog/setType',
            setCategory: 'catalog/setCategory',
            setLimit: 'catalog/setLimit',
            setProducts: 'catalog/setProducts',
            setPages: 'catalog/setPages',
            setOrder: 'catalog/setOrder'
        }),
    }
}
</script>