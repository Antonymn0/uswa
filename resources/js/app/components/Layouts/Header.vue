<template>
<div> <MobileNav /> </div>
  <div class="parent-header d-flex justify-content-between  border-bottom px-3">
    <div class="d-flex justify-content-start align-items-center">
      <div class="d-flex py-4 "> 
        <span> <h2>USWA</h2> </span>  
      </div>
      <div class="pl-3">
         <ul class="list-unstyled d-flex  ">
         <router-link :to="{name: 'student-dashboard'}" class="px-3" >Find a tutor</router-link>          
         <router-link :to="{name: 'tutor-dashboard'}" class="px-3" >Become a tutor</router-link>          
          <li class="px-3 desktop"><a href="#">FAQs</a></li>
        </ul>
      </div>
    </div>

    <div class="d-flex align-items-center">     
      <div class="px-2 desktop">
      <router-link :to="{name: 'home'}">Home</router-link>
      </div>
      <div class="p-4 border-right desktop">
       Language | currency
      </div>
      <div class="px-2 desktop">
        Help
      </div>
      
      <div class="px-3 desktop">
        <router-link :to="{name: 'login'}" class="px-1" v-if="! isLogedIn">Login</router-link>
        <router-link :to="{name: 'register'}" class="px-1" v-if="! isLogedIn">Register</router-link>
       <Logout />
      </div>
      
    </div>
  </div>
 
<div class="w-100">
    <router-view></router-view>
  </div> <br>
  <div class="w-100 ">
     <Footer /> 
  </div>
  
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

import MobileNav from "../Navigation/MobileNav.vue";
import Logout from "../Auth/Logout.vue";
import Footer from "./Footer.vue";
export default {
  components:{
    MobileNav,
    Footer,
    Logout
  },
  data(){
    return{
     //
    }
  },
  methods:{
    
  },
  computed:{
    ...mapGetters(["isLogedIn"]),    
  },
mounted(){
    this.$router.push({name: 'home'});
    }
}
</script>

<style scoped>

@media screen and (max-width: 750px){
      .desktop{
        display:none;
      }
}
  

</style>