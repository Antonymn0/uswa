<template>
    <div class="bg-white ">
        <h4 class="py-3">Profile photo</h4>
         <h5>Make a great first impression</h5>
         <p>Tutors who look friendly and professional get the most students </p>
        <div class="">        
            <div class=" ">
                <label for="imageInput" class="btn btn-secondary"> Select photo</label> <small> Max:2mb </small> | <small>Format: jpg,png,jpeg </small>  
                <input type="file" hidden  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="imageInput"    @change="this.fileUpload($event)">
            </div>

            <div class=" row  mt-3 ">                  
                <div class="col-md-6  border-end d-flex align-items-center justify-content-center shadow">
                    <span style="position:relative" v-if="this.img_preview"> <i class="bi bi-x-circle text-danger shadow rounded-circle pb-0" @click="removeImage()" style="font-size:1.5rem; position:absolute; left:14rem; top:-6rem; cursor:pointer"></i></span> 
                    
                    <img :src="img_preview" alt="" class="shadow  rounded-circle " style="width:200px; height:190px" v-if="img_preview"> 
                    <small class="text-default" v-if="!this.img_preview && !this.errors.image">Please select an image</small>
                    <br> <small class="text-danger small">{{this.errors.image}}</small>
                </div>  
                <div class="col-md-6 ">
                    <h5 class="p-2">Tips for taking a good photo</h5>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Smile and look at the camera</span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Frame your head and shoulders </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Your photo is centered and upright </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Use neutral lighting and background </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Your face and eyes are fully visible </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Avoid logos or contact information</span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> You are the only person in the photo</span> <br>
                </div>   
            <div class="text-center pt-5 pb-2">
                <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
                <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Next</button>
            </div>           
            </div>
        </div>         
    </div>
</template>

<script>
export default {
    data(){
        return{
            errors:{},
            success:{}
        }
    },
    computed:{
        img_preview:{
            get() { return this.$store.state.signupProcess_profilePhoto.profilePhoto.img_preview; },
            set(value) { this.$store.commit('set_profile_img_preview', value); }
        },
        image:{
            get() { return this.$store.state.signupProcess_profilePhoto.profilePhoto.image; },
            set(value) { this.$store.commit('set_profile_image', value); }
        },
    },

    methods:{
        fileUpload(event){             
            this.image = event.target.files[0];            
            if(this.image.size > 2048 * 1024){
              this.errors.image = "Image too big: Select an image less than 2mb."; 
              this.image = null;
              return;
           } 
           if(this.image['type'] === 'image/jpeg' || this.image['type'] === 'image/jpg' || this.image['type'] === 'image/png' || this.image['type'] === 'image/svg' || this.image['type'] === 'image/gif'){
              this.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
              delete this.errors.image
              return;
           } 
           else {
               this.errors.image = "Error:  Allowed types jpg/png/jpeg/gif";
               this.img_preview = null;
               this.image = null;
           }
        },
        removeImage(){
            this.img_preview = null;
            this.image = null;
        },
        nextStep(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('photo').classList.add('hidden');
            document.getElementById('certification').classList.remove('hidden');
        },
        backStep(){
            document.getElementById('photo').classList.add('hidden');
            document.getElementById('about').classList.remove('hidden');
        },
        validateForm(){
            this.errors = {};
            if(!this.image) this.errors.image = 'Image is required';
        }
    }
}
</script>

<style>
    
</style>