<?php

namespace App\Exports;


use App\Models\materialProductHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MaterialProductHistoryExport implements FromView
{
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function view(): View
    {
        $materialProductHistory = $this->data;
        securityLog('Material In-House Product History Export');
        return view('crm.reports.templates.material-in-house-pdt-history',compact('materialProductHistory'));
    }
}
