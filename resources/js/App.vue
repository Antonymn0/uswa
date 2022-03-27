<template>
 <Header />
  
</template>

<script>
import {mapGetters } from "vuex";

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
  computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },
  methods:{
    checkIfUserIsAuthenitcated(){
      if(! this.$store.state.token.token) return;
      let token = this.$store.state.token.token;
      axios.get('/api/check-user-authenticated', { headers: { 'Authorization': 'Bearer ' + token } })
      .then(response => {
          if(response.status == 200){
            this.$store.commit('setUser', response.data.user);            
            //redirect user
            if(this.getUser.role == 'student') this.$router.push({name: 'student-dashboard'});
            if(this.getUser.role == 'tutor') this.$router.push({name: 'tutor-dashboard'});
            if(this.getUser.role == 'admin') this.$router.push({name: 'all-users'});

            this.$store.dispatch('fetchLocalAccount');
          }
      })
      .catch(error=>{
        console.log(error.response);
      })
    },

  },
  mounted(){
    this.$router.push({name: 'home'});
    this.checkIfUserIsAuthenitcated();
  }
}
</script>

<style>


</style>