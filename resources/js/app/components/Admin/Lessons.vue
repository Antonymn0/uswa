<template>
  <div class="row">
    <div class="col-md-2">    
      <SideNav />
    </div>
    
    <div class="col-md-10">
        <div class=" ">
           <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="fetchLessons()" >All lessons <br> {{Object.keys(this.lessons).length}} </span>
           <span class="m-2 p-3 border rounded btn btn-default" >Trial lessons <br> 0 </span>
           <span class="m-2 p-3 border rounded btn btn-default" @click.prevent="getLessonsInprogress()">In progress <br> {{num_ongoing}} </span>
           <span class="m-2 p-3 border rounded btn btn-default" @click.prevent=" getLessonsCompleted()">Completed <br> {{num_completed}} </span>
           
        </div>
        <!-- <small class="alert-success p-2 rounded" v-if="this.success">{{this.success}}</small>
        <small class="alert-danger p-2 rounded" v-if="this.error">{{this.error}}</small> -->
        <div class="table-responsive p-2 mt-5">
            <h5>{{this.title}}</h5>
            <table class="table table-sm table-striped p-2">
                <thead>
                    <th>#</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Student</th>
                    <th>Tutor</th>
                    <th>Duration</th>
                    <th>Covered</th>
                    <th>Remaining</th>
                </thead>
                <tbody>
                    <tr v-for="(lesson, index) in this.current_lessons" :key="index">
                        <td> {{index + 1}}</td>
                        <td> {{lesson.lesson_type}}</td>
                        <td> {{lesson.status}}</td>
                        <td> {{lesson.get_lesson_student.first_name}}</td>
                        <td> {{lesson.get_lesson_tutor.first_name}}</td>
                        <td> {{lesson.lesson_total_duration}} <small>hrs</small></td>
                        <td> {{lesson.covered_duration}} <small>hrs</small></td>
                        <td> {{lesson.lesson_total_duration - lesson.remaining_duration}}<small>hrs</small></td>
                    </tr>
                </tbody>
           
            </table>
        </div>
   </div>
</div>

</template>

<script>
import SideNav from "./Layouts/SideNav.vue";

export default {
 components:{
        SideNav
    },
    data(){
        return{
            title:'All Lessons',
            lessons:{},
            current_lessons:{},
            num_ongoing:0,
            num_completed:0
        }
    },
    methods:{
        fetchLessons(){
            axios.get('/api/lessons')
            .then(response=>{
                this.lessons = response.data.data.data;
                this.current_lessons = this.lessons;
                // filter ongoing and completed lessons
                var num_ongoing = 0;
                var num_completed = 0;
                this.lessons.forEach(lesson=>{
                    if(lesson.status == 'ongoing'){                       
                        num_ongoing +=1;
                    } 
                    if(lesson.status == 'completed'){                        
                        num_completed +=1;
                    } 
                });
                this.num_ongoing = num_ongoing;
                this.num_completed = num_completed;

            })
            .catch(error=>{
                console.log(error.response);
            });
        },
        getLessonsInprogress(){
            var ongoing = [];
            this.lessons.forEach(lesson=>{
                if(lesson.status == 'ongoing'){
                    ongoing.push(lesson);
                } 
            });
            this.current_lessons = ongoing;
            this.title = "Lessons in progress";
        },
        getLessonsCompleted(){
            var completed = [];
            this.lessons.forEach(lesson=>{
                if(lesson.status == 'completed'){
                    completed.push(lesson);
                } 
            });
            this.current_lessons = completed;
            this.title = "Lessons completed";
        }

    },
    mounted(){
        this.fetchLessons();
    }

}
</script>

<style>

</style>