<template>
    <div class="alert alert-success" role="alert" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message','visible'],
        data() {
            return {
                show : false,
                body : ''
            }
        },
        created() {
            if(this.message) {
                this.flash(this.message)
            }
        },
        methods: {
            flash(message) {
                this.show = true
                this.body = message

                setTimeout(() => {
                    this.hide()
                },3000)
            },
            hide() {
                this.show = false

            }
        }
    }
</script>

<style>
    .spacing {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
