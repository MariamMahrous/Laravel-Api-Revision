<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    protected $table = 'admins';

    protected $fillable = ['name', 'email', 'password', 'created_at', 'updated_at'];

    public function getJWTIdentifier()
    {
        return $this->getKey(); // usually returns id
    }

    public function getJWTCustomClaims()
    {
        return []; // can be empty
    }
}
