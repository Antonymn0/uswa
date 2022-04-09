<template>
  <div class="parent-nav   py-2">
   
    <div>
        <span @click.prevent="openMobileNav()"><i class="bi bi-list text-dark float-right" style="font-size:1.8rem; margin-right:1rem"></i></span>
        <div id="mySidenav" class="sidenav" style="">
            <a href="javascript:void(0)" class="closebtn" id="closeNav" @click.prevent="closeNav()">&times;</a>
                <ul class="list-unstyled ml-5">
                    <li class="nav-item">
                        <route-link :to="{name: 'home'}" class="nav-link" @click.prevent="pushRoutes('home')">Home </route-link>
                    </li>
                      <li class="nav-item">
                        <route-link :to="{name: 'find-tutor'}" class="nav-link" @click.prevent="pushRoutes('find-tutor')" v-if="getUser.role !== 'tutor' ">Find a Tutor </route-link>
                        <router-link :to="{name: 'register-tutor'}" class="px-3"  @click.prevent="pushRoutes('register-tutor')" v-if="getUser.role !== 'tutor' && getUser.role !== 'student' ">Become a tutor</router-link>
                    </li>
                     <li class="nav-item" v-if=" isLogedIn">
                       <route-link :to="{name: 'student-dashboard'}" class="nav-link" @click.prevent="pushRoutes('student-dashboard')" v-if="getUser.role == 'student'">Dashboard </route-link>
                       <route-link :to="{name: 'tutor-dashboard'}" class="nav-link" @click.prevent="pushRoutes('tutor-dashboard')" v-if="getUser.role == 'tutor'">Dashboard </route-link>
                        <route-link :to="{name: ''}" class="nav-link" @click.prevent="pushRoutes('')" data-bs-toggle="modal" data-bs-target="#lecturesModal"> Lectures </route-link>
                        <route-link :to="{name: 'account'}" class="nav-link" @click.prevent="pushRoutes('account')" >Account </route-link>
                    </li>
                  
                  
                    
                    <li class="dropdown-item  pt-2">                          
                        <button type="submit" class="btn-danger mx-auto text-white" @click.prevent="this.closeNav()"> 
                            <span> <router-link :to="{name: 'login'}" class="px-1 text-white"  v-if="! isLogedIn" >Login</router-link></span>                            
                            <Logout />                               
                        </button>                                                
                    </li>                  
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
import {mapGetters,  mapActions } from "vuex";
import Logout from '../Auth/Logout.vue';
export default {
    components:{
        Logout
    },
    methods:{
        openMobileNav() {
            document.getElementById("mySidenav").style.width = "60%";            
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            console.log('Nav clicked...');
        },
        closeNav() {
            document.getElementById("mySidenav").style.width = "0";           
            document.body.style.backgroundColor = "white";
        },
        pushRoutes(route){
            this.$router.push({name: route});
            this.closeNav();
        }
    },
    computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },
}
</script>

<style scoped>
 .parent-nav{
     display:none;
     padding-left: 3%;
     padding-right:3%;
 }
  

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 10; /* Stay on top */
  top: 0; /* Stay at the top */
  right:0;
  right: -1rem;
  background-color: #fff;
  color:#1f2027; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  padding-right: 10px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}
.nav-link{
    color:#535457;
    font-weight:500;
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  transition: 0.3s;
  font-family: Poppins ;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #645d5d;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: -70px;
  font-size: 36px;
  margin-left: 50px;
}
i{
    margin-right: 3rem;
}

/* //media querries */
@media screen and (max-width: 750px) {
 .parent-nav{
     font-family:Poppins;
     color:#9699a2;
    display:flex;
    align-items: center;
    justify-content:space-between;

}

    .logo img{
        padding-left: .5rem;
        width:120px;
        height:70px;
    }
}


</style>