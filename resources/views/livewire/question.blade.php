<div>
    @if (session()->has('message'))
    <div>
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div>
        {{ session('error') }}
    </div>
    @endif

    <button wire:click="create">NOVO</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Alternativas</th>
                <th>Alternativa Correta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    @foreach ($item->alternatives as $alternative)
                    {{ $alternative->name }},
                    @endforeach
                </td>
                <td>{{ $item->alternative_correct }}</td>
                <td></td>
                <td>
                    <button wire:click="edit({{ $item->id }})">EDITAR</button>
                    <button wire:click="delete({{ $item->id }})">EXCLUIR</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($formVisible)
    <h3>{{ $isEditing ? 'Editar Questão' : 'Nova Questão' }}</h3>
    <form wire:submit.prevent="save">
        @if (session()->has('success'))
        <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
        <div style="color: red;">{{ session('error') }}</div>
        @endif

        <div>
            <label for="title">Título da Questão:</label>
            <input type="text" id="title" wire:model.defer="name">
            @error('name') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <hr>

        <div>
            <label for="correctAlternative">Alternativa Correta:</label>
            <select id="correctAlternative" wire:model="correctAlternativeIndex">
                <option value="">Selecione...</option>
                @foreach ($alternativeConfigurations as $index => $alternative)
                <option value="{{ $alternative->name }}">{{ $alternative->name }}</option>
                @endforeach
            </select>
            @error('correctAlternativeIndex') <span style="color: red;">Selecione uma alternativa correta.</span>
            @enderror
        </div>

        <br>

        @foreach ($alternativeConfigurations as $alternativeConfiguration)
        <div>

            <label for="alternative-{{ $alternativeConfiguration->id }}">Alternativa {{ $alternativeConfiguration->name
                }}:</label>
            <input type="text" wire:model.defer="alternatives.{{ $alternativeConfiguration->id }}.text">

            @error('alternatives.'.$alternativeConfiguration->id.'.text') <span style="color: red;">{{ $message
                }}</span> @enderror
        </div>
        @endforeach

        <hr>

        <button type="submit">{{ $isEditing ? 'Atualizar Questão' : 'Salvar Questão' }}</button>
        <button type="button" wire:click="cancelForm">Cancelar</button>
        <br>
        <a href="{{ route('configurations.index') }}">Configurar alternativas</a>
    </form>
    @endif
</div>