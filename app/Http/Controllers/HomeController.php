<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId=auth()->id();
        $messages= Message::with(['user'=>function($q){
            $q->select('id','name');
        }])->select('user_id','body')->get();
        $users=User::all('name','id')->where('id','!=',$userId);
        return view('home',compact('users','messages','userId'));
    }

    public function store(Request $request){
        $data['body']=$request->msg;
        $data['user_id']=auth()->id();
        $message=Message::create($data);
        broadcast(new MessageSend($message->load('user')))->toOthers();
    }


}
