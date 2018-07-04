<template>
    <Select v-model="model">
        <template v-for="(item, key) in data">
        <OptionGroup v-if="item.children && item.children.length" :label="item.name">
            <Option v-for="value in item.children" :value="value.id" :key="value.id">{{ value.name }}</Option>
        </OptionGroup>
        <Option v-else :value="item.id" :key="item.id">{{ item.name }}</Option>
        </template>
    </Select>
</template>

<script>
  export default {
    name: "group-option",
    props: {
      value: {},
      data: {
        type: Array,
        default: () => []
      }
    },
    data(){
      return {
        model: this.value
      }
    },
    watch: {
      model(val){
        this.$emit('input', val)
      }
    }
  }
</script>

<style scoped>

</style>