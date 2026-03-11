<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Itinerary extends Model
{
    protected $fillable = [
        'user_id', 
        'category_id', 
        'title', 
        'duration_days', 
        'image_url'
    ];

   
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

  
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

   
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'itinerary_user');
    }
}
