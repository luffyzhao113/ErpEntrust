export default {
    props: {
      data: {}
    },
    data(){
        return {
            loading: false,
        }
    },
    methods: {
      change(visible) {
            if (visible === false) {
                this.$emit('on-change')
            }
        }
    }
}