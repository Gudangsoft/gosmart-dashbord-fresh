<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Models\EventRegisted;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{

    public function index()
    {
        $profile = DashboardController::userData(auth()->user()->id);
        return view('backend.events.index', compact('profile'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $profile = DashboardController::userData(auth()->user()->id);
        $rows    = EventRegisted::where('event_id', $id)->get();
        return view('backend.events.registed_list', compact('profile', 'rows'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        EventRegisted::find($id)->delete();
        Alert::success('Terhapus', 'Data berhasil di hapus.');
        return back();
    }
}
