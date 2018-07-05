<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" inline>
                <FormItem prop="admin_id" label="用户姓名" :label-width="60">
                    <admin-select v-model="searchForm.admin_id"></admin-select>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                    <Button @click="showComponent('Create')" type="warning">添加</Button>
                </FormItem>
            </Form>
        </Card>
    </my-lists>
</template>

<script>
    import MyLists from "../../../components/layout/my-lists";
    import lists from "../../../mixins/lists";
    import AdminSelect from "../../components/admin/select";
    
    export default {
        name: "index",
        components: {AdminSelect, MyLists},
        mixins: [lists],
        data(){
            return {
                columns: [{
                    title: "操作",
                    key: "display_name"
                },{
                  title: "状态",
                  key: "status_code"
                },{
                    title: "操作人",
                    render: (h, {row}) => {
                        return <span>{row.admin ? row.admin.name : '-'}</span>
                    }
                },{
                  title: "操作时间",
                  key: "created_at"
                }]
            }
        },
        methods: {
            search(page = 1){
                this.$http.get(`logs`, {params: this.request(page)}).then((res) => {
                    this.assignmentData(res.data.data)
                }).catch((res) => {
                    this.formatErrors(res)
                });
            }
        }
    }
</script>

<style scoped>

</style>