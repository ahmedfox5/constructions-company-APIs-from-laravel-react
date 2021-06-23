<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        $messages = Message::orderby("id" ,"desc")->take(7)->get();
        return view('/dashboard/dashboard') -> with([
            'messages' => $messages,
        ]);
    }



//    start of messages functions

    public function messages(){
        $messages = Message::latest()->paginate(5);
        return view('dashboard.messages' ,compact('messages' , $messages));
    }

    public function message($id){
        $message = Message::find($id);
        return view('dashboard.message') -> with([
            'message' => $message
        ]);
    }

    public function deleteMessageGet($id){
        Message::destroy($id);
        return redirect() -> to('/dashboard/');
    }

    public function deleteMessage(Request $request){
        Message::destroy($request->id);
        return response()->json([
           'success' => true,
        ]);
    }







} // end of the dashboard controller
