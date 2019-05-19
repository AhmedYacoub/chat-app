// Main template, it has 2 sections, conversation & contact list sections respectively
<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <ContactList :contacts="contacts" @selected="startConversationWith"/> 
    </div>
</template>

<script>
    // import conversation & contact list components
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {

        // component arguments
        props: {
            user: {
                type: Object,
                required: true,
            }
        },

        // data to be used by the components
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            }
        },
        
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.handelIncoming(e.message);
                });

            // call axios to get json data and assign it to contacts variable
            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },

        methods: {
            startConversationWith(contact) {
                this.updateUnreadMessageCounter(contact, true);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
            },

            // add new message to messages array
            saveNewMessage(message) {
                this.messages.push(message);
            },

            handelIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
            
                this.updateUnreadMessageCounter(message.owner, false);
            },

            updateUnreadMessageCounter(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset) 
                        single.unread_messages_counter = 0;
                    else 
                        single.unread_messages_counter += 1;

                    return single;
                });
            }
        },

        // use the imported components
        components: {Conversation, ContactList}
    }
</script>


<style lang="scss" scoped>
    .chat-app {
        display: flex;
    }
</style>
