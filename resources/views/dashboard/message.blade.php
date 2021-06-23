@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Message View</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('messages')}}" >Messages</a></li>
                        <li class="breadcrumb-item active">Message</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if($message)
        <div class="p-3 ">
            <div class="row">
                <div class="col-5 m-2"><h5 class="font-weight-bolder">First Name: <span style="color: #444;font-weight: normal">{{$message->first_name}}</span></h5></div>
                <div class="col-5 m-2"><h5 class="font-weight-bolder">Last Name: <span style="color: #444;font-weight: normal">{{$message->last_name}}</span></h5></div>
            </div>

            <div class="row">
                <div class="col-5 m-2"><h5 class="font-weight-bolder">Email Address: <span style="color: #444;font-weight: normal">{{$message->email}}</span></h5></div>
                <div class="col-5 m-2"><h5 class="font-weight-bolder">Phone Number: <span style="color: #444;font-weight: normal">{{$message->phone}}</span></h5></div>
            </div>

            <div class="m-3 p-3 border">
                <h4 class="font-weight-bolder" >Message Content</h4>
                <br>
                <p>{{$message->message}}</p>
            </div>
            <br>
            <button class="btn btn-danger" >Delete</button>
        </div>

    @else
        <h1 class="p-5">Not Found !!</h1>

    @endif



@endsection

@section('script')
    <script>
        $('.d-messages').addClass('active');
    </script>
@endsection
