<template>
  <div class="parent-nav   ">   
    <div>
        <span @click.prevent="opennotificationSidenav()" class="position-relative" style="cursor:pointer">
            <span v-if='show_notification_badge' class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">1 </span>
            <i class="bi bi-bell text-dark hvr " @click.prevent="fetchNotifications()"></i>
        </span>
        <div id="notification" class="sidenav " style="">
            <a href="javascript:void(0)" class="closebtn" id="closeNav" @click.prevent="[closenotificationSidenav()]">&times;</a>
            <h4 class="border-bottom w-100 pb-1 px-3"> Notifications</h4>
            <div class="px-3">

                <div v-if="Object.keys(this.current_notifications).length"> 
                    <div class="card p-2 mb-2 position-relative" v-for="(notification, index) in this.current_notifications" :key="index">
                    <span class="position-absolute top-0 end-0 text-danger mr-2" style="cursor:pointer" @click.prevent="deleteNotification(notification.id)">  &times;</span>
                        <h5>{{notification.title}}</h5>
                        <p class="mb-0">
                            {{notification.body}}
                        </p>
                    </div>
                    </div>
                <div v-else>
                    <p class="text-muted small text-center py-5">You havent recieved any notification yet</p>
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
    data(){
        return{
            notifications:{},
            current_notifications:{},
            current_notification:{},
            show_notification_badge:false
        }
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
        },

        fetchNotifications(){
            axios.get('/api/student/notifications/get/' + this.getUser.id)
            .then(response=>{
                this.notifications = response.data.data.data;
                this.current_notifications = this.notifications;
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        deleteNotification(id){
            axios.delete('/api/notifications/' + id)
            .then(response=>{
                this.fetchNotifications();               
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        markNotificationRead(id){
            axios.get('/api/notifications/mark-read' + id)
            .then(response=>{
                this.fetchNotifications();               
            })
            .catch(error=>{
                console.log(error.response);
            });
        }
    },

    computed:{
        ...mapGetters(['isLogedIn', 'getUser']),   
    },
    mounted(){
        this.fetchNotifications();
    }
}
</script>

<style scoped>
.bi:hover{
  color:#d61e1ef3;

}
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
  max-width: 100%;
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