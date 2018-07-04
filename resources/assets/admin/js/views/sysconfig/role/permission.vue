<template>
    <component-modal title="分配权限">
        <Tree :data="treePermissions" show-checkbox></Tree>
        <div slot="footer">
            <Button :loading="loading" @click="correlationSubmit()">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import component from "../../../mixins/component";
    import http from "../../../mixins/http";
    import tools from "../../../mixins/tools";

    export default {
        components: {ComponentModal},
        mixins: [component, http, tools],
        name: "permission",
        data() {
            return {
                role: {
                    perms: []
                },
                oldPermissions: []
            }
        },
        computed: {
            treePermissions() {
                let data = [];
                JSON.parse(JSON.stringify(this.oldPermissions)).forEach((item) => {
                    data.push({
                        id: item.id,
                        parent_id: item.parent_id,
                        title: item.title,
                        expand: true,
                        indeterminate: this.indeterminate(item),
                        checked: this.checked(item)
                    })
                });
                return this.toTree(data)
            },
            permissions() {
                return this.toChecked(JSON.parse(JSON.stringify(this.treePermissions)))
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.$http.get(`permission`).then((res) => {
                    this.oldPermissions = res.data.data
                }).catch((res) => {
                    this.formatErrors(res)
                })

                this.$http.get(`role/${this.data.id}/permission`).then((res) => {
                    this.role = res.data.data
                }).catch((res) => {
                    this.formatErrors(res)
                })

            })
        },
        methods: {
            correlationSubmit(){
                this.loading = true
                this.$http.post(`role/${this.data.id}/permission`, {
                    permission: this.permissions
                }).then((res) => {
                    this.$Message.success('Success!');
                    this.change(false)
                }).catch((res) => {
                    this.formatErrors(res)
                }).finally(() => {
                    this.loading = false
                })
            },
            child(parent) {
                return this.oldPermissions.filter(val => val.parent_id == parent)
            },
            indeterminate(item) {
                let hasChild = this.child(item.id).length > 0
                if (!hasChild) {
                    return false
                }
                let has = typeof this.role.perms.find(val => val.id === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            checked(item) {
                let hasChild = this.child(item.id).length > 0
                if (hasChild) {
                    return false
                }
                let has = typeof this.role.perms.find(val => val.id === item.id) !== 'undefined'
                if (has) {
                    return true
                }
                return false;
            },
            toChecked(data) {
                let arr = [];
                data.forEach((item) => {
                    if(item.indeterminate === true || item.checked === true ){
                        arr.push(item.id)
                        if (item.children && item.children.length > 0) {
                            arr = arr.concat(this.toChecked(item.children));
                        }
                    }

                });
                return arr
            }
        }
    }
</script>

<style scoped>

</style>