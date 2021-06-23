<?php

namespace App\Http\Controllers;

use App\About;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class dPagesController extends Controller
{
    //    start of pages content
    public function index(){
        return view('dashboard.pages-content') -> with([
            'pages' => Page::all(),
            'abouts' => About::all(),
        ]);
    }

    public function pagesUpdate(Request $request){
        $request->validate([
                "header_description" => 'required',
                "service_description" => 'required',
                "construction" => 'required',
                "houseRenovation" => 'required',
                "painting" => 'required',
                "architectureDesign" => 'required',
                "recentWorks" => 'required',
                "employees_description" => 'required',
                "projectsPg_description" => 'required',
                "phone" => 'required',
                "email" => 'required',
                "facebook" => 'required',
                "googlePlus" => 'required',
                "twitter" => 'required',
                "pinterest" => 'required',
                "linkedIn" => 'required',
                "address" => 'required',
        ]);

        $elements = array(
            array("header_description" , $request->header_description),
            array("service_description" , $request->service_description),
            array("construction", $request->construction),
            array("houseRenovation", $request->houseRenovation),
            array("painting", $request->painting),
            array("architectureDesign", $request->architectureDesign),
            array("recentWorks", $request->recentWorks),
            array("employees_description", $request->employees_description),
            array("projectsPg_description", $request->projectsPg_description),
            array("phone", $request->phone),
            array("email", $request->email),
            array("facebook", $request->facebook),
            array("googlePlus", $request->googlePlus),
            array("twitter", $request->twitter),
            array("pinterest", $request->pinterest),
            array("linkedIn", $request->linkedIn),
            array("address", $request->address),
        );

        foreach ($elements as $element){
            Page::where('name' ,$element[0]) -> update([
                'value' => $element[1],
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function addAboutSection(){
        return view('dashboard.addAboutSection');
    }

    public function addAboutSectionStore(Request $request){
        $request->validate([
            'description' => 'required',
            'img' => 'required|mimes:jpg,png,jpeg',
        ]);

        $name = str_replace(' ' ,'' ,$request->title);
        $imgExtension = $request->img->getClientOriginalExtension();
        $imgName = time() . str_replace(['.' ,'g'] ,'' ,$request->img->getClientOriginalName()) . '.' . $imgExtension;
        $request -> img ->move('imgs/' ,$imgName);

        About::create([
           'name' => $name,
           'title' => $request->title,
           'description' => $request -> description,
            'img' => $imgName,
        ]);

        return back()->withErrors([
           'success' => true,
        ]);
    }


//    delete about section
    public function deleteAboutSectionStore(Request $request){
        $section = About::find($request->id);
        if(File::exists(public_path('imgs/' . $section->img))){
            File::delete(public_path('imgs/' . $section->img));
        }
        About::destroy($request->id);
        return response()->json([
            'success' => true,
        ]);
    }


//    update about
    public function aboutUpdate($id){
        $about = About::find($id);
        return view('dashboard.about-section-update', compact('about' ,$about));
    }


//    store the updated about section
    public function aboutUpdateStore(Request $request ,$id){
        $about = About::find($id);
        $about->update([
            'name' => str_replace(' ' ,'' ,$request->title),
            'title' => $request->title,
            'description' => $request->description,

        ]);
        if($request->hasFile('img' )){
            if(File::exists(public_path('imgs/' . $about->img))){
                File::delete(public_path('imgs/' . $about->img));
            }
            $request->img -> move('imgs/' ,$about->img);
        }
        return redirect() -> to('/dashboard/pages') -> withErrors([
           'aboutSuccess' => true,
        ]);
    }

} /// end of the class
