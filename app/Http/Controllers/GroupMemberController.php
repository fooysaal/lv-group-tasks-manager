<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function updateGroupStatus(Request $request, $groupMemberId)
    {
        $groupMember = GroupMember::find($groupMemberId);

        if($request->status == 'approved') {
            $groupMember->status = 'approved';
            $groupMember->save();
        } else {
            $groupMember->delete();
        }

        return redirect()->back();
    }

    public function destroy($groupMemberId)
    {
        $groupMember = GroupMember::find($groupMemberId);
        $groupMember->delete();

        return redirect()->back();
    }
}
