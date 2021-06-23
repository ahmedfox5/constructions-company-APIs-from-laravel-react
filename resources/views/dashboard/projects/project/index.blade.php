@extends('dashboard.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Project View</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('projects')}}" >Projects</a></li>
                        <li class="breadcrumb-item active">Update Project</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="p-3" >

        <form method="post" enctype="multipart/form-data" onsubmit="projectHeaderSave({{$project->id}} ,event);">
            @csrf
            <div class="row align-items-center justify-content-center">
                <div class="col-3">
                    <h5> Title:  </h5></div>
                <div class="col-8">
                    <input type="text" name="title" value="{{$project->title}}" class="p-2 m-2 w-100" />
                </div>
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-3">
                    <h5> Description:  </h5></div>
                <div class="col-8">
                    <textarea  class="p-2 m-2 w-100" rows="4" name="description" > {{$project->description}}</textarea>
                </div>
            </div>

            <h5>Main Image</h5>
            <br>
            <div class="row align-items-center justify-content-center">
                <div class="col-6">
                    <input type="file" name="img" id="header_img" >
                </div>

                <div class="col-6">
                    <img src="{{asset('imgs/projects/' . $project->img)}}" class="img-thumbnail" id="header_img_preview" alt="img" />
                </div>
            </div>

            <input class="btn btn-warning" type="submit" value="Save" >
        </form>


        <br><br/>



        <!-- TABLE: LATEST ORDERS -->
        <div class="card fox-glass2-light m-3">
            <div class="card-header border-transparent">
                <h4>Images of the project</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="project_imgs_cont" >




                        @foreach($project->images as $img)
                            <tr>
                                <td>
                                    <img src="{{asset('imgs/projects/' . $img->img)}}" alt="img" >
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        <button onclick="deleteProjectImage(this ,{{$img->id}});" class="btn btn-danger" >Delete</button>
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
        <h5 class="p-3">Add Image</h5>
        <div class="row justify-content-center align-items-center p-4" style="padding-top: 0!important;">
            <div class="col-6">
                <form method="post" enctype="multipart/form-data" onsubmit="addProjectImage({{$project->id}} ,event)">
                    @csrf
                    <input type="file" id="project_img" name="projectImg" >
                    <button type="submit" class="btn btn-success m-2" >Add</button>
                </form>
            </div>
            <div class="col-6">
                <img src="{{asset('imgs/default.png')}}" class="img-thumbnail" id="project_img_view" alt="img" >
            </div>
        </div>


        <br>

        <!-- TABLE: LATEST ORDERS -->
        <div class="card fox-glass2-light m-3">
            <div class="card-header border-transparent">
                <h4>Images of the project</h4>

            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>




                        @foreach($project->sections as $section)
                            <tr>
                                <td>
                                    <p>{{$section->description}}</p>
                                </td>
                                <td>
                                    <img src="{{asset('imgs/' . $section->img)}}" alt="img" >
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        <a href="{{route('project.section.update' ,$section->id)}}" class="btn btn-success mb-2" >Update</a>
                                        <button onclick="deleteSection(this ,{{$section->id}});" class="btn btn-danger" >Delete</button>
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

        <div class="row justify-content-center p-3">
            <div class="col"><a href="{{route('project.section.add' ,request()->route()->parameters['id'])}}" class="btn btn-warning">Add Section <i class="fa fa-plus" ></i></a></div>
        </div>


        <br>
        <form method="post" onsubmit="projectEditEmployees({{$project->id}} ,event)">
            @csrf
            <div class='p-3' >
                <label>Employees in this Project</label>
                <select class="form-control" onchange="addSection(this.value ,this.options[this.selectedIndex].innerHTML);">
                    <option></option>
                    @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name . " > " . $employee->job}}</option>
                    @endforeach
                </select>
                <div class="sections-inputs m-2 row justify-content-center">

                </div>
                <button type='submit' class="btn btn-primary"> save </button>
            </div>
        </form>


    </div>



    @include('dashboard.ajax-requests')
@endsection

@section('script')
    <script>
        $('.d-projects').addClass('active');

        @error('sectionSuccess')
            successNotification({
                title : 'Message',
                message: 'Successfuly Updated'
            });
        @enderror
        @error('sectionAdd')
        successNotification({
            title : 'Message',
            message: 'Section Added Successfuly'
        })
        @enderror

        function img_preview(input ,galary){
            let image = document.getElementById(galary);
            document.getElementById(input).onchange = function (){
                if (this.files && this.files[0]){
                    let reader = new FileReader();
                    reader.onload = function (e){
                        image.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            }
        }

        img_preview('project_img' , 'project_img_view');
        img_preview('header_img' , 'header_img_preview');



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

        @foreach($project->employees as $employee)
            addSection({{$employee->id}} , "{{$employee->name . ' > ' . $employee->job}}");
        @endforeach


    </script>
@endsection



