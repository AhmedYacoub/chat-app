<template>
    <div class="contacts-list">
        <ul>
            <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected': index == selected}">
                
                <div class="avatar">
                    <img :src="contact.profile_image" alt="contact.name">
                </div>

                <div class="contact">
                    <p class="name" v-text="contact.name"></p>
                    <p class="email" v-text="contact.email"></p>
                </div>

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
                selected: 0,
            }
        },
        methods: {
            selectContact(index, contact) {
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .contacts-list {
        flex: 2;
        max-height: 500px;
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
