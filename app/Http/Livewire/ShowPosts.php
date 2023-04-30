<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ShowPosts extends Component
{
    use WithFileUploads;
    
    public $search = "";
    public $post;
    public $sort = "id";
    public $direction = "desc";
    public $open_edit = false;
    public $image;
    public $identificador;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    // Esta línea de código hace que cuando se escuche la emisión de render
    // (que la emite el componente CreatePosts), se ejecute el método render
    // de este componente
    // protected $listeners = ['render' => 'render'];
    // Siempre que el emit y el evento a desencadenar tengan el mismo nombre se puede escribir:
    protected $listeners = ['render'];

    public function mount() {
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->get();
        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort) {
        if($this->sort == $sort) {
            if($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post) {
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update() {
        $this->validate();
        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }
        $this->post->save();
        $this->reset(['open_edit', 'image']);
        $this->identificador = rand();
        $this->emit('alert', 'El post se actualizó con éxito');
    }
}
