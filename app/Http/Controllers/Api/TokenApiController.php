<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoretokenApiRequest;
use App\Http\Requests\ValidatetokenApiRequest;
use App\Services\TokenApiService;

class TokenApiController extends Controller
{
    protected TokenApiService $TokenApiService;
    public function __construct() {
        $this->TokenApiService = new TokenApiService();
    }


    /**
     * Display a listing of the resource.
     */
    public function showToken()
    {

        $result = $this->TokenApiService->listActive(auth()->id());
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeToken(StoretokenApiRequest $request)
    {
        $request = $request->validated();   
        $result  = $this->TokenApiService->create($request, auth()->id());
        if ($result['success']) {   
            return response()->json($result, 201);
        } else {
            return response()->json($result, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function revokeToken($id)
    {
        $result  = $this->TokenApiService->revoke($id, auth()->id());
        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'API Key no encontrada o Revocada previamente.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Token revocado exitosamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function validateToken(ValidatetokenApiRequest $request)
    {
        $key = $request->validated();   
        $isValid = $this->TokenApiService->validateKey($key['key']);
        return response()->json([
            'valid' => $isValid,
        ], 200);
    }   
}
