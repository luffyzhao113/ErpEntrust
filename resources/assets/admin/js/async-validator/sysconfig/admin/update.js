export const Validator = (data) => {
  let validateConfirm = (rule, value, callback) => {
    if(data.formUpdate.password !== value){
      callback(new Error('两次密码不相同'));
    }else{
      callback();
    }
  }

  return {
    name: [
      {required: true, type: 'string', message: '用户姓名不能为空', trigger: 'blur'},
      {type: 'string', min: 2, max: 10, message: '用户姓名必须在 2 到 10 个字符之间', trigger: 'blur'}
    ],
    email: [
      {required: true, message: '用户邮箱不能为空', trigger: 'blur'},
      {type: 'email', message: '邮箱格式不正确', trigger: 'blur'}
    ],
    role_id: [
      {required: true, type:'number', message: '用户角色必须选择', trigger: 'change'},
    ],
    password: [
      {min: 6, max: 20, type: 'string', message: '用户密码必须在 6 到 20 个字符之间', trigger: 'blur'}
    ],
    password_confirmation: [
      { validator: validateConfirm, trigger: 'blur' }
    ]
  }
}