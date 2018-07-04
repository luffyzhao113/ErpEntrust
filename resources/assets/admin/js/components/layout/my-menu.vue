<template>
    <Menu theme="dark" :open-names="['1']" accordion mode="vertical" width="auto" :active-name="currentPage" @on-select="menuRouter">
        <MenuItem name="common.home">
            <Icon type="ios-home"></Icon>
            首页
        </MenuItem>
        <template v-for="(item, key) in menuLists">
            <MenuItem v-if="!item.children" :name="item.name">
                <Icon :type="item.icon"></Icon>
                {{item.display_name}}
            </MenuItem>

            <Submenu v-if="item.children" :name="item.name">
                <template slot="title">
                    <Icon :type="item.icon"></Icon>
                    {{item.display_name}}
                </template>
                <template v-for="(value, index) in item.children">
                    <MenuItem v-if="!value.children" :name="value.name">{{value.display_name}}</MenuItem>
                    <MenuGroup v-if="value.children" :title="value.display_name">
                        <MenuItem v-for="(val, i) in value.children" :key="i" :name="val.name">{{val.display_name}}</MenuItem>
                    </MenuGroup>
                </template>
            </Submenu>
        </template>
    </Menu>
</template>

<script>
    import Tools from '@/admin/js/mixins/tools'
    import { mapGetters } from 'vuex'

    export default {
        name: "my-menu",
        mixins: [Tools],
        methods:{
            menuRouter (name) {
                this.$router.push({
                    name
                })
            }
        },
        computed: {
            ...mapGetters([
                'menus'
            ]),
            currentPage () {
                return this.$store.state.App.currentPage
            },
            menuLists(){
                return this.toTree(JSON.parse(JSON.stringify(this.menus)))
            },
        },
        mounted(){
          this.$http.get(`auth/permission`).then((res) => {
            this.$store.commit('setAuthPerms', res.data.data)
          })
        }
    }
</script>

<style scoped>

</style>