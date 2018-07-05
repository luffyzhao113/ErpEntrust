<template>
    <Select v-model="model" placeholder="请选择用户" @on-change="setValue" clearable filterable>
        <Option v-for="(item, index) in roles" :key="index" :value="item.id">{{item.name}}</Option>
    </Select>
</template>

<script>
    export default {
        name: "admin-select",
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
                return this.$store.state.Admin.data
            }
        },
        mounted: function () {
            this.$nextTick(() => {
                if(this.$store.state.Admin.data.length === 0) {
                    this.$http.get(`admin/select`).then((res) => {
                        this.$store.commit('setAdminData', res.data.data);
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