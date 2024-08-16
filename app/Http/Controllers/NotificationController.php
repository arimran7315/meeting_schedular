<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = session('newMeetId');
        $uid = Auth::user()->id;

        $notifications = Notification::where('meeting_id', $id)
            ->whereHas('user', function ($query) use ($uid) {
                $query->where('id', '!=', $uid);
            })
            ->with('user')
            ->get();
        $users = User::query()->where('id', '!=', Auth::user()->id)->get();
        $meetings = Meeting::where('user_id', $uid)->get();

        if ($notifications->isEmpty()) {
            $notifications = null;
        }
        // return $notification;
        return view('sendMeeting', compact('meetings', 'users', 'notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Notification::create([
            'user_id' => $request->user_id,
            'meeting_id' => $request->meet_id,
            'status' => '0'
        ]);
        if ($data) {

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $uid = Auth::user()->id;
        $notifications = Notification::where('meeting_id', $id)
            ->whereHas('user', function ($query) use ($uid) {
                $query->where('id', '!=', $uid);
            })
            ->with('user')
            ->get();
        $users = User::query()->where('id', '!=', $uid)->get();
        $meetings = Meeting::where('user_id', $uid)->get();

        if ($notifications->isEmpty()) {
            $notifications = null;
        }
        // return $notification;
        return view('sendMeeting', compact('meetings', 'users', 'notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notifications = Notification::select('notifications.id as n_id', 'notifications.status', 'meetings.*', 'users.name')
        ->join('meetings', 'notifications.meeting_id', '=', 'meetings.id')
        ->join('users', 'meetings.user_id', '=', 'users.id')
        ->where('notifications.user_id', $id)
        ->where('notifications.status', 0)
        ->orderBy('notifications.meeting_id', 'DESC')
        ->get();
        return view('invitation',compact('notifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->status == '2'){
            Notification::whereId($id)->update([
                'status' => 2,
            ]);
            return redirect()->back();
        }
        if($request->status == '3'){
            Notification::whereId($id)->update([
                'status' => 3,
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
