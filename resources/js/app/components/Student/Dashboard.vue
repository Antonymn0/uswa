<template>
  <div>
      <h4 class="ps-3 pt-3">Dashboard </h4>  
      <div> <myLessons /> </div>    
  </div>
</template>

<script>
import myLessons from "./Lessons/StudentLessons.vue";
export default {  
    components:{
      myLessons
    }
}
</script>

<style>

</style>