<template>
    <div>
        <h4 class="py-3">Education</h4>
        <p>Tell students more about the higher education that you've completed or undertaking</p>
        <div>
            <div class="mb-3 ">
                <label for="institution" class="form-label">Institution </label>
                <input type="text" class="form-control" id="institution" v-model="institution">
                <small class="text-danger small p-2">{{this.errors.level}}</small>
            </div>
            <div class="mb-3 ">
                <label for="level" class="form-label">Level </label>
                <input type="text" class="form-control" id="level" v-model="level">
                <small class="text-danger small p-2">{{this.errors.level}}</small>
            </div>
            <div class="mb-3 ">
                <label for="type" class="form-label">Type </label>
                <input type="text" class="form-control" id="type" v-model="type">
                <small class="text-danger small p-2">{{this.errors.type}}</small>
            </div>
            <div class="mb-3 ">
                <label for="specialty" class="form-label">Specialty </label>
                <input type="text" class="form-control" id="specialty" v-model="specialty">
                <small class="text-danger small p-2">{{this.errors.specialty}}</small>
            </div>
            <div>
                <h5>Years of study</h5>
                <div class="row"> 
                    <div class="mb-3 col-md-6">
                        <label for="from" class="form-label">From </label>
                        <input type="date" class="form-control" id="from" v-model="study_from">
                        <small class="text-danger small p-2">{{this.errors.study_from}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="to" class="form-label">To </label>
                        <input type="date" class="form-control" id="to" v-model="study_to">
                        <small class="text-danger small  p-2">{{this.errors.study_to}}</small>
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
                    <span style="position:relative" v-if="this.img_preview"> <i class="bi bi-x-circle text-danger shadow rounded-circle pb-0" @click="removeImage()" style="font-size:1.5rem; position:absolute; left:9rem; top:-3rem; cursor:pointer"></i></span>
                    <img :src="this.img_preview" alt="" class=" " style="width:100px; height:105px" v-if="this.img_preview"> 
                    <small class="text-danger small shadow p-2">{{this.errors.image}}</small>
                </div>
            </div>
            <div class="form-check p-3">
                <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" v-model="i_dont_have_certificate">
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
            errors:{}
        }
    },
    computed:{
        img_preview:{
            get() { return this.$store.state.signupProcess_education.education.img_preview; },
            set(value) { this.$store.commit('set_education_img_preview', value); }
        },
        image:{
            get() { return this.$store.state.signupProcess_education.education.image; },
            set(value) { this.$store.commit('set_education_image', value); }
        },
        institution:{
            get() { return this.$store.state.signupProcess_education.education.institution; },
            set(value) { this.$store.commit('set_institution', value); }
        },
        level:{
            get() { return this.$store.state.signupProcess_education.education.level; },
            set(value) { this.$store.commit('set_education_level', value); }
        },
        type:{
            get() { return this.$store.state.signupProcess_education.education.type; },
            set(value) { this.$store.commit('set_type', value); }
        },
        specialty:{
            get() { return this.$store.state.signupProcess_education.education.specialty; },
            set(value) { this.$store.commit('set_specialty', value); }
        },
        study_from:{
            get() { return this.$store.state.signupProcess_education.education.study_from; },
            set(value) { this.$store.commit('set_education_study_from', value); }
        },
        study_to:{
            get() { return this.$store.state.signupProcess_education.education.study_to; },
            set(value) { this.$store.commit('set_education_study_to', value); }
        },
        i_dont_have_certificate:{
            get() { return this.$store.state.signupProcess_education.education.i_dont_have_certificate; },
            set(value) { this.$store.commit('set_i_dont_have_certificate', value); }
        },
    },
    methods:{
        backStep(){
            document.getElementById('education').classList.add('hidden');
            document.getElementById('certification').classList.remove('hidden');
        },
        nextStep(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('education').classList.add('hidden');
            document.getElementById('video').classList.remove('hidden');
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
            this.errors={};
            if( this.i_dont_have_certificate) return;

            if(! this.institution) this.errors.institution = "This field is required";
            if(! this.level) this.errors.level = "This field is required";
            if(! this.specialty) this.errors.specialty = "This field is required";
            if(! this.type) this.errors.type = "This field is required";
            if(! this.study_from) this.errors.study_from = "This field is required";
            if(! this.study_to) this.errors.study_to = "This field is required";
        }
    }
}
</script>

<style>

</style>