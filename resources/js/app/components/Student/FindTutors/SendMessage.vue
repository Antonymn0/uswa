<template>
  <div>
        <div class="modal fade" id="staticBackdropMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content px-3">
            <div class="modal-header">
                <h4 class="modal-title fw-bold">Send message </h4>
                <button type="button" class="btn-close" id="closeMessage" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-2">
				 <p class="alert-success p-2 m-2" v-if="this.success.message_sent">{{this.success.message_sent}}</p> 
              <h6>Contact {{this.tutor.first_name}},</h6>
              <small class="text-muted p-1">Introduce yourself to the tutor.
               Share your learning goals and ask any questions</small>

              <textarea cols="30" rows="10" class="w-100 form-control p-2" autofocus v-model="this.message"></textarea>
              <small class="text-danger text-center">{{this.errors.message}}</small>
                <div class="small text-muted py-3">
                    <span class="fw-bold">Saftey Note: </span>
                    <span> 
                      <ul>
                        <li>Do not share your persnal details. </li>
                        <li>Personal email address or phone numbers. </li>                       
                      </ul>
                    </span>                  
                </div>  
              <div class="p-1 text-left">
				  <small class="text-danger">{{this.errors.error}}</small>
                <button class="btn btn-primary m-1" @click.prevent="sendMessage()">Send</button> 
               <button class="btn btn-danger m-1" data-bs-dismiss="modal" aria-label="Close">Close</button>  
              </div>           
            </div>            
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import {mapGetters } from "vuex";
export default {
    props:['tutor'],
    data(){
        return{
            message:null,
			errors:{},
			success:{},
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{
        sendMessage(){
          if(!this.isLogedIn) { 
            document.getElementById('closeMessage').click();
             this.$router.push({name: 'login'})
         };
         
          this.validateForm();
          if(Object.keys(this.errors).length) return;
      if(!confirm("Start a conversation with this tutor " + this.tutor.first_name + '?' ));
      
			var form_data = new FormData();
				form_data.append('message', this.message);
				form_data.append('sender', this.$store.state.user.user.id);
				form_data.append('recipient', this.tutor.id);

			axios.post('/api/student/messages', form_data)
			.then(response =>{
				if(response.status == 201){
          this.message= null;
					this.success.message_sent = "Success, Message sent to  " + this.tutor.first_name;					
					setTimeout(() => {						
						document.getElementById('closeMessage').click();
						this.success ={};
					}, 2500);
				}
			})
			.catch(error=>{
				errors.error = "Failed. Your message was not sent. Please try again later."
				console.log(error.response);
			});           
        },
        validateForm(){
			this.errors = {};
            if(!this.message) this.errors.message = 'Message field is required!';
        }
    },
}
</script>

<style>

</style>