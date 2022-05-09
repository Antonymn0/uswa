<template>
  <div>
      <h4 class="ps-4 pt-3 mx-4">Dashboard </h4>  
      <div> <Lessons /> </div>    
  </div>
</template>

<script>
import Lessons from "./Lessons/StudentLessons.vue";
export default {  
    components:{
      Lessons
    }
}
</script>

<style scoped>

</style>