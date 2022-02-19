<template>
  <div>
      <h4>Student dashboard </h4>  
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