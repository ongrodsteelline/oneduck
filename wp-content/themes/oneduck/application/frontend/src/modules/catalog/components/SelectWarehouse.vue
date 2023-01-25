<template>
        <div id="dropdownMenuButton"
                aria-expanded="false"
                aria-haspopup="true"
                class="btn btn-secondary drop__btn dropdown-toggle"
                data-toggle="dropdown"
        >
            <i class="ic-warehouse"></i>
            <p class="number_warehouse_desktop">{{ labelState }}</p>
            <p class="number_warehouse_mobile">{{ labelStateMob }}</p>
            <i class="ic-arrow_down"></i>
        </div>
        <div aria-labelledby="dropdownMenuButton" class="dropdown-menu dropdown__header__menu">
            <div class="dropdown_text_desc">Выберите склады:</div>
            <a v-for="(warehouse, index) in warehouseList"
               :key="warehouse.term_id"
               :class="{'warehouse-active': warehouse.active}"
               class="dropdown-item drop__item"
               href="#"
               @click="toggleWarehouse($event, index)"
            >
                {{ warehouse.name }}
            </a>
        </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import axiosCancel from 'axios-cancel'
import axios from 'axios'
import { buildFormData } from '../../../core/utils/utils'
import { useStore } from 'vuex'

const props = defineProps({
    data: Array
})

const store = useStore()

const warehouseList = ref(props.data)

onMounted(() => {
    store.dispatch('user/setWarehouses', selectedWarehouses.value)
})

const labelState = computed(() => {
    if (selectedWarehouses.value.length === 0) {
        return 'Склады не выбраны'
    }

    if (selectedWarehouses.value.length === warehouseList.value.length) {
        return 'Все склады'
    }

    if (selectedWarehouses.value.length < warehouseList.value.length) {
        return `Склады: ${selectedWarehouses.value.length} из ${warehouseList.value.length}`
    }
})

const labelStateMob = computed(() => {
    if (selectedWarehouses.value.length === 0) {
        return 'Нет'
    }

    if (selectedWarehouses.value.length === warehouseList.value.length) {
        return 'Все'
    }

    if (selectedWarehouses.value.length < warehouseList.value.length) {
        return `${selectedWarehouses.value.length}/${warehouseList.value.length}`
    }
})

const toggleWarehouse = (e, index) => {
    e.stopPropagation()
    warehouseList.value[index]['active'] = !warehouseList.value[index]['active']

    store.dispatch('user/setWarehouses', selectedWarehouses.value)

    const form = new FormData()

    buildFormData(form, {
        action: 'store_user_warehouses',
        warehouses: selectedWarehouses.value
    })

    axiosCancel(axios)

    axios({
        method: 'post',
        url: '/wp-admin/admin-ajax.php',
        data: form,
        requestId: 'storeUserWarehouses'
    }).then(() => {
        store.dispatch('catalog/getProducts')
    })
}

const selectedWarehouses = computed(() => {
    return warehouseList.value.filter(e => e.active === true).map((warehouse) => {
        return warehouse.term_id
    })
})
</script>

<style lang="scss">
.warehouse-active {
    background-color: #066ed5 !important;
    color: #fff !important;
}
</style>
