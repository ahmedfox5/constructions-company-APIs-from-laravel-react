<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\ProjectEmployee;
use App\ProjectImage;
use App\ProjectSection;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class projectsController extends Controller
{
    public function index(){
        return view('dashboard.projects.index') -> with([
            'projects' => Project::all(),
        ]);
    }

    public function project($id){
        $project = Project::find($id);
        $employees = Employee::all();
        return view('dashboard.projects.project.index')->with([
            'project' => $project,
            'employees' => $employees,
        ]);
    }


    public function headerSave(Request $request ){

        $pro = Project::find($request->id);
        $fileName = $pro->img;
        if ($request->hasFile('img')){
            if(File::exists(public_path('imgs/projects/' . $fileName))){
                File::delete(public_path('imgs/projects/' .$fileName));
            }
            $extension = $request->img->getClientOriginalExtension();
            $fileName = str_replace([ '.png' , '.jpg' ,'.'] ,"" ,$fileName) . '.' . $extension;
            $request->img->move('imgs/projects' ,$fileName);
        }

        Project::find($request->id)->update([
            "title" => $request->title,
            "description" => $request->description,
            'img' => $fileName,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function imgsDelete(Request $request){
        $img = ProjectImage::find($request->id);
        if(File::exists(public_path('imgs/projects/' . $img->img))){
            File::delete(public_path('imgs/projects/' . $img->img));
        }
        ProjectImage::destroy($request->id);
        return response()->json([
           'success' => true,
        ]);
    }

    public function imgsSave(Request $request){
        $fileName = false;
        if($request->hasFile('projectImg')){
            $extension = $request->projectImg->getClientOriginalExtension();
            $fileName = time() . str_replace(['.png' ,'.jpg' ,'.jpeg' ,'.'] ,'' ,$request->projectImg->getClientOriginalName()) . "." . $extension;
            $request->projectImg->move('imgs/projects' ,$fileName);
            $newImg = new ProjectImage();
            $newImg->img = $fileName;
            $newImg->project_id = $request->id;
            $newImg->save();

        }

        return response()->json([
            'success' => true,
            'img' => $fileName,
            'last_id' => ProjectImage::where("project_id" ,$request->id)->orderby("id" ,"desc")-> take(1)->get()[0]->id
        ]);
    }

    public function sectionDelete(Request $request){
        $section = ProjectSection::find($request->id);
        if(File::exists(public_path('imgs/' . $section->img))){
            File::delete(public_path('imgs/' . $section->img));
        }
        ProjectSection::destroy($request->id);
        return response()->json([
           'success' => true ,
        ]);
    }

    public function sectionUpdate($id){
        $section = ProjectSection::find($id);
        return view('dashboard.projects.project.section-update')->with([
            'section' => $section,
        ]);
    }

    public function sectionEdit(Request $request ,$id){
        $section = ProjectSection::find($id);
        $fileName = $section->img;
        if($request->hasFile('img')){
            $extension = $request->img->getClientOriginalExtension();
            $fileName = time() . str_replace(['.png' ,'.jpg' ,'.jpeg' ,'.'] ,'' ,$request->img->getClientOriginalName()) . "." . $extension;
            if(File::exists(public_path('imgs/' . $section->img))){
                File::delete(public_path('imgs/' . $section->img));
            }
            $request->img->move('imgs/' ,$fileName);
        }

        $section->update([
           'description' => $request->description,
           'img' => $fileName,
        ]);


        return redirect()->to('/dashboard/projects/project/' . $section->project_id)->withErrors([
            'sectionSuccess' => true,
        ]);
    }


    public function newSection(){
        return view('dashboard.projects.project.section-add');
    }


    public function storeProjectSection (Request $request ,$id){
        $request->validate([
           'description' => 'required',
           'img' => 'required|mimes:jpg,png,jpeg',
        ]);

        $fileExtension = $request->img->getClientOriginalExtension();
        $filename = time() . str_replace(['.png' ,'.jp'] ,"" ,$request->img->getClientOriginalName()) . "." . $fileExtension;
        $request->img->move('imgs/' ,$filename);
        ProjectSection::create([
            'description' => $request->description,
            'img' => $filename,
            'project_id' => $id
        ]);
        return redirect() -> to('/dashboard/projects/project/' . $id) ->withErrors([
            'sectionAdd' => true,
        ]);
    }


    public function newProject(){
        return view('dashboard.projects.new');
    }

    public function storeProject(Request $request){
        $request->validate([
           'title' => 'required',
           'description' => 'required',
           'img' => 'required|mimes:jpg,jpeg,png',
        ]);

        $fileExtension = $request->img->getClientoriginalExtension();
        $filename = time() . str_replace(['.jp' ,'.pn'] ,'' ,$request->img->getClientOriginalName()) . "." . $fileExtension;
        $request->img->move("imgs/projects/" ,$filename);

        Project::create([
           'title' => $request->title,
           'description' => $request->description,
           'img' => $filename,
        ]);

        return redirect()->to('/dashboard/projects')->withErrors([
           'projectAdd' => true ,
        ]);
    }


    public function editProjectEmployees(Request $request){

        ProjectEmployee::where("project_id" ,$request->id)->delete();


        for($i = 1; $i < count($request->request) - 1 ;$i++){
            $secName = 'section' . ($i - 1 );
            $proEm = new ProjectEmployee();
            $proEm -> project_id = $request->id;
            $proEm -> employee_id = $request->$secName;
            $proEm->save();
        }


        return response()->json([
           'success' => true,
        ]);
    }


    public function delete(Request $request){

        ProjectEmployee::where("project_id" ,$request->id)->delete();
        $projectImages = ProjectImage::where("project_id" ,$request->id);
        $projectImagesAll = $projectImages->get();

        for ($i = 0; $i < count($projectImagesAll) ;$i++ ){
            if(File::exists(public_path('imgs/projects/' . $projectImagesAll[$i]->img))){
                File::delete(public_path('imgs/projects/' . $projectImagesAll[$i]->img));
            }
        }

        $projectImages->delete();

        $project = Project::find($request->id);
        if(File::exists(public_path('imgs/projects/' . $project->img))){
            File::delete(public_path('imgs/projects/' . $project->img));
        }
        Project::destroy($request->id);


        return response()->json([
           'success' => true,
        ]);
    }



}
