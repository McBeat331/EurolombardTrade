<template>
    <div>
                <div class="calculatorWrapForm main-page shell-form">
                    <div class="leftSection ">

                        <div class="title visible-viewportchecker visibility--check">
                            <span>Курси валют</span>
                            <div class="wrapper-btn-check">
                                <div>
										<span
                                                @click="switcherValues" :class="[{active: !isOpt}, 'btn-check']">
											{{ messages[lang].true }}
										</span>
                                    <span @click="switcherValues" :class="[{active: isOpt}, 'btn-check']">
											{{ messages[lang].false }}
										</span>
                                </div>
                            </div>
                        </div>

                        <div class="toggle-blocks">
                            <div class="wrap-form">
                                <obmen/>
                                <modal v-show="showModal" @close-modal="showModal = false" :currency_from="{ currency_from }" :currency_to="{ currency_to }"/>
                                <div class="showButton">
                                    <button @click="showModals()" >Обміняти</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- <div :class="[{list_active: activeList}, result-blocks]" >  -->
                    <div class="result-blocks" >
                        <div class="splash-screen"></div>
                    </div>

                </div>



        <div class="listRate">
            <div class="rateItemsTitle">
                <div class="rateNameTitle">{{ messages[lang].rateName }}</div>
                <div class="rateBuyTitle">{{ messages[lang].rateBuy }}</div>
                <div class="rateSaleTitle">{{ messages[lang].rateSale }}</div>
                <div class="rateModalTitle">{{ messages[lang].rateModal }}</div>
            </div>
            <div class="rateItem" v-for="rate in options" :key="rate.id">
                <div class="rateName">{{rate.currency_from}}/{{rate.currency_to}}</div>
                <div class="rateBuy">{{rate.buy}}</div>
                <div class="rateSale">{{rate.sale}}</div>
                <div class="rateModal"><button @click="showModals(rate.currency_from,rate.currency_to,0)" >Обміняти</button></div>
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
    import obmen from './ObmenComponent.vue'
    import modal from './ModalComponent.vue'

    export default {
        components: {
            obmen,
            modal
        },
        mixins: [ lang ],



        data() {
            return {
                showModal: false,
                options: [],
                currency_from: 'USD',
                currency_to: 'UAH',
                count_from: 0,
                isOpt:false
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
                        this.options = res.data.data;
                        bus.$emit('optionArray', this.options);
                    })
                    .catch(error => console.log(error));
            },
            intervalLoad: function intervalLoad(){
                var th = this;
                setInterval(function () {
                    th.loadData();
                },30000)
            },
            showModals: function (currency_from = this.currency_from, currency_to = this.currency_to, count_from = this.count_from) {
                this.showModal = true;
                bus.$emit('currency_to',currency_to);
                bus.$emit('currency_from',currency_from);
                bus.$emit('count_from',count_from);

            },
            switcherValues: function () {
                this.isOpt = !this.isOpt
                bus.$emit('isOpt',this.isOpt);
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
            this.loadData();
            this.intervalLoad();
            bus.$on('currency_from',data => {this.currency_from = data});
            bus.$on('currency_to',data => {this.currency_to = data});
            bus.$on('count_from',data => {this.count_from = data});
        },
    }
</script>