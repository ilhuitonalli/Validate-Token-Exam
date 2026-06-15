<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 

class User extends Authenticatable implements JWTSubject 
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtener el identificador JWT (usualmente el id del usuario)
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Obtener claims personalizados para el JWT
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}