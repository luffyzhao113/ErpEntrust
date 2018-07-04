<template>
    <login-lock>
        <p slot="title">
            <Icon type="log-in"></Icon>
            登录锁定
        </p>
        <Form slot="form" ref="form" :model="form">
            <FormItem prop="password" :rules="{required: true, message: '密码不能为空！', min: 6, max:20, trigger: 'blur'}">
                <Input type="password" v-model="form.password" autocomplete="off" placeholder="Password"
                       @on-enter="login('form')">
                <Icon type="ios-locked-outline" slot="prepend"></Icon>
                </Input>
            </FormItem>
            <FormItem>
                <Button type="primary" long @click="unlock('form')">解锁</Button>
            </FormItem>
        </Form>
    </login-lock>
</template>

<script>
    import LoginLock from "./components/lock/login-lock";
    import http from "../../mixins/http";

    export default {
      components: {LoginLock},
      mixins: [http],
      data() {
        return {
          form: {
            password: ''
          }
        }
      },
      methods: {
        unlock(name) {
          this.$refs[name].validate((valid) => {
            if (valid) {
                this.$http.delete(`auth/lock`, {params:this.form}).then(() => {
                  this.$cache.set('locking', 0);
                  this.$router.go(-1);
                }).catch((res) => {
                  this.formatErrors(res)
                })
            }
          });
        }
      }
    }
</script>


