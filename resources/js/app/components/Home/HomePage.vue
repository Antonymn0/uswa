<template>
<div class="parent">
  <div class="row pb-3 pt-5 mx-4">
    <div  class="col-md-6">
      <div class="px-auto pt-3">
        <span class="bold mx-auto">
         Speak a new language with confidence
        </span> <br>
        <span class="semi-bold mx-auto">
          with the best online tutors.
        </span>
      </div>      
      </div>
    <div class="col-md-6 text-right"><img src="https://static.preply.com/static/ssr/_next/static/images/hero-image-mobile-480-6f3bf0d176f9763ef4eca2f53c1bce25.webp" alt="" style="max-width:90%"></div>
  </div>
  <!-- --------------------- -->
  <div>    
    <div class="tutors rounded">
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>
      <div class="tutor-panels">
        <span class="lang-icon"> EN </span>
        <span>
          <span class="title"> English Tutors </span> <br>
          <small>200 Tutors </small>
        </span>               
      </div>    
    </div>
    </div>
    <!-- ------------------------------------------ -->
    <div class="my-5 mx-5">
      <h3 class="text-center fw-bold py-5">Learn a new language the easy way</h3>
        <div>
          <ul class="row list-unstyled ">
            <li class="col-md-4">
              <h4>Expert native speakers</h4>
              <p>
                Find native speakers with expert knowledge and excelent ratings
              </p>
            </li>
            <li class="col-md-4">
              <h4>Learn anytime anywhere</h4>
              <p>
                Tutors are available virtualy 24/7. 
              </p>
            </li>
            <li class="col-md-4">
              <h4>Affordable rates</h4>
              <p>
                Tutors are available with affordable rates to suit your pocket. 
              </p>
            </li>
          </ul>
        </div>
    </div>
    <!-- -------------------------------------------------- -->
  
</div>
  
</template>

<script>


export default {
  components:{
    //
  }

}
</script>

<style scoped>
.parent{
  color: #3c4447;
    font-family: Poppins,Montserrat,-apple-system,BlinkMacSystemFont,Helvetica,Arial,sans-serif;
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
}
.tutors .tutor-panels{
  width:33%;
  float:left;
  padding:4rem;
  background-color:#ffff ;
  display:flex;
  border:1px solid rgba(240, 238, 240, 0.623)
}
.lang-icon{
  border:3px solid #3bb3bd;
  color:#3bb3bd;
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
}

</style>