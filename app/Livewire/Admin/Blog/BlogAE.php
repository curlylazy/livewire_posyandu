<?php

namespace App\Livewire\Admin\Blog;

use App\Livewire\Forms\BlogForm;
use Livewire\Component;
use Illuminate\Support\Str;

class BlogAE extends Component
{
    public $pageTitle = "Blog";
    public $pageName = "Blog";
    public $isEdit = false;
    public $id = "";

    public BlogForm $form;

    public function mount($id = null)
    {
        $this->readData($id);
    }

    public function readData($id = null)
    {
        if(empty($id))
            return;

        $this->form->setPost($id);
        $this->id = $id;
        $this->isEdit = true;
        $this->pageTitle = "Edit ".Str::title($this->pageName);
    }

    public function save()
    {
        try {
            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->form->judul);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->judul);
    }

    // *** extra
    public function hapusGambar()
    {
        $this->form->hapusGambar($this->form->kodeblog);
    }

    public function render()
    {
        return view("livewire.admin.".$this->pageName.".ae")
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
