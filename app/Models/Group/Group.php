<?php

namespace App\Models\Group;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug', 'image'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function addMember(User $user): void
    {
        $this->users()->attach($user);
    }
}
