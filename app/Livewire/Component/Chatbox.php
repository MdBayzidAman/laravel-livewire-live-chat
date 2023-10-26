<?php

namespace App\Livewire\Component;

use App\Models\User;
use App\Models\wireChat;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Chatbox extends Component
{
    public static $chat_user;

    // Live wire models 
    #[Rule('required')]
    public $to_id= '2';
    public $message;
    public $attachment = '';

    public static function chatUserData(User $user) {
        self::$chat_user = $user;
    }
    // Fetch message from db
    public function fetchMessages()
    {
        $messages = wireChat::where('from_id', auth()->user()->id)
            ->orWhere('to_id', auth()->user()->id)
            ->get();
        
        return $messages;
    }

    // Send message handle
    public function saveChat()
    {

        // store message
        $wireChat = new wireChat;
        $wireChat->from_id = auth()->user()->id;
        $wireChat->to_id = $this->to_id;
        $wireChat->chats = $this->message;

        // if user included attachment
        if ($this->attachment) {
            $fileName = $this->attachment;
            $wireChat->attachment = $fileName;
        }

        // save to database
        $wireChat->save();
    }

    public function render()
    {
        // $this->chat_user = User::find();
        return view('livewire.component.chatbox',[
            'messages' => $this->fetchMessages(),
            'chatUser' => self::$chat_user,
        ]);
    }
}
