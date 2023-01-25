<template>
    <div class="selected-filters">
        <div class="filter-item" v-if="getSearch">
            Поиск: {{ getSearch }}
            <a href="#" v-html="closeIcon" @click.prevent="clearSearch"/>
        </div>
        <div class="filter-item" v-for="item in selected" :key="item.id">
            {{ item.label }}: {{ item.name }}
            <a href="#" v-html="closeIcon" @click.prevent="removeSelected(item)"/>
        </div>
    </div>
</template>

<script>
import CloseIcon from '!!raw-loader?!@assets/icons/close.svg'
import {mapActions, mapGetters} from "vuex";
export default {
    data() {
        return {
            closeIcon: CloseIcon
        }
    },
    computed: {
        ...mapGetters({
            getFilter: 'catalog/filter',
            getAttributes: 'catalog/attributes',
            getSearch: 'catalog/search'
        }),
        selected() {
            let selected = []

            Object.keys(this.getFilter).forEach((parentKey) => {
                if (this.getFilter[parentKey].length) {
                    const attribute = Object.values(this.getAttributes).find(attr => attr.slug === parentKey)

                    if (attribute.type === 'select') {
                        this.getFilter[parentKey].forEach((childKey, childIndex) => {
                            const option = attribute.items.find(o => o.id === childKey)

                            selected.push({
                                index: childIndex,
                                parent: attribute.slug,
                                label: attribute.name,
                                name: option.name
                            })
                        })
                    } else if (attribute.type === 'toggle') {
                        selected.push({
                            index: 0,
                            parent: attribute.slug,
                            label: attribute.name,
                            name: attribute.name
                        })
                    }
                }
            })

            return selected
        }
    },
    methods: {
        ...mapActions({
            getProducts: 'catalog/getProducts',
            removeFilterItem: 'catalog/removeFilterItem',
            setSearch: 'catalog/setSearch'
        }),
        removeSelected(item) {
            this.removeFilterItem(item)
            this.getProducts()
        },
        clearSearch() {
            this.setSearch(null)
            this.getProducts()
        }
    }
}
</script>

<style lang="scss" scoped>
.selected-filters {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    margin-left: 20px;
}

.filter-item {
    display: flex;
    align-items: center;
    height: 32px;
    border: 1px solid #d2d2d2;
    border-radius: 50px;
    padding: 0 10px;
    color: #333;
    transition: all .2s ease-in-out;
    line-height: 16px;
    margin-top: 3px;
    margin-bottom: 3px;
    margin-right: 10px;

    a {
        display: flex;
        width: 10px;
        height: 10px;
        color: #ff8989;
        margin-left: 6px;

        ::v-deep svg {
            width: 100%;
            height: 100%;
        }
    }
}
</style>