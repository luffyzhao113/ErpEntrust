<template>
    <Modal :title="title" :value="true" @on-visible-change="change" :transfer="false" :loading="loading" :mask-closable="false">
        <div class="modal-body"><slot></slot></div>
        <div slot="footer"><slot name="footer"></slot></div>
    </Modal>
</template>

<script>
  export default {
    name: "component-modal",
    props: {
      title: {
        type: String,
        default: '弹窗'
      }
    },
    computed: {
      loading () {
        return this.$parent.loading;
      }
    },
    methods: {
      change(v){
        this.$parent.$emit('on-change')
      }
    }
  }
</script>

<style scoped>
.modal-body{
    max-height: 500px;
    overflow-y: auto;
}
</style>