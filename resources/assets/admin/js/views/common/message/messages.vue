<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <span class="notice-title" slot="title">
            <Badge :class="{active: active === 'all'}">
                <span @click="cursor('all')">全部 </span>
            </Badge>
            <Badge dot :count="messageTotal" :class="{active: active === 'notRead'}">
                <span @click="cursor('notRead')">未读({{messageTotal}})</span>
            </Badge>
            <Badge :class="{active: active === 'read'}">
                <span @click="cursor('read')">已读</span>
            </Badge>
        </span>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
  import MyLists from "../../../components/layout/my-lists";
  import lists from "../../../mixins/lists";
  import TrueOrFalse from "../../../components/select/true-or-false";
  import Show from "./show"

  export default {
    components: {TrueOrFalse, MyLists, Show},
    name: "messages",
    mixins: [lists],
    computed: {
      messageTotal(){
        return this.$store.state.Messages.total
      }
    },
    data() {
      return {
        columns: [{
          title: '标题',
          render: (h, {row}) => {
            return <span>{row.data.title}</span>
          }
        },{
          title: '状态',
          render: (h, {row}) => {
            return <span>{row.read_at ? '已读' : '未读'}</span>
          }
        },{
          title: '发送时间',
          key: 'created_at'
        },{
          title: '操作',
          render: (h, {row}) => {
            return <i-button size="small" on-click={()=>this.showComponent('Show', row)}>查看</i-button>
          }
        }],
        active: 'all'
      };
    },
    methods:{
      search(page = 1){
        this.$http.get(`auth/message`, {params: this.request(page)}).then((res) => {
          this.assignmentData(res.data.data);
        })
      },
      cursor(type){
        this.active = type
        if(type == 'all'){
          this.searchForm.read_at = '';
        }else if(type === 'notRead'){
          this.searchForm.read_at = 1
        }else if(type === 'read'){
          this.searchForm.read_at = 0
        }
        this.search(1)
      }
    }
  }
</script>

<style>
    .notice-title .ivu-badge{
        margin: 0 10px;
        cursor: pointer;
    }
    .notice-title .active{
        color: #2d8cf0;
    }
</style>