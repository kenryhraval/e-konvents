<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taken extends Model
{
    protected $fillable = [
        'count',
        'reason',
        'item_id',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'count' => 'integer',
        ];
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
