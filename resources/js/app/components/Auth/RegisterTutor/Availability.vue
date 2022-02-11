<template>
    <div>
        <h4>Availability</h4>        
        <div>
            <div class="my-5 ">
                <label for="timezone" class="form-label"><h5>Set your timezone</h5></label>
               
                <select name="" id="" class="p-3 w-100 rounded bg-white border text-muted" v-model="timezone">
                    <option selected value=""  class=""> Option </option>
                    <option value="1"  class=""> Option 1 </option>
                    <option value="2"  class=""> Option 2</option>
                </select>
                <small class="text-danger">{{this.errors.timezone}}</small>
            </div>
            <div class="schedule">
                <h5>Set your working Schedule</h5>
                <p>Availability shows your potential working hours.
                    Students can book lessons at these times.
                </p>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="monday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck" >Monday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="monday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-control"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="monday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="tuesday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Tuesday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="tuesday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="tuesday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="wednesday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Wednesday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="wednesday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="wednesday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="thursday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Thursday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="thursday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="thursday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="friday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Friday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="friday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="friday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="saturday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Saturday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="saturday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="saturday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>

                <div class="py-3">
                     <div class="form-check">
                        <input class="form-check-input p-2" type="checkbox" id="disabledFieldsetCheck" v-model="sunday.is_available">
                        <label class="form-check-label" for="disabledFieldsetCheck">Sunday </label>
                    </div> 
                    <div class="time">
                        <p class="d-flex py-2"> 
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="sunday.from">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                            <span  class="p-3 rounded"> to </span>
                            <span>
                                <select name="" id="" class="p-3 rounded bg-white border text-muted" v-model="sunday.to">
                                    <option  v-bind="this.item" v-for="item in this.time_selector" :key="item" class="form-contro"> {{item}} </option>
                                </select>
                            </span>
                        </p>   
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center pt-5 pb-2">
            <small class="text-danger">{{this.errors.timezone}}</small> <br>
            <small class="text-danger pb-5">{{this.errors.availability}}</small> <br>
            <button class="btn btn-secondary m-1" @click.prevent="this.backStep()">Back</button>
            <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Next</button>    
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
            errors:{}
        }
    },
    computed:{
        timezone:{
            get() { return this.$store.state.signupProcess_availability.availability.timezone; },  
            set(value) { this.$store.commit('set_timezone', value); }
        },
        monday:{
            get() { return this.$store.state.signupProcess_availability.availability.monday; },
            // set(value) { this.$store.commit('set_monday', is_available, from, to); }
            
        },
        tuesday:{
            get() { return this.$store.state.signupProcess_availability.availability.tuesday; },
            // set(value) { this.$store.commit('set_tuesday', is_available, from, to); }
        },
        wednesday:{
            get() { return this.$store.state.signupProcess_availability.availability.wednesday; },
            // set(value) { this.$store.commit('set_wednesday', is_available, from, to); }
        },
        thursday:{
            get() { return this.$store.state.signupProcess_availability.availability.thursday; },
            // set(value) { this.$store.commit('set_thursday', is_available, from, to); }
        },
        friday:{
            get() { return this.$store.state.signupProcess_availability.availability.friday; },
            // set(value) { this.$store.commit('set_friday', is_available, from, to); }
        },
        saturday:{
            get() { return this.$store.state.signupProcess_availability.availability.saturday; },
            // set(value) { this.$store.commit('set_saturday', is_available, from, to); }
        },
        sunday:{
            get() { return this.$store.state.signupProcess_availability.availability.sunday; },
            // set(value) { this.$store.commit('set_sunday', is_available, from, to); }
        },
        RESET_AVAILABILITY_STATE:{
            set(value) { this.$store.commit('RESET_AVAILABILITY_STATE'); }
        }
    },
    methods:{
        backStep(){
            document.getElementById('availability').classList.add('hidden');
            document.getElementById('video').classList.remove('hidden');
        },
        nextStep(){            
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('availability').classList.add('hidden');
            document.getElementById('finish').classList.remove('hidden');
        },
       
        validateForm(){
            this.errors={};

            if(! this.monday.is_available && ! this.tuesday.is_available && ! this.wednesday.is_available && ! this.thursday.is_available && ! this.thursday.is_available && ! this.friday.is_available && ! this.saturday.is_available && ! this.sunday.is_available) this.errors.availability ="Please set up your available days."
            if(! this.timezone) this.errors.timezone = "Please setup your timezone";
        }
    }
}
</script>

<style>


</style>