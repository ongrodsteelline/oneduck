<template>
    <div id="product-view" aria-hidden="true"
         aria-labelledby="exampleModalCenterTitle"
         class="modal fade"
         role="dialog"
         tabindex="-1"
    >
        <div class="modal-dialog modal-dialog-centered"
             role="document"
             style="max-width: 90%;"
        >
            <div class="modal-content" v-if="previewProduct">
                <div class="modal-header modal__content__header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ previewProduct.name }}</h5>
                    <span data-dismiss="modal"></span>
                </div>
                <div class="modal-body" style="overflow: auto">
                    <section class="tovar__wrap">
                        <ProductSingle :key="previewProduct.id" :product="previewProduct" :show-similar="false"/>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductSingle from '@/modules/catalog/components/ProductSingle.vue'
import { mapGetters } from 'vuex'

export default {
    components: {
        ProductSingle
    },
    props: {
        product: Object
    },
    computed: {
        ...mapGetters({
            previewProduct: 'catalog/previewProduct'
        })
    }
}
</script>
