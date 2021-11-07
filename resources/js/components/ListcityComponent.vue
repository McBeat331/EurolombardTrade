<template>
    <div class="selectCity" :style="'z-index:'+zIndex">
        <div class="mcontainer">
            <div class="backgroundWrapper" v-show="dropdownyCity" @click="dropdownyCity = false"></div>
            <div class="section-input" @click="handlerSelect('dropdownyCity')">
                <svg width="18" height="23" viewBox="0 0 18 23" fill="none" xmlns="http://www.w3.org/2000/svg" :class="[{active: dropdownyCity}, 'locationIco']">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 2C5.4686 2 2 4.63241 2 9C2 11.605 3.77047 14.3616 5.74741 16.5856C6.71242 17.6713 7.68054 18.5792 8.4085 19.2162C8.63119 19.411 8.83072 19.5799 9 19.7202C9.16928 19.5799 9.36881 19.411 9.5915 19.2162C10.3195 18.5792 11.2876 17.6713 12.2526 16.5856C14.2295 14.3616 16 11.605 16 9C16 4.63241 12.5314 2 9 2ZM9 21C8.4 21.8 8.39978 21.7998 8.39953 21.7997L8.39888 21.7992L8.39703 21.7978L8.39117 21.7933L8.37091 21.778C8.35368 21.7648 8.32907 21.746 8.29758 21.7216C8.23461 21.6728 8.14406 21.6017 8.02986 21.51C7.80155 21.3265 7.47822 21.0597 7.0915 20.7213C6.31946 20.0458 5.28758 19.0787 4.25259 17.9144C2.22953 15.6384 0 12.395 0 9C0 3.36759 4.5314 0 9 0C13.4686 0 18 3.36759 18 9C18 12.395 15.7705 15.6384 13.7474 17.9144C12.7124 19.0787 11.6805 20.0458 10.9085 20.7213C10.5218 21.0597 10.1984 21.3265 9.97014 21.51C9.85594 21.6017 9.76539 21.6728 9.70242 21.7216C9.67093 21.746 9.64632 21.7648 9.62909 21.778L9.60883 21.7933L9.60297 21.7978L9.60112 21.7992L9.60047 21.7997C9.60022 21.7998 9.6 21.8 9 21ZM9 21L9.6 21.8L9 22.25L8.4 21.8L9 21ZM6.17157 6.17157C6.92172 5.42143 7.93913 5 9 5C10.0609 5 11.0783 5.42143 11.8284 6.17157C12.5786 6.92172 13 7.93913 13 9C13 10.0609 12.5786 11.0783 11.8284 11.8284C11.0783 12.5786 10.0609 13 9 13C7.93913 13 6.92172 12.5786 6.17157 11.8284C5.42143 11.0783 5 10.0609 5 9C5 7.93913 5.42143 6.92172 6.17157 6.17157ZM9 7C8.46957 7 7.96086 7.21071 7.58579 7.58579C7.21071 7.96086 7 8.46957 7 9C7 9.53043 7.21071 10.0391 7.58579 10.4142C7.96086 10.7893 8.46957 11 9 11C9.53043 11 10.0391 10.7893 10.4142 10.4142C10.7893 10.0391 11 9.53043 11 9C11 8.46957 10.7893 7.96086 10.4142 7.58579C10.0391 7.21071 9.53043 7 9 7Z" fill="#FFC244"/>
                </svg>
                <div class="customSelect">

                    <a :class="[{active: dropdownyCity}, 'chosen-single']">
                        <input hidden type="text"
                               v-model="selectedCity.id"
                        >
                        <span class="selectCityName">{{ selectedCityName }}</span>
                    </a>
                    <span :class="[{active: dropdownyCity}, 'icon-arrow-down-gray']"></span>

                    <ul class="dropdownSelect" v-show="dropdownyCity">
                        <li class="option" v-for="city in city_array"
                            @click="getOptionInSelect($event, 'isEmptyCity', 'dropdownyCity')"
                            :data-city="city.id"
                            :value="city.id"
                        ><a :href="'http://'+ city.domain + currentUrl"><span class="cityOption">{{ messages[lang].cityLetter }} {{ city.name[lang] }}</span></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // typical import
    import { bus } from '../app';
    import { gsap, ScrollTrigger, Draggable, MotionPathPlugin } from "gsap/all";
    import { lang } from '../mixins';
    import { messages } from '../helpers/messages';

    export default {
        mixins: [ lang ],



        data() {
            return {
                dropdownyCity: false,
                isEmptyCity: false,
                selectedCity: [],
                city_array: [],
                selectedCityName: '',
                currentUrl: '',
                zIndex: 50,
            }
        },
        methods: {
            loadCity: function loadData() {
                axios({
                    method: 'post',
                    url: '/ajax/getCities',
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded"
                    }
                })
                    .then(res => {
                        //res.json().then(json => (vm.options = json.data.data));
                        this.city_array = res.data.data;
                        this.selectedCity = this.city_array.filter((j) => {
                            return ((j.current === true))
                        })[0] ? this.city_array.filter((j) => {
                            return ((j.current === true))
                        })[0] : [];
                        this.selectedCityName = this.messages[this.lang].cityLetter +' '+this.selectedCity.name[this.lang]
                    })
                    .catch(error => console.log(error));
            },
            handlerSelect(prop) {
                this[prop] = !this[prop];
                if(this[prop] == true)
                {
                    this.zIndex = 500;
                }
                else
                {
                    this.zIndex = 50;
                }
            },
            getOptionInSelect({currentTarget}, propEmpty, drop) {
                if (propEmpty == 'isEmptyCity') {

                    var city_id = currentTarget.getAttribute("value");
                    this.isEmptyCity = true
                    this.selectedCity = this.city_array.filter((j) => {
                        return ((j.id == city_id))
                    })[0] ? this.city_array.filter((j) => {
                        return ((j.id == city_id))
                    })[0] : [];
                    this.selectedCityName = this.messages[this.lang].cityLetter +' '+this.selectedCity.name[this.lang]
                }

                if (this[drop] != true) {
                    this[drop] = true
                }


            },
        },

        beforeMount(){

        },

        computed: {

            messages: () => messages,

        },
        watch: {

        },
        mounted() {
            this.setLang();
            this.loadCity();
            this.currentUrl = window.location.pathname;
        },
    }
</script>