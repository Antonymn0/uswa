<template>
  <div class="parent-header d-flex justify-content-between  border-bottom px-3">
    <div class="d-flex justify-content-start align-items-center">
      <div class="d-flex py-4 "> 
        <span> <h2>USWA</h2> </span>  
      </div>
      <div class="pl-3">
         <ul class="list-unstyled d-flex  ">
          <li class="px-3"><a href="#">Find a Tutor</a></li>
          <li class="px-3"><a href="#">Become a Tutor</a></li>
          <li class="px-3 desktop"><a href="#">FAQs</a></li>
        </ul>
      </div>
    </div>

    <div class="d-flex align-items-center">     
      <div class="px-2 desktop">
      <router-link :to="{name: 'frontpage'}">Home</router-link>
      </div>
      <div class="p-4 border-right desktop">
       Language | currency
      </div>
      <div class="px-2 desktop">
        Help
      </div>
      
      <div class="px-3 desktop">
        <router-link :to="{name: 'login'}" class="px-1">Login</router-link>
        <router-link :to="{name: 'register'}" class="px-1">Register</router-link>
        <a href="#" class="px-1" @click.prevent="this.logout()">Logout</a>
      </div>
      <div> <MobileNav /> </div>
    </div>
  </div>
  <div class="w-100">
      <router-view></router-view>
  </div>
  
</template>

<script>
import MobileNav from "../../Navigation/MobileNav.vue";
export default {
  components:{
    MobileNav
  },
  methods:{
    logout(){
      console.log(this.$store.state.user.user);
      axios.post('/api/logout', {
        headers: {
            'Accept': 'application/json',
            Authorization: "Bearer " + this.$store.state.user.user.token
             }
        })
      .then(response=>{
        console.log(response)
      })
      .catch(error=>{
        console.log(error.response);
      });
      // this.$store.commit('unsetUser', user=null);
    }
  }

}
</script>

<style scoped>

@media screen and (max-width: 750px){
      .desktop{
        display:none;
      }
}
  

</style>