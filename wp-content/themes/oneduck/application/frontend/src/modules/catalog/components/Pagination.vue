<template>
    <ul class="pagination">
        <span v-if="pages.length">Страница:</span>
        <li v-for="page in pages" :key="(page.num !== '...') ? page.num : Math.floor(Math.random() * 1000000)"
            class="page-item pagination__item" :class="page.isCurrent ? 'active' : null">
            <router-link :to="routeLink(page.num)" v-slot="{ href, route }">
                <a :href="href"
                   class="page-link pagination__link"
                   @click="navigate($event, route)"
                >
                    {{ page.num }}
                </a>
            </router-link>
        </li>
    </ul>
</template>

<script>
import {
    mapGetters,
    mapActions
} from 'vuex'

export default {
    data() {
        return {
            items: []
        }
    },
    computed: {
        ...mapGetters({
            pages: 'catalog/pages',
            type: 'catalog/type',
            categoryId: 'catalog/categoryId',
            limit: 'catalog/limit'
        }),
    },
    methods: {
        ...mapActions({
            setPaged: 'catalog/setPaged',
            getProducts: 'catalog/getProducts'
        }),
        routeLink(id) {
            const route = {}
            if (id === 1) {
                route.name = 'index'
            } else {
                route.name = 'page'
                route.params = {
                    id: id
                }
            }

            return route
        },
        async navigate(e, route) {
            e.preventDefault()

            let next = this.$router.resolve(route)
            if (next.path !== this.$route.path) {
                const paged = (route.params.id) ? route.params.id : 1
                this.setPaged(paged)
                await this.getProducts()

                this.$router.push(route)
            }
        }
    }
}
</script>
