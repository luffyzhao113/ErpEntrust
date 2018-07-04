<template>
    <component-modal title="创建用户">
        <Form ref="formCreate" :model="formCreate" :label-width="80" :rules="ruleCreate">
            <FormItem label="用户姓名" prop="name">
                <Input v-model="formCreate.name" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户邮箱" prop="email">
                <Input v-model="formCreate.email" placeholder="用户邮箱"></Input>
            </FormItem>
            <FormItem label="用户角色" prop="role_id">
                <roles-select v-model="formCreate.role_id"></roles-select>
            </FormItem>
            <FormItem label="用户密码" prop="password">
                <Input v-model="formCreate.password" placeholder="用户密码"/>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
                <Input v-model="formCreate.password_confirmation" placeholder="确认密码"/>
            </FormItem>
            <FormItem label="是否开启" prop="status">
                <RadioGroup v-model="formCreate.status" type="button">
                    <Radio :label="1" :value="1">开启</Radio>
                    <Radio :label="0" :value="0">关闭</Radio>
                </RadioGroup>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button :loading="loading" @click="createSubmit('formCreate', 'admin')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "@/admin/js/components/modal/component-modal";
    import form from "@/admin/js/mixins/form";
    import PhotoOnce from "../../../components/upload/photo";
    import {Validator} from "../../../async-validator/sysconfig/admin/create"
    import RolesSelect from "../../components/roles/select";
    import component from "../../../mixins/component";

    export default {
        name: "create",
        components: {
          RolesSelect,
          PhotoOnce,
          ComponentModal},
        mixins: [component, form],
        data () {
            return {
                formCreate: {
                    name: '',
                    password: '',
                    password_confirmation: '',
                    status: 1,
                    role_id: '',
                    email: ''
                },
                ruleCreate: Validator(this)
            }
        }
    }
</script>

<style scoped>

</style>