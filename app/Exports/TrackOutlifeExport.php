<?php

namespace App\Exports;

use App\Models\Batches;
use App\Models\withdrawCart;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TrackOutlifeExport implements FromView
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $batch = Batches::with('RepackOutlifeDrawInOut','TrackOutlifeHistory','BatchMaterialProduct','BatchOwners')->findOrFail($this->id);  
        securityLog('Track Outlife Report Export'); 
        return view('crm.reports.templates.deduct-track-usage',compact('batch'));
    }
}
