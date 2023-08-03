<div>
    <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                <img src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}" class="rounded-md">
            </div>
            <div class="w-full">
                <p class="mb-2 text-blue-600 font-semibold text-xs">
                    {{ $reply->user->name }}
                </p>
                <!-- formulario editar respuesta -->
                @if ($is_editing)
                    <form wire:submit.prevent="updateReply" class="mt-4">
                        <input 
                            type="text" 
                            placeholder="Escribe una respuesta" 
                            class="bg-slate-800 border-1 border-slate-900 rounded-mb w-full p-3 text-white/60 text-xs"
                            wire:model.defer="body" 
                        >
                    </form>
                @else
                    <p class="text-white/60 text-xs">
                        {{ $reply->body }}
                    </p>
                @endif
                <!--Fin formulario editar respuesta -->
                
                <!-- formulario responder a otra respuesta -->
                @if ($is_creating)
                    <form wire:submit.prevent="postChild" class="mt-4">
                        <input 
                            type="text" 
                            placeholder="Escribe una respuesta" 
                            class="bg-slate-800 border-1 border-slate-900 rounded-mb w-full p-3 text-white/60 text-xs"
                            wire:model.defer="body" 
                        >
                    </form>
                @endif
                <!--Fin formulario responder a otra respuesta -->
                <!-- botones Responder y Editar -->
                <p class="mt-4 text-white/60 text-xs flex gap-2 justify-end">
                    @if (is_null($reply->reply_id))
                        <a href="#" wire:click.prevent="$toggle('is_creating')" class="hover:text-white">Responder</a>
                    @endif

                    @can('update', $reply)
                        <a href="#" wire:click.prevent="$toggle('is_editing')" class="hover:text-white">Editar</a>
                    @endcan
                </p>
                <!-- Fin botones Responder y Editar -->
            </div>
        </div>
    </div>

    <!-- respuestas anidadas -->
    @foreach ($reply->replies as $item)
        <div class="ml-8">
            @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
        </div>
    @endforeach
</div>