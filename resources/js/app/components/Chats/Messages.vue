<template>
  <div class="parent-nav  mr-3">   
    <div>
        <span  class="position-relative" @click.prevent="openMessages()" style="cursor:pointer">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    2
                <span class="visually-hidden">unread messages</span>
                </span>
            <i class="bi bi-chat-dots text-dark " >  </i>
        </span>
        <div id="mySidenav" class="sidenav px-3 shadow" style="">
            <span class="" id="closeMessages">
                <a href="javascript:void(0)" class="closebtn" id="closeNav" @click.prevent="closeMessages()">&times;</a>
            </span>
           <span class="hidden" id="closeThread">
                <a href="javascript:void(0)" class="closebtn hidden"  @click.prevent="closeThread()"><i class="bi bi-arrow-left text-dark " ></i></a>
            </span>
            <div id="messages" class="">             
                <h4 class="border-bottom p-1">Messages</h4>
                <ul class="list-unstyled pr-3 mr-3 pt-4">
                    <li class="border-bottom p-2">
                        <div class="d-flex" @click.prevent="showThread()">
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i></span>
                            <span class="ml-2">
                                <h5 class="m-0">Putin</h5>
                                <p class="m-0"> I am invading Ukraine, Nato can go to hell</p>
                                <small class="float-end mr-3 text-muted">Feb 19, 08:20am</small>
                            </span>
                        </div>
                    </li>
                    <li class="border-bottom p-2">
                        <div class="d-flex">
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i></span>
                            <span class="ml-2">
                                <h5 class="m-0">Macron</h5>
                                <p class="m-0">  We can solve it in a better way Vladmir </p>
                                <small class="float-end mr-3 text-muted">Feb 19, 08:20am</small>
                            </span>
                        </div>
                    </li>
                    <li class="border-bottom p-2">
                        <div class="d-flex">
                            <span>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i></span>
                            <span class="ml-2">
                                <h5 class="m-0">Biden</h5>
                                <p class="m-0">  Will give you a call tommorow morning </p>
                                <small class="float-end mr-3 text-muted">Feb 19, 08:20am</small>
                            </span>
                        </div>
                    </li>
                </ul>               
            </div>

            <!-- -------------------------------------------------------------------- -->
            <div id="thread" class="mr-3 hidden">
                <h4 class="d-flex align-items-center border-bottom">
                    <span><i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.7rem"></i>  </span>
                    <span> Biden </span> 
                </h4>
                <div class="w-100">
                    <div class="charts float-end">
                        <h5>Putin</h5>
                        <p class="mb-0">Am leting it burn joe, you folks can go to hell</p>
                        <p class="text-end  mb-0 small text-muted">
                          <span class="mx-2"> Feb 20, 7:41pm</span>
                            <span class="ml-2"><i class="bi bi-check-all "></i></span>  
                        </p>                        
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="">
                    <div class="charts float-start">
                        <h5>Joe</h5>
                        <p class="mb-0">You cant do it Vladmir, you know we will humiliate you...</p>
                        <p class="text-end  mb-0 small text-muted">
                          <span class="mx-2"> Feb 20, 7:41pm</span>                            
                        </p> 
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="">
                     <div class="charts float-end">
                        <h5>Putin</h5>
                        <p>Lets see how true is that...</p>
                    </div>
                </div>
               <div class="clearfix"></div>
               <div class="">
                    <div class="charts float-start">
                        <h5>Joe</h5>
                        <p>Wait a minute, we can solve this another way....</p>
                    </div>
               </div>
               <div class="clearfix"></div>
               <div class="p-2 reply">
                   <textarea name="" id="" class="w-100 textarea p-3" cols="5" rows="3" placeholder="Type a reply"></textarea>
               </div>
            </div>
        <!-- -------------------------------------------------------------------------------------- -->
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
        openMessages() {
            document.getElementById("mySidenav").style.width = "550px";            
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        },
        closeMessages() {
            document.getElementById("mySidenav").style.width = "0";           
            document.body.style.backgroundColor = "white";
        },
        showThread(){
            document.getElementById("messages").classList.add('hidden');            
            document.getElementById("thread").classList.remove('hidden');

            document.getElementById("closeMessages").classList.add('hidden');            
            document.getElementById("closeThread").classList.remove('hidden');
        },
        closeThread(){
            document.getElementById("messages").classList.remove('hidden');            
            document.getElementById("thread").classList.add('hidden');
            document.getElementById("closeMessages").classList.remove('hidden');            
            document.getElementById("closeThread").classList.add('hidden'); 
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
 }
  
.charts{
    padding:1rem 2rem .2rem;
    margin:.2rem 0;
    border: 1px solid rgb(230, 226, 226);
    border-radius: 2rem;
    max-width:75%;
}
.reply{
    padding: 1rem 0;
    position:relative;
    height:140px;
    margin: 0 0 1rem 0;
}
.reply .textarea{
    max-width:70%;
    position:absolute;
    bottom:0;
    right:0;
    border: 1px solid rgb(230, 226, 226);
    border-radius: 2rem;
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