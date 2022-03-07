<template>
    <div class="py-5">
        <h3 class="py-2">Finish setup</h3>
        <p> 
            Thankyou for going through the signup process. <br>
            At USWA, we take great pride in our tutors and hence the rigorous process. <br>
            The information you share with us is safe and we do not share it with third parties. <br>
            Please click the finish button to save the changes. <br>
            You can go back and review before submiting. <br>           
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
                form_data.append('middle_name', this.$store.state.signupProcess_about.about.middle_name);
                form_data.append('last_name', this.$store.state.signupProcess_about.about.last_name);
                form_data.append('country', this.$store.state.signupProcess_about.about.country);
                form_data.append('city', this.$store.state.signupProcess_about.about.city);
                form_data.append('currency', this.$store.state.signupProcess_about.about.currency);
                form_data.append('language', this.$store.state.signupProcess_about.about.language);
                form_data.append('level', this.$store.state.signupProcess_about.about.level);
                form_data.append('subject', this.$store.state.signupProcess_about.about.subject);
                // form_data.append('phone', this.$store.state.signupProcess_about.about.phone);
                form_data.append('over18', this.$store.state.signupProcess_about.about.over18);
                form_data.append('description', this.$store.state.signupProcess_about.about.description);

                form_data.append('image', this.$store.state.signupProcess_profilePhoto.profilePhoto.image);

                form_data.append('has_teaching_certificate', this.$store.state.signupProcess_certification.certification.i_dont_have_certificate);
                form_data.append('teaching_certificate_upload', this.$store.state.signupProcess_certification.certification.image);
                form_data.append('teaching_certificate_subject', this.$store.state.signupProcess_certification.certification.subject);
                form_data.append('teaching_certificate_year_of_study_from', this.$store.state.signupProcess_certification.certification.study_from);
                form_data.append('teaching_certificate_year_of_study_to', this.$store.state.signupProcess_certification.certification.study_to);
                form_data.append('teaching_certificate_description', this.$store.state.signupProcess_certification.certification.description);
                form_data.append('teaching_certificate_issued_by', this.$store.state.signupProcess_certification.certification.issued_by);
                
                //education
                form_data.append('has_higher_education', this.$store.state.signupProcess_education.education.i_dont_have_certificate);
                form_data.append('higher_education_level', this.$store.state.signupProcess_education.education.level);
                form_data.append('higher_education_type', this.$store.state.signupProcess_education.education.type);
                form_data.append('higher_education_specialty', this.$store.state.signupProcess_education.education.specialty);
                form_data.append('higher_education_certificate_upload', this.$store.state.signupProcess_education.education.image);
                form_data.append('higher_education_institution', this.$store.state.signupProcess_education.education.institution);

                if(this.$store.state.signupProcess_video.video.video) form_data.append('introduction_video', this.$store.state.signupProcess_video.video.video);
                if(this.$store.state.signupProcess_video.video.video_url) form_data.append('introduction_video_url', this.$store.state.signupProcess_video.video.video_url);

                // availability
                form_data.append('timezone', this.$store.state.signupProcess_availability.availability.timezone);
                form_data.append('monday', JSON.stringify(this.$store.state.signupProcess_availability.availability.monday));
                form_data.append('tuesday', JSON.stringify(this.$store.state.signupProcess_availability.availability.tuesday));
                form_data.append('wednesday', JSON.stringify(this.$store.state.signupProcess_availability.availability.wednesday));
                form_data.append('thursday', JSON.stringify(this.$store.state.signupProcess_availability.availability.thursday));
                form_data.append('friday', JSON.stringify(this.$store.state.signupProcess_availability.availability.friday));
                form_data.append('saturday', JSON.stringify(this.$store.state.signupProcess_availability.availability.saturday));
                form_data.append('sunday', JSON.stringify(this.$store.state.signupProcess_availability.availability.sunday));
                form_data.append('registration', 'reviewing');
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
                    setTimeout(() => {this.$router.push({name: 'tutor-dashboard'})}, 3000); //redirect to home page                   
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