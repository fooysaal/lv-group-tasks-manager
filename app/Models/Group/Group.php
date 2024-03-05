<?php

namespace App\Models\Group;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug', 'image'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
