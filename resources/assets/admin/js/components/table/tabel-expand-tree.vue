<template>
    <Table :columns="mergeCol" :data="parent"></Table>
</template>

<script>
  export default {
    name: "tabel-expand-tree",
    props: {
      data: Array,
      columns: Array
    },
    data() {
      return {
        defaultColumn: [{
          type: 'expand',
          render: (h, {row, index}) => {
            return <i-table
              show-header={false}
              v-show={this.child(row.id) && this.child(row.id).length}
              data={this.child(row.id)}
              columns={this.mergeCol} class={'table-expand-tree-' + this.level(row).length }/>
          },
          width: 50,
        }]
      }
    },
    computed: {
      parent() {
        return this.child(0)
      },
      mergeCol() {
        return this.defaultColumn.concat(this.columns)
      },
      defaultData(){
        let data = JSON.parse(JSON.stringify(this.data));
        data.forEach((val, index) => {
          data[index]._expanded = true
        });
        return data
      },
    },
    methods: {
      child(parent) {
        return JSON.parse(JSON.stringify(this.defaultData.filter(val => val.parent_id == parent)))
      },
      level(row){
        let lists = [], parentRow;
        parentRow  = this.defaultData.find(val => val.id == row.parent_id)
        if(parentRow){
          lists.push(parentRow)
          lists = lists.concat(this.level(parentRow))
        }
        return lists
      }
    }
  }
</script>

<style lang="less">
    .ivu-table-expanded-cell {
        padding: 0 !important;
        height: auto !important;
        border-bottom: none !important;
    }

    .ivu-table-expanded-cell > .ivu-table-wrapper {
        height: 100% !important;
        margin-bottom: 0px !important;
        border: none !important;
    }

    .table-tree-loop(@n, @i:0) when (@i <= @n) {
        .table-expand-tree-@{i} {
            .table-col-title{
                padding-left: (@i+1) * 20px
            }
        }
        .table-tree-loop(@n, (@i + 1));
    }

    .ivu-table-expanded-cell{
        .table-tree-loop(5)
    }
</style>