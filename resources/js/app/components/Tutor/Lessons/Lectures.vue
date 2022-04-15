<template>
  <div> 

    <!--Lectures main Modal -->
    <div class="modal fade" id="lecturesModal" tabindex="-1" aria-labelledby="lecturesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lectures</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small class="alert alert-success p-2 text-center" v-if="this.success.lecture_delete">{{this.success.lecture_delete}}</small>
                <small class="alert alert-danger p-2 text-center" v-if="this.errors.lecture_delete">{{this.errors.lecture_delete}}</small>
                <div>
                    <span class="d-flex justify-content-between">
                    <h6 class="fw-bold">Define your course lectures</h6> 
                    <button class="btn btn-primary" data-bs-target="#addModal2" data-bs-toggle="modal" data-bs-dismiss="modal"> <i class="bi bi-plus-lg"></i> New</button>
                    </span>                        
                   
                        <div class="table responsive" v-if="Object.keys(this.lectures).length">
                            <table class="table table-sm p-2">
                                <thead class="p-2">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Duration <small class="text-muted fw-light">(hrs)</small></th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(lec, index) in this.lectures" :key="index" class="p-2">
                                        <td class="p-2">{{index +1}}</td>
                                        <td>{{this.capitalize(lec.lecture_name)}}</td>
                                        <td>{{lec.lecture_duration}}</td>
                                        <td>{{this.capitalize(lec.lecture_description)}}</td>
                                        <td> 
                                            <span class="mx-2" style="cursor:pointer"> <i class="bi bi-pencil-square text-primary" @click.prevent="updateCurrentLecture(lec)" data-bs-target="#editModal2" data-bs-toggle="modal" data-bs-dismiss="modal"></i> </span>
                                            <span class="mx-2" style="cursor:pointer"> <i class="bi bi-trash text-danger" @click.prevent="deleteLecture(lec.id)"></i> </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                  
                    <div v-else>
                        <p class="text-muted small py-5 text-center">No records to show</p>
                    </div>                  

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success px-3" @click.prevent="this.fetchLectures()">Refresh</button>
                <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- --------------------- Small add new modal ------------------  -->
    <div class="modal fade" id="addModal2" aria-hidden="true" aria-labelledby="addModalLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Add a lecture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" ref="form">
                        <div class="form-group p-2">
                            <label for="name">Lecture name:</label>
                            <input type="text" id="name" class="form-control" v-model="lecture_name" placeholder="Lecture name">
                            <small class="text-danger">{{this.errors.lecture_name}}</small>
                        </div>
                        <div class="form-group p-2">
                            <label for="duration">Duration: <small class="text-muted"> (hrs)</small> </label>
                            <input type="number" id="duration" min='1' max="5" class="form-control" v-model="lecture_duration" placeholder="Duration in hrs">
                            <small class="text-danger">{{this.errors.lecture_duration}}</small>
                        </div>
                        <div class="form-group p-2">
                            <label for="description">Description:</label>
                            <textarea name=""  id="description"  class="form-control" cols="5" rows="3" v-model="lecture_description" placeholder="(eg) Introduction to english"></textarea>
                            <small class="text-danger">{{this.errors.lecture_description}}</small>
                        </div>
                    </form>
                </div>
                <p class="text-muted small p-2">
                    Tips: <br>                    
                    <i class="bi bi-dot"></i> Define your lectures in small chunks of about 1hr each <br>
                    <i class="bi bi-dot"></i> Your defined  charge rate will be applied on these lectures <br>
                    <i class="bi bi-dot"></i>  Students are billed per lecture flat rate
                </p>
            </div>
              
            <div class="text-end px-3 pb-2"> 
                <small class="text-danger">{{this.errors.lecture_submited}}</small> 
                <small class="text-success">{{this.success.lecture_submited}}</small> <br>
                <button class="btn btn-danger m-2" id="back-btn-lec" data-bs-target="#lecturesModal" data-bs-toggle="modal" data-bs-dismiss="modal">Back </button>
                <button class="btn btn-primary m-2" @click.prevent="submitForm()"> <span class="spinner spinner-border spinner-border-sm" v-if="this.spinner.submit"></span> Sumbit</button>
              </div>
            </div>
        </div>
    </div>

     <!-- --------------------- Small edit modal ------------------  -->
    <div class="modal fade" id="editModal2" aria-hidden="true" aria-labelledby="editModalleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Update lecture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" ref="form">
                        <div class="form-group p-2">
                            <label for="name">Lecture name:</label>
                            <input type="text" id="name" class="form-control" v-model="update_lecture_name">
                            <small class="text-danger">{{this.errors.lecture_name}}</small>
                        </div>
                        <div class="form-group p-2">
                            <label for="duration">Duration: <small class="text-muted"> (in hrs)</small> </label>
                            <input type="number" id="duration" min='1' class="form-control" v-model="update_lecture_duration">
                            <small class="text-danger">{{this.errors.lecture_duration}}</small>
                        </div>
                        <div class="form-group p-2">
                            <label for="description">Description:</label>
                            <textarea name=""  id="description"  class="form-control" cols="5" rows="3" v-model="update_lecture_description"></textarea>
                            <small class="text-danger">{{this.errors.lecture_description}}</small>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="text-end px-3 pb-2"> 
                <small class="text-danger">{{this.errors.lecture_updated}}</small> 
                <small class="text-success">{{this.success.lecture_updated}}</small> <br>
                <button class="btn btn-danger m-2" id="back-btn-update-lec" data-bs-target="#lecturesModal" data-bs-toggle="modal" data-bs-dismiss="modal">Back </button>
                <button class="btn btn-primary m-2" @click.prevent="updateLecture(this.current_lecture)"> <span class="spinner spinner-border spinner-border-sm" v-if="this.spinner.update"></span> Update</button>
              </div>
            </div>
        </div>
    </div>

</div>
</template>

<script>
import {mapGetters } from "vuex";

export default {
    data(){
        return{
            lecture_name:null,
            lecture_duration:null,
            lecture_description:null,
            update_lecture_name:null,
            update_lecture_duration:null,
            update_lecture_description:null,
            lectures:{},
            current_lecture:{},
            errors:{},
            success:{},
            spinner:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),    
    },
    methods:{
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        submitForm(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            var form_data = new FormData();
                form_data.append('tutor_id', this.getUser.id);
                form_data.append('lecture_name', this.lecture_name);
                form_data.append('lecture_duration', this.lecture_duration);
                form_data.append('lecture_description', this.lecture_description);
                
            this.spinner.submit =true;
            axios.post('/api/lectures', form_data)
            .then(response=>{
                this.spinner={}
                this.success.lecture_submited='Success, Lecture saved';
                this.lecture_name = null;
                this.lecture_duration = null;
                this.lecture_description = null;
                this.fetchLectures();
                document.getElementById('back-btn-lec').click();
                setTimeout(() => {
                    this.success={}
                }, 3000);  

            })
            .catch(response=>{
                this.spinner={}
                this.$refs.form.reset();
                this.errors.lecture_submited = 'Error, failed to submit';
            });            
        },
        fetchLectures(){
            axios.get('/api/lectures')
            .then(response=>{
                this.lectures= response.data.data.data;
            })
            .catch(response=>{
                console.log(response);
            });
        },
        deleteLecture(id){
            if(! confirm('Are you sure you want to delete this record?')) return;
            axios.delete('/api/lectures/' + id)
            .then(response=>{
                console.log(response);
                this.success.lecture_delete = 'Success, Record deleted!';
                this.fetchLectures();
               
            })
            .catch(response=>{
                this.errors.lecture_delete = "Failed, could not delete record!"
                console.log(response);
            });
        },
        updateCurrentLecture(lecture){
            this.current_lecture = lecture;
            this.update_lecture_name = lecture.lecture_name;
            this.update_lecture_duration = lecture.lecture_duration;
            this.update_lecture_description = lecture.lecture_description;
        },
        updateLecture(lecture){
            var form_data = new FormData();
                form_data.append('tutor_id', this.getUser.id);
                form_data.append('lecture_name', this.update_lecture_name);
                form_data.append('lecture_duration', this.update_lecture_duration);
                form_data.append('lecture_description', this.update_lecture_description);
                form_data.append('_method', 'PUT');
                
            this.spinner.update =true;
            axios.post('/api/lectures/'+ lecture.id, form_data)
            .then(response=>{
                this.spinner={}
                this.success.lecture_updated='Success, Lecture updated';
                
                this.fetchLectures();
                document.getElementById('back-btn-update-lec').click();
                setTimeout(() => {
                    this.success={}
                }, 3000);  

            })
            .catch(response=>{
                this.spinner={}
                this.errors.lecture_updated = 'Error, faild to submit';
            });        
        },
        validateForm(){
            this.errors={}
            if(! this.lecture_name) this.errors.lecture_name = 'This field is required';
            if(! this.lecture_duration) this.errors.lecture_duration = 'This field is required';
            if(! this.lecture_description) this.errors.lecture_description = 'This field is required';

        }
    },
    mounted(){
        this.fetchLectures();
    }

}
</script>

<style>

</style>