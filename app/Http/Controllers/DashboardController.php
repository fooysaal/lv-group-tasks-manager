<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
      $viewBag['notifications'] = GroupMember::with('group')->where('user_id', auth()->id())
          ->where('status', 'pending')
            ->get();
        return view('dashboard', $viewBag);
    }

    public function updateGroupStatus(Request $request, $groupMemberId)
    {
        $groupMember = GroupMember::find($groupMemberId);
        $groupMember->update(['status' => $request->status]);

        return back();
    }
}
