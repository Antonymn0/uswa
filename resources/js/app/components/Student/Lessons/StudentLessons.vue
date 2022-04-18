<template>
  
<div class="py-3 px-5">
 <div class="bg-white mt-3 ">
    <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchTrialLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
    <p class="mb-0 px-3"> Your Trial lesson requests to tutors will appear here.</p>
    <p class="text-center mb-0 py-2">
        <small class="alert-success p-2 mx-4 rounded my-3" v-if="this.success.cancel_lesson">{{this.success.cancel_lesson}}</small> 
        <small class="alert-success p-2 mx-4 rounded my-3" v-if="this.success.create_lesson">{{this.success.create_lesson}}</small> 
        <small class="alert-danger  p-2 mx-4 rounded my-3 " v-if="this.errors.process_payment"> {{this.errors.process_payment}}</small> 
        <small class="alert-success p-2 mx-4 rounded my-3" v-if="this.success.process_payment"> {{this.success.process_payment}}</small> 
    </p>
     
    <div v-if="Object.keys(this.current_trial_lessons).length"> 
    <div class="row m-1">               
        <div class="col-md-4 row p-1"  v-for="(trial_lesson, index) in this.current_trial_lessons" :key="index">              
            <div>
                <div class="border-line rounded p-3 m-1 h-100">
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span v-if="trial_lesson.get_tutor.image"> <img :src="trial_lesson.get_tutor.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                            <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(trial_lesson.get_tutor.first_name)}}
                        </h6>
                        <small class='text-muted fw-light'> <span class="small  fw-bold">  Status:</span> {{trial_lesson.tutor_confirm}} </small> 
                    </span>
                       
                    <p class="fw-bold">  {{this.capitalize(trial_lesson.lesson_type)}} trial lesson with tutor {{this.capitalize(trial_lesson.get_tutor.first_name)}} </p>
                    <span class="py-2">Scheduled for: {{this.formatDate(trial_lesson.lesson_date)}}</span> <br>                  
                    <span>Time: </span> <span>{{trial_lesson.start_time}}hrs  </span> <br>
                    <span class="py-2">Duration: </span> <span> 20 mins </span> <br>
                    
                    <p class="mb-0" v-if="trial_lesson.decline_reason !== null">
                        <span class="py-2 fw-normal">Declined:  </span> <span class="text-danger">True </span> <br>
                        <span class="py-2">Decline reason:  </span> <span> {{trial_lesson.decline_reason}}</span>
                    </p>
                   <p class="py-2 mb-0 mt-2 small" v-if="trial_lesson.tutor_confirm == 'pending' ">This trial lesson request has not been accepted yet. You will recieve a notification when {{this.capitalize(trial_lesson.get_tutor.first_name)}} responds.</p>
                   <p class="py-2 mb-0 mt-2 small" v-if="trial_lesson.tutor_confirm == 'accepted' "> {{this.capitalize(trial_lesson.get_tutor.first_name)}} has accepted the trial request. Your lesson is scheduled on the set date.</p>

                    <div class="mb-0 py-2 ">
                        <a v-if="! this.zoom_user_auth_token" :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&state=' + this.ZOOM_STATE + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-small m-2" >Link with zoom</a>  
                        <button class="btn btn-sm btn-secondary m-1" v-if="trial_lesson.tutor_confirm == 'pending' " @click.prevent="this.cancelTrialLesson(trial_lesson)">Cancel request </button>
                      
                         <span class=" d-flex align-items-center"> 
                            <a :href="trial_lesson.meeting_link" target="blank" class="btn btn-sm btn-primary m-1" v-if="trial_lesson.meeting_link " >Launch meeting</a> &nbsp;
                            <div class="dropdown small " v-if="trial_lesson.tutor_confirm == 'accepted' && trial_lesson.participant_joined_at && trial_lesson.participant_left_at"> 
                                <span class="text-primary underline" style="cursor:pointer"  type="button"  data-bs-toggle="dropdown" aria-expanded="false" :id="'trial_M_details' + trial_lesson.id" >  Duration: {{this.calculateTimeDiff(trial_lesson.meeting_started_at, trial_lesson.meeting_ended_at) }} mins </span>
                                <p class="p-3 border small dropdown-menu small text-muted rounded" :aria-labelledby="'trial_M_details' + trial_lesson.id" v-if="trial_lesson.tutor_confirm == 'accepted' && trial_lesson.participant_joined_at && trial_lesson.participant_left_at">
                                    <span class="fw-bold">Meeting Details</span>   <br>
                                    <span class="mb-2 small"> Date: {{this.formatDate(trial_lesson.meeting_started_at) }}</span> <br>
                                    <span class="my-1 small"> Start: {{this.formatDateTime(trial_lesson.meeting_started_at) }}</span> <br>
                                    <span class="my-1 small">End: {{this.formatDateTime(trial_lesson.meeting_ended_at) }}</span> <br>
                                    <span class="mt-2 border-top small">Duration: {{this.calculateTimeDiff(trial_lesson.meeting_started_at, trial_lesson.meeting_ended_at) }} mins</span>
                                </p>
                            </div>
                        </span>
                          <span v-if="!trial_lesson.is_student_impressed && trial_lesson.tutor_confirm == 'accepted' && trial_lesson.participant_joined_at">
                                Impressed by the tutor?  
                              <span class="btn btn-sm btn-primary m-1" @click="processPayment(trial_lesson)"> Yes</span>
                              <span class="btn btn-sm btn-danger m-1" @click.prevent="notImpressedbyTutor(trial_lesson)"> No</span>
                        </span> 
                        <button class="btn btn-sm btn-success m-1" v-if="trial_lesson.is_student_impressed"  @click.prevent="this.createLesson(trial_lesson)"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.create_lesson" role="status" aria-hidden="true" ></span> Create lessons </button>
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

<!-- ----------------------------------------Inprogress lessons-------------------------------------------------------------------------- -->
 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
      <small class="alert-danger p-2" v-if="this.errors.insuficient_funds">{{this.errors.insuficient_funds}}</small>
      <small class="alert-success p-2" v-if="this.success.payment_success">{{this.success.payment_success}}</small>
      <div v-if="Object.keys(this.current_lessons).length"> 
        <div class="row px-4 ">      
            <div class="col-md-4 row p-3"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'ongoing'">              
                <div>
                    <div class="border-line rounded p-2  h-100">
                        <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                            <h6 class="py-2 fw-bold"> 
                                <span v-if="lesson.get_lesson_tutor.image"> <img :src="lesson.get_lesson_tutor.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                               <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                {{this.capitalize(lesson.get_lesson_tutor.first_name)}}
                            </h6>
                            <span class="small"> Status: {{lesson.status}}...</span>
                        </span>                    
                        <p class="fw-bold">
                            <span class="m-0">{{this.capitalize(lesson.lesson_type)}} lesson with tutor {{this.capitalize(lesson.get_lesson_tutor.first_name)}} </span> 
                            <span class=" m-0 d-flex justify-content-end" style="overflow:auto">
                                <a :href="lesson.meeting_link" target="blank" class="btn btn-secondary btn-sm my-1" v-if="lesson.meeting_link && (this.getAccount.available_balance - lesson.get_lesson_tutor.hourly_rate) > 1 && !checkIfLectureUnpaid(lesson)">Classroom</a> 
                                <button v-if="(this.getAccount.available_balance - lesson.get_lesson_tutor.hourly_rate) < 1" class="btn btn-default text-muted border btn-sm m-1" data-bs-target="#paypal-modal" data-bs-toggle="modal" data-bs-dismiss="modal" > Insuficient funds</button> <br>
                                <a class="btn btn-secondary btn-sm m-1" @click.prevent="updateCurrentLesson(lesson)" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Assignments</a>  <br>
                                <button class="btn btn-warning btn-sm my-1" v-if="checkIfLectureUnpaid(lesson) && (this.getAccount.available_balance - lesson.get_lesson_tutor.hourly_rate) >= 0" @click.prevent="this.sendTutorLecturePayments(lesson)">Pay tutor</button>
                            </span>
                        </p>
                        <!-- -------------------- Lectures------------------------  -->
                        <div>
                            <h5>Lectures</h5>
                            <div v-if="Object.keys(lesson.lectures).length" class="lec-scroll border-start">   
                                                    
                                <p v-for="(lecture, index) in lesson.lectures" :key="index" class="row pt-2  rounded  lec-hover  mb-1 mx-1  ">
                                    <span class="col-1 m-0 align-middle "><i class="bi bi-patch-check-fill" v-if="this.isLectureComplete(lecture, lesson)"></i> </span>
                                    <span class=" col-7 m-0 align-middle">  {{this.capitalize(lecture.lecture_name)}}</span>
                                    <span class=" col-2 m-0 align-middle">{{lecture.lecture_duration}}<small>hrs </small> </span>                           
                                    <span class="dropdown small col-1 m-0 align-middle  " > 
                                        <span class=" col-1 m-0 align-middle text-end" style="cursor:pointer; font-size:1.5rem"  type="button"  data-bs-toggle="dropdown" aria-expanded="false" :id="'trial_M_details' + lecture.id" > <i class="bi bi-three-dots three-dot"></i></span>
                                        <p class="p-3 border small dropdown-menu small text-muted rounded" :aria-labelledby="'trial_M_details' + lecture.id" >
                                            <span class="fw-bold m-0">Description</span>  <br>
                                            <span class="m-0">{{this.capitalize(lecture.lecture_description)}}</span>                                   
                                        </p>
                                    </span>
                                    
                                </p>
                            </div>
                            <p class="text-muted small p-2" v-if="! Object.keys(lesson.lectures).length"> This tutor hasnt set any lectures yet. Defined lectures for this lesson will appear here</p>
                        </div>  
                        <!-- <p class="py-3 small">Date started : {{lesson.lessons_start_date}}</p>  -->
                        <a href="#" class="text-warning  my-3 float-end  text-decoration-underline" @click.prevent="updateCurrentLesson(lesson)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Write a review </a> 
                    </div>
                </div>              
            </div>
            </div>
          </div>
          <p class="p-3 mb-0 small text-muted" >
            Learning at Uswa is absolutely free-flow and self-paced. You  are in total control of your learning process. 
            You can take lessons anytime anywhere.                   
        </p>
          <div v-if="! Object.keys(this.current_lessons).length ">
            <p class="text-muted small text-center p-5"> You currently have no ongoing lessons</p>
          </div>
      </div>
<!-- --------------------------Review------------------------------------------ -->
<!-- -------  review modal ----------- -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Review this tutor </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="stars d-flex align-items-center mb-0"> 
            <span>Stars: </span>
            <span> <i class="bi bi-star-fill 1 text-muted" id="1" @click.prevent="updateStars(1)"></i> </span>
            <span> <i class="bi bi-star-fill 2 text-muted" id="2" @click.prevent="updateStars(2)"></i> </span>
            <span> <i class="bi bi-star-fill 3 text-muted" id="3" @click.prevent="updateStars(3)"></i> </span>
            <span> <i class="bi bi-star-fill 4 text-muted" id="4" @click.prevent="updateStars(4)"></i> </span>
            <span> <i class="bi bi-star-fill 5 text-muted" id="5" @click.prevent="updateStars(5)"></i> </span> <br> 
        </p>
        <p class="text-danger small"> {{errors.stars}} </p>
        <textarea  id="" cols="10" rows="5" v-model="this.review" class="w-100 border rounded p-2" placeholder="Write a review"></textarea>
        <small class="text-danger">{{errors.review}}</small>
      </div>
      
      <div class="modal-footer">
        <small class="text-success w-100 text-end">{{this.success.review_submited}}</small>
        <small class="text-danger w-100 text-end">{{this.errors.review_submited}}</small>
        <button class="btn btn-primary"  @click.prevent="submitReview(this.current_lesson)"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.submiting"></span> Submit</button>
        <button class="btn btn-danger" id="back-btn" data-bs-dismiss="modal" aria-label="Close">Back </button>
      </div>
    </div>
  </div>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------ -->

<div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">Completed <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
     <p class="p-3 small text-muted text-center"> Completed lessons will appear here </p>
      <div class="row p-3 " > 
          <div class="col-md-4 row p-2"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'completed'">              
              <div>
                  <div class="border-line rounded p-3 h-100">
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span v-if="lesson.get_lesson_tutor.image"> <img :src="lesson.get_lesson_tutor.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                            <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(lesson.get_lesson_tutor.first_name)}}
                        </h6>
                        <span class="small"> Status: {{lesson.status}}</span>
                        </span>                       
                    <p class="fw-bold">{{this.capitalize(lesson.lesson_type)}} lessons with tutor {{this.capitalize(lesson.get_lesson_tutor.first_name)}}</p>
                    <span class="py-2">Date started: {{this.formatDate(lesson.created_at)}}</span> <br>
                    <span class="py-2">Date completed: </span> <span> {{this.formatDate(lesson.updated_at)}}</span> <br>
                    <span class="py-2">Total Duration: </span><span>{{lesson.lesson_total_duration}}hr </span>  &nbsp; &nbsp;                      
                    <span>Score: </span> <span>{{lesson.student_score}}%</span>

                    <p class="pt-2 mb-0">This was completed in a total duration of {{lesson.lesson_total_duration}}hrs.</p>
                  </div>
                   <a href="#" class="text-warning mt-3 float-end  text-decoration-underline" @click.prevent="updateCurrentLesson(lesson)" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Write a review </a> 
              </div>              
          </div>
                   
      </div>
  </div>

   <div> <Assignments :lesson="this.current_lesson"/> </div>
  </div>
 <!-- second mini modal paypal -->
    <div class="modal fade" id="paypal-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Top up account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
            <div class="w-auto mx-uato text-left py-3">
                <label class=" text-secondary">Enter amount to topup via  paypal: </label>                   
                    <div class="py-3">                       
                        <input type="number" name="" min="5" max="100" class="form-control text-center" placeholder="Enter amount" v-model="topup_amount" @input="this.checkAmount()">
                        <small class="text-danger"> {{this.errors.topup_amount}}</small>
                    </div>
                   <div class=" mx-auto" id="paypal-button-container" ></div>  
                
               
                <small class="text-primary" v-if="this.success.payment"> {{this.success.payment}} </small>
                <small class="text-primary" v-if="this.spinner.paypal_processing"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.paypal_processing"></span> Processing...</small>
            </div>
            
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-bs-target="#staticBackdropTrial" data-bs-toggle="modal" data-bs-dismiss="modal"> <i class="bi bi-chevron-left"></i> Back </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import {mapGetters } from "vuex";

import Assignments from "./Assignemnts.vue";

export default {
    components:{
        Assignments
    },
    data(){
        return{
            current_trial_lessons:{},
            current_lessons:{},
            current_lesson:{ get_assignments:{} },
            completed_lectures:{},
            decline_reason:null,       
            refresh_interval:{},
            paypal_client_id:'',
            topup_amount:null,
            zoom_meetings:{},
            CLIENT_ID: null,
            ZOOM_CLIENT_SECRET: null,
            REDIRECT_URI: null,
            success:{},
            errors:{},
            spinner:{},
            stars:null,
            review: null,
            zoom_user_auth_token: null ,
            spinner:{},  
            ZOOM_STATE: this.$store.state.user.user.id, 
        }
    },
    methods:{
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        updateCurrentLesson(lesson)   {
            this.current_lesson = lesson;
        },
        formatDate(date){
            if (date) return moment(String(date)).format('ll');            
        },
        formatDateTime(date){
            if (date) {return moment(String(date)).format('LT');}            
        },
        calculateTimeDiff(start_time, end_time){ 
            let duration = 0;
            if(! start_time || !end_time ) return 'Unknown';

            duration = moment(start_time).diff(moment(end_time), 'minutes');
            if(duration < 1) duration = 1;
            return duration;
            
        },
        showMeetingDetails(el_id){
            let el = document.getElementById(el_id);
            if(el.classList.contains('hidden')) el.classList.remove('hidden');
            else el.classList.add('hidden');
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        cancelTrialLesson(trial_lesson){
            if(trial_lesson.tutor_confirm !== 'pending'){alert('Cannot cancel this trial lesson'); return;}
            if(! confirm('Do you want to cancel this trial lesson. \n If you cancel, you and the tutor will no longer be able to view this lesson.')) return;
            axios.get('/api/student/cancel-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                this.fetchTrialLessons();
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
        checkAmount(){
            if( this.topup_amount >= 5 && this.topup_amount <= 100) {                
                this.errors ={}
                if(this.getUser.role == 'student' ) this.loadPaypalCheckout();
            }
            else {
                this.errors.topup_amount = "Enter value between 5 and 100";
                this.topup_amount = 0;
                }
        },
        isLectureComplete(lecture, lesson){ //determine if the lecture is 'marked' completed or otherwise
            var css_class = false;
            if(!lesson) return;
            if(! Object.keys(this.completed_lectures).length) return;

            this.completed_lectures.forEach(lec=>{                
                if(lec.lecture_id == lecture.id && lec.lesson_id == lesson.id)   css_class = true;
            });
            return css_class;
        },
        checkIfLectureUnpaid(lesson){             
            if(!lesson) return;
            if(! Object.keys(this.completed_lectures).length) return;

            var unpaid = false;
            this.completed_lectures.forEach(lec=>{                
                if(lec.payment_status == 'unpaid' && lec.lesson_id == lesson.id)   unpaid = true;//if any lecture is unpaid set true
            });
            return unpaid;           
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
                this.completed_lectures = response.data.data.data[0].completed_lectures; // load completed lectures to local data
                this.current_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        updateStars(star_num){
            this.stars = star_num;
            this.toggleStarViewColor(star_num);
        },
        toggleStarViewColor(star_num){
            var stars = document.getElementsByClassName('bi-star-fill');
            for(var i =0; i<stars.length; i++ ){
                stars[i].classList.remove('text-warning');
                stars[i].classList.add('text-muted');
            }
            if(star_num == 6) return; //reset value
            for(var i =0; i<stars.length; i++ ){
                stars[i].classList.remove('text-muted');
                stars[i].classList.add('text-warning');
                if(stars[i].classList.contains(star_num)) return;
            }
            console.log(stars);
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
        if(! confirm('Schedule lessons with this tutor?')) return;
        this.spinner.create_lesson=true;
        var form_data = new FormData(); 
            form_data.append('lesson_date', trial_lesson.lesson_date);
            form_data.append('start_time', trial_lesson.start_time);
            form_data.append('lesson_type', trial_lesson.lesson_type);
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
    deleteLesson(lesson){
        axios.delete('/api/lesson/delete/{lesson_id/' + lesson.id)
        .then(response=>{
            console.log(response);
        })
        .catch(error=>{
            console.log(error.response);
        })
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
    sendTutorLecturePayments(lesson){
        // process payments fopr the lectures 
        if((this.getAccount.available_balance - lesson.get_lesson_tutor.hourly_rate) < 1) {alert('Cannot process payments. Insufficient funds '); return;}
        if(!confirm('Process payment arrears for the completed lectures?')) return;
        axios.get('/api/students/send-tutor-payments/' + lesson.id)
        .then(response =>{
            this.success.payment_success = 'Success, Payment processed';
            this.$store.dispatch('fetchLocalAccount');
            this.fetchLessons();
            setTimeout(() => {
                    this.success={}
                }, 3500);
        })
        .catch(error=>{
            if(error.response.status == 402){
                this.$store.dispatch('fetchLocalAccount');
                alert(`Insufficient funds to process payment. \n You have $${error.response.data.data.amount_due} arrears for ${error.response.data.data.lecture_count} unpaid lectures. \n \n Please top up your account and try again. `);
                this.errors.insuficient_funds = 'Failed, insufficient funds';
                setTimeout(() => {
                    this.errors={}
                }, 3500);
            }
            console.log(error.response.data.data);
            })
        },
        async scheduleZoomMeeting(lesson){
            var form_data = new FormData();
            form_data.append('topic', lesson.lesson_type);
            form_data.append('type', 3);
            form_data.append('start_time', lesson.start_date);
            form_data.append('duration', '60');

            axios.get('/api/zoom/meeting/create', form_data)
            .then(response => {
                this.updateMeetingLink(lesson.id,response.data.data.id, response.data.data.join_url);
                this.fetchTrialLessons();
                this.fetchLessons();
                console.log(response.data.data.join_url);
            })
            .catch(error=>{  
                this.deleteLesson(lesson);
                delete this.spinner.schedule_meeting;
                this.errors.shedule_meeting = 'Failed to schedule meeting!';
                console.log(error.response);
            });
        },
        updateMeetingLink(lesson_id, meeting_id, link){
            let form_data = new FormData();
            form_data.append('meeting_link', link);
            form_data.append('meeting_id', meeting_id);
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
        submitReview(lesson){
            this.validateReviewForm();
            if(Object.keys(this.errors).length) return;
            if(! confirm("Submit this Review?")) return;

            var form_data = new FormData();
            form_data.append('reviewer_id', lesson.student_id );
            form_data.append('reviewee_id', lesson.tutor_id );
            form_data.append('body', this.review);
            form_data.append('stars', this.stars);

            this.spinner.submiting = true
            axios.post('/api/reviews', form_data)
            .then(response=>{                
                if(response.status == 201){
                    this.success.review_submited= "Success, Review submited."
                    this.spinner={}
                }
                setTimeout(() => {
                    this.stars = null;
                    this.review = null;
                    this.toggleStarViewColor(6);
                    this.errors = {}
                    this.success = {}
                    this.spinner={}                    
                    document.getElementById('back-btn').click();
                }, 3000);
                
            })
            .catch(error=>{
                this.spinner={}                
                console.log(error.response.data.message);
                if(error.response.status == 422) this.errors.review_submited = error.response.data.message;
            });            
        },
        validateReviewForm(){
            this.errors ={}
            if(! this.stars) this.errors.stars = 'Please select number of stars';
            if(! this.review) this.errors.review = 'This field is required';
        },
        processPayment(trial_lesson){ 
           // process paypal payments if impressed
            if(!confirm("By clicking yes, You accept to take lessons from this tutor.")) return;

            var form_data = new FormData();
            form_data.append('trial_lesson', JSON.stringify(trial_lesson));

            // Call  server to capture the transaction            
            axios.post('/api/transfer-payments', form_data)
            .then(response=>{                
                this.success.process_payment = 'Success,  Please  go ahead and schedule your lessons with the tutor!'                     
                this.$store.dispatch('fetchLocalAccount');
                this.fetchTrialLessons();
                console.log(response);

            })
            .catch(error=>{  
                this.errors.process_payment = 'Error, Failed to process payment!'  ;                   
                console.log(error.response);
            });
        },
        notImpressedbyTutor(trial_lesson){
            if(!confirm('We are sorry to hear this '+ this.getUser.first_name +', \n You can always find yourself another tutor from the pool. \n Make sure to watch the tutors introduction video first. \n This trial record will be discarded for now and will no longer be available. \n Proceed?')) return;
            axios.get('/api/student/cancel-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                this.success.cancel_lesson ="Success, Trial lesson discarded";
                setTimeout(() => {
                    this.success ={};
                }, 2500);
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        fetchPaypalClientID(){
            axios.get('/api/get-paypal-clientId')
            .then(response=>{
                this.paypal_client_id = response.data.data;
                this.loadPaypalCheckout();
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        loadAsync(url, callback) {
            var s = document.createElement('script');
            s.setAttribute('src', url); s.onload = callback;
            document.head.insertBefore(s, document.head.firstElementChild);
        },
        loadPaypalCheckout(){ 
            // load paypal buttons 
            if(!this.topup_amount || this.topup_amount < 5 || this.topup_amount >100) return;
            var amount = this.topup_amount;           
            this.loadAsync('https://www.paypal.com/sdk/js?client-id=' + this.paypal_client_id + '&intent=authorize&disable-funding=credit,card', function() {
                paypal.Buttons({                    
                    // Set up the transaction
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    currency_code: "USD",
                                    value: amount
                                },                                
                            }],
                            application_context: {
                                shipping_preference: 'NO_SHIPPING',
                                SOLUTIONTYPE:'MARK'
                            }, 
                        });
                    },   

                   // Finalize the transaction
                onApprove: function(data, actions) {
                    // Authorize the transaction
                    actions.order.authorize().then(function(authorization) {                        
                        axios.post('/api/update/local-account', authorization )
                        .then(response=>{ 
                            window.location.reload();
                        })
                        .catch(error=>{                       
                            console.log(error.response);
                        });
                    });
                    }
                }).render('#paypal-button-container');
            });     
        },
        shedulefetchRefresh(){
            setInterval(() => {
                this.fetchLessons();
            }, 60000);
            setInterval(() => {
                this.fetchTrialLessons();
            }, 60000);
        }
   },
   computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    mounted(){
        this.fetchTrialLessons();
        this.fetchLessons();
        this.fetchZoomAuthToken();
        this.getZoomCredentials();
        this.fetchPaypalClientID();
        this.shedulefetchRefresh();        
    }

}
</script>

<style scoped>
.lec-scroll{
    height:auto;
    width:100%;
    max-height: 10rem;
    overflow:scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }
    .lec-scroll::-webkit-scrollbar {
    display: none;
    }
    .dropdown{
        width:auto !important;
    }
    .lec-hover{
        border:1px solid rgb(223, 219, 219);
    }
    .lec-hover:hover{
        border:1px solid rgb(180, 177, 177);
    }
    .three-dot:hover{
         color: rgb(116, 114, 114);
    }
    .border-line{
        border:1px solid rgb(231, 231, 231);
        width:100%;
    }
    .border-line:hover{
        border:1px solid rgb(248, 186, 186);
    }

    /* media rules */
    @media only screen and (max-width: 750px){
        .px-5, .px-4{
            padding-left:0 !important;
            padding-right:0 !important;
        }
    }
</style>