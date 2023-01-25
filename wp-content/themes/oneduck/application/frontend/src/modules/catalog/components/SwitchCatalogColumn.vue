<template>
    <div class="catalog-switcher" @click.prevent="switchValue">
        {{ props.label }}
        <label class="switcher">
            <input v-model="state" type="checkbox">
            <span class="switcher__slider"></span>
        </label>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useStore } from 'vuex'
import axios from 'axios'
import { buildFormData } from '@/core/utils/utils'

const props = defineProps({
    label: String,
    slug: String,
    value: Boolean
})

const store = useStore()

const state = ref(props.value)

onMounted(() => {
    if (state.value === true) {
        store.dispatch('catalog/toggleHiddenColumn', props.slug)
    }
})

const switchValue = () => {
    state.value = !state.value
    store.dispatch('catalog/toggleHiddenColumn', props.slug)

    const form = new FormData()

    buildFormData(form, {
        action: 'switch_catalog_column',
        columns: store.getters['catalog/hiddenColumns']
    })

    axios({
        method: 'post',
        url: '/wp-admin/admin-ajax.php',
        data: form
    })
}
</script>

<style lang="scss" scoped>
.catalog-switcher {
    align-items: center;
    cursor: pointer;
    display: flex;
}

.switcher {
    $block: &;
    display: inline-block;
    height: 34px;
    position: relative;
    width: 60px;

    input {
        height: 0;
        opacity: 0;
        width: 0;

        &:checked + #{$block}__slider {
            background-color: #2196F3;

            &:before {
                transform: translateX(16px);
            }
        }

        &:focus + #{$block}__slider {
            box-shadow: 0 0 1px #2196F3;
        }
    }

    &__slider {
        background-color: #ccc;
        border-radius: 34px;
        bottom: 0;
        cursor: pointer;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: .4s;

        &:before {
            background-color: white;
            border-radius: 50%;
            bottom: 4px;
            content: "";
            height: 26px;
            left: 4px;
            position: absolute;
            transition: .4s;
            width: 26px;
        }
    }
}
</style>
