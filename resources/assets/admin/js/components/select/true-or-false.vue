<template>
    <Select v-model="model" clearable @on-change="setValue">
        <Option :value="1">{{trueValueModel}}</Option>
        <Option :value="0">{{falseValueModel}}</Option>
    </Select>
</template>

<script>
    export default {
        name: "true-or-false",
        props: {
            value: [String, Number],
            trueValue: {
                type: String,
                default: '是'
            },
            falseValue: {
                type: String,
                default: '否'
            }
        },
        data() {
            return {
                model: this.value,
                trueValueModel: this.trueValue,
                falseValueModel: this.falseValue,
            }
        },
        methods: {
            setValue(val){
                this.$emit('input', val)
            }
        },
        watch: {
            value(val){
                this.model = val
            },
            falseValue(val){
                this.falseValueModel = val
            },
            trueValue(val){
                this.trueValueModel = val
            }
        }
    }
</script>

<style scoped>

</style>