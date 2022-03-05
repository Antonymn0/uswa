<template>
  
<div class="p-3">

  <div class="bg-white  ">      
      <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchTrialLessons()">Refresh</button> </span></h4>
        <p class="px-3 small">
            Request for trial lessons from students will appear here. You can either choose to accept requests or decline. <br>
            Please note that students can cancel the lessons if they are not satisfied during the trial or if there is no response.
        </p>
        <small class="alert-success p-2" v-if="this.success.shedule_meeting">{{this.success.shedule_meeting}}</small>
      <small class="alert-danger p-2" v-if="this.success.shedule_meeting">{{this.errors.meeting_sheduled}}</small>
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
                    <div class="mb-0 py-2">
                        <a v-if="! this.zoom_user_auth_token" :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&state=' + this.ZOOM_STATE + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-sm m-2" >Link with zoom</a>  
                        <button class="btn btn-sm btn-secondary m-1" v-if="this.zoom_user_auth_token && !trial_lesson.meeting_link " @click.prevent="this.acceptTrialLesson(trial_lesson)"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.schedule_meeting" role="status" aria-hidden="true" ></span> Accept and shcedule meeting </button>
                        <button class="btn btn-sm btn-secondary m-1" v-if="! trial_lesson.meeting_link" data-bs-toggle="modal" :data-bs-target="'#declineModal' + index">Decline</button>
                        <a :href="trial_lesson.meeting_link" class="btn btn-sm btn-secondary m-1" v-if="trial_lesson.meeting_link" >Launch meeting</a>
                    </div>
                    <!-- -------------------------decline lesson  modal---------------------------- -->
                        <!-- Modal -->
                        <div class="modal fade" :id="'declineModal' + index" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                
                                <h5 class="modal-title" id="exampleModalLabel">Decline lesson</h5>
                                <button type="button" id="close-decline" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">                                
                                <label for="reason">Reason &nbsp; &nbsp;</label>
                                <small class="text-success p-3 rounded my-1" v-if="this.success.success">{{this.success.success}}</small> 
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

<!-- ------------------------------------Lessons in progress-------------------------------------------------------------------------- -->

 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchLessons()">Refresh</button> </span></h4>
      <div class="row p-3 ">   
          <div class="col-md-4 row p-2"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'ongoing'">         
              <div class="border rounded p-3">
                  <div>
                      <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                          <h6 class="py-2 fw-bold"> 
                              <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                {{this.capitalize(lesson.get_lesson_student.first_name)}}
                            </h6>
                           <span class="small"> Status: {{lesson.status}}...</span>
                         </span>
                       
                      <p class="fw-bold">
                        <span>{{this.capitalize(lesson.lesson_type)}} lessons with tutor {{this.capitalize(lesson.get_lesson_student.first_name)}} </span> 
                        <span class="float-end">
                            <a :href="lesson.meeting_link" class="btn btn-secondary btn-sm my-1">Classroom</a> <br>
                             <a class="btn btn-secondary btn-sm my-1" @click.prevent="updateCurrentLesson(lesson)" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Assignments</a>
                               
                        </span>
                      </p>
                        
                        <span class="py-2">Duration: </span> <span>{{lesson.lesson_total_duration}}hrs </span>
                        <br>
                        <span class="py-2">Covered : </span> <span> {{lesson.covered_duration}}hrs </span> <br>
                        <span class="py-2">Remaining : </span> <span> {{lesson.remaining_duration}}hrs </span>

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
        <div> <Assignments :lesson="this.current_lesson"/> </div>
  </div>

</template>

<script>
import moment from "moment";

import Assignments from "./Assignemnts.vue";

export default {
    components:{
        Assignments
    },
    data(){
        return{
            current_trial_lessons:{},
            current_lessons:{},
            current_lesson:{},
            completed_lessons:{},
            decline_reason:null,
            errors:{},
            success:{},
            refresh_interval:{},
            spinner:{},
            zoom_meetings:{},
            CLIENT_ID: null,
            ZOOM_CLIENT_SECRET: null,
            REDIRECT_URI: null,
            zoom_user_auth_token: null ,
            ZOOM_STATE: this.$store.state.user.user.id,   
        }
    },
    methods:{  
        updateCurrentLesson(lesson)   {
            this.current_lesson = lesson;
        },   
        formatDate(date){
            if (date) return moment(String(date)).format('ll');            
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        updateMeetingLink(lesson_id, link){
            let form_data = new FormData();
            form_data.append('meeting_link', link);
            axios.post('/api/update-tial-lesson-link/' + lesson_id , form_data )
            .then(response => {
               console.log(response);
            })
            .catch(error=>{
                console.log(error);
            });
        },
        acceptTrialLesson(trial_lesson){
            if(trial_lesson.decline_reason !== null) {alert('Lesson already declined!'); return;}
            if(trial_lesson.tutor_confirm == 'accepted') {alert('Request already accepted and scheduled!'); return;}
            if(! confirm('Accept to meet with  ' + this.capitalize(trial_lesson.get_student.first_name) + ' on the specified date and time?')) return;
            axios.get('/api/tutor/confirm-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                // this.scheduleZoomMeeting(trial_lesson);
                this.fetchTrialLessons();
                setTimeout(() => {
                    this.errors ={};
                    this.success ={};
                    delete this.spinner.schedule_meeting 
                }, 3000);                
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        scheduleZoomMeeting(trial_lesson){
            this.spinner.schedule_meeting = true;
            var form_data = new FormData();
            form_data.append('topic', trial_lesson.lesson_type);
            form_data.append('type', 2);
            form_data.append('start_time', trial_lesson.start_date);
            form_data.append('duration', trial_lesson.duration);

            axios.get('/api/zoom/meeting/create', form_data)
            .then(response => {
                this.updateMeetingLink(trial_lesson.id, response.data.data.join_url)
                this.success.shedule_meeting = 'Success, meeting scheduled!'               
                
            })
            .catch(error=>{                
                if(error.response.status == 500) this.refreshZoomAuthToken();            
                delete this.spinner.schedule_meeting;
                this.errors.shedule_meeting = 'Failed to schedule meeting!';
                console.log(error.response);
            });
        },
        getZoomCredentials(){ // get credential  from .env on server.        
            axios.get('/api/zoom/get-credentials ')
            .then(response => {
                this.CLIENT_ID = response.data.data.client_id;
                this.ZOOM_CLIENT_SECRET = response.data.data.client_secret
                this.REDIRECT_URI = response.data.data.redirect_uri;
                console.log(response.data.client_id); 
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        refreshZoomAuthToken() { // refreshcurrent user's zoom auth token
            this.errors.token_expired = "Refreshing zoom... Please try again!"
            axios.get('/api/zoom/user-auth-token/refresh')
            .then(response => {
                setTimeout(() => {
                    delete this.errors.token_expired;
                }, 200);
                
            })
            .catch(error=>{   
                this.errors.token_expired = "Failed to authenticate zoom Please try again!"         
                console.log(error.response);
            }); 
        },
        fetchZoomAuthToken() { // fetch current user's zoom auth token
            axios.get('/api/zoom/user-auth-token')
                .then(response => {
                    this.zoom_user_auth_token = response.data.data.token;  
                })
                .catch(error=>{
                    console.log(error.response);
                }); 
            },
        declineTrialLesson(trial_lesson){
            this.errors={};
            this.success={};
            if(!this.decline_reason) return;
            if(trial_lesson.decline_reason ) {alert('Lesson already declined!'); return;}
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
        },
        scheduleRefresh(){
            this.refresh_interval.trial_lessons = setInterval(() => {
                this.fetchTrialLessons;
            }, 10000);
           this.refresh_interval.lessons =  setInterval(() => {
                this.fetchLessons();
            }, 20000);
        }
    },
    mounted(){
        this.fetchTrialLessons();
        this.fetchLessons();
        this.scheduleRefresh()
        this.getZoomCredentials();
        this.fetchZoomAuthToken();
    }
}
</script>

<style>

</style>