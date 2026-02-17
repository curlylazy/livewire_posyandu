<?php

namespace App\Livewire\Partial;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdminBtnLogout extends Component
{
    public $username = "";
    public $password = "";
    public $remember = false;

    public function mount()
    {

    }

    #[On('on-logout')]
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirectRoute('admin_login');
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <a class="dropdown-item" role="button" href="javascript:void(0)" wire:click='$dispatch("notif-confirm-logout")'>
                    <span class="icon me-2 material-symbols-outlined">logout</span>
                    Logout
                </a>
            </div>
        HTML;
    }
}
