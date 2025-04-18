<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'event_id',
    ];

    protected $hidden = [
        'code',
    ];

    protected function casts(): array
    {
        return [
            'code' => 'hashed',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
