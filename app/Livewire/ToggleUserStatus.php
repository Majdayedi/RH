<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ToggleUserStatus extends Component
{
    public User $user;

    public function toggle()
    {
        $this->user->update(['is_active' => !$this->user->is_active]);
    }

    public function render()
    {
        return view('livewire.toggle-user-status');
    }
}