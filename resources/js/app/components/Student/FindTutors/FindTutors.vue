<template>
    <div>
        <div class="top-header background-redi border-bottom">
            <span>
                <h1 >Online  tutors & teachers for private lessons </h1>  
                <p>
                    Looking for an online tutor? Uswa is the fastest growing online learning platform worldwide. 
                    You can choose from a pool of seasoned online tutors on our platform
                    Book a lesson with a private tutor today and start learning. <br>
                    Not entirely happy with your tutor? No worries, Uswa offers free tutor replacement till you're 100% satisfied.
                </p>
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

<style scoped>
    .top-header{       
        color: #272727;
        border-radius: 0 0 2rem 2rem;
        padding: 2rem 5rem 
    }
    h1{
        color:#CC0000;
    }
    .background-redi{
        background-color:rgba(218, 218, 216, 0.459)
    }


/* media quesries */
@media only screen and (max-width: 600px) {
    .top-header{       
        padding: .8rem .7rem;
        margin-left:2px; 
        margin-right:2px; 
    }
}
</style>