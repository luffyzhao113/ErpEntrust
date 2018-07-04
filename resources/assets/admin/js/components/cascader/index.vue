<template>
    <Cascader :data="formatData" v-model="formatValue" :change-on-select="true" trigger="hover" :placeholder="placeholder"></Cascader>
</template>

<script>
  export default {
    name: "group-cascader",
    props: {
      data: {
        type: Array,
        default: () => []
      },
      value: {},
      label: {
        type: String,
        default: 'title'
      },
      fValue: {
        type: String,
        default: 'id'
      },
      placeholder: {
        type: String,
        default: ''
      }
    },
    computed: {
      formatData() {
        return this.convert(JSON.parse(JSON.stringify(this.data)))
      },
      formatValue: {
        get() {
          let data = this.data.find(val => val[this.fValue] === this.value)
          if(data){
            let parent = this.findP(this.data, data);
            parent.push(data[this.fValue])
            return parent
          }
          return []

        },
        set(v) {
          if(v[v.length - 1]){
            this.$emit('input', v[v.length - 1])
          }else{
            this.$emit('input', 0);
          }
        }
      }
    },
    methods: {
      convert(arr, id = 0){
        var res = [];
        arr.forEach((item, key) => {
          if(item.parent_id === id){
            delete arr[key];
            res.push({
              value: item[this.fValue],
              label: item[this.label],
              children: this.convert(arr, item.id)
            });
          }
        })
        return res;
      },
      findP(zNodes, node) {
        var ans=[];
        zNodes.forEach((item) => {
          if(item.id === node.parent_id){
            ans.push(item[this.fValue]);
            ans = this.findP(zNodes, item).concat(ans);
          }
        })
        return ans;
      }
    }

  }
</script>

<style scoped>

</style>