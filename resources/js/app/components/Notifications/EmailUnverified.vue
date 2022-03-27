<template>
  <div>
    <div class="bg-secondary text-white py-2 px-3 border-bottom " v-if="! email_verified">
        <span>{{this.user.first_name }}, You have not yet verified your email address. Please click this button to:
            <button class="btn btn-secondary px-4 rounded " style="background-color:#394e4e;" @click.prevent="sendEmailverificationLink()">Verify</button>
        </span> <br>        
        <small class="text-white" v-if="this.show_message">  We have sent a verification link to '{{email}}' . Please check your email inbox to verify.</small>
    </div>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";
export default {
    data(){
        return{
            show_message:false,
            email: null,
            user: null,
            email_verified : true,
        }
    },
    methods:{
        sendEmailverificationLink(){
            this.email = this.getUser.email;
            var form_data = new FormData();
            form_data.append('email', this.email);
            axios.post('api/send-email-verification-link', form_data)
            .then(response=>{
                if(response.status == 200){
                  this.show_message = true;
                  console.log(response);  
                }                
            })
            .catch(error=>{
                this.show_message = false;
                console.log(error.response);
            })
        },
        is_emailVerified(){
            setTimeout(() => {
                if(! this.getUser.email) return;
                console.log('Setting user...');
                this.user = this.getUser;
                if(this.user.email_verified_at) return;
                else this.email_verified = false
            }, 5000);            
        }
    },
    computed:{
        ...mapGetters([ 'getUser']),       
    },
    mounted(){
       this.is_emailVerified(); 
    }
}
</script>

<style>

</style>