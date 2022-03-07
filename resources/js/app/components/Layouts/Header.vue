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
      <div class="d-flex py-4 "> 
        <span v-if="getUser.role == 'admin'"> <router-link :to="{name: 'all-users'}"><img src="http://127.0.0.1:8000/images/logo.svg" alt="uswa-logo" style="width:150px; ">  </router-link>  </span>  
        <span v-else> <router-link :to="{name: 'home'}"><img src="http://127.0.0.1:8000/images/logo.svg" alt="uswa-logo" style="width:150px; ">  </router-link>  </span>  
      </div>
      <div class="pl-3 desktop " v-if="getUser.role !== 'admin' " >
         <ul class="list-unstyled d-flex" >
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
        <div class="px-2 desktop" v-if=" isLogedIn && this.getUser.role !== 'admin'">
          <router-link :to="{name: 'student-dashboard'}" v-if="getUser.role == 'student'">Dashboard</router-link> &nbsp;
          <router-link :to="{name: 'tutor-dashboard'}" v-if="getUser.role == 'tutor'">Dashboard</router-link>
        </div>
      
        <div class="d-flex" v-if="isLogedIn && this.getUser.role !== 'admin' ">
          <span class="" v-if="getUser.role == 'student' "> <StudentMessages /></span>
          <span class="" v-if="getUser.role == 'tutor' "> <TutorMessages /></span>
          <span class="" v-if="getUser.role == 'admin' "> <AdminNotifications /></span>
          <span class="" v-if="getUser.role == 'student' "> <StudentNotifications /></span>
          <span class="" v-if="getUser.role == 'tutor' "> <TutorNotifications /></span>
        </div>
        <div class="px-3 desktop">
            <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
            <router-link :to="{name: 'register'}" class="px-1" v-if="! isLogedIn">Register</router-link>            

            <div class="dropdown mx-2">   
              <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

              {{getUser.first_name}} &nbsp; 
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
                  <li><a class="dropdown-item" href="#"><Logout /></a></li>
              </ul>
            </div>        
        </div>
        <MobileNav /> 
        </div>
  </div>
  </div>
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
import AdminNotifications from "../UserNotifications/AdminNotifications.vue";
import TutorNotifications from "../UserNotifications/TutorNotifications.vue";
import StudentNotifications from "../UserNotifications/StudentNotifications.vue";
import VerifyEmail from "../Notifications/EmailUnverified.vue";
import TutorSignupProcessNotification from "../Notifications/TutorSignupProcessNotification.vue";

import AdminDashboard from "../Admin/Dashboard.vue";

export default {
  components:{
    MobileNav,
    Footer,
    Logout,
    Profile,
    StudentMessages,
    TutorMessages,
    AdminNotifications,
    StudentNotifications,
    TutorNotifications,
    VerifyEmail,
    TutorSignupProcessNotification,
    AdminDashboard,
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