<template>
  <div>
        <div class="modal fade" id="staticBackdropTrial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg text-secondary modal-dialog-centered modal-dialog-scrollable ">
            <div class="modal-content px-3">
            <div class="modal-header">
                <h4 class="modal-title">Book Trial lesson</h4>
                <button type="button" id="closetrial" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-2">  
                
              <h5>Select date and time to meet with {{this.tutor.first_name}} {{this.tutor.last_name}}</h5>
               <div>
                 <p>
                   <label for="date">Date</label>
                   <span> <input type="date" id="date" class="form-control py-3 text-muted" v-model="this.date" @change.prevent="this.validateDate()"> </span>
                    <small class="text-danger" v-if="this.errors.date"><i class="bi bi-exclamation-triangle"></i> {{this.errors.date}}</small>
                 </p>
                 <p>
                   <label for="lesson_type">Language</label>
                    <select  id="lesson_type" v-model="lesson_type" class="w-100 py-3 border text-muted rounded bg-white">
                        <option selected value="">- Select -</option>
                        <option  value="english">English</option>
                        <option  value="german">German</option>
                        <option  value="italian">Italian</option>
                        <option  value="spanish">Spannish</option>
                        <option  value="chinese">Chinese</option>
                        <option  value="arabic">Arabic</option>
                        <option  value="russian">russian</option>
                    </select>
                    <small class="text-danger" v-if="this.errors.lesson_type"><i class="bi bi-exclamation-triangle"></i> {{this.errors.lesson_type}}</small>
                 </p>
                 
                  <p class="row py-2"> 
                    <span class=" col-sm-6">
                      <label for="from">From </label> <br>
                        <select name="" id="from" class="p-3 w-100 rounded bg-white border text-muted" v-model="this.time.from">
                            <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro" > {{item}} </option>
                        </select>
                    </span>
                    <span class=" col-sm-6">
                      <label for="to">To</label> <br>
                        <select name="" id="to" class="p-3 w-100 rounded bg-white border text-muted" v-model="this.time.to" @change.prevent="testTimeLimit()">
                            <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                        </select>
                        <small class="text-danger" v-if="this.errors.time_limit"><i class="bi bi-exclamation-triangle"></i> {{this.errors.time_limit}}</small>
                    </span>
                  </p>
                  
               </div>
                  <div class="small text-muted pb-4">
                    <span class="fw-bold"> Note: </span>
                    <span> 
                      <ul>
                        <li>All trial lessons are limited to 1hr. </li>
                        <li>This is to help you test the tutor and see if you like them. </li>
                        <li>If you dont like the tutor you can always find another. </li>
                        <li>We emphasize you to watch the tutor introduction video before booking a lesson with them. </li>
                      </ul>
                    </span> 
                   
                    </div>   
                    <span class="text-success small p-2 m-2" v-if="this.success.book_trial">{{this.success.book_trial}}</span>
                   <span class="small text-danger text-center">{{this.errors.error}}</span> <br>
                <button class="btn btn-danger m-2" @click.prevent="bookTrialLesson()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.book_lesson"></span> Book lesson</button>
                <button class="btn btn-primary m-2" data-bs-target="#paypal-modal" data-bs-toggle="modal" data-bs-dismiss="modal" v-if="this.getAccount.available_balance < this.tutor.hourly_rate" @click.prevent="this.loadPaypalCheckout()">Topup account</button>
            </div>            
            </div>
        </div>
    </div>

    <!-- second mini modal paypal -->
    <div class="modal fade" id="paypal-modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Top up account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
            <div class="w-auto mx-uato text-left py-3">
                <label class="py-2  ">Topup with Paypal: </label>
                <div @click.prevent="this.showPaypalSpinner()">
                   <div class=" mx-auto" id="paypal-button-container" ></div>  
                </div>
               
                <small class="text-primary" v-if="this.success.payment"> {{this.success.payment}} </small>
                <small class="text-primary" v-if="this.spinner.paypal_processing"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.paypal_processing"></span> Processing...</small>
            </div>
            
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" data-bs-target="#staticBackdropTrial" data-bs-toggle="modal" data-bs-dismiss="modal"> <i class="bi bi-chevron-left"></i> Back </button>
        </div>
      </div>
    </div>
  </div>

  </div>
</template>

<script>
import moment from "moment";
import {mapGetters } from "vuex";

export default {
    props:['tutor'],
  
    data(){
        return{
            time_selector:[
                        '00:00',
                        '00:30',
                        '01:00',
                        '01:30',
                        '02:00',
                        '02:30',
                        '03:00',
                        '03:30',
                        '04:00',
                        '04:30',
                        '05:00',
                        '05:30',
                        '06:00',
                        '06:30',
                        '07:00',
                        '07:30',
                        '08:00',
                        '08:30',
                        '09:00',
                        '09:30',
                        '10:00',
                        '10:30',
                        '11:00',
                        '11:30',
                        '12:00',
                        '12:30',
                        '13:00',
                        '13:30',
                        '14:00',
                        '14:30',
                        '15:00',
                        '15:30',
                        '16:00',
                        '16:30',
                        '17:00',
                        '17:30',
                        '18:00',
                        '18:30',
                        '19:00',
                        '19:30',
                        '20:00',
                        '20:30',
                        '21:00',
                        '21:30',
                        '22:00',
                        '22:30',
                        '23:00',
                        '23:30',
                    ],
            date:null,
            lesson_type:null,
            paypal_client_id:'',
            time:{
                from:null,
                to:null,
            },
            errors:{},
            success:{},
            spinner:{},
            success:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{
        testTimeLimit(){
            delete this.errors.time_limit ;
            if( moment(this.time.to, 'H:mm').diff( moment(this.time.from, 'H:mm'), 'minutes') < 30)  this.errors.time_limit = "Invalid time range selection";          
            if( moment(this.time.to, 'H:mm').diff( moment(this.time.from, 'H:mm'), 'minutes') > 60)  this.errors.time_limit = "Trial lesson is limited to 1hr.";    
        },
        validateDate(){
            delete this.errors.date;
            if( moment(this.date).isBefore(moment()) ) this.errors.date = "Invalid date selection."
            if( moment(this.date).isAfter(moment().add(5, 'days')) ) this.errors.date = "This activity should happen in 5 days max."
        },
        bookTrialLesson(){
            if(!this.isLogedIn) { 
                document.getElementById('closetrial').click();
                this.$router.push({name: 'login'})
            };
            this.errors = {};
            this.testTimeLimit() ;
            this.validateDate();
            if(this.getAccount.available_balance < this.tutor.hourly_rate)
            { alert('Insufficient account balance! \nYour account must have a balance of atleast $' + this.tutor.hourly_rate + ' to cover for the cost of your first lesson.'); return;}

            if(!this.date) this.errors.date = "Date field is required";
            if(!this.time.from) this.errors.time_limit = "Time selection is required";
            if(!this.time.to) this.errors.time_limit = "Time selection is required";            
            if(!this.lesson_type) this.errors.lesson_type = "Language selection is required";  

            if(Object.keys(this.errors).length) return;
            var form_data = new FormData();
                form_data.append('lesson_date', this.date);
                form_data.append('start_time', this.time.from);
                form_data.append('end_time', this.time.to);
                form_data.append('lesson_type', this.lesson_type);
                form_data.append('student_id', this.$store.state.user.user.id);
                form_data.append('student_timezone', this.$store.state.user.user.timezone);
                form_data.append('tutor_id', this.tutor.id);
                form_data.append('tutor_confirm', 'pending');
                form_data.append('tutor_timezone', this.tutor.timezone);           
            if(!confirm('Book a trial lesson with this tutor?')) return;
            this.spinner.book_lesson = true;
            axios.post('/api/student/trial-lesson', form_data)
            .then(response => {
                this.spinner= {}
                this.success.book_trial = "Success, Your trial lesson has been booked successfully!";
                setTimeout(() => {
                    document.getElementById('closetrial').click();
                    delete this.success.book_trial;
                    this.lesson_type = null
                    this.date = null
                    this.time.from = null
                    this.time.to = null
                }, 2500);
            })
            .catch(error => {
              this.spinner= {}
              console.log(error.response);
              this.errors.error = "Error: Something went wrong. Please try again later."
            });

            
            
        },
       
        fetchPaypalClientID(){
            axios.get('/api/get-paypal-clientId')
            .then(response=>{
                this.paypal_client_id = response.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        showPaypalSpinner(){
            return this.spinner.paypal_processing = true;
        },
        loadAsync(url, callback) {
            var s = document.createElement('script');
            s.setAttribute('src', url); s.onload = callback;
            document.head.insertBefore(s, document.head.firstElementChild);
        },
        loadPaypalCheckout(){ //paypal buttons            
            this.loadAsync('https://www.paypal.com/sdk/js?client-id=' + this.paypal_client_id + '&intent=authorize&disable-funding=credit,card', function() {
                paypal.Buttons({                    
                    // Set up the transaction
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    currency_code: "USD",
                                    value: '10'
                                },
                                // payee: {
                                //     merchant_id :  'VMJSV3L3DRE9A'
                                // },
                            }],
                            application_context: {
                                shipping_preference: 'NO_SHIPPING',
                                SOLUTIONTYPE:'MARK'
                            }, 
                        });
                    },   

                    // Finalize the transaction
                    onApprove: function(data, actions) {
                        // Authorize the transaction
                        actions.order.authorize().then(function(authorization) {
                            // Get the authorization id
                            var authorizationID = authorization.purchase_units[0].payments.authorizations[0].id
                            axios.post('/api/update/local-account/', authorization )
                            .then(response=>{      
                                console.log(response); 
                                console.log('Success, payment processed!');                 
                                this.success.payment = 'Success, payment processed!';
                            })
                            .catch(error=>{                       
                                console.log(error.response);
                            });
                        });
                    }
                }).render('#paypal-button-container');
            });     
        }

    },
    mounted(){
        this.fetchPaypalClientID();
    }
}
</script>

<style>

</style>