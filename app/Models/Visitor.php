<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'fraternity',
        'name',
        'event_id',  // Add event_id here to allow mass assignment
    ];

    // Define the relationship to the Events model
    public function event()
    {
        // Define the relationship, using event_id as the foreign key
        return $this->belongsTo(Event::class, 'event_id');  
    }
        
}
