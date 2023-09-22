<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function AdminPropertyMessage(){

        $usermsg = PropertMessage::latest()->get();
        return view('backend_admin.message.all_message',compact('usermsg'));

    }// End Method



}
