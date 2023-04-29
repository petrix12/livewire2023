<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPosts extends Component
{
    public $search = "";
    public $sort = "id";
    public $direction = "desc";

    // Esta línea de código hace que cuando se escuche la emisión de render
    // (que la emite el componente CreatePosts), se ejecute el método render
    // de este componente
    // protected $listeners = ['render' => 'render'];
    // Siempre que el emit y el evento a desencadenar tengan el mismo nombre se puede escribir:
    protected $listeners = ['render'];

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
}
