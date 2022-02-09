<template>
    <div class="bg-white ">
        <h4>Profile photo</h4>
         <h5>Make a great first impression</h5>
         <p>Tutors who look friendly and professional get the most students </p>
        <div class="">        
            <div class=" ">
                <label for="imageInput" class="btn btn-secondary"> Select photo</label> <small> Max:2mb </small> | <small>Format: jpg,png,jpeg,svg </small>  
                <input type="file" hidden  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="imageInput"    @change="this.fileUpload($event)">
            </div>

            <div class=" row  mt-3 ">                  
                <div class="col-md-6  border-end d-flex align-items-center justify-content-center">
                    <img :src="form.img_preview" alt="" class="shadow  rounded-circle " style="width:180px; height:170px" v-if="form.img_preview"> 
                </div>  
                <div class="col-md-6 ">
                    <h5 class="p-2">Tips for taking a good photo</h5>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Smile and look at the camera</span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Frame your head and shoulders </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Your photo is centered and upright </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Use neutral lighting and background </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Your face and eyes are fully visible </span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> Avoid logos or contact information</span> <br>
                    <span class="p-2"> <i class="bi bi-check-circle"></i> You are the only person in the photo</span> <br>
                </div>   
            <div class="text-center pt-5 pb-2">
                <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
                <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Next</button>
            </div>           
            </div>
        </div>         
    </div>
</template>

<script>
export default {
data(){
    return{
        form:{
            img_preview:'',
        }
    }
},
methods:{
    fileUpload(event){
        this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
    },
    nextStep(){
        document.getElementById('photo').classList.add('hidden');
        document.getElementById('certification').classList.remove('hidden');
    },
    backStep(){
        document.getElementById('photo').classList.add('hidden');
        document.getElementById('about').classList.remove('hidden');
    }
}
}
</script>

<style>
    
</style>