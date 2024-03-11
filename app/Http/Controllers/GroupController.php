<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group\Group;
use App\Models\GroupMember;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\GroupUser;
use App\Notifications\GroupInvitationNotification;
use PhpParser\Node\Stmt\GroupUse;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::all();
   
        $groups->map(function($group) {
            $group->description = Str::limit($group->description, 100);
            return $group;
        });

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGroupRequest $request)
    {
        $group = new Group();
        
        if($request->hasFile('image')) {
            $image = $request->file('image')->store('groups', 'public');
        }
        $group->name = $request->name;
        $group->slug = Str::slug($request->name);
        $group->description = $request->description;
        $group->image = $image ?? null;

        $group->save();

        // Insert the group user
        $groupMember = new GroupUser();
        $groupMember->group_id = $group->id;
        $groupMember->user_id = Auth::id();
        $groupMember->save();

        $groupMember = new GroupMember();
        $groupMember->group_id = $group->id;
        $groupMember->user_id = Auth::id();
        $groupMember->status = 'approved';
        $groupMember->save();

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($group)
    {
        $viewBag['group'] = Group::where('slug', $group)->firstOrFail();
        
        
        $viewBag['members'] = GroupMember::where('group_id', $viewBag['group']->id)
        ->where('status', 'approved')
        ->get();

        $exist_member = GroupMember::where('group_id', $viewBag['group']->id)
        ->get();
        
        $viewBag['users'] = User::whereNotIn('id', $exist_member->pluck('user_id')->toArray())
            ->get();

        return view('groups.show', $viewBag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($group)
    {
        $group = Group::where('slug', $group)->firstOrFail();

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(UpdateGroupRequest $request, $slug)
    {
        $group = Group::where('slug', $slug)->firstOrFail();
        if($request->hasFile('image')) {
            if($group->image) {
                Storage::disk('public')->delete($group->image);
            }
            $image = $request->file('image')->store('groups', 'public');
        }
        $group->name = $request->name;
        $group->slug = Str::slug($request->name);
        $group->description = $request->description;
        $group->image = $image ?? $group->image;

        $group->save();

        return redirect()->route('groups.index')->with('success', 'Group updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $group = Group::where('slug', $slug)->firstOrFail();
        if($group->image)
        {
            Storage::disk('public')->delete($group->image);
        }
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }

    public function addMember(Request $request, $group)
    {
        $group = Group::where('slug', $group)->firstOrFail();

        foreach($request->users as $member) {
            $user = User::find($member);
            $groupMember = new GroupMember();
            $groupMember->group_id = $group->id;
            $groupMember->user_id = $user->id;
            $groupMember->status = 'pending';
            $groupMember->save();
            
        }
        return redirect()->back()->with('success', 'Member added successfully');
    }
}
