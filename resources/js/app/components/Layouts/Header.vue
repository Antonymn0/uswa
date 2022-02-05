<template>
<div> 
<VerifyEmail />

</div>
<div class="border-botto"> 
  <div class="parent-header d-flex justify-content-between align-items-center  border-bottom px-3">
    <div class="d-flex justify-content-start align-items-center">
      <div class="d-flex py-4 "> 
        <span> <router-link :to="{name: 'home'}"> <h2>USWA</h2></router-link>  </span>  
      </div>
      <div class="pl-3 desktop" >
         <ul class="list-unstyled d-flex  ">
         <router-link :to="{name: 'student-dashboard'}" class="px-3" >Find a tutor</router-link>          
         <router-link :to="{name: 'tutor-dashboard'}" class="px-3" >Become a tutor</router-link>          
          <li class="px-3 desktop"><a href="#">FAQs</a></li>
        </ul>
      </div>
      
    </div>
    <!-- ---------------------- -->
    <div class="mobile">
      <span> 
        <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            &nbsp;  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.1rem"></i>  &nbsp;
            {{getUser.first_name}}
        </a> </span>
    </div>
    <!-- -------------------------- -->
    <div class="d-flex align-items-center">     
        <div class="px-2 desktop">
        <router-link :to="{name: 'home'}">Home</router-link>
        </div>
        <div class="p-4 border-right desktop">
        en | USD
        </div>
        <div class="px-3 desktop">
            <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
            <router-link :to="{name: 'register'}" class="px-1" v-if="! isLogedIn">Register</router-link>
            <div class="dropdown">
              <a v-if=" isLogedIn" class="d-flex align-items-center " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              {{getUser.first_name}} &nbsp;  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">            
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdropProfile">Profile</a></li>
                  <li><a class="dropdown-item" href="#"><Logout /></a></li>
              </ul>
            </div>        
        </div>
        <MobileNav /> 
        </div>
  </div>
  <div class="d-flex justify-content-center py-2">
    <router-link :to="{name: 'student-dashboard'}" class="px-3" >Find a tutor</router-link>          
    <router-link :to="{name: 'tutor-dashboard'}" class="px-3" >Become a tutor</router-link>   
  </div>
  </div>

 
<div class="w-100">
    <router-view></router-view>
  </div> <br>
  <div class="w-100 ">
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
import VerifyEmail from "../Notifications/EmailUnverified.vue";
export default {
  components:{
    MobileNav,
    Footer,
    Logout,
    Profile,
    VerifyEmail,
  },
  data(){
    return{
     //
    }
  },
  methods:{
    showHomePage(){
        this.$router.push({name: 'home'});
    }
  },
  computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },
mounted(){     
    setTimeout(this.showHomePage(), 200);
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