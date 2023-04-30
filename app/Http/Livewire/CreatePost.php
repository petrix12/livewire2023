<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $title;
    public $content;
    public $image;
    public $identificador;

    protected $rules = [
        /* 'title' => 'required|max:10',
        'content' => 'required|min:100', */
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    public function render()
    {
        return view('livewire.create-post');
    }

    public function mount() {
        $this->identificador = rand();
    }

    /* public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } */

    public function save() {
        $this->validate();

        $image = $this->image->store('posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);

        $this->reset(['open', 'title', 'content', 'image']);

        $this->identificador = rand();

        // Esta emisión será escuchada por todos los componentes
        // $this->emit('render');
        // Esta emisión solo será escuchada por el componente show-posts
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se creo con éxito');
    }
}
