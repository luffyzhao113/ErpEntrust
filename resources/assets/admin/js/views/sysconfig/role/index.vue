<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Button slot="button" size="small" type="success" @click="showComponent('Create')">添加</Button>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
  import MyLists from "../../../components/layout/my-lists";
  import lists from "../../../mixins/lists";
  import Create from "./create"
  import Update from "./update"
  import Permission from "./permission"

  export default {
    components: {MyLists, Create, Update, Permission},
    mixins: [lists],
    name: "index",
    data(){
      return {
        columns: [{
          title: '角色名称',
          key: 'name'
        }, {
          title: '用户数量',
          key: 'users_count'
        }, {
          title: '操作',
          render: (h, {row}) => {
            return (<button-group>
              <i-button size="small" on-click={()=>this.showComponent('Update', row)}>修改</i-button>
              <i-button size="small" on-click={()=>this.showComponent('Permission', row)}>分配权限</i-button>
              <poptip
                confirm
                transfer
                title="确定要删除吗？"
                on-on-ok={()=>this.destroyItem(row, `role/${row.id}`)}
              >
                <i-button size="small">删除</i-button>
              </poptip>
            </button-group>);
          }
        }]
      }
    },
    methods:{
      search(page = 1){
        this.$http.get(`role`, {params: this.request(page)}).then((res) => {
            this.assignmentData(res.data.data);
        })
      }
    }
  }
</script>

<style scoped>

</style>