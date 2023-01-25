import Vue from 'vue/dist/vue.js'

import Search from '@modules/search/components/Search'

Vue.component('search', Search)

import ProductGallery from '@modules/catalog/components/ProductGallery'

Vue.component('product-gallery', ProductGallery)

import SimpleCart from "@modules/cart/components/SimpleCart";

Vue.component('simple-cart', SimpleCart)

import Cart from "@modules/cart/components/Cart";

Vue.component('cart', Cart)

import ProductSingle from "@modules/catalog/components/ProductSingle";

Vue.component('product-single', ProductSingle)

import Checkout from "@modules/cart/components/Checkout";

Vue.component('checkout', Checkout)

import OrderHistory from "@modules/order-history/components/Wrapper";

Vue.component('order-history', OrderHistory)

import Filter from "@modules/catalog/components/Filter";

Vue.component('product-filter', Filter)

import SelectedFilters from "@modules/catalog/components/SelectedFilters";

Vue.component('selected-filters', SelectedFilters)

import Profile from "@modules/user/components/Profile";

Vue.component('profile', Profile)

import GroupSelector from "@modules/user/components/GroupSelector";

Vue.component('user-group-selector', GroupSelector)