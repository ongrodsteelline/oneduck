<template>
    <div class="main__filter">
        <form class="main__filter__top">
            <input type="text" v-model="search" placeholder="Поиск в категории...">

            <div class="param param_nth js-param" v-for="attr in getAttributesByType('select')" :key="attr.id">
                <h4>{{ attr.name }}</h4>
                <label class="param__check" v-for="item in attr.items" :key="item.id">
                    {{ item.name }}
                    <input type="checkbox"
                           class="js-input_box"
                           v-model="filter[attr.slug]"
                           :value="item.id"
                           @change="change"
                    >
                    <span class="checkmark"></span>
                </label>
                <template v-if="attr.items.length > 5">
                    <button class="more js-more" type="button">показать еще <span class="js-not_visible">0</span></button>
                    <button class="show_check js-show_check" type="button">свернуть не выбранное</button>
                </template>
            </div>
            <div class="switch-wrap form__switch" v-for="attr in getAttributesByType('toggle')" :key="attr.id">
                <label class="switch">
                    <input type="checkbox"
                           v-model="filter[attr.slug]"
                           value="1"
                           @change="change"
                    >
                    <span class="switch__btn"></span>
                    <span class="switch__text">{{ attr.name }}</span>
                </label>
            </div>
        </form>
        <div class="main__filter__bot">
            <template v-if="isFilterActive">
                <div>
                    <i></i>
                    <p>По указанным фильтрам найдено <span>{{ getCounter.filter }}</span>
                        {{ declOfNum(getCounter.filter, ['товар', 'товара', 'товаров']) }}.</p>
                </div>
                <button class="js-filter__clear" @click="clearFilter">сбросить фильтры</button>
            </template>
            <div>
                <i></i>
                <p>В {{ counterLabel }} <span>{{ getCounter.all }}</span>
                    {{ declOfNum(getCounter.all, ['товар', 'товара', 'товаров']) }}.</p>
            </div>
        </div>
    </div>
</template>

<script>
import {
    declOfNum
} from '@core/utils/utils'
import {mapActions, mapGetters} from "vuex";

export default {
    data() {
        return {
            filter: {}
        }
    },
    mounted() {
        this.initAttributes()
    },
    computed: {
        ...mapGetters({
            getType: 'catalog/type',
            getCategoryName: 'catalog/categoryName',
            getAttributes: 'catalog/attributes',
            getAttributesByType: 'catalog/attributesByType',
            getCounter: 'catalog/counter',
            getSearch: 'catalog/search'
        }),
        search: {
            get() {
                return this.getSearch
            },
            set(val) {
                if (val.length > 2 || val.length === 0) {
                    this.setSearch(val)
                    this.change()
                }
            }
        },
        counterLabel() {
            if (this.getType === 'catalog') {
                return 'каталоге'
            } else {
                return 'категории "' + this.getCategoryName + '"'
            }
        },
        isFilterActive() {
            for (const attr in this.filter) {
                if (this.filter[attr].length) {
                    return true
                }
            }

            return false
        }
    },
    methods: {
        ...mapActions({
            getProducts: 'catalog/getProducts',
            setFilter: 'catalog/setFilter',
            setSearch: 'catalog/setSearch'
        }),
        initAttributes() {
            Object.keys(this.getAttributes).forEach((attr) => {
                this.$set(this.filter, this.getAttributes[attr].slug, [])
            })
        },
        async change() {
            this.setSearch(this.search)
            this.setFilter(this.filter)
            await this.getProducts()
        },
        async clearFilter() {
            this.search = null
            this.initAttributes()
            this.setSearch(this.search)
            this.setFilter(this.filter)
            await this.getProducts()
        },
        declOfNum
    },
}
</script>