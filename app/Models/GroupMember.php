<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'user_id', 'status'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isMember($groupId, $userId)
    {
        return $this->where('group_id', $groupId)
            ->where('user_id', $userId)
            ->where('status', 'approved')
            ->exists();
    }
}
