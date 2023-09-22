<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Models\PropertMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentMessageController extends Controller
{
    public function AgentPropertyMessage()
    {

        $id = Auth::user()->id;
        $user_msg = PropertMessage::where('agent_id', $id)->get();
        return view('agent.message.all_message', compact('user_msg'));
    }

    public function AgentMessageDetails($id)
    {
        $msgdetails = PropertMessage::findOrFail($id);
        $user_id = Auth::user()->id;
        $usermsg = PropertMessage::where('agent_id', $user_id)->get();
        return view('agent.message.message_details', compact('usermsg', 'msgdetails'));
    }
}
