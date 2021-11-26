<template>
   <div class="grid grid-cols-2">
      <div class="font-bold text-xl">
         <!-- Chat Room Name -->
         {{ selected.name }} Chat
      </div>
      <!-- A dropdown for all caht rooms -->
      <div>
         <select
            v-model="selected"
            @change="$emit('roomchanged', selected)"
            class="float-right"
         >
         <!--  loop through all rooms -->
            <option v-for="(room, index) in rooms"
               :key="index"
               :value="room"
            >
               {{ room.name }}
            </option>
         </select>
      </div>
   </div>
</template>

<script>
export default {
   props: ['rooms', 'currentRoom'],
   data: ()=>({
      // selected chat room data
      selected: ''
   }),
   created(){
      this.selected = this.currentRoom
   }
}
</script>
