<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'dresscode',
        'datetime'
    ];

    protected function casts(): array
    {
        return [
            'datetime' => 'date',
        ];
    }

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
