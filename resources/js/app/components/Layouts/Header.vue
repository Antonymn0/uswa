<template>
<div> 
<VerifyEmail />

<TutorSignupProcessNotification />

</div>
<div class="border-bottom"> 
  <div class="parent-header d-flex justify-content-between align-items-center  border-bottom px-3">
    <div class="d-flex justify-content-start align-items-center">
      <div class="d-flex py-4 "> 
        <span> <router-link :to="{name: 'home'}"><img src="http://127.0.0.1:8000/images/logo.svg" alt="uswa-logo" style="width:150px; ">  </router-link>  </span>  
      </div>
      <div class="pl-3 desktop " >
         <ul class="list-unstyled d-flex  ">
         <router-link :to="{name: 'find-tutor'}" class="px-3" v-if="getUser.role !== 'tutor' ">Find a tutor</router-link>          
         <router-link :to="{name: 'register-tutor'}" class="px-3"  v-if="getUser.role !== 'tutor' && getUser.role !== 'student' ">Become a tutor</router-link>          
          <router-link :to="{name: 'home'}" class="px-1" >Home</router-link>
        </ul>
      </div>  
      
    </div>
    <!-- ---------------------- -->
    <div class="mobile pl-3 text-center">
      <span class="pl-3"> 
        <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
        <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            &nbsp;  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.1rem"></i>  &nbsp;
            {{getUser.first_name}}
        </a> 
        </span>
    </div>
    <!-- -------------------------- -->
    <div class="d-flex align-items-center"> 
       <div v-if=" isLogedIn">
        <span class="desktop">Balance: 0hrs &nbsp; </span>
        <span><button class="btn btn-secondary">Buy hours</button> &nbsp;</span>
        <span class="mobile">Bal: 0hrs  </span>
      </div>
        <div class="px-2 desktop" v-if=" isLogedIn">
          <router-link :to="{name: 'student-dashboard'}" v-if="getUser.role == 'student'">Dashboard</router-link> &nbsp;
          <router-link :to="{name: 'tutor-dashboard'}" v-if="getUser.role == 'tutor'">Dashboard</router-link>
        </div>
        <div class="p-4 border-right desktop">
        en | USD
        </div>
        <div class="d-flex" v-if="isLogedIn">
          <span class="" v-if="getUser.role == 'student' "> <StudentMessages /></span>
          <span class="" v-if="getUser.role == 'tutor' "> <TutorMessages /></span>
          <span class=""> <Notifications /></span>
        </div>
        <div class="px-3 desktop">
            <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
            <router-link :to="{name: 'register'}" class="px-1" v-if="! isLogedIn">Register</router-link>            

            <div class="dropdown mx-2">   
              <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              {{getUser.first_name}} &nbsp;  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">  
                  <li  v-if=" isLogedIn">
                    <a href="#" class="dropdown-item">
                      <router-link :to="{name: 'student-dashboard'}" v-if="getUser.role == 'student'">Dasboard</router-link> &nbsp;
                      <router-link :to="{name: 'tutor-dashboard'}" v-if="getUser.role == 'tutor'">Dashboard</router-link>
                    </a> 
                  </li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropProfile">Profile</a></li>
                  <li><a class="dropdown-item" href="#"><Logout /></a></li>
              </ul>
            </div>        
        </div>
        <MobileNav /> 
        </div>
  </div>
 <!-- --------------------------------------------------- -->
    <!-- <span class=" py-2 mobile  badge-success  text-default fw-bold">    
      <router-link :to="{name: 'find-tutor'}" class="px-3"  v-if="getUser.role !== 'tutor'">Find a tutor</router-link>          
      <router-link :to="{name: 'register-tutor'}" class="px-3" v-if="getUser.role !== 'tutor'">Become a tutor</router-link>   
    </span>   -->
  </div>

 

    <router-view></router-view>

  <div class="clearfix"></div>
  <div class="w-100  ">
      <Profile />
      

     <Footer /> 
  </div>
  
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

import MobileNav from "../Navigation/MobileNav.vue";
import Logout from "../Auth/Logout.vue";
import Footer from "./Footer.vue";
import Profile from "../Profile/Profile.vue";
import StudentMessages from "../Chats/StudentMessages.vue";
import TutorMessages from "../Chats/TutorMessages.vue";
import Notifications from "../UserNotifications/Notifications.vue";
import VerifyEmail from "../Notifications/EmailUnverified.vue";
import TutorSignupProcessNotification from "../Notifications/TutorSignupProcessNotification.vue";
export default {
  components:{
    MobileNav,
    Footer,
    Logout,
    Profile,
    StudentMessages,
    TutorMessages,
    Notifications,
    VerifyEmail,
    TutorSignupProcessNotification
  },
  data(){
    return{
     user: this.getUser,
    }
  },
  methods:{
    showHomePage(){ 
      this.$router.push({name: 'home'});
      // setTimeout(() => {
      //     if(window.zoom_success){ // handle zoom redirection if exists
      //       if(this.user.role == 'student') this.$router.push({name: 'student-trial-lesson'});
      //       if(this.user.role == 'tutor') this.$router.push({name: 'tutor-trial-lesson'});
      //     } else this.$router.push({name: 'home'});        
      //   }, 200);       
    }
  },
  computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },
mounted(){     
    this.showHomePage();
    }
}
</script>

<style scoped>
.mobile{
  display:none;
}
@media screen and (max-width: 750px){
      .mobile{
        display: inline-block;
      }
      .desktop{
        display:none;
      }
}
  

</style>