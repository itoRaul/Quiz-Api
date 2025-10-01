<?php

namespace App\Http\Controllers;

use App\Services\ConfigurationService;
use Illuminate\Http\Request;

//controller API - configurações
class ConfigurationController extends Controller
{
    public function createConfiguration(Request $request)
    {
        $name = $request->name;
        $color_name = $request->color_name;
        $color_hexadecimal = $request->color_hexadecimal;
        $status = $request->status;
        $configService = new ConfigurationService();
        $result = $configService->store([
            'name' => $name,
            'color_name' => $color_name,
            'color_hexadecimal' => $color_hexadecimal,
            'status' => $status
        ]);

        if ($result['success']) {
            return response()->json($result, 201);
        } else {
            return response()->json($result, 400);
        }
    }

    public function editConfiguration($id, Request $request)
    {

        $name = $request->name;
        $color_name = $request->color_name;
        $color_hexadecimal = $request->color_hexadecimal;
        $status = $request->status;

        $configurationService = new ConfigurationService();
        $result = $configurationService->update([
            'name' => $name,
            'color_name' => $color_name,
            'color_hexadecimal' => $color_hexadecimal,
            'status' => $status
        ], $id);

        if ($result['success']) {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 400);
        }
    }

    public function deleteConfiguration($id)
    {
        $configurationService = new ConfigurationService();
        $result = $configurationService->delete($id);

        if ($result['success']) {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 400);
        }
    }

    public function allConfigurations()
    {
        try {
            $configurationService = new ConfigurationService();
            $result = $configurationService->getAll();

            return response()->json([
                'data' => $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar as configurações.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
