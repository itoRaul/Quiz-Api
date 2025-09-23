<div>
    @if (session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
        <div>
            <button wire:click="create">NOVO</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nome da Cor</th>
                    <th>Cor Hexadecimal</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($configurations as $config)
                    <tr>
                        <td>{{ $config->id }}</td>
                        <td>{{ $config->name }}</td>
                        <td>{{ $config->color_name }}</td>
                        <td>{{ $config->color_hexadecimal }}</td>
                        <td>{{ $config->status ? 'Ativo' : 'Inativo' }}</td>
                        <td>
                            <button wire:click="edit({{ $config->id }})">Editar</button>
                            <button wire:click="delete({{ $config->id }})">Deletar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhuma configuração encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

         @if ($formVisible)
        <div class="mt-8">
            <h4>{{ $isEditing ? 'Editar Configuração' : 'Criar Nova Configuração' }}</h4>

            <form wire:submit.prevent="save">
                <div>
                    <label for="name">Nome</label>
                    <input type="text" id="name" wire:model="name">
                    @error('name') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-top: 1rem;">
                    <label for="color_name">Nome da Cor</label>
                    <input type="text" id="color_name" wire:model="color_name">
                    @error('color_name') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-top: 1rem;">
                    <label for="color_hexadecimal">Cor em Hexadecimal</label>
                    <input type="text" id="color_hexadecimal" wire:model="color_hexadecimal">
                    @error('color_hexadecimal') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-top: 1rem;">
                    <label for="status">Status</label>
                    <select id="status" wire:model="status">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                    @error('status') <span style="color: red;">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="button" wire:click.prevent="cancel">Cancelar</button>
                    <button type="submit">Salvar</button>
                </div>
            </form>
        </div>
        @endif
</div>