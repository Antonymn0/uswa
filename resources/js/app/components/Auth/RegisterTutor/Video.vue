<template>
  <div>
      <form action="#" method="POST" enctype="multipart/form-data" @submit.prevent="this.submitForm()">
      <h4 class="py-4">Video introduction</h4>
      <h5>Upload a video</h5>
      <p>Introduce yourself to students! Upload a short introduction video about yourself and what you do.</p>
      <div class="row">
            <div class="col-md-6">
                <div>                   
                    <p class="shadow" style="overflow:hidden"> 
                       <span class="w-100" style="position:absolute" v-if="!this.video_preview"> <small class="" style="position:absolute;top:6rem; left:1.2rem; ">Select a video or paste a link  below.</small></span> 
                        <iframe width="400" height="300"  :src="this.video_preview" autoplay="false" class="shadow bg-secondary " >  </iframe>
                        
                     </p>
                     <small class="text-danger">{{this.errors.video}}</small>
                    <br>
                    <p class="mt-3">
                        <label for="videolink" class="btn btn-secondary">Select video </label> <small class="text-muted">Max: 50mb</small>
                        <input type="file" hidden  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="videolink" accept=".mp4"   @change="this.fileUpload($event)">
                    </p>                    
                </div>
                 
                <p class="pt-5"> 
                    <label for="link" class="form-label fw-bold">Or Paste a link to Your video </label>
                   <span> <input type="text" class="w-auto p-2 border rounded" id="link" placeholder="https://website.com/video" @input.prevent="this.videoLink($event)" v-model="video_url"> </span>
                    <span class="ml-2"> <i class="bi bi-x px-1 alert-danger rounded-circle" style="font-size:1.2rem; cursor:pointer;" @click.prevent="clearUrl()"></i></span> 
                    <br> <small class="text-muted">Tip: Copy Youtube links from the share button</small>
                </p>
          </div>
          <div class="col-md-6"> 
              <h5>Tips for a great video</h5>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Keep your video less than 2 minutes long</span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Record in a horizontal mode</span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Position the camera at eye level</span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Use neutral lighting and background</span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Your face and eyes are fully visible </span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> No logos, links or contact details </span> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> No slideshows or presentations </span> <br> <br>
              <span class="p-2"> <i class="bi bi-check-circle"></i> Greet your students warmly </span> <br> 
              <span class="p-2"> <i class="bi bi-check-circle"></i> Highlight any teaching certification </span> <br> 
              <span class="p-2"> <i class="bi bi-check-circle"></i> Present your tutoring experience </span> <br> 
              <span class="p-2"> <i class="bi bi-check-circle"></i> Invite students to book a trial lesson </span> <br> 
          </div>
      </div>
       <div class="text-center pt-3 mt-3 pb-2 border-top">
           <small class="text-primary small">{{this.uploading_video}} <br> </small> 
            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-danger m-1" >  <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.submit_video"></span> Next</button>
        </div>
        </form>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    data(){
        return{            
           errors:{} , 
           spinner:{}   ,
           uploading_video:null, 
                 
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),
        video_preview:{
            get() { return this.$store.state.signupProcess_video.video.video_preview; },
            set(value) { this.$store.commit('set_video_preview', value); }
        },
        video:{
            get() { return this.$store.state.signupProcess_video.video.video; },
            set(value) { this.$store.commit('set_video', value); }
        },
        video_url:{
            get() { return this.$store.state.signupProcess_video.video.video_url; },
            set(value) { this.$store.commit('set_video_url', value); }
        },
    },
    methods:{
        fileUpload(event){  
            this.errors={}
            if(Math.round(event.currentTarget.files[0]/1024/1024) > 50){ // should be less than 50mb
              this.errors.video = "File too big: Select an image less than 50mb."; 
              this.video = null;
              this.video_preview = null;
              return;
            } 
            if(event.currentTarget.files[0]['type'] === 'video/mp4'  ){
                this.video_preview = URL.createObjectURL(event.currentTarget.files[0]); 
                this.video = event.target.files[0];                
                return;
            } 
            else {
                this.errors.video = "Error:  Allowed file type mp4";
                this.video_preview = null;
                this.video = null;
            }
        },
        submitForm(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            
            var form_data = new FormData();
                form_data.append('first_name', this.$store.state.signupProcess_about.about.first_name);
                form_data.append('last_name', this.$store.state.signupProcess_about.about.last_name);
                if(this.video_preview !== this.getUser.introduction_video){
                    if(this.$store.state.signupProcess_video.video.video) form_data.append('introduction_video', this.$store.state.signupProcess_video.video.video);   
                }
               
                if(this.video_url)  form_data.append('introduction_video_url', this.$store.state.signupProcess_video.video.video_url); 
              
               form_data.append('_method', 'PUT');

            this.spinner.submit_video = true;

            this.uploading_video = `Uploading your video. This may take a while. \n Please wait....`;
            axios.post('/api/user/' + this.getUser.id , form_data,  { headers: {   'Content-Type': 'multipart/form-data'  } })             
            .then(response=>{
                var user = this.getUser;
                user.introduction_video = this.video_preview;
                this.$store.commit('setUser', user);

                this.uploading_video = null;
                this.spinner = {}
               this.nextStep();
            })
            .catch(error=>{  
                this.uploading_video = null;
                this.spinner = {}             
                console.log(error.response);
            })
        },
        videoLink(event){
            this.errors={};
            // sanitize youtube link
            if(this.video_url.includes('https://youtu.be/')){
                this.video_url = this.video_url.replace('https://youtu.be/', 'https://youtube.com/embed/');
            }
            this.video_preview = this.video_url;
            this.video=null;
        },
        nextStep(){
            document.getElementById('video').classList.add('hidden');
            document.getElementById('availability').classList.remove('hidden');
            
        },
        backStep(){
            document.getElementById('video').classList.add('hidden');
            document.getElementById('education').classList.remove('hidden');
            
        },
        
        clearUrl(){
            this.video = null;
            this.video_url = null;
            this.video_preview = null;
        },
        
        validateForm(){
            this.errors={};            
            if(!this.video && !this.video_url && !this.video_preview) this.errors.video = "Please select a video or paste a link in the box below.";
        },
        populateFormFields(){ 
            this.video_url = this.getUser.introduction_video_url; 
            setInterval(() => {                                
                if(document.getElementById('video').classList.contains('hidden')) this.video_preview = null;
                if(this.video_preview) return; 
                if(! document.getElementById('video').classList.contains('hidden')) this.video_preview = this.getUser.introduction_video;
            }, 2000);           
                      
        }
    },
    mounted(){
        this.populateFormFields();
        }  
    
}
</script>

<style>

</style>