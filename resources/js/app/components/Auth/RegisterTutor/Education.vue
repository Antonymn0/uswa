<template>
    <div>
        <h4>Education</h4>
        <p>Tell students more about the higher education that you've completed or are working on</p>
        <div>
            <div class="mb-3 ">
                <label for="institution" class="form-label">Institution </label>
                <input type="text" class="form-control" id="institution">
            </div>
            <div class="mb-3 ">
                <label for="level" class="form-label">Level </label>
                <input type="text" class="form-control" id="level">
            </div>
            <div class="mb-3 ">
                <label for="type" class="form-label">Type </label>
                <input type="text" class="form-control" id="type">
            </div>
            <div class="mb-3 ">
                <label for="specialty" class="form-label">Specialty </label>
                <input type="text" class="form-control" id="specialty">
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
                    <label for="imageHcert" class="btn btn-secondary"> Upload certificate</label> <br>
                    <small>Format: jpg,png,jpeg,svg </small> <br> 
                    <small class="#"> Max:10mb </small> 
                      
                    <input type="file"  hidden name="image" class=" btn-sm btn alert-danger text-white m-2"  id="imageHcert"    @change="this.fileUpload($event)">
                </div>
                <div class="col-md-6 ">
                    <img :src="form.img_preview" alt="" class=" " style="width:100px; height:105px" v-if="form.img_preview"> 
                </div>
            </div>
            <div class="form-check p-3">
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
            document.getElementById('education').classList.add('hidden');
            document.getElementById('certification').classList.remove('hidden');
        },
        nextStep(){
            document.getElementById('education').classList.add('hidden');
            document.getElementById('video').classList.remove('hidden');
        },
        fileUpload(event){
            this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
        },
    }
}
</script>

<style>

</style>