<?php

namespace App\Livewire\Admin\Blog;

use App\Livewire\Forms\BlogForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class BlogAE extends Component
{
    use WithFileUploads;

    public $pageTitle = "Blog";
    public $pageName = "blog";
    public $isEdit = false;
    public $id = "";

    public BlogForm $form;

    public function mount($id = null)
    {
        $this->form->kodeuser = Auth::user()->kodeuser;
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
        session()->flash('success', "berhasil tambah data ".$this->form->namablog);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namablog);
    }

    public function hapusGambar()
    {
        $this->form->hapusGambar($this->form->kodeblog);
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
