<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Button slot="button" size="small" type="success" @click="showComponent('Create')">添加</Button>
        <components v-bind:is="component.current" @on-change="hideComponent" :data="component.data"></components>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import Update from "./update";
    import Create from "./create"
    
    export default {
        name: "index",
        components: {MyLists, Create, Update},
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: '登录邮箱',
                    key: 'email'
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