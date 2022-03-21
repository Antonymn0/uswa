<template>
    <div class="py-5">
        <h3 class="py-2">Finish setup</h3>
        <p> 
            Thankyou for going through the signup process. <br>
            At USWA, we take great pride in our tutors and hence the rigorous process. <br>
            The information you share with us is safe and we do not share it with third parties. <br>
            Please click the finish button to save the changes. <br>
            Or you can go back and review before submiting. <br>           
        </p>
        <div class="text-center pt-5 pb-2">
            <small class="text-success py-3">{{this.success.signup}}</small> <br>
            <small class="text-danger py-3">{{this.errors.signup}}</small> <br>
            <small class="text-danger py-3">{{this.errors.validation_errors}}</small> <br>

            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-secondary m-1" @click.prevent="this.cancelSignup()">Cancel</button>
            <button class="btn btn-danger m-1" @click.prevent="completeSignup()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner"></span> Finish</button>
        </div>
    </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    data(){
        return{
            spinner:false,
            errors:{},
            success:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser']),    
    },
    methods:{
        backStep(){
            document.getElementById('finish').classList.add('hidden');
            document.getElementById('availability').classList.remove('hidden');
        },
       
        cancelSignup(){
            if(! confirm('Are you sure you want to cancel the signup process? \n All the changes you have made will be lost.')) return;         
            this.$router.push({name:'home'});
        },
        completeSignup(){
            this.errors ={};
            this.success ={};
            console.log(this.$store.state.signupProcess_video.video.video);
            var form_data = new FormData();
                form_data.append('first_name', this.$store.state.signupProcess_about.about.first_name);
                form_data.append('last_name', this.$store.state.signupProcess_about.about.last_name);

                form_data.append('registration', 'submited');
                form_data.append('_method', 'PUT');
                
                this.spinner = true;
            axios.post('/api/user/' + this.getUser.id , form_data, {
            headers:{
                'accept':'application/json'
            }
            })
            .then(response=>{
                console.log(response.data)
                if(response.status == 200){   
                    this.spinner=false;  
                    this.success.signup = "Congratulations!. Your data has been submitted and is being reviewed. \n You will be redirected to dashboard shortly." ;
                    setTimeout(() => {this.$router.push({name: 'tutor-dashboard'})}, 3500); //redirect to home page                   
                }
                this.spinner=false; 
            })
            .catch(error=>{
                this.spinner=false; 
                if(error.response.status == 422){
                    this.errors.signup = `Something is wrong with the data provided. \n Please go back and fix the following errors.`;
                    this.errors.validation_errors =  error.response.data.errors;
                    this.errors.email = error.response.data.errors;
                    return;
                }
                console.log(error.response);
            })

        }
    }
}
</script>

<style>

</style>