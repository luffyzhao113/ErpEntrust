<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" inline>
                <FormItem prop="name" label="角色名称" :label-width="60">
                    <Input type="text" v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>

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