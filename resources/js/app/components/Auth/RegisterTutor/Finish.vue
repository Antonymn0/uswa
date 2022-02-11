<template>
    <div class="py-5">
        <h3 class="">Finish setup</h3>
        <p> 
            Thankyou for going through the signup process. <br>
            At USWA, we take great pride in our tutors and hence the rigorous process. <br>
            The information you share with us is safe and we do not share it with third parties. <br>
            Please click the complete signup button to save the changes. <br>
            You can go back and review before submiting. <br> 
           
        </p>
        <div class="text-center pt-5 pb-2">
            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-secondary m-1" @click.prevent="this.cancelSignup()">Cancel</button>
            <button class="btn btn-danger m-1" @click.prevent="completeSignup()">Complete Signup</button>
        </div>
    </div>
</template>

<script>
export default {
    computed:{
       //
    },
    methods:{
        backStep(){
            document.getElementById('finish').classList.add('hidden');
            document.getElementById('availability').classList.remove('hidden');
        },
       
        cancelSignup(){
            if(! confirm('Are you sure you want to cancel the signup process? \n All the changes you have made will be lost.')) return;
           
            this.$router.push({name:'home'});
        },
        completeSignup(){
            this.$router.push({name: 'tutor-dashboard'});
        }
    }
}
</script>

<style>

</style>