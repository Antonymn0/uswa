<template>
  <div>
       <div class="mb-3 col-md-6">
            <label for="phone" class="form-label">Search Language or subject </label>
            <span class="d-flex"><input type="text" class="form-control py-3 search-bar " id="phone" placeholder="Subject to learn" v-model="this.search_language"><button type="button" class="buton " @click.prevent="this.searchTutor()">Search</button> </span>
            <span></span>                 
        </div>

  </div>
</template>

<script>
export default {
    data(){
        return{
            search_language:null,
        }
    },
    methods:{
        searchTutor(){
            if(! this.search_language) return;
            axios.get('/api/search-tutors/' +  this.search_language)             
            .then(response=>{ console.log(response.data);
                this.$emit('searchTutors', response.data.data.data, this.search_language ); //pass results to parent
            })
            .catch(error=>{              
                console.log(error.response);
            })
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
        background-color: #CC0000;
        color:#fff;
        
    }
    .buton:hover{
        background-color: rgb(243, 47, 47);
        color:#fff;
    }
    .buton:active{
        background-color: rgb(223, 35, 35);
        color:#fff;
    }
    
</style>