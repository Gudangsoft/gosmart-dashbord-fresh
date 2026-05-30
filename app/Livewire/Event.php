<?php

namespace App\Livewire;

use App\Models\Event as Events;
use App\Models\ClassCategory;
use App\Models\EventRegisted;
use App\Models\PaymentModel;
use Carbon\Carbon;
use Livewire\Component;
use Exception;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Event extends Component
{
    use WithFileUploads;

    public $data;
    public $selected_id;
    public $title, $event_id, $image, $description, $participant, $contact;
    public $price, $bankName, $noRekening, $ownerName, $premium;
    public $category, $category_id, $time, $endTime, $link, $endHour, $hour, $count_registed;

    #[On('refreshParent')]
    public function refreshComponent(): void
    {
        // triggered by child components
    }

    public function editEvent($id)
    {
        $this->selected_id = $id;
        $row = Events::findOrFail($id);
        $payment = PaymentModel::where('user_id', $row->created_by)->latest()->first();
        $this->category = empty($row->category_id) ? null : $row->getCategory->title;
        $this->category_id = $row->category_id;
        $this->title = $row->title;
        $this->image = $row->image;
        $this->description = $row->description;
        $this->participant = $row->participant;
        $this->contact = $row->contact;
        $this->price = $row->price;
        $this->bankName = $payment->bank_name;
        $this->noRekening = $payment->no_rekening;
        $this->ownerName = $payment->owner_name;
        $this->premium = $row->premium;
        $this->link = $row->url_meet;
        $this->time = $row->time;
        $this->endTime = $row->end_time;
        $this->dispatch('openModalEdit');
    }

    public function detailEvent($id)
    {
        $this->selected_id = $id;
        $row = Events::findOrFail($id);
        $this->event_id = $row->id;
        $this->title = $row->title;
        $this->image = $row->image;
        $this->description = $row->description;
        $this->participant = $row->participant;
        $this->contact = $row->contact;
        $this->price = $row->price;
        $this->noRekening = $row->noRekening;
        $this->premium = $row->premium;
        $this->link = $row->url_meet;
        $this->time = Carbon::parse($row->time)->isoFormat('dddd, d MMMM Y');
        $this->endTime = Carbon::parse($row->end_time)->isoFormat('dddd, d MMMM Y');
        $this->hour = Carbon::parse($row->time)->format('H:i');
        $this->endHour = Carbon::parse($row->end_time)->format('H:i');
        $this->count_registed = EventRegisted::where('event_id', $this->selected_id)->count();
        $this->dispatch('openModalDetail');
    }

    public function deleteEvent($id)
    {
        $this->selected_id = $id;
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('confirmedDelete')]
    public function confirmed($id = null)
    {
        Events::findOrFail($id ?? $this->selected_id)->delete();
        session()->flash('success', 'Data berhasil dihapus');
        $this->dispatch('refreshParent');
    }

    public function update()
    {
        try {
            $save = Events::findOrFail($this->selected_id);
            $save->title = Str::title($this->title);
            $save->category_id = $this->category_id;
            $save->url_meet = $this->link;
            $save->description = $this->description;
            $save->participant = $this->participant;
            $save->contact = $this->contact;

            if ($this->premium == 2) {
                $save->price = null;
            } else {
                $save->price = $this->price;
            }

            $save->status = 1;
            $save->premium = (int) $this->premium == 1 ? (int) $this->premium : 2;
            $save->created_by = auth()->user()->id;
            $save->time = $this->time;
            $save->end_time = $this->endTime;
            $save->save();

            PaymentModel::where('user_id', $save->created_by)->update([
                'bank_name'   => $this->bankName,
                'no_rekening' => $this->noRekening,
                'owner_name'  => $this->ownerName,
            ]);

            session()->flash('success', 'Event ' . $this->title . ' berhasil diperbarui');
            $this->dispatch('refreshParent');
            $this->dispatch('closeModalEdit');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->dispatch('refreshParent');
            $this->dispatch('closeModalEdit');
        }
    }

    public function render()
    {
        $this->data = Events::where('created_by', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('livewire.event', [
            'category_data' => ClassCategory::where('status', 1)->get(),
        ]);
    }
}
