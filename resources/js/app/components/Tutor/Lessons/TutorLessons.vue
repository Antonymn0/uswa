<template>
  
<div class="p-3 px-5">

  <div class="bg-white  ">      
      <h4 class="alert-secondary w-100 py-3 px-3">Trial lessons <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchTrialLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
        <p class="px-3 small">
            Request for trial lessons from students will appear here. You can either choose to accept requests or decline.
        </p>
        <small class="alert-success p-2" v-if="this.success.shedule_meeting">{{this.success.shedule_meeting}}</small>
      <small class="alert-danger p-2" v-if="this.success.shedule_meeting">{{this.errors.meeting_sheduled}}</small>
      <div class="row p-3 ">          
          <div class="col-md-4 row p-1"  v-for="(trial_lesson, index) in this.current_trial_lessons" :key="index">              
              <div>
                  <div class="border-line rounded p-2 h-100">
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span v-if="trial_lesson.get_student.image"> <img :src="trial_lesson.get_student.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                            <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(trial_lesson.get_student.first_name)}}
                        </h6>
                        <small class='text-muted small fw-light'> <span class="small  fw-bold">  Status:</span> {{trial_lesson.tutor_confirm}} </small> 
                    </span>
                       
                    <p class="fw-bold">{{this.capitalize(trial_lesson.get_student.first_name)}} wants to book  {{this.capitalize(trial_lesson.lesson_type)}}  lessons with you</p>
                    <span class="py-2">Scheduled for: {{this.formatDate(trial_lesson.lesson_date)}}</span> <br>                  
                    <span>Time: </span> <span>{{trial_lesson.start_time}}hrs </span> <span class="btn btn-secondary btn-sm float-end" data-bs-target="#reschedule-trial-lesson" data-bs-toggle="modal" data-bs-dismiss="modal" @click.prevent="updateCurrentTrialLesson(trial_lesson)">Reschedule</span> <br>
                    <span class="py-2">Duration: </span> <span>20 mins </span> <br>
                    <!-- <span class="py-2">Expired: </span> <span> false</span> <br> -->
                    
                    <p class="mb-0" v-if="trial_lesson.decline_reason !== null">
                        <span class="py-2 fw-normal">Declined:  </span> <span class="text-danger">True </span> <br>
                        <span class="py-2">Decline reason:  </span> <span> {{trial_lesson.decline_reason}}</span>
                    </p>                  

                    <p class="pt-2 mb-0"  v-if="trial_lesson.decline_reason == null">{{this.capitalize(trial_lesson.get_student.first_name)}} is eager to start learning {{this.capitalize(trial_lesson.lesson_type)}} with you.</p>
                    <div class="mb-0 py-2">
                        <a v-if="! this.zoom_user_auth_token" :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&state=' + this.ZOOM_STATE + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-sm m-2" >Link with zoom</a>  
                        <button class="btn btn-sm btn-secondary m-1" v-if="this.zoom_user_auth_token && !trial_lesson.meeting_link " @click.prevent="this.acceptTrialLesson(trial_lesson)"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.schedule_meeting" role="status" aria-hidden="true" ></span> Accept and schedule meeting </button>
                        <button class="btn btn-sm btn-secondary m-1" v-if="trial_lesson.status == 'pending'" data-bs-toggle="modal" :data-bs-target="'#declineModal' + index">Decline</button>
                        <a :href="trial_lesson.meeting_link" target="blank" class="btn btn-sm btn-secondary m-1" v-if="trial_lesson.meeting_link" >Launch meeting</a>                       
                  
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
        <p class="text-muted text-center p-2 small mb-0">Tip: Students can cancel the lessons if they are not satisfied during the trial or if there is no response</p>             
      </div>
  </div>

<!-- ------------------------------------Lessons in progress-------------------------------------------------------------------------- -->

 <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">In progress <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
     <small class="alert-danger text-center p-2 rounded" v-if="this.errors.mark_complete"> {{this.errors.mark_complete}} </small>
     <small class="alert-success text-center p-2 rounded" v-if="this.success.lesson_complete"> {{this.success.lesson_complete}} </small>
     <small class="alert-danger text-center p-2 rounded" v-if="this.errors.lesson_complete"> {{this.errors.lesson_complete}} </small>
     <div v-if="Object.keys(this.current_lessons).length  "> 
      <div class="row p-2 ">            
          <div class="col-md-4 row p-1"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'ongoing'">         
              <div>
                  <div class="border-line rounded p-3 h-100">
                    <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                        <h6 class="py-2 fw-bold"> 
                            <span v-if="lesson.get_lesson_student.image"> <img :src="lesson.get_lesson_student.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                            <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                            {{this.capitalize(lesson.get_lesson_student.first_name)}}
                        </h6>
                        <span class="small"> Status: {{lesson.status}}...</span>
                    </span>
                       
                    <p class="fw-bold">
                        <span class="m-0">{{this.capitalize(lesson.lesson_type)}} lessons with tutor {{this.capitalize(lesson.get_lesson_student.first_name)}} </span> 
                        <span class="d-flex m-0 ">
                            <a :href="lesson.meeting_link" target="blank" v-if="lesson.meeting_link && ! this.checkIfLectureUnpaid(lesson)" class="btn btn-secondary btn-sm m-1">Classroom</a> <br>
                            <button class="btn btn-default m-1 btn-sm border " v-if="this.checkIfLectureUnpaid(lesson)" @click.prevent="showArrearsTip()">Arrears </button>
                            <a class="btn btn-secondary btn-sm m-1" @click.prevent="updateCurrentLesson(lesson)" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Assignments</a>
                        </span>
                    </p>

                   <!-- --------------------- Lectures---------------------------------------------------       -->
                    <div>
                        <h5>Lectures  </h5>
                        <div v-if="Object.keys(lesson.lectures).length" class="lec-scroll border-start mb-2">
                            <p v-for="(lecture, index) in lesson.lectures" :key="index" class="row small pt-2 pb- rounded align-middle lec-hover  mb-1 mx-1 " >
                                <span class="col-1 m-0 align-middle "><i class="bi bi-patch-check-fill" v-if="this.isLectureComplete(lecture, lesson)"></i> </span>
                            <span class="col-7 m-0 align-middle">
                                <span class=" dropdown  " > 
                                        <span class="  m-0 align-middle three-dot"  style="cursor:pointer "  type="button"  data-bs-toggle="dropdown" aria-expanded="false" :id="'trial_M_details' + lecture.id" >{{this.capitalize(lecture.lecture_name)}}</span>
                                        <p class="p-3 border small dropdown-menu small text-muted rounded" :aria-labelledby="'trial_M_details' + lecture.id" >
                                            <span class="fw-bold m-0">Description</span>  <br>
                                            <span class="m-0">{{this.capitalize(lecture.lecture_description)}}</span>                                   
                                        </p>
                                    </span>
                                </span>                             
                                <span class=" col-2 m-0 align-middle">{{lecture.lecture_duration}}<small>hrs </small> </span>                         
                                <span class=" small col-1 m-0 align-middle  " > 
                                    <span class="  m-0 align-middle" style="cursor:pointer; font-size:1.5rem"  type="button"  data-bs-toggle="dropdown" aria-expanded="false" :id="'trial_Mo_details' + lecture.id" > <i class="bi bi-three-dots three-dot"></i></span>
                                    <p class="p-3 border small dropdown-menu small text-muted rounded" :aria-labelledby="'trial_Mo_details' + lecture.id" >
                                        <span class="fw-bold m-0 btn btn-sm btn-success" @click.prevent="markLectureComplete(lecture, lesson)">Complete</span>  <br>                                                               
                                    </p>
                                </span>
                            </p>
                            <button class="btn btn-sm btn-primary form-control my-1" v-if="isAllLecturesComplete(lesson.lectures, this.completed_lectures, lesson)" @click.prevent="markLessonComplete( lesson)"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.lesson_complete"></span> Mark this lesson complete </button> 
                        </div>                       
                           <p class="text-muted small p-5" v-else> You havent defined any lectures yet. Click <span class="text-primary underline" data-bs-toggle="modal" data-bs-target="#lecturesModal" style="cursor:pointer"> here to define</span> </p>
                    </div>                   
                  </div>
              </div>              
          </div>
      </div>
       <p class="p-2  small text-center text-muted" v-show="Object.keys(this.current_lessons).length  ">
           Tip:  You and your students are in total control of planning your lessons. 
            Teach from anywhere anytime.
        </p>
      </div>
      <div v-else >
            <p class="text-muted small  text-center p-5"> You currently have no ongoing lessons</p>
        </div>
  </div>

<!-- --------------------------------------------------------------------------------------------------------------- -->

  <div class="bg-white mt-3 ">
      <h4 class="alert-secondary w-100 py-3 px-3">Completed <span class="float-end mx-3"> <button class="btn btn-sm btn-danger" @click.prevent="fetchLessons()"><i class="bi bi-arrow-clockwise"></i></button> </span></h4>
      <div class="row p-3 "> 
          <div class="col-md-4 row p-1"  v-for="(lesson, index) in this.current_lessons" :key="index" v-show="lesson.status == 'completed'">                
              <div v-show="lesson.status == 'completed'">
              <div>
                  <div class="border-line rounded p-3 h-100">
                      <span class="d-flex border-bottom mb-2 justify-content-between align-items-center">
                          <h6 class="py-2 fw-bold"> 
                              <span v-if="lesson.get_lesson_student.image"> <img :src="lesson.get_lesson_student.image" alt="profile pic" style="height:26px; width:26px; border-radius:50%"> </span>
                              <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.5rem"></i> </span>
                                 Antony mn
                            </h6>
                           <span class="small"> Status: {{lesson.status}}</span>
                         </span>
                       
                      <p class="fw-bold">{{lesson.lesson_type}} lessons</p>
                      <span class="py-2">Date started: {{this.formatDate(lesson.created_at)}}</span> <br>
                      <span class="py-2">Date completed: </span> <span> {{this.formatDate(lesson.updated_at)}}</span> <br>
                      <span class="py-2">Course Duration: </span><span>{{lesson.lesson_total_duration}}hrs </span>  <br>                      
                      <span>Student score: </span> <span>{{lesson.student_score}}%</span>

                      <p class="pt-2 mb-0 small">This course was taught in a total duration of {{lesson.lesson_total_duration}}hrs.</p>
                  </div>
              </div>              
              </div>              
          </div>
            <p class="p-3 mb-0 small text-muted "> 
               Tip: <br>
                <i class="bi bi-dot"></i> Completed lessons will appear here <br>
                <i class="bi bi-dot"></i>  Complete more lessons with your students. <br>
                <i class="bi bi-dot"></i>  Always aim to get a 5 star review   <br>       
                <i class="bi bi-dot"></i>  This will increase your rating   <br>       
            </p> 
      </div>
  </div>
        <div> <Assignments :lesson="this.current_lesson"/> </div>
  </div>
 <!-- Reschedule trial lesson -->
    <div class="modal fade" id="reschedule-trial-lesson" aria-hidden="true" aria-labelledby="exampleModalToggleLabelreschedule" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header"> <h5> Reschedule Trial lesson </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
            <div class="w-auto mx-uato text-left py-3">                                  
                    <div class="py-3">   
                        <label class=" text-secondary">Date: </label>                     
                        <input type="date" name=""  class="form-control text-center" placeholder="Date" v-model="trial_lesson_reschedule_date">
                        <small class="text-danger"> {{this.errors.trial_lesson_reschedule_date}}</small>
                    </div>                
                    <div class="py-3">   
                        <label class=" text-secondary">Time: </label>    
                        <select name="" id="from" class="p-2 w-100 rounded bg-white border text-muted" v-model="this.trial_lesson_reschedule_time">
                            <option  value='' selected class="form-contro" > - Select - </option>
                            <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro" > {{item}} </option>
                        </select>                
                         <small class="text-danger"> {{this.errors.trial_lesson_reschedule_time}}</small>
                    </div>                
               
                <small class="text-primary" v-if="this.success.payment"> {{this.success.payment}} </small>
                <small class="text-primary" v-if="this.spinner.paypal_processing"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.paypal_processing"></span> Processing...</small>
            </div>
            
        </div>
        <div class="py-3 border-top text-end me-3">
            <small class="text-success"> {{this.success.reschedule_trial_lesson}} <br> </small>
          <button class="btn btn-primary m-1" @click.prevent="this.rescheduleTrialLesson(this.current_trial_lesson)" > <span class="spinner-border spinner-border-sm" v-if="this.spinner.reschedule_trial_lesson" role="status" aria-hidden="true" ></span> Reschedule </button>
          <button class="btn btn-danger m-1" id="reschedule" data-bs-target="#staticBackdropTrial" data-bs-toggle="modal" data-bs-dismiss="modal"> Cancel </button>
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
            current_trial_lesson:{},
            current_lessons:{},
            completed_lectures:{},
            lectures:{},
            current_lesson:{  get_assignments:{}   },
            trial_lesson_reschedule_date:null,
            trial_lesson_reschedule_time:null,
            completed_lessons:{},
            decline_reason:null,
            errors:{},
            success:{},
            spinner:{},
            refresh_interval:{},
            spinner:{},
            zoom_meetings:{},
            CLIENT_ID: null,
            ZOOM_CLIENT_SECRET: null,
            REDIRECT_URI: null,
            zoom_user_auth_token: null ,
            ZOOM_STATE: this.$store.state.user.user.id,   
            time_selector:[
                        '00:00',
                        '00:30',
                        '01:00',
                        '01:30',
                        '02:00',
                        '02:30',
                        '03:00',
                        '03:30',
                        '04:00',
                        '04:30',
                        '05:00',
                        '05:30',
                        '06:00',
                        '06:30',
                        '07:00',
                        '07:30',
                        '08:00',
                        '08:30',
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                        '12:30',
                        '13:00',
                        '13:30',
                        '14:00',
                        '14:30',
                        '15:00',
                        '15:30',
                        '16:00',
                        '16:30',
                        '17:00',
                        '17:30',
                        '18:00',
                        '18:30',
                        '19:00',
                        '19:30',
                        '20:00',
                        '20:30',
                        '21:00',
                        '21:30',
                        '22:00',
                        '22:30',
                        '23:00',
                        '23:30',
                    ],
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{  
        updateCurrentLesson(lesson)   {
            this.current_lesson = lesson;
        },          
        formatDate(date){
            if (date) return moment(String(date)).format('ll');            
        },
         updateCurrentTrialLesson(trial_lesson)   {
            this.current_trial_lesson = trial_lesson;
        },
        convertDateToLocal(date, student){           
            // convert date from utc to local date 
          if(! date ) return "Invalid date 1";
          if(! student ) return "Invalid date parameter";
          else  {
             
              let student_tz = student.local_timezone;
              let date =  moment.tz(date, student_tz);
              let utc_time = moment.utc(date); // parse date into utc

              let local_time = utc_time.clone().local().format("YYYY-MM-DD"); // covert date into current local time
              return local_time;              
          }  
          
        },
        convertTimeToLocal(date, student){           
            // convert date from utc to local date 
          if(! date ) return "Invalid time";
          if(! student ) return "Invalid time parameter";
          else  {
             
              let student_tz = student.local_timezone;
              let date =  moment.tz(date, student_tz);
              let utc_time = date.utc(); // parse date into utc

              let local_time = utc_time.clone().local().format("hh:mm a"); // covert date into current local time
              return local_time;              
          }  
          
        },
        showArrearsTip(){
            alert("This student hasn't cleared the previous lectures arrears yet!");
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        updateMeetingLink(lesson_id, meeting_id, meeting_link){
            console.log(meeting_id);
            let form_data = new FormData();
            form_data.append('meeting_link', meeting_link);
            form_data.append('meeting_id', meeting_id);
            axios.post('/api/update-trial-lesson-link/' + lesson_id , form_data )
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
          this.spinner.schedule_meeting = true;
            axios.get('/api/tutor/confirm-trial-lesson/' + trial_lesson.id)
            .then(response =>{
                this.scheduleZoomMeeting(trial_lesson);
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
        markLectureComplete(lecture, lesson){
            if(!confirm('Are you sure to mark this lecture complete?')) return;
            var form_data = new FormData();
                form_data.append('lesson_id', lesson.id);
                form_data.append('lecture_id', lecture.id);
                form_data.append('student_id', lesson.student_id);
                form_data.append('tutor_id', lesson.tutor_id);
                form_data.append('marked_by', lesson.tutor_id);
                form_data.append('payment_status','unpaid');
                form_data.append('amount_due',this.getUser.hourly_rate);
            axios.post('/api/lecture/completed', form_data)
            .then(response => {
                this.fetchLessons();
                console.log(response.data);   
            })
            .catch(error=>{  
                if(error.response.status == 422){
                    this.errors.mark_complete = error.response.data.message;
                    setTimeout(() => {
                        this.errors={}
                    }, 3500);
                } 
                console.log(error.response);
            });
        },
        isLectureComplete(lecture, lesson){ //determine if the lecture is 'marked' completed or otherwise
            var css_class = false;
            this.completed_lectures.forEach(lec=>{                
                if(lec.lecture_id == lecture.id && lec.lesson_id == lesson.id)   css_class = true;
            });
            return css_class;
        },
        isAllLecturesComplete(lectures, completed_lectures, lesson){ //determine if all the lectures are 'marked' completed or otherwise means leasson complete
            var current_completed_lectures = []
            var completed_count =0;
            var is_lesson_complete=false;
            completed_lectures.forEach(complete_lec =>{
                if(complete_lec.lesson_id == lesson.id) current_completed_lectures.push(complete_lec); // filter this lesson completed lectures
            });

            lectures.forEach(lecture=>{
                current_completed_lectures.forEach(curr_complt_lec=>{
                    if(lecture.id == curr_complt_lec.lecture_id ) completed_count +=1;
                });
            });
            is_lesson_complete = Object.keys(lectures).length == completed_count; // true or false
            return is_lesson_complete;
        },
        checkIfLectureUnpaid(lesson){
            var unpaid = false;
            this.completed_lectures.forEach(lec=>{                
                if(lec.payment_status == 'unpaid' && lec.lesson_id == lesson.id)  unpaid = true;
            });
            return unpaid;           
        },
        markLessonComplete(lesson){
            if(lesson.status == 'complete') {alert('Lesson already marked complete'); return;}
            if(! confirm('Mark this lesson complete? \n This record will be available in your completed lessons.')) return;
            if(! this.checkIfLectureUnpaid(lesson)) {alert("Failed, This lesson has pending unpaid lecture arreas."); return;}
            this.spinner.lesson_complete = true;
            axios.get('/api/lesson/mark-complete/' + lesson.id)
            .then(response=>{
                this.spinner={}
                this.success.lesson_complete = 'Success, Lesson marked complete';
                this.fetchLessons();
                setTimeout(() => {
                    this.errors={}
                    this.success={}
                }, 3000);
            })
            .catch(error=>{
                this.spinner={}
                this.errors.lesson_complete = 'Failed, something went wrong. Please try again.';
                console.log(error.response);
            })
        },
        rescheduleTrialLesson(trial_lesson){
            this.validateRescheduleTrailLesson();
            if(Object.keys(this.errors).length) return;
          
            var form_data = new FormData();
                form_data.append('lesson_date', this.trial_lesson_reschedule_date);
                form_data.append('start_time', this.trial_lesson_reschedule_time);
                
            if(!confirm('Reschedule this trial lesson?')) return;
            this.spinner.reschedule_trial_lesson = true;
            axios.post('/api/reschedule-trial-lesson/' + trial_lesson.id, form_data)
            .then(response=>{
                this.spinner ={}
                this.success.reschedule_trial_lesson = 'Success, Operation successful!'
                this.fetchTrialLessons();
                document.getElementById('reschedule').click();
                this.trial_lesson_reschedule_date = null;
                this.trial_lesson_reschedule_time = null;
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        scheduleZoomMeeting(trial_lesson){
            this.spinner.schedule_meeting = true;
            var form_data = new FormData();
            form_data.append('topic', trial_lesson.lesson_type);
            form_data.append('type', 2);
            form_data.append('start_time', trial_lesson.start_date);
            form_data.append('duration', '20');

            axios.get('/api/zoom/meeting/create', form_data)
            .then(response => {
                console.log(response.data.data);
                this.updateMeetingLink(trial_lesson.id, response.data.data.id, response.data.data.join_url);
                this.fetchTrialLessons();
                this.success.shedule_meeting = 'Success, meeting scheduled!' ;
            })
            .catch(error=>{             
                delete this.spinner.schedule_meeting;
                this.errors.shedule_meeting = 'Failed to schedule meeting!';              
                if(error.response.status == 500) this.refreshZoomAuthToken(); 
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
                }, 2500);
                
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
                this.completed_lectures = response.data.data.data[0].completed_lectures; // load completed lectures to local data
                this.current_lessons = response.data.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        validateRescheduleTrailLesson(){
            this.errors={}
            if(! this.trial_lesson_reschedule_date) this.errors.trial_lesson_reschedule_date = 'Date field is required!'; 
            if(! this.trial_lesson_reschedule_time) this.errors.trial_lesson_reschedule_time = 'Time field is required!'; 
        },
        shedulefetchRefresh(){
            setInterval(() => {
                this.fetchLessons();
            }, 5000);
            setInterval(() => {
                this.fetchTrialLessons();
            }, 30000);
        }
    },
    mounted(){
        this.fetchTrialLessons();
        this.fetchLessons();
        this.getZoomCredentials();
        this.fetchZoomAuthToken();
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
.border-line{
        border:1px solid rgb(231, 231, 231);
        width:100%;
    }
.border-line:hover{
    border:1px solid rgb(248, 186, 186);
}
/* media rules */
    @media only screen and (max-width: 950px){
        .px-5{
            padding-left:0 !important;
            padding-right:0 !important;
        }
    }
</style>