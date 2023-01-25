<template>
    <div>
        <div class="modal fade" :class="showClass" :style="{ display: display }">
            <div role="document" class="modal-dialog modal__dialog">
                <div class="modal-content modal__content">
                    <div class="modal-header modal__content__header">
                        <h5 id="exampleModalLabel" class="modal-title">{{ heading }}</h5>
                        <span data-dismiss="modal" @click="close"></span>
                    </div>
                    <div class="modal-body modal__content__body" v-html="content"/>
                </div>
            </div>
        </div>
        <div v-show="show" class="modal-backdrop fade" :class="showClass"></div>
    </div>
</template>

<script>
export default {
    props: {
        heading: {
            type: String
        },
        content: {
            type: String
        }
    },
    data() {
        return {
            show: false,
            showClass: {},
            display: 'none'
        }
    },
    methods: {
        open() {
            this.show = true
            this.display = 'block'
            setTimeout(() => {
                this.showClass = {
                    show: true
                }
            }, 300)
        },
        close() {
            setTimeout(() => {
                this.show = false
                this.display = 'none'
            }, 500)
            this.showClass = {}
        }
    }
}
</script>