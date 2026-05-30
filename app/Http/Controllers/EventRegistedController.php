<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Event;
use App\Models\Event as ModelsEvent;
use App\Models\EventRegisted;
use App\Models\Cart;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Mail;

class EventRegistedController extends Controller
{
    public function show($id){

        $data['event'] = ModelsEvent::where('id', $id)->first();
        $data['register']       = EventRegisted::where('event_id', $id)->count();
        
        $data['meta']           = DetailController::metaData(
            $data['event']->title,
            $data['event']->title,
            htmlspecialchars_decode($data['event']->description),
            config('app.url').''.$data['event']->image,
            'event/'.$data['event']->id
        );

        if(empty(auth()->user()->id)){
            $data['username'] = null;
        }else{
            $data['cart_count']     = Cart::where('user_id', auth()->user()->id)->where('status', 1)->count();
            $data['username'] = auth()->user()->name;
        }

        return view('member.livestream.event', [
            'data' => $data,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:event_registeds',
        ]);

        try {
            $save = new EventRegisted();
            $save->event_id = $request->event_id;
            $save->username = $request->username;
            $save->email = $request->email;
            $save->whatsapp = $request->whatsapp;
            $save->company          = $user->userData->education;
            
            $save->member_option = $request->member;
            $save->profession = $request->profession;
            $save->save();

            $email_data = array(
                'name' => $request->username,
                'email' => $request->email,
                'event' => ModelsEvent::where('id', $request->event_id)->first()
            );
            // dd($email_data);
            Mail::send('member.livestream.email_for_user', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Informasi pendafraran '.$email_data['event']->title)
                    // ->with(['image' => url('/events-images/').$email_data['event']->image])
                    ->from(config('app.email'), config('app.name'));
            });

            return redirect('event')->with('msg', 'Registrasi berhasil, silakan cek pemberithauan melalui email terdaftar');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }

    }

    public function join($id){
        $user   = User::findOrFail(auth()->user()->id);
        $event  = ModelsEvent::findOrFail($id);
        
        try {
            $save = new EventRegisted();
            $save->event_id         = $id;
            $save->username         = $user->name;
            $save->email            = $user->email;
            $save->whatsapp         = $user->phone;
            if($user->userData != null){
                $save->company          = $user->userData->education;
            }else{
                $save->company          = 'user belum melengkapi data';
            }
            $save->member_option    = 1;
            $save->save();

            $email_data = array(
                'name' => $user->username,
                'email' => $user->email,
                'event' => ModelsEvent::where('id', $id)->first()
            );
            // dd($email_data);
            Mail::send('member.livestream.email_for_user', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Informasi pendafraran '.$email_data['event']->title)
                    // ->with(['image' => url('/events-images/').$email_data['event']->image])
                    ->from(config('app.email'), config('app.name'));
            });

            return redirect('event')->with('msg', 'Anda berhasil join event'.ucwords($event->title).', silakan cek pemberithauan melalui email terdaftar');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
