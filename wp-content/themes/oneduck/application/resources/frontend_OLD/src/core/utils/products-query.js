import axios from "axios";
import store from "@core/store";
import {buildFormData} from "@core/utils/utils";
import axiosCancel from "axios-cancel";

export class ProductsQuery {
    constructor(type, categoryId, paged, limit) {
        this.type = type
        this.category = categoryId
        this.paged = paged
        this.limit = limit

        this.order = null
        this.tax_order = null
        this.filter = {}
        this.search = null
    }

    setOrder(order) {
        this.order = order
        return this
    }

    setFilter(filter) {
        this.filter = filter
        return this
    }

    setSearch(filter) {
        this.search = filter
        return this
    }

    async get() {
        const data = {
            action: 'get_products',
            type: this.type,
            category_id: this.category,
            paged: this.paged,
            limit: this.limit,
            order: this.order,
            tax_order: this.tax_order,
            filter: this.filter,
            search: this.search
        }
        const form = new FormData()

        buildFormData(form, data)

        axiosCancel(axios)

        await axios({
            method: 'post',
            url: '/wp-admin/admin-ajax.php',
            data: form,
            requestId: 'addItem' + this.category
        }).then((response) => {
            store.dispatch('catalog/setProducts', response.data.products)
            store.dispatch('catalog/setPages', response.data.pagination)
            store.dispatch('catalog/setAttributes', response.data.attributes)
            store.dispatch('catalog/setCounter', response.data.counter)
        })
    }
}