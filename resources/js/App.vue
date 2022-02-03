<template>
 <Home />
</template>

<script>
import {mapState} from 'vuex';

import Home from './app/components/Home/Home.vue'
export default {
  components:{
    Home
  },
  computed:{
    token(){
      return this.$store.state.token;
    }
  },
  mounted(){
    console.log(this.$store.state.user);
  }
}
</script>

<style>

</style>