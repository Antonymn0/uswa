<template>
<Header />
  
</template>

<script>
import Header from './Layouts/Header.vue';

export default {
  components:{
    Header,
  },
  mounted(){
    this.$router.push({name: 'frontpage'});
  }

}
</script>

<style scoped>
.parent{
  color: #3c4447;
    font-family: Poppins,Montserrat,-apple-system,BlinkMacSystemFont,Helvetica,Arial,sans-serif;
}
.bold{
  font-weight:700;
  font-size:40px;
}
.semi-bold{
  font-weight:500;
  font-size:35px;
}
.tutors{
  margin-left: 4%;
  margin-right: 4%;
  background-color:#ffff ;
  color:#3c4447;
}
.tutors .tutor-panels{
  width:33%;
  float:left;
  padding:4rem;
  background-color:#ffff ;
  display:flex;
  border:1px solid rgba(240, 238, 240, 0.623)
}
.lang-icon{
  border:3px solid #3bb3bd;
  color:#3bb3bd;
  border-radius:50%;
  padding-right:7px;
  padding-left:7px;
  padding-top:8px;
  padding-bottom:5px;
  font-weight:600;
  margin-right:.7rem;
}
.tutors .title{
  font-weight:600;
}
.tutors small{
  font-weight:100;
  color:#6f757b;
}

</style>