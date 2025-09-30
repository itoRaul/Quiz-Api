<?php

namespace App\Services;

use App\Models\AlternativeConfiguration;
use Illuminate\Support\Facades\DB;


class ConfigurationService
{

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $configuration = AlternativeConfiguration::create([
                'name' => $request['name'],
                'color_name' => $request['color_name'],
                'color_hexadecimal' => $request['color_hexadecimal'],
                'status' => $request['status'],
            ]);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Configuração salva com sucesso.',
                'configuration' => $configuration
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Erro ao salvar a configuração.',
                'error' => $e->getMessage()
            ];
        }
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $configuration = AlternativeConfiguration::findOrFail($id);

            $configuration->update([
                'name' => $request['name'],
                'color_name' => $request['color_name'],
                'color_hexadecimal' => $request['color_hexadecimal'],
                'status' => $request['status'],
            ]);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Configuração atualizada com sucesso.',
                'configuration' => $configuration
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Erro ao atualizar a configuração.',
                'error' => $e->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $configuration = AlternativeConfiguration::findOrFail($id);
            $configuration->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Configuração deletada com sucesso.'
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Erro ao deletar a configuração.',
                'error' => $e->getMessage()
            ];
        }
    }
}
