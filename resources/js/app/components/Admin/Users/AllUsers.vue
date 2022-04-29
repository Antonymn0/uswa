<template>
<div class="row">
    <div class="col-md-2">    
      <SideNav />
    </div>
    
    <div class="col-md-10">
        <div class=" ">
            <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="fetchUsers()">All users <br> {{Object.keys(this.all_users).length}} </span>
            <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="filterTutors()">Tutors <br> {{this.num_of_tutors}}</span>
            <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="filterStudents()">Students <br> {{this.num_of_students}} </span>        
            <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="viewSuspendedUsers()">Suspended <br> {{Object.keys(this.suspended_users).length}} </span>        
            <span class="float-end m-2 "> <input type="text" name="" id="search" class="p-2 rounded border" placeholder="Search by Email" v-model="this.search_email"><button class="btn btn-primary" @click.prevent="searchUser(this.search_email)">Search</button> </span>
        
        </div>
        <small class="alert-success p-2 rounded" v-if="this.success">{{this.success}}</small>
        <small class="alert-danger p-2 rounded" v-if="this.error">{{this.error}}</small>
        <div class="table-responsive w-100">
            <h5>{{this.title}}</h5>
            <table class="table table-sm table-striped p-2">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Language 1</th>
                    <th>Level</th>
                    <th>Language 2</th>
                    <th>Level</th>
                    <th>Course to teach</th>
                    <th>Country</th>
                    <th>Action</th>
                </thead>
                <tbody v-if="Object.keys(this.current_users).length">
                    <tr class="p-2" v-for="(user, index) in this.current_users" :key="index">
                        <td>{{index + 1}}</td>
                        <td>{{this.capitalize(user.first_name)}} {{this.capitalize(user.last_name)}}</td>
                        <td>{{user.email}}</td>
                        <td v-if="user.role == 'admin'" ><span class="text-primary">{{user.role}} </span> </td>
                        <td v-else>{{user.role}}</td>
                        <td>{{this.capitalize(user.language)}}</td>
                        <td>{{this.capitalize(user.level)}}</td>
                        <td>{{this.capitalize(user.second_language)}}</td>
                        <td>{{this.capitalize(user.second_language_level)}}</td>
                        <td>{{this.capitalize(user.subject)}}</td>
                        <td>{{this.capitalize(user.country)}}</td>
                        <td v-if="user.role !== 'admin'">
                            <span v-if="!user.deleted_at"><i class="bi bi-trash btn-sm btn btn-danger" @click.prevent="suspendUser(user.id)"></i></span>
                            <span v-else><i class="bi bi-arrow-counterclockwise btn-sm  btn btn-primary" @click.prevent="restoreUser(user.id)"></i></span>
                        </td>
                        <td v-else></td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr> 
                        <td colspan="7" class="text-muted text-center p-5"> No records to show</td>
                    </tr>
                </tbody>
            </table>
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
            all_users:{},
            current_users:{},
            suspended_users:{},
            title:'All users',
            num_of_tutors:0,
            num_of_students:0,
            error:null,
            success:null,
            search_email:null
        }
    },

    methods:{
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        fetchUsers(){
            axios.get('/api/user')
            .then(response=>{
                var tutors=0;
                var students=0;
                this.all_users = response.data.data.data;
                this.current_users = this.all_users;
                this.title = "All users";
                this.all_users.forEach(user=>{
                    if(user.role == 'tutor') tutors += 1;
                    if(user.role == 'student') students += 1;
                });
                this.num_of_tutors = tutors;
                this.num_of_students = students;
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        filterTutors(){
            var tutors=[]
            this.all_users.forEach(user=>{
                if(user.role == 'tutor') {
                    tutors.push(user);
                }
                this.current_users = tutors;
                this.title="Tutors"
            });
        },
        filterStudents(){
            var students=[]
            this.all_users.forEach(user=>{
                if(user.role == 'student') {
                    students.push(user);
                }
                this.current_users = students;
                this.title = "Students"
            });
        },
        getSuspendedUsers(){
            axios.get('/api/user/get-deleted')
            .then(response=>{
                this.suspended_users = response.data.data.data; 
            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        viewSuspendedUsers(){
            this.current_users = this.suspended_users;
            this.title = "Suspended users"
        },
        suspendUser(id){
            if(!confirm('Are you sure you want to delete this user?')) return;
            axios.delete('/api/user/' + id)
            .then(response=>{
                console.log(response);
                this.success = "Success, user suspended";
                this.fetchUsers();
                this.getSuspendedUsers();
                setTimeout(() => {
                    this.success =null
                }, 3000);
            })
            .catch(error=>{
                this.error = "Failed to suspend user."
                console.log(error.response);
            });
        },
        restoreUser(id){
            if(!confirm('Are you sure you want to restore this user?')) return;
            axios.get('/api/user/restore/' + id)
            .then(response=>{
                console.log(response);
                this.success = "Success, user restored";
                this.fetchUsers();
                this.getSuspendedUsers();
                setTimeout(() => {
                    this.success =null
                }, 3000);
            })
            .catch(error=>{
                this.error = "Failed to restore user."
                console.log(error.response);
            });            
        },
        searchUser(email){
            axios.get('/api/user/search/' + email)
            .then(response=>{
                this.title = "Search results"  
                if(response.data.data){
                    this.current_users={}
                    this.current_users = [response.data.data]
                } 
                else this.current_users ={}
                
               
            })
            .catch(error=>{
                console.log(error.response);
            });    
        }
    },

    mounted(){
        this.fetchUsers();
        this.getSuspendedUsers();
    }


}
</script>

<style scoped>
/* media quesries */
@media only screen and (max-width: 750px) {
    
    
}

</style>