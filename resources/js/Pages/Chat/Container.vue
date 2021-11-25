<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <message-container />
                  <input-message :room ="currentRoom" v-on:messagesent="getMessages()"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import Vue from 'vue'
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import MessageContainer from './messageContainer.vue'
    import inputMessage from './inputMessage.vue'
    import axios from 'axios'



    export default defineComponent({
        components: {
            AppLayout,
            MessageContainer,
            inputMessage,

        },

        data:function() {

           return {
               chatRooms : [],
               currentRoom : [],
               messages : []
           }

        },

        methods: {
            //get rooms
            getRooms()
            {
                axios.get('/chat/rooms')
                .then(response => {
                 this.chatRooms = response.data;   // save all chatRooms available to us
                 this.setRoom(response.data[0]);   // set current room available to us
                })
                .catch(error =>{
                    console.log(error);
                })

            },

           // set current room
            setRoom(room)
            {
              this.currentRoom = room;
              this.getMessages();
            },

            // when change room will get message belonge to this room
            getMessages()
            {
                axios.get('chat/room/' + this.currentRoom.id + '/messages')
                .then(response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },

        created()
        {
            this.getRooms();
        }


    })
</script>
