<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title' , 'description' , 'media_url' , 'media_type'
    ];
    public function users():BelongsToMany
    {
        return $this->BelongsToMany(User::class); 
    }
   
}
