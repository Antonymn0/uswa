<template>

<!-- -------------  assignment  modal -------------  -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" data-bs-backdrop="static" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalToggleLabel">Assignments</h5>
        <button type="button" class="btn-close"  id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
          <small class="my-2">All assignments associated with this lesson will apppear here.  </small>
          <div class="row py-3" v-if="Object.keys(this.lesson.get_assignments).length">
            <div class="col-md-6"> 
            <div class="p-2">
                <h6 class="ps-3 fw-bold">Tutor</h6>                
                <p  v-for="(assignment, index) in this.lesson.get_assignments" :key="index" v-show="assignment.uploaded_by == assignment.tutor_id"> 
                    <span > - <a :href="assignment.assignment_link" target="blank" download="download">  {{assignment.name}}</a></span> 
                </p>
            </div>
            </div>
            <div class="col-md-6 border-start pe-4">              
                <h6 class="ps-3 fw-bold">Student <span class="float-end"> Score</span> </h6>
                <p class="d-flex justify-content-between"  v-for="(assignment, index) in this.lesson.get_assignments" :key="index" v-show="assignment.uploaded_by == assignment.student_id"> 
                  <span > <a :href="assignment.assignment_link" target="blank" download="download">  {{assignment.name}}</a> </span> 
                  <span v-if="current_assignment.assignment_score" class="border rounded small p-2 px-3"   >{{ current_assignment.assignment_score}}</span> 
                </p>               
            </div> 
             <small class="text-muted text-center ">Tip:  Click links to download.  </small>
            </div>
            <div v-else>
              <p class="text-muted small py-5 text-center">
                  No asignments available for this lesson
              </p>
            </div>
          <div> 
            <!-- ---------------------- upload assignment  ------------------ -->
            <div class=" text-center">
                <button class="btn btn-secondary btn-sm w-50 mt-2 " id="ass-btn" v-if="Object.keys(this.lesson.get_assignments).length" @click.prevent="toggelAssignmentUploadView()">Upload assignment</button> 
                <hr>  
            </div>           
           <div class="border p-3 mt-5 rounded shadow hidden" id="assUpload">                  
                <h5>Upload assignment</h5>
                <label for="assignmentUpdload1" class="mt-2">Select file:</label> <br>
                <input type="file" class="form-control" accept=".pdf,.doc, .docx" @change.prevent="this.validateFile"> 
                <small class="text-danger">{{this.errors.file}}</small> <br>
                <label for="assignmentUpdload1desc" class="mt-2" >Description:</label> 
                <textarea name="" id="assignmentUpdload1desc" max="50" class="form-control" cols="10" rows="3" v-model="this.description"></textarea>
                <small class="text-danger">{{this.errors.description}}</small> <br>
                <small class="text-success p-2 m-2" v-if="this.success.assignment_uploaded">{{this.success.assignment_uploaded}}</small> <br>        
                <small class="text-danger p-2 m-2" v-if="this.errors.assignment_uploaded">{{this.errors.assignment_uploaded}}</small>  <br>       
                <button class="btn btn-secondary btn-sm m-2 text-right" @click.prevent="uploadAssignment(this.lesson)"> <span class="spinner-border spinner-border-sm" v-if="this.spinner.assignment_uploading" role="status" aria-hidden="true" ></span> Upload </button>
                <button class="btn btn-secondary btn-sm m-2 text-right" @click.prevent="toggelAssignmentUploadView()">Close </button>
           </div>
        </div>
      </div>        
    </div>
  </div>
</div>



</template>

<script>
import {mapGetters,  mapActions } from "vuex";

export default {
    props:['lesson'],
  data () {
    return{
      description:null,
      assignment_type:'assignment',
      current_assignment:{},
      file:null,
      errors:{},
      success:{},   
      spinner:{},
      new_score:0,
    }
  },
  methods:{   
    updateCurrentAssignment(assignment){
        this.current_assignment = assignment;
      },
    updateScore(assignment){
        if(this.new_score < 1) { this.errors.new_score = "This field is required";  return; }
        else this.errors = {}        
        if(! confirm("Update this asignments score?")) return;
        this.spinner.update_score = true;
        axios.get('/api/assignment/update-score/' + assignment.id + '/' + this.new_score)
        .then(response=>{
            console.log(response);
            this.spinner={}
            this.success.score_updated = 'Success, score updated';           
            setTimeout(() => {
                this.success = {}
                document.getElementById('back-to-assignments').click();
            }, 3000);
        })
        .catch(error=>{
            this.spinner={}
            this.errors.score_updated = 'Success, assignment uploaded'; 
            console.log(error.response);
        });
    },
    toggelAssignmentUploadView(){
      var el = document.getElementById('assUpload');
      var btn = document.getElementById('ass-btn');
     if(el.classList.contains('hidden')) {
       el.classList.remove('hidden');
       btn.classList.add('hidden');
       return;
     } else{
       el.classList.add('hidden');
       btn.classList.remove('hidden');
     }
    },
    validateFile(event){        
        this.file = event.target.files[0];
        if(Math.round(event.currentTarget.files[0].size/1024/1024) > 6){ // if bigger than 5mb
            this.errors.file = "File too big. Select file less than 5mb."; 
            return;
        } 
        if(this.file['type'] == 'application/pdf' || this.file['type'] == 'apllication/doc' || this.file['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
            this.file = event.currentTarget.files[0]; 
            delete this.errors.file
            return;
        } 
        else {
            this.errors.file = " Error: Allowed format pdf/doc";
        }
    },
    uploadAssignment(lesson){
        this.validateForm();
        if(Object.keys(this.errors).length) return;
        this.spinner.assignment_uploading = true;
        var form_data = new FormData();
            form_data.append('lesson_id', lesson.id);
            form_data.append('tutor_id', lesson.tutor_id);
            form_data.append('uploaded_by', lesson.student_id);
            form_data.append('student_id', lesson.student_id);
            form_data.append('lesson_type', lesson.lesson_type);
            form_data.append('description', this.description);
            form_data.append('assignment_type', this.assignment_type);
            form_data.append('file', this.file);

        axios.post('/api/assignment', form_data)
        .then(response=>{
            this.spinner={}
            this.success.assignment_uploaded= 'Success, assignment uploaded'; 
            this.file = null,
            this.description = null,
            setTimeout(() => {
                this.success = {}
                document.getElementById('btn-close').click();
            }, 3000);
        })
        .catch(error=>{
            this.spinner={}
            this.errors.assignment_uploaded = error.response.data.errors[0]; 
            console.log(error.response);
        });
    },
 
    validateForm(){
        this.errors={}
        if(!this.description) this.errors.description = "Description is required";
        if(!this.file) this.errors.file = "Please select a file to upload";
    }
  },
  computed:{
    ...mapGetters(['isLogedIn', 'getUser']),    
  },

}
</script>

<style>
  .hidden{
    display:none;
  }
</style>