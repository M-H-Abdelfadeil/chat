@extends('layouts.app')

@section('content')


    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group justify-content-center">
                            <span class="text-white h5">Users</span>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ui class="contacts">
                            @foreach($users as $user)
                                <li class="active">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="https://ui-avatars.com/api/?name={{$user->name}}" class="rounded-circle user_img">
                                            <span class="online_icon offline status-user-{{$user->id}}"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>{{$user->name}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div></div>
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">

                            <div class="user_info">
                                <span>Chat</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body" >
                        <div id="boxMessage">
                            @foreach($messages as $msg)
                                @if($msg->user_id == $userId)
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                    <div class="font-weight-bold">Me</div>
                                        {{$msg->body}}
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="https://ui-avatars.com/api/?name=Me" class="rounded-circle user_img_msg">
                                    </div>
                                </div>
                                @else
                                <div class="d-flex justify-content-start mb-4">
                                    <div class="img_cont_msg">
                                        <img src="https://ui-avatars.com/api/?name={{$msg->user->name}}" class="rounded-circle user_img_msg">
                                    </div>
                                    <div class="msg_cotainer">
                                        <div class="font-weight-bold">{{$msg->user->name}}</div>
                                        {{$msg->body}}
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        
                        
                        

                    <div class="card-footer">
                        <div class="input-group">
                            <textarea name="" class="form-control type_msg" data-url="{{route('msg.store')}}"  placeholder="Type your message..." id="text-msg"></textarea>
                            <div class="input-group-append" >
                                <span class="input-group-text send_btn" id="btn-send-msg"><i class="fas fa-location-arrow"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form class="d-flex">--}}
{{--                    <input type="text" class="form-control" data-url="{{route('messages.store')}}" name=""  id="chat-text">--}}
{{--                    <button class="btn btn-primary">Send</button>--}}
{{--                </form> --}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
