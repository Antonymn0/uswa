<template>

   <!-- Review Twin modals  -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Reviews</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div v-if="this.tutor.reviews">
          <div v-for="(review, index) in this.tutor.reviews" :key="index" class="card p-2 my-2">
              <h5>
                  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2rem" v-if="! review.reviewer_image"></i>
                <img v-else :src="review.reviewer_image" alt="profile picture" style="width:30px; height:30px; border-radius:50%">
                &nbsp; {{this.capitalize(review.reviewer_name)}}
                  </h5>
              <p>{{this.capitalize(review.body)}}</p>
              <p class="small text-muted  d-flex justify-content-between m-0 mb-0 p-0">
                  <span class="m-0">
                      <span class="m-0"> <i class="bi bi-star-fill " :class="[review.stars <= 1 ? 'text-muted' : 'text-warning' ]"></i> </span>
                      <span class="m-0"> <i class="bi bi-star-fill " :class="[review.stars <= 2 ? 'text-muted' : 'text-warning' ]"></i> </span>
                      <span class="m-0"> <i class="bi bi-star-fill " :class="[review.stars <= 3 ? 'text-muted' : 'text-warning' ]"></i> </span>
                      <span class="m-0"> <i class="bi bi-star-fill " :class="[review.stars <= 4 ? 'text-muted' : 'text-warning' ]"></i> </span>
                      <span class="m-0"> <i class="bi bi-star-fill" :class="[review.stars <= 5 ? 'text-muted' : 'text-warning' ]"></i> </span>
                  </span>              
                  <span class="m-0">{{this.formatDate(review.created_at)}} </span> </p>            
          </div>
        </div>
        <div>
          <p class="small text-muted text-center py-5"> This tutor has no reviews yet</p>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" v-if="this.isLogedIn">Write a review</button> -->
        <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- ------- small review modal ----------- -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Write a review </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="stars d-flex align-items-center"> 
            <span>Stars: &nbsp; &nbsp;</span>
            <span> <i class="bi bi-star-fill 1 text-muted" id="1" @click.prevent="updateStars(1)"></i> </span>
            <span> <i class="bi bi-star-fill 2 text-muted" id="2" @click.prevent="updateStars(2)"></i> </span>
            <span> <i class="bi bi-star-fill 3 text-muted" id="3" @click.prevent="updateStars(3)"></i> </span>
            <span> <i class="bi bi-star-fill 4 text-muted" id="4" @click.prevent="updateStars(4)"></i> </span>
            <span> <i class="bi bi-star-fill 5 text-muted" id="5" @click.prevent="updateStars(5)"></i> </span> <br>
            <small class="text-danger"> {{errors.stars}} </small>
        </p>
        <textarea  id="" cols="10" rows="5" v-model="this.review" class="w-100 border rounded p-2" placeholder="Write a review"></textarea>
        <small class="text-danger">{{errors.review}}</small>
      </div>
      
      <div class="modal-footer">
        <small class="text-success w-100 text-end">{{this.success.review_submited}}</small>
        <small class="text-danger w-100 text-end">{{this.errors.review_submited}}</small>
        <button class="btn btn-primary"  @click.prevent="submitReview()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.submiting"></span> Submit</button>
        <button class="btn btn-danger" id="back-btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back </button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";
import moment from "moment";

export default {
    props:['tutor'],
    data(){
        return{
            stars:null,
            review: null,
            errors:{},
            success:{},
            spinner:{}
        }
    },
    methods:{        
        formatDate(date){
            if (date)  return moment(String(date)).format('ll ');            
        },
        capitalize(string){
          if(string)  return string.charAt(0).toUpperCase() + string.slice(1);
        },
        updateStars(star_num){
            this.stars = star_num;
            this.toggleStarViewColor(star_num);
        },
        toggleStarViewColor(star_num){
          if(!this.isLogedIn)  this.$router.push({name: 'login'});
            var stars = document.getElementsByClassName('bi-star-fill');
            for(var i =0; i<stars.length; i++ ){
                stars[i].classList.remove('text-warning');
                stars[i].classList.add('text-muted');
            }
            if(star_num == 6) return; //reset value
            for(var i =0; i<stars.length; i++ ){
                stars[i].classList.remove('text-muted');
                stars[i].classList.add('text-warning');
                if(stars[i].classList.contains(star_num)) return;
            }
        },
        submitReview(){
           if(!this.isLogedIn)  this.$router.push({name: 'login'});

            this.validateForm();
            if(Object.keys(this.errors).length) return;
            if(! confirm("Submit this Review?")) return;

            var form_data = new FormData();
            form_data.append('reviewer_id', this.getUser.id );
            form_data.append('reviewee_id', this.tutor.id );
            form_data.append('body', this.review);
            form_data.append('stars', this.stars);

            this.spinner.submiting = true
            axios.post('/api/reviews', form_data)
            .then(response=>{                
                if(response.status == 201){
                    this.success.review_submited= "Success, Review submited."
                    this.spinner={}
                }
                setTimeout(() => {
                    this.stars = null;
                    this.review = null;
                    this.toggleStarViewColor(6);
                    this.errors = {}
                    this.success = {}
                    this.spinner={}                    
                    document.getElementById('back-btn').click();
                }, 3000);
                
            })
            .catch(error=>{
                this.spinner={}
                console.log(error.response);
            });            
        },
        validateForm(){
            this.errors ={}
            if(! this.stars) this.errors.stars = 'Please select number of stars';
            if(! this.review) this.errors.review = 'This field is required';
        }
    },
     computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },

}
</script>

<style scoped>
.stars i{
    font-size:1.5rem;
    cursor: pointer;
}
</style>