<template>
  <div class="parent-nav  mr-3">   
    <div class="me-2">
        <span  class="position-relative" @click.prevent="openTutorMessages()" style="cursor:pointer">
             <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" v-if="this.unread_threads > 0">
                {{unread_threads}}
            </span>
            <i class="bi bi-chat-dots text-dark " >  </i>
        </span>
        <div id="mySidenav-tutor" class="sidenav px-3 shadow" style="">
            <span class="" id="closeMessages">
                <a href="javascript:void(0)" class="closebtn" id="closeNav" @click.prevent="closeMessages()">&times;</a>
            </span>
           <span class="hidden" id="closeThread">
                <a href="javascript:void(0)" class="closebtn hidden"  @click.prevent="closeThread()"><i class="bi bi-arrow-left text-dark " ></i></a>
            </span>
            <div id="messages" class="">             
                <h4 class="border-bottom p-2 d-flex align-content-center justify-content-between"> <span>Messages </span>  <span class="btn btn-danger btn-sm me-3 p-0" @click.prevent="fetchMesages()"> <i class="bi bi-arrow-clockwise"></i> </span></h4>
               <div v-if="Object.keys(this.current_messages).length">
                    <ul class="list-unstyled pr-3 mr-3 pt-4" v-for="(message, index) in this.current_messages" :key="index">
                        <li class="border-bottom p-2">
                            <div class="d-flex position-relative align-items-center" style="cursor:pointer">
                                <span v-if="message.message_sender.image">  <img :src="message.message_sender.image" alt="profile pic" style="width:50px; height:50px; border-radius:50%;"> </span>
                                <span v-else>  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem"></i></span>
                                <span class="ml-2" @click.prevent="[toggleMessage(message), toggleThread(message.conversation_thread),  showThread(), toggleSeen(message) ]" style="cursor:pointer">
                                    <h5 class="m-0 position-relative"> 
                                        {{this.capitalize(message.message_sender.first_name)}} {{ message.message_sender.last_name.charAt(0).toUpperCase()}}
                                        <span class="position-absolute top-0 start-100 text-white  bg-danger small" v-if="!message.tutor_seen" style="font-size:.6rem; padding:.2rem .45rem; border-radius:50rem"> 1 </span>
                                    </h5>
                                    <p class="m-0"> {{lastInThread(message.conversation_thread)}} </p>
                                
                                    <small class="float-end mr-3 text-muted">{{lastInThreadTime(message.conversation_thread)}}</small>
                                </span>
                                <span class="p-2 position-absolute trash end-0" @click.prevent="deleteConversation(message.id)"> <i class="bi bi-trash  " style="cursor:pointer"></i> </span>

                            </div>
                        </li>                    
                    </ul> 
                </div> 
                <div class="py-5" v-else>
                    <p class="text-muted text-center my-5"> No messages to show</p>
                </div>             
            </div>

            <!-- ----------------------------- Conversation Thread --------------------------------------- -->
            <div id="thread" class="mr-3 ">
                <div  v-if="Object.keys(this.current_message).length ">
                <h4 class="d-flex align-items-center border-bottom">
                    <span class="p-2" v-if="this.current_message.message_sender.image"> <img :src="this.current_message.message_sender.image" alt="profile pic" style="width:30px; height:30px; border-radius:50%;"> </span>                   
                    <span v-else><i class="bi bi-person-circle rounded-circle text-muted" style="font-size:1.7rem"></i>  </span>                   
                    <span v-if="Object.keys(this.current_message).length">{{this.capitalize(this.current_message.message_sender.first_name)}}  {{ this.current_message.message_sender.last_name.charAt(0).toUpperCase()}} </span> 
                </h4>

                <div v-for="(text, index) in this.current_message_thread" :key="index">
                    <div class="">
                        <div class="charts " :class="[text.sender == this.getUser.id ? 'float-end' : '']">                            
                            <p class="mb-0">{{this.capitalize(text.message)}}</p>
                            <p class="text-end  mb-0 small text-muted">
                            <span class="mx-2"> {{formatDate(text.created_at)}} </span>
                            <span class="ml-2" v-if="text.recipient !== this.getUser.id"><i class="bi bi-check-all "></i></span>   
                            </p>                        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
               
                 <div class="p-2 reply d-flex"> 
                    <span class="textarea ">
                        <span class="d-flex align-items-center mx-1"> 
                            <textarea name="" id="" class=" w-100 p-3" maxlength="150" cols="35" rows="3" placeholder="Type a reply" v-model="new_message"></textarea>
                            <button class="btn btn-sm btn-secondary float-end mx-2" @click.prevent="sendMessage()"> <i class="bi bi-send" style="transform: rotate(20deg)"></i></button>
                        </span>                    
                    </span>                 
               </div>

            </div>
            <div v-else>
                <p class="text-muted py-5 my-5 text-center"> Empty thread. Please delete this thread to save space.</p>
            </div>
            </div>
        <!-- -------------------------------------------------------------------------------------- -->
        </div>
    </div>
 </div>

</template>

<script>
import moment from 'moment';
import {mapGetters,  mapActions } from "vuex";

export default {
    components:{
       //
    },
    data(){
        return{
            current_messages:{},
            current_message:{},
            current_message_thread:{},
            new_message:null,
        }
    },
    methods:{
        formatDate(date){
            if (date)      return moment(String(date)).format('ll') + ' ' + moment(String(date)).format('LT');
        },
        capitalize(string){
          if(string)  return string.charAt(0).toUpperCase() + string.slice(1);
        },
        openTutorMessages() {
            document.getElementById("mySidenav-tutor").style.width = "550px";            
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        },
        closeMessages() {
            document.getElementById("mySidenav-tutor").style.width = "0";           
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
        },
        lastInThread(conversation_thread){
            let last_in_thread = {...conversation_thread.slice(-1)[0]};
            return this.capitalize(last_in_thread.message);
        },
        lastInThreadTime(conversation_thread){
            let last_in_thread = {...conversation_thread.slice(-1)[0]};
            return this.formatDate(last_in_thread.created_at);
        },
        toggleThread(message_thread){
            this.current_message_thread = message_thread;
        },
        toggleMessage(message){
            this.current_message = message;
        },
        fetchMesages(){
            if(!this.isLogedIn)  return;
            axios.get('/api/tutor/messages')
            .then(response => {
                this.unread_threads = 0;
                this.current_messages = response.data.data.data; 
                response.data.data.data.forEach(message=>{                 
                    if(! message.tutor_seen) this.unread_threads +=1;                    
                });              
            })
            .catch(error => {  console.log(error.response);   });
        },
        refreshCurrentMessage(){ 
            if(!Object.keys(this.current_message).length) return;
            if(!this.isLogedIn) return;         
            axios.get('/api/tutor/get-message/' + this.current_message.id)
            .then(response => {            
                if(response.status == 200){
                    this.current_message_thread = response.data.data.conversation_thread;                   
                }                               
            })
            .catch(error => {  console.log(error.response);  });
        },
        toggleSeen(message){
            axios.get('/api/student/update-seen/' + message.id)
            .then(response => {
                              
            })
            .catch(error => {  console.log(error.response);   });
        },
        deleteConversation(id){
            if(! confirm("Delete this conversation thread? \n All messages in this thread will be parmanently lost.")) return;
            axios.delete('/api/tutor/messages/' + id)
            .then(response => {
                this.fetchMesages();            
            })
            .catch(error => {  console.log(error.response);   });
        },
        sendMessage(){
            if(!this.isLogedIn) return; 
            if(! this.new_message) return;
            var form_data = new FormData();
                form_data.append('conversation_id', this.current_message.id);
                form_data.append('message', this.new_message);
                form_data.append('recipient', this.current_message.sender); //recipient student
                form_data.append('sender', this.current_message.recipient); // sender tutor               
            axios.post('/api/tutor/send-message', form_data)
            .then(response => {
                if(response.status == 201){
                    this.new_message = null;
                    this.refreshCurrentMessage();
                }                               
            })
            .catch(error => {   console.log(error.response);  });          
        },
        refreshConversation(){
            setInterval(() => {
                this.fetchMesages();
                this.refreshCurrentMessage();
            }, 20000);
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    mounted(){
        this.refreshConversation();
        this.fetchMesages();
    }
}
</script>

<style scoped>
 .parent-nav{
    font-family:Poppins;
    color:#9699a2;   
 }
 .trash{
      color: #9c9b9b !important;
  }
  .trash:hover{
      color: #CC0000 !important;
  }
.charts{
    padding:1rem 2rem .2rem;
    margin:.2rem 0;
    border: 1px solid rgb(230, 226, 226);
    border-radius: 2rem;
    width:auto;
    max-width:75%;
}
.reply{
    padding: 1rem 0;
    position:relative;
    height:140px;
    margin: 0 0 1rem 0;
}
.reply .textarea{
    max-width:90%;
    position:absolute;
    bottom:0;
    right:0;    
    align-items: center;
}
.reply textarea{
    border: 1px solid rgb(230, 226, 226);
    border-radius: 2rem;
    width:100%;
}
/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  max-width: 95%;
  position: fixed; /* Stay in place */
  z-index: 10; /* Stay on top */
  top: 0; /* Stay at the top */
  right:0;
  right: -2rem;
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