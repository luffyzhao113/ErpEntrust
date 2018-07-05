<template lang="html">
    <div>
      <Card>
        <p slot="title"><Icon type="ios-person"></Icon>个人信息</p>
        <div>
          <Form :model="formUpdate" label-position="right" :label-width="100" ref="formUpdate" :rules="ruleCreate">
            <FormItem label="用户姓名:" prop="name">
              <Input v-model="formUpdate.name" style="width: 300px"></Input>
            </FormItem>
            <FormItem label="登录邮箱:" prop="email">
              <Input v-model="formUpdate.email" style="width: 300px"></Input>
            </FormItem>
            <FormItem label="用户密码" prop="password">
              <Input v-model="formUpdate.password" placeholder="用户密码" style="width: 300px"/>
            </FormItem>
            <FormItem label="确认密码" prop="password_confirmation">
              <Input v-model="formUpdate.password_confirmation" placeholder="确认密码" style="width: 300px"/>
            </FormItem>
            <FormItem>
              <Button type="primary" @click="updateSubmit('formUpdate', 'auth/user')" style="width: 100px">保存</Button>
            </FormItem>
          </Form>
        </div>
      </Card>
    </div>
</template>

<script>
  import {Validator} from "../../async-validator/common/profile/index"

export default {
  data () {
    return {
      formUpdate: this.$store.getters.user,
      ruleCreate: Validator(this),
      setPassword: false,
      loadingVisible: false
    }
  },
  mounted(){
    this.$http.get(`auth`).then((res) => {
      this.formUpdate = res.data.data
      this.$store.commit('setAuthData', res.data.data);
    })
  },
  methods: {
    updateSubmit(name, url){

      this.$refs[name].validate((valid) => {
        if (valid) {
          this.$http.put(url, this._data[name]).then((res) => {
            this.$store.commit('setAuthData', res.data.data);
            this.$Message.success('Success!');
          }).catch((res) => {
            this.formatErrors(res)
          }).finally(() => {
            this.loading = false
          })
        } else {
          this.$Message.error('验证不通过!');
        }
      })
    }
  }
}
</script>

<style lang="scss">

</style>
