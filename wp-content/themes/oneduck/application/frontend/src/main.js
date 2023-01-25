import { createApp } from 'vue/dist/vue.esm-bundler'

import store from './core/store'
import router from './core/router'

import './core/scss/main.scss'

import Search from './modules/search/components/Search.vue'
import ProductGallery from './modules/catalog/components/ProductGallery.vue'
import SimpleCart from './modules/cart/components/SimpleCart.vue'
import Cart from './modules/cart/components/Cart.vue'
import ProductSingle from './modules/catalog/components/ProductSingle.vue'
import Checkout from './modules/cart/components/Checkout.vue'
import OrderHistory from './modules/order-history/components/Wrapper.vue'
import Filter from './modules/catalog/components/Filter.vue'
import SelectedFilters from './modules/catalog/components/SelectedFilters.vue'
import SwitchCatalogColumn from './modules/catalog/components/SwitchCatalogColumn.vue'
import Brand from './modules/catalog/components/Brand.vue'
import Profile from './modules/user/components/Profile.vue'
import GroupSelector from './modules/user/components/GroupSelector.vue'
import SelectWarehouse from './modules/catalog/components/SelectWarehouse.vue'

const app = createApp({})
app.use(router)
app.use(store)

app.component('search', Search)
app.component('product-gallery', ProductGallery)
app.component('simple-cart', SimpleCart)
app.component('cart', Cart)
app.component('product-single', ProductSingle)
app.component('checkout', Checkout)
app.component('order-history', OrderHistory)
app.component('product-filter', Filter)
app.component('selected-filters', SelectedFilters)
app.component('switch-catalog-column', SwitchCatalogColumn)
app.component('profile', Profile)
app.component('user-group-selector', GroupSelector)
app.component('brand', Brand)
app.component('select-warehouse', SelectWarehouse)

app.mount('#app')
