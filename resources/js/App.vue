<template>
 <Header />
  
</template>

<script>
import {mapState} from 'vuex';


import Header from './app/components/Layouts/Header.vue'
export default {
  components:{   
    Header
  },
  computed:{
    token(){
      return this.$store.state.token;
    },    
  },
  methods:{
    checkIfUserIsAuthenitcated(){
      if(! this.$store.state.token.token) return;
      let token = this.$store.state.token.token;
      axios.get('/api/check-user-authenticated', { headers: { 'Authorization': 'Bearer ' + token } })
      .then(response => {
          if(response.status == 200){
            this.$store.commit('setUser', response.data.user);
            console.log("Success " + response.data.message);
          }
      })
      .catch(error=>{
        console.log(error.response);
      })
    }
  },
  mounted(){
    this.$router.push({name: 'home'});
    this.checkIfUserIsAuthenitcated();
  }
}
</script>

<style>


</style>