<template>
  <div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdropProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropProfileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg text-muted">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" @submit.prevent="this.submitForm()">
                     
                    <div class="mb-3">
                        
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" class="form-control py-2" id="first_name" v-model="form.first_name"> 
                        <small class="text-danger">{{this.errors.first_name}}</small>                       
                    </div>                   
                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text" class="form-control py-2" id="middle_name" v-model="form.middle_name" > 
                         <small class="text-danger">{{this.errors.middle_name}}</small>                    
                    </div>                   
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control py-2" id="last_name" v-model="form.last_name"> 
                        <small class="text-danger">{{this.errors.last_name}}</small>                        
                    </div>   
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control py-2" id="email" v-model="form.email" >  
                            <small class="text-danger">{{this.errors.email}}</small>                      
                        </div>                   
                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control py-2" id="phone" v-model="form.phone">                        
                        </div>
                    </div>                
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control py-2" id="country" v-model="form.country" >                        
                        </div>                   
                        <div class="mb-3 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control py-2" id="city" v-model="form.city">                        
                        </div> 
                    </div> 
                    <div class="mx-auto p-2">
                        <label for="exampleFormControlInputimage">Image*</label>
                        <div class="image-preview mx-auto p-0 m-0 text-center">
                            <img :src="form.img_preview" alt="" style="width:50px; height:50px">  <br>
                            <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="exampleFormControlInputimage"  @change="fileUpload">
                        </div>    
                        <small class="text-danger"> {{this.errors.image }} </small>              
                    </div>
                    <div class="modal-footer">
                        <small class="text-success">{{this.success.update}}</small> 
                        <small class="text-danger">{{this.errors.update}}</small> <br/>
                        <button type="button" class="btn btn-danger" id="close_profile" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"> <span class="spinner-border spinner-border-sm" v-if="this.form.spinner"></span> Update</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    data(){
        return{
            form:{
                full_name: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                email:  '',
                phone:'',
                country: '',
                city:   '',
                image:'',
                img_preview: '',
                spinner:false
            },
            errors:{},
            success:{} ,
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,           
        }
    },
    methods:{
 
        fileUpload(event){
            this.form.image = event.target.files[0]; 
            if(this.form.image.size > 2048 * 1024){
              this.errors.image = "Image too big. Select an image less than 2mb."; 
              return;
           } 
           if(this.form.image['type'] === 'image/jpeg' || this.form.image['type'] === 'image/jpg' || this.form.image['type'] === 'image/png' || this.form.image['type'] === 'image/gif' || this.form.image['type'] === 'image/svg'){
              this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
              delete this.errors.image
              return;
           } 
           else {
               this.errors.image = " Allowed types jpg/png/jpeg/gif";
               this.form.img_preview = '';
           }
        }, 
        submitForm(){
            var form_data = new FormData();
                form_data.append('first_name', this.form.first_name);
                form_data.append('middle_name', this.form.middle_name);
                form_data.append('last_name', this.form.last_name);
                form_data.append('email', this.form.email);
                form_data.append('phone', this.form.phone);
                form_data.append('country', this.form.country);
                form_data.append('city', this.form.city);
            if(this.form.image) form_data.append('image', this.form.image);
            form_data.append('_method', 'PUT');

            this.spinner = true;
            axios.post('/api/user/' + this.$store.state.user.user.id, form_data)
            .then( response => {
            if( response.status == 200){
                this.spinner= false;
                this.success.update = "Success, details updated.";
                setTimeout(() => {
                    document.getElementById('close_profile').click();
                }, 3000);
            }
            })
            .catch( error => {
                this.spinner= false;
               this.errors.update = "Failed, details not updated!.";
                console.log(error.response);                    
            });
        },
        populateFields(){
            setTimeout(() => {
                this.form.first_name =  this.$store.state.user.user.first_name;
                this.form.middle_name =  this.$store.state.user.user.middle_name;
                this.form.last_name =  this.$store.state.user.user.last_name;
                this.form.email =   this.$store.state.user.user.email;
                this.form.phone = this.$store.state.user.user.phone;
                this.form.country =  this.$store.state.user.user.country;
                this.form.city =    this.$store.state.user.user.city;
                this.form.image = '';
                this.form.img_preview =  this.$store.state.user.user.image;                
            },5000);
        },
        validateForm(){
            this.errors={};
            if(!this.form.first_name) this.errors.first_name= "First name is required";
            if(!this.form.last_name) this.errors.last_name= "Last name is required";
            if(!this.form.email) this.errors.email = "Email is required";
            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email' ;
        }
    },
      computed:{ 
        ...mapGetters(['isLogedIn', 'getUser']), 
        
  },
  mounted(){
      this.populateFields();
  }

}
</script>

<style>

</style>