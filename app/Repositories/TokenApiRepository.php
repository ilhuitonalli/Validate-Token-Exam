<?php

namespace App\Repositories;

use App\Models\tokenApi;

class TokenApiRepository
{
    public function create(array $data): tokenApi
    {
        return tokenApi::create($data);
    }

    public function getActiveByUser(int $userId)
    {
        return tokenApi::where('user_id', $userId)
            ->whereNull('revoked_at')
            ->get();
    }

    public function findActiveByToken(string $tokenHash): ?tokenApi
    {
        return tokenApi::where('token', $tokenHash)
            ->whereNull('revoked_at')
            ->first();
    }

    public function findByIdAndUser(int $id, int $userId): ?tokenApi
    {
        return tokenApi::where('id', $id)
            ->where('user_id', $userId)
            ->whereNull('revoked_at')
            ->first();
    }

    public function revoke(tokenApi $token): bool
    {
        return $token->update([
            'revoked_at' => now()
        ]);
    }
}