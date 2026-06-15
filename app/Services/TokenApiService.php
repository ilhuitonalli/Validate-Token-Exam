<?php

namespace App\Services;

use App\Repositories\TokenApiRepository;
use Illuminate\Support\Str;

class TokenApiService
{
    protected TokenApiRepository $tokenApiRepository;
    public function __construct() {
        $this->tokenApiRepository = new TokenApiRepository();
    }

    public function create(array $data, int $userId): array
    {
        $plainToken =  env('HEADER_KEY', 'keys_') . Str::random(40);

        $token = $this->tokenApiRepository->create([
            'user_id' => $userId,
            'name' => $data['name'],
            'description' => $data['description'],
            'token' => hash('sha256', $plainToken),
        ]);

        if (!$token->exists) {
            return [
                'success' => false,
                'message' => 'Error al guardar la API Key',
                'token' => hash('sha256', $plainToken),
            ];
        }
                
        return [
            'success' => true,
            'message' => 'API Key creada exitosamente',
            'token' => hash('sha256', $plainToken),
        ];
    }

    public function listActive(int $userId)
    {
        return $this->tokenApiRepository->getActiveByUser($userId);
    }

    public function revoke(int $id, int $userId): bool
    {
        $token = $this->tokenApiRepository->findByIdAndUser($id, $userId);

        if (!$token) {
            return false;
        }

        return $this->tokenApiRepository->revoke($token);
    }

    public function validateKey(string $key): bool
    {

        return $this->tokenApiRepository->findActiveByToken($key) !== null;
    }
}