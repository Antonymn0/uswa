<template>
<div class="">
   <div class="row landing-text align-items-center ms-4 top  h-100" >
    <div  class="col-md-7 pb-3 h-100">  
            <h1 class="fw-bold mx-auto header-h1" > Discover a new way of learning  </h1>  
            <h5 class="semi-bold mx-auto header-h2">  Learn with the best online tutors.  </h5>               
      </div>
    <div class="col-md-5 text-right align-items-center pt-4  h-100"><img src="/images/cover.png" alt="" style="width:100%; height:100%"></div>
  </div> 

    <!-- ------------------------------------------ --> 
      <div class=" p-5 new-language h-100">
      <h1 class="text-center fw-bold pt-5 pb-2">Learn at ease</h1>
        <div class="py-4">
          <ul class="row list-unstyled text-center">
            <li class="col-md-4">          
              <font-awesome-icon :icon="['far', 'chess-queen']" />
              <h3 class="text-center">   Expert tutors</h3>
              <p>
                Learn from the most best tutors in the world  
              </p>
            </li>
            <li class="col-md-4">
             <font-awesome-icon :icon="['far', 'clock']" />
              <h3 class="text-center">Learn anytime anywhere</h3>
              <p>
                Tutors are available virtualy 24/7. 
              </p>
            </li>
            <li class="col-md-4"> 
              <font-awesome-icon :icon="['far', 'credit-card']" />
              <h3 class="text-center">Affordable rates</h3>
              <p>
                Tutors are available with affordable <br> rates to suit your pocket. 
              </p>
            </li>
          </ul>
        </div>
    </div>  
    <!-- -------------------------------------------------- -->
     <div class="clearfix p-5 mx-auto ms-3 how_uswa_works fw-bold text-center">
      <h1 class=" py-2 fw-bold ">How Uswa works</h1>

    <div class="row mx-5 py-4 how-uswa-work mx-auto clearfix align-items-center">      
        <div class="col-md-6  ">
          <h2 class="fw-bold py-2 "> Find the best tutor</h2> 
          <p class="text-secondary text-justify ">Choose from a pool of seasoned online tutors. 
            Use filters to narrow your search and find the perfect fit </p>        
        </div>
        <div class="col-md-6 text-center">
          <img src="/images/find_the_best_tutor.png" alt="image">
        </div>
      </div>

      <div class="row mx-5 py-3 mx-auto how-uswa-work clearfix align-items-center desktop">  
        <div class="col-md-6 text-center">
          <img src="/images/lessons_anytime.png" alt="image">
        </div>   
        <div class="col-md-6 ">
          <h2 class="fw-bold py-2">Take lessons anytime, anywhere </h2> 
          <p class="text-secondary">Find the perfect time for your busy schedule. 
            Book a lessons in seconds on our platform </p>        
        </div>      
      </div>

      <div class="row mx-5 py-3 mx-auto how-uswa-work clearfix align-items-center mobile">          
        <div class="col-md-6 ">
          <h2 class="fw-bold py-2">Take lessons anytime, anywhere </h2> 
          <p class="text-secondary">Find the perfect time for your busy schedule. 
            Book a lessons in seconds on our platform </p>        
        </div> 
        <div class="col-md-6 text-center">
          <img src="/images/lessons_anytime.png" alt="image">
        </div>     
      </div>    

      <div class="row mx-5 py-3 mx-auto how-uswa-work clearfix align-items-center ">     
        <div class="col-md-6">
          <h2 class="fw-bold py-2">Enter virtual classroom </h2> 
          <p class="text-secondary">When it’s lesson time, 
          connect with your tutor through zoom video platform </p>        
        </div>
        <div class="col-md-6 text-center">
          <img src="/images/enter_virtual_classroom.png" alt="image">
        </div>
      </div>   

  </div> 
  <p class="text-center py-5">
    <router-link :to="{name: 'register'}" class=" btn background-red text-white rounded-pill px-5 py-3" v-if="! isLogedIn">Register now</router-link> 
  </p>
    
</div> 
  
</template>

<script>

export default {
  components:{
    
  },
  data(){
    return{
      pranth_results:'',
      test_string: ' [ {} {[()]} ([] )]' 
    }
  },
  methods:{
    testPranth(string){
      var opening_brackets = '{[(';
      var closing_brackets = ')]}';
      
      var opening_stack =[];
      var closing_stack =[];
      for(var i=0; i<string.length; i++){
        if(opening_brackets.includes(string[i])) opening_stack.push(string[i]);
        if(closing_brackets.includes(string[i])) closing_stack.push(string[i]);
      }
      // closing_stack.reverse(); // align the indexes
      console.log(opening_stack);
      console.log(closing_stack);

      if(opening_stack.length == closing_stack.length) console.log("Brackets balanced");
      else console.log("Brackets not balanced");

      this.pranth_results = string;
    },
    checkAuth(){
      axios.get('/api/check-user-authenticated')
      .then(response => {
        console.log(response);
      })
      .catch(error => {
        console.log(error.response);
      });
    }
  },
  mounted(){
    // this.checkAuth();
  }

}
</script>

<style scoped>
.landing-text{
  padding:0 3rem  0 3rem; 
}
.header-h1{
    font-size:4rem;    
}
.header-h2{
    font-size:3rem;
    
}
.new-language svg{
  font-size:4.4rem;
  margin-bottom:1.3rem;
  color: #6f7072;
  width:auto;
  max-width:100%;
}
.how_uswa_works{
  font-size: 20px;
}
.new-language{
  background-color:#fff;
  
}
.parent{
  color: #3c4447;
  font-family: Helvetica,Arial,sans-serif;
  width:100%;
}
.bold{
  font-weight:700;
  font-size:40px;
}
.semi-bold{
  font-weight:500;
  font-size:35px;
}
.tutors{
  margin-left: 4%;
  margin-right: 4%;
  background-color:#ffff ;
  color:#3c4447;
  height:100vh;
  overflow:hidden;
}
.how_uswa_works img{
    padding:3.5rem;    
}

.tutors .tutor-panels{
  width:33.33%;
  
  padding:4rem;
  background-color:#ffff ;
  display:flex;
  border:1px solid rgba(240, 238, 240, 0.623)
}
.lang-icon{
  border-radius:50%;
  padding-right:7px;
  padding-left:7px;
  padding-top:8px;
  padding-bottom:5px;
  font-weight:600;
  margin-right:.7rem;
}
.tutors .title{
  font-weight:600;
}
.tutors small{
  font-weight:100;
  color:#6f757b;
}

.how-uswa-work{
  margin-left:2rem;
  margin-right:2rem;
  text-align: left;
}
.how-uswa-work p{
  text-align: justify;
  width:auto;
  max-width:31rem;
  margin: auto;
  padding-right:2.5rem;
}
.how-uswa-work h1, .how-uswa-work h2{
  width:auto;
  max-width:31rem;
  margin: auto;
}
.how-uswa-work img{
  width:auto; 
  max-width:100%;
}
.flags{
  margin-left: 5rem;
  margin-right: 5rem;
}
.flags span{
  width:3rem;
  margin:1rem;
  margin-bottom: 2rem;
}

.number{
  text-align: left;
  background-color: #d61e1ef3;
  color: #fff;
  border-radius:50%;
  padding:0.8rem 1.2rem;
  margin:auto;
  font-weight:500;
  font-size:1.2rem;
}
.mobile{
      display:none;
    }



/* media quesries */
@media only screen and (max-width: 750px) {
  .landing-text{
  padding:1.5rem 0; 
}
  .header-h1{
    font-size:3rem;
    padding:0;
  }
  .header-h2{
      font-size:2rem;
      padding:0;
  }
  .new-language svg{
    font-size:2.8rem;
    margin-top:1.2rem;
    margin-bottom:.1rem;
    color: #6f7072;
  }
    .mobile{
      display:inline-block;
    }
    .desktop{
      display:none;
    }
    .tutors .tutor-panels{
        width:100%;        
    }
    .top {
      margin-left: 1px !important;
      margin-right: 1px !important;
    }
    .tutors{
      margin-left: 1%;
      margin-right: 1%;
      margin-bottom:5rem !important;      
    }
    .how-uswa-work{
      text-align: center;
    }
    .how_uswa_works img{
        padding:.7rem 0;    
    }
    .how-uswa-work p{  
      padding-right:0;
    }
    .new-language {
      padding-left: 8px !important;
      padding-right: 8px !important;
      padding-top:5rem;
    }
    .new-language h3{  
      margin-top:.5rem;
      margin-bottom: 1.1rem;
    }
    .ps-4{
      padding-left:5px !important;
    }
    .mx-5{
      margin-right:3px !important;
      margin-left:3px !important;
    }
    .p-5{
      padding: 5px !important;
    }
    .ms-3{
      margin-left: 0 !important;
    }
}

</style>