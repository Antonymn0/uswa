<template>
  <div class="px-4 pe-5 text-secondary">
    <div class="row "> 
      <div class="col-sm-6">
        <div class="py-3 h-100">
          <div class="card p-3 text-center h-100">
            <!-- --------------------------------------- -->
            <div class="py-3 card mx-2 rounded shadow"> 
            <div class="fw-bold pt-5 "> 
                <h4>Available balance  </h4> 
                <p class="py-3 text-center fw-bold">
                   <span class="m-0">$ </span>
                   <span class="m-0 " v-if="this.getAccount.available_balance">{{this.getAccount.available_balance}}</span>
                   <span class="m-0" v-else >0</span>
                </p>
            </div>
            <div class="pt-3 pb-2"> 
                <!-- <button class="btn btn-lg btn-secondary m-2 px-3 w-75"   @click.prevent="this.getPaypalAccessToken()"> Get paypal token </button> -->
                <small class="text-success" v-if="this.success.signup_link"> <br>{{this.success.signup_link}}</small>
                <small class="text-danger" v-if="this.errors.signup_link"> <br> {{this.errors.signup_link}}</small>
                <button class="btn btn-lg btn-primary m-2 px-3 w-75" v-if=" !this.getUser.paypal_merchant_id && this.getUser.role == 'tutor' "  @click.prevent="this.generateSigupLink()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.signup_link"></span>  Link with paypal </button>
              
               <small class="text-success" v-if="this.success.charge_object"> <br>{{this.success.charge_object}}</small>
                <small class="text-danger" v-if="this.errors.charge_object"> <br> {{this.errors.charge_object}}</small>
               
               <span class="text-center">
                <button class="btn btn-primary p-2 btn-lg m-2 w-75" v-if=" this.getUser.paypal_merchant_id && this.getUser.role == 'tutor' "  @click.prevent="this.withdrawFunds()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.charge_object"></span>Withdraw</button>
                <div class=" mx-auto m-2 w-75" v-if="this.getUser.role == 'student' " >
                    <label class=" text-secondary">Topup via  paypal: </label>
                    <div class="py-2 small">
                        <span>
                            <input type="radio" name="amount" id="5" value='5' v-model="topup_amount" @change.prevent="loadPaypalCheckout()">  
                            <label for="5"> $5 </label> &nbsp;
                        </span>
                        <span> 
                            <input type="radio" name="amount" id="10" value='10' v-model="topup_amount" @change.prevent="loadPaypalCheckout()">  
                            <label for="10"> $10 </label> &nbsp;
                        </span>
                        <span>
                            <input type="radio" name="amount" id="20" value='20' v-model="topup_amount" @change.prevent="loadPaypalCheckout()">  
                            <label for="20"> $20 </label> &nbsp;
                        </span>
                        <span>
                            <input type="radio" name="amount" id="50" value='50' v-model="topup_amount" @change.prevent="loadPaypalCheckout()">  
                            <label for="50"> $50 </label> &nbsp;
                        </span>
                        <span>
                            <input type="radio" name="amount" id="100" value='100' v-model="topup_amount" @change.prevent="loadPaypalCheckout()">  
                            <label for="100"> $100 </label> &nbsp;
                        </span>                        
                    </div>
                    <div id="paypal-button-container"></div> 
                </div>  
               </span>
            </div> 
            </div> 
            <!-- ------------------------------------------------------ -->
            <div class="pt-5">
                <h4> Latest transactions</h4>
                <div v-if="Object.keys(this.current_transactions).length"> 
                    <div class="border rounded px-2 py-1 my-1" v-for="(transaction, index) in  this.current_transactions" :key="index" v-show="index < 5">
                        <p class="d-flex mb-0 justify-content-between">
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
          </div> 
           
          <!-- ------------------------------------------------------------------------- -->
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
                    <div class="pt-3 px-1">   
                        <div v-if="Object.keys(this.current_transactions).length">          
                            <div class="border small rounded px-1  my-1" v-for="(transaction, index) in  this.current_transactions" :key="index">
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
                                        <span class="m-0">Amount: &nbsp; </span>
                                        <span class="m-0 fw-bold"> $</span>
                                        <span class="m-0 fw-bold">{{transaction.amount_transacted}}</span>
                                    </p>                                
                                </div>
                            
                                <p class="small text-start mb-0  d-flex justify-content-between">
                                    <span>Remarks: {{this.capitalize(transaction.remarks)}}</span>                                    
                                    <span class="">Status:  {{transaction.status}}</span>
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
            paypal_client_id:'',
            paypal_sdk_url:'',
            spinner:{},
            errors:{},
            success:{},
            topup_amount:10,
            selected_country_code:null,
            selected_country_name:null,
            countries:{
                    "AF": "Afghanistan",
                    "AX": "Aland Islands",
                    "AL": "Albania",
                    "DZ": "Algeria",
                    "AS": "American Samoa",
                    "AD": "Andorra",
                    "AO": "Angola",
                    "AI": "Anguilla",
                    "AQ": "Antarctica",
                    "AG": "Antigua And Barbuda",
                    "AR": "Argentina",
                    "AM": "Armenia",
                    "AW": "Aruba",
                    "AU": "Australia",
                    "AT": "Austria",
                    "AZ": "Azerbaijan",
                    "BS": "Bahamas",
                    "BH": "Bahrain",
                    "BD": "Bangladesh",
                    "BB": "Barbados",
                    "BY": "Belarus",
                    "BE": "Belgium",
                    "BZ": "Belize",
                    "BJ": "Benin",
                    "BM": "Bermuda",
                    "BT": "Bhutan",
                    "BO": "Bolivia",
                    "BA": "Bosnia And Herzegovina",
                    "BW": "Botswana",
                    "BV": "Bouvet Island",
                    "BR": "Brazil",
                    "IO": "British Indian Ocean Territory",
                    "BN": "Brunei Darussalam",
                    "BG": "Bulgaria",
                    "BF": "Burkina Faso",
                    "BI": "Burundi",
                    "KH": "Cambodia",
                    "CM": "Cameroon",
                    "CA": "Canada",
                    "CV": "Cape Verde",
                    "KY": "Cayman Islands",
                    "CF": "Central African Republic",
                    "TD": "Chad",
                    "CL": "Chile",
                    "CN": "China",
                    "CX": "Christmas Island",
                    "CC": "Cocos (Keeling) Islands",
                    "CO": "Colombia",
                    "KM": "Comoros",
                    "CG": "Congo",
                    "CD": "Congo, Democratic Republic",
                    "CK": "Cook Islands",
                    "CR": "Costa Rica",
                    "CI": "Cote D\"Ivoire",
                    "HR": "Croatia",
                    "CU": "Cuba",
                    "CY": "Cyprus",
                    "CZ": "Czech Republic",
                    "DK": "Denmark",
                    "DJ": "Djibouti",
                    "DM": "Dominica",
                    "DO": "Dominican Republic",
                    "EC": "Ecuador",
                    "EG": "Egypt",
                    "SV": "El Salvador",
                    "GQ": "Equatorial Guinea",
                    "ER": "Eritrea",
                    "EE": "Estonia",
                    "ET": "Ethiopia",
                    "FK": "Falkland Islands (Malvinas)",
                    "FO": "Faroe Islands",
                    "FJ": "Fiji",
                    "FI": "Finland",
                    "FR": "France",
                    "GF": "French Guiana",
                    "PF": "French Polynesia",
                    "TF": "French Southern Territories",
                    "GA": "Gabon",
                    "GM": "Gambia",
                    "GE": "Georgia",
                    "DE": "Germany",
                    "GH": "Ghana",
                    "GI": "Gibraltar",
                    "GR": "Greece",
                    "GL": "Greenland",
                    "GD": "Grenada",
                    "GP": "Guadeloupe",
                    "GU": "Guam",
                    "GT": "Guatemala",
                    "GG": "Guernsey",
                    "GN": "Guinea",
                    "GW": "Guinea-Bissau",
                    "GY": "Guyana",
                    "HT": "Haiti",
                    "HM": "Heard Island & Mcdonald Islands",
                    "VA": "Holy See (Vatican City State)",
                    "HN": "Honduras",
                    "HK": "Hong Kong",
                    "HU": "Hungary",
                    "IS": "Iceland",
                    "IN": "India",
                    "ID": "Indonesia",
                    "IR": "Iran, Islamic Republic Of",
                    "IQ": "Iraq",
                    "IE": "Ireland",
                    "IM": "Isle Of Man",
                    "IL": "Israel",
                    "IT": "Italy",
                    "JM": "Jamaica",
                    "JP": "Japan",
                    "JE": "Jersey",
                    "JO": "Jordan",
                    "KZ": "Kazakhstan",
                    "KE": "Kenya",
                    "KI": "Kiribati",
                    "KR": "Korea",
                    "KP": "North Korea",
                    "KW": "Kuwait",
                    "KG": "Kyrgyzstan",
                    "LA": "Lao People\"s Democratic Republic",
                    "LV": "Latvia",
                    "LB": "Lebanon",
                    "LS": "Lesotho",
                    "LR": "Liberia",
                    "LY": "Libyan Arab Jamahiriya",
                    "LI": "Liechtenstein",
                    "LT": "Lithuania",
                    "LU": "Luxembourg",
                    "MO": "Macao",
                    "MK": "Macedonia",
                    "MG": "Madagascar",
                    "MW": "Malawi",
                    "MY": "Malaysia",
                    "MV": "Maldives",
                    "ML": "Mali",
                    "MT": "Malta",
                    "MH": "Marshall Islands",
                    "MQ": "Martinique",
                    "MR": "Mauritania",
                    "MU": "Mauritius",
                    "YT": "Mayotte",
                    "MX": "Mexico",
                    "FM": "Micronesia, Federated States Of",
                    "MD": "Moldova",
                    "MC": "Monaco",
                    "MN": "Mongolia",
                    "ME": "Montenegro",
                    "MS": "Montserrat",
                    "MA": "Morocco",
                    "MZ": "Mozambique",
                    "MM": "Myanmar",
                    "NA": "Namibia",
                    "NR": "Nauru",
                    "NP": "Nepal",
                    "NL": "Netherlands",
                    "AN": "Netherlands Antilles",
                    "NC": "New Caledonia",
                    "NZ": "New Zealand",
                    "NI": "Nicaragua",
                    "NE": "Niger",
                    "NG": "Nigeria",
                    "NU": "Niue",
                    "NF": "Norfolk Island",
                    "MP": "Northern Mariana Islands",
                    "NO": "Norway",
                    "OM": "Oman",
                    "PK": "Pakistan",
                    "PW": "Palau",
                    "PS": "Palestinian Territory, Occupied",
                    "PA": "Panama",
                    "PG": "Papua New Guinea",
                    "PY": "Paraguay",
                    "PE": "Peru",
                    "PH": "Philippines",
                    "PN": "Pitcairn",
                    "PL": "Poland",
                    "PT": "Portugal",
                    "PR": "Puerto Rico",
                    "QA": "Qatar",
                    "RE": "Reunion",
                    "RO": "Romania",
                    "RU": "Russian Federation",
                    "RW": "Rwanda",
                    "BL": "Saint Barthelemy",
                    "SH": "Saint Helena",
                    "KN": "Saint Kitts And Nevis",
                    "LC": "Saint Lucia",
                    "MF": "Saint Martin",
                    "PM": "Saint Pierre And Miquelon",
                    "VC": "Saint Vincent And Grenadines",
                    "WS": "Samoa",
                    "SM": "San Marino",
                    "ST": "Sao Tome And Principe",
                    "SA": "Saudi Arabia",
                    "SN": "Senegal",
                    "RS": "Serbia",
                    "SC": "Seychelles",
                    "SL": "Sierra Leone",
                    "SG": "Singapore",
                    "SK": "Slovakia",
                    "SI": "Slovenia",
                    "SB": "Solomon Islands",
                    "SO": "Somalia",
                    "ZA": "South Africa",
                    "GS": "South Georgia And Sandwich Isl.",
                    "ES": "Spain",
                    "LK": "Sri Lanka",
                    "SD": "Sudan",
                    "SR": "Suriname",
                    "SJ": "Svalbard And Jan Mayen",
                    "SZ": "Swaziland",
                    "SE": "Sweden",
                    "CH": "Switzerland",
                    "SY": "Syrian Arab Republic",
                    "TW": "Taiwan",
                    "TJ": "Tajikistan",
                    "TZ": "Tanzania",
                    "TH": "Thailand",
                    "TL": "Timor-Leste",
                    "TG": "Togo",
                    "TK": "Tokelau",
                    "TO": "Tonga",
                    "TT": "Trinidad And Tobago",
                    "TN": "Tunisia",
                    "TR": "Turkey",
                    "TM": "Turkmenistan",
                    "TC": "Turks And Caicos Islands",
                    "TV": "Tuvalu",
                    "UG": "Uganda",
                    "UA": "Ukraine",
                    "AE": "United Arab Emirates",
                    "GB": "United Kingdom",
                    "US": "United States",
                    "UM": "United States Outlying Islands",
                    "UY": "Uruguay",
                    "UZ": "Uzbekistan",
                    "VU": "Vanuatu",
                    "VE": "Venezuela",
                    "VN": "Vietnam",
                    "VG": "Virgin Islands, British",
                    "VI": "Virgin Islands, U.S.",
                    "WF": "Wallis And Futuna",
                    "EH": "Western Sahara",
                    "YE": "Yemen",
                    "ZM": "Zambia",
                    "ZW": "Zimbabwe"
                    }

        }
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
           this.$store.dispatch('fetchLocalAccount');
         },
        getPaypalAccessToken(){
            axios.get('/api/get-paypal-access-token')
            .then(response=>{
                // console.log(response.data);
            })
            .catch(error=>{
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
        fetchPaypalClientID(){
            axios.get('/api/get-paypal-clientId')
            .then(response=>{
                this.paypal_client_id = response.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        withdrawFunds(){
            this.success={}
            this.errors={}
            if(!this.getUser.paypal_merchant_id) { alert('Please link your paypal account first in order to process withdrawal'); return;}
            if(this.getAccount.available_balance < 50) {alert('Cannot process withdrawal of funds less than $50!'); return;}
            
            if(! confirm('Do you want to withdraw funds?')) return;
            this.spinner.charge_object = true;
            axios.get('/api/paypal-payment')
            .then(response=>{
                this.spinner={}
                this.success.charge_object = 'Success, withdrawal successful'
                this.$store.dispatch('fetchLocalAccount');

            })
            .catch(error=>{
                this.success={}
                this.errors={}
                this.spinner={}
                this.errors.charge_object = 'Error, could not withdraw funds!'
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
            },
        loadAsync(url, callback) {
            var s = document.createElement('script');
            s.setAttribute('src', url); s.onload = callback;
            document.head.insertBefore(s, document.head.firstElementChild);
        },
        loadPaypalCheckout(){
            var amount = this.topup_amount;
            this.loadAsync('https://www.paypal.com/sdk/js?client-id=' + this.paypal_client_id + '&intent=authorize&disable-funding=credit,card', function() {
                
                paypal.Buttons({
                    style: {
                        layout:  'vertical',
                        color:   'blue',
                        shape:   'rect',
                        label:   'paypal',
                        height:50
                    },

                    // Set up the transaction
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    currency_code: "USD",
                                    value: amount
                                },                                
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
                        axios.post('/api/update/local-account', authorization )
                        .then(response=>{ 
                            window.location.reload();
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
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    mounted(){
        this.fetchPaypalClientID();
        this.fetchAccount();
        this.fetchTransactionHistory();       
        setTimeout(() => { if(this.getUser.role == 'student' ) this.loadPaypalCheckout() }, 1000);
    }

}
</script>

<style>

</style>