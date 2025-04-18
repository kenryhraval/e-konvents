<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'dresscode'
    ];

    public function attendaces()
    {
        return $this->hasMany(Attendance::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function duties()
    {
        return $this->hasMany(Duty::class);
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
