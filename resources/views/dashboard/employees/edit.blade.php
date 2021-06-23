@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Employee</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employees')}}">Employees</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <form class=" p-2  m-3 border " method="post" action="{{route('update.employee' ,request()->route()->parameters['id'])}}" enctype="multipart/form-data" >

        @csrf

        <div class="border p-3 m-3">
            <label for="tea1">Name</label>
            <input class="w-100 p-2" id="tea1" name="name" value="{{$employee->name}}" placeholder="Name"  >
            <p style="color: #cc0000" >@error('name') {{$message}} @enderror</p>
            <br>
            <label for="tea2">Job</label>
            <input class="w-100 p-2" id="tea2" name="job" value="{{$employee->job}}" placeholder="Job"  >
            <p style="color: #cc0000" >@error('job') {{$message}} @enderror</p>
            <br>
            <label for="tea">description</label>
            <textarea class="w-100 p-3" id="tea" rows="4" name="description" placeholder="description" >
                {{$employee->description}}
            </textarea>
            <p style="color: #cc0000" >@error('description') {{$message}} @enderror</p>
            <br>

            <div class="row align-items-center justify-content-center">
                <div class="col-md-5">
                    <input type="file" id="input_img" name="img"/>
                </div>
                <div class="col-md-5">
                    <img class="img-thumbnail" id="imgPreview" src="{{asset('imgs/employees/' . $employee->img)}}"  alt="img" />
                </div>
            </div>

            <br>
            <label>Projects he worked in</label>
            <select class="form-control" onchange="addSection(this.value ,this.options[this.selectedIndex].innerHTML);">
                <option></option>
                @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->title}}</option>
                @endforeach
            </select>
            <div class="sections-inputs m-2 row justify-content-center">

            </div>

            <p style="color: #cc0000" >@error('img') {{$message}} @enderror</p>
        </div>


        <div class="row justify-content-center">
            <div class="col"><input type="submit" class="btn btn-primary mt-3" /></div>
        </div>

        <script>


            var sections = [];

            function addSection(value ,text){

                if(sections.indexOf(value) === -1){
                    sections.push(value);
                    $('.sections-inputs').append('<div class="section-input row align-items-center">\n' +
                        '<input readonly class="text-center d-none sec-inpt" type="text" value="'+ value +'">\n' +
                        '<span class="m-2">'+text+'</span>\n' +
                        '<i class="fa fa-times" onclick="$(this).parent().remove();sections.splice('+sections.indexOf(value)+' ,1);changeSectionInputName();" ></i>\n' +
                        '</div>');
                    changeSectionInputName();
                }else {
                    alert('This Section is added before !!');
                }

            } // end of add section function

            function changeSectionInputName(){
                let secInputs = document.getElementsByClassName('sec-inpt');
                for (let i = 0 ;i < secInputs.length ;i++){
                    $(secInputs[i]).attr('name','section' + i);
                }
            }


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

    </form>




@endsection

@section('script')
    <script>
        $('.d-employees').addClass('active');
        @foreach($employee->projects as $project)
            addSection({{$project->id}} , "{{$project->title}}");
        @endforeach
    </script>


@endsection
