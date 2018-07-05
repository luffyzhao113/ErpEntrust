<template>
    <Select v-model="model" placeholder="请选择角色" @on-change="setValue" clearable filterable>
        <Option v-for="(item, index) in roles" :key="index" :value="item.id">{{item.name}}</Option>
    </Select>
</template>

<script>
  export default {
    name: "roles-select",
    props: {
      value: [String, Number]
    },
    data() {
      return {
        model: this.value,
      }
    },
    computed: {
      roles() {
        return this.$store.state.Role.data
      }
    },
    mounted: function () {
      this.$nextTick(() => {
        if(this.$store.state.Role.data.length === 0) {
          this.$http.get(`role/select`).then((res) => {
            this.$store.commit('setRolesData', res.data.data);
          })
        }
      });
    },
    methods: {
      setValue(val){
        this.$emit('input', val)
      }
    },
    watch: {
      value(val){
        this.model = val
      }
    }
  }
</script>

<style scoped>

</style>