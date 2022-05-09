<template>
<div class="row px-1">
<div class="col-md-2">    
<SideNav />
</div>

<div class="col-md-10 ">  
<h5>Tutor review</h5>
<div class="table-responsive  w-100">
    <table class="table table-small table-stripped">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Date registered</th>
            <th>Action</th>
        </thead>
        <tbody v-if="Object.keys(this.current_users).length" >
            <tr class="p-2" v-for="(user, index) in this.current_users" :key="index">
                <td>{{index + 1}} </td>
                <td> {{this.capitalize(user.first_name)}} {{this.capitalize(user.last_name)}}</td>
                <td> {{user.email}}</td>
                <td> {{user.role}}</td>
                <td> {{this.capitalize(user.registration)}}</td>
                <td> {{this.formatDate(user.created_at)}}</td>
                <td> <span class="btn btn-sm btn-primary" @click.prevent="this.updateCurrentUser(user)" data-bs-toggle="modal" data-bs-target="#reviewmodal"> Review</span> </td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td colspan="7" class="text-muted small text-center p-5 my-5"> No records to review</td>
            </tr>
        </tbody>
    </table>        
</div> 
<!-- --------------------------  Review odal -----------------------------------------------------        -->

<!-- Modal -->
<div class="modal fade" id="reviewmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reviewmodalLabel">Tutor account review</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h6 class="d-flex align-items-center fw-bold">
                <span>
                    <i class="bi bi-person-circle rounded-circle text-muted" style="font-size:2.5rem" v-if="! current_user.image"></i> 
                    <img v-else :src="current_user.image" alt="profile picture" style="width:40px; height:40px; border-radius:50%"> 
                </span> &nbsp; 
                {{current_user.first_name}} {{current_user.last_name}}
            </h6>
            <div class=" px-2">                       
            <div class="row  rounded border-top">                       
                <div class="col-md-6 border-end pt-4">
                    <p> <span class="fw-bold">Full name: </span>  <span>{{this.capitalize(current_user.first_name)}} {{this.capitalize(current_user.middle_name)}} {{this.capitalize(current_user.last_name)}}</span> </p>
                    <p> <span class="fw-bold">Email: </span>  <span> {{current_user.email}} </span> </p>
                    <p> <span class="fw-bold">Role: </span>  <span> {{this.capitalize(current_user.role)}} </span> </p>
                    <p> <span class="fw-bold">Profile picture: </span> <span> <a :href="current_user.image" class="text-primary" target="blank"> Image </a> </span> </p>

                    <p class="border-top"> <span class="fw-bold">First language: </span> <span> {{this.capitalize(current_user.language)}} </span> </p>
                    <p> <span class="fw-bold">Profeciency level: </span> <span> {{this.capitalize(current_user.level)}} </span></p>
                    <p> <span class="fw-bold">Second language: </span> <span> {{this.capitalize(current_user.language)}} </span> </p>
                    <p> <span class="fw-bold">Profeciency level: </span> <span> {{this.capitalize(current_user.second_language_level)}} </span></p>
                    <p> <span class="fw-bold">Subject to teach: </span> <span> {{this.capitalize(current_user.subject)}} </span></p>
                    <p > <span class="fw-bold">Mastery level: </span> <span> {{this.capitalize(current_user.subject_level)}} </span> </p>

                    <p class="border-top"> <span class="fw-bold">Introduction text: </span> <span> {{this.capitalize(current_user.description)}} </span> </p>
                </div>
                <div class="col-md-6 border-start pt-4">                            
                    <p> <span class="fw-bold">Has teaching certificate: </span> <span v-if="current_user.has_teaching_certificate" class="text-pimary">Yes </span> <span class="text-danger" v-else> No </span> </p>
                    <p> <span class="fw-bold">Teaching certificate: </span> <span> <a :href="current_user.teaching_certificate_upload" class="text-primary" target="blank"> File link</a> </span> </p>
                    <p> <span class="fw-bold">Institution: </span> <span>{{this.capitalize(current_user.teaching_certificate_issued_by)}} </span> </p>
                    <p> <span class="fw-bold"> Description: </span> <span> {{this.capitalize(current_user.teaching_certificate_desription)}} </span> </p> 

                    <p class="border-top"> <span class="fw-bold">Has higher education: </span> <span v-if="current_user.higher_education_certificate_upload" class="text-pimary">Yes </span> <span class="text-danger" v-else> No </span>  </p>
                    <p> <span class="fw-bold">Institution: </span> <span> {{this.capitalize(current_user.higher_education_institution)}} </span> </p>
                    <p> <span class="fw-bold">Higher education certificate: </span> <span class="text-primary"> <a :href="current_user.higher_education_certificate_upload" target="blank"> File  </a> </span></p>
                    
                    <p> <span class="fw-bold">Has introduction video: </span>  <span v-if="current_user.introduction_video || current_user.introduction_video_url" class="text-pimary">Yes </span> <span class="text-danger" v-else> No </span> </p>
                    <p> <span class="fw-bold">Introduction video: </span>
                        <span v-if="current_user.introduction_video"> <a :href="current_user.introduction_video" class="underline" target="blank">Uploaded </a> </span> 
                        <span v-if="current_user.introduction_video_url"> <a :href="current_user.introduction_video_url" class="underline" target="blank">Video link </a> </span> 
                    </p>
                </div>
                </div>                        
                <p class="p-2">
                    <label for="remarks"></label>
                    <textarea name="" id="remarks" cols="10" rows="5" placeholder="Remarks" class="border p-2 rounded w-100" v-model="decline_reason"></textarea>
                    <small class="small text-muted">Type any remarks for the candidate incase of a revert.</small> <br>
                    <small class="small text-danger">{{this.errors.decline_reason}}</small>
                </p>
                </div>
                <div class="text-center py-2">
                    <small class="text-success"> {{this.success}} </small>                  
                    <small class="text-danger"> {{this.errors.revert}} </small> <br>
                    <small class="text-danger"> {{this.errors.approve}} </small> <br>
                    <button type="button" class="btn btn-secondary m-2" id="close-tutor" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success m-2" @click.prevent="revertToTutor(current_user.id)"> <span class="spinner-border spinner-border-sm " v-if="this.spinner.revert"></span> Revert</button>
                    <button type="button" class="btn btn-primary m-2" @click.prevent="approveTutor(current_user.id)"> <span class="spinner-border spinner-border-sm " v-if="this.spinner.approve"></span> Approve</button>
                </div>
            </div>
        </div>
        
        </div>
    </div>
</div>

</div>


</template>

<script>
import moment from "moment";
import axios from 'axios';
import SideNav from "../Layouts/SideNav.vue";

export default {
    components:{
        SideNav
    },
    data(){
        return{
            users:{},
            current_users:{},
            current_user:{},
            spinner:{},
            success:'',
            errors:{},
            decline_reason:null
        }
    },
    methods:{
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        updateCurrentUser(user){
            this.current_user = user;
        },
        approveTutor(id){
            this.errors ={}
            this.success ='';
            if(! confirm("Are you sure you want to approve this tutor account?")) return;
            this.spinner.approve=true;
            axios.get('/api/admin/approve-tutor/' + id + '/' + 'complete')
            .then(response=>{
                this.spinner.approve=false;
                this.success = "Success, Account approved!"                 
                this.fetchTutors();
                setTimeout(() => {
                   document.getElementById('close-tutor').click();
                }, 2500);
            })
            .catch(error=>{
                this.spinner.approve=false;
                this.errors.approve = "Error, failed to approve account"
                console.log(error.response);
            })
        },
        revertToTutor(id){
            this.errors ={}
            this.success ='';
            if(! this.decline_reason) {this.errors.decline_reason = 'Please provide a decline reason'; return;}
            if(! confirm("Are you sure you want to revert this candidate account?")) return;
            this.spinner.revert=true;
            axios.get('/api/admin/revert/tutor/' + id + '/' + this.decline_reason)
            .then(response=>{
                this.spinner.revert=false;
                this.success = "Success,  Account reverted!";
                this.decline_reason = '';
                this.fetchTutors();
                setTimeout(() => {
                   document.getElementById('close-tutor').click();
                }, 2500);
            })
            .catch(error=>{
                this.spinner.approve=false;
                this.errors.revert = "Error, failed to revert account"
                console.log(error.response);
            })
        },
        fetchTutors(){
            axios.get('/api/admin/get-tutors')
            .then(response=>{
                this.users = response.data.data.data;
                this.current_users = this.users;
            })
            .catch(error=>{
                console.log(error.response)
            })
        }
    },
    mounted(){
        this.fetchTutors();
    }

}
</script>

<style>

</style>