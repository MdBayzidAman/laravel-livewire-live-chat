<?php

namespace App\Livewire\Component;

use Livewire\Component;

class UserList extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.component.user-list',[
            'user' => $this->user,
        ]);
    }
}
