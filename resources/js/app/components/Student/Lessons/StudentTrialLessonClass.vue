<template>
<div class="parent">
   <h3> Trial class</h3>
  <p> 
    Meet with your tutor. As questions, guage his accent and see if you like them. <br>
    Then set up lessons and start learning.
  </p>
  <p> 
    <!-- <span> <button class="btn btn-secondary btn-small" @click="getZoomAuth()">Start video</button> </span>  -->
    <span> <a :href="'https://zoom.us/oauth/authorize?response_type=code&client_id=' + this.CLIENT_ID + '&redirect_uri=' + this.REDIRECT_URI" class="btn btn-secondary btn-small" >Link with zoom</a> </span> 
    <span> <button @click.prevent="scheduleMeeting()" class="btn btn-secondary">Schedule Zoom meeting</button> </span> 
    <span> <button @click.prevent="getMeetings()" class="btn btn-secondary">Get Zoom meetings</button> </span> 
    <span> <button @click.prevent="updateMeeting()" class="btn btn-secondary">Update Zoom meeting</button> </span> 
    <span> <button @click.prevent="deleteMeeting()" class="btn btn-secondary">Delete Zoom meeting</button> </span> 
</p>

<div class="p-3 border">
    <span class="fw-bold">Your meetings</span>
    <div v-for="(meeting, index) in this.zoom_meetings" :key="index">
       <span class="my-2" >Meeting topic: &nbsp; &nbsp; {{meeting.topic}}</span> 
       <span> <a :href="meeting.join_url" target="blank" class="btn btn-sm btn-secondary my-2">Launch meeting</a>
        &nbsp;  Host ID: &nbsp; {{meeting.host_id}}</span>  <br>
    </div>
    
</div>

  <div>
     <!-- <div>  <VideoChat /> </div>  -->
    </div> 
</div>
  
</template>

<script>
import { log } from '../../../../../../public/js/app';
import VideoChat from './VideoChat.vue';
export default {
components:{
    VideoChat,
},
data(){
    return{
        zoom_meetings:{},
        CLIENT_ID: null,
        ZOOM_CLIENT_SECRET: null,
        REDIRECT_URI: null
    }
},
methods:{
    getZoomCredentials(){ // from server
        axios.get('/api/zoom/get-credentials ')
        .then(response => {
            this.CLIENT_ID = response.data.data.client_id;
            this.ZOOM_CLIENT_SECRET = response.data.data.client_secret
            this.REDIRECT_URI = response.data.data.redirect_uri;
        })
        .catch(error=>{
            console.log(error.response);
        });
    },
    getZoomAuth(){
        axios.get('/zoom/auth/20 ')
        .then(response => {
            console.log(response);
        })
        .catch(error=>{
            console.log(error.response);
        });
    },
    scheduleMeeting(){
        axios.get('/api/zoom/meeting/create')
        .then(response => {
            console.log(response);
        })
        .catch(error=>{
            console.log(error.response);
        });
    },
    getMeetings(){
        axios.get('/api/zoom/meeting/get')
        .then(response => {
            this.zoom_meetings = response.data.data.meetings;
            console.log(response.data);
        })
        .catch(error=>{
            console.log(error.response);
        });
    },
    updateMeeting(){
        axios.get('/api/zoom/meeting/update/77403546155')
        .then(response => {
            console.log(response);
        })
        .catch(error=>{
            console.log(error.response);
        });
    },
    deleteMeeting(){
        axios.get('/api/zoom/meeting/delete/77403546155')
        .then(response => {
            console.log(response);
        })
        .catch(error=>{
            console.log(error.response);
        });
    }
},
mounted(){
    this.getZoomCredentials();
}

}
</script>

<style>
p span{
    margin:1rem 1em;
}
</style>