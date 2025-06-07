<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'birthdate',
        'balance',
        'points',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthdate' => 'date',
            'balance' => 'decimal:2',
            'points' => 'integer',
            'password' => 'hashed',
        ];
    }

    public function attendaces()
    {
        return $this->hasMany(Attendance::class);
    }

    public function events_organized()
    {
        return $this->hasMany(Event::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function taken()
    {
        return $this->hasMany(Taken::class);
    }

    public function duties()
    {
        return $this->hasMany(Duty::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function roleTypes()
    {
        return $this->hasManyThrough(RoleType::class, Position::class, 'user_id', 'id', 'id', 'role_type_id');
    }

    public function maxRoleBalanceLimit(): float
    {
        return $this->roleTypes()->max('min_balance') ?? -50;
    }

}
