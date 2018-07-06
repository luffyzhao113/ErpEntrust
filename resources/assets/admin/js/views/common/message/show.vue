<template>
    <component-modal title="查看通知">
        <h3>{{data.data.title}}</h3>
        {{data.data.content}}
    </component-modal>
</template>

<script>
  import component from "../../../mixins/component";
  import ComponentModal from "../../../components/modal/component-modal";

  export default {
    components: {ComponentModal},
    name: "update",
    mixins: [component],
    mounted(){
      if(!this.data.read_at) {
        this.$http.put(`auth/message/${this.data.id}`).then((res) => {
          this.$store.commit('decrement')
        })
      }
    }
  }
</script>

<style scoped>
h3{
    text-align: center;
    margin: 10px 0;
}
</style>