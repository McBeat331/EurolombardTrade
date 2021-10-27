<template>
    <div>
        <form action="#" class="calc-form">
            <div class="wrap-select-option">
                <div class="currency-box">
                    <v-select :options="options" label="name" :searchable="false">
                        <template #selected-option="{ buy, currency }">
                            <div style="display: flex; align-items: baseline">
                                <strong>{{ currency }}</strong>
                                <em style="margin-left: 0.5rem">buy {{ buy }}</em>
                            </div>
                        </template>
                        <template #option="{ buy, currency }">
                            <h3 style="margin: 0">{{ currency }}</h3>
                            <em>{{ buy }}</em>
                        </template>
                        <template #no-options="{ search, searching, loading }">
                            {{ messages[lang].no_found}}
                        </template>
                    </v-select>
                </div>
                <div class="switch-currency">
                        <input id="check" type="checkbox" v-model="isBuy" style="display: none">
                        <label for="check" class="checkbox-label">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="switchCurrency">
                            <circle cx="40" cy="40" r="40" fill="#FFC244"/>
                            <g clip-path="url(#clip0_0:1)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M48.75 57.5C49.0815 57.5 49.3995 57.3683 49.6339 57.1338C49.8683 56.8994 50 56.5815 50 56.25V26.7675L57.865 34.635C58.0997 34.8697 58.4181 35.0015 58.75 35.0015C59.082 35.0015 59.4003 34.8697 59.635 34.635C59.8697 34.4002 60.0016 34.0819 60.0016 33.75C60.0016 33.418 59.8697 33.0997 59.635 32.865L49.635 22.865C49.5189 22.7486 49.381 22.6562 49.2291 22.5932C49.0772 22.5302 48.9144 22.4977 48.75 22.4977C48.5856 22.4977 48.4228 22.5302 48.2709 22.5932C48.1191 22.6562 47.9811 22.7486 47.865 22.865L37.865 32.865C37.6303 33.0997 37.4984 33.418 37.4984 33.75C37.4984 34.0819 37.6303 34.4002 37.865 34.635C38.0997 34.8697 38.4181 35.0015 38.75 35.0015C39.082 35.0015 39.4003 34.8697 39.635 34.635L47.5 26.7675V56.25C47.5 56.5815 47.6317 56.8994 47.8661 57.1338C48.1006 57.3683 48.4185 57.5 48.75 57.5V57.5ZM31.25 22.5C31.5815 22.5 31.8995 22.6317 32.1339 22.8661C32.3683 23.1005 32.5 23.4184 32.5 23.75V53.2325L40.365 45.365C40.4812 45.2487 40.6192 45.1566 40.7711 45.0937C40.9229 45.0308 41.0857 44.9984 41.25 44.9984C41.4144 44.9984 41.5771 45.0308 41.729 45.0937C41.8808 45.1566 42.0188 45.2487 42.135 45.365C42.2512 45.4812 42.3434 45.6192 42.4063 45.771C42.4692 45.9229 42.5016 46.0856 42.5016 46.25C42.5016 46.4143 42.4692 46.5771 42.4063 46.7289C42.3434 46.8808 42.2512 47.0187 42.135 47.135L32.135 57.135C32.0189 57.2514 31.881 57.3437 31.7291 57.4067C31.5772 57.4698 31.4144 57.5022 31.25 57.5022C31.0856 57.5022 30.9228 57.4698 30.7709 57.4067C30.6191 57.3437 30.4811 57.2514 30.365 57.135L20.365 47.135C20.1303 46.9002 19.9984 46.5819 19.9984 46.25C19.9984 45.918 20.1303 45.5997 20.365 45.365C20.5997 45.1302 20.9181 44.9984 21.25 44.9984C21.582 44.9984 21.9003 45.1302 22.135 45.365L30 53.2325V23.75C30 23.4184 30.1317 23.1005 30.3661 22.8661C30.6006 22.6317 30.9185 22.5 31.25 22.5Z" fill="#2F2483"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_0:1">
                                    <rect width="40" height="40" fill="white" transform="translate(20 60) rotate(-90)"/>
                                </clipPath>
                            </defs>
                        </svg>
                        </label>
                </div>
                <div class="currency-box">
                    <v-select :options="options" label="name" :searchable="false">
                        <template #selected-option="{ buy, currency }">
                            <div style="display: flex; align-items: baseline">
                                <strong>{{ currency }}</strong>
                                <em style="margin-left: 0.5rem">buy {{ buy }}</em>
                            </div>
                        </template>
                        <template #option="{ buy, currency }">
                            <h3 style="margin: 0">{{ currency }}</h3>
                            <em>{{ buy }}</em>
                        </template>
                        <template #no-options="{ search, searching, loading }">
                            {{ messages[lang].no_found}}
                        </template>
                    </v-select>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
    // typical import
    import { gsap, ScrollTrigger, Draggable, MotionPathPlugin } from "gsap/all";
    import { lang } from '../mixins';
    import { messages } from '../helpers/messages';
    import vSelect from 'vue-select'
    import "vue-select/src/scss/vue-select.scss";
    export default {
        components: {
            vSelect,
        },
        mixins: [ lang ],



        data() {
            return {
                options: [],
                isBuy:true
            }
        },
        methods: {
            loadData: function loadData() {
                axios({
                        method: 'post',
                        url: '/ajax/getRatesByCity',
                        data: {
                            address_id: 1,
                        },
                        headers: {
                            "Content-type": "application/x-www-form-urlencoded"
                        }
                    })
                    .then(res => {
                        //res.json().then(json => (vm.options = json.data.data));
                        this.options = res.data.data
                        console.log(this.options)
                    })
                    .catch(error => console.log(error));
            },
        },

        beforeMount(){

        },

        computed: {

            messages: () => messages,

        },
        watch: {
            isBuy: function() {
                if(this.isBuy == true){
                    gsap.to($('.switchCurrency'), 0.5, {
                        rotate: 180
                    });
                }
                else {
                    gsap.to($('.switchCurrency'), 0.5, {
                        rotate: 0
                    });
                }

            }
        },
        mounted() {
            this.setLang();
            this.loadData();
        },
    }
</script>