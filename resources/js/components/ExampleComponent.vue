<template>
    <div>
        <form action="#" class="calc-form" @submit.prevent="handleCalc">
            <div class="wrap-select-option">
                <div class="check-box">
                    <input id="check" type="checkbox" @change="checkedCheckbox"  v-model="isScrap">
                    <label for="check" class="checkbox-label"></label>
                    <span>{{ messages[lang].scrap_check}}{{ isScrap }}</span>
                </div>
            </div>
        </form>
    </div>
</template>


<script>

    import { lang } from '../mixins';
    import { messages } from '../helpers/messages';
    export default {
        mixins: [ lang ],



        data() {
            return {
                isScrap: false,
                advantage: ''
            };
        },

        methods: {
            checkedCheckbox() {
                this.updateRequired()
                this.$emit('reset-resulp-block')
            },
            /*loadData: function loadData() {
                axios.get('/advantage')
                    .then(response =>
                    {
                        advantage = response.data.data;
                    })
                    .catch(error => console.log(error));


            },*/
        },

        beforeMount(){

        },

        computed: {

            messages: () => messages,
        },

        mounted() {
            this.setLang();
            /*this.loadData();*/
        },
    }
</script>