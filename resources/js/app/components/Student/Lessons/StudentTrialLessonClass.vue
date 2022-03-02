<template>
<div class="parent">
   <h3> Trial class</h3>
  <p> 
    Meet with your tutor. As questions, guage his accent and see if you like them. <br>
    Then set up lessons and start learning.
  </p>
    <p class="mb-0" v-if="this.errors.token_expired"> <small class="alert-danger p-2 rounded">{{this.errors.token_expired}}</small></p>
    <div> 
        <small class="text-success text-center">{{success.scheduleMeeting}} <br> </small>
        <a  :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&state=' + this.ZOOM_STATE + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-small m-2" >Link with zoom</a>  
        <span v-if="this.zoom_user_auth_token"> 
            <button @click.prevent="getMeetings()" class="btn btn-secondary m-2">  <span class="spinner-border spinner-border-sm" v-if="this.spinner.get_meetings" role="status" aria-hidden="true" ></span>Meetings</button> 
            <button class="btn btn-secondary m-2" type="button"  @click.prevent="scheduleMeeting()">
                <span class="spinner-border spinner-border-sm" v-if="this.spinner.schedule_meeting" role="status" aria-hidden="true" ></span>
                Schedule meeting
            </button>        
        </span>
    </div>

        <!-- <button class="btn btn-primary" @click.prevent="refreshZoomAuthToken()">Refresh token</button> -->

    <div class="p-3 border">
        <span class="fw-bold">Your scheduled meetings</span>
        <small class="text-success text-center mx-2 float-end" v-if="this.success.delete_meeting">{{success.delete_meeting}}  </small> 
        <div v-if="Object.keys(this.zoom_meetings).length">
               
        <div v-for="(meeting, index) in this.zoom_meetings" :key="index" class="card p-2 mt-2 rounded shadow">
            <span class="my-2 fw-bold" >{{meeting.topic}}</span> 
            <p class="mb-0">Meeting ID: {{meeting.id}}</p>
            <p class="mb-0"> Start time: {{meeting.start_time}}</p>
            <p class="mb-0"> Duration: {{meeting.duration}} mins</p>
            <span> <a :href="meeting.join_url" target="blank" class="btn btn-sm btn-secondary m-2">Launch </a>
            <button @click.prevent="updateMeeting()" class="btn btn-secondary btn-sm m-2">  <span class="spinner-border spinner-border-sm" v-if="this.spinner.update_meeting" role="status" aria-hidden="true" ></span> Reschedule</button>  
            <button @click.prevent="deleteMeeting(meeting.id)" class="btn btn-secondary btn-sm m-2">  <span class="spinner-border spinner-border-sm" v-if="this.spinner.delete_meeting" role="status" aria-hidden="true" ></span>Delete </button> 
           </span>  
        </div>
        </div> 
        <div class="py-5" v-else>
            <small class="text-muted text-center p-5 my-5">No meetings currently scheduled</small>
        </div>
    </div>

  <div>
    
    </div> 
</div>
  
</template>

<script>
import { log } from '../../../../../../public/js/app';

export default {
components:{
   //
},
data(){
    return{
        zoom_meetings:{},
        CLIENT_ID: null,
        ZOOM_CLIENT_SECRET: null,
        REDIRECT_URI: null,
        success:{},
        errors:{},
        zoom_user_auth_token: null ,
        spinner:{},  
        ZOOM_STATE: this.$store.state.user.user.id,         
    }
},
methods:{
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

    scheduleMeeting(){
        this.spinner.schedule_meeting = true;
        var form_data = new FormData();
        form_data.append('topic', 'English trial lesson');
        form_data.append('type', 2);
        form_data.append('start_time', '2022-03-05T20:30:00');
        form_data.append('duration', '40');

        axios.get('/api/zoom/meeting/create', form_data)
        .then(response => {
            this.success.scheduleMeeting = 'Success, meeting scheduled!'
            delete this.spinner.schedule_meeting 
            console.log(response);
        })
        .catch(error=>{
          this.refreshZoomAuthToken();            
            delete this.spinner.schedule_meeting
            console.log(error.response);
        });
    },
    getMeetings(){
        this.spinner.get_meetings = true;
        axios.get('/api/zoom/meeting/get')
        .then(response => {
            this.zoom_meetings = response.data.data.meetings;
           delete this.spinner.get_meetings ;
            console.log(response.data);
        })
        .catch(error=>{
            if(error.status == 500) this.refreshZoomAuthToken(); 
            delete this.spinner.get_meetings ;
            console.log(error.response);
        });
    },
    updateMeeting(){
        this.spinner.update_meeting = true;
        axios.get('/api/zoom/meeting/update/77403546155')
        .then(response => {
            console.log(response);
            delete this.spinner.update_meeting;
        })
        .catch(error=>{
            if(error.status == 500) this.refreshZoomAuthToken(); 
            console.log(error.response);
            delete this.spinner.update_meeting;
        });
    },
    deleteMeeting(id){
        this.spinner.delete_meeting = true;
        axios.get('/api/zoom/meeting/delete/' + id)
        .then(response => {
            delete this.spinner.delete_meeting;
            this.success.delete_meeting =  'Success, meeting delete.';
            console.log(response);
            this.getMeetings();
            setInterval(() => {
                this.success={}
            }, 3500);
        })
        .catch(error=>{
            if(error.status == 500) this.refreshZoomAuthToken(); 
            console.log('Fail');
             delete this.spinner.delete_meeting;
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

},
mounted(){
    this.getZoomCredentials();
    this.fetchZoomAuthToken();
    
}

}
</script>

<style>
p span{
    margin:1rem 1em;
}
</style>