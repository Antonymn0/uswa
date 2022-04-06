<template>
    <div>
        <h4>Availability</h4>        
        <div>
            <div class="mt-5 ">
                <label for="timezone" class="form-label"><h5>Set your timezone</h5></label>               
                <select  id="timezone"  v-model="this.timezone" class="bg-white w-100 p-3 border rounded text-muted">
                    <option value="" selected> -Select- </option>
                    <option :value="item.value" id="timezone" v-for="(item,index) in this.timezones" :key="index"> {{item.value}}</option>
                </select> 
                <small class="text-danger">{{this.errors.timezone}}</small>
            </div>
             <div class="form-group py-5 mb-4">
                <label class="form-label" for="disabledFieldsetCheck" > <h5> Set your hourly rate in USD: </h5> </label>
                <input class="bg-white w-100 p-3 border rounded text-muted"  type="number" min="5" id="disabledFieldsetCheck" v-model="hourly_rate">
                 <small class="text-danger">{{this.errors.hourly_rate}}</small>
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
            <button class="btn btn-danger m-1" @click.prevent="this.submitForm()"> <span class="spinner-border spinner-border-sm text-left" v-if="this.spinner.submit_availability"></span> Next</button>    
        </div> 
        </div>
</template>

<script>
import moment from "moment";
import {mapGetters } from "vuex";
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
            timezones : [
                {
                    "value": "Dateline Standard Time",
                    "abbr": "DST",
                    "offset": -12,
                    "isdst": false,
                    "text": "(UTC-12:00) International Date Line West",
                    "utc": [
                    "Etc/GMT+12"
                    ]
                },
                {
                    "value": "UTC-11",
                    "abbr": "U",
                    "offset": -11,
                    "isdst": false,
                    "text": "(UTC-11:00) Coordinated Universal Time-11",
                    "utc": [
                    "Etc/GMT+11",
                    "Pacific/Midway",
                    "Pacific/Niue",
                    "Pacific/Pago_Pago"
                    ]
                },
                {
                    "value": "Hawaiian Standard Time",
                    "abbr": "HST",
                    "offset": -10,
                    "isdst": false,
                    "text": "(UTC-10:00) Hawaii",
                    "utc": [
                    "Etc/GMT+10",
                    "Pacific/Honolulu",
                    "Pacific/Johnston",
                    "Pacific/Rarotonga",
                    "Pacific/Tahiti"
                    ]
                },
                {
                    "value": "Alaskan Standard Time",
                    "abbr": "AKDT",
                    "offset": -8,
                    "isdst": true,
                    "text": "(UTC-09:00) Alaska",
                    "utc": [
                    "America/Anchorage",
                    "America/Juneau",
                    "America/Nome",
                    "America/Sitka",
                    "America/Yakutat"
                    ]
                },
                {
                    "value": "Pacific Standard Time (Mexico)",
                    "abbr": "PDT",
                    "offset": -7,
                    "isdst": true,
                    "text": "(UTC-08:00) Baja California",
                    "utc": [
                    "America/Santa_Isabel"
                    ]
                },
                {
                    "value": "Pacific Daylight Time",
                    "abbr": "PDT",
                    "offset": -7,
                    "isdst": true,
                    "text": "(UTC-07:00) Pacific Daylight Time (US & Canada)",
                    "utc": [
                    "America/Los_Angeles",
                    "America/Tijuana",
                    "America/Vancouver"
                    ]
                },
                {
                    "value": "Pacific Standard Time",
                    "abbr": "PST",
                    "offset": -8,
                    "isdst": false,
                    "text": "(UTC-08:00) Pacific Standard Time (US & Canada)",
                    "utc": [
                    "America/Los_Angeles",
                    "America/Tijuana",
                    "America/Vancouver",
                    "PST8PDT"
                    ]
                },
                {
                    "value": "US Mountain Standard Time",
                    "abbr": "UMST",
                    "offset": -7,
                    "isdst": false,
                    "text": "(UTC-07:00) Arizona",
                    "utc": [
                    "America/Creston",
                    "America/Dawson",
                    "America/Dawson_Creek",
                    "America/Hermosillo",
                    "America/Phoenix",
                    "America/Whitehorse",
                    "Etc/GMT+7"
                    ]
                },
                {
                    "value": "Mountain Standard Time (Mexico)",
                    "abbr": "MDT",
                    "offset": -6,
                    "isdst": true,
                    "text": "(UTC-07:00) Chihuahua, La Paz, Mazatlan",
                    "utc": [
                    "America/Chihuahua",
                    "America/Mazatlan"
                    ]
                },
                {
                    "value": "Mountain Standard Time",
                    "abbr": "MDT",
                    "offset": -6,
                    "isdst": true,
                    "text": "(UTC-07:00) Mountain Time (US & Canada)",
                    "utc": [
                    "America/Boise",
                    "America/Cambridge_Bay",
                    "America/Denver",
                    "America/Edmonton",
                    "America/Inuvik",
                    "America/Ojinaga",
                    "America/Yellowknife",
                    "MST7MDT"
                    ]
                },
                {
                    "value": "Central America Standard Time",
                    "abbr": "CAST",
                    "offset": -6,
                    "isdst": false,
                    "text": "(UTC-06:00) Central America",
                    "utc": [
                    "America/Belize",
                    "America/Costa_Rica",
                    "America/El_Salvador",
                    "America/Guatemala",
                    "America/Managua",
                    "America/Tegucigalpa",
                    "Etc/GMT+6",
                    "Pacific/Galapagos"
                    ]
                },
                {
                    "value": "Central Standard Time",
                    "abbr": "CDT",
                    "offset": -5,
                    "isdst": true,
                    "text": "(UTC-06:00) Central Time (US & Canada)",
                    "utc": [
                    "America/Chicago",
                    "America/Indiana/Knox",
                    "America/Indiana/Tell_City",
                    "America/Matamoros",
                    "America/Menominee",
                    "America/North_Dakota/Beulah",
                    "America/North_Dakota/Center",
                    "America/North_Dakota/New_Salem",
                    "America/Rainy_River",
                    "America/Rankin_Inlet",
                    "America/Resolute",
                    "America/Winnipeg",
                    "CST6CDT"
                    ]
                },
                {
                    "value": "Central Standard Time (Mexico)",
                    "abbr": "CDT",
                    "offset": -5,
                    "isdst": true,
                    "text": "(UTC-06:00) Guadalajara, Mexico City, Monterrey",
                    "utc": [
                    "America/Bahia_Banderas",
                    "America/Cancun",
                    "America/Merida",
                    "America/Mexico_City",
                    "America/Monterrey"
                    ]
                },
                {
                    "value": "Canada Central Standard Time",
                    "abbr": "CCST",
                    "offset": -6,
                    "isdst": false,
                    "text": "(UTC-06:00) Saskatchewan",
                    "utc": [
                    "America/Regina",
                    "America/Swift_Current"
                    ]
                },
                {
                    "value": "SA Pacific Standard Time",
                    "abbr": "SPST",
                    "offset": -5,
                    "isdst": false,
                    "text": "(UTC-05:00) Bogota, Lima, Quito",
                    "utc": [
                    "America/Bogota",
                    "America/Cayman",
                    "America/Coral_Harbour",
                    "America/Eirunepe",
                    "America/Guayaquil",
                    "America/Jamaica",
                    "America/Lima",
                    "America/Panama",
                    "America/Rio_Branco",
                    "Etc/GMT+5"
                    ]
                },
                {
                    "value": "Eastern Standard Time",
                    "abbr": "EST",
                    "offset": -5,
                    "isdst": false,
                    "text": "(UTC-05:00) Eastern Time (US & Canada)",
                    "utc": [
                    "America/Detroit",
                    "America/Havana",
                    "America/Indiana/Petersburg",
                    "America/Indiana/Vincennes",
                    "America/Indiana/Winamac",
                    "America/Iqaluit",
                    "America/Kentucky/Monticello",
                    "America/Louisville",
                    "America/Montreal",
                    "America/Nassau",
                    "America/New_York",
                    "America/Nipigon",
                    "America/Pangnirtung",
                    "America/Port-au-Prince",
                    "America/Thunder_Bay",
                    "America/Toronto"
                    ]
                },
                {
                    "value": "Eastern Daylight Time",
                    "abbr": "EDT",
                    "offset": -4,
                    "isdst": true,
                    "text": "(UTC-04:00) Eastern Daylight Time (US & Canada)",
                    "utc": [
                    "America/Detroit",
                    "America/Havana",
                    "America/Indiana/Petersburg",
                    "America/Indiana/Vincennes",
                    "America/Indiana/Winamac",
                    "America/Iqaluit",
                    "America/Kentucky/Monticello",
                    "America/Louisville",
                    "America/Montreal",
                    "America/Nassau",
                    "America/New_York",
                    "America/Nipigon",
                    "America/Pangnirtung",
                    "America/Port-au-Prince",
                    "America/Thunder_Bay",
                    "America/Toronto"
                    ]
                },
                {
                    "value": "US Eastern Standard Time",
                    "abbr": "UEDT",
                    "offset": -5,
                    "isdst": false,
                    "text": "(UTC-05:00) Indiana (East)",
                    "utc": [
                    "America/Indiana/Marengo",
                    "America/Indiana/Vevay",
                    "America/Indianapolis"
                    ]
                },
                {
                    "value": "Venezuela Standard Time",
                    "abbr": "VST",
                    "offset": -4.5,
                    "isdst": false,
                    "text": "(UTC-04:30) Caracas",
                    "utc": [
                    "America/Caracas"
                    ]
                },
                {
                    "value": "Paraguay Standard Time",
                    "abbr": "PYT",
                    "offset": -4,
                    "isdst": false,
                    "text": "(UTC-04:00) Asuncion",
                    "utc": [
                    "America/Asuncion"
                    ]
                },
                {
                    "value": "Atlantic Standard Time",
                    "abbr": "ADT",
                    "offset": -3,
                    "isdst": true,
                    "text": "(UTC-04:00) Atlantic Time (Canada)",
                    "utc": [
                    "America/Glace_Bay",
                    "America/Goose_Bay",
                    "America/Halifax",
                    "America/Moncton",
                    "America/Thule",
                    "Atlantic/Bermuda"
                    ]
                },
                {
                    "value": "Central Brazilian Standard Time",
                    "abbr": "CBST",
                    "offset": -4,
                    "isdst": false,
                    "text": "(UTC-04:00) Cuiaba",
                    "utc": [
                    "America/Campo_Grande",
                    "America/Cuiaba"
                    ]
                },
                {
                    "value": "SA Western Standard Time",
                    "abbr": "SWST",
                    "offset": -4,
                    "isdst": false,
                    "text": "(UTC-04:00) Georgetown, La Paz, Manaus, San Juan",
                    "utc": [
                    "America/Anguilla",
                    "America/Antigua",
                    "America/Aruba",
                    "America/Barbados",
                    "America/Blanc-Sablon",
                    "America/Boa_Vista",
                    "America/Curacao",
                    "America/Dominica",
                    "America/Grand_Turk",
                    "America/Grenada",
                    "America/Guadeloupe",
                    "America/Guyana",
                    "America/Kralendijk",
                    "America/La_Paz",
                    "America/Lower_Princes",
                    "America/Manaus",
                    "America/Marigot",
                    "America/Martinique",
                    "America/Montserrat",
                    "America/Port_of_Spain",
                    "America/Porto_Velho",
                    "America/Puerto_Rico",
                    "America/Santo_Domingo",
                    "America/St_Barthelemy",
                    "America/St_Kitts",
                    "America/St_Lucia",
                    "America/St_Thomas",
                    "America/St_Vincent",
                    "America/Tortola",
                    "Etc/GMT+4"
                    ]
                },
                {
                    "value": "Pacific SA Standard Time",
                    "abbr": "PSST",
                    "offset": -4,
                    "isdst": false,
                    "text": "(UTC-04:00) Santiago",
                    "utc": [
                    "America/Santiago",
                    "Antarctica/Palmer"
                    ]
                },
                {
                    "value": "Newfoundland Standard Time",
                    "abbr": "NDT",
                    "offset": -2.5,
                    "isdst": true,
                    "text": "(UTC-03:30) Newfoundland",
                    "utc": [
                    "America/St_Johns"
                    ]
                },
                {
                    "value": "E. South America Standard Time",
                    "abbr": "ESAST",
                    "offset": -3,
                    "isdst": false,
                    "text": "(UTC-03:00) Brasilia",
                    "utc": [
                    "America/Sao_Paulo"
                    ]
                },
                {
                    "value": "Argentina Standard Time",
                    "abbr": "AST",
                    "offset": -3,
                    "isdst": false,
                    "text": "(UTC-03:00) Buenos Aires",
                    "utc": [
                    "America/Argentina/La_Rioja",
                    "America/Argentina/Rio_Gallegos",
                    "America/Argentina/Salta",
                    "America/Argentina/San_Juan",
                    "America/Argentina/San_Luis",
                    "America/Argentina/Tucuman",
                    "America/Argentina/Ushuaia",
                    "America/Buenos_Aires",
                    "America/Catamarca",
                    "America/Cordoba",
                    "America/Jujuy",
                    "America/Mendoza"
                    ]
                },
                {
                    "value": "SA Eastern Standard Time",
                    "abbr": "SEST",
                    "offset": -3,
                    "isdst": false,
                    "text": "(UTC-03:00) Cayenne, Fortaleza",
                    "utc": [
                    "America/Araguaina",
                    "America/Belem",
                    "America/Cayenne",
                    "America/Fortaleza",
                    "America/Maceio",
                    "America/Paramaribo",
                    "America/Recife",
                    "America/Santarem",
                    "Antarctica/Rothera",
                    "Atlantic/Stanley",
                    "Etc/GMT+3"
                    ]
                },
                {
                    "value": "Greenland Standard Time",
                    "abbr": "GDT",
                    "offset": -3,
                    "isdst": true,
                    "text": "(UTC-03:00) Greenland",
                    "utc": [
                    "America/Godthab"
                    ]
                },
                {
                    "value": "Montevideo Standard Time",
                    "abbr": "MST",
                    "offset": -3,
                    "isdst": false,
                    "text": "(UTC-03:00) Montevideo",
                    "utc": [
                    "America/Montevideo"
                    ]
                },
                {
                    "value": "Bahia Standard Time",
                    "abbr": "BST",
                    "offset": -3,
                    "isdst": false,
                    "text": "(UTC-03:00) Salvador",
                    "utc": [
                    "America/Bahia"
                    ]
                },
                {
                    "value": "UTC-02",
                    "abbr": "U",
                    "offset": -2,
                    "isdst": false,
                    "text": "(UTC-02:00) Coordinated Universal Time-02",
                    "utc": [
                    "America/Noronha",
                    "Atlantic/South_Georgia",
                    "Etc/GMT+2"
                    ]
                },
                {
                    "value": "Mid-Atlantic Standard Time",
                    "abbr": "MDT",
                    "offset": -1,
                    "isdst": true,
                    "text": "(UTC-02:00) Mid-Atlantic - Old",
                    "utc": []
                },
                {
                    "value": "Azores Standard Time",
                    "abbr": "ADT",
                    "offset": 0,
                    "isdst": true,
                    "text": "(UTC-01:00) Azores",
                    "utc": [
                    "America/Scoresbysund",
                    "Atlantic/Azores"
                    ]
                },
                {
                    "value": "Cape Verde Standard Time",
                    "abbr": "CVST",
                    "offset": -1,
                    "isdst": false,
                    "text": "(UTC-01:00) Cape Verde Is.",
                    "utc": [
                    "Atlantic/Cape_Verde",
                    "Etc/GMT+1"
                    ]
                },
                {
                    "value": "Morocco Standard Time",
                    "abbr": "MDT",
                    "offset": 1,
                    "isdst": true,
                    "text": "(UTC) Casablanca",
                    "utc": [
                    "Africa/Casablanca",
                    "Africa/El_Aaiun"
                    ]
                },
                {
                    "value": "UTC",
                    "abbr": "UTC",
                    "offset": 0,
                    "isdst": false,
                    "text": "(UTC) Coordinated Universal Time",
                    "utc": [
                    "America/Danmarkshavn",
                    "Etc/GMT"
                    ]
                },
                {
                    "value": "GMT Standard Time",
                    "abbr": "GMT",
                    "offset": 0,
                    "isdst": false,
                    "text": "(UTC) Edinburgh, London",
                    "utc": [
                    "Europe/Isle_of_Man",
                    "Europe/Guernsey",
                    "Europe/Jersey",
                    "Europe/London"
                    ]
                },
                {
                    "value": "British Summer Time",
                    "abbr": "BST",
                    "offset": 1,
                    "isdst": true,
                    "text": "(UTC+01:00) Edinburgh, London",
                    "utc": [
                    "Europe/Isle_of_Man",
                    "Europe/Guernsey",
                    "Europe/Jersey",
                    "Europe/London"
                    ]
                },
                {
                    "value": "GMT Standard Time",
                    "abbr": "GDT",
                    "offset": 1,
                    "isdst": true,
                    "text": "(UTC) Dublin, Lisbon",
                    "utc": [
                    "Atlantic/Canary",
                    "Atlantic/Faeroe",
                    "Atlantic/Madeira",
                    "Europe/Dublin",
                    "Europe/Lisbon"
                    ]
                },
                {
                    "value": "Greenwich Standard Time",
                    "abbr": "GST",
                    "offset": 0,
                    "isdst": false,
                    "text": "(UTC) Monrovia, Reykjavik",
                    "utc": [
                    "Africa/Abidjan",
                    "Africa/Accra",
                    "Africa/Bamako",
                    "Africa/Banjul",
                    "Africa/Bissau",
                    "Africa/Conakry",
                    "Africa/Dakar",
                    "Africa/Freetown",
                    "Africa/Lome",
                    "Africa/Monrovia",
                    "Africa/Nouakchott",
                    "Africa/Ouagadougou",
                    "Africa/Sao_Tome",
                    "Atlantic/Reykjavik",
                    "Atlantic/St_Helena"
                    ]
                },
                {
                    "value": "W. Europe Standard Time",
                    "abbr": "WEDT",
                    "offset": 2,
                    "isdst": true,
                    "text": "(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna",
                    "utc": [
                    "Arctic/Longyearbyen",
                    "Europe/Amsterdam",
                    "Europe/Andorra",
                    "Europe/Berlin",
                    "Europe/Busingen",
                    "Europe/Gibraltar",
                    "Europe/Luxembourg",
                    "Europe/Malta",
                    "Europe/Monaco",
                    "Europe/Oslo",
                    "Europe/Rome",
                    "Europe/San_Marino",
                    "Europe/Stockholm",
                    "Europe/Vaduz",
                    "Europe/Vatican",
                    "Europe/Vienna",
                    "Europe/Zurich"
                    ]
                },
                {
                    "value": "Central Europe Standard Time",
                    "abbr": "CEDT",
                    "offset": 2,
                    "isdst": true,
                    "text": "(UTC+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague",
                    "utc": [
                    "Europe/Belgrade",
                    "Europe/Bratislava",
                    "Europe/Budapest",
                    "Europe/Ljubljana",
                    "Europe/Podgorica",
                    "Europe/Prague",
                    "Europe/Tirane"
                    ]
                },
                {
                    "value": "Romance Standard Time",
                    "abbr": "RDT",
                    "offset": 2,
                    "isdst": true,
                    "text": "(UTC+01:00) Brussels, Copenhagen, Madrid, Paris",
                    "utc": [
                    "Africa/Ceuta",
                    "Europe/Brussels",
                    "Europe/Copenhagen",
                    "Europe/Madrid",
                    "Europe/Paris"
                    ]
                },
                {
                    "value": "Central European Standard Time",
                    "abbr": "CEDT",
                    "offset": 2,
                    "isdst": true,
                    "text": "(UTC+01:00) Sarajevo, Skopje, Warsaw, Zagreb",
                    "utc": [
                    "Europe/Sarajevo",
                    "Europe/Skopje",
                    "Europe/Warsaw",
                    "Europe/Zagreb"
                    ]
                },
                {
                    "value": "W. Central Africa Standard Time",
                    "abbr": "WCAST",
                    "offset": 1,
                    "isdst": false,
                    "text": "(UTC+01:00) West Central Africa",
                    "utc": [
                    "Africa/Algiers",
                    "Africa/Bangui",
                    "Africa/Brazzaville",
                    "Africa/Douala",
                    "Africa/Kinshasa",
                    "Africa/Lagos",
                    "Africa/Libreville",
                    "Africa/Luanda",
                    "Africa/Malabo",
                    "Africa/Ndjamena",
                    "Africa/Niamey",
                    "Africa/Porto-Novo",
                    "Africa/Tunis",
                    "Etc/GMT-1"
                    ]
                },
                {
                    "value": "Namibia Standard Time",
                    "abbr": "NST",
                    "offset": 1,
                    "isdst": false,
                    "text": "(UTC+01:00) Windhoek",
                    "utc": [
                    "Africa/Windhoek"
                    ]
                },
                {
                    "value": "GTB Standard Time",
                    "abbr": "GDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) Athens, Bucharest",
                    "utc": [
                    "Asia/Nicosia",
                    "Europe/Athens",
                    "Europe/Bucharest",
                    "Europe/Chisinau"
                    ]
                },
                {
                    "value": "Middle East Standard Time",
                    "abbr": "MEDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) Beirut",
                    "utc": [
                    "Asia/Beirut"
                    ]
                },
                {
                    "value": "Egypt Standard Time",
                    "abbr": "EST",
                    "offset": 2,
                    "isdst": false,
                    "text": "(UTC+02:00) Cairo",
                    "utc": [
                    "Africa/Cairo"
                    ]
                },
                {
                    "value": "Syria Standard Time",
                    "abbr": "SDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) Damascus",
                    "utc": [
                    "Asia/Damascus"
                    ]
                },
                {
                    "value": "E. Europe Standard Time",
                    "abbr": "EEDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) E. Europe",
                    "utc": [
                    "Asia/Nicosia",
                    "Europe/Athens",
                    "Europe/Bucharest",
                    "Europe/Chisinau",
                    "Europe/Helsinki",
                    "Europe/Kiev",
                    "Europe/Mariehamn",
                    "Europe/Nicosia",
                    "Europe/Riga",
                    "Europe/Sofia",
                    "Europe/Tallinn",
                    "Europe/Uzhgorod",
                    "Europe/Vilnius",
                    "Europe/Zaporozhye"

                    ]
                },
                {
                    "value": "South Africa Standard Time",
                    "abbr": "SAST",
                    "offset": 2,
                    "isdst": false,
                    "text": "(UTC+02:00) Harare, Pretoria",
                    "utc": [
                    "Africa/Blantyre",
                    "Africa/Bujumbura",
                    "Africa/Gaborone",
                    "Africa/Harare",
                    "Africa/Johannesburg",
                    "Africa/Kigali",
                    "Africa/Lubumbashi",
                    "Africa/Lusaka",
                    "Africa/Maputo",
                    "Africa/Maseru",
                    "Africa/Mbabane",
                    "Etc/GMT-2"
                    ]
                },
                {
                    "value": "FLE Standard Time",
                    "abbr": "FDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius",
                    "utc": [
                    "Europe/Helsinki",
                    "Europe/Kiev",
                    "Europe/Mariehamn",
                    "Europe/Riga",
                    "Europe/Sofia",
                    "Europe/Tallinn",
                    "Europe/Uzhgorod",
                    "Europe/Vilnius",
                    "Europe/Zaporozhye"
                    ]
                },
                {
                    "value": "Turkey Standard Time",
                    "abbr": "TDT",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Istanbul",
                    "utc": [
                    "Europe/Istanbul"
                    ]
                },
                {
                    "value": "Israel Standard Time",
                    "abbr": "JDT",
                    "offset": 3,
                    "isdst": true,
                    "text": "(UTC+02:00) Jerusalem",
                    "utc": [
                    "Asia/Jerusalem"
                    ]
                },
                {
                    "value": "Libya Standard Time",
                    "abbr": "LST",
                    "offset": 2,
                    "isdst": false,
                    "text": "(UTC+02:00) Tripoli",
                    "utc": [
                    "Africa/Tripoli"
                    ]
                },
                {
                    "value": "Jordan Standard Time",
                    "abbr": "JST",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Amman",
                    "utc": [
                    "Asia/Amman"
                    ]
                },
                {
                    "value": "Arabic Standard Time",
                    "abbr": "AST",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Baghdad",
                    "utc": [
                    "Asia/Baghdad"
                    ]
                },
                {
                    "value": "Kaliningrad Standard Time",
                    "abbr": "KST",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+02:00) Kaliningrad",
                    "utc": [
                    "Europe/Kaliningrad"
                    ]
                },
                {
                    "value": "Arab Standard Time",
                    "abbr": "AST",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Kuwait, Riyadh",
                    "utc": [
                    "Asia/Aden",
                    "Asia/Bahrain",
                    "Asia/Kuwait",
                    "Asia/Qatar",
                    "Asia/Riyadh"
                    ]
                },
                {
                    "value": "E. Africa Standard Time",
                    "abbr": "EAST",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Nairobi",
                    "utc": [
                    "Africa/Addis_Ababa",
                    "Africa/Asmera",
                    "Africa/Dar_es_Salaam",
                    "Africa/Djibouti",
                    "Africa/Juba",
                    "Africa/Kampala",
                    "Africa/Khartoum",
                    "Africa/Mogadishu",
                    "Africa/Nairobi",
                    "Antarctica/Syowa",
                    "Etc/GMT-3",
                    "Indian/Antananarivo",
                    "Indian/Comoro",
                    "Indian/Mayotte"
                    ]
                },
                {
                    "value": "Moscow Standard Time",
                    "abbr": "MSK",
                    "offset": 3,
                    "isdst": false,
                    "text": "(UTC+03:00) Moscow, St. Petersburg, Volgograd, Minsk",
                    "utc": [
                        "Europe/Kirov",
                    "Europe/Moscow",
                    "Europe/Simferopol",
                    "Europe/Volgograd",
                    "Europe/Minsk"
                    ]
                },
                {
                    "value": "Samara Time",
                    "abbr": "SAMT",
                    "offset": 4,
                    "isdst": false,
                    "text": "(UTC+04:00) Samara, Ulyanovsk, Saratov",
                    "utc": [
                        "Europe/Astrakhan",
                    "Europe/Samara",
                        "Europe/Ulyanovsk"
                    ]
                },
                {
                    "value": "Iran Standard Time",
                    "abbr": "IDT",
                    "offset": 4.5,
                    "isdst": true,
                    "text": "(UTC+03:30) Tehran",
                    "utc": [
                    "Asia/Tehran"
                    ]
                },
                {
                    "value": "Arabian Standard Time",
                    "abbr": "AST",
                    "offset": 4,
                    "isdst": false,
                    "text": "(UTC+04:00) Abu Dhabi, Muscat",
                    "utc": [
                    "Asia/Dubai",
                    "Asia/Muscat",
                    "Etc/GMT-4"
                    ]
                },
                {
                    "value": "Azerbaijan Standard Time",
                    "abbr": "ADT",
                    "offset": 5,
                    "isdst": true,
                    "text": "(UTC+04:00) Baku",
                    "utc": [
                    "Asia/Baku"
                    ]
                },
                {
                    "value": "Mauritius Standard Time",
                    "abbr": "MST",
                    "offset": 4,
                    "isdst": false,
                    "text": "(UTC+04:00) Port Louis",
                    "utc": [
                    "Indian/Mahe",
                    "Indian/Mauritius",
                    "Indian/Reunion"
                    ]
                },
                {
                    "value": "Georgian Standard Time",
                    "abbr": "GET",
                    "offset": 4,
                    "isdst": false,
                    "text": "(UTC+04:00) Tbilisi",
                    "utc": [
                    "Asia/Tbilisi"
                    ]
                },
                {
                    "value": "Caucasus Standard Time",
                    "abbr": "CST",
                    "offset": 4,
                    "isdst": false,
                    "text": "(UTC+04:00) Yerevan",
                    "utc": [
                    "Asia/Yerevan"
                    ]
                },
                {
                    "value": "Afghanistan Standard Time",
                    "abbr": "AST",
                    "offset": 4.5,
                    "isdst": false,
                    "text": "(UTC+04:30) Kabul",
                    "utc": [
                    "Asia/Kabul"
                    ]
                },
                {
                    "value": "West Asia Standard Time",
                    "abbr": "WAST",
                    "offset": 5,
                    "isdst": false,
                    "text": "(UTC+05:00) Ashgabat, Tashkent",
                    "utc": [
                    "Antarctica/Mawson",
                    "Asia/Aqtau",
                    "Asia/Aqtobe",
                    "Asia/Ashgabat",
                    "Asia/Dushanbe",
                    "Asia/Oral",
                    "Asia/Samarkand",
                    "Asia/Tashkent",
                    "Etc/GMT-5",
                    "Indian/Kerguelen",
                    "Indian/Maldives"
                    ]
                },
                {
                    "value": "Yekaterinburg Time",
                    "abbr": "YEKT",
                    "offset": 5,
                    "isdst": false,
                    "text": "(UTC+05:00) Yekaterinburg",
                    "utc": [
                    "Asia/Yekaterinburg"
                    ]
                },
                {
                    "value": "Pakistan Standard Time",
                    "abbr": "PKT",
                    "offset": 5,
                    "isdst": false,
                    "text": "(UTC+05:00) Islamabad, Karachi",
                    "utc": [
                    "Asia/Karachi"
                    ]
                },
                {
                    "value": "India Standard Time",
                    "abbr": "IST",
                    "offset": 5.5,
                    "isdst": false,
                    "text": "(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi",
                    "utc": [
                    "Asia/Kolkata",
                    "Asia/Calcutta"
                    ]
                },
                {
                    "value": "Sri Lanka Standard Time",
                    "abbr": "SLST",
                    "offset": 5.5,
                    "isdst": false,
                    "text": "(UTC+05:30) Sri Jayawardenepura",
                    "utc": [
                    "Asia/Colombo"
                    ]
                },
                {
                    "value": "Nepal Standard Time",
                    "abbr": "NST",
                    "offset": 5.75,
                    "isdst": false,
                    "text": "(UTC+05:45) Kathmandu",
                    "utc": [
                    "Asia/Kathmandu"
                    ]
                },
                {
                    "value": "Central Asia Standard Time",
                    "abbr": "CAST",
                    "offset": 6,
                    "isdst": false,
                    "text": "(UTC+06:00) Nur-Sultan (Astana)",
                    "utc": [
                    "Antarctica/Vostok",
                    "Asia/Almaty",
                    "Asia/Bishkek",
                    "Asia/Qyzylorda",
                    "Asia/Urumqi",
                    "Etc/GMT-6",
                    "Indian/Chagos"
                    ]
                },
                {
                    "value": "Bangladesh Standard Time",
                    "abbr": "BST",
                    "offset": 6,
                    "isdst": false,
                    "text": "(UTC+06:00) Dhaka",
                    "utc": [
                    "Asia/Dhaka",
                    "Asia/Thimphu"
                    ]
                },
                {
                    "value": "Myanmar Standard Time",
                    "abbr": "MST",
                    "offset": 6.5,
                    "isdst": false,
                    "text": "(UTC+06:30) Yangon (Rangoon)",
                    "utc": [
                    "Asia/Rangoon",
                    "Indian/Cocos"
                    ]
                },
                {
                    "value": "SE Asia Standard Time",
                    "abbr": "SAST",
                    "offset": 7,
                    "isdst": false,
                    "text": "(UTC+07:00) Bangkok, Hanoi, Jakarta",
                    "utc": [
                    "Antarctica/Davis",
                    "Asia/Bangkok",
                    "Asia/Hovd",
                    "Asia/Jakarta",
                    "Asia/Phnom_Penh",
                    "Asia/Pontianak",
                    "Asia/Saigon",
                    "Asia/Vientiane",
                    "Etc/GMT-7",
                    "Indian/Christmas"
                    ]
                },
                {
                    "value": "N. Central Asia Standard Time",
                    "abbr": "NCAST",
                    "offset": 7,
                    "isdst": false,
                    "text": "(UTC+07:00) Novosibirsk",
                    "utc": [
                    "Asia/Novokuznetsk",
                    "Asia/Novosibirsk",
                    "Asia/Omsk"
                    ]
                },
                {
                    "value": "China Standard Time",
                    "abbr": "CST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi",
                    "utc": [
                    "Asia/Hong_Kong",
                    "Asia/Macau",
                    "Asia/Shanghai"
                    ]
                },
                {
                    "value": "North Asia Standard Time",
                    "abbr": "NAST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Krasnoyarsk",
                    "utc": [
                    "Asia/Krasnoyarsk"
                    ]
                },
                {
                    "value": "Singapore Standard Time",
                    "abbr": "MPST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Kuala Lumpur, Singapore",
                    "utc": [
                    "Asia/Brunei",
                    "Asia/Kuala_Lumpur",
                    "Asia/Kuching",
                    "Asia/Makassar",
                    "Asia/Manila",
                    "Asia/Singapore",
                    "Etc/GMT-8"
                    ]
                },
                {
                    "value": "W. Australia Standard Time",
                    "abbr": "WAST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Perth",
                    "utc": [
                    "Antarctica/Casey",
                    "Australia/Perth"
                    ]
                },
                {
                    "value": "Taipei Standard Time",
                    "abbr": "TST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Taipei",
                    "utc": [
                    "Asia/Taipei"
                    ]
                },
                {
                    "value": "Ulaanbaatar Standard Time",
                    "abbr": "UST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Ulaanbaatar",
                    "utc": [
                    "Asia/Choibalsan",
                    "Asia/Ulaanbaatar"
                    ]
                },
                {
                    "value": "North Asia East Standard Time",
                    "abbr": "NAEST",
                    "offset": 8,
                    "isdst": false,
                    "text": "(UTC+08:00) Irkutsk",
                    "utc": [
                    "Asia/Irkutsk"
                    ]
                },
                {
                    "value": "Japan Standard Time",
                    "abbr": "JST",
                    "offset": 9,
                    "isdst": false,
                    "text": "(UTC+09:00) Osaka, Sapporo, Tokyo",
                    "utc": [
                    "Asia/Dili",
                    "Asia/Jayapura",
                    "Asia/Tokyo",
                    "Etc/GMT-9",
                    "Pacific/Palau"
                    ]
                },
                {
                    "value": "Korea Standard Time",
                    "abbr": "KST",
                    "offset": 9,
                    "isdst": false,
                    "text": "(UTC+09:00) Seoul",
                    "utc": [
                    "Asia/Pyongyang",
                    "Asia/Seoul"
                    ]
                },
                {
                    "value": "Cen. Australia Standard Time",
                    "abbr": "CAST",
                    "offset": 9.5,
                    "isdst": false,
                    "text": "(UTC+09:30) Adelaide",
                    "utc": [
                    "Australia/Adelaide",
                    "Australia/Broken_Hill"
                    ]
                },
                {
                    "value": "AUS Central Standard Time",
                    "abbr": "ACST",
                    "offset": 9.5,
                    "isdst": false,
                    "text": "(UTC+09:30) Darwin",
                    "utc": [
                    "Australia/Darwin"
                    ]
                },
                {
                    "value": "E. Australia Standard Time",
                    "abbr": "EAST",
                    "offset": 10,
                    "isdst": false,
                    "text": "(UTC+10:00) Brisbane",
                    "utc": [
                    "Australia/Brisbane",
                    "Australia/Lindeman"
                    ]
                },
                {
                    "value": "AUS Eastern Standard Time",
                    "abbr": "AEST",
                    "offset": 10,
                    "isdst": false,
                    "text": "(UTC+10:00) Canberra, Melbourne, Sydney",
                    "utc": [
                    "Australia/Melbourne",
                    "Australia/Sydney"
                    ]
                },
                {
                    "value": "West Pacific Standard Time",
                    "abbr": "WPST",
                    "offset": 10,
                    "isdst": false,
                    "text": "(UTC+10:00) Guam, Port Moresby",
                    "utc": [
                    "Antarctica/DumontDUrville",
                    "Etc/GMT-10",
                    "Pacific/Guam",
                    "Pacific/Port_Moresby",
                    "Pacific/Saipan",
                    "Pacific/Truk"
                    ]
                },
                {
                    "value": "Tasmania Standard Time",
                    "abbr": "TST",
                    "offset": 10,
                    "isdst": false,
                    "text": "(UTC+10:00) Hobart",
                    "utc": [
                    "Australia/Currie",
                    "Australia/Hobart"
                    ]
                },
                {
                    "value": "Yakutsk Standard Time",
                    "abbr": "YST",
                    "offset": 9,
                    "isdst": false,
                    "text": "(UTC+09:00) Yakutsk",
                    "utc": [
                    "Asia/Chita",
                    "Asia/Khandyga",
                    "Asia/Yakutsk"
                    ]
                },
                {
                    "value": "Central Pacific Standard Time",
                    "abbr": "CPST",
                    "offset": 11,
                    "isdst": false,
                    "text": "(UTC+11:00) Solomon Is., New Caledonia",
                    "utc": [
                    "Antarctica/Macquarie",
                    "Etc/GMT-11",
                    "Pacific/Efate",
                    "Pacific/Guadalcanal",
                    "Pacific/Kosrae",
                    "Pacific/Noumea",
                    "Pacific/Ponape"
                    ]
                },
                {
                    "value": "Vladivostok Standard Time",
                    "abbr": "VST",
                    "offset": 11,
                    "isdst": false,
                    "text": "(UTC+11:00) Vladivostok",
                    "utc": [
                    "Asia/Sakhalin",
                    "Asia/Ust-Nera",
                    "Asia/Vladivostok"
                    ]
                },
                {
                    "value": "New Zealand Standard Time",
                    "abbr": "NZST",
                    "offset": 12,
                    "isdst": false,
                    "text": "(UTC+12:00) Auckland, Wellington",
                    "utc": [
                    "Antarctica/McMurdo",
                    "Pacific/Auckland"
                    ]
                },
                {
                    "value": "UTC+12",
                    "abbr": "U",
                    "offset": 12,
                    "isdst": false,
                    "text": "(UTC+12:00) Coordinated Universal Time+12",
                    "utc": [
                    "Etc/GMT-12",
                    "Pacific/Funafuti",
                    "Pacific/Kwajalein",
                    "Pacific/Majuro",
                    "Pacific/Nauru",
                    "Pacific/Tarawa",
                    "Pacific/Wake",
                    "Pacific/Wallis"
                    ]
                },
                {
                    "value": "Fiji Standard Time",
                    "abbr": "FST",
                    "offset": 12,
                    "isdst": false,
                    "text": "(UTC+12:00) Fiji",
                    "utc": [
                    "Pacific/Fiji"
                    ]
                },
                {
                    "value": "Magadan Standard Time",
                    "abbr": "MST",
                    "offset": 12,
                    "isdst": false,
                    "text": "(UTC+12:00) Magadan",
                    "utc": [
                    "Asia/Anadyr",
                    "Asia/Kamchatka",
                    "Asia/Magadan",
                    "Asia/Srednekolymsk"
                    ]
                },
                {
                    "value": "Kamchatka Standard Time",
                    "abbr": "KDT",
                    "offset": 13,
                    "isdst": true,
                    "text": "(UTC+12:00) Petropavlovsk-Kamchatsky - Old",
                    "utc": [
                    "Asia/Kamchatka"
                    ]
                },
                {
                    "value": "Tonga Standard Time",
                    "abbr": "TST",
                    "offset": 13,
                    "isdst": false,
                    "text": "(UTC+13:00) Nuku'alofa",
                    "utc": [
                    "Etc/GMT-13",
                    "Pacific/Enderbury",
                    "Pacific/Fakaofo",
                    "Pacific/Tongatapu"
                    ]
                },
                {
                    "value": "Samoa Standard Time",
                    "abbr": "SST",
                    "offset": 13,
                    "isdst": false,
                    "text": "(UTC+13:00) Samoa",
                    "utc": [
                    "Pacific/Apia"
                    ]
                }
            ],
            errors:{},
            spinner:{}
        }
    },
    computed:{
        ...mapGetters(['isLogedIn', 'getUser', 'getAccount']),
        timezone:{
            get() { return this.$store.state.signupProcess_availability.availability.av_timezone; },  
            set(value) { this.$store.commit('set_av_timezone', value); }
        },
        hourly_rate:{
            get() { return this.$store.state.signupProcess_availability.availability.hourly_rate; },  
            set(value) { this.$store.commit('set_hourly_rate', value); }
        },
        monday:{
            get() { return this.$store.state.signupProcess_availability.availability.monday; },
            set(value) { this.$store.commit('set_monday', is_available, from, to); }
            
        },
        tuesday:{
            get() { return this.$store.state.signupProcess_availability.availability.tuesday; },
            set(value) { this.$store.commit('set_tuesday', is_available, from, to); }
        },
        wednesday:{
            get() { return this.$store.state.signupProcess_availability.availability.wednesday; },
            set(value) { this.$store.commit('set_wednesday', is_available, from, to); }
        },
        thursday:{
            get() { return this.$store.state.signupProcess_availability.availability.thursday; },
            set(value) { this.$store.commit('set_thursday', is_available, from, to); }
        },
        friday:{
            get() { return this.$store.state.signupProcess_availability.availability.friday; },
            set(value) { this.$store.commit('set_friday', is_available, from, to); }
        },
        saturday:{
            get() { return this.$store.state.signupProcess_availability.availability.saturday; },
            set(value) { this.$store.commit('set_saturday', is_available, from, to); }
        },
        sunday:{
            get() { return this.$store.state.signupProcess_availability.availability.sunday; },
            set(value) { this.$store.commit('set_sunday', is_available, from, to); }
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
            document.getElementById('availability').classList.add('hidden');
            document.getElementById('finish').classList.remove('hidden');
        },
        
       submitForm(){           
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            this.spinner.submit_availability = true;
            var form_data = new FormData();
                form_data.append('first_name', this.getUser.first_name);
                form_data.append('last_name', this.getUser.last_name);
                form_data.append('timezone', this.$store.state.signupProcess_availability.availability.av_timezone);
                form_data.append('hourly_rate', this.$store.state.signupProcess_availability.availability.hourly_rate);

                form_data.append('monday', JSON.stringify(this.$store.state.signupProcess_availability.availability.monday));
                form_data.append('tuesday', JSON.stringify(this.$store.state.signupProcess_availability.availability.tuesday));
                form_data.append('wednesday', JSON.stringify(this.$store.state.signupProcess_availability.availability.wednesday));
                form_data.append('thursday', JSON.stringify(this.$store.state.signupProcess_availability.availability.thursday));
                form_data.append('friday', JSON.stringify(this.$store.state.signupProcess_availability.availability.friday));
                form_data.append('saturday', JSON.stringify(this.$store.state.signupProcess_availability.availability.saturday));
                form_data.append('sunday', JSON.stringify(this.$store.state.signupProcess_availability.availability.sunday));            
                form_data.append('availability', true); 
                form_data.append('local_timezone', moment.tz.guess());
                form_data.append('_method', 'PUT');
                
            axios.post('/api/user/' + this.getUser.id , form_data)             
            .then(response=>{
                this.spinner = {}
                this.nextStep();
            })
            .catch(error=>{   
                this.spinner = {}             
                console.log(error.response);
            })
        },
        validateForm(){
            this.errors={};

            if(! this.monday.is_available && ! this.tuesday.is_available && ! this.wednesday.is_available && ! this.thursday.is_available && ! this.thursday.is_available && ! this.friday.is_available && ! this.saturday.is_available && ! this.sunday.is_available) this.errors.availability ="Please set up your available days."
            if(! this.timezone) this.errors.timezone = "Please setup your timezone";
            if(! this.hourly_rate) this.errors.hourly_rate = "Please setup your hourly rate";
            if( this.hourly_rate < 5) this.errors.hourly_rate = "Minimum hourly rate is 5 usd";
        },
        populateFormFields(){
            this.timezone  =  this.getUser.timezone;
            this.hourly_rate =  this.getUser.hourly_rate;

            if(! this.getUser.tutor_schedule) return;

            this.monday.is_available = this.getUser.tutor_schedule.monday ? true : false;
            this.monday.from = this.getUser.tutor_schedule.monday_from;
            this.monday.to = this.getUser.tutor_schedule.monday_to;

            this.tuesday.is_available = this.getUser.tutor_schedule.tuesday ? true : false;
            this.tuesday.from = this.getUser.tutor_schedule.tuesday_from;
            this.tuesday.to = this.getUser.tutor_schedule.tuesday_to;

            this.wednesday.is_available = this.getUser.tutor_schedule.wednesday ? true : false;
            this.wednesday.from = this.getUser.tutor_schedule.wednesday_from;
            this.wednesday.to = this.getUser.tutor_schedule.wednesday_to;

            this.thursday.is_available = this.getUser.tutor_schedule.thursday ? true : false;
            this.thursday.from = this.getUser.tutor_schedule.thursday_from;
            this.thursday.to = this.getUser.tutor_schedule.thursday_to;

            this.friday.is_available = this.getUser.tutor_schedule.friday ? true : false;
            this.friday.from = this.getUser.tutor_schedule.friday_from;
            this.friday.to = this.getUser.tutor_schedule.friday_to;

            this.saturday.is_available = this.getUser.tutor_schedule.saturday ? true : false;
            this.saturday.from = this.getUser.tutor_schedule.saturday_from;
            this.saturday.to = this.getUser.tutor_schedule.saturday_to;

            this.sunday.is_available = this.getUser.tutor_schedule.sunday ? true : false;
            this.sunday.from = this.getUser.tutor_schedule.sunday_from;
            this.sunday.to = this.getUser.tutor_schedule.sunday_to;
        }
    },
    mounted(){
        this.populateFormFields();
        }
}
</script>

<style>


</style>