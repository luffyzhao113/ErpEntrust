<template>
    <component-modal title="创建权限">
        <Form ref="formCreate" :model="formCreate" :label-width="80">
            <FormItem label="权限标识" prop="name" :rules="{required: true, message: '权限标识不能为空，并且格式为 a-z.a-z ！', pattern: /[a-z]+\.[a-z]+/}">
                <Input v-model="formCreate.name" placeholder="标识"></Input>
            </FormItem>
            <FormItem label="权限名称" prop="display_name" :rules="{required: true, message: '权限名称不能为空'}">
                <Input v-model="formCreate.display_name" placeholder="权限名称"></Input>
            </FormItem>
            <FormItem label="上级菜单" prop="parent_id">
                <group-cascader v-model="formCreate.parent_id" placeholder="顶级菜单可不选择" :data="parents"></group-cascader>
            </FormItem>
            <FormItem label="排序" prop="sort" :rules="{required: true, message: '排序不能为空'}">
                <Input v-model="formCreate.sort" placeholder="排序"></Input>
            </FormItem>
            <FormItem label="菜单图标" prop="icon">
                <Input v-model="formCreate.icon" placeholder="菜单图标"></Input>
            </FormItem>
            <FormItem label="是否菜单" prop="islink">
                <RadioGroup v-model="formCreate.islink" type="button">
                    <Radio :label="1" :value="1">菜单</Radio>
                    <Radio :label="0" :value="0">权限</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="菜单描述" prop="description" :rules="{max: 200}">
                <Input v-model="formCreate.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="菜单描述"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button :loading="loading" @click="createSubmit('formCreate', 'permission')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
  import component from "../../../mixins/component";
  import ComponentModal from "@/admin/js/components/modal/component-modal";
  import GroupOption from "@/admin/js/components/select/group-option";
  import GroupCascader from "@/admin/js/components/cascader/index";
  import form from "../../../mixins/form";

  export default {
    components: {
      GroupCascader,
      GroupOption,
      ComponentModal},
    name: "create",
    mixins:[component, form],
    data(){
      return {
        formCreate: {
          islink: 0,
          name: '',
          parent_id: 0,
          icon: '',
          display_name: '',
          description: '',
          sort: 1
        },
        parents: []
      }
    },
    mounted(){
      this.$http.get(`permission`, {
        params: {islink: 1}
      }).then((res) => {
        this.parents = res.data.data
      })
    }
  }
</script>

<style scoped>

</style>