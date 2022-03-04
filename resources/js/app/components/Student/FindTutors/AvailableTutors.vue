<template>
  <div class="parent">
      <h5> 20 Available english tutors </h5>
      <!-- ----------------------------------------------------------------------------------------------------- -->
      <div v-if="Object.keys(this.current_tutors).length">
      <div class="mobile-outer " v-for="(tutor, index) in this.current_tutors" :key="index">
          <div class="mobile   ">              
            <div class="bg-white  inner rounded">
                <div class="d-flex justify-content-cente">
                    <div class="px-3">
                        <img src="/images/profile-placeholder.jpg" alt="" style="width:5rem;">
                    </div>
                    <div class="pl-2">
                        <h5>
                            {{tutor.first_name}} {{tutor.last_name}}
                            <span> &nbsp; <country-flag country='ke' size='1rem'/> &nbsp;</span> 
                            <span>&nbsp;<i class="bi bi-shield-fill-check text-primary" ></i> </span> 
                        </h5>
                        <div class=" d-flex align-items-center justify-content-between " >                           
                            <span><i class="bi bi-mortarboard-fill text-secondary"></i> &nbsp; {{tutor.language}} </span>
                            <span ><i class="bi bi-suit-heart-fill text-muted" style="font-size:1.5rem" @click.prevent="toggleFavourite($event, tutor)"></i> </span>
                        </div>

                        <div class="">
                            <div class="p-1 d-flex justify-content-between">
                                 <span> <i class="bi bi-star-fill text-warning"></i> 5</span>
                               <small>  15 reviews</small> 
                            </div>
                            <div class="d-flex justify-content-between px-2">
                                 <span ><i class="bi bi-circle-fill text-success" style="font-size:.7rem"></i> </span>
                               <span> $ 10/ hr &nbsp;</span> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------- -->
                <div class="d-flex  small p-2">
                    <span> <i class="bi bi-person-fill"></i> 12 Actve students</span>
                    <span class=""> &nbsp; | &nbsp;</span> 
                    <span>102 Lessons </span>
                </div>
                <!-- ------------------------------------- -->
                <div class="d-flex  small p-2 speaks">
                    <span class="fw-bold">Speaks: &nbsp; </span> 
                    <span>{{tutor.language}} </span> <span class="alert-success px-1 rounded">{{tutor.level}}</span>  
                    <span class="">  &nbsp; | &nbsp;</span>
                    <span>{{tutor.subject}}</span><span class="alert-primary px-1 rounded">{{tutor.subject_level}}</span>  
                </div>
                <!-- -------------------------- -->
                <div class="px-2">
                    <span> Description: </span>
                    <span>{{tutor.description}}  </span>
                </div>
                <div class="d-flex align-items-center py-2">                    
                    <span> <button class="btn btn-danger rounded" @click.prevent="updateCurrent_tutor(tutor)" data-bs-toggle="modal" data-bs-target="#staticBackdropIntroVideo">Watch intro</button> &nbsp; </span> 
                    <span> <button class="btn btn-danger  rounded"  @click.prevent="updateCurrent_tutor(tutor)" data-bs-toggle="modal" data-bs-target="#staticBackdropTrial">Book trial lesson</button> &nbsp; </span> 
                    <span> <button class='btn btn-primary '  @click.prevent="updateCurrent_tutor(tutor)"  data-bs-toggle="modal" data-bs-target="#staticBackdropMessage"><i class="bi bi-envelope"></i></button> </span> 
                </div>
            </div>
        </div> 
      </div>  

        <div class="clearfix"></div> 
      
      </div>
      <div v-else>
        <p class="text-center text-muted py-5">No turtors found currently</p>
      </div>
    <!-- ------------------------------------------------------------------------------------------------------------------ -->
<div>
    <BookTialLessonModal :tutor="this.current_tutor"/>
    <SendMessage :tutor="this.current_tutor"/>
    <IntroVideo :tutor="this.current_tutor"/>
</div>
  </div>
</template>

<script>
import BookTialLessonModal from "./BookTrialLessonModal.vue";
import CountryFlag from 'vue-country-flag-next';
import SendMessage from "./SendMessage";
import IntroVideo from "./IntroVideo.vue";
import axios from 'axios';

export default {
    components: {
        CountryFlag,
        BookTialLessonModal,
        SendMessage,
        IntroVideo
    },
    data(){
        return{
            current_tutors: this.$store.state.tutors.tutors,
            current_tutor:{}
        }
    },
    computed:{
        tutors:{
            get() { return this.$store.state.tutors.tutors; },
            set(value) { this.$store.commit('set_tutors', value); }
        },
    },
    methods:{
        updateCurrent_tutor(tutor){
            this.current_tutor = tutor;
        },
        toggleFavourite(event, tutor){
            if(event.target.classList.contains('text-danger')){
                event.target.classList.remove('text-danger');
                event.target.classList.add('text-muted');
            }else{
               event.target.classList.remove('text-muted'); 
               event.target.classList.add('text-danger'); 
            }          
            
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

    .mobile{
        width:25%;
        float:left;    
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