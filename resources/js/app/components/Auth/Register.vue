<template>
  <div class="px-2 py-5">
      <form action="#" @submit.prevent="registerUser()" class="mx-auto rounded shadow pt-3">
        <div class="imgcontainer">
            <h2>Register</h2>
        </div>      

        <div class="container">
            <label for="name"><b>Full name</b></label>
            <input type="text" id="name" placeholder="Full name" v-model="form.full_name" required>
            <small class="text-danger">{{this.errors.full_name}}</small> <br>          

            <label for="uname"><b>Email</b></label>
            <input type="email" placeholder="Enter Username" v-model="form.email" required>
            <small class="text-danger">{{this.errors.email}}</small> <br>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" v-model="form.password" required>
            <small class="text-danger">{{this.errors.password}}</small> <br>

            <label for="psw"><b>Confirm Password </b></label>
            <input type="password" placeholder="Enter Password" v-model="form.password_again" required @input.prevent="matchPassword()">
            <small class="text-danger">{{this.errors.password_again}}</small> <br>

            <button type="submit">  <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner"></span> Register</button>
           
        </div>

        <div class="container d-flex" >
            <button type="button" class="cancelbtn m-2 rounded form-control" @click.prevent="()=>{this.$router.push({name: 'frontpage'})}">Cancel</button>
            <button type="button" class="cancelbtn m-2 rounded form-control" @click.prevent="()=>{this.$router.push({name: 'login'})}">Go to Login</button>
            
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
            full_name:null,
            email:null,
            password:null, 
            password_again:null,
            role:'student',
        },
        spinner:false,
        errors:{} , 
        regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/, 
    }
},
methods:{
    registerUser(){
        this.validateForm();
        if(Object.keys(this.errors).length) return;

        var form_data = new FormData();
            form_data.append('full_name', this.form.full_name);
            form_data.append('email', this.form.email);
            form_data.append('password', this.form.password);
            form_data.append('password_again', this.form.password_again);
            form_data.append('role', this.form.role);
        this.spinner =true;
        axios.post('api/register', form_data ,{
          headers:{
            'accept':'application/json'
          }
        })
        .then(response=>{
            if(response.status == 201){   
                this.spinner=false;            
                this.$router.push({name: 'login'})
            }
            this.spinner=false; 
        })
        .catch(error=>{
          this.spinner=false; 
            if(error.response.status == 422){
                this.errors.email = error.response.data.errors.email[0];
                return;
            }
            console.log(error.response);
        })
    },
    matchPassword(){
        if(this.form.password !== this.form.password_again) this.errors.password_again = "Password does not match";
        else delete this.errors.password_again;
    },
    validateForm(){
        this.errors={};
        if(!this.form.full_name) this.errors.full_name = "Please enter your full name";
        if(!this.form.email) this.errors.email = "Email is required";
        if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email' ;
        if(!this.form.password) this.errors.password = "Password is required";
        if(!this.form.password_again) this.errors.password_again = "Please confirm password";
        if(this.form.password !== this.form.password_again) this.errors.password_again = "Password does not match";
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
input[type=email], input[type=text], input[type=password] {
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
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}

</style>