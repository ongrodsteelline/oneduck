<template>
    <div class="input__wrap js-input__wrap">
        <span class="js-poisk"></span>
        <div class="search_wrapper">
            <div class="dropdown_text_desc">Введите запрос:</div>
            <input v-model="query" type="text" placeholder="Поиск...">
            <div class="result" v-if="query.length > 2">
                <template v-if="loading">
                    <div id="preload-update-data">
                        <div class="content">
                            <div class="circle"></div>
                            <div class="circle1"></div>
                        </div>
                        <b>Загружаем результаты...</b>
                        <div class="clearfix"></div>
                    </div>
                </template>
                <template v-if="!loading && total === 0">
                    <div class="nothing_found">
                        Ничего не найдено
                    </div>
                </template>
                <template v-else>
                    <div class="result-row" v-if="categories.length">
                        <div class="result-row__title">Категории:</div>
                        <div class="result-row__list">
                            <a v-for="item in categories"
                               :key="item.url"
                               :href="item.url"
                            >
                                {{ item.name }}
                            </a>
                        </div>
                    </div>
                    <div class="result-row" v-if="products.length">
                        <div class="result-row__title">Товары:</div>
                        <div class="result-row__list">
                            <a v-for="item in products"
                               :key="item.url"
                               :href="item.url"
                            >
                                {{ item.name }}
                            </a>
                        </div>
                    </div>
                    <a :href="resultLink" v-if="total > 15">Показать все результаты ({{ total }})</a>
                </template>
            </div>
        </div>

    </div>
</template>






<script>
import axios from 'axios'
import { buildFormData } from '@/core/utils/utils.js'

export default {
    data() {
        return {
            loading: false,
            query: '',
            result: [],
            cancelSource: null
        }
    },
    computed: {
        categories() {
            return this.result.categories ? this.result.categories : []
        },
        products() {
            return this.result.products ? this.result.products : []
        },
        total() {
            return this.result.total ? this.result.total : 0
        },
        resultLink() {
            return '/search/?q=' + this.query
        }
    },
    watch: {
        query(val) {
            if (val.length > 2) {
                const data = {
                    action: 'search',
                    query: this.query
                }
                const form = new FormData()
                buildFormData(form, data)

                if (this.cancelSource) {
                    this.cancelSource.cancel()
                }

                this.cancelSource = axios.CancelToken.source()
                this.result = []
                this.loading = true

                this.request = axios.post('/wp-admin/admin-ajax.php', form, {
                    cancelToken: this.cancelSource.token
                }).then((response) => {
                    this.loading = false
                    this.result = response.data
                })
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.result {
    width: 100%;
    position: absolute;
    top: 45px;
    background-color: #fff;
    padding: 10px;
    border: 1px solid #000;
    z-index: 10;
}

.result-row {
    margin-bottom: 10px;

    &__title {
        font-weight: 500;
        margin-bottom: 10px;
    }

    &__list {

        a {
            display: flex;
        }
    }
}
</style>
