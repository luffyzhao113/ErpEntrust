<template>
    <my-lists v-model="data" :columns="columns" @change="search">
        <Card>
            <p slot="title">
                <span>搜索</span>
            </p>
            <Form ref="searchForm" :model="searchForm" inline>
                <FormItem prop="read_at" label="是否未读" :label-width="60">
                    <true-or-false v-model="searchForm.read_at"></true-or-false>
                </FormItem>
                <FormItem :label-width="1">
                    <Button @click="search(1)" type="primary">搜索</Button>
                </FormItem>
            </Form>
        </Card>
    </my-lists>
</template>

<script>
  import MyLists from "../../components/layout/my-lists";
  import lists from "../../mixins/lists";
  import TrueOrFalse from "../../components/select/true-or-false";

  export default {
    components: {TrueOrFalse, MyLists},
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