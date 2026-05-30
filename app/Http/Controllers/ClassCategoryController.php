<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClassCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category']   = ClassCategory::orderBy('created_at', 'desc')->get();
        $profile            = DashboardController::userData(auth()->user()->id);
        // dd($data);
        return view('backend.category.index', [
            'data' => $data,
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validate = Validator::make($request->all(), [
            'title' => 'required|unique:class_categories|max:255',
        ]);


        if($validate){
            try {
                $save = new ClassCategory();
                $save->title        = $request->title;
                $save->slug         = Str::slug($request->title);
                $save->description  = $request->description_category_class ? $request->description_category_class : $request->title;
                $save->status       = 1;
                $save->created_by   = auth()->user()->id;
                $save->save();

                Alert::success('Sukses', 'Kategori berhasil ditambah!');
                return redirect()->route('category.index');
            } catch (Exception $error) {
                Alert::error('Gagal', $error->getMessage());
                return redirect()->route('category.index');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $save = ClassCategory::findOrFail($request->id);
            $save->title        = $request->title;
            $save->slug         = Str::slug($request->title);
            $save->description  = empty($request->description_category_class) ? $request->title : $request->description_category_class;
            $save->created_by   = auth()->user()->id;
            $save->save();

            Alert::success('Sukses', 'Kategori berhasil diupdate!');
            return redirect()->route('category.index');
        } catch (Exception $error) {
            Alert::error('Gagal', $error->getMessage());
            return redirect()->route('category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ClassCategory::where('id', $id)->delete();
        Alert::success('Terhapus', 'Kategori berhasil dihapus!');
        return redirect()->route('category.index');
    }

    public function changeStatus($id, $type){
        $udpate = ClassCategory::findOrFail($id);
        if($type == 1){
            $udpate->status = 0;
        }else{
            $udpate->status = 1;
        }
        $udpate->save();

        Alert::success('Sukses', 'Kategori berhasil diubah!');
        return redirect()->route('category.index');
    }
}
