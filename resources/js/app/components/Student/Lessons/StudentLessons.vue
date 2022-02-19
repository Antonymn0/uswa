<template>
  
<div class="p-3">
  <div>my lessons</div>

 <div class="bg-white mt-3 ">
    <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchTrialLessons()">Refresh</button> </span></h4>
    <small class="alert-success p-2 mx-4 rounded my-2" v-if="this.success.cancel_lesson">{{this.success.cancel_lesson}}</small> 
    <p class="mb-0 px-3"> Your Trial lesson requests to tutors will appear here.</p>
    <div class="row px-3 m-1">               
        <div class="col-md-4 row p-2"  v-for="(trial_lesson, index) in this.current_trial_lessons" :key="index">              
            <div class="border rounded p-3 m-1">
                <div>
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(trial_lesson.get_tutor.first_name)}}
                        </h6>
                        <small class='text-muted fw-light'> <span class="small  fw-bold">  Status:</span> {{trial_lesson.tutor_confirm}} </small> 
                    </span>
                       
                    <p class="fw-bold">  {{this.capitalize(trial_lesson.lesson_type)}} trial lesson with tutor {{this.capitalize(trial_lesson.get_tutor.first_name)}} </p>
                    <span class="py-2">Scheduled for: {{this.formatDate(trial_lesson.lesson_date)}}</span> <br>                  
                    <span>Time: </span> <span>{{trial_lesson.start_time}}hrs - {{trial_lesson.end_time}}hrs </span> <br>
                    <span class="py-2">Duration: </span> <span>1hr </span> <br>
                    <!-- <span class="py-2">Expired: </span> <span> false</span> <br> -->
                    
                    <p class="mb-0" v-if="trial_lesson.decline_reason !== null">
                        <span class="py-2 fw-normal">Declined:  </span> <span class="text-danger">true </span> <br>
                        <span class="py-2">Decline reason:  </span> <span> {{trial_lesson.decline_reason}}</span>
                    </p>
                   <p class="py-2 mb-0 mt-2" v-if="trial_lesson.tutor_confirm == 'pending' ">This trial lesson request has not been accepted yet. You will recieve a notification when {{this.capitalize(trial_lesson.get_tutor.first_name)}} responds.</p>
                   <p class="py-2 mb-0 mt-2" v-if="trial_lesson.tutor_confirm == 'accepted' "> {{this.capitalize(trial_lesson.get_tutor.first_name)}} has accepted the trial request. Your lesson is scheduled on the set date.</p>

                    <p class="mb-0 py-2">
                        <button class="btn btn-sm btn-secondary m-1" @click.prevent="this.cancelTrialLesson(trial_lesson)">Cancel lesson </button>
                    </p>
                   
                </div>
            </div>              
        </div>              
      </div>
  </div>

<!-- ------------------------------------------------------------------------------------------------------------------ -->

 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" >Refresh</button> </span></h4>
      <div class="row p-3 "> 
          <div class="col-md-4 p-2">              
              <div class="border rounded p-3">
                  <div>
                      <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                          <h6 class="py-2 fw-bold"> 
                              <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                TutorJoan
                            </h6>
                           <span class="small"> Status: continuing...</span>
                         </span>
                       
                      <p class="fw-bold"> <span>Spanish lesson with tutor Joan </span> <span class="float-end"><button class="btn btn-secondary">Classroom</button></span> </p>
                      <span class="py-2">Date started : 2020/02/20</span> <br>
                      <span class="py-2">Course duration: </span> <span>40hrs </span>
                       <br>
                      <span class="py-2">Covered hrs: </span> <span> 10hrs</span>
                      <span class="py-2">Remaining hrs: </span> <span> 30hrs</span>

                      <p class="pt-2 mb-0" >
                        Learning at Uswa is absolutely free-flow and self-paced. You  are in total control of your learning process. <br> 
                        You can take lessons anytime anywhere in the world. <br>
                        Happy learning..
                       </p>
                  </div>
              </div>              
          </div>

          <div class="col-sm-4 p-2">
              progess lesson 2
          </div>
          <div class="col-sm-4 p-2">
             progress lesson 3
          </div>
      </div>
  </div>

<!-- ------------------------------------------------------------------------------------------------------------------------ -->

<div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">Completed <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" >Refresh</button> </span></h4>
      <div class="row p-3 "> 
          <div class="col-md-4 p-2">              
              <div class="border rounded p-3">
                  <div>
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            Tutor Antony
                        </h6>
                        <span class="small"> Status: completed</span>
                        </span>                       
                    <p class="fw-bold">German lesson with tutor Antony</p>
                    <span class="py-2">Date started: 2020/02/20</span> <br>
                    <span class="py-2">Date completed: </span> <span> 2020/0102</span> <br>
                    <span class="py-2">Total Duration: </span><span>1hr </span>  &nbsp; &nbsp;                      
                    <span>Score: </span> <span>99%</span>

                      <p class="pt-2 mb-0">This was completed in a total duration of 40hrs.</p>
                  </div>
              </div>              
          </div>

          <div class="col-sm-4 p-2">
              completed lesson 2
          </div>
          <div class="col-sm-4 p-2">
              completed lesson 3
          </div>
      </div>
  </div>

  </div>

</template>

<script>
import moment from "moment";

export default {
    data(){
        return{
            current_trial_lessons:{},
            decline_reason:null,
            errors:{},
            success:{ }
        }
    },
    methods:{
        formatDate(date){
            if (date) return moment(String(date)).format('ll');            
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        cancelTrialLesson(trial_lesson){
            if(trial_lesson.tutor_confirm !== null){alert('Cannot delete this lesson'); return;}
            if(! confirm('Do you want to cancle this trial lesson. \n If you cancel, you and the tutor will no longer be able to see view this lesson.')) return;
            axios.get('/api/student/cancel-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                this.success.cancel_lesson =" Success, Lesson canceled";
                setTimeout(() => {
                    this.success ={};
                }, 2500);
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        
        fetchTrialLessons(){
            axios.get('/api/student/fetch-lessons/trial')
            .then(response =>{
                console.log(response.data.data.data);
                this.current_trial_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        }
    },
    mounted(){
        // this.fetchTrialLessons;
    }

}
</script>

<style>

</style>