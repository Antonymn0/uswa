<template>
<div class="">
   <div class="row  pt-5 mx-4 top align-items-center h-100">
    <div  class="col-md-7 py-5 h-100">
      <div class="ps-4 h-100 py-5 d-flex align-items-center" >       
        <span class="align-middle " >
            <h1 class="fw-bold mx-auto " style="font-size:4rem;"> Speak a new language with confidence  </h1>  
            <h5 class="semi-bold mx-auto " style="font-size:3rem;">  Learn with the best online tutors.  </h5>
          </span>   
      </div>      
      </div>
    <div class="col-md-5 text-right h-100"><img src="/images/cover.png" alt="" style="max-width:100%; height:auto"></div>
  </div> 


    <!-- ------------------------------------------ --> 
      <div class=" p-5 new-language">
      <h1 class="text-center fw-bold py-5">Learn a new language the easy way</h1>
        <div class="pb-5">
          <ul class="row list-unstyled text-center">
            <li class="col-md-4">
              <h4 class="text-center">Expert native speakers</h4>
              <p>
                Find native speakers with expert knowledge and excelent ratings
              </p>
            </li>
            <li class="col-md-4">
              <h4 class="text-center">Learn anytime anywhere</h4>
              <p>
                Tutors are available virtualy 24/7. 
              </p>
            </li>
            <li class="col-md-4">
              <h4 class="text-center">Affordable rates</h4>
              <p>
                Tutors are available with affordable rates to suit your pocket. 
              </p>
            </li>
          </ul>
        </div>
    </div>  
    <!-- -------------------------------------------------- -->
     <div class="clearfix p-5 how_uswa_works fw-bold">
      <h1 class="text-center py-2 fw-bold ">How Uswa works</h1>

    <div class="row mx-5 py-4 how-uswa-work clearfix align-items-center">      
        <div class="col-md-6">
          <h1 class="fw-bold"> Find the best tutor</h1> 
          <p>Choose from a pool of seasoned online tutors. <br>
            Use filters to narrow your search and find the perfect fit </p>        
        </div>
        <div class="col-md-6">
          <img src="/images/find_the_best_tutor.png" alt="image">
        </div>
      </div>

      <div class="row mx-5 py-3 how-uswa-work clearfix align-items-center">  
        <div class="col-md-6 ">
          <img src="/images/lessons_anytime.png" alt="image">
        </div>   
        <div class="col-md-6 ">
          <h1 class="fw-bold">Take lessons anytime anywhere </h1> 
          <p>Find the perfect time for your busy schedule. <br>
            Book a lessons in seconds on our platform </p>        
        </div>      
      </div>

      <div class="row mx-5 py-3 how-uswa-work clearfix align-items-center">     
        <div class="col-md-6">
          <h1 class="fw-bold">Enter virtual classroom </h1> 
          <p>When it’s lesson time, <br>
          connect with your tutor through zoom video platform </p>        
        </div>
        <div class="col-md-6">
          <img src="/images/enter_virtual_classroom.png" alt="image">
        </div>
      </div>   

  </div> 
  <p class="text-center py-5">
    <router-link :to="{name: 'register'}" class=" btn btn-danger rounded-pill px-5 py-3" v-if="! isLogedIn">Register now</router-link> 
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
.how_uswa_works{
  font-size: 22px;
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
}
.how-uswa-work img{
  width:35rem; 
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

/* media quesries */
@media only screen and (max-width: 950px) {
    .tutors .tutor-panels{
        width:50%;
        
    }
}
/* media quesries */
@media only screen and (max-width: 600px) {
    .tutors .tutor-panels{
        width:100%;       
    }
    .top {
      margin-left: 5px !important;
      margin-right: 5px !important;
    }
    .tutors{
      margin-left: 1%;
      margin-right: 1%;
      margin-bottom:5rem !important;      
    }
    .how-uswa-work{
      text-align: center;
    }
    .new-language {
    padding-left: 8px !important;
    padding-right: 8px !important;
    padding-top:5rem;
  }
    .new-language h3{  
      margin-top:5rem;
      margin-bottom: 1.2rem;
    }
    .mx-5{
      margin-right:3px !important;
      margin-left:3px !important;
    }
}

</style>