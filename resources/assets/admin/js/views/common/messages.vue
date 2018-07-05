<template>
    <my-lists v-model="data" :columns="columns" @change="search"></my-lists>
</template>

<script>
  import MyLists from "../../components/layout/my-lists";
  import lists from "../../mixins/lists";

  export default {
    components: {MyLists},
    name: "messages",
    mixins: [lists],
    data() {
      return {
        columns: [{
          title: '标题'
        }]
      };
    },
    methods:{
      search(page = 1){
        this.$http.get(`auth/message`, {params: this.request(page)}).then((res) => {
          this.assignmentData(res.data.data);
        })
      }
    }
  }
</script>

<style scoped>

</style>