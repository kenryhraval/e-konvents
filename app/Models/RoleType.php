<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    protected $fillable = ['name', 'min_balance'];

    public function positions()
    {
        return $this->hasMany(Position::class);
    }
}
