<template>

   <!-- Review Twin modals  -->
  <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered text-muted">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Reviews</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div v-if="Object.keys(this.tutor.reviews).length">
          <div v-for="(review, index) in this.tutor.reviews" :key="index" class="card p-2 my-2">
              <p class=" d-flex align-items-center fw-bold mb-0">
                  <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2rem" v-if="! review.reviewer_image"></i>
                <img v-else :src="review.reviewer_image" alt="profile picture" style="width:30px; height:30px; border-radius:50%">
                &nbsp; {{this.capitalize(review.reviewer_name)}}
                  </p>
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
        <div v-else>
          <p class="small text-muted text-center py-5"> This tutor has no reviews yet</p>
        </div>
      </div>
      <div class="modal-footer">
       
        <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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