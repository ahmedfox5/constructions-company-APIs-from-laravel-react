@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Messages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Messages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light m-3">
        <div class="card-header border-transparent">
            <h3 class="card-title">Latest Messages</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>




                    @foreach($messages as $message)
                        <tr>
                            <td>{{$message->first_name . " " . $message->last_name }}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->phone}}</td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                    <a href="{{route('message' ,$message->id)}}" ><button class="btn btn-primary" >View</button></a>
                                    <button onclick="deleteMessage(this ,{{$message->id}});" class="btn btn-danger" >Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
    </div>
    <div class="row justify-content-center m-0 pagination-father">{{$messages->links()}}</div>
    @include('dashboard.ajax-requests')

@endsection

@section('script')
    <script>
        $('.d-messages').addClass('active');
    </script>
@endsection
