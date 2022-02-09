<template>
<div class="text-muted">
<p class="sign-up-steps py-2 fw-bold ">
    <span> <i class="bi bi-check-circle"></i> About <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Photo <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Certificaion <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Education <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Video <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Availability <i class="bi bi-chevron-right"></i></span>
    <span> <i class="bi bi-check-circle"></i> Finnish <i class="bi bi-chevron-right"></i></span>
</p>
    <div class="parent">
        <div id="about" class="">
        <h4 class="text-center">Complete the tutor sign up process </h4>    
           <About /> 
        </div>
        <div id="photo" class="hidden">
           <Photo /> 
        </div>

        <div id="certification" class="hidden">
           <Certification/> 
        </div>

        <div id="education" class="hidden">
           <Education /> 
        </div>
        
        <div id="video" class="hidden">
           <Video /> 
        </div>
        <div id="availability" class="hidden">
           <Availability /> 
        </div>        
    </div>
 </div>
   

</template>

<script>
import About from "./About.vue";
import Photo from "./Photo.vue";
import Certification from "./Certification.vue";
import Education from "./Education.vue";
import Video from "./Video.vue";
import Availability from "./Availability.vue";

export default {
    components:{
        About,
        Photo,
        Certification,
        Education,
        Video,
        Availability,
    }
}
</script>

<style scoped>
    .sign-up-steps{
        padding: .5rem;
        width:auto;
        margin: auto;
        text-align:center;
    }
    .sign-up-steps span{
        padding: .5rem;
    }
    .parent{
        width:50rem;
        max-width:100%;
        background-color: #fff;
        padding:2rem;
        margin:auto;
    }
</style>