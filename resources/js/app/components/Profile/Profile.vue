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
                        <input type="text" class="form-control py-2" id="first_name" > 
                        <small class="text-danger">{{this.errors.first_name}}</small>                       
                    </div>                   
                    <div class="mb-3">
                        <label for="middle_name" class="form-label">Middle name</label>
                        <input type="text" class="form-control py-2" id="middle_name" > 
                         <small class="text-danger">{{this.errors.middle_name}}</small>                    
                    </div>                   
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" class="form-control py-2" id="last_name" > 
                        <small class="text-danger">{{this.errors.last_name}}</small>                        
                    </div>   
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control py-2" id="email" >  
                            <small class="text-danger">{{this.errors.email}}</small>                      
                        </div>                   
                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control py-2" id="phone" >                        
                        </div>
                    </div>                
                    
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control py-2" id="country" >                        
                        </div>                   
                        <div class="mb-3 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control py-2" id="city" >                        
                        </div> 
                    </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                full_name:'',
                first_name:'',
                last_name:'',
                email:'',
                phone:'',
                country:'',
                city:''
            },
            errors:{},
            success:{} ,
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,           
        }
    },
    methods:{
        submitForm(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            var form_data = new FormData();
            form_data.append('first_name', this.form.first_name);
            form_data.append('middle_name', this.form.middle_name);
            form_data.append('email', this.form.email);
            form_data.append('phone', this.form.phone);
            form_data.append('country', this.form.country);
            form_data.append('city', this.form.city);
        },
        validateForm(){
            this.errors={};
            if(!this.form.first_name) this.errors.first_name= "First name is required";
            if(!this.form.last_name) this.errors.last_name= "Last name is required";
            if(!this.form.email) this.errors.email = "Email is required";
            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email' ;
        }
    }

}
</script>

<style>

</style>