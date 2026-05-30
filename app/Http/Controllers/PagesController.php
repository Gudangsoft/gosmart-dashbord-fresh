<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Models\PageCategoryModel;
use App\Models\PagesModel;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $data['announcement'] = self::Announcement();

        $profile = DashboardController::userData(auth()->user()->id);
        return view('backend.announcement.index', [
            'data' => $data,
            'profile' => $profile,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['meta']['title'] = 'Pengumuman';
        $profile = DashboardController::userData(auth()->user()->id);

        return view('backend.announcement.created', [
            'data' => $data,
            'profile' => $profile,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title          = $request->title;
        $slug           = Str::slug($request->title);
        $category_id    = $request->category_id ? $request->category_id : '0';
        $content        = $request->content;
        $akses          = (int)$request->akses;
        $type           = (int)$request->type;
        $created_by     = auth()->user()->id;

        $save               = new PagesModel();
        $save->title        = $title;
        $save->slug         = $slug;
        $save->category_id  = 1;
        $save->content      = $content;
        $save->status       = $akses;
        $save->type         = $type;
        $save->created_by   = $created_by;
        $save->updated_by   = $created_by;
        $save->save();

        Alert::success('Sukses', 'Data berhasil diupdate!');
        return redirect()->route('announcement');
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
        $data['meta']['title'] = 'Pengumuman';
        $data['data'] = PagesModel::findOrFail($id);

        $profile = DashboardController::userData(auth()->user()->id);
        return view('backend.announcement.created', [
            'data' => $data,
            'profile' => $profile,
        ]);
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
        $title          = $request->title;
        $slug           = Str::slug($request->title);
        $category_id    = $request->category_id ? $request->category_id : '0';
        $content        = $request->content;
        $akses          = (int)$request->akses;
        $type           = (int)$request->type;
        $created_by     = auth()->user()->id;

        $save               = PagesModel::findOrFail($request->id);
        $save->title        = $title;
        $save->slug         = $slug;
        $save->category_id  = 1;
        $save->content      = $content;
        $save->status       = $akses;
        $save->type         = $type;
        $save->created_by   = $created_by;
        $save->updated_by   = $created_by;
        $save->save();

        Alert::success('Sukses', 'Data berhasil diupdate!');
        return redirect()->route('announcement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PagesModel::findOrFail($id)->delete();

        Alert::success('Terhapus', 'Data berhasil dihapus!');

        return back();
    }

    public static function Announcement(){
        $row = PagesModel::where('category_id', 1)->get();
        foreach ($row as $k => $v) {
            $data['data'][$k]['id']         = $v->id;
            $data['data'][$k]['title']      = $v->title;
            $data['data'][$k]['slug']       = $v->slug;
            $data['data'][$k]['content']    = $v->content;
            $data['data'][$k]['status']     = $v->status;
            $data['data'][$k]['type']       = $v->type;
            $data['data'][$k]['created_by'] = $v->getUser->name;
            $data['data'][$k]['created_at'] = $v->created_at;
        }

        return $data;
    }
}
