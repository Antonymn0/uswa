<template>
  <div>
      <h3 class="py-3">Teaching certification</h3>
      <p>Do you have any teaching certificates? <br> If so, describe them to enhance your profile credibility and get more students.</p>
      <div>
            <div class="mb-3 ">
                <label for="subject" class="form-label">Subject </label>
                <input type="text" class="form-control" id="subject" v-model="subject">
                <small class="text-danger small">{{this.errors.subject}}</small>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="certificate" class="form-label">Certificate </label>
                    <input type="text" class="form-control" id="certificate" v-model="certificate">
                    <small class="text-danger small">{{this.errors.certificate}}</small>
                </div>
                <div class="mb-3 col-md-6">
                <label for="issuedby" class="form-label">Issued by </label>
                <input type="text" class="form-control" id="issuedby" v-model="issued_by">
                <small class="text-danger small">{{this.errors.issued_by}}</small>
            </div>
            </div>
            
            <div class="mb-3 ">
                <label for="description" class="form-label">Description </label>
                <input type="text" class="form-control" id="description" v-model="description">
                <small class="text-danger small">{{this.errors.description}}</small>
            </div>
            
            <div class="py-2">
                <h5>Years of study</h5>
                <div class="row"> 
                    <div class="mb-3 col-md-6">
                        <label for="from" class="form-label">From </label>
                        <input type="date" class="form-control" id="from" v-model="study_from">
                        <small class="text-danger small">{{this.errors.study_from}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="to" class="form-label">To </label>
                        <input type="date" class="form-control" id="to" v-model="study_to">
                        <small class="text-danger small">{{this.errors.study_to}}</small>
                    </div>
                   
                </div>
            </div>
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center">
                    <label for="imagecert" class="btn btn-secondary"> Upload certificate</label> <br>
                    <small>Format: jpg,png,jpeg,svg </small> <br> 
                    <small class="#"> Max:10mb </small> 
                      
                    <input type="file"  hidden name="image" class=" btn-sm btn alert-danger text-white m-2"  id="imagecert"    @change="this.fileUpload($event)">
                </div>
                <div class="col-md-6 ">
                    <span style="position:relative" v-if="this.img_preview"> <i class="bi bi-x-circle text-danger shadow rounded-circle pb-0" @click="removeImage()" style="font-size:1.5rem; position:absolute; left:9rem; top:-3rem; cursor:pointer"></i></span> 
                    <img :src="this.img_preview" alt="" class=" " style="width:100px; height:105px" v-if="this.img_preview"> 
                    <small class="text-danger small shadow p-2">{{this.errors.image}}</small>
                </div>
            </div>
             
            <div class="form-check pt-3">
                <input class="form-check-input  text-secondary" type="checkbox" id="disabledFieldsetCheck" v-model="i_dont_have_certificate">
                <label class="form-check-label  text-secondary" for="disabledFieldsetCheck">I dont have any certification </label>
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
            errors:{},
        }
    },
    computed:{
        img_preview:{
            get() { return this.$store.state.signupProcess_certification.certification.img_preview; },
            set(value) { this.$store.commit('set_certificate_img_preview', value); }
        },
        image:{
            get() { return this.$store.state.signupProcess_certification.certification.image; },
            set(value) { this.$store.commit('set_certificate_image', value); }
        },
        subject:{
            get() { return this.$store.state.signupProcess_certification.certification.subject; },
            set(value) { this.$store.commit('set_subject', value); }
        },
        certificate:{
            get() { return this.$store.state.signupProcess_certification.certification.certificate; },
            set(value) { this.$store.commit('set_certificate', value); }
        },
        issued_by:{
            get() { return this.$store.state.signupProcess_certification.certification.issued_by; },
            set(value) { this.$store.commit('set_issued_by', value); }
        },
        description:{
            get() { return this.$store.state.signupProcess_certification.certification.description; },
            set(value) { this.$store.commit('set_description', value); }
        },
        study_from:{
            get() { return this.$store.state.signupProcess_certification.certification.study_from; },
            set(value) { this.$store.commit('set_study_from', value); }
        },
        study_to:{
            get() { return this.$store.state.signupProcess_certification.certification.study_to; },
            set(value) { this.$store.commit('set_study_to', value); }
        },
        i_dont_have_certificate:{
            get() { return this.$store.state.signupProcess_certification.certification.i_dont_have_certificate; },
            set(value) { this.$store.commit('set_i_dont_have_certificate', value); }
        },
    },
    methods:{
        backStep(){
            document.getElementById('certification').classList.add('hidden');
            document.getElementById('photo').classList.remove('hidden');
        },
        nextStep(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('certification').classList.add('hidden');
            document.getElementById('education').classList.remove('hidden');
        },
        
        fileUpload(event){             
            this.image = event.target.files[0];            
            if(this.image.size > 2048 * 1024){
              this.errors.image = "Image too big: Select an image less than 2mb."; 
              this.image = null;
              return;
            } 
            if(this.image['type'] === 'image/jpeg' || this.image['type'] === 'image/jpg' || this.image['type'] === 'image/png' || this.image['type'] === 'image/svg' || this.image['type'] === 'image/gif'){
                this.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
                delete this.errors.image
                return;
            } 
            else {
                this.errors.image = "Error:  Allowed types jpg/png/jpeg/gif";
                this.img_preview = null;
                this.image = null;
            }
        },
        removeImage(){
            this.img_preview = null;
            this.image = null;
        },
        validateForm(){
            this.errors = {};  
            if(this.i_dont_have_certificate) return; 
            
            if(!this.image) this.errors.image = 'Certificate is required';
            if(!this.subject) this.errors.subject = 'Subject field is required';
            if(!this.certificate) this.errors.certificate = 'Certificate field is required';

            if(!this.issued_by) this.errors.issued_by = 'This field is required';
            if(!this.description) this.errors.description = 'This field is required';

            if(!this.study_from) this.errors.study_from = 'This field is required';
            if(!this.study_to) this.errors.study_to = 'This field is required';
        }
    }
}
</script>

<style>

</style>