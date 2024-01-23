<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category():BelongsTo{
        
      return $this->belongsTo(Category::class);

    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
