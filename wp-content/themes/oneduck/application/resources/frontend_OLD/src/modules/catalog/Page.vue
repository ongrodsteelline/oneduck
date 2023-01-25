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
        categoryName: {
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
        },
        attributes: {
            type: [Object, Array]
        },
        counter: {
            type: Object
        }
    },
    mounted() {
        this.setType(this.type)
        this.setCategoryName(this.categoryName)
        this.setCategoryId(this.categoryId)
        this.setLimit(this.limit)
        this.setProducts(this.products)
        this.setPages(this.pages)
        this.setAttributes(this.attributes)
        this.setCounter(this.counter)

        const orderCookie = Cookies.get('cf_catalog_order') ? JSON.parse(Cookies.get('cf_catalog_order')) : ''
        if (orderCookie) {
            this.setOrder(orderCookie)
        }
    },
    methods: {
        ...mapActions({
            setType: 'catalog/setType',
            setCategoryName: 'catalog/setCategoryName',
            setCategoryId: 'catalog/setCategoryId',
            setLimit: 'catalog/setLimit',
            setProducts: 'catalog/setProducts',
            setPages: 'catalog/setPages',
            setOrder: 'catalog/setOrder',
            setAttributes: 'catalog/setAttributes',
            setCounter: 'catalog/setCounter'
        }),
    }
}
</script>