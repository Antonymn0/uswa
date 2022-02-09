<template>
  <div>
      <h3>Teaching certification</h3>
      <p>Do you have teaching certificates? If so, describe them to enhance your profile credibility and get more students.</p>
      <div>
            <div class="mb-3 ">
                <label for="subject" class="form-label">Subject </label>
                <input type="text" class="form-control" id="subject">
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="certificate" class="form-label">Certificate </label>
                    <input type="text" class="form-control" id="certificate">
                </div>
                <div class="mb-3 col-md-6">
                <label for="issuedby" class="form-label">Issued by </label>
                <input type="text" class="form-control" id="issuedby">
            </div>
            </div>
            
            <div class="mb-3 ">
                <label for="description" class="form-label">Description </label>
                <input type="text" class="form-control" id="description">
            </div>
            
            <div>
                <h5>Years of study</h5>
                <div class="row"> 
                    <div class="mb-3 col-md-6">
                        <label for="from" class="form-label">From </label>
                        <input type="text" class="form-control" id="from">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="to" class="form-label">To </label>
                        <input type="text" class="form-control" id="to">
                    </div>
                   
                </div>
            </div>
            <div class="row align-items-center py-2">
                <div class="col-md-6 text-center">
                    <label for="imagecert" class="btn btn-secondary"> Upload certificate</label> <br>
                    <small>Format: jpg,png,jpeg,svg </small> <br> 
                    <small class="#"> Max:10mb </small> 
                      
                    <input type="file"  hidden name="image" class=" btn-sm btn alert-danger text-white m-2"  id="imagecert"    @change="this.fileUpload($event)">
                </div>
                <div class="col-md-6 ">
                    <img :src="form.img_preview" alt="" class=" " style="width:100px; height:105px" v-if="form.img_preview"> 
                </div>
            </div>
             
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" >
                <label class="form-check-label" for="disabledFieldsetCheck">I dont have any certification </label>
            </div> 
      </div>
      <div class="text-center pt-5 pb-2">
        <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
        <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Next</button>
    </div> 
  </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                img_preview:null,
            }
        }
    },
    methods:{
        backStep(){
            document.getElementById('certification').classList.add('hidden');
            document.getElementById('photo').classList.remove('hidden');
        },
        nextStep(){
            document.getElementById('certification').classList.add('hidden');
            document.getElementById('education').classList.remove('hidden');
        },
        fileUpload(event){
            this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
        },
    }
}
</script>

<style>

</style>