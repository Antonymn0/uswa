<template>
  <div>
       <div class="mb-3 col-md-6">
            <label for="phone" class="form-label">Search Language or subject </label>
            <input type="text" class="form-control py-2 rounded" id="phone" placeholder="Subject to learn" v-model="this.language">                        
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

</style>