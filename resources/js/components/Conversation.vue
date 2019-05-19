<template>
    <div class="conversation">
         <!-- header -->
        <h1>{{ contact ? contact.name : 'Select a contact' }}</h1>

        <!-- // messages -->
        <MessagesFeed :contact="contact" :messages="messages"/>

        <!-- // new message  -->
        <!-- @send indicates that the event called 'send' will trigger 'sendMessage' function -->
        <MessageComposer @send="sendMessage" />
    </div>
</template>

<script>

    // import the required components
    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {

        // arguments
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },

        mounted() {

        },

        // methods
        methods: {
            sendMessage(text) {
                // check if there is a selected contact
                if (!this.contact) {
                    return;
                }

                // send text message using axios post request
                axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                });
            }
        },

        components: {MessagesFeed, MessageComposer}
    }
</script>


<style lang="scss" scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px solid lightgray;
        }
    }
</style>
