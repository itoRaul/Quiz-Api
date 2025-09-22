<div>
    <div>
        <h3>Configurações das Alternativas</h3>
        <a href="{{ route('configurations.create') }}">NOVO</a>
    </div>

    
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome (A,B,C)</th>
                <th>Cor Hexadecimal</th>
                <th>Nome da Cor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($configurations as $config)
                <tr>
                    <td>{{ $config->id }}</td>
                    <td>{{ $config->name }}</td>
                    <td>{{ $config->color_hexadecimal }}</td>
                    <td>{{ $config->color_name }}</td>
                    <td>{{ $config->status ? 'Ativo' : 'Inativo' }}</td>
                    <td>
                        <a href="{{ route('configurations.edit', $config->id) }}">Editar</a>
                        
                        <button 
                            wire:click="delete({{ $config->id }})" 
                            wire:confirm="Tem certeza que deseja deletar?">
                            Deletar
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhuma configuração encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>