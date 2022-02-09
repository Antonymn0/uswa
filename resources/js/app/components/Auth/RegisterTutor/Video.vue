<template>
  <div>
      <h4>Video introduction</h4>
      <h5>Record your video</h5>
      <p>Now introduce yourself to students! You can watch and re-record your intro before you submit it.</p>
      <div class="row">
            <div class="col-md-6">
                <div>                   
                    <span > 
                        <iframe width="320" height="240" class="bg-secondary" :src="video_preview" >  </iframe>
                     </span>
                    <br>
                    <span class="mt-3">
                        <label for="videolink" class="btn btn-secondary">Select video </label>
                        <input type="file" hidden  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="videolink"    @change="this.fileUpload($event)">
                        
                    </span>                    
                </div>
                 
                <p class="pt-5"> 
                    <label for="link" class="form-label">Or Paste a link to Your video </label>
                   <span> <input type="text" class="w-auto p-2 border rounded" id="link" placeholder="https://website.com/video" @input.prevent="this.videoLink($event)" v-model="video_link"> </span>
                    <span class="ml-2"> <i class="bi bi-x px-1 alert-danger rounded-circle" style="font-size:1.2rem; cursor:pointer;" @click.prevent="video_link = null"></i></span> 
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
            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Next</button>
        </div>
  </div>
</template>

<script>
export default {
    data(){
        return{            
            video_preview:null, 
            video_link:null,                      
        }
    },
    methods:{
        fileUpload(event){
            this.video_preview = URL.createObjectURL(event.currentTarget.files[0]); 
        },
        videoLink(event){
            this.video_preview = this.video_link;
        },
        nextStep(){
            document.getElementById('video').classList.add('hidden');
            document.getElementById('availability').classList.remove('hidden');
        },
        backStep(){
            document.getElementById('video').classList.add('hidden');
            document.getElementById('education').classList.remove('hidden');
        },
    
    }
}
</script>

<style>

</style>