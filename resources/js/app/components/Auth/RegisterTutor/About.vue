<template>
  <div class="mx-auto input-form">
       <h4>About you</h4>
       <div class="mx-auto">
           <form action="">
               <div class="mb-3">
                    <label for="firstname" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstname" v-model="first_name">
                    <small class="text-danger small">{{this.errors.first_name}}</small>
                </div>
               <div class="mb-3">
                    <label for="middlename" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middlename" v-model="middle_name">
                    <small class="text-danger small">{{this.errors.middle_name}}</small>
                </div>
               <div class="mb-3">
                    <label for="lastame" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastame" v-model="last_name">
                    <small class="text-danger small">{{this.errors.last_name}}</small>
                </div>

                <div class=" rouded mb-3 px-1 row" >
                    <label for="country" class="form-label">Country / City</label>
                    <vueCountriesCities id="country" @country='selectedCountry = $event' @city='selectedCity = $event'  @change="updateCountryCity()" class="text-muted"/>   
                    <small class="text-danger small">{{this.errors.country}}</small> 
                    <small class="text-danger small float-end">{{this.errors.city}}</small>            
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="timezone" class="form-label">Timezone</label>
                        <select  id="timezone"  v-model="timezone" class="bg-white w-100 p-2 border rounded text-muted">
                            <option value="" selected> -Select- </option>
                            <option :value="item.value" id="timezone" v-for="(item,index) in this.timezones" :key="index"> {{item.value}}</option>
                        </select>                      
                        <small class="text-danger small">{{this.errors.timezone}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="currency" class="form-label">Currency</label>
                        <select  id="currency" v-model="currency" class="w-100 p-2 border rounded bg-white text-muted">
                            <option value="" selected> -Select- </option>
                            <option :value="index" v-for="(item, index) in this.currencies" :key="index">{{item}}</option>
                        </select>
                        
                        <small class="text-danger small">{{this.errors.currency}}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="language" class="form-label">Language</label>
                        <select id="language" v-model="language" class="w-100 border rounded bg-white p-2 text-muted">
                            <option value="" selected> -Select- </option>
                            <option :value="item.name" v-for="(item, index) in this.languages" :key="index">{{item.name}}</option>
                        </select>
                        <small class="text-danger small">{{this.errors.language}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <select  id="level" v-model="level" class="w-100 border rounded bg-white p-2 text-muted">
                            <option value="" selected ="selected"> -Select- </option>
                            <option value="intermidiate"> Intermidiate</option>
                            <option value="expert" > Fluent</option>
                            <option value="native" > Native</option>
                        </select>
                        <small class="text-danger small">{{this.errors.level}}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="subject" class="form-label">Subject to teach</label>
                        <select id="language" v-model="subject" class="w-100 border rounded bg-white p-2 text-muted">
                            <option value="" selected> -Select- </option>
                            <option :value="item.name" v-for="(item, index) in this.languages" :key="index">{{item.name}}</option>
                        </select>
                        <small class="text-danger small">{{this.errors.subject}}</small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="la" class="form-label">Level </label>
                         <select  id="la" v-model="subject_level" class="w-100 border rounded bg-white p-2 text-muted">
                            <option value="" selected ="selected"> -Select- </option>
                            <option value="begginer" > Beginer </option>
                            <option value="intermidiate"> Intermidiate</option>
                            <option value="expert" > Expert</option>
                        </select>
                        <small class="text-danger small">{{this.errors.subject_level}}</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description </label>
                    <textarea  cols="30" rows="5" class="p-2 form-control" id="description" placeholder="Introduce yourself with a short text description..." v-model="description"></textarea>
                    <br> <small class="text-danger small">{{this.errors.description}}</small>
                </div >
                

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" v-model="over18">
                    <label class="form-check-label" for="disabledFieldsetCheck">Im am over 18 </label> <br>
                    <small class="text-danger small">{{this.errors.over18}}</small>
                </div>

                <div class="text-center pt-3">
                    <button class="btn btn-secondary m-1">Cancel</button>
                    <button class="btn btn-danger m-1" @click.prevent="this.nextStep()">Continue</button>
                </div>
           </form>
       </div>
   </div>

</template>

<script>
import moment from 'moment-timezone';
import vueCountriesCities from "vue-countries-cities";

export default {
components: { vueCountriesCities },
    data(){
        return{
            selectedCountry: '',
            selectedCity: '',
            errors:{},
            timezone:null,
            currency:null,
            languages:{
                "af": {
                    "name": "Afrikaans",
                    "speakers": 15200000
                },
                "am": {
                    "name": "Amharic",
                    "speakers": 25800000
                },
                "sq": {
                    "name": "Albanian",
                    "speakers": 7500000
                },
                "ar": {
                    "name": "Arabic",
                    "speakers": 425000000
                },
                "hy": {
                    "name": "Armenian",
                    "speakers": 6400000
                },
                "az": {
                    "name": "Azerbaijani",
                    "speakers": 28000000
                },
                "eu": {
                    "name": "Basque",
                    "speakers": 720000
                },
                "be": {
                    "name": "Belarusian",
                    "speakers": 8600000
                },
                "bn": {
                    "name": "Bengali",
                    "speakers": 250000000
                },
                "bs": {
                    "name": "Bosnian",
                    "speakers": 3500000
                },
                "bg": {
                    "name": "Bulgarian",
                    "speakers": 9100000
                },
                "ca": {
                    "name": "Catalan",
                    "speakers": 11500000
                },
                "ceb": {
                    "name": "Cebuano",
                    "speakers": 21000000
                },
                "ny": {
                    "name": "Chichewa",
                    "speakers": 12000000
                },
                "zh": {
                    "name": "Chinese",
                    "speakers": 1026000000
                },
                "co": {
                    "name": "Corsican",
                    "speakers": 200000
                },
                "hr": {
                    "name": "Croatian",
                    "speakers": 16000000
                },
                "cs": {
                    "name": "Czech",
                    "speakers": 9500000
                },
                "da": {
                    "name": "Danish",
                    "speakers": 5600000
                },
                "nl": {
                    "name": "Dutch",
                    "speakers": 22000000
                },
                "sjn": {
                    "name": "Elvish",
                    "speakers": 1200000
                },
                "en": {
                    "name": "English",
                    "speakers": 765000000
                },
                "eo": {
                    "name": "Esperanto",
                    "speakers": 2000000
                },
                "et": {
                    "name": "Estonian",
                    "speakers": 1200000
                },
                "tl": {
                    "name": "Filipino",
                    "speakers": 25000000
                },
                "fo": {
                    "name": "Faroese",
                    "speakers": null
                },
                "fj": {
                    "name": "Fijian",
                    "speakers": 5000000
                },
                "fi": {
                    "name": "Finnish",
                    "speakers": 5000000
                },
                "fr": {
                    "name": "French",
                    "speakers": 68500000
                },
                "fy": {
                    "name": "Frisian",
                    "speakers": 470000
                },
                "gl": {
                    "name": "Galician",
                    "speakers": 2400000
                },
                "ka": {
                    "name": "Georgian",
                    "speakers": 4300000
                },
                "de": {
                    "name": "German",
                    "speakers": 111800000
                },
                "el": {
                    "name": "Greek",
                    "speakers": 13000000
                },
                "gu": {
                    "name": "Gujarati",
                    "speakers": 46600000
                },
                "haw": {
                    "name": "Hawaiian",
                    "speakers": 2000
                },
                "ht": {
                    "name": "Haitian Creole",
                    "speakers": 7700000
                },
                "ha": {
                    "name": "Hausa",
                    "speakers": 40000000
                },
                "he": {
                    "name": "Hebrew",
                    "speakers": 5300000
                },
                "hi": {
                    "name": "Hindi",
                    "speakers": 12500000
                },
                "hmn": {
                    "name": "Hmong",
                    "speakers": 4000000
                },
                "hu": {
                    "name": "Hungarian",
                    "speakers": 12500000
                },
                "is": {
                    "name": "Icelandic",
                    "speakers": 330000
                },
                "ig": {
                    "name": "Igbo",
                    "speakers": 18000000
                },
                "id": {
                    "name": "Indonesian",
                    "speakers": 23000000
                },
                "iu": {
                    "name": "Inuktitut",
                    "speakers": 34000
                },
                "iku": {
                    "name": "Inuinnaqtun",
                    "speakers": 410
                },
                "ga": {
                    "name": "Irish",
                    "speakers": 1000000
                },
                "it": {
                    "name": "Italian",
                    "speakers": 61100000
                },
                "ja": {
                    "name": "Japanese",
                    "speakers": 123000000
                },
                "jw": {
                    "name": "Javanese",
                    "speakers": 84300000
                },
                "kk": {
                    "name": "qazaq tili",
                    "speakers": 11000000
                },
                "kn": {
                    "name": "Kannada",
                    "speakers": 46700000
                },
                "km": {
                    "name": "Khmer",
                    "speakers": 16000000
                },
                "ko": {
                    "name": "Korean",
                    "speakers": 66400000
                },
                "kok": {
                    "name": "Konkani",
                    "speakers": 7400000
                },
                "ky": {
                    "name": "Кyrgyz",
                    "speakers": 4300000
                },
                "ku": {
                    "name": "Kurdish",
                    "speakers": 30000000
                },
                "ckb": {
                    "name": "Central Kurdish",
                    "speakers": 7250000
                },
                "sdh": {
                    "name": "Southern Kurdish",
                    "speakers": 5390000
                },
                "lo": {
                    "name": "Lao",
                    "speakers": 20000000
                },
                "lv": {
                    "name": "Latvian",
                    "speakers": 1700000
                },
                "lt": {
                    "name": "Lithuanian",
                    "speakers": 3000000
                },
                "lb": {
                    "name": "Luxembourgish",
                    "speakers": 390000
                },
                "mk": {
                    "name": "Macedonian",
                    "speakers": 2500000
                },
                "mg": {
                    "name": "Malagasy",
                    "speakers": 18000000
                },
                "ms": {
                    "name": "Malay",
                    "speakers": 59400000
                },
                "ml": {
                    "name": "Malayalam",
                    "speakers": 38000000
                },
                "mt": {
                    "name": "Maltese",
                    "speakers": 520000
                },
                "mr": {
                    "name": "Marathi",
                    "speakers": 71800000
                },
                "mn": {
                    "name": "Mongolian",
                    "speakers": 5700000
                },
                "mi": {
                    "name": "Māori",
                    "speakers": 60000
                },
                "my": {
                    "name": "Burmese",
                    "speakers": 42900000
                },
                "ne": {
                    "name": "Nepali",
                    "speakers": 14000000
                },
                "no": {
                    "name": "Norwegian",
                    "speakers": 5000000
                },
                "pap": {
                    "name": "Papiamento",
                    "speakers": 260000
                },
                "fa": {
                    "name": "Persian",
                    "speakers": 56600000
                },
                "pl": {
                    "name": "Polish",
                    "speakers": 39000000
                },
                "pt": {
                    "name": "Portuguese",
                    "speakers": 217000000
                },
                "pa": {
                    "name": "Punjabi",
                    "speakers": 29500000
                },
                "ps": {
                    "name": "Pashto",
                    "speakers": 60000000
                },
                "otq": {
                    "name": "Hñohño",
                    "speakers": 260000
                },
                "ro": {
                    "name": "Romanian",
                    "speakers": 23000000
                },
                "ru": {
                    "name": "Russian",
                    "speakers": 272000000
                },
                "sm": {
                    "name": "Samoan",
                    "speakers": 510000
                },
                "gd": {
                    "name": "Scottish Gaelic",
                    "speakers": 87000
                },
                "sr": {
                    "name": "Serbian",
                    "speakers": 16000000
                },
                "sr-LA": {
                    "name": "Serbian",
                    "speakers": 16000000
                },
                "sd": {
                    "name": "Sindhi",
                    "speakers": 75000000
                },
                "si": {
                    "name": "Sinhalese",
                    "speakers": 16000000
                },
                "sk": {
                    "name": "Slovak",
                    "speakers": 5000000
                },
                "sl": {
                    "name": "Slovenian",
                    "speakers": 2500000
                },
                "sn": {
                    "name": "Slovenian",
                    "speakers": 2500000
                },
                "st": {
                    "name": "Sotho",
                    "speakers": 5600000
                },
                "so": {
                    "name": "Somali",
                    "speakers": 14000000
                },
                "es": {
                    "name": "Spanish",
                    "speakers": 466000000
                },
                "su": {
                    "name": "Sundanese",
                    "speakers": 38000000
                },
                "sw": {
                    "name": "Swahili",
                    "speakers": 140000000
                },
                "sv": {
                    "name": "Swedish",
                    "speakers": 8300000
                },
                "ty": {
                    "name": "Tahitian",
                    "speakers": 68000
                },
                "ta": {
                    "name": "Tamil",
                    "speakers": 76800000
                },
                "tg": {
                    "name": "Tajik",
                    "speakers": 8400000
                },
                "te": {
                    "name": "Telugu",
                    "speakers": 79000000
                },
                "th": {
                    "name": "Thai",
                    "speakers": 60000000
                },
                "bo": {
                    "name": "Tibetan",
                    "speakers": 1200000
                },
                "to": {
                    "name": "Tongan",
                    "speakers": 96000
                },
                "tr": {
                    "name": "Turkish",
                    "speakers": 50700000
                },
                "uk": {
                    "name": "Ukrainian",
                    "speakers": 36000000
                },
                "ur": {
                    "name": "Urdu",
                    "speakers": 63400000
                },
                "uz": {
                    "name": "Uzbek",
                    "speakers": 27000000
                },
                "vi": {
                    "name": "Vietnamese",
                    "speakers": 67800000
                },
                "cy": {
                    "name": "Welsh",
                    "speakers": 740000
                },
                "xh": {
                    "name": "Xhosa",
                    "speakers": 8200000
                },
                "yi": {
                    "name": "Yiddish",
                    "speakers": 1500000
                },
                "yo": {
                    "name": "Yoruba",
                    "speakers": 21000000
                },
                "yua": {
                    "name": "Yucatec Maya",
                    "speakers": 790000
                },
                "yue": {
                    "name": "Yueh",
                    "speakers": 60000000
                },
                "zu": {
                    "name": "Zulu",
                    "speakers": 26000000
                }
            },
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
            currencies:{
                "AED": "United Arab Emirates Dirham",
                "AFN": "Afghan Afghani",
                "ALL": "Albanian Lek",
                "AMD": "Armenian Dram",
                "ANG": "Netherlands Antillean Guilder",
                "AOA": "Angolan Kwanza",
                "ARS": "Argentine Peso",
                "AUD": "Australian Dollar",
                "AWG": "Aruban Florin",
                "AZN": "Azerbaijani Manat",
                "BAM": "Bosnia-Herzegovina Convertible Mark",
                "BBD": "Barbadian Dollar",
                "BDT": "Bangladeshi Taka",
                "BGN": "Bulgarian Lev",
                "BHD": "Bahraini Dinar",
                "BIF": "Burundian Franc",
                "BMD": "Bermudan Dollar",
                "BND": "Brunei Dollar",
                "BOB": "Bolivian Boliviano",
                "BRL": "Brazilian Real",
                "BSD": "Bahamian Dollar",
                "BTC": "Bitcoin",
                "BTN": "Bhutanese Ngultrum",
                "BWP": "Botswanan Pula",
                "BYN": "Belarusian Ruble",
                "BZD": "Belize Dollar",
                "CAD": "Canadian Dollar",
                "CDF": "Congolese Franc",
                "CHF": "Swiss Franc",
                "CLF": "Chilean Unit of Account (UF)",
                "CLP": "Chilean Peso",
                "CNH": "Chinese Yuan (Offshore)",
                "CNY": "Chinese Yuan",
                "COP": "Colombian Peso",
                "CRC": "Costa Rican Colón",
                "CUC": "Cuban Convertible Peso",
                "CUP": "Cuban Peso",
                "CVE": "Cape Verdean Escudo",
                "CZK": "Czech Republic Koruna",
                "DJF": "Djiboutian Franc",
                "DKK": "Danish Krone",
                "DOP": "Dominican Peso",
                "DZD": "Algerian Dinar",
                "EGP": "Egyptian Pound",
                "ERN": "Eritrean Nakfa",
                "ETB": "Ethiopian Birr",
                "EUR": "Euro",
                "FJD": "Fijian Dollar",
                "FKP": "Falkland Islands Pound",
                "GBP": "British Pound Sterling",
                "GEL": "Georgian Lari",
                "GGP": "Guernsey Pound",
                "GHS": "Ghanaian Cedi",
                "GIP": "Gibraltar Pound",
                "GMD": "Gambian Dalasi",
                "GNF": "Guinean Franc",
                "GTQ": "Guatemalan Quetzal",
                "GYD": "Guyanaese Dollar",
                "HKD": "Hong Kong Dollar",
                "HNL": "Honduran Lempira",
                "HRK": "Croatian Kuna",
                "HTG": "Haitian Gourde",
                "HUF": "Hungarian Forint",
                "IDR": "Indonesian Rupiah",
                "ILS": "Israeli New Sheqel",
                "IMP": "Manx pound",
                "INR": "Indian Rupee",
                "IQD": "Iraqi Dinar",
                "IRR": "Iranian Rial",
                "ISK": "Icelandic Króna",
                "JEP": "Jersey Pound",
                "JMD": "Jamaican Dollar",
                "JOD": "Jordanian Dinar",
                "JPY": "Japanese Yen",
                "KES": "Kenyan Shilling",
                "KGS": "Kyrgystani Som",
                "KHR": "Cambodian Riel",
                "KMF": "Comorian Franc",
                "KPW": "North Korean Won",
                "KRW": "South Korean Won",
                "KWD": "Kuwaiti Dinar",
                "KYD": "Cayman Islands Dollar",
                "KZT": "Kazakhstani Tenge",
                "LAK": "Laotian Kip",
                "LBP": "Lebanese Pound",
                "LKR": "Sri Lankan Rupee",
                "LRD": "Liberian Dollar",
                "LSL": "Lesotho Loti",
                "LYD": "Libyan Dinar",
                "MAD": "Moroccan Dirham",
                "MDL": "Moldovan Leu",
                "MGA": "Malagasy Ariary",
                "MKD": "Macedonian Denar",
                "MMK": "Myanma Kyat",
                "MNT": "Mongolian Tugrik",
                "MOP": "Macanese Pataca",
                "MRU": "Mauritanian Ouguiya",
                "MUR": "Mauritian Rupee",
                "MVR": "Maldivian Rufiyaa",
                "MWK": "Malawian Kwacha",
                "MXN": "Mexican Peso",
                "MYR": "Malaysian Ringgit",
                "MZN": "Mozambican Metical",
                "NAD": "Namibian Dollar",
                "NGN": "Nigerian Naira",
                "NIO": "Nicaraguan Córdoba",
                "NOK": "Norwegian Krone",
                "NPR": "Nepalese Rupee",
                "NZD": "New Zealand Dollar",
                "OMR": "Omani Rial",
                "PAB": "Panamanian Balboa",
                "PEN": "Peruvian Nuevo Sol",
                "PGK": "Papua New Guinean Kina",
                "PHP": "Philippine Peso",
                "PKR": "Pakistani Rupee",
                "PLN": "Polish Zloty",
                "PYG": "Paraguayan Guarani",
                "QAR": "Qatari Rial",
                "RON": "Romanian Leu",
                "RSD": "Serbian Dinar",
                "RUB": "Russian Ruble",
                "RWF": "Rwandan Franc",
                "SAR": "Saudi Riyal",
                "SBD": "Solomon Islands Dollar",
                "SCR": "Seychellois Rupee",
                "SDG": "Sudanese Pound",
                "SEK": "Swedish Krona",
                "SGD": "Singapore Dollar",
                "SHP": "Saint Helena Pound",
                "SLL": "Sierra Leonean Leone",
                "SOS": "Somali Shilling",
                "SRD": "Surinamese Dollar",
                "SSP": "South Sudanese Pound",
                "STD": "São Tomé and Príncipe Dobra (pre-2018)",
                "STN": "São Tomé and Príncipe Dobra",
                "SVC": "Salvadoran Colón",
                "SYP": "Syrian Pound",
                "SZL": "Swazi Lilangeni",
                "THB": "Thai Baht",
                "TJS": "Tajikistani Somoni",
                "TMT": "Turkmenistani Manat",
                "TND": "Tunisian Dinar",
                "TOP": "Tongan Pa'anga",
                "TRY": "Turkish Lira",
                "TTD": "Trinidad and Tobago Dollar",
                "TWD": "New Taiwan Dollar",
                "TZS": "Tanzanian Shilling",
                "UAH": "Ukrainian Hryvnia",
                "UGX": "Ugandan Shilling",
                "USD": "United States Dollar",
                "UYU": "Uruguayan Peso",
                "UZS": "Uzbekistan Som",
                "VEF": "Venezuelan Bolívar Fuerte (Old)",
                "VES": "Venezuelan Bolívar Soberano",
                "VND": "Vietnamese Dong",
                "VUV": "Vanuatu Vatu",
                "WST": "Samoan Tala",
                "XAF": "CFA Franc BEAC",
                "XAG": "Silver Ounce",
                "XAU": "Gold Ounce",
                "XCD": "East Caribbean Dollar",
                "XDR": "Special Drawing Rights",
                "XOF": "CFA Franc BCEAO",
                "XPD": "Palladium Ounce",
                "XPF": "CFP Franc",
                "XPT": "Platinum Ounce",
                "YER": "Yemeni Rial",
                "ZAR": "South African Rand",
                "ZMW": "Zambian Kwacha",
                "ZWL": "Zimbabwean Dollar"
            },
        }
    },
    
    computed:{
        first_name:{
            get() { return this.$store.state.signupProcess_about.about.first_name; },
            set(value) { this.$store.commit('set_first_name', value); }
        },
        middle_name:{
            get() { return this.$store.state.signupProcess_about.about.middle_name;  },
            set(value) {  this.$store.commit('set_middle_name', value);  }
        },
        last_name:{
            get() {  return this.$store.state.signupProcess_about.about.last_name; },
            set(value) { this.$store.commit('set_last_name', value); }
        },
        country:{
            get() {  return this.$store.state.signupProcess_about.about.country;  },
            set(value) {  this.$store.commit('set_country', value);  }
        },
        city:{
            get() {  return this.$store.state.signupProcess_about.about.city;},
            set(value) {  this.$store.commit('set_city', value); }
        },
        timezone:{
            get() {  return this.$store.state.signupProcess_about.about.timezone; },
            set(value) {  this.$store.commit('set_timezone', value);}
        },
        currency:{
            get() { return this.$store.state.signupProcess_about.about.currency;},           
            set(value) {  this.$store.commit('set_currency', value); }
        },
        language:{
            get() { return this.$store.state.signupProcess_about.about.language;},           
            set(value) {  this.$store.commit('set_language', value); }
        },
        level:{
            get() { return this.$store.state.signupProcess_about.about.level;},           
            set(value) { this.$store.commit('set_level', value); }
        },
        subject:{
            get() { return this.$store.state.signupProcess_about.about.subject;},           
            set(value) {  this.$store.commit('set_subject', value); }
        },
        subject_level:{
            get() { return this.$store.state.signupProcess_about.about.subject_level;},           
            set(value) {  this.$store.commit('set_subject_level', value); }
        },
        phone:{
            get() { return this.$store.state.signupProcess_about.about.phone;},           
            // set(value) {  this.$store.commit('set_phone', value); }
        },
        over18:{
            get() { return this.$store.state.signupProcess_about.about.over18;},           
            set(value) {  this.$store.commit('set_over18', value); }
        },
        description:{
            get() { return this.$store.state.signupProcess_about.about.description;},           
            set(value) {  this.$store.commit('set_description_about', value); }
        },
    },
     methods:{
        updateCountryCity(){
            this.$store.commit('set_country', this.selectedCountry);
            this.$store.commit('set_city', this.selectedCity);
        },
        timezone(){
            console.log(moment.tz.names()) ;
            return moment.tz.names();
         },
        logFile(){
            console.log(this.$store.state.signupProcess_about.about);
        },
        nextStep(){            
            this.validateForm();
            if(Object.keys(this.errors).length) return;

            document.getElementById('about').classList.add('hidden');
            document.getElementById('photo').classList.remove('hidden');
        },
        validateForm(){
            this.updateCountryCity();
            this.errors={};
            if(! this.$store.state.signupProcess_about.about.first_name) this.errors.first_name = "First name field is required";            
            if(! this.$store.state.signupProcess_about.about.middle_name) this.errors.middle_name = "Middle name field is required";           
            if(! this.$store.state.signupProcess_about.about.last_name) this.errors.last_name = "Last name field is required";
           
            if(! this.$store.state.signupProcess_about.about.country) this.errors.country = "County field is required";
            if(! this.$store.state.signupProcess_about.about.city) this.errors.city = "City field is required";
            
            if(! this.$store.state.signupProcess_about.about.timezone) this.errors.timezone = "timezone field is required";
            if(! this.$store.state.signupProcess_about.about.currency) this.errors.currency = "Currency field is required";
            
            if(! this.$store.state.signupProcess_about.about.language) this.errors.language = "Language field is required";
            if(! this.$store.state.signupProcess_about.about.level) this.errors.level = "Level field is required";
            if(! this.$store.state.signupProcess_about.about.subject) this.errors.subject = "Subject field is required";
            
            if(! this.$store.state.signupProcess_about.about.subject_level) this.errors.subject_level = "Level field is required";
            if(! this.$store.state.signupProcess_about.about.over18) this.errors.over18 = "Confirm you are an adult";

            if(! this.$store.state.signupProcess_about.about.description) this.errors.description = "Please provide a short description of yourself";
        }
    },
    mounted(){
       
    }

}
</script>

<style>
.countries-cities{
    padding:0 !important;
    z-index:0 !important;
}
.countries, .cities{
    color:rgb(141, 141, 141) !important;
}
.countries-cities .select-box{
    min-width:20px !important;
    width:48% !important;
    border-radius:5px;
    overflow:hidden;     
}
.countries-cities .select-box svg path {
    fill:rgb(212, 212, 212) !important;
    font-size:1rem;
}


</style>