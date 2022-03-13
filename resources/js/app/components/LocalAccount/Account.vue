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
                   <!-- <span class="m-0" v-if="this.getAccount">{{this.getAccount.available[0].amount}}</span> -->
                   <span class="m-0" >0</span>
                </p>
            </div>
            <div class="pt-3 pb-2">                 
                
                <button class="btn btn-lg btn-secondary m-2 px-3 w-75"   @click.prevent="this.getPaypalAccessToken()"> Get paypal token </button>
                <small class="text-success" v-if="this.success.signup_link"> <br>{{this.success.signup_link}}</small>
                <small class="text-danger" v-if="this.errors.signup_link"> <br> {{this.errors.signup_link}}</small>
                <button class="btn btn-lg btn-secondary m-2 px-3 w-75"   @click.prevent="this.generateSigupLink()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.signup_link"></span>  Link with paypal </button>
              
               <small class="text-success" v-if="this.success.charge_object"> <br>{{this.success.charge_object}}</small>
                <small class="text-danger" v-if="this.errors.charge_object"> <br> {{this.errors.charge_object}}</small>
                <button class="btn btn-lg btn-secondary m-2 px-3 w-75"   @click.prevent="this.createPaypalChargeObject()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.charge_object"></span> Create Paypal charge object</button>
               
                <div class="w-75 mx-auto" id="paypal-button-container"></div>
               
               <br> <button class="btn btn-lg btn-secondary m-2 px-5"> Topup </button>
                <button class="btn btn-lg btn-secondary m-2 px-5"> Withdraw</button> <br>

                <button class="btn btn-lg btn-secondary m-2 px-3 w-75"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" v-if="! this.getUser.stripe_account_id">  Link with Stripe </button>
                <small class="text-success p-2">{{this.success.create_charge}}</small>
                <button class="btn btn-lg btn-secondary m-2 px-5" @click.prevent="createChargeObject()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.create_charge"></span> Create stripe Charge object</button>
                <br>
                <small class="text-success p-2">{{this.success.checkout_session}}</small>
                <button class="btn btn-lg btn-secondary m-2 px-5" @click.prevent="createCheckoutSession()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.checkout_session"></span> stripe Checkout</button>
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
          </div> 
            <!-- -------------------------countries modal----------------------------------- -->
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Link with Stripe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="form-group py-3"> 
                            <small class="alert-danger p-2 rounded m-2" v-if="this.errors.stripe_fail"> Your country {{this.selected_country_name}} <br> {{this.errors.stripe_fail}} <br></small>                
                            <label for="country" class="fw-bold py-1"> Select Your country:</label>
                            <select class="w-100 bg-white border rounded p-3" id="country" v-model="this.selected_country_code" > 
                                <option :value="index" v-for="(country, index) in this.countries" :key="index" > {{country}} </option>
                            </select> 
                            <small class="text-danger p-2" v-if="this.errors.selected_country">{{this.errors.selected_country}}</small>   

                        </div>
                    </div>
                    <div class="text-end p-3 float-end">
                        <small class="text-success p-3" v-if="this.success.stripe_success">{{this.success.stripe_success}} <br> </small>
                        <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary m-1" @click.prevent="registerStripeConnectAccount()"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.link_with_stripe"></span>  Submit</button>
                    </div>
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
            spinner:{},
            errors:{},
            success:{},
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
        createChargeObject(){
            this.errors={}
            this.spinner.create_charge = true
            axios.get('/api/create-stripe-charge-object')
                .then(response=>{
                    this.spinner={}
                    this.success.create_charge = "Charge successful"
                    console.log(response.data);
                })
                .catch(error=>{
                    this.spinner={}
                    console.log(error.response);
                });
        },
        createCheckoutSession(){
            this.errors={}
            this.spinner.checkout_session= true
            axios.get('/api/create-stripe-checkout-session')
                .then(response=>{
                    this.spinner={}
                    console.log(response.data);
                    this.success.checkout_session = "Session created, Redirecting...."
                    console.log(response.data);
                    window.location.href= response.data.url;
                })
                .catch(error=>{
                    this.spinner={}
                    console.log(error.response);
                });
        },
        fetchAccount(){
            axios.get('/api/get-stripe-account-balance')
                .then(response=>{
                    this.$store.commit('set_account', response.data);
                    console.log(response.data);
                })
                .catch(error=>{
                    console.log(error.response);
                });
         },
        getPaypalAccessToken(){
            axios.get('/api/get-paypal-access-token')
            .then(response=>{
                console.log(response.data);
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
        createPaypalChargeObject(){
            this.success={}
            this.errors={}
            this.spinner.charge_object = true;
            axios.get('/api/paypal-payment')
            .then(response=>{
                this.spinner={}
                this.success.charge_object = 'Success, Paypal Charge object created'
                console.log(response.data);

            })
            .catch(error=>{
                this.errors.charge_object = 'Error, could not create charge object!'
                console.log(error.response);
            });
        },
        registerStripeConnectAccount(){
            this.errors={}
            if(!this.selected_country_code) {this.errors.selected_country="Please select your country"; return;}
            this.spinner.link_with_stripe = true
            axios.get('/api/register-stripe-connect-account/'+ this.selected_country_code)
            .then( response=>{   
                this.spinner={}                          
                this.success.stripe_success = "Success, redirecting...."; 
                window.location.href = response.data.url; 
            })
            .catch(error=>{
                this.spinner={} 

                var sel = document.getElementById("country");
                this.selected_country_name = sel.options[sel.selectedIndex].text;

                this.errors.stripe_fail = error.response.data.message
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
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    mounted(){
        this.fetchAccount();
        this.fetchTransactionHistory();

function loadAsync(url, callback) {
  var s = document.createElement('script');
  s.setAttribute('src', url); s.onload = callback;
  document.head.insertBefore(s, document.head.firstElementChild);
}
        loadAsync('https://www.paypal.com/sdk/js?client-id=sb&currency=USD', function() {
  paypal.Buttons({

    // Set up the transaction
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.01'
                }
            }]
        });
    },

    // Finalize the transaction
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Show a success message to the buyer
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
    }

  }).render('#paypal-button-container');
});
    }

}
</script>

<style>

</style>