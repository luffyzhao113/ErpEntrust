import http from "./http";

export default {
  mixins: [http],
  data(){
    return {
      loading: false
    }
  },
  methods: {
    unObserver(data){
      return JSON.parse(JSON.stringify(data));
    },
    updateSubmit(name, url){
      this.$refs[name].validate((valid) => {
        if (valid) {
          this.loading = true
          this.$http.put(url, this.unObserver(this._data[name])).then((res) => {
            this.$Message.success('Success!');
            this.change(false)
          }).catch((res) => {
            this.formatErrors(res)
          }).finally(() => {
            this.loading = false
          })
        } else {
          this.$Message.error('验证不通过!');
        }
      })
    },
    createSubmit(name, url){
      this.$refs[name].validate((valid) => {
        if(valid){
          this.loading = true
          this.$http.post(url, this._data[name]).then((res) => {
            this.$Message.success('Success!');
            this.change(false)
          }).catch((res) => {
            this.formatErrors(res)
          }).finally(() => {
            this.loading = false
          })
        }
      })
    }
  }
}