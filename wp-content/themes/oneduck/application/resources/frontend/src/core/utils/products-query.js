import axios from "axios";
import store from "@core/store";
import {buildFormData} from "@core/utils/utils";

export class ProductsQuery {
    constructor(type, categoryId, paged, limit) {
        this.type = type
        this.category = categoryId
        this.paged = paged
        this.limit = limit

        this.order = null
        this.tax_order = null
    }

    setOrder(order) {
        this.order = order
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
            tax_order: this.tax_order
        }
        const form = new FormData()

        buildFormData(form, data)

        await axios.post('/wp-admin/admin-ajax.php', form).then((response) => {
            store.dispatch('catalog/setProducts', response.data.products)
            store.dispatch('catalog/setPages', response.data.pagination)
        })
    }
}