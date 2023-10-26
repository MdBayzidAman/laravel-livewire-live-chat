<?php

namespace App\Livewire;

use App\Livewire\Component\Chatbox;
use App\Models\User;
use App\Models\wireChat;
use Livewire\Component;

class Chat extends Component
{
    public $id;
    public $chatUser;

    public function mount($id = null)
    {
        if ($id != null) {
            $this->id = $id;
            $this->chatUser = User::find($id);
            Chatbox::chatUserData($this->chatUser);
            // dd($this->chatUser);
        }
    }

    public function render()
    {
        // id list of chat users
        $chatsID = wireChat::select('from_id as id')
            ->where('to_id', auth()->user()->id)
            ->union(
                wireChat::select('to_id as id')
                    ->where('from_id', auth()->user()->id)
            )
            ->distinct()
            ->get();

        // users list of chat users
        $users = User::select('id', 'name', 'avatar', 'username', 'active_status')
            ->whereIn('id', $chatsID)
            ->get();

        return view('livewire.chat', [
            "users" => $users,
        ]);
    }
}
