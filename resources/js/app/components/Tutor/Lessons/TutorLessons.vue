<template>
  
<div class="p-3">

  <div class="bg-white  ">
      <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchTrialLessons()">Refresh</button> </span></h4>
        <p class="px-3 small">
            Request for trial lessons from students will appear here. You can either choose to accept requests or decline. <br>
            Please note that students can cancel the lessons if they are not satisfied during the trial or if there is no response.
        </p>
      <div class="row p-3 ">          
          <div class="col-md-4 row p-2"  v-for="(trial_lesson, index) in this.current_trial_lessons" :key="index">              
              <div class="border rounded p-3 m-1">
                  <div>
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(trial_lesson.get_student.first_name)}}
                        </h6>
                        <small class='text-muted fw-light'> <span class="small  fw-bold">  Status:</span> {{trial_lesson.tutor_confirm}} </small> 
                    </span>
                       
                    <p class="fw-bold">{{this.capitalize(trial_lesson.get_student.first_name)}} wants to book  {{this.capitalize(trial_lesson.lesson_type)}}  lessons with you</p>
                    <span class="py-2">Scheduled for: {{this.formatDate(trial_lesson.lesson_date)}}</span> <br>                  
                    <span>Time: </span> <span>{{trial_lesson.start_time}}hrs - {{trial_lesson.end_time}}hrs </span> <br>
                    <span class="py-2">Duration: </span> <span>1hr </span> <br>
                    <!-- <span class="py-2">Expired: </span> <span> false</span> <br> -->
                    
                    <p class="mb-0" v-if="trial_lesson.decline_reason !== null">
                        <span class="py-2 fw-normal">Declined:  </span> <span class="text-danger">true </span> <br>
                        <span class="py-2">Decline reason:  </span> <span> {{trial_lesson.decline_reason}}</span>
                    </p>
                   

                    <p class="pt-2 mb-0"  v-if="trial_lesson.decline_reason == null">{{this.capitalize(trial_lesson.get_student.first_name)}} is eager to start learning {{this.capitalize(trial_lesson.lesson_type)}} with you.</p>
                    <p class="mb-0 py-2">
                        <button class="btn btn-sm btn-secondary m-1" @click.prevent="this.acceptTrialLesson(trial_lesson)">Accept </button>
                        <button class="btn btn-sm btn-secondary m-1" data-bs-toggle="modal" :data-bs-target="'#declineModal' + index">Decline</button>
                    </p>
                    <!-- -------------------------decline lesson  modal---------------------------- -->
                        <!-- Modal -->
                        <div class="modal fade" :id="'declineModal' + index" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                
                                <h5 class="modal-title" id="exampleModalLabel">Decline lesson</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">                                
                                <label for="reason">Reason </label>
                                <small class="alert-success p-2 rounded my-1" v-if="this.success.success">{{this.success.success}}</small> 
                                <textarea  id="reason" cols="10" class="form-control" placeholder='Decline reason' rows="5" v-model="this.decline_reason"></textarea>
                                <small class="text-danger">{{this.errors.decline_reason}}</small>
                            </div>
                            <div class="text-center py-3">
                                <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-secondary m-1" @click.prevent="declineTrialLesson(trial_lesson)">Decline</button>
                            </div>
                            </div>
                        </div>
                        </div>

                    <!-- ------------------------------------------------------------- -->
                </div>
            </div>              
        </div>              
      </div>
  </div>

<!-- -------------------------------------------------------------------------------------------------------------- -->

 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchLessons()">Refresh</button> </span></h4>
      <div class="row p-3 ">   
          <div class="col-md-4 row p-2"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'ongoing'">         
              <div class="border rounded p-3">
                  <div>
                      <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                          <h6 class="py-2 fw-bold"> 
                              <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                {{lesson.get_lesson_student.first_name}}
                            </h6>
                           <span class="small"> Status: {{lesson.status}}...</span>
                         </span>
                       
                      <p class="fw-bold"> <span>{{lesson.lesson_type}} classes </span> <span class="float-end"><button class="btn btn-secondary">Classroom</button></span> </p>
                      <span class="py-2">Date started : {{lesson.lessons_start_date}}</span> <br>
                      <span class="py-2">Course duration: </span> <span>{{lesson.lesson_total_duration}}hrs </span>
                       <br>
                      <span class="py-2">Covered : </span> <span> {{lesson.covered_duration}}hrs</span> &nbsp; &nbsp;
                      <span class="py-2">Remaining : </span> <span> {{lesson.remaining_duration}}hrs</span>

                      <p class="pt-2 mb-0 small">
                       You and your students are in total control of planning your lessons. <br>
                       Teach from anywhere anytime.
                       </p>
                  </div>
              </div>              
          </div>
      </div>
  </div>

<!-- --------------------------------------------------------------------------------------------------------------- -->

  <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">Completed <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchLessons()">Refresh</button> </span></h4>
      <div class="row p-3 "> 
          <div class="col-md-4 row p-2"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'completed'">                
              <div v-show="lesson.status == 'completed'">
              <div class="border rounded p-3">
                  <div>
                      <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                          <h6 class="py-2 fw-bold"> 
                              <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                 Antony mn
                            </h6>
                           <span class="small"> Status: {{lesson.status}}</span>
                         </span>
                       
                      <p class="fw-bold">{{lesson.lesson_type}} lessons</p>
                      <span class="py-2">Date started: {{this.formatDate(lesson.lessons_start_date)}}</span> <br>
                      <span class="py-2">Date completed: </span> <span> {{this.formatDate(lesson.lessons_start_date)}}</span> <br>
                      <span class="py-2">Course Duration: </span><span>{{lesson.lesson_total_duration}}hrs </span>  <br>                      
                        <span>Student score: </span> <span>{{lesson.student_score}}%</span>

                      <p class="pt-2 mb-0 small">This course was taught in a total duration of {{lesson.lesson_total_duration}}hrs.</p>
                  </div>
              </div>              
              </div>              
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
            current_lessons:{},
            completed_lessons:{},
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
        acceptTrialLesson(trial_lesson){
            if(! confirm('Accept to meet with  ' + this.capitalize(trial_lesson.get_student.first_name) + ' on the specified date and time?')) return;
            axios.get('/api/tutor/confirm-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                this.fetchTrialLessons();
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        declineTrialLesson(trial_lesson){
            this.errors={};
            this.success={};
            if(trial_lesson.tutor_decline !== null) {alert('Lesson already declined!'); return;}
            if(! this.decline_reason) this.errors.decline_reason ="Please provide a reason";
            if( Object.keys(this.errors).length) return;
            if(! confirm('Decline  this trial lesson?')) return;

            var form_data = new FormData();
            form_data.append('decline_reason', this.decline_reason);
            form_data.append('_method', 'PUT');

            axios.post('/api/tutor/decline-trial-lesson/' + trial_lesson.id, form_data)
            .then(response =>{
                this.fetchTrialLessons();
                this.decline_reason = null;
                this.success.success = "Success, lesson declined!";
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        fetchTrialLessons(){
            axios.get('/api/tutor/fetch-lessons/trial')
            .then(response =>{
                this.current_trial_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        fetchLessons(){
            axios.get('/api/tutor/fetch-lessons')
            .then(response =>{
                this.current_lessons = response.data.data.data;

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