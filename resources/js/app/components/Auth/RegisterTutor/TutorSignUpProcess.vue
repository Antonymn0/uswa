<template>
<div class="text-secondary">
    <p class="sign-up-steps py-2 fw-bold ">
        <span @click.prevent="toggleProcess('about')"> <i class="bi bi-check-circle"></i> About <i class="bi bi-chevron-right"></i></span>
        <span @click.prevent="toggleProcess('photo')"> <i class="bi bi-check-circle"></i> Photo <i class="bi bi-chevron-right"></i></span>
        <span @click.prevent="toggleProcess('certification')"> <i class="bi bi-check-circle"></i> Certificaion <i class="bi bi-chevron-right"></i></span>
        <span @click.prevent="toggleProcess('education')"> <i class="bi bi-check-circle"></i> Education <i class="bi bi-chevron-right"></i></span>
        <span @click.prevent="toggleProcess('video')"> <i class="bi bi-check-circle"></i> Video <i class="bi bi-chevron-right"></i></span>
        <span @click.prevent="toggleProcess('availability')"> <i class="bi bi-check-circle"></i> Availability <i class="bi bi-chevron-right"></i></span>
        <span > <i class="bi bi-check-circle"></i> Finish <i class="bi bi-chevron-right"></i></span>
    </p>
    <div class="parent">
        <div id="about" class="">
        <h4 class="text-center">Complete the tutor sign up process </h4>    
           <About /> 
        </div>

        <div class="clearfix"></div>

        <div id="photo" class="hidden">
           <Photo /> 
        </div>
        <div class="clearfix"></div>
        <div id="certification" class="hidden">
           <Certification/> 
        </div>
        <div class="clearfix"></div>
        <div id="education" class="hidden">
           <Education /> 
        </div>
        <div class="clearfix"></div>
        <div id="video" class="hidden">
           <Video /> 
        </div>
        <div class="clearfix"></div>
        <div id="availability" class="hidden">
           <Availability /> 
        </div>  
        <div class="clearfix"></div> 
        <div id="finish" class="hidden">
           <Finish /> 
        </div>        
    </div>
 </div>
<div class="clearfix"></div>


</template>

<script>
import About from "./About.vue";
import Photo from "./Photo.vue";
import Certification from "./Certification.vue";
import Education from "./Education.vue";
import Video from "./Video.vue";
import Availability from "./Availability.vue";
import Finish from "./Finish.vue";

export default {
    components:{
        About,
        Photo,
        Certification,
        Education,
        Video,
        Availability,
        Finish,
    },
    methods:{
        toggleProcess(id_tag){
            document.getElementById('about').classList.add('hidden');
            document.getElementById('photo').classList.add('hidden');
            document.getElementById('certification').classList.add('hidden');
            document.getElementById('education').classList.add('hidden');
            document.getElementById('video').classList.add('hidden');
            document.getElementById('availability').classList.add('hidden');
            document.getElementById('finish').classList.add('hidden');

            document.getElementById(id_tag).classList.remove('hidden');
        }
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
    .sign-up-steps span:hover{
        cursor:pointer;
        background-color: rgb(131, 129, 129);
        color:#fff;
    }
    .sign-up-steps span{
        padding: .5rem;
    }
    .parent{
        width:50rem;
        max-width:100%;
        height:auto;
        background-color: #fff;
        padding:2rem;
        margin:auto;
    }
</style>