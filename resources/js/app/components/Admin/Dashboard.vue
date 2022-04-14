<template>
<div class="row">
    <div class="col-md-2">    
      <SideNav />
  </div>
  <div class="col-md-10">
      <router-view></router-view> 
  </div>
</div>
  
</template>

<script>
import SideNav from "./Layouts/SideNav.vue";
import Header from "./Layouts/Header.vue";
export default {
components:{
    SideNav,
    Header
}
}
</script>

<style>

</style>