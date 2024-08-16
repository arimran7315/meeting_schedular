<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uid = Auth::user()->id;
        $meetings = Meeting::where('user_id', $uid)->get();
        return view('manageMeeting', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addMeeting');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $meeting = $request->validate([
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'location' => 'required',
        ], [
            'title.required' => 'Field is required',
            'date.required' => 'Field is required',
            'time.required' => 'Field is required',
            'duration.required' => 'Field is required',
            'location.required' => 'Field is required',
        ]);
        $meet = Meeting::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'meet_date' => $request->date,
            'meet_time' => $request->time,
            'meet_duration' => $request->duration,
            'meet_location' => $request->location,
        ]);
        if ($meet) {
            Notification::create([
                'meeting_id' => $meet->id,
                'status' => '4',
                'user_id' => Auth::user()->id,
            ]);
            session()->put('newMeetId', $meet->id);
            
            return redirect()->route('Notification.create');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = Meeting::find($id);
        return view('viewMeeting', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meeting = Meeting::find($id);
        return view('editMeeting', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $meeting = Meeting::whereId($id)->update([
            'title' => $request->title,
            'meet_date' => $request->date,
            'meet_time' => $request->time,
            'meet_duration' => $request->duration,
            'meet_location' => $request->location
        ]);
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Meeting::destroy($id);
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Deleted successfully'
        ]);
    }
}
