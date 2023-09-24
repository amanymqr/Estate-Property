<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Mail\ScheduleMail;
use App\Mail\SchedualeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{

    //store message of user     from     front
    public function StoreSchedule(Request $request)
    {
        $agent_id = $request->agent_id;
        $property_id = $request->property_id;
        // dd($agent_id);
        if (Auth::check()) {
            Schedule::insert([
                'user_id' => Auth::user()->id,
                'property_id' => $property_id,
                'agent_id' => $agent_id,
                'tour_date' => $request->tour_date,
                'tour_time' => $request->tour_time,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('message', 'Send Request Successfully')
                ->with('alert-type', 'success');
        } else {
            return redirect()->back()->with('message', 'Plz Login Your Account First')
                ->with('alert-type', 'error');
        }
    }


    //agent display user message
    public function AgentScheduleRequest()
    {
        $id = Auth::user()->id;
        $user_msg = Schedule::where('agent_id', $id)->get();
        return view('agent.schedule.schedule_request', compact('user_msg'));
    }


    //agent details user message
    public function AgentDetailsSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('agent.schedule.schedule_details', compact('schedule'));
    }


    //agent update status of message to make as read
    public function AgentUpdateSchedule(Request $request)
    {
        $sid = $request->id;
        Schedule::findOrFail($sid)->update([
            'status' => '1',
        ]);
        // dd($request->email);
        $sendmail = Schedule::findOrFail($sid);

        $data = [
            'tour_date' => $sendmail->tour_date,
            'tour_time' => $sendmail->tour_time,
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));
        //send to user  email  that we get it from relation

        return redirect()->route('agent.schedule.request')->with('message', 'You have Confirm Schedule Successfully')
            ->with('alert-type', 'success');;
    }
}
