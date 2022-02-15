<template>
  <div class="parent-nav   ">   
    <div>
        <span @click.prevent="opennotificationSidenav()" class="position-relative" style="cursor:pointer">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5
            <span class="visually-hidden">unread messages</span>
            </span>
            <i class="bi bi-bell text-dark " ></i>
        </span>
        <div id="notification" class="sidenav " style="">
            <a href="javascript:void(0)" class="closebtn" id="closeNav" @click.prevent="closenotificationSidenav()">&times;</a>
            <h4 class="border-bottom w-100 pb-1 px-3">Notifications</h4>
            <div class="px-3">
                <div class="card p-2 mb-2 position-relative">
                   <span class="position-absolute top-0 end-0 mr-2" style="cursor:pointer">  &times;</span>
                    <h5>Trial lesson confirmed</h5>
                    <p class="mb-0">
                        Tutor one has confirmed your trial lesson.
                    </p>
                </div>

                <div class="card p-2 mb-2 position-relative">
                     <span class="position-absolute top-0 end-0 mr-2" style="cursor:pointer">  &times;</span>
                    <h5>Trial lesson declined</h5>
                    <p class="mb-0">
                        Tutor one has declined your trial lesson due to bla bla bla.
                    </p>
                </div>
            </div>
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
        opennotificationSidenav() {
            document.getElementById("notification").style.width = "440px";            
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        },
        closenotificationSidenav() {
            document.getElementById("notification").style.width = "0";           
            document.body.style.backgroundColor = "white";
        },
        pushRoutes(route){
            this.$router.push({name: route});
            this.closeNav();
        }
    },
    computed:{
        ...mapGetters(["isLogedIn"]),    
    },
}
</script>

<style scoped>
 .parent-nav{
    font-family:Poppins;
    color:#9699a2;
    display:flex;
    align-items: center;
    justify-content:space-between;
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
    margin: 0 .3rem;
    font-size:1.3rem;
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