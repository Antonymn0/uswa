<template>
<!-- ------------------ User dashboard--------------------------  -->
<div> 
<div> 
<VerifyEmail />
<TutorSignupProcessNotification />
</div>
<div class="border-bottom"> 
  <div class="parent-header d-flex justify-content-between align-items-center  border-bottom px-3">
    <div class="d-flex justify-content-start align-items-center">
      <div class="d-flex py-4 ps-3 log desktop"> 
        <span v-if="getUser.role == 'admin'"> <router-link :to="{name: 'all-users'}">
          <img src="/images/logo.svg" alt="uswa-logo" class="desktop" style="width:150px; "> 
          <img src="/images/email_logo.png" alt="uswa-logo" class="mobile" style="width:150px; "> 
          </router-link>  </span>  
        <span v-else> <router-link :to="{name: 'home'}">
          <img src="/images/logo.svg" alt="uswa-logo" class="" style="width:150px; height:auto">  
          <!-- <img src="/images/email_logo.png" class="mobile" alt="uswa-logo" style="width:150px;">   -->
          </router-link>  </span>  
      </div>
     
      <div class="pl-4 ms-5 desktop " v-if="getUser.role !== 'admin' " >
        <ul class="list-unstyled my-auto py-auto d-flex align-items-center"  >
          <li> <router-link :to="{name: 'home'}" class="px-1" >Home</router-link></li>        
          <li> <router-link :to="{name: 'find-tutor'}" class="px-3" v-if="getUser.role !== 'tutor' ">Find a tutor</router-link> </li>           
          <li> <router-link :to="{name: 'register-tutor'}" class="px-3"  v-if="getUser.role !== 'tutor' && getUser.role !== 'student' ">Become a tutor</router-link> </li>           
        </ul>
      </div>  
      
    </div>
    <!-- ---------------------- -->
    <div class="mobile ps-3 text-center">
      <span class=""> 
        <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
        <a v-if=" isLogedIn" class=" login" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropProfile">
              <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.1rem" v-if="! getUser.image"></i>
               <img v-else :src="getUser.image" alt="profile picture" > <br> 
            {{this.capitalize(getUser.first_name)}}
        </a> 
        </span>
    </div>
    <!-- --------------------Acc bal--------------------- -->
    <div class="text-muted acc desktop" v-if="isLogedIn">
      <router-link :to="{name: 'account'}" v-if="getUser.role !== 'admin'">
        <div class="border btn btn-default py-2">
          <span class="fw-bold"> Balance: </span>
          <span class="text-muted"> $</span>
          <span class="text-muted">{{this.getAccount.available_balance}} </span>
        </div> 
      </router-link>           
    </div>
    <!-- --------------------------------------------------- --> 
    <!-- ---------Dashboard----------------- -->
    <div class="d-flex align-items-center w-auto">        
        <div class="px-2 desktop" v-if=" isLogedIn ">
          <router-link :to="{name: 'student-dashboard'}" v-if="getUser.role == 'student'">Dashboard</router-link> &nbsp;
          <router-link :to="{name: 'tutor-dashboard'}" v-if="getUser.role == 'tutor'">Dashboard</router-link>
          <router-link :to="{name: 'all-users'}" v-if="getUser.role == 'admin'">Dashboard</router-link>
        </div>
     <!-- --------------------------------------------------   -->

     <!-- ------------------- Components -------------------------- -->
        <div class="d-flex  w-auto" v-if="isLogedIn && this.getUser.role !== 'admin' ">
          <span class="" v-if="getUser.role == 'student' "> <StudentMessages /></span>
          <span class="" v-if="getUser.role == 'tutor' "> <TutorMessages /></span>
          <span class="" v-if="getUser.role == 'student' "> <StudentNotifications /></span>
          <span class="" v-if="getUser.role == 'tutor' "> <TutorNotifications /></span>
          <span class="" > <Lectures /></span>
        </div>
        <!-- ---------------------------------------------------------------------- -->

        <!-- ---------------------- Mobile login ------------------------------------ -->
        <div class="px-3 desktop">
            <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link> <span  v-if="! isLogedIn"> | </span>
            <router-link :to="{name: 'register'}" class="px-1" v-if="! isLogedIn">Register</router-link>            
<!-- ----------------------------------------------------------------------------- -->

<!-- ----------------- Drop down --------------------------------------  -->
            <div class="dropdown mx-2" v-if=" isLogedIn">   
              <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              {{this.capitalize(getUser.first_name)}} &nbsp; 
               <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem" v-if="! getUser.image"></i>
               <img v-else :src="getUser.image" alt="profile picture" style="width:40px; height:40px; border-radius:50%">
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">  
                  <li  v-if=" isLogedIn && getUser.role !== 'admin'">
                    <a href="#" class="dropdown-item" >
                      <router-link :to="{name: 'student-dashboard'}" v-if="getUser.role == 'student'">Dasboard</router-link> 
                      <router-link :to="{name: 'tutor-dashboard'}" v-if="getUser.role == 'tutor'">Dashboard</router-link>
                    </a> 
                  </li>
                  <li v-if=" isLogedIn && this.getUser.role == 'student'"><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropProfile" >Profile</a></li> 
                  <li v-if=" isLogedIn && this.getUser.role == 'tutor'"><a class="dropdown-item" href="#"  ><router-link :to="{name: 'register-tutor-signup'}"  >Profile</router-link></a></li>
                  <li v-if="this.getUser.role == 'tutor'"> <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#lecturesModal"> Lectures </a> </li>
                  <li  v-if=" isLogedIn">  <Logout />  </li>
              </ul>
            </div>        
        </div>
        <MobileNav /> 
      </div>
  </div>
  </div>
  </div>

  <div>
    <router-view></router-view>
  </div>
    

  <div class=" ">
    <Profile />     

     <Footer /> 
  </div>
  
</template>

<script>
import {mapGetters, mapActions } from "vuex";

import MobileNav from "../Navigation/MobileNav.vue";
import Logout from "../Auth/Logout.vue";
import Footer from "./Footer.vue";
import Profile from "../Profile/Profile.vue";
import StudentMessages from "../Chats/StudentMessages.vue";

import TutorMessages from "../Chats/TutorMessages.vue";
import TutorNotifications from "../UserNotifications/TutorNotifications.vue";
import StudentNotifications from "../UserNotifications/StudentNotifications.vue";
import VerifyEmail from "../Notifications/EmailUnverified.vue";
import TutorSignupProcessNotification from "../Notifications/TutorSignupProcessNotification.vue";

import AdminDashboard from "../Admin/Dashboard.vue";
import Lectures from "../Tutor/Lessons/Lectures.vue";

export default {
  components:{
    MobileNav,
    Footer,
    Logout,
    Profile,
    StudentMessages,
    TutorMessages,
    StudentNotifications,
    TutorNotifications,
    VerifyEmail,
    TutorSignupProcessNotification,
    AdminDashboard,
    Lectures
  },
  data(){
    return{
      //
    }
  },
  methods:{
    capitalize(string){
          if(string)  return string.charAt(0).toUpperCase() + string.slice(1);
        },
    showHomePage(){ 
      this.$router.push({name: 'home'});
      setTimeout(() => {
          if(window.zoom_success){ // handle zoom redirection if exists
            if(this.user.role == 'student') this.$router.push({name: 'student-trial-lesson'});
            if(this.user.role == 'tutor') this.$router.push({name: 'tutor-trial-lesson'});
          } else this.$router.push({name: 'home'});        
        }, 200);       
    },

  },
  computed:{
    ...mapGetters(['isLogedIn', 'getUser', 'getAccount']), 
  
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
.hvr:hover, a:hover{
  color:#d61e1ef3;

}
.acc:hover{
  border:1px solid  #e08686f3;
  
  background-color: #f5e4e4f3;
  border-radius: 5px;
}
@media screen and (max-width: 850px){
      .mobile{
        display: inline-block;
      }
      .desktop{
        display:none;
      }
      .ps-4{
        padding-left: 0 !important;
        margin-right:5px;
      }
      .log img{
        width:100px !important;
      }
      .login img{
        width:25px ;
        height:25px ;
        border-radius:50%;
      }

      .px-3{
        padding-left: 0 !important;
        padding-right: 0 !important;       
      }
     

}
  

</style>