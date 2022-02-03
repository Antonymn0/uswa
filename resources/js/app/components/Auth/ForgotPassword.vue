<template>
  <div>
      forgot password
      <div>
          <form action="">
              <p class="alert-success">{{this.success.resetlink}}</p>
              <label for="email">Enter your email address</label>
              <input type="email"  id="email" v-model="form.email"><br>
              <small class="text-danger ">{{this.errors.email}}</small>
              <button  type="submit" class="btn btn-danger px-4">Reset passwordd</button>
          </form>
      </div>
 </div>
 
</template>

<script>
export default {
data(){
    return{
        form:{
            email:null
        },
        errors:{},
        success:{}
    }
},
methods:{
    submitForm(){
        this.validateForm();
        if(Object.keys(this.errors).length) return;
        var form_data = new FormData();
        form_data.append('email', this.form.email);
        axios.post('api/reset-passord', form_data)
        .then(response=>{
            if(response.status == 200){
                console.log(response);

            }
        })
    },
    validateForm(){
        this.errors={};
        if(!this.form.email) this.errors.email = "Email is required";
        if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email' ;
    }
}
}
</script>

<style>

</style>