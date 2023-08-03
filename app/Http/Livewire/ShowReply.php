<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowReply extends Component
{

    use AuthorizesRequests;

    public Reply $reply;
    public $body = '';
    // para activar el formulario de responder (comienza en falso para que no aparezca)
    public $is_creating = false;
    // para editar
    public $is_editing = false;

    // registro de la función de refrescar
    protected $listeners = ['refresh' => '$refresh'];


    public function updatedIsCreating()
    {
        // cancelar el proceso de edición
        $this->is_editing = false;
        // si ha sido actualizada, si cambio de false->true
        $this->body = '';
    }

    // funcion para que aparezca el texto que queremos editar
    public function updatedIsEditing()
    {
        // evaluamos si esta autorizado a actualizar (policity)
        $this->authorize('update', $this->reply);

        // cancelar el proceso de creación
        $this->is_creating = false;
        // si ha sido actualizada, si cambio de false->true
        $this->body = $this->reply->body;
    }


    // funcion de editar respuestas
    public function updateReply()
    {
        // evaluamos si esta autorizado a actualizar (policity)
        $this->authorize('update', $this->reply);

        // validate
        $this->validate(['body' => 'required']);

        // update
        $this->reply->update([
            'body' => $this->body
        ]);

        // refresh
        $this->is_editing = false; // estado original
    }


    // funcion para crear respuestas
    public function postChild()
    {
        // para evitar diferentes niveles de respuestas
        if (! is_null($this->reply->reply_id)) return;

        // validate
        $this->validate(['body' => 'required']);

        // create
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        // refresh
        $this->is_creating = false; // estado original
        $this->body = '';
        $this->emitSelf('refresh');
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
