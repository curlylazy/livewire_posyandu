<?php

namespace App\Livewire\Admin;

use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    public $username = "";
    public $password = "";
    public $remember = false;

    public function mount()
    {

    }

    public function login()
    {
        try {
            if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
                $this->dispatch('notif', message: "username atau password tidak sesuai", icon: "error");
                return;
            }

            $this->redirect('/admin');
        } catch (\Exception $e) {
            $this->dispatch('notif', message: "Gagal Login : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        return view('livewire.admin.login')->title("Login | ".config('app.webname'));
    }
}
