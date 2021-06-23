@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pages Content</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <h5 class="p-3"> > Home Page Elements</h5>
    <form class=" p-4  m-3 border " onsubmit="pagesSubmit(event);" >

        @csrf
        @foreach($pages as $page)
            <label for="tea{{$page->id}}">{{$page->name}}</label>
            <textarea class="w-100 p-3" id="tea{{$page->id}}" rows="3" name="{{$page->name}}"  >{{$page -> value}}</textarea>
        @endforeach

            <input type="submit" class="btn btn-primary mt-3" />


            @include('dashboard.ajax-requests')
    </form>

    <br>

    <h5 class="p-3"> > About Page Elements</h5>
    <form class=" p-2  m-3 border create-form" onsubmit="updateAbout(event);" enctype="multipart/form-data">

        @csrf
        @foreach($abouts as $about)

            <div class="border p-3 m-3">
                <label for="tea1{{$about->id}}">{{$about->name}} title</label>
                <input disabled class="w-100 p-2" id="tea1{{$about->id}}" name="{{$about->name . '_title'}}" placeholder="title" value="{{$about->title}}"  >
                <br><br>
                <label for="tea{{$about->id}}">{{$about->name}} description</label>
                <textarea disabled class="w-100 p-3" id="tea{{$about->id}}" rows="4" name="{{$about->name . '_desc'}}"  >{{$about -> description}}</textarea>
                <br><br>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5">
                        <input disabled type="file" name="{{$about->name . '_img'}}">
                    </div>
                    <div class="col-md-5">
                        <img class="img-thumbnail" src="{{asset('imgs/' . $about->img)}}"  alt="img" />
                    </div>
                </div>
                @if($about->name != 'service')
                    <button class="btn btn-danger" onclick="deleteAboutSection(this ,{{$about->id}} ,event)"  > Delete </button>
                @endif
                <a href="{{route('about.update' ,$about->id)}}" class="btn btn-success"> Update </a>

            </div>
        @endforeach

        <div class="row justify-content-center">
            <div class="col"><a href="{{route('about.add')}}" class="btn btn-warning"><i class="fa fa-plus" ></i></a></div>
        </div>


        @include('dashboard.ajax-requests')


        @error('aboutSuccess')

            <script>
                successNotification({
                    title: 'Message',
                    message: 'About section updated successfuly :)',
                });
            </script>

        @enderror

    </form>









@endsection


@section('script')
    <script>
        $('.d-pages').addClass('active');
    </script>
@endsection
