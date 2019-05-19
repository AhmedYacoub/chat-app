<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="press enter to send.."></textarea>
    </div>
</template>

<script>
    export default {
        
        // data
        data() {
            return {
                message: ''
            }
        },

        // methods
        methods: {

            // it will be triggred once the user write a message and hits enter key.
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }

                // trigger a global event using emit
                this.$emit('send', this.message);
                this.message = '';
                
            }
        },
    }
</script>

<style lang="scss" scoped>
    .composer textarea {
        width: 97%;
        margin: 10px;
        resize: none;
        border-radius: 3px;
        border: 1px solid lightgray;
        padding: 6px;
    }
</style>

