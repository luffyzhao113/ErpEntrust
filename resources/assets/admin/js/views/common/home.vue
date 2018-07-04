<template lang="html">
    <div>
        <home-remark></home-remark>

        <home-logs></home-logs>
    </div>
</template>

<script>
  import HomeLogs from "./components/home/logs";
  import HomeRemark from "./components/home/remark";

  export default {
      components: {
        HomeRemark,
        HomeLogs},
      name: 'admin-home',
  }
</script>

<style lang="scss">

</style>
