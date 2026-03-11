<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destination extends Model
{
    protected $fillable = [
        'itinerary_id', 
        'name', 
        'rental_location', 
        'places_to_visit', 
        'activities', 
        'dishes_to_try'
    ];

   
    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }
}
