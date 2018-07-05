<template>
    <my-lists v-model="data" :columns="columns" @change="search">

        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" :label-width="80" inline>
                <FormItem prop="role_id" label="所属角色" :label-width="60">
                    <roles-select v-model="searchForm.role_id"></roles-select>
                </FormItem>
                <FormItem prop="name" label="用户名" :label-width="50">
                    <Input type="text" v-model="searchForm.name"></Input>
                </FormItem>
                <FormItem prop="email" label="邮箱" :label-width="40">
                    <Input type="text" v-model="searchForm.email"></Input>
                </FormItem>
                <FormItem prop="status" label="状态" :label-width="40">
                    <true-or-false v-model="searchForm.status" true-value="开启" false-value="关闭"></true-or-false>
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
    import Update from "./update";
    import Create from "./create"
    import RolesSelect from "../../components/roles/select";
    import TrueOrFalse from "../../../components/select/true-or-false";
    
    export default {
        name: "index",
        components: {
            TrueOrFalse,
          RolesSelect,
          MyLists, Create, Update},
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: '登录邮箱',
                    key: 'email'
                },{
                  title: '用户名称',
                  key: 'name'
                }, {
                    title: '所属角色',
                    render: (h, {row}) => {
                        return <span>{row.roles.name}</span>
                    }
                },{
                    title: '状态',
                    render: (h, {row}) => {
                        return <span>{row.status === 1 ? '开启' : '关闭'}</span>
                    }
                }, {
                    title: '操作',
                    render: (h, {row}) => {
                        return  (<button-group>
                            <i-button size="small" disabled={row.roles.super != 0} on-click={()=>this.showComponent('Update', row)}>修改</i-button>
                            <poptip
                                confirm
                                transfer
                                title="确定要删除吗？"
                                on-on-ok={()=>this.destroyItem(row, `admin/${row.id}`)}
                            >
                                <i-button size="small" disabled={row.roles.super != 0}>删除</i-button>
                            </poptip>
                        </button-group>);
                    }
                }]
            }
        },
        methods: {
            search(page = 1){
                this.$http.get(`admin`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data);
                }).catch((res) => {
                  this.formatErrors(res)
                })
            }
        }
    }
</script>

<style scoped>

</style>