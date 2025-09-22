<div>
    <h3>{{ $configuration->exists ? 'Editar Configuração' : 'Criar Nova Configuração' }}</h3>

    <form wire:submit.prevent="save">
        <div>
            <label for="name">Nome da Alternativa (Ex: A, B, E)</label>
            <input type="text" id="name" wire:model="configuration.name">
            @error('configuration.name') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="color_name">Nome da Cor (Ex: Azul, Vermelho)</label>
            <input type="text" id="color_name" wire:model="configuration.color_name">
            @error('configuration.color_name') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="color_hexadecimal">Cor em Hexadecimal</label>
            <input type="color" wire:model="configuration.color_hexadecimal">
            <input type="text" wire:model="configuration.color_hexadecimal">
            @error('configuration.color_hexadecimal') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <button type="submit">Salvar Configuração</button>
            <a href="{{ route('configurations.index') }}">Cancelar</a>
        </div>
    </form>
</div>