<template>
  <div class="px-4 pe-5">
    <div class="row "> 
      <div class="col-sm-6">
        <div class="py-3 h-100">
          <div class="card p-3 text-center h-100">
            <!-- --------------------------------------- -->
            <div class="fw-bold pt-5"> 
                <h4>Availbale balance  </h4> 
                <p class="py-3 text-center">
                   <span class="m-0">$</span>
                   <span class="m-0">{{this.getAccount.available_balance}}</span>
                </p>
            </div>
            <div class="pt-3 pb-2" >
                <div class="btn btn-lg btn-secondary m-2 px-4"> Withdraw</div>
                <div class="btn btn-lg btn-secondary m-2 px-5"> Topup </div>
            </div> 
            <!-- ------------------------------------------------------ -->
            <div class="pt-5">
                <h5> Latest transactions</h5>
                <div v-if="Object.keys(this.current_transactions).length"> 
                    <div class="border rounded px-2 py-1 my-1" v-for="(transaction, index) in  this.current_transactions" :key="index" >
                        <p class="d-flex justify-content-between">
                            <span>{{this.formatDate(transaction.transaction_date)}}</span>
                            <span>{{this.capitalize(transaction.transaction_type)}}</span>    
                            <span>
                                <span class="m-0">Amount &nbsp; &nbsp;</span>
                                <span class="m-0"> $</span>
                                <span class="m-0">{{transaction.amount_transacted}}</span>
                            </span>                
                        </p>
                    </div>  
                </div>  
                <div v-else>
                    <p class="text-center text-muted py-5">You have not made any transactions yet</p>
                </div>              
            </div>   
            <!-- ------------------------------------------------------------ -->
          </div>
        </div>
      </div>

      <!-- ============================ Transaction history ======================================================= -->
      <div class="col-sm-6"> 
            <div class="py-3 h-100">
                <div class="card p-3 text-center h-100">
                    <!-- --------------------------------------- -->
                    <div class="fw-bold pt-5"> 
                        <h4>Transaction history  </h4> 
                        <p class="text-muted small"> All Your transaction history will apprear here</p>                    
                    </div>
                    <div class="pt-3 px-2">   
                        <div v-if="Object.keys(this.current_transactions).length">          
                            <div class="border rounded px-2 py-1 my-1" v-for="(transaction, index) in  this.current_transactions" :key="index">
                                <p class="d-flex justify-content-between mb-0">
                                    <span>{{this.formatDateTime(transaction.transaction_date)}}</span>
                                    <span>{{this.capitalize(transaction.transaction_type)}}</span>                    
                                </p>
                                <div class="d-flex justify-content-between align-content-center">
                                    <p class="text-start my-auto ">
                                        <span >From: </span> <span class="m-0">{{this.capitalize(transaction.transacted_from)}}</span> <br>
                                        <span >To: </span> <span>{{this.capitalize(transaction.transacted_to)}}</span>
                                    </p>
                                    <p class="d-flex my-auto align-content-center pe-3">
                                        <span class="m-0">Amount &nbsp; </span>
                                        <span class="m-0"> $</span>
                                        <span class="m-0">{{transaction.amount_transacted}}</span>
                                    </p>                                
                                </div>
                            
                                <p class="small text-start  ">
                                    <span>Remarks: </span>
                                    <span>{{this.capitalize(transaction.remarks)}}</span>
                                </p>
                            </div>  
                        </div>  
                        <div v-else>
                            <p class="text-center text-muted py-5 mt-3">You have not made any transactions yet</p>
                        </div>            
                    </div>   
                    <!-- ------------------------------------------------------------ -->
                </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters } from "vuex";
import moment from "moment"; 

export default {
    data(){
        return{
            transactions:{},
            current_transactions:{},
            current_transaction:{},

        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{
        formatDate(date){
            if (date) return moment(String(date)).format('ll');            
        },
        formatDateTime(date){
            if (date) return moment(String(date)).format('llll');            
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        fetchAccount(){
            axios.get('/api/get-account-balance')
                .then(response=>{
                this.$store.commit('set_account', response.data.data);
                console.log('Account fetched');
                })
                .catch(error=>{
                    console.log(error.response);
                });
            },
        fetchTransactionHistory(){
            axios.get('/api/get-transaction-history')
                .then(response=>{ 
                    this.transactions =  response.data.data.data;
                    this.current_transactions = this.transactions; 
                })
                .catch(error=>{
                    console.log(error.response);
                });
            }
    },
    mounted(){
        this.fetchAccount();
        this.fetchTransactionHistory();
    }

}
</script>

<style>

</style>