<template>
  
<div class="p-3">
  <div>my lessons</div>

 <div class="bg-white mt-3 ">
    <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchTrialLessons()">Refresh</button> </span></h4>
    <small class="alert-success p-2 mx-4 rounded my-3" v-if="this.success.cancel_lesson">{{this.success.cancel_lesson}}</small> 
    <small class="alert-success p-2 mx-4 rounded my-3" v-if="this.success.create_lesson">{{this.success.create_lesson}}</small> 
    <p class="mb-0 px-3"> Your Trial lesson requests to tutors will appear here.</p>
    <div v-if="Object.keys(this.current_trial_lessons).length"> 
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

                    <div class="mb-0 py-2">
                        <a v-if="! this.zoom_user_auth_token" :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&state=' + this.ZOOM_STATE + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-small m-2" >Link with zoom</a>  
                        <button class="btn btn-sm btn-secondary m-1" v-if="! trial_lesson.meeting_link" @click.prevent="this.cancelTrialLesson(trial_lesson)">Cancel request </button>
                        <!-- <button class="btn btn-sm btn-secondary m-1" v-if="! trial_lesson.meeting_link" @click.prevent="this.openTrialLesson()">Open </button> -->
                        <a :href="trial_lesson.meeting_link"   class="btn btn-sm btn-secondary m-1" v-if="trial_lesson.meeting_link" >Launch meeting</a>
                        <button class="btn btn-sm btn-secondary m-1"  v-if=" trial_lesson.meeting_link" @click.prevent="this.createLesson(trial_lesson)"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.create_lesson" role="status" aria-hidden="true" ></span> Create lesson </button>
                    </div>                   
                </div>
            </div>              
        </div> 
      </div>
      </div>
      <div v-else>
        <p class="text-muted small text-center p-5"> You currently have no trial lessons</p>
     </div>  
  </div>

<!-- ----------------------------------------trial lessons-------------------------------------------------------------------------- -->

 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchLessons()">Refresh</button> </span></h4>
      <div v-if="Object.keys(this.current_lessons).length"> 
      <div class="row px-4 ">      
          <div class="col-md-4 row p-3"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'ongoing'">              
              <div class="border rounded p-3">
                  <div>
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(lesson.get_lesson_tutor.first_name)}}
                        </h6>
                        <span class="small"> Status: {{lesson.status}}...</span>
                    </span>                    
                    <p class="fw-bold">
                        <span>{{this.capitalize(lesson.lesson_type)}} lesson with tutor {{this.capitalize(lesson.get_lesson_tutor.first_name)}} </span> 
                        <span class="float-end">
                            <a :href="lesson.meeting_link" class="btn btn-secondary btn-sm my-1">Classroom</a> <br>
                             <a class="btn btn-secondary btn-sm my-1" @click.prevent="updateCurrentLesson(lesson)" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Assignments</a>
                        </span>
                      </p>
                        
                        <span class="py-2">Duration: </span> <span>{{lesson.lesson_total_duration}}hrs </span>
                        <br>
                        <span class="py-2">Covered : </span> <span> {{lesson.covered_duration}}hrs </span> <br>
                        <span class="py-2">Remaining : </span> <span> {{lesson.remaining_duration}}hrs </span>
                    
                    <p class="pt-2 mb-0 small" >
                    Learning at Uswa is absolutely free-flow and self-paced. You  are in total control of your learning process. <br> 
                    You can take lessons anytime anywhere in the world.  Happy learning..                   
                    </p>
                    <span class="py-3 small">Date started : {{lesson.lessons_start_date}}</span> <br>
                  </div>
              </div>              
          </div>
          </div>
          </div>
          <div v-else>
            <p class="text-muted small text-center p-5"> You currently have no ongoing lessons</p>
          </div>
      </div>


<!-- ------------------------------------------------------------------------------------------------------------------------ -->

<div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">Completed <span class="float-end mx-3"> <button class="btn btn-sm btn-secondary" @click.prevent="fetchLessons()">Refresh</button> </span></h4>
      <div class="row p-3 "> 
          <div class="col-md-4 row p-2"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'completed'">              
              <div class="border rounded p-3">
                  <div>
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(lesson.get_lesson_tutor.first_name)}}
                        </h6>
                        <span class="small"> Status: {{lesson.status}}</span>
                        </span>                       
                    <p class="fw-bold">{{this.capitalize(lesson.lesson_type)}} lessons with tutor {{this.capitalize(lesson.get_lesson_tutor.first_name)}}</p>
                    <span class="py-2">Date started: {{this.formatDate(lesson.lessons_start_date)}}</span> <br>
                    <span class="py-2">Date completed: </span> <span> {{this.formatDate(lesson.lessons_end_date)}}</span> <br>
                    <span class="py-2">Total Duration: </span><span>{{lesson.lesson_total_duration}}hr </span>  &nbsp; &nbsp;                      
                    <span>Score: </span> <span>{{lesson.student_score}}%</span>

                      <p class="pt-2 mb-0">This was completed in a total duration of {{lesson.lesson_total_duration}}hrs.</p>
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
            decline_reason:null,       
            refresh_interval:{},
            zoom_meetings:{},
            CLIENT_ID: null,
            ZOOM_CLIENT_SECRET: null,
            REDIRECT_URI: null,
            success:{},
            errors:{},
            spinner:{},
            zoom_user_auth_token: null ,
            spinner:{},  
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
        cancelTrialLesson(trial_lesson){
            if(trial_lesson.tutor_confirm !== null){alert('Cannot cancel this lesson'); return;}
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
        openTrialLesson(){
            if(!confirm('Open trial lesson window?')) return;
            this.$router.push({name: 'student-trial-lesson'});
        },
        fetchTrialLessons(){
            axios.get('/api/students/fetch-lessons/trial')
            .then(response =>{
                this.current_trial_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        fetchLessons(){
            axios.get('/api/students/fetch-lessons')
            .then(response =>{
                console.log(response.data.data.data);
                this.current_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
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
    async createLesson(trial_lesson){
        this.spinner.create_lesson=true;
        var form_data = new FormData(); 
            form_data.append('lesson_date', trial_lesson.lesson_date);
            form_data.append('start_time', trial_lesson.start_time);
            form_data.append('lesson_type', 3);
            form_data.append('student_id', trial_lesson.student_id);
            form_data.append('student_timezone', this.$store.state.user.user.timezone);
            form_data.append('tutor_id', trial_lesson.tutor_id);
            form_data.append('trial_lesson_id', trial_lesson.id);
            form_data.append('tutor_confirm', 'pending');
            form_data.append('lesson_total_duration', '40');
            form_data.append('covered_duration', '0');
            form_data.append('remaining_duration', '0');
            form_data.append('status', 'ongoing');
            form_data.append('tutor_timezone', trial_lesson.timezone);            
            
        axios.post('/api/lessons/create', form_data)
        .then(response => {
           console.log(response.data.data);
           this.scheduleZoomMeeting(response.data.data); //schedule zoom meeting
           this.success.create_lesson = "Success, Lesson created";
           this.spinner.create_lesson=false;
           setTimeout(() => {
              delete this.success.create_lesson ;
           }, 3500);
        })
        .catch(error=>{
            this.spinner.create_lesson=false;
            if(error.response.status == 422) { alert('Lessons already created!'); return; }            
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
    async updateLessonMeetingLink(lesson_id){
        //

    },
    async scheduleZoomMeeting(lesson){
        var form_data = new FormData();
        form_data.append('topic', lesson.lesson_type);
        form_data.append('type', 2);
        form_data.append('start_time', lesson.start_date);
        form_data.append('duration', lesson.duration);

        axios.get('/api/zoom/meeting/create', form_data)
        .then(response => {
            this.updateMeetingLink(lesson.id, response.data.data.join_url);
            console.log(response.data.data.join_url);
        })
        .catch(error=>{            
            if(error.response.status == 500) {
                this.refreshZoomAuthToken(); 
                this.scheduleZoomMeeting(lesson);
                }           
            delete this.spinner.schedule_meeting;
            this.errors.shedule_meeting = 'Failed to schedule meeting!';
            console.log(error.response);
        });
    },
    updateMeetingLink(lesson_id, link){
        let form_data = new FormData();
        form_data.append('meeting_link', link);
        axios.post('/api/update-lesson-link/' + lesson_id , form_data )
        .then(response => {
            console.log(response);
        })
        .catch(error=>{
            console.log(error);
        });
    },
    async refreshZoomAuthToken() { // refreshcurrent user's zoom auth token
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


},
mounted(){
    this.fetchTrialLessons();
    this.fetchLessons();
    this.fetchZoomAuthToken();
    this.getZoomCredentials();
}

}
</script>

<style>

</style>