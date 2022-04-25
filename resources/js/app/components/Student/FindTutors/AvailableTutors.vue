<template>
  <div class="parent">
      <h5 class="fw-bold text-muted">   {{this.capitalize(this.search_term)}} tutors </h5>
      <!-- ----------------------------------------------------------------------------------------------------- -->
      <div class="row " v-if="Object.keys(this.current_tutors).length">
      <div class="col-md-3 mb-2 px-1" v-for="(tutor, index) in this.current_tutors" :key="index" style="overflow:hidden" >
          <div class=" h-100   ">              
            <div class="bg-white p-1 pt-2 inner rounded h-100  hover-card">
                <div class="d-flex align-items-center">
                    <div class="px-2 ">
                        <img src="/images/profile-placeholder.jpg" alt="" style="width:5rem; background:cover" v-if="!tutor.image">                        
                        <img :src="tutor.image" alt="" style="width:5.7rem; height:5.7rem;"  v-if="tutor.image">  
                    </div>
                    <div class="pl-2 ms-2">
                        <h5 class="d-flex align-items-center mb-0">
                           <span> {{this.capitalize(tutor.first_name)}} {{ tutor.last_name.charAt(0).toUpperCase()}}. </span> 
                            <span class="float-end ms-3">
                                <!-- <country-flag :country='tutor.country_code' size='.5rem'/> &nbsp; -->
                                <i class="bi bi-shield-fill-check text-primary" ></i>
                            </span>                            
                        </h5>
                        <span class="clearfix w-100"></span>
                        <div class=" d-flex align-items-center justify-content-between " >                           
                            <span class="small fw-bold"><i class="bi bi-mortarboard-fill text-secondary"></i> &nbsp; {{tutor.subject}} </span> 
                           
                        </div>
                            <div class="align-items-center ">
                                 <span class="small align-items-center "><i class="bi bi-circle-fill text-success" style="font-size:.7rem"></i> Online &nbsp; &nbsp; </span> <span class="text-muted small"><i class="bi bi-house"></i>  {{this.capitalize(tutor.country)}}</span> <br>
                               <span class="mt-5  lead"> $ {{tutor.hourly_rate}} <span class="small">/hr </span>  </span> 
                            </div>
                       </div>
                </div>
                <!-- ------------------------------- -->
                
                <div class="p-1 d-flex justify-content-start align-items-center">
                    <span class="small ps-1" data-bs-toggle="modal" href="#exampleModalToggle" role="button" style="cursor:pointer" @click.prevent ="updateCurrent_tutor(tutor)"> <i class="bi bi-star-fill text-warning"></i> {{this.calculateStarRating(tutor.reviews)}}  &nbsp; &nbsp; &nbsp;</span> 
                    <span > <a  data-bs-toggle="modal" class="text-warning" href="#exampleModalToggle" role="button" style="cursor:pointer" @click.prevent ="updateCurrent_tutor(tutor)">{{Object.keys(tutor.reviews).length}} Reviews </a>  &nbsp; &nbsp; &nbsp; </span> 
                     <span class="small float-end" ><i class="bi bi-suit-heart-fill text-muted" style="font-size:1.3rem" @click.prevent="toggleFavourite($event, tutor)"></i> </span>
                </div>
                            
                
                <div class="d-flex  small px-2">
                    <span> <i class="bi bi-person-fill"></i> 0 Active students</span>
                    <span class=""> &nbsp; | &nbsp;</span> 
                    <span>0 Lessons </span>
                </div>
                <!-- ------------------------------------- -->
                <div class="d-flex  small px-2 speaks">
                    <span class="fw-bold">Languages: &nbsp; </span> 
                    <span> {{tutor.language}} &nbsp;</span> <span class="alert-success px-1 rounded"> {{ this.capitalize(tutor.level)}} </span>  
                    <span class="">  &nbsp; | &nbsp;</span>
                    <span>{{tutor.second_language}} &nbsp; </span>  <span class="alert-primary px-1 rounded">  {{ this.capitalize(tutor.second_language_level)}} </span>  
                </div>
                <!-- -------------------------- -->
                <div class="px-2" style="height:4.5rem; overflow:hidden">
                    <span> Description: </span>
                    <span>{{ this.capitalize(tutor.description)}}  </span>
                </div>
                <div class="d-flex   p-2 ">                    
                    <span> <button class="btn btn-danger rounded" @click.prevent="updateCurrent_tutor(tutor)" data-bs-toggle="modal" data-bs-target="#staticBackdropIntroVideo">Intro</button> &nbsp; </span> 
                    <span> <button class="btn btn-danger  rounded"  @click.prevent="updateCurrent_tutor(tutor)" data-bs-toggle="modal" data-bs-target="#staticBackdropTrial">Book  lesson</button> &nbsp; </span> 
                    <span> <button class='btn btn-primary '  @click.prevent="updateCurrent_tutor(tutor)"  data-bs-toggle="modal" data-bs-target="#staticBackdropMessage"><i class="bi bi-envelope"></i></button> </span> 
                </div>
            </div>
        </div> 
      </div>  

        <div class="clearfix"></div>       
      </div>
      <div v-else>
        <p class="text-center text-muted py-5">No records found </p>
      </div>
    <!-- ------------------------------------------------------------------------------------------------------------------ -->
<div>
    <BookTialLessonModal :tutor="this.current_tutor"/>
    <SendMessage :tutor="this.current_tutor"/>
    <IntroVideo :new_tutor="this.current_tutor"/>
    <Reviews :tutor="this.current_tutor"/>
</div>
  </div>
</template>

<script>
import axios from 'axios';
import {mapGetters } from "vuex";

import BookTialLessonModal from "./BookTrialLessonModal.vue";
import CountryFlag from 'vue-country-flag-next';
import SendMessage from "./SendMessage";
import IntroVideo from "./IntroVideo.vue";
import Reviews from "../../Reviews/Reviews.vue";

export default {
   props:[
       'search_tutors_results',
       'search_keyword'
   ],
    components: {
        CountryFlag,
        BookTialLessonModal,
        SendMessage,
        IntroVideo,
        Reviews
    },
    data(){
        return{
            current_tutors: {},
            current_tutor:{},
            search_term:'Available'
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),
        tutors:{
            get() { return this.$store.state.tutors.tutors; },
            set(value) { this.$store.commit('set_tutors', value); }
        },       
    },
    watch:{
        search_tutors_results(){
            this.current_tutors = this.search_tutors_results;
            this.search_term = this.search_keyword;
            if(! Object.keys(this.current_tutors).length ) {
                setTimeout(() => {
                    this.fetchAvailableTutors();
                    this.search_term ='Suggested'
                }, 3500);
            }
        }
    },
    methods:{
        updateCurrent_tutor(tutor){
            this.current_tutor = tutor;
        },
        capitalize(string){
          if(string)  return string.charAt(0).toUpperCase() + string.slice(1);
        },
        toggleFavourite(event, tutor){
            if(!this.isLogedIn) this.$router.push({name: 'login'});
            if(event.target.classList.contains('text-danger')){
                event.target.classList.remove('text-danger');
                event.target.classList.add('text-muted');
            }else{
               event.target.classList.remove('text-muted'); 
               event.target.classList.add('text-danger'); 
            }              
        },
        calculateStarRating(reviews){
            // Formular used: AR = 1*a+2*b+3*c+4*d+5*e/(R) 
            let one_star = 0;
            let two_star = 0;
            let three_star = 0;
            let four_star = 0;
            let five_star = 0;
            let total_ratings = 0;
            let avarage_rating = 0;
            let total_rating = 0;

            if(! Object.keys(reviews).length) return total_rating; // if reviews empty return
            reviews.forEach(review=>{
                if(review.stars == 1) one_star +=1;
                if(review.stars == 2) two_star +=1;
                if(review.stars == 3) three_star +=1;
                if(review.stars == 4) four_star +=1;
                if(review.stars == 5) five_star +=1;
            });
            total_ratings = one_star + two_star +three_star + four_star + five_star;
            console.log(three_star);

            avarage_rating = (1*one_star) + (2*two_star) + (3*three_star)  + (4*four_star) + (5*five_star);

            total_rating = ( avarage_rating/total_ratings ).toFixed(1);
            return total_rating;

        },
        fetchAvailableTutors(){
            setTimeout(() => {
                axios.get('/api/student/available-tutors')
                .then(response=>{
                    if(response.status == 200){  
                        this.tutors =response.data.data.data;   
                        this.current_tutors = this.tutors; 
                        
                    }                
                })
                .catch(error=>{               
                    console.log(error.response);
                })
            }, 500);
            
        }
    },
    mounted(){
        this.fetchAvailableTutors();
    }

}
</script>

<style>
    .speaks{
        overflow: auto;
        white-space: nowrap;
            -webkit-overflow-scrolling: touch;
    }
    .speaks::-webkit-scrollbar {
    display: none;
    }
    .parent{
        margin: 0 2rem;
    }

    .hover-card{
        border: 1px solid rgb(241, 241, 241);
    }
    .hover-card:hover{
        border: 1px solid rgb(241, 201, 201);
    }

  
    .mobile .inner{
        padding:  .7rem;
        margin:  .3rem .2rem ;
    }

/* media queries */
@media only screen and (max-width: 950px) {
    .mobile{
        width:50%;               
    }
    .parent{
        margin: 0 .8rem;
    }
}
/* media queries */
@media only screen and (max-width: 600px) {
    .mobile{
        width:100%;               
    }
    .parent{
        margin: 0 .3rem;
    }
}
</style>