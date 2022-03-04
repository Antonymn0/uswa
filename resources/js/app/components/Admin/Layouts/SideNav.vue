<template>
  <div class="parent"> 
    <div class="border-end h-100">
      <h5 class=" mt-3">Admin panel</h5>
      <ul class="list-unstyled ">
        <li> <router-link :to="{name: 'all-users'}" class="px-1" >Users</router-link></li>
        <li> <router-link :to="{name: 'all-lessons'}" class="px-1" >Lessons</router-link></li>
        <li> <router-link :to="{name: 'tutor-review'}" class="px-1" >Tutor review</router-link></li>
        
        <li> link 2</li>
        <li> link c2</li>
        <li> link 2</li>
        <li> link s2</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.parent{
  height:70vh;
}
ul li{
  padding:.3rem;
}

@media only screen and (max-width:750px){
  .parent{
    height:auto;
  }
}
</style>