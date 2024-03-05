<?php

namespace App\Http\Controllers;

use App\Models\Group\Group;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\User;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::get();
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

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($group)
    {
        $group = Group::where('slug', $group)->firstOrFail();
        
        $users = User::where('id', '!=', auth()->id())
            ->whereNotIn('id', $group->users->pluck('id'))
            ->get();
        return view('groups.show', compact('group', 'users'));
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
}
