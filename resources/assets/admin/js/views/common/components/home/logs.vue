<template>
    <Card>
        <p slot="title">日志</p>
        <Table :columns="columns" :data="data"></Table>
    </Card>
</template>

<script>
  import http from "../../../../mixins/http";

  export default {
    name: "home-logs",
    mixins: [http],
    data(){
      return {
        columns: [{
          title: '序号',
          render: (h, {index}) => {
            return <span>{++index}</span>
          },
          width: 75
        }, {
          title: "操作",
          key: "display_name"
        },{
          title: "状态",
          key: "status_code"
        },{
          title: "操作时间",
          key: "created_at"
        }],
        data: []
      }
    },
    mounted() {
      this.$http.get(`auth/logs`).then((res) => {
        this.data = (res.data.data)
      }).catch((res) => {
        this.formatErrors(res)
      });
    }
  }
</script>

<style scoped>

</style>