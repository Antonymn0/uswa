<template>
  <h4 class="p-3 mx-4 my-4">Dashboard <span class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#lecturesModal">Define lectures</span></h4> 
  <div> <Lessons /></div>
  <div> <Lectures/></div>
</template>

<script>
import Lessons from "./Lessons/TutorLessons.vue";
import Lectures from "../Tutor/Lessons/Lectures.vue";
export default {
  components:{
      Lessons,
      Lectures
  }
  
}
</script>

<style>

</style>