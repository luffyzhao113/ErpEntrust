<template>
    <component-modal title="创建角色">
        <Form ref="formCreate" :model="formCreate" :label-width="80">
            <FormItem label="角色名称" prop="name" :rules="{required: true, message: '角色名称不能为空'}">
                <Input v-model="formCreate.name" placeholder="角色名称"></Input>
            </FormItem>
            <FormItem label="是否开启" prop="status">
                <RadioGroup v-model="formCreate.status" type="button">
                    <Radio :label="1" :value="1">开启</Radio>
                    <Radio :label="0" :value="0">关闭</Radio>
                </RadioGroup>
            </FormItem>
            <FormItem label="角色描述" prop="description">
                <Input v-model="formCreate.description" type="textarea" placeholder="角色描述"></Input>
            </FormItem>
        </Form>
        <div slot="footer">
            <Button :loading="loading" @click="createSubmit('formCreate', 'role')">创建</Button>
        </div>
    </component-modal>
</template>

<script>
    import ComponentModal from "../../../components/modal/component-modal";
    import form from "@/admin/js/mixins/form";
    import component from "@/admin/js/mixins/component";
    export default {
        name: "create",
        components: {ComponentModal},
        mixins: [form, component],
        data(){
            return {
                formCreate: {
                    name: '',
                    status: 1,
                    description: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>