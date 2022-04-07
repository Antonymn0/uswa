<template>
   <div>
      <div class="modal fade" id="staticBackdropIntroVideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content px-1">
            <div class="modal-header">
                <h4 class="modal-title fw-bold">{{this.tutor.first_name}} {{this.tutor.last_name}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">              
                <div class="row">                     
                    <div class="col-md-6 ">
                        <h6>Introduction Video</h6>
                        <p class="mb-0 rounded" style="overflow:hidden" v-if="this.tutor.introduction_video">                        
                            <iframe width="400" height="300"  :src="this.tutor.introduction_video" autoplay="false" class="shadow bg-dark rounded" >  </iframe>                    
                        </p>
                        <p class="mb-0 rouded" style="overflow:hidden" v-if="this.tutor.introduction_video_url"> 
                            <iframe  width="400" height="300"  :src="this.tutor.introduction_video_url" autoplay="false" class="shadow bg-dark rouded"  v-if="this.tutor.introduction_video_url">  </iframe>                        
                        </p>
                        <p v-if="!this.tutor.introduction_video && !this.tutor.introduction_video_url" class="text-muted small  py-5 mt-5">This tutor has not uploded an introduction video yet</p>
                    </div>
                    <div class="col-md-6 border-start px-3"> 
                        <p >
                            <span class="m-0 p-0">About {{tutor.first_name}}:</span> <br>
                            <span class="m-0 p-0">{{tutor.description}}</span>
                        </p>
                        <div class="py-2">
                          <h5>Availability</h5>
                         <p v-if="tutor.tutor_schedule">
                             <table class="table table-striped table-sm">
                                <thead class="text-muted">
                                     <th >Day</th>
                                     <th>From</th>
                                     <th>To</th>
                                </thead>
                                <tbody class="">
                                    <tr class="" v-if="tutor.tutor_schedule.monday == '1'">
                                        <td>Monday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.monday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.monday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Monday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.tuesday == '1'">
                                        <td>Tuesday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.tuesday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.tuesday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Tuesday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.wednesday == '1'">
                                        <td>Wednesday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.wednesday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.wednesday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Wednesday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.thursday == '1'">
                                        <td>Thursday</td>
                                       <td>{{convertTimeToLocal(tutor.tutor_schedule.thursday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.thursday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Thursday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.friday == '1'">
                                        <td>Friday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.friday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.friday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Friday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                       
                                    </tr>
                                    
                                    <tr class="" v-if="tutor.tutor_schedule.saturday == '1'">
                                         <td>Saturday</td>
                                         <td>{{convertTimeToLocal(tutor.tutor_schedule.saturday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.saturday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Saturday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.sunday == '1'">
                                         <td>Sunday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.sunday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.sunday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Sunday</td>
                                        <td colspan="2" class="text-muted small"> Not available</td>
                                    </tr>
                                 
                                 </tbody>
                             </table>  
                             <small class="text-muted text-center">Tip: Time is shown in your local timezone</small>                           
                         </p>
                         <p v-else>
                             <small class="text-center  text-muted py-4">This tutor has not set his schedule yet</small>
                         </p>
                      </div>
                  </div>
              </div>
              
              <div class="p-1 text-left">
                <button class="btn btn-success m-1"  data-bs-toggle="modal" data-bs-target="#staticBackdropMessage">Message</button> 
                <button class="btn btn-primary m-1"  data-bs-toggle="modal" data-bs-target="#staticBackdropTrial">Book trial lesson</button> 
               <button class="btn btn-danger m-1" data-bs-dismiss="modal" aria-label="Close">Close</button>  
              </div>           
            </div>            
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
    props:['tutor'],
    data(){
        return{

        }
    },
    methods:{
        convertTimeToLocal(time, tutor){
            // convert date from utc to local time 
          if(! time ) return "Invalid time";
          if(! tutor ) return "Invalid time parameter";
          else  {
              let date_placeholder = '2020-01-01 '; // JUST A FILLER PLACEHOLDER DATE to help in formating
              let tutor_tz = tutor.local_timezone;
              let date =  moment.tz(date_placeholder + time, tutor_tz);
              let utc_time = moment.utc(date); // parse date into utc

              let local_time = utc_time.clone().local().format("h:mm a"); // covert date into current local time
              return local_time;              
          }  
          
        }
    },
    mounted(){

    }

}
</script>

<style>

</style>