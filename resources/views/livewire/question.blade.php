<div>
    {{-- Formulário com `wire:submit.prevent` para chamar o método `save` --}}
    <form wire:submit.prevent="save">
        {{-- Mensagens de sucesso ou erro --}}
        @if (session()->has('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        {{-- Campo para o Título da Questão --}}
        <div>
            <label for="title">Título da Questão:</label>
            <input type="text" id="title" wire:model.defer="title">
            @error('title') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <hr>

        {{-- Campos para as Alternativas --}}
        <h4>Alternativas</h4>
        <p>Marque a alternativa correta.</p>
        
        @foreach ($alternatives as $index => $alternative)
            <div style="margin-bottom: 10px;">
                {{-- Radio button para selecionar a correta --}}
                <input type="radio" name="correctAlternative" wire:model="correctAlternativeIndex" value="{{ $index }}">

                {{-- Input para o texto da alternativa --}}
                <input type="text" wire:model.defer="alternatives.{{ $index }}.text" placeholder="Texto da alternativa {{ $index + 1 }}">
                
                @error('alternatives.'.$index.'.text') <span style="color: red;">{{ $message }}</span> @enderror
            </div>
        @endforeach
        @error('correctAlternativeIndex') <span style="color: red;">Selecione uma alternativa correta.</span> @enderror

        <hr>

        {{-- Botão para submeter o formulário --}}
        <button type="submit">Salvar Questão</button>
    </form>
</div>