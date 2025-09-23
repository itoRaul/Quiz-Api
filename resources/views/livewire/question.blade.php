<div>
    <form wire:submit.prevent="save">
        @if (session()->has('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        <div>
            <label for="title">Título da Questão:</label>
            <input type="text" id="title" wire:model.defer="title">
            @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <hr>
                
        <div>
            <label for="correctAlternative">Alternativa Correta:</label>
            <select id="correctAlternative" wire:model="correctAlternativeIndex">
                <option value="">Selecione...</option>
                @foreach ($alternatives as $index => $alternative)
                    <option value="{{ $index }}">Alternativa {{ $index + 1 }}</option>
                @endforeach
            </select>
            @error('correctAlternativeIndex') <span style="color: red;">Selecione uma alternativa correta.</span> @enderror
        </div>

        <br>

        @foreach ($alternatives as $index => $alternative)
            <div style="margin-bottom: 10px;">

                <label for="alternative-{{ $index }}">Texto da alternativa {{ $index + 1 }}:</label>
                <input type="text" id="alternative-{{ $index }}" wire:model.defer="alternatives.{{ $index }}.text" style="width: 80%;">
                
                @error('alternatives.'.$index.'.text') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
        @endforeach

        <hr>

        <button type="submit">Salvar Questão</button>
    </form>
</div>