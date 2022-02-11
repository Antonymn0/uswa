<template>
    <div>
        <div class="top-header background-red">
            <span>
                <h1>Online English tutors & teachers for private lessons </h1>  
                <p>
                    Looking for an online English tutor? Preply is the leading online language learning platform worldwide. 
                    You can choose from 10918 English teachers with an average rating of 4.89 out of 5 stars given by 71933 customers.
                    Book a lesson with a private English teacher today and start learning. 
                    Not entirely happy with your tutor? No worries, Preply offers free tutor replacement till you're 100% satisfied.
                </p>
            </span>
            <span>
                <img src="" alt="">
            </span>
            <SearchTutor />
        </div> 
        <!-- -------------------------------------- -->
        <div class="pt-2 pb-3">
            <Infos />
        </div> 
        <!-- -------------------------------  -->
        <div>
            <AvailableTutors />
        </div>


          
      </div>
</template>

<script>
import SearchTutor from "./SearchTutor.vue";
import Infos from "./Infos.vue";
import AvailableTutors from "./AvailableTutors.vue";
export default {
    components:{
      SearchTutor,
      Infos,
      AvailableTutors
    }
}
</script>

<style>
    .top-header{
       
        color: #efefef;
        border-radius: 0 0 2rem 2rem;
        padding: 2rem 5rem 
    }


/* media quesries */
@media only screen and (max-width: 600px) {
    .top-header{       
        padding: .8rem .7rem; 
    }
}
</style>