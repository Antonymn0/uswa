<template>
   <div>
      <div class="modal fade" id="staticBackdropIntroVideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable text-muted ">
            <div class="modal-content px-1">
            <div class="modal-header">
                <h4 class="modal-title fw-bold">About {{this.tutor.first_name}} {{this.tutor.last_name}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click.prevent="this.pauseIframeVideo()"></button>
            </div>
            <div class="modal-body ">              
                <div class="row">                     
                    <div class="col-md-6 ">
                        <p class="ps-1 fw-bold">Introduction Video</p>
                        <p class="mb-0 rounded text-center" style="overflow:hidden" v-if="this.tutor.introduction_video">                        
                            <iframe width="350" height="250"  :src="this.tutor.introduction_video" autoplay="false" id='iframe' class="shadow   rounded" >  </iframe>                    
                        </p>
                        <p class="mb-0 rouded text-center" style="overflow:hidden" v-if="!this.tutor.introduction_video && this.tutor.introduction_video_url"> 
                            <iframe  width="350" height="250"  :src="this.tutor.introduction_video_url" autoplay="false" class="shadow  rouded" id="iframe" v-if="this.tutor.introduction_video_url">  </iframe>  
                            <span v-if="this.tutor.introduction_video_url && !this.tutor.introduction_video" class="pt-2 text-start">If the video doesnt play, click this <a :href="this.tutor.introduction_video_url" target="blank" class="text-primary underline">link to open </a>  in another tab  </span>                      
                        </p>
                        <p v-if="!this.tutor.introduction_video && !this.tutor.introduction_video_url" class="text-muted small  py-5 mt-5">This tutor has not uploded an introduction video yet</p>
                        <p class=" ps-1 mb-0 pb-0 py-3 d-flex justify-content-between align-items-center">
                            <span class="m-0 p-0 fw-bold"> Homeland: </span>  
                            <span class="m-0 p-0"> &nbsp; &nbsp; {{tutor.city}} </span> 
                            <span class="m-0 p-0"> &nbsp; &nbsp; {{tutor.country}} </span> 
                            <span class="m-0 p-0 float-end"> <country-flag :country='tutor.country_code' size='.5rem'/> </span> 
                        </p>
                    </div>
                    <div class="col-md-6 border-start px-3">                         
                        <p >
                            <span class="m-0 p-0 fw-bold">About:</span> <br>
                            <span class="m-0 p-0">{{ this.capitalize(tutor.description) }}</span>
                        </p>
                        <div class="pt-5">
                         <p class="fw-bold">Availability</p>
                         <p v-if="tutor.tutor_schedule">
                             <table class="table table-striped table-sm text-muted mb-5">
                                <thead class="">
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
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.tuesday == '1'">
                                        <td>Tuesday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.tuesday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.tuesday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Tuesday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.wednesday == '1'">
                                        <td>Wednesday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.wednesday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.wednesday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Wednesday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.thursday == '1'">
                                        <td>Thursday</td>
                                       <td>{{convertTimeToLocal(tutor.tutor_schedule.thursday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.thursday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Thursday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.friday == '1'">
                                        <td>Friday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.friday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.friday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Friday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                       
                                    </tr>
                                    
                                    <tr class="" v-if="tutor.tutor_schedule.saturday == '1'">
                                         <td>Saturday</td>
                                         <td>{{convertTimeToLocal(tutor.tutor_schedule.saturday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.saturday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Saturday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>

                                    <tr class="" v-if="tutor.tutor_schedule.sunday == '1'">
                                         <td>Sunday</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.sunday_from, tutor)}}</td>
                                        <td>{{convertTimeToLocal(tutor.tutor_schedule.sunday_to, tutor)}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td>Sunday</td>
                                        <td colspan="2" class=" small"> Not available</td>
                                    </tr>
                                 
                                 </tbody>
                             </table>  
                             <small class="alert-warning p-3 mt-3 rounded text-center"> <i class="bi bi-info-circle"></i> Time is shown in your local timezone</small>                           
                         </p>
                         <p v-else>
                             <small class="text-center   py-4">This tutor has not set his schedule yet</small>
                         </p>
                      </div>
                  </div>
              </div>
              
              <div class="p-1 text-left">
                <button class="btn btn-success m-1"  data-bs-toggle="modal" data-bs-target="#staticBackdropMessage">Message</button> 
                <button class="btn btn-primary m-1"  data-bs-toggle="modal" data-bs-target="#staticBackdropTrial">Book trial lesson</button> 
               <button class="btn btn-danger m-1" data-bs-dismiss="modal" aria-label="Close" @click.prevent="this.pauseIframeVideo()">Close</button>  
              </div>           
            </div>            
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import CountryFlag from 'vue-country-flag-next';

export default {
    props:['new_tutor'],
    components: {
        CountryFlag,
    },
    data(){
        return{
            tutor: {}
        }
    },
    watch: {
        new_tutor: function  (){
            this.tutor = this.new_tutor;
        }
    },
    methods:{
        capitalize(string){
          if(string)  return string.charAt(0).toUpperCase() + string.slice(1);
        },
        convertTimeToLocal(time, tutor){
            // convert date from utc to local time 
          if(! time ) return "Invalid time";
          if(! tutor ) return "Invalid time parameter";
          else  {
              let date_placeholder = '2020-01-01 '; // JUST A FILLER PLACEHOLDER DATE to help in formating
              let tutor_tz = tutor.local_timezone;
              let date =  moment.tz(date_placeholder + time, tutor_tz);
              let utc_time = date.utc(); // parse date into utc

              let local_time = utc_time.clone().local().format("h:mm a"); // covert date into current local time
              return local_time;              
          }  
          
        },
        pauseIframeVideo(){
            this.tutor ={}
            setTimeout(() => {
              this.tutor = this.new_tutor;  
            }, 500);
            
          
        }
    },
    mounted(){

    }

}
</script>

<style>

</style>