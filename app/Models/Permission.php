<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    public function roles():BelongsToMany
    {
        return $this->BelongsToMany(Role::class);
    }
    public function users():BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }
}
