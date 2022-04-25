<template>
 <div class="row">
    <div class="col-md-2">    
      <SideNav />
    </div>
  <div class="col-md-10 pt-3 px-3">
       <small class="alert-success p-2 text-center" v-if="this.success.course_deleted">{{this.success.course_deleted}} <br></small>
       <small class="alert-danger p-2 text-center" v-if="this.errors.course_deleted">{{this.errors.course_deleted}} <br></small>
      <h3>Courses offered on Uswa <span class="btn btn-primary float-end me-5" data-bs-toggle="modal" data-bs-target="#add-new-course"> <i class="bi bi-plus-lg"></i> New</span></h3>
      <div class="table-responsive">
          <table class="table table-striped table-hover table-sm">
              <thead>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
              </thead>
              <tbody v-if="Object.keys(this.current_courses).length">
                  <tr v-for="(course, index) in this.current_courses" :key="index">
                      <td>{{index +1}}</td>
                    <td>{{this.capitalize(course.course_name)}}</td>
                    <td>{{this.capitalize(course.course_description)}}</td>
                    <td>
                        <span class="btn btn-sm btn-primary m-1" @click.prevent="updateCurrentCourse(course)" data-bs-toggle="modal" data-bs-target="#update-course"><i class="bi bi-pencil-square"></i></span>
                        <span class="btn btn-sm btn-danger m-1" @click.prevent="deleteCourse(course)"><i class="bi bi-trash"></i></span>
                    </td>
                  </tr>
                  
              </tbody>
              <tbody v-else>
                  <tr>
                      <td colspan='3' class="p-5 text-center small text-muted">No records to show. <br> Click new button to add a course</td>
                  </tr>
              </tbody>
          </table>
      </div>
      </div>
 </div>


<!-- Add new course Modal -->
<div class="modal fade" id="add-new-course" tabindex="-1" aria-labelledby="add-new-courseLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-new-courseLabel">Add new course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="form-group py-1">
            <label for="name">Course name</label>
            <input type="text" maxlength="50" class="form-control" id="name" placeholder="Course name" v-model="course_name">
            <small class="text-danger">{{this.errors.course_name}}</small>
         </div>
         <div class="form-group py-1">
            <label for="name">Course description</label>
            <textarea  cols="3" rows="3" class="form-control" placeholder="Write a brief course description" v-model="course_description"></textarea>
            <small class="text-danger">{{this.errors.course_description}}</small>
         </div>
      </div>
      <div class="text-end p-2">
          <small class="text-success">{{this.success.submit_form}} <br></small>
          <small class="text-danger">{{this.errors.submit_form}} <br></small>
        <button type="button" class="btn btn-danger m-1" id='close-add-modal' data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary m-1" @click.prevent="this.submitForm()">Save </button>
      </div>
    </div>
  </div>
</div>

<!-- Edit course Modal -->
<div class="modal fade" id="update-course" tabindex="-1" aria-labelledby="update-courseLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update-courseLabel">Edit course</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="form-group py-1">
            <label for="name">Course name</label>
            <input type="text" class="form-control" maxlength="50" id="name" placeholder="Course name" v-model="updated_course_name">
            <small class="text-danger">{{this.errors.updated_course_name}}</small>
         </div>
         <div class="form-group py-1">
            <label for="name">Course description</label>
            <textarea  cols="3" rows="5" class="form-control" placeholder="Course description" v-model="updated_course_description"></textarea>
           
            <small class="text-danger">{{this.errors.updated_course_description}}</small>
         </div>
      </div>
      <div class="text-end p-2">
          <small class="text-danger">{{this.errors.update_course_name}} <br> </small> 
          <small class="text-success">{{this.success.updated_course_name}} <br></small>
        <button type="button" class="btn btn-danger m-1" data-bs-dismiss="modal" id="close-update-modal">Close</button>
        <button type="button" class="btn btn-primary m-1" @click.prevent="this.UpdateCourse()">Update </button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import SideNav from "../Layouts/SideNav.vue";

export default {
components:{
            SideNav
        },
    data(){
        return{
            course_name:null,
            course_description:null,
            updated_course_name:null,
            updated_course_description:null,
            current_courses:{},
            errors:{},
            success:{}
        }
    },
    methods:{
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        updateCurrentCourse(course){
            this.current_course = course;
            this.updated_course_name = course.course_name
            this.updated_course_description = course.course_description
        },
        submitForm(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            var form_data = new FormData();
            form_data.append('course_name', this.course_name);
            form_data.append('course_description', this.course_description);

            axios.post('/api/courses', form_data)
            .then(response=>{
                this.success.submit_form = 'Success, course added';
                this.fetchCourses();
                setTimeout(() => {
                    document.getElementById('close-add-modal').click();
                }, 2500);
            })
            .catch(error=>{
                this.errors.submit_form = 'Failed, course not added'
                console.log(error.response);
            })
        },
        UpdateCourse(){
            this.validateUpdateForm();
            if(Object.keys(this.errors).length) return;

            var form_data = new FormData();
            form_data.append('course_name', this.updated_course_name);
            form_data.append('course_description', this.updated_course_description);
            form_data.append('_method', 'PUT');

            axios.post('/api/courses/' + this.current_course.id, form_data)
            .then(response=>{
                this.success.updated_course_name = 'Success, course updated';
                this.fetchCourses();
                setTimeout(() => {
                    document.getElementById('close-update-modal').click();
                }, 2500);
            })
            .catch(error=>{
                this.errors.update_course_name = 'Failed, course not updated'
                console.log(error.response);
            })
        },
        deleteCourse(course){
            if(! confirm('Are you sure you want to delete this course?')) return;
            axios.delete('/api/courses/' + course.id)
            .then(response =>{
                this.success.course_deleted= 'Success, course deleted!'
                this.fetchCourses();
                console.log(response);
            })
            .catch(error => {
                this.errors.course_deleted= 'Failed, course not deleted!'
                console.log(error.response);
            })
        },
        validateForm(){
            this.errors ={}
            if(! this.course_name) this.errors.course_name = 'This field is required';
            if(! this.course_description) this.errors.course_description = 'This field is required';
        },
        validateUpdateForm(){
            this.errors ={}
            if(! this.updated_course_name) this.errors.updated_course_name = 'This field is required';
            if(! this.updated_course_description) this.errors.updated_course_description = 'This field is required';
        },
        fetchCourses(){
            axios.get('/api/courses')
            .then(response=>{
                this.current_courses = response.data.data;
            })
            .catch(error=>{
                console.log(error.response);
            })
        }
    },
    mounted(){
        this.fetchCourses();
    }
    
}
</script>

<style>

</style>