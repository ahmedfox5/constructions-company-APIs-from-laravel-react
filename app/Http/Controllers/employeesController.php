<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Project;
use App\ProjectEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class employeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('dashboard.employees.index')->with([
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('dashboard.employees.create' ,compact('projects' ,$projects));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'job' => 'required',
           'description' => 'required',
           'img' => 'required|mimes:jpg,jpeg,png',
        ]);

        $fileExtension = $request->img->getClientOriginalExtension();
        $fileName = time() . str_replace(['.jp' ,'.pn'] ,'' ,$request->img->getClientOriginalName()) . "." . $fileExtension;
        $request->img->move("imgs/employees/" ,$fileName);

        Employee::create([
            'name' => $request->name,
            'job' => $request->job,
            'description' => $request->description,
            'img' => $fileName,
        ]);

        $lastEmplyeeId = Employee::orderby("id" ,"desc")->take(1)->get()[0]->id;

        for($i = 4; $i < count($request->request) ;$i++){
            $secName = 'section' . ($i - 4 );
            $proEm = new ProjectEmployee();
            $proEm -> project_id = $request->$secName;
            $proEm -> employee_id = $lastEmplyeeId;
            $proEm->save();
        }

        return redirect() -> to('/dashboard/employees')->withErrors([
            'employeeAdd' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.employees.edit')->with([
           'employee' => Employee::find($id),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {

        $request->validate([
           'name' => 'required',
           'job' => 'required',
           'description' => 'required',
           'img' => 'mimes:jpg,jpeg,png',
        ]);

        $employee = Employee::find($id);
        $imgName = $employee->img;

        if ($request->hasFile('img')){
            if (File::exists(public_path('imgs/employees/' . $imgName))){
                File::delete(public_path('imgs/employees/' . $imgName));
            }
            $extension = $request->img->getClientOriginalExtension();
            $imgName = time() . str_replace(['.jp' ,'.pn'] ,"" ,$request->img->getClientOriginalName()) . "." . $extension;
            $request->img->move("imgs/employees/" ,$imgName);
        }

        $employee->update([
            'name' => $request->name ,
            'job' => $request->job ,
            'description' => $request->description ,
            'img' => $imgName
        ]);

        ProjectEmployee::where("employee_id" ,$id)->delete();
        for($i = 4; $i < count($request->request) ;$i++){
            $secName = 'section' . ($i - 4 );
            $proEm = new ProjectEmployee();
            $proEm -> project_id = $request->$secName;
            $proEm -> employee_id = $id;
            $proEm->save();
        }

        return redirect() -> to('/dashboard/employees')->withErrors([
            'employeeUpdate' => true,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(Request $request)
    {
        $employee = Employee::find($request->id);
        if(File::exists(public_path('imgs/employees/' . $employee->img))){
            File::delete(public_path('imgs/employees/' . $employee->img));
        }
        Employee::destroy($request->id);

        ProjectEmployee::where("employee_id" ,$request->id)->delete();

        return response()->json([
            'success' => true,
            'employeeDelete' => true,
        ]);
    }
}
