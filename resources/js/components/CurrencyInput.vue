<template>
    <input
            ref="inputRef"
            type="text"
            :value="formattedValue"
    >
</template>

<script>
    import { useCurrencyInput } from 'vue-currency-input'
    import { watch } from '@vue/composition-api'
    export default {
        name: 'CurrencyInput',
        props: {
            value: Number, // Vue 2: value
            options: Object
        },
        setup (props) {
            const {
                inputRef,
                formattedValue,
                setOptions,
                setValue
            } = useCurrencyInput(props.options);
            watch(() => props.value, (value) => { // Vue 2: props.value
                setValue(value)
            })

            watch(() => props.options, (options) => {
                setOptions(options)
            })
            return { inputRef, formattedValue }
        }
    }
</script>