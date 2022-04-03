<template>
    <div>
        <div class="top-header background-red">
            <span>
                <h1>Online language tutors & teachers for private lessons </h1>  
                <p>
                    Looking for an online tutor? Uswa is the fastest growing language learning platform worldwide. 
                    You can choose from a pool of seasoned online tutors on our platform
                    Book a lesson with a private language teacher today and start learning. <br>
                    Not entirely happy with your tutor? No worries, Uswa offers free tutor replacement till you're 100% satisfied.
                </p>
            </span>
            <span>
                <img src="" alt="">
            </span>
            <SearchTutor @searchTutors="recieveSearchResults"/>
        </div> 
        <!-- -------------------------------------- -->
        <div class="pt-2 pb-3">
            <Infos />
        </div> 
        <!-- -------------------------------  -->
        <div>
            <AvailableTutors :search_tutors_results="this.tutors" :search_keyword="this.search_keyword"/>
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
    },
    data(){
        return{
           tutors:{},
           search_keyword:'' 
        }
    },
    methods:{
        recieveSearchResults(search_tutors, search_keyword){
            this.tutors = search_tutors;
            this.search_keyword = search_keyword;
        }
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