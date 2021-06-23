<?php

namespace App\Http\Controllers;

use App\About;
use App\User;
use App\Best;
use App\Employee;
use App\Message;
use App\Page;
use App\Project;
use App\Statistic;
use App\Http\Resources\AboutResource;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function getAll(){
        return response()->json([
            'success' => true ,
            'home' => Page::all(),
        ]);
    }

    public function getStatistics(){
        return response()->json([
            'success' => true,
            'statistics' => Statistic::all()
        ]);
    }

    public function getBest(){
        return response()->json([
           'success' => true ,
            'best' => Best::all()
        ]);
    }

    public function getRecentProjects(){

        $projects = Project::latest()->get();
//        for ($i = 0 ; $i < count($projects) ;$i++){
//            $projects[$i]['sections'] = $projects[$i] -> sections;
//        }

        return response()->json([
           'success' => true,
           'projects' => $projects
        ]);
    }

    public function getProject($id){
        $project = Project::where('id' ,$id)->get();
        $project[0]['sections'] = $project[0]->sections;
        $project[0]['images'] = $project[0]->images;
        return response()->json([
           'success' => true ,
           'project' => $project
        ]);
    }

    public function getEmployees(){
        $employees = Employee::all();
        return response()->json([
           'success' => true ,
           'employees' => $employees
        ]);
    }

    public function getEmployee($id){
        $employee = Employee::where('id' ,$id) -> get();
        $employee[0]['projects'] = $employee[0]->projects;
        return response()->json([
           'success' => true ,
           'employee' => $employee[0],
        ]);
    }


    public function getAbout(){
        // dd(bcrypt(123));
        try{
            $about = About::selectRaw('id, name, title, img ,description')->get();
            if(count($about)){
                return response()->json([
                   'success' => 1,
                   'about' => AboutResource::collection($about)
                ]);
            }else{
                return response() ->json([
                    'success' => 2 ,
                     'msg' => 'no data',
                 ]);
            }
        }catch(\Exception $e){
            return response() ->json([
                'success' => 0 ,
                 'msg' => 'error: ' . $e->getMessage(),
             ]);
        }
    }

    public function storeMessage(Request $request){

        Message::create([
            'first_name' => $request -> firstName,
            'last_name' => $request -> lastName,
            'phone' => $request -> phone,
            'email' => $request -> email,
            'message' => $request -> message,
        ]);

        return response() -> json([
           'success' => true
        ]);
    }



    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        // $credentials = $request->only('email', 'password');
       
        // $pass = \Hash::make($request->password);
        $email = $request->email;

        $checkUser = User::where('email', $email)->first();
        if($checkUser && \Hash::check($request->password, $checkUser->password)){
            $user =  $checkUser;
            $user->api_token = $this->generateRandomString($length = 60);
            $user->save();
            return $user->api_token;
        }
        return 'error in creditianls';
        /*
        if (\Auth::attempt($credentials)) {
            $user = auth()->user();
            $user->api_token = $this->generateRandomString($length = 60);
            $user->save();
            return $user->api_token;
        }else{
            return 'error in creditianls';
        }
        */
    }

    public function any(){
        $user = auth()->guard('api')->user(); // = User::where('api_token', $request->api_token)->first();

        if($user){ // auth()->guard('web')->user() //// auth()->guard('api')->user()
            return collect();
        }
        return 'a';
    }


    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}/// end of the class
