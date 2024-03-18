<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $notifications = GroupMember::with('group')->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('dashboard', compact('notifications'));
    }
}
