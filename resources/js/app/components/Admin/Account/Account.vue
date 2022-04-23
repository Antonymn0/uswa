<template>
<div class="row">
    <div class="col-md-2">    
      <SideNav />
    </div>
  <div class="col-md-10 pt-3 px-3">
      <div class="row me-2">
           <!-- --------------------------Acc Balance------------------------------------- -->
          <div class="col-md-6 "> 
              <div class="card px-3 py-5 text-center h-100">              
                <h3>Account balance</h3>
                <p class="mb-5 pb-4 text-muted  align-center"> 
                      <span>Available bal:  </span><br>                
                  <span>$ </span>  
                  <span class="fw-bold lead"> {{account.available_balance}}  </span>                
                </p>
                    <small v-if="this.errors.withdraw_funds" class="alert-danger p-2 my-3">{{this.errors.withdraw_funds}}</small>
                    <small v-if="this.success.withdraw_funds" class="alert-success p-2 my-3">{{this.success.withdraw_funds}}</small>
                <button class="btn btn-primary px-2 float-end bottom-0 my-1 " v-if=" !this.getUser.paypal_merchant_id && this.getUser.role == 'admin' "  @click.prevent="this.generateSigupLink()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.signup_link"></span>  Link with paypal </button>
                <button class="btn btn-primary px-2 float-end bottom-0 my-1" @click.prevent="withdrawAdminFunds(this.account.id)"> <span class="spinner-border spinner-border-sm " v-if="this.spinner.withdraw_funds"></span> Withdraw funds</button>
                <p class="small text-muted mb-0 pt-2">
                  <span>Last transaction type: </span> 
                  <span> {{account.last_transaction_type}} </span> 
                </p>
                
            </div>
          </div>

          <!-- --------------------- Commision ----------------------- -->
          <div class="col-md-6 "> 
              <div class="card px-3 py-5 text-center h-100">              
                <h3>Uswa commission/fee</h3>
                <p class="mb-5 text-muted">
                    <span>Current fee:  </span><br>
                    <span class="fw-bold lead"> {{account.fee_percentage}} %</span>                  
                </p>
                <small class="alert-success p-2" v-if="this.success.new_fee_percentage">{{this.success.new_fee_percentage}}</small>
                <p class="mb-0 text-center">
                    <label for="fee"> Enter new fee in percentage: </label>
                    <input type="number" min="0" max="100" class="w-100 border text-center p-1 rounded" placeholder="Enter new fee " v-model="new_fee_percentage">                
                    <small class="text-danger">{{this.errors.new_fee_percentage}}</small>
                </p>
                <button class="btn btn-primary px-2 my-2 float-end" v-if="this.new_fee_percentage > 0 && this.new_fee_percentage <= 100" @click.prevent="updateFee(this.account.id)"> <span class="spinner-border spinner-border-sm " v-if="this.spinner.new_fee_percentage"></span> Update fee</button>
            </div>
          </div>

         
          
      </div>
  </div>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";
import SideNav from "../Layouts/SideNav.vue";

export default {
    components:{
            SideNav
        },
    data(){
        return{
            account:{},
            new_fee_percentage:null,
            errors:{},
            success:{},
            spinner:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{
        fetchCommissionsAccount(){
            axios.get('/api/commissions')
            .then(response=>{
                this.account = response.data.data
            })
            .catch(error=>{
                console.log(error.response);
            })
        },
        withdrawAdminFunds(){
            this.success={}
            this.errors={}
            if(!this.getUser.paypal_merchant_id) { alert('Please link your paypal account first in order to process withdrawal'); return;}
            if(parseFloat(this.account.available_balance) < 50) {    alert('Cannot process withdrawal of funds less than 5 USD!');   return;}
            if(! confirm('Do you want to withdraw funds $'+ this.account.available_balance +'?')) return;
           
            this.spinner.withdraw_funds = true;
            axios.get('/api/withdraw/admin-funds')
            .then(response=>{
                this.spinner={}
                this.success.withdraw_funds = 'Success, withdrawal successful'
                this.fetchCommissionsAccount();
            })
            .catch(error=>{
                this.success={}
                this.errors={}
                this.spinner={}
                this.errors.withdraw_funds = 'Error, could not withdraw funds!'
                console.log(error.response);
            });
        },
        generateSigupLink(){
            this.success={}
            this.errors={}
            this.spinner.signup_link = true;
            axios.get('/api/generate-sigup-link')
            .then(response=>{
                this.success.signup_link = 'Success, redirecting...';
                this.spinner={}
                window.location.href= response.data.links[1].href;
            })
            .catch(error=>{
                this.spinner={}
                this.errors.signup_link = 'Error, cannot connect with Paypal. Please try again';
                console.log(error.response);
            });
        },
        updateFee(id){
            this.validateFee();
            if(Object.keys(this.errors).length) return;

            var form_data = new FormData();
            form_data.append('fee_percentage', this.new_fee_percentage);
            form_data.append('_method', 'PUT');

            if(! confirm('Update uswa fee percentage? \n An email notification will be sent to all tutors on the platform regarding this operation.')) return;
            this.spinner.new_fee_percentage = true;

            axios.post('/api/commissions/' + id, form_data)
            .then(response=>{
                console.log(response.data);
                this.success.new_fee_percentage = 'Success, Uswa fee updated';
                this.new_fee_percentage = null;
                this.spinner = {}
                this.fetchCommissionsAccount();
            })
            .catch(error=>{
                this.spinner = {}
                console.log(error.response);
            })
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

        validateFee(){
            this.errors={}
            if(!this.new_fee_percentage) this.errors.new_fee_percentage = "Please enter  fee  percentage"
        },


    },
    mounted(){
        this.fetchCommissionsAccount();
        this.fetchPaypalClientID();
    }
}
</script>

<style>

</style>