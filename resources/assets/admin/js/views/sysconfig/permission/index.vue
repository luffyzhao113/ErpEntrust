<template>
    <div>
        <div class="box-flex-list">
            <Card>
                <p slot="title">
                    <span>列表</span>
                    <Button size="small" type="success" @click="showComponent('Create')">添加</Button>
                </p>
                <TabelExpandTree :columns="columns" :data="lists" class="permission-role"></TabelExpandTree>
            </Card>
        </div>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </div>
</template>

<script>

  import lists from "../../../mixins/lists";
  import Create from "./create"
  import Update from "./update"
  import TabelExpandTree from '../../../components/table/tabel-expand-tree'

  export default {
    components: {
      TabelExpandTree,
      Create,
      Update
    },
    mixins: [lists],
    name: "index",
    data() {
      return {
        columns: [
          {
            title: '菜单名称',
            key: 'title',
            render: (h, {row}) =>{
              return <span class="table-col-title">{row.title}</span>
            }
          },
          {
            title: '菜单路径',
            key: 'name'
          },
          {
            title: '排序',
            key: 'sort'
          },
          {
            title: '是否菜单',
            render: (h, {row}) =>{
              return (<span>{row.islink ? '菜单' : '权限'}</span>)
            }
          },
          {
            title: '菜单图标',
            key: 'icon'
          },{
            title: '操作',
            render: (h, {row})=>{
              return (<button-group>
                <i-button size="small" on-click={()=>this.showComponent('Update', row)}>修改</i-button>
                <i-button disabled={(this.child(row.id).length > 0)}
                          size="small"
                          on-click={() => this.destroyItem(row, `permission/${row.id}`)}>删除</i-button>
              </button-group>);
            }
          }
        ],
        lists: []
      }
    },
    methods: {
      search(page = 1){
        this.$http.get(`permission`).then((res) => {
          this.lists = res.data.data
        }).catch((res) => {
          this.formatErrors(res)
        })
      },
      child(parent) {
        return this.lists.filter(val => val.parent_id == parent)
      }
    }
  }
</script>

<style>
    .permission-role .ivu-table-body {
        overflow-y: auto;
    }
</style>