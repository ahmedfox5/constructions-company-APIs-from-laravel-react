@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Projects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- TABLE: LATEST ORDERS -->
    <div class="card fox-glass2-light m-3">
        <div class="card-header border-transparent">

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>




                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->job}}</td>
                            <td>
                                <img src="{{asset('imgs/employees/' . $employee->img)}}" alt="img">
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                    <a href="{{route('edit.employee' ,$employee->id)}}" ><button class="btn btn-success" >Update</button></a>
                                    <button onclick="deleteEmployee(this ,{{$employee->id}});" class="btn btn-danger" >Delete</button>
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
        <div class="row justify-content-center p-3">
            <div class="col"><a href="{{route('create.employee')}}" class="btn btn-warning"><i class="fa fa-plus" ></i></a></div>
        </div>
    </div>

    @include('dashboard.ajax-requests')

@endsection

@section('script')
    <script>

        @error('employeeAdd')
            successNotification({
                title : 'Message',
                message: 'Employee added successfuly'
            });
        @enderror
        @error('employeeUpdate')
            successNotification({
                title : 'Message',
                message: 'Employee Updated successfuly'
            });
        @enderror

        $('.d-employees').addClass('active');
    </script>
@endsection
