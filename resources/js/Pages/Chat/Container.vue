<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              <!-- passing some props into the component. -->
                <chat-room-selection
                     v-if="currentRoom.id"
                     :rooms="chatRooms"
                     :currentRoom="currentRoom"
                     v-on:roomchanged="setRoom($event)"
                 />
            </h2>
        </template>

        <div class="py-12">
         <!-- all messages:{{ messages }} -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <!-- sending all messages to messageContainer-->
                  <message-container  :messages ="messages"/>
                   <!-- Sending currentRoom into this component as prop. Also,
                   the v:on fires every time a message gets sent from the
                   child component(emits an event)-->
                  <input-message
                   :room ="currentRoom" v-on:messagesent="getMessages()" />
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
    import chatRoomSelection from './chatRoomSelection.vue'
    import axios from 'axios'



    export default defineComponent({
        components: {
            AppLayout,
            MessageContainer,
            inputMessage,
            chatRoomSelection

        },

         data: () => ({
            chatRooms: [],
            currentRoom: [],
            messages: []
         }),

        methods: {

            getRooms()
            {
                axios.get('/chat/rooms')
                .then(response => {
                // get all rooms
                 this.chatRooms = response.data;
                // get the first room. Can be defined without a separate function
                 this.setRoom(response.data[0]);
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
             // fire the getRooms function on initialization
            this.getRooms();
        }


    })
</script>
