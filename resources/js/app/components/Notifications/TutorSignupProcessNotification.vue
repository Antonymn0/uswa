<template>
  <div >    
    <div v-if="this.show_message && this.getUser.first_name" class="bg-secondary text-white py-2 px-3 border-bottom position-fixed w-100 top-0" >
        <span> {{getUser.first_name}}, Your account registration is pending. Please complete the tutor signup process to start geting bids from students. <br>
            Click this button to complete the process.
            <button class="btn btn-secondary px-4 rounded " style="background-color:#394e4e;" @click.prevent="this.$router.push({name: 'register-tutor-signup'})">Complete signup</button>
        </span> 
    </div>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";
export default {
    data(){
        return{
            show_message:false,            
        }
    },
    methods:{       
        is_account_registration_complete(){
            this.show_message = false;
            setTimeout(() => {                                              
                if(this.getUser.registration == 'complete') return;
                if(this.getUser.role !== 'tutor') return;
                else this.show_message = true
            }, 5000);            
        }
    },
    computed:{
        ...mapGetters([ 'getUser']),       
    },
    mounted(){
       this.is_account_registration_complete(); 
    }
}
</script>

<style>

</style>