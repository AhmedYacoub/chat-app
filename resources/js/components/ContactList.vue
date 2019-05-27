<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{'selected': contact == selected}">
                
                <div class="avatar">
                    <img :src="contact.profile_image" alt="contact.name">
                </div>

                <div class="contact">
                    <p class="name" v-text="contact.name"></p>
                    <p class="email" v-text="contact.email"></p>
                </div>

                <span class="unread" v-if="contact.unread_messages_counter">{{ contact.unread_messages_counter }}</span>

            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
            }
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            }
        },

        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {

                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread_messages_counter;
                }]).reverse();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .contacts-list {
        flex: 2;
        max-height: 550px;
        overflow: scroll;
        border-left: 1px solid #bdc3c7;

        list-style-type: none;
        padding-left: 0;
    }

    ul {
        list-style-type: none;
        padding-left: 0px;

        li {
            display: flex;
            padding: 20px;
            border-bottom: 1px solid #bdc3c7;
            position: relative;
            cursor: pointer;
        }

        .selected {
            background: #ecf0f1;
        }

        span.unread {
            background: #82e0a8;
            color: #fff;
            position: absolute;
            right: 11px;
            top: 20px;
            display: flex;
            font-weight: 700;
            min-width: 20px;
            justify-content: center;
            align-items: center;
            line-height: 20px;
            font-size: 12px;
            padding: 0 4px;
            border-radius: 3px;
        }

        .avatar {
            flex: 1;
            display: flex;
            align-items: center;
        }

        img {
            width: 40px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .contact {
            flex: 3;
            font-size: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;

            p {
                margin: 0;

                p.name {
                    font-weight: bold;
                }
            }
        }
    }
</style>
