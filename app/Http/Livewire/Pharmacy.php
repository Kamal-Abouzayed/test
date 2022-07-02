<?php

namespace App\Http\Livewire;

use App\Models\Pharmacy as ModelsPharmacy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class Pharmacy extends Component
{
    public $ids;
    public $pharmacy;
    public $pharmacy_name;
    public $date_from;
    public $date_to;
    public $employee;
    public $start_time;
    public $end_time;
    public $day;
    public $updateMode = \false;

    public function resetInput()
    {
        $this->pharmacy_name = null;
        $this->date_from = null;
        $this->date_to = null;
        $this->employee = \null;
        $this->start_time = \null;
        $this->end_time = null;
        $this->day = \null;
    }

    public function store(Request $request)
    {
        $data = $this->validate([
            'pharmacy_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'employee' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
        ]);

        $start = Carbon::parse($this->date_from);
        $end =  Carbon::parse($this->date_to);
        $days = Carbon::parse($this->day)->isBetween($start, $end);
        // \dd($days);
        if ($days) {
            ModelsPharmacy::create($data);
            session()->flash('message', 'Data Created Successfully.');
            $this->resetInput();
        } else {
            session()->flash('error', 'Day must Be In Date Range.');
        }

    }

    public function edit($id)
    {
        $pharmacy = ModelsPharmacy::where('id',$id)->first();
        $this->ids = $pharmacy->id;
        $this->pharmacy_name = $pharmacy->pharmacy_name;
        $this->date_from = $pharmacy->date_from;
        $this->date_to = $pharmacy->date_to;
        $this->employee = $pharmacy->employee;
        $this->start_time = $pharmacy->start_time;
        $this->end_time = $pharmacy->end_time;
        $this->day = $pharmacy->day;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'pharmacy_name' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'employee' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
        ]);

        if ($this->ids) {
            $pharmacy = ModelsPharmacy::find($this->ids);
            $pharmacy->update([
                'pharmacy_name' => $this->pharmacy_name,
                'date_from' => $this->date_from,
                'date_to' => $this->date_to,
                'employee' => $this->employee,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'day' => $this->day,
            ]);

            \session()->flash('message', 'Data Updated Successfully.');
            $this->resetInput();
            $this->updateMode = \false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $pharmacy = ModelsPharmacy::where('id', $id);
            $pharmacy->delete();
        }
    }

    public function render()
    {
        $this->pharmacy = ModelsPharmacy::orderBy('date_from', 'ASC')->orderBy('date_to', 'ASC')->get();
        return view('livewire.pharm.pharmacy');
    }
}
