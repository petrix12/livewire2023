<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = true;
    public $title;
    public $content;

    protected $rules = [
        /* 'title' => 'required|max:10',
        'content' => 'required|min:100', */
        'title' => 'required',
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.create-post');
    }

    /* public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } */

    public function save() {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->reset(['open', 'title', 'content']);

        // Esta emisión será escuchada por todos los componentes
        // $this->emit('render');
        // Esta emisión solo será escuchada por el componente show-posts
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'El post se creo con éxito');
    }
}
