<template>
    <div class="composer">
        <textarea id="message" v-model="message" @keydown.enter="send" placeholder="press enter to send.."></textarea>
        <button id="sendBtn" class="btn btn-primary" title="send message" @click="send">
            <i class="fa fa-paper-plane"></i>
        </button>
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

    .composer {
        display: flex;
    }
    .composer textarea {
        flex: 19;
        width: 90%;
        margin: 10px 0px 10px 10px;
        resize: none;
        border-radius: 3px;
        border: 1px solid lightgray;
        padding: 6px;
    }

    #sendBtn {
        flex: 1;
        margin: 10px 10px 10px 0px;
        height: 58px;
    }
</style>

