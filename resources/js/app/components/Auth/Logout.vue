<template> 
    <span  v-if=" isLogedIn">
        <a href="#" class="dropdown-item" @click.prevent="this.logout()" v-if=" isLogedIn">Logout <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner"></span> </a> 
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
            axios.get('/api/logout')
            .then(response=>{
                if(response.status == 200){
                    this.spinner =false;
                    this.$store.commit('unsetToken', token=null);
                    this.$store.commit('unsetUser', response.data);
                    this.$router.push({name: 'home'});
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