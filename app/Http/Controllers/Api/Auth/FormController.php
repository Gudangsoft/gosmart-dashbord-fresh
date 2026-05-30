<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\ClassMenu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'This create page'
        ], 200);
    }

    public function createCourse(Request $request){

        $request->validate([
            'name'          => 'required',
            'category'      => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'premium'       => 'required',
            'tags'          => 'required',
        ]);

        // dd($request->all());

        $course = new ClassMenu();
        $course->name = $request->name;
        $course->slug = Str::slug($request->name);
        $course->category_id = $request->category;
        $course->description = $request->description;
        $course->status = 'p';
        $course->add_by = auth()->user()->id;
        $course->price = $request->price;
        $course->premium = $request->premium;
        $course->tags = $request->tags;
        $course->level_id = $request->level;
        $course->tools_id = $request->tools_id;
        $course->source_url = $request->source_url;
        $course->save();

        return response()->json([
            'message' => 'Data course add successfully',
            'data' => $course
        ], 200);
    }

}
