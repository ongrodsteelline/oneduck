<template>
    <tbody>
    <tr data-caption="radiator">
        <td colspan="11">
            <h2>{{ name }} <span class="symma">{{ sum.toFixed(2) }}</span></h2>
        </td>
    </tr>
    <slot/>
    </tbody>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true
        },
        sum: {
            type: Number,
            default: 0.00
        }
    }
}
</script>