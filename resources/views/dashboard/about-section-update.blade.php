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
                        <li class="breadcrumb-item active"><a href="{{route('pages.content')}}" >Pages Content</a></li>
                        <li class="breadcrumb-item active">About section</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <h5 class="p-3"> >Add About Page Elements</h5>
    <form class=" p-2  m-3 border " method="post" action="{{route('about.update.store' , request()->route()->parameters['id'])}}" enctype="multipart/form-data" >
        @csrf

        <div class="border p-3 m-3">
            <label for="tea1">Title</label>
            <input class="w-100 p-2" id="tea1" name="title" placeholder="title" value="{{$about->title}}" >
            <br><br>
            <label for="tea">description</label>
            <textarea class="w-100 p-3" id="tea" rows="4" name="description" placeholder="description" >{{$about->description}}</textarea>
            <p style="color: #cc0000" >@error('description') {{$message}} @enderror</p>
            <br><br>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5">
                    <input type="file" id="input_img" name="img"/>
                </div>
                <div class="col-md-5">
                    <img class="img-thumbnail" id="imgPreview" src="{{asset('imgs/' . $about->img)}}"  alt="img" />
                </div>
            </div>
            <p style="color: #cc0000" >@error('img') {{$message}} @enderror</p>
        </div>


        <div class="row justify-content-center">
            <div class="col"><input type="submit" class="btn btn-primary mt-3" /></div>

        </div>

        <script>
            let theInput = document.getElementById('input_img');
            let imgPreview = document.getElementById('imgPreview');

            theInput.onchange = function (){
                if (theInput.files && theInput.files[0]){
                    let reader = new FileReader();
                    reader.onload = function (e){
                        imgPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(theInput.files[0]);
                }
            }
        </script>



@endsection

@section('script')
    <script>
        $('.d-pages').addClass('active');
    </script>
@endsection
