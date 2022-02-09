<template>
  <div class="mx-auto input-form">
       <h4>About you</h4>
       <div class="mx-auto">
           <form action="">
               <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname">
                </div>
               <div class="mb-3">
                    <label for="middlename" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middlename">
                </div>
               <div class="mb-3">
                    <label for="lastame" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastame">
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="timezone" class="form-label">Timezone</label>
                        <input type="text" class="form-control" id="timezone">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="currency" class="form-label">Currency</label>
                        <input type="text" class="form-control" id="currency">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" id="language">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" class="form-control" id="level">
                    </div>
                </div>

                <div class="mb-3 ">
                    <label for="level" class="form-label">Subject to teach</label>
                    <input type="text" class="form-control" id="level">
                </div>
                <div class="mb-3 ">
                    <label for="phone" class="form-label">Phone </label>
                    <input type="text" class="form-control" id="phone">
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" >
                    <label class="form-check-label" for="disabledFieldsetCheck">Im am over 18 </label>
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
methods:{
    nextStep(){
        document.getElementById('about').classList.add('hidden');
        document.getElementById('photo').classList.remove('hidden');
    }
}
}
</script>

<style>

</style>