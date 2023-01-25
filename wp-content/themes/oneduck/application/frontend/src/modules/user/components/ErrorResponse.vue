<template>
    <div>
        <p>{{ message }}</p>
        <button type="button" @click="close">OK</button>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String
        }
    },
    methods: {
        close() {
            this.$emit('close')
        }
    }
}
</script>