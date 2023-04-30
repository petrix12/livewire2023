<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = "";
    public $post;
    public $sort = "id";
    public $direction = "desc";
    public $open_edit = false;
    public $image;
    public $identificador;
    public $cant = '10';
    public $readyToLoad = false;

    // Para indicar que propiedades pueden viajar como parametros en la url
    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    // Esta línea de código hace que cuando se escuche la emisión de render
    // (que la emite el componente CreatePosts), se ejecute el método render
    // de este componente
    // protected $listeners = ['render' => 'render'];
    // Siempre que el emit y el evento a desencadenar tengan el mismo nombre se puede escribir:
    protected $listeners = ['render', 'delete'];

    public function mount() {
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function render()
    {
        if($this->readyToLoad) {
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        } else {
            $posts = [];
        }
        return view('livewire.show-posts', compact('posts'));
    }

    // Esta función se va a desencadenar cuando se modifique la propiedad search
    // Para hacer que se desencade con otra propiedad, al método se le debe
    // dar el nombre: updating[Propiedad], siendo el nombre de la propiedad: propiedad
    public function updatingSearch() {
        $this->resetPage();
    }

    public function loadPosts() {
        $this->readyToLoad = true;
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

    public function delete(Post $post) {
        $post->delete();
    }
}
