<template>
    <div class="modal-overlay" @click="$emit('close-modal')">
        <div class="modal" @click.stop>
            <div class="modalObmen">
                <modalObmen/>
            </div>
            <div class="close" @click="$emit('close-modal')">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.6066 0.192471L0.192388 1.60668L9.38478 10.7991L0.192388 19.9915L1.6066 21.4057L10.799 12.2133L19.9914 21.4057L21.4056 19.9915L12.2132 10.7991L21.4056 1.60668L19.9914 0.192471L10.799 9.38486L1.6066 0.192471Z" fill="#878787"/>
                </svg>
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
    import modalObmen from './ModalObmenComponent.vue'
    export default {
        components: {
            modalObmen
        },
        mixins: [ lang ],



        data() {
            return {

            }
        },
        methods: {


        },

        beforeMount(){

        },

        computed: {



        },
        watch: {

        },
        mounted() {
            this.setLang();

        },
    }
</script>
