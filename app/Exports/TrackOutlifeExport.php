<?php

namespace App\Exports;

use App\Models\Batches;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TrackOutlifeExport implements FromView
{
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $batch = Batches::with('RepackOutlife','BatchMaterialProduct','BatchOwners')->findOrFail($this->id);  
        return view('crm.reports.templates.deduct-track-usage',compact('batch'));
    }
}
