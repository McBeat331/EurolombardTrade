const lang = {
        data: () => ({
        lang: 'uk'
    }),

    methods: {
    setLang() {
        this.lang = $('html').attr('lang');
    }
}
}

export default lang;