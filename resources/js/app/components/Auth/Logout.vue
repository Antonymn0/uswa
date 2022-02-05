<template>
  <div>
       <a href="#" class="px-1" @click.prevent="this.logout()" v-if=" isLogedIn">Logout</a>
  </div>
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    methods:{
        logout(){
            let token = this.$store.state.token.token;
            axios.get('/api/logout', {  headers: {   'Authorization': 'Bearer ' + token } })
            .then(response=>{
                if(response.status == 200){
                this.$store.commit('unsetToken', response.data);
                this.$store.commit('unsetUser', response.data);
                }
                console.log(response)
            })
            .catch(error=>{
                console.log(error.response);
            });
            }
            },
            computed:{
                ...mapGetters(["isLogedIn"]),    
        },
        mounted(){
            this.$router.push({name: 'home'});
        }
}
</script>

<style>

</style>