<template>
    <component-modal title="更新用户">
        <Form ref="formUpdate" :model="formUpdate" :label-width="80" :rules="ruleUpdate">
            <FormItem label="用户姓名" prop="name">
                <Input v-model="formUpdate.name" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户邮箱" prop="email">
                <Input v-model="formUpdate.email" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户角色" prop="role_id">
                <roles-select v-model="formUpdate.role_id"></roles-select>
            </FormItem>
            <FormItem label="用户密码" prop="password">
                <Input v-model="formUpdate.password" placeholder="用户密码"/>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input v-model="formUpdate.password_confirmation" placeholder="确认密码"/>
            </FormItem>
            <FormItem label="是否开启" prop="status">
                <RadioGroup v-model="formUpdate.status" type="button">
                    <Radio :label="1" :value="1">开启</Radio>
                    <Radio :label="0" :value="0">关闭</Radio>
                </RadioGroup>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button :loading="loading" @click="updateSubmit('formUpdate', `admin/${data.id}`)">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "@/admin/js/components/modal/component-modal";
    import form from "@/admin/js/mixins/form";
    import {Validator} from "../../../async-validator/sysconfig/admin/update"
    import RolesSelect from "../../components/roles/select";
    import component from "../../../mixins/component";

    export default {
        name: "update",
        components: {
          RolesSelect,
          ComponentModal},
        mixins: [component, form],
        data(){
          return {
            formUpdate: {
              name: '',
              password: '',
              password_confirmation: '',
              status: 1,
              role_id: '',
              email: ''
            },
            ruleUpdate: Validator(this)
          }
        },
        mounted(){
          this.$nextTick(() => {
            this.$http.get(`admin/${this.data.id}`).then((res) => {
              this.formUpdate = Object.assign(this.unObserver(this.formUpdate), res.data.data)
            }).catch((err) => {
              this.formatErrors(err)
            })
          })
        }
    }
</script>

<style scoped>

</style>