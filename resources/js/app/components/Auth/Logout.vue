<template> 
    <span>
        <a href="#" class="px-1" @click.prevent="this.logout()" v-if=" isLogedIn">Logout <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner"></span> </a> 
    </span>
     
</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    data(){
        return{
            spinner:false,
        }
    },
    methods:{
        logout(){
            let token = this.$store.state.token.token;
            this.spinner =true;
            axios.get('/api/logout', {  headers: {   'Authorization': 'Bearer ' + token } })
            .then(response=>{
                if(response.status == 200){
                    this.spinner =false;
                    this.$store.commit('unsetToken', response.data);
                    this.$store.commit('unsetUser', response.data);
                }
            })
            .catch(error=>{
                this.spinner =false;
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