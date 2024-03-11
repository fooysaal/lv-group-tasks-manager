<?php

namespace App\Models;

use App\Models\Group\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'task_name',
        'description',
        'assigned_to',
        'status'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
