<?php

namespace App\Livewire;

use App\Models\ClassCategory;
use App\Models\Event;
use App\Models\PaymentModel;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\ResizeImage;

class EventCreate extends Component
{
    use WithFileUploads;

    public $data;
    public $type = null;
    public $title, $description, $participant, $contact, $price;
    public $bankName, $noRekening, $ownerName, $premium;
    public $category, $time, $endTime, $link;

    #[Validate('required')]
    public $title_input;

    #[Validate('required|image|mimes:jpeg,png,jpg,gif,svg|max:5024')]
    public $image;

    #[Validate('required')]
    public $link_input;

    #[Validate('required')]
    public $time_input;

    #[Validate('required')]
    public $endTime_input;

    public function store()
    {
        $this->validate([
            'title'      => 'required',
            'image'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5024',
            'link'       => 'required',
            'time'       => 'required',
            'endTime'    => 'required',
        ]);

        $uniqueFileName = uniqid() . $this->image->getClientOriginalName();
        $this->image->storeAs('public/images', $uniqueFileName);

        $image_crop_name = ResizeImage::resizeImage(
            $uniqueFileName,
            $this->title,
            public_path('/storage/images/'),
            public_path('/events-images/')
        )['file_name'];

        try {
            $save = new Event();
            $save->title = Str::title($this->title);
            $save->slug = Str::slug($this->title);
            $save->category_id = $this->type == null ? 1 : 0;
            $save->image = $image_crop_name;
            $save->url_meet = $this->link;
            $save->description = $this->description;
            $save->participant = $this->participant;
            $save->contact = $this->contact;
            $save->price = $this->premium == 2 ? null : $this->price;
            $save->status = 1;
            $save->premium = $this->premium;
            $save->created_by = auth()->user()->id;
            $save->time = $this->time;
            $save->end_time = $this->endTime;
            $save->save();

            $payment = new PaymentModel();
            $payment->user_id = auth()->user()->id;
            $payment->bank_name = $this->bankName;
            $payment->no_rekening = $this->noRekening;
            $payment->owner_name = $this->ownerName;
            $payment->save();

            session()->flash('success', 'Event ' . $this->title . ' berhasil ditambahkan');
            $this->dispatch('refreshParent');
            $this->dispatch($this->type == null ? 'closeModalEvent' : 'closeModalEventLink');
            $this->cleanVars();
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->dispatch('refreshParent');
            $this->dispatch($this->type == null ? 'closeModalEvent' : 'closeModalEventLink');
            $this->cleanVars();
        }
    }

    private function cleanVars()
    {
        $this->title = null;
        $this->description = null;
        $this->participant = null;
    }

    public function render()
    {
        return view('livewire.event-create', [
            'category_data' => ClassCategory::where('status', 1)->get(),
            'type'          => $this->type,
        ]);
    }
}
