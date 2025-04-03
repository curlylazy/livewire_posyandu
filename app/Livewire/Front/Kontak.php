<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use Livewire\Component;

class Kontak extends Component
{
    public function mount()
    {

    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = "Contact | ".config('app.webname');
        $mt->url = url('/contact');
        $mt->description = "Have Questions? Let's Plan Your Dream Trip!";
        $mt->genMetaTag();

        return view('livewire.front.kontak')
            ->layout('components.layouts.front');
    }
}
