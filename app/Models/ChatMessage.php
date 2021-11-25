<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    //chat message can have one chat room
    public function room()
    {
         //$this->hasOne(ChatRoom::class,'id','chat_room_id');

         return $this->belongsTo(ChatRoom::class,'chat_room_id','id');
    }

    //chat message can only have one user
    public function user()
    {
        //$this->hasOne(ChatRoom::class,'id','user_id');

     return $this->belongsTo(ChatRoom::class, 'user_id' , 'id');
    }
}
