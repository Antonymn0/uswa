<template>
  <div>
       <div class="mb-3 col-md-6">
            <label for="phone" class="form-label">Search Language or subject </label>
            <span class="d-flex"><input type="text" class="form-control py-3 search-bar " id="phone" placeholder="Subject to learn" v-model="this.language"><button type="button" class="buton ">Search</button> </span>
            <span></span>                 
        </div>

  </div>
</template>

<script>
export default {
    data(){
        return{
            language:null,
        }
    }
}
</script>

<style>
    .search-bar{
        border-radius:20rem 0 0 20rem;
        padding: 0 0 0 1rem;
        
    }
    .buton{
        border-radius:0 20rem 20rem 0;
        padding: 0 1.5rem;
        background-color: rgb(255, 205, 205);
        
    }
    .buton:hover{
        background-color: rgb(245, 80, 80);
        color:#fff;
    }
    .buton:active{
        background-color: rgb(223, 35, 35);
        color:#fff;
    }
    
</style>