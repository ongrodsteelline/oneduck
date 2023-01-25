<template>
    <div class="selected-filters">
        <div class="filter-item" v-if="getSearch">
            Поиск: {{ getSearch }}
            <a href="#" @click.prevent="clearSearch">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 409.806 409.806">
                    <g>
                        <g>
                            <path d="M228.929,205.01L404.596,29.343c6.78-6.548,6.968-17.352,0.42-24.132c-6.548-6.78-17.352-6.968-24.132-0.42
			c-0.142,0.137-0.282,0.277-0.42,0.42L204.796,180.878L29.129,5.21c-6.78-6.548-17.584-6.36-24.132,0.42
			c-6.388,6.614-6.388,17.099,0,23.713L180.664,205.01L4.997,380.677c-6.663,6.664-6.663,17.468,0,24.132
			c6.664,6.662,17.468,6.662,24.132,0l175.667-175.667l175.667,175.667c6.78,6.548,17.584,6.36,24.132-0.42
			c6.387-6.614,6.387-17.099,0-23.712L228.929,205.01z" fill="#066ed5"/>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
        <div class="filter-item" v-for="item in selected" :key="item.id">
            {{ item.label }}: {{ item.name }}
            <a href="#" @click.prevent="removeSelected(item)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 409.806 409.806">
                    <g>
                        <g>
                            <path d="M228.929,205.01L404.596,29.343c6.78-6.548,6.968-17.352,0.42-24.132c-6.548-6.78-17.352-6.968-24.132-0.42
			c-0.142,0.137-0.282,0.277-0.42,0.42L204.796,180.878L29.129,5.21c-6.78-6.548-17.584-6.36-24.132,0.42
			c-6.388,6.614-6.388,17.099,0,23.713L180.664,205.01L4.997,380.677c-6.663,6.664-6.663,17.468,0,24.132
			c6.664,6.662,17.468,6.662,24.132,0l175.667-175.667l175.667,175.667c6.78,6.548,17.584,6.36,24.132-0.42
			c6.387-6.614,6.387-17.099,0-23.712L228.929,205.01z" fill="#066ed5"/>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
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
                            name: 'Да'
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

        :deep svg {
            width: 100%;
            height: 100%;
        }
    }
}
</style>
