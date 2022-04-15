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
                    <h5 class="px-2">Tips for taking a good photo</h5>
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
                <button class="btn btn-danger m-1" @click.prevent="this.submitForm()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.submit_photo"></span> Next</button>
            </div>           
            </div>
        </div>         
    </div>
</template>

<script>
import {mapGetters } from "vuex";
export default {
    data(){
        return{
            errors:{},
            success:{},
            spinner:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),
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
        submitForm(){
            if(this.img_preview == this.getUser.image) {this.nextStep(); retun;};

            this.validateForm();
            if(Object.keys(this.errors).length) return;

            this.spinner.submit_photo = true;
            var form_data = new FormData();
                form_data.append('first_name', this.$store.state.signupProcess_about.about.first_name);
                form_data.append('last_name', this.$store.state.signupProcess_about.about.last_name);
                form_data.append('image', this.$store.state.signupProcess_profilePhoto.profilePhoto.image);               
                form_data.append('_method', 'PUT');

            axios.post('/api/user/' + this.getUser.id , form_data)             
            .then(response=>{
                this.spinner = {}
               this.nextStep();
            })
            .catch(error=>{   
                this.spinner = {}             
                console.log(error.response);
            })
        },
        nextStep(){
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
        },
        populateFormFields(){
            this.$store.commit('set_profile_img_preview', this.getUser.image);            
        },
       
    },
    mounted(){
        this.populateFormFields();
    }
}
</script>

<style>
    
</style>