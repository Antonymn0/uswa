<template>
  <div class="mx-auto input-form">
       <h4>About you</h4>
       <div class="mx-auto">
           <form action="">
               <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname" v-model="first_name">
                    <small class="text-danger small">{{this.errors.first_name}}</small>
                </div>
               <div class="mb-3">
                    <label for="middlename" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middlename" v-model="middle_name">
                    <small class="text-danger small">{{this.errors.middle_name}}</small>
                </div>
               <div class="mb-3">
                    <label for="lastame" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastame" v-model="last_name">
                    <small class="text-danger small">{{this.errors.last_name}}</small>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" v-model="country">
                        <small class="text-danger small">{{this.errors.country}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" v-model="city">
                        <small class="text-danger small">{{this.errors.city}}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="timezone" class="form-label">Timezone</label>
                        <input type="text" class="form-control" id="timezone" v-model="timezone">
                        <small class="text-danger small">{{this.errors.timezone}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="currency" v-model="currency">
                        <small class="text-danger small">{{this.errors.currency}}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" id="language" v-model="language">
                        <small class="text-danger small">{{this.errors.language}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control" id="level" v-model="level">
                        <small class="text-danger small">{{this.errors.level}}</small>
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="subject" class="form-label">Subject to teach</label>
                    <input type="text" class="form-control" id="subject" v-model="subject">
                    <small class="text-danger small">{{this.errors.subject}}</small>
                </div>
                <div class="mb-3 ">
                    <label for="phone" class="form-label">Phone </label>
                    <input type="text" class="form-control" id="phone" v-model="phone">
                    <small class="text-danger small">{{this.errors.phone}}</small>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" v-model="over18">
                    <label class="form-check-label" for="disabledFieldsetCheck">Im am over 18 </label> <br>
                    <small class="text-danger small">{{this.errors.over18}}</small>
                </div>

                <div class="text-center py-3">
                    <button class="btn btn-secondary m-1">Cancel</button>
                    <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Continue</button>
                </div>
           </form>
       </div>
   </div>
</template>

<script>


export default {
    data(){
        return{
            errors:{},
        }
    },
    
    computed:{
        first_name:{
            get() { return this.$store.state.signupProcess_about.about.first_name; },
            set(value) { this.$store.commit('set_first_name', value); }
        },
        middle_name:{
            get() { return this.$store.state.signupProcess_about.about.middle_name;  },
            set(value) {  this.$store.commit('set_middle_name', value);  }
        },
        last_name:{
            get() {  return this.$store.state.signupProcess_about.about.last_name; },
            set(value) { this.$store.commit('set_last_name', value); }
        },
        country:{
            get() {  return this.$store.state.signupProcess_about.about.country;  },
            set(value) {  this.$store.commit('set_country', value);  }
        },
        city:{
            get() {  return this.$store.state.signupProcess_about.about.city;},
            set(value) {  this.$store.commit('set_city', value); }
        },
        timezone:{
            get() {  return this.$store.state.signupProcess_about.about.timezone; },
            set(value) {  this.$store.commit('set_timezone', value);}
        },
        currency:{
            get() { return this.$store.state.signupProcess_about.about.currency;},           
            set(value) {  this.$store.commit('set_currency', value); }
        },
        language:{
            get() { return this.$store.state.signupProcess_about.about.language;},           
            set(value) {  this.$store.commit('set_language', value); }
        },
        level:{
            get() { return this.$store.state.signupProcess_about.about.level;},           
            set(value) { this.$store.commit('set_level', value); }
        },
        subject:{
            get() { return this.$store.state.signupProcess_about.about.subject;},           
            set(value) {  this.$store.commit('set_subject', value); }
        },
        phone:{
            get() { return this.$store.state.signupProcess_about.about.phone;},           
            set(value) {  this.$store.commit('set_phone', value); }
        },
        over18:{
            get() { return this.$store.state.signupProcess_about.about.over18;},           
            set(value) {  this.$store.commit('set_over18', value); }
        },
    },
     methods:{
        logFile(){
            console.log(this.$store.state.signupProcess_about.about);
        },
        nextStep(){            
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('about').classList.add('hidden');
            document.getElementById('photo').classList.remove('hidden');
        },
        validateForm(){
            this.errors={};
            if(! this.$store.state.signupProcess_about.about.first_name) this.errors.first_name = "First name field is required";            
            if(! this.$store.state.signupProcess_about.about.middle_name) this.errors.middle_name = "Middle name field is required";           
            if(! this.$store.state.signupProcess_about.about.last_name) this.errors.last_name = "Last name field is required";
           
            if(! this.$store.state.signupProcess_about.about.country) this.errors.country = "County field is required";
            if(! this.$store.state.signupProcess_about.about.city) this.errors.city = "City field is required";
            
            if(! this.$store.state.signupProcess_about.about.timezone) this.errors.timezone = "timezone field is required";
            if(! this.$store.state.signupProcess_about.about.currency) this.errors.currency = "Currency field is required";
            
            if(! this.$store.state.signupProcess_about.about.language) this.errors.language = "Language field is required";
            if(! this.$store.state.signupProcess_about.about.level) this.errors.level = "Level field is required";
            if(! this.$store.state.signupProcess_about.about.subject) this.errors.subject = "Subject field is required";
            
            if(! this.$store.state.signupProcess_about.about.phone) this.errors.phone = "Phone field is required";
            if(! this.$store.state.signupProcess_about.about.over18) this.errors.over18 = "Confirm you are an adult";
        }
    },
    mounted(){
       
    }

}
</script>

<style>

</style>