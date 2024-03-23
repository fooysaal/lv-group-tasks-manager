<?php

namespace App\Http\Controllers;

use App\Models\GroupTask;
use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupTaskController extends Controller
{
    public function create()
    {
        return view('groups.tasks.create');
    }

    public function store(Request $request, GroupMember $group)
    {
        $request->validate([
            'task_name' => 'required',
            'description' => 'required',
            'assigned_to' => 'required'
        ]);

        $groupTask = new GroupTask();
        $groupTask->group_id = $group->id;
        $groupTask->task_name = $request->task_name;
        $groupTask->description = $request->description;
        $groupTask->assigned_to = $request->assigned_to;
        $groupTask->status = 'pending';
        $groupTask->save();

        return redirect()->route('groups.show', $group->id);
    }
}
