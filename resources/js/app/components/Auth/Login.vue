<template>
  <div class="px-2 py-5 w-100">
      <form action="#" @submit.prevent="loginUser()" class="mx-auto rounded shadow ">
        <div class="imgcontainer">
            <img src="/images/avatar_login.png" alt="Avatar" class="avatar">
        </div>
        <h2 class=text-center>Login</h2>
        <div class="text-center my-2" v-if="this.errors.credentials">
            <span class="alert-danger py-2 px-5">
               {{this.errors.credentials}}
            </span> 
        </div>

        <div class="container">
            <label for="uname"><b>Email</b></label>
            <input type="email" placeholder="Enter Username" v-model="form.email" required>
            <small class="text-danger">{{this.errors.email}}</small> <br>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" v-model="form.password" required>
            <small class="text-danger">{{this.errors.password}}</small> <br>

            <button type="submit"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner"></span> Login</button>
            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" >
            <button type="button" class="cancelbtn m-2 rounded" @click.prevent="()=>{this.$router.push({name: 'frontpage'})}">Cancel</button>
            <button type="button" class="cancelbtn m-2 rounded" @click.prevent="()=>{this.$router.push({name: 'register'})}">Register</button>
            <span class="psw"> <a href="password/reset">Forgot password?</a></span>
        </div>
        </form>

  </div>
</template>

<script>
import axios from 'axios';

export default {
data(){
    return{
        form:{
           email:null,
           password:null 
        },
        spinner:false,
        errors:{} , 
        regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/, 
    }
},
methods:{
    loginUser(){
        this.validateForm();
        if(Object.keys(this.errors).length) return;
        var form_data = new FormData();
        form_data.append('email', this.form.email);
        form_data.append('password', this.form.password);

        this.spinner=true;
        axios.post('api/login', form_data )
        .then(response=>{
            this.$store.commit('setToken', response.data.token);
            this.$store.commit('setUser', response.data.user);
            this.spinner=false;
            this.$router.push({name: 'student-dashboard'});
        })
        .catch(error=>{
          this.spinner=false;
            if(error.response.status == 401){
              this.$store.commit('unsetUser', error.response.data);
              this.errors.credentials = error.response.data.message;
            }
            console.log(error.response);
        })
    },
    validateForm(){
        this.errors={};
        if(!this.form.email) this.errors.email = "Email is required";
        if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email' ;
        if(!this.form.password) this.errors.password = "Password is required";
        if(this.form.password.length < 4) this.errors.password = "Password must be atleast 4 characters";
    }

}

}
</script>

<style scoped>

/* Bordered form */
form {
    width:30rem;
    max-width:98%;    
    background-color:#fefefe;  
}

/* Full-width inputs */
input[type=email], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 15%;
  border-radius: 50%;
  margin-top:-1.2rem;
  padding-bottom:.5rem;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
  
}
span.psw:hover {
  text-decoration: underline;
  
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 600px) {
    form {    
        width:100vw;      
    }
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}

</style>