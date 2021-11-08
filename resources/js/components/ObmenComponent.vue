<template>
    <div class="wrap-select-option" >
        <div class="loadingio-spinner-spinner-a5somt2npz" v-show="isLoading"><div class="ldio-cuoiwrivni7">
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div></div>
        <div class="currency-box">

            <div class="section-input" @click="handlerSelect('dropdownyFrom')">
                <span :class="[{active: dropdownyFrom}, 'icon-arrow-down-gray']"></span>

                <div class="customSelect">

                    <a class="chosen-single">
                        <input hidden type="text"
                               v-model="currency_from"
                        >
                         <template>
                            <div class="countBlock" @click.stop>
                                <span v-show="pairCurrencyItem.length != 0" class="topSubText">{{ messages[lang].giveMoney }}</span>
                                <currency-input
                                        v-model="count_from"
                                        :options="{ currency: 'EUR', currencyDisplay: 'hidden', precision: 0 }"
                                        :value="count_from"
                                        class="inputFrom"
                                />
                                <span  v-show="pairCurrencyItem.length != 0" class="buttomSubText">1 {{currency_from}} = {{ rateFrom }} {{currency_to}}</span>
                            </div>
                            <div class="currentCurrency">
                                <span class="placeholder"><span class="currencyImg"><img :src="'/images/currency/'+ currency_from +'.png'" /></span><strong>{{ currency_from }}</strong></span>
                            </div>

                        </template>
                    </a>

                    <ul class="dropdownSelect" v-show="dropdownyFrom">
                        <li class="option" v-for="probe in currency_from_array"
                            @click="getOptionInSelect($event, 'isEmptyCurrencyFrom', 'dropdownyFrom')"
                            :data-name="probe"
                            :value="probe"
                        ><span class="currencyImg"><img :src="'/images/currency/'+ probe +'.png'" /></span><strong>{{ probe }}</strong><span class="currencyName">{{ messages[lang][probe] }}</span></li>
                    </ul>

                </div>
            </div>

        </div>
        <div class="switch-currency">

            <label class="checkbox-label" @change="switchRate()">
                <input type="checkbox" v-model="isBuy" style="display: none">
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
            <div class="section-input" @click="handlerSelect('dropdownyTo')">
                <span :class="[{active: dropdownyTo}, 'icon-arrow-down-gray']"></span>

                <div class="customSelect">

                    <a class="chosen-single">
                        <input hidden type="text"
                               v-model="currency_to"
                        >

                        <template else >
                            <span v-show="pairCurrencyItem.length == 0" class="notFoundSmile"><img src="/images/png-clipart-iphone-emoji-sadness.png"/></span>
                            <div class="countBlock" @click.stop v-show="pairCurrencyItem.length != 0">
                                <span v-show="pairCurrencyItem.length != 0" class="topSubText">{{ messages[lang].getMoney }}</span>
                                <span class="currency_to">{{ count_to }}</span>
                                <span v-show="pairCurrencyItem.length != 0" class="buttomSubText">1 {{currency_to}} = {{ rateTo }} {{currency_from}}</span>
                            </div>
                            <div class="currentCurrency">
                                <span class="placeholder"><span class="currencyImg"><img :src="'/images/currency/'+ currency_to +'.png'" /></span><strong>{{ currency_to }}</strong></span>
                            </div>

                        </template>
                    </a>

                    <ul class="dropdownSelect" v-show="dropdownyTo">
                        <li class="option" v-for="probe in currency_from_array"
                            @click="getOptionInSelect($event, 'isEmptyCurrencyTo', 'dropdownyTo')"
                            :data-name="probe"
                            :value="probe"
                        ><span class="currencyImg"><img :src="'/images/currency/'+ probe +'.png'" /></span><strong>{{ probe }}</strong><span class="currencyName">{{ messages[lang][probe] }}</span></li>
                    </ul>

                </div>
            </div>

        </div>
        <span class="errorFoundCurrency" v-bind="pairCurrencyItem" v-show="pairCurrencyItem.length == 0">{{ messages[lang].no_found}}</span>
    </div>

</template>

<script>
    // typical import
    import { bus } from '../app';
    import { gsap, ScrollTrigger, Draggable, MotionPathPlugin } from "gsap/all";
    import { lang } from '../mixins';
    import { messages } from '../helpers/messages';
    import vSelect from 'vue-select'
    import "vue-select/src/scss/vue-select.scss";
    import CurrencyInput from './CurrencyInput'
    export default {
        components: {
            vSelect,
            CurrencyInput
        },
        mixins: [ lang ],

        data() {
            return {
                options: [],
                currency_from_array: ["UAH","USD","EUR","RUR","PLN","GBP","CHF","CZK"],
                currency_from: 'USD',
                currency_to: 'UAH',
                count_from: 0,
                rateFrom: 0,
                rateTo: 0,
                isBuy:true,
                isOpt:false,
                BuyOrSales: 'buy',
                pairCurrencyItem: [],
                isLoading: true,
                dropdownyFrom: false,
                dropdownyTo: false,
                isEmptyCurrencyFrom: true,
                isEmptyCurrencyTo: true
            }
        },
        methods: {
            focusOnInput({currentTarget}) {
                currentTarget.querySelector('input').focus();
            },

            getOptionInSelect({currentTarget}, propEmpty, drop) {
                if (propEmpty == 'isEmptyCurrencyFrom') {
                    this.isEmptyCurrencyFrom = true
                    this.currency_from = currentTarget.getAttribute("data-name");

                }
                if (propEmpty == 'isEmptyCurrencyTo') {
                    this.isEmptyCurrencyTo = true
                    this.currency_to = currentTarget.getAttribute("data-name");
                }

                if (this[drop] != true) {
                    this[drop] = true
                }


            },

            handlerSelect(prop) {
                this[prop] = !this[prop]
            },
            switchRate: function switchSaleBuy () {
                var cur_from = this.currency_from;
                var cur_to = this.currency_to;
                this.currency_to = cur_from;
                this.currency_from = cur_to;
                if(this.isBuy == true){
                    gsap.to($('.switchCurrency'), 0.5, {
                        rotate: 0
                    });
                }
                else {
                    gsap.to($('.switchCurrency'), 0.5, {
                        rotate: 180
                    });
                }
            },
            getThisRate: function getThisRate(cur_from, cur_to){
                this.pairCurrencyItem = this.options.filter((j) => {
                    return ((j.currency_from === cur_from) && (j.currency_to === cur_to)) || ((j.currency_to === cur_from) && (j.currency_from === cur_to))
                })[0] ? this.options.filter((j) => {
                    return ((j.currency_from === cur_from) && (j.currency_to === cur_to)) || ((j.currency_to === cur_from) && (j.currency_from === cur_to))
                })[0] : [];
                if( this.pairCurrencyItem.length != 0 )
                {

                    if(this.currency_from == this.pairCurrencyItem.currency_from)
                    {
                        this.BuyOrSales = 'buy';
                        if(this.isOpt == true)
                        {
                            this.rateFrom = this.pairCurrencyItem.buy_opt.toFixed(5);
                            this.rateTo = (1/this.pairCurrencyItem.buy_opt).toFixed(5);
                        }
                        else {
                            this.rateFrom = this.pairCurrencyItem.buy.toFixed(5);
                            this.rateTo = (1/this.pairCurrencyItem.buy).toFixed(5);
                        }

                    }
                    else {
                        this.BuyOrSales = 'sale';

                        if(this.isOpt == true)
                        {
                            this.rateFrom = (1/this.pairCurrencyItem.sale_opt).toFixed(5);
                            this.rateTo = this.pairCurrencyItem.sale_opt.toFixed(5);
                        }
                        else {
                            this.rateFrom = (1/this.pairCurrencyItem.sale).toFixed(5);
                            this.rateTo = this.pairCurrencyItem.sale.toFixed(5);
                        }
                    }
                }
            },
        },

        beforeMount(){

        },
        computed: {

            messages: () => messages,

            count_to: function () {
                var count_from = this.count_from;
                var rateFrom = this.rateFrom;
                return (count_from*rateFrom).toFixed(2);
            },
            /*rateTo: function () {
                var pairCurrencyItem = this.pairCurrencyItem;
                var BuyOrSale = this.BuyOrSale;
                if(BuyOrSale == 'buy')
                {
                    return (1/pairCurrencyItem[0].buy).toFixed(3);
                }
                else if(BuyOrSale == 'sale') {
                    return pairCurrencyItem[0].sale.toFixed(3);
                }
                else
                {
                    return 0;
                }
            },
            */


        },
        watch: {
            currency_from: function (val) {
                bus.$emit('currency_from',val);
                var cur_from = this.currency_from;
                var cur_to = this.currency_to;
                this.getThisRate(cur_from, cur_to);

            },
            currency_to: function (val) {
                bus.$emit('currency_to',val);
                var cur_from = this.currency_from;
                var cur_to = this.currency_to;
                this.getThisRate(cur_from, cur_to);
            },
            isOpt: function (val) {
                var cur_from = this.currency_from;
                var cur_to = this.currency_to;
                this.getThisRate(cur_from, cur_to);
            },
            count_from: function (val) {
                bus.$emit('count_from',val);

            },
            options: {
                handler: function() {
                    var cur_from = this.currency_from;
                    var cur_to = this.currency_to;
                    this.getThisRate(cur_from, cur_to);
                },
                deep: true
            }
        },
        mounted() {
            this.setLang();
            bus.$on('currency_from',data => {this.currency_from = data});
            bus.$on('currency_to',data => {this.currency_to = data});
            bus.$on('optionArray', data => {this.options = data, this.pairCurrencyItem = data[0]});
            bus.$on('count_from',data => {this.count_from = data});
            bus.$on('isOpt',data => {this.isOpt = data});
            setTimeout(() => {
                this.getThisRate(this.currency_from, this.currency_to);
                this.isLoading = false;
            }, 2000);
            window.addEventListener('mouseup', () => {
                if (this.dropdownyFrom === true) {
                    this.dropdownyFrom = false;
                }
                if (this.dropdownyTo === true) {
                    this.dropdownyTo = false;
                }
            });
        },
    }
</script>