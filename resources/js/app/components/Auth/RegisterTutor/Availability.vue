<template>
    <div>
        <h4>Availability</h4>
        
        <div>
            <div class="my-5 ">
                <label for="timezone" class="form-label"><h5>Set your timezone</h5></label>
                 <select name="" id="" class="p-3 w-100 rounded bg-white border text-muted">
                    <option value=""  class=""> Option </option>
                </select>
            </div>
            <div class="schedule">
                <h5>Set your working Schedule</h5>
                <p>Availability shows your potential working hours.
                    Students can book lessons at these times.
                </p>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Monday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Tuesday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Wednesday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Thursday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Friday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Saturday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" >
                        <label class="form-check-label" for="disabledFieldsetCheck">Sunday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

            </div>
        </div>
        <div class="text-center pt-5 pb-2">
            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-secondary m-1" @click.prevent="this.cancelSignup()">cancel</button>
            <button class="btn btn-danger m-1" @click.prevent="completeSignup()">Complete Signup</button>
        </div> 
        </div>
</template>

<script>
export default {
    data(){
        return{
            time_selector:[
                '00:00',
                '00:30',
                '01:00',
                '01:30',
                '02:00',
                '02:30',
                '03:00',
                '03:30',
                '04:00',
                '04:30',
                '05:00',
                '05:30',
                '06:00',
                '06:30',
                '07:00',
                '07:30',
                '08:00',
                '08:30',
                '09:00',
                '09:30',
                '10:00',
                '10:30',
                '11:00',
                '11:30',
                '12:00',
                '12:30',
                '13:00',
                '13:30',
                '14:00',
                '14:30',
                '15:00',
                '15:30',
                '16:00',
                '16:30',
                '17:00',
                '17:30',
                '18:00',
                '18:30',
                '19:00',
                '19:30',
                '20:00',
                '20:30',
                '21:00',
                '21:30',
                '22:00',
                '22:30',
                '23:00',
                '23:30',
            ],
        }
    },
    methods:{
        backStep(){
            document.getElementById('education').classList.add('hidden');
            document.getElementById('video').classList.remove('hidden');
        },
        nextStep(){
            document.getElementById('education').classList.add('hidden');
            document.getElementById('video').classList.remove('hidden');
        },
        cancelSignup(){
            //
        },
        completeSignup(){
            this.$router.push({name: 'tutor-dashboard'});
        }
    }
}
</script>

<style>


</style>