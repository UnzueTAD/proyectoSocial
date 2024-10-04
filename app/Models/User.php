<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    // Relación con roles
    public function role() {
        return $this->belongsTo(Role::class);
    }
}


class Role extends Model
{
    use HasFactory;

    protected $fillable = ['admin'];

    // Relación con usuarios
    public function users() {
        return $this->hasMany(User::class);
    }
}